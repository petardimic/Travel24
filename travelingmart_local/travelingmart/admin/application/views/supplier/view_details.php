<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Rate Details</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery-1.4.3.min.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<?php /*?><script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script><?php */?><script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<?php // echo "<pre>"; print_r($rate);exit;?>
<script type="text/javascript">
$(document).ready(function()
{
	$(document).ready(function()
{
	<?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value == 1 || $pos->payment_process_value == 2){?>
		document.getElementById('pre_payment1').disabled = true;
		document.getElementById('pre_payment2').disabled = true;
	<?php }}}?>
	<?php if(isset($rate)){if($rate != ''){ if($rate->security_deposit == 1){?>
	
$('#method_display').show();
<?php }}}else{?> 
$('#method_display').hide();

<?php }?>
<?php if(isset($rate)){if($rate != ''){if($rate->deposit_method == 2){?>
$('#percentage').show();
<?php }elseif($rate->deposit_method == 3){?>
$('#amount_sec').show();
$('#anmount_drop_hide').hide();
<?php }
}}else{?>
$('#percentage').hide();
$('#anmount_drop_hide').hide();
$('#amount_sec').hide();
<?php }?>
});
$('#rate_plan').watermark("standard");
$('#default_avail').watermark("10");
$('#def_max').watermark("15");
$('#def_min').watermark("1");
$('#rate').watermark("200");
<?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 1){?> 
$('#perc').show();
		$('#amount').show();
<?php }}}?> 
<?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 1){?>
$('#charge_rate_row').hide();

<?php }else if($rate->policy_flag == 2) {?>
	$('#charge_percent_row').hide();
<?php }else{?>
	$('#cancel_details_row').hide();
<?php }}}?>
<?php if(isset($rate)){if($rate!=''){if($rate->breakfast == 'E' || $rate->breakfast == 'I'){?>
document.getElementById('breakfast_type').disabled = false;
document.getElementById('breakfastfrom').disabled = false;
document.getElementById('breakfastto').disabled = false;
<?php }else{?>
document.getElementById('breakfast_type').disabled = true;
document.getElementById('breakfastfrom').disabled = true;
document.getElementById('breakfastto').disabled = true;
<?php }}}?>
document.getElementById('plan_name').disabled = true;
});
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
		$('#anmount_drop_hide').show();
	}
	else if(val == 3)
	{
		$('#percentage').hide();
		$('#amount_sec').show();
		$('#anmount_drop_hide').hide();
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
<script type="text/javascript">
function popup_close()
{
	$('#login-box').hide();
	$('#mask').hide();
}
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
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
$(document).ready(function(){
						
			$('.popup').css('display','none');
			$('.popup1').css('display','none');
			$('.eassy-popup').css('display','none');
			$('.categories-icon li').click(function(){
				$('.popup').css('display','block');				
				}); 
			$('.featured-icon li').click(function(){
				$('.popup').css('display','block');	
				$('.popup1').css('display','none');				
				});
			$('.categories-icon span').click(function(){
				$('.popup1').css('display','block');				
				});
			$('.popup div').click(function(){
				$('.popup').css('display','none');				
				});
			$('.popup1 span').click(function(){
				$('.popup1').css('display','none');				
				});
			$("#eassy-step").hover(
			    function () {
				  $('.eassy-popup').css('display','block');
			    }, 
			    function () {
			      $('.eassy-popup').css('display','none');
			    }
			);
			$('#add_option1 input:radio').click(function(){
				var value = $(this).val();
				$('#testinput').val(value);
			}); 
					
		});
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
			try{			
				xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e){
				try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
				}
				catch(e1){
					xmlhttp=false;
				}
			}
		}
		 	
		return xmlhttp;
    }
function delete_pic(id)
{

	if(confirm('Are you sure want to delete this Picture?'))
	{
		$('#pic'+id).hide();
		var strURL="<?php echo WEB_URL?>supplier/delete_planpicture/"+id;
		// alert(strURL);
		 var req = getXMLHTTP();
		 if (req) {
		
					
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							
							if (req.status == 200) {	
											
								var s=req.responseText;	
								if(s !='')
								{
									//alert(s);
								}					
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}				
					}			
					req.open("GET", strURL, true);
					req.send(null);
				}
	}
	else
	{
		return false;
	}			
}
function facilities()
{

	var valcheck3 = [];
	var selectedVariants1 = $("input[name=htlfcltycb1]:checked").serializeArray();
	jQuery.each(selectedVariants1, function(j, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck3[j] = field.value;
    });
	//alert(valcheck3);
	$('#roomfec_val1').val('');
	$('#roomfec_val1').val(valcheck3);
	/*alert(valcheck2);
	alert($('#roomfec_val').val(valcheck2));*/
	if(valcheck2 != ""){
   		return true;
	}
	
	return false;
}
</script>
<style type="text/css">

