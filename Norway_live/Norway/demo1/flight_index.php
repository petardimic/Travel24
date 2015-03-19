<?php
    $adult_arr=array();

    $adult_arr[] = "1";
    $adult_arr[] = "2";
    $adult_arr[] = "3";
    $adult_arr[] = "4";
    $adult_arr[] = "5";
    $adult_arr[] = "6";
    $adult_arr[] = "7";
    $adult_arr[] = "8";
    $adult_arr[] = "9";

    $adult_arr1[1][] = "0";
    $adult_arr1[1][] = "1";
    $adult_arr1[1][] = "2";
    $adult_arr1[1][] = "3";
    $adult_arr1[1][] = "4";
    $adult_arr1[1][] = "5";
    $adult_arr1[1][] = "6";
    $adult_arr1[1][] = "7";
    $adult_arr1[1][] = "8";

    $adult_arr1[2][] = "0";
    $adult_arr1[2][] = "1";
    $adult_arr1[2][] = "2";
    $adult_arr1[2][] = "3";
    $adult_arr1[2][] = "4";
    $adult_arr1[2][] = "5";
    $adult_arr1[2][] = "6";
    $adult_arr1[2][] = "7";

    $adult_arr1[3][] = "0";
    $adult_arr1[3][] = "1";
    $adult_arr1[3][] = "2";
    $adult_arr1[3][] = "3";
    $adult_arr1[3][] = "4";
    $adult_arr1[3][] = "5";
    $adult_arr1[3][] = "6";

    $adult_arr1[4][] = "0";
    $adult_arr1[4][] = "1";
    $adult_arr1[4][] = "2";
    $adult_arr1[4][] = "3";
    $adult_arr1[4][] = "4";
    $adult_arr1[4][] = "5";


    $adult_arr1[5][] = "0";
    $adult_arr1[5][] = "1";
    $adult_arr1[5][] = "2";
    $adult_arr1[5][] = "3";
    $adult_arr1[5][] = "4";

    $adult_arr1[6][] = "0";
    $adult_arr1[6][] = "1";
    $adult_arr1[6][] = "2";
    $adult_arr1[6][] = "3";

    $adult_arr1[7][] = "0";
    $adult_arr1[7][] = "1";
    $adult_arr1[7][] = "2";

    $adult_arr1[8][] = "0";
    $adult_arr1[8][] = "1";

    $adult_arr2[9][] = "0";
    $adult_arr2[9][] = "1";
    $adult_arr2[9][] = "2";
    $adult_arr2[9][] = "3";
    $adult_arr2[9][] = "4";
    $adult_arr2[9][] = "5";
    $adult_arr2[9][] = "6";
    $adult_arr2[9][] = "7";
    $adult_arr2[9][] = "8";
    $adult_arr2[9][] = "9";

    $adult_arr2[8][] = "0";
    $adult_arr2[8][] = "1";
    $adult_arr2[8][] = "2";
    $adult_arr2[8][] = "3";
    $adult_arr2[8][] = "4";
    $adult_arr2[8][] = "5";
    $adult_arr2[8][] = "6";
    $adult_arr2[8][] = "7";
    $adult_arr2[8][] = "8";

    $adult_arr2[7][] = "0";
    $adult_arr2[7][] = "1";
    $adult_arr2[7][] = "2";
    $adult_arr2[7][] = "3";
    $adult_arr2[7][] = "4";
    $adult_arr2[7][] = "5";
    $adult_arr2[7][] = "6";
    $adult_arr2[7][] = "7";

    $adult_arr2[6][] = "0";
    $adult_arr2[6][] = "1";
    $adult_arr2[6][] = "2";
    $adult_arr2[6][] = "3";
    $adult_arr2[6][] = "4";
    $adult_arr2[6][] = "5";
    $adult_arr2[6][]= "6";

    $adult_arr2[5][] = "0";
    $adult_arr2[5][] = "1";
    $adult_arr2[5][] = "2";
    $adult_arr2[5][] = "3";
    $adult_arr2[5][] = "4";
    $adult_arr2[5][] = "5";

    $adult_arr2[4][] = "0";
    $adult_arr2[4][] = "1";
    $adult_arr2[4][] = "2";
    $adult_arr2[4][] = "3";
    $adult_arr2[4][] = "4";

    $adult_arr2[3][] = "0";
    $adult_arr2[3][] = "1";
    $adult_arr2[3][] = "2";
    $adult_arr2[3][] = "3";

    $adult_arr2[2][] = "0";
    $adult_arr2[2][] = "1";
    $adult_arr2[2][] = "2";

    $adult_arr2[1][] = "0";
    $adult_arr2[1][] = "1";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Akbar Travels</title>
        <!-- CSS -->
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
        <!--########### COMMON CSS #############-->    
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab_rounded.css" type="text/css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/nivo-slider.css" type="text/css" media="screen" />
    </head>
    <body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('header'); ?>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/Validation/js/jquery.validationEngine.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/Validation/js/languages/jquery.validationEngine-en.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/Validation/css/validationEngine.jquery.css" media="all" type="text/css" />
