 <script type="text/javascript" src="<?php print WEB_DIR?>datepicker/js/jquery-1.4.2.min.js"></script>
 <script type="text/javascript" src="<?php print WEB_DIR_ADMIN?>js/sorting.js"></script>
        <link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
        <link href="<?php print WEB_DIR ?>SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="<?php print WEB_DIR ?>SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
		<style type="text/css">
		a:link {
	color: #333;
	text-decoration: none;
}
        a:visited {
	color: #333;
	text-decoration: none;
}
        a:hover {
	color: #456e08;
	text-decoration: none;
}
        a:active {
	text-decoration: none;
}
        </style>
 <div class="clr"></div>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>
<style>
table.sortable thead {
    background-color:#eee;
    color:#FFFFFF;
    font-weight: bold;
    cursor: default;
}

</style>
 <div id="container_warpper" style="padding-bottom:50px;" >


<div style="text-align:right; margin-right:20px;" class="add"></div>
<div class="right-wrapper" style="width:1000px; margin-left:0px; ">
 <div id="TabbedPanels1" class="TabbedPanels">
                                
                              
                                <div class="TabbedPanelsContentGroup">
                                 
                                  <div class="TabbedPanelsContent" style="100%">
		<form method="post"  name="deposit"  enctype="multipart/form-data" action="<?php print WEB_URL_ADMIN?>admin/insert_supplier" onsubmit="return valid(this)">
		
                                  <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                 <div><h1>New Supplier Sign-Up </h1></div>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                
                    
                    <span id="ctl00_OptionalLinks_UpdatePanel_xlblAccommodationName" style="font-weight:bold;"></span>
                </td>
            </tr>
            <tr>
            <td colspan="2" style="border-bottom:1px solid #dcdcdc; color:#000; font-size:12px;">It couldn't be easier to sign-up with entevour; simply complete our registration form and you could be making bookings in no time at all.</td>
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
                    
                    <select name="country" id="country" class="subgetselectfields" style="width:360px; height:25px;">
	<option value="">--select country--</option>
		 <?php foreach($country as $c){?>
					   <option value="<?php echo $c->name?>"><?php echo $c->name?></option>
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
            <?php /*?> <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move"> Name of 1st property: </span>
               </td>
                <td style="border-bottom:1px solid #dcdcdc;">
            <input name="prop_name" id="prop_name" class="getfields" style="width:350px;" type="text">
            <br/><span id="err_prop_name"></span>
                </td>
            </tr><?php */?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span > Language</span>
                :</td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="language" id="language" class="getselectfields" style="width:360px; height:25px;">
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
    </table></form>
                                   	
                                  </div>
                                  
                                 
   <!-- tab panel 3 end here -->                       
                                  
       </div>
                              </div>

</div>		
             
       
		
			  
<script type="text/javascript">
	var menu=new menu.dd("menu");
	menu.init("menu","menuhover");
</script>

</div>
