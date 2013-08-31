<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property UserProfile $UserProfile
 */
class User extends AppModel {

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'name';
    
/**
 * Virtual Full Name
 *
 * @var string
 */
    public $virtualFields = array(
        'name' => 'CONCAT(User.first_name, " ", User.last_name)'
    );

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'first_name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true, 'allowEmpty' => false,
				'message' => 'This field can\'t stay empty'
			)
		),
		'last_name' => array(
			'required' => array(
				'rule' => array('notEmpty'),
				'required' => true, 'allowEmpty' => false,
				'message' => 'This field can\'t stay empty')
		),
		'email' => array(
			'isValid' => array(
				'rule' => 'email',
				'required' => true,
				'message' => 'Valid email required.'),
			'isUnique' => array(
				'rule' => array('isUnique', 'email'),
				'message' => 'Email is already in use.')
		),
		'password' => array(
			'required' => array(
				'rule' => 'notEmpty',
				'message' => 'This field can\'t stay empty'),
            'between' => array(
                'rule'    => array('between', 6, 20),
                'message' => 'Between 6 to 20 characters'
            )           
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
		'Contact' => array(
			'className' => 'Contact',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'LoginHistory' => array(
			'className' => 'LoginHistory',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'UserProfile' => array(
			'className' => 'UserProfile',
			'foreignKey' => 'user_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
    
/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'Contact' => array(
			'className' => 'Contact',
			'joinTable' => 'users_contacts',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'contact_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	/*public function __construct() {
		$this->_setupValidation();
	}*/
    
/**
 * Setup validation rules
 *
 * @return void
 */
	protected function _setupValidation() {
		$this->validatePasswordChange = array(
			'new_password' => $this->validate['password'],
			'confirm_password' => array(
				'required' => array('rule' => array('compareFields', 'new_password', 'confirm_password'), 'required' => true, 'message' => __d('users', 'The passwords are not equal.'))),
			'old_password' => array(
				'to_short' => array('rule' => 'validateOldPassword', 'required' => true, 'message' => __d('users', 'Invalid password.'))));
	}
    
    
/**
 * Create a hash from string using given method.
 * Fallback on next available method.
 *
 * Override this method to use a different hashing method
 *
 * @param string $string String to hash
 * @param string $type Method to use (sha1/sha256/md5)
 * @param boolean $salt If true, automatically appends the application's salt
 *     value to $string (Security.salt)
 * @return string Hash
 */
	public function hash($string, $type = null, $salt = false) {
		return Security::hash($string, $type, $salt);
	}

/**
 * Custom validation method to ensure that the two entered passwords match
 *
 * @param string $password Password
 * @return boolean Success
 */
	public function confirmPassword($password = null) {
		if ((isset($this->data['User']['password']) && isset($password['temppassword']))
			&& !empty($password['temppassword'])
			&& ($this->data['User']['password'] === $password['temppassword'])) {
			return true;
		}
		return false;
	}
	

/**
 * Compares the email confirmation
 *
 * @param array $email Email data
 * @return boolean
 */
	public function confirmEmail($email = null) {
		if ((isset($this->data['User']['email']) && isset($email['confirm_email']))
			&& !empty($email['confirm_email'])
			&& (strtolower($this->data['User']['email']) === strtolower($email['confirm_email']))) {
				return true;
		}
		return false;
	}

/**
 * Verifies a users email by a token that was sent to him via email and flags the user record as active
 *
 * @param string $token The token that wa sent to the user
 * @return array On success it returns the user data record
 */
	public function verifyEmail($token = null) {
		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				'User.email_verified' => 0,
				'User.email_token' => $token),
			'fields' => array(
				'id', 'first_name', 'last_name',  'email', 'email_token_expires')));

		if (empty($user)) {
			throw new RuntimeException(__d('users', 'Invalid token, please check the email you were sent, and retry the verification link.'));
		}

		$expires = strtotime($user['User']['email_token_expires']);
		if ($expires < time()) {
			throw new RuntimeException(__d('users', 'The token has expired.'));
		}

		$data['User']['is_active'] = true;
		$user['User']['email_verified'] = true;
		$user['User']['email_token'] = null;
		$user['User']['email_token_expires'] = null;
		$user = $this->save($user, array('validate' => false,'callbacks' => false));
		$this->data = $user;
		return $user;
	}

/**
 * Validates the user token
 *
 * @deprecated See verifyEmail()
 * @param string $token Token
 * @param boolean $reset Reset boolean
 * @param boolean $now time() value
 * @return mixed false or user data
 */
	public function validateToken($token = null, $reset = false, $now = null) {
		if (!$now) {
			$now = time();
		}

		$data = false;
		$match = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.email_token' => $token),
			'fields' => array(
				'id', 'email', 'email_token_expires')));

		if (!empty($match)) {
			$expires = strtotime($match['User']['email_token_expires']);
			if ($expires > $now) {
				$data['User']['id'] = $match['User']['id'];
				$data['User']['email'] = $match['User']['email'];
				$data['User']['email_verified'] = '1';

				if ($reset === true) {
					$newPassword = $this->generatePassword();
					$data['User']['password'] = $this->hash($newPassword, null, true);
					$data['User']['new_password'] = $newPassword;
					$data['User']['password_token'] = null;
				}

				$data['User']['email_token'] = null;
				$data['User']['email_token_expires'] = null;
			}
		}

		return $data;
	}

