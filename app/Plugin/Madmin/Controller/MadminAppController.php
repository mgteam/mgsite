<?php
App::uses('AppController', 'Controller');

class MadminAppController extends AppController {
/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array(
		'Html',
		'Form',
		'TB' => array(
			'className' => 'TwitterBootstrap.TwitterBootstrap'
		),
		'Session',
		'Paginator' => array(
			'className' => 'Madmin.BootstrapPaginator'
		),
		'Madmin.Admin',
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
		'Paginator',
		'CsvView.CsvView',
		'Madmin.Site',
	);

/**
 * variables to be used in views to make necessary admin panel calls
 */
	public $sidebarElements = array(
		'index' => array(
			'filters' => array(
				'filterRequestAction' => array('action' => 'index_filters')
			)
		),
		'add' => array(
		),
		'edit' => array(
		),
		'default' => array(
			'quick_links' => array(
				'quickLinkRequestAction' => array('action' => 'quick_links')
			),
		)
	);
	
/**
 *	set Auth actions.
 *	set user information in configuration if user is logged in.
 *	call function which set pagination limit.
 *	
 *	@return void.
 */
	public function beforeFilter(){
		parent::beforeFilter();
		$userInfo = array();
		if($this->Auth->user('id')){
			$userInfo['User'] = $this->Auth->user();
			$userInfo['User']['name'] = $userInfo['User']['first_name'] . ' ' . $userInfo['User']['last_name'];
			Configure::write($userInfo);
		}
		$this->Auth->logoutRedirect = array('plugin' => 'madmin', 'controller' => 'users', 'action' => 'login');
		$this->Auth->loginAction = array('plugin' => 'madmin', 'controller' => 'users', 'action' => 'login');
		$this->Auth->loginRedirect  = array('plugin' => 'madmin', 'controller' => 'users', 'action' => 'index');
		$this->Auth->allow(
			'madmin.login'
		);
		$this->set(compact('userInfo'));
		
		$this->layout = 'default';
		
		// call functions
		$this->setPageLimit();
	}	

/**
 * the beforeRender callback
 */
	public function beforeRender() {
		if (!$this->request->is('requested') 
			&& !$this->request->is('ajax')) {
			$this->set('sidebarElements', $this->sidebarElements);
		}
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
	
	/************************************ Private function ***************************/
/**
 *	set pagination limit to paginator.
 *	if user change the pagination limit then save value to session 
 *	and set new pagination limit.
 *
 *	@access private.
 *	@return void.
 */
	private function setPageLimit(){
		$page_limit = null;

		// set limit value to session.
		if (isset($this->request->params['named']['limit']) && !empty($this->request->params['named']['limit'])) {
			$this->Session->write('page_limit', $this->request->params['named']['limit']);
		}

		// check and get page limit value form session.
		if ($this->Session->check('page_limit')) {
			$page_limit = $this->Session->read('page_limit');
		}

		$this->Paginator->settings['limit'] = (!empty($page_limit)) ? $page_limit : ADMIN_PAGE_LIMIT;
	}
}
