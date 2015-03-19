<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="bpp0ROCVS3LPbXjA1yFatlXcJXu8PHHlhKPqCAgvyAk" />
<title>Cheap hotels, hotels in,Luxury hotels,Best hotels in | Travellingmart</title>

<meta name="description" content="hotels in Bangalore,hotels in Bahrain,hotels in Vlore,hotels in Durres,hotels in Tirana,hotels in Perth,hotels in Brasilia,hotels in Toronto,hotels in Dublin,hotels in Boston,hotels in Auckland,Hotels in Dubai,Hotels in Saudi Arabia">

<meta name="keywords" content="best luxury hotels in oman,hotels in Bahrain,best hotels in Dubai,discount hotel in iraq,Luxury hotels in Saudi Arabia,the best cheapest hotel in iran,best 7 star hotels in saudi,hotels in Iran,hotels in Iraq,hotels in Bangalore, hotels in India,hotels in Perth">

<meta name="robots" content="index,follow">
<?php if($api == 'hotelspro')
		{
			$hotel_det = $this->Home_Model->get_hotel_dethp($hotel_code);
			$hotel_desc = $this->Home_Model->get_hotel_desc($hotel_code);
			$rooms = $this->Home_Model->get_rooms($hotel_code,$sec_id);
		}
		else
		{
			$hotel_det = $this->Home_Model->get_hotel_det($HotelSearchCode,$hid);
 			$hotel_images = $this->Home_Model->hotel_images($hid);
			$rooms = $this->Home_Model->get_rooms($hid,$sec_id);
		}?>
<body class="body-visible" onload="return load('<?php echo $hotel_det->Latitude?>','<?php echo $hotel_det->Longitude?>');">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44964359-1']);
  _gaq.push(['_setDomainName', 'travellingmart.com']);
  _gaq.push(['_setAllowLinker', true]);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://' : 'http://') + 'stats.g.doubleclick.net/dc.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

 <script src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyDF0Uq19B_mn5qFTN6R-t6tZPi0FcRJbv0"
      type="text/javascript"></script>
     
    <script type="text/javascript">
    //<![CDATA[
	  var WINDOW_HTML = '<div style="width: 250px;padding-left: 10px;size:8px;">';	
    function load(lat,long) {
	
  
      if (GBrowserIsCompatible()) {
			var map = new GMap2(document.getElementById("map_div"), { size: new GSize(960,328) });
			map.addControl(new GSmallMapControl());
			map.addControl(new GMapTypeControl());
			map.setCenter(new GLatLng(lat,long), 18);
			var marker = new GMarker(new GLatLng(lat,long));
			

			//marker.setContent(100);
			map.addOverlay(marker);
			GEvent.addListener(marker, "click", function() {
				marker.openInfoWindowHtml(WINDOW_HTML);
			
			marker.openInfoWindowHtml('<span style="color:#E62424; font-size:16px; float:left;"><?php echo $hotel_det->HotelName?></span><br/><span style="color:#E62424; float:left; font-size:14px;padding-left:4px;"><?php echo $hotel_det->Address?></span><br/><span style="color:#E62424; float:left; font-size:14px; padding-left:4px;"><?php echo $hotel_det->Phone?></span>');
			
		});	
         }
     }
	 </script>
 <?php /*?><ul id="exampleMenu">
            <li ><a href="<?php echo WEB_URL ?>home/index">Home</a></li>
            
        </ul><?php */?>
<!--header-->

<?php if($this->session->userdata('memid') != '')
		{
			$this->load->view('member/header'); 
		}
		else
		{
			$this->load->view('header'); 
		}?>

<!--header-->



<!--main-->
<div class="wrapper">
<div style="margin:auto; width:1000px; height:auto;">

<div class="main">
 
 
<div class="rollover" style="margin:25px 0px 5px 50px; font-size:13px; color:#e62424;"><a href="<?php echo WEB_URL ?>home/index">Home</a>&nbsp; > &nbsp;<a href="<?php echo WEB_URL ?>home/hotel_search">Hotel Search</a> &nbsp;>&nbsp; Hotels in <?php echo $this->session->userdata('disp_city'); ?></div>

 

<!--rigtside-->
 
 

 
    
      <p id="MapLatitude" style="display:none !important;"><?php echo $hotel_det->Latitude ?></p>
