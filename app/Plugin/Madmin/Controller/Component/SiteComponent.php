<?php
App::uses('Component', 'Controller');

class SiteComponent extends Component {

	public $components = array(
	    'Session'
	);

	public function initialize(Controller $controller) {
        
    }

	public function startup(Controller $controller){
	}

/**
 *	set success flash message element.
 *	
 *	@access public.
 *	@param string message.
 *	@return flash message.
 */
	public function successFlash($message = null){
		return $this->Session->setFlash(__($message), 'success');
	}
	
/**
 *	set error flash message element.
 *	
 *	@access public.
 *	@param string message.
 *	@return flash message.
 */
	public function errorFlash($message = null){
		return $this->Session->setFlash(__($message), 'error');
	}
}