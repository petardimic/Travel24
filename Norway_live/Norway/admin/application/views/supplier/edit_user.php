
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
         <div class="headersuplr_new1">Edit User<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
 <form method="post" id="add_user" name="add_user" action="<?php echo WEB_URL_ADMIN?>supplier/update_user_perm/<?php echo $manage->manage_users_id?>">

    
	<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >First Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="fname" id="fname" class="getfields" style="width:350px;" type="text" value="<?php if(isset($manage)){if($manage != ''){echo $manage->fname;}}?>">
						<br/><span id="fname_err"></span>
                </td>
            </tr>
            
			 <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Last Name:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="lname" id="lname" class="getfields" style="width:350px;" type="text" value="<?php if(isset($manage)){if($manage != ''){echo $manage->lname;}}?>">
						<br/><span id="lname_err"></span>
                </td>
            </tr>
           <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >PIN:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="pincode" id="pincode" class="getfields" style="width:350px;" type="text" value="<?php if(isset($manage)){if($manage != ''){echo $manage->pin ;}}?>">
						<br/><span id="pincode_err"></span>
                </td>
            </tr>
          <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Position:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="position" id="position" class="getfields" style="width:350px;" type="text" value="<?php if(isset($manage)){if($manage != ''){echo $manage->position ;}}?>">
						<br/><span id="position_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Username:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="email" id="email" class="getfields" style="width:350px;" type="text" readonly="readonly" value="<?php if(isset($manage)){if($manage != ''){echo $manage->email ;}}?>" >
						<br/><span id="email_err"></span>
                </td>
            </tr>
            <?php /*?><tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Password:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="pwd" id="pwd" class="getfields" style="width:350px;" type="password">
						<br/><span id="pwd_err"></span>
                </td>
            </tr>
            <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Confirm Password:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <input name="cnf_pwd" id="cnf_pwd" class="getfields" style="width:350px;" type="password">
						<br/><span id="cnf_pwd_err"></span>
                </td>
            </tr><?php */?>
             <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span >Properties:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    
                </td>
            </tr>
            <?php $id = $manage->prop;$select = explode(',',$id);?>
            <input type="hidden" name="cnt" value="<?php if(isset($apartment_list)){if($apartment_list !=''){echo count($apartment_list);}}?>"/>
            <?php if(isset($apartment_list)){if($apartment_list != ''){
				$i=0;
				foreach($apartment_list as $row){?>
                <input type="hidden" name="prop_id<?php echo $i;?>" value="<?php echo $row->sup_apart_list_id?>"/>
               <tr>
                <td style="border-bottom:1px solid #dcdcdc;"  width="43%">
                    <span ><?php echo $row->apartment_name;?>:</span>
                </td>
                <td style="border-bottom:1px solid #dcdcdc;">
                    <select name="prop_permision<?php echo $i?>" class="getfields" style="width:350px; height:25px;">
                    <option value="1" <?php  if(in_array($row->sup_apart_list_id,$select)) {?> selected="selected"<?php }?> >Allowed</option>
                    <option value="0" <?php  if(!in_array($row->sup_apart_list_id,$select)) {?> selected="selected"<?php }?> >Not Allowed</option>
                    </select>
						
                </td>
            </tr>
            <?php $i++;}}}?>
            <tr>
				<td colspan="5" align="left" style="border-top:#ccc 1px solid;">
              
				
                <div style="float:right;">
				<input name="apartsubmit" id="apartsubmit" type="submit" value=""  class="login-inner-save" />
                    </div></td>
			</tr>
		</tbody></table>
	
    </form>
	
    </div> </div>
    <div class="fix">
    </div>
    </div>
    
                <!-- Footer -->
</body></html>