<p id="MapLongitude" style="display:none !important;"><?php echo $hotel_det->Longitude?></p>
    
     <div class="right_search_result1" style="float:left; margin-left:30px; margin-top:0px; width:993px;">
    <div>
   <div class="left_part_fiiglt1" style="width:970px; color:#e62424; height:auto; line-height:20px;">
   <?php  if($hotel_det->HotelName != '') { echo $hotel_det->HotelName; } ?><br />
<span style="color:#333; font-weight:normal; font-size:12px;"><?php if($api == 'hotelspro')
		  {
			  echo $hotel_det->HotelAddress;
		  }
		  else {  if($hotel_det->Address != '') { echo $hotel_det->Address; } }?> </span>
<span style="float:right;">

 </span>
</div>
   
   <!--left_part_fiiglt-->
   
   <div class="links3" >
   <ul>
   <li><a href="#DESCRIPTION">DESCRIPTION</a></li>
   <li><a href="#FACILITIES">FACILITIES</a></li>
   <li><a href="#LOCATION">LOCATION</a></li>
   <li><a href="#REVIEWS">REVIEWS</a></li>

   
   </ul>
   </div>
   
   
</div>
   <div style="clear:both;"></div><!--prv_next-->

    
 
    
    <div class="search_result1" style="width:978px;"><!--six_tab-->
   
    <div class="flight_resutl_full"  style="width:978px;">
    
   <!--flight_result--> <a name="REVIEWS" id="DESCRIPTION"></a>
   <div class="hotel_result1"  style="width:978px; font-size:12px;">
     <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="15">&nbsp;</td>
      <td width="100" align="left" valign="top">
      <?php if($api == 'hotelspro') { ?>
      <a href="#"><img src="<?php echo $hotel_det->HotelImages1;  ?>" border="0"  width="367" height="281" style="border-radius:7px;"/></a>
      <?php } else { ?>
      <a href="#"><img src="<?php echo $hotel_images[0]->picts;  ?>" border="0"  width="367" height="281" style="border-radius:7px;"/></a>
      <?php } ?></td>
      
      <td width="20" align="right" valign="middle" >&nbsp;</td>
      <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td height="23" valign="top" style="line-height:18px; color:#333; font-weight:bold; font-size:14px;"><?php if($hotel_det->HotelName != '') { echo $hotel_det->HotelName; } ?></td>
        </tr>
        <tr>
          <td style="line-height:18px; color:#666;"> </td>
        </tr>
        <tr>
          <td height="10"> </td>
        </tr>
        
        <tr>
          <td>
          
          <?php  if($api == 'hotelspro') { 
		  ?>
         
          <span style="margin:5px 8px 0px 0px; float:left;"><a href="#"><img src="<?php echo $hotel_det->HotelImages1; ?>" id="ghoda1" border="0" width="75" height="75" style="border-radius:7px;"/></a></span>
          <span style="margin:5px 8px 0px 0px; float:left;"><a href="#"><img src="<?php echo $hotel_det->HotelImages2; ?>" id="ghoda2" border="0" width="75" height="75" style="border-radius:7px;"/></a></span>
          <span style="margin:5px 8px 0px 0px; float:left;"><a href="#"><img src="<?php echo $hotel_det->HotelImages3; ?>" id="ghoda2" border="0" width="75" height="75" style="border-radius:7px;"/></a></span>
         
		  <?php } else { $d = 1; if(isset($hotel_images)) { if($hotel_images != '') { foreach($hotel_images as $imgs) { ?>
          
          <style type="text/css">
      /* HOVER STYLES */
      div#pappu<?php echo $d;?> {
        display: none;
        position:absolute;
		margin:3px 0px 0px -400px;
        width: auto;
        padding: 5px;
        background: #ffe0bb;
        color: #000000;
        border: 1px solid #f8a848;
        font-size: 90%;
		z-index: 10000;
		font-weight:bold;
      }
      </style>
		 <script type="text/javascript">
      $(function() {
        var moveLeft = 152;
        var moveDown = 10;
        
        $('#ghoda<?php echo $d;?>').hover(function(e) {
          $('div#pappu<?php echo $d;?>').show();
          
        }, function() {
          $('div#pappu<?php echo $d;?>').hide();
        });
        
        $('#ghoda<?php echo $d;?>').mousemove(function(e) {
          $("div#pappu<?php echo $d;?>").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });
		
	});
      
    </script>
          <span style="margin:5px 8px 0px 0px; float:left;"><a href="#"><img src="<?php echo $imgs->picts; ?>" id="ghoda<?php echo $d;?>" border="0" width="75" height="75" style="border-radius:7px;"/></a></span>
          <div id="pappu<?php echo $d?>">
                <img src="<?php echo $imgs->picts; ?>" width="350"  height="280" style="border-radius:3px; margin-left:3px; margin-top:3px;" />
                </div>
          <?php $d++; } } } }?>
         
          </td>
        </tr>
      </table></td>
      <!--rate part plus book button-->     <!--rate part plus book button--> 
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" align="left" valign="top">&nbsp;</td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" align="left" valign="top"><span class="flight_resutl_full" style="width:955px; text-align:justify; line-height:19px; padding-right:20px;">
       
   
   <?php   if($api == 'hotelspro') { echo $hotel_desc->HotelInfo;  } else { if($hotel_det->Description != '') { echo $hotel_det->Description; } } ?>
   
      </span></td>
    </tr>
    
    </table>
   
 </div>
    
    
 
 <div class="hotel_result1"  style="width:978px; font-size:12px; padding:0px;">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="links4" >
      <ul>
        <li style="border-radius:5px 0px 0px 0px; width:42px;">Photos</li>
        <li style="width:142px; text-align:center;">Room Type</li>
        <li style="width:92px; text-align:center;">Inclusion</li>
        <li style="width:42px; text-align:center;">Status</li>
        <li style="width:60px; text-align:center;">Total Price</li>
        <!--<li>No of Units</li>-->
        <li style="width:66px; border-radius:0px 5px 0px 0px; text-align:center;">Select</li>
      </ul>
    </div></td>
  </tr>
 <?php //if($api == 'hotelspro') { ?>
 <?php //} else { ?>
  <?php $i=0;
  		if(isset($rooms)) { if($rooms != '') { foreach($rooms as $rom) { ?>
  
   <script type="text/javascript">
  function show_det<?php echo $i; ?>()
  {
	  $("#show_detshow<?php echo $i; ?>").toggle('slow');
	  var hotel_search = $("#hotel_search_code<?php echo $i; ?>").val();
	  //alert(hotel_search);
	   $.ajax
	   ({
			type: "POST",
			url: "<?php echo WEB_URL?>home/cancelation_policy",
			data: "hotel_search="+hotel_search,
			success: function(msg)
			{
			 	$("#show_detshow<?php echo $i; ?>").html(msg);
			}
		 });
				 
				 
  }
  
 function show_dethp<?php echo $i; ?>(result_id)
  {
	  $("#show_detshow<?php echo $i; ?>").toggle('slow');
	  //var result_id = $("#result_id<?php echo $i; ?>").val();
	 // alert(result_id);
	   $.ajax
	   ({
			type: "POST",
			url: "<?php echo WEB_URL?>home/cancelation_policyhp",
			data: "result_id="+result_id,
			success: function(msg)
			{
			 	$("#show_detshow<?php echo $i; ?>").html(msg);
			}
		 });
				 
				 
  }
  </script>
  
   <script type="text/javascript">
      $(function() {
		
		var hotel_search = $("#hotel_search_code<?php echo $i; ?>").val();
        var moveLeft = 20;
        var moveDown = 10;
      //  alert(hotel_search);
        $('a#trigger').hover(function(e) {
         // $('div#pop-up').show();
           $.ajax
			   ({
					type: "POST",
					url: "<?php echo WEB_URL?>home/price_breakdown",
					data: "hotel_search="+hotel_search,
					success: function(msg)
					{
						//$("#show_det<?php echo $i; ?>").html(msg);
						$('div#pop-up').show(msg);
					}
				 });
        }, function() {
          $('div#pop-up').hide();
        });
        
        $('a#trigger').mousemove(function(e) {
          $("div#pop-up").css('top', e.pageY + moveDown).css('left', e.pageX + moveLeft);
        });
        
      });
    </script>
    <style>
#pop-up {
        display: none;
        position: absolute;
        width: 280px;
        padding: 10px;
        background:#F3F8FA;
        color: #000000;
        border: 1px solid #1C9BD1;
        font-size: 12px;
		font-weight:normal;
		text-align:left;
}
</style>



  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="128" align="center" style="border-right:1px #CCC solid; border-bottom:1px #CCC solid;"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center">
            <?php  if($api == 'hotelspro') {  ?>
            <img src="<?php echo $hotel_det->HotelImages2;  ?>" border="0" width="120"  style="padding:5px; border-radius:5px;"/>
            <?php } else { ?>
            <a href="#"><img src="<?php echo $hotel_images[0]->picts;  ?>" border="0" width="120"  style="padding:5px; border-radius:5px;"/></a>
            <?php } ?></td>
          </tr>
          <tr>
            <td align="center">
            <?php  if($api == 'hotelspro') {  ?>
            <span style="background-color: #000000; color: #FFFFFF; cursor: pointer; margin: -22px 0 0; padding: 2px; position: relative; top: -22px; width: 111px;"  onclick="show_dethp<?php echo $i; ?>(<?php echo $rom->result_id; ?>);">+ Cance. Details</span>
            <?php } else { ?><span style="background-color: #000000; color: #FFFFFF; cursor: pointer; margin: -22px 0 0; padding: 2px; position: relative; top: -22px; width: 111px;"  onclick="show_det<?php echo $i; ?>();">+ Cance. Details</span>
            <?php } ?></td>
            <input type="hidden" value="<?php echo $rom->HotelSearchCode; ?>" name="hotel_search_code<?php echo $i; ?>" id="hotel_search_code<?php echo $i; ?>"  />
            <input type="hidden" value="<?php echo $rom->result_id; ?>" name="result_id<?php echo $i; ?>" id="result_id<?php echo $i; ?>"  />
          </tr>
        </table>          <a href="#"></a></td>
        <td width="230" align="center" style="border-right:1px #CCC solid; border-bottom:1px #CCC solid;"><?php echo $rom->room_type; ?><br />
          <!--Non-Refundable--></td>
        <td width="180" align="center" style="border-right:1px #CCC solid; border-bottom:1px #CCC solid;"><?php  if($api == 'hotelspro') { echo $rom->inclusion; } else { 
			
			if($rom->plan_type =='BB')
			{
				echo "BED AND BREAKFAST";
			}
			else if($rom->plan_type =='HB')
			{
				echo "HALF-BOARD";
			}
			else if($rom->plan_type =='FB')
			{
				echo "FULL-BOARD";
			}
			else if($rom->plan_type =='RO')
			{
				echo "ROOM ONLY";
			}
			else if($rom->plan_type =='CB')
			{
				echo "CONTINENTAL BREAKFAST";
			}
			else if($rom->plan_type =='AI')
			{
				echo "ALL-INCLUSIVE";
			}
			else if($rom->plan_type =='BD')
			{
				echo "BED AND DINNER";
			}
			 }?></td>
        <td width="130" align="center" style="border-right:1px #CCC solid; border-bottom:1px #CCC solid;"><?php echo $rom->status; ?></td>
        <td width="148" align="center" style="border-right:1px #CCC solid; border-bottom:1px #CCC solid; font-weight:bold; font-size:16px; color:#e62424;" > <!--<a  id="trigger">-->
		<?php if($new_cost !=''){
		echo $this->session->userdata('host_currencyCode').' '.round($new_cost * $rom->nightperroom);
		}else{?>
		
		<?php echo round($rom->nightperroom); ?> <?php echo $rom->cost_type; ?>
        <?php }?>
        
        
       
     </td>
       
        <td align="center"  style=" border-bottom:1px #CCC solid;  ">
        <?php  if($api == 'hotelspro') {  ?>
        <a href="<?php echo WEB_URL ?>home/reservation_fromhp/<?php echo $rom->result_id; ?>"><img src="<?php print WEB_DIR ?>images/book.png" border="0" /></a>
        <?php } else { ?>
        
        <a href="<?php echo WEB_URL ?>home/reservation_from/<?php echo $rom->result_id; ?>"><img src="<?php print WEB_DIR ?>images/book.png" border="0" /></a>
        
        <?php } ?>
        </td>
      </tr>
    </table></td>
  </tr>
  <tr id="show_detshow<?php echo $i; ?>" >
   
  </tr>
  <?php   $i++; } ?>
  <?php } } //} ?>
  <tr style="display:none;">
    <td>&nbsp;</td>
  </tr>
    </table>

    
   
   </div>
 
 
 
 
 
 <a name="REVIEWS" id="FACILITIES"></a>
