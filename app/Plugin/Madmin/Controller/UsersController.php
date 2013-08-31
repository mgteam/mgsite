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
	public $scaffold;

/**
 * Controller name
 *
 * @var string
 */
	public $name = 'Users';
	
	public $presetVars = true; // using the model configuration

/**
 *	Madmin dashboard.
 *
 *	@access public.
 **/
	public function dashboard(){
		
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
				$this->Session->setFlash(sprintf(__d('users', '%s, you have successfully logged in.'), $this->Auth->user('first_name')));
				$this->redirect($this->Auth->redirect());
			} else {
				$this->request->data['User']['password'] = null;
				$this->Session->setFlash(sprintf(__d('users', 'Invalid e-mail / password combination.  Please try again.')));
			}
		}
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
		$this->Session->setFlash(
			sprintf(__d('users', '%s you have successfully logged out.', $user['first_name'])));
		$this->redirect($this->Auth->logout());
	}
	
/**
 *	add
 *
 *	@access public.
 **/
	public function add(){
		debug($this->User->hash('testdata', null, true));
		if (!empty($this->data)) {
				$this->User->create();
				$this->request->data['User']['group_id'] = UserGroup::User;
				$this->request->data['User']['password'] = $this->User->hash($this->request->data['User']['password'], 'sha1', true);
				//debug($this->request->data['User']['password']);
				//exit();
				
				if ($this->User->save($this->data)) {
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The record could not be saved. Please, try again.', true));
				}
		}
	}
	
	public function index(){
		$this->User->recursive = 0;
		$this->Prg->commonProcess();
		$conditions = $this->User->parseCriteria($this->passedArgs);
        $this->paginate = array(
        	'conditions' => $conditions
		);
        $this->set('users', $this->paginate());
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
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
?>