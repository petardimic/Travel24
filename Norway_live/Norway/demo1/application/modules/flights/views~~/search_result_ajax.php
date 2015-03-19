<?php
$totalPriceAry=array();

$noofPassenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];
//echo '<pre/>';print_r($flight_result);exit;
if($flight_result != '')
{
	$r=0;
	$count_val = count($flight_result);
	foreach($flight_result as $testing)
	{
		$result[$r++]=$testing;
	}
		 $id=$result[0]['rand_id'];
		 $fcityname=explode(",",$_SESSION['fromcityval']);
		 $fcount_city_code=(count($fcityname));
		 $from_city_code=$fcityname[($fcount_city_code-1)];
		 
		 $tcityname=explode(",",$_SESSION['tocityval']);
		 $tcount_city_code=(count($tcityname));
		 $to_city_code=$tcityname[($tcount_city_code-1)];
		 
		 $flight_result_temp=$_SESSION[$id]['flight_result1'];
		 $iii=0;
		 foreach($flight_result_temp as $testing_final)
			$flightDetails1[$iii++]=$testing_final;
		
		$result1=$flight_result;
		$s1='';
		if($result1 != '')
		{
			$a1=array();
			$t1=0;
			foreach($result1 as $price1)
			{
				if(in_array(($price1['Total_FareAmount']),$a1))
				{
					$s1[$t1][]=$price1;
					
				}
				else
				{
					$s1[($t1+1)][]=$price1;
					$a1[] = $price1['Total_FareAmount'];
				}
				$t1 = count($a1);
			}
		}
		
		$result11=$flightDetails1;
		$s11='';
		if($result11 != '')
		{
			$a11=array();
			$t11=0;
			foreach($result11 as $price11)
			{
				if(in_array(($price11['totalFareAmount']),$a11))
				{
					$s11[$t11][]=$price11;
					
				}
				else
				{
					$s11[($t11+1)][]=$price11;
					$a11[] = $price11['totalFareAmount'];
				}
				$t11 = count($a11);
			}
		}
			     
			     
//echo '<pre/>';print_r($s11);exit;
?>


<?php
	$airport='';$i=0;	
	$flight_result=$s1;
	$flightDetails1=$s11;
	//echo '<pre/>';print_r($flight_result);exit;
	//echo '<pre/>';print_r($flightDetails1);exit;
	if($flight_result != '')
	{
		$count_val = count($flight_result);
		for($i=1;$i<=$count_val;$i++)
		{
                    
			$used_oneway = array();$used_oneway1 = array();
			$count_val_oneway= count($flight_result[$i]);
			
			for( $iii=0; $iii<$count_val_oneway; $iii++ ) 
			{
				if ( in_array( $flight_result[$i][$iii]['timeOfDeparture'], $used_oneway ) ) 
				{
					
				}
				else 
				{
					$used_oneway[] = $flight_result[$i][$iii]['timeOfDeparture'];
					$used_oneway1[] = $flight_result[$i][$iii];
				}
			}
			
			$flight_result[$i]=$used_oneway1;
			$usernames = array();
            foreach ($flight_result[$i] as $user) {
                $usernames[] = $user['timeOfDeparture'];
            }
            array_multisort($usernames, SORT_ASC, $flight_result[$i]);
            
			
			$count_val1 = count($flight_result[$i]);
			for($j=0;$j<1;$j++)
			{
                            if($flight_result[$i][$j]['Total_FareAmount']!='')
                            {
                                $totalPriceAry[]= $flight_result[$i][$j]['Total_FareAmount'];
                            
				if($flight_result[$i][$j]['flag']=='false')
				{
					$dep_name=$this->Flights_Model->get_City_name($flight_result[$i][$j]['dlocation']);
					$arr_name=$this->Flights_Model->get_City_name($flight_result[$i][$j]['alocation']);
					
					$dep_name_final=$dep_name->city.", ".$dep_name->country." (".$dep_name->city_code.")";
					$arr_name_final=$arr_name->city.", ".$arr_name->country." (".$arr_name->city_code.")";
					
					$date=$flight_result[$i][$j]['ddate1'];
					$date1=explode(" ",$date);
					$date_2=explode("-",$date1[0]);
					$date_final_on=$date_2[0]."-".$date_2[1]."-20".$date_2[2];
					$de_date = date('F j, Y',(strtotime("+0 day", (strtotime($date_final_on)))));
                                        
					$ddate=explode(' ',$flight_result[$i][$j]['ddate1']);
                                        $adate=explode(' ',$flight_result[$i][$j]['adate1']);
                                        $duration=explode(' ',$flight_result[$i][$j]['duration_final1']);
                                        $durCount=count($duration);
                                        if($durCount==3)
                                        {
                                            $duration0=explode('D',$duration[0]);
                                            $duration1=explode('H',$duration[1]);
                                            $duration2=explode('M',$duration[2]);
                                            $durationInMin=($duration0[0]*24*60)+($duration1[0]*60)+$duration2[0];
                                            $durationMinSec=($duration0[0]*24)+$duration1[0].'H '.$duration2[0].'M';
                                        }
                                        else if($durCount==2)
                                        {
                                            $duration1=explode('H',$duration[0]);
                                            $duration2=explode('M',$duration[1]);
                                            $durationInMin=($duration1[0]*60)+$duration2[0];
                                            $durationMinSec=$flight_result[$i][$j]['duration_final1'];
                                        }
                                        else
                                        {
                                            $duration2=explode('M',$duration[0]);
                                            $durationInMin=$duration2[0];
                                            $durationMinSec=$flight_result[$i][$j]['duration_final1'];
                                        }
                                        
?>
<div class="searchflight_box">
    <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result[$i][$j]['name']; ?>" data-departure="<?php echo $flight_result[$i][$j]['dtime_filter']; ?>" data-arrival="<?php echo $flight_result[$i][$j]['atime_filter']; ?>" data-duration="<?php echo $durationInMin; ?>" data-price="<?php echo $flight_result[$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result[$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result[$i][$j]['fareType']; ?>">
        <div class="detail_bar"><img src="<?php echo base_url(); ?>assets/images/deal.png" align="absmiddle" />Use this coupon FLIGHT150 for getting Rs. 150 cashback <a href="">Know more</a></div>
        <div class=" wid80 fleft top10 left10"><img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result[$i][$j]['cicode']; ?>.gif" /><br /><?php echo $flight_result[$i][$j]['name']; ?></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:30px; text-align:center;" ><?php echo $ddate[1]; ?><br /><span style="font-weight:normal; color:#4a4a4a;"> <?php echo $flight_result[$i][$j]['dlocation']; ?> </span></div>
        <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:20px;" ><?php echo $adate[1]; ?><br /> <span style="font-weight:normal; color:#4a4a4a;"><?php echo $flight_result[$i][$j]['alocation']; ?> </span></div>
        <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $durationMinSec; ?> <br /><span style="font-weight:normal; color:#4a4a4a;"><?php echo($flight_result[$i][$j]['stops']>0 ? $flight_result[$i][$j]['stops'].' Stops' : 'Non Stop') ?></span></div>
        <div class="wid170 fleft left60 top10 fleft" style="line-height:18px; text-align:right;"><span class="details_price_small_txt">&#36; <?php echo $flight_result[$i][$j]['Total_FareAmount'] + ($flight_result[$i][$j]['Total_FareAmount'] *5/100); ?></span>  <span class="left10">  <span class="details_price_txt">&#36;&nbsp;<?php echo $flight_result[$i][$j]['Total_FareAmount']; ?></span></span> <br /><span class="detail_txt" style="color:#333;">
			<?php 
				if($flight_result[$i][$j]['fareType']=='RP')
					echo 'Non-Refundable';
				else echo 'Refundable';
			 ?>
			</span><span id="details<?php echo $i; ?>" class="detail_txt"><img src="<?php echo base_url(); ?>assets/images/plus_icon.png" align="absmiddle" />Details</span></div>
        <div class="book_btn fleft"><a href="<?php echo site_url(); ?>/flights/flight_details/<?php echo $flight_result[$i][$j]['id']; ?>/<?php echo $flight_result[$i][$j]['rand_id']; ?>">BOOK</a></div>
        <div id="flightdetails<?php echo $i; ?>" style="color:#000; display:none;">
                <div align="center" class="top10">
                    <img src="<?php echo base_url(); ?>assets/images/details_devider.jpg" />
                </div>
                <div class="fleft wid500">
                    <div style="font-size:14px;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                    <div class="fleft wid125 top20">
                        <div class="wid40 fleft" style="width:60px;">
                            <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result[$i][$j]['cicode']; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result[$i][$j]['name']; ?><br /> 
                            <?php echo $flight_result[$i][$j]['cicode'].' - '.$flight_result[$i][$j]['fnumber']; ?><br /> 
                            <?php 
								$cabin_value=$flight_result[$i][$j]['cabin'];
								if ($cabin_value == "F")
									$cabin_code = "First, Supersonic";
								else if ($cabin_value == "C")
									$cabin_code = "Business";
								else if ($cabin_value == "Y")
									$cabin_code = "Economic";
								else if ($cabin_value == "W")
									$cabin_code = "Premium Economy";
								else if ($cabin_value == "M")
									$cabin_code = "Standard Economy";
								else $cabin_code='';
									
									echo $cabin_code;
                            ?></div>
                    </div>
                    <div class="wid140 fleft top20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result[$i][$j]['dlocation']; ?> <strong><?php echo $ddate[1]; ?></strong></span><br />
                        <?php $dateDep=date("jS, F Y", strtotime($flight_result[$i][$j]['dep_date'])); echo $dateDep; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:18px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <br /><?php echo $flight_result[$i][$j]['duration_final1']; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result[$i][$j]['alocation']; ?> <strong><?php echo $adate[1]; ?></strong></span><br />
                        <?php $dateArr=date("jS, F Y", strtotime($flight_result[$i][$j]['arv_date'])); echo $dateArr; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="clear"></div>
                    <?php /*?><div class="fair_blue_txt top10">Baggage - 20kg allowed</div><?php */?>
                </div>
                <div class="fright wid225" style="margin-right:20px;">
                    <div class="fairprice_bg">
                        <div class="fair_txt" style="line-height:18px;">Fare breakup</div>
                        <div class="fleft wid100 fair_txt_small top10"  >Base Fare<br />
                            Taxes & Fees<br />
                            Total
                        </div>
                        <div class="fleft wid100 fair_txt_small top10 left20"  >USD <?php echo($flight_result[$i][$j]['Total_FareAmount']-$flight_result[$i][$j]['TaxAmount']); ?><br />
                            USD <?php echo $flight_result[$i][$j]['TaxAmount']; ?><br />
                            USD <?php echo $flight_result[$i][$j]['Total_FareAmount']; ?>
                        </div>
                        <div class="clear"> </div>
    <!--                    <div class="fair_txt" style="line-height:18px; margin-top:10px;">Airline Refund Policy</div>
                        <div class="fleft fair_txt_small top10"  > Cancelation fee Rs.1,500 / Person <br /> Cancelation fee Rs.1,500 / Person  </div>-->
                    </div>
                </div>
            </div>
            <div style="clear:both;"></div>
    </div><div style="clear:both;"></div>
</div>
<?php 
    }
    else
    {
        $stops=$flight_result[$i][$j]['stops'];
        $count=count($flight_result[$i][$j]['dlocation']);
        
        $ddate=explode(' ',$flight_result[$i][$j]['ddate1'][0]);
        $adate=explode(' ',$flight_result[$i][$j]['adate1'][$stops]);
        
        $duration=explode(' ',$flight_result[$i][$j]['duration_final_eft']);
        $durCount=count($duration);
        
        if($durCount==3)
        {
            
            $duration0=explode('D',$duration[0]);
            $duration1=explode('H',$duration[1]);
            $duration2=explode('M',$duration[2]);
            $durationInMin1=($duration0[0]*24*60)+($duration1[0]*60)+$duration2[0];
            $durationMinSec1=($duration0[0]*24)+$duration1[0].'H '.$duration2[0].'M';
        }
        else if($durCount==2)
        {
            $duration1=explode('H',$duration[0]);
            $duration2=explode('M',$duration[1]);
            $durationInMin1=($duration1[0]*60)+$duration2[0];
            $durationMinSec1=$flight_result[$i][$j]['duration_final_eft'];
        }
        else
        {
            $duration2=explode('M',$duration[1]);
            $durationInMin1=$duration2[0];
            $durationMinSec1=$flight_result[$i][$j]['duration_final_eft'];
        }


?>
<div class="searchflight_box"><div style="clear:both;"></div>
    <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result[$i][$j]['name'][0]; ?>" data-departure="<?php echo $flight_result[$i][$j]['timeOfDeparture'][0]; ?>" data-arrival="<?php echo $flight_result[$i][$j]['timeOfArrival'][$stops]; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo $flight_result[$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result[$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result[$i][$j]['fareType'][0]; ?>">
        <div class="detail_bar"><img src="<?php echo base_url(); ?>assets/images/deal.png" align="absmiddle" />Use this coupon FLIGHT150 for getting Rs. 150 cashback <a href="">Know more</a></div>
        <div class=" wid80 fleft top10 left10"><img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result[$i][$j]['cicode'][0]; ?>.gif" /><br /><?php echo $flight_result[$i][$j]['name'][0]; ?></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><?php echo $ddate[1]; ?><br /> <span style="font-weight:normal; color:#4a4a4a;"><?php echo $flight_result[$i][$j]['dlocation'][0]; ?> </span></div>
        <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:20px;" ><?php echo $adate[1]; ?><br /> <span style="font-weight:normal; color:#4a4a4a;"><?php echo $flight_result[$i][$j]['alocation'][$stops]; ?></span> </div>
        <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $durationMinSec1; ?> <br /><span style="font-weight:normal; color:#4a4a4a;"><?php echo($flight_result[$i][$j]['stops'] > 0 ? $flight_result[$i][$j]['stops'].' Stops' : 'Non Stop') ?></span></div>
        <div class="wid170 fleft left60 top10 fleft" style="line-height:18px; text-align:right;"> <span class="details_price_small_txt"> &#36; <?php echo $flight_result[$i][$j]['Total_FareAmount'] + ($flight_result[$i][$j]['Total_FareAmount'] *5/100); ?></span> <span class="left10"> <span class="details_price_txt">&#36;&nbsp;<?php echo $flight_result[$i][$j]['Total_FareAmount']; ?></span></span> <br /> 
<span class="detail_txt" style="color:#333;">
	<?php 
		if($flight_result[$i][$j]['fareType'][0]=='RP')
			echo 'Non-Refundable';
		else echo 'Refundable';
	 ?>
	</span><span id="details<?php echo $i; ?>" class="detail_txt"><img src="<?php echo base_url(); ?>assets/images/plus_icon.png" align="absmiddle" />Details</span></div>
        <div class="book_btn fleft"><a href="<?php echo site_url(); ?>/flights/flight_details/<?php echo $flight_result[$i][$j]['id']; ?>/<?php echo $flight_result[$i][$j]['rand_id']; ?>">BOOK</a></div>
        <div id="flightdetails<?php echo $i; ?>" style="color:#000; display:none;"><div >
                <div align="center" class="top10"> 
                    <img src="<?php echo base_url(); ?>assets/images/details_devider.jpg" />
                </div>
                <div class="fleft wid500">
                    <div style="font-size:14px;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                    for($st=0;$st<$count;$st++)
                    {
                        $depdate=explode(' ',$flight_result[$i][$j]['ddate1'][$st]);
                        $arvdate=explode(' ',$flight_result[$i][$j]['adate1'][$st]);
                        $depDate1=explode('-',$depdate[0]);
                        $arvDate1=explode('-',$arvdate[0]);
                ?>

                    <div class="fleft wid125 top20">
                        <div class="wid40 fleft"  style="width:60px;">
                            <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result[$i][$j]['cicode'][$st]; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result[$i][$j]['name'][$st]; ?><br /> 
                            <?php echo $flight_result[$i][$j]['cicode'][$st].' - '.$flight_result[$i][$j]['fnumber'][$st]; ?><br /> 
                            <?php 
								$cabin_value=$flight_result[$i][$j]['cabin'][$st];
								if ($cabin_value == "F")
									$cabin_code = "First, Supersonic";
								else if ($cabin_value == "C")
									$cabin_code = "Business";
								else if ($cabin_value == "Y")
									$cabin_code = "Economic";
								else if ($cabin_value == "W")
									$cabin_code = "Premium Economy";
								else if ($cabin_value == "M")
									$cabin_code = "Standard Economy";
								else $cabin_code='';
									
									echo $cabin_code;
                            ?></div>
                    </div>
                    <div class="wid140 fleft top20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result[$i][$j]['dlocation'][$st]; ?> <strong><?php echo $depdate[1]; ?></strong></span><br />
                        <?php $dateDep=date("jS, F Y", strtotime($depDate1[2].'-'.$depDate1[1].'-'.$depDate1[0])); echo $dateDep; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:18px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                     <?php echo $flight_result[$i][$j]['duration_final1'][$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result[$i][$j]['alocation'][$st]; ?> <strong><?php echo $arvdate[1]; ?></strong></span><br />
                        <?php $dateArr=date("jS, F Y", strtotime($arvDate1[2].'-'.$arvDate1[1].'-'.$arvDate1[0])); echo $dateArr; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="clear"></div>
    <!--                <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>-->
                <?php 
                    }
                ?>
                </div>
                <div class="fright wid225" style="margin-right:20px;">
                    <div class="fairprice_bg">
                        <div class="fair_txt" style="line-height:18px;">Fare breakup</div>
                        <div class="fleft wid100 fair_txt_small top10"  >Base Fare<br />
                            Taxes & Fees<br />
                            Total
                        </div>
                        <div class="fleft wid100 fair_txt_small top10 left20"  >USD <?php echo($flight_result[$i][$j]['Total_FareAmount']-$flight_result[$i][$j]['TaxAmount']); ?><br />
                            USD <?php echo $flight_result[$i][$j]['TaxAmount']; ?><br />
                            USD <?php echo $flight_result[$i][$j]['Total_FareAmount']; ?>
                        </div>
                        <div class="clear"> </div>
    <!--                    <div class="fair_txt" style="line-height:18px; margin-top:10px;">Airline Refund Policy</div>
                        <div class="fleft fair_txt_small top10"  > Cancelation fee Rs.1,500 / Person <br /> Cancelation fee Rs.1,500 / Person  </div>-->
                    </div>
                </div>
            </div></div>
    </div> 
</div>
<?php
            
      }
?>
<?php   
echo '<script>
                  $("#details'.$i.'").click(function(){
                    $("#flightdetails'.$i.'").toggle();
                  });
                </script>';
            }
        }
                
        
               }
            
           // print_r($totalPriceAry);
           // echo min($totalPriceAry).'<<>>';die;
	}
        
        
?>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo 'USD';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<?php
    }
    else
    {
       echo "empty";
    }

?>
