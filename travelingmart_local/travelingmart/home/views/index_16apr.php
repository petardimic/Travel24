
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Norway</title>
        <meta name="description" content="Full view calendar component for twitter bootstrap with year, month, week, day views.">
        <meta name="keywords" content="jQuery,Bootstrap,Calendar,HTML,CSS,JavaScript,responsive,month,week,year,day">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <link href="<?php print WEB_DIR ?>css/1200.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/980.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/979.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/979-768.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/767.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/480.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/bootstrap.css" rel="stylesheet"> 
        <!--<link href="css/bootstrap.min.css" rel="stylesheet">--> 
        <link href="<?php print WEB_DIR ?>css/custom_responsive.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/bootstrap-responsive.min.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/custom.css" rel="stylesheet"> 
        <link href="<?php print WEB_DIR ?>css/date/kendo.common.min.css" rel="stylesheet" />
        <link href="<?php print WEB_DIR ?>css/date/kendo.default.min.css" rel="stylesheet" />
        <link href="<?php print WEB_DIR ?>css/responsive-calendar.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/less/responsive-calendar.less" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/calendar.css" rel="stylesheet">
        <link href="<?php print WEB_DIR ?>css/jquery.css" rel="stylesheet">
        <script type="text/javascript" src="<?php print WEB_DIR ?>js/Jquery.ui.js"></script>
         <script type="text/javascript" src="<?php print WEB_DIR ?>js/jquery.new.js"></script>
        <script type="text/javascript" src="<?php print WEB_DIR ?>autofill/js/bsn.AutoSuggest_c_2.0.js"></script>
<link rel="stylesheet" href="<?php print WEB_DIR ?>autofill/css/autosuggest_inquisitor.css" type="text/css" media="screen" charset="utf-8" />

        <!-- Fav and touch icons -->
        <link rel="shortcut icon" href="<?php print WEB_DIR ?>images/img/favicon.png">
        <script type="text/javascript">

 function validate_form()
 {
	 var dorigin = $('#dorigin').val();
	 var dorigin = $('#dorigin').val();
	 var ddestination= $('#ddestination').val();
	 var sd = $('#datepicker_value').val();
	 var ed = $('#datepicker_value1').val();
	  var stryear1 = sd.substring(6);
 var strmth1  = sd.substring(0,2);
 var strday1  = sd.substring(5,3);
 var date1    = new Date(stryear1  ,strmth1,strday1);

 //seperate the year,month and day for the second date
 var stryear2 = ed.substring(6);
 var strmth2  = ed.substring(0,2);
 var strday2  = ed.substring(5,3);
 var date2    = new Date(stryear2 ,strmth2,strday2  );
 var datediffval = (date2 - date1 )/864e5;
 var id=
   alert(ddestination);

	// var ddestination = $('#ddestination').val();
	
	 if(dorigin == 'Type Departure Location Here' || dorigin == '')
	 {
		  document.getElementById("date_error").innerHTML = "Please Select Travelling From";
		  document.getElementById("dorigin").focus();
		 return false;
	 }
	 else if(ddestination == 'Type Arrival Location Here' || ddestination == '')
	 {
		 document.getElementById("dorigin_error").innerHTML = "";
		  document.getElementById("date_error").innerHTML = "Please Select Travelling To";
		  document.getElementById("ddestination").focus();
		 return false;
	 }
	 else if(sd == '')
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error").innerHTML = "Please Select Departure Date";
		 document.getElementById("datepicker_value").focus();
		 return false;
	  }
	  else if(datediffval>0)
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 ///document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error").innerHTML = "Please select  proper checkout date";
		 document.getElementById("datepicker_value1").focus();
		 return false;
	  }
	   else if(datediffval>=20)
	  {
		 document.getElementById("dorigin_error").innerHTML = "";
		 ///document.getElementById("ddestination_error").innerHTML = "";
		 document.getElementById("date_error").innerHTML = "Please select date within 20days";
		 document.getElementById("datepicker_value1").focus();
		 return false;
	  }
	  else
	  {
		  document.getElementById("dorigin_error").innerHTML = "";
		  document.getElementById("date_error").innerHTML = "";
		  //document.getElementById("ddestination_error").innerHTML = "";
		 // document.flight_search.submit();
	  }
	 
 }


 </script>
 <script type="application/javascript">
