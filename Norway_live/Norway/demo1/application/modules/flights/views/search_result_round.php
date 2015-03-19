<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>DEMO</title>
<!-- CSS --><link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/main_style.css" type="text/css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/smart_tab.css" type="text/css"/>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.smartTab.js"></script>
<script src="<?php echo base_url(); ?>assets/js/menu_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>

<!-- For slider filter and sorting js--> 
  <script type="text/javascript" src="http://testing.benzyinfotech.com/assets/js/jquery-ui.js"></script>
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

<!--<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>-->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/stepcarousel.js"></script>

</head>
<style type="text/css">

.stepcarousel{
	position: relative;
	overflow: scroll; /*leave this value alone*/
	width: 535px; /*Width of Carousel Viewer itself*/
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
<body onload="loadData();">
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
                
                <div style="clear:both;"></div>
                <?php /*?><div class="lblue1_bg " id="hotel_details">
					<div id="progressbar2" style="display:none;" align="center"><img src="<?php echo base_url();?>assets/images/290.gif"  /></div>
                    
                </div><?php */?>
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
                <div style="clear:both;"></div>
                <div class="blue_bg-2" id="summary" style="padding-top:5px;">
                    <h3>Your Search Details</h3>
                    <div class="rental-inner3">
                       <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px; padding:0px;">
                               <span style="width:100px; float:left;">Departure From </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $fromCity; ?><br /></span>
                               <span style="width:100px; float:left;">Arrival To </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $toCity; ?><br /></span>
                                <span style="width:100px; float:left;">Journey Type</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['journey_type']; ?><br /></span>
                               <span style="width:100px; float:left;">Departure Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M y',strtotime($_SESSION['sd'])); ?><br /></span>
                                <span style="width:100px; float:left;">Return Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M y',strtotime($_SESSION['ed'])); ?><br /></span>
                                <span style="width:100px; float:left;">Cabin Class</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['cabin']; ?><br /></span>
                                <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adults']; ?><br /></span>
                                <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['childs']; ?><br /></span>
                                <span style="width:100px; float:left;">Infants</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['infants']; ?></span>
                            </ul>
                        <input type="image" src="<?php echo base_url() ?>assets/images/modify-btn.png" class="top10" border="0" onclick="get_form(1)">                 
                    </div>
                       
               
                </div>
                <div class="blue_bg-2" id="modify" style="display:none; margin-top:15px; margin-left:0px;">
                    <h3>Modify Search</h3>
                    
                   
                    <div class="rental-inner1" style="padding-left:10px; padding-top:10px; padding-bottom:10px; width:179px; color:#333;">
                       
                       <?php $this->load->view('flights/modify_search'); ?>
                       
                      
                       
                       <p onclick="get_form(2)" style="font-family:Arial; cursor:pointer; padding-left:5px; text-decoration:underline; ">Cancel Search</p>
                    </div>
               
                </div>
                <div class="blue_bg top20 left5">
                    <div class="lblue_bg">
                        <div class="left_header" style=" color:#000; margin-bottom:10px;"> Price Range (Onward) </div>
                        <span id="priceSliderOutput" style="font-weight: normal;"></span>
                        <div style="padding:10px 0px 0px 0px; margin: 0px;">
                          <div id="priceSlider" style="width:175px">
                              <?php /*?><img src="images/price_bar.png"/><?php */?>
                          </div>
                          <input type="hidden" name="minPrice" id="minPrice" class="autoSubmit"  />
                          <input type="hidden" name="maxPrice" id="maxPrice" class="autoSubmit"  />
                        </div>
                    </div>
                </div>
                
                <div style="clear:both;"></div>
                <div class="blue_bg top20 left5">
                    <div class="lblue_bg">
                        <div class="left_header" style=" color:#000; margin-bottom:10px;">Price Range (Return)</div>
                        <span id="priceSliderOutputRound" style="font-weight: normal;"></span>
                        <div style="padding:10px 0px 0px 0px; margin: 0px;">
                          <div id="priceSliderRound" style="width:175px">
                              <?php /*?><img src="images/price_bar.png"/><?php */?>
                          </div>
                          <input type="hidden" name="minPriceRound" id="minPriceRound" class="autoSubmit"  />
                          <input type="hidden" name="minPriceRound" id="minPriceRound" class="autoSubmit"  />
                        </div>
                    </div>
                </div>
               
                <div >&nbsp;&nbsp;</div>
                <div id='cssmenu' style="margin-top:10px;">
                   <ul>
                        <?php /*?><li class='has-sub'><a href=''><span>Your Search Details</span></a>
                            <ul style="line-height:20px; font-family:Arial, Helvetica, sans-serif; font-size:12px;">
                               <span style="width:100px; float:left;">Departure From </span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $fromCity; ?><br /></span>
                               <span style="width:100px; float:left;">Arrival To </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $toCity; ?><br /></span>
                                <span style="width:100px; float:left;">Journey Type</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['journey_type']; ?><br /></span>
                               <span style="width:100px; float:left;"> Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M y',strtotime($_SESSION['sd'])); ?><br /></span>
                               <span style="width:100px; float:left;"> Date</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo date('d M y',strtotime($_SESSION['ed'])); ?><br /></span>
                                <span style="width:100px; float:left;">Cabin Class</span> <span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['cabin']; ?><br /></span>
                                <span style="width:100px; float:left;">Adults </span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['adults']; ?><br /></span>
                                <span style="width:100px; float:left;">Childs</span><span style="font-weight:bold; color:#025590;">:&nbsp;<?php echo $_SESSION['childs']; ?><br /></span>
                                <span style="width:100px; float:left;">Infants</span> <span style="font-weight:bold; color:#025590;"> :&nbsp;<?php echo $_SESSION['infants']; ?></span>
                            </ul>
                            <div style="clear:both;"></div>
                        </li>
                        <li class='has-sub'><a href='#'><span>Modify Search</span></a>
                            <ul>
                                <p>
                                    <?php $this->load->view('flights/modify_search'); ?>
                                </p>
                            </ul>
                            <div style="clear:both;"></div>
                        </li><?php */?>
                        <li class='has-sub active'><a href='#'><span>Departure Time</span></a>
                            <ul>
								<div><strong>Onward</strong></div>
                                <p style="text-align:center; margin:6px;"><span id="timeSliderOutput" style="font-weight: normal;"></span></p>
                                <div style="margin-left:5px;">
									 <div id="timeSlider" style="width:165px; "></div>
                                    <input type="hidden" name="minTime" id="minTime" class="autoSubmit"  />
                                    <input type="hidden" name="maxTime" id="maxTime" class="autoSubmit"  />
                                </div>
                                
                                <div style="margin-top:10px;"><strong>Return</strong></div>
                                <p style="text-align:center; margin:6px;"><span id="timeSliderOutputRound" style="font-weight: normal;"></span></p>
                                <div style="margin-left:5px;">
									 <div id="timeSliderRound" style="width:165px; "></div>
                                    <input type="hidden" name="minTimeRound" id="minTimeRound" class="autoSubmit" style="margin-top:20px;"  />
                                    <input type="hidden" name="maxTimeRound" id="maxTimeRound" class="autoSubmit"  />
                                </div>
                            </ul>
                        </li>
                       <li class='has-sub'><a href='#'><span>Stops</span></a>
                            <ul>
                                <div  style="float:right"><input type="checkbox" name="select_all_stops" id="selectall_stops">select all</div>
                                <div id="stops_filter"></div>
                            </ul>
                        </li>
                       <li class='has-sub'><a href='#'><span>Airlines</span></a>
                            <ul>
                                <div  style="float:right"><input type="checkbox" name="select_all" id="selectall_airline">select all</div>
                                <div id="airline_filter"></div>
                            </ul>
                        </li>
                        <li class='has-sub'><a href='#'><span>Fare Type</span></a>
                            <ul>
                                <div class="top10"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:5px;" value="NRP" checked  onclick="return filter_new();"/>Refundable</div>
                                <div class="top10"><input type="checkbox" name="airline_filter" class="faretype_nm" style="padding-top:5px;" value="RP" checked  onclick="return filter_new();"/>Non-Refundable</div>
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
                <div class="right_main_header"><span id="flightCount">Searching</span> flights from <?php echo trim($fromCity).", ".$from[1]; ?> to <?php echo trim($toCity).", ".$to[1]; ?></div>
                <div>Travel Class : <?php echo $_SESSION['cabin']; ?> | Onward : <?php echo date('d M Y',strtotime($_SESSION['sd'])); ?>  | Return : <?php echo date('d M Y',strtotime($_SESSION['ed'])); ?> | Passengers : Adults-<?php echo $_SESSION['adults']; ?>, Child-<?php echo $_SESSION['childs']; ?>, Infant-<?php echo $_SESSION['infants']; ?></div>
                <div class="right_main_bar top20">
                    <div class="fleft left20"><img src="<?php echo base_url(); ?>assets/images/white_arrow.png" align="absmiddle" /> &nbsp;Airline Matrix</div>
                    <div class="fright" style="margin-right:20px;">Prev Day  |  Next Day</div>
                    <div class="clear"></div>
                      
                    <!--########################## MATRIX PART START  ###################################-->   
                    <div id="matrix_result" style="color:#000;"></div>
                    <!--######################### MATRIX PART END  ####################################--> 

                    <div class="cler"></div><div class="cler"></div>
                    <div class="sort_bar top10 clear" style="margin-top:10px;">
                        <div class="wid108 right_devider center_txt fleft">Sort By ></div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Airline" rel="data-airline" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Airline&nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" /> </a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Departure" rel="data-departure" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Departure&nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" /> </a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Arrival" rel="data-arrival" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Arrival&nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" /> </a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Duration" rel="data-duration" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Duration &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" /></a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft">
                            <a href="javascript:void(0);" title="Sort By Price" rel="data-total-price" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Price &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" />  </a>
                        </div>
                        <div class="wid108 right_devider center_txt fleft" style="border-right:0px;">
                            <a href="javascript:void(0);" title="Sort By Stops" rel="data-stops" data-order="asc" class="FlightSorting" style="text-decoration:none; color:#fff;"><img src="<?php echo base_url();?>assets/images/uparror.png" /> &nbsp;Stops &nbsp; <img src="<?php echo base_url();?>assets/images/downarror.png" /> </a>
                        </div>
                    </div>
                    <div class="clear"></div>
                   <!--####################### FLIGHT LIST START  #################################-->
                   <div class="resultFlights" id="result">
                       <div id="progressbar" style="display:none; margin-top:30px;" align="center"><img src="<?php echo base_url();?>assets/images/ajax-loader.gif" /></div>
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
<?php /*?><!--###########AUTO COMPLETE#############-->            
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/base/minified/jquery-ui.min.css" type="text/css" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/autocomplete/flights_city_autocomplete.js"></script>
    <!--###########AUTO COMPLETE#############-->
    <!--###########DATE PICKER#############-->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-ui.css" />
    <!--###########DATE PICKER#############--->
<?php */?>


<script language="javascript">
        
        <!-- Calling Multiple Api Function -->
        
        $(document).ready(function () 
        {
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
						//alert("hi");
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
			//alert(data.flight_search_result);
                        $('#result').html(data.flight_search_result);
                        $('#matrix_result').html(data.matrix_search_result);
                        $('#airline_filter').html(data.airline_filter_search);
                        $('#stops_filter').html(data.stops_filter_search);
                        var flightCount = $('div.searchflight_box').length;
                        $("#flightCount").text(flightCount);
                        setPriceSlider();
                        setPriceSliderRound();
                        setTimeSlider();
                        setTimeSliderRound();
                        if(data.rand_id!=null)
                        {
                                random_id=data.rand_id;
                        }
                    },
                    error:function(request, status, error){
                        $('#result').html('<p class="error" style="padding:30px"><strong></strong></p>');
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
                    filter_new();
                }
                else{
                    $('.airline_nm').prop("checked",false);
                    filter_new();
                }
            })
            
            $('#selectall_stops').click(function(){
                if($(this).is(':checked')){
                    $('.stops_nm').prop("checked",true);
                    filter_new();
                }
                else{
                    $('.stops_nm').prop("checked",false);
                    filter_new();
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
