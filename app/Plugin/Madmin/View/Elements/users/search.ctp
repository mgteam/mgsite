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
				<?php echo __("Search By Email"); ?>:
			</td>
			<td class='search-control'>
				<?php
					$email = isset($this->request->params['named']['search']) ? $this->request->params['named']['search'] : null;
                    echo $this->Form->input(
						'search',
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
							'options' => Configure::read('status')
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