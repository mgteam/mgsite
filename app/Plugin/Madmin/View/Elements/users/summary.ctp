<table cellspacing="0" cellpadding="0" class="index-table border-col a-center">
	<tbody>
		<tr>
			<th class="center">
				<?php
					echo $this->Paginator->sort(
						'id',
						__( 'ID', true ),
						array(
							'title' => 'Customer Id'
						)
					);
				?>
			</th>
			<th class="center">
				<?php
					echo $this->Paginator->sort(
						'email',
						__( 'Username', true ),
						array(
							'title' => 'Username'
						)
					);
				?>
			</th>
			<th class="center"><?php echo __('Status');?></th>
			<th class="center"><?php echo __('View');?></th>
			<th class="center"><?php echo __('Edit');?></th>
			<th class="center"><?php echo __('Archive');?></th>
		</tr>
		<?php if(!$users):?>
		<tr>
			<td colspan="8"><?php echo __('No record found.');?></td>
		</tr>
		<?php else:?>
			<?php foreach($users as $user): ?>
			<tr>
				<td class="numeric">
					<?php echo $user['User']['id']; ?>
				</td>
				<td>
					<?php
						echo $user['User']['email'];
					?>
				</td>
				<td class="actions links">
					<?php
						/*echo $this->Status->block(
							$user['User']['id'],				// page id.
							$user['User']['is_active'],			// status.
							'is_active'						// field name.
						);*/
					?>
				</td>
				<td class="actions links">
					<?php
						echo $this->Html->link(
							$this->Html->image(
								'Madmin.images/magnifire.jpeg',
								array(
									'title' => 'View'
								)
							),
							array(
								'controller' => 'users',
								'action' => 'view',
								$user['User']['id']
							),
							array(
								'escape' => false
							)
						);
					?>
				</td>
				<td class="actions links">
					<?php
						echo $this->Html->link(
							$this->Html->image(
								'Madmin.images/edit_link.png',
								array(
									'title' => 'Edit Profile'
								)
							),
							array(
								'action'=>'edit',
								$user['User']['id']
							),
							array(
								'escape' => false
							)
						);
					?>
				</td>
				<td class="actions links">
					<?php
						echo $this->Html->link(
							$this->Html->image(
								'Madmin.images/delete_link.png',
								array(
									'title' => 'Delete'
								)
							),
							array(
								'action'=>'delete',
								$user['User']['id']
							),
							array(
								'escape' => false
							)
						);
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
	</tbody>
</table>