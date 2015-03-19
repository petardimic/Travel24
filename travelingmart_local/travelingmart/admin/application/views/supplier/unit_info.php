<?php
$max_persons = "";$normal_persons = "";$size = "";$bedrooms = "";$terrace = "";$floors = "";$bathrooms = "";$add_charges = ""; $category = "";
$plan = "";$rate = ""; $desc = "";
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
		    $rate = $row->sup_apart_categoryrate;
		   $desc = $row->desc;
//		   $plan = $row->sup_apart_rateplan_id;
		 }    
  }
//Unit Info ENDs here
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Category Information</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/light-box.css"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
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
<script type="text/javascript">
function facilities()
{
	var valcheck2 = [];
	var selectedVariants = $("input[name=htlfcltycb]:checked").serializeArray();
	jQuery.each(selectedVariants, function(i, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck2[i] = field.value;
    });
	$('#roomfec_val').val('');
	$('#roomfec_val').val(valcheck2);
	/*alert(valcheck2);
	alert($('#roomfec_val').val(valcheck2));*/
	if(valcheck2 != ""){
   		return true;
	}
	
	return false;
}
</script>

<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
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
    </div>--><!--sidebar-position-->
    <!-- Content wrapper -->
    <!--<div class="wrapper">
        <!-- Content -->
        <!--<div class="content">
            <!-- Dynamic table -->
            <!--<div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Category Information</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>-->
                
