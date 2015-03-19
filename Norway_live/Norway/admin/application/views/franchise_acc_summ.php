<?php $this->view('header');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<title>Endeavour - Administration</title>
<link type="text/css" href="<?php echo WEB_DIR?>css/style.css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/jquery-1.4.2.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>
<script type="text/javascript">
function showCash()
{
	alert('anand');
	if(str=='cash')
	{
		$('#cash').show();
		$('#cash_deposit').show();
		$('#cheque_deposit').hide();
		$('#etransfer_deposit').hide();
		$('#trans_id').hide();
		$('#transfer').hide();
		$('#cheque').hide();
		$('#dd_date').hide();
		$('#dd_num').hide();
	}
	else if(str == 'transfer')
	{
		$('#cash').show();
		$('#cash_deposit').hide();
		$('#cheque_deposit').hide();
		$('#etransfer_deposit').show();
		$('#trans_id').show();
		$('#cheque').hide();
		$('#dd_date').hide();
		$('#dd_num').hide();
		
	}
	else
	{
		$('#cash').show();
		$('#cash_deposit').hide();
		$('#etransfer_deposit').hide();
		$('#cheque_deposit').show();
		$('#trans_id').hide();
		$('#transfer').hide();
		$('#dd_date').show();
		$('#dd_num').show();
	}

}
/*function validate_form()
{
	if(document.frmname.amount_deposited.value=="" || document.frmname.amount_deposited.value.length==0)
	{
		alert ("Enter the Deposited Amount");
		document.frmname.amount_deposited.value ='';
		document.frmname.amount_deposited.focus();
		return false;
	}
	if(isNaN(document.frmname.amount_deposited.value))
	{
		alert("Enter the Deposited amount in numeric"); 
		document.frmname.amount_deposited.value ='';
		document.frmname.amount_deposited.focus();
		return false;
	}
	if(document.frmname.current_limit.value=="" || document.frmname.current_limit.value.length==0)
	{
		alert ("Enter the Current Limit");
		document.frmname.current_limit.value ='';
		document.frmname.current_limit.focus();
		return false;
	}
	if(isNaN(document.frmname.current_limit.value))
	{
		alert("Enter the Current Limit in numeric"); 
		document.frmname.current_limit.value ='';
		document.frmname.current_limit.focus();
		return false;
	}
	
	if(document.frmname.deposit_date.value =="")
	{
		alert('Please enter deposited date');
		document.frmname.deposit_date.value ='';
		document.frmname.deposit_date.focus();
		return false;
	}
}*/
function validate()
{
	if(confirm("Are you sure to delete the record?"))	
	{
		window.location.href='<?php echo WEB_URL_ADMIN?>admin/delete_agent/<?php echo $agent->user_id?>';
	   	return true;
   	}
   	else
   	{
		return false;
   	}

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
	var type = "<?php echo $users->user_type_id;?>";
if(type !='')
{
	document.getElementById('user_type').disabled = true;
}
	$(function() {
			$("#dob").datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true,
			maxDate: 0
		});
		

	});

});
</script>

<style type="text/css">
/*#container_warpper {
    background: none repeat scroll 0 0 #FFFFFF;
    border-color: #74941D;
    border-left: 3px solid #74941D;
    border-style: solid;
    border-width: 2px 3px 3px;
    height: auto !important;
    margin: auto;
    overflow: hidden;
    width: 1000px;
}*/
.getfields {
    border: 1px solid #D6D6D6;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 14px;
    height: 18px;
    padding: 5px;
    width: 280px;
}
.getfields1 {    border: 1px solid #D6D6D6;
    border-radius: 3px 3px 3px 3px;
    color: #333333;
    font-size: 14px;
    height: 18px;
    padding: 5px;
    width: 280px;
}
</style>
</head>
<body>
<!--<div id="inner-pagetit">Agent Registration</div>-->
<div id="container_warpper" >
<form method="post" id="user_registration_form" action="<?php echo WEB_URL_ADMIN?>admin/update_franchise_acc">
 <input name="id" type="hidden" value="<?php echo $id;?>" />
 
