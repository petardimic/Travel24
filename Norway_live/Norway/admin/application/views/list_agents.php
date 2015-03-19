 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
		<script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
<div class="clr"></div>
<style>
table.sortable thead {
    background-color:#eee;
    color:#666666;
    font-weight: bold;
    cursor: default;
}

</style>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>


 <div class="clr">
 
 <div class="clr">
 


 <div style="float:right; margin-left:10px; font-weight:bold; padding:10px; font-size:18px;"><a href="<?php print WEB_URL_ADMIN ?>admin/export_agent" style=" color:#cc1d1d;" >Export In to Excel Sheet</a></div>
 <table width="100%" border="0" align="right" cellpadding="0" cellspacing="0" style="background-color:#fff; color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px -120px;" class="sortable">
   <thead>
     <tr style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; height:20px;  ">
       <th width="30"  align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px; "><b>SL.No</b></th>
       <th width="70" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px; "><b>AgentID</b></th>
       <th height="20" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b>Agency Name</b></th>
       <th width="142" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b>Contact Person </b></th>
       <th width="150" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px; "><b>Contact No </b></th>
       <th width="150" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b> E-mail ID </b></th>
       <th width="100" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b>Balance</b></th>
       <th width="100" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b>Status</b></th>
       <th width="50" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b>Action</b></th>
       <th width="100" align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:10px 10px 10px 10px;"><b>Agent Id</b></th>
     </tr>
   </thead>
   <?php
	  if(isset($list_agent)){ if($list_agent != '') {
		  
		  $i=1; ?>
   <tbody>
     <?php 
	   foreach ($list_agent as $row){ 
	  
		  ?>
     <tr style="height:25px;">
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; height:30px; "><?php echo  $i; ?></td>
       <td align="center" valign="left" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; height:30px; "><a href="<?php print WEB_URL_ADMIN.'admin/view_user_detail/'.$row->agent_id; ?>" style="color:#cc1d1d;">
         <?php
		echo $row->agent_id;
		 ?>
       </a></td>
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; height:30px; "><?php echo $row->agency_name; ?></td>
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; height:30px; "><?php print $row->agent_name; ?></td>
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; height:30px; "><?php print $row->mobile_phone; ?></td>
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; "><?php echo $row->email;?></td>
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; "><?php echo $row->account_balance;?></td>
       <td align="center" valign="middle" style="border-right:1px solid #c7c7c7
        ; padding:0 5px 0 5px; color:#333; "><a href="<?php WEB_DIR_ADMIN?>change_status/<?php echo $row->agent_id;?>/<?php echo $row->status;?>" style="color:#cc1d1d;">
         <?php if($row->status=='yes'){echo 'Approved';}elseif($row->status=='no'){echo 'Disapproved';}?>
       </a></td>
       <td align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; "><a href="<?php WEB_DIR_ADMIN?>delete_agent/<?php echo $row->agent_id;?>"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td>
       <td align="center" valign="middle" style="border-right:1px solid #FFF
        ; padding:0 5px 0 5px; color:#333; "><?php if($row->agent_id_new == '') {  ?>
         <a href="<?php WEB_DIR_ADMIN?>create_agent_id/<?php echo $row->agent_id;?>" style="color:#cc1d1d;">Add</a>
         <?php } else { echo $row->agent_id_new; }?></td>
     </tr>
     <?php    $i++;
	  }}else{?>
     <tr>
       <td colspan="14" align="center" style="color:#000000;"><?php  echo 'No Agents found'; ?></td>
     </tr>
     <?php }}
	  ?>
   </tbody>
 </table>
 </div>
        
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>	
