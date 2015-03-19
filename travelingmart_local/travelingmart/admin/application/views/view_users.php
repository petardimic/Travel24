 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Noori Travels</title>
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
 <div style="background:#EFA146; color:#000; padding:4px;" >View Users</div>


 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333; height:30px;">
	 <td width="140" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>User Type</b></td>
        <td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Company/Group/Brand Name</b></td>
	
	
	
	
        <td width="96" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Country</b></td>
<td width="64" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>City</b></td>
<td width="82" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>User Name</b></td>
<td width="88" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Password</b></td>

<td width="93" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></td>
	<td width="126" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td>
	<td width="93" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	   foreach ($users as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print ucfirst($row->user_type); ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->first_name.$row->last_name;?></td>
     
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $cnt = $this->Home_Model->get_ind_country($row->country);?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->city;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->email;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->password;?></td>

	 
       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	  <?php  if($row->user_type_id==4){?>
	   <a href=<?php print WEB_URL_ADMIN ."admin/edit_cust/".$row->user_id;?> class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit"/></a><?php }else if($row->user_type_id==1){?>
       <a href=<?php print WEB_URL_ADMIN ."admin/edit_sup/".$row->user_id;?>  class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit" class="add_update_link"/><?Php }else{?></a>
       <a href=<?php print WEB_URL_ADMIN ."admin/edit_agent/".$row->user_id;?>  class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit" class="add_update_link"/><?Php }?></a>
       </td> 
		
		
<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->status=='InActive'){?><a href="<?php echo WEB_URL_ADMIN?>admin/user_status/<?php echo $row->status?>/<?php echo $row->user_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/user_status/<?php echo $row->status?>/<?php echo $row->user_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td>  
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."/admin/delete_user/".$row->user_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this user?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> 
	 </tr>
          <?php
	  }?>  <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr> <?php }}else{ echo "No records found";}
	  ?>
  
</table>

		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
