<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - General Settings</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
</head>

<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<script type="text/javascript">
$(document).ready(function() 
		{
					
		$('#checkout_hr').watermark("12:00");
		$("#checkin_hr").watermark("12:00");

	<?php if(isset($tax)){if($tax!=''){ if($tax->state_tax == 1 || $tax->state_tax == 2){?> $('#state_tax_div').show(); <?php }}}?>	
	<?php if(isset($tax)){if($tax!=''){ if($tax->city_tax == 1 || $tax->city_tax == 2){?> $('#city_tax_div').show(); <?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->room_tax == 1 || $tax->room_tax == 2){?> $('#room_tax_div').show(); <?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->vat_tax == 1 || $tax->vat_tax == 2){?> $('#vat_tax_div').show(); <?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->service_tax == 1 || $tax->service_tax == 2){?> $('#service_tax_div').show(); <?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->state_totalstay_flag == 1){?> 
		document.getElementById("state_persons").disabled = true;
		document.getElementById("state_price").readOnly = true;
		document.getElementById("state_percentage_val").readOnly = false; 
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->state_fixedprice_flag == 1){?> 
		document.getElementById("state_persons").disabled = false;
		document.getElementById("state_price").readOnly = false;
		document.getElementById("state_percentage_val").readOnly = true; 
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->city_totalstay_flag == 1){?> 
		document.getElementById("city_persons").disabled = true;
		document.getElementById("city_price").readOnly = true;
		document.getElementById("city_percentage_val").readOnly = false;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->city_fixedprice_flag == 1){?> 
		document.getElementById("city_persons").disabled = false;
		document.getElementById("city_price").readOnly = false;
		document.getElementById("city_percentage_val").readOnly = true;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->room_totalstay_flag == 1){?> 
		document.getElementById("room_persons").disabled = true;
		document.getElementById("room_price").readOnly = true;
		document.getElementById("room_percentage_val").readOnly = false;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->room_fixedprice_flag == 1){?> 
		document.getElementById("room_persons").disabled = false;
		document.getElementById("room_price").readOnly = false;
		document.getElementById("room_percentage_val").readOnly = true;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->vat_totalstay_flag == 1){?> 
		document.getElementById("vat_persons").disabled = true;
		document.getElementById("vat_price").readOnly = true;
		document.getElementById("vat_percentage_val").readOnly = false;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->vat_fixedprice_flag == 1){?> 
		document.getElementById("vat_persons").disabled = false;
		document.getElementById("vat_price").readOnly = false;
		document.getElementById("vat_percentage_val").readOnly = true;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->service_totalstay_flag == 1){?> 
		document.getElementById("service_persons").disabled = true;
		document.getElementById("service_price").readOnly = true;
		document.getElementById("service_percentage_val").readOnly = false;
	<?php }}}?>
	<?php if(isset($tax)){if($tax!=''){ if($tax->service_fixedprice_flag == 1){?> 
		document.getElementById("service_persons").disabled = false;
		document.getElementById("service_price").readOnly = false;
		document.getElementById("service_percentage_val").readOnly = true;
	<?php }}}?>
});
</script>
<script type="text/javascript">