<script>
$(document).ready(function(){
  jQuery("#flight_search").validationEngine();
 });
 </script>
        <script type="text/javascript" src="<?php print base_url();  ?>assets/autofill/js/bsn.AutoSuggest_c_2.0.js"></script>


<link rel="stylesheet" href="<?php print base_url();  ?>assets/autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################---> 
        
        <div class="inner_wrapper">  
<!--      <div style="position:absolute; z-index:10000; margin-left:550px; margin-top:24px;">  <img src="<?php echo base_url(); ?>assets/images/guaratee.png" /></div>-->
            <div class="tabMain">
                <div class="tabs">
                    <ul style="width:auto; flat:left; padding-left:0px; ">
                        <li style="background: linear-gradient(to bottom, #033A76 0%, #2679B4 50%, #145893 50%, #033A76 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);"><a href="<?php echo site_url(); ?>/home/flights" >Flights<br />

                            </a></li>
                        <li><a href="<?php echo site_url(); ?>/home/hotels">Hotels<br />

                            </a></li>
                        <li><a href="<?php echo site_url(); ?>/home/cars">Car<br />

                            </a></li>
                        <li><a href="<?php echo site_url() ?>/package_home">Packages<br />

                            </a></li>
                    </ul>	</div> 
                <form name="flight_search" id="flight_search" method="POST" action="<?php echo site_url(); ?>/flights/search" onSubmit="return validation(this)">
                    <div class="tabmain_container">
                    
                     
                        <div>
                                <p style="float:left">
<!--                                    <label>
                                        <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_0" />
                                        Domestic
                                    </label>
                                    <br />-->
                                    
                                  <div class="radio_btn_bg"> <label>
                                        <input type="radio" name="journey_type" value="OneWay" id="oneway" checked />
                                        One Way
                                   </label></div>
                                   
                                </p>
                                <p style="float:left;">
