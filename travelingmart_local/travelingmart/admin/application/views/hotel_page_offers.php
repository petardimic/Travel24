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
<form action="<?php print WEB_URL_ADMIN ?>admin/hotel_offers_add" method="post">
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
	<tr><th style="background:#EFA146; color:#000; padding:4px;" colspan="2">International Hotels</th></tr>
      
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
    	Select International Hotel 1
    	</td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">  
        		<select name="inter1"  style="width:300px;">
                <option value=""> - Select - </option>
                <?php if(isset($hotels_inter)) { if($hotels_inter != '') { foreach($hotels_inter as $row) { ?>
                		<option value="<?php echo $row->hotel_list_id; ?>" <?php if($offers->inter1 == $row->hotel_list_id) { echo "selected"; } ?> ><?php echo $row->HotelName.", ".$row->Destination; ?></option>
                <?php } } } ?>
                </select></td>
	 	 </tr>
         <tr><td colspan="2">&nbsp;</td></tr>
         <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
    	Select International Hotel 2
    	</td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">  
        		<select name="inter2" style="width:300px;">
                <option value=""> - Select - </option>
                <?php if(isset($hotels_inter)) { if($hotels_inter != '') { foreach($hotels_inter as $row) { ?>
                		<option value="<?php echo $row->hotel_list_id; ?>" <?php if($offers->inter2 == $row->hotel_list_id) { echo "selected"; } ?> ><?php echo $row->HotelName.", ".$row->Destination; ?></option>
                <?php } } } ?>
                </select></td>
	 	 </tr>
         <tr><td colspan="2">&nbsp;</td></tr>
          <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
    	Select International Hotel 3
    	</td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">  
        		<select name="inter3" style="width:300px;">
                <option value=""> - Select - </option>
                <?php if(isset($hotels_inter)) { if($hotels_inter != '') { foreach($hotels_inter as $row) { ?>
                		<option value="<?php echo $row->hotel_list_id; ?>" <?php if($offers->inter3 == $row->hotel_list_id) { echo "selected"; } ?>><?php echo $row->HotelName.", ".$row->Destination; ?></option>
                <?php } } } ?>
                </select></td>
	 	 </tr>
      
</table>
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     <tr><th style="background:#EFA146; color:#000; padding:4px;" colspan="2">Domestic Hotels</th></tr>

      
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
    	Select Domestic Hotel 1
    	</td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">  
        		<select name="dom1" style="width:300px;">
                <option value=""> - Select - </option>
                <?php if(isset($hotels_domestic)) { if($hotels_domestic != '') { foreach($hotels_domestic as $row1) { ?>
                		<option value="<?php echo $row1->hotel_list_id; ?>" <?php if($offers->dom1 == $row1->hotel_list_id) { echo "selected"; } ?> ><?php echo $row1->HotelName.", ".$row1->Destination; ?></option>
                <?php } } } ?>
                </select></td>
	 	 </tr>
         <tr><td colspan="2">&nbsp;</td></tr>
         <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
    	Select Domestic Hotel 2
    	</td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">  
        		<select name="dom2" style="width:300px;">
                <option value=""> - Select - </option>
                <?php if(isset($hotels_domestic)) { if($hotels_domestic != '') { foreach($hotels_domestic as $row2) { ?>
                		<option value="<?php echo $row2->hotel_list_id; ?>" <?php if($offers->dom2 == $row2->hotel_list_id) { echo "selected"; } ?> ><?php echo $row2->HotelName.", ".$row2->Destination; ?></option>
                <?php } } } ?>
                </select></td>
	 	 </tr>
         <tr><td colspan="2">&nbsp;</td></tr>
          <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
    	Select Domestic Hotel 3
    	</td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">  
        		<select name="dom3" style="width:300px;">
                <option value=""> - Select - </option>
                <?php if(isset($hotels_domestic)) { if($hotels_domestic != '') { foreach($hotels_domestic as $row3) { ?>
                		<option value="<?php echo $row3->hotel_list_id; ?>"  <?php if($offers->dom3 == $row3->hotel_list_id) { echo "selected"; } ?> ><?php echo $row3->HotelName.", ".$row3->Destination; ?></option>
                <?php } } } ?>
                </select></td>
	 	 </tr>
     
 <tr><td colspan="2" align="center"><input type="image" src="<?php print WEB_DIR_ADMIN ?>images/update_btn.png" border="0"  /></td></tr>
 </table>
</form>
		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
