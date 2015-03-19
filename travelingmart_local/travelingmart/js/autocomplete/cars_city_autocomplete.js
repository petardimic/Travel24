/*!
 * jQuery Hotels City Autocomplete 1.10.3
 * http://jqueryui.com
 * 
 */

$(document).ready(function(){
	
	$("#pickuploc").autocomplete({
		source: siteUrl +'/car/cars_city_auto_list/',
		minLength:1,	
		autoFocus: true		
			
	});
        
        $("#dropoffloc").autocomplete({
		source: siteUrl +'/car/cars_city_auto_list/',
		minLength:1,	
		autoFocus: true		
			
	});
	
});

