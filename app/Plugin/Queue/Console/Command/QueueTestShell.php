<?php
App::uses('AppShell', 'Console/Command');
if (!defined('FORMAT_DB_DATE')) {
	define('FORMAT_DB_DATETIME', 'Y-m-d H:i:s');
}

/**
 * Testing email etc
 * 
 * @author Mark Scherer
 */
class QueueTestShell extends AppShell {
	
	public $uses = array(
		'Queue.QueuedTask'
	);

	public function email() {
		$data = array(
			'settings' => array(
				'subject' => 'Some test - '.date(FORMAT_DB_DATETIME),
				'to' => Configure::read('Config.admin_email'),
			),
			'vars' => array(
				'content' => 'I am a test',
			)
		);
		
		if ($this->QueuedTask->createJob('Email', $data)) {
			$this->out('OK, test email created');
		} else {
			$this->err('Could not create test email');
		}
	}
	
}
