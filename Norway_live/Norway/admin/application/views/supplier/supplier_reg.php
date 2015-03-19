<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart </title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?Php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
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
	
	
function insert(str) {
//alert(str);
		 var alt_email = $('#email').val(); 
		$("#agent_login12").val(alt_email);
		var user_type = $('#user_type').val();
		if(str!=''){
		  var strURL="<?php print WEB_URL?>/supplier/confirm_agent/"+str;
		 // alert(strURL);
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
				return false;
			}
	
	}
</script>
</head>
<body style="background:#232222 !important;">


    <!-- Top navigation bar -->
    <div id="topNav">
        <div class="fixed">
            <div class="wrapper">
               
          
            <div><a href="<?php print WEB_URL?>home/index"><img src="<?Php echo WEB_DIR?>supplier_includes/images/logo_new.png" width="200" height="69" border="0" style="margin:4px;" /></a>
      
                
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
    <div class="wrapper" style="width:780px; margin:20px auto; color:#fff; background-color:#f7f7f7; " >
        
         <form method="post" id="supplier_reg_form" action="<?php print WEB_URL?>/supplier/add_supplier">
           
           <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                 <div><h1>New Partner Sign-Up </h1></div>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                <div class="fix">&nbsp;<div align="right"><span onclick="javascript:back(-1);" style="cursor:pointer;">back</span></div></div>
                    
                    <span id="ctl00_OptionalLinks_UpdatePanel_xlblAccommodationName" style="font-weight:bold;"></span>
                </td>
            </tr>
            <tr>
            <td colspan="2" style="border-bottom:1px solid #dcdcdc; color:#000; font-size:12px;">It couldn't be easier to sign-up with Travelingmart; simply complete our registration form and you could be making bookings in no time at all.</td>
            </tr>
            <tr>
            <td>
                    <span  class="inner-heading">General Information </span></td>
                    <td></td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Country</span>
                    
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <select name="country" id="country" class="subgetselectfields" style="width:360px;">
	<option value="">--select country--</option>
		<?php foreach($country as $cont){?>
		<option value="<?php echo $cont->country_id;?>"><?php echo $cont->name;?></option>
		<?php }?>
		</select><br/><span id="err_country"></span></td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span>City</span>
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                        <input name="city" id="city" class="getfields" style="width:350px;" type="text">
                        <br/><span id="err_city"></span>
                </td>
            </tr>
            
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move"> Company / Group / Brand Name: </span>
               </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                 <input name="appt_name" id="appt_name" class="getfields" style="width:350px;" type="text">
                 <br/><span id="err_appt_name"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move"> Name of 1st property: </span>
               </td>
                <td style="border-bottom:1px solid #dcdcdc;">
            <input name="prop_name" id="prop_name" class="getfields" style="width:350px;" type="text">
            <br/><span id="err_prop_name"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span > Language</span>
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="language" id="language" class="getselectfields" style="width:360px;">
	<option value="">--select language--</option>
		<?php foreach($language as $cont){?>
		<option value="<?php echo $cont->language_id;?>"><?php echo $cont->language;?></option>
		<?php }?>
		</select>
         <br/><span id="err_language"></span></td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">&nbsp;</td>
              
                <td style="border-bottom:1px solid #dcdcdc;">&nbsp;</td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span  class="inner-heading">Main Contact Information </span>
                    
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <span  style="font-weight:bold;"></span>
                </td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >First Name</span>
                     
                                        
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="fname" id="fname" class="getfields" style="width:350px;" type="text">
                     <br/><span id="err_fname"></span>
                </td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    <span  class="lables-move">Last Name</span>
                    
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                    <input type="text" name="lname" id="lname" class="getfields" style="width:360px;">
                    <br/><span id="err_lname"></span>
				 </td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc;">
                    
                    
                    <span >Email Address</span>
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="email" id="email" class="getfields" onBlur="return insert(this.value);" style="width:350px;" type="text">
                    <br/><span id="err_email"></span>
                </td>
            </tr>
			
                    <input name="agent_login" readonly="readonly" id="agent_login12" class="getfields" style="width:350px;" type="hidden">
                
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Password</span>
                    
                    
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="passd" id="passd" class="getfields" style="width:350px;" type="password">
                      <br/><span id="err_passd"></span>
                    
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Confirm Password :</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="con_passd" id="con_passd" class="getfields" style="width:350px;" type="password">
                      <br/><span id="err_con_passd"></span>
                    
                    
                </td>
            </tr>
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc;">
                <input name="" type="submit" value=""  class="login-inner-save" />
     </td>
            </tr>
            
        </tbody>
    </table>

           </form>
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