function facilities()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=htlfcltycb]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	/*alert(valcheck2);
	alert($('#apartfec_val').val(valcheck2));*/
	if(valcheck2 != ""){
   		return true;
	}
	
	return false;
}
</script>
<script type="text/javascript">
function state_tax_val(val)
{
	if(val == 1 || val == 2)
	{
		$('#state_tax_div').show();
	}
	else
	{
		$('#state_tax_div').hide();
	}
}
function state_percentage_val_script(val)
{
	if(val == 1)
	{
		//$('#state_price').css('readonly','true');
		document.getElementById("state_persons").disabled = true;
		document.getElementById("state_price").readOnly = true;
		document.getElementById("state_percentage_val").readOnly = false;
		//$('#state_persons').css('readonly','true');
	}
	else
	{
		document.getElementById("state_persons").disabled = false;
		document.getElementById("state_price").readOnly = false;
			document.getElementById("state_percentage_val").readOnly = true;
	}
}
function city_tax_val(val)
{
	if(val == 1 || val == 2)
	{
		$('#city_tax_div').show();
	}
	else
	{
		$('#city_tax_div').hide();
	}
}
function city_percentage_val_script(val)
{
	if(val == 1)
	{
		//$('#state_price').css('readonly','true');
		document.getElementById("city_persons").disabled = true;
		document.getElementById("city_price").readOnly = true;
		document.getElementById("city_percentage_val").readOnly = false;
		//$('#state_persons').css('readonly','true');
	}
	else
	{
		document.getElementById("city_persons").disabled = false;
		document.getElementById("city_price").readOnly = false;
			document.getElementById("city_percentage_val").readOnly = true;
	}
}
function room_tax_val(val)
{
	if(val == 1 || val == 2)
	{
		$('#room_tax_div').show();
	}
	else
	{
		$('#room_tax_div').hide();
	}
}
function room_percentage_val_script(val)
{
	if(val == 1)
	{
		//$('#state_price').css('readonly','true');
		document.getElementById("room_persons").disabled = true;
		document.getElementById("room_price").readOnly = true;
		document.getElementById("room_percentage_val").readOnly = false;
		//$('#state_persons').css('readonly','true');
	}
	else
	{
		document.getElementById("room_persons").disabled = false;
		document.getElementById("room_price").readOnly = false;
			document.getElementById("room_percentage_val").readOnly = true;
	}
}
function vat_tax_val(val)
{
	if(val == 1 || val == 2)
	{
		$('#vat_tax_div').show();
	}
	else
	{
		$('#vat_tax_div').hide();
	}
}
function vat_percentage_val_script(val)
{
	if(val == 1)
	{
		//$('#state_price').css('readonly','true');
		document.getElementById("vat_persons").disabled = true;
		document.getElementById("vat_price").readOnly = true;
		document.getElementById("vat_percentage_val").readOnly = false;
		//$('#state_persons').css('readonly','true');
	}
	else
	{
		document.getElementById("vat_persons").disabled = false;
		document.getElementById("vat_price").readOnly = false;
		document.getElementById("vat_percentage_val").readOnly = true;
	}
}
function service_tax_val(val)
{
	if(val == 1 || val == 2)
	{
		$('#service_tax_div').show();
	}
	else
	{
		$('#service_tax_div').hide();
	}
}
function service_percentage_val_script(val)
{
	if(val == 1)
	{
		//$('#state_price').css('readonly','true');
		document.getElementById("service_persons").disabled = true;
		document.getElementById("service_price").readOnly = true;
		document.getElementById("service_percentage_val").readOnly = false;
		//$('#state_persons').css('readonly','true');
	}
	else
	{
		document.getElementById("service_persons").disabled = false;
		document.getElementById("service_price").readOnly = false;
		document.getElementById("service_percentage_val").readOnly = true;
	}
}
</script>
<body>
<div class="wrapper">

    <!-- Top navigation bar -->
      <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

   <!-- <div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div>--><!--sidebar-position-->
    <!-- Content wrapper -->
   <!-- <div class="wrapper">
        <!-- Content -->
       <!-- <div class="content">
            <!-- Dynamic table -->
            <!--<div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">General Settings </span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                
                                </h5>
                        </div>
                    </div>
                </div>-->
                
    <div style="display: none;" id="ctl00_DescriptionHolder_XpnlSuccess">
	
                <div align="center">
                    <div class="status_msg">
                        <strong>SUCCESS: </strong>All Details Saved / Updated Successfully
                    </div>
                </div>
            
</div>
            

                <div class="error-text">
                </div>
                
                
    <div id="ctl00_OptionalLinks_UpdatePanel_upConfirmation">
	
            
        
