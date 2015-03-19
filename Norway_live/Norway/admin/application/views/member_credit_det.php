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
 
 <div id="container_warpper" >
<div style=" font-size:18px; text-align:center; color:#000; padding-top:10px;" >Agency Statement</div>

 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333;  height:30px;">
	 <td width="200" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Agency Name</b></td>
       
	<td height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b> Agent Name</b></td>
     <td width="150" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Credit</b></td>
         <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Debit</b></td>
		  <td width="150" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Balance</b></td>
        
	 <td width="150" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Remarks</b></td> 
	
    </tr>
      <?php
	//echo "<pre>";print_r($agents);exit;
	  if(isset($agent)){ if($agent!= '') { ?>
     
      <?php 
	   foreach ($agent as $row){ 
	  
		  ?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->agency_name; ?></td>
        
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->agent_name; ?>  </td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->credit; ?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->debit;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->account_balance;?></td>
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->remarks;?></td>
	
	  
   
	 </tr>
          <?php
	  }}else{ ?>
      <tr>
      <td>
	  <?php echo "No records found";?></td></tr>
	  <?php }}
	  ?>
     <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>

		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
