<script type="text/javascript">
	$(document).ready(function() {
		$(".cancel").click(function(e) {
			window.location.href = "<?php echo $this->base; ?>/admin/<?php echo $this->params['controller']?>/";
		});
		
	});
</script>
<div class="main-form-wrapper">						
	<div class="form-btn-wrapper">
		<?php
			echo $this->Form->submit(
				'Save',
				array(
					'div' => false,
					'label' => false,
					'class' => 'admin_button save'
				)
			);
			echo " ".$this->Form->button(
				'Cancel',
				array(
					'div' => false,
					'label' => false,
					'type' => 'button',
					'class' => 'admin_button cancel'
				)
			);
		?>
	</div>
</div>