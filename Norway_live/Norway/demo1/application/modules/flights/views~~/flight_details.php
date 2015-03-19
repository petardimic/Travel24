<?php //echo '<pre />';print_r($flightDetails);die; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DSS Travels</title>
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
<script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>

<script  src="<?php echo base_url(); ?>assets/menu_assets/menu_jquery.js"></script>


<script type="text/javascript"  src="<?php echo base_url(); ?>assets/js/stepcarousel.js"></script>
</head>
<style type="text/css">

.stepcarousel{
	position: relative;
	overflow: scroll; /*leave this value alone*/
	width: 535px; /*Width of Carousel Viewer itself*/
	height: 170px; /*Height should enough to fit largest content's height*/
	-moz-border-radius: 0px 10px 10px 0px;
    -webkit-border-radius: 0px 10px 10px 0px;
    -khtml-border-radius: 0px 10px 10px 0px;
    border-radius: 0px 10px 10px 0px;

	background-color: #none;/*
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFFFFF), to(#F1F1F1));
    background: -webkit-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -moz-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -ms-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -o-linear-gradient(top, #F1F1F1, #FFFFFF);*/
	margin:0 8px 8px 8px;
	margin-left:160px;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
}

.stepcarousel .belt{
position: absolute; /*leave this value alone*/
left: 0;
top: 0;
}

.stepcarousel .panel{
	float: left; /*leave this value alone*/
	overflow: hidden; /*margin around each panel*/
	width: 100px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */
	padding-right: 0px;
	padding-left: 0px;
	margin-top: 0px;
	margin-right: 5px;
	margin-bottom: 0px;
	margin-left: 0px;/*
	border-right:1px solid #CCCCCC;*/
	background:none;
	border:1px solid #9dc8e7;
}

.search_result_border_bottom_part { border-bottom: dashed 1px #ccc; }


</style>
<body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('home/header'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################--->
        <div class="inner_wrapper">
            <!-- LEFT PART -->

            <div class="left_part"> 

                <!--############################ SUMMERY AREA #########################-->
                <div class="left_header1_bg top20"><span class="left20">Summery</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">

                    <div> <div class="left10" style="font-size:11px; font-weight:normal;">1 
                        <?php if($_SESSION['journey_type']=='OneWay') echo 'One Way'; ?> Ticket(s) 
                            <br />
                            <span class="flight_booking_smalltxt">
                                (<?php echo $_SESSION['adults']; ?> x Adult)&nbsp;&nbsp;&nbsp;(<?php echo $_SESSION['childs']; ?> x Child)&nbsp;&nbsp;&nbsp;(<?php echo $_SESSION['infants']; ?> x Infant) 
                            </span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?>
                       
                        <div class="flight_booking_header left10 top20">Fare Summary ( In USD) </div>	
                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div>

                        <div class="flight_booking_smalltxt top10"><span class="wid100 left10">Base Fare</span>
                            <span class="left80">USD <?php echo($flightDetails['Total_FareAmount']-$flightDetails['TaxAmount']); ?></span>
                        </div>
                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div>

                        <div class="flight_booking_smalltxt top10"><div class=" left10 fleft">Fee & <br /> Surcharge</div>
                            <span class="left80">USD <?php echo $flightDetails['TaxAmount']; ?></span>
                        </div>
                        <div class="top20" style="border-bottom:1px solid #ccc;"> </div>

                        <div class="top10"><span class="wid100 left10">Grand Total</span>
                            <span class="left60">USD <?php echo $flightDetails['Total_FareAmount']; ?></span>
                        </div>
                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div></div>


                    </div></div>




                <!--############################ SUMMERY AREA  END#########################-->

                <!--############################ HOTEL DETAILS AREA #########################-->
                <div class="left_header1_bg top20"><span class="left20">Hotel Details Hyderabad</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">
                    <div class="wid80 fleft">
                        <img  src="<?php echo base_url(); ?>assets/images/hotel-details.png" />

                    </div>
                    <div class="wid140 fleft"> <div class="left10" style="font-size:11px; font-weight:normal;">Journeys Kings Cross
                            54-58 Caledonian Rd</div>

                        <div class="top10 left10"><img  src="<?php echo base_url(); ?>assets/images/dummy/star.png" /></div> 
                        <div class="left10 top10 blue_txt2">USD 57.23</div>
                    </div>

                    <div style="clear:both;" ></div>
                    <div class="top10" style="border-bottom:1px solid #ccc;"> </div>

                    <div class="wid80 fleft top10">
                        <img  src="<?php echo base_url(); ?>assets/images/hotel-details.png" />

                    </div>
                    <div class="wid140 fleft top10"> <div class="left10" style="font-size:11px; font-weight:normal;">Journeys Kings Cross
                            54-58 Caledonian Rd</div>

                        <div class="top10 left10"><img  src="<?php echo base_url(); ?>assets/images/dummy/star.png" /></div> 
                        <div class="left10 top10 blue_txt2">USD 57.23</div>
                    </div>

                </div>

                <div >&nbsp;&nbsp;</div> <!--############################ HOTEL DETAILS AREA  END#########################-->




            </div>

            <!-- LEFT PART END -->

            <!-- RIGHT PART -->

            <div class="right_part top30">
                <div class="right_main_header">Review Flight</div>


                <div class="right_main_bar top20">
                    <div class="fleft left20"><img  src="<?php echo base_url(); ?>assets/images/booking/white_flight_icon.png"  align="absmiddle" />
                        &nbsp;<?php echo $_SESSION['fromCity']; ?> to <?php echo $_SESSION['toCity']; ?>
                    </div>
                    <div class="fright" style="margin-right:20px;">Duration: <?php echo $flightDetails['duration_final_eft']; ?></div> </div>
                <div class="clear"></div>

                <div class="clear"></div>

                <div class="detail_area top10">


                    <div  style="color:#000; "><div >
                            <?php 
                                if($flightDetails['stops'] == 0)
                                {
                            ?>
                            <div>
                                <div class="fleft wid125 top20" style="width:150px;">
                                    <div class="wid40 fleft" ><img  src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flightDetails['cicode']; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px; width:100px "><?php echo $flightDetails['name']; ?><br /> 
                                        <span class="flight_booking_smalltxt"><?php echo $flightDetails['cicode'].' - '.$flightDetails['fnumber']; ?><br /> 
                                           
                                            <?php 
												$cabin_value=$flightDetails['cabin'];
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
                                <?php
                                    $depDateTime=explode(' ',$flightDetails['ddate1']);
                                    $arvDateTime=explode(' ',$flightDetails['adate1']);
                                    $fromAirport=explode('-',$_SESSION['fromcityval']);
                                    $toAirport=explode('-',$_SESSION['tocityval']);
                                ?>
                                <div class="wid125 fleft top20" style="text-align:right; line-height:18px; width:145px;"> <span class="fair_add_txt"><?php echo $flightDetails['dlocation']; ?> <strong><?php echo $depDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:right;"><?php echo $depDateTime[0]; ?><br />
                                        <?php echo $fromAirport[1]; ?></div></div>

                                <div class="wid40 fleft top20 left80" style="line-height:18px; margin-left:40px;"><img  src="<?php echo base_url(); ?>assets/images/flight_icon3.png" /> </div>
                                <div class="wid125 fleft top20 left40" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flightDetails['alocation']; ?><strong><?php echo $arvDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:left;"><?php echo $arvDateTime[0]; ?><br />
                                        <?php echo $toAirport[1]; ?></div> </div>

                                <div class="wid80 fleft left80 top20" style="line-height:18px; margin-left:35px;">Duration <br />
                                    <span class="flight_booking_smalltxt"><?php echo $flightDetails['duration_final_eft']; ?></span></div>
								
                            </div>
                            <div style="clear:both;"></div>
                            <div class="top10">
									 <span class="flight_booking_blue_txt">Please take time to read the following: <a href="#"  style="color:#f30000;  font-size:11px;">Cancellation Policy </a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000; font-size:11px;"> Modification Policy</a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000;  font-size:11px;">Baggage Allowance</a></span>
								</div>
                                <div class="clear"> </div>
                                <?php
                                    }
                                    else
                                    {
                                        $count=count($flightDetails['cicode']);
                                        for($i=0;$i<$count;$i++)
                                        {
                                            $depDateTime=explode(' ',$flightDetails['ddate1'][$i]);
                                            $arvDateTime=explode(' ',$flightDetails['adate1'][$i]);
                                            $fromAirport=explode('-',$_SESSION['fromcityval']);
                                            $toAirport=explode('-',$_SESSION['tocityval']);
                                ?>
                                <div>
                                <div class="fleft wid125 top20">
                                    <div class="wid40 fleft" style="width:80px;"><img  src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flightDetails['cicode'][$i]; ?>.gif" /></div><div class="wid80 fleft" style="line-height:18px;"><?php echo $flightDetails['name'][$i]; ?><br /> 
                                        <span class="flight_booking_smalltxt"><?php echo $flightDetails['cicode'][$i].' - '.$flightDetails['fnumber'][$i]; ?><br /> 
                                            
                                             <?php 
												$cabin_value=$flightDetails['cabin'][$i];
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

                                <div class="wid125 fleft top20" style="text-align:right; line-height:18px; width:120px;"> <span class="fair_add_txt"><?php echo $flightDetails['dlocation'][$i]; ?> <strong><?php echo $depDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:right;"><?php echo $depDateTime[0]; ?><br />
                                        <?php echo $flightDetails['dlocation'][$i]; ?></div></div>

                                <div class="wid40 fleft top20 left80" style="line-height:18px; margin-left:50px; margin-top:30px;"><img  src="<?php echo base_url(); ?>assets/images/flight_icon3.png" /> </div>
                                <div class="wid125 fleft top20 left40" style="text-align:left; line-height:18px;"> <span class="fair_add_txt"><?php echo $flightDetails['alocation'][$i]; ?> <strong><?php echo $arvDateTime[1]; ?></strong></span><br />
                                    <div class="flight_booking_smalltxt" style="text-align:left;"><?php echo $arvDateTime[0]; ?><br />
                                        <?php echo $flightDetails['alocation'][$i]; ?></div> </div>

                                <div class="wid80 fleft left80 top20" style="line-height:18px; margin-left:30px;">Duration <br />
                                    <span class="flight_booking_smalltxt"><?php echo $flightDetails['duration_final1'][$i]; ?></span></div>

                            </div>
                            <div style="clear:both;"></div>
                            <div class="top10">
								 <span class="flight_booking_blue_txt">Please take time to read the following: <a href="#"  style="color:#f30000;  font-size:11px;">Cancellation Policy </a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000; font-size:11px;"> Modification Policy</a>&nbsp;|&nbsp;<a href="#"  style="color:#f30000;  font-size:11px;">Baggage Allowance</a></span>
							</div>    
                            <div class="clear"> </div>
                            <?php if($i< ($count-1)){ ?>
                            <div class="flight_booking_bar ">Change of Planes  Connection time <?php echo $flightDetails['duration_final_layover'][$i]; ?></div>
                            <?php } ?>
                            
                                    <?php
                                            }
                                            
                                        } 
                                    ?>
                        </div>
                        
                        </div>

                </div>
                <div class="clear"></div>

                <div class="flight_booking_bluebg top10">
                
                   <div class="top10" style="margin-top:0px;">
                        <input name="" type="checkbox" value="" /> <span class="flight_booking_blue_txt">I have read, accept and agree to abide by AkbarTravels.us's <a href="<?php echo base_url(); ?>assets/" style="color:#f30000;  font-size:11px;">  Terms & conditions and privacy policy </a></span>
                    </div>
                      <div class="top10">
                        <input name="" type="checkbox" value="" /> <span class="flight_booking_blue_txt">Include   icici insurance Travel Insurance <a href="<?php echo base_url(); ?>assets/"  style="color:#f30000;  font-size:11px;"> (View Insurance Benefits)</a></span>
                    </div>

                    <div class="top10">
                        <input name="" type="checkbox" value="" /> <span class="flight_booking_blue_txt">I accept insurance <a href="<?php echo base_url(); ?>assets/"  style="color:#f30000;  font-size:11px;">Terms and Conditions</a></span>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Proceed to Payment</div>
                </div>
                <div class="detail_area top10">
                    <form name="guest_form" method="POST" action="<?php echo site_url(); ?>/flights/pro_pre_booking/<?php echo $flightDetails['id'] ?>/<?php echo $flightDetails['rand_id'] ?>">
                        <div class="top30 fleft left20">
                            <div class="flight_booking_header1"> Continue without registering</div>
                            <div class="top30"> In a hurry? Proceed to pay without registering on<br />
                                Akbartravelsonline<br /><br />
                                Enter your e-mail to continue.</div>
                            <input type="text" name="guest_email" value="" class="flight_booking_inputbox top20" required />
                            <br><?php echo form_error('guest_email'); ?>
                            <input type="hidden" name="guest_booking" value="guest_booking" />
                            <div class="clear"></div>
                            <button class="flight_booking_redbtn top20" onclick="document.guest_form.submit();"> Continue as Guest </button>
                            
                        </div>
                    </form>
                    <div class="wid40 top30 fleft left30"><img  src="<?php echo base_url(); ?>assets/images/booking/or_devider.png" /> </div>
                    <form name="user_form" method="POST" action="<?php echo site_url(); ?>/flights/pro_pre_booking/<?php echo $flightDetails['id'] ?>/<?php echo $flightDetails['rand_id'] ?>">
                        <div class="top30 fleft left20">
                            <div class="flight_booking_header1"> Already Registered</div>
                            <div class="top30"> Welcome back! Please log-in to your Akbartravelsonline <br />
                                account by entering your e-mail and password to continue.</div>
                            <br />
                            <label class="top20">Username</label><br />
                            <input type="text" name="user_name" value="" class="flight_booking_inputbox" required />
                            <br /><?php echo form_error('user_name'); ?>
                            
                            <br />
                            <label class="top20">Password</label><br />
                            <input type="text" name="user_password" value="" class="flight_booking_inputbox" required />
                            <br><?php echo form_error('user_password'); ?>
                            <input type="hidden" name="user_booking" value="user_booking" />
                            <div class="clear"></div>
                            <button class="flight_booking_redbtn top20 fleft" onclick="document.user_form.submit();"> Login </button>
                            <div class="top30 fright" style="margin-right:150px;"><a href="<?php echo base_url(); ?>assets/" class="forgotpassword">Forgot Passord</a></div>
                        </div>
                    </form>
                </div>

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


<script type="text/javascript">

stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:true, moveby:1, pause:3000},
	panelbehavior: {speed:500, wraparound:false, persist:true},
	defaultbuttons: {enable: true, moveby: 1, leftnav: ['images/left-icon.png', -150, 70], rightnav: ['images/right-icon.png', -17, 70]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['external', 'path_to_external_file']
})

              </script>
<script>
/*var flip = 0;
$( "#details" ).click(function() {
$( "#flightdetails" ).toggle( flip++ % 2 === 0 );
});*/
</script>
