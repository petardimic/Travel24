 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>ckeditor/ckeditor.js"></script>
		<script type="text/javascript">
            $(window).load( function() {
               
                CKEDITOR.replace("content");
            });
        </script>
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
 
 <div id="container_warpper" >
<div style="background:#EFA146; color:#000; padding:4px;" >Page Managemet : <?php echo $page_name; ?></div>
<form action="<?php print WEB_URL_ADMIN ?>admin/cms_update/<?php echo $val; ?>" method="post" >
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     <tr height="30">
    <td style="color:#000; padding:10px; font-weight:bold;" colspan="2">Content For  <?php echo $page_name; ?> Page</td>
    </tr>
	<tr>
    <td colspan="2"><textarea name="content" id="content" rows="10" cols="40" ><?php echo $content; ?></textarea></td>
    </tr>
    <tr><td colspan="2" align="center" headers="30"><input type="image" src="<?php print WEB_DIR_ADMIN ?>images/update_btn.png"   border="0"/> </td></tr>
</table>

	</form>	
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
