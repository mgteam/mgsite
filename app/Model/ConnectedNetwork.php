<?php
App::uses('AppModel', 'Model');
/**
 * ConnectedNetwork Model
 *
 * @property Contact $Contact
 * @property Network $Network
 */
class ConnectedNetwork extends AppModel {

/**
 * Displayfield
 *
 * @var string $displayField
 */
	public $displayField = 'provider';

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
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array();

/**
 * Constructor
 *
 * @param string $id ID
 * @param string $table Table
 * @param string $ds Datasource
 */
	/*public function __construct() {
		$this->_setupValidation();
	}*/  
}
