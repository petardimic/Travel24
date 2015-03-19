<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>travelingmart - Super Administration</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>


</head>
<body>
<!--<div id="inner-pagetit">Agent Registration</div>-->
<div id="container_warpper" >
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/insert_admin_access/">

<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
<table align="left" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #DCDCDC  solid; padding-right:15px;">
<div id="inner-pagetit" style="background-color:#505e91; font-weight:bold; font-size:14px; color:#fff; padding:7px 0px 7px 10px">Update Admin Access</div>

<tr><td style="color:#221D61 ; font-size:14px; font-weight:bold;">Select Admin and Give Access</td></tr>
<tr>
<td>Select Admin</td>
<td width="20" align="center">:</td>
<td><select name="admin_id" id="admin_id" style="width:260px; border:1px solid #DCDCDC; padding:3px;">
        <?php if(isset($users)) { if($users != '') {  ?>
        	<option value="<?php echo $users->admin_id; ?>" ><?php echo $users->first_name." ".$users->last_name; ?></option>
           <?php  } } ?>
		</select></td>
</tr>
<tr>
	<td>Add the Access Details</td>
	<td align="center">:</td>
	<td>
    <input type="checkbox"  name="supplier" id="supplier" value="1" <?php if($access_det->supplier == '1') { echo "checked"; } ?> />Supplier Section &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="slider_image" id="slider_image" value="1" <?php if($access_det->slider_image == '1') { echo "checked"; } ?>/>Slider Image 
    <br  /><br /><input type="checkbox"  name="agent" id="agent" value="1" <?php if($access_det->agent == '1') { echo "checked"; } ?>/>Agent Section &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="holidays" id="holidays" value="1" <?php if($access_det->holidays == '1') { echo "checked"; } ?>/>Holidays Section 
    
    <br  /><br /><input type="checkbox"  name="Markup" id="Markup" value="1"<?php if($access_det->markup == '1') { echo "checked"; } ?> />Markup Section &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="member_credit" id="member_credit" value="1" <?php if($access_det->member_credit == '1') { echo "checked"; } ?>/>Member Credit Limit
    
    <br  /><br /><input type="checkbox"  name="changepassword" id="changepassword" value="1" <?php if($access_det->changepassword == '1') { echo "checked"; } ?>/>Change Pasword &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="offlinebus" id="offlinebus" value="1" <?php if($access_det->offlinebus == '1') { echo "checked"; } ?>/>Offline Bus Management
    
     <br  /><br /><input type="checkbox"  name="offlineflight" id="offlineflight" value="1" <?php if($access_det->offlineflight == '1') { echo "checked"; } ?>/>Offline Flight &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="offlineoffer" id="offlineoffer" value="1" <?php if($access_det->offlineoffer == '1') { echo "checked"; } ?>/>Offline Offer Management
     <br  /><br /><input type="checkbox"  name="offlinehotel" id="offlinehotel" value="1" <?php if($access_det->offlinehotel == '1') { echo "checked"; } ?>/>Offline Hotel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="checkbox"  name="offlineholiday" id="offlineholiday" value="1" <?php if($access_det->offlineholiday == '1') { echo "checked"; } ?>/>Offline Holiday Management
     
     <br  /><br /><input type="checkbox"  name="news_management" id="news_management" value="1" <?php if($access_det->news_management == '1') { echo "checked"; } ?>/>News Management <input type="checkbox"  name="imagemanagement" id="imagemanagement" value="1" <?php if($access_det->imagemanagement == '1') { echo "checked"; } ?> />Image Management
      <br  /><br /><input type="checkbox"  name="B2C_report" id="B2C_report" value="1" <?php if($access_det->b2c_report == '1') { echo "checked"; } ?>/>B2C Report &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp; <input type="checkbox"  name="B2B_report" id="B2B_report" value="1" <?php if($access_det->b2b_report == '1') { echo "checked"; } ?>/>B2B Report
      
      <br  /><br /><input type="checkbox"  name="service_managemnt" id="service_managemnt" value="1" <?php if($access_det->service_managemnt == '1') { echo "checked"; } ?>/>Service Managemnt <input type="checkbox"  name="page_management" id="page_management" value="1" <?php if($access_det->page_management == '1') { echo "checked"; } ?>/>Page Management
      
        <br  /><br /><input type="checkbox"  name="user_managemnt" id="user_managemnt" value="1" <?php if($access_det->usermanagement == '1') { echo "checked"; } ?>/>User Management  &nbsp;&nbsp;<input type="checkbox"  name="banner_images" id="banner_images" value="1" <?php if($access_det->banner_images == '1') { echo "checked"; } ?> />Banner Images
        
         <br  /><br /><input type="checkbox"  name="mail_agent" id="mail_agent" value="1" <?php if($access_det->mail_agent == '1') { echo "checked"; } ?> />Mail to Agents
         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <input type="checkbox"  name="lbs_flight" id="lbs_flight" value="1" <?php if($access_det->lbs_flight == '1') { echo "checked"; } ?> />LBS flight
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