/**
 * Updates the last activity field of a user
 *
 * @param string $user User ID
 * @param string $field Default is "last_action", changing it allows you to use this method also for "last_login" for example
 * @return boolean True on success
 */
	public function updateLastActivity($userId = null, $field = 'last_action') {
		if (!empty($userId)) {
			$this->id = $userId;
		}
		if ($this->exists()) {
			return $this->saveField($field, date(TimeFormat::DatabaseDate, time()));
		}
		return false;
	}

/**
 * Checks if an email is in the system, validated and if the user is active so that the user is allowed to reste his password
 *
 * @param array $postData post data from controller
 * @return mixed False or user data as array on success
 */
	public function passwordReset($postData = array()) {
		$this->recursive = -1;
		$user = $this->find('first', array(
			'conditions' => array(
				$this->alias . '.is_active' => 1,
				$this->alias . '.email' => $postData['User']['email'])));

		if (!empty($user)) {
			$sixtyMins = time() + 43000;
			$token = $this->generatePassword();
			$user['User']['password_token'] = $token;
			$user['User']['email_token_expires'] = date(TimeFormat::DatabaseDate, $sixtyMins);
			$user = $this->save($user, false);
			$this->data = $user;
			return $user;
		}

		return false;
	}

/**
 * Checks the token for a password change
 * 
 * @param string $token Token
 * @return mixed False or user data as array
 */
	public function checkPasswordToken($token = null) {
		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.is_active' => 1,
				$this->alias . '.password_token' => $token,
				$this->alias . '.email_token_expires >=' => date(TimeFormat::DatabaseDate))));
		if (empty($user)) {
			return false;
		}
		return $user;
	}

/**
 * Resets the password
 * 
 * @param array $postData Post data from controller
 * @return boolean True on success
 */
	public function resetPassword($postData = array()) {
		$result = false;

		$tmp = $this->validate;
		$this->validate = array(
			'new_password' => $tmp['password'],
			'confirm_password' => array(
				'required' => array(
					'rule' => array('compareFields', 'new_password', 'confirm_password'), 
					'message' => __d('users', 'passwords are not equal.'))));

		$this->set($postData);
		if ($this->validates()) {
			$this->data['User']['password'] = $this->hash($this->data['User']['new_password'], null, true);
			$this->data['User']['password_token'] = null;
			$result = $this->save($this->data, array(
				'validate' => false,
				'callbacks' => false));
		}

		$this->validate = $tmp;
		return $result;
	}

/**
 * Changes the password for a user
 *
 * @param array $postData Post data from controller
 * @return boolean True on success
 */
	public function changePassword($postData = array()) {
		$this->validate = $this->validatePasswordChange;
		$this->set($postData);
		if ($this->validates()) {
			$this->data['User']['password'] = $this->hash($this->data['User']['new_password'], null, true);
			$this->save($postData, array(
				'validate' => false,
				'callbacks' => false));
			return true;
		}
		return false;
	}

