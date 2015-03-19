<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>travelingmart - Administration</title>
	
</head>

<body>
<?php $this->load->view('header'); ?>
<link type="text/css" href="<?php echo WEB_DIR_ADMIN?>css/style_one.css" rel="stylesheet" />
<link href="<?php echo WEB_DIR_ADMIN?>/images/fev_icon.png" rel='shortcut icon' type='image/x-icon'/>
<div id="container_warpper" style="padding-bottom:50px; margin-top:50px;" >
   <div class="left_menu_sub">
		<ul>
<?php /*?>        <?php echo WEB_URL_ADMIN?>admin/add_subadmin<?php */?>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/markup" style="text-decoration:none;"class="active">Commission</a></li>
            <?php /*?><li><a href="<?php  print WEB_URL_ADMIN?>admin/rebate_setting" style="text-decoration:none;"class="active">Rebate</a></li><?php */?>
			<?php /*?><li><a href="<?php echo WEB_URL_ADMIN?>admin/change_pwd" style="text-decoration:none;">Change Password</a></li>

			<li><a href="<?php  print WEB_URL_ADMIN?>admin/website_settings" style="text-decoration:none;">Website Settings</a></li>
  <?php */?>
		</ul>
	</div>
   <script type="text/javascript">
  function abc()
  {
  //	alert('anand');
  $('#add_comm').show();
  $('#view_comm').hide();
  }
  function xyz()
  {
  //	alert('anand');
  $('#add_comm').hide();
  $('#view_comm').show();
  }
  </script>
  
  <div style="margin:auto; width:790px; height:auto; overflow:hidden;">
  <div style="width:790px; height:20px; margin-left:20px; ">
 <!-- <span style="color:#fff; background:#3a3a39 ; width:150px; float:left; text-align:center; cursor:pointer; border-right:1px solid #fff; padding:7px 7px; font-weight:bold;" onclick="return xyz();">Commission Details</span>&nbsp;<span style="color:#fff; padding:7px 7px; font-weight:bold; background:#3a3a39 ; width:150px; float:right; text-align:center; cursor:pointer;" onclick="return abc();">Add Commission</span> --></div>
  <div id="view_comm" style="width:750px; height:auto; float:left; overflow:hidden; border:solid 1px #ccc; margin-left:20px;">
  <table width="100%"  >
  <tr style=" border:solid 1px #ccc; background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; font-size:14px; font-weight:bold; text-align:center;">
    <td height="30">Item</td>
    <td>Markup</td>
  </tr>
  <form name="markup"  method="post" action="<?php print WEB_URL_ADMIN ?>admin/insert_marup" >
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Payment Gateway</td>
    <td> <input type="text"  name="payment_gateway" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->payment_gateway; } } ?>" /> <input type="radio" value="percentage" name="gateway_type" <?php if($markup->gateway_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="gateway_type"  <?php if($markup->gateway_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
 
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Hotel</td>
    <td> <input type="text"  name="hotel" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->hotel; } } ?>"  /> <input type="radio" value="percentage" name="hotel_type" <?php if($markup->hotel_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="hotel_type"  <?php if($markup->hotel_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Packages</td>
    <td> <input type="text"  name="holidays" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->holidays; } } ?>"  /> <input type="radio" value="percentage" name="holiday_type" <?php if($markup->holiday_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="holiday_type"  <?php if($markup->holiday_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Football</td>
    <td> <input type="text"  name="football" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->football; } } ?>"  /> <input type="radio" value="percentage" name="football_type" <?php if($markup->football_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="football_type"  <?php if($markup->football_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  
  
   <tr  >
   <input type="hidden"  name="air_india" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->air_india; } } ?>"  /> 
    <input type="hidden" value="percentage" name="air_india_type" <?php if($markup->air_india_type =='percentage') { echo "checked"; }?> />
    <input type="hidden"  name="jetairways" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->jetairways; } } ?>"  />
     <input type="hidden" value="percentage" name="jetairways_type" <?php if($markup->jetairways_type =='percentage') { echo "checked"; }?> />
     <input type="hidden"  name="jetlite" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->jetlite; } } ?>"  />
     <input type="hidden" value="percentage" name="jetlite_type" <?php if($markup->jetlite_type =='percentage') { echo "checked"; }?> />
      <input type="hidden"  name="kingfisher" size="10"  value="<?php if(isset($markup)) { if($markup != '') { echo $markup->kingfisher; } } ?>"  /> 
       <input type="hidden" value="percentage" name="kingfisher_type" <?php if($markup->kingfisher_type =='percentage') { echo "checked"; }?> />
       <input type="hidden"  name="airindia_express" size="10"  value="<?php if(isset($markup)) { if($markup != '') { echo $markup->airindia_express; } } ?>"  />  
       <input type="hidden" value="percentage" name="airindia_express_type" <?php if($markup->airindia_express_type =='percentage') { echo "checked"; }?> /> 
       <input type="hidden"  name="airindia_express" size="10"  value="<?php if(isset($markup)) { if($markup != '') { echo $markup->airindia_express; } } ?>"  /> 
       <input type="hidden" value="percentage" name="airindia_express_type" <?php if($markup->airindia_express_type =='percentage') { echo "checked"; }?> />
       <input type="hidden"  name="goair" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->go_air; } } ?>"  />
       <input type="hidden" value="percentage" name="goair_type" <?php if($markup->goair_type =='percentage') { echo "checked"; }?> />
        <input type="hidden"  name="indigo" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->indigo; } } ?>"  /> 
        <input type="hidden" value="percentage" name="indigo_type" <?php if($markup->indigo_type =='percentage') { echo "checked"; }?> />
        <input type="hidden"  name="indigo" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->indigo; } } ?>"  />
        <input type="hidden" value="percentage" name="indigo_type" <?php if($markup->indigo_type =='percentage') { echo "checked"; }?> />
         <input type="hidden"  name="spicjet" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->spice_jet; } } ?>"  />
         <input type="hidden" value="percentage" name="spicjet_type" <?php if($markup->spicjet_type =='percentage') { echo "checked"; }?> />
     <td height="10" colspan="2">&nbsp;</td>
   </tr>
   
  
   
  
   <?php /*?><tr style="background-image:url(../../images/searchbg.jpg); background-repeat:repeat-x; color:#333; border:solid 1px #ccc; font-weight:bold; font-size:14px; text-align:center;">
    <td height="30" colspan="2">Flights International</td>
  </tr>
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Air India</td>
    <td> <input type="text"  name="air_india_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->air_india_inter; } } ?>"  /> <input type="radio" value="percentage" name="air_india_inter_type" <?php if($markup->air_india_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="air_india_inter_type"  <?php if($markup->air_india_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Jet Airways</td>
    <td> <input type="text"  name="jetairways_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->jetairways_inter; } } ?>"  /> <input type="radio" value="percentage" name="jetairways_inter_type" <?php if($markup->jetairways_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="jetairways_inter_type"  <?php if($markup->jetairways_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr> 
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">JetLite</td>
    <td> <input type="text"  name="jetlite_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->jetlite_inter; } } ?>"  /> <input type="radio" value="percentage" name="jetlite_inter_type" <?php if($markup->jetlite_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="jetlite_inter_type"  <?php if($markup->jetlite_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Kingfisher</td>
    <td> <input type="text"  name="kingfisher_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->kingfisher_inter; } } ?>"  /><input type="radio" value="percentage" name="kingfisher_inter_type" <?php if($markup->kingfisher_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="kingfisher_inter_type"  <?php if($markup->kingfisher_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
   <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Air India Exp.</td>
    <td> <input type="text"  name="airindia_express_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->air_india_express_inter; } } ?>"  /><input type="radio" value="percentage" name="airindia_express_inter_type" <?php if($markup->airindia_express_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="airindia_express_inter_type"  <?php if($markup->airindia_express_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Go Air</td>
    <td> <input type="text"  name="goair_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->goair_inter; } } ?>"  /> <input type="radio" value="percentage" name="goair_inter_type" <?php if($markup->goair_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="goair_inter_type"  <?php if($markup->goair_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
  <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Indigo</td>
    <td> <input type="text"  name="indigo_inter" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->indigo_inter; } } ?>"  /><input type="radio" value="percentage" name="indigo_inter_type" <?php if($markup->indigo_inter_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="indigo_inter_type"  <?php if($markup->indigo_inter_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
   <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">MDLR</td>
    <td> <input type="text"  name="mdlr" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->mdlr_inter; } } ?>"  /><input type="radio" value="percentage" name="mdlr_type" <?php if($markup->mdlr_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="mdlr_type"  <?php if($markup->mdlr_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
   <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Paramount</td>
    <td> <input type="text"  name="paramount" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->paramount_inter; } } ?>"  /><input type="radio" value="percentage" name="paramount_type" <?php if($markup->paramount_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="paramount_type"  <?php if($markup->paramount_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
   <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">Spice Jet</td>
    <td> <input type="text"  name="spicejet" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->spice_jet_inter; } } ?>"  /><input type="radio" value="percentage" name="spicejet_type" <?php if($markup->spicejet_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="spicejet_type"  <?php if($markup->spicejet_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr>
   <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
    <td height="30">For all other Flights</td>
    <td> <input type="text"  name="other_flights" size="10" value="<?php if(isset($markup)) { if($markup != '') { echo $markup->other_flight; } } ?>"  /> <input type="radio" value="percentage" name="other_flights_type" <?php if($markup->other_flights_type =='percentage') { echo "checked"; }?> /> Percentage <input type="radio" value="fixed" name="other_flights_type"  <?php if($markup->other_flights_type =='fixed') { echo "checked"; }?> /> Fixed</td>
  </tr><?php */?>
  
   <tr style="border:solid 1px #ccc; color:#000; font-size:14px; text-align:center;">
  <tr><td colspan="2" align="center"><input type="image" src="<?php print WEB_DIR_ADMIN ?>images/submit_btn.png" border="0"  /></td></tr>
  </form>
 
   </table>
  </div>
   <form name="form1" id="add_comm" style="display:none;" action="<?php print WEB_URL_ADMIN?>admin/add_commission_details" method="post">
	<input name="services" value="" class="user_fld_box-fld-2" type="hidden" />
  <table style="width:600px; padding:15px; border:1px #ccc solid; margin-left:20px;">
  <tr>
	<td style="border:solid 1px #ccc; padding:2px;">Commission Value</td>
	<td style="border:solid 1px #ccc; padding:2px;"><input type="text" name="value" id="value"/>%</td></tr>
	<?php /*?><tr>
	<td style="border:solid 1px #ccc; padding:2px;">Commission Type</td>
	<td style="border:solid 1px #ccc; padding:2px;"><select name="type" id="type" style="width:145px;">
		<option value="">select commisssion</option>
		<option value="1">price</option>
		<option value="2">Percentage</option>
		</select></td>
	</tr><?php */?>
	
	<tr>
	<td style="border:solid 1px #ccc; padding:2px;">
	</td>
	<td style="border:solid 1px #ccc; padding:2px;">  <input type="image" src="<?php echo WEB_DIR_ADMIN?>/images/submit_btn.png" width="72" height="36">
	<a><img src="<?php echo WEB_DIR_ADMIN?>/images/clear_btn.png" width="72" height="36" border="0"  onclick="javascript:history.back(-1);" style="cursor:pointer;"/></a>
    </td>
	</tr>
  </table>
</form>
  </div>
  
  
  
  
  
</div>
<?php $this->load->view('footer'); ?>
</body>
</html>
