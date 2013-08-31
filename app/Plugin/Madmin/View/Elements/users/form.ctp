<tr style="border:0px">
	<td class="content_cell" style="border:0px">
		<table class="form_table" width="100%">
            <tr>
                <td class=label>
                    <?php echo h("Email");?> <span class="required_field">*</span>
                </td>
                <td class=control>
                    <?php
                        echo $this->Form->input('email', array('class' => 'validEmail notEmpty'));
                        //if (!empty($this->data['User']['id'])) {
                        //    echo $this->Html->link(
                        //        'Change Password',
                        //        array(
                        //            'action'=>'reset_password',
                        //            $this->data['User']['id']
                        //        ),
                        //        array(
                        //            'class'=>'hello',
                        //        )
                        //    );
                        //}
                    ?>
                </td>
            </tr>
	    <tr>
                <td class=label>
                    <?php echo __("First Name");?> <span class="required_field">*</span>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('first_name', array('class'=>'notEmpty'));?>
                </td>
            </tr>
	     <tr>
                <td class=label>
                    <?php echo __("Last Name");?> <span class="required_field">*</span>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('last_name', array('class'=>'notEmpty'));?>
                </td>
            </tr>
            <?php if (empty($this->data['User']['id'])) {?>
                <tr>
                    <td class=label>
                        <?php echo __("Password");?> <span class="required_field">*</span>
                    </td>
                    <td class=control>
                        <?php echo $this->Form->input('password', array('class' => 'notEmpty validPassword'));?>
                    </td>
                </tr>
                
                <tr>
                    <td class=label>
                        <?php echo __("Confirm Password");?> <span class="required_field">*</span>
                    </td>
                    <td class=control>
                        <?php
                            echo $this->Form->input(
                                'confirm_password',
                                array(
                                    'type' => 'password',
                                    'class' => 'notEmpty validPassword'
                                )
                            );
                        ?>
                    </td>
                </tr>
            <?php }?>
            <tr>
                <td class=label>
                    <?php echo __("Active");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('is_active',array('type'=>'checkbox'));?>
                </td>
            </tr>
        </table>
    </td>
</tr>