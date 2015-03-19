<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Apartments List</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>

<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR?>supplier_includes/js/custom.js" type="text/javascript"></script>

<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>


    <!-- Top navigation bar -->
    <?php $this->load->view('header');?>
        <!-- Header -->
    <div class="fix"></div>

    <!--<div id="sidebar-position">
  <?php /*?>  <?php  $this->load->view('supplier/leftbar');?><?php */?>
    </div>--><!--sidebar-position-->
    <!-- Content wrapper -->
    <div class="wrapper">
        <!-- Content -->
        <div class="content" style=" width:80%; margin-left:auto; margin-right:auto; float:none !important;">
            <!-- Dynamic table -->
            <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName">Your Property</span><b></b></h5>
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
 
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >No </span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;" >
                  <strong><span>Country</span>
                 </strong></td>
              <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >City  </span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span>Accommodation Name</span>
                 </strong></td>
    <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Room Status</span>
                 </strong></td>
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span>View Details</span>
                 </strong></td>
            </tr>
             <?php
			 $m = 1;
				if(isset($apartment_list)){ if($apartment_list != '') { ?>
					 
					  <?php foreach ($apartment_list as $row){ ?>
                      <tr>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span ><?php echo $m; ?></span>
                            </td>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->name; ?></span>
                            </td>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                <span ><?php $city = $this->Supplier_Model->get_city($row->city); if($city) { $x = explode(',',$city);echo $x[0];} else echo $row->city; ?></span>
                            </td>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->apartment_name; ?></span>
                            </td>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                <span ><?php echo "Incomplete"; ?></span>
                            </td>
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><a href="<?php print WEB_URL?>supplier/supplier_home/<?php echo $row->sup_apart_list_id; ?>/1">Click</a></span>
                            </td>
                      </tr>
					  <?php
					$m++; } 
				}
				}
			 ?>
             
          <tr>
          <td colspan="6" align="right" class="add-your-property" style="border-bottom:1px solid #dcdcdc;"><a href="<?php echo WEB_URL?>supplier/add_accommodation/1"/>Add Accomidation</a></td>
          </tr>
        </tbody>
    </table>
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