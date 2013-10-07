<fieldset>
	<?php if (isset($user['Education']) && !empty($user['Education'])): ?>
		<dl>
			<?php foreach($user['Education'] as $key => $value): ?>
				<dt class='span3 clear_margin_left'><?php echo __('University:'); ?></dt>
				<dd class='span9'>
					<?php 
						echo $this->Site->isEmpty($value['university']); ?>
					&nbsp;
				</dd>
				<dt class='span3 clear_margin_left'><?php echo __('Class:'); ?></dt>
				<dd class='span9'>
					<?php 
						echo $this->Site->isEmpty($value['class']); ?>
					&nbsp;
				</dd>
				<dt class='span3 clear_margin_left'><?php echo __('City:'); ?></dt>
				<dd class='span9'>
					<?php echo $this->Site->isEmpty($value['city']); ?>
					&nbsp;
				</dd>
				<dt class='span3 clear_margin_left'><?php echo __('Start Date:'); ?></dt>
				<dd class='span9'>
					<?php
						echo DateTimeLib::setFormat($value['start_date'], TimeFormat::CustomDate);
					?>
					&nbsp;
				</dd>
				<dt class='span3 clear_margin_left'><?php echo __('End Date:'); ?></dt>
				<dd class='span9'>
					<?php 
						echo DateTimeLib::setFormat($value['end_date'], TimeFormat::CustomDate);
					?>
					&nbsp;
				</dd>
				<div class='span12' style='background: #000;min-height: 1px;max-height: 1px;margin-left: 0px;margin-bottom: 1em;'></div>
			<?php endforeach; ?>
		</dl>
	<?php else: ?>
		<dl>
			<dd class='span12'>
				<?php 
					echo __('No Education Found.');
				?>
				&nbsp;
			</dd>
		</dl>
	<?php endif;?>
</fieldset>