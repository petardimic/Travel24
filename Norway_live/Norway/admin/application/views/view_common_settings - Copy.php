<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>travelingmart - Administration</title>
	
</head>

<body>
<?php $this->load->view('header'); ?>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px; margin-top:50px;" >
   <div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup" style="text-decoration:none;"class="active">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd" style="text-decoration:none;">Change Password</a></li>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings" style="text-decoration:none;">Website Settings</a></li>
  
		</ul>
	</div>
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
  <div style="width:700px; height:20px; margin-left:20px; margin-top:20px;">
  <span style="color:#fff; background:#3a3a39 ; width:150px; float:left; text-align:center; cursor:pointer; border-right:1px solid #fff; padding:7px 7px; font-weight:bold;" onclick="return xyz();">Commission Details</span>&nbsp;<span style="color:#fff; padding:7px 7px; font-weight:bold; background:#3a3a39 ; width:150px; float:right; text-align:center; cursor:pointer;" onclick="return abc();">Add Commission</span>  </div>
  <div id="view_comm" style="width:678px; height:auto; overflow:hidden; border:solid 1px #ccc; margin-left:20px;">
  <table width="100%"  >
  <tr style="background-color:#505e91; border:solid 1px #ccc; color:#fff; font-size:14px; text-align:center;">
    <td height="30">Commission</td>
    <td>status</td>
    <td>Action</td>
  </tr>
  <?php $i=1; if(isset($commission_list)){ if($commission_list != '') { foreach ($commission_list as $row){ ?>
    <form name="form1" action="<?php print WEB_URL_ADMIN?>admin/edit_commission_details" method="post">
	<input name="comm_id" value="<?php print $row->commision_id; ?>" class="user_fld_box-fld-2" type="hidden" />

  
  <td style="border:solid 1px #ccc;"><input name="markup" type="text" style="width:40px;" value="<?php print $row->value; ?>" />&nbsp;<?php if($row->type == 2){?>%<?php }else{?>price<?php }?></td>
  <td style="border:solid 1px #ccc;"><?php if($row->status=='Active'){?><a href="<?php echo WEB_URL_ADMIN?>admin/edit_com_status/<?php echo $row->status?>/<?php echo $row->commision_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/edit_com_status/<?php echo $row->status?>/<?php echo $row->commision_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td>
  <td style="border:solid 1px #ccc;"><input type="image" src="<?php print WEB_DIR_ADMIN?>images/update_btn.png" style="width:60px; height:30px;" />
 <?php /*?> <input type="image" src="<?php print WEB_DIR_ADMIN?>images/delete1.png" /><?php */?></td>
  </tr>
 
</form>
  <?php $i++; }}} ?>
   </table>
  </div>
   <form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_commission_details" method="post">
	<input name="services" value="" class="user_fld_box-fld-2" type="hidden" />
  <table style="width:600px; padding:15px; border:1px #ccc solid; margin-left:20px;">
  <tr>
	<td style="border:solid 1px #ccc; padding:2px;">Commission Value</td>
	<td style="border:solid 1px #ccc; padding:2px;"><input type="text" name="value" id="value"/>%</td></tr>
	<?php /*?><tr>
	<td style="border:solid 1px #ccc; padding:2px;">Commission Type</td>
	<td style="border:solid 1px #ccc; padding:2px;"><select name="type" id="type" style="width:145px;">
		<option value="">select commisssion</option>
		<option value="1">price</option>
		<option value="2">Percentage</option>
		</select></td>
	</tr><?php */?>
	
	<tr>
	<td style="border:solid 1px #ccc; padding:2px;">
	</td>
	<td style="border:solid 1px #ccc; padding:2px;">  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="36">
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="36" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
</form>
  </div>
  
  
  
  
  
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>
