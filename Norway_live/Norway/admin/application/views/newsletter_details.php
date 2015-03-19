<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelingmart</title>
	
</head>

<body>

<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
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
<div id="container_warpper" >

<div class="right-wrapper">

   <form name="add_currency" id="add_currency" action="<?php echo WEB_URL_ADMIN?>admin/send_newsletter" method="post">
    <table width="750" border="0" align="center" cellpadding="0" cellspacing="0" style="border:1px solid #ccc; border-radius:8px 8px 0px 0px;  background:#fff; margin-top:20px;">
    
    <tr><td colspan="2" style="background:#333333; color:#fff; font-size:20px; text-align:center;height:30px; border-radius:6px 6px 0px 0px;"> Newsletter Template</td></tr>
    <tr><td height="20"></td></tr>
  <tr>
    <td width="129" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Email</td>
    <td width="400" style="padding:5px 0 15px 10px;">
       <input name="email" id="email" type="text" class="supplier_text291" style="border:1px solid #999; width:291px; height:auto; text-wrap:normal; overflow:hidden; display:block;" 
	  value="<?php   $N = count($sel);for($i=0; $i <=$N-1; $i++)echo($sel[$i] . ", ");?>"> 
      </td>
  </tr>
 <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Message</td>
    <td width="400" style="padding:5px 0 15px 10px;">
	<textarea rows="2" name="test" id="test"></textarea>
            
                              <script type="text/javascript">

        CKEDITOR.replace('test', 
       {
       docType : '<!DOCTYPE HTML>',
       // filebrowserBrowseUrl : 'browser/browser.php',
       filebrowserUploadUrl : '<?php echo WEB_DIR?>upload.php'
       });
               
     </script>
     
</td>
  </tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Subject</td>
    <td width="400" style="padding:5px 0 15px 10px;">
     
	   <input name="subject" id="subject" type="text" class="supplier_text291" style="border:1px solid #999; width:291px; height:auto; text-wrap:normal; overflow:hidden; display:block;" />
</td>
  </tr>
  <tr>
    <td align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">&nbsp;</td>
    <td style="padding:5px 0 15px 10px;">
                  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22">			  
                 <a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
	</td>
  </tr>
 
 </table>  
  </form></div>
</div>

</body>
</html>
