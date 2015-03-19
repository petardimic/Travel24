 <?php 
//echo '<pre/>soma';print_r($flight_result);exit;
 if($flight_result!='')
 {
	$r=0;
	foreach($flight_result as $testing_oneway)
	{
		$result_oneway[$r++]=$testing_oneway;
	}
	
	if(!empty($result_oneway))
	{
		$id=$result_oneway[0]['rand_id'];
		$curr_code=$result_oneway[0]['ccode'];
		$lowest_price=$result_oneway[0]['Total_FareAmount'];
		$date_sess_sd=$_SESSION[$id]['sd'];
		//echo $date_sess_sd;
		$newdate=explode('-',$date_sess_sd);
		$year=str_split($newdate[2]);
		$orig_date= $newdate[0].'-'.$newdate[1].'-'.$year[2].$year[3];
		//echo $newdate[0].'/'.$newdate[1].'/'.$year[2].$year[3];
		$date_sess_ed=$_SESSION[$id]['ed'];
		$passenger_count=$_SESSION[$id]['adults']+$_SESSION[$id]['childs']+$_SESSION[$id]['infants'];
	}
	else
	{
		$id=0;$lowest_price=0;
		$date_sess=date("m-d-y");
		$date_sess_ed=date("m-d-y");
	}
	//echo '<pre/>';print_r($result_oneway);print_r($result_return);
	$date_sd['cal_date'][0] = date('D j M',(strtotime("-3 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][1] = date('D j M',(strtotime("-2 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][2] = date('D j M',(strtotime("-1 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][3] = date('D j M',(strtotime("+0 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][4] = date('D j M',(strtotime("+1 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][5] = date('D j M',(strtotime("+2 day", (strtotime($date_sess_sd)))));
	$date_sd['cal_date'][6] = date('D j M',(strtotime("+3 day", (strtotime($date_sess_sd)))));
	//echo $date_sd['cal_date'][3];
	
	$date_sd1['cal_date'][0] = date('d-m-Y',(strtotime("-3 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][1] = date('d-m-Y',(strtotime("-2 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][2] = date('d-m-Y',(strtotime("-1 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][3] = date('d-m-Y',(strtotime("+0 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][4] = date('d-m-Y',(strtotime("+1 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][5] = date('d-m-Y',(strtotime("+2 day", (strtotime($date_sess_sd)))));
	$date_sd1['cal_date'][6] = date('d-m-Y',(strtotime("+3 day", (strtotime($date_sess_sd)))));
	//echo '<pre>'; print_r($date_sess_sd);
	
	
	
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
		
				
	
					//$count=(count($result_return[$i]['adate1']));
					if(is_array($result_oneway[$i]['adate1']))
						$ed=$result_oneway[$i]['adate1'][0];
					else
						$ed=$result_oneway[$i]['adate1'];
											
					$cinval = explode("-",$ed);
					$edd=$cinval[0]."-".$cinval[1]."-20".$cinval[2];
					$date_result_return=(date('D j M',((strtotime($edd)))));
					$Total_FareAmount=$result_oneway[$i]['Total_FareAmount'];
					$flight_id=$result_oneway[$i]['id'];
					if((count($result_oneway[$i]['name']))<=1)
								$name=$result_oneway[$i]['name'];
							else
								$name=$result_oneway[$i]['name'][0];
						
					
				
		
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
                           
                                <tr>
                                 <th></th>
     <th>Departure<br/><?php $date=explode(" ",$date_sd['cal_date'][0]);
	// print_r($date);exit;
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
    <th>Departure<br/><?php $date1=explode(" ",$date_sd['cal_date'][1]);
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
    <th>Departure<br/><?php $date2=explode(" ",$date_sd['cal_date'][2]);
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
	$date3=explode(" ",$date_sd['cal_date'][3]);
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
	$date4=explode(" ",$date_sd['cal_date'][4]);
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
	$date5=explode(" ",$date_sd['cal_date'][5]);
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
	$date6=explode(" ",$date_sd['cal_date'][6]);	
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
                            
                          
                            
                           
			<tr >
				<td></td>
					
                <?php 
                    $cal_date = array();
				    $cal_date[] = date('Y-m-d',(strtotime("-3 day", (strtotime($date_sess_sd)))));
					$cal_date[] = date('Y-m-d',(strtotime("-2 day", (strtotime($date_sess_sd)))));
					$cal_date[] = date('Y-m-d',(strtotime("-1 day", (strtotime($date_sess_sd)))));
					$cal_date[] = date('Y-m-d',(strtotime("0 day", (strtotime($date_sess_sd)))));
					$cal_date[] = date('Y-m-d',(strtotime("+1 day", (strtotime($date_sess_sd)))));
					$cal_date[] = date('Y-m-d',(strtotime("+2 day", (strtotime($date_sess_sd)))));
					$cal_date[] = date('Y-m-d',(strtotime("+3 day", (strtotime($date_sess_sd)))));
					
		 for($d=0;$d<count($cal_date);$d++) { 
			 
				for($kk=0;$kk<count($flight_result);$kk++){		
					
					$_SESSION[$id][$date_id]['date_sd']=$date_sd1['cal_date'][$kk];
					$flight_id1=$flight_result[$kk]['id'];
					$Total_FareAmount1=$flight_result[$kk]['Total_FareAmount'];
					$name=$flight_result[$kk]['name'][0];
					$airline_code=$flight_result[$kk]['fnumber'][0];
					$orig_date1= $flight_result[$kk]['adate1'][0];
					$idss= $flight_result[$kk]['rand_id'];
					$orig_date2=explode(' ',$orig_date1);
					//print_r($orig_date2);
					$orig_date3 = $orig_date2[0];
					//echo $flight_result[$kk]['dep_date'][0].'  '.$orig_date;
					//echo strtotime(date('Y-m-d',strtotime($orig_date3))).' '.strtotime(date('Y-m-d',strtotime($orig_date)));
					if(isset($Total_FareAmount1))
					{ 	
								 if(strtotime(date('d-m-y',strtotime($cal_date[$d])))==strtotime($orig_date3)){ if($d==3){?>
							<td style="background-color:#00a38e;">
								
									<?php if(isset($flight_id1)){?>
									
										<?php }else{?><a href="#"><?php }?>
									<span title="Flight Name: <?php echo $name?> Flight Number: <?php echo $airline_code ?> "><input onclick="showdetials(<?php echo $flight_id1;?>)" type="submit" name="submit" id="submitssss" style="background:none; border:none;color:#fff; font-size:15px;text-align:center" value="<?php echo $Total_FareAmount1.' EUR ';?>"  ></span>
									</a>
                                    
                                    
                                    </td>
				  <?php }else {?>
				  
				  <td class="calender_bg_div">
								
									<?php if(isset($flight_id1)){?>
									
										<?php }else{?><a href="#"><?php }?>
									<span title="Flight Name: <?php echo $name?> Flight Number: <?php echo $airline_code ?> "><input  type="submit" name="submit" id="submitssss" style="background:none; border:none;color:#fff; font-size:15px;text-align:center" value="<?php echo $Total_FareAmount1.' EUR ';?>"  ></span>
									</a>
                                    
                                    
                                    </td>
				  <?php }break;}
					}
					else
					{ ?>
						<td  class="calender_bg_div">
								
								<?php if(isset($flight_id1)){?>
								
									<?php }else{?><a href="#"><?php }?>
									<?php echo "No Fares";?>
								</a>
							
						</td>	
			  <?php } } }
				?>
				</tr>
			  <?php }  ?>

                        </table>
                        </div>
 <script>
 function showdetials(id) {
	//alert(id);
	
	 $("#flight_deatils").html('');

$.ajax({
           type: "POST",
           url: "<?php echo WEB_URL; ?>flight/calendar_flight_detail_oneway",
           data: 'id=' + id  ,
           success:function(data) {
            $("#flight_deatils").html(data);
           }

      });
}
</script>
