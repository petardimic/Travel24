<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>travelingmart - Super Administration</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
	<style type="text/css">
	</style>
</head>
<body>
<?php $this->load->view('superadmin/header'); ?>

<div id="container_warpper">
  <table width="1000" style=" float:left; margin-left:0px; margin-top:50px; margin-bottom:10px;">
  
  <tr>
    <td height="20" align="left"><a href="<?php echo WEB_URL_ADMIN?>admin/admin_list"><img src="<?php echo WEB_DIR_ADMIN?>/images/User_Management.png" border="0" /></a></td>
    <?php /*?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/markup1"><img src="<?php echo WEB_DIR_ADMIN?>/images/Markup_Management.png" border="0" /></a></td>
    <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/member_credit_limit"><img src="<?php echo WEB_DIR_ADMIN?>/images/Member_Credit_Limit.png" border="0" /></a></td>
    <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/member_credit_det"><img src="<?php echo WEB_DIR_ADMIN?>/images/Member_Credit_Limit_Details.png" border="0" /></a></td>
    <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd"><img src="<?php echo WEB_DIR_ADMIN?>/images/Change_Password.png" border="0" /></a></td><?php */?>
  </tr>
    

  </table>
  <div class="clr"></div>
</div>
<!--footer-->
<?php $this->load->view('footer'); ?>
    <!--footer end-->
</body>
</html>
