<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="google-site-verification" content="bpp0ROCVS3LPbXjA1yFatlXcJXu8PHHlhKPqCAgvyAk" />
<title>travellingmart ! Luxury hotels and resorts,cheap hotel rooms,book hotels online</title>

<meta name="description" content="Travellingmart for Best hotels & resorts in dubai,cheap accommodation in oman,Top hotels in qatar,best resorts in oman & bahrain,best luxury hotels in iraq,Spa luxury hotels in qatar">

<meta name="keywords" content="budget hotels in iran,the best cheapest hotel in dubai,the best 7 star hotels in saudi arabia,the best luxury hotels in oman,Nice hotels in iraq, special rate hotels in bahrain,5 star hotels in oman,best small hotels in saudi">

<meta name="robots" content="index,follow">

<body class="body-visible">

<!--<script type="text/javascript">

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

</script>-->
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

<script type="text/javascript" src="<?php echo WEB_DIR?>js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>Validation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo WEB_DIR?>Validation/js/languages/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" href="<?php echo WEB_DIR?>Validation/css/validationEngine.jquery.css" media="all" type="text/css" />

<!--main-->
<div class="wrapper">

<div style="margin:auto; width:1000px; height:auto;">
<div class="main">
 
 
<div class="rollover" style="margin:25px 0px 5px 50px; font-size:13px; color:#e62424;"><a href="<?php echo WEB_URL ?>home/index">Home</a>&nbsp; > &nbsp;<a href="<?php echo WEB_URL ?>home/hotel_search">Hotel Search</a> &nbsp;>&nbsp; Hotels in <?php echo $this->session->userdata('disp_city'); ?></div>

 

<!--rigtside-->
 
 

 <?php 	//echo $HotelSearchCode.$hid; exit;
 		if($res->api_name =='hotelspro') { 
			$hotel_det = $this->Home_Model->get_hotel_dethp($hotel_code);
			$hotel_desc = $this->Home_Model->get_hotel_desc($hotel_code);
			$rooms = $this->Home_Model->get_rooms($hotel_code,$sec_id);
		}
		else
		{
			$hotel_det = $this->Home_Model->get_hotel_det($HotelSearchCode,$hid);
			//echo "<pre>"; print_r($hotel_det);
			$hotel_images = $this->Home_Model->hotel_images($hid);
			$rooms = $this->Home_Model->get_rooms($hid,$sec_id); 
		}?>
    
     
    
     <div class="right_search_result1" style="float:left; margin-left:30px; margin-top:0px; width:993px;">
    <div>
   <div class="left_part_fiiglt1" style="width:970px; color:#e62424; height:auto; line-height:20px;"><br />
<span style="color:#333; font-weight:normal; font-size:12px;"> </span>
<span style="float:right;">

 </span>
</div>
   
   <!--left_part_fiiglt-->
   
    
   
   
