<?php $this->view('header');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>Travelingmart</title>
    <link type="text/css" href="<?php echo WEB_DIR?>css/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/jquery-1.4.2.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function() {
		$('#user_type').change(function() {
			var locval= $(this).val();
			if(locval == 2)
			{
				$('#anamelbl').show();
				$('#anametxt').show();
				$('#cur_show').show();
			}else
			{
				$('#anamelbl').hide();
				$('#anametxt').hide();
				$('#cur_show').hide();
			}
 
});
		
	});
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
	
	
function insert(str) {
//alert(str);
		 var alt_email = $('#email').val(); 
		$("#agent_login12").val(alt_email);
		var user_type = $('#user_type').val();
		if(user_type && str!='')
		{
		  var strURL="<?php print WEB_URL_ADMIN?>/admin/confirm_agent/"+str+"/"+user_type;
		 // alert(strURL);
				var req = getXMLHTTP();
				
				if (req) {
					
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {						
								var s=req.responseText;	
								if(s !='')
								{
								alert(s);
								document.getElementById('email').value='';
								document.getElementById('email').focus();
								}					
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}				
					}			
					req.open("GET", strURL, true);
					req.send(null);
				}
		  
		}
		else
		{
			if(user_type == '')
			{
				alert('please select user type');
			}
			document.getElementById('user_type').focus();
			return false;
		}
	}
	
</script>

<script>
function zeroPad(num,count)
{
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}
function dateADD(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
$(document).ready(function(){
	$(function() {
			$("#dob").datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true,
			maxDate: 0
		});

	});

});
</script>
<style type="text/css">
/*#container_warpper {
    background: none repeat scroll 0 0 #FFFFFF;
    border-color: #74941D;
    border-left: 3px solid #74941D;
    border-style: solid;
    border-width: 2px 3px 3px;
    height: auto !important;
    margin: auto;
    overflow: hidden;
    width: 1000px;
}*/
</style>
</head>
<body>
<!--<div id="inner-pagetit">Agent Registration</div>-->
<div id="container_warpper" >
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/user_regisrtaion">
<div style="background:#EFA146; color:#000; padding:4px;" >User Registration</div>

<table width="920" align="center" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;  padding-top:2px;">
<tr><td>
<table align="left" width="450" border="0" cellpadding="5" cellspacing="5" style="border:1px #f6f4f4 solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#333; color:#fff; width:450px;"><span style="padding-left:10px">Add User</span></div>
<tr>
	<td>User Type </td>
	<td><select name="user_type" id="user_type" style="width:180px;">
		<option value="">select user type</option>
		<?php foreach($user_type as $user){?>
		<option value="<?php echo $user->user_type_id;?>"><?php echo $user->user_type;?></option>
		<?php }?>
	</select></td>
</tr>
<tr>
	<td>First Name</td>
	<td><input type="text" style="width:180px;" name="userf_name" id="userf_name"/></td>
</tr>
<tr>
	<td><div id="anamelbl" style="display:none;">Agency Name</div></td>
	<td><div id="anametxt" style="display:none;"><input type="text" style="width:180px;" name="agency_name" id="agency_name" value=""/></div></td>
</tr>
<tr>
	<td>Last Name</td>
	<td><input type="text" style="width:180px;" name="userl_name" id="userl_name"/></td>
</tr>
<tr>
	<td>Gender</td>
	<td><select name="gender" id="gender"  style="width:180px;">
		<option value="">select gender</option>
		<option value="male">Male</option>
		<option value="female">Female</option>
		</select></td>
</tr>
<tr>
	<td>DOB</td>
	<td><input type="text" style="width:160px;" name="dob" id="dob"/></td>
</tr>
<tr>
	<td>Address</td>
	<td><textarea name="address" id="address"></textarea></td>
</tr>
<tr>
	<td>Country</td>
	<td><select name="country" id="country" style="width:180px;">
		<option value="">--select country--</option>
		<?php foreach($country as $cont){?>
		<option value="<?php echo $cont->country_id;?>"><?php echo $cont->name;?></option>
		<?php }?>
		</select></td>
</tr>
<tr>
	<td>City</td>
	<td><input type="text" style="width:180px;" name="city" id="city"/></td>
</tr>
<tr>
	<td>PostalCode</td>
	<td><input type="text" style="width:180px;" name="postalcode" id="postalcode"/></td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="text" style="width:180px;" name="email" id="email" onBlur="return insert(this.value);"/></td>
</tr>
<tr>
	<td>MobileNumber</td>
	<td><input type="text" style="width:180px;" name="office_no" id="office_no"/></td>
</tr>
<tr>
	<td>OfficeNumber</td>
	<td><input type="text" style="width:180px;" name="mob_phn" id="mob_phn"/></td>
</tr>
<tr>
	<td>Nationality</td>
	<td><input type="text" style="width:180px;" name="nation" id="nation"/></td>
</tr>
<tr>
	<td>Commission Id</td>
	<td><select name="comm_id" id="comm_id" style="width:180px;">
		<option value="">--Select Commision id--</option>
		<?php foreach($commid as $cont){?>
		<option value="<?php echo $cont->commision_id;?>"><?php echo $cont->value; if($cont->type==1){?>price<?php }else{?>%<?php }?></option>
		<?php }?>
		</select></td>
</tr>
<tr id="cur_show">
	<td>Currency</td>
	<td><select name="currency" id="currency" style="width:180px;">
		<option value="">--Select Currency--</option>
		<?php foreach($cur as $c){?>
		<option value="<?php echo $c->currency_id;?>"><?php echo $c->currency_name;?></option>
		<?php }?>
		</select><br/><span id="currency_err"></span></td>
</tr>
</table>
</td>
<td valign="top">
<table align="left" width="450" border="0" cellpadding="5" cellspacing="5"  style="border:1px #f6f4f4 solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#333; width:450px; color:#fff;"><span style="padding-left:10px">Login Information</span></div>
<tr>
	<td>user Login</td>
	<td><input type="text" style="width:180px;" name="agent_login" readonly="readonly" id="agent_login12"/></td>
</tr>
<tr>
	<td>Password</td>
	<td><input type="password" style="width:180px;" name="passd" id="passd"/></td>
</tr>
<tr>
	<td>Confirm Password</td>
	<td><input type="password" style="width:180px;" name="con_passd" id="con_passd"/></td>
</tr>
<tr>
<td></td>
<td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/submit_btn.png"   name="submit_agent" value="Register"/>
<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
</td>
<td>
	
    </td>
 </tr>
</table>
</td></tr>
</table>
</form>
<div style="clear:both;"></div>
</div>
<div style="width:940px; margin:0 auto">
<?php $this->view('footer');?>
</div>
</body>
</html>