<div class="hotel_result1"  style="width:978px; font-size:12px; padding:0px;">
  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="links4" >
      <ul>
        <li style="border-radius:5px 5px 0px 0px; width:918px; padding-left:15px; font-size:14px;">Facilities</li>
        
      </ul>
    </div></td>
  </tr>
 <?php  if($api == 'hotelspro') { 
		//echo $hotel_code;
 	$facii = $this->Home_Model->get_hotel_facilities($hotel_code);
	 $faci = explode(';',$facii->PAmenities);
	 $faci2 = explode(';',$facii->RAmenities);
	
  } else { $faci = explode(',',$hotel_det->HotelFacilities);
 $faci2 = explode(',',$hotel_det->RoomFacilities); }
   ?>
  
  <tr >
    <td><table width="98%" border="0" align="left" cellpadding="5" cellspacing="0" style="padding-left:10px; color:#333;">
      <tr >
      
      <?php if($faci != ''){
		  $t = 0;
		  foreach($faci as $f){?>
        <td width="300" height="30" style="border-bottom:1px #bfbfbf dashed; padding-bottom:5px; line-height:18px;"><?php echo $f?></td>
        <?Php $t++;
		if($t%3 == 0)
		{
			echo '</tr><tr>';
		}}}?>
        
         <?php if($faci2 != ''){
		  $t = 0;
		  foreach($faci2 as $f2){?>
        <td width="300" height="30" style="border-bottom:1px #bfbfbf dashed; padding-bottom:5px; line-height:18px;"><?php echo $f2?></td>
        <?Php $t++;
		if($t%3 == 0)
		{
			echo '</tr><tr>';
		}}}?>
        
     
        
      </tr></table>
 
 
 </td>
 </tr>
 </table>
 </div>
 
 
 
 <a name="REVIEWS" id="LOCATION"></a>
 
 
 <div class="hotel_result1"  style="width:978px; font-size:12px; padding:0px;">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="links4" >
      <ul>
        <li style="border-radius:5px 5px 0px 0px; width:918px; padding-left:15px; font-size:14px;">Location</li>
        
      </ul>
    </div></td>
  </tr>
 
  
  <tr >
    <td >
    
   
   <div id="map_div" style="padding:5px 5px 0px 5px; background-color:#FFF; width:960px; height:320px;"></div></td>
  </tr>
  <tr >
    <td>&nbsp;</td>
  </tr>
  
  <tr style="display:none;">
    <td>&nbsp;</td>
  </tr>
    </table>

    
   
   </div>
 
   
   
   
   
   
   
   
   
   
   <a name="REVIEWS" id="REVIEWS"></a>
   
   <?php if($api == 'hotelspro') {  } else { ?>
   <div class="hotel_result1"  style="width:978px; font-size:12px; padding:0px;">
    
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="links4" >
      <ul>
        <li style="border-radius:5px 5px 0px 0px; width:918px; padding-left:15px; font-size:14px;">Reviews</li>
      </ul>
    </div></td>
  </tr>
  <tr >
    <td><table width="98%" border="0" align="left" cellpadding="5" cellspacing="0" style="padding-left:10px; color:#333;">
     
      <tr >
        <td colspan="2" style="border-bottom:1px #bfbfbf dashed; padding-bottom:5px; padding-top; line-height:18px;"><iframe src="<?php echo $rooms[0]->Reviews; ?>" width="960"  height="auto" style="height:auto; min-height:500px;"></iframe>
          <div></div>          
          <strong> </strong></td>
      </tr>
      </table></td>
  </tr>
  <tr style="display:none;">
    <td>&nbsp;</td>
  </tr>
    </table>

    
   
   </div>
   <?php } ?>
   
  </div> 

 


  
  
  
   
  
   
  
   

</div><!--search_result-->
</div>   

 
  




<!--rigtside-->

 
</div>

</div>


<!--main-->

<?php /*?><div style="float:left; margin-top:20px;  "><?php $this->load->view('right_banner'); ?></div><?php */?>

</div>






 <!--footer-->
    
	<?php $this->load->view('footer'); ?>
	
    
    <!--footer-->

</body>
</html>
