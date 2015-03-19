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
	//echo '<pre/>';print_r($result_oneway);print_r($result_return);exit;
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
							if((count($result_oneway[$i]['name']))<=1)
								$name[$k][$j]=$result_oneway[$i]['name'];
							else
								$name[$k][$j]=$result_oneway[$i]['name'][0];
						}
					}
				}
			}
		}
	}

						
						?>
                                        
                        <table class="table cal-table">
                            <thead>
                                <tr>
                                    <th></th>
     <th>Retur<br/><?php $date=explode(" ",$date_ed['cal_date'][0]);
	 if($date[0]=='Mon')
	 { echo 'Mandag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Tue')
	 { echo 'Tirsdag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Wed')
	 { echo 'Onsdag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Thur')
	 { echo 'Torsdag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Fri')
	 { echo 'Fredag '.$date[1].' '.$date[2]; }
	 if($date[0]=='Sun')
	 { echo 'Søndag '.$date[1].' '.$date[2]; }
	  if($date[0]=='Sat')
	 { echo 'Lørdag '.$date[1].' '.$date[2]; } ?></th>
    <th>Retur<br/><?php $date1=explode(" ",$date_ed['cal_date'][1]);
	 if($date1[0]=='Mon')
	 { echo 'Mandag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Tue')
	 { echo 'Tirsdag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Wed')
	 { echo 'Onsdag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Thur')
	 { echo 'Torsdag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Fri')
	 { echo 'Fredag '.$date1[1].' '.$date1[2]; }
	 if($date1[0]=='Sun')
	 { echo 'Søndag '.$date1[1].' '.$date1[2]; }
	  if($date1[0]=='Sat')
	 { echo 'Lørdag '.$date1[1].' '.$date1[2]; }
	?></th>
    <th>Retur<br/><?php $date2=explode(" ",$date_ed['cal_date'][2]);
	  if($date2[0]=='Mon')
	 { echo 'Mandag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Tue')
	 { echo 'Tirsdag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Wed')
	 { echo 'Onsdag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Thur')
	 { echo 'Torsdag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Fri')
	 { echo 'Fredag '.$date2[1].' '.$date2[2]; }
	 if($date2[0]=='Sun')
	 { echo 'Søndag '.$date2[1].' '.$date2[2]; }
	  if($date2[0]=='Sat')
	 { echo 'Lørdag '.$date2[1].' '.$date2[2]; }
	  ?></th>
    <th>Retur<br/><?php
	$date3=explode(" ",$date_ed['cal_date'][3]);
	 if($date3[0]=='Mon')
	 { echo 'Mandag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Tue')
	 { echo 'Tirsdag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Wed')
	 { echo 'Onsdag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Thur')
	 { echo 'Torsdag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Fri')
	 { echo 'Fredag '.$date3[1].' '.$date3[2]; }
	 if($date3[0]=='Sun')
	 { echo 'Søndag '.$date3[1].' '.$date3[2]; }
	  if($date3[0]=='Sat')
	 { echo 'Lørdag '.$date3[1].' '.$date3[2]; }
	 ?></th>
    <th>Retur<br/><?php 
	$date4=explode(" ",$date_ed['cal_date'][4]);
	 if($date4[0]=='Mon')
	 { echo 'Mandag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Tue')
	 { echo 'Tirsdag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Wed')
	 { echo 'Onsdag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Thur')
	 { echo 'Torsdag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Fri')
	 { echo 'Fredag '.$date4[1].' '.$date4[2]; }
	 if($date4[0]=='Sun')
	 { echo 'Søndag '.$date4[1].' '.$date4[2]; }
	  if($date4[0]=='Sat')
	 { echo 'Lørdag '.$date4[1].' '.$date4[2]; }
	 ?></th>
    <th>Retur<br/><?php 
	$date5=explode(" ",$date_ed['cal_date'][5]);
	 if($date5[0]=='Mon')
	 { echo 'Mandag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Tue')
	 { echo 'Tirsdag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Wed')
	 { echo 'Onsdag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Thur')
	 { echo 'Torsdag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Fri')
	 { echo 'Fredag '.$date5[1].' '.$date5[2]; }
	 if($date5[0]=='Sun')
	 { echo 'Søndag '.$date5[1].' '.$date5[2]; }
	  if($date5[0]=='Sat')
	 { echo 'Lørdag '.$date5[1].' '.$date5[2]; }
	 ?></th>
    <th>Retur<br/><?php
	$date6=explode(" ",$date_ed['cal_date'][6]);
	 if($date6[0]=='Mon')
	 { echo 'Mandag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Tue')
	 { echo 'Tirsdag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Wed')
	 { echo 'Onsdag '.$date6[1].' '.$date6[2]; }
	 if($date6[0]=='Thur')
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
			<tr class="null-bg">
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
	 if($datesd[0]=='Thur')
	 { echo 'Torsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Fri')
	 { echo 'Fredag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Sun')
	 { echo 'Søndag '.$datesd[1].' '.$datesd[2]; }
	  if($datesd[0]=='Sat')
	 { echo 'Lørdag '.$datesd[1].' '.$datesd[2]; }
					
					 ?></th>
				<?php }else{?>
					<th  class="bg-cal" style="border:1px solid #DDDDDD;">Departure<br/><?php $datesd=explode(" ",$date_sd['cal_date'][$ii]);
					if($datesd[0]=='Mon')
	 { echo 'Mandag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Tue')
	 { echo 'Tirsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Wed')
	 { echo 'Onsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Thur')
	 { echo 'Torsdag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Fri')
	 { echo 'Fredag '.$datesd[1].' '.$datesd[2]; }
	 if($datesd[0]=='Sun')
	 { echo 'Søndag '.$datesd[1].' '.$datesd[2]; }
	  if($datesd[0]=='Sat')
	 { echo 'Lørdag '.$datesd[1].' '.$datesd[2]; }?></th>
				<?php } ?>
               
                <?php for($kk=0;$kk<7;$kk++){
					$date_id=$ii.$kk;
					$_SESSION[$id][$date_id]['date_sd']=$date_sd1['cal_date'][$ii];
					$_SESSION[$id][$date_id]['date_ed']=$date_ed1['cal_date'][$kk];
					
					if(isset($Total_FareAmount[$ii][$kk]))
					{ 
						if($Total_FareAmount[$ii][$kk]==$lowest_price)
						{
							// echo '<pre>ghgh'.$ii.$kk;echo $Total_FareAmount[0][1];
							?>
                            <td class="calender_bg_div">
									<?php 
										if(isset($flight_id[$ii][$kk]))
										{?>
											<a target="_blank" href="<?php echo WEB_URL.'flight/calendar_flight_detail/'.$flight_id[$ii][$kk]."/".$flight_id1[$ii][$kk] ?>/<?php echo $id ?>/<?php echo $date_id ?>">
											<?php 
										}
										else
										{
											?>  <a href="#"><?php 
										}?>
										<?php if(isset($name[$ii][$kk])){ echo substr($name[$ii][$kk],0,25)."<br/><span> From </span><strong><span>".$Total_FareAmount[$ii][$kk]."<br/></span></strong><span>for ".$passenger_count." Passenger(s)</span><br><span style='color:red; line-height:10px;'>* Lowest Price</span>"; }else { echo "" ; } ?>
									</a>
                                    
                                    </td>
				   <?php }
						else
						{?>
							<td class="calender_bg_div">
								
									<?php if(isset($flight_id[$ii][$kk])){?>
									<a target="_blank" href="<?php echo WEB_URL.'flight/calendar_flight_detail/'.$flight_id[$ii][$kk]."/".$flight_id1[$ii][$kk] ?>/<?php echo $id ?>/<?php echo $date_id ?>">
										<?php }else{?><a href="#"><?php }?>
									<?php if(isset($name[$ii][$kk])){ echo substr($name[$ii][$kk],0,25)."<br/><strong><span>".$Total_FareAmount[$ii][$kk].' EUR'."<br/></span></strong>"; }else { echo "" ; } ?>
									</a>
                                    
                                    
                                    </td>
				  <?php }
					}
					else
					{ ?>
						<td  class="calender_bg_div">
								
								<?php if(isset($flight_id[$ii][$kk])){?>
								<a target="_blank" href="<?php echo WEB_URL.'flight/calendar_flight_detail/'.$flight_id[$ii][$kk]."/".$flight_id1[$ii][$kk] ?>/<?php echo $id ?>/<?php echo $date_id ?>">
									<?php }else{?><a href="#"><?php }?>
									<?php echo "No Fares";?>
								</a>
							
						</td>	
			  <?php } }
				?>
				</tr>
			  <?php }  ?>
                            
                                   
                            </tbody>
                        </table>
                        <!--                       <div class="page-header">
                        
                                        <div class="pull-right form-inline">
                                                <div class="btn-group">
                                                        <button class="btn btn-primary" data-calendar-nav="prev">&lt;&lt; Prev</button>
                                                        <button class="btn" data-calendar-nav="today">Today</button>
                                                        <button class="btn btn-primary" data-calendar-nav="next">Next &gt;&gt;</button>
                                                </div>
                                                <div class="btn-group">
                                                        <button class="btn btn-warning" data-calendar-view="year">Year</button>
                                                        <button class="btn btn-warning active" data-calendar-view="month">Month</button>
                                                        <button class="btn btn-warning" data-calendar-view="week">Week</button>
                                                        <button class="btn btn-warning" data-calendar-view="day">Day</button>
                                                </div>
                                        </div>
                        
                                        <h3>March 2013</h3>
                                </div>
                                                <div class="row-fluid">
                                                    <div class="span12">
                                                       <div id="calendar"></div>
                                                    </div>
                                                </div>-->
                  
                    
                    <?php }?>