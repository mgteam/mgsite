<div class="users form">
	<?php 
		echo $this->Form->create(
			'User',
			array(
				'id' => 'UserAdminForm',
				'class' => 'form-horizontal'
			)
		); 
	?>
		<fieldset>
			<legend><?php echo __('Edit User'); ?></legend>
			<?php
				echo $this->Form->input('id');
				echo $this->element('Users/form');
			?>
		</fieldset>
		<div class="form-actions">
			<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-primary', 'div' => false)); ?>
			<?php
				echo $this->Html->link(
					__('Cancel'),
					array(
						'action' => 'index'
					),
					array(
						'class' => 'btn'
					)
				);
			?>
		</div>
	<?php echo $this->Form->end(); ?>
</div>