<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - View Bookings</title>
<link href="<?php echo WEB_DIR; ?>css/staykey.css" rel="stylesheet" type="text/css" media="screen" />
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
      
       
       
        <div class="content" style="float:left; width:100%; ">
         <div class="headersuplr_new1" style="width:956px;">View Booking Details<span style=" width:20%;float:right; font-size:13px; text-align:right;"></span>
        </div>
        <div style="float:left; width:60%;">
<div style="float:left; width:550px; ">
            	<table width="100%" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td height="20"></td>
                        <td></td>
                    </tr>
                     <?php if(isset($bookings)){if($bookings !=''){if($bookings->status == 'OnRequest'){ ?>
                     <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Confirm Booking:</td>
                        <td><a href="<?php echo WEB_URL_ADMIN?>admin/cancel_booking_onrequest_confirm/<?php echo $bookings->booking_ref_no;?>"><img src="<?php echo WEB_DIR?>supplier_includes/images/confirm.png" /></a></td>
                    </tr>
                     <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Cancel Booking:</td>
                        <td><a href="<?php echo WEB_URL_ADMIN?>admin/cancel_booking_onrequest_cancel/<?php echo $bookings->booking_ref_no;?>"><img src="<?php echo WEB_DIR?>supplier_includes/images/cancel.png" /></a></td>
                    </tr>
                    <?php }else if($bookings->status == 'Available'){?>
                     <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Cancel Booking:</td>
                        <td> <a href="<?php echo WEB_URL_ADMIN?>admin/cancel_booking_available_cancel/<?php echo $bookings->booking_ref_no;?>"><img src="<?php echo WEB_DIR?>supplier_includes/images/cancel.png" /></a></td>
                    </tr>
                    <?php }}}?>
                     <tr>
                    	<td   height="20" style="font-weight:bold;padding-left:10px;">Status</td>
                        <td style="padding-left:0px;"><?php if(isset($bookings)){if($bookings !=''){if($bookings->status =='Available'){echo 'Confirmed';}else if($bookings->status =='Cancel'){echo 'Cancelled';}else{echo 'Pending Confirmation';}}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Booking No:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->booking_ref_no;}}?></td>
                    </tr>
<tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Pincode:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->itemcode;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Client:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->guest1;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Accommodation:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->hotelname;}}?></td>
                    </tr>
                    <tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Address:</td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $this->Home_Model->gt_hotel_address($bookings->booking_no);}}?></td>
                    </tr>
                   <?php /*<tr>
                    	<td height="20"></td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->city;}}?></td>
                    </tr>
                    <tr>
                    	<td height="20"></td>
                        <td><?php if(isset($bookings)){if($bookings !=''){echo $bookings->countryName;}}?></td>
                    </tr> */ ?>
