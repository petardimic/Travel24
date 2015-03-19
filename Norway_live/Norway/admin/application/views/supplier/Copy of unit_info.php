<?php
$max_persons = "";$normal_persons = "";$size = "";$bedrooms = "";$terrace = "";$floors = "";$bathrooms = "";$add_charges = ""; $category = "";
$plan = "";
//Unit Info starts here
//print_r($unit_details);exit();
 if(isset($unit_details) && $unit_details != '') { 
		 foreach ($unit_details as $row){ 
		   $sup_apart_list_id = $row->sup_apart_list_id; 	
		   $max_persons = $row->max_persons; 
		   $normal_persons = $row->normal_persons;
		   $size = $row->size; 
		   $bedrooms = $row->bedrooms;
		   $terrace = $row->terrace; 
		   $floors = $row->floors;
		   $bathrooms = $row->bathrooms;
		   $add_charges = $row->add_charges;
		   $category = $row->category_name;
		   $plan = $row->sup_apart_rateplan_id;
		 }    
  }
//Unit Info ENDs here
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Staykey - Unit Information</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR?>supplier_includes/js/custom.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>

<script type="text/javascript">
$(document).ready(function()   size rooms terrace floors brooms charge
{
		$('#personn').watermark("Number Of Person (Normal)");
		$("#personm").watermark("Number Of Person (Maximum)");
		$("#unitcate").watermark("Category Name");
		$("#size").watermark("Size For Accommodation");
		$("#rooms").watermark("Bed Rooms");
		$("#floors").watermark("Floors");
		$("#brooms").watermark("Bed Rooms");
		$("#charge").watermark("Additional Charges");
		
});
</script>
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
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
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Unit Information</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="#" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    <div style="display: none;" id="ctl00_DescriptionHolder_XpnlSuccess">
	
                <div align="center">
                    <div class="status_msg">
                        <strong>SUCCESS: </strong>All Details Saved / Updated Successfully
                    </div>
                </div>
            
</div>
            

                <div class="error-text">
                </div>
                
                
    <div id="ctl00_OptionalLinks_UpdatePanel_upConfirmation">
	
            
        
</div>
 <form method="post" id="unit_info" name="unit_info" action="<?php echo WEB_URL?>supplier/insert_unit_info">

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Category Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="unitcate" id="unitcate" class="getfields" style="width:350px;" type="text" value="<?php echo $category; ?>">
						<br/><span id="unitcate_err"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Rate Plans:</span> 
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <select name="plan" id="plan" class="subgetselectfields"  style="width:360px;">
				     <option value="">select plan type</option>
					 <?php if(isset($plan_list)){if($plan_list!=''){
                    foreach($plan_list as $t){?>
                    <option value="<?php echo $t->sup_apart_rateplan_id; ?>" <?php if($plan == $t->sup_apart_rateplan_id){ echo "Selected='Selected'"; } ?>><?php echo $t->rate_name?></option>
                    <?php }}}?>
					</select>
		         <br/><span id="plan_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                 <div class="fix">&nbsp;</div>
                    <span >No: of Person (Normal):</span>
                </td>
                 <td style="border-bottom:1px solid #dcdcdc;">
                   
                   <input name="personn" id="personn" class="getfields" style="width:350px;" type="text" value="<?php echo $normal_persons; ?>">
		<br/><span id="personn_err"></span>
                </td>
            </tr>
            
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >No of Person (Maximum):</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="personm" id="personm" class="getfields" style="width:350px;" type="text" value="<?php echo $max_persons; ?>">
						<br/><span id="personm_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Size of area: </span>
                </td>
               <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="size" id="size" class="getfields" style="width:350px;" type="text" value="<?php echo $size; ?>">
					<br/><span id="size_err"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">No of Bed Rooms: </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="rooms" id="rooms" class="getfields" style="width:350px;" type="text" value="<?php echo $bedrooms; ?>">
					<br/><span id="rooms_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Is Building Terrace:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;"><input type="radio" name="terrace" id="terrace" value="1" <?php if($terrace){ echo "Checked='Checked'"; } ?>/>
                  <label for="radio"></label>
                   Yes &nbsp; &nbsp; <input name="terrace" id="terrace" type="radio" value="0" <?php if(!$terrace){ echo "Checked='Checked'"; } ?>/> No <br/><span id="terrace_err"></span>
              </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >No of floors</span>                </td>
              
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input name="floors" id="floors" class="getfields" style="width:350px;" type="text" value="<?php echo $floors; ?>">
			<br/><span id="floors_err"></span>
		</td>
            </tr>
           
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >No of bath rooms:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                  <input name="brooms" id="brooms" class="getfields" style="width:350px;" type="text" value="<?php echo $bathrooms; ?>">
				<br/><span id="brooms_err"></span>
                </td>
            </tr>
        
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Additional Charges:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input name="charge" id="charge" class="getfields" style="width:350px;" type="text" value="<?php echo $add_charges; ?>">
				<br/><span id="charge_err"></span>
                </td>
            </tr>
           
            
            
            <tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="unitsub" id="unitsub" type="submit" value=""  class="login-inner-save" />
     </td>
            </tr>
        </tbody>
    </table>
    </form>
    </div> </div>
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