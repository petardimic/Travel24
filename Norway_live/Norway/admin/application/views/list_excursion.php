
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title> List Holiday</title>
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
      <?php $this->load->view('header2');?>
        <!-- Header -->
    <div class="fix"></div>

    <div id="sidebar-position" style="position:absolute; margin-top:20px;">
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
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">List Holidays</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/list_excursion" style="font-size:13px; color:#fff;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    
            

 			 <?php /*?><table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
         <tr>
          <td colspan="13" align="right" class="add-your-property" style="border-bottom:1px solid #dcdcdc;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_excursion" style="color:#fff"/>Add Holiday</a></td>
          </tr>
          <tr>
          <td colspan="13" align="center" height="30" class="add-your-property" style="border-bottom:1px solid #dcdcdc; font-weight:bold; font-size:18px; color:#800000">Domestic Holidays</td>
          </tr>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Theme </span>
                 </strong></td>
                
				<td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Holiday Name  </span>
                 </strong></td>
                 
                   
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Location</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Duration</span>
                 </strong></td>
                 
                 
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price from (INR)</span>
                 </strong></td>
                 
                                  
                <!-- <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Added By</span>
                 </strong></td>-->
  					
                     <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Add Hotel</span>
                 </strong></td>
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> List Hotel</span>
                 </strong></td>
                   <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Add Destination</span>
                 </strong></td>
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> List Destination</span>
                 </strong></td>
                 
                   <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Edit</span>
                 </strong></td>
                 
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Delete</span>
                 </strong></td>
            </tr>
             <?php
			 if(isset($permissions)){if($permissions !=''){
			 $per = explode(',',$permissions->prop);
			 }}
			 $m = 1;
				if(isset($excursion)){ if($excursion != '') { ?>
					 
					  <?php foreach ($excursion as $row){ ?>
                      <tr>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span ><?php echo $row->holiday_theme; ?></span>
                            </td>
                         
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_name; ?></span>
                            </td>
                            
                            
                                                      
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_location; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_duration; ?></span>
                            </td>
                            
                          
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_price; ?></span>
                            </td>
                            
                                                        
                             <!--<td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->added_by; ?></span>
                            </td>-->
                            
                            <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_holiday_hotel/<?php echo $row->excursion_id; ?>" style="color:#fff">Add Hotel</a></td>
                            
                            <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/list_holiday_hotels/<?php echo $row->excursion_id; ?>" style="color:#fff">List Hotel</a></td>
                            
                             <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_holiday_destination/<?php echo $row->excursion_id; ?>" style="color:#fff">Add Destination</a></td>
                            
                            <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/list_holiday_destination/<?php echo $row->excursion_id; ?>" style="color:#fff">List Destination</a></td>
                           
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span style="color:#F10E21;"><a href="<?php print WEB_URL_ADMIN ?>admin/edi_excursion/<?php echo $row->excursion_id; ?>"><img src="<?php print WEB_DIR ?>images/edit_icon.jpg"  /></a></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                 <?php  if($this->session->userdata('new_user_id')) {?>
                              
                             <span> - </span>
                           
                              <?php }else{?>
                              <span><a href="<?php print WEB_URL_ADMIN ?>admin/delete_excursion/<?php echo $row->excursion_id; ?>" ><img src="<?php echo WEB_DIR?>supplier_includes/images/delete.png" alt=" Delete" title=" Delete" onclick="return confirm('Are you sure want to delete this Package?')"  /></a></span>
                              <?php }?>
                            </td>
                      </tr>
					  <?php
					$m++; } 
				}
				}
			
			 ?>
                <?php  if($this->session->userdata('new_user_id')) {}else{?>
         
          <?php }?>
        </tbody>
    </table><?php */?>
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
         <tr>
          <td colspan="13" align="center" height="30" class="add-your-property" style="border-bottom:1px solid #dcdcdc; font-weight:bold; font-size:18px; color:#800000">International Holidays</td>
          </tr>
         <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Theme </span>
                 </strong></td>
                
				<td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Holiday Name  </span>
                 </strong></td>
                 
                   
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Location</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Duration</span>
                 </strong></td>
                 
                 
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price from (INR)</span>
                 </strong></td>
                 
                                  
                <!-- <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Added By</span>
                 </strong></td>-->
  					
                     <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Add Hotel</span>
                 </strong></td>
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> List Hotel</span>
                 </strong></td>
                   <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Add Destination</span>
                 </strong></td>
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> List Destination</span>
                 </strong></td>
                 
                  <!-- <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Edit</span>
                 </strong></td>-->
                 
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Delete</span>
                 </strong></td>
            </tr>
             <?php
			 if(isset($permissions)){if($permissions !=''){
			 $per = explode(',',$permissions->prop);
			 }}
			 $m = 1;
				if(isset($excursion_inter)){ if($excursion_inter != '') { ?>
					 
					  <?php foreach ($excursion_inter as $row){ ?>
                      <tr>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span ><?php echo $row->holiday_theme; ?></span>
                            </td>
                         
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_name; ?></span>
                            </td>
                            
                            
                                                      
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_location; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_duration; ?></span>
                            </td>
                            
                          
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_price; ?></span>
                            </td>
                            
                                                        
                             <!--<td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->added_by; ?></span>
                            </td>-->
                            
                            <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_holiday_hotel/<?php echo $row->excursion_id; ?>" style="color:#fff">Add Hotel</a></td>
                            
                            <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/list_holiday_hotels/<?php echo $row->excursion_id; ?>" style="color:#fff">List Hotel</a></td>
                            
                             <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_holiday_destination/<?php echo $row->excursion_id; ?>" style="color:#fff">Add Destination</a></td>
                            
                            <td  align="center" class="add-your-property" style="border-bottom:1px solid #dcdcdc; color:#fff; line-height:20px;"><a href="<?php echo WEB_URL_ADMIN ?>admin/list_holiday_hotels/<?php echo $row->excursion_id; ?>" style="color:#fff">List Destination</a></td>
                           
                            <?php /*?> <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span style="color:#F10E21;"><a href="<?php print WEB_URL_ADMIN ?>admin/edi_excursion/<?php echo $row->excursion_id; ?>"><img src="<?php print WEB_DIR ?>images/edit_icon.jpg"  /></a></span>
                            </td><?php */?>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                 <?php  if($this->session->userdata('new_user_id')) {?>
                              
                             <span> - </span>
                           
                              <?php }else{?>
                              <span><a href="<?php print WEB_URL_ADMIN ?>admin/delete_excursion/<?php echo $row->excursion_id; ?>" ><img src="<?php echo WEB_DIR?>supplier_includes/images/delete.png" alt=" Delete" title=" Delete" onclick="return confirm('Are you sure want to delete this Package?')"  /></a></span>
                              <?php }?>
                            </td>
                      </tr>
					  <?php
					$m++; } 
				}
				}
			
			 ?>
                <?php  if($this->session->userdata('new_user_id')) {}else{?>
         
          <?php }?>
        </tbody>
    </table>


	
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