a { 
	text-decoration:none; 
	/*color:#00c6ff;*/
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
	background: #333;
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
	width:214px;
}

.button:hover { background:#ddd; }

</style>

</head>
<body>

<div class="wrapper">
    <!-- Top navigation bar -->
   <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

    <!--<div id="sidebar-position">
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
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Rate Plan Details</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>
                </div>-->
              

<div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Rate Plan Details<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
 <form name="rate_details" id="rate_details" action="<?php echo WEB_URL_ADMIN?>supplier/update_rate_details/<?php if(isset($rate)){if($rate!=''){ echo $rate->sup_apart_rateplan_id;}}?>" method="post" onsubmit="return facilities();">
  <input type="hidden" id="roomfec_val1" name="roomfec_val1" value=""/>
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
						<option value="<?php echo $p->sup_apart_category_id;?>" <?php if(isset($rate)){ if($rate!=''){if($p->sup_apart_category_id == $rate->sup_apart_category_id){?> selected="selected" <?php }}}?>><?php echo $p->category_name;?></option>
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
                        <input name="rate" id="rate" class="input-field" type="text"  style="width:290px; background:#F2F2F2;"value="<?php if(isset($rate)){if($rate!=''){ echo $rate->default_rate ;}}?>">
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
               <?php /*?> <tr>
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
                                                <input id="cancellation" name="cancellation" value="1" type="radio" onclick="return cancellation_policy(this.value);" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 1){?> checked="checked"<?php }}}?>> Percentage</span>
                                          
                                            <span style="padding-left: 12px">
                                                <input id="cancellation" name="cancellation" value="2" type="radio"  onclick="return cancellation_policy(this.value);" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 2){?> checked="checked"<?php }}}?>> Amount</span>
                                           
                                            <span style="padding-left: 12px">
                                                <input id="cancellation" name="cancellation" value="3" type="radio"  onclick="return cancellation_policy(this.value);" <?php if(isset($rate)){if($rate!=''){if($rate->policy_flag == 3){?> checked="checked"<?php }}}?>></span>
                                            <span class="lables">
                                                <span id="ctl00_OptionalLinks_UpdatePanel_xlblNonRefundable">Non-refundable</span></span>
                                                <br/><span id="err_cancellation"></span>
                                        </td>
                                    </tr>
                                    <tr  id="cancel_details_row">
                                        <td class="border-bottom border-right" width="33%">&nbsp;
                                            
                                        </td>
                                        <td class="border-bottom">
                                            <div id="ctl00_OptionalLinks_UpdatePanel_xpnlCancelpolicy">
			
                                                <table cellpadding="0" cellspacing="0" width="100%" >
                                                    <tbody><tr>
                                                       
                                                         <td style="padding-left: 12px; vertical-align: middle;" width="10%" id="days_before">
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
                                                        <td id="charge_percent_row">
                                                           &nbsp;
                                                            <span class="lables"><span>
                                                               <select name="charge_percent" id="charge_percent" class="input-field" style="width:50px;"><?php for($i=1;$i<=100;$i++){?><option value="<?php echo $i;?>" <?php if(isset($rate)){if($rate!=''){if($rate->charge_persent == $i){?> selected="selected"<?php }}}?>><?php echo $i;?></option><?php }?></select>
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
                                                        <td id="charge_rate_row">
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

			</select>
</span></span>
                                                             
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
                       <input type="radio" name="type_book" value="1" <?php if(isset($rate)){if($rate != ''){ if($rate->type_book == 1){?> checked="checked"<?php }}}?> />&nbsp; Instant&nbsp;  <input type="radio" name="type_book" value="0"<?php if(isset($rate)){if($rate != ''){ if($rate->type_book == 0){?> checked="checked"<?php }}}?> />&nbsp; On Request
                    </td>
                </tr>
                <tr>
                    <td class="border-bottom border-right" style="padding: 7px 10px; vertical-align: middle" width="33%">
                        <span id="ctl00_OptionalLinks_UpdatePanel_Label2">Payment Policy :</span>&nbsp;
                    </td>
                    <td class="border-bottom" style="padding: 10px;">
                  
                   <table width="100%" cellpadding="0" cellspacing="0">
                   <tr>
                   <td><input type="radio" name="pre_payment" id="pre_payment1" value="1" onclick="return pre_pay(this.value);"<?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 1){?> checked="checked"<?php }}}?>/> &nbsp; Part-payment&nbsp;  <input type="radio" name="pre_payment" value="2" onclick="return pre_pay(this.value);" id="pre_payment2"  <?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 2){?> checked="checked"<?php }}}?> /> &nbsp; All &nbsp;  <input type="radio" name="pre_payment" value="3"  onclick="return pre_pay(this.value);" <?php if(isset($pre)){if($pre != ''){ if($pre->type_book == 3){?> checked="checked"<?php }}}?> />&nbsp;  Pre-authorize </td>
                   </tr>
                   <tr id="perc" style="display:none">
                   <td style="width:250px;">Percentage of total</td>
                   <td><input type="text" name="percentage" value="<?php if(isset($pre)){if($pre != ''){ echo $pre->total_percentage;}}?> "  />&nbsp;%</td>
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
                  <input type="radio" name="security_deposit"  value="1" <?php if(isset($rate)){if($rate != ''){if($rate->security_deposit == 1){?> checked="checked"<?php }}}?> onclick="return security_deposit_show(this.value);" />&nbsp; Security Deposit &nbsp;<input type="radio" name="security_deposit" value="2"  onclick="return security_deposit_show(this.value);" <?php if(isset($rate)){if($rate != ''){if($rate->security_deposit == 2){?> checked="checked"<?php }}}?>   /> &nbsp;Not Required
				<br/><span id="err_currency"></span>
                </td>
            </tr>
             <tr id="method_display"  style="display:none;">
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span ></span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
 <input type="radio" name="deposit_method" value="1" onclick="return deposit_method_show(this.value);" <?php if(isset($rate)){if($rate != ''){if($rate->deposit_method == 1){?> checked="checked"<?php }}}?>    /> &nbsp; Credit Card &nbsp;
 <input type="radio" name="deposit_method" value="2" onclick="return deposit_method_show(this.value);" <?php if(isset($rate)){if($rate != ''){if($rate->deposit_method == 2){?> checked="checked"<?php }}}?>/> &nbsp; Percentage &nbsp;
 <input type="radio" name="deposit_method" value="3" onclick="return deposit_method_show(this.value);" <?php if(isset($rate)){if($rate != ''){if($rate->deposit_method == 3){?> checked="checked"<?php }}}?>/> &nbsp; Amount &nbsp;
				<br/><span id="err_currency"></span>
                </td>
            </tr>
            
            <tr id="percentage" style="display:none;">
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span ></span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
 <input type="tesx" name="percentage_val" class="getfields" style="width:150px;" value="<?php if(isset($rate)){if($rate != ''){if($rate->percentage_val != ''){echo $rate->percentage_val;}}}?>" /> % 
 <select name="per_days" >
 <option value="1 Night" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "1 Night" ){?> selected="selected" <?php }}}}?>>1 Night</option>
 <option value="2 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "2 Nights" ){?> selected="selected" <?php }}}}?>>2 Nights</option>
<option value="3 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "3 Nights" ){?> selected="selected" <?php }}}}?>>3 Nights</option>
<option value="4 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "4 Nights" ){?> selected="selected" <?php }}}}?>>4 Nights</option>
<option value="5 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "5 Nights" ){?> selected="selected" <?php }}}}?>>5 Nights</option>
 <option value="6 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "6 Nights" ){?> selected="selected" <?php }}}}?>>6 Nights</option>
<option value="1 Week" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "1 Week" ){?> selected="selected" <?php }}}}?>>1 Week</option>
<option value="2 Weeks" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "2 Weeks" ){?> selected="selected" <?php }}}}?>>2 Weeks</option>
<option value="1 Month" <?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "1 Month" ){?> selected="selected" <?php }}}}?>>1 Month</option>
<option value="2 Months<?php if(isset($rate)){if($rate != ''){if($rate->per_days != ''){if($rate->per_days == "2 Months" ){?> selected="selected" <?php }}}}?>">2 Months</option>
 </select>
				<br/><span id="err_currency"></span>
                </td>
            </tr>
            <tr style="display:none;" id="amount_sec">
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span ></span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
  <input type="tesx" name="amount_val" class="getfields" style="width:150px;" value="<?php if(isset($rate)){if($rate != ''){if($rate->amount_val != ''){echo $rate->amount_val;}}}?>"  />
  <select name="amt_days" id="anmount_drop_hide" >
<option value="1 Night" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "1 Night" ){?> selected="selected" <?php }}}}?>>1 Night</option>
 <option value="2 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "2 Nights" ){?> selected="selected" <?php }}}}?>>2 Nights</option>
<option value="3 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "3 Nights" ){?> selected="selected" <?php }}}}?>>3 Nights</option>
<option value="4 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "4 Nights" ){?> selected="selected" <?php }}}}?>>4 Nights</option>
<option value="5 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "5 Nights" ){?> selected="selected" <?php }}}}?>>5 Nights</option>
 <option value="6 Nights" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "6 Nights" ){?> selected="selected" <?php }}}}?>>6 Nights</option>
<option value="1 Week" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "1 Week" ){?> selected="selected" <?php }}}}?>>1 Week</option>
<option value="2 Weeks" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "2 Weeks" ){?> selected="selected" <?php }}}}?>>2 Weeks</option>
<option value="1 Month" <?php if(isset($rate)){if($rate != ''){if($rate->amt_days != ''){if($rate->amt_days == "1 Month" ){?> selected="selected" <?php }}}}?>>1 Month</option>
<option value="2 Months<?php if(isset($rate)){if($rate != ''){if($rate->deposit_method != ''){if($rate->amt_days == "2 Months" ){?> selected="selected" <?php }}}}?>">2 Months</option>
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
                        From<input name="stdate" id="stdate" class="input-field" type="text"  style="width:100px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->startdate;}}?>"/>
                        To<span id="out"><input name="eddate" id="eddate" class="input-field" type="text"  style="width:100px; background:#F2F2F2;" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->enddate;}}?>"></span><br/><span id="err_stdate"></span>
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
            <?php /*?><tr><td colspan="4" id="inner-span-heading">
 <span class="inner-heading" >Plan Pictures:</span><div style="text-align:right; padding-bottom:5px; font-weight:bold; border-bottom:2px #666 solid;">  Upload a valid file with extension JPG, JPEG, PNG.     | <a href="#login-box" class="login-window"><img src="<?php echo WEB_DIR?>supplier_includes/images/up-load.png" width="122" height="24" border="0" style="margin:0px 5px 0 0; vertical-align:top;" /></a></div>
</td></tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
               
     </td>
            </tr><?php */?>
            </tbody>
        </table>
        <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		<?php  $k=1;
		if(isset($pic)){ if($pic != '') { ?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="100%">
				<?php foreach($pic as $p){ ?>
                 <div class="image-box" id="pic<?php echo $p->sup_apart_plapictures_id;?>">
                 <div>
                 <img src="<?php echo WEB_DIR?>uploadroomimage/<?php echo $p->image_name;?>" width="185" height="120" border="0" style="margin:4px;" />
                 <div class="checkbox-bg">
                 <span style="float:left; margin-top:2px;">
				 <input name="htlfcltycb1" id="htlfcltycb1" type="checkbox" <?php if($p->status == 1){?> checked="checked" <?php }?> value="<?php echo $p->sup_apart_plapictures_id;?>" /></span>
                 <span style=" float:left;">
				 <img src="<?php echo WEB_DIR?>supplier_includes/images/minus.png" width="18" height="18" border="0" style="vertical-align:top; margin-left:5px;" onclick="return delete_pic('<?php echo $p->sup_apart_plapictures_id;?>');"/></span>
                 </div>
                 <div ><textarea name="cmnts1_<?php echo $p->sup_apart_plapictures_id; ?>" id="cmnts1_<?php echo $p->sup_apart_plapictures_id; ?>" cols="" rows="" class="text-box-bg"><?php echo $p->title;?></textarea></div>
                 </div>
                 </div>
                 <?php }?>
                </td>
				<?php if($k%4 == 0){
							echo "</tr><tr>";
						}
						?>
              <?php $k++;?> 
            </tr>
			<?php }}?>
			<tr>
				<td colspan="5" align="left" style="border-top:#ccc 1px solid;">
               
                <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>
            
        </tbody>
    </table>
        </form>
        <?php /*?><div id="login-box" class="login-popup" style="height:150px; background-color:#F4F4F4;">
       <img src="<?php echo WEB_DIR; ?>images/close_pop.png" id="close" onclick="return popup_close();" style="cursor:pointer;" class="btn_close" title="Close Window" alt="Close" />
         
	<form name="pic_browse" method="post" class="signin" action="<?php echo WEB_URL_ADMIN?>supplier/upload_plan_picture" enctype="multipart/form-data">
                
                <input type="hidden" name="room_id" value="<?php if(isset($rate)){if($rate!=''){ echo $rate->sup_apart_rateplan_id;}}?>" />
                <p style="color:#000;">
                Instruction: browse your files and select the pictures to upload. Check the color of the border on this screen to identify their quality.<br>Tip: high resolution images (at least 800 x 600 pixels) will help your hotel convert better, which means even more bookings!    <br/>
                <br><input type="file" id="image1" name="image1">
                </p><br />
                <div style="text-align:center">
         <input name="" type="submit" value=""  class="login-inner-save" />
         </div><?php */?>
          </form>
		</div>
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>
