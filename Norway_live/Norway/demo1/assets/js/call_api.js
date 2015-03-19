//alert(a);
  	  var i = 0;
 	  var aa='';
			
    function nextCall() 
	{
		$final=0;
		
		if(i == (a.length-1)) 
		{
			$final=1;
		}
		
		if(i != a.length)
		{
		$.ajax({
			  type: 'POST',
			  url: api_url+'/hotel_services/call_api_search_result/'+a[i]+'/'+$final,
			  data: '',
			  async: true,
			  dataType: 'json',
			  beforeSend:function(){
				  
			 },
			success: function(data){
				i++;
				nextCall();
				if(data.hotel_search_result != "")
				{
				$(".nextpage").fadeIn('slow');
				$("#result_count").html(data.total_result);
				$('#place').html(data.place);
				$('#priceStarts').html(data.per_night_min);
				$('#chain').html(data.chain);
				
				$('#result').html(data.hotel_search_result);
				if(i == (a.length)) 
				{
					$('.min_rate_final_load').hide();
					$('.min_rate_final').fadeIn();
				}
				//alert(data.min_val);alert(data.max_val);
				var minVal = parseInt(data.min_val);
				var maxVal = parseInt(data.max_val);
			
				$( "#slider-range" ).slider({
					range: true,
					min: minVal,
					max: maxVal,
					values: [ minVal, maxVal ],
					slide: function( event, ui ) {
						var r = Math.round(ui.values[ 0 ] );
						var rr = Math.round(ui.values[ 1 ]);
						$( "#amount_dummy" ).val( ui.values[ 0 ] + "  to " + ui.values[ 1 ] );
						$( "#amount" ).val( "USD " + r + "  to  USD " + rr );
					},
					  change: function( event, ui ) {
					  if (event.originalEvent) {
					  	price_filter();
                        //loadData(1);  // For first time page load default results
                       
					  }
					}
				});
				$( "#amount_dummy" ).val( $( "#slider-range" ).slider( "values", 0 ) +
					"  to   " + $( "#slider-range" ).slider( "values", 1 ) )
		
			loadData(1);
			}
		  },

		  
		 	error:function(request, status, error){
			$('#preloading_div').fadeOut('slow');
			$('#black_grid').fadeOut('slow');


			if(i==0)
			{
			$('#result').html('<div class="no_available" style="text-align:center"><h1>There are no available hotels  for your stay. </h1><img src="'+api_dir+'img/no_hotel_img.png" width="154" height="154" /><br /><br /><div class="no_available_text">Sorry, we have no prices for hotels in this date range matching your criteria. One or more of your preferences may be affecting the number of exact matches found. Try searching again with a wider search criteria. <br><img src="'+api_dir+'img/cust_support.jpg" /></div></div>');
			}
			else{//alert(a[i]+" Having some problem cotact your admin")cust_support
			}
		  }
		  
			});
		}
		}
nextCall();
    function search_view(val)
  {
	  if(val==2)
	  {
		  //grid
		  $("#grid").show();
		  $("#itemContainer").hide();
	  }
	  else
	  {
		   $("#itemContainer").show();
		  $("#grid").hide();
		  
	  }
  }
  
