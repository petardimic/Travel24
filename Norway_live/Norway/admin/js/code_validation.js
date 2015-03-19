$().ready(function() {
$("#user_registration_form").validate({
		rules:
		{		
			"user_type":
			{
				required:true
			},
			"userf_name":
			{
				required:true
			},
			"userl_name":
			{
				required:true
			},
			"gender":
			{
				required:true
			},
			"dob":
			{
				required:true
			},
			"address":
			{
				required:true
			},
			"country":
			{
				required:true
			},
			city:"required",
			"email":{
				required:true,
				email:true
			},
			
			"nation": 
			{
				required:true
			},
			"passd":
			{
				required:true,
				minlength:6
			},
			"con_passd":
			{
				required:true,
				equalTo:"#passd"
			}
		},
		messages: {
				user_type:"<font color=red>Please select user type</font>",
				userf_name:"<font color=red>Please enter first name</font>",
				userl_name:"<font color=red>Please enter last name</font>",
				gender:"<font color=red>Please select gender</font>",
				dob:"<font color=red>Please enter date of birth</font>",
				address:"<font color=red>Please enter address</font>",
				country:"<font color=red>Please select country</font>",
				city:"<font color=red>Please enter city</font>",
				//postalcode:"<font color=red>Please enter postal code</font>",
				email: "<font color=red>Please enter email address</font>",
				nation:"<font color=red>Please enter nation</font>",
				passd:"<font color=red>Please enter minimum 6 letters in password</font>",
				con_passd:"<font color=red>Please enter confirem password</font>"
			}
	});
	$('#add_subadmin').validate({
		rules:
		{
			"userf_name":
			{
				required:true
			},
			"userl_name":
			{
				required:true
			},
			"email":{
				required:true,
				email:true
			},
			"passd":
			{
				required:true,
				minlength:6
			},
			"con_passd":
			{
				required:true,
				equalTo:"#passd"
			}
		},
		messages:
		{
			userf_name:"<font color=red>Please enter first name</font>",
			userl_name:"<font color=red>Please enter last name</font>",
			email: "<font color=red>Please enter email address</font>",
			passd:"<font color=red>Please enter minimum 6 letters in password</font>",
			con_passd:"<font color=red>Please enter confirem password</font>"
		}
	});
	$('#change_password').validate({
		rules:
		{
			"current_pwd":
			{
				required:true
			},
			"new_pwd":
			{
				required:true,
				minlength:6
			},
			"reenter_pwd":
			{
				required:true,
				equalTo:"#new_pwd"
			}
		},
		messages:
		{
			current_pwd:"<font color=red>Please enter current password</font>",
			new_pwd:"<font color=red>Please enter new password</font>",
			reenter_pwd: "<font color=red>Please enter confirem password</font>"
		}					
	});
	$('#add_comm').validate({
		rules:
		{
			"value":
			{
				required:true,
				number:true
			},
			"type":
			{
				required:true
			}
		},
		messages:
		{
			value:"<font color=red>Please enter commission value</font>",
			type:"<font color=red>Please select commission type</font>"
		}
	});
	$('#add_email').validate({
		rules:
		{
			"add_email_type":
			{
				required:true
			},
			"add_email_code":
			{
				required:true
			}
		},
		messages:
		{
			add_email_type:"<font color=red>Please enter title</font>",
			add_email_code:"<font color=red>Please enter title code</font>"
		},
			 errorElement: "span",
			  errorPlacement: function(error, element) {
				    if (element.attr("name") == "add_email_type")
					error.appendTo('#err_add_email_type');
					else if(element.attr("name") == "add_email_code")
					error.appendTo('#err_add_email_code');
					else
					error.insertAfter(element);
					},
		 errorClass: "error"	
	});
	$('#email_content').validate({
		rules:
		{
			"title":
			{
				required:true
			},
			"subject":
			{
				required:true
			}
		},
		messages:
		{
			title:"<font color=red>Please select title</font>",
			subject:"<font color=red>Please enter subject</font>"
		},
			 errorElement: "span",
			  errorPlacement: function(error, element) {
				    if (element.attr("name") == "title")
					error.appendTo('#err_title');
					else if(element.attr("name") == "subject")
					error.appendTo('#err_subject');
					else
					error.insertAfter(element);
					},
		 errorClass: "error"							 
	});
	$('#update_comm').validate({
		rules:
		{
			"add_update_comm":
			{
				required:true,
				number:true
			}
		},
		messages:
		{
			add_update_comm:"<font color=red>Please enter commission</font>"
		},
			 errorElement: "span",
			  errorPlacement: function(error, element) {
				    if (element.attr("name") == "add_update_comm")
					error.appendTo('#err_add_update_comm');
					else
					error.insertAfter(element);
					},
		 errorClass: "error"	
	});
});
