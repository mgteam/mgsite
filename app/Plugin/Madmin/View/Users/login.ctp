<?php 
	echo $this->Form->create(
		'User',
		array(
			'class' => 'form-signin',
			'inputDefaults' => array(
				'div' => false,
				'label' => false
			)
		)
	);
?>
<?php echo $this->Session->flash();?>
<h2 class="form-signin-heading"><?php echo __('Please sign in'); ?></h2>
<?php
	echo $this->TB->input(
		'User.email', array(
			'class' => 'span3',
			'label' => false, 
			'placeholder' => 'Email',
			'prepend' => '<i class="icon-user"></i>',
		)
	); 
	echo $this->TB->input(
		'User.password', 
		array(
			'class' => 'span3',
			'label' => false,
			'placeholder' => 'Password',
			'prepend' => '<i class="icon-lock"></i>',
		)
	);
	?>
	<div class="controls span2" style='margin-left: 0; width: 100%;'>
        <label class="checkbox" for='UserRememberMe'>
        	<?php 
				echo $this->Form->checkbox(
					'remember_me'
				);
				echo __('Remember Me')
			?>
        </label>
    </div>
    <!-- <div class="controls span2" style='margin-left: 0; width: 100%;'>
    	<label class="checkbox" style='padding-left: 0;'>
	    	<?php
	    		/*echo $this->Html->link(
	    			__('Forgot Password'),
	    			array(
	    				'controller' => 'users',
	    				'action' => 'forgot_password',
	    				'admin' => true
	    			)
	    		);*/
	    	?>
	    </label>
    </div> -->
<?php 
	echo $this->Form->submit(
		__('Submit'),
		array(
			'class' => 'btn btn-primary'
		)
	); 
	echo $this->Form->end();
?>
<?php $this->start('script'); ?>
<script type="text/javascript">
	$('#UserAdminLoginForm').validate({
		showErrors: function(errorMap, errorList) {
	        // Do nothing here
	    }
	});
</script>
<?php $this->end(); ?>