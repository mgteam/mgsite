<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		echo $this->Html->meta('Madmin.icon');
		echo $this->Html->css(array('Madmin.style'));
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id='wrapper'>
		<div id='header'>
			<div id='header-content'>
				<?php echo $this->Html->image('images/logo.png', array('class'=>'logo', 'height'=>'45px'))?>
			</div><!-- header content -->
			<div id='header-strip' class='strip'>
				<div id="header-strip-content">
					<span class='current_date'><?php echo date('d F Y')?></span>
					<span class="header-logout">
						<?php echo $this->Html->link(__('Sign Up'),array('controller'=>'users','action'=>'register'));?>
					</span>
				</div>
			</div><!-- header-strip -->
		</div><!-- header end -->
		
		
		<div id='content-wrapper'>
			<div id='content'>
				<?php echo $content_for_layout;?>
			</div><!-- content ends here -->
		</div><!-- content wrapper ends -->
		
		<div id='footer' class='strip'>
			Web Design London //
			<?php
				echo $this->Html->link(
					'Mangra Design',
					'http://mangra.com',
					array(
						'target' => '_black'
					)
				);
			?>
			<!--<a href="http://jbiwebdesign.co.uk" target="_blank">JBi Web Design </a>-->
		</div><!-- -->
	</div><!-- wrapper end -->
	<!--================== JS here ==================-->
		<?php
			echo $this->Html->script( array(
				'Madmin.jquery-1.8.3.min',
				'Madmin.jquery.placeholder'
				)
			);
		?>
	<script>
		jQuery(document).ready(function(){
			jQuery("#sidenav").height( jQuery(".Mcontent").height() );
		});
	</script>
	<!--================== JS end ==================-->
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>