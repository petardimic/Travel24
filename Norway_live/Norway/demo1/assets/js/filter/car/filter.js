/*
#################################### jQuery UI Slider #######################################
### 											  ###
###  Programmed By: Khadharvalli K, khadharvalli.provab@gmail.com                         ###
###  Powered By   : Provab Technosoft pvt ltd, Bangalore, India.                          ###
### 											  ###
### ====================================================================================  ###
###  Copy this code to your application and call "setPriceSlider() function in  ready     ###
###  state.                                                                               ###
### 											  ###	
###	::  Necessary hidden calls from integration page ::                               ###
###	Ex: <input type="hidden" id="setMinPrice" value="10" />                           ###
###         <input type="hidden" id="setMaxPrice" value="700" />                          ###
###         <input type="hidden" id="setCurrency" value="INR" />                          ###
### 											  ###
#############################################################################################
 */

function setPriceSlider()
{
    var setPriceMin=parseFloat($("#setMinPrice").val());
    var setPriceMax=parseFloat($("#setMaxPrice").val());
    
    var currency=$("#setCurrency").val();
    callPriceSlider(setPriceMin,setPriceMax,currency);
    priceSorting();
}

function setPriceSliderRound()
{
    var setPriceMinRound=parseFloat($("#setMinPriceRound").val());
    var setPriceMaxRound=parseFloat($("#setMaxPriceRound").val());
    alert(setPriceMinRound);
    var currency=$("#setCurrency").val();
    callPriceSliderRound(setPriceMinRound,setPriceMaxRound,currency);
    priceSortingRound();
}

