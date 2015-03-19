<?php 
//echo '<pre />';print_r($flightDetails);die; 
$flight_details_return = $this->Flights_Model->get_return_flights($flightDetails->session_id,$flightDetails->akbar_session,$flightDetails->ref_id);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DSS DEMO</title>
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<style type="text/css">

a { 
	text-decoration:none; 
	color:#f30000;
}

.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }



.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }

#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

.login-popup{
	display:none;
	background: #fff;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:314px;
}

.button:hover { background:#ddd; }

</style>

<script type="text/javascript" src="<?php print base_url()?>assets/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/jquery.validationEngine.js"></script>
	<script type="text/javascript" src="<?php echo base_url()?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
	<link rel="stylesheet" href="<?php echo base_url()?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
 
<script type="text/javascript">
$(document).ready(function() {
	$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
        
        $('a.login-window1').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');
		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
</script>


<body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('home/header1'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################--->
        <div class="inner_wrapper">
            <!-- LEFT PART -->

            <div class="left_part"> 

                <!--############################ SUMMERY AREA #########################-->
                <div class="left_header1_bg top20"><span class="left20" style="letter-spacing:-1px;">Summary</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg " style="padding-bottom:30px;">

                    <div style="float:left; width:207px;"> <div class="left10" style="font-size:11px; margin-left:5px; margin-top:5px; font-weight:normal;">1 
                        <?php if($_SESSION['journey_type']=='Round') echo 'Round Trip'; ?> Ticket(s) 
                            <br />
                            <span class="flight_booking_smalltxt" >
                               <?php echo $_SESSION['adults']; ?> Adult<?php if($_SESSION['adults'] > 1) { echo "(s)"; } ?>&nbsp;&nbsp;&nbsp;<?php if($_SESSION['childs'] != 0) { ?><?php echo $_SESSION['childs']; ?> Child&nbsp;&nbsp;&nbsp; <?php } ?> <?php if($_SESSION['infants'] !=0) { ?><?php echo $_SESSION['infants']; ?> Infant(s) <?php } ?>
                            </span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal; margin-left:5px;"><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?>
                       
                        <div class="flight_booking_header left10 top20" style="margin-left:0px; font-size:12px;  font-weight:bold; font-family:Arial, Helvetica, sans-serif;">Fare Summary (In &#36;) </div>	
                        <div class="top10" style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>

                        <div class="flight_booking_smalltxt top10" style="margin-top:5px;"><span   style="margin-top:5px;">Base Fare</span>
                            <span class="left80" style="float:right;">&#36;<?php echo ($flightDetails->Total_FareAmount-$flightDetails->TaxAmount) + ($flight_details_return->Total_FareAmount-$flight_details_return->TaxAmount); ?></span>
                        </div>
                        <div class="top10" style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>

                        <div class="flight_booking_smalltxt top10" style="margin-top:5px;">
                        <span style="margin-top:5px;">Fee &  Surcharge</span>
                            <span class="left80" style="float:right; margin-left:0px;">&#36;<?php echo ($flightDetails->TaxAmount + $flight_details_return->TaxAmount); ?></span>
                        </div>
                        <div class="top20" style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>

                        <div class="top10" style="margin-top:5px; font-weight:bold; font-size:13px;"><span class="wid100 left10" style="margin-left:0px;">Grand Total</span>
                            <span class="left60" style="float:right; margin-left:0px;">&#36;<?php echo ($flightDetails->Total_FareAmount + $flight_details_return->Total_FareAmount); ?></span>
                        </div>
                        <div class="top10" style="border-bottom:1px solid #ccc; margin-top:5px;"> </div></div>


                    </div></div>




                <!--############################ SUMMERY AREA  END#########################-->

                <!--############################ HOTEL DETAILS AREA #########################-->
                <?php /*?><div class="left_header1_bg top20"><span class="left20">Hotel deals in <?php  $tocityval = $this->session->userdata('tocityval'); 
             $city = explode('-',$tocityval);
		echo $city1 = $city[0];?></span></div><?php */?>
                <div style="clear:both;"></div>
                <?php /*?><div class="lblue1_bg ">
                    <?php if(isset($results)) { if($results != '') { foreach($results as $row) { 
						
						 if($row->hotelRating=='1.0' || $row->hotelRating=='1.5')
						$starRating=1;
						if($row->hotelRating=='2.0' || $row->hotelRating=='2.5')
							$starRating=2;
						if($row->hotelRating=='3.0' || $row->hotelRating=='3.5')
							$starRating=3;
						if($row->hotelRating=='4.0' || $row->hotelRating=='4.5')
							$starRating=4;
						if($row->hotelRating=='5.0' || $row->hotelRating=='5.5')
							$starRating=5;
						?>
					
					
                   
					<div class="wid80 fleft">
                        <img src="http://media.expedia.com<?php echo $row->thumbNailUrl; ?>" />
                    </div>
                    <div class="wid140 fleft"> <div class="left10" style="font-size:11px; font-weight:normal;"><?php echo $row->name; ?>, <?php echo $row->address1; ?></div>

                        <div class="left10"><div class="stars<?php echo $starRating; ?>"></div> </div>
                        <div class="left10 blue_txt2">&#36;<?php echo $row->lowRate; ?></div>
                    </div>
                    <div style="clear:both;" ></div>
                    <div class="top10" style="border-bottom:1px solid #ccc; margin-top:5px; margin-bottom:5px;"> </div>
					
					<?php } } } ?>
                </div><?php */?>

                <div >&nbsp;&nbsp;</div> <!--############################ HOTEL DETAILS AREA  END#########################-->




            </div>

            <!-- LEFT PART END -->

            <!-- RIGHT PART -->

            <div class="right_part top30">
               <div style="width: 100%;">
                    <div class="right_main_header" style="float: left;">Review Flight</div>
                    <div style="float: right;"><button class="flight_booking_redbtn" onclick="submitFlight_prev();"> Back to Search </button></div>
                </div>
                <script type="text/javascript">
		function submitFlight_prev()
                {
                        document.flight_search_prev.submit();
                }
               </script>
               
                    <form name="flight_search_prev" id="flight_search_prev" action="<?php echo site_url(); ?>/flights/search" method="post">
                    	<input type="hidden" name="journey_type" value="<?php echo $_SESSION['journey_type']; ?>"  />
                        <input type="hidden" name="from_city" value="<?php echo $_SESSION['fromcityval']; ?>"  />
                        <input type="hidden" name="to_city" value="<?php echo $_SESSION['tocityval']; ?>"  />
                        <input type="hidden" name="sd" value="<?php $_SESSION['sd']; ?>"  />
                       <?php if(isset($_SESSION['ed']) && $_SESSION['ed']!=''){ ?>
                        <input type="hidden" name="ed" value="<?php echo $_SESSION['ed']; ?>"  />
                        <?php } ?>
                        <input type="hidden" name="adult" value="<?php echo $_SESSION['adults']; ?>"  />
                        <input type="hidden" name="child" value="<?php echo $_SESSION['childs']; ?>"  />
                        <input type="hidden" name="infant" value="<?php echo $_SESSION['infants']; ?>"  />
                        <input type="hidden" name="cabin" value="<?php echo $_SESSION['cabin']; ?>"  />
                    </form>
						<?php
                                                    if($flightDetails->stops==0)
                                                    {
							$ddate=explode(' ',$flightDetails->ddate1);
                                                        $adate=explode(' ',$flightDetails->adate1);
                                                        $duration=explode(' ',$flightDetails->duration_final1);
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
                                            $durationMinSec=$flightDetails->duration_final1;
                                        }
                                        else
                                        {
                                            $duration2=explode('M',$duration[0]);
                                            $durationInMin=$duration2[0];
                                            $durationMinSec=$flightDetails->duration_final1;
                                        } 
									}
									else
									{
										$ddate1=explode('<br>',$flightDetails->ddate1);
										$adate1=explode('<br>',$flightDetails->adate1);
										
										$ddate=explode(' ',$ddate1[0]);
                                        $adate=explode(' ',$adate1[$flightDetails->stops]);
                                        $duration=explode(' ',$flightDetails->duration_final_eft);
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
                                            $durationMinSec=$flightDetails->duration_final_eft;
                                        }
                                        else
                                        {
                                            $duration2=explode('M',$duration[0]);
                                            $durationInMin=$duration2[0];
                                            $durationMinSec=$flightDetails->duration_final_eft;
                                        } 
									}
                ?>

                <div class="right_main_bar top20"  style="margin-top:7px;float: left;">
                    <div class="fleft left20"><img  src="<?php echo base_url(); ?>assets/images/booking/white_flight_icon.png"  align="absmiddle" />
                        &nbsp;<?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?>
                    </div>
                    <div class="fright" style="margin-right:20px;">Duration: <?php echo $durationMinSec; //echo $flightDetails['duration_final_eft']; ?></div> </div>
                <div class="clear"></div>

                <div class="clear"></div>

                <div class="detail_area top10" style="padding-bottom:20px;">


                    <div  style="color:#000; "><div >
                            <?php 
                                if($flightDetails->stops == 0)
                                {
                            ?>
                            <div>
                                <div class="fleft wid125 top20" style="width:180px;">
                                    <div class="wid40 fleft" style="width:80px;" ><img  src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flightDetails->cicode; ?>.gif" /></div><div class="wid80 fleft" style="line-height:17px; width:100px; "><?php echo $flightDetails->name; ?><br /> 
                                        <span class="flight_booking_smalltxt" style=" font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif;"><?php echo $flightDetails->cicode.' - '.$flightDetails->fnumber; ?><br /> 
                                         
                                           
                                            <?php 
												$cabin_value=$flightDetails->cabin;
												if ($cabin_value == "F")
													$cabin_code = "First, Supersonic";
												else if ($cabin_value == "C")
													$cabin_code = "Business";
												else if ($cabin_value == "Y")
													$cabin_code = "Economic";
												else if ($cabin_value == "W")
													$cabin_code = "Premium Economy";
												else if ($cabin_value == "MM")
													$cabin_code = "Standard Economy";
												else $cabin_code='';
													
													echo $cabin_code;
											?>
                                            </span></div>

                                </div>
                                <?php
                                    $depDateTime=explode(' ',$flightDetails->ddate1);
                                    $arvDateTime=explode(' ',$flightDetails->adate1);
                                    $fromAirport=explode('-',$_SESSION['fromcityval']);
                                    $toAirport=explode('-',$_SESSION['tocityval']);
									
									
                                ?>
                                <div class="wid125 fleft top20" style="text-align:right; line-height:18px; width:145px;"> <span class="fair_add_txt"><?php echo $flightDetails->dlocation; ?> <strong><?php echo $depDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:right;  font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif; "><?php echo $depDateTime[0]; ?><br />
                                        <?php 
                                        //echo $fromAirport[1]; 
                                        $airportNameDep=$this->Flights_Model->get_airportname($flightDetails->dlocation);
                                            echo $airportNameDep->city;
                                        ?></div></div>

                                <div class="wid40 fleft top20 left80" style="line-height:18px; margin-left:45px;  margin-top:30px;"><img  src="<?php echo base_url(); ?>assets/images/flight_icon3.png" /> </div>
                                <div class="wid125 fleft top20 left40" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flightDetails->alocation; ?><strong><?php echo $arvDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:left; font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif;"><?php echo $arvDateTime[0]; ?><br />
                                        <?php 
                                        //echo $toAirport[1]; 
                                        $airportNameArv=$this->Flights_Model->get_airportname($flightDetails->alocation);
                                        echo $airportNameArv->city;
                                        ?></div> </div>

                                <div class="wid80 fleft left80 top20" style="line-height:18px; margin-left:35px;">Duration <br />
                                    <span class="flight_booking_smalltxt" style="font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif;"><?php echo $durationMinSec; ?><?php //echo $flightDetails['duration_final_eft']; ?></span></div>
								
                            </div>
                            <div style="clear:both;"></div>
                            <div class="top10">
									 <span class="flight_booking_blue_txt" style="font-size:11px;">Please take time to read the following: <a href="#"  style="color:#f30000;  font-size:11px;">Cancellation Policy </a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000; font-size:11px;"> Modification Policy</a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000;  font-size:11px;">Baggage Allowance</a></span>
								</div>
                                <div class="clear"> </div>
                                <?php
                                    }
                                    else
                                    {
										//echo "<pre>"; print_r($flightDetails);
										$segmets=explode('<br>',$flightDetails->cicode);
                                        $count=count($segmets);
                                        //echo '<pre />';print_r($flightDetails);die;
                                        $cicode=explode('<br>',$flightDetails->cicode);
                                        $name=explode('<br>',$flightDetails->name);
                                        $fnumber=explode('<br>',$flightDetails->fnumber);
                                        $dlocation=explode('<br>',$flightDetails->dlocation);
                                        $alocation=explode('<br>',$flightDetails->alocation);
                                        $timeOfDeparture=explode('<br>',$flightDetails->timeOfDeparture);
                                        $timeOfArrival=explode('<br>',$flightDetails->timeOfArrival);
                                        $dateOfDeparture=explode('<br>',$flightDetails->dateOfDeparture);
                                        $dateOfArrival=explode('<br>',$flightDetails->dateOfArrival);
                                        $equipmentType=explode('<br>',$flightDetails->equipmentType);
                                        $ddate=explode('<br>',$flightDetails->ddate);
                                        $adate=explode('<br>',$flightDetails->adate);
                                        $dep_date=explode('<br>',$flightDetails->dep_date);
                                        $arv_date=explode('<br>',$flightDetails->arv_date);
                                        $ddate1=explode('<br>',$flightDetails->ddate1);
                                        $adate1=explode('<br>',$flightDetails->adate1);
                                        $duration_final=explode('<br>',$flightDetails->duration_final);
                                        $duration_final1=explode('<br>',$flightDetails->duration_final1);
                                        $dur_in_min_layover=explode('<br>',$flightDetails->dur_in_min_layover);
                                        $duration_final_layover=explode('<br>',$flightDetails->duration_final_layover);
                                        $fareType=explode('<br>',$flightDetails->fareType);
                                        $BookingClass=explode('<br>',$flightDetails->BookingClass);
                                        $cabin=explode('<br>',$flightDetails->cabin);
                                        for($i=0;$i<$count;$i++)
                                        {
											
											
											
                                            $depDateTime=explode(' ',$ddate1[$i]);
                                            $arvDateTime=explode(' ',$adate1[$i]);
                                            $fromAirport=explode('-',$_SESSION['fromcityval']);
                                            $toAirport=explode('-',$_SESSION['tocityval']);
                                ?>
                                <div>
                                <div class="fleft wid125 top20" style="width:200px;">
                                    <div class="wid40 fleft" style="width:80px;"><img  src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$i]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px; width:110px;"><?php echo $name[$i]; ?><br /> 
                                        <span class="flight_booking_smalltxt"><?php echo $cicode[$i].' - '.$fnumber[$i]; ?><br /> 
                                            
                                             <?php 
                                                    $cabin_value=$cabin[$i];
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
                                            ?>
                                            </span></div>

                                </div>

                                <div class="wid125 fleft top20" style="text-align:right; line-height:18px; width:120px;"> <span class="fair_add_txt"><?php echo $dlocation[$i]; ?> <strong><?php echo $depDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:right;"><?php echo $depDateTime[0]; ?><br />
                                        <?php 
                                        $airportNameDep=$this->Flights_Model->get_airportname($dlocation[$i]);
                                            echo $airportNameDep->city;
                                        //echo $dlocation[$i]; 
                                        ?></div></div>

                                <div class="wid40 fleft top20 left80" style="line-height:18px; margin-left:50px; margin-top:30px;"><img  src="<?php echo base_url(); ?>assets/images/flight_icon3.png" /> </div>
                                <div class="wid125 fleft top20 left40" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $alocation[$i]; ?> <strong><?php echo $arvDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:left;"><?php echo $arvDateTime[0]; ?><br />
                                        <?php 
                                        //echo $alocation[$i]; 
                                        $airportNameArv=$this->Flights_Model->get_airportname($alocation[$i]);
                                        echo $airportNameArv->city;
                                        ?></div> </div>

                                <div class="wid80 fleft left80 top20" style="line-height:18px; margin-left:30px;">Duration <br />
                                    <span class="flight_booking_smalltxt"><?php echo $duration_final1[$i]; ?></span></div>

                            </div>
                            <div style="clear:both;"></div>
                            <div class="top10">
								 <span class="flight_booking_blue_txt">Please take time to read the following: <a href="#"  style="color:#f30000;  font-size:11px;">Cancellation Policy </a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000; font-size:11px;"> Modification Policy</a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000;  font-size:11px;">Baggage Allowance</a></span>
							</div>    
                            <div class="clear"> </div>
                            <?php if($i< ($count-1)){ ?>
                            <div class="flight_booking_bar ">Change of Planes  Connection time <?php echo $duration_final_layover[$i]; ?></div>
                            <?php } ?>
                            
                                    <?php
                                            }
                                            
                                        } 
                                    ?>
                        </div>
                        
                        </div>

                </div>
                <div class="clear"></div>
				<?php
                                //echo '<pre />';print_r($flight_details_return);die;
                                    if($flight_details_return->stops==0)
                                    {
					$ddate=explode(' ',$flight_details_return->ddate1);
                                        $adate=explode(' ',$flight_details_return->adate1);
                                        $duration=explode(' ',$flight_details_return->duration_final1);
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
                                            $durationMinSec=$flight_details_return->duration_final1;
                                        }
                                        else
                                        {
                                            $duration2=explode('M',$duration[0]);
                                            $durationInMin=$duration2[0];
                                            $durationMinSec=$flight_details_return->duration_final1;
                                        } 
                                    }
                                    else
                                    {
                                        $ddate1=explode('<br>',$flight_details_return->ddate1);
                                        $adate1=explode('<br>',$flight_details_return->adate1);

                                        $ddate=explode(' ',$ddate1[0]);
                                        $adate=explode(' ',$adate1[$flight_details_return->stops]);
                                        $duration=explode(' ',$flight_details_return->duration_final_eft);
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
                                            $durationMinSec=$flight_details_return->duration_final_eft;
                                        }
                                        else
                                        {
                                            $duration2=explode('M',$duration[0]);
                                            $durationInMin=$duration2[0];
                                            $durationMinSec=$flight_details_return->duration_final_eft;
                                        } 
									}
                ?>
                <div class="right_main_bar top20" style="margin-top:7px;">
                    <div class="fleft left20"><img  src="<?php echo base_url(); ?>assets/images/booking/white_flight_icon.png"  align="absmiddle" />
                        &nbsp;<?php echo $_SESSION['toCity']; ?> to <?php echo $_SESSION['fromCity']; ?>
                    </div>
                    <div class="fright" style="margin-right:20px;">Duration: <?php echo $durationMinSec; //echo $flightDetails['duration_final_eft']; ?></div> </div>
                <div class="clear"></div>

                <div class="clear"></div>

                <div class="detail_area top10" style="padding-bottom:20px;">


                    <div  style="color:#000; "><div >
                            <?php 
                                if($flight_details_return->stops == 0)
                                {
                            ?>
                            <div>
                                <div class="fleft wid125 top20" style="width:180px;">
                                    <div class="wid40 fleft" style="width:80px;" ><img  src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $flight_details_return->cicode; ?>.gif" /></div><div class="wid80 fleft" style="line-height:17px; width:100px; "><?php echo $flight_details_return->name; ?><br /> 
                                        <span class="flight_booking_smalltxt" style=" font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif;"><?php echo $flight_details_return->cicode.' - '.$flight_details_return->fnumber; ?><br /> 
                                         
                                           
                                            <?php 
												$cabin_value=$flight_details_return->cabin;
												if ($cabin_value == "F")
													$cabin_code = "First, Supersonic";
												else if ($cabin_value == "C")
													$cabin_code = "Business";
												else if ($cabin_value == "Y")
													$cabin_code = "Economic";
												else if ($cabin_value == "W")
													$cabin_code = "Premium Economy";
												else if ($cabin_value == "MM")
													$cabin_code = "Standard Economy";
												else $cabin_code='';
													
													echo $cabin_code;
											?>
                                            </span></div>

                                </div>
                                <?php
                                    $depDateTime=explode(' ',$flight_details_return->ddate1);
                                    $arvDateTime=explode(' ',$flight_details_return->adate1);
                                    $fromAirport=explode('-',$_SESSION['fromcityval']);
                                    $toAirport=explode('-',$_SESSION['tocityval']);
									
									
                                ?>
                                <div class="wid125 fleft top20" style="text-align:right; line-height:18px; width:145px;"> <span class="fair_add_txt"><?php echo $flight_details_return->dlocation; ?> <strong><?php echo $depDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:right;  font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif; "><?php echo $depDateTime[0]; ?><br />
                                        <?php 
                                        //echo $fromAirport[1];
                                            $airportNameDep=$this->Flights_Model->get_airportname($flight_details_return->dlocation);
                                            echo $airportNameDep->city;
                                        ?></div></div>

                                <div class="wid40 fleft top20 left80" style="line-height:18px; margin-left:45px;  margin-top:30px;"><img  src="<?php echo base_url(); ?>assets/images/flight_icon3.png" /> </div>
                                <div class="wid125 fleft top20 left40" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flight_details_return->alocation; ?><strong><?php echo $arvDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:left; font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif;"><?php echo $arvDateTime[0]; ?><br />
                                        <?php 
                                        //echo $toAirport[1];
                                        $airportNameArv=$this->Flights_Model->get_airportname($flight_details_return->alocation);
                                            echo $airportNameArv->city;
                                        ?></div> </div>

                                <div class="wid80 fleft left80 top20" style="line-height:18px; margin-left:35px;">Duration <br />
                                    <span class="flight_booking_smalltxt" style="font-size:11px; line-height:16px; font-family:Arial, Helvetica, sans-serif;"><?php echo $durationMinSec; ?><?php //echo $flight_details_return['duration_final_eft']; ?></span></div>
								
                            </div>
                            <div style="clear:both;"></div>
                            <div class="top10">
									 <span class="flight_booking_blue_txt" style="font-size:11px;">Please take time to read the following: <a href="#"  style="color:#f30000;  font-size:11px;">Cancellation Policy </a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000; font-size:11px;"> Modification Policy</a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000;  font-size:11px;">Baggage Allowance</a></span>
								</div>
                                <div class="clear"> </div>
                                <?php
                                    }
                                    else
                                    {
										//echo "<pre>"; print_r($flight_details_return);
										$segmets=explode('<br>',$flight_details_return->cicode);
                                        $count=count($segmets);
                                        //echo '<pre />';print_r($flight_details_return);die;
                                        $cicode=explode('<br>',$flight_details_return->cicode);
										$name=explode('<br>',$flight_details_return->name);
										$fnumber=explode('<br>',$flight_details_return->fnumber);
										$dlocation=explode('<br>',$flight_details_return->dlocation);
										$alocation=explode('<br>',$flight_details_return->alocation);
										$timeOfDeparture=explode('<br>',$flight_details_return->timeOfDeparture);
										$timeOfArrival=explode('<br>',$flight_details_return->timeOfArrival);
										$dateOfDeparture=explode('<br>',$flight_details_return->dateOfDeparture);
										$dateOfArrival=explode('<br>',$flight_details_return->dateOfArrival);
										$equipmentType=explode('<br>',$flight_details_return->equipmentType);
										$ddate=explode('<br>',$flight_details_return->ddate);
										$adate=explode('<br>',$flight_details_return->adate);
										$dep_date=explode('<br>',$flight_details_return->dep_date);
										$arv_date=explode('<br>',$flight_details_return->arv_date);
										$ddate1=explode('<br>',$flight_details_return->ddate1);
										$adate1=explode('<br>',$flight_details_return->adate1);
										$duration_final=explode('<br>',$flight_details_return->duration_final);
										$duration_final1=explode('<br>',$flight_details_return->duration_final1);
										$dur_in_min_layover=explode('<br>',$flight_details_return->dur_in_min_layover);
										$duration_final_layover=explode('<br>',$flight_details_return->duration_final_layover);
										$fareType=explode('<br>',$flight_details_return->fareType);
										$BookingClass=explode('<br>',$flight_details_return->BookingClass);
										$cabin=explode('<br>',$flight_details_return->cabin);
                                        for($i=0;$i<$count;$i++)
                                        {
											
											
											
                                            $depDateTime=explode(' ',$ddate1[$i]);
                                            $arvDateTime=explode(' ',$adate1[$i]);
                                            $fromAirport=explode('-',$_SESSION['fromcityval']);
                                            $toAirport=explode('-',$_SESSION['tocityval']);
                                ?>
                                <div>
                                <div class="fleft wid125 top20">
                                    <div class="wid40 fleft" style="width:80px;"><img  src="<?php echo base_url(); ?>assets/airline_logo/<?php echo $cicode[$i]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $name[$i]; ?><br /> 
                                        <span class="flight_booking_smalltxt"><?php echo $cicode[$i].' - '.$fnumber[$i]; ?><br /> 
                                            
                                             <?php 
												$cabin_value=$cabin[$i];
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
											?>
                                            </span></div>

                                </div>

                                <div class="wid125 fleft top20" style="text-align:right; line-height:18px; width:120px;"> <span class="fair_add_txt"><?php echo $dlocation[$i]; ?> <strong><?php echo $depDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:right;"><?php echo $depDateTime[0]; ?><br />
                                        <?php 
                                            //echo $dlocation[$i]; 
                                            $airportNameDep=$this->Flights_Model->get_airportname($dlocation[$i]);
                                            echo $airportNameDep->city;
                                        ?></div></div>

                                <div class="wid40 fleft top20 left80" style="line-height:18px; margin-left:50px; margin-top:30px;"><img  src="<?php echo base_url(); ?>assets/images/flight_icon3.png" /> </div>
                                <div class="wid125 fleft top20 left40" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $alocation[$i]; ?> <strong><?php echo $arvDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:left;"><?php echo $arvDateTime[0]; ?><br />
                                        <?php 
                                            //echo $alocation[$i]; 
                                            $airportNameArv=$this->Flights_Model->get_airportname($alocation[$i]);
                                            echo $airportNameArv->city;
                                        ?></div> </div>

                                <div class="wid80 fleft left80 top20" style="line-height:18px; margin-left:30px;">Duration <br />
                                    <span class="flight_booking_smalltxt"><?php echo $duration_final1[$i]; ?></span></div>

                            </div>
                            <div style="clear:both;"></div>
                            <div class="top10">
								 <span class="flight_booking_blue_txt">Please take time to read the following: <?php /*?><a href="#"  style="color:#f30000;  font-size:11px;">Cancellation Policy </a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000; font-size:11px;"> Modification Policy</a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000;  font-size:11px;">Baggage Allowance</a><?php */?></span>
							</div>    
                            <div class="clear"> </div>
                            <?php if($i< ($count-1)){ ?>
                            <div class="flight_booking_bar ">Change of Planes  Connection time <?php echo $duration_final_layover[$i]; ?></div>
                            <?php } ?>
                            
                                    <?php
                                            }
                                            
                                        } 
                                    ?>
                        </div>
                        
                        </div>

                </div>
                <div class="clear"></div>
                <script type="text/javascript">
				function submit_payment()
                        {
                             if(!document.getElementById('terms_checking_v1').checked)
                           {
                               alert('Please select checkbox to Terms & conditions and privacy policy');
                               document.getElementById('terms_checking_v1').focus();
                               return false;
                           }
                           else
                           { 
                          	 document.proceed.submit();
                           }  
                        }
                    function contine_guest_submit()
                        {
                           if(!document.getElementById('terms_checking_v1').checked)
                           {
                               alert('Please select checkbox to  Terms & conditions and privacy policy');
                               document.getElementById('terms_checking_v1').focus();
                               return false;
                           }
                           else
                           { 
                           
                           } 
                        }
                </script>
                <div class="flight_booking_bluebg top10">
                
                    <div class="top10" style="margin-top:0px;">
                        <form name="terms_checking" method="POST" action="" id="terms_check">
                        <input name="" type="checkbox" id="terms_checking_v1" value=""  /> <span class="flight_booking_blue_txt">I have read, accept and agree to 's </span>
                        <a href="#login-box1" class="login-window" style="font-size:11px;">  Terms & conditions </a>
                       
                        <div id="login-box1" class="login-popup">
         <a href="#" class="close"><img src="<?php echo base_url()?>assets/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        <iframe frameborder="0" height="500" width="650" src="<?php print site_url()?>/flights/terms_conditions"></iframe>
     </div>
                    
                    
                        and <a href="#login-box2" class="login-window1" style="font-size:11px;">privacy policy </a>
                        
                         <div id="login-box2" class="login-popup">
         <a href="#" class="close"><img src="<?php echo base_url()?>assets/images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
        <iframe frameborder="0" height="500" width="650" src="<?php print site_url()?>/flights/privacy_policy"></iframe>
     </div>
                        
                        </form>
                        
                         
                        </span>
                    </div>
                      <!--<div class="top10">
                        <input name="" type="checkbox" value="" /> <span class="flight_booking_blue_txt">Include   icici insurance Travel Insurance <a href="<?php echo base_url(); ?>assets/"  style="color:#f30000;  font-size:11px;"> (View Insurance Benefits)</a></span>
                    </div>

                    <div class="top10">
                        <input name="" type="checkbox" value="" /> <span class="flight_booking_blue_txt">I accept insurance <a href="<?php echo base_url(); ?>assets/"  style="color:#f30000;  font-size:11px;">Terms and Conditions</a></span>
                    </div>-->
                </div>
                <div class="clear"></div>
                <div class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Proceed to Payment</div>
                </div>
                <?php 
					if($_SESSION['user_email'] != '')
					{
						$custdet= $this->Home_Model->check_password($_SESSION['user_email']);
					}
					else if($this->session->userdata('customer_id') != '')
					{
						$custdet= $this->Home_Model->getcustomerdet($this->session->userdata('customer_id'));
					}
				if($this->session->userdata('customer_id') != '' || $_SESSION['user_email']) {
                    ?>
                    <br />
                    <span class="book_btn fleft" style="width:100px;  line-height: 29px;"><a href="#" onclick="return submit_payment();" >Proceed to Payment</a></span>
                        
                    <form method="post" name="proceed" id="proceed" action="<?php echo site_url(); ?>/flights/pre_booking/<?php echo $flightDetails->id; ?>/<?php echo $flightDetails->rand_id; ?>">
                      <input type="hidden" name="user_booking2" value="user_booking2" />  
                      
                      <input type="hidden" name="user_name" value="<?php if(isset($custdet)){ if($custdet != '') { echo $custdet->emailid; } } ?>" />
                      <input type="hidden" name="user_password" value="<?php if(isset($custdet)){ if($custdet != '') { echo $custdet->password; } } ?> ?>" />
                    </form>
                <?php
                    } else { ?>
                <div class="detail_area top10">
                    <form name="guest_form" id="contine_guest" method="POST" action="<?php echo site_url(); ?>/flights/pro_pre_booking/<?php echo $flightDetails->id; ?>/<?php echo $flightDetails->rand_id; ?>/<?php echo $flightDetails->ref_id; ?>" class='form-horizontal form-validate'>
                        <div class="top30 fleft left20">
                            <div class="flight_booking_header1"> Continue without registering</div>
                            <div class="top30" style="margin-top:12px;"> In a hurry? Proceed to pay without registering on<br />
                                Akbartravelsonline<br /><br />
                                Enter your e-mail to continue.</div>
                            <input type="text" name="guest_email" style="margin-top:5px;" value="" class="flight_booking_inputbox top20 validate[required,custom[email]]" />
                            
                            <input type="hidden" name="guest_booking" value="guest_booking" />
                            <div class="clear"></div>
                            <button class="flight_booking_redbtn top20" onclick="javascript:return contine_guest_submit();" style="margin-top:10px;"> Continue as Guest </button>
                           <br><a name="exist_error"><?php if(isset($error_flag) && $error_flag=='err_flag') { echo "<span style='color:red; margin-top:10px; margin-bottom:35px; line-hieght:21px; width: 287px; float: left;'>Your E-mail address is already registered.
To avoid entering your contact details again, use the
already registered option. In case you forgot your
password, Please use forgot password option.</span>"; }  ?> </a> 
                        </div>
                    </form>
                    <div class="wid40 top30 fleft left30"><img  src="<?php echo base_url(); ?>assets/images/booking/or_devider.png" /> </div>
                    <form name="user_form" id="user_form" method="POST" action="<?php echo site_url(); ?>/flights/pro_pre_booking/<?php echo $flightDetails->id; ?>/<?php echo $flightDetails->rand_id; ?>/<?php echo $flightDetails->ref_id; ?>" class='form-horizontal form-validate'>
                        <div class="top30 fleft left20">
                            <div class="flight_booking_header1"> Already Registered</div>
                            <div class="top30" style="margin-top:12px;"> Welcome back! Please log-in to your Akbartravelsonline <br />
                                account by entering your e-mail and password to continue.</div>
                            <br />
                            <label class="top20">Username</label>
                            <span id="loading" style="display:none;"><img src="<?php echo base_url(); ?>assets/images/290.gif" width="20"  /></span>
                            <span style="display:none; margin-left:10px; color:#BF0000" id="usemail_pwd">Please enter email id you have registered with us</span><br />
                            <input type="text" name="user_name" id="user_name" value="" style="margin-top:5px;" class="flight_booking_inputbox validate[required,custom[email]]"  />
                            <?php /*?><br /><?php echo form_error('user_name'); ?><?php */?>
                            
                            <br />
                            <label class="top20">Password</label><br />
                            <input type="password" name="user_password" style="margin-top:5px;" value="" class="flight_booking_inputbox validate[required]" />
                            <?php /*?><br><?php echo form_error('user_password'); ?><?php */?>
                            <input type="hidden" name="user_booking" value="user_booking" />
                            <div class="clear"></div>
                            <button class="flight_booking_redbtn top20 fleft" onclick="javascript:return contine_guest_submit();"> Login </button>
                            <div class="top30 fright" style="margin-right:150px; cursor:pointer;"><span class="forgotpassword" onclick="forgot_password();">Forgot Passord</span></div>
                        </div>
                    </form>
                </div>
				<?php } ?>
				<script type="text/javascript">
				function forgot_password()
				{
					$('#user_name').focus();
					var email = $('#user_name').val();
					if(email == '')
					{
						$('#usemail_pwd').show();
					}
					else
					{
						 $("#loading").show();
						$.ajax
						({
							 type: "POST",
							 url: "<?php echo site_url(); ?>/home/get_password",
							 // $("#loading").show(),
							  data: "source="+email,
							  success: function(msg)
							  {
								 
								if(msg != '') {
									 $('#loading').hide();
									$("#usemail_pwd").show();
									$("#usemail_pwd").html(msg);
									 }
								}
							});
					}
				}
				</script>
            </div>
        </div>
</div>

<!-- RIGHT PART END -->


</div>

        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('home/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
                    						

      
</div>  <!-- Wrapper END -->    
</body>

      
</html>


<script class="secret-source">
		$(document).ready(function(){
			$("#contine_guest").validationEngine();
			$("#user_form").validationEngine();
	});
  
    </script>
