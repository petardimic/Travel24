<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Rate Details</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery-1.4.3.min.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<?php /*?><script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script><?php */?>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>

<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
$(document).ready(function()
{
$('#rate_plan').watermark("standard");
$('#default_avail').watermark("10");
$('#def_max').watermark("15");
$('#def_min').watermark("1");
$('#rate').watermark("200");
<?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 1){?> 
$('#perc').show();
		$('#amount').show();
<?php }}}?> 
$(function() {

							$("#stdate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage:'<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true,
								minDate: 0
							});

						});
				
			$(function() { 
							$("#eddate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true,
								minDate: 0
							});

						});
						
							$("#stdate").change(function(){
							//alert("dfgdf");
						 var selectedDate1= $("#stdate").datepicker('getDate');
			//alert(selectedDate1);
			  var nextdayDate  = dateADD(selectedDate1);
				   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
				    $t = nextDateStr;
				  $('#out').html('<input type="text" name="eddate" id="eddate" class="input-field" type="text"  style="width:100px; background:#F2F2F2;"  value="'+$t+'"> ');+
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

function cancellation_policy(val)
{
	if(val == 1)
	{
		$('#cancel_details_row').show();
		$('#days_before').show();
		$('#charge_percent_row').show();
		$('#charge_rate_row').hide();
		document.getElementById('cancellation_nights').disabled = true;
		document.getElementById('cancellation_days').disabled = false;
	}
	else if(val == 2)
	{
		$('#cancel_details_row').show();
		$('#days_before').show();
		$('#charge_rate_row').show();
		$('#charge_percent_row').hide();
		document.getElementById('cancellation_nights').disabled = false;
		document.getElementById('cancellation_days').disabled = true;
	}
	else
	{
		$('#cancel_details_row').hide();
		document.getElementById('cancellation_nights').disabled = true;
		document.getElementById('cancellation_days').disabled = true;
	}
}
function breakfast_type_script(val)
{
	if(val == "NO")
	{
		document.getElementById('breakfast_type').disabled = true;
		document.getElementById('breakfastfrom').disabled = true;
		document.getElementById('breakfastto').disabled = true;
	}
	else
	{
		document.getElementById('breakfast_type').disabled = false;
		document.getElementById('breakfastfrom').disabled = false;
		document.getElementById('breakfastto').disabled = false;
	}
}
function charges_script(val)
{
	if(val == 1)
	{
		document.getElementById('charge_rate').readOnly = true;
		document.getElementById('charge_percent').readOnly = false;
	}
	else
	{
		document.getElementById('charge_rate').readOnly = false;
		document.getElementById('charge_percent').readOnly = true;
	}
}
function pre_pay(val)
{
	if(val == 1)
	{
		$('#perc').show();
		$('#amount').show();
	}
	else
	{
		$('#perc').hide();
		$('#amount').hide();
	}
}
</script>
<script type="text/javascript">
function security_deposit_show(val)
{

	if(val == 1)
	{
		$('#method_display').show();
	}
	else
	{
		$('#method_display').hide();
	}
}
function deposit_method_show(val)
{
	if(val == 2)
	{
		$('#percentage').show();
		$('#amount_sec').hide();
	}
	else if(val == 3)
	{
		$('#percentage').hide();
		$('#amount_sec').show();
	}
	else
	{
		$('#percentage').hide();
		$('#amount_sec').hide();
	}
	
}
</script>
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
table.display td select {
    background: none repeat scroll 0 0 #F2F2F2;
    border: 1px solid #DCDCDC;
    border-radius: 3px 3px 3px 3px;
    color: #555555;
    font-size: 11px;
    height: 30px;
}
table.display td input {
   /* background: none repeat scroll 0 0 #FFFFFF;*/
    border: 1px solid #DCDCDC;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 11px;
    height: 25px;
    vertical-align: middle;
}
.border-bottom {
    border-bottom: 1px solid #E7E7E7;
    vertical-align: top;
}
</style>
</head>
<body>
<div class="wrapper">

    <!-- Top navigation bar -->
    <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

   <!-- <div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <!--<div class="wrapper">
        <!-- Content -->
        <!--<div class="content">
            <!-- Dynamic table -->
            <!--<div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Rate Plan Details</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>
                </div>-->
               
<div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Rate Plan Details<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
        <?php if(isset($plan1)){if($plan1!=''){?>

<form method="post" name="get_ind" id="get_ind" action="<?php echo WEB_URL_ADMIN?>supplier/get_ind_plan">
 <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">

  <tr>
                <td style="border-bottom:1px solid #dcdcdc; width:33%">
                    <span >Duplicate Previous Rate Plan:</span>
                </td>
                   <td style="border-bottom:1px solid #dcdcdc;">
	<?php //echo $plan;?>
               <select name="plan_name" id="plan_name" class="getfields" style="width:300px; height:30px;" onchange="return this.form.submit();">
				<option value="">Select Rate Plan</option>
				<?php if(isset($plan1)){if($plan1!=''){foreach($plan1 as $p){
					$cat_name = $this->Supplier_Model->get_cat_name($p->sup_apart_category_id,$p->sup_apart_list_id);
					?>
				<option value="<?php echo $p->sup_apart_rateplan_id;?>"<?php if(isset($id)){if($id != ''){if($id == $p->sup_apart_rateplan_id){?> selected="selected" <?php }}}?> ><?php echo $p->rate_name.','.$cat_name?></option>
				<?php }}}?>
			</select>
                    </td>
            </tr>
            </table>
            </form>
            <?php }}?>
 <form name="rate_details" id="rate_details" action="<?php echo WEB_URL_ADMIN?>supplier/add_rate_details" method="post">
    <table class="display tableStatic" border="0" cellpadding="0" cellspacing="0">
            <tbody>
                <tr>
                    <td class="border-bottom border-right" colspan="2">
                        <div align="center">
                            
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblRatePlanName">Rate Plan Name   	</span>
                        &nbsp;
                        <span id="ctl00_OptionalLinks_UpdatePanel_RequiredFieldValidator9" class="error" style="color:Red;visibility:hidden;">*</span>
                    </td>
                    <td class="border-bottom">
                        <input name="rate_plan" id="rate_plan" class="input-field" style="width:300px; background:#F2F2F2;" type="text" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->rate_name;}}?>">
                    <br/><span id="rate_plan_err"></span></td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblDefaultAvailability">Default Availability</span>
                        <span id="ctl00_OptionalLinks_UpdatePanel_RequiredFieldValidator1" class="error" style="color:Red;visibility:hidden;">*</span>
                    </td>
                    <td class="border-bottom">
                        <input name="default_avail" id="default_avail" class="input-field" type="text"  style="width:300px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->default_availablity ;}}?>">
                        
                   <br/><span id="default_avail_err"></span>     
                    </td>
                </tr>
				<tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblCapacity">Select Rate for Room Plan</span>
                        &nbsp;
                        <span id="ctl00_OptionalLinks_UpdatePanel_RequiredFieldValidator6" class="error" style="color:Red;visibility:hidden;">*</span>
                    </td>
                    <td class="border-bottom">
	
                        <select name="plan_name" id="plan_name" class="getfields" style="width:300px;">
						<option value="">Select rate Plan</option>
						<?php if(isset($plan)){if($plan!=''){foreach($plan as $p){?>
						<option value="<?php echo $p->sup_apart_category_id;?>" <?php if(isset($cat_name1)){if($cat_name1 != ''){if($cat_name1 == $p->sup_apart_category_id){?> selected="selected"<?Php }}}?>><?php echo $p->category_name;?></option>
						<?php }}}?>
			</select>
                    <br/><span id="plan_name_err"></span></td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblCapacity">Capacity</span>
                        &nbsp;
                        <span id="ctl00_OptionalLinks_UpdatePanel_RequiredFieldValidator6" class="error" style="color:Red;visibility:hidden;">*</span>
                    </td>
                    <td class="border-bottom">
                        <select name="capacity" id="capacity" class="getfields" style="width:300px;">
						<option value="">select capacity</option>
						<?php for($i = 1; $i<=20;$i++){?>
						<option value="<?php echo $i;?>"<?php if(isset($rate)){if($rate!=''){if($rate->capacity == $i){?> selected="selected"<?php }}}?>><?php echo $i;?></option>
						<?php }?>
			</select>
                    <br/><span id="capacity_err"></span></td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblDefultMaxLenOfStay">Default Maximum Length of Stay</span>
                        &nbsp;
                       
                    </td>
                    <td class="border-bottom">
                        <input name="def_max"  id="def_max"  class="input-field" type="text"  style="width:300px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->max_stay;}}?>">
                        
                  <br/><span id="def_max_err"></span>  </td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblDefaultMinStay">Default Minimum Length of Stay</span>
                        &nbsp;
                       
                    </td>
                    <td class="border-bottom">
                        <input name="def_min" id="def_min" class="input-field" type="text"  style="width:300px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->mini_stay;}}?>">
                   <br/><span id="def_min_err"></span>     
                    </td>
                </tr>
		<tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblDefaultMinStay">Days Before Arrival</span>
                        &nbsp;
                       
                    </td>
                    <td class="border-bottom">
                        <input name="day_befr" id="day_befr" class="input-field" type="text"  style="width:300px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->days_before;}}?>">
                   <br/><span id="day_befr_err"></span>     
                    </td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblDefaultRate">Plan Rate per Night</span>
                    </td>
                    <td class="border-bottom">
                        <input name="rate" id="rate" class="input-field" type="text"  style="width:290px; background:#F2F2F2; padding-right:"value="<?php if(isset($rate)){if($rate!=''){ echo $rate->default_rate ;}}?>">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblCurS1"></span>
						<br/><span id="rate_err"></span>
                    </td>
                </tr>
                <tr style="display: none;">
                    <td style="border-right: 1px solid #f5f5f5;" width="33%">
                    </td>
                    <td class="border-bottom">
                        <span class="lables">
                            <span id="ctl00_OptionalLinks_UpdatePanel_xlblWeekendRate">Weekend Rate</span></span>
                        <input name="ctl00$OptionalLinks_UpdatePanel$xtxtWeekendRate" maxlength="5" id="ctl00_OptionalLinks_UpdatePanel_xtxtWeekendRate" disabled="disabled" class="input-field" onblur="return Rate(this.id)" style="width:267px;" type="text">
                        
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblCurS2" style="font-weight:bold;">£</span>
                    </td>
                </tr>
                <?php /*?><tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblTypeofBooking">Type of Booking</span>
                    </td>
                    <td class="border-bottom">
                        <select name="booking" id="booking" class="getfields" style="width:126px;">
						<option value="">Selecting booking type</option>
		<option value="E" <?php if(isset($rate)){if($rate!=''){if($rate->booking_type == 'E'){?> selected="selected"<?php }}}?>>Early Booking</option>
		<option value="L" <?php if(isset($rate)){if($rate!=''){if($rate->booking_type == 'L'){?> selected="selected"<?php }}}?>>Last-minute</option>
		<option value="S" <?php if(isset($rate)){if($rate!=''){if($rate->booking_type == 'S'){?> selected="selected"<?php }}}?>>Standard</option>

	</select>
                   <br/><span id="booking_err"></span> </td>
                </tr><?php */?>
               <tr>
                                        <td class="border-bottom border-right" width="33%">
                                            <span id="ctl00_OptionalLinks_UpdatePanel_xlblBreakfast">Breakfast</span>
                                        </td>
                                        <td class="border-bottom">
                                            <table id="ctl00_OptionalLinks_UpdatePanel_xradBreakFastOpts" border="0">
			<tbody><tr>
				<td><input id="breakfast" name="breakfast" value="E" type="radio" onclick="return breakfast_type_script(this.value);"  <?php if(isset($rate)){if($rate!=''){if($rate->breakfast == 'E'){?> checked="checked"<?php }}}?>>
				<label for="ctl00_OptionalLinks_UpdatePanel_xradBreakFastOpts_0"><span class="lables-move"> Excluded</span></label></td><td><input id="breakfast" name="breakfast" value="I"  type="radio" onclick="return breakfast_type_script(this.value);" <?php if(isset($rate)){if($rate!=''){if($rate->breakfast == 'I'){?> checked="checked"<?php }}}?>><label for="ctl00_OptionalLinks_UpdatePanel_xradBreakFastOpts_1"><span class="lables-move"> Included</span></label></td><td><input id="breakfast" name="breakfast" value="NO" type="radio" onclick="return breakfast_type_script(this.value);" <?php if(isset($rate)){if($rate!=''){if($rate->breakfast == 'NO'){?> checked="checked"<?php }}}?>><label for="ctl00_OptionalLinks_UpdatePanel_xradBreakFastOpts_2"><span class="lables-move" > Not offered</span></label><br/></td>
			</tr>
		</tbody></table>
                                        <span id="breakfast_err"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom border-right" width="33%">
                                            <span id="ctl00_OptionalLinks_UpdatePanel_xlblBreakfastType">Breakfast Type</span>
                                        </td>
                                        <td class="border-bottom">
                                         <select name="breakfast_type" id="breakfast_type" class="getfields" style="width:300px;">
										 <option value="">select breakfast type</option>
			<option value="Continental" <?php if(isset($rate)){if($rate!=''){if($rate->breakfast_type == 'Continental'){?> selected="selected"<?php }}}?>> Continental</option>
			<option value="Full English" <?php if(isset($rate)){if($rate!=''){if($rate->breakfast_type == 'Full English'){?> selected="selected"<?php }}}?>> Full English</option>

		</select>
                                        <br/><span id="breakfast_type_err"></span></td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom border-right" width="33%">
                                            <span id="ctl00_OptionalLinks_UpdatePanel_xlblBreakfastHoursfrom">Breakfast Hours from</span>
                                        </td>
                                        <td class="border-bottom">
                                            <select name="breakfastfrom" id="breakfastfrom" class="getfields" style="width:140px;">
			<?php if(isset($time)){if($time!=''){?>
		<option value="">select breakfast from</option>
	<?php foreach($time as $t){?>
	<option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rate)){if($rate!=''){if($rate->breakfast_from == $t->sup_apart_checktimes_value){?> selected="selected"<?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
	<?php }}}?>
	

		</select>
                                            <span class="lables-move">to</span>
                                            <select name="breakfastto" id="breakfastto" class="getfields" style="width:140px;">
			<?php if(isset($time)){if($time!=''){?>
		<option value="">select breakfast to</option>
	<?php
	foreach($time as $t){?>
	<option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rate)){if($rate!=''){if($rate->breakfast_to == $t->sup_apart_checktimes_value){?> selected="selected"<?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
	<?php }}}?>
	

		</select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border-bottom border-right" width="33%">
                                            <span id="ctl00_OptionalLinks_UpdatePanel_xlblCancellationPolicy">Cancellation Policy</span>
                                        </td>
                                        <td class="border-bottom">
                                            <span class="lables">
                                                <input id="cancellation" name="cancellation" value="1" type="radio" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 1){?> checked="checked"<?php }}}?>  onclick="return cancellation_policy(this.value);"> Percentage</span>
                                          
                                            <span style="padding-left: 12px">
                                                <input id="cancellation" name="cancellation" value="2" type="radio" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 2){?> checked="checked"<?php }}}?>   onclick="return cancellation_policy(this.value);"> Amount</span>
                                           
                                            <span style="padding-left: 12px">
                                                <input id="cancellation" name="cancellation" value="3" type="radio" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 3){?> checked="checked"<?php }}}?>  onclick="return cancellation_policy(this.value);"></span>
                                            <span class="lables">
                                                <span id="ctl00_OptionalLinks_UpdatePanel_xlblNonRefundable">Non-refundable</span></span>
                                                <br/><span id="err_cancellation"></span>
                                        </td>
                                    </tr>
                                    <tr  id="cancel_details_row" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 1 || $rate->policy_flag == 2 ){?> <?php }}else{?> style="display:none;"<?php }}?>>
                                        <td class="border-bottom border-right" width="33%">&nbsp;
                                            
                                        </td>
                                        <td class="border-bottom">
                                            <div id="ctl00_OptionalLinks_UpdatePanel_xpnlCancelpolicy">
			
                                                <table cellpadding="0" cellspacing="0" width="100%" >
                                                    <tbody><tr>
                                                       
                                                         <td <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 1 || $rate->policy_flag == 2 ){?>style="padding-left: 12px; vertical-align: middle;" <?php }}else{?> style="padding-left: 12px; vertical-align: middle; display:none;"<?php }}?>  width="10%" id="days_before">
                                                        <select name="cancellation_days" id="cancellation_days" class="getfields" style="width:90px;">
			
			<option  value="24:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '24:00'){?> selected="selected"<?php }}}?> >24 Hours</option>
			<option value="48:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '48:00'){?> selected="selected"<?php }}}?> >48 Hours</option>
			<option value="72:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '72:00'){?> selected="selected"<?php }}}?> >72 Hours</option>
			<option value="96:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '96:00'){?> selected="selected"<?php }}}?> >96 Hours</option>
			<option value="120:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '120:00'){?> selected="selected"<?php }}}?> >5 Days</option>
			<option value="144:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '144:00'){?> selected="selected"<?php }}}?> >6 Days</option>
			<option value="168:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '168:00'){?> selected="selected"<?php }}}?> >7 Days</option>
			<option value="192:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '192:00'){?> selected="selected"<?php }}}?> >8 Days</option>
			<option value="216:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '216:00'){?> selected="selected"<?php }}}?> >9 Days</option>
			<option value="240:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '240:00'){?> selected="selected"<?php }}}?> >10 Days</option>
			<option value="264:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '264:00'){?> selected="selected"<?php }}}?> >11 Days</option>
			<option value="288:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '288:00'){?> selected="selected"<?php }}}?> >12 Days</option>
			<option value="312:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '312:00'){?> selected="selected"<?php }}}?> >13 Days</option>
			<option value="336:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '336:00'){?> selected="selected"<?php }}}?> >14 Days</option>
			<option value="360:00" <?php if(isset($rate)){if($rate!=''){if($rate->hours1 == '360:00'){?> selected="selected"<?php }}}?> >15 Days</option>
			
		</select></td>
                                                         <td id="charge_percent_row"<?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 1 ){?> <?php }}else{?> style="display:none;"<?php }}?>>
                                                         
                                                           &nbsp;
                                                            <span class="lables"><span>
                                                               <select name="charge_percent" id="charge_percent" class="input-field" style="width:50px;"><?php for($i=1;$i<=100;$i++){?><option value="<?php echo $i;?>"><?php echo $i;?></option><?php }?></select>
                                                                %   <select name="per_night_percent" id="per_night_percent" class="getfields" style="width:90px;">
				<option value="1 night" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == '1 night'){?> selected="selected"<?php }}}?>>1 Night</option>
				<option value="2 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "2 nights"){?> selected="selected"<?php }}}?>>Upto 2 Nights</option>
				<option value="3 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "3 nights"){?> selected="selected"<?php }}}?>>Upto 3 Nights</option>
				<option value="4 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "4 nights"){?> selected="selected"<?php }}}?>>Upto 4 Nights</option>
				<option value="5 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "5 nights"){?> selected="selected"<?php }}}?>>Upto 5 Nights</option>
				<option value="6 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "6 nights"){?> selected="selected"<?php }}}?>>Upto 6 Nights</option>
				<option value="7 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "7 nights"){?> selected="selected"<?php }}}?>>Upto 7 Nights</option>

			</select></span></span>
                                                          
                                                        </td>
                                                        <td id="charge_rate_row" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 2 ){?> <?php }}else{?> style="display:none;"<?php }}?>>
                                                          
                                                           &nbsp;
                                                            <span class="lables"><span>
                                                               <input type="text" name="charge_rate" id="charge_rate" class="input-field" style="width:50px;"/>
                                                                <select name="per_night_price" id="per_night_price" class="getfields" style="width:90px;">
				<option value="1 night" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == '1 night'){?> selected="selected"<?php }}}?>>1 Night</option>
				<option value="2 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "2 nights"){?> selected="selected"<?php }}}?>>Upto 2 Nights</option>
				<option value="3 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "3 nights"){?> selected="selected"<?php }}}?>>Upto 3 Nights</option>
				<option value="4 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "4 nights"){?> selected="selected"<?php }}}?>>Upto 4 Nights</option>
				<option value="5 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "5 nights"){?> selected="selected"<?php }}}?>>Upto 5 Nights</option>
				<option value="6 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "6 nights"){?> selected="selected"<?php }}}?>>Upto 6 Nights</option>
				<option value="7 nights" <?php if(isset($rate)){if($rate!=''){if($rate->charge_nights  == "7 nights"){?> selected="selected"<?php }}}?>>Upto 7 Nights</option>

			</select></span></span>
                                                             
                                                        </td>
                                                    </tr>
                                                </tbody></table>
                                            
		</div>
                                      
                    </td>
                </tr>
                 <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblAdditionalCancellationComment">Bookings Instant or On Request</span>
                        &nbsp;
                    </td>
                    <td class="border-bottom" style="padding-left:15px;">
                       <input type="radio" name="type" value="1" <?php if(isset($rate)){if($rate != ''){if($rate->type_book == 1){?> checked="checked"<?php }}}?> />&nbsp; Instant&nbsp;  <input type="radio" name="type" value="0" <?php if(isset($rate)){if($rate != ''){if($rate->type_book == 0){?> checked="checked"<?php }}}?> />&nbsp; On Request
                    </td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" style="padding: 7px 10px; vertical-align: middle" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_Label2">Payment Policy :</span>&nbsp;
                    </td>
                    <td class="border-bottom" style="padding: 10px;">
                 
                   <table width="100%" cellpadding="0" cellspacing="0">
                   <tr>
                   <td>
                   <input type="radio" name="pre-payment" value="1" onclick="return pre_pay(this.value);"<?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 1){?> checked="checked"<?php }}}?><?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value != 3){?> disabled="disabled"<?php }}}?> /> &nbsp;Part-payment &nbsp;  <input type="radio" name="pre-payment" value="2" <?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 2){?> checked="checked"<?php }}}?><?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value != 3){?> disabled="disabled"<?php }}}?> onclick="return pre_pay(this.value);"  />&nbsp;  All &nbsp; <input type="radio" name="pre-payment" value="3"  onclick="return pre_pay(this.value);" <?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 3){?> checked="checked"<?php }}}?><?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value != 3){?> disabled="disabled"<?php }}}?> />&nbsp;  Pre-authorize </td>
                   </tr>
                   <tr id="perc" style="display:none">
                   <td style="width:250px;">Percentage of total</td>
                   <td><input type="text" name="percentage" value="<?php if(isset($pre)){if($pre != ''){ echo $pre->total_percentage;}}?> "   />&nbsp;%</td>
                   </tr>
                   <tr id="amount" style="display:none">
                   <td style="width:250px;">Fixed Amount</td>
                   <td><input type="text" name="amount"  value="<?php if(isset($pre)){if($pre != ''){ echo $pre->total_amount;}}?> " /></td>
                   </tr>
                   </table>
                
                   
                   
                   </td>
                </tr>
                <?php /*?><tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblAdditionalCancellationComment">Additional Cancellation Comment</span>
                        &nbsp;
                    </td>
                    <td class="border-bottom">
                        <textarea name="cancel_details" rows="2" cols="20" id="cancel_details" class="input-field"><?php if(isset($rate)){if($rate!=''){ echo $rate->cancel_comments  ;}}?></textarea>
                    </td>
                </tr><?php */?>
                  <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Security Deposit:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  <input type="radio" name="security_deposit"  value="1" <?php if(isset($rules)){if($rules != ''){if($rules->security_deposit == 1){?> checked="checked"<?php }}}?> onclick="return security_deposit_show(this.value);" />&nbsp; Security Deposit &nbsp;<input type="radio" name="security_deposit" value="2"  onclick="return security_deposit_show(this.value);"  /> &nbsp;Not Required
				<br/><span id="err_currency"></span>
                </td>
            </tr>
             <tr id="method_display"  style="display:none;">
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span ></span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
 <input type="radio" name="deposit_method" value="1" onclick="return deposit_method_show(this.value);" <?php if(isset($rules)){if($rules != ''){if($rules->deposit_method == 1){?> checked="checked"<?php }}}?>    /> &nbsp; Credit Card &nbsp;
 <input type="radio" name="deposit_method" value="2" onclick="return deposit_method_show(this.value);" <?php if(isset($rules)){if($rules != ''){if($rules->deposit_method == 2){?> checked="checked"<?php }}}?>/> &nbsp; Percentage &nbsp;
 <input type="radio" name="deposit_method" value="3" onclick="return deposit_method_show(this.value);" <?php if(isset($rules)){if($rules != ''){if($rules->deposit_method == 3){?> checked="checked"<?php }}}?>/> &nbsp; Amount &nbsp;
				<br/><span id="err_currency"></span>
                </td>
            </tr>
            
            <tr id="percentage" style="display:none;">
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span ></span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
 <input type="tesx" name="percentage_val" class="getfields" style="width:150px;" value="<?php if(isset($rules)){if($rules != ''){if($rules->percentage_val != ''){echo $rules->percentage_val;}}}?>" /> % 
 <select name="per_days" >
 <option value="1 Night" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "1 Night" ){?> selected="selected" <?php }}}}?>>1 Night</option>
 <option value="2 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "2 Nights" ){?> selected="selected" <?php }}}}?>>2 Nights</option>