<tr>
                    	<td height="26" style="font-weight:bold; padding-left:10px;">Telephone:</td>
                        <td>  <?php echo $this->Home_Model->get_phonenumber($bookings->hotel_code)?></td>
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
                   	   <td width="45%"height="26" valign="bottom" style="font-weight:bold; padding-left:10px;  padding-top:12px;">Lead Guest Name, 
                        Accom. Type</td>
                       <td style="font-weight:bold; padding-left:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="25"><img src="<?php echo WEB_DIR?>images/adults.jpg" width="20" height="20" title="adults"/></td>
                            <td width="25"><img src="<?php echo WEB_DIR?>images/childs.jpg" width="20" height="20" title="childs"/></td>
                            <td width="25"><img src="<?php echo WEB_DIR?>images/breakfast_icon.png" title="breakfast" height="20" width="20"/></td>
                            <td width="15"><img src="<?php echo WEB_DIR?>images/smoke.png" width="20" height="20" title="smoke"/></td>
                          </tr>
                          <tr>
                            <td height="5" colspan="4"></td>
                          </tr>
                        </table></td>
                        <td colspan="7"  style="font-weight:bold; padding-left:23px;">Amount</td>
                  </tr>

                    <?php $tot_rooms = $this->Home_Model->get_allroomguests($bookings->passenger_info_id);
					if($tot_rooms != '')
					{
					foreach($tot_rooms as $rooms){//echo "<pre>"; print_r($rooms);exit;?>
                    <tr>
                        <td style="padding-left:10px;" height="20"><?php echo $rooms->guest_name.', '.$bookings->room_type;?></td>
                        
                      <td style="padding-left:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="40" align="center"><?php echo $rooms->adults?></td>
                            <td width="30" align="center"><?php echo $rooms->childs?></td>
                            <td width="35" align="center"><?php if($rooms->breakfast == 'NO'){echo 'No';}else{echo 'Yes';}?></td>
                            <td align="center"><?php if($rooms->smoking == 'no'){echo 'No';}else{echo 'Yes';}?></td>
                        </tr>
                        </table></td>
                        <td colspan="7" style="padding-left:23px;   "><?php echo $bookings->currency_type.' ' ; if(count($tot_rooms) == 1){echo  $bookings->amount;}else{echo $bookings->amount/count($tot_rooms);}?></td>
                    </tr>
                    <?php }}?>
                   
                   
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
                       <?php if($tot_rooms != '')
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
                    	<td height="20" colspan="5" style="font-weight:bold;padding-left:10px;">Special Requests:</td>
                     </tr>
                        <?php if($tot_rooms != '')
					{foreach($tot_rooms as $rooms){?>
                     <tr>
                      <td height="20" colspan="8" style="padding-left:10px;">
                    	<table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td width="290"><b><?php echo $rooms->guest_name.', '.$bookings->room_type.': '?></b><?php echo $this->Home_Model->get_special_req1($bookings->passenger_info_id,$rooms->guest_details_id)?></td>
                         </tr>
                       </table></td>
                     </tr>
                    <?php }}?>
                     <tr>
                    	<td height="10" colspan="10" style="font-weight:bold;padding-left:10px;"></td>
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
                       <td height="20" colspan="5" style="font-weight:bold;padding-left:10px;">&nbsp;</td>
                  </tr>
                    <tr>
                       <td height="20" colspan="5" style="font-weight:bold;padding-left:10px;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                         <tr>
                           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td><strong>Credit  Card Details:</strong></td>
                               <td>&nbsp;</td>
                             </tr>
                             <tr>
                               <td><strong>Name:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->cardname?></span></td>
                             </tr>
                             <tr>
                               <td><strong>Card  Type</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->cardtype?></span></td>
                             </tr>
                             <tr>
                               <td><strong>Card  No:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->cardnumber;?></span></td>
                             </tr>
                             <tr>
                               <td><strong>EXP:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->expire_date?></span></td>
                             </tr>
                           
                           </table></td>
                           <td>&nbsp;</td>
                           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                             <tr>
                               <td><strong>Client  Details</strong></td>
                               <td>&nbsp;</td>
                             </tr>
                             <tr>
                               <td><strong>Name:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->firstname?></span></td>
                             </tr>
                             <tr>
                               <td><strong>Address</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->address?></span></td>
                             </tr>
                             <tr>
                               <td><strong>City:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->city?></span></td>
                             </tr>
                             <tr>
                               <td><strong>Country:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $this->Home_Model->get_cnt($bookings->country_id)?></span></td>
                             </tr>
                             <tr>
                               <td><strong>Mobile:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->firstname?></span></td>
                             </tr>
                              <tr>
                               <td><strong>Email:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->email?></span></td>
                             </tr>
                              <tr>
                               <td><strong>Postal/Zip:</strong></td>
                               <td><span style="font-weight:normal"><?php echo $bookings->postalcode?></span></td>
                             </tr>
                           </table></td>
                         </tr>
                       </table></td>
                  </tr>
                    
                  
                  <tr>
                    	<td height="20" style="padding-left:10px"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                        <td style="padding-left:10px;"></td>
                    </tr>
                </table>
            </div>
            
            </div>
            <div style="width:37%; height:auto; float:left;">
            <div style="padding-top:10px; padding-right:30px; float:right;"><img src="<?php echo WEB_DIR?>images/print_icon.jpg" width="50" height="50" onClick="window.print()" style="cursor:pointer;"  /></div>
            <div style="float:left; width:375px; padding:7px 0px;"><span style="font-size:14px; color:#363636;">
            <?php if($bookings->agent_id){echo 'Agent';}else{echo "Guest";}?></span></div>
            <div style="float:left; width:375px; padding:7px 0px;"><span style="font-size:14px; color:#363636;"><font color="#ed1c24">>></font>
             Resend Client's confirmation voucher</span>
         
            
            
