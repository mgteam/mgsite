<table>
	<tr>
		<td>Hello <?php echo $user['first_name'] . ' ' . $user['last_name'];?>,</td>
	</tr>
	<tr>
		<td>
			<?php
				echo __('Welcome to '. TITLE .'!');
			?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo __('Your account is successfully created.'); ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php
				echo __('Your account details are:');
				echo '<br />';
				echo __('Email - '. $user['email']);
				echo '<br />';
				echo __('Passwors - '. $user['password']);
			?>
		</td>
	</tr>
</table>