<option value="3 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "3 Nights" ){?> selected="selected" <?php }}}}?>>3 Nights</option>
<option value="4 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "4 Nights" ){?> selected="selected" <?php }}}}?>>4 Nights</option>
<option value="5 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "5 Nights" ){?> selected="selected" <?php }}}}?>>5 Nights</option>
 <option value="6 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "6 Nights" ){?> selected="selected" <?php }}}}?>>6 Nights</option>
<option value="1 Week" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "1 Week" ){?> selected="selected" <?php }}}}?>>1 Week</option>
<option value="2 Weeks" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "2 Weeks" ){?> selected="selected" <?php }}}}?>>2 Weeks</option>
<option value="1 Month" <?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "1 Month" ){?> selected="selected" <?php }}}}?>>1 Month</option>
<option value="2 Months<?php if(isset($rules)){if($rules != ''){if($rules->per_days != ''){if($rules->per_days == "2 Months" ){?> selected="selected" <?php }}}}?>">2 Months</option>
 </select>
				<br/><span id="err_currency"></span>
                </td>
            </tr>
            <tr style="display:none;" id="amount_sec">
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span ></span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
  <input type="tesx" name="amount_val" class="getfields" style="width:150px;" value="<?php if(isset($rules)){if($rules != ''){if($rules->amount_val != ''){echo $rules->amount_val;}}}?>"  />
  <select name="amt_days" >
