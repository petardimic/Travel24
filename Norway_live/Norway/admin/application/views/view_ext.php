 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/nav.css" rel="stylesheet" />
		<link type="text/css" href="<?php print WEB_DIR_ADMIN?>css/examples.css" rel="stylesheet" />

        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Travelingmart</title>
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

 <div id="container_warpper" style="padding-bottom:00px;" >
   <form action="" method="get">
  <div style="text-align:right; margin-right:20px; margin-top:10px;" class="add"><a href="<?php echo WEB_URL_ADMIN?>admin/add_ext_page"><img src="<?php echo WEB_DIR_ADMIN?>images/addimage.jpg" width="72" height="28" border="0" title="click to delete" /></a></div>
   </form>    
   <div style="float:left; height:auto;">
   
   <table width="980" cellspacing="0" cellpadding="0" border="0" align="left" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:5px 0 50px 10px;" class="menutwo">
     
<tbody>
  <tr style="background-color:#FFF; height:30px;">
	 <td width="61" height="30" align="left" valign="middle" bgcolor="#333333" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#fff; "><b>SI.NO</b></td>
	<td width="226" height="30" align="left" valign="middle" bgcolor="#333333" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#fff; "><b>Title</b></td>

         <td width="336" align="left" valign="middle" bgcolor="#333333" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#fff;"><b>URL</b></td>
		        
		  <td width="244" align="left" valign="middle" bgcolor="#333333" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#fff;"><b>Created</b></td>
       
	<td width="111" align="left" valign="middle" bgcolor="#333333" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#fff"><b>Action</b></td>
	
    </tr>
	<?php if(isset($res)){if($res !=''){
	$i = 1;
	foreach($res as $row){?>
           
      	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
      	  <td valign="middle" align="left" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $i?></td>
      	  <td valign="middle" align="left" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo ucfirst($row->name)?></td>
      	
      	  <td valign="middle" align="left" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php echo $row->url?>" target="_blank"><?php echo $row->url?></a></td>
		 
      	  <td valign="middle" align="left" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->date?></td>
      	    
      	  <td valign="middle" align="left" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><table width="100%" border="0" cellspacing="0" cellpadding="0">
      	    <tr>
      	      <td width="22">
			  <a href="<?php echo WEB_URL_ADMIN?>admin/edit_ext_page/<?php echo $row->external_links_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/edit_icon.jpg" border="0" title="click to edit <?php echo $row->name;?> Page" /></a></td>
			    <td width="22">
			  <a href="<?php echo WEB_URL_ADMIN?>admin/delete_ext_page/<?php echo $row->external_links_id?>" onclick="return confirm('Are you sure want to delete this link?')" class="add_update_link" ><img src="<?php echo WEB_DIR_ADMIN?>images/delete1.png" width="32" height="32" border="0" title="click to delete <?php echo $row->name;?> Page"" /></a></td>

      	      </tr>
   	      </table></td> 
   	    </tr>
	<?php $i++;}}}?>
          	
          	
          	
               
</tbody>
   </table>
   
   </div>     
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
