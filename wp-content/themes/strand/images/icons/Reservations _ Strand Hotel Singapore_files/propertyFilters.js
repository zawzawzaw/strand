var PROPERTY_FILTER_JS = "PROPERTY_FILTER_JS";
var rateMax = 0;
var rateMin = 0;

function initSlider()
{
	destroySlider();
	getPropertyPriceMinMax();
	var sliderOptions = {};
	sliderOptions.min = rateMin;
	sliderOptions.max = rateMax;
	
	if( rateMin != rateMax )
	{
		sliderOptions.range = true;
		sliderOptions.values = [ rateMin, rateMax ];
		$( "#price_low" ).val( rateMin );
		$( "#price_high" ).val( rateMax );
		$( "#minRateDisplay" ).html( rateMin );
		$( "#maxRateDisplay" ).html( rateMax );
	}
	else
	{
		if( rateMin != 0 && rateMax != 0 )
		{
			$( "#minRateDisplay" ).html( rateMin );
		}
		sliderOptions.disabled = true;
	}
	
	sliderOptions.stop = slidePriceRange;
	$( "#slider-range" ).slider( sliderOptions );
}

function destroySlider()
{
	try
	{
		rateMin = 0;
		rateMax = 0;
		$( "#slider-range" ).slider( "destroy" );
		$( "#minRateDisplay" ).html( "" );
		$( "#maxRateDisplay" ).html( "" );
		$( "#price_low" ).val( 0 );
		$( "#price_hight" ).val( 0 );
	}
	catch( error )
	{
		
	}
}

function slidePriceRange( event, ui) 	
{
	$( "#price_low" ).val( ui.values[ 0 ] );
	$( "#price_high" ).val( ui.values[ 1 ] );
	
	$( "#minRateDisplay" ).html( $( "#price_low" ).val() );
	$( "#maxRateDisaply" ).html( $( "#price_high" ).val() );
	
	showHiddenProperty();
	runPriceFilters();
	refreshPropertyView();
}

function getPropertyPriceMinMax()
{
	rateMin = 0;
	rateMax = 0;
	$( ".propertyDetail" ).each(
		function()
		{
			var avgPrice = parseFloat( $( this ).attr( "data-avgprice" ) );
			if( typeof avgPrice != "undefined" && avgPrice != null && isNaN( avgPrice ) != true )
			{
				if( rateMin == 0 || avgPrice < rateMin )
				{
					rateMin = avgPrice;
				}
				
				if( rateMax == 0 || avgPrice > rateMax )
				{
					rateMax = avgPrice;
				}
			}
		}
	);
}

function getVisiblePropertyCodes()
{
	var result = new Array();
	
	$( ".propertyDetail" ).each(
		function()
		{
			var property = $( this );
			if( property.hasClass( "hiddenProperty" ) == false )
			{
				result.push( property.attr( "data-propertycode" ) );
			}
		}
	);
	
	return result;
}

function hideProperty( idx ) {
	if( idx != null ) {
		var element = $( "#prop_" + idx );
		if( element.hasClass( "hiddenProperty" ) == false ) {
			element.addClass( "hiddenProperty" );
		}
		element.hide();
		clearPropertyDetails();
	}
	
	var visibleProperties = getVisiblePropertyCodes();
	if( typeof visibleProperties != "undefined" && visibleProperties != null && visibleProperties.length ==  1 ) {
		if (typeof centerOnProperty != 'undefined')
			centerOnProperty( visibleProperties[0] );
	}
	
	if (typeof placeProperties != 'undefined')
		placeProperties();
}

function resetFilters()
{
	if( $( "#slider-range" ).slider() && $( "#slider-range" ).slider( "option", "disabled" ) == false )
	{
		$( "#slider-range" ).slider( "values", [ rateMin, rateMax ] );
		$( "#price_high" ).val( rateMax );
		$( "#price_low" ).val( rateMin );
	}
	
	showHiddenProperty();
}

function showHiddenProperty() {
	$( ".hiddenProperty" ).each(function() {
			var element = $( this );
			if(element) {
				element.removeClass( "hiddenProperty" );
			}
		}
	);
	
	if (typeof placeProperties != 'undefined')
		placeProperties();
}

function filterLowPrice() {
	var lowLimitField = $( "#price_low" );
	if( lowLimitField )
	{
		var lowerLimitStr = lowLimitField.val();
		if( lowerLimitStr != null && lowerLimitStr.trim() != "" )
		{
			var lowerLimit = parseFloat( lowerLimitStr );
			if( isNaN( lowerLimit ) != true )
			{
				$( ".propertyDetail" ).each(function() {
						var property = $( this );
						var avgPriceStr = property.attr( "data-avgPrice" );
						var avgPrice = 0;
						
						if( avgPriceStr != null && avgPriceStr.trim() != "" && isNaN( parseFloat( avgPriceStr ) ) != true ) {
							avgPrice = parseFloat( avgPriceStr );
						}
						
						if( avgPrice < lowerLimit ) {
							property.addClass( "hiddenProperty" );
						}
					}
				);
			}
		}
	}
}

