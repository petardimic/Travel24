<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> DEMO</title>
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
<script src="<?php echo base_url(); ?>assets/js/menu_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<!-- For slider filter and sorting js--> 
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>
    <link type="text/css" href="<?php echo base_url(); ?>assets/js/filter/styles/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filter/flight/filter.js"></script> 
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/filter/flight/sorting.js"></script> 
    <!-- For slider filter and sorting js--> 
<!--#################################################   ############################################################################-->      
<!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/flights_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui1.css" />
    <!--###########DATE PICKER#############--->

<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/stepcarousel.js"></script>

</head>
    
<style type="text/css">
.blue_bg-1 {
    background-color: #013672;
    background-image: linear-gradient(to bottom, #013672, #2475B0);
    background-repeat: repeat-x;
    border-bottom-left-radius: 5px;
    border-bottom-right-radius: 5px;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    box-shadow: 0 2px 4px rgba(50, 50, 50, 0.75);
    padding-bottom: 20px;
    padding-left: 10px;
    padding-right: 10px;
    padding-top: 20px;
}
rental-inner {
    background-color: #FFFFFF;
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    padding-bottom: 5px;
    padding-left: 20px;
    padding-right: 20px;
    padding-top: 20px;
    width: 81%;
}
.stepcarousel{
	position: relative;
	overflow: scroll; /*leave this value alone*/
	width: 1035px; /*Width of Carousel Viewer itself*/
	height: 170px; /*Height should enough to fit largest content's height*/
	-moz-border-radius: 0px 10px 10px 0px;
    -webkit-border-radius: 0px 10px 10px 0px;
    -khtml-border-radius: 0px 10px 10px 0px;
    border-radius: 0px 10px 10px 0px;

	background-color: #none;/*
    background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FFFFFF), to(#F1F1F1));
    background: -webkit-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -moz-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -ms-linear-gradient(top, #F1F1F1, #FFFFFF);
    background: -o-linear-gradient(top, #F1F1F1, #FFFFFF);*/
	margin:0 8px 8px 8px;
	margin-left:160px;
	font-family:Tahoma, Geneva, sans-serif;
	font-size:12px;
}

.stepcarousel .belt{
position: absolute; /*leave this value alone*/
left: 0;
top: 0;
}

.stepcarousel .panel{
	float: left; /*leave this value alone*/
	overflow: hidden; /*margin around each panel*/
	width: 100px; /*Width of each panel holding each content. If removed, widths should be individually defined on each content DIV then. */
	padding-right: 0px;
	padding-left: 0px;
	margin-top: 0px;
	margin-right: 5px;
	margin-bottom: 0px;
	margin-left: 0px;/*
	border-right:1px solid #CCCCCC;*/
	background:none;
	border:1px solid #ccc;
}


</style>
<body>
        <!--########################## HEADER INCLUDE ##############################-->
        <?php $this->load->view('home/header1'); ?>
        <!--########################## HEADER INCLUDE ##############################-->
        <!--#################################### BODY CONTENT STARTS #################################################--->
        <div class="inner_wrapper">
            <!-- LEFT PART -->
            <div class="left_part"> 
            
             <?php /*?><div class="left_header1_bg top20"><span class="left20">Hotel deals in <?php  $tocityval = $this->session->userdata('tocityval'); 
             $city = explode('-',$tocityval);
		echo $city1 = $city[0];?></span></div><?php */?>
        
                <div style="clear:both;"></div>
                <?php /*?><div class="lblue1_bg " id="hotel_details">
					<div id="progressbar2" style="display:none;" align="center"><img src="<?php echo base_url();?>assets/images/290.gif"  /></div>
                    
                </div><?php */?>
                
                <div style="clear:both;"></div>
                
                <script type="text/javascript">
                    function get_form(val)
                    {
                            if(val ==1)
                            {
                                    $("#modify").show('slow');
                                    $("#summary").hide('slow');
                            }
                            else
                            {
                                    $("#modify").hide('slow');
                                    $("#summary").show('slow');
                            }
                    }
                    </script>
               <div class="blue_bg-2" id="summary" style="padding-top:5px;">
                    <h3>Your Search Details</h3>
                    <div class="rental-inner3">
                       <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:0px;">
                               <span style="width:100px; float:left;">Departure From </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $fromCity; ?><br /></span>
                               <span style="width:100px; float:left;">Arrival To </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $toCity; ?><br /></span>
                                <span style="width:100px; float:left;">Journey Type</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['journey_type']; ?><br /></span>
                               <span style="width:100px; float:left;"> Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M y',strtotime($_SESSION['sd'])); ?><br /></span>
                                <span style="width:100px; float:left;">Cabin Class</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['cabin']; ?><br /></span>
                                <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adults']; ?><br /></span>
                                <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['childs']; ?><br /></span>
                                <span style="width:100px; float:left;">Infants</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['infants']; ?></span>
                            </ul>
                        <input type="image" src="<?php echo base_url() ?>assets/images/modify-btn.png" class="top10" border="0" onclick="get_form(1)">                 
                    </div>
                       
               
                </div>
                <div class="blue_bg-1 top30 left5" id="modify" style="display:none; margin-top:15px; margin-left:0px;">
                    <h4>Modify Search</h4>
                    
                   
                    <div class="rental-inner1" style="padding-left:10px; padding-top:10px; padding-bottom:10px; width:179px;">
                       
                       <?php $this->load->view('flights/modify_search'); ?>
                       
                      
                       
                       <p onclick="get_form(2)" style="font-family:Arial; cursor:pointer; padding-left:5px; text-decoration:underline; ">Cancel Search</p>
                    </div>
               
                </div>
                <div class="blue_bg top20 left5" style="margin-left:0px;">
                    <div class="lblue_bg">
                        <div class="left_header" style=" color:#000; margin-bottom:10px;">Price Range</div>
                        <span id="priceSliderOutput" style="font-weight: normal; margin:10px 0px 0px 10px; "></span>
                        <div style="padding:10px 0px 0px 0px; margin: 0px;">
                          <div id="priceSlider" style="width:175px">
                             
                          </div>
                          <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                          <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                        </div>
                    </div>
                </div>
                <div >&nbsp;&nbsp;</div>
                <div id='cssmenu'  >
                    <ul>
                        <?php /*?><li class='has-sub'><a href=''><span>Your Search Details</span></a>
                            <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
                               <span style="width:100px; float:left;">Departure From </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $fromCity; ?><br /></span>
                               <span style="width:100px; float:left;">Arrival To </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $toCity; ?><br /></span>
                                <span style="width:100px; float:left;">Journey Type</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['journey_type']; ?><br /></span>
                               <span style="width:100px; float:left;"> Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M y',strtotime($_SESSION['sd'])); ?><br /></span>
                                <span style="width:100px; float:left;">Cabin Class</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['cabin']; ?><br /></span>
                                <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adults']; ?><br /></span>
                                <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['childs']; ?><br /></span>
                                <span style="width:100px; float:left;">Infants</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['infants']; ?></span>
                            </ul>
                            <div style="clear:both;"></div>
                        </li><?php */?>
                        <?php /*?><li class='has-sub'><a href='#'><span>Modify Search</span></a>
                            <ul>
                                <p>
                                    <?php $this->load->view('flights/modify_search'); ?>
                                </p>
                            </ul>
                            <div style="clear:both;"></div>
                        </li><?php */?>
                        <li class='has-sub'><a href='#'><span>Departure Time</span></a>
                            <ul style="padding:25px 0px">
                                <span id="timeSliderOutput" style="font-weight: normal; margin:0px 0px 0px 70px; float:left; "></span>
                                <div style="padding:20px 0px 0px 0px; margin: 0px;"> <div id="timeSlider" style="width:180px;">
                                </div>
                                    <input type="hidden" name="minTime" id="minTime" class="autoSubmit" />
                                    <input type="hidden" name="maxTime" id="maxTime" class="autoSubmit"  /> </div>
                                   
                               
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>Stops</span></a>
                            <ul >
                                <div  style="float:right; font-family:Arial, Helvetica, sans-serif; font-size:12px;"><input type="checkbox" name="select_all_stops" id="selectall_stops">Select All</div>
                                <div id="stops_filter" style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; "></div>
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>Airlines</span></a>
                            <ul>
                                <div  style="float:right; font-family:Arial, Helvetica, sans-serif; font-size:12px; "><input type="checkbox" name="select_all" id="selectall_airline">Select All</div>
                                <div id="airline_filter" style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; "></div>
                            </ul>
                        </li>
                        <li class='has-sub active'><a href='#'><span>Fare Type</span></a>
                            <ul style=" font-family:Arial, Helvetica, sans-serif; font-size:12px; display: block;">
                                <div class="top10" style="margin-top:2px;"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:5px;" value="NRP" checked  onclick="return filter();"/>Refundable</div>
                                <div class="top10"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:5px;" value="RP" checked  onclick="return filter();"/>Non-Refundable</div>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- LEFT PART END -->

            <!-- RIGHT PART -->
          <!--##################################### RIGHT PART START   ########################################################--->
          <div class="right_part top30">
          <?php //echo "<pre>"; print_r($_SESSION);
		  		$from1 = $_SESSION['fromcityval'];
				$from = explode(',',$from1);
				
				$to1 = $_SESSION['tocityval'];
				$to = explode(',',$to1);
				?>
                <div class="right_main_header" ><span id="flightCount">Searching</span> flights from <?php echo trim($fromCity).", ".$from[1]; ?> to <?php echo trim($toCity).", ".$to[1]; ?></div>
                <div style="color:#063879; margin-top:5px;">Travel Class : <?php echo $_SESSION['cabin']; ?> | Onward : <?php echo date('d M Y',strtotime($_SESSION['sd'])); ?> | Passengers : Adults-<?php echo $_SESSION['adults']; ?>, Child-<?php echo $_SESSION['childs']; ?>, Infant-<?php echo $_SESSION['infants']; ?></div>
                <div class="right_main_bar top20" style="margin-top:15px;">
                    <div class="fleft left20"><img src="<?php echo base_url(); ?>assets/images/white_arrow.png" align="absmiddle" onclick="toggle_matrix(1)" /> &nbsp;Airline Matrix</div>
                    <div class="fright" style="margin-right:20px;"><span onclick="return submitFlight_prev();" style="cursor:pointer;">Prev Day</span>  |  <span onclick="return submitFlight_next();" style="cursor:pointer;">Next Day</span></div>
                    
                   		<script type="text/javascript">
                                    function toggle_matrix(val)
                                    {
                                        if(val == 1)
                                        {
                                            $("#matrix_result").toggle('slow');
                                        }
                                    }
						function submitFlight_prev()
							{
								document.flight_search_prev.submit();
							}
					    </script>
                    <form name="flight_search_prev" id="flight_search_prev" action="<?php echo site_url(); ?>/flights/search" method="post">
                    	<input type="hidden" name="journey_type" value="<?php echo $_SESSION['journey_type']; ?>"  />
                        <input type="hidden" name="from_city" value="<?php echo $_SESSION['fromcityval']; ?>"  />
                        <input type="hidden" name="to_city" value="<?php echo $_SESSION['tocityval']; ?>"  />
                        <input type="hidden" name="sd" value="<?php echo date('d-m-Y',strtotime('-1 day'.$_SESSION['sd'])); ?>"  />
                       <?php if(isset($_SESSION['ed']) && $_SESSION['ed']!=''){ ?>
                        <input type="hidden" name="ed" value="<?php echo $_SESSION['ed']; ?>"  />
                        <?php } ?>
                        <input type="hidden" name="adult" value="<?php echo $_SESSION['adults']; ?>"  />
                        <input type="hidden" name="child" value="<?php echo $_SESSION['childs']; ?>"  />
                        <input type="hidden" name="infant" value="<?php echo $_SESSION['infants']; ?>"  />
                        <input type="hidden" name="cabin" value="<?php echo $_SESSION['cabin']; ?>"  />
                    </form>
                    <script type="text/javascript">
						function submitFlight_next()
							{
								document.flight_search_next.submit();
							}
					    </script>
                        
                         <form name="flight_search_next" id="flight_search_next" action="<?php echo site_url(); ?>/flights/search" method="post">
                    	<input type="hidden" name="journey_type" value="<?php echo $_SESSION['journey_type']; ?>"  />
                        <input type="hidden" name="from_city" value="<?php echo $_SESSION['fromcityval']; ?>"  />
                        <input type="hidden" name="to_city" value="<?php echo $_SESSION['tocityval']; ?>"  />
                        <input type="hidden" name="sd" value="<?php echo date('d-m-Y',strtotime('+1 day'.$_SESSION['sd'])); ?>"  />
                       <?php if(isset($_SESSION['ed']) && $_SESSION['ed']!=''){ ?>
                        <input type="hidden" name="ed" value="<?php echo $_SESSION['ed']; ?>"  />
                        <?php } ?>
                        <input type="hidden" name="adult" value="<?php echo $_SESSION['adults']; ?>"  />
                        <input type="hidden" name="child" value="<?php echo $_SESSION['childs']; ?>"  />
                        <input type="hidden" name="infant" value="<?php echo $_SESSION['infants']; ?>"  />
                        <input type="hidden" name="cabin" value="<?php echo $_SESSION['cabin']; ?>"  />
                    </form>
                    <div class="clear"></div>
                      
                    <!--########################## MATRIX PART START  ###################################-->   
                    <div id="matrix_result" style="color:#000;"></div>
                    <!--######################### MATRIX PART END  ####################################--> 

                    <div class="cler"></div><div class="cler"></div>
                    <div class="sort_bar top10 clear"  >
                        <div class="wid108 right_devider center_txt fleft">Sort By ></div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Airline" rel="data-airline" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> &nbsp;Airline&nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                      </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> &nbsp;Departure&nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                      </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> &nbsp;Arrival&nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Duration" rel="data-duration" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> &nbsp;Duration &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /></a>
                      </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Price" rel="data-price" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> &nbsp;Price &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" border="0" />  </a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft" style="border-right:0px;">
                            <a href="javascript:void(0);" title="Sort By Stops" rel="data-stops" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" border="0" /> &nbsp;Stops &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" border="0" /> </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                   <!--####################### FLIGHT LIST START  #################################-->
                   <div class="resultFlights" id="result">
                       <div id="progressbar" style="display:none; margin-top:10px;" align="center"><img src="<?php echo base_url();?>assets/images/ajax-loader.gif"  /></div>
                   </div>
                   <!--####################### FLIGHT LIST END ####################################-->
                </div>
            </div>
          <!--##################################### RIGHT PART END  ###########################################################--->
        </div>
        <!--#################################### BODY CONTENT ENDS ###################################################--->
        <!--########################## FOOTER INCLUDE ##############################-->
        <?php $this->load->view('home/footer'); ?>
        <!--########################## FOOTER INCLUDE ##############################-->
        
        <script class="secret-source">
        jQuery(document).ready(function($) {
			$('#tabs').smartTab({autoProgress: false,stopOnFocus:true,transitionEffect:'vSlide'});
        });
  </script>


<script type="text/javascript">

stepcarousel.setup({
	galleryid: 'mygallery', //id of carousel DIV
	beltclass: 'belt', //class of inner "belt" DIV containing all the panel DIVs
	panelclass: 'panel', //class of panel DIVs each holding content
	autostep: {enable:true, moveby:1, pause:3000},
	panelbehavior: {speed:500, wraparound:false, persist:true},
	defaultbuttons: {enable: true, moveby: 1, leftnav: ['images/left-icon.png', -150, 70], rightnav: ['images/right-icon.png', -17, 70]},
	statusvars: ['statusA', 'statusB', 'statusC'], //register 3 variables that contain current panel (start), current panel (last), and total panels
	contenttype: ['inline'] //content setting ['inline'] or ['external', 'path_to_external_file']
})

</script>

<!--################################################################################################################-->
<script type="text/javascript">
        var baseUrl = "<?php echo base_url() ?>";
        var siteUrl = "<?php echo site_url() ?>";
</script>




<script language="javascript">
        
        <!-- Calling Multiple Api Function -->
        
        $(document).ready(function () 
        {
			//$("#hotels_details").hide();
            //var a = [<?php echo $api_fs; ?>];
           // var randomid=["<?php //echo $rand_id ;?>"];
            var a = ['amadeus'];
            var i = 0; var random_id="";
            $('#loading').fadeIn();
            function nextCall() 
            {
                if(i == a.length) 
                {
                    $('#loading').fadeOut();
                    $('#loading_image').hide();
        
                    $('#loading_result').fadeIn();
                    $('#loading_imagea').fadeIn();
                    return; 
                }
                
                $.ajax({
                    url:'<?php echo site_url(); ?>/flights/call_api/'+a[i],
                    dataType: "json",
                    beforeSend:function()
                    {
                        $('#progressbar').show();
                        //$('#loading').html('<div  style=" padding-top:22px;"  class="loading" ><img width="253" height="31" src="<?php echo base_url(); ?>gui/images/loading_bar_animated.gif" alt="Loading..." /><br><div class="bottom-header" style="padding-left:105px">Loading</div></div>');
                       // $('#loading_image').fadeIn();
                    },
                    success: function(data)
                    {
                        $('#progressbar').hide();
                        var currency_value = parseFloat("<?php echo $_SESSION['currency_value']; ?>");
                        i++;
                        nextCall();      
                        if(data.flight_search_result == false || data.flight_search_result == null)
                        {
                            $('#noresult').fadeIn();
                        }
                        else
                        {
                             $('#noresult').hide();
                        }	
			
                        $('#result').html(data.flight_search_result);
                        $('#matrix_result').html(data.matrix_search_result);
                        $('#airline_filter').html(data.airline_filter_search);
                        $('#stops_filter').html(data.stops_filter_search);
                        var flightCount = $('div.searchflight_box').length;
                        $("#flightCount").text(flightCount);
                        setPriceSlider();
                        setTimeSlider();
                        if(data.rand_id!=null)
                        {
                                random_id=data.rand_id;
                        }
                    },
                    error:function(request, status, error){
                        $('#result').html('<p class="error" style="padding:30px"><strong></strong></p>');
						$("#flightCount").text('No');
                    }
        
                });
            }
        
            nextCall();
            
       });
        </script>
<script type="text/javascript">
    
        $(document).ready(function(){
            $('#selectall_airline').click(function(){
                if($(this).is(':checked')){
                    $('.airline_nm').prop("checked",true);
                    filter();
                }
                else{
                    $('.airline_nm').prop("checked",false);
                    filter();
                }
            })
            
            $('#selectall_stops').click(function(){
                if($(this).is(':checked')){
                    $('.stops_nm').prop("checked",true);
                    filter();
                }
                else{
                    $('.stops_nm').prop("checked",false);
                    filter();
                }
            })
        });
    
        
        
</script>

<script type="text/javascript">
function loadData()
	{
		$.ajax({
			url: siteUrl+'/flights/hotel_in_search',				
			dataType: 'json',				
			type: 'get',
			beforeSend: function()
			{
				$('#progressbar2').show();
				
			},
			//success: successHandler
			success: function(msg)
				  {
					  
					if(msg != '') {
						$('#progressbar2').hide();
						$("#hotel_details").html(msg.hotel_search_result2);
						 }
					}
				
			});
	
	}</script>
</body>
</html>
