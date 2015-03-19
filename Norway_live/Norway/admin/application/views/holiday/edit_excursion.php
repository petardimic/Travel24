
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title> Edit Holiday</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_two.css" rel="stylesheet" />

<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR?>supplier_includes/css/light-box.css"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/cruise_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR?>/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>/autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>ckeditor/ckeditor.js"></script>
		<script type="text/javascript">
            $(window).load( function() {
               
                CKEDITOR.replace("inclusion");
				CKEDITOR.replace("exclusion");
				CKEDITOR.replace("ex_details");
				CKEDITOR.replace("transportation");
				CKEDITOR.replace("itinary");
				CKEDITOR.replace("additional_details");
				CKEDITOR.replace("cancel_policy");
				CKEDITOR.replace("term_cond");
				CKEDITOR.replace("itinary_basic");
				CKEDITOR.replace("holiday_plan");
            });
        </script>



<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>


    <!-- Top navigation bar -->
      <?php $this->load->view('header2');?>
        <!-- Header -->
    <div class="fix"></div>

    <div id="sidebar-position" style="position:absolute;margin-top:20px;">
    <?php  $this->load->view('package_leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <div class="wrapper">
        <!-- Content -->
        <div class="content">
            <!-- Dynamic table -->
            <div class="table" style="margin-top:20px;">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title" style="position:absolute;">
					 
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Edit Holiday</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/list_excursion" style="font-size:13px; color:#fff;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    
            

 <form method="post" name="frm1"  enctype="multipart/form-data" action="<?php print WEB_URL_ADMIN?>admin/update_holiday/<?php echo $excursion_id; ?>" > <!--onsubmit="return citydesc();"-->

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Type:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="pack_type" class="getfields" style="height:28px; width:362px;">
                    <option value="dom" <?php if($excursion_det->ex_type =='dom') { echo "selected"; } ?>>Domestic</option>
                    <option value="int" <?php if($excursion_det->ex_type =='int') { echo "selected"; } ?>>International</option>
                    </select>
						
                </td>
            </tr>
            <?php $themes = $this->Home_Model->holiday_themes(); ?>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Themes:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="holiday_theme" class="getfields" style="height:28px; width:362px;">
                  	<option value=""> - Select - </option>
                    <?php if(isset($themes)) { if($themes != '') { foreach($themes as $row) { ?>
                    <option value="<?php echo $row->item; ?>" <?php if($excursion_det->holiday_theme == $row->item) { echo "selected"; } ?>><?php echo $row->item; ?></option>
                    <?php } } } ?>
                    </select>
						
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Starts at:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="city" id="testinput" class="getfields" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_location; }}?>" style="width:350px;" />
					<input name="city_hide" id="city_hide" class="getfields"  type="hidden">
		<script type="text/javascript">
	    var options = {
		script:"<?php print WEB_DIR; ?>test.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('city_hide').value = obj.id; } };
	    var as_json = new AutoSuggest('testinput', options);
        </script>
                </td>
            </tr>
            
			 <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="activity_name" class="getfields" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_name; }}?>" style="width:350px;"  />
						
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Duration: (Days)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="duration" class="getfields" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_duration; }}?>" style="width:350px;"   /> 
						
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Duration: (Hours)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="duration_hours" class="getfields" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->duration_hours; }}?>" style="width:350px;"   /> 
						
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Image:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="file" name="image" class="getfields" style="width:350px; height:30px;"    />
					<?php /*?><input type="hidden" name="image_holi" class="getfields" style="width:350px; height:30px;" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_location; }}?>	"    /><?php */?>
                    <img src="<?php print WEB_DIR_ADMIN ?>excursionimages/<?php echo $excursion_det->ex_mainimage; ?>"  width="100" height="100" />
					<input type="hidden" name="image_holi" value="<?php echo $excursion_det->ex_mainimage; ?>"  />
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Plan:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="holiday_plan" id="holiday_plan" style="height:70px; width:350px;"><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->holiday_plan; }}?>	</textarea> 
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Highlight:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="highlight" id="highlight" style="height:70px; width:350px;"><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->highlight; }}?>	</textarea> 
                </td>
            </tr>
          <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Detail:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="ex_details" id="ex_details" style="height:70px; width:350px;"><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_detail; }}?>	</textarea> 
                </td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >  Price From: (Per Person)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="price" class="getfields" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_price; }}?>	" style="width:350px;"  />
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >  Price Fake: (Per Person)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="price_fake" class="getfields" style="width:350px;" value="<?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->price_fake; }}?>	"  />
                </td>
            </tr>
            
           <!-- <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Product Code:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="product_code" class="getfields" style="width:350px;"  />
                </td>
            </tr>-->
             <input type="hidden" name="product_code" class="getfields" style="width:350px;"  />
          
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Inclusions:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="inclusion" id="inclusion" style="height:70px; width:350px;"><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->inclusion; }}?>	</textarea> 
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Exclusions:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="exclusion" id="exclusion" style="height:70px; width:350px;"><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->exclusion; }}?>	</textarea> 
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Transportation:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="transportation" id="transportation" style="height:70px; width:350px;"></textarea> 
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Itinerary Basic</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="itinary_basic" id="itinary_basic" class="getfields" ><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->itinary_basic; }}?>	</textarea>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Itinerary Detailed</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="more_det" id="itinary" class="getfields" ><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_moredet; }}?>	</textarea>
                </td>
            </tr>
              <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Video:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="video" ><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_video; }}?></textarea> 
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">OR</td>
                <td style="border-bottom:1px solid #dcdcdc;">&nbsp;</td>
            </tr>
            
           <!-- <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Holiday Banner: (Multiple picture can be selected)</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                 
                     <input name="banner[]"  type="file" multiple class="getfields" style="width:350px; height:30px;"  />
                </td>
            </tr>-->
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday map (Google map)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  
						<label for="textfield"></label>
						<textarea class="getfields" name="shedule_details" id="shedule_details" ><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det-> 	ex_shedule; }}?></textarea> 
                </td>
            </tr>
            
            
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Additional Details</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="additional_details" id="additional_details" class="getfields"><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->ex_additionaldet; }}?></textarea>
                </td>
            </tr>
            
            
            
         
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Cancellation Policy</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="cancel_policy" id="cancel_policy" class="getfields" ><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->cancel_policy; }}?></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Terms & Conditions</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="term_cond" id="term_cond" class="getfields" ><?php if(isset($excursion_det)) { if($excursion_det != '') { echo $excursion_det->term_cond; }}?></textarea>
                </td>
            </tr>
            
            
            
            
           
		</tbody></table>
              </td>
            </tr>
        </tbody>
    </table>
	
    <!--</form>
    <form name="" action="" method="post">-->
    <table width="100%" border="0" class="tableStatic">
  <tr>
   <!-- <td style="border-bottom:1px solid #dcdcdc;"  width="74%">Image Gallery:<br/>(Multiple picture can be selected)</td>
    <td style="border-bottom:1px solid #dcdcdc;">
    <input name="new_image[]"  type="file" multiple class="getfields" style="width:350px; height:30px;"  /></td>-->
    <td width="28%" style="border-bottom:1px solid #dcdcdc;"> 
    <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" /></div></td>
  </tr>
  
</table>
</form>


	
    </div> </div>
    <div class="fix">
    </div>
    </div>
    <div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--></span>
        </div>
    </div>
                <!-- Footer -->
</body></html>
<script type="text/javascript">
function check_login(email)
{
		$.post("<?php echo WEB_URL?>supplier/confirm_sup_user",{'user':email},function(data){
		if(data == 1)
		{
			document.getElementById('email_err').innerHTML="<font color=red>Email already exist</font>";
			document.getElementById("email").value = '';
			document.getElementById("email").focus();
		}
		else
		{
			document.getElementById('email_err').innerHTML="";
		}
		});
	//}
}
</script>
