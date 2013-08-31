<td id="links_contents_separator"></td>
<td id="contents" valign="top">
	<table id="contents_table" cellpadding='0' cellspacing='0'>
		<tr>
			<td>
				<div class="form">
					<table cellspacing='0px' cellpadding='0px' id="content_heading_table">
						<tr>
							<td class="content_heading">
								<?php echo ("User Manager"); ?>
							</td>
						</tr>
					</table>
					<div id="CountryAddForm">
						<table class="form_container">
							<tr class="header_row">
								<th colspan='2'><?php echo ("Edit User"); ?></th>
							</tr>
							<tr>
								<td class="content_cell">
									<?php
										echo $this->Form->create(
											'User',
											array(
												'inputDefaults' => array(
													'label' => false,
													'div' => false
												),
												'class' => 'AddUserForm',
												'onsubmit'=>'return validate(".EditUserForm");'
											)
                                        );
										echo $this->Form->hidden('id');                                        
                                    ?>
										<table class="form_table" width="100%">
												<?php echo $this->element('Madmin.users/form');?>	
											<tr style="border:0px">
												<td>
													<?php echo '<div style=float:left;margin-left:155px;>'. $this->element('Madmin.action_button').'</div>';?>
												</td>
											</tr>
										</table>
									<?php echo $this->Form->end();?>
								</td>
							</tr>	
						</table>
					</div>
                </div>
            </td>
        </tr>
    </table>
</td>