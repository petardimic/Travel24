<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - House Rules</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery-1.4.3.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
	<?php if(isset($rules)){if($rules != ''){ if($rules->security_deposit == 1){?>
	
$('#method_display').show();
<?php }}}else{?> 
$('#method_display').hide();

<?php }?>
<?php if(isset($rules)){if($rules != ''){if($rules->deposit_method != 0 && $rules->deposit_method != 1){?>
$('#percentage').show();
<?php }}}else{?>
$('#percentage').hide();
<?php }?>
});
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

   <!-- <div id="sidebar-position">
    <?php // $this->load->view('supplier/leftbar');?>
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
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">House Rules </span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>-->
               

 <div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">House Rules<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
    <form method="post" id="house_info" name="house_info" action="<?php echo WEB_URL_ADMIN?>supplier/insert_house_info">
<input type="hidden" name="house_id" value="<?Php if(isset($rules)){if($rules!=''){echo $rules->sup_apart_list_id;}}?>"/>
     <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
          <?php /*?>  <tr>
              <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                <div class="fix">&nbsp;</div>
                  <span >Arrival Time (from):</span>
                </td>
                 <td style="border-bottom:1px solid #dcdcdc;">
                   
                   <select name="atimefrom" id="atimefrom" class="subgetselectfields"  style="width:360px;">
				   <option value="">select time</option>  
				   <?php if(isset($time)){if($time!=''){
                    foreach($time as $t){?>
                    <option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rules)){if($rules!=''){ if($rules->arrivaltime_from == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
                    <?php }}}?>
					</select>
		         <br/><span id="err_class"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Departure Time (Before):</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="dtimebefore" id="dtimebefore" class="subgetselectfields"  style="width:360px;">
				   <option value="">select time</option>
                     <?php if(isset($time)){if($time!=''){
                    foreach($time as $t){?>
                    <option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rules)){if($rules!=''){ if($rules-> 	departtime_before == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
                    <?php }}}?>
                   </select>
						<br/><span id="err_group"></span>
                </td>
            </tr><?php */?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Check-in with Extra cost (after): </span>
                </td>
               <td style="border-bottom:1px solid #dcdcdc;">
                    hours: 
                       <select name="checkin_from1" id="checkin_from1" class="subgetselectfields" style="width:100px;">
                    <option value="">Not Aplicable</option>
                    <?php if(isset($time)){if($time!=''){
                    foreach($time as $t){?>
                    <option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rules)){if($rules!=''){ if($rules-> 	checkin_time1 == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
                    <?php }}}?>
                    </select>
                     Cost <input name="costin1" id="costin1" class="getfields" style="width:60px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->checkin_extracost1;}}?>" ><br />
 hours: 
                       <select name="checkin_from2" id="checkin_from2" class="subgetselectfields" style="width:100px;">
                    <option value="">Not Aplicable</option>
                    <?php if(isset($time)){if($time!=''){
                    foreach($time as $t){?>
                    <option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rules)){if($rules!=''){ if($rules-> 	checkin_time2 == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
                    <?php }}}?>
                    </select>
                     Cost <input name="costin2" id="costin2" class="getfields" style="width:60px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->	checkin_extracost2; }}?>" >   
					<br/><span id="err_long"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Check-out with Extra cost (after): </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    hours: 
                     <select name="checkout_from1" id="checkout_from1" class="subgetselectfields" style="width:100px;">
                    <option value="">Not Aplicable</option>
                    <?php if(isset($time)){if($time!=''){
                    foreach($time as $t){?>
                    <option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rules)){if($rules!=''){ if($rules-> 	checkout_time1 == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
                    <?php }}}?>
                    </select> 
                    Cost <input name="costout1" id="costout1" class="getfields" style="width:60px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->checkout_extracost2; }}?>" ><br />
 hours: 
                      <select name="checkout_from2" id="checkout_from2" class="subgetselectfields" style="width:100px;">
                    <option value="">Not Aplicable</option>
                    <?php if(isset($time)){if($time!=''){
                    foreach($time as $t){?>
                    <option value="<?php echo $t->sup_apart_checktimes_value?>" <?php if(isset($rules)){if($rules!=''){ if($rules-> 	checkout_time2 == $t->sup_apart_checktimes_value){?> selected="selected" <?php }}}?>><?php echo $t->sup_apart_checktimes_value?></option>
                    <?php }}}?>
                    </select>
                     Cost <input name="costout2" id="costout2" class="getfields" style="width:60px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->checkout_extracost2; }}?>">   
					<br/><span id="err_long"></span>
                </td>
            </tr>
           <?php /*?> <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Minimum Stay:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                 <input name="mistay" id="mistay" class="getfields" style="width:350px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->mini_stay; }}?>">
              </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Maximum Stay:</span>                </td>
              
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input name="mxstay" id="mxstay" class="getfields" style="width:350px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->max_stay; }}?>">
			<br/><span id="err_time_zone"></span>
		</td>
            </tr><?php */?>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Payment of fees:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                  <?php /*?> <select name="rentamt" id="rentamt" class="subgetselectfields" style="width:100px;">
                    <option value="">Not Aplicable</option>
                    <option value="10" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 10){?> selected="selected" <?php }}}?>>10</option>
                    <option value="20" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 20){?> selected="selected" <?php }}}?>>20</option>
                    <option value="25" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 25){?> selected="selected" <?php }}}?>>25</option>
                    <option value="50" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount == 50){?> selected="selected" <?php }}}?>>50</option>
                    <option value="75" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 75){?> selected="selected" <?php }}}?>>75</option>
					<option value="100" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 100){?> selected="selected" <?php }}}?>>100</option>
                       </select>% maximum
                    <input name="rentamtday" id="rentamtday" class="getfields" style="width:60px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->rent_amount_days ; }}?>">days after the booking date<?php */?>
                   <textarea name="rentamtday" id="rentamtday"  class="getfields" style="width:350px; height:60px;text-align:left;">
                   <?php if(isset($rules)){if($rules != ''){if($rules->rent_amount_days != ''){ echo $rules->rent_amount_days;}}}?>
                   </textarea>
				<br/><span id="err_star"></span>
                </td>
            </tr>
           <?php /*?> <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Payment of the rent amount:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                   <select name="rentamt" id="rentamt" class="subgetselectfields" style="width:100px;">
                    <option value="">Not Aplicable</option>
                    <option value="10" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 10){?> selected="selected" <?php }}}?>>10</option>
                    <option value="20" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 20){?> selected="selected" <?php }}}?>>20</option>
                    <option value="25" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 25){?> selected="selected" <?php }}}?>>25</option>
                    <option value="50" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount == 50){?> selected="selected" <?php }}}?>>50</option>
                    <option value="75" <?php if(isset($rules)){if($rules!=''){ if($rules->rent_amount  == 75){?> selected="selected" <?php }}}?>>75</option>
                    </select>% maximum
                    <input name="rentamtday" id="rentamtday" class="getfields" style="width:60px;" type="text" value="<?Php  if(isset($rules)){if($rules!=''){  echo $rules->rent_amount_days ; }}?>">days after the booking date
				<br/><span id="err_star"></span>
                </td>
            </tr><?php */?>
        
          <?php /*?> <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Security Deposit:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  <input type="radio" name="security_deposit"  value="1" <?php if(isset($rules)){if($rules != ''){if($rules->security_deposit == 1){?> checked="checked"<?php }}}?> onclick="return security_deposit_show(this.value);" />&nbsp; Security Deposit &nbsp;<input type="radio" name="security_deposit" value="2"  <?php if(isset($rules)){if($rules != ''){if($rules->security_deposit == 2){?> checked="checked"<?php }}}?> onclick="return security_deposit_show(this.value);"  /> &nbsp;Not Required
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
            <tr style="display:none;" id="amount">
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
            </tr><?php */?>
              <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Cleaning:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  <select name="clean" id="clean" class="subgetselectfields"  style="width:360px;">
				   <option value="">select option</option>
		<option value="1" <?php if(isset($rules)){if($rules!=''){ if($rules->cleaning == 1){?> selected="selected" <?php }}}?> >Daily</option>
   <option value="2" <?php if(isset($rules)){if($rules!=''){ if($rules->cleaning == 2){?> selected="selected" <?php }}}?> >Every other day</option>
  <option value="3" <?php if(isset($rules)){if($rules!=''){ if($rules->cleaning == 3){?> selected="selected" <?php }}}?> >Weekly</option>
  <option value="4" <?php if(isset($rules)){if($rules!=''){ if($rules->cleaning == 4){?> selected="selected" <?php }}}?> >On departure</option>
 <option value="5" <?php if(isset($rules)){if($rules!=''){ if($rules->cleaning == 5){?> selected="selected" <?php }}}?> >Not offered</option>
		           </select>
				<br/><span id="err_currency"></span>
                </td>
            </tr>
               <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Supplies:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                   <select name="supp" id="supp" class="subgetselectfields"  style="width:360px;">
				   <option value="">select option</option>
                    <option value="1" <?php if(isset($rules)){if($rules!=''){ if($rules->supplies == 1){?> selected="selected" <?php }}}?> >Included</option>
                    <option value="0" <?php if(isset($rules)){if($rules!=''){ if($rules->supplies == 0){?> selected="selected" <?php }}}?> >Not Included</option>
	            	</select>
				<br/><span id="err_currency"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Children and extra beds:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                 <textarea name="mistay" id="mistay"  class="getfields" style="width:350px; height:60px;text-align:left;">
				<?php if(isset($rules)){ if($rules!='' && $rules->mini_stay != ''){echo $rules->mini_stay;}else{?>Children are welcome.All children under 2 years stay free of charge for children's cots/cribs.All older children or adults are charged per person per night for an extra bed. The maximum number of extra beds/children's cots permitted in a Unit is 1.
                <?php }}?>
                </textarea>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Pets:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                 <input name="pets" id="pets"  type="radio" value="yes" <?php if(isset($rules)){if($rules!=''){ if($rules->pets == 'yes'){?> checked="checked" <?php }}}?>> Pets are welcomed
                 <input name="pets" id="pets"  type="radio" value="no"<?php if(isset($rules)){if($rules!=''){ if($rules->pets == 'no'){?> checked="checked" <?php }}}?>> Sorry, pets are not allowed
                </td>
            </tr>
              <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Cancellation/Prepayment:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
              <textarea name="mxstay" id="mxstay"  class="getfields" style="width:350px; height:60px; text-align:left;">
				<?php if(isset($rules)){if($rules!='' && $rules->max_stay != ''){echo $rules->max_stay;}else{?>Cancellation and prepayment policies vary according to unit type. Please check the conditions of your required unit.
                <?php }}?>
                </textarea>
                </td>
            </tr>
              <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Important Information: </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="policy" id="policy"  class="getfields" style="width:350px; height:60px;"><?php if(isset($rules)){ if($rules!=''){echo $rules->policy;}}?></textarea>
                <br/><span id="err_address"></span>
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
    </div>
    </div>
    
                <!-- Footer -->
</body></html>
<script type="text/javascript">
function security_deposit_show(val)
{

	if(val == 1)
	{
		$('#method_display').show();
		$('#percentage').hide();
	}
	else
	{
		$('#method_display').hide();
		$('#percentage').hide();
		
	}
}
function deposit_method_show(val)
{
	if(val == 2)
	{
		$('#percentage').show();
		$('#amount').hide();
	}
	else if(val == 3)
	{
		$('#percentage').hide();
		$('#amount').show();
	}
	else
	{
		$('#percentage').hide();
		$('#amount').hide();
	}
	
}
</script>