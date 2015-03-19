<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelingmart</title>
	
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
   <div style="background:#EFA146; color:#000; padding:4px;" >Add User Type</div>

   <script type="text/javascript">
  function abc()
  {
  //	alert('anand');
  $('#add_comm').show();
  $('#view_comm').hide();
  }
  function xyz()
  {
  //	alert('anand');
  $('#add_comm').hide();
  $('#view_comm').show();
  }
  </script>
  <div style="margin:auto; width:700px; height:auto; overflow:hidden;">
  <div style="width:900px; height:20px; margin-left:20px; margin-top:20px;">
  <span style="color:#fff; background:#F69F3A; width:150px; float:left; text-align:center; cursor:pointer; border-right:1px #fff solid;" onclick="return xyz();">View user types</span>&nbsp;<span style="color:#fff; background:#F69F3A; width:150px; float:left; text-align:center; cursor:pointer;" onclick="return abc();">Add user type</span> 
  </div>
  <div id="view_comm" style="width:678px; height:auto; overflow:hidden; border:solid 1px #ccc; margin-left:20px;">
  <table style="width:600px; padding:15px;">
  <tr style="background-color:#333; border:solid 1px #ccc; color:#fff; font-size:14px; text-align:center;">
    <td>User Types</td>
  </tr>
  <?php $i=1; if(isset($commission_list)){ if($commission_list != '') { foreach ($commission_list as $row){ ?>
   <input name="comm_id" value="<?php print $row->user_type_id; ?>" class="user_fld_box-fld-2" type="hidden" />
	  <td style="border:solid 1px #ccc;"><?php print $row->user_type; ?></td>
  </tr>
	<?php $i++; }}} ?>
   </table>
  </div>
   <form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/user_type" method="post">
  <table style="width:600px; margin-left:21px; border:solid 1px #ccc;">
  <tr>
	<td>User type</td>
	<td><input type="text" name="user_type" id="value"/></td></tr>
    <tr><td height="10"></td></tr>
	
	
	<tr>
	<td>
	  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22"></td>
	<td>
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
</form>
  </div>
  
  
  
  
  
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>
