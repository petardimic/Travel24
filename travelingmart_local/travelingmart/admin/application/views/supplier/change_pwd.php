<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Chnage Password</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
function check_pwd(cur_pwd)
{
	$.post("<?php echo WEB_URL?>supplier/confirm_pwd",{'cur_pwd':cur_pwd},function(data){
	if(data == 1)
	{
		document.getElementById('err_cur_pwd').innerHTML='';
	}
	else
	{
		document.getElementById('err_cur_pwd').innerHTML="<font color=red>Password doesnot Match.</font>";
	//	document.getElementById("cur_pwd").value = '';
		document.getElementById("cur_pwd").focus();
		
	}
	});
}
</script>
</head>
<body>


    <!-- Top navigation bar -->
    <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

    <div id="sidebar-position">
    <?php  $this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
	<form method="post" action="<?php echo WEB_URL?>supplier/change_password" id="change_pwd" name="change_pwd">
    <div class="wrapper">
        <!-- Content -->
        <div class="content">
            <!-- Dynamic table -->
            <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Forgot Password</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Current Password:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="cur_pwd" id="cur_pwd" class="getfields" style="width:350px;" type="password" value="" onblur="return check_pwd(this.value);">
						<br/><span id="err_cur_pwd"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >New Password: </span>
                </td>
               <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="new_pwd" id="new_pwd" class="getfields" style="width:350px;" type="password" value="">
					<br/><span id="err_new_pwd"></span>
                </td>
            </tr>
			 <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Retype New Password:</span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
					<input name="renew_pwd" id="renew_pwd" class="getfields" style="width:350px;" type="password" value="">
					<br/><span id="err_renew_pwd"></span>	
                </td>
            </tr>
           
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="" type="submit" value=""  class="login-inner-save" />
     </td>
            </tr>
        </tbody>
    </table>
    
            

                
                
                
   
    
    </div> </div>
    <div class="fix">
    </div>
    </div>
	</form>
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