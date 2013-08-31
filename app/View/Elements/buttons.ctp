<?php
	echo $this->Form->submit(__('Submit'), array('div'=>false, 'class'=>'button button-primary', 'after'=>'&nbsp;'));
	echo $this->Form->button(__('Cancel'), array('type' => 'button', 'div'=>false, 'class'=>'button button-secondary', 'onclick' => 'goToIndex();'));
?>