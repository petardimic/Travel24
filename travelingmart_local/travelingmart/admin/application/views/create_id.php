 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>travelingmart</title>
		
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
   <form action="<?php echo WEB_URL_ADMIN?>admin/creates_agent_id/<?php echo $id; ?>" method="post" onsubmit="return validate();"  enctype="multipart/form-data">
  
   <div style="float:left; height:auto; margin:20px 10px 15px 20px; width:960px;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table" style="border-top:1px #CCC solid">
       <tbody>
         <tr>
           <td colspan="3" align="center" valign="middle" style="font-weight:bold; font-size:20px;">&nbsp;</td>
         </tr>
         <tr>
           <td colspan="3" align="center" valign="middle" style="font-weight:bold; font-size:20px;"> Create Agent Id</td>
          </tr>
         
		 
         
           <td height="10" colspan="3" > </td>
           </tr>
             <tr>
               <td width="357" align="right"><span class="clsName">Agent Id</span></td>
               <td width="7"> : </td>
               <td width="504"><input name="agent_id" id="title" type="text" class="field" /></td>
             </tr>
             <tr>
               <td align="right">&nbsp;</td>
               <td>&nbsp;</td>
               <td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/submit_btn.png"  border="0"/></td>
             </tr>
             <tr>
               <td align="right">&nbsp;</td>
               <td>&nbsp;</td>
               <td>&nbsp;</td>
             </tr>
           </table>
     </td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
       
         
         <tr>
           <td></td>
           <td>&nbsp;</td>
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