</div>
<div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">General Settings 
        <span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
<form action="<?php echo WEB_URL_ADMIN?>supplier/insert_general_settings" id="general_settings" method="post" onsubmit="return facilities();">
 
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                 <div class="fix">&nbsp;</div>
                    <span >Check-in is possible :</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                <div class="fix">&nbsp;</div>
                   
                  From: <select name="checkin_from" id="checkin_from" class="subgetselectfields" style="width:100px;">
	<option value="">Not Aplicable</option>
    <option value="After" <?php if(isset($general)){if($general!=''){if($general->checkinfrom  == 'After'){?> selected="selected" <?php }}}?>>After</option>
	<?php if(isset($time)){if($time!=''){
	foreach($time as $t){?>
	<option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($general)){if($general!=''){if($general->checkinfrom  == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
	<?php }}}?>
	

</select> To <select name="checkin_to" id="checkin_to" class="subgetselectfields" style="width:100px;">
	<option value="">Not Aplicable</option>
	<?php if(isset($time)){if($time!=''){
	foreach($time as $t){?>
	<option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($general)){if($general!=''){if($general->checkinto   == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
	<?php }}}?>

</select>   (24-hour time display)<br/><span id="checkin_from_err"></span><span id="checkin_to_err"></span>
			</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Check-out is possible:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                  From <select name="checkout_from" id="checkout_from" class="subgetselectfields" style="width:100px;">
	<option value="">Not Aplicable</option>
    <option value="Before" <?php if(isset($general)){if($general!=''){if($general->checkoutfrom  == 'Before'){?> selected="selected" <?php }}}?>>Before</option>
	<?php if(isset($time)){if($time!=''){
	foreach($time as $t){?>
	<option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($general)){if($general!=''){if($general->checkoutfrom == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
	<?php }}}?>

</select>  To <select name="checkout_to" id="checkout_to" class="subgetselectfields" style="width:100px;">
	<option value="">Not Aplicable</option>
    
	<?php if(isset($time)){if($time!=''){
	foreach($time as $t){?>
	<option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($general)){if($general!=''){if($general->checkoutto == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
	<?php }}}?>
</select> (24-hour time display)<br/><span id="checkout_from_err"></span>&nbsp;&nbsp;<span id="checkout_to_err"></span>
                </td>
            </tr>
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="inner-heading">Check-in/Check-Out Automation: </span>
               </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                     
                   
                </td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Automatically check-in guest after</span> 
                </td>
                
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input name="checkin_hr" id="checkin_hr" class="getfields" style="width:314px;" type="text" value="<?php if(isset($general)){if($general!=''){ echo $general->checkin_after;}}?>">  hours
				    <br/><span id="checkin_hr_err"></span>
                </td>
				
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Automatically check-out guest after</span>                </td>
              
                <td style="border-bottom:1px solid #dcdcdc;">
                  <input name="checkout_hr" id="checkout_hr" class="getfields" style="width:314px;" type="text" value="<?php if(isset($general)){if($general!=''){ echo $general->checkout_after ;}}?>">  hours
				  <br/><span id="checkout_hr_err"></span>
                </td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Key Collection:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;"><input type="radio" name="collection" value="1" <?php if(isset($general)){if($general!=''){ if($general->key_collection == 1){?> checked="checked" <?php }}}?>   />
                <label for="radio"> </label> On-Site &nbsp; &nbsp; <input name="collection" type="radio" value="2" <?php if(isset($general)){if($general!=''){ if($general->key_collection == 2){?> checked="checked" <?php }}}?>  /> 
                Off-site  &nbsp;  &nbsp;Description <input name="desc" id="desc" class="getfields" style="width:142px;" type="text" value="<?php if(isset($general)){if($general!=''){ echo $general->key_collection_desc;}}?>">	
				  <br/><span id="collection_err"></span></td>
          </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    
                    
                    <span class="inner-heading">Taxes:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">&nbsp;</td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >State:</span>
                    
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <div><input name="state_tax" type="radio" title="5252" id="state_tax" value="1" onclick="return state_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->state_tax == 1){?> checked="checked" <?php }}}?>  />  Included  &nbsp; &nbsp; <input name="state_tax" type="radio" id="state_tax" title="6236" value="2" <?php if(isset($tax)){if($tax!=''){ if($tax->state_tax == 2){?> checked="checked" <?php }}}?>  onclick="return state_tax_val(this.value);"/> Excluded    &nbsp; &nbsp; <input name="state_tax" id="state_tax" type="radio" value="3" <?php if(isset($tax)){if($tax!=''){ if($tax->state_tax == 3){?> checked="checked" <?php }}}?> onclick="return state_tax_val(this.value);" /> Not Applicable </div>
				
				
                <div class="tax" id="state_tax_div" style="margin-top:5px; display:none;">
				<input name="state_percentage" type="radio" id="state_percentage" value="1" <?php if(isset($tax)){if($tax!=''){ if($tax->state_totalstay_flag == 1){?> checked="checked" <?php }}}?> onclick="return state_percentage_val_script(this.value);" />  Percentage of Total Stay  &nbsp; &nbsp;<input name="state_percentage_val" id="state_percentage_val" class="getfields" style="width:180px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->state_totalstay_percent;}}?>"> %
                <div style="margin-top:10px;">
				<input name="state_percentage" type="radio" id="state_percentage" value="2" <?php if(isset($tax)){if($tax!=''){ if($tax->state_fixedprice_flag  == 1){?> checked="checked" <?php }}}?>  onclick="return state_percentage_val_script(this.value);" /> Fixed Price<select name="state_persons" id="state_persons" class="subgetselectfields" style="width:100px;">
		<option value="">select</option>
	<option value="PPPN" <?php if(isset($tax)){if($tax!=''){ if($tax->state_per_person == 'PPPN'){?> selected="selected"<?php }}}?>>Per Person Per Night</option>
	<option value="PPPS" <?php if(isset($tax)){if($tax!=''){ if($tax->state_per_person == 'PPPS'){?> selected="selected"<?php }}}?>>Per Person Per Stay</option>
	<option value="PRPN" <?php if(isset($tax)){if($tax!=''){ if($tax->state_per_person == 'PRPN'){?> selected="selected"<?php }}}?>>Per Room Per Night</option>
	<option value="PRPS" <?php if(isset($tax)){if($tax!=''){ if($tax->state_per_person == 'PRPS'){?> selected="selected"<?php }}}?>>Per Room Per Stay</option>

</select> Price  <input name="state_price" id="state_price" class="getfields" style="width:62px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->state_fixedprice;}}?>"></div>
                </div>
				<span id="state_tax_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >City:</span>
                    
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <div><input name="city_tax" type="radio" id="city_tax" value="1" onclick="return city_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->city_tax == 1){?> checked="checked" <?php }}}?> />  Included  &nbsp; &nbsp; <input name="city_tax" type="radio" id="city_tax" value="2" onclick="return city_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->city_tax == 2){?> checked="checked" <?php }}}?> /> Excluded    &nbsp; &nbsp; <input name="city_tax" id="city_tax" type="radio" value="3" onclick="return city_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->city_tax == 3){?> checked="checked" <?php }}}?>  /> Not Applicable </div>
                <div class="tax" id="city_tax_div" style="margin-top:5px; display:none;"><input name="city_percentage" id="city_percentage" type="radio" value="1" onclick="return city_percentage_val_script(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->city_totalstay_flag == 1){?> checked="checked" <?php }}}?>  />  Percentage of Total Stay  &nbsp; &nbsp;<input name="city_percentage_val" id="city_percentage_val" class="getfields" style="width:180px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->city_totalstay_percent;}}?>"> %
                <div style="margin-top:10px;"><input name="city_percentage" id="city_percentage" type="radio" value="2" <?php if(isset($tax)){if($tax!=''){ if($tax->city_fixedprice_flag  == 1){?> checked="checked" <?php }}}?> onclick="return city_percentage_val_script(this.value);"  /> Fixed Price<select name="city_persons" id="city_persons" class="subgetselectfields" style="width:100px;">
		<option value="">select</option>
	<option value="PPPN" <?php if(isset($tax)){if($tax!=''){ if($tax->city_per_person == 'PPPN'){?> selected="selected" <?php }}}?>>Per Person Per Night</option>
	<option value="PPPS" <?php if(isset($tax)){if($tax!=''){ if($tax->city_per_person == 'PPPS'){?>selected="selected" <?php }}}?>>Per Person Per Stay</option>
	<option value="PRPN" <?php if(isset($tax)){if($tax!=''){ if($tax->city_per_person == 'PRPN'){?>selected="selected" <?php }}}?>>Per Room Per Night</option>
	<option value="PRPS" <?php if(isset($tax)){if($tax!=''){ if($tax->city_per_person == 'PRPS'){?> selected="selected"<?php }}}?>>Per Room Per Stay</option>

</select> Price  <input name="city_price" id="city_price" class="getfields" style="width:62px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->city_fixedprice ;}}?>"></div>
                </div>
				<span id="city_tax_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Room:</span>
                    
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <div><input name="room_tax" type="radio" id="room_tax" value="1" onclick="return room_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->room_tax == 1){?> checked="checked" <?php }}}?> />  Included  &nbsp; &nbsp; <input name="room_tax" type="radio" id="room_tax" value="2" onclick="return room_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->room_tax == 2){?> checked="checked" <?php }}}?>   /> Excluded    &nbsp; &nbsp; <input name="room_tax" id="room_tax" type="radio" value="3" onclick="return room_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->room_tax == 3){?> checked="checked" <?php }}}?> /> Not Applicable </div>
                <div class="tax" id="room_tax_div" style="margin-top:5px; display:none;"><input name="room_percentage" id="room_percentage" type="radio" value="1" onclick="return room_percentage_val_script(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->room_totalstay_flag == 1){?> checked="checked" <?php }}}?>   />  Percentage of Total Stay  &nbsp; &nbsp;<input name="room_percentage_val" id="room_percentage_val" class="getfields" style="width:180px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->room_totalstay_percent;}}?>"> %
				<div style="margin-top:10px;"><input name="room_percentage" id="room_percentage" type="radio" value="2" <?php if(isset($tax)){if($tax!=''){ if($tax->room_totalstay_flag == 1){?> checked="checked" <?php }}}?> onclick="return room_percentage_val_script(this.value);" /> Fixed Price<select name="room_persons" id="room_persons" class="subgetselectfields" style="width:100px;">
					<option value="">select</option>
	<option value="PPPN" <?php if(isset($tax)){if($tax!=''){ if($tax->room_per_person  == 'PPPN'){?> selected="selected"<?php }}}?>>Per Person Per Night</option>
	<option value="PPPS" <?php if(isset($tax)){if($tax!=''){ if($tax->room_per_person  == 'PPPS'){?>selected="selected"<?php }}}?>>Per Person Per Stay</option>
	<option value="PRPN" <?php if(isset($tax)){if($tax!=''){ if($tax->room_per_person  == 'PRPN'){?> selected="selected" <?php }}}?>>Per Room Per Night</option>
	<option value="PRPS" <?php if(isset($tax)){if($tax!=''){ if($tax->room_per_person  == 'PRPS'){?> selected="selected" <?php }}}?>>Per Room Per Stay</option>


