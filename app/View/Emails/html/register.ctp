<p>
Hello <?php echo $user['first_name'] . ' ' . $user['last_name'];?>,
</p>
<p>Welcome to <?php echo TITLE; ?>!</p>
<p>
	Please click on below link for verifing your account.
</p>
<?php
	$url = $this->Html->url(array('controller' => 'users', 'action' => 'verify', 'email', $user['token']), true);
	echo $this->Html->link(
		$url,
		$url
	)
?>