<div style="float:left; width:360px; height:30px;">
				<form method="post" id="resend_voucher" action="<?php echo WEB_URL_ADMIN?>admin/resend_voucher" >
                <input type="hidden" name="booking_ref" value="<?php if(isset($bookings)){if($bookings !=''){echo $bookings->booking_ref_no;}}?>" />
            	<table width="100%">
                	<tr>
                    	<td width="81%" ><input type="text" name="resend_email" id="resend_email" style="border:solid 2px #f79646; width:253px; height:20px;" /><br/><span id="resend_email_err"></span></td>
                        <td width="19%" valign="top" style="cursor:pointer; " ><span class="btn_ok" style="height:17px;" onclick="return validate_resend();">OK</span></td>
                    </tr>
                </table>
                </form>
                
            </div>
            
            
             <br/> <br />Please confirm your email address and click OK </div>
             
             
             <div style="float:left; width:375px; padding:7px 0px;"><span style="font-size:14px; color:#363636;"><font color="#ed1c24">>></font>
             Resend Client's Reciepts</span>
         
            
            
<div style="float:left; width:360px; height:30px;">
				<form method="post" id="resend_reciept" action="<?php echo WEB_URL_ADMIN?>admin/resend_reciept" >
          <input type="hidden" name="booking_ref" value="<?php if(isset($bookings)){if($bookings !=''){echo $bookings->booking_ref_no;}}?>" />
            	<table width="100%">
                	<tr>
                    	<td width="81%"><input type="text" name="reciept_email" id="reciept_email" style="border:solid 2px #f79646; width:253px; height:20px;" onblur="return validate_rec();" /><span id="reciept_email_err"></span></td>
                        <td width="19%" style="cursor:pointer;"><span class="btn_ok" style="height:17px;"  onclick="return validate_reciept();">OK</span></td>
                    </tr>
                </table>
                </form>
                
            </div>
            
            
             <br/> <br />Please confirm your email address and click OK </div>
 <div style="float:left; width:375px; padding:7px 0px;"><span style="font-size:14px; color:#363636;">
             Supplier</span></div>
            <div style="float:left; width:375px; padding:7px 0px;"><span style="font-size:14px; color:#363636;"><font color="#ed1c24">>></font>
             Resend Client's confirmation voucher to Supplier</span>
         
            
            
<div style="float:left; width:360px; height:30px;">
				<form method="post" id="resend_voucher" action="<?php echo WEB_URL_ADMIN?>supplier/resend_voucher" >
                <input type="hidden" name="booking_ref" value="<?php if(isset($bookings)){if($bookings !=''){echo $bookings->booking_ref_no;}}?>" />
            	<table width="100%">
                	<tr>
                    	<td width="81%" ><input type="text" name="resend_email" id="resend_email1" style="border:solid 2px #f79646; width:253px; height:20px;" /><br/><span id="resend_email_err1"></span></td>
                        <td width="19%" style="cursor:pointer; padding:5px;" ><span class="btn_ok" style="height:17px;" onclick="return validate_resend1();">OK</span></td>
                    </tr>
                </table>
                </form>
                
            </div>
            
            
             <br/> <br />Please confirm your email address and click OK </div>
             
             
             <div style="float:left; width:375px; padding:7px 0px;"><span style="font-size:14px; color:#363636;"><font color="#ed1c24">>></font>
             Resend Invoice</span>
         
            
            
