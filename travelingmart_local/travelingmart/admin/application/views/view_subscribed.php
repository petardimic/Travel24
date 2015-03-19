<script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
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
    <style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}

</style>
 <div id="container_warpper" style="padding-bottom:50px;" >
 <div style="background:#EFA146; color:#000; padding:4px;" >View Subscribers</div>
  <div style="float:right; padding:10px 25px 10px 37px; margin:10px;  background:#f7941d; border:1px solid #b8b8b8; width:80px; height:14px; cursor:pointer;" onclick="return deleteCats2();">Export CVC</div>
<form action="<?php echo WEB_URL_ADMIN?>admin/export_newsletter" method="post" name="frmemail" onSubmit="return deleteCats2();">
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="sortable" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 5px 10px;">

<tr style="background-color:#333; height:30px;">
	 <td width="140" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>User Type</b></td>
        <td width="196" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Company/Group/Brand Name</b></td>
	
	
	
	
        <td width="96" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>First Name/ Last Name</b></td>
<td width="64" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Email</b></td>
<td width="82" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Country</b></td>
<td width="88" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>City</b></td>

<td width="93" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Comp New</b></td>
	<td width="126" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Promos</b></td>
	<td width="93" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>
    <input name="btn" type="button"  onClick="javascript:selectAll();"  value="Select All" id="btn" style="width:100px; border:none; background-color:#FCCA03; border:#FEB301 1px solid;"/></b></td>
	
    </tr>

      <?php
	//echo "<pre>";print_r($users);exit;
	  if(isset($users)){ if($users!= '') { ?>
     
      <?php 
	
	   foreach ($users as $row){ 
	  
		  ?>
       
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php $type = ($this->Home_Model->get_type($row->user_type_id)); if($type != ''){ echo ucfirst($type);} else{echo '-';}?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php print $row->agency_name;?></td>
     
	
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
	<?php print $row->first_name.$row->last_name;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->email;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $cnt = $this->Home_Model->get_ind_country($row->country);?></td>
    <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->city;?></td>

	 
       <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; ">
       <?php $not = $this->Home_Model->get_notify($row->user_id);
	   if(isset($not)){if($not != ''){
		   if($not->peridoic == 1){?>
           <img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="subscribed" width="20" height="20">
       <?php }}
	   else
	   {?>
       <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="not subscribed" width="20" height="20">
	   <?php }}?>
	</td> 
		
		
<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "> 
<?php if(isset($not)){if($not != ''){
		   if($not->news == 1){?>
           <img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="subscribed" width="20" height="20">
       <?php }else{?>   <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="not subscribed" width="20" height="20"><?php }}
	   else
	   {?>
       <img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="not subscribed" width="20" height="20">
	   <?php }}?></td>  
		
		<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><input type="checkbox" name="Del_Id[]" id="checkbox[]" value="<?php echo $row->user_id; ?>"  class="all_area_chk" /></td> 
	 </tr>
          <?php
}}}else{ echo "No records found";}?>  <?php 
	  ?>
  <table style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px;  margin:0px 0 0px 8px;">
 <tr><td style="color:#FF0000;">
              <?php echo $this->pagination->create_links(); ?></td></tr>
</table>
</table>

	</form>	
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>
<script type="text/javascript">
function selectAll()
{
	temp = document.frmemail.elements.length ;
    for (i=0; i < temp; i++) 
	{
    	if(document.frmemail.elements[i].checked == 1)
    	{
			document.frmemail.elements[i].checked = 0;
	   	    document.frmemail.btn.value = "Select All"; 
		}
    	else 
		{
			document.frmemail.elements[i].checked = 1; 
   	   		document.frmemail.btn.value = "Deselect All"; 
		}
	}
}
function deleteCats2()
{
  ptr=document.frmemail;
  len=ptr.elements.length;
  var i=0,j=0;
  for(i=0; i<len; i++)
	if (ptr.elements[i].name=='Del_Id[]')
	{
	   if(ptr.elements[i].checked==true)
	   {
	   		j=j+1;
	   }
	}
	if(j==0)
	{
		alert("Select Atleast One Checkbox");
		return false;
	}
	else
	{
			FormName=document.frmemail;
			FormName.submit();
	}
}
</script>

</div>