function filterHighPrice()
{
	var highLimitField = $( "#price_high" );
	if( highLimitField )
	{
		var highLimitStr = highLimitField.val();
		if( highLimitStr != null && highLimitStr.trim() != "" )
		{
			var highLimit = parseFloat( highLimitStr );
			if( isNaN( highLimit ) != true )
			{
				$( ".propertyDetail" ).each(
					function()
					{
						var property = $( this );
						var avgPriceStr = property.attr( "data-avgPrice" );
						var avgPrice = 0;
						
						if( avgPriceStr != null && avgPriceStr.trim() != "" && isNaN( parseFloat( avgPriceStr ) ) != true )
						{
							avgPrice = parseFloat( avgPriceStr );
						}
						
						if( avgPrice > highLimit )
						{
							property.addClass( "hiddenProperty" );
						}
						
					}
				);
			}
		}
	}
	
}

function filterRating()
{
	var ratingFilterField = $( "#ratingFilter" );
	ratingFilter = parseInt( ratingFilterField.val() );
	if( isNaN( ratingFilter ) == true ) {
		return;
	}
	
	var ratingLimitField = $( "#rating" );
	if( ratingLimitField )
	{
		var ratingLimitStr = ratingLimitField.val();
		if( ratingLimitStr != null && ratingLimitStr.trim() != "" && isNaN( parseFloat( ratingLimitStr ) ) != true )
		{
			var rating = parseInt( ratingLimitStr );
			if( rating == 0 )
				rating = 1;
			
			$( ".propertyDetail" ).each(
				function()
				{
					var property = $( this );
					var propertyRatingStr = property.attr( "data-rating" );
					if( propertyRatingStr != null && propertyRatingStr.trim() != "" && isNaN( parseInt( propertyRatingStr ) ) != true  )
					{
						var propertyRating = parseInt( propertyRatingStr );
						
						if( ratingFilter == 0 )
						{
							if( propertyRating != rating )
							{
								property.addClass( "hiddenProperty" );
							}
						}
						else if( ratingFilter == 1 )
						{
							if( propertyRating <= rating )
							{
								property.addClass( "hiddenProperty" );
							}
						}
						else if( ratingFilter == -1 )
						{
							if( propertyRating > rating )
							{
								property.addClass( "hiddenProperty" );
							}
						}
					}
				}
			);
		}
	}
	
}

function filterByFeatures() {
	var selectedFeatures = new Array();
	var count = 0;
	$('.filterKey:checked').each(function() {
	    selectedFeatures.push($(this).val());
	});
	var url = "/wbe/property/filterPropByFeatures.action";
	url = url + "?selectedFeatures=" + selectedFeatures;
	var ajaxExt = new AjaxExt();
	ajaxExt.request(url, "POST", function() {
	}, "#wrapper", null, null);
}

function filterByKeywords() {
	var keywords = $('#keywordField').val();
	var count = 0;
	var url = "/wbe/property/doFilterByKeywords.action";
	url = url + "?keywords=" + keywords;
	var ajaxExt = new AjaxExt();
	ajaxExt.request(url, "POST", function() {
	}, "#wrapper", null, null);
}

function inArrayCaseInsensitive(needle, array){
    var defaultResult = -1;
    var result = defaultResult;
    $.each(array, function(index, value) { 
        if (result == defaultResult && value.toLowerCase() == needle.toLowerCase()) {
            result = index;
        }
    });
    return result;
}

function filterKeywords()
{
	var keywordField = $( "#keywordField" );
	if( keywordField )
	{
		var keywordStr = keywordField.val();
		if( keywordStr != null && keywordStr.trim() != "" )
		{
			$( ".propertyDetail" ).each(
				function()
				{
					var property = $( this );
					var keywordListStr = property.attr( "data-keywords" );
					if( keywordListStr != null && keywordListStr.trim() != "" && keywordListStr.indexOf( "[" ) == 0 && keywordListStr.indexOf( "]" ) == ( keywordListStr.length - 1 )  )
					{
						var keywordList = eval( keywordListStr );
						if( typeof keywordList == "object" && keywordList.length > 0 )
						{
							if( inArrayCaseInsensitive( keywordStr, keywordList ) < 0 )
							{
								var keywordTokens = keywordStr.split( "//s" );
								for( i in keywordTokens )
								{
									var keyword = keywordTokens[ i ];
									if( inArrayCaseInsensitive( keyword, keywordList ) >= 0 )
									{
										return;
									}
								}
							}
							else
							{
								return;
							}
							property.addClass( "hiddenProperty" );
						}
					}
				}
			);
		}
	}
}

function runPriceFilters()
{
	filterLowPrice();
	filterHighPrice();
}

function runFilters() {
	showHiddenProperty();
	runPriceFilters();
	filterRating();
	filterKeywords();
	
	refreshPropertyView();
}

function refreshPropertyView()
{
	var visibleProperties = getVisiblePropertyCodes();
	if( visibleProperties != null && visibleProperties.length == 1 ) {
		if (typeof centerOnProperty != 'undefined')
			centerOnProperty( visibleProperties[ 0 ] );
	}
	if (typeof placeProperties != 'undefined')
		placeProperties();
}