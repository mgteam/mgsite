<?php
    $config = array();
		
	# set array of status values.
	Configure::write(
		'status',
		array(
			1 => 'Active',
			0 => 'Inactive'
		)
	);
	
	$config['Email_Templates'] = array(
		'REGITER' => 'register',
		'REGITER_SOCIAL_USER' => 'social_user_password_welcome',
		'WELCOME' => 'welcome_mail'
	);
?>