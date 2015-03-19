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
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/update_user/<?php echo $users->user_id?>">

<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
<table align="left" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #f6f4f4 solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#333333; color:#fff;"><span style="padding-left:10px">View Customer</span></div>
<tr>
	<td>User Type </td>
	<td><select name="user_type" id="user_type" style="width:180px;">
		<option value="">select user type</option>
		<?php foreach($user_type as $user){?>
		<option value="<?php echo $user->user_type_id;?>"<?Php if($user->user_type_id == $users->user_type_id){?> selected="selected" <?php }?>><?php echo $user->user_type;?></option>
		<?php }?>
	</select></td>
</tr>
<tr>
	<td>First Name</td>
	<td><input type="text" style="width:180px;" name="userf_name" id="userf_name" value="<?php echo $users->first_name;?>" readonly="readonly"/></td>
</tr>
<tr>
	<td>Last Name</td>
	<td><input type="text" style="width:180px;" name="userl_name" id="userl_name" value="<?php echo $users->last_name;?>" readonly="readonly"/></td>
</tr>
<tr>
	<td>Gender</td>
	
	<td><select name="gender" id="gender"  style="width:180px;">
		<option value="">select gender</option>
		<option value="male" <?php if($users->gender == "Male"){?> selected="selected"<?php }?>>Male</option>
		<option value="female"  <?php if($users->gender == "Female"){?> selected="selected"<?php }?>>Female</option>
		</select></td>
</tr>
<tr>
	<td>DOB</td>
	<td><input type="text" style="width:160px;" name="dob" id="dob" readonly="readonly" value="<?php list($y,$m,$d) = explode('-',$users->dob);echo $d.'/'.$m.'/'.$y;?>"/></td>
</tr>
<tr>
	<td>Address</td>
	<td><textarea name="address" id="address" readonly="readonly"><?php echo $users->address;?></textarea></td>
</tr>
<tr>
	<td>Country</td>
	<td><select name="country" id="country" style="width:180px;">
		<option value="">--select country--</option>
		<?php foreach($country as $cont){?>
		<option value="<?php echo $cont->country_id;?>" <?php if($cont->country_id == $users->country){?> selected="selected"<?php }?>><?php echo $cont->name;?></option>
		<?php }?>
		</select></td>
</tr>
<tr>
	<td>City</td>
	<td><input type="text" style="width:180px;" name="city" id="city" readonly="readonly" value="<?php echo $users->city;?>"/></td>
</tr>
<tr>
	<td>PostalCode</td>
	<td><input type="text" style="width:180px;" name="postalcode" id="postalcode" readonly="readonly" value="<?php echo $users->postal_code;?>"/></td>
</tr>
<tr>
	<td>Email</td>
	<td><input type="text" style="width:180px;" name="email" id="email" readonly="readonly" value="<?php echo $users->email;?>" readonly="readonly" /></td>
</tr>
<tr>
	<td>MobileNumber</td>
	<td><input type="text" style="width:180px;" name="office_no" id="office_no" readonly="readonly" value="<?php echo $users->mobile_no;?>"/></td>
</tr>
<tr>
	<td>OfficeNumber</td>
	<td><input type="text" style="width:180px;" name="mob_phn" id="mob_phn" readonly="readonly" value="<?php echo $users->alternative_no;?>"/></td>
</tr>
<tr>
	<td>Nationality</td>
	<td><input type="text" style="width:180px;" name="nation" id="nation"  readonly="readonly" value="<?php echo $users->nationality;?>"/></td>
</tr>
<?php /*?><tr>
	<td>Commission Id</td>
	<td><select name="comm_id" id="comm_id" style="width:180px;">
		<option value="">--select commision id--</option>
		<?php foreach($commid as $cont){?>
		<option value="<?php echo $cont->commision_id;?>" <?php if($cont->commision_id == $users->commision_id){?> selected="selected"<?php }?>><?php echo $cont->value; if($cont->type==1){?>price<?php }else{?>%<?php }?></option>
		<?php }?>
		</select></td>
</tr><?php */?>
<?php /*?><tr>
<td></td>
<td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/update_btn.png"   name="submit_agent" value="Register"/></td>
 </tr><?php */?>
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