</select> Price  <input name="room_price" id="room_price" class="getfields" style="width:62px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->room_fixedprice;}}?>"></div>
				</div>
				<span id="room_tax_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Vat:</span>
                    
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <div><input name="vat_tax" type="radio" id="vat_tax" value="1" onclick="return vat_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_tax == 1){?> checked="checked" <?php }}}?>   />  Included  &nbsp; &nbsp; <input name="vat_tax" dir="vat_tax" type="radio" value="2" onclick="return vat_tax_val(this.value);"  <?php if(isset($tax)){if($tax!=''){ if($tax->vat_tax == 2){?> checked="checked" <?php }}}?> /> Excluded    &nbsp; &nbsp; <input name="vat_tax" id="vat_tax" type="radio" value="3" onclick="return vat_tax_val(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_tax == 3){?> checked="checked" <?php }}}?>  /> Not Applicable </div>
                <div class="tax" id="vat_tax_div" style="margin-top:5px; display:none;"><input name="vat_percentage" id="vat_percentage" type="radio" value="1"  onclick="return vat_percentage_val_script(this.value);" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_totalstay_flag == 1){?> checked="checked" <?php }}}?>  />  Percentage of Total Stay  &nbsp; &nbsp;<input name="vat_percentage_val" id="vat_percentage_val" class="getfields" style="width:180px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->vat_totalstay_percent;}}?>"> %
                <div style="margin-top:10px;"><input name="vat_percentage" id="vat_percentage" type="radio" value="2" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_fixedprice_flag == 1){?> checked="checked" <?php }}}?>  onclick="return vat_percentage_val_script(this.value);"  /> Fixed Price<select name="vat_persons" id="vat_persons" class="subgetselectfields" style="width:100px;">
					<option value="">select</option>
	<option value="PPPN" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_per_person  == 'PPPN'){?> selected="selected" <?php }}}?>>Per Person Per Night</option>
	<option value="PPPS" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_per_person  == 'PPPS'){?> selected="selected"<?php }}}?>>Per Person Per Stay</option>
	<option value="PRPN" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_per_person  == 'PRPN'){?> selected="selected" <?php }}}?>>Per Room Per Night</option>
	<option value="PRPS" <?php if(isset($tax)){if($tax!=''){ if($tax->vat_per_person  == 'PRPS'){?> selected="selected" <?php }}}?>>Per Room Per Stay</option>


