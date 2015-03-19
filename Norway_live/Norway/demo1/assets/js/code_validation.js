$().ready(function() {

$("#flight_search").validate({
		rules:
		{		
			"from_city":
			{
				required:true
			}
			
		},
		messages: {
				from_city:"<font color=red>Please Enter From City</font>"
			},
			 errorElement: "span",
			  errorPlacement: function(error, element) {
				    if (element.attr("name") == "from_city")
					error.appendTo('#dorigin_error');
					else if (element.attr("name") == "postalcode")
					error.appendTo('#err_postalcode');
					else if (element.attr("name") == "last_name")
					error.appendTo('#err_lname');
					else if (element.attr("name") == "email_id")
					error.appendTo('#err_email_id');
					else if (element.attr("name") == "pwfield")
					error.appendTo('#err_pwd_id');
					else if (element.attr("name") == "phone")
					error.appendTo('#err_phone');
					else if (element.attr("name") == "cpwfield")
					error.appendTo('#err_cpwfield');
					else if (element.attr("name") == "email")
					error.appendTo('#err_email');
					else if (element.attr("name") == "passd")
					error.appendTo('#err_passd');
					else if (element.attr("name") == "con_passd")
					error.appendTo('#err_con_passd');
					else if (element.attr("name") == "prop_name")
					error.appendTo('#err_prop_name');
					else
					error.insertAfter(element);
					},
		 errorClass: "error"	
	});
	
});
