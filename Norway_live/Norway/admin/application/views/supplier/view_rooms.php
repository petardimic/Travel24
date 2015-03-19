<?php
$grouptype = 0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Cache-control" content="no-cache" />
<title>WinWinTrip - Supplier::Room Details</title> 
<link href="<?php echo WEB_DIR?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link rel="stylesheet" href="<?php print WEB_DIR; ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
<link href="<?php print WEB_DIR; ?>css/reset.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/general.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/style-g.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/style-geo.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/style-alex.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/style-p.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/style-s.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/style-jim.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>css/ui-lightness/datepicker-theme.css" rel="stylesheet" type="text/css" />
<link href="<?php print WEB_DIR; ?>js/Tooltip/Tooltip.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>datepickernew/themes/base/jquery.ui.all.css">
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>datepickernew/demos.css">

<script src="<?php print WEB_DIR; ?>js/Tooltip/Tooltip.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery-ui-1.8.18.custom.min.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.selectbox-1.2.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.jcarousel.min.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.cycle.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.cluetip.all.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.jscrollpane.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/script-g.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/script-geo.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/script-alex.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/script-p.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/script-s.js"></script>
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/script-jim.js"></script>
<link type="text/css" href="<?php print WEB_DIR; ?>css/menu.css" rel="stylesheet" />
<script type="text/javascript" src="<?php print WEB_DIR; ?>js/menu.js"></script>
<script src="<?php echo WEB_DIR; ?>datepickernew/jquery-1.7.2.js"></script> 
<script src="<?php echo WEB_DIR; ?>datepickernew/ui/jquery.ui.core.js"></script> 
<script src="<?php echo WEB_DIR; ?>datepickernew/ui/jquery.ui.widget.js"></script> 
<script src="<?php echo WEB_DIR; ?>datepickernew/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo WEB_DIR; ?>js/groupbook_datepicker.js"></script>

                
<!--login pop up-->

<script type="text/javascript">
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
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".tabLink").each(function(){
      $(this).click(function(){
        tabeId = $(this).attr('id');
        $(".tabLink").removeClass("activeLink");
        $(this).addClass("activeLink");
        $(".tabcontent").addClass("hide");
        $("#"+tabeId+"-1").removeClass("hide")   
        return false;	  
      });
    });  
  });
</script>
<link rel="canonical" href="http://www.alessioatzeni.com/wp-content/tutorials/jquery/login-box-modal-dialog-window/index.html" />
<!--login pop up-->
<!--[if lte IE 8]>
<style type="text/css">
.extra:hover b {filter: alpha(opacity=70); filter: progid:DXImageTransform.Microsoft.Alpha(opacity=70);}
</style>
<![endif]-->
  <script type="text/javascript">
function filter_by(value)
{
	document.getElementById("filter").submit();
}
</script>
</head>
<body class='no-cols page-hotels2'>
    <div id="outer-header" >
<div id="header">
	<div id="logo"><a href="#"><img src="<?php print WEB_DIR; ?>images/logo.png" alt="logo" width="292" height="98" border="0" title="logo" /></a></div>
	<div class=" header-first-bar">
		<div style="height:auto; float:right; position:absolute; width:664px;">
        <div id="menu">
     <ul class="menu">
     <li><a href="#"><span>Home</span></a></li>
    <li><a href="#" class="parent"><span>Hotels <img src="<?php print WEB_DIR; ?>images/arrow-icon-g.png" width="9" height="5" style="float:right; position:absolute; top:25px; margin:0 0 0 5px;" /></span></a>
            <div style="left:-90px;"><ul>
                <li><a href="<?php print WEB_URL?>supplier/add_hotels"><span>Add Hotels</span></a></li>
                <li><a href="<?php print WEB_URL?>supplier/view_hotels"><span>View</span></a></li>
            </ul></div>
        </li>
