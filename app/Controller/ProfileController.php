<?php
App::uses('AppController', 'Controller');
/**
 * Profile Page Controller
 *
 */
class ProfileController extends AppController {
 
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
	}
}