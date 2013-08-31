<?php
App::uses('AppController', 'Controller');

class MadminAppController extends AppController {
/**
 * Helpers
 *
 * @var array
 */
	
	public $helpers = array(
		'Madmin.Cdn',
	);
	//public $helpers = array('Madmin.Status',
	//	'Madmin.Cdn',
	//	'Madmin.Menu',
	//	'Madmin.BootstrapPaginator',
	//	'Madmin.Day',
	//	'Madmin.Time'
	//);

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
						'User.is_active' => 1
					)
				)
			)
		),
		'Session',
		'Cookie',
		'Search.Prg',
		'CsvView.CsvView'
		//'Madmin.FilterRecallComponent'
	);

	public function beforeFilter(){
		parent::beforeFilter();
		$userInfo = array();
		if($this->Auth->user('id')){
			$userInfo['User'] = $this->Auth->user();
			Configure::write($userInfo);
		}
		$this->Auth->logoutRedirect = array('plugin' => 'madmin', 'controller' => 'users', 'action' => 'login');
		$this->Auth->loginAction = array('plugin' => 'madmin', 'controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect  = array('plugin' => 'madmin', 'controller' => 'users', 'action' => 'index');
		$this->Auth->allow(
			'madmin.login', 'madmin.add'
		);
		$this->set(compact('userInfo'));
	}	

/**
 *	Admin toggle status.
 **/
	function status($id, $status = 0, $field = 'status'){
		if(!$id){
			$this->Session->setFlash(__('Invalid request.'), 'default', array('class'=>'error'));
			$this->redirect(array('action' => 'index'));
		}
		$this->{$this->modelClass}->id = $id;
    	$this->{$this->modelClass}->saveField($field , $status);
		$this->Session->setFlash(__('Status has been updated.'), 'default', array('class'=>'success'));
    	$this->redirect($this->referer());
	}
	
/**
 * Base method for exporting data to csv file
 * Make use of the ViewClass 'CsvView' provide the CsvView Plugin
 */
	public function export(){
		

	}
}
