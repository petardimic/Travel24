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
 <div id="container_warpper" style="padding-bottom:0px;" >
   <form action="<?php echo WEB_URL_ADMIN?>admin/get_agents" method="post" onsubmit="return validate();"  enctype="multipart/form-data">
  
   <div style="float:left; height:auto; width:980px; margin-left:10px; margin-top:10px; border-top:1px #CCC solid;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table">
       <tbody>
         <tr>
           <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">&nbsp;</td>
         </tr>
         <tr>
           <td align="center" style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">Agent Search</td>
         </tr>
         
		 
         <tr>
           <td>&nbsp;</td>
         </tr>
         <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="290" align="right"><span class="clsName">Agent Name</span></td>
                  <td width="26" align="center"> : </td>
                  <td width="464"><input name="agent_name" id="title" type="text" class="field"/></td>
                </tr>
                <tr>
                  <td align="right" class="clsName">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td width="290" align="right"><span class="clsName">Agent Id</span></td>
                  <td align="center"> : </td>
                  <td><input name="agent_id" id="title" type="text" class="field" /></td>
                </tr>
                <tr>
                  <td align="right" class="clsName">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td width="290" align="right"><span class="clsName">Cell No</span></td>
                  <td align="center"> : </td>
                  <td><input name="cell_no" id="cell_no" type="text" class="field" /></td>
                </tr>
                <tr>
                  <td align="right" class="clsName">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                </tr>
                <tr>
                  <td width="290" align="right"><span class="clsName">Email Id</span></td>
                  <td align="center"> : </td>
                  <td><input name="email_id" id="email_id" type="text" class="field" /></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td><input type="image" src="<?php echo WEB_DIR_ADMIN?>images/submit_btn.png"  border="0"/></td>
                </tr>
                <tr>
                  <td align="right">&nbsp;</td>
                  <td align="center">&nbsp;</td>
                  <td>&nbsp;</td>
                </tr>
            </table></td>
         </tr>
         <tr>
           <td>&nbsp;</td>
         </tr>
             
           </table></td>
         </tr>
         <tr>
           <td class="clsName">&nbsp;</td>
           <td>&nbsp;</td>
         </tr>
            
           </table></td>
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
