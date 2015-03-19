<?php /*?><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><?php */?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popbox_new.css" type="text/css" media="screen" charset="utf-8">

  <script type="text/javascript" charset="utf-8"  src="<?php echo base_url(); ?>assets/js/popbox_new.js"></script>
  
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $('.popbox,.popbox1').popbox();
    });
  </script>

<?php
$noofPassenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];
$flight_result_temp=$flight_result;
$iii=0;
$totalPriceAry = array();
$totalPriceAryRound=array();
if($flight_result!='')
{
    $fcityname=explode(",",$_SESSION['fromcityval']);
    $fcount_city_code=(count($fcityname));
    $from_city_code=$fcityname[($fcount_city_code-1)];

    $tcityname=explode(",",$_SESSION['tocityval']);
    $tcount_city_code=(count($tcityname));
    $to_city_code=$tcityname[($tcount_city_code-1)];
    $i = 1;
	
    foreach($flight_result as $flight_result_trip) 
    { 
        
        $flight_result_trip_return = $this->Flights_Model->get_return_flights($flight_result_trip->session_id,$flight_result_trip->akbar_session,$flight_result_trip->ref_id);
//        if($flight_result_trip->id=='28097')
//        {
//            echo $flight_result_trip->Total_FareAmount.'<<>>'.$flight_result_trip_return->Total_FareAmount;die;
//            echo '<<<<<>>>>>';echo $flight_result_trip->Total_FareAmount+$flight_result_trip_return->Total_FareAmount;die;
//        }
	if($flight_result_trip->Total_FareAmount!='')
	{
            $totalPriceAry[]= $flight_result_trip->Total_FareAmount;
            $totalPriceAryRound[]=$flight_result_trip_return->Total_FareAmount;
            $ostops = $flight_result_trip->stops;
            if(strpos($flight_result_trip->ddate, '<br>'))
            {
                $res=explode('<br>',$flight_result_trip->ddate);
                for($f=0;$f<count($res);$f++)
                {
                    $departurearray[]=$res[$f];
                }
            }
            else
            {
                $departurearray[] = $flight_result_trip->ddate;
            }
            if($flight_result_trip->flag=='false')
            {
		$dep_name=$this->Flights_Model->get_City_name($flight_result_trip->dlocation);
		$arr_name=$this->Flights_Model->get_City_name($flight_result_trip->alocation);
					
		$dep_name_final=$dep_name->city.", ".$dep_name->country." (".$dep_name->city_code.")";
		$arr_name_final=$arr_name->city.", ".$arr_name->country." (".$arr_name->city_code.")";
		
		$date=$flight_result_trip->ddate1;
		$date1=explode(" ",$date);
		$date_2=explode("-",$date1[0]);
		$date_final_on=$date_2[0]."-".$date_2[1]."-20".$date_2[2];
		$de_date = date('F j, Y',(strtotime("+0 day", (strtotime($date_final_on)))));
                                        
		$ddate=explode(' ',$flight_result_trip->ddate1);
		$adate=explode(' ',$flight_result_trip->adate1);
		$duration=explode(' ',$flight_result_trip->duration_final1);
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
                    $durationMinSec=$flight_result_trip->duration_final1;
		}
		else
		{
                    $duration2=explode('M',$duration[0]);
                    $durationInMin=$duration2[0];
                    $durationMinSec=$flight_result_trip->duration_final1;
		}
	}
	else
	{
            $stops=$flight_result_trip->stops;
            $cicode=explode('<br>',$flight_result_trip->cicode);
            $name=explode('<br>',$flight_result_trip->name);
            $fnumber=explode('<br>',$flight_result_trip->fnumber);
            $dlocation=explode('<br>',$flight_result_trip->dlocation);
            $alocation=explode('<br>',$flight_result_trip->alocation);
            $timeOfDeparture=explode('<br>',$flight_result_trip->timeOfDeparture);
            $timeOfArrival=explode('<br>',$flight_result_trip->timeOfArrival);
            $dateOfDeparture=explode('<br>',$flight_result_trip->dateOfDeparture);
            $dateOfArrival=explode('<br>',$flight_result_trip->dateOfArrival);
            $equipmentType=explode('<br>',$flight_result_trip->equipmentType);
            $ddate=explode('<br>',$flight_result_trip->ddate);
            $adate=explode('<br>',$flight_result_trip->adate);
            $dep_date=explode('<br>',$flight_result_trip->dep_date);
            $arv_date=explode('<br>',$flight_result_trip->arv_date);
            $ddate1=explode('<br>',$flight_result_trip->ddate1);
            $adate1=explode('<br>',$flight_result_trip->adate1);
            $duration_final=explode('<br>',$flight_result_trip->duration_final);
            $duration_final1=explode('<br>',$flight_result_trip->duration_final1);
            $dur_in_min_layover=explode('<br>',$flight_result_trip->dur_in_min_layover);
            $duration_final_layover=explode('<br>',$flight_result_trip->duration_final_layover);
            $fareType=explode('<br>',$flight_result_trip->fareType);
            $BookingClass=explode('<br>',$flight_result_trip->BookingClass);
            $cabin=explode('<br>',$flight_result_trip->cabin);

            $count=count($dlocation);
            $ddate=explode(' ',$ddate1[0]);
            $adate=explode(' ',$adate1[$stops]);
            $duration=explode(' ',$flight_result_trip->duration_final_eft);
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
                $durationMinSec1=$flight_result_trip->duration_final_eft;
            }
            else
            {
                $duration2=explode('M',$duration[1]);
                $durationInMin1=$duration2[0];
                $durationMinSec1=$flight_result_trip->duration_final_eft;
            }
	}
        
        if(strpos($flight_result_trip->name,'<br>'))
        {
            $airlineNameArr=explode('<br>',$flight_result_trip->name);
            $airlineName=$airlineNameArr[0];
        }
        else
        {
            $airlineName=$flight_result_trip->name;
        }
        
        if(strpos($flight_result_trip->dtime_filter,'<br>'))
        {
            $dTimeFilterArr=explode('<br>',$flight_result_trip->dtime_filter);
            $dTimeFilter=$dTimeFilterArr[0];
        }
        else
            $dTimeFilter=$flight_result_trip->dtime_filter;
        
        if(strpos($flight_result_trip->atime_filter,'<br>'))
        {
            $aTimeArrivalArr=explode('<br>',$flight_result_trip->atime_filter);
            $aTimeFilter=$aTimeArrivalArr[0];
        }
        else
            $aTimeFilter=$flight_result_trip->atime_filter;
        
        if(strpos($flight_result_trip->fareType,'<br>'))
        {
            $fareTypeArr=explode('<br>',$flight_result_trip->fareType);
            $fareType=$fareTypeArr[0];
        }
        else
            $fareType=$flight_result_trip->fareType;
?>

<div class="searchflight_box"><div style="clear:both;"></div>
  <div class="detail_area2 top10 FlightInfoBox searchflight" data-airline="<?php echo $airlineName; ?>" data-departure="<?php echo $dTimeFilter; ?>" data-arrival="<?php echo $aTimeFilter; ?>" data-duration="<?php echo $durationInMin; ?>" data-price="<?php echo $flight_result_trip->Total_FareAmount; ?>" data-price-round="<?php echo $flight_result_trip_return->Total_FareAmount; ?>" data-stops="<?php echo $flight_result_trip->stops; ?>" data-fare-type="<?php echo $flight_result_trip->fareType; ?>" data-total-price="<?php echo ($flight_result_trip->Total_FareAmount+$flight_result_trip_return->Total_FareAmount); ?>">
    <div class="detail_bar"><img src="<?php echo base_url(); ?>assets/images/deal.png" align="absmiddle" />Use this coupon FLIGHT150 for getting Rs. 150 cashback <a href="">Know more</a></div>
    <div class="wid600 fleft">  <div class=" wid100 fleft top10 left10"  style="line-height:16px; width:90px; text-align:center; font-weight:normal;"> <div class="box_roundtrip left10" ><img src="<?php echo base_url(); ?>assets/images/flight_icon4.png" align="absmiddle" style="margin-top:3px; float:left;" />  Onward </div>
            
            <?php 
                if($flight_result_trip->stops==0)
                {
            ?>
                    <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_result_trip->cicode; ?>.gif" border="0" align="absmiddle" class="left10" /> <br />
<?php echo $flight_result_trip->name; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-right:30px; text-align:right;" ><span class="fair_add_txt" ><?php echo $flight_result_trip->dlocation; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $ddate[1]; ?><br />
                          <?php 
                                $date_dep = $flight_result_trip->dep_date;
                                $date_deps = explode('/',$date_dep);
                                $deps = "20".$date_deps[2]."-".$date_deps[1]."-".$date_deps[0];
				$dateDep=date("d, D M", strtotime($deps)); echo $dateDep; ?></span> </div>
                    <div class="fleft top20 left20" style="margin-top:28px;"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $flight_result_trip->alocation; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $adate[1]; ?><br />
                             <?php 
                                $date_arv = $flight_result_trip->arv_date;
                                $arv_dates = explode('/',$date_arv);
                                $arvs = "20".$arv_dates[2]."-".$arv_dates[1]."-".$arv_dates[0];
				$dateArr=date("d, D M", strtotime($arvs)); echo $dateArr; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip->duration_final_eft; ?><br />
                        <div class="popbox"  style="float:left; width:25px;" >
            <a class="open" href="#" style=" float:left; padding-top:2px; text-align:center; width:80px; color:#1d6aa5;"> <?php echo($flight_result[$i]->stops > 0 ? $flight_result[$i]->stops.' Stops' : 'Non Stop') ?> </a>
            <div class="collapse"  >
      <div style="display: none; top: 10px; " class="box">
        
<div style="float:left; margin-left:32px; padding-top:25px; position:absolute;"><a href="#"  ><img src="<?php echo base_url(); ?>assets/images/top.png" border="0"  /></a></div>
        <div style="width:700px; height:auto; height:auto; float:left; background:#fff; border:solid 1px #d9d9d9; border:solid 1px #BBBBBB;
      border-radius:5px; margin-top:36px; box-shadow:0px 0px 15px #999; margin-left:-266px; ">
      
              
        
        
        <div style="float:left; width:690px; height:auto; font-size:10px; font-size:12px; color:#333;  padding:5px;overflow: auto;">
        	 	
             <div class="fleft wid500" style="width:690px;">
                    <div style="font-size:14px; background-color:#0d4b81; padding:5px; width:680px; color:#FFF;   text-align:left;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                    for($st=0;$st<$count;$st++)
                    {
                        $depdate=explode(' ',$ddate1[$st]);
                        $arvdate=explode(' ',$adate1[$st]);
                        $depDate1=explode('-',$depdate[0]);
                        $arvDate1=explode('-',$arvdate[0]);
                ?>

                    <div class="fleft wid125 top20" style="width:158px;">
                        <div class="wid40 fleft"  style="width:80px;">
                            <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$st]; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:16px; width:130px; text-align:left; "><?php echo $name[$st]; ?><br /> 
                            <?php echo $cicode[$st].' - '.$fnumber[$st]; ?><br /> 
                            <?php 
								$cabin_value=$cabin[$st];
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
                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px; "> <span class="fair_add_txt"><?php echo $dlocation[$st]; ?> <strong><?php echo $depdate[1]; ?></strong></span><br />
                        <?php $dateDep=date("jS, F Y", strtotime($depDate1[2].'-'.$depDate1[1].'-'.$depDate1[0])); echo $dateDep; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:16px;  width:80px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                     <?php echo $duration_final1[$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $alocation[$st]; ?> <strong><?php echo $arvdate[1]; ?></strong></span><br />
                        <?php $dateArr=date("jS, F Y", strtotime($arvDate1[2].'-'.$arvDate1[1].'-'.$arvDate1[0])); echo $dateArr; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid140 fleft top20 left20" style="text-align:center; line-height:18px; width:80px;"> <span class="fair_add_txt"><?php echo $duration_final1[$st]; ?> </strong></span><br />
                         <br />
   							<?php $airport_from = $this->Flights_Model->get_City_name($flight_result[$i]->alocation); 
							  echo $airport_from->city; ?>
                    </div>
                    
                    <div class="clear"></div>
                     <?php if($duration_final_layover[$st] != '') { ?> <div style="font-size:11px; background-color:#e5eaf0; padding:5px; width:680px; color:#333; margin:10px 0px;text-align:center;"> Change of Planes   Connection time <?php echo $duration_final_layover[$st]; ?></div> <?php } ?>
                     <?php 
                    }
                ?>
                </div> 
    <!--                <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>-->
                
               	
            
 
         
         </div>
        
        </div>
</div></div></div>
                         </div>
            <?php
                }
                else
                {
//					$stops=$flight_result_trip->stops;
//					$cicode=explode('<br>',$flight_result_trip->cicode);
//					$name=explode('<br>',$flight_result_trip->name);
//					$fnumber=explode('<br>',$flight_result_trip->fnumber);
//					$dlocation=explode('<br>',$flight_result_trip->dlocation);
//					$alocation=explode('<br>',$flight_result_trip->alocation);
//					$timeOfDeparture=explode('<br>',$flight_result_trip->timeOfDeparture);
//					$timeOfArrival=explode('<br>',$flight_result_trip->timeOfArrival);
//					$dateOfDeparture=explode('<br>',$flight_result_trip->dateOfDeparture);
//					$dateOfArrival=explode('<br>',$flight_result_trip->dateOfArrival);
//					$equipmentType=explode('<br>',$flight_result_trip->equipmentType);
//					$ddate=explode('<br>',$flight_result_trip->ddate);
//					$adate=explode('<br>',$flight_result_trip->adate);
//					$dep_date=explode('<br>',$flight_result_trip->dep_date);
//					$arv_date=explode('<br>',$flight_result_trip->arv_date);
//					$ddate1=explode('<br>',$flight_result_trip->ddate1);
//					$adate1=explode('<br>',$flight_result_trip->adate1);
//					$duration_final=explode('<br>',$flight_result_trip->duration_final);
//					$duration_final1=explode('<br>',$flight_result_trip->duration_final1);
//					$dur_in_min_layover=explode('<br>',$flight_result_trip->dur_in_min_layover);
//					$duration_final_layover=explode('<br>',$flight_result_trip->duration_final_layover);
//					$fareType=explode('<br>',$flight_result_trip->fareType);
//					$BookingClass=explode('<br>',$flight_result_trip->BookingClass);
//					$cabin=explode('<br>',$flight_result_trip->cabin);
//					
//					$count=count($dlocation);
//					$ddate=explode(' ',$ddate1[0]);
//					$adate=explode(' ',$adate1[$stops]);
//					$duration=explode(' ',$flight_result_trip->duration_final_eft);
//					$durCount=count($duration);
//					
//					if($durCount==3)
//					{
//						$duration0=explode('D',$duration[0]);
//						$duration1=explode('H',$duration[1]);
//						$duration2=explode('M',$duration[2]);
//						$durationInMin1=($duration0[0]*24*60)+($duration1[0]*60)+$duration2[0];
//						$durationMinSec1=($duration0[0]*24)+$duration1[0].'H '.$duration2[0].'M';
//					}
//					else if($durCount==2)
//					{
//						$duration1=explode('H',$duration[0]);
//						$duration2=explode('M',$duration[1]);
//						$durationInMin1=($duration1[0]*60)+$duration2[0];
//						$durationMinSec1=$flight_result_trip->duration_final_eft;
//					}
//					else
//					{
//						$duration2=explode('M',$duration[1]);
//						$durationInMin1=$duration2[0];
//						$durationMinSec1=$flight_result_trip->duration_final_eft;
//					}
            ?>
                    <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[0]; ?>.gif" border="0" align="absmiddle" class="left10" /> <?php echo $name[0]; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-right:30px; text-align:right;" ><span class="fair_add_txt"><?php echo $dlocation[0]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $ddate[1]; ?><br />
                            <?php 
								$date_dep = $dep_date[0];
								$date_deps = explode('/',$date_dep);
								$deps = "20".$date_deps[2]."-".$date_deps[1]."-".$date_deps[0];
						$dateDep=date("d, D M", strtotime($deps)); echo $dateDep; ?></span> </div>
                    <div class="fleft top20 left20" style="margin-top:28px;"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $alocation[$ostops]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $adate[$ostops]; ?><br />
                             <?php 
								$arv_date = $arv_date[$ostops];
								$arv_dates = explode('/',$arv_date);
								$arvs = "20".$arv_dates[2]."-".$arv_dates[1]."-".$arv_dates[0];
						$arvs_det=date("d, D M", strtotime($arvs)); echo $arvs_det; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip->duration_final_eft; ?><br />
                        <div class="popbox"  style="float:left; width:25px;" >
            <a class="open" href="#" style=" float:left; padding-top:2px; text-align:center; width:80px; color:#1d6aa5;"> <?php echo($flight_result[$i]->stops > 0 ? $flight_result[$i]->stops.' Stops' : 'Non Stop') ?> </a>
            <div class="collapse"  >
      <div style="display: none; top: 10px; " class="box">
        
<div style="float:left; margin-left:32px; padding-top:25px; position:absolute;"><a href="#"  ><img src="<?php echo base_url(); ?>assets/images/top.png" border="0"  /></a></div>
        <div style="width:700px; height:auto; height:auto; float:left; background:#fff; border:solid 1px #d9d9d9; border:solid 1px #BBBBBB;
      border-radius:5px; margin-top:36px; box-shadow:0px 0px 15px #999; margin-left:-266px; ">
      
              
        
        
        <div style="float:left; width:690px; height:auto; font-size:10px; font-size:12px; color:#333;  padding:5px;overflow: auto;">
        	 	
             <div class="fleft wid500" style="width:690px;">
                    <div style="font-size:14px; background-color:#0d4b81; padding:5px; width:680px; color:#FFF;   text-align:left;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                    for($st=0;$st<$count;$st++)
                    {
                        $depdate=explode(' ',$ddate1[$st]);
                        $arvdate=explode(' ',$adate1[$st]);
                        $depDate1=explode('-',$depdate[0]);
                        $arvDate1=explode('-',$arvdate[0]);
                ?>

                    <div class="fleft wid125 top20" style="width:158px;">
                        <div class="wid40 fleft"  style="width:80px;">
                            <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$st]; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:16px; width:130px; text-align:left; "><?php echo $name[$st]; ?><br /> 
                            <?php echo $cicode[$st].' - '.$fnumber[$st]; ?><br /> 
                            <?php 
								$cabin_value=$cabin[$st];
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
                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px; "> <span class="fair_add_txt"><?php echo $dlocation[$st]; ?> <strong><?php echo $depdate[1]; ?></strong></span><br />
                        <?php $dateDep=date("jS, F Y", strtotime($depDate1[2].'-'.$depDate1[1].'-'.$depDate1[0])); echo $dateDep; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:16px;  width:80px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                     <?php echo $duration_final1[$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $alocation[$st]; ?> <strong><?php echo $arvdate[1]; ?></strong></span><br />
                        <?php $dateArr=date("jS, F Y", strtotime($arvDate1[2].'-'.$arvDate1[1].'-'.$arvDate1[0])); echo $dateArr; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid140 fleft top20 left20" style="text-align:center; line-height:18px; width:80px;"> <span class="fair_add_txt"><?php echo $duration_final1[$st]; ?> </strong></span><br />
                         <br />
   							<?php $airport_from = $this->Flights_Model->get_City_name($flight_result[$i]->alocation); 
							  echo $airport_from->city; ?>
                    </div>
                    
                    <div class="clear"></div>
                     <?php if($duration_final_layover[$st] != '') { ?> <div style="font-size:11px; background-color:#e5eaf0; padding:5px; width:680px; color:#333; margin:10px 0px;text-align:center;"> Change of Planes   Connection time <?php echo $duration_final_layover[$st]; ?></div> <?php } ?>
                     <?php 
                    }
                ?>
                </div> 
    <!--                <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>-->
                
               	
            
 
         
         </div>
        
        </div>
</div></div></div>
                         </div>
            <?php
                }
            ?>


            <div  class="top10"> <img src="<?php echo base_url(); ?>assets/images/details_devider_roundtrip.png" /></div>
            <?php //echo $flight_result_trip->ref_id; ?>
            <?php
                 
                $rstops = $flight_result_trip_return->stops;
                if($rstops==0)
                {
                    $rddate=explode(' ',$flight_result_trip_return->ddate1);
                    $radate=explode(' ',$flight_result_trip_return->adate1);
                }
                else
                {
                    $rddate=explode(' ',$flight_result_trip_return->ddate1[$rstops]);
                    $radate=explode(' ',$flight_result_trip_return->adate1[$rstops]);
                }
				
				
                if($flight_result_trip_return->stops==0)
                {
            ?>
                    <div class=" wid100 fleft top10 left10" style="line-height:16px; width:90px; text-align:center; font-weight:normal;"> <div class="box_roundtrip left10" ><img src="<?php echo base_url(); ?>assets/images/flight_icon5.png" align="absmiddle" style="margin-top:3px; float:left;" /> Return  </div>
                        <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_result_trip_return->cicode; ?>.gif" border="0" align="absmiddle" class="left10" /> <?php echo $flight_result_trip_return->name; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-right:30px; text-align:right;" ><span class="fair_add_txt"><?php echo $flight_result_trip_return->dlocation; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $rddate[1]; ?><br />
                            <?php $arv = $flight_result_trip_return->dep_date; 
									$date_arv = explode('/',$arv);
								$date_arvs = "20".$date_arv[2]."-".$date_arv[1]."-".$date_arv[0];
						$datesrvs=date("d, D M", strtotime($date_arvs)); echo $datesrvs;
							?></span> </div>
                    <div class="fleft top20 left20" style="margin-top:28px;"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px; " ><span class="fair_add_txt"><?php echo $flight_result_trip_return->alocation; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $radate[1]; ?><br />
                            <?php 
							$date_arv = $flight_result_trip_return->arv_date;
							$arv_dates = explode('/',$date_arv);
							$arvs = "20".$arv_dates[2]."-".$arv_dates[1]."-".$arv_dates[0];
						$dateArr=date("d, D M", strtotime($arvs)); echo $dateArr; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip->duration_final_eft; ?><br />
                        <div class="popbox"  style="float:left; width:25px;" >
            <a class="open" href="#" style=" float:left; padding-top:2px; text-align:center; width:80px; color:#1d6aa5;"> 
			<?php echo($flight_result[$i]->stops > 0 ? $flight_result[$i]->stops.' Stops' : 'Non Stop') ?> </a>
            <div class="collapse"  >
      <div style="display: none; top: 10px; " class="box">
        
<div style="float:left; margin-left:32px; padding-top:25px; position:absolute;"><a href="#"  ><img src="<?php echo base_url(); ?>assets/images/top.png" border="0"  /></a></div>
        <div style="width:700px; height:auto; height:auto; float:left; background:#fff; border:solid 1px #d9d9d9; border:solid 1px #BBBBBB;
      border-radius:5px; margin-top:36px; box-shadow:0px 0px 15px #999; margin-left:-266px; ">
      
              
        
        
        <div style="float:left; width:690px; height:auto; font-size:10px; font-size:12px; color:#333;  padding:5px;overflow: auto;">
        	 	
             <div class="fleft wid500" style="width:690px;">
                    <div style="font-size:14px; background-color:#0d4b81; padding:5px; width:680px; color:#FFF;   text-align:left;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                    for($st=0;$st<$count;$st++)
                    {
                        $depdate=explode(' ',$ddate1[$st]);
                        $arvdate=explode(' ',$adate1[$st]);
                        $depDate1=explode('-',$depdate[0]);
                        $arvDate1=explode('-',$arvdate[0]);
                ?>

                    <div class="fleft wid125 top20" style="width:158px;">
                        <div class="wid40 fleft"  style="width:80px;">
                            <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$st]; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:16px; width:130px; text-align:left; "><?php echo $name[$st]; ?><br /> 
                            <?php echo $cicode[$st].' - '.$fnumber[$st]; ?><br /> 
                            <?php 
								$cabin_value=$cabin[$st];
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
                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px; "> <span class="fair_add_txt"><?php echo $dlocation[$st]; ?> <strong><?php echo $depdate[1]; ?></strong></span><br />
                        <?php $dateDep=date("jS, F Y", strtotime($depDate1[2].'-'.$depDate1[1].'-'.$depDate1[0])); echo $dateDep; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:16px;  width:80px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                     <?php echo $duration_final1[$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $alocation[$st]; ?> <strong><?php echo $arvdate[1]; ?></strong></span><br />
                        <?php $dateArr=date("jS, F Y", strtotime($arvDate1[2].'-'.$arvDate1[1].'-'.$arvDate1[0])); echo $dateArr; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid140 fleft top20 left20" style="text-align:center; line-height:18px; width:80px;"> <span class="fair_add_txt"><?php echo $duration_final1[$st]; ?> </strong></span><br />
                         <br />
   							<?php $airport_from = $this->Flights_Model->get_City_name($flight_result[$i]->alocation); 
							  echo $airport_from->city; ?>
                    </div>
                    
                    <div class="clear"></div>
                     <?php if($duration_final_layover[$st] != '') { ?> <div style="font-size:11px; background-color:#e5eaf0; padding:5px; width:680px; color:#333; margin:10px 0px;text-align:center;"> Change of Planes   Connection time <?php echo $duration_final_layover[$st]; ?></div> <?php } ?>
                     <?php 
                    }
                ?>
                </div> 
    <!--                <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>-->
                
               	
            
 
         
         </div>
        
        </div>
</div></div></div>
                         </div>
            <?php 
                }
                else
                {
					$stops=$flight_result_trip_return->stops;
					$cicode=explode('<br>',$flight_result_trip_return->cicode);
					$name=explode('<br>',$flight_result_trip_return->name);
					$fnumber=explode('<br>',$flight_result_trip_return->fnumber);
					$dlocation=explode('<br>',$flight_result_trip_return->dlocation);
					$alocation=explode('<br>',$flight_result_trip_return->alocation);
					$timeOfDeparture=explode('<br>',$flight_result_trip_return->timeOfDeparture);
					$timeOfArrival=explode('<br>',$flight_result_trip_return->timeOfArrival);
					$dateOfDeparture=explode('<br>',$flight_result_trip_return->dateOfDeparture);
					$dateOfArrival=explode('<br>',$flight_result_trip_return->dateOfArrival);
					$equipmentType=explode('<br>',$flight_result_trip_return->equipmentType);
					$ddate=explode('<br>',$flight_result_trip_return->ddate);
					$adate=explode('<br>',$flight_result_trip_return->adate);
					$dep_date=explode('<br>',$flight_result_trip_return->dep_date);
					$arv_date=explode('<br>',$flight_result_trip_return->arv_date);
					$ddate1=explode('<br>',$flight_result_trip_return->ddate1);
					$adate1=explode('<br>',$flight_result_trip_return->adate1);
					$duration_final=explode('<br>',$flight_result_trip_return->duration_final);
					$duration_final1=explode('<br>',$flight_result_trip_return->duration_final1);
					$dur_in_min_layover=explode('<br>',$flight_result_trip_return->dur_in_min_layover);
					$duration_final_layover=explode('<br>',$flight_result_trip_return->duration_final_layover);
					$fareType=explode('<br>',$flight_result_trip_return->fareType);
					$BookingClass=explode('<br>',$flight_result_trip_return->BookingClass);
					$cabin=explode('<br>',$flight_result_trip_return->cabin);
					
					$count=count($dlocation);
					$ddate=explode(' ',$ddate1[0]);
					$adate=explode(' ',$adate1[$stops]);
					$duration=explode(' ',$flight_result_trip_return->duration_final_eft);
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
						$durationMinSec1=$flight_result_trip_return->duration_final_eft;
					}
					else
					{
						$duration2=explode('M',$duration[1]);
						$durationInMin1=$duration2[0];
						$durationMinSec1=$flight_result_trip_return->duration_final_eft;
					}
					
            ?>
                    <div class=" wid100 fleft top10 left10"  style="line-height:18px; width:90px; font-weight:normal; text-align:center"> <div class="box_roundtrip left10"><img src="<?php echo base_url(); ?>assets/images/flight_icon5.png" align="absmiddle" style="margin-top:3px; float:left;" />  Return  </div>
                        <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$rstops]; ?>.gif" border="0" align="absmiddle" class="left10" /> <br />
