<?php //echo '<pre />';print_r($flightDetails);die; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>

<script src="<?php echo base_url(); ?>assets/menu_assets/menu_jquery.js"></script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/stepcarousel.js"></script>
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
        <form name="pre_booking" method="POST" action="<?php echo site_url(); ?>/flights/booking_final/<?php echo $id; ?>/<?php echo $rand_id; ?>">
        <div class="inner_wrapper">
            <!-- LEFT PART -->

            <div class="left_part"> 

                <!--############################ Flight Details AREA #########################-->
                <div class="left_header1_bg top20"><span class="left20">Flight Details</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">

                    <div> 
                        <div class=" traveller_blue_bg"><span class="left10">Onward</span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><div class="fleft">
                                <?php if($flightDetails['stops']==0){ ?>
                                <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flightDetails['cicode']; ?>.gif" />
                                <?php }else{ ?>
                                <img src="http://cheapfaresindia.makemytrip.com/international/img/international/airline-logos/sm<?php echo $flightDetails['cicode'][0]; ?>.gif" />
                                <?php } ?>
                            </div><span class="left20"><?php echo $_SESSION['toCity']; ?>(<?php $stops=$flightDetails['stops']; echo($flightDetails['stops']==0 ? $flightDetails['alocation']:$flightDetails['alocation'][$stops]); ?>)
                                <br />
                                <span class="flight_booking_smalltxt left20">G8 116  </span></span></div>

                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div>	
                        <div class=" traveller_blue_bg"><div class="left10 flight_booking_blue_txt" style="line-height:18px !important; padding:5px 0 5px 10px; margin:2px 0 2px 0; "><?php echo $_SESSION['fromCity']; ?> (<?php $stops=$flightDetails['stops']; echo($flightDetails['stops']==0 ? $flightDetails['dlocation']:$flightDetails['dlocation'][$stops]); ?>)<br /> to<br /> <?php echo $_SESSION['toCity']; ?> (<?php $stops=$flightDetails['stops']; echo($flightDetails['stops']==0 ? $flightDetails['alocation']:$flightDetails['alocation'][$stops]); ?>) </div></div>
                        <div  style="border-bottom:1px solid #ccc;"> </div>

                        <div class="top10 left10">
                            <?php 
                                if($flightDetails['stops']==0) echo 'Non-Stop';
                                else if($flightDetails['stops']==1) echo 'One-Stop';
                                else 'Multi Stops';
                            ?>
                            <br />
                            <?php 
                                if($flightDetails['stops']==0)
                                {
                                    echo $flightDetails['ddate1'];
                                }
                                else echo $flightDetails['ddate1'][0];
                            ?></div>

                    </div>
                </div>
                <!--############################ Flight details AREA  END#########################-->

                <!--############################ Fare details AREA #########################-->

                <div class="left_header1_bg top20"><span class="left20">Fare Details</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">

                    <div> 
                        <div class=" traveller_blue_bg"><span class="left10">Base Fare</span></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><span class="flight_booking_smalltxt">
                                <?php echo $_SESSION['adults']; ?> x Adult)
                                <?php if($_SESSION['childs']!=0){ ?><br />
                                <?php echo $_SESSION['childs']; ?> x Child
                                <?php } if($_SESSION['infants']!=0){ ?><br />
                                <?php echo $_SESSION['infants']; ?> x Infant
                                <?php } ?>
                           <span class="flight_booking_smalltxt left80">
                               <?php 
                                    if($flightDetails['stops']==0)
                                    {
                                        $flightDetails['cicode'].' - '.$flightDetails['fnumber'];
                                    }
                                    else
                                    {
                                        $a=0;
                                        foreach($flightDetails['cicode'] as $val)
                                        {
                                            $flightDetails['cicode'][$a].' - '.$flightDetails['fnumber'][$a].'<br />';
                                            $a++;
                                        }
                                    }
                               ?>
                           </span></span></div>

                        <div class="top10" style="border-bottom:1px solid #ccc;"> </div>	
                        <div class=" traveller_blue_bg"><div class="left10 flight_booking_blue_txt" style="line-height:18px !important; padding:5px 0 5px 10px; margin:2px 0 2px 0; ">Taxes & other charges </div></div>

                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><span class="flight_booking_smalltxt">1 Adult(s)

                                <span class="flight_booking_smalltxt left80">G8 116  </span></span></div>
                        <div  style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>
                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><span class="flight_booking_smalltxt">Base Fare

                                <span class="flight_booking_smalltxt left80">USD <?php echo($flightDetails['Total_FareAmount']-$flightDetails['TaxAmount']); ?>  </span></span></div>
                        <div  style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>
                        <div class="left10 top10" style="font-size:11px; font-weight:normal;"><span class="flight_booking_smalltxt">Fee & Surcharge 

                                <span class="flight_booking_smalltxt left30">USD <?php echo $flightDetails['TaxAmount']; ?>  </span></span></div>
                        <div  style="border-bottom:1px solid #ccc; margin-top:5px;"> </div>

                        <div class="red_txt left10 top10" style="margin-right:10px;"><span class="fleft">Total</span> <span class="fright">USD <?php echo $flightDetails['Total_FareAmount']; ?></span></div>

                    </div>
                </div>

                <!--############################ Fare details AREA  END #########################-->

                <!--############################ HOTEL DETAILS AREA #########################-->
                <div class="left_header1_bg top20"><span class="left20">Hotel Details Hyderabad</span></div>
                <div style="clear:both;"></div>
                <div class="lblue1_bg ">
                    <div class="wid80 fleft">
                        <img src="<?php echo base_url(); ?>assets/images/hotel-details.png" />

                    </div>
                    <div class="wid140 fleft"> <div class="left10" style="font-size:11px; font-weight:normal;">Journeys Kings Cross
                            54-58 Caledonian Rd</div>

                        <div class="top10 left10"><img src="<?php echo base_url(); ?>assets/images/dummy/star.png" /></div> 
                        <div class="left10 top10 blue_txt2">USD 57.23</div>
                    </div>

                    <div style="clear:both;" ></div>
                    <div class="top10" style="border-bottom:1px solid #ccc;"> </div>

                    <div class="wid80 fleft top10">
                        <img src="<?php echo base_url(); ?>assets/images/hotel-details.png" />

                    </div>
                    <div class="wid140 fleft top10"> <div class="left10" style="font-size:11px; font-weight:normal;">Journeys Kings Cross
                            54-58 Caledonian Rd</div>

                        <div class="top10 left10"><img src="<?php echo base_url(); ?>assets/images/dummy/star.png" /></div> 
                        <div class="left10 top10 blue_txt2">USD 57.23</div>
                    </div>

                </div>

                <div >&nbsp;&nbsp;</div> <!--############################ HOTEL DETAILS AREA  END#########################-->

            </div>

            <!-- LEFT PART END -->

            <!-- RIGHT PART -->

            <div class="right_part top30" style="width:766px;">
                <div class="right_main_header">Traveller Details</div>

                <div class="right_main_bar top20" style="margin-top:13px;"  >
                    <div class="fleft left20">Pax Details</div>
                    <div class="fright" style="margin-right:20px;">Adults 12+ yrs (1) </div> </div>
                <div class="clear"></div>


                <div class="detail_area top10">
                    <div class="traveller_blue_bg" style="color:#0F4F8B; padding-left:10px;"> Please Note : Please make sure that the name entered is exactly as per traveller's passport.  Traveler age is calculated as per the travel date. </div> 
                    <?php 
                        for($i=0;$i<$_SESSION['adults'];$i++)
                        {
                    ?>
                    <div class="top10">
                        <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                            <select name="saladult[]" class="travller_inputbox77 fleft" >
                                <option value="">Select</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                            </select>
                        </div>

                        <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                            <input name="fnameadult[]" class="travller_inputbox178 fleft" type="text" required /></div>

                        <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                            <input name="lnameadult[]" class="travller_inputbox178 fleft" type="text" required /></div>
                    </div>   
                    <?php 
                        }
                    ?>
                    <br /><br />
                    <?php
                        if($_SESSION['childs']>0)
                        {
                            for($c=0;$c<$_SESSION['childs'];$c++)
                            {
                    ?>
                        
                        <div class="top10">
                            <div class="wid100 fleft"><label class="left10">Title:</label>
                                <select name="salchild[]" class="travller_inputbox77 fleft" >
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>

                            <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                                <input name="fnamechild[]" class="travller_inputbox178 fleft" type="text" required /></div>

                            <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                                <input name="lnamechild[]" class="travller_inputbox178 fleft" type="text" required /></div>
                                
                            <div class="wid190 fleft"><label class="left10">Date Of Birth:</label><br />
                                <input name="adobchild[]" class="travller_inputbox178 fleft" type="text" required /></div>    
                        </div>  
                    <?php 
                            }
                        }
                    ?>
                    <br /><br />
                    <?php
                        if($_SESSION['infants']>0)
                        {
                            for($c=0;$c<$_SESSION['infants'];$c++)
                            {
                    ?>
                        <div class="top10">
                            <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                                <select name="salinfant[]" class="travller_inputbox77 fleft" >
                                    <option value="">Select</option>
                                    <option value="Mr">Mr</option>
                                    <option value="Mrs">Mrs</option>
                                </select>
                            </div>

                            <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                                <input name="fnameinfant[]" class="travller_inputbox178 fleft" type="text" required /></div>

                            <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                                <input name="lnameinfant[]" class="travller_inputbox178 fleft" type="text" required /></div>
                                
                            <div class="wid190 fleft"><label class="left10">Date Of Birth:</label><br />
                                <input name="adobinfant[]" class="travller_inputbox178 fleft" type="text" required /></div>
                        </div>  
                    <?php 
                            }
                        }
                    ?>
                    <input type="hidden" name="result_id" value="<?php echo $id; ?>">
                    <input type="hidden" name="rand_id" value="<?php echo $rand_id; ?>">
                </div>
                <div class="clear"></div>

                <div class="right_main_bar top20" style="margin-top:13px;">
                    <div class="fleft left20">Contact Details</div>
                </div>
                <div class="clear"></div>

                <div class="detail_area top10">

                    <div class="top10">
                        <div class="wid100 fleft" style="width:85px;"><label class="left10">Title:</label>
                            <select name="user_title" class="travller_inputbox77 fleft" style="font-size:12px; " required >
                                <option value="">Select</option>
                                <option value="Mr">Mr</option>
                                <option value="Mrs">Mrs</option>
                            </select>
                        </div>

                        <div class="wid190 fleft"><label class="left10">First Name:</label><br />
                            <input name="user_fname" class="travller_inputbox178 fleft" type="text" required /></div>

                        <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                            <input name="user_lname" class="travller_inputbox178 fleft" type="text" required /></div>

                        <div class="clear"></div>
                        <div class="top10">
                            <label class="left10">Address</label><br />
                            <textarea name="user_address" rows="4" style="border:1px solid #aacde6; border-radius:5px; width:475px;" required ></textarea></div>
                        <div class="top10">
                            <div class="wid190 fleft"><label class="left10">City:</label><br />
                                <input name="user_city" class="travller_inputbox178 fleft" type="text" required />
                            </div>
                            <div class="wid190 fleft"><label class="left10">Pin Code:</label><br />
                                <input name="user_pincode" class="travller_inputbox178 fleft" type="text" required /></div>
                            <div class="wid190 fleft"><label class="left10">State:</label><br />
                                <input name="user_state" class="travller_inputbox178 fleft" type="text" required /></div>
                        </div> 
                        <div class="clear"></div>
                        <div class="top10"><div class="wid190 fleft"><label class="left10">Country:</label><br />
                                <input name="user_country" class="travller_inputbox178 fleft" type="text" required /></div>
                            <div class="wid190 fleft"><label class="left10">E-mail:</label><br />
                                <input name="user_email" class="travller_inputbox178 fleft" type="text" value="<?php echo(isset($_SESSION['guest_email']) ? $_SESSION['guest_email'] : $_SESSION['user_email']) ?>" required /></div>
                            <div class="wid190 fleft"><label class="left10">Mobile:</label><br />
                                <input name="user_mobile" class="travller_inputbox178 fleft" type="text" /></div>
                        </div>

                        <div class="clear"></div>
                        <div class="traveller_blue_bg top10"><input name="user_update" type="checkbox" value=""  class="fleft" style="margin-top:8px;"/><div style="color:#0F4F8B; padding-left:10px;">Update my profile with this contact details. for flight </div></div>
                    </div>                      
                </div>
                <div class="clear"></div>

                <div class="flight_booking_bluebg top10">
                    <div  style="color:#0F4F8B; padding-left:10px;">Redeem your coupon / promo code here :
                        <input name="" type="text" class="travller_inputbox284" />

                        <button class="flight_booking_redbtn left30" style="margin-left:10px;">REDEEM</button>
                    </div>
                </div>
                <div class="clear"></div>
                <div class="right_main_bar top10">
                    <div class="fleft left20"> &nbsp;Proceed to Payment</div>
                </div>
                <div class="detail_area top10">

                    <div class="top10 left10" style="margin-left:10px;">
                        <div class="flight_booking_header1"> Credit Cart Details </div>
                         

                        <div class="top20 left50" style="margin-left:0px;">
                            <div class="fleft top20 wid170" style="text-align:right;">Name of the Credit card:</div> <div class="wid190 fleft left10"><label class="left10">First Name:</label><br />
                                <input name="" class="travller_inputbox178 fleft" type="text" /></div> <div class="wid190 fleft"><label class="left10">Last Name:</label><br />
                                <input name="" class="travller_inputbox178 fleft" type="text" /></div>

                            <div class="clear"></div> 

                            <div class="fleft top20 wid170" style="text-align:right;">Billing address (line 1): </div> <div class="wid190 fleft left10">
                                <input name="" class="travller_inputbox284 fleft top10" type="text" /></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;">Billing address (line 2):  </div> <div class="wid190 fleft left10">
                                <input name="" class="travller_inputbox284 fleft top10" type="text" /></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;">City:  </div> <div class="wid190 fleft left10">
                                <input name="" class="travller_inputbox284 fleft top10" type="text" /></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;">Country:  </div> <div class="wid190 fleft left10">
                                <select name="" style="border:1px solid #aacde6; height:30px; margin-top:10px; border-radius:5px; width:284px; padding:5px;"></select></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;">Postel Code / Zip:  </div> <div class="wid190 fleft left10">
                                <select name="" style="border:1px solid #aacde6; height:30px; margin-top:10px; border-radius:5px; width:124px; padding:5px;"></select></div> 

                            <div class="clear"></div>  