/**
 * Validation method to check the old password
 *
 * @param array $password 
 * @return boolean True on success
 */
	public function validateOldPassword($password) {
		if (!isset($this->data['User']['id']) || empty($this->data['User']['id'])) {
			if (Configure::read('debug') > 0) {
				throw new OutOfBoundsException(__d('users', '$this->data[\'' . $this->alias . '\'][\'id\'] has to be set and not empty'));
			}
		}

		$currentPassword = $this->field('password', array($this->alias . '.id' => $this->data['User']['id']));
		return $currentPassword === $this->hash($password['old_password'], null, true);
	}

/**
 * Validation method to compare two fields
 *
 * @param mixed $field1 Array or string, if array the first key is used as fieldname
 * @param string $field2 Second fieldname
 * @return boolean True on success
 */
	public function compareFields($field1, $field2) {
		if (is_array($field1)) {
			$field1 = key($field1);
		}
		if (isset($this->data['User'][$field1]) && isset($this->data['User'][$field2]) && 
			$this->data['User'][$field1] == $this->data['User'][$field2]) {
			return true;
		}
		return false;
	}

/**
 * Returns all data about a user
 *
 * @param string $slug user slug or the uuid of a user
 * @return array
 */
	public function view($id = null) {
		$user = $this->find('first', array(
			'contain' => array(
				'UserDetail'),
			'conditions' => array(
				'User.id'=>$id,
				'User.is_active' => 1,
				'User.email_verified' => 1)));

		if (empty($user)) {
			throw new OutOfBoundsException(__d('users', 'The user does not exist.'));
		}

		return $user;
	}

/**
 * Registers a new user
 *
 * Options:
 * - bool emailVerification : Default is true, generates the token for email verification
 * - bool removeExpiredRegistrations : Default is true, removes expired registrations to do cleanup when no cron is configured for that
 * - bool returnData : Default is true, if false the method returns true/false the data is always available through $this->User->data
 *
 * @param array $postData Post data from controller
 * @param mixed should be array now but can be boolean for emailVerification because of backward compatibility
 * @return mixed
 */
	public function register($postData = array(), $options = array()) {
		if (is_bool($options)) {
			$options = array('emailVerification' => $options);
		}

		$defaults = array(
			'emailVerification' => true,
			'removeExpiredRegistrations' => true,
			'returnData' => true);
		extract(array_merge($defaults, $options));

		$postData = $this->_beforeRegistration($postData, $emailVerification);

		if ($removeExpiredRegistrations) {
			$this->_removeExpiredRegistrations();
		}

		// getting user info.
		$userInfo['User'] = isset($postData['User']) ? $postData['User'] : null;

		// getting baby info.
		//$babyInfo['UserBaby'] = isset($postData['UserBaby']) ? $postData['UserBaby'] : null;

		$this->set($userInfo);
		//$this->UserBaby->set($babyInfo['UserBaby']);        
		if ($this->validates()) {
			$postData['User']['password'] = $this->hash($postData['User']['password'], 'sha1', true);
			$postData['User']['group_id'] = UserGroup::User;
			$this->create();
			
			// saving user info.
			if($this->saveAssociated($postData, array('validate'=>false ))){
				$this->data = $postData;
				$this->data['User']['id'] = $this->id;
				return $this->data;
			}
		}
		return false;
	}



/**
 * Registers a new user without varification
 *
 * @param array $postData Post data from controller
 * @return mixed
 */
	/*public function register_checkout_user($postData = array()) {
		$postData['User']['email_verified'] = ACTIVE;
		$postData['User']['tos'] = ACTIVE;
		// getting user info.
		$userInfo['User'] = isset($postData['User']) ? $postData['User'] : null;
		$this->set($userInfo);

		if ($this->validates()) {
			$postData['User']['password'] = $this->hash($postData['User']['password'], 'sha1', true);
			$postData['User']['group_id'] = UserGroup::User;
			$this->create();
			
			// saving user info.
			if($this->saveAssociated($postData, array('validate'=>false ))){
				$this->data = $postData;
				$this->data['User']['id'] = $this->id;
				return $this->data;
			}
		}
		return false;
	}*/