<li><a href="<?php print WEB_URL?>supplier/supplier_group_book"><span>Group Booking</span></a></li>
         
         
        <li><a href="#" class="parent"><span>Settings<img src="<?php print WEB_DIR; ?>images/arrow-icon-g.png" width="9" height="5" style="float:right; position:absolute; top:25px; margin:0 0 0 5px;" /></span> </a>
           <div style="left:-110px;"><ul>
                <li><a href="#"><span>Change Password</span></a></li>
                <li><a href="<?php print WEB_URL?>supplier/update_profile"><span>Update Profile</span></a></li>
               
            </ul></div>
        </li>
    </ul>
	<div id="login-box" class="login-popup">
        <a href="#" class="close"><img src="<?php echo WEB_DIR?>images/close_pop.png" class="btn_close" title="Close Window" alt="Close" /></a>
         
	<form name="agent_login" id="agent_login" method="post" class="signin" action="<?php print WEB_URL?>/supplier/login_check">
                <fieldset class="textbox">
            	<label class="username">
                <span>Username </span>
                <input id="username" name="username" value="" type="text" autocomplete="on" placeholder="Username">
                </label>
                
                <label class="password">
                <span>Password</span>
                <input id="password" name="password" value="" type="password" placeholder="Password">
                </label>
		<label class="username"><input type="radio" name="radio1" checked="checked" value="Supplier"/>Login as Supplier</label>
		<label class="username"><input type="radio" name="radio1" value="Agent" />Login as Agent</label>
                <input type="submit" name="submit" value="submit">
                
                <p>
		<!-- <a class="forgot" href="<?php echo WEB_URL?>/welcome/forgot_pass">forgot password</a> -->&nbsp;<a class="forgot" href="<?php echo WEB_URL?>/welcome/agent_reg">newuser</a>
   
                </p>
                
                </fieldset>
          </form>
		</div>
    <div id="copyright" style="display:none; visibility:hidden;"><a href="http://apycom.com/"></a></div>
</div>
        </div>
        <div class="clr1" style="height:75px;"></div>
        <div class="customer-support">
        <div class="phone">Call us to book !</div> <div class="nember">1 - 222 - 333 - 4444</div>
        </div>
	</div>
    <div class="clr"></div>
    
    <!--<div id="main-menu">
            	<ul>
                	<li class="flights "><a href="#">Flight </a></li>
                    <li class="hotels "><a href="#">Hotel  </a></li>
                    <li class="apartments"><a href="#">Apartments</a></li>
                    <li class="cars "><a href="#">Cars </a></li>
                    <li class="activities"><a href="#">Activities</a></li>
                    <li class="packages "><a href="#">Packages</a></li>
                    <li class="flash "><a href="#"> Flash Sales</a></li>
                    <li class="rewards "><a href="#">Rewards</a></li>
                </ul>
            </div>--><!-- #main-menu -->
             <div class="clr"></div>
             <?php if($supplier_info !='') 
			{ 
				foreach($supplier_info as $supplier)
				{
					$last_login=$supplier->last_login;
					$name=$supplier->first_name." ".$supplier->middle_name;
				}
			} 
			else
			{
				$last_login='';
				$name='';
			} ?>
             <div style=" clear:both; padding-top:8px; color:#000; text-align:right; width:989px; font-size:18px;">Welcome , <?php echo $name; ?>  |  Last login : <?php echo $last_login; ?>  |  <a href="<?php print WEB_URL?>supplier/supplier_logout">Log out</a></div>
</div>
</div><!--header-->
  
         <div class="content-box" style="clear:both; height:auto; overflow:hidden; margin:0px; padding:0px;">
         <div style="width:1000px; height:auto; overflow:hidden;  margin:auto">
         <table width="980" border="0" align="left" cellpadding="0" cellspacing="0" class="menutwo" style=" color:#FFF; font-family:Arial, Helvetica, sans-serif; font-size:12px; border:1px solid #CCC; margin:20px 0 50px 10px;">
     
<tr style="background-color:#a64003; height:30px;">
  
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Room Id</b></td>
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; "><b>Room Type Name</b></td> 
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Room Rate</b></td>            
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Existing Beds</b></td>
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Extra Beds</b></td>
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Room Features</b></td>
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Status</b></td>
   <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px;"><b>Action</b></td>
    </tr>
      <?php
	  if(isset($room_det_all)){ if($room_det_all != '') {
		//  echo "<pre>";print_r($room_det_all);exit;
	   foreach ($room_det_all as $row){ ?>
          <tr style="height:30px; background:#fbf7f7; font-family:calibri; font-size:13px; ">
    
          <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php print $row->room_id; ?></td>
       <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $row->room_type_name;?></td>
	<td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $row->room_rate;?></td>
	
        <td align="center" valign="middle"  style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $row->existing_beds;?></td>      
	      
      <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><?php echo $row->extra_beds;?></td>
	<td align="center" valign="middle"  style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL?>supplier/room_facilities/<?php echo $row->rid; ?>">Room Features</a></td>
         <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><a href="<?php print WEB_URL.'supplier/edit_status_room/'.$row->rid.'/'.$row->rstatus; ?>"><?php if($row->rstatus=='Active'){?><img src="<?php echo WEB_DIR ?>images/activate_icon.png" /><?php }else {?><img src="<?php echo WEB_DIR ?>images/deactivate_icon.png" /><?php }?></a></td>  
	    <td align="center" valign="middle" style="border-right:1px solid #FFF; padding:0 5px 0 5px; color:#333; "><a href=<?php print WEB_URL."supplier/edit_room/".$row->room_id;?> class="add_update_link"><img src="<?php echo WEB_DIR ?>images/edit_icon.jpg" /> </a><a href=<?php print WEB_URL ."supplier/delete_room_details/".$row->rid."/".$row->hotel_id;?> class="add_update_link"><img src="<?php echo WEB_DIR ?>images/delete1.png" /></a></td>
          </tr>
          <?php
	  }}}else{
	   echo "No Rooms Avaialble";}?>
