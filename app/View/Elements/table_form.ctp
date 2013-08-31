<table cellspacing="0" cellpadding="0" class="form-table border-row a-left">
	<tbody>
		<tr>
			<th class='a-left'>
				<?php h($title);?>
				
			</th>
		</tr>
		<tr class='no-border'>
			<td class='content-cell'>
				<table cellpadding='0' cellspacing='0'>
					<?php echo $this->element($form)?>
				</table>
			</td>
		</tr>
		<tr class='no-border'>
			<td class='form-buttons'>
				<?php
					echo $this->element('buttons');
				?>
			</td>
		</tr>
	</tbody>
</table>