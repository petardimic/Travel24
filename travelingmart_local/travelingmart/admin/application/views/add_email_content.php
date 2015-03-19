<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
		
 <div class="clr"></div>
<script type="text/javascript">
  document.createElement('nav');
  $(document).ready(function() 
		{
  <?php if(isset($content)){if($content!=''){ ?> 
		document.getElementById("title").disabled = true;
	
	<?php }}?>	});
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
   <form action="<?php echo WEB_URL_ADMIN?>admin/add_email_content" method="post" name="email_content" id="email_content"  enctype="multipart/form-data">
  <input type="hidden" name="email_type_id" value="<?php echo $id?>"/>
   <div style="float:left; height:auto;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table">
       <tbody>
         <tr>
           <td class="clsName"><h3>&nbsp;</h3></td>
           <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">Add Email Content</td>
         </tr>
         <tr>
           <td width="70" class="clsName">&nbsp;</td>
           <td class="clsMailID"><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Title</span></td>
               <td>:</td>
               <td><select name="title" id="title" style="width:400px;">
			   <option value="">Please Select Title</option>
			   <?php if(isset($emails)){if($emails !=''){foreach($emails as $e){?>
			   <option value="<?php echo $e->email_types_id?>" <?php if(isset($content)){if($content != ''){if($content->email_types_id == $e->email_types_id){?> selected="selected" <?php }}}?>><?php echo $e->email_title; ?></option>
			   <?php }}}?>
			   </select><br/><span id="err_title"></span></td>
             </tr>
			 
           </table></td>
         </tr>
		<tr>
           <td class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Subject</span></td>
               <td>:</td>
               <td><input name="subject" id="subject" type="text" style="width:400px;" value="<?php if(isset($content)){if($content != ''){echo $content->email_subject;}}?>" /><br/><span id="err_subject"></span></td>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
		
          <tr>
           <td class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Html Content</span></td>
               <td>:</td>
               <td><textarea name="html_content" id="html_content"><?php if(isset($content)){if($content != ''){echo $content->html_content;}}?></textarea>
			    <script type="text/javascript">

        CKEDITOR.replace('html_content', 
       {
       docType : '<!DOCTYPE HTML>',
       // filebrowserBrowseUrl : 'browser/browser.php',
       //filebrowserUploadUrl : '<?php echo WEB_DIR?>upload.php'
       });
               
     </script></td>
             </tr>
           </table></td>
         </tr>
		   <tr>
           <td class="clsName">&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
		<tr>
		 <tr>
           <td class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Footer</span></td>
               <td>:</td>
               <td><textarea name="footer" id="footer"><?php if(isset($content)){if($content != ''){echo $content->footer;}}?></textarea>
			    <script type="text/javascript">

        CKEDITOR.replace('footer', 
       {
       docType : '<!DOCTYPE HTML>',
       // filebrowserBrowseUrl : 'browser/browser.php',
       //filebrowserUploadUrl : '<?php echo WEB_DIR?>upload.php'
       });
               
     </script></td>
             </tr>
           </table></td>
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
