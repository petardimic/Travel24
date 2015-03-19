<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Travelingmart</title>
	
</head>

<body>
<?php $this->load->view('header'); ?>
<script type="text/javascript">
function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp=false;	
		try{
			xmlhttp=new XMLHttpRequest();
		}
		catch(e)	{		
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
	
	
function check(str) {
//alert(str);
		 var alt_email = $('#email').val(); 
		$("#login").val(alt_email);
		if(str!='')
		{
		  var strURL="<?php print WEB_URL_ADMIN?>/admin/subadmin_check/"+str;
		 //alert(strURL);
				var req = getXMLHTTP();
				
				if (req) {
					
					req.onreadystatechange = function() {
						if (req.readyState == 4) {
							// only if "OK"
							if (req.status == 200) {						
								var s=req.responseText;	
								if(s !='')
								{
								alert(s);
								document.getElementById('email').value='';
								document.getElementById('email').focus();
								}					
							} else {
								alert("There was a problem while using XMLHTTP:\n" + req.statusText);
							}
						}				
					}			
					req.open("GET", strURL, true);
					req.send(null);
				}
		  
		}
		else
		{
			if(user_type == '')
			{
				alert('please select user type');
			}
			document.getElementById('user_type').focus();
			return false;
		}
	}
</script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px;" >
<table width="920" align="left" border="0" cellpadding="4" cellspacing="4" style="border:0px #000 solid; color:#202f23; font-family:calibri; margin-left:25px;  padding-top:65px;">

<tr>
<div class="menu">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>
			<li><a href="#">Add subadmin</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis">View subadmin</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">change password</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details">Currency</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings">Website Settings</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">IpControl</a></li>          
		</ul>
	</div>
</tr>
</table>
   <form name="add_subadmin" id="add_subadmin" action="<?php echo WEB_URL_ADMIN?>admin/insert_subadmin" method="post">
	<table width="500" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #ccc; border-radius:8px 8px 0px 0px; margin-left:250px; margin-top:50px; background:#fff;">
    
    <tr><td colspan="2" style="background:#333; color:#fff; font-size:20px; text-align:center;height:30px; border-radius:6px 6px 0px 0px;">Add Subadmin</td></tr>
    <tr><td height="20"></td></tr>
  <tr>
    <td width="129" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">First Name<span style="color: #C00">*</span> </td>
    <td width="400" style="padding:5px 0 15px 10px;">
      <input name="userf_name" id="userf_name" type="text"  class="supplier_text291"  style="width:200px;"/>
	  
</td>
  </tr>
  <tr>
    <td width="129" align="right"  style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Last Name<span style="color: #C00">*</span></td>
    <td width="400" style="padding:5px 0 15px 10px;">
	<input type="text" name="userl_name" id="userl_name" class="txtu" style="width:200px;"/>
		
     
</td>
  </tr>
 

 <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Email<span style="color: #C00">*</span></td>
    <td width="400" style="padding:5px 0 15px 10px;">
	<input name="email" id="email" type="text"  class="supplier_text291"  style="width:200px;" onblur="return check(this.value);">
     
</td>
  </tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Login id<span style="color: #C00">*</span></td>
    <td width="400" style="padding:5px 0 15px 10px;">
	<input name="login " id="login" type="text"  class="supplier_text291" readonly="readonly"  style="width:200px;">
     
</td>
  </tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Password<span style="color: #C00">*</span></td>
    <td width="400" style="padding:5px 0 15px 10px;">
     
	   <input name="passd" id="passd" type="password" class="supplier_text291" style="width:200px;"/>
</td>
  </tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Confirm Password<span style="color: #C00">*</span></td>
    <td width="400" style="padding:5px 0 15px 10px;">
     
	   <input name="con_passd" id="con_passd" type="password" class="supplier_text291" style="width:200px;"/>
</td>
  </tr>
  <tr>
    <td align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">&nbsp;</td>
    <td style="padding:5px 0 15px 10px;">
                  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="22">			  

	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="22" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
  
	</td>
  </tr>
 
 </table>  
  </form>
</div>
</body>
</html>
