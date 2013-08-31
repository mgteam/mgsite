<div id="registration-outer">
	<div id="registration-form-outer">
		<div class="register-header DroidSans">
			<h5>Join Today &amp; Become a Member !</h5>
		</div>
		<hr class="h-row" />
		<div class="register-form">
		<?php
			/**
			 * Registration Form
			 */
			echo $this->Form->create(
				'User',
				array(
					'action'=>'register', 'class' => 'adminPanelForm',
					'inputDefaults' => array('label' => false, 'div' => false, 'required' => false),
				)
			);
			?>
			<table cellspacing="0" cellpadding="0" class="form-table border-row a-left">
				<tbody>
					<tr>
						<th class='a-left'>
							<?php //h($title);?>
						</th>
					</tr>
					<tr class='no-border'>
						<td class='content-cell'>
							<table cellpadding='0' cellspacing='0'>
								<?php echo $this->element('Users/register')?>
								</table>
							</td>
						</tr>
						<tr class='no-border'>
							<td class='form-buttons'>
								<?php
									echo $this->Form->submit(__('Submit'), array('div'=>false, 'class'=>'button button-primary', 'after'=>'&nbsp;'));
									echo $this->Form->button(
										__('Cancel'),
										array(
											'type' => 'button',
											'div'=>false,
											'class'=>'button button-secondary cancel-btn',
											'data-action' => 'users/login'
										)
									);
								?>
							</td>
						</tr>
					</tbody>
				</table>
			<?php echo $this->Form->end(); ?>
		</div>
		<div class="register-signin-link">
			Already have a <b>Mengra</b> account ? <?php echo $this->Html->link('Login here !',array('controller'=>'users','action'=>'login')); ?>
		</div>
	</div>
</div>