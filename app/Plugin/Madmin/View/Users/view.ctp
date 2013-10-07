<div class="form-horizontal">
	<div class="users view span12">
		<div id='tabs'>
			<ul>
				<li>
					<?php
						echo $this->Html->link(
							__('User Info.'),
							'#tabs-1'
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							'Educations',
							'#tabs-2'
						);
					?>
				</li>
				<li>
					<?php
						echo $this->Html->link(
							'User Social Access Tokens',
							'#tabs-3'
						);
					?>
				</li>
			</ul>
			<div id='tabs-1'>
				<?php echo $this->element('Users/view_user_info'); ?>
			</div>
			<div id='tabs-2'>
				<?php echo $this->element('Users/view_user_education'); ?>
			</div>
			<div id='tabs-3'>
				<?php echo $this->element('Users/view_user_info'); ?>
			</div>
		</div>
	</div>
	<div class="form-actions clear">
		<?php
			echo $this->Html->link(
				__('Back'),
				array(
					'action' => 'index'
				),
				array(
					'class' => 'btn btn-primary'
				)
			);
		?>
	</div>
</div>
<?php $this->start('script'); ?>
<script type='text/javascript'>
    var tabs = $( "#tabs" ).tabs();
	tabs.find( ".ui-tabs-nav" ).sortable({
		axis: "x",
		stop: function() {
			tabs.tabs( "refresh" );
		}
	});
</script>
<?php $this->end(); ?>