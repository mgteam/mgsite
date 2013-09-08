<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	
	<?php
		echo $this->Html->css(
			array(
				'profile_css/profile_page.css',
				'profile_css/reset.css',
				'profile_css/960.css',
				'common.css',
				'contact_card.css'
			)
		);
		//echo $scripts_for_layout;
	?>
</head>
<body>
	<div id="wrapper">
		<!-- Header Start -->
			<div id="wrap_header">
				<div class="header_top">
					<div class="container_16">
						<div class="logo">
							<?php
								$image = $this->Timthumb->image('/img/mengra-logo.png', array('width' => 185, 'height' => 39));
								//$image = $this->Html->image('mengra-logo.png', array('title' => 'MENGRA','alt' => 'MENGRA'));
								echo $this->Html->link($image,array('controller'=>'users','action'=>'login'),array('escape'=>false));
							?>
						</div>
						<div class="wrap_topnav">
							<ul class="topnav_links">
								<li>
									<?php echo __('Welcome '); ?>
									<span>
										<?php
											$conf_user =Configure::read('User.name');
											echo __($conf_user . '!');
										?>
									</span>
								</li>
								<li class="divider">&nbsp;</li>
								<li>
									<a href="javascript:void();">
										<?php echo $this->Html->image('profile_images/icon_mesg.png', array('title' => 'Messages','alt' => 'mesg')); ?>

									</a>
								</li>
								<li class="divider">&nbsp;</li>
								<li class="dropdown">
									<a href="javascript:void();">
										<div class="profile_setting"></div>
										<div class="down_arrow"></div>

									</a>
									<?php //echo $this->Html->image('profile_images/icon_settings.png', array('alt' => 'setting')); ?>
									<?php //echo $this->Html->image('profile_images/arrow_downs.png', array('alt' => 'drop', 'class' => 'icon')); ?>
									<div class="dropdown_menu">
										<div class="dropdown_arrow">
										</div>
										<ul class="abc">
											<li><a class="f" href="javascript:void();">Direct Messages</a></li>
											<li><a href="javascript:void();">Edit Profile</a></li>
											<li><a href="javascript:void();">Help</a></li>
											<li><a href="javascript:void();">Settings</a></li>
											<li>
												<?php
													echo $this->Html->link(
														__('Sign Out'),
														array(
															'controller' => 'users',
															'action' => 'logout'
														)
													);
												?>
												<!--<a href="javascript:void();">Sign Out</a>-->
											</li>
										</ul>
									</div>










								</li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>

				</div>

				<div class="header_bottom">
					<div class="container_16">
						<div class="search">
							<input type="text" placeholder="Search here..." class="textbox1" id="textfield" name="textfield">
							<a class="search_btton" href="javascript:void(0);">SEARCH</a>
						</div>
						<div class="wrap_nav">
							<ul class="nav_links">
								<li><a href="index.html">Home</a></li>
								<li><a href="javascript:void();">Feeds</a></li>
								<li><a href="javascript:void();">Reports</a></li>
								<li><a href="javascript:void();">Community</a></li>
								<li class="active"><a href="profile.html">My Profile</a></li>
							</ul>
						</div>
						<div class="clear"></div>
					</div>

				</div>
			</div>

			<!-- Header Ends -->
		<div id="wrap">

			<div id="wrap_middle">
				<div class="container_16">
					<?php echo $content_for_layout;?>
				</div><!-- content ends here -->
			</div><!-- content wrapper ends -->

		</div><!-- wrapper end -->	
		<?php echo $this->element('footer'); ?>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>