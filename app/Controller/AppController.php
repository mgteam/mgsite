<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array(
		'Timthumb.Timthumb'
	);
	
/**
 * Components
 *
 * @var array
 */
	public $components = array(
		'Auth' => array(
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email'),
					'scope' => array(
						'User.is_active' => true,
						'User.email_verified' => true
					)
				)
			)
		),
		'Session',
		'Cookie',
		'RememberMe'
		//'Mymail'
	);
    
	function beforeFilter(){
		
		parent::beforeFilter();
		$userInfo = array();
		if($this->Auth->user('id')){
			$userInfo['User'] = $this->Auth->user();
			Configure::write($userInfo);
		}

		$this->layout = 'client';
 		$this->Auth->loginRedirect  = array( 'controller' => 'profile', 'action' => 'profile_page');
		$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
		$this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
		$this->Auth->allow(
			'login',
            'register',
			'index_oauth'
		);
	}
	
/**
 *	execute all code before render.
 *
 *	@access public.
 **/
	public function beforeRender(){
		$this->set('base_url', $this->base_url());
	}

		/*************************************** function to send email from site. **********************************/
	/*protected function _sendMail($settings = array()){
		$options = array();
		
		$options['to'] = $settings['user']['to'];
		$options['from'] = array('luckys383@gmail.com' => 'Mang');
		$options['subject'] = 'Activation';
		$options['content'] = 'Hi '.$settings["user"]['to'].'
					Please click on link '.
					$settings['user']['activation_link'];
		
		if(!$this->Mymail->sendEmail($options)){
			$this->log("APP Controller, LINE NO: 564: Mail is not Sent. ", 'debug');
			return false;
		}
		return true;
	}*/
	
	protected function base_url(){
		return 'http://'.$_SERVER['SERVER_NAME'].Router::url('/');
	}
	
	public function load_external_user_by_url($url){
		$existingUser = false;
		$existingSocialProfile = $this->load_connected_network_by_url($url);
		
		if($existingSocialProfile){
			$contact = $this->load_contact($existingSocialProfile['contact_id']);
			if($contact && !empty($contact['user_id']))
				$existingUser = $this->load_user($user_id);
		}
		else{
		}
		return $existingUser;
	}
	
	public function load_contact($contact_id = null){
		$this->loadModel('Contact');
		return $this->Contact->find('first', array('conditions' => array('id' => $contact_id)));
	}
	
	public function load_connected_network_by_url($url){
		$this->loadModel('ConnectedNetwork');
		return $this->ConnectedNetwork->find('first', array('conditions' => array('url' => $url)));
	}
	
	public function load_user($user_id){
		$this->loadModel('User');
		return $this->User->find('first', array('conditions' => array('id' => $user_id)));
	}
}
