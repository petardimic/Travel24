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
 
 <div id="container_warpper" >
<div style="background:#505e91; color:#fff; padding:7px;" >Franchise Details</div>

 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333333; height:30px;">
	 <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Franchise Name</b></td>
       
	 <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Organisation</b></td>
     <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Office Address</b></td>
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Contact</b></td>
	 <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Email</b></td>
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Website</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Notice</b></td>
	 <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Action</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($franchise_list)){ if($franchise_list!= '') { ?>
     
      <?php 
	   foreach ($franchise_list as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php echo WEB_URL_ADMIN?>admin/edit_franchise/<?php echo $row->id?>" style="color:#a64003;"><?php print $row->franchise_name; ?> </a></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->org_name; ?>  </td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->off_add;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print "M:".$row->mobile_no."<br/>"."F:".$row->fax;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->email_id;?></td>
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->website_add;?></td>
	
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/notice_board/".$row->id;?> class="add_update_link"> Add</a></td>
	  
   <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/delete_franchise_details/".$row->id;?> class="add_update_link"> <input type="image" title="delete the Franchise" src="<?php print WEB_DIR_ADMIN?>images/delete1.png" onclick="return confirm('Are you sure want to delete this Franchise..?')"/></a></td>
	 </tr>
          <?php
	  }}else{ ?>
      <tr>
      <td>
	  <?php echo "No records found";?></td></tr>
	  <?php }}
	  ?>
     <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>

		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
