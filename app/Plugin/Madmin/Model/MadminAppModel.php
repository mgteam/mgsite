<?php

App::uses('AppModel', 'Model');

class MadminAppModel extends AppModel {
	 
	 public $recursive = -1;

	 // add behaviors.
	 var $actsAs = array(
		'Search.Searchable',
		'Containable'
	 );
	
/**
* get list of the records.
*
* @access public.
* @param get array of options and checkActive value.
* set checkActive value default 1.
* @return list according to conditions and status.
**/
	 public function getList($options = array(), $checkActive = 1) {
		  $listOrder = 'id desc';
		  $fields = array_keys($this->schema());
	 
		  # for fields
		  if (!isset($options['fields']) && empty( $options['fields'])) {
			   if ($this->displayField) {
					$options['fields'] = array($this->displayField);
			   }
			   else if (in_array('name', $fields)) {
					$options['fields'] = array('title');
			   }
			   else {
					$options['fields'] = array('id');
			   }
		  }
	  
		  #for order
		  if (in_array('name', $fields)) {
			   $listOrder = 'name asc';
		  }
		  if (!empty( $this->displayField)) {
			   $listOrder = $this->displayField.' asc';
		  }
		  if (in_array('display_order', $fields)) {
			   $listOrder = 'display_order asc';
		  }
		  if (!isset($options['order']) && empty($options['order'])) {
			   $options['order'] = $listOrder;
		  }
		  		  
		  #for active conditions
		  if ( $checkActive ) {
			   $options['conditions']['status'] = true;
		  }
		  return $this->find('list', $options);
	 }

	
/**
 *	get a single record.
 *
 *	@access public.
 *	@param get array of options like conditions, fields, order etc and recursive value.
 *	set recursive value default -1.
 *	@return all records according to conditions and recursive value.
 **/
	public function getRecord($options = array(), $recorsive = -1) {
		$options['recursive'] = $recorsive;
		return $this->find('first', $options);	
	}
	
}
