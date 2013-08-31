<?php
App::uses('AppHelper', 'View/Helper');
class CdnHelper extends AppHelper {
	var $helpers = array('Html');
	
/**
 *	create image tag.
 *
 *	@access public.
 *	@param string image path, array options of html attributes.
 *	@return image tag.
 **/
	public function image($image_path, $options = array()){
		return $this->Html->image($image_path, $options);
	}

/**
 *	create css tag.
 *
 *	@access public.
 *	@param string css file path, array options of html attributes.
 *	@return css tag.
 **/
	public function css($css_path, $options = array()){
		return $this->Html->css($css_path, $options);
	}
	
/**
 *	create script tag.
 *
 *	@access public.
 *	@param string script file path, array options of html attributes.
 *	@return script tag.
 **/
	public function script($script_path, $options = array()){
		return $this->Html->script($script_path, $options);
	}
}
?>