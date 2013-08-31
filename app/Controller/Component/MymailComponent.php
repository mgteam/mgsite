<?php
App::uses('CakeEmail', 'Network/Email');
class MymailComponent extends Object {
    
    var $controller = null;
  	var $Email = null;
	var $settings = array();
    
  	/**
     *function for component initialization.
     *called before Controller::beforeFilter()
     **/
    function initialize(Controller $controller, $settings = array())
    {
        $this->controller = $controller;
		$this->settings = $settings;
		
		$this->Email = new CakeEmail();
    }
    
    /**
     *startup function for component.
     *called after Controller::beforeFilter()
     **/
    function startup(Controller $controller){
        
    }
    
    /**
     *called after Controller::beforeRender()
     **/
    function beforeRender(Controller $controller) {
        
    }
    
     /**
     *called after Controller::redirect()
     **/
    function beforeRedirect(Controller $controller) {
        
    }
    
    /**
     *called after Controller::render()
     **/
    function shutdown(Controller $controller) {
        
    }
	
	/*
	 * $options['to] : A string value where to send mail
	 * $options['from] : A string value from where to send mail
	 * $options['subject] : A string value defining the title of 
	 * $options['content] : A array used to set the data of the template
	 * $options['contentTemplate]: the template to be used for sending mail
	 */
    function sendEmail($options = array()){
		$this->Email->to($options['to']);
		$this->Email->from($options['from']);
		$this->Email->subject($options['subject']);
		if(isset($options['contentTemplate']))
		   $this->Email->template($options['contentTemplate']);
		else
		  $this->Email->template("default");
		  
		$this->Email->emailFormat("html");
		//$this->controller->set("data", $options['content']);
		if($this->Email->send($options['content'])){
		   return true;
		}else{
		  return false;
		}
	}
	
	/*
	 * $options['options] : Array of Default options for sending mail
	 * $options['template] : Array of Dynamic Template stored in Database
	 * $options['data] : Array of Template varibles with value
	 * $options['layout] : Email layout file.
	 */
    function sendMail($options = array()){

   		$content = NULL;
		$this->Email->template("default");
		$this->Email->emailFormat("html");
		$success = 1;
		if(!empty($options)){
			
			// check that admin need alter all mails.
			$admin_email_alert = Configure::read('Settings.ADMIN_EMAIL_ALERT');
			if($admin_email_alert == false && isset($options['admin'])){
				unset($options['admin']);
			}

			#traversed array and send mail.
			foreach($options as $option){
				// check that the template is select or not.
				if(isset($option['template']) && !empty($option['template'])){
					$template = $option['template'];
					# set subject.
					if(isset($template['EmailTemplate']['subject']) && !empty($template['EmailTemplate']['subject'])){
						$option['option']['subject'] = $template['EmailTemplate']['subject'];
					}
					//if(isset($template['EmailTemplate']['content']) && !empty($template['EmailTemplate']['content']))
					if($template['EmailTemplate']['use_default'] == true)
						$content = $template['EmailTemplate']['default_content'];
					else
						$content = $template['EmailTemplate']['content'];
					
					#check that the data is empty or not.
					if(isset($option['data']) && !empty($option['data'])){
						foreach($option['data'] as $var => $data){
							$content = str_replace("{{".$var."}}", $data, $content);
						}
					}
				}
				
				#set options.
				if(isset($option['option']) && !empty($option['option'])){
					#traversed email option.
					foreach($option['option'] as $key=>$value){
						$this->Email->$key($value);
					}
				}

				# for layout.
				if(isset($option['layout']) && !empty($option['layout'])){
					$this->Email->template($option['layout']);
				}

				if(!$this->Email->send($content)){
					$success = 0;
				}
			}
		}
		return $success;
	}
}
?>