</div>
   <div style="clear:both;"></div><!--prv_next-->

    
 
    
    <div class="search_result1" style="width:978px;"><!--six_tab-->
   
    <div class="flight_resutl_full"  style="width:978px;">
    
   <!--flight_result-->
   <div class="hotel_result1"  style="width:978px; font-size:12px;">
     <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td width="20">&nbsp;</td>
      <td width="100" align="left" valign="top">
      <?php if($res->api_name =='hotelspro') {
		  if(isset($hotel_det->HotelImages1)) { if($hotel_det->HotelImages1 != '') {  ?>
      	<a href="#"><img src="<?php echo $hotel_det->HotelImages1;  ?>" border="0"  width="250" style="border-radius:7px;"/></a>
      <?php  } } } else { ?>
      <a href="#"><img src="<?php echo $hotel_images[0]->picts; ?>" border="0"  width="250" style="border-radius:7px;"/></a>
      
      <?php } ?></td>
      
      <td width="20" align="right" valign="middle" >&nbsp;</td>
      <td align="left" valign="top"><table width="100%" border="0" cellspacing="5" cellpadding="5">
        <tr>
          <td height="23" colspan="2" valign="top" style="line-height:18px; color:#333; font-weight:bold; font-size:16px;"><strong><?php if(isset($hotel_det->HotelName))
		  {
			  if($hotel_det->HotelName != '')
			  {
				  echo $hotel_det->HotelName;
			  }
		  }?> &nbsp;<?php 						
		  	if($res->api_name =='hotelspro') { 
				if(isset($hotel_det->StarRating))
				{if($hotel_det->StarRating != '')
				{
					$star_rate = $hotel_det->StarRating;
				}
				else
				{
					$star_rate = '';
				}}else
				{
					$star_rate = '';
				}
			}
			else{
			$star_rate = $hotel_det->Category; }
			if($star_rate == '1')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active1.png" /> 
                <?php
			}
			elseif($star_rate == '2')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active2.png" /> 
                <?php
			}
			elseif($star_rate == '3')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active3.png" /> 
                <?php
			}
			elseif($star_rate == '4')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active4.png" /> 
                <?php
			}
			elseif($star_rate == '5')
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active5.png" /> 
                <?php
			}
			else
			{
				?>
               <img src="<?php echo WEB_DIR ?>images/hotels/star-active0.png" /> 
                <?php
			}?></strong></td>
          </tr>
        <tr>
          <td colspan="2" style="line-height:18px; color:#666;"> </td>
          </tr>
        <tr>
          <td height="10" colspan="2"><?php if($res->api_name =='hotelspro') {  if(isset($hotel_det->HotelAddress)) { if($hotel_det->HotelAddress != '') { echo $hotel_det->HotelAddress; } } }else { if($hotel_det->Address != '') { echo $hotel_det->Address; } }?>  </td>
          </tr>
           <tr>
          <td height="10" colspan="2">Phone : <?php if($res->api_name =='hotelspro') { if(isset($hotel_det->HotelPhoneNumber)) { if($hotel_det->HotelPhoneNumber != '') { echo $hotel_det->HotelPhoneNumber; }} } else { if($hotel_det->Phone != '') { echo $hotel_det->Phone; } } ?>  </td>
          </tr>
           <tr>
         <?php if($res->api_name =='hotelspro') { 
		  ?>
          <td height="10" colspan="2">Postal Code : <?php if(isset($hotel_det->HotelPostalCode)) { if($hotel_det->HotelPostalCode != '') { if($hotel_det->HotelPostalCode != '') { echo $hotel_det->HotelPostalCode;  }} }?>  </td>
          <?php } else  { ?>
         	<td height="10" colspan="2">Fax : <?php if($hotel_det->Fax != '') { echo $hotel_det->Fax; } ?>  </td>
            <?php } ?>
          </tr>
        <tr>
          <td width="200">Check-in:</td>
          <td height="10"><?php $depdate = explode('-',$this->session->userdata('start_date')); 
		  				echo $dpdate1 = date("d M Y, D",mktime(0,0,0,$depdate[1],$depdate[2],$depdate[0]))?> </td>
        </tr>
        <tr>
          <td>Check-out:</td>
          <td height="10"><?php $depdate = explode('-',$this->session->userdata('end_date')); 
		  				echo $dpdate1 = date("d M Y, D",mktime(0,0,0,$depdate[1],$depdate[2],$depdate[0]))?></td>
        </tr>
        <tr>
          <td>For:</td>
          <td height="10"><?php echo $this->session->userdata('dt'); ?> night <!--2 rooms--> </td>
        </tr>
      </table></td>
      <!--rate part plus book button-->     <!--rate part plus book button--> 
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="3" align="left" valign="top">&nbsp;</td>
      </tr>
    
    </table>
   
 </div>
    
    
 
 
 
 
 
 
 
 
 
 <div class="hotel_result1"  style="width:978px; font-size:12px; padding:0px;">
 <!-- make_payment -->
    <form name="booking" id="booking" action="<?php print WEB_URL ?>home/booking" method="post" class='form-horizontal form-validate'>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><div class="links4" >
      <ul>
        <li style="border-radius:5px 5px 0px 0px; width:918px; padding-left:15px; font-size:14px;">Your details</li>
        
      </ul>
    </div></td>
  </tr>
 
  <?php /* ?><form name="booking" action="<?php print WEB_URL ?>home/booking" method="post"> <?pph */ ?>
 
 

  <input type="hidden" name="result_id" value="<?php echo $res->result_id; ?>"  />
  
  <input type="hidden" name="api" value="<?php echo $res->api_name; ?>"  />
  <?php if($res->api_name !='hotelspro') { ?>
  <input type="hidden" name="HotelSearchCode" value="<?php echo $HotelSearchCode; ?>"  />
  <?php } ?>
  <tr>
    <td><table align="center" border="0" cellpadding="0" cellspacing="0" width="95%" style="font-size:12px;" >
    <tr>
      <td colspan="4" align="left" valign="top">&nbsp;</td>
    </tr>
    <tr>
      <td width="50" align="left" valign="top">&nbsp;</td>
      <td align="left" valign="top"><table border="0" cellpadding="0" cellspacing="0" width="100%">
       
          <tr>
            <td> </td>
          </tr>
          <?php $room_count = $this->session->userdata('room_count');
		  		$room_type1 = $this->session->userdata('room_types');
				$room_types2 = $this->session->userdata('room_types2');
				$room_types3 = $this->session->userdata('room_types3');
		  		if($room_count == '1')
				{
					if($room_type1 == 'DBL')
					{
						$adult = 2;
					}
					elseif($room_type1 == 'DBL')
					{
						$adult = 1;
					}
					elseif($room_type1 == 'TWN')
					{
						$adult = 2;
					}
					elseif($room_type1 == 'TPL')
					{
						$adult = 3;
					}
					elseif($room_type1 == 'QDR')
					{
						$adult = 4;
					}
					else
					{
						$adult = 1;
					}
					$adult2 = 0;
					$adult3 = 0;
				}
					if($room_count == '2')
					{
						if($room_type1 == 'DBL')
						{
							$adult = 2;
						}
						elseif($room_type1 == 'DBL')
						{
							$adult = 1;
						}
						elseif($room_type1 == 'TWN')
						{
							$adult = 2;
						}
						elseif($room_type1 == 'TPL')
						{
							$adult = 3;
						}
						elseif($room_type1 == 'QDR')
						{
							$adult = 4;
						}
						elseif($room_type1 == 'DBLSGL')
						{
							$adult = 1;
						}
						
						if($room_type2 == 'DBL')
						{
							$adult2 = 2;
						}
						elseif($room_type2 == 'DBL')
						{
							$adult2 = 1;
						}
						elseif($room_type2 == 'TWN')
						{
							$adult2 = 2;
						}
						elseif($room_type2 == 'TPL')
						{
							$adult2 = 3;
						}
						elseif($room_type2 == 'QDR')
						{
							$adult2 = 4;
						}
						elseif($room_type2 == 'DBLSGL')
						{
							$adult2 = 1;
						}
						$adult3 = 0;
					}
					
					if($room_count == '3')
					{
						if($room_type1 == 'DBL')
						{
							$adult = 2;
						}
						elseif($room_type1 == 'DBL')
						{
							$adult = 1;
						}
						elseif($room_type1 == 'TWN')
						{
							$adult = 2;
						}
						elseif($room_type1 == 'TPL')
						{
							$adult = 3;
						}
						elseif($room_type1 == 'QDR')
						{
							$adult = 4;
						}
						elseif($room_type1 == 'DBLSGL')
						{
							$adult = 1;
						}
						
						if($room_type2 == 'DBL')
						{
							$adult2 = 2;
						}
						elseif($room_type2 == 'DBL')
						{
							$adult2 = 1;
						}
						elseif($room_type2 == 'TWN')
						{
							$adult2 = 2;
						}
						elseif($room_type2 == 'TPL')
						{
							$adult2 = 3;
						}
						elseif($room_type2 == 'QDR')
						{
							$adult2 = 4;
						}
						elseif($room_type2 == 'DBLSGL')
						{
							$adult2 = 1;
						}
						
						if($room_type3 == 'DBL')
						{
							$adult3 = 2;
						}
						elseif($room_type3 == 'DBL')
						{
							$adult3 = 1;
						}
						elseif($room_type3 == 'TWN')
						{
							$adult3 = 2;
						}
						elseif($room_type3 == 'TPL')
						{
							$adult3 = 3;
						}
						elseif($room_type3 == 'QDR')
						{
							$adult3 = 4;
						}
						elseif($room_type3 == 'DBLSGL')
						{
							$adult3 = 1;
						}
						
					}
					
					?>
                    
                    <?php if($room_count == '1')
					{
						for($i = 0; $i< $adult; $i++) { ?>
                        
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">

              <tr>
                <td height="25">Title</td>
                <td>First Name</td>
                <td>Last Name : </td>
              </tr>
              <tr>
                <td><select name="title[]" class="field" style="width:100px;" id="select">
                		<option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                </select></td>
                <td><input name="first_name[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
                <td><input name="last_name[]" class="field validate[required]" id="last_name" value="" type="text" /></td>
              </tr>
            </table></td>
          </tr>
          <?php }
		   } ?>
           
           <?php if($room_count == '2')
					{
						for($i = 0; $i< $adult; $i++) { ?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25">Title</td>
                <td>First Name</td>
                <td>Last Name : </td>
              </tr>
              <tr>
                <td><select name="title[]" class="field" style="width:100px;" id="select">
                		<option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                </select></td>
                <td><input name="first_name[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
                <td><input name="last_name[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
              </tr>
            </table></td>
          </tr>
          <?php } 
          for($i = 0; $i< $adult2; $i++) { ?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25">Title</td>
                <td>First Name</td>
                <td>Last Name : </td>
              </tr>
              <tr>
                <td><select name="title2[]" class="field validate[required]" style="width:100px;" id="select">
                		<option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                </select></td>
                <td><input name="first_name2[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
                <td><input name="last_name2[]" class="field validate[required]" id="last_name" value="" type="text" /></td>
              </tr>
            </table></td>
          </tr>
          <?php  }
		   } ?>
           <?php if($room_count == '3')
					{
						for($i = 0; $i< $adult; $i++) { ?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25">Title</td>
                <td>First Name</td>
                <td>Last Name : </td>
              </tr>
              <tr>
                <td><select name="title[]" class="field validate[required]" style="width:100px;" id="select">
                		<option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                </select></td>
                <td><input name="first_name[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
                <td><input name="last_name[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
              </tr>
            </table></td>
          </tr>
          <?php } 
          for($i = 0; $i< $adult2; $i++) { ?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25">Title</td>
                <td>First Name</td>
                <td>Last Name : </td>
              </tr>
              <tr>
                <td><select name="title2[]" class="field validate[required]" style="width:100px;" id="select">
                		<option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                </select></td>
                <td><input name="first_name2[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
                <td><input name="last_name2[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
              </tr>
            </table></td>
          </tr>
          <?php  }
		  for($i = 0; $i< $adult3; $i++) { ?>
          <tr>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25">Title</td>
                <td>First Name</td>
                <td>Last Name : </td>
              </tr>
              <tr>
                <td><select name="title3[]" class="field validate[required]" style="width:100px;" id="select">
                		<option value="Mr.">Mr.</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Ms.">Ms.</option>
                </select></td>
                <td><input name="first_name3[]" class="field validate[required]" id="first_name" value="" type="text" /></td>
                <td><input name="last_name3[]" class="field validate[required]" id="last_name" value="" type="text" /></td>
              </tr>
            </table></td>
          </tr>
          <?php  }
		   } ?>
           <?php $adult_count = $adult + $adult2 + $adult3; ?>
           <input type="hidden" name="adult" value="<?php echo $adult; ?>"  />
           <input type="hidden" name="adult2" value="<?php echo $adult2; ?>"  />
           <input type="hidden" name="adult3" value="<?php echo $adult3; ?>"  />
          <tr>
            <td height="15"></td>
          </tr>
          <tr>
            <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td height="25"><span id="label_email">Email address </span></td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td width="174"><input name="email_id" class="field validate[required,custom[email]]" id="email_id" value="" type="text" />
