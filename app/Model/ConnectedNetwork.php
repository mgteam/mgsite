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
    
    public function isNetworkIdExists($network_id = null) {
        if (!$network_id) {
            return false;
        }
        return $this->field('id', array('ConnectedNetwork.network_id' => $network_id));
    }
    
/**
 *  add new social network detail.
 *
 *  @author Lucky Saini.
 *  @access public.
 *  @param array of connected network detail and integer contact id.
 *  @return boolean.
 **/
    public function addNewNetwork($post = array(), $contact_id = null) {
        $data['ConnectedNetwork']['access_token'] = $post['ConnectedNetwork']['0']['access_token'];
        $data['ConnectedNetwork']['url'] = $post['ConnectedNetwork']['0']['url'];
        $data['ConnectedNetwork']['network_id'] = $post['ConnectedNetwork']['0']['network_id'];
        $data['ConnectedNetwork']['provider'] = $post['ConnectedNetwork']['0']['provider'];
        $data['ConnectedNetwork']['contact_id'] = $contact_id;
        $this->set($data);
        if ($this->save()) {
            return true;
        }
        return false;
    }
}
