 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
		
 <div class="clr"></div>
<script type="text/javascript">
function validate()
{
	var val = $('#menu').val();
	if(val == '')
	{
		alert('Please Select Menu');
		document.getElementById('menu').focus();
		return false;
	}
	var title = $('#title').val();
	if(title == '')
	{
		alert('Please Enter URL');
		document.getElementById('title').focus();
		return false;
	}
}
</script>
 <div id="container_warpper" style="padding-bottom:00px;" >
   <form action="<?php echo WEB_URL_ADMIN?>admin/add_ext" method="post" onsubmit="return validate();"  enctype="multipart/form-data">
  
   <div style="float:left; height:auto;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table">
       <tbody>
         <tr>
           <td class="clsName"><h3>&nbsp;</h3></td>
           <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">Add External link</td>
         </tr>
         <tr>
           <td width="70" class="clsName">&nbsp;</td>
           <td class="clsMailID"><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Menu</span></td>
               <td>:</td>
               <td><select name="menu" id="menu" style="width:207px;" onchange="return select_submenu(this.value);" >
			   <option value="">Select Menu</option>
			   <option value="Blog">Blog</option>
			   <option value="Help">Help & Support</option>
			   <option value="terms">Terms & Condtions</option>
			   <option value="privacy">Privacy</option>
			    <option value="termsofsup">Terms of Collaboration</option>
				 <option value="contact">Contact</option>
			   </select></td>
             </tr>
			 
           </table></td>
         </tr>
		  
		  
         <tr>
           <td class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Url</span></td>
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
		

</div>
