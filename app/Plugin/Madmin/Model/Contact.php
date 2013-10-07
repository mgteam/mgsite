<?php
App::uses('MadminAppModel', 'Madmin.Model');
/**
 * Contact Model
 *
 * @property User $User
 * @property ConnectedNetwork $ConnectedNetwork
 * @property ContactPicture $ContactPicture
 * @property Education $Education
 * @property Language $Language
 * @property SocialMedia $SocialMedia
 * @property Work $Work
 * @property User $User
 */
class Contact extends MadminAppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'Madmin.User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'ConnectedNetwork' => array(
			'className' => 'Madmin.ConnectedNetwork',
			'foreignKey' => 'contact_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ContactPicture' => array(
			'className' => 'Mamdin.ContactPicture',
			'foreignKey' => 'contact_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Education' => array(
			'className' => 'Madmin.Education',
			'foreignKey' => 'contact_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Language' => array(
			'className' => 'Madmin.Language',
			'foreignKey' => 'contact_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'SocialMedia' => array(
			'className' => 'Madmin.SocialMedia',
			'foreignKey' => 'contact_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Work' => array(
			'className' => 'Madmin.Work',
			'foreignKey' => 'contact_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);


/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
	public $hasAndBelongsToMany = array(
		'User' => array(
			'className' => 'Madmin.User',
			'joinTable' => 'users_contacts',
			'foreignKey' => 'contact_id',
			'associationForeignKey' => 'user_id',
			'unique' => 'keepExisting',
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);
    
    public function getUserContactDetail($user_id = null) {
        $userOptions['conditions']['User.id'] = $user_id;
        $userOptions['fields'] = array('id', 'first_name', 'last_name', 'name','email', 'email_verified', 'last_login');
        $user = $this->User->getRecord($userOptions);
        
        $options['conditions']['Contact.user_id'] = $user_id;
        $options['fields'] = array('name', 'username', 'gender', 'dob', 'phone', 'address', 'about', 'mobile');
        $options['contain'] = array(
            'Education' => array(
                'fields' => array('city', 'university', 'start_date', 'end_date', 'is_studying', 'class')
            )
        );
        
        $contact = $this->getRecord($options);
        $contact['User'] = $user['User'];
        
        return $contact;
    }

}
