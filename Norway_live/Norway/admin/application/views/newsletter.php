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

 <div id="container_warpper" style="padding-bottom:50px;" >
 <div style="background:#EFA146; color:#000; padding:4px;" >View Subscribers</div>

<form action="<?php echo WEB_URL_ADMIN?>admin/newsletter_template" method="post" name="frmemail" onSubmit="return deleteCats2();">
 <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#333; height:30px;">
	 <td width="123" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Id</b></td>
        <td width="103" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Email</b></td>
	
	
	<td width="113" height="30" align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b> <input name="btn" type="button"  onClick="javascript:selectAll();"  value="Select All" id="btn" style="width:100px; border:none; background-color:#FCCA03; border:#FEB301 1px solid;"/></b></td>
	
       
	
    </tr>
      <?php if(isset($sub)){ if($sub!= '') { ?>
      <?php $i=1; 
	   foreach ($sub as $row){?>
	<tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $i; ?></td>
        <td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><?php echo $row->email?></td>
     
	<td align="center" valign="middle" style="border-right:1px solid #E6E6E6; border-bottom:1px solid #E6E6E6; padding:0 5px 0 5px; color:#333; "><input type="checkbox" name="Del_Id[]" id="checkbox[]" value="<?php echo $row->email; ?>"  class="all_area_chk" /></td>
	
	
	 </tr>
          <?php
	  $i++;}?> 
	  <?php }}else{ echo "No records found";}
	  ?>
   <tr>
           <td align="right"  colspan="7" style="padding-top:5px;" >
		   <span style="float:left;"><!--<input name="submit" type="image" value="Export XLS" src="images/export.png"  />--></span>
           <input name="button" type="image" id="button"   src="<?php echo WEB_DIR_ADMIN?>images/submit_btn.png" onclick="getSelectedValues();" />
           
           </td>		   
           </tr> 
</table>

</form>		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
