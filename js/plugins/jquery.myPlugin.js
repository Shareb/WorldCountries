//privatizing the jQuery $ in case the user uses other JS libraries.
(function($){

$.fn.shareb = function(options){

		//default properties
		options = $.extend({
			url: null,
			dependant: null
		}, options);

		return this.each(function(){
		//plugin code
		if(options.url == null && options.dependant == null)
		{
			alert("No optional");
		}
		else
		{
		var listCountries = $(this);
		var listCities = $("#" + dependant); //class selector to be covered later..
		
		$.ajax({
			url: options.url,
			type: "GET",
			dataType: "json",
			success:function(result){
				console.log(result);
			}
		});
		}
	});
};

})(jQuery); 