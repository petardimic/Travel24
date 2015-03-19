 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
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
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>
 
 <div id="container_warpper" style="width:98%" >
<div style=" text-align:center; font-size:18px; color:#000; padding-top:4px;" >News List</div>

 <table width="98%" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333333; height:30px;">
	 <td height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>News Title</b></td>
       
	<td height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>News Type</b></td>
        <td height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>News For</b></td>
   <td width="100" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Edit</b></td>
		  <td width="100" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></td>
        
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($news)){ if($news!= '') { ?>
     
      <?php 
	   foreach ($news as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->new_title; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->show_at; ?>  </td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->news_for; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN?>admin/edit_news/<?php echo $row->id; ?>"><img src="<?php print WEB_DIR_ADMIN ?>images/edit.png" border="0"  /></a></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL_ADMIN?>admin/delete_news/<?php echo $row->id; ?>"><img src="<?php print WEB_DIR_ADMIN ?>images/delete1.png" border="0"  /></a></td>
	
		  
   
	 </tr>
          <?php
	  }}else{ ?>
      <tr>
      <td colspan="10" align="center" style="padding:70px;">
<?php echo "<span style='color:#000; font-weight:bold;'>No News found</span>";?></td></tr>
	  <?php }}
	  ?>
     
</table>

		
    <table><tr>
    <td><a href="<?php print WEB_URL_ADMIN ?>admin/add_news"><img src="<?php print WEB_DIR_ADMIN ?>images/addimage.jpg" border="0" /></a>
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