</select> Price  <input name="vat_price" id="vat_price" class="getfields" style="width:62px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->vat_fixedprice;}}?>"></div>
                </div>
				<span id="vat_tax_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Service:</span>
                    
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <div><input name="service_tax" id="service_tax" type="radio" value="1" <?php if(isset($tax)){if($tax!=''){ if($tax->service_tax == 1){?> checked="checked" <?php }}}?>  onclick="return service_tax_val(this.value);"  />  Included  &nbsp; &nbsp; <input name="service_tax" id="service_tax" type="radio" value="2" <?php if(isset($tax)){if($tax!=''){ if($tax->service_tax == 2){?> checked="checked" <?php }}}?> onclick="return service_tax_val(this.value);"  /> Excluded    &nbsp; &nbsp; <input name="service_tax" id="service_tax" type="radio" value="3" <?php if(isset($tax)){if($tax!=''){ if($tax->service_tax == 3){?> checked="checked" <?php }}}?> onclick="return service_tax_val(this.value);"  /> Not Applicable </div>
                <div class="tax" id="service_tax_div" style="margin-top:5px; display:none;"><input name="service_percentage" id="service_percentage" type="radio" value="1"  <?php if(isset($tax)){if($tax!=''){ if($tax->service_totalstay_flag == 1){?> checked="checked" <?php }}}?> onclick="return service_percentage_val_script(this.value);" />  Percentage of Total Stay  &nbsp; &nbsp;<input name="service_percentage_val" id="service_percentage_val" class="getfields" style="width:180px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->service_totalstay_percent;}}?>"> %
                <div style="margin-top:10px;"><input name="service_percentage" id="service_percentage" type="radio" <?php if(isset($tax)){if($tax!=''){ if($tax->service_fixedprice_flag == 1){?> checked="checked" <?php }}}?> value="2"  onclick="return service_percentage_val_script(this.value);" /> Fixed Price<select name="service_persons" id="service_persons" class="subgetselectfields" style="width:100px;">
	<option value="">select</option>

	<option value="PPPN" <?php if(isset($tax)){if($tax!=''){ if($tax->service_per_person  == "PPPN"){?> selected="selected" <?php }}}?>>Per Person Per Night</option>
	<option value="PPPS" <?php if(isset($tax)){if($tax!=''){ if($tax->service_per_person  == "PPPS"){?> selected="selected" <?php }}}?>>Per Person Per Stay</option>
	<option value="PRPN" <?php if(isset($tax)){if($tax!=''){ if($tax->service_per_person  == "PRPN"){?> selected="selected" <?php }}}?>>Per Room Per Night</option>
	<option value="PRPS" <?php if(isset($tax)){if($tax!=''){ if($tax->service_per_person  == "PRPS"){?> selected="selected" <?php }}}?>>Per Room Per Stay</option>
