<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Your Payment Details</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
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
	<form method="post" action="<?php echo WEB_URL_ADMIN?>supplier/update_payment_details" id="payment_details" name="payment_details">
    <div class="wrapper">
        <!-- Content -->
        <!--<div class="content">
            <!-- Dynamic table -->
           <!-- <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Payment Details</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>
                </div>-->
               
                
	<div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">Payment Details<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
 
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		 <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                         <span  class="inner-heading">Your Payment Details</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                <div class="fix">&nbsp;</div>
                    
                    <span id="ctl00_OptionalLinks_UpdatePanel_xlblAccommodationName" style="font-weight:bold;"></span>
                </td>
            </tr>
          <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Transfer To:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    <input name="transfer_to" id="transfer_to" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->transfer_to;}} ?>">
              <br/><span id="err_transfer_to"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Account Number:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    <input name="acc_num" id="acc_num" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->acc_num ;}} ?>">
              <br/><span id="err_acc_num"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >S.W.I.F.T:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    <input name="swjft" id="swjft" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->swjft;}} ?>">
              <br/><span id="err_swjft"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Paymnet Currency:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                    <select name="currency" id="currency" class="subgetselectfields" style="width:360px;">
	<?php foreach($currency as $cont){?>
		<option value="<?php echo $cont->currency_id;?>" <?php if(isset($sup_details)){if($sup_details){if($sup_details->payment_currency == $cont->currency_id){?> selected="selected" <?php }}} ?>><?php echo $cont->currency;?></option>
		<?php }?>

</select>
              <br/><span id="err_currency"></span>  </td>
            </tr>
            <?php /*?><tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Maximum Payment (HKD):</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="payment" id="payment" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->max_payment;}} ?>">
              <br/><span id="err_payment"></span>  </td>
            </tr><?php */?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Bank Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="bank_name" id="bank_name" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->bank_name;}} ?>">
              <br/><span id="err_bank_name"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Bank Address1:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="bank_adds1" id="bank_adds1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->address1;}} ?>">
              <br/><span id="err_bank_adds1"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Bank Address2:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="bank_adds2" id="bank_adds2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->address2;}} ?>">
              <br/><span id="err_bank_adds2"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Bank Country:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                    <select name="country" id="country" class="subgetselectfields" style="width:360px;">
	<?php foreach($country as $cont){?>
		<option value="<?php echo $cont->countrycode;?>" <?php if(isset($sup_details)){if($sup_details){if($sup_details->bacnk_country  == $cont->countrycode){?> selected="selected" <?php }}} ?>><?php echo $cont->name;?></option>
		<?php }?>

</select>
              <br/><span id="err_country"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Bank State/ Province:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="bank_state" id="bank_state" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->bank_state;}} ?>">
              <br/><span id="err_bank_state"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Bank City:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="bank_city" id="bank_city" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->bank_city;}} ?>">
              <br/><span id="err_bank_city"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Postal/ Zip  code:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="postal_code" id="postal_code" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->postal_code ;}} ?>">
              <br/><span id="err_postal_code"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Tax Id/ sse:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="tax_id" id="tax_id" class="getfields" style="width:350px;" type="text"  value="<?php if(isset($sup_details)){if($sup_details){echo $sup_details->tax_id;}} ?>">
              <br/><span id="err_tax_id"></span>  </td>
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
    </div> </div>
    <div class="fix">
    </div>
    </div>
	</form>
   <!-- <div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--><!--</span>
        </div>
    </div>-->
                <!-- Footer -->
</body></html>