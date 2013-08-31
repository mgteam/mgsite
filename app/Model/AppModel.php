<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
    
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
    
/**
 *	get all the records from database upon some conditions.
 *
 *	@access public.
 *	@param get array of options and recursive value.
 *	set recursive value default -1.
 *	@return all records according to conditions and recursive value.
 **/
	public function getRecords($options = array(), $recursive = -1) {
		//$options['recursive'] = $recursive;
		return $this->find('all', $options);
	} 

/**
 * Generate token used by the user registration system
 *
 * @param int $length Token Length
 * @return string
 */


/******************** Please use users model genrate password function for generating rendom number. ************************/
	
	/*public function generateToken($length = 10) {
		$possible = '0123456789abcdefghijklmnopqrstuvwxyz';
		$token = "";
		$i = 0;

		while ($i < $length) {
			$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
			if (!stristr($token, $char)) {
				$token .= $char;
				$i++;
			}
		}
		return $token;
	}*/

}
