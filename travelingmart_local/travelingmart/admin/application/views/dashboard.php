<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>travelingmart - Administration</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
	<style type="text/css">
	</style>
</head>
<body>
<?php $this->load->view('header'); ?>

<div id="container_warpper">
  <table width="1000" style=" float:left; margin-left:0px; margin-top:50px; margin-bottom:10px;">
  <tr>
    <?php if(isset($access)) { if($access->supplier != '0') { ?><td align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/view_suppliers"><img src="<?php echo WEB_DIR_ADMIN?>/images/Supplier-details.png" border="0" /></a></td><?php } } ?>
  <?php /*?>  <?php if(isset($access)) { if($access->slider_image != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/banner_images"><img src="<?php echo WEB_DIR_ADMIN?>/images/sliderimage.png" border="0" /></a></td><?php } } ?><?php */?>
      <?php if(isset($access)) { if($access->b2c_report != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/reports"><img src="<?php echo WEB_DIR_ADMIN?>/images/B2CBookingreport.png" border="0" /></a></td> <?php } } ?>
   <?php if(isset($access)) { if($access->b2c_report != '0') { ?> <td align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/reports"><img src="<?php echo WEB_DIR_ADMIN?>/images/reports.jpg" border="0" /></a></td><?php } } ?>
   <?php /*?> <?php if(isset($access)) { if($access->agent != '0') { ?> <td align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/view_agents"></a><a href="<?php echo WEB_URL_ADMIN?>admin/view_agent_details"><img src="<?php echo WEB_DIR_ADMIN?>/images/deposit.png" border="0" /></a></td><?php } } ?><?php */?>
    
    
   <?php if(isset($access)) { if($access->usermanagement != '0') { ?>  <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/customer_details"><img src="<?php echo WEB_DIR_ADMIN?>/images/User_Management.png" border="0" /></a></td> <?php } } ?>
   <?php if(isset($access)) { if($access->page_management != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/pagemanament"><img src="<?php echo WEB_DIR_ADMIN?>/images/page_management.png" border="0" /></a></td> <?php } } ?>
    <?php /*?><td width="262" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/view_agents"></a><a href="<?php echo WEB_URL_ADMIN?>admin/customer_details"><img src="<?php echo WEB_DIR_ADMIN?>/images/deposit.png" border="0" /></a></td>
    <td width="51" align="center"></td><?php */?>
<?php /*?>    <a href="<?php echo WEB_URL_ADMIN?>admin/featured_dest"><?php */?>
     <?php /*?><td width="262" align="center"><a href="#"><img src="<?php echo WEB_DIR_ADMIN?>/images/Feature_Destination.png" border="0" /></a></td>
    <td width="51" align="center"></td>
    <td width="307" align="center"><a href="#"><img src="<?php echo WEB_DIR_ADMIN?>/images/Popular_Destinations.png" border="0" /></a></td><?php */?>
<?php /*?>    <a href="<?php echo WEB_URL_ADMIN?>admin/popular_dest"><?php */?>
    </tr>
  <tr>
    <td height="20" align="center"></td>
     <td height="20" align="center"></td>
       <td height="20" align="center"></td>
        <td height="20" align="center"></td>
         <td height="20" align="center"></td>
        
    </tr>
  <tr>
    <?php /*?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/slider_images"><img src="<?php echo WEB_DIR_ADMIN?>/images/sliderimage.png" border="0" /></a></td><?php */?>
      <?php if(isset($access)) { if($access->offlineoffer != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/offline_offer"><img src="<?php echo WEB_DIR_ADMIN?>/images/Offline_Offer.png" border="0" /></a></td> <?php } } ?>
    <?php if(isset($access)) { if($access->offlineflight != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/offline_flight"><img src="<?php echo WEB_DIR_ADMIN?>/images/Offline_Flight_Management.png" border="0" /></a></td> <?php } } ?>
    <?php if(isset($access)) { if($access->offlinehotel != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/offline_hotel"><img src="<?php echo WEB_DIR_ADMIN?>/images/Offline_Hotel_Management.png" border="0" /></a></td> <?php } } ?>
    <?php if(isset($access)) { if($access->markup != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/markup1"><img src="<?php echo WEB_DIR_ADMIN?>/images/Markup_Management.png" border="0" /></a></td><?php } } ?>
    <?php /*?> <?php if(isset($access)) { if($access->member_credit != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/member_credit_limit"><img src="<?php echo WEB_DIR_ADMIN?>/images/Member_Credit_Limit.png" border="0" /></a></td> <?php } } ?>
    <?php if(isset($access)) { if($access->member_credit != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/member_credit_det"><img src="<?php echo WEB_DIR_ADMIN?>/images/Member_Credit_Limit_Details.png" border="0" /></a></td> <?php } } ?><?php */?>
    <?php if(isset($access)) { if($access->changepassword != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd"><img src="<?php echo WEB_DIR_ADMIN?>/images/Change_Password.png" border="0" /></a></td> <?php } } ?>
  </tr> 
  <tr>
    <td height="20" align="center"></td>
    <td height="20" align="center"></td>
    <td height="20" align="center"></td>
    <td height="20" align="center"></td>
    <td height="20" align="center"></td>
  </tr>
  <tr>
    <?php /*?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/slider_images"><img src="<?php echo WEB_DIR_ADMIN?>/images/sliderimage.png" border="0" /></a></td><?php */?>
    <?php /*?> <?php if(isset($access)) { if($access->offlinebus != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/offline_bus"><img src="<?php echo WEB_DIR_ADMIN?>/images/Offline_Bus_Management.png" border="0" /></a></td> <?php } } ?><?php */?>
   <?php if(isset($access)) { if($access->news_management != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/news_management"><img src="<?php echo WEB_DIR_ADMIN?>/images/NewsManagement.png" border="0" /></a></td> <?php } } ?>
    <?php if(isset($access)) { if($access->offlineholiday != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/offline_package"><img src="<?php echo WEB_DIR_ADMIN?>/images/Offline_Holiday_Management.png" border="0" /></a></td> <?php } } ?>
  
  <?php /*?> <?php if(isset($access)) { if($access->b2b_report != '0') { ?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/agent_reports"><img src="<?php echo WEB_DIR_ADMIN?>/images/B2BBookingReport.png" border="0" /></a></td> <?php } } ?><?php */?>
   <?php /*?> <?php if(isset($access)) { if($access->service_managemnt != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/service_management"><img src="<?php echo WEB_DIR_ADMIN?>/images/ServiceManagement.png" border="0" /></a></td> <?php } } ?><?php */?>
    <?php if(isset($access)) { if($access->holidays != '0') { ?> <td align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/list_excursion"><img src="<?php echo WEB_DIR_ADMIN?>images/Package_Details.png" border="0"  /></a></td><?php } } ?>
    <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/logout"><img src="<?php echo WEB_DIR_ADMIN?>/images/LogOut.png" border="0" /></a></td>
    
  </tr>
  <tr>
    <?php /*?> <td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/slider_images"><img src="<?php echo WEB_DIR_ADMIN?>/images/sliderimage.png" border="0" /></a></td><?php */?>
   
    <?php /*?><?php if(isset($access)) { if($access->imagemanagement != '0') { ?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/add_banner"><img src="<?php echo WEB_DIR_ADMIN?>/images/imagemanagement.png" border="0" /></a></td> <?php } } ?><?php */?>
    
    </tr>
    <tr>
     <?php /*?><td height="20" align="center"><a href="<?php echo WEB_URL_ADMIN?>admin/hoteloffers"><img src="<?php echo WEB_DIR_ADMIN?>/images/hotel_offer.png" border="0" /></a></td><?php */?>
     
    
   
    
    </tr>
  

  </table>
  <div class="clr"></div>
</div>
<!--footer-->
<?php $this->load->view('footer'); ?>
    <!--footer end-->
</body>
</html>
