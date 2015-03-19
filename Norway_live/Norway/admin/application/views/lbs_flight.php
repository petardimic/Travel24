 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
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
 <div id="container_warpper" style="padding-bottom:50px; width:98%;"  >


<div style="text-align:right; margin-right:20px;" class="add"><?php /*?><a href="<?php echo WEB_URL_ADMIN?>admin/user_reg">Add Supplier</a><?php */?></div>
<div class="right-wrapper" style="width:99%">
 <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0" class="sortable" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
 <thead>
<tr style="background-color:#333333; height:30px;">
	
    <th width="80" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:4px 5px 0 4px; ">
        <div style="float:left; padding:0px 0px 0px 8px;"><b>Flight No.&nbsp;</b></div>
        <div style="float:left; padding:0px 0px;">
        </div>
        </th>
         <th width="85" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:4px 5px 0 4px; ">
        <div style="float:left; padding:0px 0px 0px 8px;"><b>Flight Type&nbsp;</b></div>
        <div style="float:left; padding:0px 0px;">
        </div>
        </th>
         <th width="150" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:4px 5px 0 4px; ">
        <div style="float:left; padding:0px 0px 0px 8px;"><b>Airline&nbsp;</b></div>
        <div style="float:left; padding:0px 0px;">
        </div>
        </th>
         <th height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:4px 5px 0 4px; ">
        <div style="float:left; padding:0px 0px 0px 8px;"><b>From - To&nbsp;</b></div>
        <div style="float:left; padding:0px 0px;">
        </div>
        </th>
        <th width="150" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:4px 5px 0 4px; ">
        <div style="float:left; padding:0px 2px;">
        </div>
        <div style="float:left; padding:0px 0px 0px 8px;"><b>Lead Guest Name&nbsp;</b></div>
        <div style="float:left; padding:0px 0px;">
        </div>
        </th>
		<th width="100" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 4px; ">
         <div style="float:left; padding:0px 0px;">
        </div>
         <div style="float:left; padding:0px 0px 0px 7px;"><b>Date Of Travel&nbsp;</b></div>
         <div style="float:left; padding:0px 0px;">
        </div></th>
        
        
<th width="86" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;">
 <div style="float:left; padding:0px 0px;">
        </div>
        <div style="float:left; padding:0px 0px 0px 13px;"><b>Country&nbsp;</b></div>
        
  <div style="float:left; padding:0px 0px;">
        </div></th>
        
        
<th width="98" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;">
<div style="float:left; padding:0px 0px;">
        </div>
<div style="float:left; padding-left:40px; padding-right:25px;"><b>City&nbsp;</b></div>
<div style="float:left; padding:0px 0px;">
        </div></th>
	<th width="85" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;"><b>Full Detail</b></th>
	<th width="20" align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px;"><b>Status</b></th>
	<th width="51" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Delete</b></th>

    </tr>	</thead>
     <?php if(isset($flight)) { if($flight != '') { foreach($flight as $row) { ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->flight_no; ?></td>
     <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php if($row->mode != 'ONE') { echo "Round Trip"; } else { echo "One Way"; } ?></td>
      <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->airline; ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->origin; ?> - <?php echo $row->destination; ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">Nitesh</td>
       
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->depart_date; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->country; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->city; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	  <a href="#">View</td> </a>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="#">Booked</a></td> 
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><a href="#"><img src="<?php echo WEB_DIR_ADMIN ?>images/delete1.png" title="click to delete" /></a></td> 
	 </tr>
     
     <?php } } } ?>
         
  
</table>

</div>		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
