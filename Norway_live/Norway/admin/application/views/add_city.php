 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
		
 <div class="clr"></div>
<script type="text/javascript">

function validate()
{
	
	if(title == '')
	{
		alert('Please Enter Title');
		document.getElementById('title').focus();
		return false;
	}
}
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
   <form action="<?php echo WEB_URL_ADMIN?>admin/add_city" method="post" onsubmit="return validate();"  enctype="multipart/form-data">
  
   <div style="float:left; height:auto;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table">
       <tbody>
         <tr>
           <td class="clsName"><h3>&nbsp;</h3></td>
           <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">Add City</td>
         </tr>
         
		 
         <tr>
              <td width="70" class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">City Name</span></td>
               <td>:</td>
               <td><input name="title" id="title" type="text" size="30" /></td>
             </tr>
           </table></td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td><span class="clsName">City Content</span></td>
         </tr>
         <tr>
           <td valign="middle" class="clsName">&nbsp;</td>
           <td><textarea rows="2" name="test" id="test"></textarea>
            
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
