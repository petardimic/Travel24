<?php 
//echo '<pre>'; print_r($result_pag_data);exit;
if($result_pag_data != '')
		{
			foreach($result_pag_data as $row)
			{
				//echo '<pre>'; print_r($result_pag_data);
?>	
<?php if($row->api_name != 'hotelspro') { 
	 
    $url = WEB_URL.'home/prop_detail/'.$row->hotel_id.'/'.$row->hotel_name.'/1/'.$row->result_id;
     } else {
    $url = WEB_URL.'home/prop_detail/'.$row->hotel_id.'/'.$row->result_id.'/2'.'/'.$row->result_id;
       } ?>
       <a href="<?php echo $url; ?>">
<div class="hotel_result1 " style="text-decoration:none;" >
    <table width="730">
    <tr>
      <td width="8">&nbsp;</td>
      <?php 
	  		if($row->api_name == 'hotelspro')
			{
				$hotel_det = $this->Home_Model->get_hotel_dethp($row->hotel_id);
				if(isset($hotel_det->HotelImages1))
				{
					$image = $hotel_det->HotelImages1;
				}
				else if(isset($hotel_det->HotelImages2))
				{
					$image = $hotel_det->HotelImages2;
				}
				else if(isset($hotel_det->HotelImages3))
				{
					$image = $hotel_det->HotelImages3;
				}
				else
				{
					$image = WEB_DIR.'images/noImageAvailable.jpg';
				}
			}
			else
			{
				$image = $row->image_url;
				if($image != '')
				{
					$image = $image;
				}
				else
				{ 
					$image = WEB_DIR.'images/noImageAvailable.jpg';
				} 
			}?>
      <td width="150" align="left" valign="top" ><img src="<?php echo $image; ?>" style="border-radius:5px;"  width="132" height="88"  /></td>
    <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td style="color:#e62424; font-size:15px; font-weight:bold;"><?php 
			if($row->api_name == 'hotelspro') { 
			echo $hotel_det->HotelName; }
			else {
			echo $row->hotel_name; }?></td>
        </tr>
      <tr>
        <td height="20" style="color:#cba302; font-size:12px;"><span style="margin-top:10px;">
       	<?php  if($row->api_name == 'hotelspro') { $star_rate = $hotel_det->StarRating;
		}
		else { $star_rate = $row->star_rate;  }
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
        <td height="18" style="color:#202020; font-size:12px;"><?php if($row->api_name == 'hotelspro') { echo $hotel_det->Destination.", ".$hotel_det->Country; } else { echo $row->location; }?> <?php //echo $row->description; ?></td>
      </tr>
      <?php if($row->api_name != 'hotelspro') { ?>
      <?php if($row->RatingImage != '') { ?> <tr>
        <td height="18" valign="top" style="color:#0084ba;"><a href="<?php echo $row->Reviews; ?>" target="_blank"><img src="<?php echo $row->RatingImage; ?>"  border="0" width="80" /></a> 
        <span class="rollover"><a href="<?php echo $row->Reviews; ?>" target="_blank"> <?php if($row->ReviewCount != '') { ?>Review Count : <?php echo $row->ReviewCount; ?> <?php } ?>&nbsp;</a></span></td>
      </tr>
      <?php } ?>
      <?php if($row->Rating != '') { ?>
      <tr>
        <td height="18" style="color:#0084ba;"><span class="rollover"><a href="#"><?php echo $row->Rating; ?>/5 Excellent&nbsp;</a> </span> </td>
      </tr>
      <?php } ?>
      <?php } ?>
       	<tr>
        <td height="18" style="color:#0084ba; font-size:12px;"><span class="rollover"><?php if($row->api_name == 'hotelspro') { echo $hotel_det->HotelAddress; } else { if($row->description != '') { ?><?php echo $row->description; ?>&nbsp;</a><?php } }?> </span> </td>
      </tr>
    </table></td>
     <!--rate part plus book button-->
     <td width="140" align="left">
      <span style="color:#4e4e4e; font-size:16px; text-decoration:line-through; font-weight:normal; font-family:Arial, Helvetica, sans-serif;"><b><!--&#163;-->
      
		<?php 
			$price = $this->Home_Model->get_rooms_lowest($row->hotel_id,$row->criteria_id);
		if($new_cost !=''){
			//echo $this->session->userdata('host_currencyCode').' '.round(($price->nightperroom + (($price->nightperroom *10)/100))*($new_cost));
			echo $this->session->userdata('host_currencyCode').' '.($price->nightperroom + (($price->nightperroom *10)/100))*($new_cost);
			}else{?>
       <?php echo $row->cost_type; ?>  <?php //echo round($price->nightperroom + ($price->nightperroom *10)/100);
	   	echo ($price->nightperroom + ($price->nightperroom *10)/100); ?>
       <?php }?>
       
       
       </b> <br /> </span> 
     <span style="color:#e62424; font-size:18px; font-family:Arial, Helvetica, sans-serif;"><b>
	 <?php if($new_cost != ''){
		 //echo $this->session->userdata('host_currencyCode').' '.round($price->nightperroom *($new_cost));
		 echo $this->session->userdata('host_currencyCode').' '.($price->nightperroom *($new_cost));
	 }else{?>
	 <?php echo $row->cost_type; ?>  <?php //echo round($price->nightperroom); 
	 	echo $price->nightperroom;?>
     <?php }?>
     
     </b> <br />
     </span> <span style="color:#191919; font-size:11px;">(Per room Per <?php echo $this->session->userdata('dt'); ?> <?php if($this->session->userdata('dt') > 1) { echo "Nights"; } else { echo "Night"; } ?>)</span><br />
     <?php if($row->api_name != 'hotelspro') { 
	 ?>
     <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/<?php echo $row->hotel_id; ?>/<?php echo $row->hotel_name; ?>/1/<?php echo $row->result_id; ?>"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span>
     <?php } else { ?>
      <span style="margin-top:5px; float:left;"><a href="<?php echo WEB_URL ?>home/prop_detail/<?php echo $row->hotel_id; ?>/<?php echo $row->result_id; ?>/2/<?php echo $row->result_id; ?>"><input type="image" src="<?php echo WEB_DIR ?>images/hotels/select.jpg" /></a></span>
      <?php } ?>
      </td>
    <!--rate part plus book button--> 
    </tr>
    
    </table>
   
   </div> </a>
   
   <?php 	}
		}
?>
