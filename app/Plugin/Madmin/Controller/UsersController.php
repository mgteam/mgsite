<?php
App::uses('MadminAppController', 'Madmin.Controller');
/**
 * Users Controller
 *
 */
class UsersController extends MadminAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	//public $scaffold;

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';
	
	public $presetVars = true; // using the model configuration

/**
 *	override parent before filter method of plugin app controller.
 *
 *	@access public.
 **/
	public function beforeFilter(){
		parent::beforeFilter();
		$this->set('title_for_layout', 'User Manager');
	}
	
/**
 *	login
 *
 *	@access public.
 **/
	public function login(){
		$this->layout = 'Madmin.login';
		if($this->Auth->user()){
			$this->redirect(array('plugin'=>'madmin','controller' => 'users', 'action' => 'index'));
		}
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$user_id = $this->Auth->user('id');
				$this->User->id = $user_id;
				
				// save user login detail.
				$this->User->saveField('last_login', date('Y-m-d H:i:s'));
				//$this->saveHistory($user_id);
					
				if ($this->here == $this->Auth->loginRedirect) {
					$this->Auth->loginRedirect = '/';
				}
				if (!empty($this->request->data)) {
					$data = $this->request->data['User'];
				}
					
				//$this->Auth->loginRedirect  = array('hub' => true, 'controller' => 'users', 'action' => 'index');
				$this->Site->successFlash(sprintf(__d('users', '%s, you have successfully logged in.'), $this->Auth->user('first_name')));
				$this->redirect($this->Auth->redirect());
			} else {
				$this->request->data['User']['password'] = null;
				$this->Site->errorFlash(sprintf(__d('users', 'Invalid e-mail / password combination.  Please try again.')));
			}
		}
		$this->set('title_for_layout', 'User Login');
	}
	
/**
 *	logout user.
 *
 *	@access public.
 *	@return false.
 **/
	public function logout(){
		$user = $this->Auth->user();
		$this->Session->destroy();
		$this->Cookie->destroy();
		//$this->saveHistory();
		$this->Site->successFlash(
			sprintf(__d('users', '%s you have successfully logged out.', $user['first_name'])));
		$this->redirect($this->Auth->logout());
	}
	
	public function index(){
		$this->User->recursive = -1;
		$this->Prg->commonProcess();
		$conditions = $this->User->parseCriteria($this->passedArgs);
		$conditions['User.group_id <>'] = UserGroup::SuperAdmin;
		$this->Paginator->settings['conditions'] = $conditions;
        $users = $this->Paginator->paginate('User');
		$sideSection = 'index';
        $this->set(compact('users', 'sideSection'));
	}
	
/**
 *	add
 *
 *	@access public.
 **/
	public function add(){
		if (!empty($this->data)) {
				$this->User->create();
				$this->request->data['User']['group_id'] = UserGroup::User;
				$this->request->data['User']['password'] = $this->User->hash($this->request->data['User']['password'], 'sha1', true);
				
				if ($this->User->save($this->data)) {
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Site->errorFlash('The record could not be saved. Please, try again.');
				}
		}
	}
	
/**
 *	add
 *
 *	@access public.
 **/
	public function view($id = null){
		if (!$this->User->exists($id)) {
			throw new NotFoundException(__('Invalid user'));
		}
		$user = $this->User->Contact->getUserContactDetail($id);
		$this->set(compact('user'));
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
				$this->Site->successFlash('The user has been saved');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Site->errorFlash('The user could not be saved. Please, try again.');
			}
		} else {
			$options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
			$this->request->data = $this->User->find('first', $options);
		}
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
		if ($this->User->delete($id)) {
			$this->Site->successFlash('User deleted');
			$this->redirect(array('action' => 'index'));
		}
		$this->Site->errorFlash('User was not deleted');
		$this->redirect(array('action' => 'index'));
	}
	
/**
 * function to return filterActions for index view
 */
	public function index_filters() {
		return array(
			'fields' => array(
				'User.search' => array(
					'placeholder' => 'Username'
				)
			)
		);
	}

	public function quick_links() {
		return array(
			'sections' => array(
				__('Users') => array(
					__('List all Users') => array(
						'controller' => 'users',
						'action' => 'index'
					),
					__('Add new User') => array(
						'controller' => 'users',
						'action' => 'add'
					)
				)
			)
		);
	}
}
?>