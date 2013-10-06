<div class="pagination">
	<?php echo $this->Paginator->pager(); ?>
</div>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th><?php echo $this->Paginator->sort('id', __('ID')); ?></th>
			<th><?php echo $this->Paginator->sort('User.name', __('Name')); ?></th>
			<th><?php echo $this->Paginator->sort('email', __('Email')); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (!$users): ?>
			<tr>
				<td colspan='6' style='text-align: center;'> <?php echo __(NO_RECORD_FOUND); ?></td>
			</tr>
		<?php 
			else:
				foreach ($users as $user): ?>
					<tr>
						<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
						<td>
							<?php 
								echo h($user['User']['name']); 
							?>
							&nbsp;
						</td>
						<td><?php echo h($user['User']['email']); ?>&nbsp;</td>
						<td class="actions">
							<?php 
								echo $this->Admin->grid_action_cell(array('id' => $user['User']['id']));
							?>
						</td>
					</tr>
				<?php endforeach;
			endif;
		?>
	</tbody>
</table>