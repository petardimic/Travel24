<!DOCTYPE html>
<html lang="en">
<head>
<link href="<?php print WEB_DIR_ADMIN; ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php print WEB_DIR_ADMIN; ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>


	<meta charset="utf-8">
	<title>entevour - Administrator</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>

	<style type="text/css">
	</style>
</head>
<body>
<div id="head">
<?php 	$admin_id = $this->session->userdata('admin_id');
		$access = $this->Home_Model->access_details($admin_id); ?>
<div id="logo"><a href="<?php echo WEB_URL_ADMIN?>admin/admin_dashboard"><img src="<?php echo WEB_DIR_ADMIN;?>images/logo_new.png" /></a></div>
<div id="welcome_part" class="menuthree">Welcome&nbsp; <?php echo $this->session->userdata('admin');?> &nbsp;|<a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">&nbsp;&nbsp;Change Password</a> &nbsp; &nbsp;<span style="color:#000">|</span> &nbsp; &nbsp;<a href="<?php echo WEB_URL_ADMIN?>admin/logout">Log out</a></div>
</div>
<div id="header_part">
	<div class="menu" style="margin-top:22px;">
		<ul>
			<li style="border-left:1px solid #fff;"> <a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/admin_dashboard">Home</a></li>
			<?php /*?><li><a class="hide" href="">Users</a>
				<ul>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/add_user_type">Add User Type</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Users</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_users">View Users</a></li>
				</ul>
			</li><?php */?>
			<?php /*?><li><a class="hide" href="">Agent</a>
				<ul>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Agent</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_agents">View Agents</a></li>
				</ul>
			</li><?php */?>
          <?php if(isset($access)) { if($access->supplier != '0') { ?> <li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/view_suppliers">Supplier</a> <?php } } ?>
            		<ul>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/add_supplier">Add Supplier</a></li>
					<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_suppliers">View Suppliers</a></li>
				</ul>
            </li>
			<?php if(isset($access)) { if($access->b2c_report != '0') { ?><li><a class="hide" href="#">Reports</a>
            	<ul>
                    <li><a href="<?php echo WEB_URL_ADMIN?>admin/reports">B2C Reports</a></li>
                    <li><a href="<?php  print WEB_URL_ADMIN?>admin/agent_reports">B2B Reports</a></li>
                </ul>
<?php /*?>            <li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/bookings">Booking Details</a><?php */?>
			</li> <?php } } ?>
			
			<?php if(isset($access)) { if($access->markup != '0') { ?> <li><a class="hide" href="<?php echo WEB_URL_ADMIN?>admin/markup">Maintenance</a></li> <?php } } ?>
			<?php /*?><ul>
				<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">MarkUp</a></li>
				<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details">Currency</a></li>
                <li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
				<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">IpControl</a></li>
			</ul><?php */?>
			
           <?php if(isset($access)) { if($access->banner_images != '0') { ?>  <li><a class="hide" href="#" style="width:113px; height:24px; float:left;">Home Page Images</a>
            	<ul>
					<li style="width:116px;"><a href="<?php echo WEB_URL_ADMIN?>admin/add_banner">Add Banner</a></li>
					<li style="width:116px;"><a href="<?php echo WEB_URL_ADMIN?>admin/banner_images">Banner images</a></li>
					<?php /*?><li style="width:116px;"><a href="<?php echo WEB_URL_ADMIN?>admin/bottom_right">Bottom Images</a></li><?php */?>
				</ul>
            </li> <?php } } ?>
            
           <?php if(isset($access)) { if($access->mail_agent != '0') { ?><li><a class="hide" href="<?php print WEB_URL_ADMIN ?>admin/mail_agent" style="width:113px; height:24px; float:left;">Mail to Agents</a></li> <?php } } ?>
           
           <?php if(isset($access)) { if($access->lbs_flight != '0') { ?><li><a class="hide" href="<?php print WEB_URL_ADMIN ?>admin/mail_agent" style="width:113px; height:24px; float:left;">LBS Flight</a></li> <?php } } ?>
           
			 
			
           
           
		</ul>
	</div>
</div><!--header_part-->

</body>
