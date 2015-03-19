<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Payment Processing</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<script type="text/javascript">
$(document).ready(function() 
		{
		$('#location').watermark("Enter Detailed Location");
		$("#interest").watermark("Enter Nearest Interests");
		$("#transport").watermark("Enter Nearest Transport");
		$("#airport").watermark("Enter Nearest Airport");		
});
	
</script>

<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>
<div class="wrapper">

    <!-- Top navigation bar -->
     <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

   
              
 
 <div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">Payment Processing<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
    <form name="detailed_location" id="detailed_location" action="<?php echo WEB_URL_ADMIN?>supplier/insert_pay_process" method="post">
	<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
       
  <tr>
    <td width="52%"  style="border-bottom:1px solid #dcdcdc;"><span id="ctl00_OptionalLinks_UpdatePanel_xlblLocationDesc">Payment Processing</span></td>
    <td width="52%"  style="border-bottom:1px solid #dcdcdc;"></td>
  </tr>
  <tr>
    <td  style="border-bottom:1px solid #dcdcdc;"><label for="textarea"></label>
   		 <input type="radio" name="pay_process" value="1" <?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value == 1){?> checked="checked" <?php }}}?>/> &nbsp;&nbsp; No Credit details required
      
	  </td>
	    <td  style="border-bottom:1px solid #dcdcdc;"><label for="textarea"></label>
   		 <input type="radio" name="pay_process" value="2" <?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value == 2){?> checked="checked" <?php }}}?>/> &nbsp;&nbsp; Luhn Algorithm
     </td>
   </tr>
   <tr>
    <td  style="border-bottom:1px solid #dcdcdc;"><label for="textarea"></label>
   		 <input type="radio" name="pay_process" value="3" <?php if(isset($pos)){if($pos != ''){if($pos->payment_process_value == 3){?> checked="checked" <?php }}}?>/>&nbsp;&nbsp; Payment Gateway
    </td>
	<td  style="border-bottom:1px solid #dcdcdc;"><label for="textarea"></label></td>
   
  </tr>
  <tr>

                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="" type="submit" value=""  class="login-inner-save" />
     </td>
          </tr>
  
  
  
   
                 
        </tbody>
    </table>
    </form>
	
	
    </div> </div>
    <div class="fix">
    </div>
    </div></div>
   <!-- <div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--><!--</span>
        </div>
    </div>-->
                <!-- Footer -->
</body></html>