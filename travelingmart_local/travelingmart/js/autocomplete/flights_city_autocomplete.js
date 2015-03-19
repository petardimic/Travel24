/*!
 * jQuery Hotels City Autocomplete 1.10.3
 * http://jqueryui.com
 * 
 */

$(document).ready(function(){
	
	$("#airportcodeinput").autocomplete({
		source: siteUrl +'/flights/flights_city_auto_list/',
		minLength:1,	
		autoFocus: true,
			
	});
	//$('#airportcodeinput').autocomplete().setOptions(options);
      /* $('#airportcodeinput').css({
			color: 'blue'
		});*/ 
        $("#testtoinput").autocomplete({
		source: siteUrl +'/flights/flights_city_auto_list/',
		minLength:1,	
		autoFocus: true		
			
	});
	
});

