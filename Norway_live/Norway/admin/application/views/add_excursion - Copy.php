
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title> Add Holiday</title>
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
            });
        </script>

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
            <div class="table" style="margin-top:20px;">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title" style="position:absolute;">
					 
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Add Holiday</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/list_excursion" style="font-size:13px; color:#fff;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    
            

 <form method="post" name="frm1"  enctype="multipart/form-data" action="<?php print WEB_URL_ADMIN?>admin/insert_excursion" > <!--onsubmit="return citydesc();"-->

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
        <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Type:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="pack_type" class="getfields" style="height:28px; width:362px;">
                    <option value="dom" selected="selected">Domestic</option>
                    <option value="int">International</option>
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
                    <option value="<?php echo $row->item; ?>"><?php echo $row->item; ?></option>
                    <?php } } } ?>
                    </select>
						
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Starts at:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="city" id="testinput" class="getfields" style="width:350px;" />
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
                    <input type="text" name="activity_name" class="getfields" style="width:350px;"  />
						
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Duration: (Days)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="duration" class="getfields" style="width:350px;"   /> 
						
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Duration: (Hours)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="duration_hours" class="getfields" style="width:350px;"   /> 
						
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Image:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="file" name="image" class="getfields" style="width:350px; height:30px;"    />
						
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Highlight:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="highlight" id="highlight" style="height:70px; width:350px;"></textarea> 
                </td>
            </tr>
          <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Detail:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="ex_details" id="ex_details" style="height:70px; width:350px;"></textarea> 
                </td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >  Price From: (Per Person)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="price" class="getfields" style="width:350px;"  />
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >  Price Fake: (Per Person)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input type="text" name="price_fake" class="getfields" style="width:350px;"  />
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
                    <textarea class="getfields" name="inclusion" id="inclusion" style="height:70px; width:350px;"></textarea> 
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Exclusions:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="exclusion" id="exclusion" style="height:70px; width:350px;"></textarea> 
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
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Itinerary</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="more_det" id="itinary" class="getfields" ></textarea>
                </td>
            </tr>
              <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday Video:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <textarea class="getfields" name="video" ></textarea> 
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">OR</td>
                <td style="border-bottom:1px solid #dcdcdc;">&nbsp;</td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Holiday Banner: (Multiple picture can be selected)</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <!--<input type="file" name="banner" multiple class="getfields" style="width:350px;"  />-->
                     <input name="banner[]"  type="file" multiple class="getfields" style="width:350px; height:30px;"  />
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Holiday map (Google map)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  
						<label for="textfield"></label>
						<textarea class="getfields" name="shedule_details" id="shedule_details" ></textarea> 
                </td>
            </tr>
            
            <!--<tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Price Infants (0m - 24m)</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  <input type="text" name="price_infant" class="getfields" style="width:350px;"   />
                </td>
            </tr>
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Child (2y - 12)</td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="text" name="price_child" class="getfields" style="width:350px;"   /></td>
            </tr>
            
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Adult (12 + )</td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input type="text" name="price_adult" class="getfields" style="width:350px;"   /></td>
            </tr>-->
            
            
             <!--<tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Includes</td>
                <td style="border-bottom:1px solid #dcdcdc;"><table width="100%" height="200" border="0">
				  <tr>
				    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk" value="1" />&nbsp;Flight Taxes</td>
				    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk2" value="1" />&nbsp;ATOL Protection</td>
				    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk3" value="1" />&nbsp;20 Kgs Luggage</td>
                    <td width="25%" height="30"><input type="checkbox" name="price_includes_chk4" value="1" />&nbsp;Flight Details</td>
				    
			      </tr>
					  <tr>
					    <td height="50" style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes" id="price_includes" class="getfields" style="width:100px; height:30px;"  ></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes2" id="price_includes2" class="getfields" style="width:100px; height:30px;" ></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes3" id="price_includes3" class="getfields" style="width:100px; height:30px;" ></textarea>&nbsp;Add Comment </td>
                        <td style="border-bottom:1px solid #dcdcdc;" >
                        <textarea name="price_includes4" id="price_includes4" class="getfields" style="width:100px; height:30px;"  ></textarea>&nbsp;Add Comment</td>
					    
				      </tr>
                      <tr>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      </tr>
                       <tr>
				    <td width="25%"><input type="checkbox" name="price_includes_chk5" value="1" />&nbsp;Accomodation</td>
				    <td width="25%"><input type="checkbox" name="price_includes_chk6" value="1" />&nbsp;Breakfast</td>
				    <td width="25%"><input type="checkbox" name="price_includes_chk7" value="1" />&nbsp;Meals</td>
                    <td width="25%"><input type="checkbox" name="price_includes_chk8" value="1" />&nbsp;Airport Transfer </td>
				    
			      </tr>
					  <tr>
					    <td height="50" style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes5" id="price_includes5" class="getfields" style="width:100px; height:30px;"  ></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes6" id="price_includes6" class="getfields" style="width:100px; height:30px;" ></textarea>&nbsp;Add Comment</td>
					    <td style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes7" id="price_includes7" class="getfields" style="width:100px; height:30px;" ></textarea>&nbsp;Add Comment </td>
                        <td style="border-bottom:1px solid #dcdcdc;">
                        <textarea name="price_includes8" id="price_includes8" class="getfields" style="width:100px; height:30px;"  ></textarea>&nbsp;Add Comment</td>
					    
				      </tr>
                      <tr>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      <td style="border-bottom:1px solid #dcdcdc;" >&nbsp;</td>
                      </tr>
                      <tr>
				    <td width="25%"><input type="checkbox" name="price_includes_chk9" value="1" />&nbsp;Sightseen</td>
				 	  </tr>
					  <tr>
					    <td height="50">
                        	<textarea name="price_includes9" id="price_includes9" class="getfields" style="width:100px; height:30px;"  ></textarea>&nbsp;Add Comment</td>
					  </tr>
				  </table></td>
            </tr>-->
            
            <!--<tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Price Excludes</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="price_excludes" id="price_excludes" class="getfields" ></textarea>
                </td>
            </tr>-->
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Additional Details</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea name="additional_details" id="additional_details" class="getfields"></textarea>
                </td>
            </tr>
            
            
            
          <!--  <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Diving</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="diving" id="diving" class="getfields" ></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Surfing</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="surfing" id="surfing" class="getfields" ></textarea>
                </td>
            </tr>-->
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Cancellation Policy</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="cancel_policy" id="cancel_policy" class="getfields" ></textarea>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">Terms & Conditions</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                <textarea type="text" name="term_cond" id="term_cond" class="getfields" ></textarea>
                </td>
            </tr>
            
            
            
            
             <!--<tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span ></span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                </td>
            </tr>-->
            
            
            
            <!--<tr>
				<td colspan="5" align="left" style=" border-bottom:1px solid #dcdcdc;">
              
				
                <div style="float:right;">
				<input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>-->
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
