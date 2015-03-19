<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Noori Travels</title>
	
</head>

<body>
<?php $this->load->view('header'); ?>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px;" >
   
   
  <!--debasmita-->
  <div style="margin:auto; width:700px; height:auto; overflow:hidden;">
  <div style="width:900px; height:20px; margin-left:20px; margin-top:20px;">
  <span style="color:#fff; background:#EFA146; width:150px; float:left; text-align:center; ">API Control</span>
  </div>
  <div style="width:678px; height:auto; overflow:hidden; border:solid 1px #ccc; margin-left:20px;">
  
  <table style="width:600px; padding:15px;">
  <tr style="background-color:#74941D; border:solid 1px #ccc; color:#fff; font-size:15px; text-align:center;">
    <td>Api Name</td>
    <td>Status</td>
    </tr>
    <?php
    $i=1;
	 if(isset($apiselect)){
         if($apiselect != ''){
		 foreach($apiselect as $row){?>
  <tr style="text-align:center;">
  <td style="border:solid 1px #ccc;"><?php echo $row->api_name;?></td>
  <td style="border:solid 1px #ccc;"><?php if($row->status==1)
	{?>
   <a href="<?php print WEB_URL_ADMIN.'/admin/api_status/'.$row->api_id.'/'.$row->status; ?>" class="icon_link">Active</a>
	<?php }else{?>
	 
    <a href="<?php print WEB_URL_ADMIN.'/admin/api_status/'.$row->api_id.'/'.$row->status; ?>" class="icon_link">DeActive</a>
	<?php }?></td>
  </tr>
  <?php $i++;}}}?>
  </table>
 
  </div>
  
  </div>
  
  
  
  
  
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>
