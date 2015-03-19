<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Category List</title>
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
   <!--  <div class="wrapper">
        <!-- Content -->
        <!-- <div class="content">
            <!-- Dynamic table -->
            <!-- <div class="table">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title">
					<div class="hidden_head">&nbsp;</div>
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">Category List</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL?>supplier/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
                                </h5>
                        </div>
                    </div>
                </div>-->
                
 
 <div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">Category List<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">

 <table width="100%" border="0" cellspacing="0" cellpadding="0" style=" background-color:#ccc;">
  
  <tr>
    <td>&nbsp;</td>
    <td></td>
    <td></td>
    <td></td>
    <td class="add-your-property" align="right" ><a href="<?php echo WEB_URL_ADMIN?>supplier/unit_info/1" style="margin-bottom:5px; width:120px;" >Add New Unit Plan</a></td>
  </tr>
</table>


    <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
   <tbody>
   <tr>
			 
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span > Plan Name  </span>
                 </strong></td>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;" >
                  <strong><span>Maximum Persons</span>
                 </strong></td>
              <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span > Status </span>
                 </strong></td>

    <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;"><strong>Action </strong></td>
              
          </tr>
   	<?php if(isset($units)){if($units!=''){ for($i=0; $i<count($units); $i++){?>
               
             <tr>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span ><a href="<?php echo WEB_URL_ADMIN?>supplier/view_unit_details/<?php echo $units[$i]->sup_apart_category_id;?>/1"><strong><?php echo $units[$i]->category_name;?></strong></a></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                  <span><?php echo $units[$i]->normal_persons;?></span>
                </td>
                <td align="center" style="border-bottom:1px solid #dcdcdc;">
                    <span ><?php if($units[$i]->status == 1){?><a href="<?php echo WEB_URL_ADMIN?>supplier/cat_status/<?php echo $units[$i]->sup_apart_category_id;?>/<?php echo $units[$i]->status?>"><img src="<?php echo WEB_DIR_ADMIN?>/images/activate_icon.png" title="click to activate"width="20" height="20"></a><?php }else{?><a href="<?php echo WEB_URL_ADMIN?>supplier/cat_status/<?php echo $units[$i]->sup_apart_category_id?>/<?php echo $units[$i]->status?>"><img src="<?php echo WEB_DIR_ADMIN?>/images/deactivate_icon.png" title="click to deactivate" width="20" height="20"></a><?php }?></span>
                </td>
               
                
               
                <td align="center" style="border-bottom:1px solid #dcdcdc;"><a href="<?php echo WEB_URL_ADMIN?>supplier/delete_unit/<?php echo $units[$i]->sup_apart_category_id;?>"  onclick="return confirm('Are you sure want to delete this user?')"><img src="<?php echo WEB_DIR?>supplier_includes/images/delete.png" alt=" Delete" title=" Delete" /></a></td>
            </tr>
        <?php }}}?>  
        </tbody>
    </table>
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