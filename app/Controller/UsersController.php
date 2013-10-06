<?php
App::uses('AppController', 'Controller');
App::uses('Image', 'Lib');
App::uses('SetUserSocialDetail', 'Lib');
//Import OAuth Class
App::import('Vendor', 'OAuth/OAuthClient');

/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

	public $components = array('ExtAuth.ExtAuth');
	
    public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('login', 'verify', 'auth_login', 'auth_callback', 'data');
    }
    
/**
* Admin login action
*
* @return void
*/
	public function login() {
		$userInfo = array();
		if($this->Auth->user('id')){
			$userInfo['User'] = $this->Auth->user();
			Configure::write($userInfo);
		}
		
       	#traking front users.
		if(isset($userInfo['User']) && !empty($userInfo['User'])){
			$this->redirect(array('controller'=>'users', 'action'=>'index' ));
		}
        
		$this->layout = Layouts::FrontendLogin;
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
                $user_id = $this->Auth->user('id');
				$this->User->id = $user_id;
				$this->User->saveField('last_login', date(TimeFormat::DatabaseDateTime));
                $this->saveHistory($user_id);
				if ($this->here == $this->Auth->loginRedirect) {
                    $this->Auth->loginRedirect = '/';
					//$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in..'), $this->Auth->user('name')), 'default', array('class'=>'success'));
					//$this->Auth->loginRedirect  = array('admin' => true, 'controller' => 'orders', 'action' => 'index');
				}
                if (!empty($this->request->data)) {
					$data = $this->request->data['User'];
					if (empty($this->request->data['User']['remember_me'])) {
						$this->RememberMe->destroyCookie();
					} else {
						$this->_setCookie();
					}
				}
                
				$this->Session->setFlash(sprintf(__d('users', '%s, you have successfully logged in.'), $this->Auth->user('name')), 'default', array('class'=>'success'));
				$this->redirect($this->Auth->loginRedirect);
			} else {
				$this->request->data['User']['password'] = null;
				$this->Session->setFlash(sprintf(__d('users', 'Invalid e-mail / password combination.  Please try again.')), 'default', array('class'=>'error'));
			}
		}
	}
    
/**
 * Common logout action
 * 
 * @author Lucky Saini.
 * @return void
 */
	public function logout() {
		$user = $this->Auth->user();
        // save user login detail.
		$this->saveHistory($user['id'], false);
		$this->Session->destroy();
		$this->Cookie->destroy();
		$this->Session->setFlash(
			sprintf(__d('users', '%s you have successfully logged out.', $user['first_name'])));
		$this->redirect($this->Auth->logout());
	}
    
/**
 * User register action
 *
 * @author Lucky Saini.
 * @return void
 */
	public function register() {
		$namedArgs = $this->passedArgs;
		$this->layout = Layouts::FrontendLogin;
		if ($this->Auth->user()) {
			$this->Session->setFlash(__d('users', 'You have already registered and logged in!'), 'default', array('class'=>'warning'));
			$this->redirect('/');
		}

		if (!empty($this->request->data)) {
			$this->request->data['User']['group_id'] = UserGroup::User;
			$user = $this->User->register($this->request->data);
			if ($user !== false) {
                $user['template'] = Configure::read('Email_Templates.REGITER');
				$this->sendRegisterMail($user);
				$this->Session->setFlash(__d('users', 'Your account has been created. You should receive an e-mail shortly to authenticate your account. Once validated you will be able to login.'), 'default', array('class'=>'success'));
				$this->redirect(array('action' => 'login'));
			} else {
				unset($this->request->data[$this->modelClass]['password']);
				//unset($this->request->data[$this->modelClass]['temppassword']);
				$this->Session->setFlash(__d('users', 'Your account could not be created. Please, try again.'), 'default', array('class' => 'error'));
			}
		}
	}
	
