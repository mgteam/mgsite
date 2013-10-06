<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo __('User Login'); ?></title>

	<!-- css section -->
	<?php
		echo $this->Html->css(
			array(
				'Madmin.bootstrap',
				'Madmin.bootstrap-responsive'
			)
		);
	?>
	<style>
		body {
	        padding-top: 40px;
	        padding-bottom: 40px;
	        background-color: #f5f5f5;
      	}

  		.form-signin {
	        max-width: 300px;
	        padding: 19px 29px 29px;
	        margin: 0 auto 20px;
	        background-color: #fff;
	        border: 1px solid #e5e5e5;
	        -webkit-border-radius: 5px;
	           -moz-border-radius: 5px;
	                border-radius: 5px;
	        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.05);
	                box-shadow: 0 1px 2px rgba(0,0,0,.05);
      	}
      	.form-signin .form-signin-heading,
      	.form-signin .checkbox {
        	margin-bottom: 10px;
      	}
	</style>
	<!-- end of css section -->
</head>
<body>
	<div class="container">
		<?php
			echo $content_for_layout;
		?>
	</div>
	<!-- js section -->
	<?php
		echo $this->Html->script(
			array(
				'Madmin.jquery',
				'Madmin.bootstrap',
				'Madmin.jquery-ui-1.10.3.custom.min',
				'Madmin.jquery.validate',
			)
		);
		echo $this->fetch('script');
	?>
	<!-- end of js section -->
</body>
</html>