<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Inventory Details</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery-1.4.3.min.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>
<?php /*?><script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script><?php */?>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>


<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->

<script type="text/javascript">
$(document).ready(function()
{
$('#rate_plan').watermark("standard");
$('#default_avail').watermark("10");
$('#def_max').watermark("15");
$('#def_min').watermark("1");
$('#rate').watermark("200");
$(function() {

							$("#stdate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage:'<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true,
								minDate: 0
							});

						});
				
			$(function() { 
							$("#eddate").datepicker({
								changeMonth: true,
								changeYear: true,
								showOn: "button",
								buttonImage: '<?php echo WEB_DIR?>media/cal_new.png',
								buttonImageOnly: true,
								minDate: 0
							});

						});
						
							$("#stdate").change(function(){
							//alert("dfgdf");
						 var selectedDate1= $("#stdate").datepicker('getDate');
			//alert(selectedDate1);
			  var nextdayDate  = dateADD(selectedDate1);
				   var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"/"+zeroPad((nextdayDate.getMonth()+1),2)+"/"+(nextdayDate.getFullYear());
				    $t = nextDateStr;
				  $('#out').html('<input type="text" name="eddate" id="eddate" class="getfields"  style="width:70px; height:18px;" value="'+$t+'"> ');+
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
function getXMLHTTP() { //fuction to return the xml http object
  var xmlhttp=false; 
  try{
   xmlhttp=new XMLHttpRequest();
  }
  catch(e) {  
   try{   
    xmlhttp= new ActiveXObject("Microsoft.XMLHTTP");
   }
   catch(e){
    try{
    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch(e1){
     xmlhttp=false;
    }
   }
  }
    
  return xmlhttp;
    }
function check(){
$price = $('#price').val();
$avail = $('#avail').val();
$min_stay = $('#min_stay').val();
$max_stay = $('#max_stay').val();
$checked_val=$('#on_req').val();
if($avail!=''){
$('input[name="avail[]"]').each(function(){
 $('input[name="avail[]"]').val($avail);
});
}
if($price!=''){
$('input[name="price[]"]').each(function(){
 $('input[name="price[]"]').val($price);
});
}
if($min_stay!=''){
$('input[name="min_stay[]"]').each(function(){
 $('input[name="min_stay[]"]').val($min_stay);
});
}
if($max_stay!=''){
$('input[name="max_stay[]"]').each(function(){
 $('input[name="max_stay[]"]').val($max_stay);
});
}
if($checked_val=='checkall'){ 
	
	$("#tablecheckbox input").each( function() {
		$(this).attr("checked",true);
	})
}
if($checked_val=='uncheckall'){
	
	$("#tablecheckbox input").each( function() {
		$(this).attr("checked",false);
		})
	
	}
$checked_val1 = $('#block_arr').val();
if($checked_val1=='checkall'){ 
	$("#tablecheckbox1 input").each( function() {
	$(this).attr("checked",true);
	})
}
if($checked_val1=='uncheckall'){
	$("#tablecheckbox1 input").each( function() {
	$(this).attr("checked",false);
	})
	
	}
$checked_val2 = $('#block_dept').val();
if($checked_val2=='checkall'){ 
	/*$('input[name="select[]"]').each(function(){
	 $('input[name="select[]"]').attr('checked',true);
	});*/
	$("#tablecheckbox2 input").each( function() {
		$(this).attr("checked",true);
	})
}
if($checked_val2=='uncheckall'){
	/*$('input[name="select[]"]').each(function(){
	 $('input[name="select[]"]').attr('checked',false);
	});*/
	$("#tablecheckbox2 input").each( function() {
		$(this).attr("checked",false);
		})
	
	}

}
function facilities()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=day]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	/*alert(valcheck2);
	alert($('#apartfec_val').val(valcheck2));*/
	
}
function check_all()
{
	if($('#all_day').attr('checked'))
	{

		$("#day input").each( function() {
			$(this).attr("checked",true);
		});
	}
	else
	{
		$("#day input").each( function() {
			$(this).attr("checked",false);
		});
	}
}

function abc()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=day]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	document.getElementById("maintain_month").submit();
}
function month(month,year)
{

	$('#month').val(month);
	$('#year').val(year);
	var valcheck2 = [];
	var selectedVariants = $("input[name=day]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#apartfec_val').val('');
	$('#apartfec_val').val(valcheck2);
	document.getElementById("maintain_month").submit();
}
function checked()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=on_req_checked_val]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     //alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#on_req_checked').val('');
	$('#on_req_checked').val(valcheck2);
	var valcheck3 = [];
	var selectedVariants1 = $("input[name=on_arr_checked_val]:checked").serializeArray();
	jQuery.each(selectedVariants1, function(j, field){
     //alert(field.value); alert("IValue=="+i);
		valcheck3[j] = field.value;
    });
	$('#on_arr_checked').val('');
	$('#on_arr_checked').val(valcheck3);
	var valcheck4 = [];
	var selectedVariants2 = $("input[name=on_blk_checked_val]:checked").serializeArray();
	jQuery.each(selectedVariants2, function(k, field){
     //alert(field.value); alert("IValue=="+i);
		valcheck4[k] = field.value;
    });
	$('#on_blk_checked').val('');
	$('#on_blk_checked').val(valcheck4);
	var stdate = $('#stdate').val();
	var eddate = $('#eddate').val();
	$('#from').val(stdate);
	$('#to').val(eddate);
}
</script>
<style type="text/css">
@media screen and (-webkit-min-device-pixel-ratio:0) {
 #tdtd { }
 #tdtd2 { width:97px !important;}
 #tdtd3 { width:95px !important;}
}
td{ vertical-align:top !important; font-size:12px; }
table.display td select {
    background: none repeat scroll 0 0 #F2F2F2;
    border: 1px solid #DCDCDC;
    border-radius: 3px 3px 3px 3px;
    color: #555555;
    font-size: 11px;
    height: 30px;
}
table.display td input {
   /* background: none repeat scroll 0 0 #FFFFFF;*/
    border: 1px solid #DCDCDC;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 11px;
    height: 25px;
    vertical-align: middle;
}
.border-bottom {
    border-bottom: 1px solid #E7E7E7;
    vertical-align: top;
}
</style>
</head>
<body>
<div class="wrapper">

    <!-- Top navigation bar -->
   <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

    <!--<div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div>--><!--sidebar-position-->
    <!-- Content wrapper -->
  <!--  <div class="wrapper">-->
        <!-- Content -->
      <!--  <div class="content">-->
        
        <div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Maintain by Month - <?php if(isset($name)){if($name!=''){ echo $name->category_name.' ('.$name->rate_name.')';}}?> <span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
            <!-- Dynamic table -->
            <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<!--<div class="hidden_head">&nbsp;</div>-->
					
					
                        <div class="title" >
						
                            <!--<h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Rate Plan Details</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>-->
							
		<!--<div style="color:#fff !important; height:22px; width:100%; font-size:18px; padding:8px 12px;">Maintain by Month - <?php if(isset($name)){if($name!=''){ echo $name->category_name.' ('.$name->rate_name.')';}}?> <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right; margin-right:15px;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></div>-->
			 <?php if(isset($room)){if($room != ''){?> 
			 					
		<div style="coloir:#fff; height:162px; width:auto; background:#dcdcdc; overflow:auto;">
	<form name="maintain_month" id="maintain_month" action="<?php echo WEB_URL_ADMIN?>supplier/maintain_by_month/1" method="post" onsubmit="return facilities();">
		
			<div style="padding-top:5px; width:100%"> 
            <table width="100%"><tr><td style="font-size:15px; padding-left:5px;">
			<?php if(isset($month)){if($month != ''){
			$i=0;
			foreach($month as $m){ ?>
           	&nbsp;&nbsp;<a href="javascript:void(1);"  onClick="month('<?php echo $m->month?>','<?php echo $m->year?>');" style="cursor:pointer;"><?php echo $m->month.''.$m->year?></a>
		
			<?php }}}?></td></tr>
            </table>
			</div>
		
			<!--calender-->
         
		
	
	  <input type="hidden" id="apartfec_val" name="apartfec_val" value=""/>
		 <input type="hidden" name="month" id="month" value=""/>
		  <input type="hidden" name="year" id="year" value=""/>
		<div style="margin-top:15px;">
        <table style="margin-left:10px;" width="100%">
        <tr>
        <td width="30%">Select Category and Plan Type</td>
        <td></td>
        <td width="15%">From</td>
        <td></td>
        <td width="15%">To</td>
        <td></td>
        <td width="40%" style="border-bottom:solid 1px #666"><strong>Day</strong>
         <span style="float:right;"><input name="all_day" id="all_day" type="checkbox" value="" onclick="return check_all();" /> <strong>Check All</strong></span></td>
      	<td></td>
        </tr>
       
          <tr>
        <td style="width:300px;"><select name="room_plan" class="getfields" style="width:250px; height:30px;" onchange="return abc();">
		<?php foreach($room as $row){?>
		<option value="<?php echo $row->sup_apart_rateplan_id?>" <?php if(isset($room_plan)){if($room_plan!=''){ if($row->sup_apart_rateplan_id == $room_plan){?> selected="selected"<?php }}}?>><?php echo $row->rate_name .', '. $row->category_name?></option>
		<?php }?>
		</select></td>
		<?php $start = date('d/m/y');?>
        <td >&nbsp;</td>
        <td style="width:200px;"><input name="stdate" id="stdate" type="text" class="getfields"  style="width:70px; height:18px;" value="<?php if(isset($stdate)){if($stdate != ''){ echo $stdate;}} else{ echo date("d/m/Y",strtotime("+0 day"));}?>"/></td>
        <td >&nbsp;</td>
        <td  style="width:200px;"><span id="out"><input name="eddate" id="eddate" type="text" class="getfields"  style="width:70px; height:18px;" value="<?php if(isset($eddate)){if($eddate != ''){ echo $eddate;}} else{ echo date("d/m/Y",strtotime("+13 day"));}?>"/></span></td>
        <td>&nbsp;</td>
		
        <td id="day">
		<?php if(isset($checkedval)){if($checkedval!=''){  $res = explode(",",$checkedval); }}?>
		<?php $yes=''; if(isset($res)){if($res!=''){if(in_array('Mon',$res)) {$yes="checked=\"checked\""; }else $yes='';}} ?>
		<input name="day"  type="checkbox" value="Mon" <?php echo $yes?> style="margin-right:5px;"/>Mon  
        &nbsp;&nbsp;<?php if(isset($res)){if($res!=''){if(in_array('Tue',$res)) {$yes="checked=\"checked\""; }else $yes='';}} ?><input name="day" type="checkbox" value="Tue" <?php echo $yes?> style="margin-right:5px;" />Tue
        &nbsp;&nbsp; <?php if(isset($res)){if($res!=''){if(in_array('Wed',$res)) {$yes="checked=\"checked\""; }else $yes='';}} ?><input name="day"  type="checkbox" value="Wed" <?php echo $yes?> style="margin-right:5px;" />Wed
        &nbsp;&nbsp; <?php if(isset($res)){if($res!=''){if(in_array('Thu',$res)) {$yes="checked=\"checked\""; }else $yes='';}} ?><input name="day"  type="checkbox" value="Thu" <?php echo $yes?>  style="margin-right:5px;"/>Thu<br />
       <?php if(isset($res)){if($res!=''){if(in_array('Fri',$res)){$yes="checked=\"checked\""; }}}else $yes=''; ?><input name="day" type="checkbox" value="Fri" <?php echo $yes?>  style="margin-right:5px;"/>Fri
        &nbsp;&nbsp; <?php if(isset($res)){if($res!=''){if(in_array('Sat',$res)) {$yes="checked=\"checked\""; }else $yes='';}} ?><input name="day"   type="checkbox" value="Sat" <?php echo $yes?> style="margin:0 5px 0 6px;"/>Sat
        &nbsp;&nbsp; <?php if(isset($res)){if($res!=''){if(in_array('Sun',$res)) {$yes="checked=\"checked\""; }else $yes='';}} ?><input name="day" type="checkbox" value="Sun" <?php echo $yes?>style="margin-right:5px;" />Sun </td>
        <td>&nbsp;</td>
      
      <td><input name="" type="submit"  value="submit"/></td>
      <td>&nbsp;</td>
        </tr>
        </table>
        
        </div><!--select room field-->
		</form>
		</div><!--gray table-->	
							
		
        <div style="coloir:#fff; height:40px; width:100%; background:#f8f8f8">
        <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic">
        <tr height="30">
        <td  style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Date</td>
         <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Rate Plan</td>
          <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Price</td>
           <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Available</td>
            <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Max Stay</td>
             <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Min Stay</td>
              <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">On Request</td>
               <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Block Arrival </td>
                <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%;">Block Departure </td>
                 <td style="border-right:solid 1px #f8d1a3; text-align:center; width:10%; ">&nbsp;</td>
        </tr>
        
         <tr style="background:#f5cc9c"  height="30">
        <td style="border-right:solid 1px #deab6f; text-align:center; padding-top:3px;" colspan="2">Smart Update</td>
        
          <td style="border-right:solid 1px #deab6f; text-align:center;"><input name="price" id="price" type="text" class="input-field"  style="width:50px; height:20px; margin-top:3px; background:#F2F2F2;" value="" /></td>
           <td style="border-right:solid 1px #deab6f; text-align:center; "><input name="avail" id="avail" type="text" class="input-field"  style="width:50px; height:20px; margin-top:3px; background:#F2F2F2;" value="" /></td>
            <td style="border-right:solid 1px #deab6f; text-align:center;"><input name="min_stay" id="min_stay" type="text" class="input-field"  style="width:50px; height:20px; margin-top:3px; background:#F2F2F2;" value="" /></td>
             <td style="border-right:solid 1px #deab6f; text-align:center;"><input name="max_stay" id="max_stay" type="text" class="input-field"  style="width:50px; height:20px; margin-top:3px; background:#F2F2F2;" value="" /></td>
              <td style="border-right:solid 1px #deab6f; text-align:center; "><select name="on_req" id="on_req"   style="width:70px; margin-top:3px;"><option value=""></option><option id="call" value="checkall">checkall</option><option id="ucall" value="uncheckall">uncheckall</option></select></td>
               <td style="border-right:solid 1px #deab6f; text-align:center;"><select name="block_arr" id="block_arr" style="width:70px; margin-top:3px;"><option value=""></option><option id="call1" value="checkall">checkall</option><option id="ucall1" value="uncheckall">uncheckall</option></select></td>
                <td style="border-right:solid 1px #deab6f; text-align:center; "><select name="block_dept" id="block_dept" style="width:70px; margin-top:3px;"><option value=""></option><option id="call2" value="checkall">checkall</option><option id="ucall2" value="uncheckall">uncheckall</option></select></td>
                 <td style="border-right:solid 1px #deab6f; text-align:center;"><input name="" type="submit" value="Update" style="margin-top:3px;" onclick="check();"/></td>
        </tr>
        
        </table>
        </div><!--date room part-->					
			<?php }}?>					
                        </div><!--title-->
					 </div>
                </div>
