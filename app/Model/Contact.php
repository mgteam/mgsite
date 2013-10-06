<?php
App::uses('AppModel', 'Model');
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
        'name' => 'CONCAT(Contact.first_name, " ", Contact.last_name)'
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
		'ContactPicture' => array(
			'className' => 'ContactPicture',
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
			'className' => 'Education',
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
			'className' => 'Language',
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
		),
		'Work' => array(
			'className' => 'Work',
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
    
/**
 *  check is social user exists.
 *
 *  @author Lucky Saini.
 *  @param social id and email id.
 *  @return boolean.
 **/
    public function isSocialUserExists($oid = null, $email = null) {
        if(!empty($email)) {
            $exists = $this->field('id', array('Contact.email' => $email));
            
            if (!$exists) {
                $exists = $this->isSocialIdExists($oid);
            }
        } else {
            $exists = $this->isSocialIdExists($oid);
        }
        return $exists;
    }
    
/**
 *  check is social id of user exists.
 *
 *  @author Lucky Saini.
 *  @param social id.
 *  @return boolean.
 **/
    public function isSocialIdExists($oid = null) {
        $exists = false;
        if ($oid) {
            $exists = $this->field('id', array('Contact.oid' => $oid));
        }
        return $exists;
    }
    
/**
 *  set models for getting data from contact and related tables.
 *
 *  @author Lucky Saini.
 *  @return array of contain models and their fields.
 **/
    public function containForProfile() {
        return array(
			'Education' => array(
				'fields' => array('id', 'city', 'university', 'start_date', 'end_date', 'is_studying', 'class')
			),
			'Work' => array(
				'fields' => array('id', 'employer', 'position', 'city', 'description', 'start_date', 'end_date', 'is_currently_working')
			),
			'Language' => array(
				'fields' => array('id', 'title')
			)
		);
    }
    
/**
 *  get contact id.
 *
 *  @author Lucky Saini.
 *  @access public.
 *  @param string email id.
 *  @return integer contact id.
 **/
    public function getContactId($email = null) {
        if(!$email) {
            return false;
        }
        return $this->field('id', array('Contact.email' => $email));
    }
}
