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
<?php /*?><script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script><?php */?>
<link href="<?Php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
function check_login(email)
{
/*	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(user) == true)
	{*/
		$.post("<?php echo WEB_URL?>supplier/confirm_sup",{'user':email},function(data){
		if(data == 1)
		{
			document.getElementById('user_error1').innerHTML='';
		}
		else
		{
			document.getElementById('user_error1').innerHTML="<font color=red>Email address doesn't exist</font>";
			document.getElementById("user").value = '';
			document.getElementById("user").focus();
		}
		});
	//}
}
function validate()
{	
	var email = $('#user').val();
	var regMail = /^([_a-zA-Z0-9-]+)(\.[_a-zA-Z0-9-]+)*@([a-zA-Z0-9-]+\.)+([a-zA-Z]{2,3})$/;
	if(regMail.test(email) == false)
	{
		document.getElementById("user_error1").innerHTML = "<font color=red>Please enter a valid email address</font>";
		document.getElementById("user").value = '';
		document.getElementById("user").focus();
		return false;
	}
	var pwd = $('#pass').val();
	if(pwd == '')
	{
		document.getElementById("pass_error").innerHTML = "<font color=red>Please enter password</font>";
		document.getElementById("pass").focus();
		return false;
	}
	//return true;
}
</script>
</head>
<body style="background:#232222 !important;">


    <!-- Top navigation bar -->
    <div id="topNav">
        <div class="fixed">
            <div class="wrapper">
               
          
            <div><a href="<?php print WEB_URL ?>home/index"><img src="<?Php echo WEB_DIR?>supplier_includes/images/logo_new.png" width="200" height="69" border="0" style="margin:4px;" /></a>
      
                
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
    <div class="wrapper" style="width:780px; margin:0 auto;" >
        
          	<div class="login-bg">
            	<div class="login-inner"><form id="loginfrm" name="loginfrm" action="<?php echo WEB_URL?>supplier/supplier_login" method="post" onsubmit="return validate();">
                <div class="login-inner-heading">Existing<span style="color:#F69F3A;"> Partner</span></div>
                <div class="login-inner-username">Username<span name="user_error" id="user_error"></span><span name="user_error1" id="user_error1" style="margin-left:25px;"></div>
                <div class="login-inner-input-box"><input name="user" id="user" type="text" style="width:260px ; height:24px; background-color:transparent; border:none; margin-bottom:10px; margin-top:4px;" onblur="return check_login(this.value);" /></div></span>
                 <div  class="login-inner-username" style="margin:8px 0 0 0 ;">Password  <span style="padding-left:25px;"><?php if(isset($error)){if($error != ''){ echo $error;}}?></span><span name="pass_error" id="pass_error"></span></div>
                 <div class="login-inner-input-box"> <input name="pass" id="pass" type="password" style="width:260px ; height:24px; background-color:transparent; border:none; margin-top:2px;"/></div>  
                 <div class="login-inner-forgot"><a href="<?php echo WEB_URL?>supplier/forgot_password">Forgot your password</a>
                  <input name="" type="submit" value=""  class="login-inner-submit"  /></div>
                </form>
                </div>
            </div><!-- login-bg-->
            <div class="login-bg-right">
            	<div class="login-inner"><form id="regfrm" name="regfrm" action="<?php echo WEB_URL; ?>supplier/supplier_reg" method="post" onsubmit="javascript:document.regfrm.submit();">
                <div class="login-inner-heading">New <span style="color:#F69F3A;"> Partner</span></div>
               <div style="padding:20px 20px 20px 32px; font-size:14px; letter-spacing:0px;">Welcome to Travelingmart.com<span class="click-here"><br />
               <a href="#" >
Click here</a></span> to find out why you should join the Travelingmart network</div>
<input name="" type="submit" value="" class="login-inner-sign-up"  style="margin-left:32px;" />
               
                </form>
                </div>
            </div><!-- login-bg-->
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
                <!-- Footer -->
</body></html>