<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title><?php echo $title_for_layout; ?></title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- css section -->
	<style>
		body { padding-top: 60px; }
		.sidebar-nav { padding: 9px 0; }
	</style>
	<?php 
		echo $this->Html->css(
			array(
				'Madmin.bootstrap',
				'Madmin.bootstrap-responsive',
				'Madmin.jquery-ui-1.10.3.custom.min',
				'Madmin.site'
			)
		); 
	?>
	<style>
		
	</style>
	<!-- end of css section -->
</head>
<body>
	<?php echo $this->element('navbar'); ?>

	<div class="container-fluid">
	    <div class="row-fluid">
	        <?php echo $this->TB->page_header($title_for_layout); ?>
	    </div>
	    <div class="row-fluid">
	        <div class="span3">
	            <?php
	            	if ( !empty( $sidebarElements ) ) {
	            		/*
	                    if ( empty( $sideSection ) ) {
	                        $sideSection = 'index';
	                    }
	                    */
						if (isset($sideSection) && !empty( $sidebarElements[$sideSection] ) ) {
	                        foreach ($sidebarElements[$sideSection] as $element => $viewVars) {
	                            echo $this->element( $element, $viewVars);
	                        }
	                    }
						if ( !empty( $sidebarElements['default'] ) ) {
	                        foreach ($sidebarElements['default'] as $element => $viewVars) {
	                            echo $this->element($element, $viewVars);
	                        }
	                    }
	                }
	            ?>
	        </div>
	        <div class="span9">
	            <?php
					echo $this->Session->flash();
					echo $this->fetch('content');
				?>
	        </div>
	    </div>
	</div>
	<!-- js section -->
	<?php
		echo $this->Html->script(
			array(
				'Madmin.jquery',
				'Madmin.bootstrap',
				'Madmin.jquery-ui-1.10.3.custom.min',
				'Madmin.jquery.validate',
				'Madmin.custom',
			)
		);
		echo $this->fetch('script');
	?>
	<!-- end of js section -->
</body>
</html>