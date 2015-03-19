<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Travelingmart</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
	
</head>
<body>
<?php $this->load->view('header'); ?>
<?php /*?><?php echo "<pre>"; print_r($msg);?><?php */?>



<div id="container_warpper">
<div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup" style="text-decoration:none;">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd" class="active" style="text-decoration:none;">Change Password</a></li>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings" style="text-decoration:none;">Website Settings</a></li>
 
     
		</ul>
	</div>
<?php if(isset($msg)){ if($msg!=''){ echo $msg;}}?>
<div class="right-wrapper" style="width:760px; margin-left:20px; ">
	<form method="post" name="change_password" id="change_password" action="<?PHP echo WEB_URL_ADMIN?>admin/password_check">
	<table width="100%" align="center" style="border:1px solid #ccc; border-radius:6px 6px 0px 0px;  margin-top:20px; background:#fff;">
	 <tr><td colspan="3" style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; font-size:18px; text-align:center; height:35px; border-radius:6px 6px 0px 0px;">Change Password</td></tr>
    <tr><td width="43%" height="20"></td></tr>
    <tr>
	<td align="right">Current Password:</td>
	<td width="1%">&nbsp;</td>
	<td width="56%"><input type="password" name="current_pwd" id="current_pwd" class="field"/></td></tr>
    <tr align="right"><td height="10"></td></tr>
	<tr>
	<td align="right">New Password:</td>
	<td>&nbsp;</td>
	<td><input type="password" name="new_pwd" id="new_pwd" class="field"/></td>
	</tr>
	<tr align="right"><td height="10"></td></tr>
	<tr>
	<td align="right">Reenter Password:</td>
	<td>&nbsp;</td>
	<td><input type="password" name="reenter_pwd" id="reenter_pwd" class="field"/></td>
	</tr>
    <tr align="right"><td height="10"></td></tr>
	<tr>
	<td>
	  </td>
	<td>&nbsp;</td>
	<td>
    <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" >
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png"   border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
	<tr>
	  <td></td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  </tr>
	</table>
	</form>
    </div>
	<!--<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>-->
 
</div>

</body>
</html>