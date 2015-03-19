<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Excursion List</title>
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/main.css" rel="stylesheet" />
<script src="<?php echo WEB_DIR?>supplier_includes/js/custom.js" type="text/javascript"></script>
<script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>
<style>

<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>


    <!-- Top navigation bar -->
    <?php $this->load->view('header1');?>
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
            <div class="table" style="margin-top:10px;">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					 
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName">Your Package</span><b></b></h5>
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
          <td colspan="13" align="right" class="add-your-property" style="border-bottom:1px solid #dcdcdc;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_excursion"/>Add Package</a></td>
          </tr>
          <tr>
          <td colspan="13" align="center" height="30" class="add-your-property" style="border-bottom:1px solid #dcdcdc; font-weight:bold; font-size:18px; color:#800000">Domestic Packages</td>
          </tr>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Sl No </span>
                 </strong></td>
                
				<td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Acticity Name  </span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Acticity Type  </span>
                 </strong></td>
               
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Location</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Duration<br />In Hours</span>
                 </strong></td>
                 
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Product Code</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price from</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price infant</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price Child</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price Adult</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Added By</span>
                 </strong></td>
  
                 
                   <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Edit</span>
                 </strong></td>
                 
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Delete</span>
                 </strong></td>
            </tr>
             <?php
			 if(isset($permissions)){if($permissions !=''){
			 $per = explode(',',$permissions->prop);
			 }}
			 $m = 1;
				if(isset($excursion)){ if($excursion != '') { ?>
					 
					  <?php foreach ($excursion as $row){ ?>
                      <tr>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span ><?php echo $m; ?></span>
                            </td>
                         
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_name; ?></span>
                            </td>
                            
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php if($row->ex_type == 'int'){echo "International"; }else{echo "Domestic";}?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_location; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_duration; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_productcode; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_price; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_priceinfant; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_pricechild; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_priceadult; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->added_by; ?></span>
                            </td>
                           
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span style="color:#F10E21;"><a href="<?php print WEB_URL_ADMIN ?>admin/edi_excursion/<?php echo $row->excursion_id; ?>"><img src="<?php print WEB_DIR ?>images/edit_icon.jpg"  /></a></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                 <?php  if($this->session->userdata('new_user_id')) {?>
                              
                             <span> - </span>
                           
                              <?php }else{?>
                              <span><a href="<?php print WEB_URL_ADMIN ?>admin/delete_excursion/<?php echo $row->excursion_id; ?>" ><img src="<?php echo WEB_DIR?>supplier_includes/images/delete.png" alt=" Delete" title=" Delete" onclick="return confirm('Are you sure want to delete this Package?')"  /></a></span>
                              <?php }?>
                            </td>
                      </tr>
					  <?php
					$m++; } 
				}
				}
			
			 ?>
                <?php  if($this->session->userdata('new_user_id')) {}else{?>
         
          <?php }?>
        </tbody>
    </table>
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
         <tr>
          <td colspan="13" align="center" height="30" class="add-your-property" style="border-bottom:1px solid #dcdcdc; font-weight:bold; font-size:18px; color:#800000">International Packages</td>
          </tr>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Sl No </span>
                 </strong></td>
                
				<td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Acticity Name  </span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Acticity Type  </span>
                 </strong></td>
               
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Location</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Duration<br />In Hours</span>
                 </strong></td>
                 
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Product Code</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price from</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price infant</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price Child</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Price Adult</span>
                 </strong></td>
                 
                 <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span> Added By</span>
                 </strong></td>
  
                 
                   <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Edit</span>
                 </strong></td>
                 
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Delete</span>
                 </strong></td>
            </tr>
             <?php
			 if(isset($permissions)){if($permissions !=''){
			 $per = explode(',',$permissions->prop);
			 }}
			 $m = 1;
				if(isset($excursion_inter)){ if($excursion_inter != '') { ?>
					 
					  <?php foreach ($excursion_inter as $row){ ?>
                      <tr>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span ><?php echo $m; ?></span>
                            </td>
                         
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_name; ?></span>
                            </td>
                            
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php if($row->ex_type == 'int'){echo "International"; }else{echo "Domestic";}?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_location; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_duration; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_productcode; ?></span>
                            </td>
                            
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_price; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_priceinfant; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_pricechild; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->ex_priceadult; ?></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->added_by; ?></span>
                            </td>
                           
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span style="color:#F10E21;"><a href="<?php print WEB_URL_ADMIN ?>admin/edi_excursion/<?php echo $row->excursion_id; ?>"><img src="<?php print WEB_DIR ?>images/edit_icon.jpg"  /></a></span>
                            </td>
                            
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                 <?php  if($this->session->userdata('new_user_id')) {?>
                              
                             <span> - </span>
                           
                              <?php }else{?>
                              <span><a href="<?php print WEB_URL_ADMIN ?>admin/delete_excursion/<?php echo $row->excursion_id; ?>" ><img src="<?php echo WEB_DIR?>supplier_includes/images/delete.png" alt=" Delete" title=" Delete" onclick="return confirm('Are you sure want to delete this Package?')"  /></a></span>
                              <?php }?>
                            </td>
                      </tr>
					  <?php
					$m++; } 
				}
				}
			
			 ?>
                <?php  if($this->session->userdata('new_user_id')) {}else{?>
         
          <?php }?>
        </tbody>
    </table>
    </div> </div>
    <div class="fix">
    </div>
    </div>
    <?php /*?><div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--></span>
        </div>
    </div><?php */?>
                <!-- Footer -->
</body></html>
