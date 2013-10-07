<?php
App::uses('AppHelper', 'View/Helper');
class SiteHelper extends AppHelper {
	var $helpers = array('Html');
	
/**
 *	check is empty and set empty label.
 *
 *	@access public.
 *	@param mixed value.
 *	@return bool or empty label.
 **/
	public function isEmpty($data){
		if (empty($data)) {
			return '--------';
		}
		return h($data);
	}

}