<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;">
<tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3" valign="top"> <span id="info_message" style="margin-left:15px; color:#F00;"><?php if(isset($message)){if($message != ''){echo $message ;}}?><strong></strong></span></td>
    </tr>
  <tr>
    <td width="300" valign="top"><div style="width:21%; float:left">
   <div class="deposit_text" style="background-color:#505e91;">Account Information</div>
   <div style="border:solid 1px #ccc; height:auto; overflow:hidden; width:211px; margin-top:1px;">
   <table width="210">
<tr>
   <td>Balance</td>
   <td><?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->account_balance ;}}?>&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?>  &nbsp;</td>
   </tr>
   <tr><td height="5"  colspan="2" style="border-bottom:dotted 1px #202f23"></td></tr>
   <tr>
   <td width="102">Current Limit</td>
   <td width="96"><?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->current_limit ;}}?>&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?>&nbsp;</td>
   </tr>
   <tr><td height="5" colspan="2" style="border-bottom:dotted 1px #202f23"></td></tr>
   
   <tr>
   <td>Used Amount</td>
   <td><?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->used_amount ;}}?>&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?>&nbsp;</td>
   </tr>
    </table>
   </div>
   </div></td>
    <td width="20" valign="top">&nbsp;</td>
    <td align="left" valign="top"><div style="width:97%; float:right; margin-left:20px;">
    <div class="deposit_text1" style="background-color:#505e91;">Admin Deposit</div>
   <div style="border:solid 1px #ccc; height:auto; overflow:hidden; width:719px; margin-top:1px;">
  
   <table width="719" style="margin-left:15px;">
   <tr>
   <td width="102">Franchise Name :</td>
   <td width="96"><?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->franchise_name ;}}?></td>
   </tr>
   <tr><td height="15" colspan="2" ></td></tr>
   <tr>
   <td>Balance Amount :</td>
   <td><?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->account_balance ;}}?>&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?> </td>
   </tr>
   <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Current Limit :</td>
   <td><?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->current_limit ;}}?>&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?></td>
   </tr>
   
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Amount Deposited :</td>
   <td><input name="amount_deposited" id="amount_deposited" type="text" style="width:200px;" />&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Current Limit :</td>
   <td><input name="current_limit" type="text" style="width:200px;" />&nbsp;<?php if(isset($acc_det)){if($acc_det != ''){echo $acc_det->currency ;}}?></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Date of Deposit :</td> 
   <td><input name="deposit_date" type="text" id="datepicker"  style="width:200px;"/></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Mode of Deposit :</td>
   <td><select name="mode_deposit" onchange="change_mode(this.value);"   style="width:180px;">
	<option value="">--select---</option>
  	<option value="cash">Cash Deposit</option>
	<option value="transfer">e Transfer</option>
	<option value="cheque">Cheque /DD Deposit</option>
   </select></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
</table>

<table id="cash" style="margin-left:10px;display:none;">
<tr id="cash_deposit" style="display:none;">
	<td colspan="2"  style="text-align:center; background:#74941D; color:#fff;">Cash Deposit</td>
    </tr>
	<tr><td height="5"></td></tr>

<tr id="etransfer_deposit" style="display:none;">
	<td colspan="2" style="text-align:center; background:#74941D; color:#fff;">E Transfer</td>
    </tr>
	<tr><td height="5"></td></tr>

