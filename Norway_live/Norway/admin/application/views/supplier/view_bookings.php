<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - View Bookings</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery-1.4.3.min.js"></script>
<link type="text/css" href="<?php echo WEB_DIR?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>calender/ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR?>supplier_includes/js/custom.js" type="text/javascript"></script>

<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>

<div class="wrapper">
    <!-- Top navigation bar -->
    <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

<!--    <div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <!--<div class="wrapper">
        <!-- Content -->
       <!-- <div class="content">
            <!-- Dynamic table -->
           <!-- <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">View Bookings</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>-->
                
<div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">View Booking Details<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
<div style="float:left; width:550px;">
            	<table width="100%" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td height="20"></td>
                        <td></td>
                    </tr>
                     <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Status:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){if($bookings->status =='Available'){echo 'Confirmed';}else if($bookings->status =='Cancel'){echo 'Cancelled';}else{echo 'Pending Confirmation';}}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Booking Ref:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->booking_ref_no;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Client:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->firstname.' '.$bookings->lastname;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Accommodation:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->hotelname;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Address:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $this->Home_Model->gt_hotel_address($bookings->booking_no);}}?></td>
                    </tr>
                    <?php /*?><tr>
                    	<td height="20"></td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->city;}}?></td>
                    </tr>
                    <tr>
                    	<td height="20"></td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->countryName;}}?></td>
                    </tr><?php */?>
                      <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Telephone:</td>
                        <td><?php echo $this->Home_Model->get_phonenumber($bookings->hotel_code);?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Arrival Date:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->check_in;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26 " style="font-weight:bold; padding-left:10px;">Departure Date:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->check_out;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">No. of Nights:</td>
                        <td><?php echo $diff = (strtotime($bookings->check_out) - strtotime($bookings->check_in))/(60*60*24);?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">No. of Units:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->no_of_room;}}?></td>
                    </tr>
                    <tr>
                    	<td height="20"></td>
                        <td></td>
                    </tr>
                </table>
                
                <table width="100%" cellpadding="0" cellspacing="0">
                	 <tr>
                    	<td width="24%" height="26" style="font-weight:bold; padding-left:10px;">Lead Guest Name</td>
                        <td width="34%" height="26" style="font-weight:bold; padding-left:10px;">Accom. Type</td>
                        <td width="14%" style="font-weight:bold; padding-left:10px;">Adults</td>
                        <td width="14%" style="font-weight:bold; padding-left:10px;">Children</td>
                        <td width="14%" style="font-weight:bold; padding-left:10px;">Smoking</td>
                    </tr>
                    <?php for($k=1;$k<=$bookings->no_of_room;$k++){
						$ss = 'guest'.$k;
						$ad = 'adults'.$k;
						$cd = 'childs'.$k;
						$smo = 'smoking'.$k;?>
                    <tr>
                        <td style="padding-left:10px;" height="20"><?php echo $bookings->$ss;?></td>
                        <td style="padding-left:10px;"><?php echo $bookings->room_type?></td>
                        <td style="padding-left:10px;"><?php echo $bookings->$ad;?></td>
                        <td style="padding-left:10px;"><?php echo $bookings->$cd;?></td>
                   		<td style="padding-left:10px;"><?php echo $bookings->$smo;?></td>
                    </tr>
                    <?php }?>
                   
                   <tr>
                        <td height="20" style="padding-left:10px"></td>
                        <td colspan="2" style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td colspan="6" style="padding-left:10px;"></td>
                  </tr>
                      <tr>
                        <td height="20" style="padding-left:10px"></td>
                        <td style="padding-left:10px;">Sub Total:</td>
                       
                        <td colspan="6" align="left" style="padding-left:20px;"   ><?php echo $bookings->currency_type.' '. $bookings->amount?></td>
                      </tr>
                      <tr>
                        <td height="20" style="padding-left:10px"></td>
                        <td  style="padding-left:10px;">Payment Recd:</td>
                       
                        <td colspan="6" align="left" style="padding-left:20px;" ><?php echo $bookings->currency_type.' '. $bookings->paid_amount?></td>
                      </tr>
                      <tr>
                        <td height="20" style="padding-left:10px"></td>
                        <td  style="padding-left:10px;"><strong>Balance:</strong></td>
                       
                        <td colspan="6" align="left" style="padding-left:20px;" ><?php echo $bookings->currency_type.' '. $bookings->bal_amount 	?></td>
                      </tr>
			 <tr>
                    	<td height="20" colspan="5" style="font-weight:bold;padding-left:10px;">Cancellation Polcy:</td>
                     </tr>
		 <?php $tot_rooms = $this->Home_Model->get_allroomguests($bookings->passenger_info_id);if($tot_rooms != '')
					{foreach($tot_rooms as $rooms){?>
                     <tr>
                    	<td height="20" style="padding-left:10px"><?php echo $bookings->room_type?></td>
                        <td style="padding-left:10px;"><?php if($bookings->cancel_tilldate != 'null'){ echo 'Refundable';}else{echo 'Non - refundable';}?></td>
                        <td style="padding-left:10px;" colspan="3"><?php if($bookings->cancel_tilldate != 'null'){ echo 'If cancelled before '.$bookings->cancel_tilldate.', no fee will be charged. If cancelled later, or in case on no-show '.$bookings->cancel_amount.' '. $bookings->currency_type.' will be charged. ';}else{echo 'Non - refundable';}?></td>
                    </tr>
			<tr>
                    	<td height="10" colspan="10" style="font-weight:bold;padding-left:10px;"></td>
                  </tr>
                    <?php }}?>
                    
                       <tr>
                    	<td height="20" style="padding-left:10px"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                    </tr>
                    <tr>
                    	<td height="20" colspan="5" style="font-weight:bold;padding-left:10px;">Special Requests:</td>
                     </tr>
                     <?php if($tot_rooms != '')
					{foreach($tot_rooms as $rooms){?>
                     <tr>
                       <td height="20" colspan="8" style="padding-left:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="290" colspan="4"><b><?php echo $rooms->guest_name.', '.$bookings->room_type.': '?></b><?php echo $this->Home_Model->get_special_req1($bookings->passenger_info_id,$rooms->guest_details_id)?></td>
                          <?php /*?> <td width="20">&nbsp;</td><?php */?>
                    
                        </tr>
                       </table></td>
                     </tr>
                     
                    <?php }}?>
                       <tr>
                    	<td height="20" style="padding-left:10px"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                    </tr>
                      <tr>
                    	<td height="20" colspan="5" style="font-weight:bold;padding-left:10px;">Remarks:</td>
                     </tr>
                     <tr>
                    	<td height="20" colspan="5" style="padding-left:10px;">
			<?php
				echo $this->Home_Model->get_remarks($bookings->type,$bookings->roomUseCode);
				
			?>
			</td>
                      </tr>
                         <tr>
                    	<td height="20" style="padding-left:10px"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                    </tr>
                    <tr>
                    	<td height="20" colspan="5" style="font-weight:bold;padding-left:10px;">Payment Details:</td>
                     </tr>
                     <tr>
                    	<td height="15" style="font-weight:bold;padding-left:10px;">Name:</td>
                        <td style="padding-left:10px;"><?php echo $bookings->cardname?></td>
                        <td style="font-weight:bold; padding-left:10px;">Card Type:</td>
                        <td style="padding-left:10px;"><?php echo $bookings->cardtype?></td>
                     </tr>
                     <tr>
                    	<td height="20" style="font-weight:bold;padding-left:10px;">Card No: </td>
                        <td style="padding-left:10px;"><?php echo 'XXXX XXXX XXXX'. substr($bookings->cardnumber,12,16);?></td>
                        <td style="padding-left:10px; font-weight:bold;" >EXP:</td>
                        <td style="padding-left:10px;"><?php echo $bookings->expire_date?></td>
                        <td style="padding-left:10px;"></td>
                    </tr>
                   
                </table>
            </div>
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>