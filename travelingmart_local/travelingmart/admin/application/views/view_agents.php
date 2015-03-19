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

 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333333; height:30px;">
	 <td width="111" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Agent Namexcv mxcn bcn bn cvn </b></td>
        <td width="111" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Agency name</b></td>
	<td width="111" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Agenct Address</b></td>
        <td width="111" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Country</b></td>
         <td width="40" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>City</b></td>
		  <td width="52" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Email</b></td>
         <td width="109" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Office Number</b></td>
	 <td width="166" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Mobile Number</b></td> 
	<td width="110" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td>
	<td width="57" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($agents)){ if($agents!= '') { ?>
     
      <?php 
	   foreach ($agents as $row){ 
	  
		  ?>
		  
			  
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><a href="<?php echo WEB_URL_ADMIN?>/admin/view_agent_details/<?php echo $row->agent_id?>" style="color:#a64003;"><?php print $row->agent_name; ?></a></td>
	
        <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->agency_name; ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->agent_address; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $cnt = $this->Home_Model->get_ind_country($row->country);?></td>
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->city;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->email;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $row->office_num;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $row->mob_num;?></td>  
	
	
        <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php if($row->status=='Deactive'){?><a href="<?php echo WEB_URL_ADMIN?>/admin/agent_status/<?php echo $row->agent_id?>/<?php echo $row->status?>"><img src="<?php echo WEB_DIR_ADMIN?>/images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>/admin/agent_status/<?php echo $row->agent_id?>/<?php echo $row->status?>"><img src="<?php echo WEB_DIR_ADMIN?>/images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> 
		
		<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."/hotel/delete_agent/".$row->agent_id;?> class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" /></a></td> 
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
