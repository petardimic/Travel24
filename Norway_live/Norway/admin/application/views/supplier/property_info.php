<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Property Information</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<script type="text/javascript">
$(document).ready(function() 
		{
		$('#group').watermark("Brand Name");
		$("#long").watermark("10.028");
		$("#lat").watermark("50.25");
		$("#website").watermark("www.example.com");
		$("#confirmation_fax").watermark("040257888");
		$("#confirmation_email").watermark("john@example.com")
		
});
</script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
 function myWindow(address) {

window.open( address, "myWindow", "status = 1, height = 500, width = 800, Left =300, Top =50, resizable = 0" )

}
</script>
</head>
<body>
<div class="wrapper">

    <!-- Top navigation bar -->
    <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

    <!--<div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div>--><!--sidebar-position-->
    <!-- Content wrapper -->
   <!-- <div class="wrapper">-->
        <!-- Content -->
        <!--<div class="content">-->
            <!-- Dynamic table -->
             <!--<div class="table">
               <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Property Information </span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                <b>
                                    
                                    
                                    
                                    
                                    </b></h5>
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
                
                
    <!--<div id="ctl00_OptionalLinks_UpdatePanel_upConfirmation">
	
            
        
</div>-->
<div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">Property Information
        <span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
 <form method="post" id="property_info" name="property_info" action="<?php echo WEB_URL_ADMIN?>supplier/insert_property_info/1">
 
 	
   <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                 <div class="fix">&nbsp;</div>
                    <span >Class Type:</span>
                </td>
                 <td style="border-bottom:1px solid #dcdcdc;">
                   
                   <select name="class" id="class" class="subgetselectfields"  style="width:360px;">
				   <option value="">select class type</option>
		<?php foreach($class as $cont){?>
		<option value="<?php echo $cont->sup_apartclass_type_id;?>" <?php if(isset($profile)){ if($profile!=''){if($profile->	sup_apartclass_type_id  == $cont->sup_apartclass_type_id){?> selected="selected"<?php }}}?>><?php echo $cont->apartclass;?></option>
		<?php }?>
		</select>
		<br/><span id="err_class"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Group/ Brand Association:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="group" id="group" class="getfields" style="width:350px;" type="text" value="<?php if(isset($profile)){ if($profile!=''){echo $profile->brand;}}?>">
						<br/><span id="err_group"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Longitude: <a href="http://itouchmap.com/latlong.html" target="_blank">http://itouchmap.com/latlong.html</a></span>
                </td>
               <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="long" id="long" class="getfields" style="width:350px;" type="text" value="<?php if(isset($profile)){ if($profile!=''){echo $profile->longitude;}}?>">
					<br/><span id="err_long"></span>
              </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Latitude:<a HREF="http://itouchmap.com/latlong.html" target="_blank">http://itouchmap.com/latlong.html</a> </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="lat" id="lat" class="getfields" style="width:350px;" type="text" value="<?php if(isset($profile)){ if($profile!=''){echo $profile->latitude;}}?>">
					<br/><span id="err_lat"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Address: </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="address" id="address"  class="getfields" style="width:350px; height:60px;"><?php if(isset($profile)){ if($profile!=''){echo $profile->address;}}?></textarea>
                <br/><span id="err_address"></span>
              </td>
            </tr>
			 <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Description: </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="prop_info" id="prop_info"  class="getfields" style="width:350px; height:60px;"><?php if(isset($profile)){ if($profile!=''){echo $profile->details;}}?></textarea>
                <br/><span id="err_address"></span>
              </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Time-zones:</span>                </td>
              
                <td style="border-bottom:1px solid #dcdcdc;">
                   <select name="time_zone" id="time_zone" class="subgetselectfields"  style="width:360px;">
				     <option value="">select timezone</option>
		<?php foreach($time as $cont){?>
		<option value="<?php echo $cont->sup_apart_timezone_list_id;?>" <?php if(isset($profile)){ if($profile!=''){if($profile->	sup_apart_timezone_list_id == $cont->sup_apart_timezone_list_id){?> selected="selected"<?php }}}?> ><?php echo '(';echo  $cont->time; echo $cont->value; echo ')'; echo $cont->time_location;?></option>
		<?php }?>
		</select>
			<br/><span id="err_time_zone"></span>
		</td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Star:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                  <select name="star" id="star" class="subgetselectfields" style="width:360px;">
				<option value="">Please select star</option>
                <option value="0" <?php if(isset($profile)){ if($profile!=''){if($profile->star == 0){?> selected="selected"<?php }}}?>>0</option>
				<option value="1" <?php if(isset($profile)){ if($profile!=''){if($profile->star == 1){?> selected="selected"<?php }}}?>>1</option>
				<option value="2" <?php if(isset($profile)){ if($profile!=''){if($profile->star == 2){?> selected="selected"<?php }}}?>>2</option>
				<option value="3" <?php if(isset($profile)){ if($profile!=''){if($profile->star == 3){?> selected="selected"<?php }}}?>>3</option>
				<option value="4" <?php if(isset($profile)){ if($profile!=''){if($profile->star == 4){?> selected="selected"<?php }}}?>>4</option>
				<option value="5" <?php if(isset($profile)){ if($profile!=''){if($profile->star == 5){?> selected="selected"<?php }}}?>>5</option>
				</select>
				<br/><span id="err_star"></span>
                </td>
            </tr>
        
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Currency:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                   <select name="currency" id="currency" class="subgetselectfields" style="width:360px;">
				   <option value="">select currency</option>
	<?php foreach($currency as $cont){?>
		<option value="<?php echo $cont-> currency_id;?>" <?php if(isset($profile)){ if($profile!=''){if($profile->	currency_id == $cont->currency_id){?> selected="selected"<?php }}}?>><?php echo $cont->currency;?></option>
		<?php }?>
		</select>
				<br/><span id="err_currency"></span>
                </td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">website:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <input name="website" id="website" class="getfields" style="width:350px;" type="text" value="<?php if(isset($profile)){ if($profile!=''){echo $profile->website;}}?>">
						
                </td>
            </tr>
            <?php /*?><tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    
                    
                    <span >Bookings: Instant or On request?</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    Instant <input name="response" id="response" type="radio" value="1" <?php if(isset($profile)){ if($profile!=''){if($profile->booking_type  == 1){?> checked="checked" <?php }}}?> /> On request <input name="response" type="radio" value="2" <?php if(isset($profile)){ if($profile!=''){if($profile->booking_type  == 2){?> checked="checked" <?php }}}?>/>
               <br/><span id="err_response"></span> </td>
            </tr><?php */?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Receive confirmation via fax or email s?</span>
              </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables">Fax</span>
                    &nbsp;
                    <input id="fax" name="fax" type="checkbox" value="1" <?php if(isset($profile)){ if($profile!=''){if($profile->confirmation_type_fax   == 1){?> checked="checked" <?php }}}?>>
                    &nbsp;&nbsp;&nbsp;
                    <span  class="lables-move">Email</span>&nbsp;
                    <input id="email" name="email" type="checkbox" value="2" <?php if(isset($profile)){ if($profile!=''){if($profile->confirmation_type_email  == 2){?> checked="checked" <?php }}}?>>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Booking confirmation fax</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="confirmation_fax"  id="confirmation_fax" class="getfields" style="width:350px;" type="text" value="<?php if(isset($profile)){ if($profile!=''){echo $profile->confirmation_fax;}}?>"/>
               <br/><span id="err_confirmation_fax"></span>       
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Booking confirmation email</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="confirmation_email"  id="confirmation_email" class="getfields" style="width:350px;" type="text" value="<?php if(isset($profile)){ if($profile!=''){echo $profile->confirmation_mail;}}?>"/>  <br/><span id="err_confirmation_email"></span>      
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
	</form></div>
    </div> </div>
    <div class="fix">
    </div>
	</div>
    <!--<div id="footer">
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