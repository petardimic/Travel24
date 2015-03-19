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
<div style=" text-align:center; color:#000; padding:10px 4px 0px 4px; font-size:18px;" >Customer Details</div>

 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0"  style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:10px 0 50px 10px;">
     
<tr style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; height:30px;">
	 <td width="100" height="35" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Customer Name</b></td>
       
  <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b> Address</b></td>
        <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Country</b></td>
         <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>City</b></td>
		  <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Email</b></td>
        
	 <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Mobile Number</b></td> 
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Action</b></td>
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($customer)){ if($customer!= '') { ?>
     
      <?php 
	   foreach ($customer as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php echo WEB_URL_ADMIN?>admin/edit_customer/<?php echo $row->id?>" style="color:#cc1d1d;"><?php print $row->first_name; ?>&nbsp;<?php print $row->last_name; ?></a></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->address; ?>  </td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->country;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->city;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->email;?></td>
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->mobile_no;?></td>
	
	  
   <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL_ADMIN ."admin/delete_customer_details/".$row->id;?> class="add_update_link"> <input type="image" title="delete the customer" src="<?php print WEB_DIR_ADMIN?>images/delete1.png" onclick="return confirm('Are you sure want to delete this currency?')"/></a></td>
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