<div class="fleft top20 wid170" style="text-align:right;">Creadit Card No:  </div> <div class="wid190 fleft left10">
                                <input name="" class="travller_inputbox284 fleft top10" type="text" /></div> 
<div class="clear"></div>  
                            <div class="fleft top20 wid170" style="text-align:right;">Credit Cart Type:  </div> <div class="wid190 fleft left10">
                                <select name="" style="border:1px solid #aacde6; height:30px; margin-top:10px; border-radius:5px; width:200px; padding:5px;"></select></div> <div class="fleft top10 left10" ><img src="<?php echo base_url(); ?>assets/images/booking/credit_cards.png" /></div> 

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;">Credit Card Security Number:  </div> <div class=" fleft left10">
                                <input name="" class="travller_inputbox77 fleft top10" type="text" /></div> <div class="top20 left10"><a class="travller_blue_txt" style="background-image:none;" href="">What is this ? </a></div>

                            <div class="clear"></div>  

                            <div class="fleft top20 wid170" style="text-align:right;">Card Expiry Date:  </div> <div class=" fleft left10">
                                <select name="" style="border:1px solid #aacde6; height:30px; margin-top:10px; border-radius:5px; width:124px; padding:5px;"></select></div> <div class="fleft top20 left20">/</div> <div class="wid190 fleft left20">
                                <select name="" style="border:1px solid #aacde6; height:30px; margin-top:10px; border-radius:5px; width:124px; padding:5px;"></select></div>
                        </div>



                    </div>

                </div>

                <div > <div class="fleft top20"><input name="" type="checkbox" value=""  class="fleft"  /><div  style="color:#0F4F8B; padding-left:10px; font-size:11px;  width:300px; padding-top:5px;">Update my profile with this contact details. for flight </div> </div>

                    <div class="fright top20" style="text-align:right; font-weight:bold;">Total you need to pay : <span class="red_txt"> &#36; 6836 </span>
                        <div>Click the button below to make the payment & complete your booking</div>

                        <button class="flight_booking_redbtn top10" style="margin-bottom:30px;" onclick="document.pre_booking.submit();">MAKE PAYMENT</button>
                    </div>
                </div>
            </div>
        </div>
</form>
        <!-- RIGHT PART END -->


</div>
    <!--#################################### BODY CONTENT ENDS ###################################################--->
    <!--########################## FOOTER INCLUDE ##############################-->
    <?php $this->load->view('home/footer'); ?>
    <!--########################## FOOTER INCLUDE ##############################-->               
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