<!--                                    <label>
                                        <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_0" />
                                        International
                                    </label>
                                    <br />-->
                                     <div class="radio_btn_bg"><label>
                                        <input type="radio" name="journey_type" value="Round" id="roundtrip" />
                                        Round Trip
                                    </label></div>
                                   
                                </p>
                            <p style="float:left;">
                                   <div class="radio_btn_bg"> <label>
                                        <input type="radio" name="journey_type" value="MultiCity" id="multicity" />
                                        Multi City
                                    </label></div>
                                    <br />
                                </p>
                        </div>
                        <div class="clear"></div>
                        <div style="padding:15px;" >
							<script language="javascript" type="text/javascript">
			 function DropDownTextToBox(objDropdown, strTextboxId) {
				document.getElementById(strTextboxId).value = objDropdown.options[objDropdown.selectedIndex].value;
				DropDownIndexClear(objDropdown.id);
				document.getElementById(strTextboxId).focus();
			}
			function DropDownIndexClear(strDropdownId) {
				if (document.getElementById(strDropdownId) != null) {
					document.getElementById(strDropdownId).selectedIndex = -1;
				}
			}
		</script>
                            <div class="fleft">
                                <label class="label" style="color:#2F382F; ">Leaving From</label> <br />
                                 <?php /*<input class="search_input_box"  type="text" name="from_city" id="airportcodeinput"  /> <?php */ ?>
                                 <input type="text" name="from_city" id='dorigin' class="home_search_input_box" tabindex="2" 
                    onchange="DropDownIndexClear('DropDownExTextboxExample');"
                     value="Type Departure Location Here" onblur="if(this.value == '') { this.value='Type Departure Location Here'}" onfocus="if (this.value == 'Type Departure Location Here') {this.value=''}" />
                    
           <select name="DropDownExTextboxExample" id="DropDownExTextboxExample" tabindex="1000"
                    onchange="DropDownTextToBox(this,'dorigin');" style="  border:1px #CCC solid; padding:4px 0px;   height:auto;  width: 270px;-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px; text-overflow: '';" class="search_input_box2">
    
                    <?php if(isset($airports)) { if($airports != '') { foreach($airports as $air){ ?>                    
                    <option  style="width:350px; font-size:11px; padding:2px; color:#666; font-family:Arial, Helvetica, sans-serif;" value="<?php echo $air->city."-".$air->country.",".$air->city_code; ?>"><?php echo $air->city."-".$air->country.",".$air->city_code; ?></option>
                    <?php } } } ?>
                    
                </select>
                <script language="javascript" type="text/javascript">
                    DropDownIndexClear("DropDownExTextboxExample");
					 DropDownIndexClear2("DropDownExTextboxExample2");
                </script>
                
                
         <script type="text/javascript">
	    var options = {
		script:"<?php echo base_url(); ?>test_airport.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('dorigin').value = obj.id; } };
	    var as_json = new AutoSuggest('dorigin', options);
        </script>
                            </div>
                            
                            
                            <div class="fleft left10">
                                <label class="label" style="color:#2F382F; ">Travelling to</label> <br />
                                <?php /* ?><input class="search_input_box" type="text" name="to_city" id="testtoinput" value="" onblur="addinanotherinput1(this.value)" style="width:250px;"/> <?php */ ?>
                                <input type="text" name="to_city" id='ddestination'class="home_search_input_box1" tabindex="1" 
                    onchange="DropDownIndexClear2('DropDownExTextboxExample');"  
    value="Type Arrival Location Here" onblur="if(this.value == '') { this.value='Type Arrival Location Here'}" onfocus="if (this.value == 'Type Arrival Location Here') {this.value=''}" />
     <select name="DropDownExTextboxExample2" id="DropDownExTextboxExample2" tabindex="1000"
                    onchange="DropDownTextToBox(this,'ddestination');" style="  border:1px #CCC solid; padding:4px 0px;   height:auto;  width: 270px;-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px; text-overflow: '';" class="search_input_box2">
    				<option value="" ></option>
                    <?php if(isset($airports)) { if($airports != '') { foreach($airports as $air){ ?>                    
                    <option style="width:350px; font-size:11px; padding:2px; color:#666; font-family:Arial, Helvetica, sans-serif;" value="<?php echo $air->city."-".$air->country.",".$air->city_code; ?>"><?php echo $air->city."-".$air->country.",".$air->city_code; ?></option>
                    <?php } } } ?>
                </select>
                <script type="text/javascript">
					var options = {
					script:"<?php echo base_url(); ?>test_airport.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('ddestination').value = obj.id; } };
					var as_json = new AutoSuggest('ddestination', options);
					</script>
                            </div>
                            
                            <div class="clear"></div>
                            <div class="top10 fleft">
                                <label class="label" style="color:#2F382F;">Departure</label> <br />
                                <input style="color:#999999;" class="search_input_box4 required validate[required]" type="text" name="sd" id="datepicker" readonly="readonly" />
                            </div>
                            <div class="fleft left10 top10" id="return_date" style="display:none;">
                                <label class="label" style="font-size:12px; color:#919191;">Return</label> <br />
                                <span id="out"><input style="color:#999999;" class="search_input_box4 required validate[required]" type="text" name="ed" id="datepicker1" readonly="readonly"  /></span>
                            </div>
                            
                            <div class="clear"></div>
                            <div class="fleft top10">
                                <label class="label"  style="font-size:12px; color:#2F382F;  ">Adult(12+)</label> <br />
                                <select name="adult" id="s1" class="search_input_box2" style="-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px; text-overflow: ''; padding:5px; height:30px; width:70px; color:#999999;">
                                    <?php foreach($adult_arr as $sa) { ?>
                                        <option value="<?php echo $sa; ?>"><?php echo $sa; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="fleft left10 top10">
                                <label class="label" style="font-size:12px; color:#2F382F;">Child(2-11)</label> <br />
                                <div id="child">
                                    <select id="s2" name="child" class="search_input_box2" style="-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px;
    text-overflow: ''; padding:5px; height:30px; color:#999999;  width:70px;">
									<option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    </select>
                                </div>
                            </div>
                            <div class="fleft left10 top10">
                                <label class="label" style="font-size:12px; color:#2F382F;">Infant(0-2)</label> <br />
                                <select id="s3" name="infant" class="search_input_box2" style="-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px;
    text-overflow: ''; color:#999999; padding:5px; height:30px;  width:70px;">
                					<option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                             <div class="clear"></div>
                            <div class="fleft top10">
                                <label class="label" style="font-size:12px;color:#2F382F;">Class</label> <br />
                                <select name="cabin" style="-moz-appearance: none; -webkit-appearance: none; 
    text-indent: 0.01px;
    text-overflow: ''; padding:5px; height:30px;; width:180px; color:#999999;" class="search_input_box1" >
                                        <option value="All" selected="selected">All</option>
                                        <option value="First, Supersonic">First, Supersonic</option>
                                        <option value="Business">Business</option>
                                        <option value="Economic">Economic</option>
                                        <option value="Premium Economy">Premium Economy</option>
                                        <option value="Standard Economy">Standard Economy</option>
                                </select>
                               
                            </div>
                            
                            <div style="display:none;">
                                <select name="cabin_type" style="width:100%;" class="flight_adult_select_box_all">
                                        <option value="Mandatory cabin" selected="selected">Mandatory cabin</option>
                                        <option value="Recommended cabin">Recommended cabin</option>
                                        <option value="Major cabin">Major cabin</option>
                                </select>
                                <input type="text" name="hours" class="new_text_box"  placeholder="HH" style="width:30px; height:26px; padding:0px 5px 0px 5px;" >
                                <input type="text" name="mins" class="new_text_box" placeholder="MM" style="width:30px; height:26px; padding:0px 5px 0px 5px;" >
                                <input type="text" name="dradius" maxlength="3" class="new_text_box" placeholder="Departure" style="width:60px; height:26px; padding:0px 5px 0px 5px;">
                                <input type="text" name="aradius" maxlength="3" class="new_text_box" placeholder="Arival" style="width:60px; height:26px; padding:0px 5px 0px 5px;">
                                <input id="daterangeid1" type="radio" value="plus2days" name="daterange">
                                <input id="daterangeid1" type="radio" value="minus2days" name="daterange">
                                <input id="daterangeid1" type="radio" value="bothdays" name="daterange"> 
                                <input id="time_window" type="radio" value="timewindow" name="daterange">
                                <input type="text" name="include_city" id="testinput_include" class="TEX_style" style="width:200px; margin-right:24px; height:26px; padding:0px 5px 0px 5px;" placeholder="Include Connect city" />
                                <input type="text" name="exclude_city" id="testinput_exclude" class="TEX_style" style="width:200px; height:26px; padding:0px 5px 0px 5px;" placeholder="Exclude Connect City" />
                                <input type="text" name="hours_time" class="new_text_box" placeholder="HH" style="width:20px; margin-top: -1px; height:26px; padding:0px 5px 0px 5px;">
                                <input type="text" name="mins_time" class="new_text_box" placeholder="MM" style="width:20px; margin-top: -1px; height:26px; padding:0px 5px 0px 5px;">
                                <select name="time_qualifier" style="width:80px; margin-top:2px;" class="flight_adult_select_box_all">
                                    <option value="Arrival by" selected="selected">Arrival by</option>
                                    <option value="Depart from">Depart from</option>
				</select>
                                <input type="text" value="" name="time_interval" class="new_text_box" placeholder="HH" style="width:20px;  height:26px; padding:0px 5px 0px 5px;">
                            </div>
                            
                            
                            
                            <button class="search_btn" onclick="return submitFlight();" >
                                <img src="<?php echo base_url(); ?>assets/images/search_icon.png" align="absmiddle" />Search Flight
                            </button>
                            
                          
                        </div>
                    </div>
                   
                </form>
            </div>
            <div class="toplayer1 fright top50" style="width:370px;">
           <span style="margin-top:10px; float:left; width:322px; height:62px;">
                <img src="<?php echo base_url(); ?>assets/images/express_deals.png" />
</span>

<span style="margin-top:10px; float:left; width:322px; height:70px; margin-bottom:15px;">
                <img src="<?php echo base_url(); ?>assets/images/express_deals1.png" />
</span>

                <div class="top50 "><img src="<?php echo base_url(); ?>assets/images/dealoftheday.png" /></div>
            
            </div>
        </div>
        <!-- SLIDER WRAPPER -->
        <div id="wrapper">
            <div class="slider-wrapper theme-default">
                <div id="slider" class="nivoSlider">
                 <?php
						$slider_images = $this->home->get_fightsliderImages(); 
						if(isset($slider_images)){ if($slider_images != ''){ foreach($slider_images as $si){
						?>
                    <img src="<?php echo base_url(); ?>admin/banner_images/<?php echo $si->file_path;?>" />
                   
				  <?php }}}?>
                  
                </div>
                <div id="htmlcaption" class="nivo-html-caption">
                    <strong>This</strong> is an example of a <em>HTML</em> caption with <a href="#">a link</a>. 
                </div>
            </div>
        </div> <!-- SLIDER WRAPPER END -->
        <div class="clear"></div>
        <!-- CONTENT WRAPPER -->
        <div class="top10"></div>
        <div class="content_wrapper">
    <div class="inner_wrapper" style="margin-top:200px;">
        <!-- LEFT SIDE -->
                
                <div style="width:1020px; height:auto; float:left;">
                
                <div class="step1">
                
                <div class="box1">
                
                 <h1 style="font-weight:bold; font-size:18px;">Recent Search</h1>
                    <div class="left_side_box" style="min-height:302px;">
                        <div class="heading_left" style="color:#05407a; font-weight:bold;">Flight</div>
						<?php $recent_search = $this->home->recent_search(); 
						$r= 0;
							  if(isset($recent_search)) { if($recent_search != '') { foreach($recent_search as $rec) {
								  //echo $rec->alocation; 
								  $from1 = $rec->dlocation;
								  $from = substr($from1,0,3);
								  $to1 = $rec->alocation;
								  $to = substr($to1,0,-3);
								  $dep1 = $rec->ddate1;
								  $dep = substr($dep1,0,8);
								  $deps = explode('-',$dep);
								  $depss = "20".$deps[2]."-".$deps[1]."-".$deps[0];
								  
								  $arv1 = $rec->adate1;
								  if(strpos($rec->dlocation,'<br>'))
								  {
								  		$dlocation = explode('<br>',$rec->dlocation);
										$dloc = $dlocation[0];
								  }
								  else
								  {
									  $dloc =$rec->dlocation;
								  }
								  
								  if(strpos($rec->alocation,'<br>'))
								  {
								  		$alocation = explode('<br>',$rec->alocation);
										$count = count($alocation);
										$con = $count -1;
										$aloc = $alocation[$con];
								  }
								  else
								  {
									   $aloc =$rec->alocation;
								  }
								  
								 $from_cit = $this->home->get_from_city($dloc);
								 $to_cit = $this->home->get_from_city($aloc);
								  ?>
                                   <script type="text/javascript">
									function recent_flightas<?php echo $r; ?>()
									{
										$("#recent_flights<?php echo $r; ?>").submit();
									}
									</script>
									<form name="recent_flights<?php echo $r; ?>" id="recent_flights<?php echo $r; ?>" action="<?php echo site_url(); ?>/flights/search1" method="post">
									<input type="hidden" name="from_city1" value="<?php echo $from_cit->city."-".$from_cit->country.",".$from_cit->city_code; ?>"  />
									<input type="hidden" name="to_city1" value="<?php echo $to_cit->city."-".$to_cit->country.",".$to_cit->city_code; ?>"  />
									<input type="hidden" name="adult" value="<?php echo $rec->adults; ?>" />
									<input type="hidden" name="child" value="<?php echo $rec->childs; ?>" />
									<input type="hidden" name="infant" value="<?php echo $rec->infants; ?>" />
									<input type="hidden" name="cabin" value="<?php echo $rec->cabin_selected; ?>"  />
									<input type="hidden" name="sd" value="<?php echo $rec->sd; ?>"  />
                                    <?php if($rec->journey_types == 'Round')
									{
										$journey_type = 'Round';
									}
									else
									{
										$journey_type = 'OneWay';
									}
									if($journey_type == 'Round') { 
									?>
                                    <input type="hidden" name="ed" value="<?php echo $rec->ed; ?>"  />
                                    <?php } else {  ?> <input type="hidden" name="ed" value=""  /> <?php } ?>
								   <input type="hidden" name="journey_type" value="<?php echo $journey_type; ?>"  />
								   </form>
                        <div class="left_txt_area">
                            <div  class="fleft red_txt left10" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"> <?php echo $from; ?> </div>
                            <div class="fleft left10" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"> <img src="<?php echo base_url(); ?>assets/images/arrow_icon.png" /></div>
                            <div class="fleft red_txt left10" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"><?php echo $aloc; ?></div>
                            <div class=" wid100 fleft left40" onclick="recent_flightas<?php echo $r; ?>();" style="cursor:pointer;"><?php echo date('M d',strtotime($depss)); ?> - <?php echo date('M d',strtotime($depss)); ?>  <?php if($rec->journey_types == 'Round') { echo "Round Trip"; } else { echo "One Way"; } ?> &#36;<?php echo round($rec->FareAmount); ?></div>
                        </div>
						<?php $r++; } } } ?>
                        
               </div>
               </div>
               
               <div class="box2">
              <h1 style="font-weight:bold; font-size:18px;">best hotel deals</h1>
                   <?php
				   			$hotel = 0;
							$hotel_deals = $this->home->get_hotelDeals(); 
							if(isset($hotel_deals)){ if($hotel_deals != ''){ foreach($hotel_deals as $hd){
					?>
                    <form name="hotel_form<?php echo $hotel; ?>" id="hotel_form<?php echo $hotel; ?>" action="<?php echo site_url(); ?>/hotels/hotel_search_result1" method="post">
                    <input type="hidden" name="check_in" id="check_in" value="<?php echo date('d-m-Y'); ?>" />
                    <input type="hidden" name="check_out" id="check_out" value="<?php echo date('d-m-Y', strtotime(date('d-m-Y') . ' + 1 day')); ?>" />
                    <input type="hidden" name="room_count[]" id="room_count" value="1" />
                    <input type="hidden" name="adult[]" id="adult" value="1" />
                    <input type="hidden" name="child[]" id="child" value="0" />
                    <input type="hidden" name="hotel_name" id="hotel_name" value="<?php echo $hd->hotel_name; ?>" />
                    </form>
                     <script type="text/javascript">
						function get_hoteldetails<?php echo $hotel; ?>()
						{
							$("#hotel_form<?php echo $hotel; ?>").submit();
						}
					</script>
                    <div class="best_hotel_bg" style="margin-top:3px; margin-left:5px; margin-right:5px; margin-bottom:8px;">
                    	
                        <div style="width:194px; height:auto; float:left;  padding:10px;">
                        
          				<span><img src="<?php echo base_url(); ?>admin/banner_images/<?php echo $hd->image ;?>" width="194" height="80" border="0" title="<?php echo $hd->hotel_name;?>" onclick="get_hoteldetails<?php echo $hotel; ?>()" style="cursor:pointer;"/></span> 
                       </div>
                       
                       <div style="width:215px; height:auto; float:left; background-color:#fff;">
                      <div  style="width:auto; float:left; margin-left:9px; padding:5px;">
                            <span onclick="get_hoteldetails<?php echo $hotel; ?>()"><?php echo $hd->hotel_name; ?><span class="red_txt1"><br/> From &#36;<?php echo $hd->fare;?></span></span> <span class="blue_txt1"><a href="#" style="text-decoration:blink; font-weight:bold; color:#083e73;" >Book Now </a></span>
                        </div> </div>
                    </div>
                    <?php $hotel++; }}}?>
               </div>
               
               
               <div class="box3">
               
               <h1 style="font-weight:bold; font-size:18px;">Best car deals</h1>
                    <?php 
							$car_deals = $this->home->get_carDeals();
							$c = 0;
							if(isset($car_deals)){if($car_deals != ''){ foreach($car_deals as $cd){
					?>
                    <script type="text/javascript">
							function car_deals_form<?php echo $c; ?>()
							{
								$("#car_dealsfr<?php echo $c; ?>").submit();
								//document.car_dealsfr<?php echo $c; ?>.submit();
							}
							</script>
                    <form name="car_dealsfr<?php echo $c; ?>" id="car_dealsfr<?php echo $c; ?>" action="<?php echo site_url(); ?>/car/search/<?php echo $cd->traveltype; ?>" method="post">
                    <input type="hidden" value="<?php $cd->traveltype; ?>" name="travel_type"  />
                    	<?php if($cd->traveltype == 1) { ?>
                    	<input type="hidden" name="city_from_local" id="city_from_local" value="<?php echo $cd->source_local; ?>"  />
                        <input type="hidden" name="duration_local" id="duration_local" value="6"  />
                        <input type="hidden" name="sd" id="sd" value="<?php echo date('d-m-Y'); ?>"  />
                        <?php }
						else
						{ ?>
                        <input type="hidden" name="city_from" id="city_from" value="<?php echo $cd->source_outstation; ?>"  />
                        <input type="hidden" name="city_to" id="city_to" value="<?php echo $cd->city_to; ?>"  />
                        <input type="hidden" name="duration" id="duration" value="22"  />
                        <input type="hidden" name="ed" id="ed" value="<?php echo date('d-m-Y'); ?>"  />
                        <?php } ?>
                    </form>
                    <div class="right_txt_area"> 
                        <div class="fleft wid100" style="margin-right:10px;">
                        	<a href="#" title="<?php echo $cd->carname;?>"><img src="<?php echo base_url(); ?>admin/banner_images/<?php echo $cd->image ;?>" border="0" align="top" width="92" height="65" onclick="car_deals_form<?php echo $c; ?>();"/></a>
                        </div>
                        <div onclick="car_deals_form<?php echo $c; ?>();" style="cursor:pointer;  line-height:16px; font-size:12px;  "><?php $car_det = $cd->cardetails; echo substr($car_det,0,53).'...';?></div>
                    </div>
                    <?php $c++; }}}?></div>

         
</div>

<div class="step1" style="margin-top:10px;" >
      
           <div class="box4">
            <h1 style="font-weight:bold; font-size:18px;">Best Flight Offers</h1>
            <span><img src="<?php echo base_url(); ?>assets/images/w1.jpg" /></span>
           
           </div>
           
           
           <div class="box5" >
           <h1 style="font-weight:bold; font-size:18px;">Top Hotel deals</h1>
           <div class="box1body">
<div class="special-body">
<div class="special-box">
<div class="special-boxin">
<div class="special-img"><img src="<?php echo base_url(); ?>assets/images/tophotel.jpg" width="92" height="86" /></div>
<div class="special-textbox">
<h2>Dubai Holidays</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text f the printing </p>
</div>
<div class="special-textbox-rightimg"></div>
<div class="special-textbox-right">
<div class="special-form">Form</div>
<div class="special-rate">$4500</div>
<div class="special-form" style="margin-top:3px;">On Words</div>
</div>

</div>
</div>

<div class="special-box">
<div class="special-boxin">
<div class="special-img"><img src="<?php echo base_url(); ?>assets/images/tophotel.jpg" width="92" height="86" /></div>
<div class="special-textbox">
<h2>Dubai Holidays</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text </p>
</div>
<div class="special-textbox-rightimg"></div>
<div class="special-textbox-right">
<div class="special-form">Form</div>
<div class="special-rate">$4500</div>
<div class="special-form" style="margin-top:3px;">On Words</div>
</div>

</div>
</div>

<div class="special-box">
<div class="special-boxin">
<div class="special-img"><img src="<?php echo base_url(); ?>assets/images/tophotel.jpg" width="92" height="86" /></div>
<div class="special-textbox">
<h2>Dubai Holidays</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy texthe printing and typesetting industry.  </p>
</div>
<div class="special-textbox-rightimg"></div>
<div class="special-textbox-right">
<div class="special-form">Form</div>
<div class="special-rate">$4500</div>
<div class="special-form" style="margin-top:3px;">On Words</div>
</div>

</div>
</div>

</div>

</div>
</div>


</div>
           
           </div>    
               
    
</div>

</div>   
        <style>
            .middle_box{border: none;border-radius: 0px; }
            .webwidget_tab{font-size: 12px; font-family:Verdana, Geneva, sans-serif;}.tabContainer{width:100%;background:url('../../assets/images/tab/tab.gif') repeat-x bottom;overflow:hidden;}.tabContainer li{float:left;margin-right:2px;background:url('../../assets/images/tab/tabOff_right.gif') no-repeat right top;}.tabContainer li a{display:block!important;display:inline-block;padding:0 15px;height:27px;line-height:27px;background:url('../../assets/images/tab/tabOff_left.gif') no-repeat left top;}
.webwidget_tab .tabHead{list-style-type: none; margin:0px;padding:0px;}
.webwidget_tab .tabBody{border-left:#dbdbdb solid 1px;border-right:#dbdbdb solid 1px;background-color: white;}
.webwidget_tab .tabBody ul,li{ margin: 0px;padding: 0px;list-style: none;}
.webwidget_tab .tabBody ul{   
}
.webwidget_tab .tabBody ul li{    
}
.webwidget_tab .tabHead li a{font-weight: bold;text-decoration: none;color: #0099FF;}
.webwidget_tab .tabCot{}
.webwidget_tab .tabCot p{margin: 0px;padding:5px;}
.webwidget_tab .tabContainer li.currentBtn{background:url('../../assets/images/tab/tabOn_right.gif') no-repeat right top;}
.webwidget_tab .tabContainer li.currentBtn a{height:28px;background:url('../../assets/images/tab/tabOn_left.gif') no-repeat left top;color:#434142;}
.webwidget_tab .modA{margin:10px;}
.webwidget_tab .modBody{border-left:#dbdbdb solid 1px;border-right:#dbdbdb solid 1px; background-color: white;}
.webwidget_tab .modTop h3{padding:0px;margin:0px;height:28px;background:url('../../assets/images/tab/modAT.gif') repeat-x left top;color:#2C6A78;font-size:12px;line-height:25px;}
.modTop span.modATL,.modTop span.modATR{float:left;width:4px;height:28px;background:url('../assets/images/tab/bg.gif') no-repeat left top;overflow:hidden;}.modTop span.modATR{float:right;background:url('../../assets/images/tab/bg.gif') no-repeat -4px top;}.modA #sideNav dd a:hover{background:url('../../assets/images/tab/bg.gif') no-repeat left -110px;color:#FFF;text-decoration:none;}
.webwidget_tab .modBottom{width:100%;height:4px;background:url('../../assets/images/tab/modAB.gif') repeat-x left top;overflow:hidden;}
.webwidget_tab .modBottom span.modABL,.modBottom span.modABR,.modTopB span.modATR,.modTopB span.modATL{float:left;width:4px;height:4px;background:url('../../assets/images/tab/bg.gif') no-repeat left -28px;overflow:hidden;}
.webwidget_tab .modBottom span.modABR{float:right;background:url('../../assets/images/tab/bg.gif') no-repeat -4px -28px;}

 </style>
<!--<script type='text/javascript' src='<?php echo base_url(); ?>assets/js/jquery-1.3.2.min.js'></script>-->

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/webwidget_tab.js"></script>
       
        <script language="javascript" type="text/javascript">

            $(function() {
                $(".webwidget_tab").webwidget_tab({
                    window_padding: '10',
                    head_text_color: '#0099FF',
                    head_current_text_color: '#666'
                });
            });
        </script>
       
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
    </body>
    <script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
        var siteUrl = "<?php echo site_url() ?>";
    </script>
    <!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />

    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/flights_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui1.css" />
    <!--###########DATE PICKER#############--->
     
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bjqs-1.3.min.js"></script>
    <!-- Home Slider Javascript--> 
    
    <script class="secret-source">
    jQuery(document).ready(function($) {
        $('#tabs').smartTab({autoProgress: false, stopOnFocus: true, transitionEffect: 'vSlide'});
    });
    </script><!-- Home Slider Javascript END-->
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $('#slider').nivoSlider({effect:'fade'});
			slider.trigger('nivo:animFinished');
        });
    </script>
    
    <script>
    function zeroPad(num, count)
    {
        var numZeropad = num + '';
        while (numZeropad.length < count) {
            numZeropad = "0" + numZeropad;
        }
        return numZeropad;
    }
    
    function dateADD(currentDate)
    {
        var valueofcurrentDate = currentDate.valueOf() + (24 * 60 * 60 * 1000);
        var newDate = new Date(valueofcurrentDate);
        return newDate;
    }
    var holydays = ['14-01-2014', '15-01-2014', '16-01-2014'];
	function highlightDays(date) {
		//alert("hii");
    for (var i = 0; i < 3; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
			//alert("hi");
            return [true, 'highlight'];
        }
    }
    return [true, ''];

}
var holydays = ['01/01/2014','01/20/2014','02/17/2014','05/26/2014','07/04/2014','09/01/2014','10/13/2014','11/11/2014','11/27/2014','12/25/2014'];
var tips  = ['New Year','Martin Luther King Day','Presidents Day (Washington Birthday)','Memorial Day','Independence Day','Labor Day','Columbus Day','Veterans Day','','Christmas']; 
function highlightDays(date) {
   
    for (var i = 0; i < holydays.length; i++) {
        if (new Date(holydays[i]).toString() == date.toString()) {
            return [true, 'highlight',tips[i]];
        }
    }
    return [true, ''];

}
    $(function() {
		
        $( "#datepicker" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            minDate: 1,
			firstDay: 1,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        
       /* $( "#datepicker1" ).datepicker({
			changeMonth: true,
			changeYear: true,
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            minDate: 1
        });*/
        
    });
   
   $("#datepicker").change(function(){
				var selectedDate1= $("#datepicker").datepicker('getDate');
			  	var nextdayDate  = dateADD(selectedDate1);
				var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
				$t = nextDateStr;
				$('#out').html('<input type="text" name="ed" id="datepicker1" class="search_input_box4" value="'+$t+'" style="color:#999999;"/> ');+
				$(function() {
							$( "#datepicker1").datepicker({
								
								 numberOfMonths: 2,
								 firstDay: 1,
								dateFormat: 'dd-mm-yy',
								buttonImageOnly: true,
								minDate: $t
							});

						});
			});
    
    $('#oneway').click(function () {
        $('#return_date').hide();
    });
    $('#roundtrip').click(function () {
        $('#return_date').show();
    });
</script>

<script type="text/javascript">
    var s1 =  document.getElementById("s1");
    var s2 = document.getElementById("s2");
    var s3 = document.getElementById("s3");
    onchange_comb(); //Change options after page load
    s1.onchange = onchange_comb; // change options when s1 is changed
    function onchange_comb()
    {
        if (s1.value == '9') {
               s2.style.visibility = 'hidden';
               child.style.visibility = 'hidden';
           }else{
               s2.style.visibility = 'visible';
               child.style.visibility = 'visible';
           }

           <?php foreach ($adult_arr as $sa) {?>
               if (s1.value == '<?php echo $sa; ?>') {
                   option_html = "";
                   <?php if (isset($adult_arr1[$sa])) { ?> // Make sure position is exist
                       <?php foreach ($adult_arr1[$sa] as $value) { ?>
                           option_html += "<option><?php echo $value; ?></option>";
                       <?php } ?>
                   <?php } ?>
                   s2.innerHTML = option_html;
               }
           <?php } ?>

           <?php foreach ($adult_arr as $sa) {?>
               if (s1.value == '<?php echo $sa; ?>') {
                   option_html = "";
                   // Make sure position is exist
                       <?php foreach ($adult_arr2[$sa] as $value) { ?>
                           option_html += "<option><?php echo $value; ?></option>";
                       <?php } ?>

                   s3.innerHTML = option_html;
               }
           <?php } ?>
    }
    
    function addinanotherinput1(val)
    {
        document.getElementById("airfill_1").value=val;   		
    }
    
    function submitFlight()
    {
        document.flight_search.submit();
    }
</script>
</html>
