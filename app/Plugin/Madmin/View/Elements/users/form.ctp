<div class="row-fluid">
	<div class="span6">
		<?php
			echo $this->TB->input(
				'User.group_id', 
				array(
					'class' => 'span12',
					'empty' => SELECT_EMPTY,
					'label' => 'Group *',
					'required' => true,
				)
			); 
		?>
	</div>
	<div class="span6">
		<?php
			echo $this->TB->input(
				'User.first_name', 
				array(
					'class' => 'span12',
					'label' => 'First Name *',
					'required' => true,
				)
			); 
		?>
	</div>
</div>
<div class="row-fluid">
	<div class="span6">
		<?php
			echo $this->TB->input(
				'User.last_name',
				array(
					'class' => 'span12',
					'label' => 'Last Name *',
					'required' => true,
				)
			);
		?>
	</div>
	<div class="span6">
		<?php
			echo $this->TB->input(
				'User.email',
				array(
					'class' => 'span12 email',
					'type' => 'text',
					'label' => 'Email *',
					'required' => true,
				)
			);
		?>
	</div>
</div>
<?php $this->start('script'); ?>
<script type="text/javascript">
	$('#UserAdminForm').validate({
		messages: {
			'data[User][group_id]': 'Please select user group.',
			'data[User][first_name]': 'Please enter first_name.',
			'data[User][last_name]': 'Please enter last name.',
			'data[User][email]': {
                required: 'Please enter email address.',
                email: 'Please enter valid email address.'
            }
		}
	});
</script>
<?php $this->end(); ?>