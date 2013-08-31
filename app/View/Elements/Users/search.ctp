<?php
	echo $this->Form->create(
		'User',
		array(
			'url'=>array(
				'controller'=>'users',
				'action'=>'index'
			),
			'inputDefaults'=>array(
				'label'=>false,
				'div'=>false
			),
			'type'=>'get',
			'id' => 'admin_search_form',
			'class'=>'admin_search_form'
		)
	);
?>
<table cellspacing="0" cellpadding="0" class="search-table border-row">
	<tbody>
		<tr>
			<th colspan="3" class='a-left' >
				<?php echo __("Search By"); ?>
			</th>
		</tr>
		<tr>
			<td class='search-label'>
				<?php echo __("Search By Name"); ?>:
			</td>
			<td class='search-control'>
				<?php
					$name = isset($this->request->params['named']['name']) ? $this->request->params['named']['name'] : null;
                    echo $this->Form->input(
						'name',
						array(
							'label' => false,
							'value' => $name
						)
					);
				?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class='search-label'>
				<?php echo __("Search By Email"); ?>:
			</td>
			<td class='search-control'>
				<?php
					$email = isset($this->request->params['named']['email']) ? $this->request->params['named']['email'] : null;
                    echo $this->Form->input(
						'email',
						array(
							'label' => false,
							'value' => $email
						)
					);
				?>
			</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td class='search-label'>
				<?php echo __("Search By User Status"); ?>:
			</td>
			<td class='search-control'>
				<?php
					$status = isset($this->request->params['named']['is_active']) ? $this->request->params['named']['is_active'] : null;
					echo $this->Form->input(
						'User.is_active',
						array(
							'label'=>false,
							'type' => 'select',
							'empty' => SELECT_EMPTY,
							'value' => $status,
							'options' => Configure::read('user_status')
						)
					);
				?>
			</td>
			<td>
				<?php
					echo $this->Form->submit(
						__('Search'),
						array(
							'div'=>false,
							'class'=>'button'
						)
					);
				?>
			</td>
		</tr>
	</tbody>
</table>
<?php echo $this->Form->end(); ?>