<option value="1 Night" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "1 Night" ){?> selected="selected" <?php }}}}?>>1 Night</option>
 <option value="2 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "2 Nights" ){?> selected="selected" <?php }}}}?>>2 Nights</option>
<option value="3 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "3 Nights" ){?> selected="selected" <?php }}}}?>>3 Nights</option>
<option value="4 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "4 Nights" ){?> selected="selected" <?php }}}}?>>4 Nights</option>
<option value="5 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "5 Nights" ){?> selected="selected" <?php }}}}?>>5 Nights</option>
 <option value="6 Nights" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "6 Nights" ){?> selected="selected" <?php }}}}?>>6 Nights</option>
<option value="1 Week" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "1 Week" ){?> selected="selected" <?php }}}}?>>1 Week</option>
<option value="2 Weeks" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "2 Weeks" ){?> selected="selected" <?php }}}}?>>2 Weeks</option>
<option value="1 Month" <?php if(isset($rules)){if($rules != ''){if($rules->amt_days != ''){if($rules->amt_days == "1 Month" ){?> selected="selected" <?php }}}}?>>1 Month</option>
<option value="2 Months<?php if(isset($rules)){if($rules != ''){if($rules->deposit_method != ''){if($rules->amt_days == "2 Months" ){?> selected="selected" <?php }}}}?>">2 Months</option>
 </select> 
				<br/><span id="err_currency"></span>
                </td>
            </tr>
                 <tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblAdditionalCancellationComment">Date Range</span>
                        &nbsp;
                    </td>
                   
                       <td class="border-bottom">
                        From<input name="stdate" id="stdate" class="input-field" type="text"  style="width:100px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ list($y1,$m1,$d1) = explode('-',$rate->startdate); echo $d1.'/'.$m1.'/'.$y1;}}?>">
                        To<span id="out"><input name="eddate" id="eddate" class="input-field" type="text" value="<?php if(isset($rate)){if($rate!=''){ list($y,$m,$d) = explode('-',$rate->enddate); echo $d.'/'.$m.'/'.$y;}}?>"  style="width:100px; background:#F2F2F2;" value=""></span><br/><span id="err_stdate"></span>
                   <br/><span id="default_avail_err"></span>     
                    </td>
                   
                </tr>
				<tr>
                    <td class="border-bottom border-right" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_xlblAdditionalCancellationComment">Remarks(Optinal)</span>
                        &nbsp;
                    </td>
                    <td class="border-bottom">
                        <textarea name="remarks_room" rows="2" cols="20" id="remarks_room" class="input-field"><?php if(isset($rate)){if($rate!=''){ echo $rate->rate_remarks;}}?></textarea>
                    </td>
                </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="" type="submit" value=""  class="login-inner-save" style="background-color:transparent !important; border:none !important; height:51px;" />
     </td>
            </tr>
            </tbody>
        </table>
        </form>
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>
