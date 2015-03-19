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
<div style="background:#EFA146; color:#000; padding:4px;" >Hotel Offers</div>

 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333333; height:30px;">
	 <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Hotel Name</b></td>
       
	<td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Star Rating</b></td>
        <td width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>City, Country</b></td>
         <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Phone</b></td>
		  <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Image</b></td>
        
     <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Select Hotel</b></td> 
     	
    </tr>
      <?php
		$hotel = $this->Home_Model->gethoteloffers(); 
	  if(isset($hotel)){ if($hotel!= '') { ?>
     	
      <?php 
	   foreach ($hotel as $row){ 
	  	$hotel_id = $row->hotel_list_id;
		/*$selected = $this->Home_Model->get_selected();
		foreach($selected as $sel)
		{
			$sel_id = $sel->hotel_id;
		}*/
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->HotelName; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->StarRating; ?>  </td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->Destination.", ".$row->Country; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->HotelPhoneNumber;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><img src="<?php print $row->HotelImages1; ?>" width="100" height="100" /></td>
	
	
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/selct_hotel/<?php echo $row->hotel_list_id; ?>/<?php echo $row->selected; ?>"><?php if($row->selected =='active') { echo "Selected"; } else { echo "Select"; }?></a></td>
   
	
	  
   
	 </tr>
          <?php
	  }}else{ ?>
      <tr>
      <td colspan="10" style="padding:70px;">
	  <?php echo "<span style='color:#000; font-weight:bold;'>No Hotel Booking Requests found</span>";?></td></tr>
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
