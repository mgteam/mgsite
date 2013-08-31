<script type="text/javascript">
	$(function(){
		$('#LoginForm input#UserEmail').focus();
	});
</script>
<style type="text/css">#confirmation-msg {width: 100%;}</style>
<div id="form-login" style="width:350px;">
	<?php echo $this->element('flash_message');?>
	<?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' =>'login'), 'id' => 'LoginForm')); ?>
	<table cellpadding="5px" cellspacing="5px">
		<tr>
			<th colspan="2">
				Login
			</th>
		</tr>
		<tr>
			<td>
				<?php echo __('Username(Email): ');?>
			</td>
			<td>
				<?php echo $this->Form->input('email', array('label' => false));?>
			</td>
		</tr>
		<tr>
			<td>
				<?php echo __('Password: ');?>
			</td>
			<td>
				<?php echo $this->Form->input('password',  array('label' => false));?>
			</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<?php 
					echo $this->Form->submit('Login', array('class'=>'button', 'div'=>false )); 
					echo $this->Html->link('Forgot password?', array('controller'=>'users', 'action'=>'forgot_password'), array('class'=>'forgot_password'));
				?>
			</td>
		</tr>
	</table>
	<?php echo $this->Form->end(); ?>
</div>