</table>
</div>
         </div>
           <!-- #content box-->
           <div class="bottom-curve"></div>
       <div style="height:30px; clear:both;">&nbsp;</div>
     <!--content-container-->
 </div> <!-- #outer-content -->
<div id="outer-footer">
    <div id="footer">
        
        <div class="footer-newsletter">
        	<form action="form_action.php" method="get">
                <div>
                	<div class="form-components">
                    	<div><label for="newsletter">Newsletter Sign Up</label></div>
                        <div><input type="text" name="newsltr" id="newsletter" value="type your email in here"/></div>
                    </div>
                    <div class="button-wrapper">
                        <div><input type="submit" value="" /></div>
                    </div>
                </div>
            </form>
        </div><!-- .footer-newsletter -->
		<div class="footer-banner-region">
        <div class="footer-right-top-banner"></div>
        </div><!-- .footer-banner-region -->        
        <div class="footer-main-menu">
         <div class="lang-label">About Us :</div><br />
        	<ul>
            	<li class="first "><a href="#">Group2Free </a></li>
                <li class=""><a href="#">Privacy </a></li>
                <li class=""><a href="#">Travel Blog</a></li>
                <li><a href="#">Press Room</a></li>
                <li><a href="#">Career</a></li>
                <li  class="last"><a href="#"> Sitemap</a></li>
            </ul>
        </div><!-- .footer-main-menu -->
        <div class="footer-languages">
        	<div class="lang-label">For You : </div><br />

            <div class="lang-flags">
            	<ul>
                	<li><a "#" style="width:140px;">Brand Advertisers</a></li>
                    <li ><a "#">Hoteliers</a></li>
                    <li><a href="#"> Affiliates</a></li>
                    <li ><a href="#"> Rewards</a></li>
                    <li ><a href="#" style="width:140px;"> Worldwide Hotels</a></li>
                    <li ><a href="#">Direct Offers</a></li>
                    <li ><a href="#"> 24/7 Help</a></li>
                    <li ><a href="#"> Terms Of Use</a></li>
					<li ><a href="#"> Feedback</a></li>
                </ul>
            </div>
        </div><!-- .footer-for you -->
        <div class="footer-languages">
        	<div class="lang-label">language : </div><br />

            <div class="lang-flags">
            	<ul>
                	<li><a "#">English </a></li>
                    <li ><a "#">Deutsch  </a></li>
                    <li><a href="#"> Nederlands  </a></li>
                    <li ><a href="#">Français </a></li>
                    <li ><a href="#">Español </a></li>
                    <li ><a href="#">Čeština  </a></li>
                    <li ><a href="#">Italiano</a></li>
                    <li ><a href="#">Português </a></li>
                    
                      <li ><a href="#">Norsk </a></li>
                       <li ><a href="#"> Svenska</a></li>
                        <li ><a href="#">Dansk  </a></li>
                         <li ><a href="#">Română </a></li>
                         <li><a href="#">لعربية  </a> </li>
                         <li><a href="#"> Polski</a></li>
                         <li><a href="#">Ελληνικά </a></li>
                         <li ><a href="#"> Русский  </a></li>
 						<li><a href="#">Türkçe </a></li>
                        <li><a href="#">Català</a>
                         <li style="width:140px;"><a href="#">Português Brasileiro  </a></li>
                </ul>
            </div>
        </div><!-- .footer-languages -->
        <div class="footer-log-menu">
            <ul>
                <li class="first"><a href="#">© 2012 All Rights Reserved.</a></li><span style="float:right; font-size:11px; color:#999;">Powered By PROVAB</span>
            </ul>
        </div><!-- .footer-log-menu -->
    </div><!-- #footer -->
</div><!-- #outer-footer -->


</body>
</html>
