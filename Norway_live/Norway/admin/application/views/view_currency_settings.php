<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelingmart</title>
	
</head>

<body>
<?php $this->load->view('header'); ?>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px;" >
<div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis" >View Admin</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">Change Password</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details" class="active">Currency</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
			<li ><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">Ip Control</a></li>  
             <li style="border:none;"><a href="<?php  print WEB_URL_ADMIN?>admin/payment">Payment Gateway</a></li>            
		</ul>
	</div>
  <div style="margin:auto; width:700px; height:auto; overflow:hidden;">
  <div style="width:900px; height:20px; margin-left:20px; margin-top:20px;">
  <span style="color:#000; background:#EFA146; width:150px; float:left; text-align:center; ">Currency Details</span>
  </div>
  <div style="width:678px; height:auto; overflow:hidden; border:solid 1px #ccc; margin-left:20px;">
  
  <table style="width:600px; padding:15px;">
  <tr>
<td style="color:#a64003; font-size:14px;">Note :- Below currency denotes for <?php if($default_currency!=''){echo $default_currency->currency;}?></td>
<td></td>
 <td colspan="2" class="add"><a href="<?php echo WEB_URL_ADMIN?>admin/add_currecny" >Add Currency</a></td></tr>
 
  <tr style="background-color:#333; border:solid 1px #ccc; color:#fff; font-size:14px; text-align:center;">
    <td>Currency </td>
    <td>Actual Rate</td>
    <td colspan="2"></td>
  </tr>
   <?php $i=1; if(isset($currency_list)){ if($currency_list != '') { 
foreach ($currency_list as $row){
	if($row->currency != $default_currency->currency)
	{
	 ?>
<input name="currency_id" value="<?php print $row->currency_id; ?>" class="user_fld_box-fld-2" type="hidden" />
  <tr style="text-align:center;">
    <td style="border:solid 1px #ccc;"><?php print $row->currency; ?></td>
    <td style="border:solid 1px #ccc;"><input name="value" type="text" style="width:100px;" value="<?php print $row->currency_value; ?>" />&nbsp;%</td>
    <td style="border:solid 1px #ccc;"><a href="<?php print WEB_URL_ADMIN?>admin/edit_currency/<?php echo $row->currency_id?>"><input type="image"  title="edit  click to update value" src="<?php print WEB_DIR_ADMIN?>images/edit_icon.jpg"/></a></td>
    <td style="border:solid 1px #ccc;"><a href="<?php print WEB_URL_ADMIN?>admin/delete_currency_details/<?php echo $row->currency_id?>">
      <input type="image" title="delete the currency" src="<?php print WEB_DIR_ADMIN?>images/delete1.png" onclick="return confirm('Are you sure want to delete this currency?')"/>
    </a></td>
    
  </tr>
  <?php $i++; }}}} ?>	
  
  
  </table>
  
  </div>
  
  </div>
  
  
  
  
  
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>
