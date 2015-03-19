<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<style>
#error_user
{
color:#33CC99;
}
</style>
<title> Travelingmart</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<link href="<?Php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php print WEB_DIR?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    
	 $('#user').watermark('Enter your email address');
		 
});
function check_email(email)
{
	
	if(email)
	{
		$.post('<?php echo WEB_URL?>supplier/confirm_sup',{'user':email},function(data){
		if(data == 1)
		{
			document.getElementById('user_error').innerHTML='';
		}
		else
		{
			document.getElementById('user_error').innerHTML="";
			document.getElementById('user_error1').innerHTML="<font color=red>Email address doesn't exist</font>";
			document.getElementById("user").value = '';
			document.getElementById("user").focus();
			
		}
		});
	}
}
</script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->

</head>
<body style="background:#232222 !important;">


    <!-- Top navigation bar -->
    <div id="topNav">
        <div class="fixed">
            <div class="wrapper">
               
          
            <div><a href="#"><img src="<?Php echo WEB_DIR?>supplier_includes/images/logo_new.png" width="200" height="69" border="0" style="margin:4px;" /></a>
      
                
            </div>   </div>
      </div>
    </div>
    <div class="fix">
    </div>
    <div style="display: none" align="right">
        <div id="ctl00_topmenus" class="topmenus">
            <a href="#" style="display: none;" class="activetebss">General Detail</a>
            
        </div>
    </div>
    <!-- Header -->
    
    <!-- Content wrapper -->
    <div class="wrapper" style="width:380px; margin:0 auto;" >
        
          	<div class="login-bg-forgot">
            	<div class="login-inner"><form id="forgot_password" name="forgot_password" action="<?php echo WEB_URL?>supplier/get_pwd" method="post" >
                <div class="login-inner-headingpass" style="margin-top:20px;"  >Forgot<span style="color:#F69F3A;"> Password</span></div>
                <div style="padding:5px 10px 0px 10px; text-align:justify; width:293px;">If you forget your password or your account has been locked , enter your email address in the box below. Your password will be sent to your registered email address.</div>
                
                <div class="login-inner-input-boxpass">
                <input name="user" id="user" type="text" style="width:260px ; height:24px; background-color:transparent; border:none; margin-bottom:10px; margin-top:9px;" onblur="return check_email(this.value)" />
                <br/>  <span name="user_error" id="user_error"></span><span name="user_error1" id="user_error1"></span></div>
 				<input name="" type="submit" value=""  class="login-inner-passs"  />
                </form>
                </div>
            </div><!-- login-bg-->
            <!-- login-bg-->
    <div class="fix">
    </div>
    </div>
    <div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--></span>
        </div>
    </div>
    <p>&nbsp;</p>
                <!-- Footer -->
</body></html>