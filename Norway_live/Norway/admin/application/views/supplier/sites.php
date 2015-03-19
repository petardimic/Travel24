<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - View Sites</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_DIR_ADMIN?>supplier_includes/js/custom.js" type="text/javascript"></script>

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
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <!--<div class="wrapper">
        <!-- Content -->
        <!--<div class="content">
            <!-- Dynamic table -->
           <!-- <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">View Sites</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>-->
             
                
 <div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content" >
         <div class="headersuplr_new1">View Sites<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
<form action="" method="get">
 

    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
   <tbody>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Site Id</span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;" >
                  <strong><span>Site Name</span>
                 </strong></td>
              <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >url </span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                  <strong><span>status</span>
                 </strong></td>

            </tr>
            <?php if(isset($sites)){if($sites != ''){
				foreach($sites as $s){?>
             <tr>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span ><?php echo $s->site_id?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                  <span><?php echo $s->site_name?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span><a href="<?php echo $s->url?>" target="_blank"><?php echo $s->url?></a></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                  <span><?php echo $s->status?></span>
                </td>
            </tr>
            <?php }}}?>
                      </tbody>
            </table>
            <table width="90%">
            <tr>
                <td align="right" class="add-your-property" ><a href="<?php echo WEB_URL_ADMIN?>supplier/addsite/1" >Add site</a></td>
            </tr>
            </table>

    </form>
    </div> </div>
    <div class="fix">
    </div>
    </div>
    <!--<div id="footer">
        <div class="wrapper">
            <span style="padding-top: 5px;text-align:center">
            <span id="ctl00_OptionalLinks_UpdatePanel_xlblmsg_1"></span>
            <!--<span style="float: right;">
                <input name="ctl00$OptionalLinks_UpdatePanel$Save" value="Save" onclick='javascript:WebForm_DoPostBackWithOptions(new WebForm_PostBackOptions("ctl00$OptionalLinks_UpdatePanel$Save", "", true, "", "", false, false))' id="ctl00_OptionalLinks_UpdatePanel_Save" class="button" style="height:28px;" type="submit">
            </span>--><!--</span>
        </div>
    </div>-->
                <!-- Footer -->
</body></html>