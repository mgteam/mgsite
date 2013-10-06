<div id="accordion">
    <h3><?php echo __('Personal Information'); ?></h3>
    <div>
    <dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
    </dl>
    </div>
<!--    <div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Id: '); ?></strong>
                    </label>
                    <div class="control-label"><?php echo h($user['User']['id']); ?></div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Group: '); ?></strong>
                    </label>
                    <label class="control-label"><?php echo h($user['Group']['name']); ?></label>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Name: '); ?></strong>
                    </label>
                    <label class="control-label"><?php echo h($user['User']['name']); ?></label>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Group: '); ?></strong>
                    </label>
                    <label class="control-label"><?php echo h($user['Group']['name']); ?></label>
                </div>
            </div>
        </div>
    </div>-->
    <h3><?php echo __('Contact Information'); ?></h3>
    <div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Id: '); ?></strong>
                    </label>
                    <div class="control-label"><?php echo h($user['User']['id']); ?></div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Group: '); ?></strong>
                    </label>
                    <label class="control-label"><?php echo h($user['Group']['name']); ?></label>
                </div>
            </div>
        </div>
        <div class="row-fluid">
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Name: '); ?></strong>
                    </label>
                    <label class="control-label"><?php echo h($user['User']['name']); ?></label>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="control-label">
                        <strong><?php echo __('Group: '); ?></strong>
                    </label>
                    <label class="control-label"><?php echo h($user['Group']['name']); ?></label>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $this->start('script'); ?>
<script type='text/javascript'>
    $( "#accordion" ).accordion();
</script>
<?php $this->end(); ?>