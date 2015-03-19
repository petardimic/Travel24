<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Add Site</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/code_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR_ADMIN; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR_ADMIN; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
</head>
<body>
<div class="wrapper">

    <!-- Top navigation bar -->
    <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

    <!--<div id="sidebar-position">
    <?php  //$this->load->view('supplier/leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
	<form method="post" action="<?php echo WEB_URL?>supplier/add_site/1" id="add_site" name="add_site">
    <!--<div class="wrapper">-->
        <!-- Content -->
        <!--<div class="content">-->
            <!-- Dynamic table -->
            <!--<div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Add Site</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>
                </div>-->
               <!-- <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>-->
                

 <div id="container_warpper">       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">Add Site<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
		 <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                         <span  class="inner-heading">Add Site</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                <div class="fix">&nbsp;</div>
                    
                    <span id="ctl00_OptionalLinks_UpdatePanel_xlblAccommodationName" style="font-weight:bold;"></span>
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Site Id:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="site_id" id="site_id" class="getfields" style="width:350px;" type="text" />
              <br/><span id="err_site_id"></span>  </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Site Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="site_name" id="site_name" class="getfields" style="width:350px;" type="text" >
              <br/><span id="err_site_name"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Site URL:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="url" id="url" class="getfields" style="width:350px;" type="text"  />
              <br/><span id="err_url"></span>  </td>
            </tr>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;" width="43%">
                    <span >Status</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;" width="57%">
                    
                      <input name="status" id="status" class="getfields" style="width:350px;" type="text"  />
              <br/><span id="err_status"></span>  </td>
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
    </div> </div>
    <div class="fix">
    </div>
    </div>
	</form>

                <!-- Footer -->
</body></html>