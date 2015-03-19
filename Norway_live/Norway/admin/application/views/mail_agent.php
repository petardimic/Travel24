<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>

<script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>ckeditor/ckeditor.js"></script>
		<script type="text/javascript">
            $(window).load( function() {
               
                CKEDITOR.replace("mail_con");
				
            });
        </script>
        
        
        <title>Khempsons</title>
		<style type="text/css">
		a:link {
	color: #333;
	text-decoration: none;
}
        a:visited {
	color: #333;
	text-decoration: none;
}
        a:hover {
	color: #456e08;
	text-decoration: none;
}
        a:active {
	text-decoration: none;
}
        </style>
 <div class="clr"></div>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>
<style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}
.getfields {
    border: 1px solid #D6D6D6;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 14px;
    height: 30px;
    padding: 5px;
    width: 280px;
}

</style>
 <div id="container_warpper" style="padding-bottom:50px;" >
<?php /*?><div class="left_menu_sub">
		<ul>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_suppliers" class="active">View Suppliers</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/cardaccept_list">Cards Accepted List</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/facilities_list">Facilities List</a></li>
            <li><a href="<?php echo WEB_URL_ADMIN?>admin/roomfacilities_list">Unit Facilities List</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/timezone_list">Timezone List</a></li>
			<li style="border:none;"><a href="<?php echo WEB_URL_ADMIN?>admin/apartclass_type">Class Type List</a></li>
		</ul>
	</div><?php */?>

<div style="text-align:right; margin-right:20px;" class="add"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Supplier</a><?php */?></div>
<div class="right-wrapper" style="width:982px;">
 <div id="TabbedPanels1" class="TabbedPanels">
                                <ul class="TabbedPanelsTabGroup">
                                 
                                  <li class="TabbedPanelsTab" tabindex="0" style="font-weight:bold; font-size:12px; padding:10px; margin-top:20px;" >Mails and Reminders
        </li>
                                   
        </ul>
                              
                                <div class="TabbedPanelsContentGroup">
                                 
                                  <div class="TabbedPanelsContent">
		<form method="post"  name="deposit"  enctype="multipart/form-data" action="#" onsubmit="return valid(this)">
                                  <table width="918" height="57" border="0">
  <tr><td>Message Header</td><td><input type="text" name="msg_heder" id="msg_heder" class="getfields" value="" /></td></tr>
  
     
      <tr><td>Message</td><td><textarea name="mail_con" id="mail_con" class="getfields"> </textarea></td>
      </tr>
        
     <tr><td align="center"><input type="image" src="<?php echo WEB_DIR_ADMIN ?>images/update_btn.png"  /></td>
     <td></td></tr>
  
</table></form>
                                   	
                                  </div>
                                  
                                 
   <!-- tab panel 3 end here -->                       
                                  
       </div>
                              </div>

</div>		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
