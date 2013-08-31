<?php
App::uses('AppController', 'Controller');
/**
 * Contacts Controller
 *
 */
class ContactsController extends AppController {

	public function beforeFilter(){
        parent::beforeFilter();
        $this->Auth->allow('index');
		$this->layout = 'home';
    }
	
	/**
 	 * Show all user contacts
	 * Surinder Sammy [11 August, 2013]
	 * @return contacts
	 */
	public function index() {
		
	}
}