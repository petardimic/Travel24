<!DOCTYPE html>
<html lang="en">
<head>
<link href="<?php print WEB_DIR_ADMIN; ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php print WEB_DIR_ADMIN; ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>


	<meta charset="utf-8">
	<title>Travelingmart - Administrator</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
	<style type="text/css">
	</style>
</head>
<body>
<div id="head" style="padding-bottom:8px;">
<div id="logo"><img src="<?php echo WEB_DIR_ADMIN;?>images/logo_new.png" /></div>
<div id="welcome_part" class="menuthree" style="padding-top:5px;">Welcome <?php echo $this->session->userdata('admin');?> |<a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">Change Password</a> &nbsp; &nbsp;<span style="color:#000">|</span> &nbsp; &nbsp;<a href="<?php echo WEB_URL_ADMIN?>admin/logout">Log out</a></div>
</div>
<div id="header_part">
	<div class="menu">
		<ul>
			<li style="border-left:1px solid #fff;"> <a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/admin_dashboard">Home</a></li>
			
			<li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/customer_details">Customer</a></li>
			<li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/bookings">Booking Details</a>
			</li>
			
			<li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis">Maintenance</a>
			<?php /*?><ul>
				<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">MarkUp</a></li>
				<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details">Currency</a></li>
                <li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
				<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">IpControl</a></li>
			</ul><?php */?>
			</li>
            <li><a class="hide" href="">Users</a>
				<ul>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/add_user_type">Add User Type</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Users</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_users">View Users</a></li>
				</ul>
			</li>
			<li><a class="hide" href="">Agent</a>
				<ul>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Agent</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_agents">View Agents</a></li>
				</ul>
			</li>
           <!-- <li><a class="hide" href="#">NewsLetter</a>-->
		
			</li>
           
           
		</ul>
	</div>
</div><!--header_part-->

</body>
