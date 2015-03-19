
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>- Edit Package</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR?>supplier_includes/css/light-box.css"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/cruise_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR?>/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>/autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "none",
		theme : "advanced",
		plugins : "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,",
		theme_advanced_buttons4 : "",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "false",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],
	});
tinyMCE.execCommand('mceAddControl', false, 'ex_details');
tinyMCE.execCommand('mceAddControl', false, 'shedule_details');
//tinyMCE.execCommand('mceAddControl', false, 'price_includes');
tinyMCE.execCommand('mceAddControl', false, 'price_excludes');
tinyMCE.execCommand('mceAddControl', false, 'additional_details');
tinyMCE.execCommand('mceAddControl', false, 'more_det');
tinyMCE.execCommand('mceAddControl', false, 'diving');
tinyMCE.execCommand('mceAddControl', false, 'surfing');
</script>
<script type="text/javascript">
	function citydesc()
	{
 
   if( document.frm1.city.value == "" )
   {
     alert( "Please enter the activity name!" );
     document.frm1.city.focus() ;
     return false;
   }
   if( document.frm1.activity_name.value == "" )
   {
     alert( "Please enter the activity location!" );
     document.frm1.activity_name.focus() ;
     return false;
   }
    if( document.frm1.duration.value == "" )
   {
     alert( "Please enter duration!" );
     document.frm1.duration.focus() ;
     return false;
   }
   else if(isNaN (document.frm1.duration.value) )
   {
	   alert( "Duration must be an Integer Value!" );
	   document.frm1.duration.focus() ;
	   document.frm1.duration.value = "" ;
	   return false;
   }
    if( document.frm1.ex_details.value == "" )
   {
     alert( "Please enter the details !" );
     document.frm1.ex_details.focus() ;
     return false;
   }
   if( document.frm1.price.value == "" )
   {
     alert( "Please enter the price !" );
     document.frm1.price.focus() ;
     return false;
   }
   else if(isNaN (document.frm1.price.value) )
   {
	   alert( "Price must be an Integer Value!" );
	   document.frm1.price.focus() ;
	   document.frm1.price.value = "" ;
	   return false;
   }
   
    
    if( document.frm1.product_code.value == "" )
   {
     alert( "Please entet the product_code!" );
     document.frm1.product_code.focus() ;
     return false;
   }
    if( document.frm1.video.value == "" )
   {
     alert( "Please enter the video or select banner !" );
     document.frm1.video.focus() ;
     return false;
   }
   
    if( document.frm1.shedule_details.value == "" )
   {
     alert( "Please enter the shedule_details !" );
     document.frm1.shedule_details.focus() ;
     return false;
   }
   
   
    if( document.frm1.price_infant.value == "" )
   {
     alert( "Please provide price for infants!" );
     document.frm1.price_infant.focus() ;
     return false;
   }
   else if(isNaN (document.frm1.price_infant.value) )
   {
	   alert( "Infant Price must be an Integer Value!" );
	   document.frm1.price_infant.focus() ;
	   document.frm1.price_infant.value = "" ;
	   return false;
   }
   
    if( document.frm1.price_child.value == "" )
   {
     alert( "Please provide price for child !" );
     document.frm1.price_child.focus() ;
     return false;
   }
   else if(isNaN (document.frm1.price_child.value) )
   {
	   alert( "Child Price must be an Integer Value!" );
	   document.frm1.price_child.focus() ;
	   document.frm1.price_child.value = "" ;
	   return false;
   }
   
   if( document.frm1.price_adult.value == "" )
   {
     alert( "Please provide price for adults !" );
     document.frm1.price_adult.focus() ;
     return false;
   }
   else if(isNaN (document.frm1.price_adult.value) )
   {
	   alert( "Adult Price must be an Integer Value!" );
	   document.frm1.price_adult.focus() ;
	   document.frm1.price_adult.value = "" ;
	   return false;
   }
   
 if( document.frm1.price_includes.value == "" )
   {
     alert( "Please provide price_includes !" );
     document.frm1.price_includes.focus() ;
     return false;
   }
 if( document.frm1.price_excludes.value == "" )
   {
     alert( "Please provide price_excludes !" );
     document.frm1.price_excludes.focus() ;
     return false;
   }
    if( document.frm1.additional_details.value == "" )
   {
     alert( "Please provide additional_details !" );
     document.frm1.additional_details.focus() ;
     return false;
   }
    if( document.frm1.more_det.value == "" )
   {
     alert( "Please provide more details !" );
     document.frm1.more_det.focus() ;
     return false;
   }
   
 
 
   
   
  
  /* if( document.myForm.Country.value == "-1" )
   {
     alert( "Please provide your country!" );
     return false;
   }*/
   
   return( true );
}
</script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>


    <!-- Top navigation bar -->
     <?php $this->load->view('header1');?>
        <!-- Header -->
    <div class="fix"></div>

    <div id="sidebar-position" style="position:absolute;">
    <?php  $this->load->view('package_leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <div class="wrapper">
        <!-- Content -->
        <div class="content">
            <!-- Dynamic table -->
            <div class="table"  style="margin-top:20px;">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title" style="position:absolute;">
					 
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Update Package</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/list_excursion" style="font-size:13px; color:#fff;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    
            

 <form method="post" name="frm1"  enctype="multipart/form-data" action="<?php print WEB_URL_ADMIN?>admin/update_excursion/<?php echo $excursion_id; ?>" > <!--onsubmit="return citydesc();"-->

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Type:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="pack_type" class="getfields" style="height:28px; width:362px;">
                    <option value="dom" <?php if(isset($excursion_det)){if($excursion_det != ''){if($excursion_det->ex_type == 'dom'){?> selected="selected" <?php }}}?>>Domestic</option>
                    <option value="int" <?php if(isset($excursion_det)){if($excursion_det != ''){if($excursion_det->ex_type == 'int'){?> selected="selected" <?php }}}?>>International</option>
                    </select>
						
                </td>
            </tr>
          <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Location:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="city" id="testinput" class="getfields" style="width:350px;" value="<?php print $excursion_det->ex_location; ?>" />
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
                    <span >Package Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="activity_name" value="<?php print $excursion_det->ex_name; ?>" class="getfields" style="width:350px;"  />
						
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Duration:<br/>(Mention the Duration in Day)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <?php /*?><input type="text" name="duration" class="getfields" style="width:350px;"   value="<?php print $excursion_det->ex_duration; ?>"  /> <?php */?>
					<select name="duration" class="getfields" style="width:150px; height:30px;" >
                    	<option value="">Select</option>
                        <?php for($i=1; $i<=31; $i++)
						{ ?> <option value="<?php echo $i; ?>" <?php if($excursion_det->ex_duration ==$i) { echo "selected"; } ?> ><?php echo $i; ?></option>
                        <?php } ?>
                    </select>	
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Image:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input type="file" name="image" class="getfields" style="width:350px;"   />
                   <img src="<?php print WEB_DIR_ADMIN ?>excursionimages/<?php echo $excursion_det->ex_mainimage; ?>" width="100" height="100"  />
        <input type="hidden" name="excursion_image" value="<?php echo $excursion_det->ex_mainimage; ?>"  />
						
                </td>
            </tr>
          <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Detail:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="ex_details" id="ex_details" ><?php print $excursion_det->ex_detail; ?></textarea> 
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >  Price From:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="price" value="<?php print $excursion_det->ex_price; ?>" class="getfields" style="width:350px;"    />
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Product Code:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="product_code" value="<?php print $excursion_det->ex_productcode; ?>" class="getfields" style="width:350px;" />
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Video:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="video" ><?php print $excursion_det->ex_video; ?></textarea> 
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">OR</td>
                <td style="border-bottom:1px solid #dcdcdc;">&nbsp;</td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Package Banner:</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="file" name="banner" class="getfields" style="width:350px;"/>
                    <img src="<?php print WEB_DIR_ADMIN ?>excursionimages/<?php echo $excursion_det->ex_image; ?>" width="100" height="100"  />
        <input type="hidden" name="banner_image" value="<?php echo $excursion_det->ex_image; ?>"  />
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Package Shedule Details</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  
						<label for="textfield"></label>
						<textarea class="getfields" name="shedule_details" id="shedule_details" ><?php echo $excursion_det->ex_shedule; ?></textarea> 
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Price Infants (0m - 24m)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  <input type="text" name="price_infant" class="getfields" style="width:350px;"  value="<?php echo $excursion_det->ex_priceinfant; ?>"  />
                </td>
            </tr>
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Child (2y - 12)</td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="text" name="price_child" class="getfields" style="width:350px;"  value="<?php echo $excursion_det->ex_pricechild; ?>"  />
            </tr>
            
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Adult (12 + )</td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="text" name="price_adult" class="getfields" style="width:350px;"  value="<?php echo $excursion_det->ex_priceadult; ?>"  />
					</td>
            </tr>
            
            
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Includes</td>
                <td style="border-bottom:1px solid #dcdcdc;"><table width="100%" height="200" border="0">
				  <tr>
				    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk" value="1" 
					<?php if($excursion_det->ex_price_includes_chk == 1){ ?> checked="checked"<?php }?> />&nbsp;Flight Taxes</td>
				    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk2" value="1"
                    <?php if($excursion_det->ex_price_includes_chk2 == 1){ ?> checked="checked"<?php }?> />&nbsp;ATOL Protection</td>
				    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk3" value="1" 
                    <?php if($excursion_det->ex_price_includes_chk3 == 1){ ?> checked="checked"<?php }?>/>&nbsp;20 Kgs Luggage</td>
                    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk4" value="1"
                    <?php if($excursion_det->ex_price_includes_chk4 == 1){ ?> checked="checked"<?php }?> />&nbsp;Flight Details</td>
				    
			      </tr>
					  <tr>
					    <td height="50" style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes" id="price_includes" class="getfields" style="width:100px; height:30px;"  >
                        <?php echo $excursion_det->ex_priceincludes; ?></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes2" id="price_includes2" class="getfields" style="width:100px; height:30px;" >
                        <?php echo $excursion_det->ex_priceincludes2; ?></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes3" id="price_includes3" class="getfields" style="width:100px; height:30px;" >
                        <?php echo $excursion_det->ex_priceincludes3; ?></textarea>&nbsp;Add Comment </td>
                        <td style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes4" id="price_includes4" class="getfields" style="width:100px; height:30px;"  >
                        <?php echo $excursion_det->ex_priceincludes4; ?></textarea>&nbsp;Add Comment</td>
					    
				      </tr>
                      <tr>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      </tr>
                       <tr>
				    <td width="25%"><input type="checkbox" name="price_includes_chk5" value="1" 
                    <?php if($excursion_det->ex_price_includes_chk5 == 1){ ?> checked="checked"<?php }?>/>&nbsp;Accomodation</td>
				    <td width="25%"><input type="checkbox" name="price_includes_chk6" value="1"
                    <?php if($excursion_det->ex_price_includes_chk6 == 1){ ?> checked="checked"<?php }?> />&nbsp;Breakfast</td>
				    <td width="25%"><input type="checkbox" name="price_includes_chk7" value="1" 
                    <?php if($excursion_det->ex_price_includes_chk7 == 1){ ?> checked="checked"<?php }?>/>&nbsp;Meals</td>
                    <td width="25%"><input type="checkbox" name="price_includes_chk8" value="1" 
                    <?php if($excursion_det->ex_price_includes_chk8 == 1){ ?> checked="checked"<?php }?>/>&nbsp;Airport Transfer </td>
				    
			      </tr>
					  <tr>
					    <td height="50" style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes5" id="price_includes5" class="getfields" style="width:100px; height:30px;"  >
                        <?php echo $excursion_det->ex_priceincludes5; ?></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes6" id="price_includes6" class="getfields" style="width:100px; height:30px;" >
                        <?php echo $excursion_det->ex_priceincludes6; ?></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes7" id="price_includes7" class="getfields" style="width:100px; height:30px;" >
                        <?php echo $excursion_det->ex_priceincludes7; ?></textarea>&nbsp;Add Comment </td>
                        <td style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes8" id="price_includes8" class="getfields" style="width:100px; height:30px;"  >
                        <?php echo $excursion_det->ex_priceincludes8; ?></textarea>&nbsp;Add Comment</td>
					    
				      </tr>
                      <tr>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      </tr>
                      <tr>
				    <td width="25%"><input type="checkbox" name="price_includes_chk9" value="1"
                    <?php if($excursion_det->ex_price_includes_chk9 == 1){ ?> checked="checked"<?php }?> />&nbsp;Sightseen</td>
				 	  </tr>
					  <tr>
					    <td height="50">
                        	<textarea name="price_includes9" id="price_includes9" class="getfields" style="width:100px; height:30px;"  >
							<?php echo $excursion_det->ex_priceincludes9; ?></textarea>&nbsp;Add Comment</td>
					  </tr>
				  </table></td>
            </tr>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Excludes</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="price_excludes" id="price_excludes" class="getfields" ><?php echo $excursion_det->ex_priceexcludes; ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Additional Details</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="additional_details" id="additional_details" class="getfields"><?php echo $excursion_det->ex_additionaldet; ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Itinerary</td>
                <td style="border-bottom:1px solid #dcdcdc;">
               <textarea type="text" name="more_det" id="more_det" class="getfields" ><?php echo $excursion_det->ex_moredet; ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Diving</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="diving" id="diving" class="getfields" ><?php echo $excursion_det->ex_diving; ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Surfing</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="surfing" id="surfing" class="getfields" ><?php echo $excursion_det->ex_surfing; ?></textarea>
                </td>
            </tr>
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Cancellation Policy</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="cancel_policy" id="cancel_policy" class="getfields" ><?php echo $excursion_det->cancel_policy; ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Terms & Conditions</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="term_cond" id="term_cond" class="getfields" ><?php echo $excursion_det->term_cond; ?></textarea>
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
    <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Image Gallery:<br/>(Multiple picture can be selected)</td>
    <td style="border-bottom:1px solid #dcdcdc;">
    <input name="new_image[]"  type="file" multiple class="getfields" style="width:350px; height:30px;"  /></td>
    <!--<td width="28%" style="border-bottom:1px solid #dcdcdc;"> 
    <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" /></div></td>-->
  </tr>
  
</table>
<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
       
		<?php  $pic = $this->Home_Model->HolidayGallery($excursion_det->excursion_id);
				$k=1;
				//echo count($pic);
		if(isset($pic)){ if($pic != '') { ?>
        <input type="hidden" name="count" value="<?php echo count($pic);?>" />
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="100%">
				<?php foreach($pic as $p){ ?>
                 <div class="image-box" id="pic<?php echo $p->gallery_id;?>">
                 <div>
                 
                 <img src="<?php echo WEB_DIR_ADMIN ?>excursionimages/<?php echo $p->image?>" width="185" height="180" border="0" style="margin:4px;" />
                 <div class="checkbox-bg">
                 <span style="float:left; margin-top:2px;">
				<?php /*?> <input name="htlfcltycb1" id="htlfcltycb1" type="checkbox" <?php if($p->status == 1){?> checked="checked" <?php } else { ?> checked="checked" <?php }?> value="<?php echo $p->sup_apart_roompictures_id;?>" /><?php */?></span>
                 <span style=" float:left;">
				<a href="<?php echo WEB_URL_ADMIN ?>admin/delete_gallery_pic/<?php echo $p->gallery_id;?>/<?php echo $excursion_det->excursion_id ;?>" onclick="return confirm('Click Ok to delete this picture')"> 
                <img src="<?php echo WEB_DIR?>images/minus.png" width="18" height="18" border="0" style="vertical-align:top; margin-left:5px;" /></a></</span>
                 </div>
                 <?php /*?><div ><textarea name="cmnts_<?php echo $p->gallery_id ;?>" id="cmnts1" cols="" rows="" class="text-box-bg">
				 <?php echo $p->description;?></textarea></div><?php */?>
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
                <input type="hidden" id="count" name="count" value=""/>
                <input type="hidden" id="apartfec_val" name="apartfec_val" value=""/>
                <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>
        </tbody>
    </table>
<?php /*?><table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr>
              <?php $gallery = $this->Home_Model->HolidayGallery($excursion_det->excursion_id);
			  		if(isset($gallery)){if($gallery != ''){foreach($gallery as $img){
						//echo "<pre>"; print_r($img);exit?>
                <td><div style="border: 1px solid #CCCCCC; float: left; height: 200px; margin: 5px; position: relative; width: 193px;">
                <img src="<?php echo WEB_DIR_ADMIN ?>excursionimages/<?php echo $img->image?>" width="180" height="180" /></div></td>
                <?php }}}?>
              </tr>
            </table><?php */?>
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
function delete_pic(id)
{

	if(confirm('Are you sure want to delete this Picture?'))
	{
		//alert(id);
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
	}
	else
	{
		return false;
	}			
}
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
</script>
