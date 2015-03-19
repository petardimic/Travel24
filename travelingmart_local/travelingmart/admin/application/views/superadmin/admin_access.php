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
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/insert_admin_access/">

<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
<table align="left" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #DCDCDC  solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#505e91; font-weight:bold; font-size:14px; color:#fff; padding:7px 0px 7px 10px">Add Admin Admin</div>

<tr><td style="color:#221D61 ; font-size:14px; font-weight:bold;">Select Admin and Give Access</td></tr>
<tr>
<td>Select Admin</td>
<td width="20" align="center">:</td>
<td><select name="admin_id" id="admin_id" style="width:260px; border:1px solid #DCDCDC; padding:3px;">
		<option value="">Select Admin</option>
        <?php if(isset($users)) { if($users != '') { foreach($users as $rw) { ?>
        	<option value="<?php echo $rw->admin_id; ?>"><?php echo $rw->first_name." ".$rw->last_name; ?></option>
           <?php } } } ?>
		</select></td>
</tr>
<tr>
	<td>Add the Access Details</td>
	<td align="center">:</td>
	<td>
    <input type="checkbox"  name="supplier" id="supplier" value="1"/>Supplier Section &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="slider_image" id="slider_image" value="1"/>Slider Image <br  /><br /><input type="checkbox"  name="agent" id="agent" value="1"/>Agent Section &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="holidays" id="holidays" value="1"/>Holidays Section 
    <br  /><br /><input type="checkbox"  name="Markup" id="Markup" value="1"/>Markup Section &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="member_credit" id="member_credit" value="1"/>Member Credit Limit
    
    <br  /><br /><input type="checkbox"  name="changepassword" id="changepassword" value="1"/>Change Pasword &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="offlinebus" id="offlinebus" value="1"/>Offline Bus Management
    
     <br  /><br /><input type="checkbox"  name="offlineflight" id="offlineflight" value="1"/>Offline Flight &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="offlineoffer" id="offlineoffer" value="1"/>Offline Offer Management
     <br  /><br /><input type="checkbox"  name="offlinehotel" id="offlinehotel" value="1"/>Offline Hotel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="offlineholiday" id="offlineholiday" value="1"/>Offline Holiday Management
     
     <br  /><br /><input type="checkbox"  name="news_management" id="news_management" value="1"/>News Management <input type="checkbox"  name="imagemanagement" id="imagemanagement" value="1"/>Image Management
      <br  /><br /><input type="checkbox"  name="B2C_report" id="B2C_report" value="1"/>B2C Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input type="checkbox"  name="B2B_report" id="B2B_report" value="1"/>B2B Report
      
      <br  /><br /><input type="checkbox"  name="service_managemnt" id="service_managemnt" value="1"/>Service Managemnt <input type="checkbox"  name="page_management" id="page_management" value="1"/>Page Management
      <br  /><br /><input type="checkbox"  name="user_managemnt" id="user_managemnt" value="1"/>User Management  &nbsp;&nbsp;<input type="checkbox"  name="B2B_report" id="B2B_report" value="1"/>Banner Images  
      
      <br  /><br /><input type="checkbox"  name="mail_agent" id="mail_agent" value="1"/>Mail to Agents &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox"  name="lbs_flight" id="lbs_flight" value="1"/>LBS flight
    </td>
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