/**
 * Confirm email action
 *
 * @param string $type Type, deprecated, will be removed. Its just still there for a smooth transistion.
 * @param string $token Token
 * @return void
 */
	public function verify($type = 'email', $token = null) {
		try{
			$userDetail = $this->User->verifyEmail($token);
            
			// SENDING WELCOME EMAIL
			$options['to'] = $userDetail['User']['email'];
			$options['from'] = array(EMIL_FROM => TITLE);
			$options['subject'] = Configure::read('EMAIL_SUBJECTS.WELCOME_MAIL');
			$options['template'] = Configure::read('Email_Templates.WELCOME');
            $options['viewVars'] = array(
				'user' => array(
					'first_name' => $userDetail['User']['first_name'],
					'last_name' => $userDetail['User']['last_name'],
					'email' => $userDetail['User']['email']
				)
			);
            SendMail::sendEmail($options);
			$this->Session->setFlash(__d('users', 'Your e-mail has been validated!'), 'default', array('class'=>'success'));
			return $this->redirect(array('controller' => 'users', 'action' => 'login'));
		} catch (RuntimeException $e) {
			$this->Session->setFlash($e->getMessage(), 'default', array('class' => 'error'));
			return $this->redirect('/');
		}
	}
	
/**
 * Social media login [Surinder Sammy]
 */
	public function auth_login($provider) {
		
		$result = $this->ExtAuth->login($provider);		
		if ($result['success']) {			
			$this->redirect($result['redirectURL']);

		} else {
			$this->Session->setFlash($result['message']);
			$this->redirect($this->Auth->loginAction);
		}
	}

