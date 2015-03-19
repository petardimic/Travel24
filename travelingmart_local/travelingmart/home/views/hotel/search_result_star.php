<?php
	$star_val = '';
	if($star != '' && $loc_a != '')
	{
		$star_val = explode(',',$star);
		if(in_array(5,$star_val) && $this->Home_Model->results_5star_loc($loc_a))
		{
			$results_5star = count($this->Home_Model->results_5star_loc($loc_a)); 
		}
		else
		{
			$results_5star = 0;
		}
		if(in_array(4,$star_val) && $this->Home_Model->results_4star_loc($loc_a))
		{
			$results_4star = count($this->Home_Model->results_4star_loc($loc_a)); 
		}
		else
		{
			$results_4star = 0;
		}
		if(in_array(3,$star_val) && $this->Home_Model->results_3star_loc($loc_a))
		{
			$results_3star = count($this->Home_Model->results_3star_loc($loc_a));
		}
		else
		{
			$results_3star = 0;
		}
		if(in_array(2,$star_val) && $this->Home_Model->results_2star_loc($loc_a))
		{ 
			$results_2star = count($this->Home_Model->results_2star_loc($loc_a));
		}
		else
		{
			$results_2star = 0;
		}
		if(in_array(1,$star_val) && $this->Home_Model->results_1star_loc($loc_a))
		{ 
			$results_1star = count($this->Home_Model->results_1star_loc($loc_a)); 
		}
		else
		{
			$results_1star = 0;
		}
		if(in_array(0,$star_val) && $this->Home_Model->results_0star_loc($loc_a))
		{
			$results_0star = count($this->Home_Model->results_0star_loc($loc_a)); 
		}
		else
		{
			$results_0star = 0;
		}
	}
	
	else if($star != '')
	{
		$star_val = explode(',',$star);
		if(in_array(5,$star_val))
		{
			$results_5star = count($this->Home_Model->results_5star()); 
		}
		else
		{
			$results_5star = 0;
		}
		if(in_array(4,$star_val)){
			$results_4star = count($this->Home_Model->results_4star()); 
		}
		else
		{
			$results_4star = 0;
		}
		if(in_array(3,$star_val)){
			$results_3star = count($this->Home_Model->results_3star()); 
		}
		else
		{
			$results_3star = 0;
		}
		if(in_array(2,$star_val))
		{
			
			$results_2star = count($this->Home_Model->results_2star()); 			
		}
		else
		{
			$results_2star = 0;
		}
		if(in_array(1,$star_val))
		{
			if($this->Home_Model->results_1star())
			{
				$results_1star =count($this->Home_Model->results_1star()); 
			}
			else
			{
				$results_1star = 0;
			}
		}
		else
		{
			$results_1star = 0;
		}
		
		if(in_array(0,$star_val))
		{
			if($this->Home_Model->results_0star() != '')
			{
				$results_0star =count($this->Home_Model->results_0star()); 
			}
			else
			{
				$results_0star = 0;
			}			
		}
		else
		{
			$results_0star = 0;
		}
	}
	
	else if($loc_a != '')
	{
		if($this->Home_Model->results_5star_loc($loc_a))
		{
			$results_5star = count($this->Home_Model->results_5star_loc($loc_a)); 
		}
		else
		{
			$results_5star = 0;
		}
		if($this->Home_Model->results_4star_loc($loc_a))
		{
			$results_4star = count($this->Home_Model->results_4star_loc($loc_a)); 
		}
		else
		{
			$results_4star = 0;
		}
		if($this->Home_Model->results_3star_loc($loc_a))
		{
			$results_3star = count($this->Home_Model->results_3star_loc($loc_a));
		}
		else
		{
			$results_3star = 0;
		}
		if($this->Home_Model->results_2star_loc($loc_a))
		{ 
			$results_2star = count($this->Home_Model->results_2star_loc($loc_a));
		}
		else
		{
			$results_2star = 0;
		}
		if($this->Home_Model->results_1star_loc($loc_a))
		{ 
			$results_1star = count($this->Home_Model->results_1star_loc($loc_a)); 
		}
		else
		{
			$results_1star = 0;
		}
		if($this->Home_Model->results_0star_loc($loc_a))
		{
			$results_0star = count($this->Home_Model->results_0star_loc($loc_a)); 
		}
		else
		{
			$results_0star = 0;
		}
	}
	else if($bord_type_a != '')
	{
		$loc_a = $bord_type_a;
		if($this->Home_Model->results_5star_plan($loc_a))
		{
			$results_5star = count($this->Home_Model->results_5star_plan($loc_a)); 
		}
		else
		{
			$results_5star = 0;
		}
		if($this->Home_Model->results_4star_plan($loc_a))
		{
			$results_4star = count($this->Home_Model->results_4star_plan($loc_a)); 
		}
		else
		{
			$results_4star = 0;
		}
		if($this->Home_Model->results_3star_loc($loc_a))
		{
			$results_3star = count($this->Home_Model->results_3star_plan($loc_a));
		}
		else
		{
			$results_3star = 0;
		}
		if($this->Home_Model->results_2star_loc($loc_a))
		{ 
			$results_2star = count($this->Home_Model->results_2star_plan($loc_a));
		}
		else
		{
			$results_2star = 0;
		}
		if($this->Home_Model->results_1star_loc($loc_a))
		{ 
			$results_1star = count($this->Home_Model->results_1star_plan($loc_a)); 
		}
		else
		{
			$results_1star = 0;
		}
		if($this->Home_Model->results_0star_loc($loc_a))
		{
			$results_0star = count($this->Home_Model->results_0star_plan($loc_a)); 
		}
		else
		{
			$results_0star = 0;
		}
	
	}
	else
	{
		if($this->Home_Model->results_5star())
		{
			$results_5star = count($this->Home_Model->results_5star()); 
		}
		else
		{
			$results_5star = '';
		}
		if($this->Home_Model->results_4star())
		{
			$results_4star = count($this->Home_Model->results_4star()); 
		}
		else
		{
			$results_4star = 0;
		}
		if($this->Home_Model->results_3star())
		{
			$results_3star = count($this->Home_Model->results_3star()); 
		}
		else
		{
			$results_3star = 0;
		}
		if($this->Home_Model->results_2star())
		{
			$results_2star = count($this->Home_Model->results_2star()); 
		}
		else
		{
			$results_2star =0; 
		}
		if($this->Home_Model->results_1star() != '')
		{
			$results_1star = count($this->Home_Model->results_1star()); 
		}
		else
		{
			$results_1star = 0;
		}
		if($this->Home_Model->results_0star())
		{
			$results_0star =count($this->Home_Model->results_0star());
		}
		else
		{
			$results_0star = 0;
		}
		
	}
