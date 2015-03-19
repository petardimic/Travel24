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
    
    $output.html(currency+''+$selector.slider( "values", 0 ) + " To "+currency+''+ $selector.slider( "values",1) );
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

function filter()
{ 	
    //alert('hello');
    $minPr=parseFloat($("#minPrice").val());
    $maxPr=parseFloat($("#maxPrice").val());   
    
    $stars=new Array;
    $location=new Array;
	$location1=new Array;
    $mealplan=new Array;
    
    $(".star:checked").each(function()
    {
        $starNum=$(this).val();
        $stars.push($starNum); 
    });  
    
    $(".location_name:checked").each(function()
    {
        $locationNum=$(this).val();
        $location.push($locationNum); 
    });
	$(".location_name1:checked").each(function()
    {
        $locationNum1=$(this).val();
        $location1.push($locationNum1); 
    });
	
	$(".mealplan_filter:checked").each(function()
    {
        $mealplan_filter=$(this).val();
        $mealplan.push($mealplan_filter); 
    });
//    
//    $(".proptype:checked").each(function()
//    {
//        $typeNum=$(this).val();
//        $type.push($typeNum); 
//    });
    
    
  
    hotelCount = 0;
    $(".HotelInfoBox").each(function()
    {		
        $datastar=$(this).attr("data-star");
        $datalocation=$(this).attr("data-location");
		$datalocation1=$(this).attr("data-location1"); 
		   
        $datamealplan=$(this).attr("data-mealplan");    
		
        $dataprice=parseFloat($(this).attr("data-price"));
       
        var starShow=$.inArray($datastar, $stars)>=0?true:false;
		var locationShow=$.inArray($datalocation, $location)>=0?true:false;
		var locationShow1=$.inArray($datalocation1, $location1)>=0?true:false;
		
		var mealshow=$.inArray($datamealplan, $mealplan)>=0?true:false;
        
        if(($dataprice<=$maxPr && $dataprice>=$minPr) && starShow && locationShow && mealshow)
        {
			hotelCount++;
            $(this).parents(".searchhotel_box").show();
        }
        else
        {
            $(this).parents(".searchhotel_box").hide();
        }
    });  
    
    $("#hotelCount").text(hotelCount);	
    
   
}

function spothotels(name)
{
	alert("hi");
	flightCount = 0;
    alert(name);
    $(".HotelInfoBox").each(function()
    {		
       $dataprice=parseFloat($(this).attr("data-deluxe-toprated"));
       //$dataairline=$(this).attr("data-airline");
       if($dataprice==name)
       {
            flightCount++;
            $(this).parents(".searchhotel_box").show();
       }
       else
       {
            $(this).parents(".searchhotel_box").hide();
       }
    });  
    
    $("#hotelCount").text(flightCount);
}