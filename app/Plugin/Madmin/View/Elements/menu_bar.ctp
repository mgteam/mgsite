<script type="text/javascript">
$(function(){
	$("#sidebar ul li").each(function(){
	  var $active = "<?php echo isset($active_menu) ? $active_menu : null; ?>";
	  var $activeSubMenu = "<?php echo isset($active_submenu) ? $active_submenu : null; ?>";
	  if($(this).children().html() == $active ){
	    $(this).addClass('active_menu');
	  }
	  if($(this).children().html() == $activeSubMenu ){
	    $(this).addClass('active_submenu');
	  }
	})
});
</script>
<div id='sidebar'>
	<ul class='menu'>
		<!-- for Users Management -->
		<li class='m-header'>
			<?php echo $this->Html->link(__('Manage Users'),array('controller'=>'users','action'=>'index'))?>
		</li>
		<li class='m-option'>
			<?php echo $this->Html->link(__('Add User'), array('controller'=>'users', 'action'=>'add'))?>
		</li>
		<!-- for admin detail -->
		<li class="user-info" style="padding:10px 5px;">
			<ul>
				<li><?php echo __('Username: ').Configure::read('User.name'); ?></li>
				<li><?php echo __('Email: ').Configure::read('User.email'); ?></li>
				<li><?php echo __('Last Login Date: ').date(TimeFormat::CustomDate, strtotime(Configure::read('User.last_login'))); ?></li>
				<li><?php echo __('Last Login Time: ').date(TimeFormat::MeridiemTime, strtotime(Configure::read('User.last_login')));?></li>
			</ul>
		</li>
	</ul>
</div><!-- sidebar ends -->