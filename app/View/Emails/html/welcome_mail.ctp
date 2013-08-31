<p>
Hello <?php echo $user['first_name'] . ' ' . $user['last_name'];?>,
</p>
<p>Welcome to <?php echo TITLE; ?>!</p>
<p>
	your accountis now activated. Please click on link for login.
</p>
<?php
	$url = $this->Html->url(array('controller' => 'users', 'action' => 'login'), true);
	echo $this->Html->link(
		$url,
		$url
	)
?>