<?php
    $config = array();
		
	# set array of status values.
	Configure::write(
		'status',
		array(
			1 => 'Active',
			0 => 'Inactive'
		)
	);
?>