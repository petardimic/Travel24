 <?php 
 if($flight_result!='')
 {
	$r=0;
	foreach($flight_result['oneway'] as $testing_oneway)
	{
		$result_oneway[$r++]=$testing_oneway;
	}
	$r=0;
	foreach($flight_result['Return'] as $testing_return)
	{
		$result_return[$r++]=$testing_return;
	}
	if(!empty($result_oneway))
	{
		$id=$result_oneway[0]['rand_id'];
		$curr_code=$result_oneway[0]['ccode'];
		$lowest_price=$result_oneway[0]['Total_FareAmount'];
		$date_sess_sd=$_SESSION[$id]['sd'];
		$date_sess_ed=$_SESSION[$id]['ed'];
		$passenger_count=$_SESSION[$id]['adults']+$_SESSION[$id]['childs']+$_SESSION[$id]['infants'];
	}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
	//echo '<pre/>hjghj';print_r($result_oneway);echo '<pre/>hjghj';print_r($result_return);exit;
	$date_sd['cal_date'][0] = date('D j M',(strtotime("-3 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][1] = date('D j M',(strtotime("-2 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][2] = date('D j M',(strtotime("-1 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][3] = date('D j M',(strtotime("+0 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][4] = date('D j M',(strtotime("+1 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][5] = date('D j M',(strtotime("+2 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][6] = date('D j M',(strtotime("+3 day", (strtotime($date_sess_sd)))));
	
	
	$date_sd1['cal_date'][0] = date('d-m-Y',(strtotime("-3 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][1] = date('d-m-Y',(strtotime("-2 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][2] = date('d-m-Y',(strtotime("-1 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][3] = date('d-m-Y',(strtotime("+0 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][4] = date('d-m-Y',(strtotime("+1 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][5] = date('d-m-Y',(strtotime("+2 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][6] = date('d-m-Y',(strtotime("+3 day", (strtotime($date_sess_sd)))));
	
	$date_ed['cal_date'][0] = date('D j M',(strtotime("-3 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][1] = date('D j M',(strtotime("-2 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][2] = date('D j M',(strtotime("-1 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][3] = date('D j M',(strtotime("+0 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][4] = date('D j M',(strtotime("+1 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][5] = date('D j M',(strtotime("+2 day", (strtotime($date_sess_ed)))));
	$date_ed['cal_date'][6] = date('D j M',(strtotime("+3 day", (strtotime($date_sess_ed)))));
	
	$date_ed1['cal_date'][0] = date('d-m-Y',(strtotime("-3 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][1] = date('d-m-Y',(strtotime("-2 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][2] = date('d-m-Y',(strtotime("-1 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][3] = date('d-m-Y',(strtotime("+0 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][4] = date('d-m-Y',(strtotime("+1 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][5] = date('d-m-Y',(strtotime("+2 day", (strtotime($date_sess_ed)))));
	$date_ed1['cal_date'][6] = date('d-m-Y',(strtotime("+3 day", (strtotime($date_sess_ed)))));
	
	//echo 'frg';print_r($date_ed['cal_date'][2]);echo 'frg';print_r($date_ed1['cal_date'][2]);
	if(!empty($result_oneway))
	{
		for($i=0;$i<(count($result_oneway));$i++) 
		{
			if(is_array($result_oneway[$i]['ddate1']))
				$sd=$result_oneway[$i]['ddate1'][0];
			else
				$sd=$result_oneway[$i]['ddate1'];
			
			$cinval = explode("-",$sd);
			$sdd=$cinval[0]."-".$cinval[1]."-20".$cinval[2];
			$date_result_oneway=(date('D j M',((strtotime($sdd)))));
			for($k=0;$k<7;$k++)
			{			
				
				if($date_result_oneway==$date_sd['cal_date'][$k])
				{
					//$count=(count($result_return[$i]['adate1']));
					if(is_array($result_return[$i]['adate1']))
						$ed=$result_return[$i]['adate1'][0];
					else
						$ed=$result_return[$i]['adate1'];
											
					$cinval = explode("-",$ed);
					$edd=$cinval[0]."-".$cinval[1]."-20".$cinval[2];
					$date_result_return=(date('D j M',((strtotime($edd)))));
					
					for($j=0;$j<7;$j++)
					{
						if($date_result_return==$date_ed['cal_date'][$j])
						{
							$Total_FareAmount[$k][$j]=$result_oneway[$i]['Total_FareAmount'];
							$flight_id[$k][$j]=$result_oneway[$i]['id'];
							$flight_id1[$k][$j]=$result_return[$i]['id'];
							if((count($result_oneway[$i]['name']))<=1){
								$name[$k][$j]=$result_oneway[$i]['name'];
								$airline_code[$k][$j]=$result_oneway[$i]['fnumber'];}
							else{
								$name[$k][$j]=$result_oneway[$i]['name'][0];
								$airline_code[$k][$j]=$result_oneway[$i]['fnumber'][0];}
						}
					}
				}
			}
		}
	}

						
						?>
                         <div  id="flight_deatils">
                    		
                    </div>
                        <div class="home_page_calender_part">
                        <div class="row-fluid top20">
                <div class="span12">
                    <div class="flight-box-head" >
                        <strong>Lavpriskalender</strong>
                    </div>
                </div>
            </div>
                             <div class="flight-calander"> 
                                          
                        <table class="table cal-table">
                            <thead>
                                <tr>
                                    <th></th>
     <th>Departure<br/><?php $date=explode(" ",$date_ed['cal_date'][0]);
	 if($date[0]=='Mon')
	 { echo 'Mandag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Tue')
	 { echo 'Tirsdag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Wed')
	 { echo 'Onsdag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Thu')
	 { echo 'Torsdag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Fri')
	 { echo 'Fredag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Sun')
	 { echo 'Søndag '.$date[1].' '.$date[2]; }
	  if($date[0]=='Sat')
	 { echo 'Lørdag '.$date[1].' '.$date[2]; } ?></th>
    <th>Departure<br/><?php $date1=explode(" ",$date_ed['cal_date'][1]);
	 if($date1[0]=='Mon')
	 { echo 'Mandag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Tue')
	 { echo 'Tirsdag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Wed')
	 { echo 'Onsdag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Thu')
	 { echo 'Torsdag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Fri')
	 { echo 'Fredag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Sun')
	 { echo 'Søndag '.$date1[1].' '.$date1[2]; }
	  if($date1[0]=='Sat')
	 { echo 'Lørdag '.$date1[1].' '.$date1[2]; }
	?></th>
    <th>Departure<br/><?php $date2=explode(" ",$date_ed['cal_date'][2]);
	  if($date2[0]=='Mon')
	 { echo 'Mandag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Tue')
	 { echo 'Tirsdag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Wed')
	 { echo 'Onsdag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Thu')
	 { echo 'Torsdag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Fri')
	 { echo 'Fredag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Sun')
	 { echo 'Søndag '.$date2[1].' '.$date2[2]; }
	  if($date2[0]=='Sat')
	 { echo 'Lørdag '.$date2[1].' '.$date2[2]; }
	  ?></th>
    <th>Departure<br/><?php
	$date3=explode(" ",$date_ed['cal_date'][3]);
	 if($date3[0]=='Mon')
	 { echo 'Mandag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Tue')
	 { echo 'Tirsdag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Wed')
	 { echo 'Onsdag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Thu')
	 { echo 'Torsdag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Fri')
	 { echo 'Fredag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Sun')
	 { echo 'Søndag '.$date3[1].' '.$date3[2]; }
	  if($date3[0]=='Sat')
	 { echo 'Lørdag '.$date3[1].' '.$date3[2]; }
	 ?></th>
    <th>Departure<br/><?php 
	$date4=explode(" ",$date_ed['cal_date'][4]);
	 if($date4[0]=='Mon')
	 { echo 'Mandag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Tue')
	 { echo 'Tirsdag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Wed')
	 { echo 'Onsdag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Thu')
	 { echo 'Torsdag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Fri')
	 { echo 'Fredag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Sun')
	 { echo 'Søndag '.$date4[1].' '.$date4[2]; }
	  if($date4[0]=='Sat')
	 { echo 'Lørdag '.$date4[1].' '.$date4[2]; }
	 ?></th>
    <th>Departure<br/><?php 
	$date5=explode(" ",$date_ed['cal_date'][5]);
	 if($date5[0]=='Mon')
	 { echo 'Mandag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Tue')
	 { echo 'Tirsdag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Wed')
	 { echo 'Onsdag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Thu')
	 { echo 'Torsdag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Fri')
	 { echo 'Fredag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Sun')
	 { echo 'Søndag '.$date5[1].' '.$date5[2]; }
	  if($date5[0]=='Sat')
	 { echo 'Lørdag '.$date5[1].' '.$date5[2]; }
	 ?></th>
    <th>Departure<br/><?php
	$date6=explode(" ",$date_ed['cal_date'][6]);
	 if($date6[0]=='Mon')
	 { echo 'Mandag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Tue')
	 { echo 'Tirsdag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Wed')
	 { echo 'Onsdag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Thu')
	 { echo 'Torsdag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Fri')
	 { echo 'Fredag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Sun')
	 { echo 'Søndag '.$date6[1].' '.$date6[2]; }
	  if($date6[0]=='Sat')
	 { echo 'Lørdag '.$date6[1].' '.$date6[2]; }
	
	?></th>
                                </tr>
                            </thead>
                            <tbody>
                            
                            
                            <?php for($ii=0;$ii<7;$ii++)
		{
			?>
			<tr>
				<?php if($ii==3){
					
					?>
					<th  class="bg-cal" style="border:1px solid #DDDDDD;">Departure<br/><?php
					$datesd=explode(" ",$date_sd['cal_date'][$ii]);
					if($datesd[0]=='Mon')
	 { echo 'Mandag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Tue')
	 { echo 'Tirsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Wed')
	 { echo 'Onsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Thu')
	 { echo 'Torsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Fri')
	 { echo 'Fredag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Sun')
	 { echo 'Søndag '.$datesd[1].' '.$datesd[2]; }
	  if($datesd[0]=='Sat')
	 { echo 'Lørdag '.$datesd[1].' '.$datesd[2]; }
					
					 ?></th>
				<?php }else{?>
					<th  class="bg-cal" style="border:1px solid #DDDDDD;">Departure<br/><?php $datesd1=explode(" ",$date_sd['cal_date'][$ii]);
					if($datesd1[0]=='Mon')
	 { echo 'Mandag '.$datesd1[1].' '.$datesd1[2]; }
	 if($datesd1[0]=='Tue')
	 { echo 'Tirsdag '.$datesd1[1].' '.$datesd1[2]; }
	 if($datesd1[0]=='Wed')
	 { echo 'Onsdag '.$datesd1[1].' '.$datesd1[2]; }
	 if($datesd1[0]=='Thu')
	 { echo 'Torsdag '.$datesd1[1].' '.$datesd1[2]; }
	 if($datesd1[0]=='Fri')
	 { echo 'Fredag '.$datesd1[1].' '.$datesd1[2]; }
	 if($datesd1[0]=='Sun')
	 { echo 'Søndag '.$datesd1[1].' '.$datesd1[2]; }
	  if($datesd1[0]=='Sat')
	 { echo 'Lørdag '.$datesd1[1].' '.$datesd1[2]; }?></th>
				<?php } ?>
               
                <?php for($kk=0;$kk<7;$kk++){
					$date_id=$ii.$kk;
					$_SESSION[$id][$date_id]['date_sd']=$date_sd1['cal_date'][$ii];
					$_SESSION[$id][$date_id]['date_ed']=$date_ed1['cal_date'][$kk];
					
					if(isset($Total_FareAmount[$ii][$kk]))
					{ 
						if($Total_FareAmount[$ii][$kk]==$lowest_price)
						{
							if($flight_id[$ii][$kk]==$flight_id[3][3]){// echo '<pre>ghgh'.$ii.$kk;echo $Total_FareAmount[0][1];
							?>
                            
                            <td style="background-color: #00a38e;">
									<?php 
										if(isset($flight_id[$ii][$kk]))
										{?>
																					<?php 
										}
										else
										{
											?>  <a href="#" ><?php 
										}?>
										<?php if(isset($name[$ii][$kk])){
											
											?>
									</a>
                                     <input type="hidden" name="flight_id" id="flight_id" value="<?php echo $flight_id[$ii][$kk];?>" />
                                     <input type="hidden" name="flight_id1" id="flight_id1" value="<?php echo $flight_id1[$ii][$kk];?>" />
                                      <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                       <input type="hidden" name="date_id" id="date_id"  value="<?php echo $date_id;?>" />
                                       <span title="Flight Name: <?php echo $name[$ii][$kk]?> Flight Number: <?php echo $airline_code[$ii][$kk] ?> "><input onclick="showdetials(<?php echo $flight_id[$ii][$kk];?>,<?php echo $flight_id1[$ii][$kk];?>,<?php echo $date_id;?>)" type="submit" name="submit" id="submitssss" style="background:none; border:none;color:#fff; font-size:15px;text-align:center" value="<?php echo $Total_FareAmount[$ii][$kk].' EUR ';?>"  ></span>
                                     <?php }?> 
                                    </td>
				   <?php   }
				   else{?>
					                               <td class="calender_bg_div">
									<?php 
										if(isset($flight_id[$ii][$kk]))
										{?>
																					<?php 
										}
										else
										{
											?>  <a href="#" ><?php 
										}?>
										<?php if(isset($name[$ii][$kk])){
											
											?>
									</a>
                                     <input type="hidden" name="flight_id" id="flight_id" value="<?php echo $flight_id[$ii][$kk];?>" />
                                     <input type="hidden" name="flight_id1" id="flight_id1" value="<?php echo $flight_id1[$ii][$kk];?>" />
                                      <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                       <input type="hidden" name="date_id" id="date_id"  value="<?php echo $date_id;?>" />
                                       <span title="Flight Name: <?php echo $name[$ii][$kk]?> Flight Number: <?php echo $airline_code[$ii][$kk] ?> "><input onclick="showdetials(<?php echo $flight_id[$ii][$kk];?>,<?php echo $flight_id1[$ii][$kk];?>,<?php echo $date_id;?>)" type="submit" name="submit" id="submitssss" style="background:none; border:none;color:#fff; font-size:15px;text-align:center" value="<?php echo $Total_FareAmount[$ii][$kk].' EUR ';?>"  ></span></br>
                                      <?php }?>
                                    </td>
					   <?php 
				   
				    }}
						else
						{if($flight_id[$ii][$kk]==$flight_id[3][3]){?>
							<td style="background-color: #00a38e;">
								
									<?php if(isset($flight_id[$ii][$kk])){?>
									
										<?php }else{?><a href="#"><?php }?>
									<?php if(isset($name[$ii][$kk])){
											
											?>
                                       
                                        <input type="hidden" name="flight_id" id="flight_id" value="<?php echo $flight_id[$ii][$kk];?>" />
                                     <input type="hidden" name="flight_id1" id="flight_id1" value="<?php echo $flight_id1[$ii][$kk];?>" />
                                      <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                       <input type="hidden" name="date_id" id="date_id"  value="<?php echo $date_id;?>" />
                                       <span title="Flight Name: <?php echo $name[$ii][$kk]?> Flight Number: <?php echo $airline_code[$ii][$kk] ?> "><input onclick="showdetials(<?php echo $flight_id[$ii][$kk];?>,<?php echo $flight_id1[$ii][$kk];?>,<?php echo $date_id;?>)" type="submit" name="submit" id="submitssss" style="background:none; border:none;color:#fff; font-size:15px;text-align:center" value="<?php echo $Total_FareAmount[$ii][$kk].' EUR';?>"  ></span>
                                       
                                       <?php }?>
                                    </td>
				  <?php } else{
	?>		
    
    <td class="calender_bg_div">
								
									<?php if(isset($flight_id[$ii][$kk])){?>
									
										<?php }else{?><a href="#"><?php }?>
									<?php if(isset($name[$ii][$kk])){
											
											?>
                                       
                                        <input type="hidden" name="flight_id" id="flight_id" value="<?php echo $flight_id[$ii][$kk];?>" />
                                     <input type="hidden" name="flight_id1" id="flight_id1" value="<?php echo $flight_id1[$ii][$kk];?>" />
                                      <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                       <input type="hidden" name="date_id" id="date_id"  value="<?php echo $date_id;?>" />
                                       <span title="Flight Name: <?php echo $name[$ii][$kk]?> Flight Number: <?php echo $airline_code[$ii][$kk] ?> "><input  type="submit" name="submit" id="submitssss" style="background:none; border:none;color:#fff; font-size:15px;text-align:center" value="<?php echo $Total_FareAmount[$ii][$kk].' EUR';?>"  ></span>
                                       
                                       <?php }?>
                                    </td>	  
				  
			<?php  } 
				    }
					}
					else
					{ ?>
						<td class="calender_bg_div">
								
								<?php if(isset($flight_id[$ii][$kk])){?>
								<a id="showdetails" href="#">
									<?php }else{?><a href="#"><?php }?>
									<?php echo "No Fares";?>
								</a>
							
						</td>	
			  <?php } ?>
			  
			             
			  <?php }
				?>
				</tr>
			  <?php }  ?>
                            
                                   
                            </tbody>
                        </table>
                        
                  
                    
                    <?php }?>
                   
					</div>
                    
                    
                    <div class="home_page_add_part">
                    <div class="well top20" style="padding: 5px;">
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="<?php print WEB_DIR ?>images/img/add1.png">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="<?php print WEB_DIR ?>images/img/add2.png">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="<?php print WEB_DIR ?>images/img/add3.png">
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">                                
                            <img src="<?php print WEB_DIR ?>images/img/add4.png">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                </div>
           
           <script>
/*function showdetials(id,id1,date)
{
	
	
	
	
	alert(id);
	alert(id1);
	alert(date);
	var ids = document.getElementById("id").value;
	alert(ids);
    $.ajax({
        url: "<?php echo WEB_URL; ?>flight/calendar_flight_detail",
        type: "post",
        data: 'id=' + id + '&id1=' + id1 + '&ids=' + ids + '&date=' + date,
        success: function(data){
           // $("#loder").hide();
            $("#flight_deatils").html(data);
        },
        error:function(){
            
            $("#flight_deatils").html('Oops! no results found.');
        }
    });
});

}*/


 function showdetials(id,id1,date) {
	 var ids = document.getElementById("id").value;
	 alert(id);
	 alert(id1);
	 alert(date);
	 alert(ids);
	 $("#flight_deatils").html('');

$.ajax({
           type: "POST",
           url: "<?php echo WEB_URL; ?>flight/calendar_flight_detail",
           data: 'id=' + id + '&id1=' + id1 + '&ids=' + ids + '&date=' + date,
           success:function(data) {
            $("#flight_deatils").html(data);
           }

      });
}
//Call AJAX:
//$(document).ready(showdetials);
</script>
  <script type="text/javascript">
	 //function showdetials(id){
  /* Attach a submit handler to the form */
//$("#show").submit(function(event) {
alert(id);
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#flight_deatils").html('');
    //var loder='<div id="loder" style="margin-left:350px;"><img src="<?php echo WEB_DIR; ?>images/1c5b8_loading_big_transparent.gif" /></div>';
    //$("#flight_details").html(loder);
	
    /* Get some values from elements on the page: */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div */
	 var flight_id = $('#flight_id<?php echo  $ii.$kk?>').val();
	 var flight_id1 = $('#flight_id1').val();
	 var id = $('#id').val();
	 var date_id=$('#date_id').val();
	 alert(flight_id);
    $.ajax({
        url: "<?php echo WEB_URL; ?>flight/calendar_flight_detail",
        type: "post",
        data: 'flight_id=' + flight_id + '&flight_id1=' + flight_id1 + '&id=' + id + '&date_id=' + date_id,
        success: function(data){
           // $("#loder").hide();
            $("#flight_deatils").html(data);
        },
        error:function(){
            
            $("#flight_deatils").html('Oops! no results found.');
        }
    });
});
 
	// }
</script>   