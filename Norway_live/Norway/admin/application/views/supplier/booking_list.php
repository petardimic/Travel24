<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Bookings List</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery-1.4.3.min.js"></script>
<link type="text/css" href="<?php echo WEB_DIR?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>calender/ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR?>supplier_includes/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function()
{
$(function() {

							$("#stdate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage:'<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true
							});

						});
				
			$(function() { 
							$("#eddate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true
							});

						});
						
							$("#stdate").change(function(){
							//alert("dfgdf");
						 var selectedDate1= $("#stdate").datepicker('getDate');
			//alert(selectedDate1);
			  var nextdayDate  = dateADD(selectedDate1);
				   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
				    $t = nextDateStr;
				  $('#out').html('<input type="text" name="eddate" id="eddate" class="getfields" type="text"  style="width:80px; background:#F2F2F2;"  value="'+$t+'"> ');+
				$(function() {
							$( "#eddate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true,
								minDate: $t
							});

						});
			});
});
function dateADD(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
function zeroPad(num,count)
{
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}

</script>

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
         <div class="headersuplr_new1">View Bookings<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
<form action="<?php echo WEB_URL_ADMIN?>supplier/booking_list/1" method="post" id="filter_booking">
 <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" background-color:#ccc;">
  <tr>
    <td>List</td>
    <td>Period</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>Action </td>
  </tr>
  <tr>
    <td><select name="class" id="class" class="subgetselectfields"  style="width:180px;">
				   <option value="">select class type</option>
		<?php foreach($class as $cont){?>
		<option value="<?php echo $cont->sup_apartclass_type_id;?>" <?php if(isset($profile)){ if($profile!=''){if($profile->	sup_apartclass_type_id  == $cont->sup_apartclass_type_id){?> selected="selected"<?php }}}?>><?php echo $cont->apartclass;?></option>
		<?php }?>
		</select></td>
    <td></td>
    <td><input name="stdate" id="stdate" class="getfields" style="width:80px;" type="text" value="" ></td>
    <td><span id="out"><input name="eddate" id="eddate" class="getfields" style="width:80px; " type="text" value="" ></span></td>
     <td>
      <select name="status"  class="getfields" style="width:150px; height:30px;">
     		<option value="">Select status</option>
            <option value="Available">Confirmed</option>
            <option value="OnRequest">Pending Confirmation</option>
            <option value="Cancel">Cancelled</option>
            </select>
            </td>
    <td class="add-your-property" ><input type="submit" style="margin-bottom:5px;" value="submit"/></td>
  </tr>
</table>
</form>
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
   <tbody>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Booking Code </span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;" >
                  <strong><span>Res date</span>
                 </strong></td>
              <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Pin Code  </span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span>Client Name</span>
                 </strong></td>
    <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>Check in</strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>Check Out </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>Room</strong> </td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>Total Price </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>Status</strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>View Details</strong></td>
            </tr>
              <?php if(isset($bookings)){if($bookings !=''){
				foreach($bookings as $row){?>
             <tr>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span ><?php echo $row->booking_ref_no 	?> </span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                  <span><?php echo $row->voucher_date?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span ><?php echo $row->itemcode?> </span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                  <span><?php echo $row->firstname.' '.$row->lastname?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span ><?php echo $row->check_in?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                  <span><?php echo $row->check_out?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;"><?php echo $diff = ((strtotime($row->check_out) - strtotime($row->check_in)))/(60*60*24);?></td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;"><?php echo $row->currency_type.' '.$row->amount?></td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
				<?php if($row->status == 'Available'){echo 'Confirmed';}else if($row->status == 'Cancel'){echo 'Cancelled';}else if($row->status == 'OnRequest'){?><a href="<?php echo WEB_URL_ADMIN?>supplier/change_booking_status/<?php echo $row->booking_ref_no;?>" style="color:#555555;" title="click to confirm"> <?php echo 'Pending Confirmation';?></a><?php }?></td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;"><a href="<?php echo WEB_URL_ADMIN?>supplier/view_bookings/<?php echo $row->booking_ref_no 	?>"><img src="<?php echo WEB_DIR?>supplier_includes/images/view.png" alt="View Details" title="View Details"></a></td>
            </tr>
          <?php }}}?>
        </tbody>
    </table>
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>