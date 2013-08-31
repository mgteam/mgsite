	<tr>
		<td class="form-control">
			<?php
				echo $this->Form->input(
					'first_name',
					array(
						'class' => 'required text-input text-input-short',
						'label' => false,
						'placeholder' => 'First Name'
					)
				);
			?>
		</td>
		<td class="form-control">
			<?php
				echo $this->Form->input(
					'last_name',
					array(
						'class' => 'required text-input text-input-short',
						'label' => false,
						'placeholder' => 'Last Name'
					)
				);
			?>
		</td>
	</tr>
	<tr>
		<td class="form-control" colspan="2">
			<?php
				echo $this->Form->input(
					'email',
					array(
						'class' => 'required email text-input',
						'label' => false,
						'placeholder' => 'Email or Phone'
					)
				);
			?>
		</td>
	</tr>
	<tr>
		<td class="form-control" colspan="2">
			<?php
				echo $this->Form->input(
					'password',
					array(
						'class' => 'required password text-input',
						'label' => false,
						'placeholder' => 'Password'
					)
				);
			?>
		</td>
	</tr>
	<tr>
		<td class="form-control" colspan="2">
			<?php
				echo $this->Form->input(
					'confirm_password',
					array(
						'type' => 'password',
						'class' => 'required password text-input',
						'label' => false,
						'placeholder' => 'Confirm Password'
					)
				);
			?>
		</td>
	</tr>
	<tr class="custom-option">
		<td class="form-control" colspan="2">
			<div class="radio">
			<?php
				$options=array('M'=>'Male','F'=>'Female');
				$attributes=array('legend'=>false, 'label'=>'I am (*)');
				echo $this->Form->radio('gender',$options,$attributes);
			?>
			</div>
		</td>
	</tr>