<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - General & Contact Information</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
$(document).ready(function() 
		{
		$("#fname0").watermark("First Name");
		$("#fname1").watermark("First Name");
		$("#fname2").watermark("First Name");
		$("#lname0").watermark("Last Name");
		$("#lname1").watermark("Last Name");
		$("#lname2").watermark("Last Name");
		$("#phone0").watermark("Phone Number");
		$("#phone1").watermark("Phone Number");
		$("#phone2").watermark("Phone Number");
		$('#fax0').watermark("Fax");
		$('#fax1').watermark("Fax");
		$('#fax2').watermark("Fax");
		$('#email0').watermark("Email");
		$('#email1').watermark("Email");
		$('#email2').watermark("Email");
		$('#cemail0').watermark("Confirm Email");
		$('#cemail1').watermark("Confirm Email");
		$('#cemail2').watermark("Confirm Email");
});
$(function(){
  
   $('#country').change(function(){
	  $v=$(this).val();
	  //alert($v);
	  $('#region').empty().html('<option>Loading....</option>'); 
	   $.post('<?php echo WEB_URL?>supplier/get_region', {'country':$v},function(data){
		if(data != '')
		{
			$('#region').html(data);
		}
		else		
		{
			//alert($v);
			$('#city').empty().html('<option>Loading....</option>'); 
	  		$.post('<?php echo WEB_URL?>supplier/get_cities_country', {'country':$v},function(data){
			$('#city').html(data);
	  });
		}
	  });
   });
   $('#region').change(function(){
	  $v=$(this).val();
	  //alert($v);
	  $('#city').empty().html('<option>Loading....</option>'); 
	   $.post('<?php echo WEB_URL?>supplier/get_cities', {'country':$v},function(data){
		   $('#city').html(data);
		   
	   });
   });
   $('#city').change(function(){
	  $v=$(this).val();
	  //alert($v);
	  $('#district').empty().html('<option>Loading....</option>'); 
	   $.post('<?php echo WEB_URL?>supplier/get_district', {'country':$v},function(data){
		   $('#district').html(data);
		   
	   });
   });
    
  
 });
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
	<form method="post" action="<?php echo WEB_URL_ADMIN?>supplier/general_info" id="general_contact" name="general_contact">
    <input type="hidden" name="apart_id" value="<?php echo $apart_id?>" /> 
        <!-- Content -->
<div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
        <div class="content">
        <div class="headersuplr_new1">Contact Information
        <span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
            <!-- Dynamic table -->
            <div class="table">
               <!-- <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>-->
                        <!--<div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left;">General & Contact Information</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php //echo WEB_URL_ADMIN?>admin/view_prop/<?php echo $this->session->userdata('admin_user_id')?>" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>-->
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    <div style="display: none;" id="ctl00_DescriptionHolder_XpnlSuccess">
	
                <div align="center">
                    <div class="status_msg">
                        <strong>SUCCESS: </strong>All Details Saved / Updated Successfully
                    </div>
                </div>
            
</div>
            

                <div class="error-text">
                </div>
                
                
   <!-- <div id="ctl00_OptionalLinks_UpdatePanel_upConfirmation">
	
            
        
</div>-->
 	
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		 <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                         <span  class="inner-heading">General Information </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                <div class="fix">&nbsp;</div>
                    
                    <span id="ctl00_OptionalLinks_UpdatePanel_xlblAccommodationName" style="font-weight:bold;"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Country:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                    <select name="country" id="country" class="subgetselectfields" style="width:360px;">
                    <option value="">--select--</option>
	<?php  foreach($country as $cont){?>
		<option value="<?php echo $cont->countrycode;?>" <?php if($cont->countrycode == $cnt){?> selected="selected"<?php }?>>
		<?php echo $cont->name;?></option>
		<?php }?>

</select>
              <br/><span id="err_country"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Region :</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                    <select name="region" id="region" class="subgetselectfields" style="width:360px;">
                      <?php if($apt!=''){
						  $resion_name = $this->Supplier_Model->get_region_name($apt->region)?>
                     <option value="<?php if(isset($apt)){ if($apt!=''){echo $apt->region;}} ?>">
					 <?php echo $resion_name ?></option>
                     <?php }else{?>
                       <option value="">--select country--</option>
                     <?php }?>
</select>
              </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >City:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                   <select name="city" id="city" class="subgetselectfields" style="width:360px;" >
                   <?php if($apt!=''){
					   $resion_name = $this->Supplier_Model->get_city_name($apt->city)?>
				   <option value="<?php if(isset($apt)){ if($apt!=''){echo $apt->city;}} ?>"><?php echo $resion_name?></option>
                   <?php }else{?>
                     <option value="">--select region--</option>
                   <?php }?>
                  
                   </select>
			
                 <br/><span id="err_city"></span></td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >District:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                   <select name="district" id="district" class="subgetselectfields" style="width:360px;" >
               		<?php if($apt!=''){
						$resion_name = $this->Supplier_Model->get_district_name($apt->district_id)?>
                   <option value="<?php if(isset($apt)){ if($apt!=''){echo $apt->district_id;}} ?>"><?php echo $resion_name ?></option>
                   <?php }else{?>
                   <option value="">--select city--</option>
                   <?php }?>
                    
                   </select>
			
                 <br/><span id="err_city"></span></td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Property Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                   <input name="apt_name" id="apt_name" class="getfields" <?php if($this->session->userdata('apt_id')){?>  <?php }?>style="width:350px;" type="text" value="<?php if(isset($apt)){ if($apt!=''){echo $apt->apartment_name;}} ?>">
				    <br/><span id="err_apt_name"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Language Prefernce:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                    <select name="language" id="language" class="subgetselectfields" <?php if($this->session->userdata('apt_id')){?> disabled="disabled" <?php }?> style="width:360px;">
		<?php foreach($language as $cont){?>
		<option value="<?php echo $cont->language_id;?>" <?php if($cont->language_id == $lang){?> selected="selected" <?php }?>><?php echo $cont->language;?></option>
		<?php }?>
		

