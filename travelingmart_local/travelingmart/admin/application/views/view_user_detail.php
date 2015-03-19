<?php /*?><?php
session_start();

require_once("../flight/connect.php");
$agent_id=$id;

if(isset($_POST['updateMark'])){

//print_r($_REQUEST);exit;
	//$hotel_comm	 		= (int) $_POST['hotel_comm'];
	$hotel_markup		= (int) $_POST['hotel_markup'];
	$H_comm 	 		= '';
	$bus_markup  		= (int) $_POST['bus_markup'];
	$car_comm 	 		= '';
	$car_markup  		= '';
	$f_airindia_c		= (int) $_POST['f_airindia_c'];
	$f_airindia_m		= '';
	$f_indian_c	 		= '';
	$f_indian_m	 		= '';
	$f_jetair_c  		= (int) $_POST['f_jetair_c'];
	$f_jetair_m  		= '';
	$f_king_c	 		= (int) $_POST['f_king_c'];
	$f_king_m	 		= '';
	$f_airindiaexp_c 	= (int) $_POST['f_airindiaexp_c'];
	$f_airindiaexp_m 	= '';
	$f_goair_c	 		= (int) $_POST['f_goair_c'];
	$f_goair_m	 		= '';
	$f_indigo_c	 		= (int) $_POST['f_indigo_c'];
	$f_indigo_m	 		= '';
	$f_mdlr_c	 		= '';
	$f_mdlr_m	 		= '';
	$f_paramount_c		= '';
	$f_paramount_m		= ''; 
	$f_jetlite_c		= (int) $_POST['f_jetlite_c'];
	$f_jetlite_m		= ''; 
	$f_spice_c			= (int) $_POST['f_spice_c'];
	$f_spice_m			= ''; 
	$f_int_c			= (int) $_POST['f_int_c'];
	$f_int_airindia_c	= (int) $_POST['f_int_airindia_c'];
	$f_int_jetair_c		= (int) $_POST['f_int_jetair_c'];
	$f_int_jetlite_c	= (int) $_POST['f_int_jetlite_c'];
	$f_int_king_c		= (int) $_POST['f_int_king_c'];
	$f_int_airindiaexp_c= (int) $_POST['f_int_airindiaexp_c'];
	$f_int_goair_c		= (int) $_POST['f_int_goair_c'];
	$f_int_indigo_c		= (int) $_POST['f_int_indigo_c'];
	$f_int_mdlr_c		= (int) $_POST['f_int_mdlr_c'];
	$f_int_paramount_c	= (int) $_POST['f_int_paramount_c'];
	$f_int_spice_c		= (int) $_POST['f_int_spice_c'];
	
	  
	if(!mysql_query("UPDATE agents SET hotel_markup='$hotel_markup',  bus_markup='$bus_markup', car_comm='$car_comm', car_markup='$car_markup', 
					f_airindia_c='$f_airindia_c', f_airindia_m='$f_airindia_m', f_indian_c='$f_indian_c', f_indian_m='$f_indian_m',
					f_jetair_c='$f_jetair_c', f_jetair_m='$f_jetair_m', f_jetlite_c='$f_jetlite_c', f_jetlite_m='$f_jetlite_m', f_king_c='$f_king_c',
					f_king_m='$f_king_m', f_airindiaexp_c='$f_airindiaexp_c', f_airindiaexp_m='$f_airindiaexp_m', f_goair_c='$f_goair_c',
					f_goair_m='$f_goair_m', f_indigo_c='$f_indigo_c', f_indigo_m='$f_indigo_m', f_mdlr_c='$f_mdlr_c', f_mdlr_m='$f_mdlr_m', 
					f_paramount_c='$f_paramount_c', f_paramount_m='$f_paramount_m', f_spice_c='$f_spice_c', f_spice_m='$f_spice_m',f_int_c='$f_int_c',
					f_int_airindia_c='$f_int_airindia_c', f_int_jetair_c='$f_int_jetair_c', f_int_jetlite_c='$f_int_jetlite_c', f_int_king_c='$f_int_king_c',f_int_airindiaexp_c='$f_int_airindiaexp_c',
					f_int_goair_c='$f_int_goair_c', f_int_indigo_c='$f_int_indigo_c', f_int_mdlr_c='$f_int_mdlr_c', f_int_paramount_c='$f_int_paramount_c',f_int_spice_c='$f_int_spice_c' 
					WHERE agent_id='$agent_id' ")) exit(mysql_error());
}

?>
<?php */?>