function callPriceSlider(setPriceMin,setPriceMax,currency)
{	
    $selector=$( "#priceSlider" );
    $output=$( "#priceSliderOutput");
    $minPrice=$("#minPrice");
    $maxPrice=$("#maxPrice");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html(currency+' '+ ui.values[ 0 ] + " to "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html(currency+' '+$selector.slider( "values", 0 ) + " to "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}

function callPriceSliderRound(setPriceMin,setPriceMax,currency)
{	
    $selector=$( "#priceSliderRound" );
    $output=$( "#priceSliderOutputRound");
    $minPrice=$("#minPriceRound");
    $maxPrice=$("#maxPriceRound");
    $selector.slider
    ({
        range: true,
        min: setPriceMin,
        max: setPriceMax,
        values: [setPriceMin, setPriceMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+20>=ui.values[1])
            {
                return false;
            }
            else
            {                
                $output.html(currency+' '+ ui.values[ 0 ] + " to "+currency+' '+ui.values[ 1 ] );
                $minPrice.val(ui.values[0]);
                $maxPrice.val(ui.values[1]);                
            }
        }
    });
    
    $output.html(currency+' '+$selector.slider( "values", 0 ) + " to "+currency+' '+ $selector.slider( "values",1) );
    $minPrice.val($selector.slider( "values",0));
    $maxPrice.val($selector.slider( "values",1));
}


function priceSorting()
{
    $(".ui-slider").bind( "slidestop", function() 
    {
        filter();
    });
}

function priceSortingRound()
{
	$(".ui-slider").bind( "slidestop", function() 
    {
        filterRound();
    });
}
function setTimeSlider()
{
    var setTimeMin=parseInt($("#setMinTime").val());
    var setTimeMax=parseInt($("#setMaxTime").val());
    callTimeSlider(setTimeMin,setTimeMax);
    priceSorting();
}

function setTimeSliderRound()
{
    var setTimeMinRound=parseInt($("#setMinTimeRound").val());
    var setTimeMaxRound=parseInt($("#setMaxTimeRound").val());
    callTimeSliderRound(setTimeMinRound,setTimeMaxRound);
    priceSortingRound();
}

function callTimeSlider(setTimeMin,setTimeMax)
{
	
    $selector1=$( "#timeSlider" );
    $output1=$( "#timeSliderOutput");
    $minTime=$("#minTime");
    $maxTime=$("#maxTime");
    
    $selector1.slider
    ({
        range: true,
        min: setTimeMin,
        max: setTimeMax,
        values: [setTimeMin, setTimeMax],
        slide: function(event, ui)
        {
            if(ui.values[0]+5>=ui.values[1])
            {
                return false;
            }
            else
            {     
                $hhmin= Math.floor(ui.values[0]/60);
                if($hhmin<10) {
                    $hhmin='0'+$hhmin;
                }
                $mmmin= Math.floor(ui.values[0]%60);
                if($mmmin<10) {
                    $mmmin='0'+$mmmin;
                }  
                $hhmax= Math.floor(ui.values[1]/60);
                if($hhmax<10) {
                    $hhmax='0'+$hhmax;
                }
                $mmmax= Math.floor(ui.values[1]%60);
                if($mmmax<10) {
                    $mmmax='0'+$mmmax;
                }         
                $output1.html($hhmin+':'+$mmmin+' To '+$hhmax+':'+$mmmax);
                $("#minTime").val(ui.values[0]);
                $("#maxTime").val(ui.values[1]);
            }
        }
    });
    
    $hhminm= Math.floor($selector1.slider( "values", 0 )/60);
    if($hhminm<10) 
    {
        $hhminm='0'+$hhminm;
    }
    $mmminm= Math.floor($selector1.slider( "values", 0 )%60);
    if($mmminm<10) 
    {
        $mmminm='0'+$mmminm;
    }  
    $hhmaxm= Math.floor($selector1.slider( "values", 1 )/60);
    if($hhmaxm<10) 
    {
        $hhmaxm='0'+$hhmaxm;
    }
    $mmmaxm= Math.floor($selector1.slider( "values", 0 )%60);
    if($mmmaxm<10) 
    {
        $mmmaxm='0'+$mmmaxm;
    }     
    $output1.html($hhminm+':'+$mmminm+' To '+$hhmaxm+':'+$mmmaxm);
    $minTime.val($selector1.slider( "values",0));
    $maxTime.val($selector1.slider( "values",1));
}

function callTimeSliderRound(setTimeMinRound,setTimeMaxRound)
{
	
    $selector1=$( "#timeSliderRound" );
    $output1=$( "#timeSliderOutputRound");
    $minTimeRound=$("#minTimeRound");
    $maxTimeRound=$("#maxTimeRound");
    
    $selector1.slider
    ({
        range: true,
        min: setTimeMinRound,
        max: setTimeMaxRound,
        values: [setTimeMinRound, setTimeMaxRound],
        slide: function(event, ui)
        {
            if(ui.values[0]+5>=ui.values[1])
            {
                return false;
            }
            else
            {     
                $hhmin= Math.floor(ui.values[0]/60);
                if($hhmin<10) {
                    $hhmin='0'+$hhmin;
                }
                $mmmin= Math.floor(ui.values[0]%60);
                if($mmmin<10) {
                    $mmmin='0'+$mmmin;
                }  
                $hhmax= Math.floor(ui.values[1]/60);
                if($hhmax<10) {
                    $hhmax='0'+$hhmax;
                }
                $mmmax= Math.floor(ui.values[1]%60);
                if($mmmax<10) {
                    $mmmax='0'+$mmmax;
                }         
                $output1.html($hhmin+':'+$mmmin+' To '+$hhmax+':'+$mmmax);
                $("#minTimeRound").val(ui.values[0]);
                $("#maxTimeRound").val(ui.values[1]);
            }
        }
    });
    
    $hhminm= Math.floor($selector1.slider( "values", 0 )/60);
    if($hhminm<10) 
    {
        $hhminm='0'+$hhminm;
    }
    $mmminm= Math.floor($selector1.slider( "values", 0 )%60);
    if($mmminm<10) 
    {
        $mmminm='0'+$mmminm;
    }  
    $hhmaxm= Math.floor($selector1.slider( "values", 1 )/60);
    if($hhmaxm<10) 
    {
        $hhmaxm='0'+$hhmaxm;
    }
    $mmmaxm= Math.floor($selector1.slider( "values", 0 )%60);
    if($mmmaxm<10) 
    {
        $mmmaxm='0'+$mmmaxm;
    }     
    $output1.html($hhminm+':'+$mmminm+' To '+$hhmaxm+':'+$mmmaxm);
    $minTimeRound.val($selector1.slider( "values",0));
    $maxTimeRound.val($selector1.slider( "values",1));
}



function filter()
{ 
    $minPr=parseFloat($("#minPrice").val());
    $maxPr=parseFloat($("#maxPrice").val());   
    
    $minTime=parseInt($("#minTime").val());
    $maxTime=parseInt($("#maxTime").val());
    
    $airline_nm=new Array;
    $doors_nm=new Array;
    $fuel_nm=new Array;
    $trans_nm=new Array;
    $(".car_nm:checked").each(function()
    {
		//alert("hi");
        $airlineNum=$(this).val();
        $airline_nm.push($airlineNum); 
    }); 
    
    $(".car_doors:checked").each(function()
    {
        $doorsNum=$(this).val();
        $doors_nm.push($doorsNum); 
    });
  
    $(".car_fuel:checked").each(function()
    {
        $car_fuelNum=$(this).val();
        $fuel_nm.push($car_fuelNum); 
    });
	$(".car_trans:checked").each(function()
    {
        $car_transNum=$(this).val();
        $trans_nm.push($car_transNum); 
    });
    
    flightCount = 0;
    $(".FlightInfoBox").each(function()
    {		
        $dataairline=$(this).attr("data-airline");
        $datadoors=$(this).attr("data-doors");
        $datafuel=$(this).attr("data-fuel");
		$datatrans =$(this).attr("data-trans");
        /* $datadeparture=parseInt($(this).attr("data-departure"));
        $datafaretype=$(this).attr("data-fare-type"); */
       
        var airlineShow=$.inArray($dataairline, $airline_nm)>=0?true:false;
        var doorsShow=$.inArray($datadoors, $doors_nm)>=0?true:false;
        var fuelShow=$.inArray($datafuel, $fuel_nm)>=0?true:false;
		var fueltrans=$.inArray($datatrans, $trans_nm)>=0?true:false;
        
        //if(($dataprice<=$maxPr && $dataprice>=$minPr) && airlineShow && stopsShow && faretypeShow && ($datadeparture<=$maxTime && $datadeparture>=$minTime))
		if(airlineShow && doorsShow && fuelShow && fueltrans)
        {
			flightCount++;
            $(this).parents(".searchflight_box").show();
        }
        else
        {
            $(this).parents(".searchflight_box").hide();
        }
    });  
    
    $("#carCount").text(flightCount);	
    
   
}

function filterRound()
{ 
    $minPr=parseFloat($("#minPrice").val());
    $maxPr=parseFloat($("#maxPrice").val());  
    
    $minPrRound=parseFloat($("#minPriceRound").val());
    $maxPrRound=parseFloat($("#maxPriceRound").val());  
    
    $minTime=parseInt($("#minTime").val());
    $maxTime=parseInt($("#maxTime").val());
    
    $minTimeRound=parseInt($("#minTimeRound").val());
    $maxTimeRound=parseInt($("#maxTimeRound").val());
    
    $airline_nm=new Array;
    $stops_nm=new Array;
    $faretype_nm=new Array;
    
    $(".airline_nm:checked").each(function()
    {
        $airlineNum=$(this).val();
        $airline_nm.push($airlineNum); 
    }); 
    
    $(".stops_nm:checked").each(function()
    {
        $stopsNum=$(this).val();
        $stops_nm.push($stopsNum); 
    });
  
    $(".faretype_nm:checked").each(function()
    {
        $faretypeNum=$(this).val();
        $faretype_nm.push($faretypeNum); 
    });
    
    flightCount = 0;
    $(".FlightInfoBox").each(function()
    {		
        $dataairline=$(this).attr("data-airline");
        $datastops=$(this).attr("data-stops");
       /* $dataprice=parseFloat($(this).attr("data-price"));
        $datapriceRound=parseFloat($(this).attr("data-price-round"));
        $datadeparture=parseInt($(this).attr("data-departure"));
        $datadepartureRound=parseInt($(this).attr("data-departure-round"));
        $datafaretype=$(this).attr("data-fare-type"); */
       
        var airlineShow=$.inArray($dataairline, $airline_nm)>=0?true:false;
        var stopsShow=$.inArray($datastops, $stops_nm)>=0?true:false;
        var faretypeShow=$.inArray($datafaretype, $faretype_nm)>=0?true:false;
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && ($datapriceRound<=$maxPrRound && $dataprice>=$minPrRound) && airlineShow && stopsShow && faretypeShow && ($datadeparture<=$maxTime && $datadeparture>=$minTime) && ($datadepartureRound<=$maxTimeRound && $datadepartureRound>=$minTimeRound))
        {
			flightCount++;
            $(this).parents(".searchflight_box").show();
        }
        else
        {
            $(this).parents(".searchflight_box").hide();
        }
    });  
    
    $("#flightCount").text(flightCount);	
    
   
}
