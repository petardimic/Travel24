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
<div style="background:#EFA146; color:#000; padding:4px;" >View Agents</div>
<form id="filter" action="<?php print WEB_URL_ADMIN?>admin/filter" method="post">
 <table width="605" border="0" align="right" cellpadding="0" cellspacing="0" style="margin-top:20px;">
  <tr>
    <td width="406" align="right" style="width:155px;"><strong>List by Agency Name</strong></td>
    <td width="94" style="padding:0 0 0 10px;"><?php ?><select name="hotel" onchange="filter_by(this.value)" style="padding:2px; width:200px; outline:none;" >
    <option value="Select" >Select----------</option>
    <option value="all">All</option>
    <?php
	
	foreach($agents as $rw)
	{
	?>
     <option value="<?php echo $rw->agency_name?>"><?php echo $rw->agency_name?></option>
    <?php
	}
	?>
    </select></td>
    <td width="105" style="padding:0 0 0 10px;"><div class="add" style="text-align:right; margin-right:20px; padding-top:5px;"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Agent</a><?php */?></div></td>

  </tr>
</table>
</form>
 <div style="clear:both"></div>
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:5px 0 50px 10px;">
     
<tr style="background-color:#333; height:30px;">
	 <td width="128" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Agent Name</b></td>
       <td width="165" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Agency/ Corporate Name</b></td>

        <td width="75" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Country</b></td>
         <td width="59" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>City</b></td>
		  <td width="163" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Email</b></td>
          <td width="114" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Password</b></td>

	<td width="164" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td>
	<td width="110" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
	
    </tr>
      <?php
	
	  if(isset($agents)){ if($agents!= '') { ?>
     
      <?php 
	   foreach ($agents as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php echo WEB_URL_ADMIN?>admin/view_agent_details/<?php echo $row->user_id?>" style="color:#a64003;"> <?php print $row->first_name; ?></a></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->agency_name;?></td>
          
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $cnt;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->city;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->email;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->password;?></td>
	
         <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->status=='InActive'){?><a href="<?php echo WEB_URL_ADMIN?>admin/agent_view_status/<?php echo $row->status?>/<?php echo $row->user_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/agent_view_status/<?php echo $row->status?>/<?php echo $row->user_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td> 
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/delete_viewagent/".$row->user_id;?> class="add_update_link" onclick="return confirm('Are you sure want to delete this user?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> 
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
