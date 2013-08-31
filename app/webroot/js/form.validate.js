$(function(){
    // default setting for validations
	jQuery.validator.setDefaults({
		errorPlacement: function(error, element) {
                error.appendTo(element.parent());
		},
		success: function(element) {
				element.closest('.control-group').removeClass('error').addClass('success');	
		},
		highlight: function(element) {
			$(element).closest('.control-group').removeClass('success').addClass('error');
		}
		
	});
	
	if ($('#LoginForm').length > 0) {
		// Login form
        $("#LoginForm").validate({
            messages: {
                "data[User][email]": {
                    required: app.error_message.REGISTER.Email_Required,
                    email: app.error_message.LOGIN.Email_Valid
                },
                "data[User][password]": {
                    required: app.error_message.LOGIN.Password
                }
            }
        });
	}
    // validation for trainers
    if($('#UserRegisterForm').length > 0){
		 // add form
        $("#UserRegisterForm").validate({
            rules: {
                "data[User][confirm_password]": {
                    equalTo: "#UserPassword"
                }
            },
            messages: {
                "data[User][first_name]": app.error_message.REGISTER.First_Name,
                "data[User][last_name]": app.error_message.REGISTER.Last_Name,
                "data[User][email]": {
                    required: app.error_message.REGISTER.Email_Required,
                    email: app.error_message.REGISTER.Email_Valid
                },
                "data[User][password]": {
                    required: app.error_message.REGISTER.Password
                },
                "data[User][confirm_password]": {
                    required: app.error_message.REGISTER.Confirm_password
                }

            }
        });
    }
    
    /*if($('#TrainerEditForm').length > 0){
        // edit form
        $("#TrainerEditForm").validate({
            messages: {
                "data[Trainer][first_name]": app.error_message.TRAINER.First_Name,
                "data[Trainer][last_name]": app.error_message.TRAINER.Last_Name,
                "data[Trainer][email]": {
                    required: app.error_message.GLOBAL.Email_Required,
                    email: app.error_message.GLOBAL.Email_Valid
                }
            }
        });
    }
    
	jQuery.validator.addMethod("compareClassDates", compareClassDates);
	
    //class form
    if($('#DanceClassAddForm, #DanceClassEditForm').length > 0){
        $("#DanceClassAddForm,#DanceClassEditForm").validate({
            rules: {
				"data[DanceClass][end_time]" : {
					compareClassDates: true 
				},
			    //"data[DanceClass][description]": {
                //    max: 500
                //},
                "data[DanceClass][capacity]": {
                    number: true
                }
            },
			messages: {
                "data[DanceClass][location]": app.error_message.CLASS.Location,
                "data[DanceClass][start_date]": app.error_message.CLASS.Start_Date,
                //"data[DanceClass][start_time]": app.error_message.CLASS.Invalid_Start_Time,
                "data[DanceClass][end_time]": app.error_message.CLASS.Invalid_End_Time,
                "data[DanceClass][address]": app.error_message.CLASS.Street_Address,
                "data[DanceClass][city]": app.error_message.CLASS.City,
                "data[DanceClass][state]": app.error_message.CLASS.State,
                "data[DanceClass][postcode]": app.error_message.CLASS.Postcode,
                "data[DanceClass][description]": app.error_message.CLASS.Description,
                "data[DanceClass][capacity]": {
                    required: app.error_message.CLASS.Capacity.Required,
                    number: app.error_message.CLASS.Capacity.Number                    
                }
            }/*,
			errorPlacement: function(error, element) {
				if( element.hasClass('compareClassDates') == true ){
					error.appendTo(element.closest('.controls'));
				} else if (jQuery.isEmptyObject(element.next('.Fh-help'))){
					error.appendTo(element.next('.Fh-help'));
				}else{
					error.appendTo(element.parent());
				}
			}*/
/*        });
    }
    
    if($('#UserLoginForm').length > 0){
        $("#UserLoginForm").validate({
            messages: {
                "data[User][email]": {
                    required : app.error_message.USER_LOGIN.Email.Required,
                    email: app.error_message.USER_LOGIN.Email.Invalid
                },
                "data[User][password]": app.error_message.USER_LOGIN.Password
            }
        });
    }
	
	if($('#AssetForm').length > 0){
        // add form
        $("#AssetForm").validate({
            messages: {
                "data[Asset][name]": app.error_message.ASSETS.Name,
                "data[Asset][file_name]": app.error_message.ASSETS.File_Name,
				"data[Asset][format]": app.error_message.ASSETS.Format,
				"data[Asset][category_id]": app.error_message.ASSETS.Category_Id
            }
        });
    }

    if($('#UserMyProfileForm').length > 0){
        // add form
        $("#UserMyProfileForm").validate({
            messages: {
                "data[Trainer][first_name]": app.error_message.MY_PROFILE.First_Name,
                "data[Trainer][last_name]": app.error_message.MY_PROFILE.Last_Name,
                "data[Trainer][email]": app.error_message.GLOBAL.Email_Required,
                "data[User][city]" : app.error_message.MY_PROFILE.City,
                "data[User][state]" : app.error_message.MY_PROFILE.State
            }
        });
    }

    if($('#UserChangePasswordForm').length > 0){
        // add form
        $("#UserChangePasswordForm").validate({
            messages: {
                "data[User][old_password]": app.error_message.CHANGE_PASSWORD.CURRENT_PASSWORD,
                "data[User][new_password]": app.error_message.CHANGE_PASSWORD.NEW_PASSWORD,
                "data[User][confirm_password]": app.error_message.CHANGE_PASSWORD.CONFIRM_PASSWORD
            }
        });
    }
	
	if($('#UserResetPasswordForm').length > 0){
        // reset password form.
        $("#UserResetPasswordForm").validate({
			 rules: {
                "data[User][confirm_password]": {
                    equalTo: "#inputPassword"
                }
            },
            messages: {
                "data[User][email]": app.error_message.RESET_PASSWORD.EMAIL,
                "data[User][new_password]": app.error_message.RESET_PASSWORD.NEW_PASSWORD,
                "data[User][confirm_password]": {
                    required: app.error_message.RESET_PASSWORD.CONFIRM_PASSWORD,
                    equalTo: app.error_message.RESET_PASSWORD.Confirm_Not_match
                }
            }
        });
    }
	
	if($('#UserForgotPasswordForm').length > 0){
		// reset password form.
        $("#UserForgotPasswordForm").validate({
            messages: {
               "data[User][email]": {
                    required : app.error_message.FORGOT_PASSWORD.Email.Required,
                    email: app.error_message.FORGOT_PASSWORD.Email.Invalid
                }
            }
        });
    }

    // update franchisee form validations.
    if($('#FranchiseeUpdateFranchiseeForm').length > 0){
        // update form
        $("#FranchiseeUpdateFranchiseeForm").validate({
            rules: {
                /*"data[Franchisee][email]" : {
                    compareClassDates: true 
                },*/
/*                "data[SubscriptionFee][fee]": {
                    number: true
                },
                "data[SubscriptionFee][vat]": {
                    number: true
                }
            },
            messages: {
                "data[Franchisee][first_name]": app.error_message.FRANCHISEE.First_Name,
                "data[Franchisee][last_name]": app.error_message.FRANCHISEE.Last_Name,
                "data[Franchisee][email]": {
                    required : app.error_message.FRANCHISEE.Email.NotEmpty,
                    email: app.error_message.FRANCHISEE.Email.Valid
                },
                "data[Franchisee][country_code]": app.error_message.FRANCHISEE.Country,
                "data[SubscriptionFee][fee]": {
                    required : app.error_message.SUBSCRIPTIONFEE.Fee.NotEmpty,
                    number: app.error_message.SUBSCRIPTIONFEE.Fee.Numeric
                },
                "data[SubscriptionFee][vat]": {
                    number: app.error_message.SUBSCRIPTIONFEE.Vat.Numeric
                }
            }
        });
    }*/
});