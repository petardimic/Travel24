<?php //echo "<pre>"; print_r($this->session->userdata); exit;?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Loading Payment Gateway...</title>
        <style type="text/css">
            <!--
            body {
                margin-left: 0px;
                margin-top: 0px;
                margin-right: 0px;
                margin-bottom: 0px;
				background-image:url(<?php print WEB_DIR ?>images/hotelmainb1g.jpg);
                background-repeat:repeat; 
                background-position:center top;
				 background-attachment:fixed;
				background-size:cover;
				visibility: visible;
            }
            .tableborder{
                /*border:#999 solid 1px;*/
                margin-top:120px;
            }
            .underline{
                background-image:url(<?php print WEB_DIR ?>load/underline.jpg);
                background-repeat:repeat-x;
                height:20px;
                background-position:top;
                -webkit-border-radius: 5px;
            }
            .text{
                font-family:Arial, Helvetica, sans-serif;
                font-size:13px;
                color:#0066CC;
                font-weight:bold;
            }
            .text1{
                font-family:Arial, Helvetica, sans-serif;
                font-size:13px;
                color:#0066CC;
            }
            .textBlack{
                font-family:Arial, Helvetica, sans-serif;
                font-size:12px;
                color:#000000;
            }
            -->
        </style>

        <script type="text/javascript">
            function call()
            {
				//alert("hi");
               document.frmname.submit();
                //showProgress();
            }
            function showProgress() 
            {
                var pb = document.getElementById("loader");
                pb.innerHTML = '<img src="<?php print WEB_DIR ?>images/hotelloding.gif" align="center" />';
                pb.style.display = '';
            }
			
            var ray={
                ajax:function(st)
                {
                    this.show('load');
                },
                show:function(el)
                {
                    this.getID(el).style.display='';
                },
                getID:function(el)
                {
                    document.getElementById("main_container").style.opacity=0.1;
                    return document.getElementById(el);
                }
            }
        </script>
        <style type="text/css">
            #load{
                position:absolute;
                z-index:1;
                border:3px double #999;
                background:#f7f7f7;
                width:300px;
                height:300px;
                margin-top:-150px;
                margin-left:-150px;
                top:55%;
                left:50%;
                text-align:center;
                line-height:300px;
                font-size:18pt;
            }
            .style1 {color: #000000}
        </style>
    </head>
    
        <div align="center"  style=" height:650px; width:1040px; margin:auto;">
            <body onload="call()" >
                <?php //echo floor($amount); ?>
                
            <form name="frmname" action="<?php print WEB_URL; ?>home/vpc_php_serverhost_do" method="post">
             <input type="hidden" name="Title" value="PHP VPC 3-Party">
  <input type="hidden" name="virtualPaymentClientURL" size="63" value="https://migs.mastercard.com.au/vpcpay" maxlength="250">
  <input type="hidden" name="vpc_Version" value="1" size="20" maxlength="8">
  <input type="hidden" name="vpc_Command" value="pay" size="20" maxlength="16">
  <input type="hidden" name="vpc_AccessCode" value="7C78B94E" size="20" maxlength="8">
  <input type="hidden" name="vpc_MerchTxnRef" value="000001" size="20" maxlength="40">
  <input type="hidden" name="vpc_Merchant" value="E09105900" size="20" maxlength="16">
  <input type="hidden" name="vpc_OrderInfo" value="" size="20" maxlength="34">
      <input type="hidden" name="vpc_Amount" value="<?php echo round($amount); ?>" size="20" maxlength="10">
  <input type="hidden" name="vpc_Locale" value="en" size="20" maxlength="5">
  <input type="hidden" name="vpc_ReturnURL" size="63" value="<?php print WEB_URL ?>home/booking_after_payment" maxlength="250">
  <input type="hidden" name="vpc_TicketNo" maxlength="15">
</form>
           
                <div id="load" style="display:none;"> </div>
                <div id="page">
                    <div id="wrapper">
                        <div id="header">
                          <table width="690">

                          <tr>
                                <td align="right" >
                                   </td>
                            </tr>
                        </table>
                       
                                    <div style="width:800px; position:absolute; margin-top:25px; margin-left:245px;"></div>
                                    <table width="650" border="0" align="center" cellpadding="0" cellspacing="0"  class="tableborder" style="border:3px #ec923c solid; margin-top:85px; background-color:#F5F5F5; border-radius:20px; box-shadow: 5px 5px 8px #4a4a4a; background-image:url(../images/slicebg.jpg); background-position:bottom center; background-repeat:repeat-x;">

                                        <tr>
                                            <td height="20" colspan="2" align="center" valign="baseline" class="underline">&nbsp;</td>
                                        </tr>
                                        <tr>
                                          <td height="30" colspan="2" align="center" valign="baseline" class="text1 style1" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; line-height:18px;"><div class="logo" style="width:800px;"><img src="<?php print WEB_DIR_ADMIN ?>images/logo_new.png" border="0" alt="" style="margin-top:20px; margin-left:50px;" /> </div></td>
                                        </tr>
                                        <tr>
                                          <td height="30" colspan="2" align="center" valign="baseline" class="text1 style1" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; line-height:18px;">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="30" colspan="2" align="center" valign="baseline" class="text1 style1" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; line-height:18px;">Travellingmart Loading the <span style="color:#ec923c;font-weight:bolder;">" Payment Gateway "</span> for you!!</td>
                                        </tr>
                                        <tr>
                                            <td height="80" colspan="2" align="center" valign="middle" id="loader"><img align="center" src="<?php print WEB_DIR ?>images/hotelloding.gif"  /></td>
                                        </tr>
                                        
                                        <tr>
                                            <td height="20" colspan="2" align="center" valign="baseline">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td height="20" colspan="2" align="center" valign="baseline" class="text1 style1" style="font-family:Verdana, Geneva, sans-serif; font-size:13px; color:#000; line-height:18px;">Please do not refresh the screen or press backspace key.</td>
                                        </tr>
                                        <tr>
                                            <td height="20" align="center" valign="baseline">&nbsp;</td>
                                            <td align="center" valign="baseline">&nbsp;</td>
                                        </tr>
                                       
                                        <tr>
                                            <td height="20" align="center" valign="baseline">&nbsp;</td>
                                            <td align="center" valign="baseline">&nbsp;</td>
                                        </tr>
                          </table>

                                    </div>


                                    </div></div>
                                    </body>
                                    </div>
                                    </html>
