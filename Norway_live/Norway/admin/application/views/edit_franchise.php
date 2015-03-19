<?php //$this->view('header');?>
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
.getfields {
    border: 1px solid #D6D6D6;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 14px;
    height: 18px;
    padding: 5px;
    width: 280px;
}
.getfields1 {    border: 1px solid #D6D6D6;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 14px;
    height: 18px;
    padding: 5px;
    width: 280px;
}
</style>
</head>
<body>
<!--<div id="inner-pagetit">Agent Registration</div>-->
<div id="container_warpper" >
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/update_franchise">
<input type="hidden" name="id" value="<?php echo $franchise_edit->id ;?>" />
<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" valign="top"><div id="inner-pagetit" style="background-color:#333333; color:#fff;"><span style="padding-left:10px">Edit Franchise</span></div><span id="info_message" style="margin-left:15px; color:#F00;"><strong>
          <?php if(isset($message)){if($message != ''){ echo $message ;}}?>
        </strong></span></td>
    </tr>
  <tr>
    <td width="700" valign="top"><table align="left" width="700" border="0" cellpadding="5" cellspacing="5" style="border:1px #f6f4f4 solid; padding-right:15px;">
      
      <tr>
        <td></td>
      </tr>
      <tr>
        <td>User Name </td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->username;?>" name="username" readonly="readonly" /></td>
        
      </tr>
      <tr>
        <td>Franchisee </td>
        <td><input class="getfields validate[required,custom[onlyLetterSp]]" type="text" style="width:400px;" value="<?php print $franchise_edit->franchise_name;?>" name="franchise_name" /></td>
       
      </tr>
      <tr>
        <td>Full Name</td>
        <td><input class="getfields validate[required,custom[onlyLetterSp]]" type="text" style="width:400px;" value="<?php print $franchise_edit->agent_name;?>" name="agent_name" /></td>
      </tr>
      <tr>
        <td>Name of the Organization</td>
        <td><input class="getfields validate[required,custom[onlyLetterSp]]" type="text" style="width:400px;" value="<?php print $franchise_edit->org_name ;?>" name="org_name" /></td>
      </tr>
      <tr>
        <td>Nearest Branch</td>
        <td><input class="getfields validate[required,custom[onlyLetterSp]]" type="text" style="width:400px;" value="<?php print $franchise_edit->nearest_bra;?>" name="nearest_bra" /></td>
      </tr>
      <tr>
        <td>Mobile No</td>
        <td><input class="getfields validate[required,custom[onlyNumberSp]]" type="text" style="width:400px;" value="<?php print $franchise_edit->mobile_no;?>" name="mobile_no" /></td>
      </tr>
      <tr>
        <td>Land Line</td>
        <td><input class="getfields validate[required,custom[onlyLetterSp]]" type="text" style="width:400px;" value="<?php print $franchise_edit->land_line;?>" name="land_line" /></td>
      </tr>
      <tr>
        <td>Fax</td>
        <td><input class="getfields validate[required,custom[email]]" type="text" style="width:400px;" value="<?php print $franchise_edit->fax;?>" name="fax" /></td>
      </tr>
      <tr>
        <td>Website Address</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->website_add;?>" name="website_add" /></td>
      </tr>
      <tr>
        <td>Other Details</td>
        <td><textarea name="other_det"  class="getfields validate[required]" id="other_det"><?php print $franchise_edit->other_det;?></textarea></td>
      </tr>
      <tr>
        <td>Official Address</td>
        <td><textarea name="off_add"  class="getfields validate[required]" id="other_det" value=""><?php print $franchise_edit->off_add;?></textarea></td>
      </tr>
      <tr>
        <td>Country</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->country;?>" name="country" /></td>
      </tr>
      <tr>
        <td>Bank Name</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->bank_name;?>" name="bank_name" /></td>
      </tr>
      <tr>
        <td>Bank Account No</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->bank_acc;?>" name="bank_acc" /></td>
      </tr>
      <tr>
        <td>Pan No</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->pan_no;?>" name="pan_no" /></td>
      </tr>
      <tr>
        <td>Name of the Pancard Holder</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->pan_name;?>" name="pan_name" /></td>
      </tr>
      <tr>
        <td>Service Tax Reg. No </td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->service_tax;?>" name="service_tax" /></td>
      </tr>
      <tr>
        <td>Details</td>
        <td><textarea name="details"  class="getfields validate[required]" id="other_det" value=""><?php print $franchise_edit->details;?></textarea></td>
      </tr>
      <tr>
        <td>GDS</td>
        <td><input class="getfields validate[required]" type="text" style="width:400px;" value="<?php print $franchise_edit->gds;?>" name="gds" /></td>
      </tr>
      <tr>
        <td>Preferred Currency</td>
        <td><select id="ddlShowPriceCurrency" class="putclassdropdown" style="width:213px;" name="currency">
          <option value="AED" <?php if($franchise_edit->currency=="AED"){?> selected="selected"<?php }?>>AED - United Arab Emirates Dirham</option>
          <option value="AUD" <?php if($franchise_edit->currency=="AUD"){?> selected="selected"<?php }?>>AUD - Australia Dollars</option>
          <option value="BHD" <?php if($franchise_edit->currency=="BHD"){?> selected="selected"<?php }?>>BHD - Bahraini Dinar</option>
          <option value="EUR" <?php if($franchise_edit->currency=="EUR"){?> selected="selected"<?php }?>>EUR - Euro</option>
          <option value="GBP"<?php if($franchise_edit->currency=="GBP"){?> selected="selected"<?php }?>>GBP - Great British Pound</option>
          <option value="INR"<?php if($franchise_edit->currency=="INR"){?> selected="selected"<?php }?>>INR - Indian Rupees</option>
          <option value="KWD"<?php if($franchise_edit->currency=="KWD"){?> selected="selected"<?php }?>>KWD - Kuwaiti Dinar</option>
          <option value="SAR"<?php if($franchise_edit->currency=="SAR"){?> selected="selected"<?php }?>>SAR - Saudi Arabian Riyal</option>
          <option value="SGD"<?php if($franchise_edit->currency=="SGD"){?> selected="selected"<?php }?>>SGD - Singapore Dollar</option>
          <option value="THB"<?php if($franchise_edit->currency=="THB"){?> selected="selected"<?php }?>>THB - Thai Baht</option>
          <option value="USD"<?php if($franchise_edit->currency=="USD"){?> selected="selected"<?php }?>>USD - United States Dollars</option>
        </select></td>
      </tr>
      <tr>
        <td></td>
        <td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/update_btn.png"   name="submit_agent" value="Register"/></td>
      </tr>
    </table></td>
    <td width="20" valign="top">&nbsp;</td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><a href="#<?php /*?><?php echo WEB_URL_ADMIN?>admin/view_franchise_bookings/<?php echo $franchise_edit->id?><?php */?>"><img src="<?php echo WEB_DIR_ADMIN?>images/view_booking.png"   style="padding-right:50px;" /></a></td>
      </tr>
      <tr>
        <td><a href="<?php echo WEB_URL_ADMIN?>admin/view_account_summary/<?php echo $franchise_edit->id;?>"><img src="<?php echo WEB_DIR_ADMIN?>images/account_summary.png"   style="padding-right:50px;" /></a></td>
      </tr>
      <tr>
        <td height="40" align="left" valign="middle" style="font-weight:bold; font-size:14px;">&nbsp;&nbsp;Franchisee Logo</td>
      </tr>
      <tr>
        <td><img src="<?php echo WEB_DIR?>agentlogo/<?php print $franchise_edit->brand_logo;?>" height="180" width="180"  /></td>
      </tr>
    </table></td>
  </tr>
</table></td>
<td valign="top">

</td></tr>
</table>
</form>
<div style="clear:both;"></div>
</div>
<div style="width:940px; margin:0 auto">
<?php //$this->view('footer');?>
</div>
</body>
</html>
<script>
  setTimeout(function(){
    document.getElementById('info_message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 3000);
</script>