
<tr style="border:0px">
	<td class="content_cell" style="border:0px">
		<table class="form_table" width="100%">
            <tr>
				<th colspan='4' class='header_row2'>User Details</th>
			</tr>
            <tr>
                <td class=label>
                    <?php __("Company Name");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('company_name');?>
                </td>
            </tr>
            
            <tr>
                <td class=label>
                    <?php __("First Name");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('first_name');?>
                </td>
            </tr>
            
            <tr>
                <td class=label>
                    <?php __("Last Name");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('last_name');?>
                </td>
            </tr>
            <?php if (empty($this->data['User']['id'])) {?>
                <tr>
                    <td class=label>
                        <?php __("Password");?> <span class="required_field">*</span>
                    </td>
                    <td class=control>
                        <?php
                            echo $this->Form->input('password', array('class' => 'notEmpty'));
                        ?>
                    </td>
                </tr>
                
                <tr>
                    <td class=label>
                        <?php __("Confirm Password");?> <span class="required_field">*</span>
                    </td>
                    <td class=control>
                        <?php
                            echo $this->Form->input(
                                'confirm_password',
                                array(
                                    'type' => 'password',
                                    'class' => 'notEmpty'
                                )
                            );
                        ?>
                    </td>
                </tr>
            <?php }?>
            <tr>
                <td class=label>
                    <?php __("email");?> <span class="required_field">*</span>
                </td>
                <td class=control>
                    <?php
                        echo $this->Form->input('email', array('class'=>'validEmail'));
                        if (!empty($this->data['User']['id'])) {
                            echo $this->Html->link(
                                'Change Password',
                                array(
                                    'action'=>'admin_reset_password',
                                    $this->data['User']['id']
                                ),
                                array(
                                    'class'=>'hello',
                                )
                            );
                        }
                    ?>
                </td>
            </tr>
            <tr>
                <td class=label>
                    <?php __("phone");?> <span class="required_field">*</span>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('phone', array('class'=>'notEmpty numeric'));?>
                </td>
            </tr>
            <tr>
                <td class=label>
                    <?php __("Active");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('is_active');?>
                </td>
            </tr>
        </table>
    </td>
</tr>
<tr style="border:0px">
	<td class="content_cell" style="border:0px">
		<table class="form_table" width="100%">
            <tr>
				<th colspan='4' class='header_row2'>User Address</th>
			</tr>
            
            
            <tr>
                <td class=label>
                    <?php e(" Unit Number");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('unit_number');?>
                </td>
            </tr>
            
            <tr>
                <td class=label>
                    <?php e("Street Number");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('street_number');?>
                </td>
                
                 <td class=label>
                    <?php e("Street Name");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('street_name');?>
                </td>
            </tr>
            <tr>
                <td class=label>
                    <?php e("State");?>
                </td>
                <td class=control>
                    <?php
                        echo $this->Form->input(
                            'state_id',
                            array(
                                'type' => 'select',
                                'options' => $states,
                                'empty' => PLEASE_SELECT
                            )
                        );
                    ?>
                </td>
				<td class=label>
                    <?php e("City");?>
                </td>
                <td class=control>
                    <?php
                        echo $this->Form->input(
                            'suburb_id',
                            array(
                                'type' => 'select',
                                'options' => $suburbs,
                                'empty' => PLEASE_SELECT
                            )
                        );
                    ?>
                </td>
            </tr>
			
			<tr>
                <!--<td class=label>
                    <?php e("Country");?>
                </td>
                <td class=control>
                    <?php
                        echo $this->Form->input(
                            'country_id',
                            array(
                                'type' => 'select',
                                'options' => $countries,
                                'empty' => PLEASE_SELECT
                            )
                        );
                    ?>
				</td>-->
				<td class=label>
                    <?php e("Zip Code");?>
                </td>
                <td class=control>
                    <?php
                        echo $this->Form->input(
                            'zip_code',
                            array(
                                'class' => 'numeric'
                            )
                        );
                    ?>
                </td>
            </tr>
            
            <tr>
				<td class=label>
                    <?php e("Show Contact");?>
                </td>
                <td class=control>
                    <?php echo $this->Form->input('display_address');?>
                </td>
            </tr>
        </table>
    </td>
</tr>
