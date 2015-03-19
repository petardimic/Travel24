<?php $this->view('header');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>travelingmart - Administration</title>
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
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/update_sup/<?php echo $users->user_id?>">

<table width="920" align="center" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td>
  <table align="center" width="920" border="0" cellpadding="5" cellspacing="5" style="border:1px #DCDCDC  solid; padding-right:15px;">
  <div id="inner-pagetit" style="   font-weight:bold; font-size:14px;  background-image:url(<?php echo WEB_URL_ADMIN ?>images/searchbg.jpg); background-repeat:repeat-x; color:#333; padding:7px 0px 7px 10px">Edit Supplier</div>
    
  <tr>
    <td height="10" colspan="2" style="color:#cc1d1d; font-size:14px; font-weight:bold;"> </td>
    </tr>
  <tr>
    <td width="30" style="color:#cc1d1d; font-size:14px; font-weight:bold;">&nbsp;</td>
    <td style="color:#cc1d1d; font-size:14px; font-weight:bold;">Main Company Information</td></tr>
  <tr>
    <td>&nbsp;</td>
  <td>Company/ Group/ Brand Name</td>
  <td width="20" align="center">:</td>
  <td><input type="text" class="field" name="brand" id="brand" value="<?php echo $users->agency_name;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Address</td>
    <td align="center">:</td>
    <td><textarea name="address" id="address" class="field"  ><?php echo $users->address;?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Country</td>
    <td align="center">:</td>
    <td><select name="country" id="country" class="field" style="width:315px;">
      <option value="">--select country--</option>
      <?php foreach($country as $cont){?>
      <option value="<?php echo $cont->country_name;?>" <?php if($cont->country_name == $users->country){?> selected="selected"<?php }?>><?php echo $cont->country_name;?></option>
      <?php }?>
      </select></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>City</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="city" id="city" value="<?php echo $users->city;?>"/></td>
  </tr>
    
  <tr>
    <td>&nbsp;</td>
    <td>Zip / PostalCode</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="postalcode" id="postalcode" value="<?php echo $users->postal_code;?>"/></td>
  </tr>
    
  <tr>
    <td style="color:#cc1d1d; font-size:14px; font-weight:bold;">&nbsp;</td>
    <td style="color:#cc1d1d; font-size:14px; font-weight:bold;">&nbsp;</td>
  </tr>
  <tr>
    <td style="color:#cc1d1d; font-size:14px; font-weight:bold;">&nbsp;</td>
    <td style="color:#cc1d1d; font-size:14px; font-weight:bold;">Main Contact Information</td></tr>
  <tr>
    <td>&nbsp;</td>
    <td>First Name</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="userf_name" id="userf_name" value="<?php echo $users->first_name;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Last Name</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="userl_name" id="userl_name" value="<?php echo $users->last_name;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Position</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="position" id="position" value="<?php echo $users->position;?>"/></td>
  </tr>
    
    
  <tr>
    <td>&nbsp;</td>
    <td>User Name</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="email" id="email" value="<?php echo $users->email;?>" readonly="readonly" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>MobileNumber</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="office_no" id="office_no" value="<?php echo $users->mobile_no;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>OfficeNumber</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="mob_phn" id="mob_phn" value="<?php echo $users->alternative_no;?>"/></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>Nationality</td>
    <td align="center">:</td>
    <td><input type="text" class="field" name="nation" id="nation" value="<?php echo $users->nationality;?>"/></td>
  </tr>
  <?php if($users->user_type_id != 4){?>
  <tr>
    <td>&nbsp;</td>
    <td>Mark-up</td>
    <td align="center">:</td>
    <td><select name="comm_id" id="comm_id" class="field" style="width:315px;">
      <option value="">--select mark--</option>
      <?php foreach($commid as $cont){?>
      <option value="<?php echo $cont->commision_id;?>" <?php if($cont->commision_id == $users->commision_id){?> selected="selected"<?php }?>><?php echo $cont->value; if($cont->type==1){?>price<?php }else{?>%<?php }?></option>
      <?php }?>
      </select></td>
  </tr>
  <?php }else{?>
  <input type="hidden" name="comm_id" id="comm_id" value=""/>
  <?php }?>
  <?php if($users->user_type_id != 4){?>
  <tr>
    <td>&nbsp;</td>
    <td>Commission</td>
    <td align="center">:</td>
    <td><select name="markup" id="markup" class="field" style="width:315px;">
      <option value="">--select marup--</option>
      <option value="0" <?php if($users->markup == 0){?> selected="selected"<?php }?>>0</option>
      <?php foreach($commid as $cont){?>
      <option value="<?php echo $cont->commision_id;?>" <?php if($cont->commision_id == $users->markup){?> selected="selected"<?php }?>><?php echo $cont->value; if($cont->type==1){?>price<?php }else{?>%<?php }?></option>
      <?php }?>
      </select></td>
  </tr>
  <?php }else{?>
  <input type="hidden" name="markup" id="markup" value=""/>
  <?php }?>
  <tr>
    <td></td>
    <td></td>
    <td align="center">&nbsp;</td>
  <td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/update_btn.png"   name="submit_agent" value="Register"/></td>
    </tr>
  </table>
</td>
</tr>
</table>
</form>
<div style="clear:both;"></div>
</div>
<div style="width:940px; margin:0 auto">
<?php $this->view('footer');?>
</div>
</body>
</html>