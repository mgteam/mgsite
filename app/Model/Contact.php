<?php
App::uses('AppModel', 'Model');
/**
 * Contact Model
 *
 * @property User $User
 * @property SocialMedia $SocialMedia
 * @property User $User
 */
class Contact extends AppModel {

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'name';
    
/**
 * Virtual Full Name
 *
 * @var string
 */
    public $virtualFields = array(
        'name' => 'CONCAT(User.first_name, " ", User.last_name)'
    );

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
        'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please use numeric value.'
			)
		),
        'username' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can\'t stay empty'
			),
		),
        'gender' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can\'t stay empty.'
			),
		),
		'email' => array(
			'isValid' => array(
				'rule' => 'email',
				'required' => true,
				'message' => 'Valid email required.'),
			'isUnique' => array(
				'rule' => array('isUnique', 'email'),
				'message' => 'Email is already in use.')
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className' => 'User',
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
			'className' => 'ConnectedNetwork',
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
			'className' => 'SocialMedia',
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
			'className' => 'User',
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
}
