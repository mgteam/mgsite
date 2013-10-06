<div class="users form">
	<fieldset>
		<legend><?php echo __('View User'); ?></legend>
		<?php echo $this->element('Users/view'); ?>
	</fieldset>
	<div class="form-actions">
		<?php
			echo $this->Html->link(
				__('Back'),
				array(
					'action' => 'index'
				),
				array(
					'class' => 'btn btn-primary'
				)
			);
		?>
	</div>
</div>