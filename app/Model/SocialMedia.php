<?php
App::uses('AppModel', 'Model');
/**
 * SocialMedia Model
 *
 * @property Contact $Contact
 * @property Network $Network
 * @property Access $Access
 */
class SocialMedia extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'contact_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				'message' => 'Please enter numeric value'
			),
		),
		'provider' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can\'t stay empty'
            ),
		),
		'network_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can\'t stay empty'
			)
		),
		'access_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can\'t stay empty'
			)
		),
		'url' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'This field can\'t stay empty'
			)
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Contact' => array(
			'className' => 'Contact',
			'foreignKey' => 'contact_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Network' => array(
			'className' => 'Network',
			'foreignKey' => 'network_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Access' => array(
			'className' => 'Access',
			'foreignKey' => 'access_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
