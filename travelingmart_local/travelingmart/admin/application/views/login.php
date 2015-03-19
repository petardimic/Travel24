<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>travelingmart - Administration</title>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript">
function check()
{
	var alphaExp=/^[aa-zA-Z\.]+$/;
	if(document.getElementById('username_admin').value=="")
	{
		alert('User Name field should not be empty');
		document.getElementById('username_admin').focus();
		return false;
	}
	else if(!document.getElementById('username_admin').value.match(alphaExp))
	{
		alert('User Name should contins only characters');
		document.getElementById('username_admin').value = '';
		document.getElementById('username_admin').focus();
		return false;
	}
//	alert('anand');
	//return false;
}
</script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
	<style type="text/css">
	body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}
    </style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body style=" background-color:#e6e6e6; background-image:url(<?php echo WEB_DIR_ADMIN?>images/bg.jpg); background-position:center top; background-repeat:no-repeat; border-top:10px #e52323 solid;  !important;">

<div id="container_warpper" >

<div id="login_part">
	<div style="float:left; width:182px; padding-left:110px; padding-top:35px; color:#e52323; font-size:18px; font-weight:bold; margin-bottom: 22px;">Administrator <span style="color:#494949;">Login</span></div>
	<div style="float:left; width:150px; padding-top:23px; padding-left:12px;"><!--<img src="<?php echo WEB_DIR_ADMIN;?>images/logo_news.png" />--></div>
    <div style="clear:both; border-bottom:1px solid #fff; width:329px; margin-left:88px; "></div>
	<form method="post" name="admin_login" id="admin_login" action="<?PHP echo WEB_URL_ADMIN?>admin/admin_login_check" onSubmit="return check();">
	<div style="margin-left:118px; width:280px; margin-top:0px;">
    <div><?php if(isset($error)){ if($error != ''){ echo $error; } } ?></div>
	<div style="color:#676767;">Username:</div>
	<div><input type="text" name="username_admin" id="username_admin" style="width:260px; height:28px; background-color:transparent; border:none; outline:none; margin-top:5px;"/></div>
   
	<div style="padding-top:8px; color:#676767; margin-top:3px;">Password:</div>
	<div><input type="password" name="password_admin" id="password_admin"  style="width:260px; height:26px; background-color:transparent; border:none; outline:none; padding-top:8px;"/></div>
	<div style="margin-top:10px; outline:none;">
	  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png"  >
	
    <img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png"  style="cursor:pointer;" onClick="javascript:history.back(-1);">
	</div>
    </div>
	</form>
	<!--<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>-->
    </div>
</div>
<div style="background-color:#e52323; float:left; height:10px; width:100%; position:fixed;  bottom: 0; clear: both;"></div>
</body>
</html>
