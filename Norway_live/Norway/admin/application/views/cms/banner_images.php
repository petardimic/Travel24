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
	color: #2697e3;
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

<div style="text-align:right; margin-right:20px;" class="add"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Supplier</a><?php */?></div>
<div class="right-wrapper">
                                
                              
                                
		<table width="980" height="60" border="0" class="sortable" style="margin-top:10px;"> <thead>
  <tr style="background-color:#62a4d0; background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333;  height:30px;">
    <th width="51" height="24" align="center"  > S.No </th>
    <th width="101" align="center"  > Image </th>
    <th width="178" align="center" > Image Link Text </th>
    <th align="center" ><strong> Image link </th>
    <th width="100" align="center"  > Edit </th>
    <th width="100" align="center"  > Delete </th>
     </tr> </thead>
      <?php 

  if(isset($banner_images)){ if($banner_images != '') { ?>
     
      <?php $i=1;  foreach ($banner_images as $row){ 
	  
	  ?><tbody>
  <tr style="background-color:#e5e5e5;">
    <td height="27" align="center"><?php echo $i; ?></td>
    <td align="center"><img src="<?php print WEB_DIR_ADMIN ?>banner_images/<?php echo $row->image_name; ?>" width="75" height="75"  style="margin-top:3px;"  /></td>
    <td align="center"><?php print $row->link_text; ?></td>
    
    <td align="center"><a href="<?php print $row->image_url; ?>" target="_blank"><?php print $row->image_url; ?></a></td>
    <td align="center"><a href="<?php print WEB_URL_ADMIN?>admin/edit_banner_image/<?php echo $row->id; ?>"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit.png"  style="margin-top:3px;"/></a></td>
    <td align="center"><a href="<?php print WEB_URL_ADMIN?>admin/delete_banner_image/<?php echo $row->id; ?>" onclick="return confirm('Are you sure want to delete this row?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" width="20" height="23" style="margin-top:3px;" /></a></td>
  </tr>
      
      <?php $i++; } ?>
      
         <?php } else { ?>
        <tr> <td colspan="7" align="center">No Records Found!!</td></tr>
         <?php } } ?></tbody>
</table>

</div>		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
