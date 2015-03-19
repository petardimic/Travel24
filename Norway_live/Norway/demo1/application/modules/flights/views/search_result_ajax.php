<?php /*?><script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script><?php */?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/popbox_new.css" type="text/css" media="screen" charset="utf-8">

<?php /*?>  <script type="text/javascript" charset="utf-8"  src="<?php echo base_url(); ?>assets/js/popbox_new.js"></script>
  <?php */?>
  <script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
      $('.popbox,.popbox1').popbox();
    });
  </script>
<?php
$totalPriceAry=array();
$departurearray = array();
$deals = $this->Flights_Model->getdeals();
$noofPassenger_count=$_SESSION['adults']+$_SESSION['childs']+$_SESSION['infants'];
if($flight_result != '')
{
    $r=0;
    $count_val = count($flight_result);
    $fcityname=explode(",",$_SESSION['fromcityval']);
    $fcount_city_code=(count($fcityname));
    $from_city_code=$fcityname[($fcount_city_code-1)];

    $tcityname=explode(",",$_SESSION['tocityval']);
    $tcount_city_code=(count($tcityname));
    $to_city_code=$tcityname[($tcount_city_code-1)];

    if($flight_result != '')
    {
        $count_val = count($flight_result);
        for($i=1;$i<=$count_val;$i++)
        {

            if($flight_result[$i]->Total_FareAmount!='')
            {
                $totalPriceAry[]= $flight_result[$i]->Total_FareAmount;
                if(strpos($flight_result[$i]->ddate, '<br>'))
                {
                    $res=explode('<br>',$flight_result[$i]->ddate);
                    for($f=0;$f<count($res);$f++)
                    {
                       $departurearray[]=$res[$f];
                    }
                }
                else
                {
                   $departurearray[] = $flight_result[$i]->ddate;
                }
                if($flight_result[$i]->flag=='false')
                {
                    $dep_name=$this->Flights_Model->get_City_name($flight_result[$i]->dlocation);
                    $arr_name=$this->Flights_Model->get_City_name($flight_result[$i]->alocation);

                    $dep_name_final=$dep_name->city.", ".$dep_name->country." (".$dep_name->city_code.")";
                    $arr_name_final=$arr_name->city.", ".$arr_name->country." (".$arr_name->city_code.")";

                    $date=$flight_result[$i]->ddate1;
                    $date1=explode(" ",$date);
                    $date_2=explode("-",$date1[0]);
                    $date_final_on=$date_2[0]."-".$date_2[1]."-20".$date_2[2];
                    $de_date = date('F j, Y',(strtotime("+0 day", (strtotime($date_final_on)))));

                    $ddate=explode(' ',$flight_result[$i]->ddate1);
                    $adate=explode(' ',$flight_result[$i]->adate1);
                    $duration=explode(' ',$flight_result[$i]->duration_final1);
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
                        $durationMinSec=$flight_result[$i]->duration_final1;
                    }
                    else
                    {
                        $duration2=explode('M',$duration[0]);
                        $durationInMin=$duration2[0];
                        $durationMinSec=$flight_result[$i]->duration_final1;
                    }
                                        
?>
<div class="searchflight_box">
    <div class="detail_area2 top10 FlightInfoBox searchflight" data-airline="<?php echo $flight_result[$i]->name; ?>" data-departure="<?php echo $ddate[1]; ?><?php //echo $flight_result[$i]->dtime_filter; ?>" data-arrival="<?php echo $flight_result[$i]->atime_filter; ?>" data-duration="<?php echo $durationInMin; ?>" data-price="<?php echo $flight_result[$i]->Total_FareAmount; ?>" data-stops="<?php echo $flight_result[$i]->stops; ?>" data-fare-type="<?php echo $flight_result[$i]->fareType; ?>">
        
       
        <?php if(isset($deals)) { if($deals->dealofday != '') { ?><div class="detail_bar"><img src="<?php echo base_url(); ?>assets/images/deal.png" align="absmiddle" /><?php echo $deals->dealofday; ?></a></div> <?php } } ?>
        <div class=" wid80 fleft top10 left10" style="line-height:18px; width:100px; font-weight:normal;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_result[$i]->cicode; ?>.gif" /><br /><?php echo ($flight_result[$i]->name=='Nacil Air India'?'Air India':$flight_result[$i]->name); ?></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:15px; text-align:center; font-weight:normal; font-size:14px;" ><?php echo $ddate[1]; ?><br /><span style="font-weight:normal;  font-size:11px; color:#4a4a4a;"> <?php echo $flight_result[$i]->dlocation; ?> </span></div>
        <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:20px; font-weight:normal; text-align:center; font-size:14px;" ><?php echo $adate[1]; ?><br /> <span style="font-weight:normal; color:#4a4a4a; font-size:11px;"><?php echo $flight_result[$i]->alocation; ?> </span></div>
        <div class="wid80 fleft top10 left30" style="line-height:17px; padding-left:30px; text-align:center; font-weight:normal; font-size:11px;" ><?php echo $durationMinSec; ?> <br /><span style="font-weight:normal; color:#4a4a4a;  font-size:11px;"><?php echo($flight_result[$i]->stops>0 ? $flight_result[$i]->stops.' Stops' : 'Non Stop') ?></span></div>
        <div class="wid170 fleft left60 top10 fleft" style="line-height:18px; text-align:right; margin-left:25px;"><span class="details_price_small_txt">&#36;<?php echo $flight_result[$i]->Total_FareAmount + ($flight_result[$i]->Total_FareAmount *5/100); ?></span>  <span class="left10">  <span class="details_price_txt">&#36;<?php echo $flight_result[$i]->Total_FareAmount; ?></span></span> <br /><span class="detail_txt" style="color:#333; float:right; font-weight:normal;">
			<?php 
				if($flight_result[$i]->fareType=='RP')
					echo 'Non-Refundable';
				else echo 'Refundable';
			 ?>
			</span><span id="details<?php echo $i; ?>" class="detail_txt">
            
            <span id="plusicon<?php echo $i; ?>" class="plusic"><img src="<?php echo base_url(); ?>assets/images/plus_icon.png" align="absmiddle" id="plus<?php echo $i; ?>" /></span>
           
            
            Details</span>
            <span id="details_hide<?php echo $i; ?>" class="detail_txt" style="display:none;"><span id="minusicon<?php echo $i; ?>" class="minusic"> <img src="<?php echo base_url(); ?>assets/images/minus_icon.png" align="absmiddle" id="minus<?php echo $i; ?>" style="display:none;" /></span> Details</span></div>
        <div class="book_btn fleft"><a href="<?php echo site_url(); ?>/flights/flight_details/<?php echo $flight_result[$i]->id; ?>/<?php echo $flight_result[$i]->rand_id; ?>">BOOK</a></div>
        <div id="flightdetails<?php echo $i; ?>" class="flightdet" style="color:#000; display:none;">
                <div align="center" class="top10">
                    <img src="<?php echo base_url(); ?>assets/images/details_devider.png" />
                </div>
                <div class="fleft wid500">
                    <div style="font-size:14px;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                    <div class="fleft wid125 top20" style="width:150px;"> 
                        <div class="wid40 fleft" style="width:70px;">
                            <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_result[$i]->cicode; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:18px;width: 68px;"><?php echo $flight_result[$i]->name; ?><br /> 
                            <?php echo $flight_result[$i]->cicode.' - '.$flight_result[$i]->fnumber; ?><br /> 
                            <?php 
								$cabin_value=$flight_result[$i]->cabin;
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
                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result[$i]->dlocation; ?> <strong><?php echo $ddate[1]; ?></strong></span><br />
                        <?php 
								$date_dep = $flight_result[$i]->dep_date;
								$date_deps = explode('/',$date_dep);
								$deps = "20".$date_deps[2]."-".$date_deps[1]."-".$date_deps[0];
						$dateDep=date("D, M Y", strtotime($deps)); echo $dateDep; ?><br />
                        <?php $airport_from = $this->Flights_Model->get_City_name($flight_result[$i]->dlocation); 
							  echo $airport_from->city; ?>
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:18px; margin-left:25px; text-align:center;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /> <br /><?php echo $flight_result[$i]->duration_final1; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_result[$i]->alocation; ?> <strong><?php echo $adate[1]; ?></strong></span><br />
                        <?php 
							$date_arv = $flight_result[$i]->arv_date;
							$arv_dates = explode('/',$date_arv);
							$arvs = "20".$arv_dates[2]."-".$arv_dates[1]."-".$arv_dates[0];
						$dateArr=date("D, M Y", strtotime($arvs)); echo $dateArr; ?><br />
    					<?php $airport_from = $this->Flights_Model->get_City_name($flight_result[$i]->alocation); 
							  echo $airport_from->city; ?>
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
                        <div class="fleft wid100 fair_txt_small top10 left20"  >&#36;<?php echo($flight_result[$i]->Total_FareAmount-$flight_result[$i]->TaxAmount); ?><br />
                            &#36;<?php echo $flight_result[$i]->TaxAmount; ?><br />
                            &#36;<?php echo $flight_result[$i]->Total_FareAmount; ?>
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
		$stops=$flight_result[$i]->stops;
		$cicode=explode('<br>',$flight_result[$i]->cicode);
        $name=explode('<br>',$flight_result[$i]->name);
        $fnumber=explode('<br>',$flight_result[$i]->fnumber);
        $dlocation=explode('<br>',$flight_result[$i]->dlocation);
        $alocation=explode('<br>',$flight_result[$i]->alocation);
        $timeOfDeparture=explode('<br>',$flight_result[$i]->timeOfDeparture);
        $timeOfArrival=explode('<br>',$flight_result[$i]->timeOfArrival);
        $dateOfDeparture=explode('<br>',$flight_result[$i]->dateOfDeparture);
        $dateOfArrival=explode('<br>',$flight_result[$i]->dateOfArrival);
        $equipmentType=explode('<br>',$flight_result[$i]->equipmentType);
        $ddate=explode('<br>',$flight_result[$i]->ddate);
        $adate=explode('<br>',$flight_result[$i]->adate);
        $dep_date=explode('<br>',$flight_result[$i]->dep_date);
        $arv_date=explode('<br>',$flight_result[$i]->arv_date);
        $ddate1=explode('<br>',$flight_result[$i]->ddate1);
        $adate1=explode('<br>',$flight_result[$i]->adate1);
        $duration_final=explode('<br>',$flight_result[$i]->duration_final);
        $duration_final1=explode('<br>',$flight_result[$i]->duration_final1);
        $dur_in_min_layover=explode('<br>',$flight_result[$i]->dur_in_min_layover);
        $duration_final_layover=explode('<br>',$flight_result[$i]->duration_final_layover);
        $fareType=explode('<br>',$flight_result[$i]->fareType);
        $BookingClass=explode('<br>',$flight_result[$i]->BookingClass);
        $cabin=explode('<br>',$flight_result[$i]->cabin);
        
        $count=count($dlocation);
        $ddate=explode(' ',$ddate1[0]);
        $adate=explode(' ',$adate1[$stops]);
        $duration=explode(' ',$flight_result[$i]->duration_final_eft);
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
            $durationMinSec1=$flight_result[$i]->duration_final_eft;
        }
        else
        {
            $duration2=explode('M',$duration[1]);
            $durationInMin1=$duration2[0];
            $durationMinSec1=$flight_result[$i]->duration_final_eft;
        }
        //$ddate_new=explode('<br>',$flight_result[$i]->ddate);
		//$departure = $ddate_new[0];
		//$departure1 = explode('(',$departure);
		//echo $departure1[1];

?>
<div class="searchflight_box"><div style="clear:both;"></div>
    <div class="detail_area2 top10 FlightInfoBox searchflight" data-airline="<?php echo $name[0]; ?>" data-departure="<?php echo $timeOfDeparture[0]; ?>" data-arrival="<?php echo $timeOfArrival[$stops]; ?>" data-duration="<?php echo $durationInMin1; ?>" data-price="<?php echo $flight_result[$i]->Total_FareAmount; ?>" data-stops="<?php echo $flight_result[$i]->stops; ?>" data-fare-type="<?php echo $fareType[0]; ?>">
        <?php if(isset($deals)) { if($deals->dealofday != '') { ?><div class="detail_bar"><img src="<?php echo base_url(); ?>assets/images/deal.png" align="absmiddle" /><?php echo $deals->dealofday; ?></a></div> <?php } } ?>
        <div class=" wid80 fleft top10 left10" style="line-height:18px; width:100px; font-weight:normal;"><img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[0]; ?>.gif" /><br /><?php echo($name[0]=='Nacil Air India' ? 'Air India':$name[0]); ?></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:15px; text-align:center; font-weight:normal; font-size:14px;" ><?php echo $ddate[1]; ?><br /> <span style="font-weight:normal; color:#4a4a4a;font-size:11px;"><?php echo $dlocation[0]; ?> </span></div>
        <div class="fleft top20 left20"><img src="<?php echo base_url(); ?>assets/images/flight_icon3.png" align="absmiddle" /></div>
        <div class="wid40 fleft top10 left10" style="line-height:18px; padding-left:20px;  text-align:center; font-weight:normal; font-size:14px;" ><?php echo $adate[1]; ?><br /> <span style="font-weight:normal; color:#4a4a4a; font-size:11px;"><?php echo $alocation[$stops]; ?></span> </div>
        <div class="wid80 fleft top10 left30" style="line-height:17px; padding-left:30px; text-align:center; font-weight:normal; font-size:11px;" ><?php echo $durationMinSec1; ?> <br /><span style="font-weight:normal; color:#4a4a4a;font-size:11px; "><div class="popbox"  style="float:left; width:25px;" >
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

                    <div class="fleft wid125 top20" style="width:210px;">
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
                    <div class="wid40 fleft top20" style="line-height:16px;  width:70px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
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
</div></div></div></span></div>
        <div class="wid170 fleft left60 top10 fleft" style="line-height:18px; text-align:right; margin-left:25px;"> <span class="details_price_small_txt"> &#36;<?php echo $flight_result[$i]->Total_FareAmount + ($flight_result[$i]->Total_FareAmount *5/100); ?></span> <span class="left10"> <span class="details_price_txt">&#36;<?php echo $flight_result[$i]->Total_FareAmount; ?></span></span> <br /> 
<span class="detail_txt" style="color:#333; float:right; font-weight:normal;">
	<?php 
		if($fareType[0]=='RP')
			echo 'Non-Refundable';
		else echo 'Refundable';
	 ?>
	</span><span id="details<?php echo $i; ?>" class="detail_txt">
            
            <span id="plusicon<?php echo $i; ?>" class="plusic"><img src="<?php echo base_url(); ?>assets/images/plus_icon.png" align="absmiddle" id="plus<?php echo $i; ?>" /></span>
           
            
            Details</span>
            <span id="details_hide<?php echo $i; ?>" class="detail_txt details_hide"  style="display:none;"><span id="minusicon<?php echo $i; ?>" class="minusic"> <img src="<?php echo base_url(); ?>assets/images/minus_icon.png" align="absmiddle" id="minus<?php echo $i; ?>" style="display:none;" /></span> Details</span>
    </div>
        <div class="book_btn fleft"><a href="<?php echo site_url(); ?>/flights/flight_details/<?php echo $flight_result[$i]->id; ?>/<?php echo $flight_result[$i]->rand_id; ?>">BOOK</a></div>
        <div id="flightdetails<?php echo $i; ?>" class="flightdet" style="color:#000; display:none;"><div >
                <div align="center" class="top10"> 
                    <img src="<?php echo base_url(); ?>assets/images/details_devider.png" />
                </div>
                <div class="fleft wid500">
                    <div style="font-size:14px;"><strong><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?> </strong>&nbsp;&nbsp;<?php $date=date("jS, F Y", strtotime($_SESSION['sd'])); echo $date; ?></div>
                <?php 
                    for($st=0;$st<$count;$st++)
                    {
                        $depdate=explode(' ',$ddate1[$st]);
                        $arvdate=explode(' ',$adate1[$st]);
                        $depDate1=explode('-',$depdate[0]);
                        $arvDate1=explode('-',$arvdate[0]);
                ?>

                    <div class="fleft wid125 top20">
                        <div class="wid40 fleft"  style="width:70px;">
                            <img src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$st]; ?>.gif" />
                        </div><div class="wid80 fleft" style="line-height:16px;width: 65px;"><?php echo $name[$st]; ?><br /> 
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
                    <div class="wid140 fleft top20" style="text-align:right; line-height:18px;"> <span class="fair_add_txt"><?php echo $dlocation[$st]; ?> <strong><?php echo $depdate[1]; ?></strong></span><br />
                        <?php $dateDep=date("jS, F Y", strtotime($depDate1[2].'-'.$depDate1[1].'-'.$depDate1[0])); echo $dateDep; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="wid40 fleft top20" style="line-height:16px;  width:50px; text-align:center; margin-left:20px;"><img src="<?php echo base_url(); ?>assets/images/clock_icon.png" /><br />
                     <?php echo $duration_final1[$st]; ?></div>
                    <div class="wid140 fleft top20 left20" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $alocation[$st]; ?> <strong><?php echo $arvdate[1]; ?></strong></span><br />
                        <?php $dateArr=date("jS, F Y", strtotime($arvDate1[2].'-'.$arvDate1[1].'-'.$arvDate1[0])); echo $dateArr; ?><br />
    <!--                    Bengaluru International<br />Airport, Bangalore-->
                    </div>
                    <div class="clear"></div>
    	<div class="clear"></div>
                     <?php if($duration_final_layover[$st] != '') { ?> <div style="font-size:11px; background-color:#e5eaf0; color:#333; margin:10px 0px;text-align:center;"> Change of Planes   Connection time <?php echo $duration_final_layover[$st]; ?></div> <?php } ?>
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
                        <div class="fleft wid100 fair_txt_small top10 left20"  >&#36;<?php echo($flight_result[$i]->Total_FareAmount-$flight_result[$i]->TaxAmount); ?><br />
                            &#36;<?php echo $flight_result[$i]->TaxAmount; ?><br />
                            &#36;<?php echo $flight_result[$i]->Total_FareAmount; ?>
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
					$(".flightdet").not("#flightdetails'.$i.'").hide();
                    $("#flightdetails'.$i.'").show();
					$("#details_hide'.$i.'").show();
					$("#details'.$i.'").hide();
					$(".plusic").show();
					$("#minus'.$i.'").show();
                  });
				  
				  $("#details_hide'.$i.'").click(function(){
                    $("#flightdetails'.$i.'").hide();
					$("#details_hide'.$i.'").hide();
					$("#details'.$i.'").show();
					$("#plusicon'.$i.'").show();
					$("#minus'.$i.'").hide();
                  });
                </script>';
            }
			//$("#plusicon'.$i.'").hide(); $("#minus'.$i.'").show();
					
       }
	}
        
        
?>
<input type="hidden" id="setMinPrice" value="<?php if(!empty($totalPriceAry)) echo min($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setMaxPrice" value="<?php if(!empty($totalPriceAry)) echo max($totalPriceAry); else echo 0; ?>" />
<input type="hidden" id="setCurrency" value="<?php echo '&#36;';?>" />
<input type="hidden" id="setMinTime" value="0" />
<input type="hidden" id="setMaxTime" value="1140" />
<?php
    }
    else
    {
       echo "empty";
    }

?>
