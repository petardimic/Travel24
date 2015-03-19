<?php

$noofPassenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];
$flight_result_temp=$_SESSION['flight_result1'];
$iii=0;
//echo '<pre/>dfdf';print_r($flight_result_temp);exit;
foreach($flight_result_temp as $testing_final)
	$flightDetails1[$iii++]=$testing_final['Recomm'];
//echo '<pre/>dfdf';print_r($flightDetails1);exit;
//echo '<pre/>dfdf';print_r($flight_result);

if($flight_result!='')
{
$p=0;
	foreach($flight_result['oneway'] as $testing)
	{
		$flight_result_trip['oneway'][$p++]=$testing;
	}
	$p=0;
	foreach($flight_result['Return'] as $testing1)
	{
		$flight_result_trip['Return'][$p++]=$testing1;
	}
	
	//echo '<pre/>dfdf';echo (count($flight_result_trip['Return']));
	
	
	
	
	
	$r=0;
	foreach($flight_result['Return'] as $testing2)
	{
		$result[$r++]=$testing2;
	}
	if(!empty($result))
		$id=$result[0]['rand_id'];
	else
		$id=0;
	
	$usernames = array();
	foreach ($flight_result_trip['oneway'] as $user) 
	{
	   $usernames[] = $user['Total_FareAmount'];
	}
	array_multisort($usernames, SORT_ASC, $flight_result_trip['oneway']);
	
	$usernames1 = array();
	foreach ($flight_result_trip['Return'] as $user) 
	{
	   $usernames1[] = $user['Total_FareAmount'];
	}
	array_multisort($usernames1, SORT_ASC, $flight_result_trip['Return']);
			   
	// echo '<pre/>';print_r($flight_result_trip['Return']);exit;
	
	
	$result_oneway=$flight_result_trip['oneway'];
	$s_oneway='';
        if($result_oneway != '')
	{
		$a1=array();
		$t1=0;
		foreach($result_oneway as $price_oneway)
		{
			if(in_array(($price_oneway['Total_FareAmount']),$a1))
			{
				$s_oneway[$t1][]=$price_oneway;
				
			}
			else
			{
				$s_oneway[($t1+1)][]=$price_oneway;
				$a1[] = $price_oneway['Total_FareAmount'];
			}
			$t1 = count($a1);
		}
	}
	//echo '<pre/>';print_r($s_oneway);exit;
	
	$result_return=$flight_result_trip['Return'];
	$s_return='';
	if($result_return != '')
	{
		$a2=array();
		$t2=0;
		foreach($result_return as $price_return)
		{
			if(in_array(($price_return['Total_FareAmount']),$a2))
			{
				$s_return[$t2][]=$price_return;
				
			}
			else
			{
				$s_return[($t2+1)][]=$price_return;
				$a2[] = $price_return['Total_FareAmount'];
			}
			$t2 = count($a2);
		}
	}
	//echo '<pre/>';print_r($s_return);exit;
	

 $fcityname=explode(",",$_SESSION['fromcityval']);
 $fcount_city_code=(count($fcityname));
 $from_city_code=$fcityname[($fcount_city_code-1)];
 
 $tcityname=explode(",",$_SESSION['tocityval']);
 $tcount_city_code=(count($tcityname));
 $to_city_code=$tcityname[($tcount_city_code-1)];
 
 $flight_result_trip['oneway']=$s_oneway;
	$flight_result_trip['Return']=$s_return;
	
    if(!empty($flight_result_trip['oneway']))
    {
	//echo '<pre />';print_r($flight_result_trip['oneway']);die;	
	for($i=1;$i<(count($flight_result_trip['oneway']));$i++) 
        {
            
			$used_oneway = array();$used_return = array();$used_oneway1 = array();$used_return1 = array();
			$count_val_oneway= count($flight_result_trip['oneway'][$i]);
			$count_val_return= count($flight_result_trip['Return'][$i]);
			
			for( $iii=0; $iii<$count_val_oneway; $iii++ ) 
			{
				if ( in_array( $flight_result_trip['oneway'][$i][$iii]['timeOfDeparture'], $used_oneway ) ) 
				{
					
				}
				else 
				{
					$used_oneway[] = $flight_result_trip['oneway'][$i][$iii]['timeOfDeparture'];
					$used_oneway1[] = $flight_result_trip['oneway'][$i][$iii];
				}
			}
			$flight_result_trip['oneway'][$i]=$used_oneway1;
			$usernames = array();
            foreach ($flight_result_trip['oneway'][$i] as $user) {
                $usernames[] = $user['timeOfDeparture'];
            }
            array_multisort($usernames, SORT_ASC, $flight_result_trip['oneway'][$i]);
			
			
			
			
			for( $iii=0; $iii<$count_val_return; $iii++ ) 
			{
				if ( in_array( $flight_result_trip['Return'][$i][$iii]['timeOfDeparture'], $used_return ) ) 
				{
				}
				else 
				{
					$used_return[] = $flight_result_trip['Return'][$i][$iii]['timeOfDeparture'];
					$used_return1[] = $flight_result_trip['Return'][$i][$iii];
				}
			}
			$flight_result_trip['Return'][$i]=$used_return1;
			$usernames = array();
            foreach ($flight_result_trip['Return'][$i] as $user) {
                $usernames[] = $user['timeOfDeparture'];
            }
            array_multisort($usernames, SORT_ASC, $flight_result_trip['Return'][$i]);
			
			$count_val1 = count($flight_result_trip['oneway'][$i]);
			$count_val01 = count($flight_result_trip['Return'][$i]);
			
			$usernames = array();
			foreach ($used_oneway1 as $user) 
			{
			   if(!isset($user['timeOfArrival'][0]))
					$usernames[] = $user['timeOfArrival'];
			   else
			   {
				   $ac=((count($user['timeOfArrival']))-1);
				   $usernames[] = $user['timeOfArrival'][$ac];
			   }
			}
			array_multisort($usernames, SORT_ASC, $used_oneway1);
			$ccc=(count($used_oneway1));
			$ccc1=(count($used_oneway1[($ccc-1)]['timeOfArrival']));
			if($ccc1>1)
				$maxarival=$used_oneway1[($ccc-1)]['timeOfArrival'][0];
			else
				$maxarival=$used_oneway1[($ccc-1)]['timeOfArrival'];
			
            
           // echo '<pre />';print_r($flight_result_trip['Return']);die;
            for($j=0;$j<1;$j++)
            {
				
                $totalPriceAry[]= $flight_result_trip['oneway'][$i][$j]['Total_FareAmount'];
                $totalPriceAryRound[]= $flight_result_trip['Return'][$i][$j]['Total_FareAmount'];
                $ostops=$flight_result_trip['oneway'][$i][$j]['stops'];
                $rstops=$flight_result_trip['Return'][$i][$j]['stops'];
                if($ostops==0)
                {
                    $ddate=explode(' ',$flight_result_trip['oneway'][$i][$j]['ddate1']);
                    $adate=explode(' ',$flight_result_trip['oneway'][$i][$j]['adate1']);
                }
                else 
                {
                    $ddate=explode(' ',$flight_result_trip['oneway'][$i][$j]['ddate1'][$ostops]);
                    $adate=explode(' ',$flight_result_trip['oneway'][$i][$j]['adate1'][$ostops]);
                }
                if($rstops==0)
                {
                    $rddate=explode(' ',$flight_result_trip['Return'][$i][$j]['ddate1']);
                    $radate=explode(' ',$flight_result_trip['Return'][$i][$j]['adate1']);
                }
                else
                {
                    $rddate=explode(' ',$flight_result_trip['Return'][$i][$j]['ddate1'][$rstops]);
                    $radate=explode(' ',$flight_result_trip['Return'][$i][$j]['adate1'][$rstops]);
                }
                $fromcityAirport=explode('-',$_SESSION['fromcityval']);
                $tocityAirport=explode('-',$_SESSION['tocityval']);
                
        $duration=explode(' ',$flight_result_trip['oneway'][$i][$j]['duration_final_eft']);
        $durCount=count($duration);
        
        if($durCount==3)
        {
            
            $duration0=explode('D',$duration[0]);
            $duration1=explode('H',$duration[1]);
            $duration2=explode('M',$duration[2]);
            $durationInMin1=($duration0[0]*24*60)+($duration1[0]*60)+$duration2[0];
        }
        else if($durCount==2)
        {
            $duration1=explode('H',$duration[0]);
            $duration2=explode('M',$duration[1]);
            $durationInMin1=($duration1[0]*60)+$duration2[0];
        }
        else
        {
            $duration2=explode('M',$duration[1]);
            $durationInMin1=$duration2[0];
        }

                
                //echo '<pre />';print_r($flight_result_trip['Return']);die;
?>

<div class="searchflight_box">
    <?php
        if($flight_result_trip['oneway'][$i][$j]['stops']==0 && $flight_result_trip['Round'][$i][$j]['stops']==0)
        {
    ?>
        <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result_trip['oneway'][$i][$j]['name']; ?>" data-departure="<?php echo $flight_result_trip['oneway'][$i][$j]['timeOfDeparture']; ?>" data-departure-round="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfDeparture']; ?>" data-arrival="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfArrival']; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo ($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']); ?>" data-price-round="<?php echo $flight_result_trip['Round'][$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result_trip['oneway'][$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result_trip['oneway'][$i][$j]['fareType']; ?>">
    <?php
        }
        elseif($flight_result_trip['oneway'][$i][$j]['stops']>0 && $flight_result_trip['Round'][$i][$j]['stops']>0)
        {
            $stp=$flight_result_trip['oneway'][$i][$j]['stops'];
    ?>
        <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result_trip['oneway'][$i][$j]['name'][0]; ?>" data-departure="<?php echo $flight_result_trip['oneway'][$i][$j]['timeOfDeparture'][0]; ?>" data-departure-round="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfDeparture'][0]; ?>" data-arrival="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfArrival'][$stp]; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo ($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']); ?>" data-price-round="<?php echo $flight_result_trip['Round'][$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result_trip['oneway'][$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result_trip['oneway'][$i][$j]['fareType'][0]; ?>">
    <?php
        }
        elseif($flight_result_trip['oneway'][$i][$j]['stops']>0 && $flight_result_trip['Round'][$i][$j]['stops']==0)
        {
            $stp=$flight_result_trip['oneway'][$i][$j]['stops'];
    ?>
        <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result_trip['oneway'][$i][$j]['name'][0]; ?>" data-departure="<?php echo $flight_result_trip['oneway'][$i][$j]['timeOfDeparture'][0]; ?>" data-departure-round="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfDeparture']; ?>" data-arrival="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfArrival'][$stp]; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo ($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']); ?>" data-price-round="<?php echo $flight_result_trip['Round'][$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result_trip['oneway'][$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result_trip['oneway'][$i][$j]['fareType'][0]; ?>">
    <?php
        }
        elseif($flight_result_trip['oneway'][$i][$j]['stops']==0 && $flight_result_trip['Round'][$i][$j]['stops']>0)
        {
    ?>
        <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result_trip['oneway'][$i][$j]['name']; ?>" data-departure="<?php echo $flight_result_trip['oneway'][$i][$j]['timeOfDeparture']; ?>" data-departure-round="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfDeparture'][0]; ?>" data-arrival="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfArrival']; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo ($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']); ?>" data-price-round="<?php echo $flight_result_trip['Round'][$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result_trip['oneway'][$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result_trip['oneway'][$i][$j]['fareType']; ?>">
    <?php
        }
        elseif($flight_result_trip['oneway'][$i][$j]['stops']>0 && $flight_result_trip['Round'][$i][$j]['stops']>0)
        {
            $stp=$flight_result_trip['oneway'][$i][$j]['stops'];
    ?>
        <div class="detail_area top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result_trip['oneway'][$i][$j]['name'][0]; ?>" data-departure="<?php echo $flight_result_trip['oneway'][$i][$j]['timeOfDeparture'][0]; ?>" data-departure-round="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfDeparture'][0]; ?>" data-arrival="<?php echo $flight_result_trip['Round'][$i][$j]['timeOfArrival'][$stp]; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo ($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']); ?>" data-price-round="<?php echo $flight_result_trip['Round'][$i][$j]['Total_FareAmount']; ?>" data-stops="<?php echo $flight_result_trip['oneway'][$i][$j]['stops']; ?>" data-fare-type="<?php echo $flight_result_trip['oneway'][$i][$j]['fareType'][0]; ?>">
    <?php
        }
    ?>
    
    <div class="detail_bar"><img src="<?php echo base_url(); ?>assets/images/deal.png" align="absmiddle" />Use this coupon FLIGHT150 for getting Rs. 150 cashback <a href="">Know more</a></div>
    <div class="wid600 fleft">  <div class=" wid100 fleft top10 left10"> <div class="box_roundtrip left10"><img src="<?php echo base_url(); ?>assets/images/flight_icon4.png" align="absmiddle" style="margin-top:3px; float:left;" /><div style="margin-top:-7px; "> Onward </div></div>
            
            <?php 
                if($flight_result_trip['oneway'][$i][$j]['stops']==0)
                {
            ?>
                    <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['oneway'][$i][$j]['cicode']; ?>.gif" border="0" align="absmiddle" class="left10" /> <?php echo $flight_result_trip['oneway'][$i][$j]['name']; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['dlocation']; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $ddate[1]; ?><br />
                            <?php echo $ddate[0]; ?></span> </div>
                    <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['alocation']; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $adate[1]; ?><br />
                            <?php echo $adate[0]; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip['oneway'][$i][$j]['duration_final_eft']; ?><br />
                        <a   href="" class="stop_txt"> Non-Stops </a> </div>
            <?php
                }
                else
                {
            ?>
                    <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['oneway'][$i][$j]['cicode'][$ostops]; ?>.gif" border="0" align="absmiddle" class="left10" /> <?php echo $flight_result_trip['oneway'][$i][$j]['name'][$ostops]; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['dlocation'][0]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $ddate[1]; ?><br />
                            <?php echo $ddate[0]; ?></span> </div>
                    <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['alocation'][$ostops]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $adate[1]; ?><br />
                            <?php echo $adate[0]; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip['oneway'][$i][$j]['duration_final_eft']; ?><br />
                        <a href="" class="stop_txt"> 
                            <?php 
                                echo $ostops.' Stops';
                            ?>
                        </a> </div>
            <?php
                }
            ?>


            <div  class="top10"> <img src="<?php echo base_url(); ?>assets/images/details_devider_roundtrip.png" /></div>
            <?php 
                if($flight_result_trip['Return'][$i][$j]['stops']==0)
                {
            ?>
                    <div class=" wid100 fleft top10 left10"> <div class="box_roundtrip left10"><img src="<?php echo base_url(); ?>assets/images/flight_icon5.png" align="absmiddle" style="margin-top:3px; float:left;" /><div style="margin-top:-7px; "> Return </div></div>
                        <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['Return'][$i][$j]['cicode']; ?>.gif" border="0" align="absmiddle" class="left10" /> <?php echo $flight_result_trip['Return'][$i][$j]['name']; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['Return'][$i][$j]['dlocation']; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $rddate[1]; ?><br />
                            <?php echo $rddate[0]; ?></span> </div>
                    <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['Return'][$i][$j]['alocation']; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $radate[1]; ?><br />
                            <?php echo $radate[0]; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip['Return'][$i][$j]['duration_final_eft']; ?><br />
                        <a href="" class="stop_txt"> Non-Stops </a> </div>
            <?php 
                }
                else
                {
            ?>
                    <div class=" wid100 fleft top10 left10"> <div class="box_roundtrip left10"><img src="<?php echo base_url(); ?>assets/images/flight_icon5.png" align="absmiddle" style="margin-top:3px; float:left;" /><div style="margin-top:-7px; "> Return </div></div>
                        <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['Return'][$i][$j]['cicode'][$rstops]; ?>.gif" border="0" align="absmiddle" class="left10" /> <?php echo $flight_result_trip['Return'][$i][$j]['name'][$rstops]; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['Return'][$i][$j]['dlocation'][0]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $rddate[1]; ?><br />
                            <?php echo $rddate[0]; ?></span> </div>
                    <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip['Return'][$i][$j]['alocation'][$rstops]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $radate[1]; ?><br />
                            <?php echo $radate[0]; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip['Return'][$i][$j]['duration_final_eft']; ?><br />
                        <a href="" class="stop_txt"> <?php
                            echo $rstops.' Stops';
                        ?> </a> </div>
            <?php
                }
            ?>
    </div>


    <div class="fleft wid170 left10 top20" style="width:167px;"><div class="fleft"><img src="<?php echo base_url(); ?>assets/images/vertical_devider.png" />
        </div> <div style="text-align:center">
            <span class="details_price_small_txt">USD <?php echo($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']+$flight_result_trip['Return'][$i][$j]['Total_FareAmount']); ?></span>
            <br />
            <span>USD
                <span class="details_price_txt"><?php echo($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']+$flight_result_trip['Return'][$i][$j]['Total_FareAmount']); ?></span></span><br />
            <div class="booknow_btn left60"><a href="<?php echo site_url(); ?>/flights/flight_details/<?php echo $flight_result_trip['oneway'][$i][$j]['id']; ?>/<?php echo $flight_result_trip['oneway'][$i][$j]['rand_id']; ?>" style="text-decoration:none; color:#FFF; font-weight:normal;">BOOK</a></div>


        </div><div id="details<?php echo $i; ?>" class="detail_txt " style="margin-left:60px !important;" >
            <img align="absmiddle" src="<?php echo base_url(); ?>assets/images/plus_icon.png" style="float:left; margin-top:9px;">
            Details
        </div>
   </div>

    <div id="flightdetails<?php echo $i; ?>" style="color:#000;display:none;"><div >


            <div align="center" class="top10"> <img src="<?php echo base_url(); ?>assets/images/details_devider.jpg" /></div>

            <div class="fleft wid500">
                <div style="font-size:14px;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?></strong> <?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
              <?php 
               
                if($ostops==0)
                {
              ?>  
                <div class="fleft wid125 top20">
                    <div class="wid40 fleft"><img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['oneway'][$i][$j]['cicode']; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result_trip['oneway'][$i][$j]['name']; ?><br /> 
                        <?php echo $flight_result_trip['oneway'][$i][$j]['cicode'].' - '.$flight_result_trip['oneway'][$i][$j]['fnumber']; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin=$flight_result_trip['oneway'][$i][$j]['cabin'];
                            if($cabin=="MC")
                                    $cabin_text="Major Cabin";
                            else if($cabin=="RC")
                                    $cabin_text="Recommended";
                            else if($cabin=="C")
                                    $cabin_text="Business";
                            else if($cabin=="F")
                                    $cabin_text="First";
                            else if($cabin=="M")
                                    $cabin_text="Economy Standard";
                            else if($cabin=="W")
                                    $cabin_text="Economy Premium";
                            
                            echo $cabin_text;
                        ?></div>
                </div>

                <div class="wid140 fleft top20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['dlocation']; ?><strong><?php echo $ddate[1]; ?></strong></span><br />
                    <?php echo $ddate[0]; ?><br />
                    <?php //echo $fromcityAirport[1]; ?></div>

                <div class="wid40 fleft top20" style="line-height:18px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <?php echo $flight_result_trip['oneway'][$i][$j]['duration_final_eft']; ?></div>
                <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['alocation']; ?> <strong><?php echo $adate[1]; ?></strong></span><br />
                    <?php echo $adate[0]; ?><br />
                    <?php //echo $tocityAirport[1]; ?></div>
                <div class="clear"></div>
            <?php
                }
                else
                {
                    
                    $countStop=count($flight_result_trip['oneway'][$i][$j]['cicode']);
                    for($os=0;$os<$countStop;$os++)
                    {
                        $ddate1=explode(' ',$flight_result_trip['oneway'][$i][$j]['ddate1'][$os]);
                        $adate1=explode(' ',$flight_result_trip['oneway'][$i][$j]['adate1'][$os]);
            ?>
                    <div class="fleft wid125 top20">
                    <div class="wid40 fleft"><img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['oneway'][$i][$j]['cicode'][$os]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result_trip['oneway'][$i][$j]['name'][$os]; ?><br /> 
                        <?php echo $flight_result_trip['oneway'][$i][$j]['cicode'][$os].' - '.$flight_result_trip['oneway'][$i][$j]['fnumber'][$os]; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin=$flight_result_trip['oneway'][$i][$j]['cabin'][$os];
                            if($cabin=="MC")
                                    $cabin_text="Major Cabin";
                            else if($cabin=="RC")
                                    $cabin_text="Recommended";
                            else if($cabin=="C")
                                    $cabin_text="Business";
                            else if($cabin=="F")
                                    $cabin_text="First";
                            else if($cabin=="M")
                                    $cabin_text="Economy Standard";
                            else if($cabin=="W")
                                    $cabin_text="Economy Premium";
                            
                            echo $cabin_text;
                        ?></div>
                    </div>

                    <div class="wid140 fleft top20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['dlocation'][$os]; ?><strong><?php echo $ddate1[1]; ?></strong></span><br />
                        <?php echo $ddate1[0]; ?><br />
                        <?php //echo $fromcityAirport[1]; ?></div>

                    <div class="wid40 fleft top20" style="line-height:18px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <?php echo $flight_result_trip['oneway'][$i][$j]['duration_final1'][$os]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['alocation'][$os]; ?> <strong><?php echo $adate1[1]; ?></strong></span><br />
                        <?php echo $adate1[0]; ?><br />
                        <?php //echo $tocityAirport[1]; ?></div>
                    <div class="clear"></div>
            <?php
              
                    }
                }
            ?>   
                
                <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>
            </div>
            <div class="fright wid225" style="margin-right:20px;">
                <div class="fairprice_bg">
                    <div class="fair_txt" style="line-height:18px;">Fare breakup</div>
                    <div class="fleft wid100 fair_txt_small top10"  >Base Fare<br />
                        Taxes & Fees<br />
                        Total
                    </div>
                    <div class="fleft wid100 fair_txt_small top10 left20"  >USD <?php echo($flight_result_trip['oneway'][$i][$j]['Total_FareAmount']-$flight_result_trip['oneway'][$i][$j]['TaxAmount']); ?><br />
                        USD <?php echo $flight_result_trip['oneway'][$i][$j]['TaxAmount']; ?><br />
                        USD <?php echo $flight_result_trip['oneway'][$i][$j]['Total_FareAmount']; ?>
                    </div>
                    <div class="clear"> </div>
<!--                    <div class="fair_txt" style="line-height:18px; margin-top:10px;">Airline Refund Policy</div>-->
<!--                    <div class="fleft fair_txt_small top10"  > Cancelation fee Rs.1,500 / Person <br /> Cancelation fee Rs.1,500 / Person  </div>-->

                </div>
            </div> 
            
            <div>Return Flight:<br /></div>
            <!--##################################################--->
            <div class="fleft wid500">
                <div style="font-size:14px;"><strong><?php echo $_SESSION['toCity']; ?> to <?php echo $_SESSION['fromCity']; ?></strong> <?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                if($rstops==0)
                {
              ?>  
                <div class="fleft wid125 top20">
                    <div class="wid40 fleft"><img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['Return'][$i][$j]['cicode']; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result_trip['Return'][$i][$j]['name']; ?><br /> 
                        <?php echo $flight_result_trip['Return'][$i][$j]['cicode'].' - '.$flight_result_trip['Return'][$i][$j]['fnumber']; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin=$flight_result_trip['Return'][$i][$j]['cabin'];
                            if($cabin=="MC")
                                    $cabin_text="Major Cabin";
                            else if($cabin=="RC")
                                    $cabin_text="Recommended";
                            else if($cabin=="C")
                                    $cabin_text="Business";
                            else if($cabin=="F")
                                    $cabin_text="First";
                            else if($cabin=="M")
                                    $cabin_text="Economy Standard";
                            else if($cabin=="W")
                                    $cabin_text="Economy Premium";
                            
                            echo $cabin_text;
                        ?></div>
                </div>

                <div class="wid140 fleft top20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['dlocation']; ?><strong><?php echo $ddate[1]; ?></strong></span><br />
                    <?php echo $ddate[0]; ?><br />
                    <?php //echo $fromcityAirport[1]; ?></div>

                <div class="wid40 fleft top20" style="line-height:18px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <?php echo $flight_result_trip['oneway'][$i][$j]['duration_final_eft']; ?></div>
                <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['oneway'][$i][$j]['alocation']; ?> <strong><?php echo $adate[1]; ?></strong></span><br />
                    <?php echo $adate[0]; ?><br />
                    <?php //echo $tocityAirport[1]; ?></div>
                <div class="clear"></div>
            <?php
                }
                else
                {
                    $countStop1=count($flight_result_trip['Return'][$i][$j]['cicode']);
                    for($os=0;$os<$countStop1;$os++)
                    {
                        $ddate2=explode(' ',$flight_result_trip['Return'][$i][$j]['ddate1'][$os]);
                        $adate2=explode(' ',$flight_result_trip['Return'][$i][$j]['adate1'][$os]);
            ?>
                    <div class="fleft wid125 top20">
                    <div class="wid40 fleft"><img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flight_result_trip['Return'][$i][$j]['cicode'][$os]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result_trip['Return'][$i][$j]['name'][$os]; ?><br /> 
                        <?php echo $flight_result_trip['Return'][$i][$j]['cicode'][$os].' - '.$flight_result_trip['Return'][$i][$j]['fnumber'][$os]; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin=$flight_result_trip['Return'][$i][$j]['cabin'][$os];
                            if($cabin=="MC")
                                    $cabin_text="Major Cabin";
                            else if($cabin=="RC")
                                    $cabin_text="Recommended";
                            else if($cabin=="C")
                                    $cabin_text="Business";
                            else if($cabin=="F")
                                    $cabin_text="First";
                            else if($cabin=="M")
                                    $cabin_text="Economy Standard";
                            else if($cabin=="W")
                                    $cabin_text="Economy Premium";
                            
                            echo $cabin_text;
                        ?></div>
                    </div>

                    <div class="wid140 fleft top20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['Return'][$i][$j]['dlocation'][$os]; ?><strong><?php echo $ddate2[1]; ?></strong></span><br />
                        <?php echo $ddate2[0]; ?><br />
                        <?php //echo $fromcityAirport[1]; ?></div>

                    <div class="wid40 fleft top20" style="line-height:18px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <?php echo $flight_result_trip['Return'][$i][$j]['duration_final1'][$os]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip['Return'][$i][$j]['alocation'][$os]; ?> <strong><?php echo $adate2[1]; ?></strong></span><br />
                        <?php echo $adate2[0]; ?><br />
                        <?php //echo $tocityAirport[1]; ?></div>
                    <div class="clear"></div>
            <?php
                    }
                }
            ?>   
                
                <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>
            </div>
            <div class="fright wid225" style="margin-right:20px;">
                <div class="fairprice_bg">
                    <div class="fair_txt" style="line-height:18px;">Fare breakup</div>
                    <div class="fleft wid100 fair_txt_small top10"  >Base Fare<br />
                        Taxes & Fees<br />
                        Total
                    </div>
                    <div class="fleft wid100 fair_txt_small top10 left20"  >USD <?php echo($flight_result_trip['Return'][$i][$j]['Total_FareAmount']-$flight_result_trip['Return'][$i][$j]['TaxAmount']); ?><br />
                        USD <?php echo $flight_result_trip['Return'][$i][$j]['TaxAmount']; ?><br />
                        USD <?php echo $flight_result_trip['Return'][$i][$j]['Total_FareAmount']; ?>
                    </div>
                    <div class="clear"> </div>
<!--                    <div class="fair_txt" style="line-height:18px; margin-top:10px;">Airline Refund Policy</div>-->
<!--                    <div class="fleft fair_txt_small top10"  > Cancelation fee Rs.1,500 / Person <br /> Cancelation fee Rs.1,500 / Person  </div>-->

                </div>
            </div>
            <!--##################################################--->
            
            
        </div></div>
</div>
</div>


<?php
            }
            echo '<script>
                  $("#details'.$i.'").click(function(){
                    $("#flightdetails'.$i.'").toggle();
                  });
                </script>';
        }
        ///print_r($totalPriceAryRound);die;
?>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMinPriceRound" value="<?php if(!empty($totalPriceAryRound)) echo min($totalPriceAryRound); else echo 0; ?>" />
<input type="hidden" id="setMaxPriceRound" value="<?php if(!empty($totalPriceAryRound)) echo max($totalPriceAryRound); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo 'USD';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<input type="hidden" id="setMinTimeRound" value="0" />
<input type="hidden" id="setMaxTimeRound" value="1440" />
<?php
    }
    else
    {
        echo 'empty';
    }
}
?>