<div style="float:left; width:360px; height:30px;">
				<form method="post" id="resend_voucher1" action="<?php echo WEB_URL_ADMIN?>supplier/resend_voucher1" >
                <input type="hidden" name="booking_ref" value="<?php if(isset($bookings)){if($bookings !=''){echo $bookings->booking_ref_no;}}?>" />
            	<table width="100%">
                	<tr>
                    	<td width="81%" ><input type="text" name="resend_email" id="resend_email2" style="border:solid 2px #f79646; width:253px; height:20px;" /><br/><span id="resend_email_err2"></span></td>
                        <td width="19%" style="cursor:pointer; padding:5px;" ><span class="btn_ok" style="height:17px;" onclick="return validate_resend2();">OK</span></td>
                    </tr>
                </table>
                </form>
                
            </div>
            
            
             <br/> <br />Please confirm your email address and click OK </div>

            </div>
           
            </div>
           
           
           
            
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>
<script type="text/javascript">
function validate_resend()
{	
	var email = $('#resend_email').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("resend_email_err").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("resend_email").value = '';
		document.getElementById("resend_email").focus();
		return false;
	}
	else
	{
		document.getElementById('resend_voucher').submit();
	}
	//return true;
}
function validate_resend2()
{	
	var email = $('#resend_email2').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("resend_email_err2").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("resend_email2").value = '';
		document.getElementById("resend_email2").focus();
		return false;
	}
	else
	{
		document.getElementById('resend_voucher1').submit();
	}
	//return true;
}

function validate_resend1()
{	
	var email = $('#resend_email1').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("resend_email_err1").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("resend_email").value = '';
		document.getElementById("resend_email").focus();
		return false;
	}
	else
	{
		document.getElementById('resend_voucher').submit();
	}
	//return true;
}
function validate()
{	
	var cust_id = "<?php echo $bookings->customer_id;?>";
	var email = $('#resend_email').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("resend_email_err").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("resend_email").value = '';
		document.getElementById("resend_email").focus();
		return false;
	}
	else
	{
		$.post("<?php echo WEB_URL?>home/check_cust_user_resend",{'email':email,'cust_id':cust_id},function(data){
		if(data == 1)
		{
			document.getElementById('resend_email_err').innerHTML='';
		}
		else
		{
			document.getElementById('resend_email_err').innerHTML="<font color=red>Email address doesn't exist</font>";
			document.getElementById("resend_email").value = '';
			document.getElementById("resend_email").focus();		
		}
		});
		
	}
	//return true;
}
function validate_rec()
{
	var cust_id = "<?php echo $this->session->userdata('user_id');?>";
	var email = $('#reciept_email').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("reciept_email_err").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("reciept_email").value = '';
		document.getElementById("reciept_email").focus();
		return false;
	}
	else
	{
		$.post("<?php echo WEB_URL?>home/check_cust_user_resend",{'email':email,'cust_id':cust_id},function(data){
		if(data == 1)
		{
			document.getElementById('reciept_email_err').innerHTML='';
		}
		else
		{
			document.getElementById('reciept_email_err').innerHTML="<font color=red>Email address doesn't exist</font>";
			document.getElementById("reciept_email").value = '';
			document.getElementById("reciept_email").focus();		
		}
		});
		
	}
}
function validate_reciept()
{
	var email = $('#reciept_email').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("reciept_email_err").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("reciept_email").value = '';
		document.getElementById("reciept_email").focus();
		return false;
	}
	else
	{
		document.getElementById('resend_reciept').submit();
	}
}
</script>
