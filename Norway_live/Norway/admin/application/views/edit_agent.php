<?php $this->view('header');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>Khempsons</title>
<link type="text/css" href="<?php echo WEB_DIR?>css/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/jquery-1.4.2.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
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
	var type = "<?php echo $users->user_type_id;?>";
if(type !='')
{
	document.getElementById('user_type').disabled = true;
}
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
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/update_agent/<?php echo $users->user_id?>">

<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
<table align="left" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #f6f4f4 solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#333333; color:#fff;"><span style="padding-left:10px">Edit Agent</span></div>
<tr>
	<td>User Type </td>
	<td><select name="user_type" id="user_type" style="width:180px;">
		<option value="">select user type</option>
		<?php foreach($user_type as $user){?>
		<option value="<?php echo $user->user_type_id;?>"<?Php if($user->user_type_id == $users->user_type_id){?> selected="selected"<?php }?>><?php echo $user->user_type;?></option>
		<?php }?>
	</select></td>
    <td><a href="<?php echo WEB_URL_ADMIN?>admin/agent_approval/<?php echo $users->user_id?>"><img src="<?php echo WEB_DIR?>images/Approve_Partner.png" height="40" style="padding-right:40px;" /></a></td>
</tr>
<tr>
	<td>First Name</td>
	<td><input type="text" style="width:180px;" name="userf_name" id="userf_name" value="<?php echo $users->first_name;?>"/></td>
     <td><a href="<?php echo WEB_URL_ADMIN?>admin/view_agent_bookings/<?php echo $users->user_id?>"><img src="<?php echo WEB_DIR?>images/View_a_c_bookings.png" height="40" style="padding-right:40px;" /></a></td>
</tr>
<tr>
	<td>Last Name</td>
	<td><input type="text" style="width:180px;" name="userl_name" id="userl_name" value="<?php echo $users->last_name;?>"/></td>
</tr>
<tr>
	<td>Company Type</td>
	<td><select name="com_type" id="com_type" style="width:180px;">
		<option value="">--select company type--</option>
	<option value="<?php echo $users->com_type;?>" <?php if($users->com_type == 'Agency'){?> selected="selected"<?php }?>>Agency</option>
	<option value="<?php echo $users->com_type;?>" <?php if($users->com_type == 'Corporate'){?> selected="selected"<?php }?>>Corporate</option>
		</select></td>
</tr>
<tr>
	<td>Company Name</td>
	<td><input type="text" style="width:180px;" name="comp_name" id="comp_name" value="<?php echo $users->agency_name;?>"/></td>
</tr>
<tr>
	<td>Address</td>
	<td><textarea name="address" id="address"><?php echo $users->address;?></textarea></td>
</tr>

<tr>
	<td>Country</td>
	<td><select name="country" id="country" style="width:180px;">
		<option value="">--select country--</option>
		<?php foreach($country as $cont){?>
		<option value="<?php echo $cont->countrycode;?>" <?php if($cont->countrycode == $users->country){?> selected="selected"<?php }?>><?php echo $cont->name;?></option>
		<?php }?>
		</select></td>
</tr>
<tr>
	<td>City</td>
	<td><input type="text" style="width:180px;" name="city" id="city" value="<?php echo $users->city;?>"/></td>
</tr>
<tr>
	<td>PostalCode/Zip</td>
	<td><input type="text" style="width:180px;" name="postalcode" id="postalcode" value="<?php echo $users->postal_code;?>"/></td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="text" style="width:180px;" name="email" id="email" value="<?php echo $users->email;?>" readonly="readonly" /></td>
</tr>
<tr>
	<td>Mobile Phone</td>
	<td><input type="text" style="width:180px;" name="office_no" id="office_no" value="<?php echo $users->mobile_no;?>"/></td>
</tr>
<tr>
	<td>Phone</td>
	<td><input type="text" style="width:180px;" name="mob_phn" id="mob_phn" value="<?php echo $users->alternative_no;?>"/></td>
</tr>
<tr>
	<td>Mark up</td>
	<td><select name="mark_up" id="mark_up" style="width:180px;">
		<option value="">--select mark up--</option>
		<?php foreach($commid as $cont){?>
		<option value="<?php echo $cont->commision_id;?>" <?php if($cont->commision_id == $users->markup){?> selected="selected"<?php }?>><?php echo $cont->value; if($cont->type==1){?>price<?php }else{?>%<?php }?></option>
		<?php }?>
		</select></td>
</tr>
<tr>
	<td>Commission</td>
	<td><select name="comm_id" id="comm_id" style="width:180px;">
		<option value="">--select commision id--</option>
		<?php foreach($commid as $cont){?>
		<option value="<?php echo $cont->commision_id;?>" <?php if($cont->commision_id == $users->commision_id){?> selected="selected"<?php }?>><?php echo $cont->value; if($cont->type==1){?>price<?php }else{?>%<?php }?></option>
		<?php }?>
		</select></td>
</tr>

<tr>
<td></td>
<td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/update_btn.png"   name="submit_agent" value="Register"/></td>
 </tr>
</table>
</td>
<td valign="top">

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
