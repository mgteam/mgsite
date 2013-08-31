<?php
/**
 * This file is loaded from plugins bootstrap file
 *
 * This file should create/define help texts messages shown on different screens
 *
 * PHP 5
 *
 * @package       Hub.Config
 */

$validation_messages = array(
    'LOGIN' => array(
        'Email_Required' => 'Please enter email.',
        'Email_Valid' => 'Please enter valid email.',
        'Password' => 'Please enter password.'
    ),
    'REGISTER' => array(
        'First_Name' => 'Please enter a first name',
        'Last_Name' => 'Please enter a last name',
        'Email_Required' => 'Please enter email.',
        'Email_Valid' => 'Please enter valid email.',
        'Password' => 'Please enter password.',
        'Confirm_password' => 'Please enter confirm password.'
    )
);

$notice_messages = array(
    /*'TRAINER' => array(
        'ADD' => array(
            'Success' => 'Trainer added successfully.',
            'Error' =>  'Please correct the highlighted fields.',
            'Not_Match_Email' => 'Email not matched.'
        ),
        'EDIT' => array(
            'Success' => 'Trainer updated successfully.',
            'Error' =>  'Please correct the highlighted fields.',
            'Not_Authorized' => 'You are not authorized to access this location'
        ),
		'ARCHIVE' => 'Trainer is successfully archived.',
		'UN-ARCHIVE' => 'Trainer is successfully unarchived.'
    ),*/
);

$confirm_messages = array(
    /*'TRAINER' => array(
        'Archive' => 'If you archive the trainer, the system will also archive all the Trainer’s classes. The trainer’s profile and classes will not be shown on the website.
		<br/>
		Are you sure you want to archive the selected trainer? ',
        'Deactivate' => 'If you de-activate the trainer, the system will also de-active all Classes of the Trainer. The trainer profile and classes will not be shown on the website.
		<br/>
		Are you sure you want to de-active the selected trainer? ',
        'Activate' => 'Are you sure you want to active the selected trainer?',
        'Un-archive' => 'Are you sure you want to unarchive the selected trainer?'
    ),*/
);

$alert_messages = array(
    /*'CHECH_BOX_NOT_SELECT' => 'Please select at least one checkbox.',
    'CONFIRM_ACTION' => 'Are you really want to perform action?',
    'ALERT_HEADER' => 'Alert',
	'DOWNLOADING_IN_PROGRESS' => 'Please take patiance your downloading is in progress.',
	'DOWNLOADING_FAILED' => 'Your requested files are not exists.'*/
);

$email_subjects = array(
	'REGISTER' => 'Account Activation',
	'WELCOME_MAIL' => 'Welcome To Mengra'
);

$config['error_message'] = $validation_messages;
$config['NOTICE_MESSAGE'] = $notice_messages;
$config['CONFIRM_MESSAGE'] = $confirm_messages;
$config['ALERT_MESSAGE'] = $alert_messages;
$config['EMAIL_SUBJECTS'] = $email_subjects;
?>