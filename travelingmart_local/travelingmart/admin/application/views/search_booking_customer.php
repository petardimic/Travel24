<script type="text/javascript" src="<?php echo WEB_DIR; ?>js/jquery_tab2.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>css/thickbox.css" type="text/css" media="screen" />
<link type="text/css" href="<?php echo WEB_DIR?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>calender/ui.datepicker.js"></script>
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<script type="text/javascript">
$(document).ready(function()
{
$(function() {

							$("#stdate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage:'<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true
							});

						});
				
			$(function() { 
							$("#eddate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true
							});

						});
						
							$("#stdate").change(function(){
							//alert("dfgdf");
						 var selectedDate1= $("#stdate").datepicker('getDate');
			//alert(selectedDate1);
			  var nextdayDate  = dateADD(selectedDate1);
				   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
				    $t = nextDateStr;
				  $('#out').html('<input type="text" name="eddate" id="eddate" style="width:150px;"  value="'+$t+'"> ');+
				$(function() {
							$( "#eddate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true,
								minDate: $t
							});

						});
			});
});
function dateADD(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
function zeroPad(num,count)
{
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}

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
#container_warpper_new{ background: none repeat scroll 0 0 #FFFFFF;
    border-color:#333 !important;
    border-style: solid;
    border-width: 2px 3px 3px;
    height: auto !important;
    margin: auto;
    overflow: hidden;
    width: 100%; padding-bottom:50px;
	font-family: Arial,Helvetica,sans-serif;}
        </style>
 <div class="clr"></div>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>
<script type="text/javascript">
function valid()
{
	
	 fname=document.advance_search;
	var val=fname.sel_date_type.value;
	if(val=='')
	{
		alert('Please Select Datatype');
		fname.sel_date_type.focus();
		return false;	
	}
	else{
		
	if(fname.fdate.value=='')
	{
	alert('Please Select From date');
	fname.fdate.focus();
	return false;
	}
	if(fname.tdate.value=='')
	{
	alert('Please Select To Date');
	fname.tdate.focus();
	return false;
	}
	if (CompareDates(fname.tdate.value,fname.fdate.value))
	{
	alert("From  Date cannot be greater than To Date"); 
	fname.tdate.focus();        
	return false; 
	}
	}


}
function CompareDates(str1,str2) 
{ 
	var dt1  = parseInt(str1.substring(0,2),10); 
	var mon1 = parseInt(str1.substring(3,5),10); 
	var yr1  = parseInt(str1.substring(6,10),10); 
	var dt2  = parseInt(str2.substring(0,2),10); 
	var mon2 = parseInt(str2.substring(3,5),10); 
	var yr2  = parseInt(str2.substring(6,10),10); 
	var date1 = new Date(yr1, mon1, dt1); 
	var date2 = new Date(yr2, mon2, dt2); 

	if(date2 < date1) 
	{ 
		return false; 
	} 
	else 
	{ 
		return true; 
	} 
} 
function cancel(transid)
{
	$.post("<?php echo WEB_URL?>admin/cancel_booking",{'transid':transidt},function(data){
	alert(data);
	});		
}
function deleteCats2()
{
  		FormName=document.frmemail;
			FormName.submit();
}
function validate()
{
	var class1 = $('#class4').val();
	var hotel_city = $('#hotel_city').val();
	$('#hotel_city1').val(hotel_city);
	$('#class1').val(class1);
	var eddate = $('#eddate').val();
	$('#seconddate').val(eddate);
	<?php //$this->session->set_userdata(array('eddate'=>$eddate));?>
	
}
</script>
 <div id="container_warpper_new" style="padding-bottom:50px;" >

 <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 10px 10px;">


    
    <form action="<?php echo WEB_URL_ADMIN?>admin/view_cust_bookings/<?php echo $id?>" method="post" onsubmit="return validate();">
    <input type="hidden" name="class1" id="class1"  />
    <input type="hidden" name="hotel_city1" id="hotel_city1"  />
    <input type="hidden" name="seconddate" id="seconddate" />
