 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <link href="<?php print WEB_DIR ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php print WEB_DIR ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
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

<div style="text-align:right; margin-right:20px; " class="add"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Supplier</a><?php */?></div>
<div class="right-wrapper" style="width:975px;">
 <div id="TabbedPanels1" class="TabbedPanels">
                                <ul class="TabbedPanelsTabGroup">
                                 
                                  <li class="TabbedPanelsTab" tabindex="0" style="font-size:12px; font-weight:bold; padding:10px; margin-top:20px;" >Add Banner Images
        </li>
                                   
        </ul>
                              
                                <div class="TabbedPanelsContentGroup">
                                 
                                  <div class="TabbedPanelsContent">
		<form method="post"  name="deposit"  enctype="multipart/form-data" action="<?php print WEB_URL_ADMIN?>admin/add_banner_images" onsubmit="return valid(this)">
		
                                  <table width="918" height="57" border="0">
  <tr><td>Image Link Text</td><td><input type="text" name="image_text" id="image_text" class="field"/></td></tr>
   <tr><td>Image url</td><td><input type="text" name="image_url" id="image_url" class="field" /></td></tr>
	 <tr><td>Upload Image</td><td><input type="file" name="image" id="image" size="35" />&nbsp;&nbsp;&nbsp;Images size should be (1340 X 372)</td></tr>
        
     <tr><td><td><input type="submit" value="Upload" /></td></tr>
  
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