<?php $i = 0;if(isset($all)){if($all != ''){ ?>
 <form name="maintain_month" id="maintain_month" action="<?php echo WEB_URL_ADMIN?>supplier/update_maintain_month/1" method="post" onsubmit="return checked();">
         <div style="coloir:#fff; width:100%; ">

    <table  width="100%" border="0" align="left" cellpadding="0" cellspacing="0" class="display tableStatic" style="background:#fff;">
           
            <tr><td style="height:40px;" colspan="10"></td></tr>
			
			<?php foreach($all as $det){?>
			<input type="hidden" name="date<?php echo $i?>" value="<?php echo $det->date ?>"/>
            <tr style="border-top:solid 1px #deab6f; border-bottom:solid 1px #deab6f;">
            <td  style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd"><?php $date =  $det->date; echo $new1= date("D", strtotime($date)).'-'. date("d", strtotime($date));echo '<br/>'; echo $month= date("M", strtotime($date));?></td>
            <td  style="border-right:solid 1px #deab6f; text-align:center; width:10%;"  id="tdtd2"><?php echo ucfirst($det->rate_name);?></td>
            <td style="border-right:solid 1px #deab6f;  text-align:center; width:10%;" id="tdtd3"><input name="price[]" type="text" class="input-field"  style="width:50px; height:20px;  background:#F2F2F2;" value="<?php echo $det->rate;?>" /></td>
            <td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="avail[]" type="text" class="input-field"  style="width:50px; height:20px;  background:#F2F2F2;" value="<?php echo $det->available;?>" /></td>
            <td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="min_stay[]" type="text" class="input-field"  style="width:50px; height:20px;  background:#F2F2F2;" value="<?php echo $det->maxi_stay;?>"/></td>
            <td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tdtd3"><input name="max_stay[]" type="text" class="input-field"  style="width:50px; height:20px; background:#F2F2F2;" value="<?php echo $det->min_stay;?>" /></td>
            <td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tablecheckbox"><input name="on_req_checked_val" id="on_req_checked_val" type="checkbox"  value="<?php echo $det->date;?>"<?php if($det->on_request == 1){?> checked="checked"<?php }?> /></td>
            <td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tablecheckbox1"><input name="on_arr_checked_val" id="on_arr_checked_val" type="checkbox" value="<?php echo $det->date;?>" <?php if($det->block_arrival == 1){?> checked="checked"<?php }?>  /></td>
            <td style="border-right:solid 1px #deab6f; text-align:center; width:10%;" id="tablecheckbox2"><input name="on_blk_checked_val" id="on_blk_checked_val" type="checkbox" value="<?php echo $det->date;?>"  <?php if($det->block_departure == 1){?> checked="checked"<?php }?> /></td>

            <td></td>

            </tr>
&nbsp;&nbsp;&nbsp;&nbsp;
            <?php $i++;} ?>
			<input type="hidden" name="cnt" value="<?php echo $i?>"/>
			<input type="hidden" name="from" id="from" value=""/>
			<input type="hidden" name="to" id="to" value=""/>
			<input type="hidden" name="room_id" value="<?php if(isset($all)){if($all != ''){echo $all[0]->sup_apart_rateplan_id;}}?>"/>
			
			<input type="hidden" name="on_req_checked" id="on_req_checked"/>
            <input type="hidden" name="on_arr_checked" id="on_arr_checked"/>
			<input type="hidden" name="on_blk_checked" id="on_blk_checked"/>
   </table>
   <div style="clear:both; height:1px;"></div>
   </div>
   <table width="100%">
   
 <tr style="height:40px !important;">
                
              <td class="content-right-heading" style=" text-align:right; height:80px;" align="right">
                <input name="" type="submit" value=""  class="login-inner-save" style=""/>
     </td>
            </tr>
   </table>
        </form>
		<?php }}?>
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>