<?php echo $name[$rstops]; ?></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-right:30px;  text-align:right;" ><span class="fair_add_txt"><?php echo $dlocation[0]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $ddate[1]; ?><br />
                            <?php //echo $rddate[$rstops]; ?>
                            <?php 
								$date_dep = $dep_date[0];
								$date_deps = explode('/',$date_dep);
								$deps = "20".$date_deps[2]."-".$date_deps[1]."-".$date_deps[0];
						$dateDep=date("d, D M", strtotime($deps)); echo $dateDep; ?>
						</span> </div>
                    <div class="fleft top20 left20" style="margin-top:28px;"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
                    <div class="wid100 fleft top10 left10" style="line-height:18px; padding-left:30px;" ><span class="fair_add_txt"><?php echo $alocation[$rstops]; ?></span> <br />
                        <span class="flight_booking_smalltxt"><?php echo $adate[$rstops]; ?><br />
                            <?php //echo $adate[0]; 
                            
								$arv_date = $arv_date[$ostops];
								$arv_dates = explode('/',$arv_date);
								$arvs = "20".$arv_dates[2]."-".$arv_dates[1]."-".$arv_dates[0];
						$arvs_det=date("d, D M", strtotime($arvs)); echo $arvs_det; ?></span> </div>
                    <div class="wid80 fleft top10 left30" style="line-height:18px; padding-left:0px; text-align:center;" ><?php echo $flight_result_trip_return->duration_final_eft; ?><br />
                    <?php if($rstops >0) { ?>
                        <a href="" class="stop_txt"> <?php
                            echo $rstops.' Stops';
                        ?> </a>
                        <?php } else
						{ echo $rstops.' Stops'; } ?> </div>
            <?php
                }
            ?>
    </div>


    <div class="fleft wid170 left10 top20" style="width:167px;"><div class="fleft"><img src="<?php echo base_url(); ?>assets/images/vertical_devider.png" />
        </div> <div style="text-align:center; line-height:26px;">
            <span class="details_price_small_txt">&#36;<?php echo ($flight_result_trip->Total_FareAmount+$flight_result_trip_return->Total_FareAmount); ?></span>
            <br />
            <span>
                <span class="details_price_txt">&#36;<?php echo ($flight_result_trip->Total_FareAmount+$flight_result_trip_return->Total_FareAmount); ?></span></span><br />
            <div class="booknow_btn left60"><a href="<?php echo site_url(); ?>/flights/flight_details/<?php echo $flight_result_trip->id; ?>/<?php echo $flight_result_trip->rand_id; ?>/<?php echo $flight_result_trip->ref_id; ?>" style="text-decoration:none; color:#FFF; font-weight:normal;">BOOK</a></div>


        </div><div id="details<?php echo $i; ?>" class="detail_txt " style="margin-left:47px !important; float:left;" >
            <img align="absmiddle" src="<?php echo base_url(); ?>assets/images/plus_icon.png" style="float:left; margin-top:9px;">
            Details
        </div>
   </div>

    <div id="flightdetails<?php echo $i; ?>" style="color:#000;display:none;">


            <div align="center" class="top10"> <img src="<?php echo base_url(); ?>assets/images/details_devider.jpg" /></div>

            <div class="fleft wid500">
                <div style="font-size:14px;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?></strong> <?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
              <?php 
               
                if($ostops==0)
                {
              ?>  
                <div class="fleft wid125 top20" style="width:158px;">
                    <div class="wid40 fleft" style="width:80px;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_result_trip->cicode; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result_trip->name; ?><br /> 
                        <?php echo $flight_result_trip->cicode.' - '.$flight_result_trip->fnumber; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin=$flight_result_trip->cabin;
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

                <div class="wid140 fleft top20" style="text-align:right; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip->dlocation; ?><strong><?php echo $flight_result_trip->ddate; ?></strong></span><br />
                    <?php echo $flight_result_trip->ddate; ?><br />
                    <?php //echo $fromcityAirport[1]; 
                    $airportNameDep=$this->Flights_Model->get_airportname($flight_result_trip->dlocation);
                                            echo $airportNameDep->city;
                    ?></div>

                <div class="wid40 fleft top20" style="line-height:16px; width:50px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                <?php echo $flight_result_trip->duration_final_eft; ?></div>
                <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px; width:120px;"> <span class="fair_add_txt"><?php echo $flight_result_trip->alocation; ?> <strong><?php echo $flight_result_trip->adate; ?></strong></span><br />
                    <?php echo $flight_result_trip->adate; ?>
                    <?php 
//echo $tocityAirport[1]; 
                    $airportNameArv=$this->Flights_Model->get_airportname($flight_result_trip->alocation);
                                        echo $airportNameArv->city;
                    ?></div>
                <div class="clear"></div>
                
               
                 </div>
                <div class="fright wid225" style="margin-right:20px;">
                <div class="fairprice_bg">
                    <div class="fair_txt" style="line-height:18px;">Fare breakup</div>
                    <div class="fleft wid100 fair_txt_small top10"  >Base Fare<br />
                        Taxes & Fees<br />
                        Total
                    </div>
                    <div class="fleft wid100 fair_txt_small top10 left20"  >&#36;<?php echo($flight_result_trip->Total_FareAmount-$flight_result_trip->TaxAmount); ?><br />
                        &#36;<?php echo $flight_result_trip->TaxAmount; ?><br />
                        &#36;<?php echo $flight_result_trip->Total_FareAmount; ?>
                    </div>
                    <div class="clear"> </div>


                </div>
            </div> 
            <?php
                }
                else
                {
                    //echo '<pre />';print_r($flight_result_trip);die;
                    $countStop=count($flight_result_trip->cicode);
                    //echo $flight_result_trip->ddate1.'<<<>>>'.$flight_result_trip->adate1;die;
                    for($os=0;$os<$countStop;$os++)
                    {
                        
                        $stops=$flight_result_trip->stops;
                        $cicode=explode('<br>',$flight_result_trip->cicode);
                        $name=explode('<br>',$flight_result_trip->name);
                        $fnumber=explode('<br>',$flight_result_trip->fnumber);
                        $dlocation=explode('<br>',$flight_result_trip->dlocation);
                        $alocation=explode('<br>',$flight_result_trip->alocation);
                        $timeOfDeparture=explode('<br>',$flight_result_trip->timeOfDeparture);
                        $timeOfArrival=explode('<br>',$flight_result_trip->timeOfArrival);
                        $dateOfDeparture=explode('<br>',$flight_result_trip->dateOfDeparture);
                        $dateOfArrival=explode('<br>',$flight_result_trip->dateOfArrival);
                        $equipmentType=explode('<br>',$flight_result_trip->equipmentType);
                        $ddate=explode('<br>',$flight_result_trip->ddate);
                        $adate=explode('<br>',$flight_result_trip->adate);
                        $dep_date=explode('<br>',$flight_result_trip->dep_date);
                        $arv_date=explode('<br>',$flight_result_trip->arv_date);
                        $ddate1=explode('<br>',$flight_result_trip->ddate1);
                        $adate1=explode('<br>',$flight_result_trip->adate1);
                        $ddate2=explode(' ',$ddate1[$os]);
                        $adate2=explode(' ',$adate1[$os]);
                        $duration_final=explode('<br>',$flight_result_trip->duration_final);
                        $duration_final1=explode('<br>',$flight_result_trip->duration_final1);
                        $dur_in_min_layover=explode('<br>',$flight_result_trip->dur_in_min_layover);
                        $duration_final_layover=explode('<br>',$flight_result_trip->duration_final_layover);
                        $fareType=explode('<br>',$flight_result_trip->fareType);
                        $BookingClass=explode('<br>',$flight_result_trip->BookingClass);
                        $cabin=explode('<br>',$flight_result_trip->cabin);

                        $count=count($dlocation);
                        $ddate=explode(' ',$ddate1[0]);
                        $adate=explode(' ',$adate1[$stops]);
                        $duration=explode(' ',$flight_result_trip->duration_final_eft);
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
                                $durationMinSec1=$flight_result_trip->duration_final_eft;
                        }
                        else
                        {
                                $duration2=explode('M',$duration[1]);
                                $durationInMin1=$duration2[0];
                                $durationMinSec1=$flight_result_trip->duration_final_eft;
                        }
       ?>
       <?php 
            $jk=1;
            for($st=0;$st<$count;$st++)
            {
                $depdate=explode(' ',$ddate1[$st]);
                $arvdate=explode(' ',$adate1[$st]);
                $depDate1=explode('-',$depdate[0]);
                $arvDate1=explode('-',$arvdate[0]);
       ?>
                <div class="fleft wid125 top20" style="width:158px;">
                    <div class="wid40 fleft" style="width:80px;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$os]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $name[$os]; ?><br /> 
                        <?php echo $cicode[$os].' - '.$fnumber[$os]; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin1=$cabin[$os];
                            if($cabin1=="MC")
                                    $cabin_text="Major Cabin";
                            else if($cabin1=="RC")
                                    $cabin_text="Recommended";
                            else if($cabin1=="C")
                                    $cabin_text="Business";
                            else if($cabin1=="F")
                                    $cabin_text="First";
                            else if($cabin1=="M")
                                    $cabin_text="Economy Standard";
                            else if($cabin1=="W")
                                    $cabin_text="Economy Premium";
                            
                            echo $cabin_text;
                        ?></div>
                    </div>

                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px;"> <span class="fair_add_txt"><?php echo $dlocation[$st]; ?><strong><?php echo $ddate1[1]; ?></strong></span><br />
                        <?php echo $ddate1[$st]; ?><br />
                        <?php
                        //echo $fromcityAirport[1]; 
                        $airportNameDep=$this->Flights_Model->get_airportname($dlocation[$st]);
                        echo $airportNameDep->city;
                        ?></div>

                    <div class="wid40 fleft top20" style="line-height:16px; width:50px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                    <?php echo $duration_final1[$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px; width: 120px;"> <span class="fair_add_txt"><?php echo $alocation[$st]; ?> <strong><?php echo $arvdate[$st]; ?></strong></span><br />
                        <?php echo $adate1[$st]; ?><br />
                        <?php
                        //echo $tocityAirport[1]; 
                        $airportNameArv=$this->Flights_Model->get_airportname($alocation[$st]);
                        echo $airportNameArv->city;
                        ?></div>
                    <div class="clear"></div>
                <?php if($jk<$count){ ?>    
                  <div style="font-size:11px; background-color:#e5eaf0; color:#333; margin:10px 0px;text-align:center;"> Change of Planes Connection time <?php echo $duration_final_layover[$st]; ?></div>     
                <?php } ?>
            <?php
                        $jk++;
                    }
                    
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
                    <div class="fleft wid100 fair_txt_small top10 left20"  >&#36;<?php echo($flight_result_trip->Total_FareAmount-$flight_result_trip->TaxAmount); ?><br />
                        &#36;<?php echo $flight_result_trip->TaxAmount; ?><br />
                        &#36;<?php echo $flight_result_trip->Total_FareAmount; ?>
                    </div>
                    <div class="clear"> </div>


                </div>
            </div> 
            <?php } ?> <br />
            <div>Return Flight:<br /></div>
            <!--##################################################--->
            <div class="fleft wid500">
                <div style="font-size:14px;"><strong><?php echo $_SESSION['toCity']; ?> to <?php echo $_SESSION['fromCity']; ?></strong> <?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                if($rstops==0)
                {
              ?>  
                <div class="fleft wid125 top20"  style="width:158px;">
                    <div class="wid40 fleft" style="width:80px;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_result_trip_return->cicode; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flight_result_trip_return->name; ?><br /> 
                        <?php echo $flight_result_trip_return->cicode.' - '.$flight_result_trip_return->fnumber; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin=$flight_result_trip_return->cabin;
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

                <div class="wid140 fleft top20" style="text-align:right; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result_trip_return->dlocation; ?><strong><?php echo $flight_result_trip->ddate; ?></strong></span><br />
                    <?php echo $flight_result_trip->ddate; ?><br />
                    <?php 
//echo $fromcityAirport[1]; 
                    $airportNameDep=$this->Flights_Model->get_airportname($flight_result_trip_return->dlocation);
                                            echo $airportNameDep->city;
                    ?></div>

                <div class="wid40 fleft top20" style="line-height:16px; width:50px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
<?php echo $flight_result_trip_return->duration_final_eft; ?></div>
                <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px; width: 120px;"> <span class="fair_add_txt"><?php echo $flight_result_trip_return->alocation; ?> <strong><?php echo $adate[1]; ?></strong></span><br />
                    <?php echo $adate[0]; ?><br />
                    <?php 
//echo $tocityAirport[1]; 
                    $airportNameArv=$this->Flights_Model->get_airportname($flight_result_trip_return->alocation);
                                        echo $airportNameArv->city;
                    ?></div>
                <div class="clear"></div>
<!--                 <div style="font-size:11px; background-color:#e5eaf0; color:#333; margin:10px 0px;text-align:center;"> Change of Planes Connection time 1 hours 25 minutes</div>-->
            <?php
                }
                else
                {
                    $countStop1=count($flight_result_trip_return->cicode);
                    for($os=0;$os<$countStop1;$os++)
                    {
                        
                        $stops=$flight_result_trip_return->stops;
                        $cicode=explode('<br>',$flight_result_trip_return->cicode);
                        $name=explode('<br>',$flight_result_trip_return->name);
                        $fnumber=explode('<br>',$flight_result_trip_return->fnumber);
                        $dlocation=explode('<br>',$flight_result_trip_return->dlocation);
                        $alocation=explode('<br>',$flight_result_trip_return->alocation);
                        $timeOfDeparture=explode('<br>',$flight_result_trip_return->timeOfDeparture);
                        $timeOfArrival=explode('<br>',$flight_result_trip_return->timeOfArrival);
                        $dateOfDeparture=explode('<br>',$flight_result_trip_return->dateOfDeparture);
                        $dateOfArrival=explode('<br>',$flight_result_trip_return->dateOfArrival);
                        $equipmentType=explode('<br>',$flight_result_trip_return->equipmentType);
                        $ddate=explode('<br>',$flight_result_trip_return->ddate);
                        $adate=explode('<br>',$flight_result_trip_return->adate);
                        $dep_date=explode('<br>',$flight_result_trip_return->dep_date);
                        $arv_date=explode('<br>',$flight_result_trip_return->arv_date);
                        $ddate1=explode('<br>',$flight_result_trip_return->ddate1);
                        $adate1=explode('<br>',$flight_result_trip_return->adate1);
                        $ddate2=explode(' ',$ddate1[$os]);
                        $adate2=explode(' ',$adate1[$os]);
                        $duration_final=explode('<br>',$flight_result_trip_return->duration_final);
                        $duration_final1=explode('<br>',$flight_result_trip_return->duration_final1);
                        $dur_in_min_layover=explode('<br>',$flight_result_trip_return->dur_in_min_layover);
                        $duration_final_layover=explode('<br>',$flight_result_trip_return->duration_final_layover);
                        $fareType=explode('<br>',$flight_result_trip_return->fareType);
                        $BookingClass=explode('<br>',$flight_result_trip_return->BookingClass);
                        $cabin=explode('<br>',$flight_result_trip_return->cabin);

                        $count=count($dlocation);
                        $ddate=explode(' ',$ddate1[0]);
                        $adate=explode(' ',$adate1[$stops]);
                        $duration=explode(' ',$flight_result_trip_return->duration_final_eft);
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
                                $durationMinSec1=$flight_result_trip_return->duration_final_eft;
                        }
                        else
                        {
                                $duration2=explode('M',$duration[1]);
                                $durationInMin1=$duration2[0];
                                $durationMinSec1=$flight_result_trip_return->duration_final_eft;
                        }
            ?>
                    <?php 
                    $kj=1;
                    for($st=0;$st<$count;$st++)
                    {
                        $depdate=explode(' ',$ddate1[$st]);
                        $arvdate=explode(' ',$adate1[$st]);
                        $depDate1=explode('-',$depdate[0]);
                        $arvDate1=explode('-',$arvdate[0]);
                ?><div class="fleft wid125 top20"  style="width:158px;">
                    <div class="wid40 fleft"  style="width:80px;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$st]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $name[$st]; ?><br /> 
                        <?php echo $cicode[$st].' - '.$fnumber[$st]; ?><br /> 
                        <?php 
                            $cabin_text='';
                            $cabin2=$cabin[$st];
                            if($cabin2=="MC")
                                    $cabin_text="Major Cabin";
                            else if($cabin2=="RC")
                                    $cabin_text="Recommended";
                            else if($cabin2=="C")
                                    $cabin_text="Business";
                            else if($cabin2=="F")
                                    $cabin_text="First";
                            else if($cabin2=="M")
                                    $cabin_text="Economy Standard";
                            else if($cabin2=="W")
                                    $cabin_text="Economy Premium";
                            
                            echo $cabin_text;
                        ?></div>
                    </div>

                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px;"> <span class="fair_add_txt"><?php echo $dlocation[$st]; ?><strong><?php echo $ddate1[$st]; ?></strong></span><br />
                        <?php echo $ddate1[$st]; ?><br />
                        <?php
                        //echo $fromcityAirport[1]; 
                        $airportNameDep=$this->Flights_Model->get_airportname($dlocation[$st]);
                        echo $airportNameDep->city;
                        ?></div>

                    <div class="wid40 fleft top20" style="line-height:16px; width:50px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <br />
<?php echo $duration_final1[$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px; width: 120px;"> <span class="fair_add_txt"><?php echo $alocation[$st]; ?> <strong><?php echo $arvdate[1]; ?></strong></span><br />
                        <?php echo $adate1[$st]; ?><br />
                        <?php 
                            //echo $tocityAirport[1]; 
                            $airportNameArv=$this->Flights_Model->get_airportname($alocation[$st]);
                            echo $airportNameArv->city;
                        ?></div>
                    <div class="clear"></div>
                    <?php if($kj<$count){ ?>
                    <div style="font-size:11px; background-color:#e5eaf0; color:#333; margin:10px 0px;text-align:center;"> Change of Planes Connection time <?php echo $duration_final_layover[$st]; ?></div>
                    <?php } ?>
                        <?php $kj++;} ?>
            <?php
                        
                    }
                }
            ?>   
                
               <!-- <div class="fair_blue_txt top10">Baggage - 20kg allowed</div>-->
            </div> 
            <div class="fright wid225" style="margin-right:20px;">
                <div class="fairprice_bg">
                    <div class="fair_txt" style="line-height:18px;">Fare breakup</div>
                    <div class="fleft wid100 fair_txt_small top10"  >Base Fare<br />
                        Taxes & Fees<br />
                        Total
                    </div>
                    <div class="fleft wid100 fair_txt_small top10 left20"  >&#36;<?php echo ($flight_result_trip_return->Total_FareAmount-$flight_result_trip_return->TaxAmount); ?><br />
                        &#36;<?php echo $flight_result_trip_return->TaxAmount; ?><br />
                        &#36;<?php echo $flight_result_trip_return->Total_FareAmount; ?>
                    </div>
                    <div class="clear"> </div>

                </div>
            </div>
            <!--##################################################--->
            
            
        </div>
</div>
</div>


<?php
 echo '<script>
                  $("#details'.$i.'").click(function(){
                    $("#flightdetails'.$i.'").toggle();
                  });
                </script>';
           $i++; }
           
        }
}
        ///print_r($totalPriceAryRound);die;
?>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMinPriceRound" value="<?php if(!empty($totalPriceAryRound)) echo min($totalPriceAryRound); else echo 0; ?>" />
<input type="hidden" id="setMaxPriceRound" value="<?php if(!empty($totalPriceAryRound)) echo max($totalPriceAryRound); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '&#36;';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1440" />
<input type="hidden" id="setMinTimeRound" value="0" />
<input type="hidden" id="setMaxTimeRound" value="1440" />

