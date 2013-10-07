<?php
App::uses('MadminAppModel', 'Madmin.Model');
/**
 * User Model
 *
 * @property Group $Group
 * @property Contact $Contact
 * @property LoginHistory $LoginHistory
 * @property UserProfile $UserProfile
 * @property Contact $Contact
 */
class User extends MadminAppModel {

    public $name = 'User';
    
	public $virtualFields = array(
		'name' => 'CONCAT(User.first_name, " ", User.last_name)'
	);
    var $actsAs = array(
	'SoftDelete'=> array(
            'is_deleted' => 'deleted_on'
        )
    ); 

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
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
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
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
		'Contact' => array(
			'className' => 'Madmin.Contact',
			'foreignKey' => 'user_id',
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
		'LoginHistory' => array(
			'className' => 'LoginHistory',
			'foreignKey' => 'user_id',
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
		'UserProfile' => array(
			'className' => 'UserProfile',
			'foreignKey' => 'user_id',
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
		'Contact' => array(
			'className' => 'Madmin.Contact',
			'joinTable' => 'users_contacts',
			'foreignKey' => 'user_id',
			'associationForeignKey' => 'contact_id',
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
	
    public $filterArgs = array(
        'search' => array(
        	'type' => 'like', 
        	'field' => array(
        		'User.first_name',
				'User.last_name',
				'User.name',
                'User.email'
        	)
        ),
        'is_active' => array(
        	'type' => 'value', 
        	'field' => array(
        		'User.is_active'
        	)
        )
    );
    
    /**
 * Create a hash from string using given method.
 * Fallback on next available method.
 *
 * Override this method to use a different hashing method
 *
 * @param string $string String to hash
 * @param string $type Method to use (sha1/sha256/md5)
 * @param boolean $salt If true, automatically appends the application's salt
 *     value to $string (Security.salt)
 * @return string Hash
 */
	public function hash($string, $type = null, $salt = false) {
		return Security::hash($string, $type, $salt);
	}
}
