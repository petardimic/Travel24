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

   <script type="text/javascript">
  function abc()
  {
  //	alert('anand');
  $('#add_comm').show();
  $('#view_comm').hide();
  }
  function xyz()
  {
  //	alert('anand');
  $('#add_comm').hide();
  $('#view_comm').show();
  }
  </script>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px;" >

<div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/view_subadmis" >View Admin</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup">Commission</a></li>
			<li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd">Change Password</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/currency_details" >Currency</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings" >Website Settings</a></li>
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol">Ip Control</a></li>  
             <li style="border:none;"><a href="<?php  print WEB_URL_ADMIN?>admin/payment" class="active">Payment Gateway</a></li>            
		</ul>
	</div>

 <div class="right-wrapper" style="margin-top:20px;">
 
 
<div id="view_comm" style="width:678px; height:auto; overflow:hidden; border:solid 0px #ccc; margin-left:20px;">
  <table style="width:600px; padding:15px;" cellpadding="0" cellspacing="0">
  <tr style="background-color:#000; border:solid 0px #ccc; color:#fff; font-size:14px; text-align:center;">
    <td colspan="3">
    <div style="text-align:left; width:100%; height:16px; padding:8px;">Payment Processing</div>
    </td>
    </tr>
    <tr>
    <td colspan="3" style="width:100%; height:auto; border:1px solid #ccc;">
    <form action="<?php echo WEB_URL_ADMIN?>admin/payment_details" method="post" >
  		<table border="0" cellpadding="4" cellspacing="4" width="100%" style="margin:0px 10px 10px 50px;">
        	<tr>
            	<td>Payment Processing System</td>
                <td><select name="payment" style="width:200px;">
                <option value="Paydollar">Paydollar</option>
                </select></td>
            </tr>
            <?php /*?><tr>
            	<td>Currency</td>
                <td><select name="currency" style="width:200px;">
                <?php if(isset($currency_types)){if($currency_types != ''){
					foreach($currency_types as $row){?>
                <option value="<?php echo $row->currency_id?>" <?php  if(isset($payment)){if($payment != ''){if($payment->currency == $row->currency_id){?> selected="selected"<?php }}}?>><?php echo $row->currency?></option>
                <?php }}}?>
                </select></td>
            </tr><?php */?>
            <tr>
            	<td></td>
            	<td colspan="2"><input width="72" type="image" height="22" src="<?php echo WEB_DIR_ADMIN?>images/submit_btn.png"></td>
                
            </tr>
        </table>
    </form>
    </td>
  </tr>
 
   </table>
  </div>
  
    

  </div>
</div>
</body>
</html>
