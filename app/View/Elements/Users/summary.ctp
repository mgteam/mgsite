<?php
/**
 * Display a list of Pages.
 * */

	#create Deletion Form.
	echo $this->Form->create(
		'User',
		array(
			'url'=>array(
				'controller'=>'users',
				'action'=>'delete',
				'admin'=>true
			),
			'inputDefaults'=>array(
				'label'=>false,
				'div'=>false
			),
			'onsubmit' => 'return confirm("Are you really want to delete record(s)?")'
		)
	);
?>
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
						'first_name',
						__( 'Name', true ),
						array(
							'title' => 'Name'
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
			<th class="center">
				<?php
					echo $this->Paginator->sort(
						'created',
						__( 'Member since', true ),
						array(
							'title' => 'Date of registration'
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
				<td class="numeric">
					<?php
						echo $user['User']['name'];
					?>
				</td>
				<td>
					<?php
						echo $user['User']['email'];
					?>
				</td>
				<td>
					<?php //echo $this->Custom->customDate($user['User']['created']); ?>
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
								'images/magnifire.jpeg',
								array(
									'title' => 'View'
								)
							),
							array(
								'controller' => 'users',
								'action' => 'admin_view',
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
								'images/admin_edit.png',
								array(
									'title' => 'Edit Profile'
								)
							),
							array(
								'action'=>'admin_edit',
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
						echo $this->Form->input(
							$user['User']['id'],
							array(
								'type'=>'checkbox',
								'label'=>false,
							)
						);
					?>
				</td>
			</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		<tr class='border-row'>
			<td colspan="7" class='a-left'>
				<?php //echo $this->element('pagination')?>
			</td>
			<td class='r-center'>
				<?php
					if($users){
						echo $this->Form->submit(
							'Delete', array(
								'div'=>false,
								'class'=>'button'
							)
						);
					}
				?>
			</td>
		</tr>
	</tbody>
</table>
<?php echo $this->Form->end(); ?>