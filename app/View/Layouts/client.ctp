<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
<?php
	echo $this->fetch('IE10Code');
	echo $this->Html->meta('icon');
	echo $this->Html->css(array('style', 'jquery-ui-1.9.2.custom.min', 'admin_custom', 'colorbox/colorbox'));
	echo $this->Html->script(array('jquery-1.8.3', 'jquery-ui-1.9.2.custom.min', 'colorbox/jquery.colorbox-min', 'jquery.validate', 'admin_custom'), true);
	echo $scripts_for_layout;
?>
</head>
<body>
	<div id='wrapper'>
		<div id='header'>
			<div id='header-content'>
				<?php
					echo $this->Html->link(
						$this->Html->image(
							'images/logo.png',
							array(
								'class'=>'logo',
								'style'=>'height:45px;'
							)
						),
						array(
							'controller' => 'orders',
							'action' => 'index'
						),
						array(
							'escape' => false
						)
					);
				?>
			</div><!-- header content -->
			<div id='header-strip' class='strip'>
				<div id="header-strip-content">
					<span class='current_date'><?php echo date('d F Y')?></span>
					<span class="header-logout">
						<?php echo $this->Html->link(__('Logout'),array('controller'=>'users','action'=>'logout'));?>
					</span>
				</div>
			</div><!-- header-strip -->
		</div><!-- header end -->
		
		
		<div id='content-wrapper'>
			<div id='content'>
				<?php echo $this->element('menu_bar');?>
				<div id='workspace'>
					<?php
						echo $this->element('flash_message');
						//echo $this->element('Admin/flash_message');
						echo $content_for_layout;
					?>
				</div><!-- workspace ends -->
				
			</div><!-- content ends here -->
		</div><!-- content wrapper ends -->
		
		<div id='footer' class='strip'>
			<a href="http://www.mangra.com" target="_blank">Mangra Web Development</a>
		</div>
		<?php echo $this->element('sql_dump'); ?>
	</div><!-- wrapper end -->
</body>
</html>