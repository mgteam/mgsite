<?php
App::uses('CakeEmail', 'Network/Email');
class SendMail {

/**
 *	send reset password email to trainer.
 *
 *	@access public.
 *	@param $options array - should contain the following keys
 *  'to': Mix - can be email or array of emails
 *  'from:' if not passed will be picked from config
 *  'viewVars': array of viewVars that will made available to template
 *	'subject': subject of the email
 *	'template': template of the email
 *	'layout': optional. layout of of the mail. Default is default
 *  @param $debug sendImmidiate - if false will return the configured object for further modification
 *	@return CakeEmail
 *  else returns CakeEmail object
 **/
	public function sendEmail($options, $debug = false,  $sendImmidiate = true){
//debug($options);exit;
		$Email = new CakeEmail('default');
		
		$Email->emailFormat('html')
			->from(array(EMIL_FROM => TITLE))
			->to($options['to']);
		
		$viewVars = (isset($options['viewVars'])) ? $options['viewVars'] : array();
		$Email->viewVars($viewVars);
		
		$layout = (isset($options['layout'])) ? $options['layout'] : 'default';
		$Email->template($options['template'], $layout);
		
		$Email->subject($options['subject']);		
		
		if($debug === true) {
			$Email->transport('Debug');
		}
		if($sendImmidiate === true) {
			return $Email->send();
		} else {
			return $Email;
		}
	}
}