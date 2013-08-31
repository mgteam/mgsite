<?php
	echo $this->Form->create(
		'User',
		array(
			'action' => 'admin_multiple_delete',
			'type' => 'post'
		)
	);
?>
	<table class="index_table centered_table all_borders" cellspacing="0" cellpadding="0">
		<tbody>
			<tr>
				<th class="center"><?php echo $this->Paginator->sort('ID', 'id'); ?></th>
				<th><?php echo $this->Paginator->sort('Group', 'group_id');?></th>
				<th><?php echo $this->Paginator->sort('Username', 'username');?></th>
				<th><?php echo $this->Paginator->sort('Email', 'email');?></th>
				<th class="center"><?php __("Status");?></th>
				<th class="center"><?php __("Edit");?></th>
				<th class="center"><?php __("Delete");?></th>
			</tr>
			
			<?php 
			if(!$records): ?>
                <tr class="altrow">
                    <td colspan=7> No record found.</td>
                </tr>
            <?php else: 
				foreach ($records as $record) :?>
					<tr class="altrow">
						<td class="numeric"> <?php echo $record['User']['id'];?> </td>
						<td><?php echo $record['Group']['name']; ?>&nbsp</td>
						<td><?php echo $record['User']['username']; ?>&nbsp;</td>
						<td><?php echo $record['User']['email']; ?>&nbsp;</td>
						<td class="actions links">
							<?php $status = $record['User']['is_active'];
								if ($status == 1)
								{
									echo $this->Html->image(
										'admin/active.png',
										array(
											'url' => array(
												'action' => 'admin_active',
												$record['User']['id']
											)
										)
									);
								}
								else
								{
									echo $this->Html->image(
										'admin/cross.png',
										array(
											'url' => array(
												'action' => 'admin_active',
												$record['User']['id']
											)
										)
									);
								}
							?>
						</td>
						<td class="actions links">
							<?php
								echo $this->Html->image(
									'admin/edit_link.png',
									array(
										'alt' => 'edit_link',
										'url' => array(
											'action' => 'admin_edit',
											$record['User']['id']
										)
									)
								);
							?>
						</td>
						<td>
							<div class="input checkbox">
								<?php
									echo $this->Form->checkbox(
										$record['User']['id'],
										array(
											'label' => false,
											'value' => $record['User']['id']
										)
									);
								?>
							</div>
						</td>
					</tr>
				<?php endforeach ;
			endif;?>
			<tr class="pagination_row">
				<td colspan="6">
					<div class="paging">
						<!-- Shows the next and previous links -->
						<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
						<!-- Shows the page numbers -->
						<?php echo $this->Paginator->numbers(); ?>
						<!-- prints X of Y, where X is current page and Y is number of pages -->
						<?php #echo $this->Paginator->counter(); ?>
						<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
					</div>
				</td>
				<?php echo $this->element('admin/delete_button');?>
			</tr>
		</tbody>
	</table>
<?php echo $this->Form->end();?>