/**
 * Social media login callback [Surinder Sammy]
 */
	public function auth_callback($provider = array()) {
		$this->autoRender = false;
        $contact = $result = array();
		$result = $this->ExtAuth->loginCallback($provider);
		if ($result['success']) {
			//$result data
			//When come from Facebook
			/*$result = array(
				'success' => true,
				'accessToken' => 'CAAIUnL5fWsEBAAcw8T6pWx2P53CrUBd3SFVPzvtpPZAvFh5ksBexuniOE5Bl6lcbeG7QSBhs5nZCUCjiRk3mYD57ZCaVjLTWziC0pgVR1ZCxgYhkyG9DwoeLcDNwjIzNrP3325BgDkQV6gfgaJ9X',
				'profile' => array(
					'id' => '100001185010014',
					'name' => 'Surinder Sammy',
					'first_name' => 'Surinder',
					'last_name' => 'Sammy',
					'username' => 'surinder.sammy',
					'gender' => 'male',
					'email' => 'sammy27july@gmail.com',
					'locale' => 'en_US',
					'given_name' => 'Surinder',
					'family_name' => 'Sammy',
					'oid' => 'https://www.facebook.com/surinder.sammy',
					'picture' => 'https://graph.facebook.com/surinder.sammy/picture?type=large',
					'raw' => '{"id":"100001185010014","name":"Surinder Sammy","first_name":"Surinder","last_name":"Sammy","link":"https:\/\/www.facebook.com\/surinder.sammy","username":"surinder.sammy","hometown":{"id":"106313309406070","name":"Ludhiana, Punjab, India"},"sports":[{"id":"109441309082794","name":"Kabaddi"}],"gender":"male","email":"sammy27july\u0040gmail.com","timezone":5.5,"locale":"en_US","languages":[{"id":"105606752807048","name":"Punjabi"},{"id":"112969428713061","name":"Hindi"},{"id":"106059522759137","name":"English"}],"verified":true,"updated_time":"2013-05-02T09:42:11+0000"}',
					'provider' => 'Facebook'
				)
			);*/
			//When come from google
			/*$result = array(
				'success' => true,
				'accessToken' => 'ya29.AHES6ZSmvNB48ceDS5HpP9JEhnjutL8TupuSYW8ZY7mBIxM9S_M9bg',
				'profile' => array(
					'email' => 'sammy.mengra@gmail.com',
					'given_name' => 'Surinder',
					'family_name' => 'Sammy',
					'gender' => 'male',
					'locale' => 'en',
					'oid' => 'https://plus.google.com/114676595476522367467',
					'dob' => '0000-08-01',
					'username' => 'Surinder Sammy',
					'raw' => '{
						 "id": "114676595476522367467",
						 "email": "sammy.mengra@gmail.com",
						 "verified_email": true,
						 "name": "Surinder Sammy",
						 "given_name": "Surinder",
						 "family_name": "Sammy",
						 "link": "https://plus.google.com/114676595476522367467",
						 "gender": "male",
						 "birthday": "0000-08-01",
						 "locale": "en"
					}',
					'provider' => 'Google'
				)
			);*/
		
			$this->__successfulExtAuth($result['profile'], $result['accessToken']);
			
		} else {
			$this->Session->setFlash($result['message']);
			$this->redirect($this->Auth->loginAction);
		}
	}
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
		$this->set('user', $this->User->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * check is external user or not
 *
 * @throws NotFoundException
 * @param array $profile_data
 * @return user
 */
	public function isExternalUser($profile_data = null) {
		if(!empty($profile_data) && is_array($profile_data)){
			$conditions = array();
			switch($profile_data['provider']){
				case 'Facebook':
					$conditions['provider'] = 'Facebook';
					break;
				case 'Google':
					break;
				case 'Twitter':
					break;
				case 'LinkedIn':
					break;
			}
		}
		else{
			return false;
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
    
    /*********************** private methods *********************************/

/**
 * Save user social media data [Surinder Sammy]
 * check user social site detail and save detail.
 * 
 * @author Lucky Saini
 */
	private function __successfulExtAuth($incomingProfile, $accessToken) {
		$contact = $response = array();

		// set data accourding to social media.
		if ($incomingProfile['provider'] == 'Facebook') {
			$contact = SetUserSocialDetail::setFacebookData($incomingProfile, $accessToken);
		} else {
			$contact = SetUserSocialDetail::setGoogleData($incomingProfile, $accessToken);
		}
		
		if (!empty($incomingProfile['email'])) {
			// check user is already registered.
			if ($this->User->isRegistered($incomingProfile['email'])) {
                
                // user logged in already, attach profile to logged in user.
				if ($this->Auth->loggedIn()) {
					// TODO:: Update or Create user connected network data
					// TODO:: If connect with facebook then import contacts
				} else {
					
					// save user connected network detail.
					$network_id = $contact['ConnectedNetwork']['0']['network_id'];
					if (!$this->User->Contact->ConnectedNetwork->isNetworkIdExists($network_id)) {
						$contact_id = $this->User->Contact->getContactId($contact['Contact']['email']);
						$this->User->Contact->ConnectedNetwork->addNewNetwork($contact, $contact_id);
					}
					
					//$this->User->saveContactProfileImage();
					
					$user['User']['email'] = $contact['Contact']['email'];
					// log in
					$this->__doAuthLogin($user);
				}
			} elseif ($this->User->Contact->isSocialUserExists($incomingProfile['oid'], $incomingProfile['email'])) {
				// is user in contact.
				$response = $this->registerSocialUser($contact);
				$response['Contact']['id'] = $this->User->Contact->isSocialUserExists($incomingProfile['oid'], $incomingProfile['email']);
				$user['User'] = $response['User'];
                
                // set user raw data.
                if (isset($incomingProfile['raw']) && !empty($incomingProfile['raw'])) {
                    $user_profile_detail = SetUserSocialDetail::setFacebookUserDetail($incomingProfile['raw']);
                    $response = array_merge($response, $user_profile_detail);
                }
				
				unset($response['User']);
				$this->User->Contact->saveAll($user_contact);
				$this->Session->setFlash(__('Congratulations, your account is successfully completed.'));
				$this->__doAuthLogin($user, true);
			} else {				// user is not exists.
				$this->registerNewSocialUser($contact, $incomingProfile);
			}
		} else {
			$this->Session->setFlash(__('Your Email id is not isset.'));
			$this->redirect($this->Auth->loginAction);
		}
	}

/**
 *	perform action of save new social user.
 *	
 *	@author Lucky Saini.
 *	@param array of user contact detail and array of user social profile.
 *	@return false.
 **/
	private function registerNewSocialUser($contact = array(), $incomingProfile = array()) {
		$contact = $this->registerSocialUser($contact);
		$user['User'] = $contact['User'];
		unset($contact['User']);
		
		// set user raw data.
		if (isset($incomingProfile['raw']) && !empty($incomingProfile['raw'])) {
			$user_profile_detail = SetUserSocialDetail::setFacebookUserDetail($incomingProfile['raw']);
			$contact = array_merge($contact, $user_profile_detail);
		}
		
		if($this->User->Contact->saveAll($contact)) {
			$this->Session->setFlash(__('Congratulations, your account is successfully completed.'));
			$this->__doAuthLogin($user, true);
		} else {
			$this->Session->setFlash(__('There is some error in your registration.'));
			$this->redirect(array('controller' => 'users', 'action' => 'login'));
		}
	}
    private function load_external_user($oid){
        return $this->User->Contact->field('id', array('Contact.oid' => $oid));
    }
    
/**
 *  do login for authorized user after connecting with social media.
 *
 *  @author Lucky Saini
 *  @param array of user detail and bool of redirection.
 **/
	private function __doAuthLogin($user, $isRedirectToProfile = false) {
        
		if ($this->Auth->login($user['User'])) {
			$users_options['conditions']['User.email'] = $user['User']['email'];
			$user = $this->User->getRecord($users_options);
			$this->Session->write('Auth', $user);
			$user['User']['last_login'] = date(TimeFormat::DatabaseDateTime);
			$this->User->save(array('User' => $user));
            
            $this->log($this->Auth->user('username').' logged in','info');
            if ($isRedirectToProfile) {
                $this->redirect(array('controller' => 'profile', 'action' => 'profile_page'));
            } else {
                $this->redirect($this->Auth->loginRedirect);
            }
		}
	}

/**
 *	save user login/logout detail.
 *
 *	@access private.
 *	@param integer user id, bool islogin.
 *	@return false.
 **/
	private function saveHistory($userId = null, $isLogin = true) {
		// save user login hostory.
		$this->loadModel('LoginHistory');
		$session_id = $this->Session->id();
		$this->LoginHistory->saveHistory($session_id, $userId, $isLogin);
	}

	/**
 *	function for register social user detail.
 *	and send verification email to user to active his/her account.
 *
 *	@access private.
 *	@param user detail.
 *	@return array of user detail.
 **/
	private function registerSocialUser($contact) {
		$detail = array();
		$password = $this->User->generatePassword();
		$detail['first_name'] = $contact['Contact']['first_name'];
		$detail['last_name'] = $contact['Contact']['last_name'];
		$detail['email'] = $contact['Contact']['email'];
		$detail['group_id'] = UserGroup::User;
		$detail['password'] = $password;
		$user['User'] = $detail;
		$user = $this->User->register($user, false);
		$user['User']['password'] = $password;
		$user['template'] = Configure::read('Email_Templates.REGITER_SOCIAL_USER');
		$this->sendRegisterMail($user);
		$contact['User'] = $user['User'];
		$contact['Contact']['user_id'] = $user['User']['id'];
		return $contact;
	}
	
/**
 *	function for send mail after successful registration process.
 *
 *	@access private.
 *	@param array of user detail.
 *	@return boolean.
 **/
	private function sendRegisterMail($user = array()) {
		// SENDING ACTIVATION EMAIL
		$options = array();
		$options['to'] = $user['User']['email'];
		$options['from'] = array(EMIL_FROM => TITLE);
		$options['subject'] = Configure::read('EMAIL_SUBJECTS.REGISTER');
		$options['template'] = $user['template'];
		
		$email_vars['first_name'] = $user['User']['first_name'];
		$email_vars['last_name'] = $user['User']['last_name'];
		$email_vars['email'] = $user['User']['email'];
		if (isset($user['User']['password'])){
			$email_vars['password'] = $user['User']['password'];
		}
		if (isset($user['User']['email_token'])) {
			$email_vars['token'] = $user['User']['email_token'];
		}
		$options['viewVars'] = array(
			'user' => $email_vars
		);
		return SendMail::sendEmail($options);
	}
    
/**
 * Sets the cookie to remember the user
 *
 * @param array RememberMe (Cookie) component properties as array, like array('domain' => 'yourdomain.com')
 * @param string Cookie data keyname for the userdata, its default is "User". This is set to User and NOT using the model alias to make sure it works with different apps with different user models across different (sub)domains.
 * @return void
 * @deprecated Use the RememberMe Component
 */
	protected function _setCookie($options = array(), $cookieKey = 'rememberMe') {
		$this->RememberMe->settings['cookieKey'] = $cookieKey;
		$this->RememberMe->configureCookie($options);
		$this->RememberMe->setCookie();
	}
}
