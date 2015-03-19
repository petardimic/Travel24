 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
		<style type="text/css">
		a:link {
	color: #333;
	text-decoration: none;
}
        a:visited {
	color: #333;
	text-decoration: none;
}
        a:hover {
	color: #456e08;
	text-decoration: none;
}
        a:active {
	text-decoration: none;
}
        </style>
 <div class="clr"></div>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>

 <div id="container_warpper" style="padding-bottom:50px;" >
 <div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis" class="active">View Admin</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">Change Password</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details">Currency</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">Ip Control</a></li>    
    
		</ul>
	</div>
    
<div style="width:800px ; float:left; margin-top:20px;">
 <table width="800" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:2px 0 50px 10px;">
     
<tr style="background-color:#333; height:30px;">
	 <td width="110" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>First Name</b></td>
        <td width="90" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Last Name</b></td>	
<td width="42" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Email</b></td>
<td width="48" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></td>
<?php /*?>	<td width="48" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td><?php */?>
	<td width="48" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Ip Status</b></td>
	<td width="75" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($subadmins)){ if($subadmins!= '') { ?>
     
      <?php 
	   foreach ($subadmins as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print ucfirst($row->first_name); ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->last_name;?></td>
       
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->email;?></td>
	
	 
       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/edit_subadmin/".$row->admin_id;?> class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit"/></a></td> 
		
		
	<?php /*?><td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->status== 0){?><a href="<?php echo WEB_URL_ADMIN?>admin/subadmin_status/<?php echo $row->status?>/<?php echo $row->admin_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/subadmin_status/<?php echo $row->status?>/<?php echo $row-> admin_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> <?php */?>
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->ipstatus== 0){?><a href="<?php echo WEB_URL_ADMIN?>admin/ip_status/<?php echo $row->ipstatus?>/<?php echo $row->admin_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/ip_status/<?php echo $row->ipstatus?>/<?php echo $row-> admin_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> 
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."/admin/delete_subadmin/".$row-> admin_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this subadmin?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> 
	 </tr>
          <?php
	  }?>  <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr> <?php }}else{ echo "No records found";}
	  ?>
  
</table>

</div>		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
