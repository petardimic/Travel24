 <?php if(isset($results)) { if($results != '') { foreach($results as $row) { 
	
	$address = $this->Home_Model->get_address($row->hotel_id); ?>
    <span style="display:none;"><?php echo $row->star_rate; ?></span>
   <div class="hotel_result1 " >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <?php $image = $row->image_url;
	  		if($image != '')
			{
				$image = $image;
			}
			else
			{ 
				$image = WEB_DIR.'images/noImageAvailable.jpg';
			} ?>
      <td width="150" align="left" valign="top" ><img src="<?php echo $image; ?>" style="border-radius:5px;"  width="132" height="88"  /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;"><?php echo $row->hotel_name; ?></td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;">
       	<?php $star_rate = $row->star_rate; 
			if($star_rate == '1')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active1.png" /> 
                <?php
			}
			elseif($star_rate == '2')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active2.png" /> 
                <?php
			}
			elseif($star_rate == '3')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active3.png" /> 
                <?php
			}
			elseif($star_rate == '4')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active4.png" /> 
                <?php
			}
			elseif($star_rate == '5')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active5.png" /> 
                <?php
			}
			else
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active0.png" /> 
                <?php
			}?>
        
        </span></td>
      </tr>
      <tr>
        <td height="18" style="color:#202020; font-size:12px;"><?php echo $row->location; ?>, <?php echo $address->address; ?></td>
      </tr>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#">4.2/5 Excellent&nbsp;</a> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="105" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b>Rs.<?php echo $row->nightperroom + ($row->nightperroom *10)/100 ; ?></b> <br /> </span> 
     <span style="color:#e62424; font-size:20px; font-family:Arial, Helvetica, sans-serif;"><b>Rs. <?php echo $row->nightperroom; ?></b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per Night)</span><br />
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/<?php echo $row->hotel_id; ?>/<?php echo $row->hotel_name; ?>/<?php echo $row->api_name; ?>"><img src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span></td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div> 
    
    <?php } } } ?>