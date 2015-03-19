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
<div style="text-align:right; margin-right:20px;" class="add"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Supplier</a><?php */?></div>
<div class="right-wrapper">
 <div id="TabbedPanels1" class="TabbedPanels">
                                <ul class="TabbedPanelsTabGroup">
                                 
                                  <li class="TabbedPanelsTab" tabindex="0" >Add Bottom Right Images
        </li>
                                   
        </ul>
                              
                                <div class="TabbedPanelsContentGroup">
                                 
                                  <div class="TabbedPanelsContent">
		<form method="post"  name="deposit"  action="<?php print WEB_URL_ADMIN?>admin/add_bottom_images" onsubmit="return valid(this)" enctype="multipart/form-data" >
		
                                  <table width="918" height="57" border="0">
  								 <tr><td>Upload Image 1</td><td><input type="file" name="image1" id="image1" size="35" />&nbsp;&nbsp;&nbsp;Images size should be (250 X 100) <img src="<?php print WEB_DIR_ADMIN ?>bottom_images/<?php echo $images->image; ?>" width="100" height="100"  />
                                 <input type="hidden" name="image_1" id="image_1" value="<?php echo $images->image; ?>"/></td></tr>
                                <?php /*?> <tr><td colspan="2">&nbsp;</td></tr>
                                 <tr><td>Upload Image 2</td><td><input type="file" name="image2" id="image2" size="35" />&nbsp;&nbsp;&nbsp;Images size should be (250 X 100)</td></tr>
                                 <tr><td colspan="2">&nbsp;</td></tr>
                                 <tr><td>Upload Image 3</td><td><input type="file" name="image3" id="image3" size="35" />&nbsp;&nbsp;&nbsp;Images size should be (250 X 100)</td></tr>
                                 <tr><td colspan="2">&nbsp;</td></tr>
                                 <tr><td>Upload Image 4</td><td><input type="file" name="image4" id="image4" size="35" />&nbsp;&nbsp;&nbsp;Images size should be (250 X 100)</td></tr>
        <tr><td colspan="2">&nbsp;</td></tr><?php */?>
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
