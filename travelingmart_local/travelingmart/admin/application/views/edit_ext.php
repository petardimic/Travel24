 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
		
 <div class="clr"></div>
 <div id="container_warpper" style="padding-bottom:00px;" >
   <form action="<?php echo WEB_URL_ADMIN?>admin/update_ext/<?php echo $res->external_links_id?>" method="post" >
  
   <div style="float:left; height:auto;">
     <table width="100%" align="center" cellpadding="4" cellspacing="0" class="table">
       <tbody>
         <tr>
           <td class="clsName"><h3>&nbsp;</h3></td>
           <td style="font-family:Arial, Helvetica, sans-serif; font-size:16px; font-weight:bold;">Update External Link Page</td>
         </tr>
         <tr>
           <td width="70" class="clsName">&nbsp;</td>
           <td class="clsMailID"><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">Menu</span></td>
               <td>:</td>
               <td><select name="menu" id="menu" style="width:207px;" disabled="disabled" >
			   <option value="">Select Menu</option>
			   <option value="About" <?php if(isset($res)){if($res!=''){if($res->name == 'Blog'){?> selected="selected"<?php }}}?>>Blog</option>
				<option value="About" <?php if(isset($res)){if($res!=''){if($res->name == 'Help'){?> selected="selected"<?php }}}?>>Help & Support</option>
				<option value="About" <?php if(isset($res)){if($res!=''){if($res->name == 'terms'){?> selected="selected"<?php }}}?>>Terms & Condtions</option>
				<option value="About" <?php if(isset($res)){if($res!=''){if($res->name == 'privacy'){?> selected="selected"<?php }}}?>>Privacy</option>
				<option value="About" <?php if(isset($res)){if($res!=''){if($res->name == 'termsofsup'){?> selected="selected"<?php }}}?>>Terms of Collaboration</option>
			   </select></td>
             </tr>
			 
           </table></td>
		 
         </tr>
		  
		  
         <tr>
           <td class="clsName">&nbsp;</td>
           <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
             <tr>
               <td width="180" align="left"><span class="clsName">URL</span></td>
               <td>:</td>
               <td><input name="title" id="title" type="text" size="30" value="<?php if(isset($res)){if($res != ''){ echo $res->url; }}?>" /></td>
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
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