<?php 
@session_start();

require_once("../flight/connect.php");
$agent_id=$id;

if(isset($_POST['updateMark'])){
	
	$hotel_markup		= (int) $_POST['hotel_markup'];
	$H_comm 	 		= '';
	$bus_markup  		= (int) $_POST['bus_markup'];
	$car_comm 	 		= '';
	$car_markup  		= (int) $_POST['car_markup'];
	$thingstodo_markup  		= (int) $_POST['thingstodo_markup'];
	$package_markup  		= (int) $_POST['package_markup'];
	
	$all_dom_airline		= (int) $_POST['all_dom_airline'];
	$all_int_airline		= (int) $_POST['all_int_airline'];
	
		if(!mysql_query("UPDATE agents SET hotel_markup='$hotel_markup',  bus_markup='$bus_markup', car_comm='$car_comm', car_markup='$car_markup',all_dom_airline='$all_dom_airline',all_int_airline='$all_int_airline',thingstodo_markup='$thingstodo_markup',package_markup='$package_markup' WHERE agent_id='$agent_id' ")) exit(mysql_error());
}
	
	?>
<script type="text/javascript">

function isExp(data)
	{
	var numStr="1234567890.+-";
	var thisChar;
	var counter=0;
	for(var i=0; i < data.length; i++)
		{
			thisChar=data.substring(i,i+1);
			if(numStr.indexOf(thisChar)!=-1)
			{counter++;}
		}
		if(counter==data.length)
		{return true;}
		else
		return false;
	}
	
function validate_form()
{



	 if(document.frmname.amount_depo.value=="" || document.frmname.amount_depo.value.length==0)
	{
		alert ("Enter the Deposit Amount");
		document.frmname.amount_depo.focus();
		return false;
	}
 if (isExp(document.frmname.amount_depo.value)==false)
	{
	alert("Enter the value in numeric"); 
	document.frmname.amount_depo.focus();
	return false;
	}	
	
	
		 if(document.frmname.dod.value=="" || document.frmname.dod.value.length==0)
	{
		alert ("Enter the Date");
		document.frmname.dod.focus();
		return false;
	}	
	
 if(document.frmname.users.selectedIndex=="")
	{
		alert ("Select the Deposit Mode");
		document.frmname.users.focus();
		return false;
	}	


			 if(document.frmname.bank_name.value=="" || document.frmname.bank_name.value.length==0)
	{
		alert ("Enter the Bank Name");
		document.frmname.bank_name.focus();
		return false;
	}	
	
				 if(document.frmname.branch_name.value=="" || document.frmname.branch_name.value.length==0)
	{
		alert ("Enter the Bank Branch");
		document.frmname.branch_name.focus();
		return false;
	}	
	
					 if(document.frmname.city.value=="" || document.frmname.city.value.length==0)
	{
		alert ("Enter the City");
		document.frmname.city.focus();
		return false;
	}	
	
						 if(document.frmname.transaction_id.value=="" || document.frmname.transaction_id.value.length==0)
	{
		alert ("Enter the Transaction Id");
		document.frmname.transaction_id.focus();
		return false;
	}	
	
						 if(document.frmname.cheque_date.value=="" || document.frmname.cheque_date.value.length==0)
	{
		alert ("Enter the Cheque Date");
		document.frmname.cheque_date.focus();
		return false;
	}	
	
						 if(document.frmname.cheque_no.value=="" || document.frmname.cheque_no.value.length==0)
	{
		alert ("Enter the Cheque No");
		document.frmname.cheque_no.focus();
		return false;
	}			

	return true
	
	
}
</script>

