
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title> List Holiday Destinations</title>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_two.css" rel="stylesheet" />

<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR?>supplier_includes/css/light-box.css"></script> 
<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery.js"></script>
<script src="<?php print WEB_DIR?>js/jquery.validate.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/cruise_validation.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR?>/js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>/autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />




<!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body>


    <!-- Top navigation bar -->
      <?php $this->load->view('header2');?>
        <!-- Header -->
    <div class="fix"></div>

    <div id="sidebar-position" style="position:absolute; margin-top:20px;">
    <?php  $this->load->view('package_leftbar');?>
    </div><!--sidebar-position-->
    <!-- Content wrapper -->
    <div class="wrapper">
        <!-- Content -->
        <div class="content">
            <!-- Dynamic table -->
            <div class="table" style="margin-top:20px;">
                <div id="HeaderNav_title">
                    <div class="fixed_HeadNav_title" style="position:absolute;">
					 
                        <div class="title">
                            <h5>
                                <span id="ctl00_xlblPageName" style="width:80%; float:left; display:block;">List Holidays Destinations</span>
                                <span style=" width:20%; display:block; float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/list_excursion" style="font-size:13px; color:#fff;">Go to List</a></span></h5>
                        </div>
                    </div>
                </div>
                <div style="margin-top: 5px; margin-bottom: 10px;" align="right">
                    
                    
                </div>
                
    
            

 			 <table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
         <tr>
          <td colspan="13" align="right" class="add-your-property" style="border-bottom:1px solid #dcdcdc;"><a href="<?php echo WEB_URL_ADMIN ?>admin/add_holiday_destination/<?php echo $ex_id; ?>"/>Add Destination</a></td>
          </tr>
          <tr>
          <td colspan="13" align="center" height="30" class="add-your-property" style="border-bottom:1px solid #dcdcdc; font-weight:bold; font-size:18px; color:#800000">Destinations Available for <?php echo $ex_det->ex_name; ?></td>
          </tr>
               <tr>
                <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Sl No </span>
                 </strong></td>
                
				<td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Destination Name  </span>
                 </strong></td>
                 
                   
                 
                 
                   
                  <td align="center" class="inner-span-heading1" style="border-bottom:1px solid #dcdcdc;">
                    <strong><span >Delete</span>
                 </strong></td>
            </tr>
             <?php
			
			 $m = 1;
				if(isset($dest)){ if($dest != '') { ?>
					 
					  <?php foreach ($dest as $row){ ?>
                      <tr>
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span ><?php echo $m; ?></span>
                            </td>
                         
                            <td align="center" style="border-bottom:1px solid #dcdcdc;">
                              <span><?php echo $row->destination_name; ?></span>
                            </td>
                            
                            
                            
                                                        
                                                       
                             <td align="center" style="border-bottom:1px solid #dcdcdc;">
                                 <?php  if($this->session->userdata('new_user_id')) {?>
                              
                             <span> - </span>
                           
                              <?php }else{?>
                              <span><a href="<?php print WEB_URL_ADMIN ?>admin/delete_holiday_destination/<?php echo $row->id; ?>/<?php echo $row->ex_id; ?>" ><img src="<?php echo WEB_DIR?>supplier_includes/images/delete.png" alt=" Delete" title=" Delete" onclick="return confirm('Are you sure want to delete this Package?')"  /></a></span>
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
<script type="text/javascript">
function check_login(email)
{
		$.post("<?php echo WEB_URL?>supplier/confirm_sup_user",{'user':email},function(data){
		if(data == 1)
		{
			document.getElementById('email_err').innerHTML="<font color=red>Email already exist</font>";
			document.getElementById("email").value = '';
			document.getElementById("email").focus();
		}
		else
		{
			document.getElementById('email_err').innerHTML="";
		}
		});
	//}
}
</script>
