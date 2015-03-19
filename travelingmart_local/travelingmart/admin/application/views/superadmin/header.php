<!DOCTYPE html>
<html lang="en">
<head>
<link href="<?php print WEB_DIR_ADMIN; ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php print WEB_DIR_ADMIN; ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>


	<meta charset="utf-8">
	<title>travelingmart - Administrator</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>

	<style type="text/css">
	</style>
</head>
<body>
<div id="head">

<div id="logo"><a href="<?php echo WEB_URL_ADMIN?>admin/super_dashboard"><img src="<?php echo WEB_DIR_ADMIN;?>images/logo_new.png" /></a></div>
<div id="welcome_part" class="menuthree">Welcome&nbsp; <?php echo $this->session->userdata('super_admin');?> <!--&nbsp;|<a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">&nbsp;Change Password</a> &nbsp;--> &nbsp;<span style="color:#000">|</span> &nbsp; &nbsp;<a href="<?php echo WEB_URL_ADMIN?>admin/super_logout">Log out</a></div>
</div>
<div id="header_part">
	<div class="menu">
		<ul>
			<li style="border-left:1px solid #fff;"> <a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/admin_list">List Admin</a></li>
			

			<li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/add_admin">Add Admin</a>
            		
            </li>
			<?php /*?><li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/admin_access">Giving Access</a>
            	
			</li><?php */?>
			
			<li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/mail_admin">Mail</a></li>
			
			
            <li><a class="hide" href="#" style="width:150px; height:24px; float:left;"></a>
            	
            </li>
           
			 
			
           
           
		</ul>
	</div>
</div><!--header_part-->

</body>
