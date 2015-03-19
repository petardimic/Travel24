 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-ui-1.8.custom.min.js"></script>
		<link type="text/css" href="<?php print WEB_DIR?>datepicker/css/ui-lightness/jquery-ui-1.8.custom.css" rel="stylesheet" />
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <title>Noori Travels</title>
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
 
 <div id="container_warpper" style="padding-bottom:50px;" >
<div style="background:#EFA146; color:#000; padding:4px;" >View Emails Titles</div>
<div class="add" style="text-align:right; margin-right:20px; padding-top:5px;"><a href="<?php echo WEB_URL_ADMIN?>admin/add_email">Add Email Title</a></div>
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333333; height:30px;">
	 <td width="93" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>S.No</b></td>
        <td width="286" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Title</b></td>
	<td width="189" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Code</b></td>
        <td width="203" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Action</b></td>
         
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($emails)){ if($emails!= '') { ?>
     
      <?php 
	   foreach ($emails as $row){ 
	  
		  ?>
		  
			  
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	
	
        <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->email_types_id;?></td>
        <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><a href="<?php echo WEB_URL_ADMIN?>admin/email_content/<?php echo $row->email_types_id;?>"><?php print $row->email_title;?></a></td>
		<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->email_code;?></td>
		<td width="207" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; ">
		<a href="<?php print WEB_URL_ADMIN?>admin/edit_email_type/<?php echo $row->email_types_id;?>" class="add_update_link"><img src="<?php echo WEB_DIR_ADMIN ?>images/edit_icon.jpg" /></a>
		<a href="<?php print WEB_URL_ADMIN?>admin/delete_email_type/<?php echo $row->email_types_id;?>" class="add_update_link" onclick="return confirm('Are you sure want to delete this currency?')"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" /></a></td> 
    </tr>
          <?php
	  }?>  <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr> <?php }}else{ echo "No records found";}
	  ?>
  
</table>

		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
