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
			<li><a href="<?php  print WEB_URL_ADMIN?>admin/ipcontrol" class="active">Ip Control</a></li>  
             <li style="border:none;"><a href="<?php  print WEB_URL_ADMIN?>admin/payment">Payment Gateway</a></li>            
		</ul>
	</div>

 <div class="right-wrapper" style="margin-top:20px;">
  <span style="color:#000; background:#EFA146; width:150px; margin-left:20px; border-right:1px solid #000; float:left; text-align:center; cursor:pointer;" onclick="return xyz();">View Ip</span>&nbsp;<span style="color:#000; background:#EFA146; width:150px; margin-right:100px; float:right; text-align:center; cursor:pointer;" onclick="return abc();">Add Ip</span> 
 
<div id="view_comm" style="width:678px; height:auto; overflow:hidden; border:solid 1px #ccc; margin-left:20px;">
  <table style="width:600px; padding:15px;">
  <tr style="background-color:#333; border:solid 1px #ccc; color:#fff; font-size:14px; text-align:center;">
    <td>ip Address</td>
    <td>status</td>
    <td>Action</td>
  </tr>
  <?php $i=1; if(isset($commission_list)){ if($commission_list != '') { foreach ($commission_list as $row){ ?>
 	<input name="comm_id" value="<?php print $row->ipcontrol_id; ?>" class="user_fld_box-fld-2" type="hidden" />

  
  <td style="border:solid 1px #ccc;"><?php print $row->ip_address; ?>&nbsp;</td>
  <td style="border:solid 1px #ccc;"><?php if($row->status=='Active'){?>
  
  <a href="<?php echo WEB_URL_ADMIN?>admin/edit_ip_status/<?php echo $row->status?>/<?php echo $row->ipcontrol_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/activate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>admin/edit_ip_status/<?php echo $row->status?>/<?php echo $row->ipcontrol_id?>"><img src="<?php echo WEB_DIR_ADMIN?>images/deactivate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></td>
  <td style="border:solid 1px #ccc;"><a href="<?php echo WEB_URL_ADMIN?>admin/delete_ip/<?php echo $row->ipcontrol_id?>" onclick="return confirm('Are you sure want to delete this user?')"><input type="image" src="<?php print WEB_DIR_ADMIN?>images/delete1.png" /></a>
</td>
  </tr>
 
</form>
  <?php $i++; }}} ?>
   </table>
  </div>
  
   <form name="add_subadmin" id="add_comm" style="display:none;" action="<?php echo WEB_URL_ADMIN?>admin/insert_ip" method="post">
	<div style="border:1px #ccc solid; padding:10px; margin-left:20px; width:659px;"><table width="500" border="0" align="left" cellpadding="0" cellspacing="0" style="border:1px solid #ccc; margin-left:10px; border-radius:8px 8px 0px 0px; border:1px #ccc solid;  background:#fff;">
    
    <tr><td colspan="2" style="background:#000; color:#fff; font-size:20px; text-align:center;height:30px; border-radius:6px 6px 0px 0px;">Add Ip Address</td></tr>
    <tr><td height="20"></td></tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Add Ipaddress<span style="color: #C00">*</span></td>
    <td width="400" style="padding:5px 0 15px 10px;">
     
	   <input name="ipadds" id="ipadds" type="text" class="supplier_text291" style="width:200px;"/>
</td>
  </tr>
     <tr><td height="20"></td></tr>
  <tr>
    <td width="129" align="right" style="font-weight:normal; color:#000032; padding:5px 0 15px 10px;">Desctiption</td>
    <td width="400" style="padding:5px 0 15px 10px;">
     <textarea name="desc" id="desc" class="supplier_text291" style="width:200px;"></textarea>
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
 <div style="clear:both;"  ></div>  
 </div>
  </form> 

  </div>
</div>
</body>
</html>
