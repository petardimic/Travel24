<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>FLIGHT :: THANKYOU</title>
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

<div id="wrapper">
<?php $this->load->view('home/header1'); ?>
<div class="inner_wrapper">
<!-- LEFT PART -->

				
<?php   $flight_det = $this->Flights_Model->getflightdetvoucher($id); 
		$transaction_det = $this->Flights_Model->get_transaction_det($id);
//echo '<pre />';print_r($flight_det);die; ?>
<!-- LEFT PART END -->


<!-- RIGHT PART -->

<div class="right_part top30" style="margin-top:10px; margin-left:0px;">
    <div class="flight_booking_bluebg top10" style="background-color:#FFF; width:1002px;">
        <img src="<?php echo base_url(); ?>assets/images/thanku_banner.png" />
    </div>
    <div class="clear"></div>
    <div class="right_main_bar top10" style="width:1023px;">
        <div class="fleft left20" >Thank You For Booking</div>
        <div class="flight_booking_bluebg top10" style="background-color:#FFF; color: #333; padding:25px; width:972px;">
            <div style="width: 484px; float: left;">
                <h2 style="margin: 0;font-weight: normal;">Flight Details</h2>
                <p style="line-height: 20px;margin: 0; ">
                    <span style="color:#F00;">Thanks For Booking With Akbartravels.us</span> <br />
                    <span style="float:left; width:110px;"> Departure From </span>&nbsp;: 
                        <?php 
                            if(strpos($flight_det->dlocation,'<br>'))
                            {
                                $dlocation1=explode('<br>',$flight_det->dlocation);
                                $dlocation=$dlocation1[0];
                            }
                            else
                            {
                                $dlocation=$flight_det->dlocation;
                            }
                            
                        ?>
						<?php
                            //echo $dlocation; 
							$from_airport = $this->Flights_Model->get_City_name($dlocation);
							echo $from_airport->city.",".$dlocation;
                        ?> 
                    <br />
                    <span style="float:left; width:110px;"> Departure To </span>&nbsp;: 
                        <?php 
                            if(strpos($flight_det->alocation,'<br>'))
                            {
                                $alocation1=explode('<br>',$flight_det->alocation);
                                $alocation=$alocation1[0];
                            }
                            else
                            {
                                $alocation=$flight_det->alocation;
                            }
                            
                        ?>
						<?php
							$to_airport = $this->Flights_Model->get_City_name($alocation);
                           echo $to_airport->city.",".$alocation; 
                        ?> 
                    <br />
                    <span style="float:left; width:110px;"> Journey Type </span>&nbsp;: 
                        <?php
                            echo $flight_det->journey_type; 
                        ?> 
                    <br />
                    <span style="float:left; width:110px;">  Airline</span>&nbsp;:  
                        <?php 
                            if(strpos($flight_det->airline,'<br>'))
                            {
                                $airlineArr=explode('<br>',$flight_det->airline);
                                $airlineCodeArr=explode('<br>',$flight_det->airline_code);
                                $airline=$airlineArr[0];
                                $airlineCode=$airlineCodeArr[0];
                            }
                            else
                            {
                                $airline=$flight_det->airline;
                                $airlineCode=$flight_det->airline_code;
                            }
                            echo $airline . " - " . $airlineCode; 
                        ?> 
                    <br />
                    <span style="float:left; width:110px;">  Departure Date </span>&nbsp;: 
                        <?php 
                            if(strpos($flight_det->dep_date,'<br>'))
                            {
                                $depDateArr=explode('<br>',$flight_det->dep_date);
                                $arvDateArr=explode('<br>',$flight_det->arv_date);
                                $depDate=$depDateArr[0];
                                $arvDate=end($arvDateArr);
                            }
                            else
                            {
                                $depDate=$flight_det->dep_date;
                                $arvDate=end($flight_det->arv_date);
                            }
                            echo $depDate; 
                        ?> 
                        <?php if($flight_det->journey_type != 'OneWay') { ?>
                    <br />
                    <span style="float:left; width:110px;"> Arrival Date </span>&nbsp;: 
                        <?php 
                            echo $arvDate; 
                        ?> 
                        <?php } ?>
                    <br />
                    <br />
                    <a href="<?php echo site_url(); ?>/flights/get_voucher/<?php echo $id; ?>" target="_blank"><img src="<?php echo base_url(); ?>assets/images/Voucher.png" border="0" /></a>
                </p>

            </div>
            <div style="width: 445px; float: left;background-color: #e7ecf0;padding: 20px;border-radius: 5px;">
                <h3 style="color: red;margin: 0;font-weight: bold;">Payment Details</h3>
                <p style="font-weight: normal;line-height:  20px; margin: 0; color:#666; font-weight:bold; ">
                    <span style="float:left; width:153px;">Transaction Id </span>&nbsp;: <?php echo $transaction_det->booking_id; ?><br />
                    <span style="float:left; width:153px;">Bank Transaction Id </span>&nbsp;: <?php echo $transaction_det->TransactionID; ?><br />
                    <span style="float:left; width:153px;">Amount Collected</span>&nbsp;: <?php echo $transaction_det->amount; ?><br />
                    <span style="float:left; width:153px;">Booking Status </span>&nbsp;: <?php echo $transaction_det->status; ?><br />
                    <span style="float:left; width:153px;">Payment Id </span>&nbsp;: <?php echo $transaction_det->PaymentID; ?><br />
                    <span style="float:left; width:153px;">Bank Reference Number </span>&nbsp;: <?php echo $transaction_det->res_ref; ?><br />
                </p>
            </div>


        </div>




        <div class="flight_booking_bluebg top10" style="background-color:#FFF; color:#333; padding:10px; width:1000px;">
            <div style="width: 333px; float: left;">
                <img src="<?php echo base_url(); ?>assets/images/best_car.png" style="width: 322px;"/>
            </div>
            <div style="width: 333px; float: left;">
                <img src="<?php echo base_url(); ?>assets/images/best_hotels.png" style="width: 322px;"/>
            </div>
            <div style="width: 334px; float: left;">
                <img src="<?php echo base_url(); ?>assets/images/holidays.png" style="width: 334px;height: 116px;"/>
            </div>

        </div>

    </div>


</div>
</div>
</div>

<!-- RIGHT PART END -->


</div>

                 <?php $this->load->view('home/footer'); ?>
                    						

      
</div>  <!-- Wrapper END -->    
</body>

      
</html>



