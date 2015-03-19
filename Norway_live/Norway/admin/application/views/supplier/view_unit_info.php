<?php
$max_persons = "";$normal_persons = "";$size = "";$bedrooms = "";$terrace = "";$floors = "";$bathrooms = "";$add_charges = ""; $category = "";
$plan = "";
//Unit Info starts here
//print_r($unit_details);exit();
 if(isset($unit_details) && $unit_details != '') { 
		 foreach ($unit_details as $row){ 
		   $sup_apart_unitdetails_id  = $row-> sup_apart_category_id;
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
		   $plan = $row->sup_apart_categoryrate;
		     $desc = $row->desc;
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
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>

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
	var valcheck3 = [];
	var selectedVariants1 = $("input[name=htlfcltycb1]:checked").serializeArray();
	jQuery.each(selectedVariants1, function(j, field){
     // alert(field.value); alert("IValue=="+i);
		valcheck3[j] = field.value;
    });
	//alert(valcheck3);
	$('#roomfec_val1').val('');
	$('#roomfec_val1').val(valcheck3);
	/*alert(valcheck2);
	alert($('#roomfec_val').val(valcheck2));*/
	if(valcheck2 != ""){
   		return true;
	}
	
	return false;
}
</script>
<script type="text/javascript">
function popup_close()
{
	$('#login-box').hide();
	$('#mask').hide();
}
$(document).ready(function() {
		$('a.login-window').click(function() {
		
		// Getting the variable's value from a link 
		var loginBox = $(this).attr('href');

		//Fade in the Popup and add close button
		$(loginBox).fadeIn(300);
		
		//Set the center alignment padding + border
		var popMargTop = ($(loginBox).height() + 24) / 2; 
		var popMargLeft = ($(loginBox).width() + 24) / 2; 
		
		$(loginBox).css({ 
			'margin-top' : -popMargTop,
			'margin-left' : -popMargLeft
		});
		
		// Add the mask to body
		$('body').append('<div id="mask"></div>');
		$('#mask').fadeIn(300);
		
		return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').live('click', function() { 
	  $('#mask , .login-popup').fadeOut(300 , function() {
		$('#mask').remove();  
	}); 
	return false;
	});
});
$(document).ready(function(){
						
			$('.popup').css('display','none');
			$('.popup1').css('display','none');
			$('.eassy-popup').css('display','none');
			$('.categories-icon li').click(function(){
				$('.popup').css('display','block');				
				}); 
			$('.featured-icon li').click(function(){
				$('.popup').css('display','block');	
				$('.popup1').css('display','none');				
				});
			$('.categories-icon span').click(function(){
				$('.popup1').css('display','block');				
				});
			$('.popup div').click(function(){
				$('.popup').css('display','none');				
				});
			$('.popup1 span').click(function(){
				$('.popup1').css('display','none');				
				});
			$("#eassy-step").hover(
			    function () {
				  $('.eassy-popup').css('display','block');
			    }, 
			    function () {
			      $('.eassy-popup').css('display','none');
			    }
			);
			$('#add_option1 input:radio').click(function(){
				var value = $(this).val();
				$('#testinput').val(value);
			}); 
					
		});
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
function delete_pic(id)
{

	if(confirm('Are you sure want to delete this Picture?'))
	{
		$('#pic'+id).hide();
		var strURL="<?php echo WEB_URL_ADMIN?>supplier/delete_roompicture/"+id;
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
									//alert(s);
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
<style type="text/css">

a { 
	text-decoration:none; 
	/*color:#00c6ff;*/
}

.post { margin: 0 auto; padding-bottom: 50px; float: left; width: 960px; }



.btn-sign a { color:#fff; text-shadow:0 1px 2px #161616; }

#mask {
	display: none;
	background: #000; 
	position: fixed; left: 0; top: 0; 
	z-index: 10;
	width: 100%; height: 100%;
	opacity: 0.8;
	z-index: 999;
}

.login-popup{
	display:none;
	background: #333;
	padding: 10px; 	
	border: 2px solid #ddd;
	float: left;
	font-size: 1.2em;
	position: fixed;
	top: 50%; left: 50%;
	z-index: 99999;
	box-shadow: 0px 0px 20px #999;
	-moz-box-shadow: 0px 0px 20px #999; /* Firefox */
    -webkit-box-shadow: 0px 0px 20px #999; /* Safari, Chrome */
	border-radius:3px 3px 3px 3px;
    -moz-border-radius: 3px; /* Firefox */
    -webkit-border-radius: 3px; /* Safari, Chrome */
}

img.btn_close {
	float: right; 
	margin: -28px -28px 0 0;
}

fieldset { 
	border:none; 
}

form.signin .textbox label { 
	display:block; 
	padding-bottom:7px; 
}

form.signin .textbox span { 
	display:block;
}

form.signin p, form.signin span { 
	color:#999; 
	font-size:11px; 
	line-height:18px;
} 

form.signin .textbox input { 
	background:#666666; 
	border-bottom:1px solid #333;
	border-left:1px solid #000;
	border-right:1px solid #333;
	border-top:1px solid #000;
	color:#fff; 
	border-radius: 3px 3px 3px 3px;
	-moz-border-radius: 3px;
    -webkit-border-radius: 3px;
	font:13px Arial, Helvetica, sans-serif;
	padding:6px 6px 4px;
	width:200px;
}

form.signin input:-moz-placeholder { color:#bbb; text-shadow:0 0 2px #000; }
form.signin input::-webkit-input-placeholder { color:#bbb; text-shadow:0 0 2px #000;  }

.button { 
	background: -moz-linear-gradient(center top, #f3f3f3, #dddddd);
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#dddddd));
	background:  -o-linear-gradient(top, #f3f3f3, #dddddd);
    filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#f3f3f3', EndColorStr='#dddddd');
	border-color:#000; 
	border-width:1px;
	border-radius:4px 4px 4px 4px;
	-moz-border-radius: 4px;
    -webkit-border-radius: 4px;
	color:#333;
	cursor:pointer;
	display:inline-block;
	padding:6px 6px 4px;
	margin-top:10px;
	font:12px; 
	width:214px;
}

.button:hover { background:#ddd; }

</style>
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
   <!-- <div class="fix"></div>

    <div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <!--<div class="wrapper">
        <!-- Content -->
       <!-- <div class="content">
            <!-- Dynamic table -->
          <!--  <div class="table">
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
               
<div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1"> Category Information<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
 <form method="post" id="unit_info" name="unit_info" action="<?php echo WEB_URL_ADMIN?>supplier/update_unit_info/<?php echo $sup_apart_unitdetails_id;?>" onsubmit="return facilities();">
<input type="hidden" id="roomfec_val" name="roomfec_val" value=""/>
<input type="hidden" id="roomfec_val1" name="roomfec_val1" value=""/>
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
                     <input name="plan" id="plan" class="getfields" style="width:350px;" type="text" value="<?php echo $plan;?>">
				     
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
				  <option value="<?php echo $i;?>" <?php if($bathrooms == $i){?> selected="selected"<?php }?>><?php echo $i;?></option>
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
                <?php $size = explode(' ',$size); ?>
               <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="size" id="size" class="getfields" style="width:200px;" type="text" value="<?php echo $size[0]; ?>">
					<input type="radio" name="meter" value="Sq.feet" <?php if($size[1] == 'Sq.feet'){?> checked="checked" <?php }?>> Sq.feet <input type="radio" name="meter" value="Sq.meters"  <?php if($size[1] == 'Sq.meters'){?> checked="checked" <?php }?> /> Sq.meters<br/><span id="size_err"></span>
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
                   <textarea name="desc" id="desc"  class="getfields" style="width:350px; height:60px;"><?php echo $desc;?></textarea>
				<br/><span id="desc_err"></span>
                </td>
            </tr>
             <tr>
                <td colspan="2" id="inner-span-heading" style="border-bottom:1px solid #dcdcdc;">
                  <span class="inner-heading" >Space Facilities:</span>
                </td>
            </tr>
           <tr>
            
            <?php /*?><tr>
                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span ></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="unitsub" id="unitsub" type="submit" value=""  class="login-inner-save" />
     </td>
            </tr><?php */?>
        </tbody>
    </table>
	<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td class="border-bottom" valign="top">
                        <table width="100%" border="0" align="Left" cellpadding="0" cellspacing="0" id="ctl00_OptionalLinks_UpdatePanel_xdlFacilitiesGroupName_ctl01_xdlFacilities" style="width:100%;border-collapse:collapse;">
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

<tr><td colspan="4" id="inner-span-heading">
 <span class="inner-heading" >Space Pictures:</span><div style="text-align:right; padding-bottom:5px; font-weight:bold; border-bottom:2px #666 solid;">  Upload a valid file with extension JPG, JPEG, PNG.     | <a href="#login-box" class="login-window"><img src="<?php echo WEB_DIR?>supplier_includes/images/up-load.png" width="122" height="24" border="0" style="margin:0px 5px 0 0; vertical-align:top;" /></a></div>
</td></tr>
            
		</tbody></table>
              </td>
            </tr>
        </tbody>
    </table>
	<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		<?php  $k=1;
		if(isset($pic)){ if($pic != '') { ?>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="100%">
				<?php foreach($pic as $p){ ?>
                 <div class="image-box" id="pic<?php echo $p->sup_apart_roompictures_id;?>">
                 <div>
                 
                 <?php if($p->added_by == 0){ ?>
                 <img src="<?php echo WEB_DIR?>uploadroomimage/<?php echo $p->image_name;?>" width="185" height="120" border="0" style="margin:4px;" />
                 <?php }else if($p->added_by == 1){?>
          <img src="<?php echo WEB_DIR_ADMIN?>uploadroomimage/<?php echo $p->image_name;?>" width="185" height="120" border="0" style="margin:4px;" />
                 <?php }?>
                 
                 <div class="checkbox-bg">
                 <span style="float:left; margin-top:2px;">
                 
                  <input name="htlfcltycb1" id="htlfcltycb1" type="checkbox" <?php if($p->status == 1){?> checked="checked" <?php } else { ?> checked="checked" <?php } ?> value="<?php echo $p->sup_apart_roompictures_id;?>" />
                 
				<?php /*?> <input name="htlfcltycb1" id="htlfcltycb1" type="checkbox" <?php if($p->status == 1){?> checked="checked" <?php } else { ?> checked="checked" <?php } ?> value="<?php echo $p->sup_apart_roompictures_id;?>" /><?php */?>
                 
                 </span>
                 <span style=" float:left;">
				 <img src="<?php echo WEB_DIR?>supplier_includes/images/minus.png" width="18" height="18" border="0" style="vertical-align:top; margin-left:5px;" onclick="return delete_pic('<?php echo $p->sup_apart_roompictures_id;?>');"/></span>
                 </div>
                 <div ><textarea name="cmnts1_<?php echo $p->sup_apart_roompictures_id; ?>" id="cmnts1_<?php echo $p->sup_apart_roompictures_id; ?>" cols="" rows="" class="text-box-bg"><?php echo $p->title;?></textarea></div>
                 </div>
                 </div>
                 <?php }?>
                </td>
				<?php if($k%4 == 0){
							echo "</tr><tr>";
						}
						?>
              <?php $k++;?> 
            </tr>
			<?php }}?>
			<tr>
				<td colspan="5" align="left" style="border-top:#ccc 1px solid;">
                <input type="hidden" id="count" name="count" value="<?php echo $m-1; ?>"/>
                <input type="hidden" id="apartfec_val" name="apartfec_val" value=""/>
                <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>
        </tbody>
    </table>
    </form>
	
	<div id="login-box" class="login-popup" style="height:150px; background-color:#F4F4F4;">
       <img src="<?php echo WEB_DIR; ?>images/close_pop.png" id="close" onclick="return popup_close();" style="cursor:pointer;" class="btn_close" title="Close Window" alt="Close" />
         
	<form name="pic_browse" method="post" class="signin" action="<?php echo WEB_URL_ADMIN?>supplier/upload_room_picture" enctype="multipart/form-data">
                
                <input type="hidden" name="room_id" value="<?php echo $sup_apart_unitdetails_id;?>" />
                <p style="color:#000;">
                Instruction: browse your files and select the pictures to upload. Check the color of the border on this screen to identify their quality.<br>Tip: high resolution images (at least 800 x 600 pixels) will help your hotel convert better, which means even more bookings!    <br/>
                <br><input type="file" id="image1" name="image1">
                </p><br />
                <div style="text-align:center">
         <input name="" type="submit" value=""  class="login-inner-save" />
         </div>
          </form>
		</div>
    </div> </div>
    <div class="fix">
    </div>
    </div>

                <!-- Footer -->
</body></html>