<tr id="cheque_deposit" style="display:none;">
	<td colspan="2" style="text-align:center; background:#74941D; color:#fff;">Cheque/DD</td>
    </tr>
	<tr><td height="5"></td></tr>

	<tr>
        <td width="240">Bank :</td>
        <td><input name="bank_name" type="text"/></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	
	<tr>
        <td width="240">Branch :</td>
        <td><input name="branch_name" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	
	<tr>
        <td width="240">City :</td>
        <td><input name="city" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	
	<tr id="trans_id" style="display:none;">
        <td width="240">Transaction Id :</td>
        <td><input name="transaction_id" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	<tr id="dd_num" style="display:none;">
        <td width="240">DD/Cheque date :</td>
        <td><input name="cheque_date" id="cheque_date" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	
	<tr id="dd_date" style="display:none;">
        <td width="240">DD/Cheque No :</td>
        <td><input name="cheque_no" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	
	<tr>
        <td width="240">Remarks :</td>
        <td><textarea name="remarks" cols="25"></textarea></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	
	<tr>
        <td width="240"></td>
        <td><input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22"></td>
        </tr>
</table>


</form>
   </div>
   <table width="719" border="0" style="margin-top:10px;" >
  <tr style="color:#fff">

     <td bgcolor="#555"><div align="center">Date</div></td>
      <td bgcolor="#555"><div align="center">Deposit Mode</div></td>
     <td bgcolor="#555"><div align="center">Deposit Amount</div></td>
     <td bgcolor="#555"><div align="center">Limit</div></td>
     <!--<td bgcolor="#555"><div align="center">Mode</div></td>-->
     <td bgcolor="#555"><div align="center">Status</div></td>
  </tr>
  
 
    <?php if(isset($deposite_list)){if($deposite_list != ''){foreach($deposite_list as $row){?>         
  <tr style="color:#000" align="center">

    <td bgcolor="#e6e7eb"><?php echo $row->date_of_deposit?></td>
     <td bgcolor="#e6e7eb"><?php echo $row->mode_of_deposit?></td>
    <td bgcolor="#e6e7eb"><?php echo $row->deposited_amount?></td>
    <td bgcolor="#e6e7eb"><?php echo $row->current_limit?></td>
   <!-- <td bgcolor="#e6e7eb"><?php echo $row->date_of_deposit?></td>-->
   
 <td bgcolor="#e6e7eb"><a href="<?php echo WEB_URL_ADMIN?>admin/change_deposite_status/<?php echo $row->franchise_amount_deposit_id ;?>/<?php echo $row->status?>/<?php echo $id ;?>"><?php echo $row->status?></a></td>
  </tr>
 <?php }}}?>  
</table>
   
   </div></td>
  </tr>
</table></td>
<td valign="top">

</td></tr>
</table>
 
<div style="clear:both;"></div>
</div>
<div style="width:940px; margin:0 auto">
<?php $this->view('footer');?>
</div>
</body>
</html>
<script type="text/javascript">
function change_mode(str)
{
	//alert("asdf");
	//alert(str);
	if(str=='cash')
	{
		$('#cash').show();
		$('#cash_deposit').show();
		$('#cheque_deposit').hide();
		$('#etransfer_deposit').hide();
		$('#trans_id').hide();
		$('#transfer').hide();
		$('#cheque').hide();
		$('#dd_date').hide();
		$('#dd_num').hide();
	}
	else if(str == 'transfer')
	{
		$('#cash').show();
		$('#cash_deposit').hide();
		$('#cheque_deposit').hide();
		$('#etransfer_deposit').show();
		$('#trans_id').show();
		$('#cheque').hide();
		$('#dd_date').hide();
		$('#dd_num').hide();
		
	}
	else
	{
		$('#cash').show();
		$('#cash_deposit').hide();
		$('#etransfer_deposit').hide();
		$('#cheque_deposit').show();
		$('#trans_id').hide();
		$('#transfer').hide();
		$('#dd_date').show();
		$('#dd_num').show();
	}
}
</script>
<script>
  setTimeout(function(){
    document.getElementById('info_message').style.display = 'none';
    /* or
    var item = document.getElementById('info-message')
    item.parentNode.removeChild(item); 
    */
  }, 3000);
</script>