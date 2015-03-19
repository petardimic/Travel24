 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
		
 <div class="clr"></div>
 <script type="text/javascript">
$(document).ready(function() 
		{
   <?php if(isset($res)){if($res != ''){if($res->menu == 'About' && $res->sub_menu){?> $('#menu_about').show(); <?php }}}?>	
     <?php if(isset($res)){if($res != ''){if($res->menu == 'Insider' && $res->sub_menu){?> $('#menu_insider').show(); <?php }}}?>	
   });
</script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.editorConfig = function( config )
{
 config.toolbar = 'MyToolbar';
//            config.height = 1800;

 config.toolbar_MyToolbar =
   [

 ['Cut','Copy','Paste','PasteText','PasteFromWord'],
 ['Undo','Redo','SelectAll','RemoveFormat'],
 ['Link','Unlink','Image','Table','HorizontalRule','Smiley'],
 ['TextColor','BGColor','FontSize'],
 ['NumberedList','BulletedList'],
 '/',
 ['Bold','Italic','Underline','Strike','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
 ['Styles','Format','Font','Source']
 ];
};

</script>
 <div id="container_warpper" style="padding-bottom:00px;" >
   <form action="<?php echo WEB_URL_ADMIN?>admin/update_static/<?php echo $res->static_pages_id?>" method="post" >
  
   <div style="float:left; height:auto;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table">
       <tbody>
         <tr>
           <td class="clsName"><h3>&nbsp;</h3></td>
           <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">Add Page</td>
         </tr>
         <tr>
           <td width="70" class="clsName">&nbsp;</td>
           <td class="clsMailID"><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Menu</span></td>
               <td>:</td>
               <td><select name="menu" id="menu" style="width:207px;" disabled="disabled" >
			   <option value="">Select Menu</option>
			   <option value="About" <?php if(isset($res)){if($res!=''){if($res->menu == 'About'){?> selected="selected"<?php }}}?>>About</option>
			   <option value="Insider" <?php if(isset($res)){if($res!=''){if($res->menu == 'Insider'){?> selected="selected"<?php }}}?>>Insider</option>
			   <option value="Contact Us" <?php if(isset($res)){if($res!=''){if($res->menu == 'Contact Us'){?> selected="selected"<?php }}}?>>Contact Us</option>
			   <option value="FAQ" <?php if(isset($res)){if($res!=''){if($res->menu == 'FAQ'){?> selected="selected"<?php }}}?>>FAQ</option>
			   </select></td>
             </tr>
			 
           </table></td>
		 
         </tr>
		  <tr style="display:none;" id="menu_about">
           <td width="70" class="clsName">&nbsp;</td>
           <td class="clsMailID"><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Sub Menu</span></td>
               <td>:</td>
               <td><select name="sub_menu_about" id="sub_menu_about" style="width:207px;" disabled="disabled" >
			   <option value="">Select Sub Menu</option>
			   <option value="About Us"  <?php if(isset($res)){if($res!=''){if($res->sub_menu == ' About Us'){?> selected="selected"<?php }}}?>> About Us</option>
			   <option value="The Team" <?php if(isset($res)){if($res!=''){if($res->sub_menu == 'The Team'){?> selected="selected"<?php }}}?>>The Team</option>
			   <option value="Careers" <?php if(isset($res)){if($res!=''){if($res->sub_menu == 'Careers'){?> selected="selected"<?php }}}?>>Careers</option>
			   </select></td>
             </tr>
			 
           </table></td>
         </tr>
		  <tr style="display:none;" id="menu_insider">
           <td width="70" class="clsName">&nbsp;</td>
           <td class="clsMailID"><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Sub Menu</span></td>
               <td>:</td>
               <td><select name="sub_menu_insider" id="sub_menu_insider" style="width:207px;" disabled="disabled" >
			   <option value="">Select Sub Menu</option>
			   <option value="Price Guarantee" <?php if(isset($res)){if($res!=''){if($res->sub_menu == 'Price Guarantee'){?> selected="selected"<?php }}}?>>Price Guarantee</option>
			   <option value="Save up to 30% " <?php if(isset($res)){if($res!=''){if($res->sub_menu == 'Save up to 30% '){?> selected="selected"<?php }}}?>>Save up to 30% </option>
			   <option value="Our Solutions" <?php if(isset($res)){if($res!=''){if($res->sub_menu == 'Our Solutions'){?> selected="selected"<?php }}}?>>Our Solutions</option>
                 <option value="Links" <?php if(isset($res)){if($res!=''){if($res->sub_menu == 'Links'){?> selected="selected"<?php }}}?>>Links</option>
			   </select></td>
             </tr>
			 
           </table></td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Menue Title</span></td>
               <td>:</td>
               <td><input name="title" id="title" type="text" size="30" value="<?php if(isset($res)){if($res != ''){ echo $res->title; }}?>" /></td>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td><span class="clsName">Page Content</span></td>
         </tr>
         <tr>
           <td valign="middle" class="clsName">&nbsp;</td>
           <td><textarea rows="2" name="test" id="test"><?php echo $res->content;?></textarea>
            
                              <script type="text/javascript">

        CKEDITOR.replace('test', 
       {
       docType : '<!DOCTYPE HTML>',
       // filebrowserBrowseUrl : 'browser/browser.php',
       filebrowserUploadUrl : '<?php echo WEB_DIR?>upload.php'
       });
               
     </script>

             <span class="mceEditor defaultSimpleSkin" id="elm1_container">
               
             </span></td>
         </tr>
         <tr>
           <td></td>
           <td>
		   <input type="image" src="<?php echo WEB_DIR_ADMIN?>images/submit_btn.png"  width="72" height="22" border="0"/></td>
         </tr>
         <tr>
           <td></td>
           <td>&nbsp;</td>
         </tr>
       </tbody>
     </table>
   </div>     
       </form>     
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
