<?php
App::uses('AppController', 'Controller');
/**
 * Profile Page Controller
 *
 */
class ProfileController extends AppController {
 
	public $uses = array('User');
	public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('profile_page');
		$this->layout = 'home';
    }
/**
* Admin login action
*
* @return void
*/
	public function profile_page() {
		//$this->layout = 'home';
		$user_id = $this->Auth->user('id');
		$user = $user_info = array();
		
		$user_options['conditions']['User.id'] = $user_id;
		$user_options['fields'] = array('id', 'first_name', 'last_name', 'name', 'email');
		$user_info = $this->User->getRecord($user_options);
		
		$options['conditions']['Contact.user_id'] = $user_id;
		$options['fields'] = array('id', 'user_id', 'gender', 'dob', 'phone', 'mobile');
		$options['contain'] = $this->User->Contact->containForProfile();
		$user = $this->User->Contact->getRecord($options, 0);
		$user['User'] = $user_info['User'];
		//debug($user);
		$this->set(compact('user'));
	}
}