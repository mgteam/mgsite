<?php
App::uses('AppModel', 'Model');
/**
 * LoginHistory Model
 *
 * @property User $User
 */
class LoginHistory extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
/**
 *	save user login and logout detail.
 *
 *	@access public.
 *	@param string session id, integer user id, bool islogin.
 *	@return bool.
 **/
	public function saveHistory($sessionId = null, $userId = null, $isLogin = true) {
		$userInfo = array();
		$data['session_id'] = $sessionId;
		if($isLogin){
			$this->checkTimeout($sessionId, $userId);
			$data['log_in_datetime'] = date(TimeFormat::DatabaseDate);
			$data['id'] = false;
			$data['ip'] = UserSystemInfo::getIp();
			$userInfo = UserSystemInfo::findLocation($data['ip']);
			$data['city'] = $userInfo['city'];
			$data['state'] = $userInfo['state'];
			$data['zip_code'] = $userInfo['zip_code'];
			$data['timezone'] = $userInfo['timezone'];
			$data['latitude'] = $userInfo['latitude'];
			$data['longitude'] = $userInfo['longitude'];
		} else {
			$data['id'] = $this->field('id', array('LoginHistory.session_id' => $sessionId));
			$data['log_out_datetime'] = date(TimeFormat::DatabaseDate);
		}
		$data['user_id'] = $userId;
		if($this->save($data)){
			return true;
		}
		return false;
	}

/**
 * 	check that last time user was time out or not.
 * 	if user last time was timeout then save user's last login time.
 * 
 * 	@access public.
 * 	@param string session id and int user id.
 * 	@return true.
 */
	public function checkTimeout($sessionId = null, $userId = null) {
		$options['conditions']['LoginHistory.user_id'] = $userId;
		$options['conditions']['LoginHistory.log_out_datetime'] = '';
		$options['fields'] = array('id', 'session_id', 'log_out_datetime');
		$options['order'] = array('LoginHistory.id' => 'DESC');
		$user_history = $this->getRecord($options);
		if ($user_history) {
			if ($user_history['LoginHistory']['session_id'] != $sessionId) {
				$user_history['LoginHistory']['log_out_datetime'] = date(TimeFormat::DatabaseDate);
				$this->save($user_history);
			}
		}
		return true;
	}
}