</select> Price  <input name="service_price" id="service_price" class="getfields" style="width:62px;" type="text" value="<?php if(isset($tax)){if($tax!=''){ echo $tax->service_fixedprice;}}?>"></div>
                </div>
				<span id="service_tax_err"></span>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Group Reservation:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;"><input type="radio" name="group" id="group" value="1" <?php if(isset($general)){if($general!=''){ if($general->grp_reservation == 1){?> checked="checked" <?php }}}?> />
                <label for="radio2"> </label> Yes &nbsp; &nbsp; <input name="group" id="group" type="radio" value="2" <?php if(isset($general)){if($general!=''){ if($general->grp_reservation == 2){?> checked="checked" <?php }}}?>  /> No
				<br/><span id="group_err"></span></td>
            </tr>
           
            
           
             <tr>
                <td colspan="2" id="inner-span-heading" style="border-bottom:1px solid #dcdcdc;">
                  <span class="inner-heading" >Card Accepted:</span>
                </td>
            </tr>
           <tr>
		  
                <td valign="top" style="border-bottom:1px solid #dcdcdc; vertical-align:top !important;" colspan="2">
              
									<?php $m = 1;
		   if(isset($cards)){ if($cards != '') {
		   foreach ($cards as $row){  ?>
		      <div class="check-span"><table width="19%" cellspacing="0" cellpadding="0" border="0" class="display">
                                    <tbody><tr>
                                        <td width="250px" style="border: 1px solid #e7e7e7; background: #fcfcfc; font-size: 0.9em;">
                                            <input type="checkbox" name="htlfcltycb" id="htlfcltycb" value="<?php echo $row-> sup_apart_cardaccept_list_id;?>" <?php	
                                  if(isset($usedcards)){ if($usedcards != '') { 
                                      foreach ($usedcards as $row1){
                                          if($row1->sup_apart_cardaccept_list_id == $row->sup_apart_cardaccept_list_id){
                                              echo "checked='checked'";
                                          }
                                      }
                                  }}
                               ?>/>
                                            &nbsp; <?php echo $row->cards;?> &nbsp;<br> 
                                        </td>
										<?php if($m%4 == 0){
							echo " </tr></tbody></table></div><div><table><tbody><tr>";
						}
						?>
              <?php $m++;?> 
            </tr></tbody></table></div>  
               
			<?php }}}?>
                           
 				 <input type="hidden" id="count" name="count" value="<?php echo $m-1; ?>"/>
                <input type="hidden" id="apartfec_val" name="apartfec_val" value=""/>	
                </td>
                
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="" type="submit" value=""  class="login-inner-save" />
     </td>
            </tr>
        </tbody>
    </table>
    </form>
    </div> </div>
    <div class="fix">
    </div></div></div>
    <!--<div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span></span>
        </div>
    </div>-->
                <!-- Footer -->
</body></html>