<tr style="height:30px; color:#333;">

  <td height="30" align="left" valign="middle" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">
    From Date :<input type="text" name="stdate" id="stdate" style="width:150px;" value="<?php if(isset($sd)){if($sd != ''){ echo $sd;}}?>" /></td>
  <td height="30" align="right" valign="middle" style="border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">
    To Date : <span id="out"><input name="eddate" id="eddate" style="width:150px; " type="text" value="<?php if(isset($ed)){if($ed != ''){ echo $ed;}}?>"></span></td>
  <td height="30" align="center" valign="middle" style="border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">
	<select name="stat" id="stat" style="width:150px; padding:2px; height:26px;">
	<option value="1" <?php if(isset($stat)){ if($stat != ''){ if($stat == 1){?> selected="selected"<?php }}}?>>All</option>
	<option value="2" <?php if(isset($stat)){ if($stat != ''){ if($stat == 2){?> selected="selected"<?php }}}?>>Confirmed</option>
	<option value="3" <?php if(isset($stat)){ if($stat != ''){ if($stat == 3){?> selected="selected"<?php }}}?>>Cancellation</option>
	<option value="4" <?php if(isset($stat)){ if($stat != ''){ if($stat == 4){?> selected="selected"<?php }}}?>>Pending</option>
          </select></td>
  <td height="30" align="center" valign="middle" style="border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22" ></td>
  <td align="center" valign="middle" style="border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px;">&nbsp;</td>
     
</tr>
    </form> 
    
 </table>
 
 <div style="clear:both;"></div>
 
  <div style="border:1px #555 solid; margin-left:10px;">
  <form action="<?php echo WEB_URL_ADMIN?>admin/export_bookings" method="post" name="frmemail" >
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0"  class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC;">
  <tr>
    <td colspan="13" style="background-color:#333333; height:30px; padding-left:5px;"><strong>Booking Details</strong></td>
    </tr>
  <tr style="color:#333;">
    <td width="10%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; height:25px; ">Booking No </td>
    <td width="7%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Res date</td>
    <td width="11%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Pincode</td>
    <td width="19%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Booker / Guest Name</td>
    <td width="10%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Check - in</td>
    <td width="6%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Check - out </td>
    <td width="7%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Nights </td>
   
    <td width="7%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Total Price</td>
    <td width="15%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">Status</td>
    <td width="8%" style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">View Details</td>
    
  </tr>
  <?php if(isset($books)){if($books != ''){
  foreach($books as $b){//echo $b->status;exit;?>
  <tr style="color:#333;">
  
  <input type="hidden" name="Del_Id[]" value="<?php echo $b->booking_ref_no; ?>"   />
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; height:25px; "><a href="<?php echo WEB_URL_ADMIN?>admin/view_bookings/<?php echo $b->booking_ref_no 	?>"><?php echo $b->booking_ref_no;?></a></td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->voucher_date;?></td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->itemcode;?></td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->firstname.' '.$b->lastname;?></td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->check_in;?></td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->check_out;?></td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->no_of_room;?></td>
   
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; "><?php echo $b->amount;?></td>
     <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">
	<?php $status = $this->Home_Model->get_book_status($b->booking_ref_no);?>
   	<?php if($status == 'Available'){echo 'Confirmed';}else if($status == 'Cancel'){echo 'Cancelled';}else{ echo 'Pending Confirmation';}?>
   
    </td>
    <td style=" border-bottom: 1px solid #E6E6E6;
    border-right: 1px solid #E6E6E6; padding:0 5px 0 5px; ">
   <a href="<?php echo WEB_URL_ADMIN?>admin/view_bookings/<?php echo $b->booking_ref_no 	?>"><img src="<?php echo WEB_DIR?>supplier_includes/images/view.png" alt="View Details" title="View Details">
    </a>
    </td>
  
    
    
  </tr>
  <?php }}}?>
</table>
</form> 
  </div>                      
            
       
</div>		
</div>			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

