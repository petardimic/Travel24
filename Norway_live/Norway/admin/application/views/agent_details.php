<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelingmart</title>
</head>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery_tab.js"></script>	
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/jquery-1.4.2.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>calender/css/overcast/jquery-ui-1.8.6.custom.css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.core.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>calender/ui.datepicker.js"></script>

<!--Tab Script-->

<script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")   
        return false;	  
      });
    });  
  });
</script>

<script type="text/javascript">
$(document).ready(function(){

	$(function() {
			$("#datepicker").datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true,
			//minDate: 0
			maxDate: 0
		});
$("#cheque_date").datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: '<?php echo WEB_DIR_ADMIN?>media/cal_new.png ',
			buttonImageOnly: true,
			//minDate: 0
			//maxDate: 0
	});
	
	});
	
});
</script>
<script type="text/javascript">
function showCash(str)
{
	//alert('anand');
	if(str=='cash')
	{
		$('#cash').show();
		$('#cash_deposit').show();
		$('#trans_id').hide();
		$('#transfer').hide();
		$('#cheque').hide();
	}
	else if(str == 'transfer')
	{
		$('#cash').show();
		$('#cash_deposit').hide();
		$('#etransfer_deposit').show();
		$('#trans_id').show();
		$('#cheque').hide();
	}
	else
	{
		$('#cash').show();
		$('#cash_deposit').hide();
		$('#cheque_deposit').show();
		$('#etransfer_deposit').hide();
		$('#transfer').hide();
		$('#dd_date').show();
		$('#dd_num').show();
	}

}
function validate_form()
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
}
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
<!--Tab Script-->


<?php if(isset($amount)){ $tot_avail = 0; $deposited_amt = 0; if($amount!= '') { foreach($amount as $amt){ $tot_avail = $tot_avail + $amt->current_limit; $deposited_amt = $deposited_amt + $amt->deposited_amount;?>	<?php }}}?>



<div id="container_warpper" >  
  <div style="background:#EFA146; color:#000; padding:4px;" >View Agent Details</div>
