<div class="user_profile">
	<div class="profile_img">
		<div>
			<?php
				echo $this->Timthumb->image(ImagePath::ProfileImgPath.'profile_img.jpg', array('width' => 150, 'height' => 150));
				//echo $this->Html->image(ImagePath::ProfileImgPath.'profile_img.jpg', array('title' => 'Profile Picture','alt' => 'Pic'));
			?>
		</div>
		<div><a href="javascript:void();">Change Face</a></div>
	</div>
	<div class="profile_info">
		<h1>
			<?php echo __($user['User']['name']);?>
			<span style='text-transform: capitalize;'>
				<?php
					if(!empty($user['Contact']['gender'])) {
						echo __($user['Contact']['gender'] . ',');
					}
				?> Florida, USA / Mood Information Technology and Services</span></h1>
		<div class="user_info">
			<?php if(!empty($user['Contact']['dob'])): ?>
				<div class="label">Birthday</div>
				<div class="info">
					<?php echo __(DateTimeLib::setFormat($user['Contact']['dob'], TimeFormat::DayMonth)); ?>
				</div>
			<?php endif; ?>
			<div class="label">Education</div>
			<div class="info">
				<?php 
					if (is_array($user['Education'])){
						foreach($user['Education'] as $user_education) {
							echo __($user_education['university']. ', ');
						}
					}
				?>
			</div>
			<div class="label">About</div>
			<div class="info">I define myself as a self-starter, an innovator, venturesome, willing to take waves, take responsibility for the risks, persuasive and drive the change. I play to WIN...</div>
			<div class="clear"></div>
		</div>

	</div>
	<div class="edit_profile">
		<a href="javascript:void();">Edit Profile</a>
	</div>
	
	<div class="profile_pics">
		<ul>
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::ProfilePageImgPath.'1.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::ProfilePageImgPath.'2.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::ProfilePageImgPath.'3.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::ProfilePageImgPath.'4.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>	
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::ProfilePageImgPath.'5.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::ProfilePageImgPath.'6.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>
			<?php for($i=1; $i <11; $i++){ ?>
			<li>
				<?php 
					$image = $this->Html->image(ImagePath::UserPlaceholderImage.'uplaceholder.png', array('title' => 'User not available','alt' => 'Pic')); 
					echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
				?>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div class="clear"></div>
</div>
<!-- Content Area Start Here -->
	<div class="content_outer">
		<!-- Left Sidebar Area Start Here -->
		<div class="m_left_sidebar m_sidebar">
			<ul class="outer-block-sidebar outer-block-left">
				<!-- First Block -->
				<li>
					<ul class="inner-block-left inner-block-sidebar">
						<li class="m_heading">Favorites</li>
						<li>
							<a href="javascript:void(0);" class="m_text news_feeds">News Feed</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text messages">Messages</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text photos">Photos</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text browse">Browse</a>
						</li>
					</ul>
				</li>	
				<!-- Second Block -->
				<li>
					<ul class="inner-block-left inner-block-sidebar">
						<li class="m_heading">Apps</li>
						<li>
							<a href="javascript:void(0);" class="m_text app_center">App Center</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text links">Links</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text games_feed">Games Feed</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text music">Music</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Left Sidebar Area End Here -->
		
		<!-- Main content Section Start Here -->
		<div class="m_feeds_area  m_feeds_area_outer">
			<div class="m_feeds_area_inner">
				<?php echo $this->element('update_feed'); ?>
			</div>
		</div>
		<!-- Main content Section End Here -->
		
		<!-- Left Sidebar Area Start Here -->
		<div class="m_right_sidebar m_sidebar">
			<ul class="outer-block-sidebar outer-block-right">
				<!-- First Block -->
				<li>
					<ul class="inner-block-right inner-block-sidebar">
						<li class="m_heading">Friend Suggestions</li>
						<li>
							<div class="friend-suggestion">
								<div class="friend-img">
									<?php 
										$image = $this->Html->image(ImagePath::ProfilePageImgPath.'2.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
										echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
									?>
								</div>
								<div class="friend-info">
									<span class="friend-name"><?php echo $this->Html->link('Steve Cyrus',array('class'=>'f-name-link')); ?> </span>
									<span class="common-friend"><?php echo $this->Html->link('2 common friend',array('class'=>'common-friend-link')); ?> </span>
									<span class="send-request"><?php echo $this->Html->link('Send Request',array('class'=>'send-request-link')); ?> </span>
								</div>
							</div>
						</li>
						<li>
							<div class="friend-suggestion">
								<div class="friend-img">
									<?php 
										$image = $this->Html->image(ImagePath::ProfilePageImgPath.'4.jpg', array('title' => 'Profile Picture','alt' => 'Pic')); 
										echo $this->Html->link($image,array('controller'=>'profile','action'=>'profile_page'),array('escape'=>false));
									?>
								</div>
								<div class="friend-info">
									<span class="friend-name"><?php echo $this->Html->link('Ahilya bhatt',array('class'=>'f-name-link')); ?> </span>
									<span class="common-friend"><?php echo $this->Html->link('2 common friend',array('class'=>'common-friend-link')); ?> </span>
									<span class="send-request"><?php echo $this->Html->link('Send Request',array('class'=>'send-request-link')); ?> </span>
								</div>
							</div>
						</li>
					</ul>
				</li>	
				<!-- Second Block -->
				<li>
					<ul class="inner-block-right inner-block-sidebar">
						<li class="m_heading">Sponsored</li>
						<li>
							<a href="javascript:void(0);" class="m_text app_center">App Center</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text links">Links</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text games_feed">Games Feed</a>
						</li>
						<li>
							<a href="javascript:void(0);" class="m_text music">Music</a>
						</li>
					</ul>
				</li>
			</ul>
		</div>
		<!-- Left Sidebar Area End Here -->
	</div>
<!-- Content Area Ends Here -->