 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>

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
<style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}

</style>
 <div id="container_warpper" style="padding-bottom:50px;" >

<div style="text-align:right; margin-right:20px;" class="add"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Supplier</a><?php */?></div>
<div class="right-wrapper">
 <table width="965" border="0" align="left" cellpadding="0" cellspacing="0" class="sortable" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
 <thead>
<tr style="background-color:#505e91; height:30px;">
	
        <th width="200" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:4px 5px 0 4px; ">
        <div style="float:left; padding:0px 2px;">
       <?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_up.png" width="10" height="15" style="padding-right:2px;" /><?php */?>
        </div>
        <div style="float:left; padding:0px 0px 0px 8px;"><b>Name &nbsp;</b></div>
        <div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_down.png"  width="10" height="15"/><?php */?>
        </div>
        </th>
	
	
	
	
        <th width="260" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 4px; ">
         <div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_up.png" width="10" height="15" style="padding-right:2px;" /><?php */?>
        </div>
         <div style="float:left; padding:0px 0px 0px 7px;"><b>Email&nbsp;</b></div>
         <div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_down.png"  width="10" height="15"/><?php */?>
        </div></th>
        
        
<th width="86" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;">
 <div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_up.png" width="10" height="15" style="padding-right:2px;" /><?php */?>
        </div>
        <div style="float:left; padding:0px 0px 0px 13px;"><b>Country&nbsp;</b></div>
        
  <div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_down.png"  width="10" height="15"/><?php */?>
        </div></th>
        
        
<th width="98" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;">
<div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_up.png" width="10" height="15" style="padding-right:2px;" /><?php */?>
        </div>
<div style="float:left; padding-left:40px; padding-right:25px;"><b>City&nbsp;</b></div>
<div style="float:left; padding:0px 0px;"><?php /*?><img src="<?php echo WEB_DIR_ADMIN?>images/arrow_new_down.png"  width="10" height="15"/><?php */?>
        </div></th>

<?php /*?><th width="71" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;"><b>Properties</b></th><?php */?>
<th width="15" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;"><b>Edit</b></th>
	<th width="20" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;"><b>Status</b></th>
    <th width="20" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;"><b>Access</b></th>
	<th width="51" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></th>

    </tr>	</thead>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	   foreach ($users as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print ucfirst($row->first_name.$row->last_name);?></td>
       
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->email;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo ucfirst($row->country);?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo ucfirst($row->city);?></td>

	
	 
     
       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	 
	   <a href=<?php print WEB_URL_ADMIN ."admin/edit_admin/".$row->admin_id;?> class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg"  title="click to edit"/></a></td> 
		
		
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->status=='0'){?><a href="<?php echo WEB_URL_ADMIN?>admin/admin_status/<?php echo $row->status?>/<?php echo $row->admin_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/admin_status/<?php echo $row->status?>/<?php echo $row->admin_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> 
		
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/admin_accessupdated/".$row->admin_id;?> class="add_update_link">Update</a></td>
        
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/delete_admin/".$row->admin_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this Admin?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> 
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
