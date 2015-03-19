<?php
$extraservice1 = "";$extraservice2 = "";$extraservice3 = "";$extraservice4 = "";$mode1 = "";$mode2 = "";$mode3 = "";$mode4 = "";$cost1 = "";$cost2 = "";$cost3 = "";$cost4 = "";
//Unit Info starts here
$k = 1;
 if(isset($extra_details) && $extra_details != '') { 
		 foreach ($extra_details as $row){ 
		   $sup_apart_list_id = $row->sup_apart_list_id; 	
		   if($k == 1){
			   $extraservice1 = $row->extraservice; 
			   $mode1 = $row->mode;
			   $cost1 = $row->cost; 
		   }else
		    if($k == 2){
			   $extraservice2 = $row->extraservice; 
			   $mode2 = $row->mode;
			   $cost2 = $row->cost; 
		   }
		   else
		    if($k == 3){
			   $extraservice3 = $row->extraservice; 
			   $mode3 = $row->mode;
			   $cost3 = $row->cost; 
		   }
		   else
		    if($k == 4){
			   $extraservice4 = $row->extraservice; 
			   $mode4 = $row->mode;
			   $cost4 = $row->cost; 
		   }
		   $k++;
		 }    
  }
//Unit Info ENDs here
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Extra Services</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<script type="text/javascript">
$(document).ready(function()
{
		$('#service1').watermark("Service1");
		$("#service2").watermark("Service2");
		$("#service3").watermark("Service3");
		$("#service4").watermark("Service4");
		$("#cost1").watermark("Cost1");
		$("#cost2").watermark("Cost2");
		$("#cost3").watermark("Cost3");
		$("#cost4").watermark("Cost4");
		
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

   <!-- <div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <!-- <div class="wrapper">
        <!-- Content -->
        <!-- <div class="content">
            <!-- Dynamic table -->
             <!--<div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Extra Services</span>
                               <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>-->
               
 <div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Extra Services<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
  <form method="post" id="extra_info" name="extra_info" action="<?php echo WEB_URL_ADMIN?>supplier/insert_extra_info">

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
           
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Extra Servies:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                  <div style="margin:4px 0 4px 0">
                  Service: <input name="service1" id="service1" class="getfields" style="width:140px;" type="text" value="<?php echo $extraservice1; ?>"> &nbsp;&nbsp;
                  Mode: 
                        <select name="mode1" id="mode1" class="subgetselectfields" style="width:100px;">
                        <option <?php if(!$mode1){ echo "Selected='Selected'"; } ?> value="0">Not Included</option>
                        <option <?php if($mode1){ echo "Selected='Selected'"; } ?> value="1">Included</option>
                        </select> 

                   &nbsp;&nbsp;    Cost <input name="cost1" id="cost1" class="getfields" style="width:81px;" type="text" value="<?php echo $cost1; ?>">   
                  </div>
                  <div style="margin:4px 0 4px 0">
                  Service: <input name="service2" id="service2" class="getfields" style="width:140px;" type="text" value="<?php echo $extraservice2; ?>"> &nbsp;&nbsp;
                  Mode: 
                       <select name="mode2" id="mode2" class="subgetselectfields" style="width:100px;">
                        <option <?php if(!$mode2){ echo "Selected='Selected'"; } ?> value="0">Not Included</option>
                        <option <?php if($mode2){ echo "Selected='Selected'"; } ?> value="1">Included</option>
                        </select> 

                   &nbsp;&nbsp;    Cost <input name="cost2" id="cost2" class="getfields" style="width:81px;" type="text" value="<?php echo $cost2; ?>">   
                  </div>
                  <div style="margin:4px 0 4px 0">
                  Service: <input name="service3" id="service3" class="getfields" style="width:140px;" type="text" value="<?php echo $extraservice3; ?>"> &nbsp;&nbsp;
                  Mode: 
                        <select name="mode3" id="mode3" class="subgetselectfields" style="width:100px;">
                        <option <?php if(!$mode3){ echo "Selected='Selected'"; } ?> value="0">Not Included</option>
                        <option <?php if($mode3){ echo "Selected='Selected'"; } ?> value="1">Included</option>
                        </select> 

                    &nbsp;&nbsp;   Cost <input name="cost3" id="cost3" class="getfields" style="width:81px;" type="text" value="<?php echo $cost3; ?>">   
                  </div>
                  <div style="margin:4px 0 4px 0">
                  Service: <input name="service4" id="service4" class="getfields" style="width:140px;" type="text" value="<?php echo $extraservice4; ?>"> &nbsp;&nbsp;
                  Mode: 
                       <select name="mode4" id="mode4" class="subgetselectfields" style="width:100px;">
                        <option <?php if(!$mode4){ echo "Selected='Selected'"; } ?> value="0">Not Included</option>
                        <option <?php if($mode4){ echo "Selected='Selected'"; } ?> value="1">Included</option>
                        </select> 

                     &nbsp;&nbsp;  Cost <input name="cost4" id="cost4" class="getfields" style="width:81px;" type="text" value="<?php echo $cost4; ?>">   
                  </div>
					<br/><span id="err_long"></span>
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
    </form>
    </div> </div>
    <div class="fix">
    </div>
    </div>
    
                <!-- Footer -->
</body></html>