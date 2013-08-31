<?php
/**
 * Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010 - 2011, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<?php 
	echo $this->element(
		'content_header',
		array(
			'contentTitle'=>'Manage Users'
		)
	);  
?>
<?php echo $this->element('Users/search')?>

<?php echo $this->element('csv_export');?>

<?php echo $this->element('paging_info');?>

<?php echo $this->element('Users/summary')?>