<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link href="<?php print WEB_DIR?>css/thanku_styles.css" rel="stylesheet" type="text/css" />
<style>
#lightbox{ background:url(<?php echo WEB_DIR?>images/overlay.png); width:100%; height:100%; top:0px; left:0px; display:none;z-index:99999; padding-top:140px;}
</style>
<style>
.thankyou_title{font-size:20px; color:#000032; margin-top:10px; float:left; margin-bottom:5px;}
.thankyou_main_box{width:1076px; height:auto; float:left; min-height:30px; padding:15px 0 0 10px;  background-color:#FFF; -moz-border-radius:5px; border-radius:8px;  border:#E5E5E5 solid 1px;}
.thankyou_left_section{width:430px; height:auto; float:left; min-height:30px; font-size:14px;}
.thankyou_right_panel{width:500px; height:295px; float:left; min-height:30px; margin:10px; margin-top:0; background:url(<?php echo WEB_DIR?>images/thankyou_summary_bg.png) top no-repeat;}
.thankyou_summary_main_title{width:490px; height:30px; float:left; padding:7px 0 0 10px; font-size:24px; color:#FFF;}
.thankyou_summary_content_box{width:490px; height:auto; float:left; padding:15px 0 0 10px; font-size:13px;}
.summary_div{width:490px; height:auto; float:left; margin:3px 0;}
.thankyou_summary_label{width:125px; height:20px; float:left; margin-left:10px;}
.thankyou_summary_result{width:340px; height:20px; float:left;}
</style>
<body class="body-visible">

 <?php /*?><ul id="exampleMenu">
            <li ><a href="<?php echo WEB_URL ?>home/index">Home</a></li>
            
        </ul><?php */?>
<!--header-->

<?php if($this->session->userdata('memid') != '')
		{
			$this->load->view('member/header'); 
		}
		else
		{
			$this->load->view('header');
		}?>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44759003-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<!--header-->



<!--main-->
<div class="wrapper">

<div style="margin:auto; width:1000px; height:auto;">
<div class="main">
 
 
<div class="rollover" style="margin:25px 0px 5px 50px; font-size:13px; color:#e62424;"><a href="#">Home</a>&nbsp; > &nbsp;<a href="#">Hotel Search</a> &nbsp;>&nbsp; Hotels in <?php echo $this->session->userdata('disp_city'); ?></div>

 

<!--rigtside-->
 
 


    
     
    
     <div class="right_search_result1" style="float:left; margin-left:30px; margin-top:0px; width:993px;">
    <div>
   <div class="left_part_fiiglt1" style="width:970px; color:#e62424; height:auto; line-height:20px;"><br />
<span style="color:#333; font-weight:normal; font-size:12px;"> </span>
<span style="float:right;">

 </span>
</div>
   
   <!--left_part_fiiglt-->
   
    
   
   
</div>
   <div style="clear:both;"></div><!--prv_next-->

    
 
    
    <div class="search_result1" style="width:978px;"><!--six_tab-->
   
    <div class="flight_resutl_full"  style="width:978px;">
    
   <!--flight_result-->
   <div class="hotel_result1"  style="width:978px; font-size:12px; float:left;">
      
<div class="page_banner" style="margin-left:15px;"><img src="<?php print WEB_DIR?>images/Thankyou_Banner.png" width="945"     /></div>
<div class="title" >THANK YOU <span class="blue"><?php //echo $agent_details[0]['webmaster_name']?></span></div>
<div class="full_width">
            		<div class="content_div">
                 <strong class="thankyou_title" style="color: #000032;
    float: left;
    font-size: 20px;
    margin-bottom: 5px;
    margin-top: 10px;">Your transaction has been completed successfully.</strong><br /><br />
<br />

                	<div class="thankyou_main_box" style="background-color: #EFEEF3;
    float: left;
    height: auto;
    min-height: 30px;
    padding: 15px 0 0 10px;
    width: 950px;">
  
    
                    	<div class="thankyou_left_section">
                       	  <div style="width:390px; height:auto; float:left; margin:22px 20px 0 20px;">
                            	Thanks for the booking.<br /><br />
                                
                                You will be mailed a reciept copy of the booking done on your mail Id<br /><br />
                                You can check your bookings on your dashboard.<br /><br /><br /><br /><br /><br /><br /><br />
                   <br /><br /><br /><br /><br />
                            
                           <?php /*?><a href="<?php echo WEB_URL?>home/index">
                           <img src="<?php print WEB_DIR?>images/back2dashboard.png" width="161" height="38" alt="Back to dashboard" />
                            </a>
                            &nbsp;
                          
                            
                            <a href="<?php echo WEB_URL?>home/get_voucher/<?php echo $hotel->booking_no; ?>" target="_blank"><img src="<?php echo WEB_DIR?>images/Get_Voucher_bt.png"  alt="Get Voucher"/></a>
                            
                            <a href="<?php echo WEB_URL?>home/cancel_hotel/<?php echo $hotel->booking_no; ?>" target="_blank"><img src="<?php echo WEB_DIR?>images/cancel.png"  alt="Get Voucher"/></a>
                            <br />
                            <a href="<?php echo WEB_URL?>home/check_hotel/<?php echo $hotel->booking_no; ?>" target="_blank"><img src="<?php echo WEB_DIR?>images/check_status.png"  alt="Check Status"/></a>
<br /><?php */?>

                            </div>
                        	
                        </div>
						<?php /*?><div class="thankyou_right_panel">
                        	<div class="thankyou_summary_main_title">Your Booking Summary</div>
                            <div class="thankyou_summary_content_box">
                            	<div class="summary_div">
                                	<div class="thankyou_summary_label">Transaction Id.</div>
                                    <div class="thankyou_summary_result"><?php //echo $hotel->ProcessId; ?></div>
                                    
                                   
                                </div>
								<div class="summary_div">
                                	<div class="thankyou_summary_label">Hotel Name.</div>
                                    <div class="thankyou_summary_result"><?php //echo $hotel->hotelname; ?></div>
                                </div>
								
                               
                                <div class="summary_div">
                                	<div class="thankyou_summary_label">Check-In Date</div>
                                    <div class="thankyou_summary_result" style="width:100px;"><?php //echo $hotel->check_in; ?></div>
                                    <div class="thankyou_summary_label" style="margin-left:30px; width:110px;">Check-Out Date</div>
                                    <div class="thankyou_summary_result" style="width:100px;"><?php echo $hotel->check_out; ?></div>
                                </div>
                                
                                <div class="summary_div">
                                	<div class="thankyou_summary_label">Reservation Date</div>
                                    <div class="thankyou_summary_result"><?php echo $hotel->voucher_date; ?></div>
                                </div>
								<div class="summary_div">
                                	<div class="thankyou_summary_label">No. of Rooms</div>
                                    <div class="thankyou_summary_result" style="width:100px;">1</div>
                                    <div class="thankyou_summary_label" style="margin-left:30px; width:110px;">No. of Days</div>
                                    <div class="thankyou_summary_result" style="width:100px;"><?php echo $hotel->Nights; ?></div>
                                </div>
								<div class="summary_div">
                                	<div class="thankyou_summary_label">Room Type</div>
                                    <div class="thankyou_summary_result" style="width:100px;"><?php echo $hotel->room_type; ?></div>
                                    </div>
                           
                                <div class="summary_div">
                                	<div class="thankyou_summary_label">Billing Amount</div>
                                    <div class="thankyou_summary_result"><?php echo $hotel->Currency; ?> <?php echo $hotel->amount; ?></div>
                                </div>

									  <!--<div class="summary_div">
                                	<div class="thankyou_summary_label">EMERGENCY LINE</div>
                                    <div class="thankyou_summary_result">001-212-401-4550</div>
                                </div>-->
                            </div>
                        </div><?php */?>
                    </div>
                    
                    </div>
            </div>

 </div>
    
    
 
 
   
    
  </div> 

 


 
  
  
   
  
   
  
   

</div><!--search_result-->
</div>   

 
  




<!--rigtside-->

 
</div>

</div>


<!--main-->


<?php /*?><div style="float:left; margin-top:20px;  "><?php $this->load->view('right_banner'); ?></div><?php */?>


</div>




 <!--footer-->
    
	<?php $this->load->view('footer'); ?>
	
    
    <!--footer-->

</body>
</html>
