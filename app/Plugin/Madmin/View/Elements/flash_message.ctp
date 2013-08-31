<script type="text/javascript">
$(function(){
	setTimeout(function() {
      $('#confirmation-msg div').slideUp(1500);
	}, 10000);
})
</script>
<div id="confirmation-msg">
	<?php
		echo $this->Session->flash('success');
		echo $this->Session->flash('error');
		echo $this->Session->flash('auth');
		echo $this->Session->flash();
	?>
</div>