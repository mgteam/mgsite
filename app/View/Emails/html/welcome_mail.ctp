<p>
<?php echo __('Hello ' . $user['first_name'] . ' ' . $user['last_name']);?>,
</p>
<p><?php echo __('Welcome to ' . TITLE); ?>!</p>
<p>
	<?php echo __('your account is now activated. Please click on link for login.'); ?>
</p>
<?php
	$url = $this->Html->url(array('controller' => 'users', 'action' => 'login'), true);
	echo $this->Html->link(
		$url,
		$url
	)
?>