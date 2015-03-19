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
     <tr style="background-color:#333333; height:30px;"><th colspan="3">International Hotels</th></tr>
<tr style="background-color:#333333; height:30px;">
	 <td width="300" height="30" align="center" valign="middle"><b>Hotel Name</b></td>
       
	<td  align="center" valign="middle" style=" padding:0 5px 0 5px; "><b>Star Rating</b></td>
       <td align="center" style=" padding:0 5px 0 5px; ">Change</td>
     	
    </tr>
      <?php
		
	  if(isset($hotels)){ if($hotels!= '') { ?>
     	
      <?php 
	  
	  	$inter1 = $hotels->inter1;
		$inter2 = $hotels->inter2;
		$inter3 = $hotels->inter3;
		$dom1 = $hotels->dom1;
		$dom2 = $hotels->dom2;
		$dom3 = $hotels->dom3;
		$row = $this->Home_Model->get_hot_det($inter1);
		$row2 = $this->Home_Model->get_hot_det($inter2);
		$row3 = $this->Home_Model->get_hot_det($inter3);
		$row4 = $this->Home_Model->get_hot_det($dom1);
		$row5 = $this->Home_Model->get_hot_det($dom2);
		$row6 = $this->Home_Model->get_hot_det($dom3);
		  ?>
          
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->HotelName.", ".$row->Destination; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->StarRating; ?>  
	  <td  align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers">Update</a></td>
   
	 </tr>
     <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row2->HotelName.", ".$row2->Destination; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row2->StarRating; ?>  
	  <td  align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers">Update</a></td>
   
	 </tr>
     <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row3->HotelName.", ".$row3->Destination; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row3->StarRating; ?>  
	  <td  align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers"><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers">Update</a></a></td>
   
	 </tr>
     <tr style="background-color:#333333; height:30px;"><th colspan="3">Domestic Hotels</th></tr>
     <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row4->HotelName.", ".$row4->Destination; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row4->StarRating; ?>  
	   <td  align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers"><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers">Update</a></a></td>
   
	 </tr>
     <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row5->HotelName.", ".$row5->Destination; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row5->StarRating; ?>  
	  
   <td  align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers">Update</a></td>
	 </tr>
     <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row6->HotelName.", ".$row6->Destination; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row6->StarRating; ?>  
	  <td  align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN ?>admin/hotel_page_offers">Update</a></td>
   
	 </tr>
          <?php
	  }else{ ?>
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
