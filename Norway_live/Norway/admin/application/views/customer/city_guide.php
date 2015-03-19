<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Travelingmart -<?php echo $res->city_name?></title>
<link href="<?php echo WEB_DIR?>images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR; ?>css/staykey.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo WEB_DIR; ?>css/home.css" rel="stylesheet" type="text/css" media="screen" />
<link href="<?php echo WEB_DIR; ?>css/oa_new.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR; ?>js/jquery_tab2.js"></script>
<script src="https://staykey.tenderapp.com/tender_widget.js" type="text/javascript"></script>


</head>
<body>
<!-- #header -->
 <?php echo $this->load->view('customer/header'); ?>
<!-- #header -->
    <div id="main-wrapper">
  <div id="main-content">
  <?php echo $res->content?>

    <div class="clr"></div>
 
  </div><!--main-content-->
	
</div><!--main-wrapper-->
<!-- #footer -->
 <?php echo $this->load->view('customer/footer'); ?>
<!-- #footer -->
<!--footer-wrapper-->
</body>
</html>