</select> <br/><span id="err_language"></span>
                </td>
            </tr>
			 <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span  class="inner-heading">Main Contact Information </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <span  style="font-weight:bold;"></span>
                </td>
            </tr>
			 <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >First Name</span>
                     
                                        
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="fname" id="fname" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup)){if($sup!=''){echo $sup->first_name; }}?>"><br/><span id="err_fname">
                </td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Last Name</span>
                    
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <input type="text" name="lname" id="lname" class="getfields" style="width:350px;" value="<?php if(isset($sup)){if($sup!=''){echo $sup->last_name; }}?>">
				 <br/><span id="err_lname"></td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    
                    
                    <span >Email Address</span>
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="email" id="email" class="getfields" style="width:350px;" type="text" value="<?php if(isset($sup)){if($sup!=''){echo $sup->email; }}?>">
                <br/><span id="err_email"></td>
            </tr>
			
            
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span  class="inner-heading">Reservation Contact Information </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <span  style="font-weight:bold;"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >First Name:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="hidden" name="cn0" value="1"/>
                    <input name="fname0" id="fname0" class="getfields" style="width:350px;" type="text" value="<?php if(isset($res)){ if($res!=''){echo ucfirst($res->fname);}}?>">
					<br/><span id="err_fname0"></span></td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Last Name:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="lname0" id="lname0" class="getfields" style="width:350px;" type="text" value="<?php if(isset($res)){ if($res!=''){echo ucfirst($res->lname);}}?>">
					<br/><span id="err_lname0"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Phone:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="phone0" id="phone0" class="getfields" style="width:350px;" type="text" value="<?php if(isset($res)){ if($res!=''){echo ($res->phone);}}?>">
					<br/><span id="err_phone0"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Fax:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="fax0" id="fax0" class="getfields" style="width:350px;" type="text" value="<?php if(isset($res)){ if($res!=''){echo ($res->fax);}}?>">
					<br/><span id="err_fax0"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Email:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="email0" id="email0" class="getfields" style="width:350px;" type="text" value="<?php if(isset($res)){ if($res!=''){echo ($res->email);}}?>">
					<br/><span id="err_email0"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Confirm Email:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="cemail0" id="cemail0" class="getfields" style="width:350px;" type="text" value="<?php if(isset($res)){ if($res!=''){echo ($res->email);}}?>">
					<br/><span id="err_cemail0"></span>
				</td>
            </tr>
			<tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span  class="inner-heading">Marketing Contact Information </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <span  style="font-weight:bold;"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >First Name:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="hidden" name="cn1" value="2"/>
                    <input name="fname1" id="fname1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($mar)){ if($mar!=''){echo ($mar->fname);}}?>">
					<br/><span id="err_fname1"></span></td>
				</td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Last Name:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="lname1" id="lname1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($mar)){ if($mar!=''){echo ($mar->lname);}}?>">
					<br/><span id="err_lname1"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Phone:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="phone1" id="phone1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($mar)){ if($mar!=''){echo ($mar->phone);}}?>">
					<br/><span id="err_phone1"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Fax:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="fax1" id="fax1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($mar)){ if($mar!=''){echo ($mar->fax);}}?>">
					<br/><span id="err_fax1"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Email:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="email1" id="email1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($mar)){ if($mar!=''){echo ($mar->email);}}?>">
					<br/><span id="err_email1"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Confirm Email:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="cemail1" id="cemail1" class="getfields" style="width:350px;" type="text" value="<?php if(isset($mar)){ if($mar!=''){echo ($mar->email);}}?>">
					<br/><span id="err_cemail1"></span>
				</td>
            </tr>
			<tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span  class="inner-heading">Accounts/Finance Contact Information </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <span  style="font-weight:bold;"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >First Name:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="hidden" name="cn2" value="3"/>
                    <input name="fname2" id="fname2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($fin)){ if($fin!=''){echo ($fin->fname);}}?>">
					<br/><span id="err_fname2"></span>
					</td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Last Name:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="lname2" id="lname2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($fin)){ if($fin!=''){echo ($fin->lname);}}?>">
					<br/><span id="err_lname2"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Phone:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="phone2" id="phone2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($fin)){ if($fin!=''){echo ($fin->phone);}}?>">
					<br/><span id="err_phone2"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Fax:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="fax2" id="fax2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($fin)){ if($fin!=''){echo ($fin->fax);}}?>">
					<br/><span id="err_fax2"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Email:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="email2" id="email2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($fin)){ if($fin!=''){echo ($fin->email);}}?>">
					<br/><span id="err_email2"></span>
				</td>
            </tr>
			<tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Confirm Email:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="cemail2" id="cemail2" class="getfields" style="width:350px;" type="text" value="<?php if(isset($fin)){ if($fin!=''){echo ($fin->email);}}?>">
					<br/><span id="err_cemail2"></span>
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
    </div>
    <div class="fix">
    </div>
    </div>
	</form>
    <br /><br />
    <!--<div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span></span>
        </div>-->
    </div>
                <!-- Footer -->
</div>
</body>
</html>
