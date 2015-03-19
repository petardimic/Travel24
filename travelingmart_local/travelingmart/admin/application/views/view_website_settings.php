<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>travelingmart - Administration</title>
	
</head>

<body>
<?php $this->load->view('header'); ?>

<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px;" >
<div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup" style="text-decoration:none;">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd" style="text-decoration:none;">Change Password</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings" class="active" style="text-decoration:none;">Website Settings</a></li>
            
		</ul>
	</div>
 <?php 
if(isset($websetting_details)){
     if($websetting_details != ''){
		 foreach($websetting_details as $details){
?>
   <form name="add_suuplier_details" id="add_suuplier_details" action="<?php echo WEB_URL_ADMIN ?>admin/website_settings_update" method="post">
  <input type="hidden" name="web_id" value="<?php echo $details->setting_id; ?>" />
    <table width="76%" border="0" height="auto;" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #ccc; border-radius:8px 8px 0px 0px; margin-top:20px; background:#fff;">
    
<tr>
</tr>
    <tr><td colspan="2" style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; font-size:18px; text-align:center; height:35px; border-radius:6px 6px 0px 0px;">Website Settings</td></tr>
    <tr><td height="20"></td></tr>
  <tr>
    <td width="167" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Name </td>
    <td width="331" style="padding:5px 0 15px 10px;">
      <input name="name" id="name" type="text"  class="supplier_text291" value="<?php echo $details->name;?>" style="width:200px;"/>
	  
</td>
  </tr>
  <tr>
    <td width="167" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Company Name</td>
    <td width="331" style="padding:5px 0 15px 10px;">
	<input type="text" name="company_name" id="testinput" class="txtu" style="width:200px;" value="<?php echo $details->company_name;?>"/>
		
     
</td>
  </tr>
 

 <tr>
    <td width="167" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Website URL</td>
    <td width="331" style="padding:5px 0 15px 10px;">
	<input name="web_url" id="web_url" type="text"  class="supplier_text291" value="<?php echo $details->website_url;?>" style="width:200px;">
     
</td>
  </tr>
  <tr>
    <td width="167" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Email ID</td>
    <td width="331" style="padding:5px 0 15px 10px;">
     
	   <input name="email_id" id="email_id" type="text" class="supplier_text291" value="<?php echo $details->email_id;?>" style="width:200px;"/>
</td>
  </tr>
 <tr>
    <td width="167" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Contact No</td>
    <td width="331" style="padding:5px 0 15px 10px;">
	<input name="contact_no" id="contact_no" type="text" class="supplier_text291" value="<?php echo $details->contact_no;?>" style="width:200px;"/>     
	</td>
  </tr>
 <tr>
   <td width="167" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Address</td>
   <td width="331" style="padding:5px 0 15px 10px;">
	<textarea name="address" cols="23" rows="5"><?php echo $details->address;?></textarea>
	</td>
</tr>
  <?php /*?><tr>
    <td width="167" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Default Currency</td>
    <td width="331" style="padding:5px 0 15px 10px;">
	<select name="fixed_amount" type="text" class="supplier_text291" style="width:200px;">
    <?php foreach($currency_types as $row){?>
    <option value="<?php echo $row->currency_id?>"<?php if($row->currency_id == $details->fixed_amount){?> selected="selected"<?php }?>><?php echo $row->currency?></option>
    <?php }?>
    </select>
     
</td>
  </tr><?php */?>
  
   <tr>
    <td align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">&nbsp;</td>
    <td style="padding:5px 0 15px 10px;">
                  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="60" height="36">			  
                <a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="60" height="36" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
	</td>
  </tr>
 
 </table>  
  </form>
  <?php } } } ?>
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>
