//privatizing the jQuery $ in case the user uses other JS libraries.
(function($){

$.fn.worldcountries = function(options){

		//default properties
		options = $.extend({
			url: null,
			includeCities: false,
                        dependantCities: null
		}, options);

		return this.each(function(){
		//plugin properties validation
		if(options.url == null)
		{
                    alert("World Cities plugin error: URL is null.");
		}
                else if(options.includeCities == true && options.dependantCities == null)
                {
                    alert("World Cities plugin error: Cities.");
                }
		else
		{
		var listCountries = $(this);
		var listCities = options.dependantCities;
		
                //Countries AJAX request
                $.ajax({
			url: options.url,
			type: "GET",
			dataType: "json",
			success:function(result){
                                    listCountries.append('<option value="-1">--Select--</option>');
				$(result).each(function(i, element){
                                    var option = '<option value="' + element.countryCode + '">' + element.countryName +'</option>';
                                    listCountries.append(option);
                                    
                                });
                                
			}
		});
                //Handling countries list selected item change
                listCountries.bind("change", function(){
                //Cities AJAX request
                $.ajax({
			url: options.url,
			type: "GET",
                        data: {countryCode: listCountries.val()},
			dataType: "json",
			success:function(result){
                            listCities.empty();
				$(result).each(function(i, element){
                                    var option = '<option value="' + element.cityId + '">' + element.cityName +'</option>';
                                    listCities.append(option);
                                    
                                });
                                
			}
		});
                
                });
		}
	});
};

})(jQuery);