<script type="text/javascript">
function showCash(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","<?php print WEB_URL_ADMIN?>admin/getcash/"+str,true);
xmlhttp.send();
}
</script>
<style type="text/css">
<!--
.style1 {color: #FFFFFF}
.style2 {font-weight: bold}
.style3 {color: #FFFFFF; font-weight: bold; }
-->
</style>
<?php 
$agent_id=$id;
$sql = mysql_query("SELECT * FROM agents WHERE agent_id='$agent_id'");
$rows=mysql_fetch_array($sql);
?>
<div class="agent_dash_out">
<div class="my_acc_out">
            	<div id="TabbedPanels1" class="TabbedPanels">
                                <ul class="TabbedPanelsTabGroup">
                                  <li class="TabbedPanelsTab" tabindex="0">Contact Details</li>
                                  <li class="TabbedPanelsTab" tabindex="0">Deposit</li>
                                  <!--<?php if(isset($user_list)){ if($user_list != '') { foreach ($user_list as $row) ?>
                                  <li class="TabbedPanelsTab" tabindex="0"><a href="<?php print WEB_URL_ADMIN.'admin/admin_deposit/'.$row->agent_id; ?>admin/make_deposit">Deposit</a></li><?php }} ?>
                                  -->
                                  <li class="TabbedPanelsTab" tabindex="0">Discount</li><?php if(isset($user_list)){ if($user_list != '') { foreach ($user_list as $row) ?>
                                 <?php }} ?>
                                </ul>
                                <div class="TabbedPanelsContentGroup">
                                  <div class="TabbedPanelsContent">
                                    <div id="descTab">
                                    	  	<div class="user_details_out">
                                   	  	
	
   <?php foreach ($user_list as $row) ?>
   
   <div class="user_fld-out">
    <div class="user_fld_txt">Company Name :</div>
    <div class="userr_fld_box"><?php print $row->agency_name ; ?></div>
    </div>
<div class="user_fld-out">
    <div class="user_fld_txt">User Name :</div>
    <div class="userr_fld_box"><?php print $row->agent_name ; ?></div>
    </div>
    
    <div class="user_fld-out">
    <div class="user_fld_txt">Address :</div>
    <div class="userr_fld_box"><?php print $row->address; ?></div>
    </div>
     <div class="user_fld-out">
    <div class="user_fld_txt">State :</div>
    <div class="userr_fld_box"><?php print $row->state; ?></div>
    </div>
    <div class="user_fld-out">
    <div class="user_fld_txt">City :</div>
    <div class="userr_fld_box"><?php print $row->city;?></div>
    </div>
    <div class="user_fld-out">
    <div class="user_fld_txt">Pincode :</div>
    <div class="userr_fld_box"><?php print $row->pincode; ?></div>
    </div>
     <div class="user_fld-out">
    <div class="user_fld_txt">Country:</div>
     <div class="userr_fld_box"><?php print $row->country; ?></div>
    </div>
    <div class="user_fld-out">
    <div class="user_fld_txt">Email:</div>
    <div class="userr_fld_box"><?php print $row->email ; ?></div>
    </div>
    <div class="user_fld-out">
    <div class="user_fld_txt">Office Phone:</div>
    <div class="userr_fld_box"><?php print $row->office_phone ; ?></div>
    </div>
    
     <div class="user_fld-out">
    <div class="user_fld_txt">Mobile:</div>
    <div class="userr_fld_box"><?php print $row->mobile_phone ; ?></div>
    </div>

    <div class="user_fld-out">
    <div class="user_fld_txt">Fax :</div>
    <div class="userr_fld_box"><?php print $row->fax; ?></div>
    </div>
     
   
    
  
</div>
                                    </div>
                                  </div>
                                  <!-- tab 2 start here -->
                                  
<div class="TabbedPanelsContent">
<form name="frmname" method="post" action="<?php print WEB_URL_ADMIN?>admin/add_deposit_details" onsubmit="return validate_form();">
<input type="hidden" name="agentid" value="<?php print $row->agent_id; ?>" />
<div class="agent_account_depo-left">
                	<div class="agent_dash-box-out">
                   	  <div class="agent_dash-box-title-red">
                        	<div class="agent_dash-box-titile-txt">Account Information</div>
                            </div>
                   	  <div class="agent_dash-box-txt-2">
                        	<ul>
                          
                               
                                <li class="contactperson"><a href="#">Balance</a></li>
                                <li class="contactperson"><a href="#">Used</a></li>
                                
                            </ul>
                            <ul><?php
							if(isset($user_list))
							{
								if($user_list!='')
								{
									foreach ($user_list as $row1)
									{
										
									 ?>
                            	
                         
                         <li><?php print $row1->account_balance; ?> <strong>INR</strong></li>
                         <li><?php //print $row1->used_amt; ?> <strong>INR</strong></li>
                               <?php }
								}
								else
								{
									
									
									 ?>
									
							 <li>0 <strong>INR</strong></li>
							 <li>0 <strong>INR</strong></li>
							 <li>0 <strong>INR</strong></li>
								   <?php
								}
							}
							else
							{
								
								 ?>
                            	
                         <li>0 <strong>INR</strong></li>
                         <li>0 <strong>INR</strong></li>
                         <li>0 <strong>INR</strong></li>
                               <?php
							}
							?>
                            </ul>
                      </div>
                    </div>
                </div>
                <div class="agent_account_depo-right">
                	<div class="agent_dash-box-out-3">
                   	  <div class="agent_dash-box-title-red-3">
                        	<div class="agent_dash-box-titile-txt-3">Agent Deposit</div>
                      </div>
                      <div style=" height:auto; width:665px; border-top:solid 1px #8B9698; margin-top:1px;">
                   	  <div class="agent_dash-box-txt-3"  >
                      	
                        <?php
						//print_r($deposit_list);
						 if(isset($user_list))
						{
							if($user_list!='')
							{
								foreach ($user_list as $row1) 
								{
								?>
                        <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Balance Amount  :</div>
                            <div class="agent_acc_depo-h1-right"><?php print $row1->account_balance; ?> <strong>INR</strong></div>
                        </div>
                    
                       
						<?php }
							}
							else{?>
                                          <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Balance Amount  :</div>
                            <div class="agent_acc_depo-h1-right">0.00 <strong>INR</strong></div>
                        </div>
                       
                        <?php }}?>
                         <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Amount Deposited :</div>
                            <div class="agent_acc_depo-h1-right">
                            <input name="amount_depo" type="text" value="" class="agent_acc_depo-h1-right-fld-2" />
                            </div>
                        </div>
                        
                        <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Date of Deposit  :</div>
                            <div class="agent_acc_depo-h1-right">
                            <div class="agent_acc_depo-h1-right-in">
    	                       <input type="text" class="w8em format-d-m-y divider-dash highlight-days-12 range-low-today" id="sd" name="dod" value="<?php echo date('d/m/Y'); ?>" maxlength="10" size="10" />
                            </div>
                            <div class="agent_acc_depo-h1-right-fld-icon">
                             
                            </div>
                            </div>
                        </div>
                        <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Mode of Deposit  :</div>
                            <div class="agent_acc_depo-h1-right">
                            <select name="users" onchange="showCash(this.value)" class="agent_acc_depo-h1-right-fld-3">
                                        <option value="" selected="selected">Select</option>
               <option value="cash">Cash Deposit</option>
              <option value="credit">e Transfer</option>
              <option value="cheque">Cheque /DD Deposit</option>
                  <option value="cheque">Cheque /DD Deposit</option>
                    <option value="creditdeposit">Credit Deposit</option>
                            </select>
                            </div>
                        </div>
                        
                        <?php $admin = $this->Home_Model->get_admin_list(); ?>
                        <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Admin Name  :</div>
                            <div class="agent_acc_depo-h1-right">
                            <select name="admin_name"  class="agent_acc_depo-h1-right-fld-3">
                            <option value="">select</option>
                                     <?php if(isset($admin)) { if($admin != '') { foreach($admin as $ad) {?>
                                     	<option value="<?php echo $ad->first_name." ".$ad->last_name; ?>"><?php echo $ad->first_name." ".$ad->last_name; ?></option>
                                     <?php } } } ?>  
                            </select>
                            </div>
                        </div>
                         <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left">Remarks  :</div>
                            <div class="agent_acc_depo-h1-right">
                            <textarea name="remarks"></textarea>
                            </div>
                        </div>
                          <div class="agent_acc_depo-h1-out-2">
                        	<div class="agent_acc_depo-h1-left"></div>
                            <div class="agent_acc_depo-h1-right">
                            <input type="image" src="<?php echo WEB_DIR_ADMIN;?>images/submit.jpg"/>
                            </div>
                        </div>
                        <div id="txtHint"></div>
                      </div>
                      </div><!--debasmita-->
                	</div>
                </div>
                </form>
                <div class="clr"></div><!--
                Admin deposit details start here
 -->
 <div class="amo-depo-out">
 <table width="672px" border="0" style="float:right;">
  <tr style="color:#fff">
    <td bgcolor="#4f6c7f"><div align="center"><strong>S.No</strong></div></td>
     <td bgcolor="#4f6c7f"><div align="center"><strong>Date Time </strong></div></td>
     <td bgcolor="#4f6c7f"><div align="center"><strong>Time </strong></div></td>
     <td bgcolor="#4f6c7f"><div align="center"><strong>Remark</strong></div></td>
     <td bgcolor="#4f6c7f"><div align="center"><strong>Amount  </strong></div></td>
    
     <td bgcolor="#4f6c7f"><div align="center"><strong>Mode</strong></div></td>
      <td bgcolor="#4f6c7f"><div align="center"><strong>Added By</strong></div></td>
      <td bgcolor="#4f6c7f"><div align="center"><strong>Remarks</strong></div></td>
     <td bgcolor="#4f6c7f"><div align="center"><strong>Status</strong></div></td>
  </tr>
  <?php							
		if(isset($admin_deposit_list)) { if($admin_deposit_list !='')   {
		$i=0;
		 foreach($admin_deposit_list as $all_list) 	
		 { 
		 if($all_list->User_Type =="admin")
		 {
		 $i++;
	?>	
                       
  <tr style="color:#000" align="center">
    <td bgcolor="#e6e7eb"><?php echo $i; ?></td>
    <td bgcolor="#e6e7eb"><?php echo $all_list->DateOfPay; ?></td>
    <td bgcolor="#e6e7eb"><?php echo $all_list->UserTime; ?></td>
    <td bgcolor="#e6e7eb"><?php echo  substr($all_list->Remark,0,20);  ?></td>
    <td bgcolor="#e6e7eb"><?php echo $all_list->Amount ; ?></td>
     <td bgcolor="#e6e7eb"><?php echo $all_list->Type_of_pay; ?></td>
     <td bgcolor="#e6e7eb"><?php echo $all_list->admin_name; ?></td>
      <td bgcolor="#e6e7eb"><?php echo $all_list->remarks; ?></td>
   
  
    <td bgcolor="#e6e7eb">Accepted</td>
  </tr>
  <?php } } } } ?>
</table>
                          </div>
</div>
                                  <!-- tab 2 end here -->
                                  
                                  
                                  <!-- tab 3 start here -->
                                  
                                    <div class="TabbedPanelsContent">
<div class="agent_commission-out">
	<div class="agent_commission-title-out_janu">
	 
      
  </div>
	<form action="<?php print WEB_URL_ADMIN ?>admin/markup_agents/<?php print $agent_id; ?>" method="post" id="flights" name="flights">
<input type="hidden" value="<?php echo $agent_id; ?>" name="agent_id" />
	<?php $i=1; if(isset($user_list)){if($user_list!=''){foreach ($user_list as $row1){
		//print_r($row1);exit;
		 ?>
	    <table bgcolor="#FFFFFF" border="0" cellspacing="1" cellpadding="0" align="center" width="100%" style="border:1px #CCCCCC solid;">
 <tr><td colspan="4" class="sidebartitle" align="center">Commissions & Markup</td></tr>
          <tr>
            <td align="center" bgcolor="#EEEEEE" colspan="4" class="bl_13b" height="45">SET MARKUP AND COMMISSION FOR &nbsp;Agent name : <font color="red"><?php echo $rows['agent_name']; ?></font>&nbsp; Agent id : <font color="red">&nbsp;<?php echo $rows['agent_id']; ?></font></td>
</tr> <tr>
    <td align="center" height="27" bgcolor="#EEEEEE" width="30%"><strong>Carrier</strong></td>
    <td  colspan="3" align="center" bgcolor="#EEEEEE" width="40%"><strong>Commission And Mark Up</strong></td>
  <!--  <td align="center" bgcolor="#EEEEEE"><strong>Mark Up</strong></td>-->
  </tr>
  <tr>
    <td height="10" colspan="3"></td>
  </tr>
  
  <tr>
    <td  align="center">Payment Gateway</td>
    <td  align="center">
        <input type="text" size="5" name="payment_gateway" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->payment_gateway; }} ?>" />            
    </td>
    <td align="center"><input type="radio" value="percentage" name="gateway_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->gateway_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="gateway_type"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->gateway_type == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
    </tr>
  
<tr>
    <td  align="center">Hotel</td>
    <td  align="center">
        <input type="text" size="5" name="hotel" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->hotel; }} ?>" />            
    </td>
    <td align="center"><input type="radio" value="percentage" name="hotel_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->hotel_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="hotel_type"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->hotel_type == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td>
     <tr>
   <td  align="center">Bus</td>
    <td  align="center">
        <input type="text" size="5" name="bus" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->bus; }} ?>"  />            
    </td>
     <td align="center"><input type="radio" value="percentage" name="bus_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->bus_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="bus_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->bus_type == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td> 
     <tr>
   <td  align="center">Car</td>
   
   <td  align="center">
        <input type="text" size="5" name="car" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->car; }} ?>"   />            
    </td>
     <td align="center"><input type="radio" value="percentage" name="car_type"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->car_type == 'percentage') { echo "checked"; } }} ?>/> Percentage <input type="radio" value="fixed" name="car_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->car_type == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td> 
   
     <tr>
   <td  align="center">Holidays</td>
   
   <td  align="center">
        <input type="text" size="5" name="holidays" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->holidays; }} ?>" />            
    </td>
    <td align="center"><input type="radio" value="percentage" name="holiday_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->holiday_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="holiday_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->holiday_type == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td> 
  </tr> 
  <tr>
    <td align="center" colspan="3" height="27" bgcolor="#EEEEEE" ><strong>Domestic Flights</strong> </td>
  </tr>
   
  <tr>
    <td align="center">Air India</td>
    <td align="center">
        <input type="text" size="5" name="airindia_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->airindia_dom; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="airindia_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->airindia_type == 'percentage') { echo "checked"; } }} ?>/> Percentage <input type="radio" value="fixed" name="airindia_type"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->airindia_type == 'fixed') { echo "checked"; } }} ?>/> Fixed</td>
  </tr>
    <!-- <tr>
    <td align="center">Indian</td>
    <td align="center">Rs.&nbsp;
        <input type="text" size="5" name="f_indian_c" value="<?php echo $rows['f_indian_c']; ?>" /></td>
 <td align="center">Rs.&nbsp;
        <input type="text" size="5" name="f_indian_m" value="<?php //echo $rows['f_indian_m']; ?>" /></td
  </tr>-->   
  <tr>
    <td align="center">Jet Airways</td>
    <td align="center">
        <input type="text" size="5" name="jet_airways_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->jet_airways_dom; }} ?>" /></td>
     <td align="center"><input type="radio" value="percentage" name="jeta_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jeta_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="jeta_type"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jeta_type == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
  </tr>  
  <tr>
    <td align="center">JetLite</td>
    <td align="center">
        <input type="text" size="5" name="jetlite_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->jetlite_dom; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="jetlite_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jetlite_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="jetlite_type"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jetlite_type == 'fixed') { echo "checked"; } }} ?>/> Fixed</td>
  </tr>  
   <tr>
    <td align="center">Kingfisher</td>
    <td align="center">
        <input type="text" size="5" name="kingfisher_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->kingfisher_dom; }} ?>" /></td>
     <td align="center"><input type="radio" value="percentage" name="kingfisher_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->kingfisher_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="kingfisher_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->kingfisher_type == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Air India Exp.</td>
    <td align="center">
        <input type="text" size="5" name="airindia_express" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->airindia_express; }} ?>" /></td>
     <td align="center"><input type="radio" value="percentage" name="aiindiaex_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->aiindiaex_type == 'percentage') { echo "checked"; } }} ?>  /> Percentage <input type="radio" value="fixed" name="aiindiaex_type"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->aiindiaex_type == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Go Air</td>
    <td align="center">
        <input type="text" size="5" name="goair_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->goair_dom; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="goair_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->goair_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="goair_type"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->goair_type == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td>
  </tr>  
   <tr>
    <td align="center">Indigo</td>
    <td align="center">
        <input type="text" size="5" name="indigo_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->indigo_dom; }} ?>" /></td>
     <td align="center"><input type="radio" value="percentage" name="indigo_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->indigo_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="indigo_type"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->indigo_type == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
  </tr>
   <!--<tr>
    <td align="center">MDLR</td>
    <td align="center">Rs.&nbsp;
        <input type="text" size="5" name="f_mdlr_c" value="<?php echo $rows['f_mdlr_c']; ?>" /></td>
    <td align="center">Rs.&nbsp;
        <input type="text" size="5" name="f_mdlr_m" value="<?php //echo $rows['f_mdlr_m']; ?>" /></td>
  </tr>
   <tr>
    <td align="center">Paramount</td>
    <td align="center">Rs.&nbsp;
        <input type="text" size="5" name="f_paramount_c" value="<?php echo $rows['f_paramount_c']; ?>" /></td>
    <td align="center">Rs.&nbsp;
        <input type="text" size="5" name="f_paramount_m" value="<?php //echo $rows['f_paramount_m']; ?>" /></td>
  </tr>-->
   <tr>
    <td align="center">Spice Jet</td>
    <td align="center">
        <input type="text" size="5" name="spicejet_dom" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->spicejet_dom; }} ?>" /></td>
     <td align="center"><input type="radio" value="percentage" name="spicejet_type"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->spicejet_type == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="spicejet_type" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->spicejet_type == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td>
  </tr>
   <tr>
    <td align="center">For All Other Flights</td>
    <td align="center">
        <input type="text" size="5" name="all_dom_airline" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->all_dom_airline; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="other_airline" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->other_airline == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="other_airline" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->other_airline == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td>
  </tr>
   <tr>
    <td height="10" colspan="3"></td>
  </tr>
  
  
  <!-- ==============================START=======- International Flights Markup Fields ==============================================-->
 <tr>
    <td align="center" colspan="3" height="27" bgcolor="#EEEEEE" ><strong>International Flights</strong> </td>
  </tr>
  
  <tr>
    <td align="center">Air India</td>
    <td align="center">
        <input type="text" size="5" name="airindia_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->airindia_inter; }} ?>" /></td>
     <td align="center"><input type="radio" value="percentage" name="airindia_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->airindia_typeinter == 'percentage') { echo "checked"; } }} ?>/> Percentage <input type="radio" value="fixed" name="airindia_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->airindia_typeinter == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
  </tr>
 <tr>
    <td align="center">Jet Airways</td>
    <td align="center">
        <input type="text" size="5" name="jetairways_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->jetairways_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="jetairways_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jetairways_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="jetairways_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jetairways_typeinter == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td>
  </tr>
   <tr>
    <td align="center">JetLite</td>
    <td align="center">
        <input type="text" size="5" name="jetlite_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->jetlite_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="jetlite_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jetlite_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="jetlite_typeinter"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->jetlite_typeinter == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Kingfisher</td>
    <td align="center">
        <input type="text" size="5" name="kingfisher_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->kingfisher_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="kingfisher_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->kingfisher_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="kingfisher_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->kingfisher_typeinter == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Air India Express</td>
    <td align="center">
        <input type="text" size="5" name="airindiaexp_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->airindiaexp_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="airindiaex_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->airindiaex_typeinter == 'percentage') { echo "checked"; } }} ?>/> Percentage <input type="radio" value="fixed" name="airindiaex_typeinter"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->airindiaex_typeinter == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
  </tr> <tr>
    <td align="center">Go Air</td>
    <td align="center">
        <input type="text" size="5" name="goair_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->goair_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="goair_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->goair_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="goair_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->goair_typeinter == 'fixed') { echo "checked"; } }} ?>  /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Indigo</td>
    <td align="center">
        <input type="text" size="5" name="indigo_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->indigo_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="indigo_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->indigo_typeinter == 'percentage') { echo "checked"; } }} ?>/> Percentage <input type="radio" value="fixed" name="indigo_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->indigo_typeinter == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td>
  </tr>
   <tr>
    <td align="center">MDLR</td>
    <td align="center">
        <input type="text" size="5" name="mdlr_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->indigo_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="mdlr_typeinter" /> Percentage <input type="radio" value="fixed" name="mdlr_typeinter"   /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Paramount</td>
    <td align="center">
        <input type="text" size="5" name="paramount_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->paramount_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="paramount_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->paramount_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="paramount_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->paramount_typeinter == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td>
  </tr>
   <tr>
    <td align="center">Spice Jet</td>
    <td align="center">
        <input type="text" size="5" name="spicejet_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->spicejet_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="spicejet_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->spicejet_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="spicejet_typeinter"   <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->spicejet_typeinter == 'fixed') { echo "checked"; } }} ?> /> Fixed</td>
  </tr>
   <tr>
    <td align="center">For All Other Flights</td>
    <td align="center">
        <input type="text" size="5" name="other_inter" value="<?php if(isset($agent_markup)) { if($agent_markup != '') { echo $agent_markup->other_inter; }} ?>" /></td>
    <td align="center"><input type="radio" value="percentage" name="other_typeinter" <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->other_typeinter == 'percentage') { echo "checked"; } }} ?> /> Percentage <input type="radio" value="fixed" name="other_typeinter"  <?php if(isset($agent_markup)) { if($agent_markup != '') { if($agent_markup->other_typeinter == 'fixed') { echo "checked"; } }} ?>   /> Fixed</td>
  </tr>
  <tr>
    <td height="10" colspan="3"></td>
  </tr>
  <tr>
    <td align="center" colspan="3"><input type="submit" name="updateMark" value="Update" /></td>
  </tr>
  <tr>
    <td height="15" colspan="3"></td>
  </tr>
</table>
      <?php $i++; }
	  }} ?>
	</form>
</div>

                                  </div>
                                  <!-- tab 3 end here -->
                                  
                                  <!-- tab 4 start here -->
                                  
                                    <div class="TabbedPanelsContent">
                                  	
                                  </div>
                                  <!-- tab 4 end here -->
                                   
           
                                </div>
                              </div>
            </div>
</div>    
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>