&nbsp;</td>
                <td width="482">You'll receive a confirmation email</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="15"></td>
          </tr>
          <tr>
            <td><span id="label_email_confirm">Confirm email address</span></td>
          </tr>
          <tr>
            <td height="5"></td>
          </tr>
          <tr>
            <td><input name="email_id" class="field validate[required,custom[email],equals[email_id]]" id="cemail_id" value="" type="text" /><div id="emailDiv"></div></td>
          </tr>
          <tr>
            <td height="35"> </td>
            </tr>
          <tr>
            <td><table width="100%" border="1" cellspacing="0" cellpadding="0">
              <tr>
                <td width="107" rowspan="3"><a href="#"><img src="<?php echo $res->image; ?>" border="0"  width="100" style="border-radius:7px;"/></a></td>
                <td height="25"><strong><?php echo $res->room_type; ?>, <?php echo $res->plan_type; ?> <br />
                	<?php echo round($res->nightperroom); ?> <?php echo $res->cost_type; ?></strong> <?php /*?><span id="label_firstname">Guest Full name </span><?php */?></td>
                <td>&nbsp;</td>
              </tr>
             <!-- <tr>
                <td width="220"><input name="mobile_no2" class="field" id="mobile_no2" value="" type="text" />
                  &nbsp;</td>
                <td width="355"><strong>Max People </strong> ( 2 guests )</td>
              </tr>-->
              <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td height="15"></td>
          </tr>
          
          <tr>
            <td colspan="3" height="25"></td>
          </tr>
          <tr>
            <td colspan="3"><strong>Special Requests</strong> (Please write your requests in English.)</td>
          </tr>
          <tr>
            <td colspan="3" height="10"></td>
          </tr>
          <tr>
            <td colspan="3"><textarea name="address" id="address"  style="width:750px; height:120px;" class="field" value=""></textarea></td>
          </tr>
          <tr>
            <td height="5"></td>
          </tr>
          <tr>
            <td align="left"><input type="checkbox"  name="checkbox" class="validate[required]" /><b>Price will be converted to USD in the payment page and please agree that to proceed to payment page</b></td>
          </tr>
    
          
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="left"><input src="<?php echo WEB_DIR ?>images/continue.png" border="0"  type="image" /></td>
            </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
          <tr>
            <td align="left">&nbsp;</td>
          </tr>
        
      </table></td>
      <td width="65">&nbsp;</td>
      <td align="left" valign="top">&nbsp;</td>
    </tr>
    
  
</table></td>
  </tr>
  <tr style="display:none;">
    <td>&nbsp;</td>
  </tr>
    </table>
</form>
    
   
   </div>
 
 
 
 
 
 
 
 
 
  
 
   
   
   
   
   
   
   
   
   
   
   
   
    
   
    
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
<script>
$(document).ready(function(){
    $("#booking").validationEngine();
   });
</script>	