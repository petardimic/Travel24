<?php $this->view('superadmin/header');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>travelingmart - Super Administration</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>


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
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/insert_admin/">

<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
<table align="left" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #DCDCDC  solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#505e91; font-weight:bold; font-size:14px; color:#fff; padding:7px 0px 7px 10px">Add Admin</div>

<tr><td style="color:#221D61 ; font-size:14px; font-weight:bold;">Main Admin Information</td></tr>
<tr>
<td>User Name</td>
<td width="20" align="center">:</td>
<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="username" id="username" value=""/></td>
</tr>
<tr>
	<td>Password</td>
	<td align="center">:</td>
	<td><input type="password" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="password" id="password" value=""/></td>
</tr>
<tr>
	<td>Country</td>
	<td align="center">:</td>
	<td><select name="country" id="country" style="width:260px; border:1px solid #DCDCDC; padding:3px;">
		<option value="">--select country--</option>
		<?php foreach($country as $cont){?>
		<option value="<?php echo $cont->country_name;?>" ><?php echo $cont->country_name;?></option>
		<?php }?>
		</select></td>
</tr>
<tr>
	<td>City</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="city" id="city" value=""/></td>
</tr>

<tr>
	<td>Zip / PostalCode</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="postalcode" id="postalcode" value=""/></td>
</tr>

<tr><td style="color:#221D61 ; font-size:14px; font-weight:bold;">Main Contact Information</td></tr>
<tr>
	<td>First Name</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="userf_name" id="userf_name" value=""/></td>
</tr>
<tr>
	<td>Last Name</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="userl_name" id="userl_name" value=""/></td>
</tr>
<tr>
	<td>Position</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="position" id="position" value=""/></td>
</tr>


<tr>
	<td>Email Id</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="email" id="email" value="" /></td>
</tr>
<tr>
	<td>MobileNumber</td>
	<td align="center">:</td>
	<td><input type="text"style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="office_no" id="office_no" value=""/></td>
</tr>
<tr>
	<td>OfficeNumber</td>
	<td align="center">:</td>
	<td><input type="text"style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="mob_phn" id="mob_phn" value=""/></td>
</tr>
<tr>
	<td>Nationality</td>
	<td align="center">:</td>
	<td><input type="text" style="width:250px; border:1px solid #DCDCDC; padding:3px;" name="nation" id="nation" value=""/></td>
</tr>

<tr>
  <td></td>
  <td align="center">&nbsp;</td>
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