<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Space Facilities</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR?>supplier_includes/js/custom.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>supplier_includes/js/jquery-1.js"></script> 
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
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>


    <!-- Top navigation bar -->
    <?php $this->load->view('header');?>
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
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;" >Space Facilities</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
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
 <form  id="partfec" name="partfec" action="<?php print WEB_URL?>/supplier/reg_apart_roomfacilityinfo" method="post" onsubmit="return facilities();">
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
                        <td width="250px" style="border: 1px solid #e7e7e7; background: #fcfcfc; font-size:1em;" valign="top">
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
                            <div style="float:left;  width:170px;">
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
                                <textarea style="height:40px;width:160px;" placeholder="(frequency, timmings, charges, other comments…)" onkeypress="return textboxMultilineMaxNumber(this,160)" onpaste="return false;" id="cmnts_<?php echo $row->sup_apart_roomfacilities_list_id; ?>" cols="20" rows="2" name="cmnts_<?php echo $row->sup_apart_roomfacilities_list_id; ?>"> <?php	
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
 						if($m%5 == 0){
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
                <div style="float:right;"><input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
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
    <div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
           </span>
        </div>
    </div>
                <!-- Footer -->
</body></html>