?>
<table width="100%" border="0" cellspacing="3" id="hotel_star" cellpadding="4" style="font-family:Arial, Helvetica, sans-serif; font-size:11px; color:#000;">
            <tr>
              <td width="25" align="left"><input name="star" value="5" id="star5" <?php if($star_val != ''){ if(in_array(5,$star_val)){ echo "checked=checked"?> <?php }else{}}else{ } //echo 'checked=checked';?> type="checkbox" onclick="star_filter(5,1);" /></td>
              <td>5 Stars</td>
              <td width="20">(<?php echo ($results_5star); ?>)</td>
            </tr>
            <tr>
              <td align="left"><input name="star" value="4" class="star" id="star4" <?php if($star_val != ''){ if(in_array(4,$star_val)){ echo "checked=checked"?> <?php }else{}}else{ } //echo 'checked=checked';?> type="checkbox" onclick="star_filter(4,1);" /></td>
              <td>4 Stars</td>
              <td>(<?php echo ($results_4star); ?>)</td>
            </tr>
            <tr>
              <td align="left"><input name="star" value="3" class="star" id="star3" <?php if($star_val != ''){ if(in_array(3,$star_val)){ echo "checked=checked"?> <?php }else{}}else{ } //echo 'checked=checked';?> type="checkbox" onclick="star_filter(3,1);"/></td>
              <td>3 Stars</td>
              <td>(<?php echo ($results_3star); ?>)</td>
            </tr>
            <tr>
              <td align="left"><input name="star" value="2" class="star" id="star2" <?php if($star_val != ''){ if(in_array(2,$star_val)){ echo "checked=checked"?> <?php }else{}}else{ } //echo 'checked=checked';?> type="checkbox" onclick="star_filter(2,1);" /></td>
              <td>2 Stars</td>
              <td>(<?php echo ($results_2star); ?>)</td>
            </tr>
            <tr>
              <td align="left"><input name="star" value="1" class="star" id="star1" <?php if($star_val != ''){ if(in_array(1,$star_val)){ echo "checked=checked"?> <?php }else{}}else{ } //echo 'checked=checked';?> type="checkbox" onclick="star_filter(1,1);"/></td>
              <td>1 Stars</td>
              <td>(<?php echo ($results_1star); ?>)</td>
            </tr>
            <tr>
              <td align="left"><input name="star" value="0" class="star" id="star0" <?php if($star_val != ''){ if(in_array(0,$star_val)){ echo "checked=checked"?> <?php }else{}}else{ } //echo 'checked=checked';?> type="checkbox" onclick="star_filter(0,1);" /></td>
              <td>Not Rated</td>
              <td>(<?php echo ($results_0star); ?>)</td>
            </tr>
          </table>