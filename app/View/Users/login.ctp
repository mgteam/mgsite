<style type="text/css">#confirmation-msg {width: 100%;}</style>
<div id="form-login" class="mengra_login">
	<?php echo $this->element('flash_message');?>
	<div class="login-left-area">
		<ul>
			<li class="button-secondary facebook"><?php echo $this->Html->link(__('Log in with Facebook'),'/auth_login/facebook',array('class'=>'')); ?></li>
			<li class="button-secondary twitter"><?php echo $this->Html->link(__('Log in with Twitter'),'/auth_login/twitter',array('class'=>'')); ?></li>
			<li class="button-secondary googleplus"><?php echo $this->Html->link(__('Log in with Google+'),'/auth_login/google',array('class'=>'')); ?></li>
			<li class="button-secondary linkedin"><?php echo $this->Html->link(__('Log in with LinkedIn'),'/auth_login/linkedin',array('class'=>'')); ?></li>
		</ul>
	</div>
	<div class="login-right-area">
		<div class="login-text DroidSans">
			<h4><?php echo __('Don`t have these social media?'); ?></h4>
			<h5><?php echo __('Login the old-fashion way below:'); ?></h5>
		</div>
		<?php
			echo $this->Form->create(
				'User',
				array(
					'url' => array(
						'controller' => 'users',
						'action' =>'login'
					),
					'id' => 'LoginForm',
					'inputDefaults' => array(
						'required' => false
					)
				)
			);
				echo $this->Form->input(
					'email',
					array(
						'class' => 'required email login_input text-input',
						'label' => false,
						'placeholder' => __('Username (Email)')
					)
				);
				echo $this->Form->input(
					'password',
					array(
						'class' => 'required login_input password_input text-input',
						'label' => false,
						'placeholder' => __('Password')
					)
				);
				echo $this->Form->input(
					'remember_me',
					array(
						'type' => 'checkbox',
						'class' => 'login_checkbox',
						'label' => __('Remember me')
					)
				);
				echo $this->Html->link(
					__('Forgot password?'),
					array(
						'controller'=>'users',
						'action'=>'forgot_password'
					),
					array(
						'class'=>'forgot_password'
					)
				);
				?>
				<div class="sign-up-container">
					<?php
						echo $this->Form->button(
							__('I don`t have an account'),
							array(
								'type'=>'button',
								'data-action' => 'users/register',
								'class'=>'sign-up-button button-primary cancel-btn',
								'div'=>false,
								'label'=>false
							)
						);
						echo $this->Form->submit(__('Login'), array('class'=>'mengra_submit button-primary', 'div'=>false ));
					?>
				</div>
			<?php echo $this->Form->end(); ?>
	</div>
</div>
<div class="clear"></div>