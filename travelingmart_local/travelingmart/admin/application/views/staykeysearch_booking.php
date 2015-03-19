<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/jquery-1.4.2.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
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
<script>
function zeroPad(num,count)
{
	var numZeropad = num + '';
	while(numZeropad.length < count) {
	numZeropad = "0" + numZeropad;
	}
	return numZeropad;
}
function dateADD(currentDate)
{
 var valueofcurrentDate=currentDate.valueOf()+(24*60*60*1000);
 var newDate =new Date(valueofcurrentDate);
 return newDate;
} 
$(document).ready(function(){
	$(function() {
			$("#datepicker" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true
			});
	});
	$(function() {
			$( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true
	});
	});
	$("#datepicker").change(function(){
							//alert("dfgdf");
						 var selectedDate1= $("#datepicker").datepicker('getDate');
			//alert(selectedDate1);
			  var nextdayDate  = dateADD(selectedDate1);
				   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
				    $t = nextDateStr;
				  $('#out').html('<input type="text" name="ed" id="datepicker1" style="width:180px; height:20px;" float:left;border:1px #ccc solid;" value="'+$t+'"> ');+
				$(function() {
							$( "#datepicker1").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
								buttonImageOnly: true,
								minDate: $t
							});

						});
			});
	
	

});
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

</script>
 <div id="container_warpper" style="padding-bottom:50px;" >

  <form action="<?php print WEB_URL_ADMIN ?>admin/search_booking_view" method="post" name="form1" onsubmit="javascript:return valid_date();">

 <div class="agent_acc_depo-h1-out-3" style=" color:#000; font-size:14px; text-align:center; width:500px; height:auto;  
 border:1px solid #ccc; border-radius:8px 8px 0px 0px; margin-left:250px; margin-top:50px; ">
 
 <div style=" color:#fff; font-size:20px; text-align:center; height:30px;  
  border-radius:8px 8px 0px 0px; background:#333333;">Quick Search</div>
                       <div class="agent_acc_depo-h1-out-2"style="padding:10px;">
                        	<div class="agent_acc_depo-h1-left" style="float:left; width:150px; text-align:right;">From  :</div>
                    <div class="agent_acc_depo-h1-right">
                            <div class="agent_acc_depo-h1-right-in">
    	                        <label>  <input type="text" name="sd" id="datepicker" readonly="readonly" size="10" style="width:180px; height:20px;" />    <img src="<?php print WEB_DIR_ADMIN; ?>images/cal.gif" alt="" border="0" /> </label>
                            </div>
                            <div class="agent_acc_depo-h1-right-fld-icon">
                            </div>
              </div>
                        </div>
                        <div class="agent_acc_depo-h1-out-2" style="padding:10px;">
                        	<div class="agent_acc_depo-h1-left" style="float:left; width:150px; text-align:right;">To :</div>
                            <div class="agent_acc_depo-h1-right">
                            <div class="agent_acc_depo-h1-right-in">
    	                         <label><span id="out"> <input type="text" name="ed" id="datepicker1" readonly="readonly" size="10" style="width:180px; height:20px;" /></span><img src="<?php print WEB_DIR_ADMIN; ?>images/cal.gif" alt="" border="0" /></label> 
                            </div>
                            <div class="agent_acc_depo-h1-right-fld-icon" ><!--<input type="image" src="images/calendar_day.png"  />-->
                            </div>
                          </div>
                        </div>
                        <div class="agent_acc_depo-sumit"style="padding:10px;"><input width="72" type="image" height="22" src="<?php print WEB_DIR_ADMIN; ?>images/submit_btn.png">
                        </div>
						</form>
                        
             
       
</div>		
</div>			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>


