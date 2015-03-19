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
 
 <div id="container_warpper" style="width:98%" >
<div style=" color:#000; font-size:18px; text-align:center; margin-top:20x;" >Offline Bus Requests</div>

 <table width="98%" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:10px 0 50px 10px;">
     
<tr style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; height:30px;">
	 <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Passenger Name</b></td>
       
	<td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Email Id</b></td>
        <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Mobile Number</b></td>
         <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Address</b></td>
		  <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Id proof, Id number</b></td>
        
	 <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Gender, Age</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>No of Seats required</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Type</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Orign</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Destination</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Departure Date</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Return Date</b></td> 
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Bus Type</b></td> 
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($bus)){ if($bus!= '') { ?>
     
      <?php 
	   foreach ($bus as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->firstname." ".$row->lastname; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->email; ?>  </td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->mobile; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->address;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->idproof.", ".$row->idnumber;?></td>
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->gender.", ".$row->age;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->no_seats;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->type;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->origin;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->destination;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->departure_date;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->return_date;?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->bus_type;?></td>
	
	  
   
	 </tr>
          <?php
	  }}else{ ?>
      <tr>
      <td colspan="10" style="padding:70px;">
	  <?php echo "<span style='color:#000; font-weight:bold;'>No Bus Booking Requests found</span>";?></td></tr>
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
