<?php
App::uses('AppHelper', 'View/Helper');

class AdminHelper extends AppHelper {
	public $helpers = array('Form', 'Html');
	
/**
 * grid_action_cell method
 *
 * creates common action links with proper styling
 *
 * @param array $options options containing links to display and their custom styling
 * @return string
 */
    public function grid_action_cell($options = array()) {
        $defaults = array(
            'id' => null,
            'edit' => __('Edit'),
            'delete' => __('Delete'),
            'view' => __('View'),
            'editLink' => array(
                'url' => array('action' => 'edit', '--ID--'), 
                'options' => array(), 
                'confirmMessage' => false
            ),
            'viewLink' => array(
                'url' => array('action' => 'view', '--ID--'), 
                'options' => array(), 
                'confirmMessage' => false
            ),
            'deleteLink' => array(
                'url' => array('action' => 'delete', '--ID--'), 
                'options' => array(), 
                'confirmMessage' => __('Are you sure want to delete this record?')
            )
        );

        $options = array_merge($defaults, $options);

        if ( empty($options['id']) ) {
            throw new Exception("Please pass an id");
        }

        $output = '';

        if ( $options['view'] ) {
            $output .= $this->Html->link(
                $options['view'], 
                $options['viewLink']['url'], 
                $options['viewLink']['options'], 
                $options['viewLink']['confirmMessage']
            ) . " ";
        }

        if ( $options['edit'] ) {
            $output .= $this->Html->link(
                $options['edit'], 
                $options['editLink']['url'], 
                $options['editLink']['options'], 
                $options['editLink']['confirmMessage']
            ) . " ";
        }

        if ( $options['delete'] ) {
            $output .= $this->Form->postLink(
                $options['delete'], 
                $options['deleteLink']['url'], 
                $options['deleteLink']['options'], 
                $options['deleteLink']['confirmMessage']
            ) . " ";
        }

        return strtr($output, array('--ID--' => $options['id']));
    }
}