function validateForm()
{
var x=document.forms["Search_flight"]["dorigin"].value;
var y=document.forms["Search_flight"]["ddestination"].value;
var z=document.forms["Search_flight"]["s1"].value;
var a=document.forms["Search_flight"]["s3"].value;
var b=document.forms["Search_flight"]["datepicker_value"].value;
var stryear1 = b.substring(6);
var strday1 = b.substring(0,2);
var strmth1 = b.substring(5,3);
var date1 = new Date(stryear1,strmth1,strday1);

var c=document.forms["Search_flight"]["datepicker_value1"].value;

var stryear = c.substring(6);
var strday = c.substring(0,2);
var strmth = c.substring(5,3);
var date2 = new Date(stryear,strmth,strday);

var datediffval = (date2 - date1 )/864e5;

if (x==null || x=="")
  {
  alert("Please Select Travelling From");
  document.Search_flight.dorigin.focus() ;
  return false;
  }
if (y==null || y=="")
  {
  alert("Please Select Travelling To");
  document.Search_flight.ddestination.focus() ;
  return false;
  }
if (z==null || z==0)
  {
  alert("Please Select Adult");
  document.Search_flight.ddestination.focus() ;
  return false;
  }
  if (a>=z)
  {
  alert("Please Select Infant as per adult");
  document.Search_flight.ddestination.focus() ;
  return false;
  }
  if (b==null || b=="")
  {
  alert("Select Check in Date");
  document.Search_flight.ddestination.focus() ;
  return false;
  }
    if (datediffval<1)
  {
  alert("Select Proper Check out date");
  document.Search_flight.ddestination.focus() ;
  return false;
  }

}
 </script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js">
</script>
 	<script>
$(document).ready(function(){
  $("#roundtrip").click(function(){
     $("#overlay1").hide();
  });
  $("#optionsRadios1").click(function(){
     $("#overlay1").show();
  });
});
</script>
 <script type="text/javascript">
$().ready(function() {

$("#datepicker").datepicker({
	onSelect: function(dateText, inst) { 
	
		$("#datepicker_value").val(dateText);
	},
	dateFormat: 'dd-mm-yy',
});
$("#datepicker1").datepicker({
	
	onSelect: function(dateText, inst) { 
	
		$("#datepicker_value1").val(dateText);
	},
	dateFormat: 'dd-mm-yy',
});

});

</script>
<script>
function myFunction()
{
document.getElementById("Search_flight").reset();
}
</script>

<style>
.ui-widget-content {
	border:0px;
	}
</style>
    </head>
   
    <body>

        <div class="header">
            <div class="container">
                <div class="row-fluid top-bottom15">
                    <div class="span4">
                        <img src="<?php print WEB_DIR ?>images/img/logo.png">
                    </div>
                    <div class="span8">
                        <div class="navbar top25">
                            <!--<div class="navbar-inner">-->
                            <div class="container">
                                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <!--<a class="brand" href="#">Project name</a>-->
                                <div class="nav-collapse collapse">
                                    <ul class="nav">
                                        <li class="active"><a href="#">FLYBILLETTER</a></li>
                                        <li><a href="#about">HOTELL</a></li>
                                        <li><a href="#contact">STOREBYFERIE</a></li>
                                        <li><a href="#contact">SOL OG BAD</a></li>
                                        <li><a href="#contact">TOPPLISTER</a></li>
                                    </ul>
                                </div><!--/.nav-collapse -->
                            </div>
                            <!--</div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container top40">
            <div class="row">
                <div class="span6">
                    <h4>SØK FLYBILLETTER / SAS - STAR ALLIANCE</h4>
                    <p>Forsiden/ <span style="color: #999;">Billige Flybilletter</span></p>
                </div>
                <div class="span6 align-right">
                   <div id="flip" class="detail-cross-btn top20" onClick="clickslide()">Skjul/vis sokeboksen X</div>
                </div>
            </div>
 <form id="Search_flight" action="<?php echo WEB_URL; ?>flight/flight_search_result" method="post" onsubmit="return validateForm()">
 <span id="date_error" style="color:#F00;"></span>
            <div id="panel" class="search-box">
                <div class="row-fluid">
               
                    <div class="span5 top10">
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="row-fluid">
                                
                                    <div class="span6">
                                        <label class="radio">
                                         <input type="radio" name="journey_type" value="OneWay" id="optionsRadios1" /><strong>Tur/ retur</strong>
                                            
                                        </label>
                                    </div>
                                    <div class="span6">
                                        <label class="radio">
                                         
                                            <input type="radio" name="journey_type" id="roundtrip" value="Calendar" checked ><strong>Enkel</strong>
                                        </label>                                
                                    </div>
                                    <!--<div class="span6">
                                   
                                        <label class="radio">
                                         
                                            <input type="radio" name="journey_type" id="calender" value="Calendar"  ><strong>Calender</strong>
                                        </label>                                
                                    </div>-->
                                </div>
                                
                                <div class="row-fluid">
                                    <div class="span12">
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
        <label style="margin: 0px;"><strong>Reis Fra</strong></label>
                                        <input type="text" class="search-input" name="from_city" id="dorigin" tabindex="2" 
                    onchange="DropDownIndexClear('DropDownExTextboxExample');"
                     value="" >
