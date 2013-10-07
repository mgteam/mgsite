<fieldset>
	<dl>
		<dt class='span3 clear_margin_left'><?php echo __('User ID:'); ?></dt>
		<dd class='span9'>
			<?php 
				echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Name:'); ?></dt>
		<dd class='span9'>
			<?php 
				echo $this->Site->isEmpty($user['User']['name']); ?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('First Name:'); ?></dt>
		<dd class='span9'>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Last Name:'); ?></dt>
		<dd class='span9'>
			<?php 
				echo $this->Site->isEmpty($user['User']['last_name']);
			?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Username:'); ?></dt>
		<dd class='span9'>
			<?php
				$username = null;
				if(isset($user['Contact']['username']) && !empty($user['Contact']['username'])) {
					$username = $user['Contact']['username'];
				}
				echo $this->Site->isEmpty($username);
			?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Email:'); ?></dt>
		<dd class='span9'>
			<?php 
				echo $this->Site->isEmpty($user['User']['email']);
			?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Gender:'); ?></dt>
		<dd class='span9'>
			<?php
				$gender = null;
				if(isset($user['Contact']['gender']) && !empty($user['Contact']['gender'])) {
					$gender = $user['Contact']['gender'];
				}
				echo $this->Site->isEmpty($gender);
			?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Date of Birth:'); ?></dt>
		<dd class='span9'>
			<?php
				$dob = null;
				if(isset($user['Contact']['dob']) && !empty($user['Contact']['dob'])) {
					$dob = $user['Contact']['dob'];
				}
				$dob = DateTimeLib::setFormat($dob, TimeFormat::CustomDate);
				echo $this->Site->isEmpty($dob);
			?>
			&nbsp;
		</dd>
		<dt class='span3 clear_margin_left'><?php echo __('Email Verified:'); ?></dt>
		<dd class='span9'>
			<?php
				$email_verified_icon = 'cross.png';
				if ($user['User']['email_verified'] == true) {
					$email_verified_icon = 'check.png';
				}
				echo $this->Html->image('/img/icons/'.$email_verified_icon);
			?>
			&nbsp;
		</dd>
	</dl>
</fieldset>