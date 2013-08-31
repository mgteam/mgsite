<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		//echo $this->Html->meta('icon', $this->Html->url('/favicon.png'));
		echo $this->Html->meta('favicon.ico','/mangra/favicon.ico',array('type' => 'icon'));

		//echo $this->Html->meta('icon');
		//echo $this->Html->css(array('style'));
		echo $this->Html->css(array('fonts','common','landing_page'));
		echo $scripts_for_layout;
	?>
</head>
<body>
	<div id='wrapper'>
			
		<div id='content-wrapper'>
			<div id='content'>
				<?php echo $content_for_layout;?>
			</div><!-- content ends here -->
		</div><!-- content wrapper ends -->

</div><!-- wrapper end -->
<?php //echo $this->element('sql_dump'); 
	echo $this->Html->script(
		array(
			'jquery-1.8.3.min',
			'jquery.validate',
			'form.validate',
			'application'
		)
	);
	$global_msg = Configure::read('error_message');
?>
<script type="text/javascript">
		app = {
			BASE_PATH: '<?php echo $base_url; ?>',
		}
		app.error_message = $.parseJSON('<?php echo json_encode($global_msg); ?>');
	</script>
</body>
</html>