/**
 * Resends the verification if the user is not already validated or invalid
 *
 * @param array $postData Post data from controller
 * @return mixed False or user data array on success
 */
	public function resendVerification($postData = array()) {
		if (!isset($postData['User']['email']) || empty($postData['User']['email'])) {
			$this->invalidate('email', __d('users', 'Please enter your email address.'));
			return false;
		}

		$user = $this->find('first', array(
			'contain' => array(),
			'conditions' => array(
				$this->alias . '.email' => $postData['User']['email'])));

		if (empty($user)) {
			$this->invalidate('email', __d('users', 'The email address does not exist in the system'));
			return false;
		}

		if ($user['User']['email_verified'] == 1) {
			$this->invalidate('email', __d('users', 'Your account is already authenticaed.'));
			return false;
		}

		if ($user['User']['active'] == 0) {
			$this->invalidate('email', __d('users', 'Your account is disabled.'));
			return false;
		}

		$user['User']['email_token'] = $this->generatePassword();
		$user['User']['email_token_expires'] = date(TimeFormat::DatabaseDate, time() + 86400);

		return $this->save($user, false);
	}

/**
 * Generates a password
 *
 * @param int $length Password length
 * @return string
 */
	public function generatePassword($length = 10, $add_dashes = false, $sets = 'lud') {
		/*srand((double)microtime() * 1000000);
		$password = '';
		$vowels = array("a", "e", "i", "o", "u");
		$cons = array("b", "c", "d", "g", "h", "j", "k", "l", "m", "n", "p", "r", "s", "t", "u", "v", "w", "tr",
							"cr", "br", "fr", "th", "dr", "ch", "ph", "wr", "st", "sp", "sw", "pr", "sl", "cl");
		for ($i = 0; $i < $length; $i++) {
			$password .= $cons[mt_rand(0, 31)] . $vowels[mt_rand(0, 4)];
		}
		return substr($password, 0, $length);*/

		return GeneratePassword::getPassword($length, $add_dashes, $sets);
	}
    
/**
 * Optional data manipulation before the registration record is saved
 *
 * @param array post data array
 * @param boolean Use email generation, create token, default true
 * @return array
 */
	protected function _beforeRegistration($postData = array(), $useEmailVerification = true) {
		if ($useEmailVerification == true) {
			$postData['User']['email_token'] = $this->generatePassword();
			$postData['User']['email_token_expires'] = date(TimeFormat::DatabaseDate, time() + 86400);
		} else {
			$postData['User']['email_verified'] = 1;
		}
        $postData['User']['is_active'] = 1;
        return $postData;
	}

/**
 * Adds a new user
 * 
 * @param array post data, should be Controller->data
 * @return boolean True if the data was saved successfully.
 */
	public function add($postData = null) {
		if (!empty($postData)) {
            $this->data = $postData;
            if ($this->validates()) {
                $postData['User']['password'] = $this->hash($postData['User']['password'], 'sha1', true);
                $this->create();
                $result = $this->save($postData, false);
                if ($result) {
                    $result['User']['id'] = $this->id;
                    $this->data = $result;
                    return true;
                }
            }
		}
		return false;
	}

/**
 * Edits an existing user
 *
 * @param string $userId User ID
 * @param array $postData controller post data usually $this->data
 * @return mixed True on successfully save else post data as array
 */
	public function edit($userId = null, $postData = null) {
		$user = $this->find('first', array('conditions' => array('User.id' => $userId)));

		$this->set($user);
		if (empty($user)) {
			throw new OutOfBoundsException(__d('users', 'Invalid User'));
		}
		if (!empty($postData)) {
			$this->set($postData);
			$result = $this->save(null, true);
			if ($result) {
				$this->data = $result;
				return true;
			} else {
				return $postData;
			}
		}
	}

/**
 * Removes all users from the user table that are outdated
 *
 * Override it as needed for your specific project
 *
 * @return void
 */
	protected function _removeExpiredRegistrations() {
		$this->deleteAll(array(
			$this->alias . '.email_verified' => 0,
			$this->alias . '.email_token_expires <' => date(TimeFormat::DatabaseDate)));
	}    
}
