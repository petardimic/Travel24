<?php $this->view('header');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>Travelingmart</title>
<link type="text/css" href="<?php echo WEB_DIR?>css/style.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<style type="text/css">
#container_warpper {
    background: none repeat scroll 0 0 #FFFFFF;
    border-color: #74941D;
    border-left: 3px solid #74941D;
    border-style: solid;
    border-width: 2px 3px 3px;
    height: auto !important;
    margin: auto;
    overflow: hidden;
    width: 1000px;
}
</style>
</head>
<body>
<!--<div id="inner-pagetit">Agent Registration</div>-->
<div class="container_warpper" style="  background: none repeat scroll 0 0 #FFFFFF;
    border-color: #74941D;
    border-left: 3px solid #74941D;
    border-style: solid;
    border-width: 2px 3px 3px;
    height: auto !important;
    margin: auto;
    overflow: hidden;
    width: 1000px;">
<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;  padding-top:65px;">

<tr>
<div class="menu">
		<ul>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/add_subadmin">Add subadmin</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis">View subadmin</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">change password</a></li>
			<?php /*?><li><a href="<?php  print WEB_URL_ADMIN?>/admin/currency_details">Currency</a></li><?php */?>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">IP Control</a></li>          
		</ul>
	</div>
</tr>
</table>
<div style="clear:both;"></div>
</div>
<div style="width:940px; margin:0 auto">
<?php $this->view('footer');?>
</div>
</body>
</html>