<div style="clear:both; height:15px;"></div>
  <!--tab part-->
  <div class="tab-box" > 
    <a href="javascript:;" class="tabLink activeLink" id="cont-1">Contact Details</a> 
    <a href="javascript:;" class="tabLink " id="cont-2">Deposit</a> 
    <a href="javascript:;" class="tabLink " id="cont-3">Discount</a> 
     <a href="javascript:;" class="tabLink " id="cont-4" onclick="return  validate();" >Delete</a>

  </div>
  
  <div class="tabcontent" id="cont-1-1" style=" ">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="300"><table width="369" style="margin-left:8px; margin-top:10px; background-color:#FFFFF9 !important; border:dashed 1px #74941D !important;">
          <tr>
            <td width="180">Agent/ Corporate Name :</td>
            <td width="33"></td>
            <td width="207"><?php if($agent != ''){print $agent->agency_name;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td width="113">First Name :</td>
            <td width="33"></td>
            <td width="207"><?php if($agent != ''){print $agent->first_name;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td width="113">Last Name :</td>
            <td width="33"></td>
            <td width="207"><?php if($agent != ''){print $agent->last_name;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Address :</td>
            <td></td>
            <td><?php if($agent != ''){ print $agent->address;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Country:</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->country;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>City :</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->city;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Pincode :</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->postal_code;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Email:</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->email;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Office Phone:</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->alternative_no;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Mobile:</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->mobile_no;}?></td>
          </tr>
          <tr>
            <td height="4"></td>
          </tr>
          <tr>
            <td>Status :</td>
            <td></td>
            <td><?php if($agent != ''){print $agent->status;}?></td>
          </tr>
        </table></td>
        <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="369" style="margin-left:8px; float:right; margin-top:10px; background-color:#FFFFF9 !important; ">
              <tr>
                <td><a href="<?php echo WEB_URL_ADMIN?>admin/edit_agent/<?php echo $agent->user_id?>"><img src="<?php echo WEB_DIR?>images/View_a_c_Profile.png" height="40" width="150" /></a></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><table width="369" style="margin-left:8px; float:right; margin-top:10px; background-color:#FFFFF9 !important;">
              <tr>
                <td><a href="<?php echo WEB_URL_ADMIN?>admin/view_agent_bookings/<?php echo $agent->user_id?>"><img src="<?php echo WEB_DIR?>images/View_a_c_bookings.png" height="40" width="150" /></a></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
        <td width="100" align="left">&nbsp;</td>
      </tr>
    </table>
  </div><!--first tab-->
  
  <div class="tabcontent hide" id="cont-2-1" style="height:auto; overflow:hidden;"> 
  
   <div style="width:948px; margin-top:10px;">
   
   <div style="width:21%; float:left">
   <div class="deposit_text">Account Information</div>
   <div style="border:solid 1px #ccc; height:auto; overflow:hidden; width:211px; margin-top:1px;">
   <table width="210">
<tr>
   <td>Balance</td>
   <td><?php if($avail != ''){echo $avail->Total_Bal;}?>&nbsp;<?php if($default_currency!=''){echo $default_currency->currency;}?></td>
   </tr>
   <tr><td height="5"  colspan="2" style="border-bottom:dotted 1px #202f23"></td></tr>
   <tr>
   <td width="102">Current Limit</td>
   <td width="96"><?php if($avail != ''){echo $avail->current_limit;}?>&nbsp;<?php if($default_currency!=''){echo $default_currency->currency;}?></td>
   </tr>
   <tr><td height="5" colspan="2" style="border-bottom:dotted 1px #202f23"></td></tr>
   
   <tr>
   <td>Used</td>
   <td><?php if($avail != ''){ echo $avail->used_amount;}?></td>
   </tr>
    </table>
   </div>
   </div><!--40% width-->
   
   <div style="width:76%; float:right; margin-left:20px;">
    <div class="deposit_text1">Admin Deposit</div>
   <div style="border:solid 1px #ccc; height:auto; overflow:hidden; width:719px; margin-top:1px;">
   <form method="post" id="agent_deposit" name="frmname"  action="<?php echo WEB_URL_ADMIN?>/admin/add_deposit_details/<?php echo $agent->user_id?>" onsubmit="return validate_form();"><?php /*<?php echo WEB_URL_ADMIN?>/admin/add_deposit_details/<?php echo $agent->agent_id?><?php */?>
   <table width="719" style="margin-left:15px;">
   <tr>
   <td width="102">Agent Name :</td>
   <td width="96"><?php print $agent->first_name;?></td>
   </tr>
   <tr><td height="15" colspan="2" ></td></tr>
   <tr>
   <td>Balance Amount :</td>
   <td><?php if($avail != ''){echo $avail->Total_Bal;}?>&nbsp;<?php if($default_currency!=''){echo $default_currency->currency;}?></td>
   </tr>
   <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Current Limit :</td>
   <td><?php if($avail != ''){echo $avail->current_limit;}?>&nbsp;<?php if($default_currency!=''){echo $default_currency->currency;}?></td>
   </tr>
   
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Amount Deposited :</td>
   <td><input name="amount_deposited" id="amount_deposited" type="text" style="width:200px;" />&nbsp;<?php if($default_currency!=''){echo $default_currency->currency;}?></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Current Limit :</td>
   <td><input name="current_limit" type="text" style="width:200px;" />&nbsp;<?php if($default_currency!=''){echo $default_currency->currency;}?></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Date of Deposit :</td> 
   <td><input name="deposit_date" type="text" id="datepicker"  style="width:200px;"/></td>
   </tr>
   
    <tr><td height="15"  colspan="2" ></td></tr>
   <tr>
   <td>Mode of Deposit :</td>
   <td><select name="mode_deposit" onchange="showCash(this.value)"  style="width:180px;">
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
	<tr><td height="5"></td></tr>
</tr>
<tr id="etransfer_deposit" style="display:none;">
	<td colspan="2" style="text-align:center; background:#74941D; color:#fff;">E Transfer</td>
	<tr><td height="5"></td></tr>
</tr>
<tr id="cheque_deposit" style="display:none;">
	<td colspan="2" style="text-align:center; background:#74941D; color:#fff;">Cheque/DD</td>
	<tr><td height="5"></td></tr>
</tr>
	<tr>
        <td width="240">Bank :</td>
        <td><input name="bank_name" type="text"/></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	</tr>
	<tr>
        <td width="240">Branch :</td>
        <td><input name="branch_name" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	</tr>
	<tr>
        <td width="240">City :</td>
        <td><input name="city" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	</tr>
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
	
	</tr>
	<tr id="dd_date" style="display:none;">
        <td width="240">DD/Cheque No :</td>
        <td><input name="cheque_no" type="text" /></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	</tr>
	<tr>
        <td width="240">Remarks :</td>
        <td><textarea name="remarks" cols="25"></textarea></td>
        </tr>
	<tr><td height="5"></td></tr>
	
	</tr>
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
     <td bgcolor="#555"><div align="center">Mode</div></td>
     <td bgcolor="#555"><div align="center">Status</div></td>
  </tr>
  
<?php if(isset($amount)){ if($amount!= '') { foreach($amount as $row){ ?>	
               
  <tr style="color:#000" align="center">

    <td bgcolor="#e6e7eb"><?php echo $row->date_of_deposit;?></td>
     <td bgcolor="#e6e7eb"><?php echo $row->mode_of_deposit ?></td>
    <td bgcolor="#e6e7eb"><?php echo $row->deposited_amount?></td>
    <td bgcolor="#e6e7eb"><?php echo $row->current_limit?></td>
    <td bgcolor="#e6e7eb"><?php echo $row->mode_of_deposit?></td>
    <td bgcolor="#e6e7eb"><?php echo $row->deposit_status;?></td>
  </tr>
 <?php }}}else{?>
<tr>No Records Found</tr>
<?php }?>
</table>
   
   </div><!--60% width-->
   </div><!--100% width-->
   
   
   
  </div> <!--second tab-->
  
  <div class="tabcontent hide" id="cont-3-1"> 
   
   
   
    <form method="post" action="<?php echo WEB_URL_ADMIN?>/admin/edit_discount/<?php echo $agent->user_id?>">
   <table width="410" style="margin-top:10px;">
   <tr style="width:410px; background:#333333; border-right:solid 1px #fff; text-align:center; color:#fff;">
   <td width="102">Services</td>
   <td width="50">Discount</td>
   </tr>
	
   <tr style="width:410px; text-align:center; color:#000;">
   <td width="102" style="border:solid 1px #ccc;">All Services</td>
   <td width="50" style="border:solid 1px #ccc;"><input name="discount" type="text" style="width:50px;" value="<?php  if($discount != '') { echo $discount->value; } ?>" />%&nbsp;<input type="image" src="<?php echo WEB_DIR_ADMIN?>images/pencil-icon.gif"/><?php if($discount != '') {if($discount->type == 1){echo "price";} else{echo "%";} }?></td>
   </tr>
 </table>
 </form>
    
    
  </div> <!--third tab-->
   <div class="tabcontent hide" id="cont-4-1"> 
	<table width="180" style="margin-left:8px; margin-top:10px; background-color:#FFFFF9 !important; border:dashed 1px #74941D !important;">
	<tr><td>Request Cancelled</td></tr>
	</table>
</div>
  <!--tab part-->
  
  

</div>
</body>
</html>
