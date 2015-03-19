<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "https://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="https://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">

<title>Travelingmart - Detailed Loaction</title>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<link href="<?php echo WEB_DIR_ADMIN?>supplier_includes/css/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo WEB_DIR_ADMIN?>js/jquery.js"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.validate.js" type="text/javascript"></script>
<script src="<?php print WEB_DIR_ADMIN?>js/jquery.watermark.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>js/code_validation.js"></script>
<script type="text/javascript">
$(document).ready(function() 
		{
		$('#location').watermark("Enter Detailed Location");
		$("#interest").watermark("Enter Nearest Interests");
		$("#transport").watermark("Enter Nearest Transport");
		$("#airport").watermark("Enter Nearest Airport");		
});
	
</script>
<link rel="canonical" href="https://www.alessioatzeni.com/wp-content/tutorials/jquery/login-box-modal-dialog-window/index.html" />
 <script src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyDF0Uq19B_mn5qFTN6R-t6tZPi0FcRJbv0"
      type="text/javascript"></script>
   <script type="text/javascript">
    //<![CDATA[
	  var WINDOW_HTML = '<div style="width: 250px;padding-left: 10px;size:8px;">';	
    function load(lat,long) {
      if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map"), { size: new GSize(580,450) });
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
			map.setCenter(new GLatLng(lat,long), 8);
			var marker = new GMarker(new GLatLng(lat,long));
			map.addOverlay(marker);
			GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowHtml(WINDOW_HTML);
			});
			//marker.openInfoWindowHtml(WINDOW_HTML);			
         }
     }
    //]]>
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
</script>
<style type="text/css">

a { 
	text-decoration:none; 
	color:#00c6ff;
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

</style><!--<link href="css/reset.css" rel="stylesheet" type="text/css">-->
<style type="text/css">
td{ vertical-align:top !important; font-size:12px;}
</style>
</head>
<body onload="return load('<?php if(isset($pos)){if($pos!=''){ echo $pos->latitude;}}?>','<?php if(isset($pos)){if($pos!=''){ echo $pos->longitude;}}?>');">
<div class="wrapper">

    <!-- Top navigation bar -->
     <?php $this->load->view('supplier/header');?>
        <!-- Header -->
    <div class="fix"></div>

   
              
 
 <div id="container_warpper" >       
       <div class="leftbtnarea_new" id="sidebar-position">
       <?php  $this->load->view('supplier/leftbar');?>
       </div>
       
       
        <div class="content">
         <div class="headersuplr_new1">Detail Location<span style=" width:20%;float:right; font-size:13px; text-align:right;"><a href="<?php echo WEB_URL_ADMIN?>admin/apart_list" style="font-size:13px; color:#F69F3A;">Go to List</a></span>
        </div>
        <div style="float:left; width:100%;">
    <form name="detailed_location" id="detailed_location" action="<?php echo WEB_URL_ADMIN?>supplier/add_location" method="post">
	<table class="tableStatic" border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
      <input type="hidden" id="location_lat" value="<?php if(isset($pos)){if($pos!=''){ echo $pos->latitude;}}?>"/>
	  <input type="hidden" id="location_long" value="<?php if(isset($pos)){if($pos!=''){ echo $pos->longitude;}}?>"/>     
  <tr>
    <td width="52%"  style="border-bottom:1px solid #dcdcdc;"><span id="ctl00_OptionalLinks_UpdatePanel_xlblLocationDesc">Location (detailed location)</span></td>
    <td width="48%"  style="border-bottom:1px solid #dcdcdc;"><span id="ctl00_OptionalLinks_UpdatePanel_xlblNearestTubeTrainStation">Nearest Airport</span></td>
  </tr>
  <tr>
    <td  style="border-bottom:1px solid #dcdcdc;"><label for="textarea"></label>
      <textarea name="location" id="location" cols="20" rows="5"  class="getfields" style="height:80px;width:340px;"><?php if(isset($loc)){if($loc!=''){echo $loc->location;}}?></textarea>
	  
	  </td>
	  
    <td  style="border-bottom:1px solid #dcdcdc;"><label for="textarea2"></label>
      <textarea name="airport" id="airport" cols="20" rows="5"  class="getfields" style="height:80px;width:315px;"><?php if(isset($loc)){if($loc!=''){echo $loc->nearby_airport;}}?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><span id="ctl00_OptionalLinks_UpdatePanel_xlblNearestAirport">Nearest Public Transport</span></td>
    <td><span id="ctl00_OptionalLinks_UpdatePanel_xlblDirectionProperty">Places of Interest Nearby</span></td>
  </tr>
  <tr>
    <td><label for="textarea3"></label>
      <textarea name="transport" id="transport" cols="20" rows="5"  class="getfields" style="height:80px; width:340px; "><?php if(isset($loc)){if($loc!=''){echo $loc->nearby_transport;}}?></textarea></td>
    <td><label for="textarea4"></label>
      <textarea name="interest" id="interest" cols="20" rows="5"  class="getfields" style="height:80px;width:315px; "><?php if(isset($loc)){if($loc!=''){echo $loc->nearby_placeinterest ;}}?></textarea></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
   <tr>

                <td class="content-heading" style="border-bottom:1px solid #dcdcdc; ">
                    <span >Latitude <?php if(isset($pos)){if($pos!=''){ echo $pos->latitude;}}?>: Longitude   <?php if(isset($pos)){if($pos!=''){ echo $pos->longitude;}}?>
                  <a href="#login-box" class="login-window" style="color:#F69F3A; font-weight:bold; text-decoration:underline;" >Click here to Show Map</a></span>
                </td>
              <td class="content-right-heading" style="border-bottom:1px solid #dcdcdc; text-align:right;">
                <input name="" type="submit" value=""  class="login-inner-save" />
     </td>
          </tr>
                 
        </tbody>
    </table>
    </form>
	
	<div id="login-box" class="login-popup" style="height:auto; background-color:#F4F4F4;">
       <img src="<?php echo WEB_DIR; ?>images/close_pop.png" id="close" onclick="return popup_close();" style="cursor:pointer;" class="btn_close" title="Close Window" alt="Close" />
                <div id="map" style="width: 580px; height: 450px"></div>
		</div>
    </div> </div>
    <div class="fix">
    </div>
    </div></div>
   <!-- <div id="footer">
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