<!--                                        <input style="color:#70a4d1;"  type="date" name="sd" id="datepicker"  />
                           <br  /><span id="date_error" style="color:#F00;"></span>-->
                                        <script type="text/javascript">
	    var options = {
		script:"<?php echo WEB_DIR; ?>test_airport.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('dorigin').value = obj.id; } };
	    var as_json = new AutoSuggest('dorigin', options);
        </script>
                                        <label style="margin: 0px;"><strong>Reis Til</strong></label>
                                        <input type="text" class="search-input" style="margin-bottom: 0px;" name="to_city" id="ddestination" tabindex="1" 
                    onchange="DropDownIndexClear2('DropDownExTextboxExample');"  
    value="" >
    <!-- <span id="out"><input style="color:#70a4d1;"  type="date" name="ed" id="datepicker1"   /></span>-->
                                        <script type="text/javascript">
					var options = {
					script:"<?php echo WEB_DIR; ?>test_airport.php?json=true&",varname:"input",json:true,callback: function (obj) { document.getElementById('ddestination').value = obj.id; } };
					var as_json = new AutoSuggest('ddestination', options);
					</script>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span6 top20">
                                        <button class="btn top10" type="reset" value="Reset" onclick="myFunction()">Nullstill s0k</button>
                                    </div>
                                   <!-- <div class="span6 top10">
                                         <label style="margin: 0px;"><strong>Class</strong></label>
                                         <select name="cabin" style="text-indent: 0.01px;text-overflow: ''; padding:5px; height:30px;color:#70a4d1;"  class="sele-width" >
                                        <option value="All" selected="selected">All</option>
                                        <option value="First, Supersonic">First, Supersonic</option>
                                        <option value="Business">Business</option>
                                        <option value="Economic">Economic</option>
                                        <option value="Premium Economy">Premium Economy</option>
                                        <option value="Standard Economy">Standard Economy</option>
                                </select>
                                    </div>-->
<!--                                    <div class="span12 top20">
                                       <select name="cabin_type" style="width:100%;" class="sele-width">
                                        <option value="Mandatory cabin" selected="selected">Mandatory cabin</option>
                                        <option value="Recommended cabin">Recommended cabin</option>
                                        <option value="Major cabin">Major cabin</option>
                                </select>
                                    </div>-->
       
                                </div>
                            </div>
                            <div class="span6">
                                <div class="row-fluid">
                                    <div class="span12">
                                        <strong>Reisende</strong>
                                    </div>
                                </div>
                                <div class="row-fluid">
                                    <div class="span12">
                                        <label style="margin: 0px;"><strong>Voksen</strong></label>
                                        <select class="sele-width" name="adult" id="s1">
                                        	
                                            <option value="1" selected>1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                        <label style="margin: 0px;"><strong>Barn (2-11 ar)</strong></label>
                                        <select class="sele-width" name="child" id="s2">
                                        <option value="0" selected>0</option>
                                         <option value="1">1</option>
                                            
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                        </select>
                                        <label style="margin: 0px;"><strong>Spedbarn (0-23 mnd)</strong></label>
                                        <select class="sele-width" style="margin-bottom: 0px;" name="infant" id="s3">
                                            <option value="0" selected>0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                        </select>
                                       
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    
                    <div class="span5">
                        <div class="row-fluid">
                            <div class="span6">
                                <label><strong>Check In</strong></label>
                                <div id="datepicker"></div>

<input type="hidden" name="sd" id="datepicker_value" />
<!--                                <div class="responsive-calendar cal-bg">
                                    <div class="controls">
                                        <a class="pull-left" data-go="prev"><div class="btn-arrow"> < </div></a>
                                        <strong><span data-head-year></span> <span data-head-month></span></strong>
                                        <a class="pull-right" data-go="next"><div class="btn-arrow"> > </div></a>
                                    </div><hr style="margin: 2px;">
                                    <div class="day-headers">
                                        <div class="day header">Mon</div>
                                        <div class="day header">Tue</div>
                                        <div class="day header">Wed</div>
                                        <div class="day header">Thu</div>
                                        <div class="day header">Fri</div>
                                        <div class="day header">Sat</div>
                                        <div class="day header">Sun</div>
                                    </div>
                                    <div class="days" data-group="days">

                                    </div>
                                </div>-->
                            </div>
                            <div class="span6">
                                <label><strong>Check Out</strong></label>
                                <div id="return_date"><div id="overlay1"></div><div id="datepicker1"></div>

<input type="hidden" name="ed" id="datepicker_value1" /></div>
<!--                                <div class="responsive-calendar cal-bg">
                                    <div class="controls">
                                        <a class="pull-left" data-go="prev"><div class="btn-arrow"> < </div></a>
                                        <strong><span data-head-year></span> <span data-head-month></span></strong>
                                        <a class="pull-right" data-go="next"><div class="btn-arrow"> > </div></a>
                                    </div><hr style="margin: 2px;">
                                    <div class="day-headers">
                                        <div class="day header">Mon</div>
                                        <div class="day header">Tue</div>
                                        <div class="day header">Wed</div>
                                        <div class="day header">Thu</div>
                                        <div class="day header">Fri</div>
                                        <div class="day header">Sat</div>
                                        <div class="day header">Sun</div>
                                    </div>
                                    <div class="days" data-group="days">
	
                                    </div>
                                 </div>-->
                            </div>
                        </div>
                    </div>
 
                    <div class="span2">
                       <!--<img src="<?php print WEB_DIR ?>images/img/search-botton.png" class="top95-rep">-->
                      <!-- <button id="submit" value="Submit" >submit</button>-->
                        <input type="image" name="submit" id="submitssss" value="submit" class="top95-rep" src="<?php print WEB_DIR ?>images/img/search-botton.png" >
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
                </div>
            </div>     
</form>


            <!--<div class="flight-search-box top20">
                <div class="row-fluid">
                    <div class="span4">
                        <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="<?php print WEB_DIR ?>images/img/sas.png">
                            </a>
                            <div class="media-body top10">
                                <h4 class="media-heading">Scandinavian Airlines</h4>    
                            </div>
                        </div>
                        <h5>FLYAVGANGER MED SAS /STARALLIANCE</h5>
                        <div class="row-fluid">
                            <div class="span12">
                                <h4 style="margin: 0px;">OSL - BKK | 12/02 &nbsp; &nbsp; &nbsp; 1 voksen</h4>
                                <h4 style="margin: 0px;">BKK - OLS | 28/02 </h4>
                            </div>
                        </div>
                        <div class="row-fluid top10">
                            <div class="span12">
                                <h5><a href="#" id="show" style="text-decoration: underline;">Mer info om denne reisen</a></h5>
                            </div>
                        </div>
                    </div>
                    <div class="span8">
                        <div class="flight-home">
                            <div class="row-fluid">
                                <div class="span8">
                                    <div class="row-fluid">
                                        <div class="span6">
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label>Utreise</label>
                                                    <input type="text" class="span12 place-color" placeholder="OSL 20:50" style="background-color: #276baa;border: 1px solid #276baa;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-left-icon.png">
                                                </div>
                                                <div class="span5">
                                                  \
                                                    <input type="text" class="span12 top25-rep place-color" placeholder="BKK 00:25" style="background-color: #276baa;border: 1px solid #276baa;">
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span5">
                                                    <label>Hjemreise</label>
                                                    <input type="text" class="span12 place-color" placeholder="BKK 00:25" style="background-color: #958c29;border: 1px solid #958c29;">
                                                </div>
                                                <div class="span2 top300">
                                                    <img src="<?php print WEB_DIR ?>images/img/flight-right-icon.png">
                                                </div>
                                                <div class="span5">
                                                   
                                                    <input type="text" class="span12 top25-rep place-color" placeholder="OSL 20:50" style="background-color: #958c29;border: 1px solid #958c29;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="span6">
                                            <div class="row-fluid top30">
                                                <div class="span6">
                                                    12t 15m
                                                </div>
                                                <div class="span6">
                                                    1 stopp (CPH)
                                                </div>
                                            </div>
                                            <div class="row-fluid top32">
                                                <div class="span6">
                                                    12t 15m
                                                </div>
                                                <div class="span6">
                                                    1 stopp (CPH)
                                                </div>
                                            </div>
                                            <div class="row-fluid align-right">
                                                <div class="span12">
                                                    <h5><a href="#" style="text-decoration: underline; color: #fff;">+9 ledige plasser</a></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="span4 align-right">
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <span>Kr <b style="font-size: 50px;">7.470</b></span>
                                        </div>
                                    </div>
                                    <div class="row-fluid top40">
                                        <div class="span12">
                                            <img src="<?php print WEB_DIR ?>images/img/price-btn.png">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>-->

            
            <div class="row-fluid">
                <div class="span9">
                    
                    <div id="panel2"  class="row-fluid" >
                     <div class="row-fluid top20">
                <!--<div class="span6">
                    <div class="reisedetaljer-head">
                        <strong>Lavpriskalender</strong>
                    </div>
                </div>
-->                        <!-- <div class="span6 align-right">
                             <div id="hide" class="detail-cross-btn">Skjul Detaljer X</div>
                </div>-->
            </div>
                     <!--<div class="flight-calander">
                        <div class="row-fluid">
                            <div class="span12">
                                <p>Reisedetaljer</p>
                                <strong>OSLO - BANGKOK TORSDAG 13. MARS 2014</strong> 
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4>OSLO - KØBENHAVN</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="span6">

                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">
                                                        <h4>KØBENHAVN - BANGKOK</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>22:15 - 15:20</td>
                                                                <td>10:20</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="resize-content">
                                                        (Terminal 3) (SK973)<br/>
                                                        Flyselskap: Scandinavian Airlines<br/>
                                                        Flytype: Airbus Industrie A340-300
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row-fluid top20">
                            <div class="span12">
                                <p>Reisedetaljer</p>
                                <strong>BANGKOK - OSLO TORSDAG 20. MARS 2014</strong> 
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span6">
                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">
                                                        <h4>KØBENHAVN - BANGKOK</h4>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>22:15 - 15:20</td>
                                                                <td>10:20</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <div class="resize-content">
                                                        (Terminal 3) (SK973)<br/>
                                                        Flyselskap: Scandinavian Airlines<br/>
                                                        Flytype: Airbus Industrie A340-300
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>



                            </div>
                            <div class="span6">
                                <div class="row-fluid top10">
                                    <div class="span12">
                                        <div class="resize-fly">
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <div class="resize-head">

                                                        <h4>OSLO - KØBENHAVN</h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row-fluid">
                                                <div class="span12">
                                                    <table class="table resize-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Avganger :</th>
                                                                <th>Reisetid :</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="success1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                            <tr class="error1">
                                                                <td>18:00 - 19:15</td>
                                                                <td>01:15</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row-fluid top20 align-center">
                            <div class="span12">
                                <button class="btn btn-primary" type="button">TILBAKE TIL KALENDER</button>
                            </div>
                        </div>
                    </div>-->
                        </div>
                    
                    
                    <div  id="flight_calander">
                    		
                    </div>
                    
                   
                   
                </div>
                
            </div>



        </div> <!-- /container -->

        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?php print WEB_DIR ?>js/jquery.js"></script>
        <script src="<?php print WEB_DIR ?>js/bootstrap-transition.js"></script>
        <script src="<?php print WEB_DIR ?>js/bootstrap-collapse.js"></script>
        <script src="<?php print WEB_DIR ?>js/bootstrap-dropdown.js"></script>

        <!--<script src="js/bootstrap.min.js"></script>-->
        <script src="<?php print WEB_DIR ?>js/responsive-calendar.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $(".responsive-calendar").responsiveCalendar({
                    time: '2013-05',
                    events: {
                        "2013-04-30": {"number": 5, "url": "#"},
                        "2013-04-26": {"number": 1, "url": "#"},
                        "2013-05-03": {"number": 1},
                        "2013-06-12": {}}
                });
            });
        </script>
        
