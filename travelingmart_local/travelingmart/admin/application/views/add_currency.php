<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelingmart</title>
	
</head>

<body>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" >
<div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis" >View Admin</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">Change Password</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details" class="active">Currency</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
			<li style="border:none;"><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">Ip Control</a></li>          
		</ul>
	</div>
<div class="right-wrapper">

   <form name="add_currency" id="add_currency" action="<?php echo WEB_URL_ADMIN?>admin/add_currency_details" method="post">
    <table width="500" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #ccc; border-radius:8px 8px 0px 0px;  background:#fff; margin-top:20px;">
    
    <tr><td colspan="2" style="background:#333333; color:#fff; font-size:20px; text-align:center;height:30px; border-radius:6px 6px 0px 0px;">Add Currency</td></tr>
    <tr><td height="20"></td></tr>
  <tr>
    <td width="129" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Currency Code</td>
    <td width="400" style="padding:5px 0 15px 10px;">
      <input name="currency_code" id="currency_code" type="text"  class="supplier_text291" value="" style="width:200px;"/>
	  
</td>
  </tr>

 <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Currency name</td>
    <td width="400" style="padding:5px 0 15px 10px;">
	<input name="currency_name" id="currency_name" type="text"  class="supplier_text291" value="" style="width:200px;">
     
</td>
  </tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Amount</td>
    <td width="400" style="padding:5px 0 15px 10px;">
     
	   <input name="amount" id="amount" type="text" class="supplier_text291" value="" style="width:200px;" />
</td>
  </tr>
  <tr>
    <td align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">&nbsp;</td>
    <td style="padding:5px 0 15px 10px;">
                  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22">			  
                 <a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
	</td>
  </tr>
 
 </table>  
  </form></div>
</div>

</body>
</html>