<div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Category Information<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
        <?php if(isset($plan1)){if($plan1!=''){?>
<form method="post" name="get_ind" id="get_ind" action="<?php echo WEB_URL_ADMIN?>supplier/get_ind_units">
 <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">

  <tr>
                <td style="border-bottom:1px solid #dcdcdc; width:43%">
                    <span >Duplicate Previous Unit Type:</span>
                </td>
                   <td style="border-bottom:1px solid #dcdcdc;">
	<?php //echo $plan;?>
               <select name="plan_name" id="plan_name" class="subgetselectfields valid" style="width:350px;" onchange="return this.form.submit();">
				<option value="">Select category Plan</option>
				<?php if(isset($plan1)){if($plan1!=''){foreach($plan1 as $p){?>
				<option value="<?php echo $p->sup_apart_category_id;?>"<?php if(isset($id)){if($id != ''){if($id == $p->sup_apart_category_id){?> selected="selected" <?php }}}?> ><?php echo $p->category_name;?></option>
				<?php }}}?>
			</select>
                    </td>
            </tr>
            </table>
            </form>
            <?php }}?>
 <form method="post" id="unit_info" name="unit_info" action="<?php echo WEB_URL_ADMIN?>supplier/insert_unit_info" onsubmit="return facilities();">

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Indicate the name of this room type in English:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="unitcate" id="unitcate" class="getfields" style="width:350px;" type="text" value="<?php echo $category; ?>">
						<br/><span id="unitcate_err"></span>
                </td>
            </tr>
            <?php /*?> <tr>
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
            </tr><?php */?>
			 <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >What is the Rack Rate of this room type?:</span> 
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <input name="plan" id="plan" class="getfields" style="width:350px;" type="text" value="<?php echo $rate?>">
				     
		         <br/><span id="plan_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
              
                    <span >Max Person:</span>
                </td>
                 <td style="border-bottom:1px solid #dcdcdc;">
                   
                   <input name="personn" id="personn" class="getfields" style="width:350px;" type="text" value="<?php echo $normal_persons; ?>">
		<br/><span id="personn_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >No of bathrooms:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                  <select name="brooms" id="brooms" class="subgetselectfields valid" style="width:350px;">
				  <option value="">shared</option>
				  <?php for($i=1;$i<=10;$i++){?>
				  <option value="<?php echo $i;?>" ><?php echo $i;?></option>
				  <?php }?>
				  </select><?php /*?>value="<?php echo $bathrooms; ?>"><?php */?>
				<br/><span id="brooms_err"></span>
                </td>
            </tr>
        
            <?php /*?><tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Max Person:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="personm" id="personm" class="getfields" style="width:350px;" type="text" value="<?php echo $max_persons; ?>">
						<br/><span id="personm_err"></span>
                </td>
            </tr><?php */?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Room Size: </span>
                </td>
               <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="size" id="size" class="getfields" style="width:200px;" type="text" value="<?php echo $size; ?>">
					<input type="radio" name="meter" value="Sq.feet" checked="checked" /> Sq.feet <input type="radio" name="meter" value="Sq.meters" /> Sq.meters<br/><span id="size_err"></span>
                </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">No of bedrooms: </span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="rooms" id="rooms" class="getfields" style="width:350px;" type="text" value="<?php echo $bedrooms; ?>">
					<br/><span id="rooms_err"></span>
                </td>
            </tr>
            <?php /*?><tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                     <span  class="lables-move">Is Building Terrace:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;"><input type="radio" name="terrace" id="terrace" value="1" <?php if($terrace){ echo "Checked='Checked'"; } ?>/>
                  <label for="radio"></label>
                   Yes &nbsp; &nbsp; <input name="terrace" id="terrace" type="radio" value="0" <?php if(!$terrace){ echo "Checked='Checked'"; } ?>/> No <br/><span id="terrace_err"></span>
              </td>
            </tr><?php */?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Beds</span>:               </td>
              
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input name="floors" id="floors" class="getfields" style="width:350px;" type="text" value="<?php echo $floors; ?>">
			<br/><span id="floors_err"></span>
		</td>
            </tr>
           
            
            <?php /*?><tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Additional Charges:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                   <input name="charge" id="charge" class="getfields" style="width:350px;" type="text" value="<?php echo $add_charges; ?>">
				<br/><span id="charge_err"></span>
                </td>
            </tr><?php */?>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <span >Description:</span>
                     
                                        
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                   <textarea name="desc" id="desc"  class="getfields" style="width:350px; height:60px;"><?php echo $desc?></textarea>
				<br/><span id="desc_err"></span>
                </td>
            </tr>
             <tr>
                <td colspan="2" id="inner-span-heading" style="border-bottom:1px solid #dcdcdc;">
                  <span class="inner-heading" >Space Facilities:</span>
                </td>
            </tr>
           <tr>
            
            
        </tbody>
    </table>
	<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td class="border-bottom" valign="top">
                        <table width="100%" border="0" align="Left" cellpadding="0" cellspacing="0" id="ctl00_OptionalLinks_UpdatePanel_xdlFacilitiesGroupName_ctl01_xdlFacilities" style="width:100%; border-collapse:collapse;">
			<tbody><tr>
				<td colspan="5">
                    </td>
			</tr>
            <tr>
 <?php
	 $m = 1;
        if(isset($roomfecility_list)){ if($roomfecility_list != '') { ?>
             
              <?php foreach ($roomfecility_list as $row){ ?>
                <td valign="top">
                <table width="19%" cellspacing="0" cellpadding="0" border="0" class="display">
                    <tbody><tr>
                        <td width="200px" style="border: 1px solid #e7e7e7; background: #fcfcfc; font-size:1em;" valign="top">
                            <input type="checkbox" name="htlfcltycb" id="htlfcltycb" value="<?php echo $row->sup_apart_roomfacilities_list_id; ?>" 
                              <?php	
                                  if(isset($roomfecility_val)){ if($roomfecility_val != '') { 
                                      foreach ($roomfecility_val as $row1){
                                          if($row1->sup_apart_roomfacilities_list_id == $row->sup_apart_roomfacilities_list_id){
                                              echo "checked='checked'";
                                          }
                                      }
                                  }}
                               ?>
                            
                            />&nbsp;<label><?php echo $row->roomfacilities; ?></label>&nbsp;<br>
                            <div style="float:left;  width:100px;">
                            <span id="cmnts_<?php echo $m; ?>"><span style="font-size:11px;  background-image: url(images/list-arrows-green.png);background-repeat: no-repeat;padding-left:13px;" id="Original_<?php echo $m; ?>"><a onclick="Edit(<?php echo $m; ?>);" id="ah<?php echo $m; ?>" href="javascript:(void);">Add Comment</a></span></span>      
                            <?php	
							 $show_it = 0;
                                  if(isset($roomfecility_val)){ if($roomfecility_val != '') { 
                                      foreach ($roomfecility_val as $row1){
                                          if($row1->sup_apart_roomfacilities_list_id == $row->sup_apart_roomfacilities_list_id){
                                              if($row1->comments != " "){
										       $show_it = 1;
                                          	}
                                          }
                                      }
                                  }}
                               ?>                                      
                            <span <?php if($show_it){ echo 'style="display:block;"';}else{ echo 'style="display:none;"'; } ?> id="Edit_<?php echo $m; ?>">
                                <textarea style="height:40px;width:100px;" placeholder="(frequency, timmings, charges, other comments…)" onkeypress="return textboxMultilineMaxNumber(this,160)" onpaste="return false;" id="cmnts_<?php echo $row->sup_apart_roomfacilities_list_id; ?>" cols="20" rows="2" name="cmnts_<?php echo $row->sup_apart_roomfacilities_list_id; ?>"> <?php	
                                  if(isset($roomfecility_val)){ if($roomfecility_val != '') { 
                                      foreach ($roomfecility_val as $row1){
                                          if($row1->sup_apart_roomfacilities_list_id == $row->sup_apart_roomfacilities_list_id){
                                              if($row1->comments != " "){
										       ?>
                                               <?php
                                              echo $row1->comments;
                                          	}
                                          }
                                      }
                                  }}
                               ?></textarea> <br>
                                <span style="font-size:11px;">
                                <span style="font-size:12px; color:#F30;" id="characters">160</span> Characters Limit</span>                                                </span></div>            
                        </td>
                    </tr>
                </tbody></table>
                </td>
 <?php		
 						if($m%4 == 0){
							echo "</tr><tr>";
						}
						?>
              <?php $m++; } 
              
        }}?>
</tr>

            <tr>
				<td colspan="5" align="left" style="border-top:#ccc 1px solid;">
                <input type="hidden" id="count" name="count" value="<?php echo $m-1; ?>"/>
                <input type="hidden" id="roomfec_val" name="roomfec_val" value=""/>
				
                <div style="float:right;">
				<input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>
		</tbody></table>
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