<!--<script type="text/javascript" src="js/jquery.min.js"></script>-->
        <script type="text/javascript" src="<?php print WEB_DIR ?>js/underscore-min.js"></script>
        <script type="text/javascript" src="<?php print WEB_DIR ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php print WEB_DIR ?>js/calendar.js"></script>
        <script type="text/javascript" src="<?php print WEB_DIR ?>js/app.js"></script>

        <script type="text/javascript">
            var disqus_shortname = 'bootstrapcalendar'; // required: replace example with your forum shortname
            (function() {
                var dsq = document.createElement('script');
                dsq.type = 'text/javascript';
                dsq.async = true;
                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
            })();
        </script>
        
        <script> 
		
$(document).ready(function(){
  $("#flip").click(function(){
    $("#panel").toggle();
  });
});
$("a").click(function(event){
  event.preventDefault();
});

</script>

<script>
$(document).ready(function(){
  $("#hide").click(function(){
    $("#panel2").hide();
  });
  $("#show").click(function(){
    $("#panel2").show();
  });
});
$("a").click(function(event){
  event.preventDefault();
});
</script>
<!---Shubhalaxmi--->
 <!--<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />-->

    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php print WEB_DIR ?>js/autocomplete/flights_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <!--<link rel="stylesheet" href="<?php print WEB_DIR ?>css/jquery-ui1.css" />-->
    <!--###########DATE PICKER#############--->
     
    <script type="text/javascript" src="<?php print WEB_DIR ?>js/jquery.smartTab.js"></script>
    <script src="<?php print WEB_DIR ?>js/bjqs-1.3.min.js"></script>
    <!---shubhalaxmi--->
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
		
        $( "#datepicker_value" ).datepicker({
            numberOfMonths: 2,
            dateFormat: 'dd-mm-yy',
            minDate: 1,
			firstDay: 1,
			inline: true,
			beforeShowDay: highlightDays
			
        });
        
        $( "#datepicker1" ).datepicker({
//			changeMonth: true,
//			changeYear: true,
//            numberOfMonths: 2,
//            dateFormat: 'dd-mm-yy',
//            minDate: 1
//        });
        
    });
   
   $("#datepicker_value").change(function(){
				var selectedDate1= $("#datepicker_value").datepicker('getDate');
			  	var nextdayDate  = dateADD(selectedDate1);
				var nextDateStr = zeroPad(nextdayDate.getDate(),2)+"-"+zeroPad((nextdayDate.getMonth()+1),2)+"-"+(nextdayDate.getFullYear());
				$t = nextDateStr;
				$('#out').html('<input type="text" name="datepicker1" id="datepicker_value1"  value="'+$t+'" style="color:#70a4d1;"/> ');+
				$(function() {
							$( "#datepicker_value1").datepicker({
								
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
	 //alert('helllo');
  /* Attach a submit handler to the form */
$("#Search_flight").submit(function(event) {

    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#flight_calander").html('');
    var loder='<div id="loder" style="margin-left:350px;"><img src="<?php echo WEB_DIR; ?>images/1c5b8_loading_big_transparent.gif" /></div>';
    $("#flight_calander").html(loder);
	
    /* Get some values from elements on the page: */
    var values = $(this).serialize();

    /* Send the data using post and put the results in a div */
    $.ajax({
        url: "<?php echo WEB_URL; ?>flight/flight_search_result",
        type: "post",
        data: values,
        success: function(data){
            $("#loder").hide();
            $("#flight_calander").html(data);
        },
        error:function(){
            
            $("#flight_calander").html('Oops! no results found.');
        }
    });
});
 

</script>
    </body>
</html>
