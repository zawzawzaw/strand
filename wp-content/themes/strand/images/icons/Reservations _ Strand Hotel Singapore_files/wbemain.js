var item = null;
var subItem = null;
var itemEvent = null;
var navigationPerventionMessage = null;
var allowNavigateAway = true;
var cartHeight, sideDisplay;
var ajaxExtAdd = new AjaxExt();
var ajaxExtDel = new AjaxExt();
var ajaxExt = new AjaxExt();

function ieFixBanner(){
	$('#roll').height($('#roll').parent().height());
	var bannerHeight = $('#roll').height();
	var bannerWidth = $('#roll').width();
	$('#roll li').each(function() {
		$(this).height(bannerHeight).width(bannerWidth);
		//$(this).find('img').height(bannerHeight).width(bannerWidth);
	});
}

function toggleTransportation(){
	$("#transportation").slideToggle(function() {
		if($("#transportation").is(":visible")) {
			$(this).children().find("input, select").not("input#etaTN").not("input#etdTN").addClass("required");
			$(".transportation a").text($(".transportation a").attr("data-hide"));
		}
	});
}


function toggleDesc(descblock, section){
	$("#"+descblock).slideToggle(function(){
		var expand = $(section);
		var text = ( $("#"+descblock).is(":hidden") ) ? "[&equiv;]" : "[&minus;]";	
			expand.html(text);
	});
}
var rootMenu="", scrolltop = 0;
function deepdropdown(ulObj, opt){
	var root = $("#"+ulObj);
	var totalHeight=0;
	if (rootMenu == "") rootMenu = root.attr("id");
	root.children().each(function(index,element){
		if($(this).children("ul").length){
			var lmn = $(element);
			var _this = $(this);
			var ul = _this.children("ul");
			var ulTopPos = _this.offset().top - (_this.height() + parseInt(_this.children("a").css("padding").replace("px")));
			if(lmn.parent("#"+rootMenu).length){
				ul.css("width", $(element).width + "px");
				if (opt != undefined || opt != "" || opt !== null) {
					if (opt.position.toLowerCase() == "vertical") ul.css("top", "0px");
				}
				_this.on("mouseenter mouseleave", function(e){
					parentMenu(ul.attr("id"), e);
				})
			}else{
				totalHeight = 0;
				if (opt.position.toLowerCase() != "vertical"){
					lmn.prevAll().each(function(){
						totalHeight += $(this).outerHeight();
					})
				}
				//var ulTopPos = lmn.height() * index;
				ul.css({
					"top":totalHeight+"px",
					"left":lmn.width()
				});
				_this.on("mouseenter mouseleave", function(e){
					subMenu(ul.attr("id"), e);
				})
			}
			deepdropdown(_this.children("ul").attr("id"), opt);
		}
	});
}

var login = function() {
	if(typeof window.login_reload == 'function') {
		ajaxExt.formSubmit("#loginForm", "#header", login_reload, null);
	} else {
		alert('no login reload');
		ajaxExt.formSubmit("#loginForm", "#header", null, null);
	}
};
 
var forgotPassword = function() {
	var url = '/wbe/login/forgotPassword.action?mobile=N&amp;fromMenu=1';
	url += "?loginInfoData.userName=" + $("#username").val() ;	
	location.href = url;	
};
 
var logout = function() {
	location.href = '/wbe/login/logout.action?mobile=N&amp;fromMenu=1';
};
 
var register = function() {
	location.href = '/wbe/login/initRegister.action?mobile=N&amp;fromMenu=1';
};

var modifyAction = function(formId, sessionId, hosturl) {
	return;
	var tmpurl = '';
	if (sessionId == null)
		return;
	var myForm = jQuery('#' +formId);
	var originalAction = myForm.attr('action');
	if (originalAction != null && originalAction.indexOf('jsessionid') > 0)
		return;
	
	var host = hosturl.split('/')[2];
	hosturl = host;
	
	if (hosturl != null && sessionId != null)
		tmpurl = hosturl + "/" + myForm.attr("action")
				+ ';jsessionid=' + sessionId;
	else if (hosturl != null && sessionId == null)
		tmpurl = hosturl + "/" + myForm.attr("action");
	else
		tmpurl = myForm.attr("action");
	myForm.attr('action',tmpurl);	
};

//#SellOption
var getSellOption = function(sessionId, hosturl) {
	//TODO: need to populate the form action to contain hostURL and sessionID
	modifyAction('listForm', sessionId, hosturl);
	ajaxExt.formSubmit("#listForm", "#wrapper", null, null);
};

//##SellOption
var filterSellOptions = function(sessionId, hosturl) {
	var selectedCurrency = $('#exchangeCurrency').val();
	var propCurrency = $('#propCurrencyCode').val();
	var isUsingExchange = propCurrency != selectedCurrency;
	var exchange = 1;
	var selectedMin = $( "#slider-range" ).slider( "values" )[ 0 ];
	var selectedMax = $( "#slider-range" ).slider( "values" )[ 1 ];
/*	$( "#minRate" ).val( selectedMin);
	$( "#maxRate" ).val( selectedMax ); */
	
	var oldMinRate = $( "#minRate" ).val();
	var oldMaxRate = $( "#maxRate" ).val();
	
	if (isUsingExchange) {
		exchange = $('#exchangeCurrency option:selected').data('exchange');
		selectedMin = (Math.round((selectedMin * 100) / exchange)/ 100).toFixed(0);
		selectedMax = (Math.round((selectedMax * 100) / exchange)/ 100).toFixed(0);
		$( "#minRate" ).val(selectedMin);
		$( "#maxRate" ).val(selectedMax); 
	}
/*	$( "#minRateDisplay" ).html(selectedMin);
	$( "#maxRateDisplay" ).html(selectedMax);*/

	var form = document.getElementById( "filterForm" );
//	form.action = "<s:url namespace='/sellOption' action='filter'/>";
	modifyAction('filterForm', sessionId, hosturl);
	ajaxExt.formSubmit("#filterForm", "#sellOptionList", function() {
		initFancyBox();
		if (isUsingExchange) {
			changeCurrency(selectedCurrency, exchange);
			$('#exchangeCurrency').val(selectedCurrency);
		}

		$( "#minRateDisplay" ).html(oldMinRate);
		$( "#maxRateDisplay" ).html(oldMaxRate);
		$('#minRate').val(oldMinRate);
		$('#maxRate').val(oldMaxRate);
		$("#slider-range").slider('values',[$('#minRate').val(), $('#maxRate').val()]);
	});
};

// modify search
var relistSearchOption = function(url, sessionId, hosturl) {
	var ajaxExt = new AjaxExt();
	modifyAction('modifySearchForm', sessionId, hosturl);
	var data = $('#modifySearchForm').serialize(); 
	ajaxExt.request(url, 'POST', function() {
		checkBody("");
	}, "#wrapper", data);
};

//#SellOption
var sortSellOptions = function(sessionId, hosturl) {
	var form = document.getElementById( "filterForm" );
	form.action = "sort";
	modifyAction('filterForm', sessionId, hosturl);
	ajaxExt.formSubmit( "#filterForm", "#sellOptionList", function() {
		initFancyBox();
	});
};
 
var resizeImage = function(imageId) {
	var maxWidth = 143; // Max width for the image
	var maxHeight = 140;    // Max height for the image
	var ratio = 0;  // Used for aspect ratio
	var width = $("#"+imageId).width();    // Current image width
	var height = $("#"+imageId).height();  // Current image height

	var parentElement = $( "#" + imageId ).parent();
	maxWidth = Math.min( maxWidth, parentElement.width() );
	maxHeight = Math.min( maxHeight, parentElement.height() );
	
	// Check if the current width is larger than the max
	if(width > maxWidth){
		ratio = maxWidth / width;   // get ratio for scaling image
		$("#"+imageId).css("width", maxWidth); // Set new width
		$("#"+imageId).css("height", height * ratio);  // Scale height based on ratio
		height = height * ratio;    // Reset height to match scaled image
	}

	// Check if current height is larger than max
	if(height > maxHeight){
		ratio = maxHeight / height; // get ratio for scaling image
		$("#"+imageId).css("height", maxHeight);   // Set new height
		$("#"+imageId).css("width", width * ratio);    // Scale width based on ratio
		width = width * ratio;    // Reset width to match scaled image
	}
};

var oldCheckInDate, oldCheckOutDate, oldDateDiff;

// checkDateRange
var checkDateRange = function( input, inst ) {
	var instID = $(inst).attr("id");
	$(inst).datepicker( "setDate", $(input).datepicker( "getDate" ));
	oldCheckInDate =  $('#checkInDate').datepicker( "getDate" );
	oldCheckOutDate = $('#checkOutDate').datepicker( "getDate" );
	
	if(instID == "checkInDate") {
/*		if (instID == 'checkInDate')
			checkOutDate = $( "#checkOutDate" ).datepicker( "getDate" );
		else
			checkOutDate = $( "#qik_checkOutDate" ).datepicker( "getDate" );
		if (checkOutDate != null) {
			maxDate = new Date(checkOutDate.getTime());
			$(input).datepicker( "option", "maxDate", maxDate ); 
		} */
	} else if( instID == "checkOutDate") {
		checkInDate = $( "#checkInDate" ).datepicker( "getDate" );
		if (checkInDate != null) {
			checkInDate.setDate(checkInDate.getDate() + 1);
			minDate = new Date(checkInDate.getTime());
			$( input ).datepicker( "option", "minDate", minDate);
		}
	}
};

var keepTheSize = function() {
	var bodyCart = $(".qikres_body_cart");
//	$(".qikres_side_display").css("top",sideDisplay + "px");
	if (parseInt(bodyCart.height()) >= parseInt(cartHeight - $("#totalPayment").height())){
		bodyCart.css("height",(cartHeight - $("#totalPayment").height())+"px");
	}else{
		bodyCart.css("height","auto");
	}
	var side = $(".qikres_side_display");
	var sideDisplayPos = sideDisplay;
	if ((sideDisplayPos + side.height()) >  $('.qikres_main_display').height()) {
		side.css("top", 0);
		//sideDisplay = 0;
	}
	if ($('#resvCartBar').length > 0) $('#resvCartBar').css('top', '0');
}

var allowMonthDayChange = true;
// after date change
var dateChange = function( date, element ) {
	var useNumNight = $('#numOfNight').is(":visible");
	var instID = $(element).attr("id");
	if( date == null )
		date = $( element ).datepicker( "getDate" );
	
	if(instID == "checkInDate") {
		checkInDate = $( "#checkInDate" ).datepicker( "getDate" );
		if (oldCheckOutDate != null && oldCheckOutDate < checkInDate ) {
			if (oldDateDiff == 0)
				oldDateDiff = 1;
			checkInDate.setDate(checkInDate.getDate() + oldDateDiff);
		} else {
			if (useNumNight) {
				olDateDiff =  parseInt($('#numOfNight').val(), 10);
				checkInDate.setDate(checkInDate.getDate() + olDateDiff);
			} else {
				checkInDate.setDate(checkInDate.getDate() + 1);
				olDateDiff = 1;
			}
		}
		/*if ($('#checkOutDate').val() == '') {
			$('#checkOutDate').datepicker("setDate", checkInDate);
		}*/
		allowMonthDayChange = false;
		minDate = new Date(checkInDate.getTime());
		$( "#checkOutDate" ).datepicker( "option", "minDate", minDate );
		$('#checkOutDate').datepicker('setDate', minDate);
		if ($('#checkOutDate').val() == '') {
			$( "#checkOutDate" ).datepicker( "option", "minDate", minDate );
			$('#checkOutDate').datepicker("setDate", minDate);
		}
		allowMonthDayChange = true;
	} else if( instID == "checkOutDate") {
/*		if (useNumNight) {
			checkOutDate = $( "#checkOutDate" ).datepicker( "getDate" );
			checkOutDate.setDate(checkOutDate.getDate() - parseInt($('#numOfNight').val(), 10));
			var newCheckInDate = new Date(checkOutDate.getTime());
			$( "#checkInDate" ).datepicker( "setDate", newCheckInDate );
		} */
	};

	if (useNumNight && instID != "checkOutDate") {
		oldDateDiff = parseInt($('#numOfNight').val(), 10);
	} else {
		oldDateDiff = ($( "#checkOutDate" ).datepicker("getDate") - $( "#checkInDate" ).datepicker("getDate"))/1000/60/60/24;
		oldDateDiff = oldDateDiff <= 0 ? 1 : oldDateDiff; 
	}
};

var updateNumOfNight = function(recount) {
	var checkInDate = $('#checkInDate').datepicker('getDate', '+1d');
	if (typeof recount !== 'undefined'  && recount) {
		var checkOutDate =  $('#checkOutDate').datepicker('getDate');
		var delta = (checkOutDate - checkInDate)/86400000;
		$('#numOfNight').val(delta);
	} else {
		var delta = $('#numOfNight').val();
		if (checkInDate != null) {
			var date2 = checkInDate;
			date2.setDate(checkInDate.getDate() + parseInt(delta, 10));
			$('#checkOutDate').datepicker('option', 'minDate', date2);
			$('#checkOutDate').datepicker('setDate', date2);

		} else {
			$('#checkOutDate').val('');
		}
	}
};


var dateValueChange= function(fieldName) {
	if ($('#alternate'))
		$('#' + fieldName).val($('#alternate').val());
	else
		alert('please create alternate hidden field');
};

var formatDate = function(date, formatPattern) {
	return $.datepicker.formatDate(formatPattern, date);
};

//##SellOption
var setOptimumSize = function( element, maxHeight, maxWidth ) {
	var textElement = $( element );
	var ratio = 1;
	
	ratio = Math.min( maxWidth / textElement.width() , maxHeight / textElement.height() );
	
	if( maxHeight > 0 && maxHeight > textElement.parent().parent().height() ) {
		textElement.parent().parent().css( { height : maxHeight } );
	}
	
	if( maxWidth > 0 && maxWidth > textElement.parent().parent().width() ) {
		textElement.parent().parent().css( { width : maxWidth } );
	}
	textElement.css( { clip : "rect( 0px, " + textElement.parent().width() + ", " + textElement.parent().height() + ", 0px )" } );
};

//#SellOption
var showMore = function( id ) {
	if( id == null )
		id = "moreDesc";
	
	$( "#" + id ).slideToggle();
	$( "#" + id ).show( 'fast' );
};

//#SellOption
var showAdvancedFilters = function() {
	$( "#otherFilters" ).slideToggle();
};

//#SellOption
var startheight=0;
var showMorePropertyInfo = function(more, less, caller, id) {
	var propDesc = $("#propertyDesc");
		if (!startheight) startheight = propDesc.height();
	if( typeof id == 'undefined' || id == null) {
		if (propDesc.css("overflow") == "hidden" ) {
			propDesc.css({
				"overflow":"visible",
				"height":"auto"
			})
			$("#"+caller).text(less);
		}else{
			propDesc.css({
				"overflow":"hidden",
				"height":startheight + "px"
			});
			$("#"+caller).text(more);
		}
	} else {
		$( "#lessPropertyDesc_" +id ).slideToggle().hide( "fast" );
		$( "#morePropertyDesc_" +id).slideToggle().show( "fast" );
	}
};

var showMoreRoomDesc = function(id) {
	if( typeof id == 'undefined' || id == null) {
		$( "#lessRoomDesc" ).slideToggle().hide( "fast" );
		$( "#moreRoomDesc" ).slideToggle().show( "fast" );
	} else {
		$( "#lessRoomDesc_" +id ).slideToggle().hide( "fast" );
		$( "#moreRoomDesc_" +id).slideToggle().show( "fast" );
	}
};

//#SellOption
var showLessPropertyInfo = function(id) {
	if( typeof id == 'undefined' || id == null) {
		$( "#morePropertyDesc" ).slideToggle().hide( "fast" );
		$( "#lessPropertyDesc" ).slideToggle().show( "fast" );
	} else {
		$( "#morePropertyDesc_" +id ).slideToggle().hide( "fast" );
		$( "#lessPropertyDesc_" +id).slideToggle().show( "fast" );
	}
};

var showLessRoomDesc = function(id) {
	if( typeof id == 'undefined' || id == null) {
		$( "#moreRoomDesc" ).slideToggle().hide( "fast" );
		$( "#lessRoomDesc" ).slideToggle().show( "fast" );
	} else {
		$( "#moreRoomDesc_" +id ).slideToggle().hide( "fast" );
		$( "#lessRoomDesc_" +id).slideToggle().show( "fast" );
	}
};

//#SellOption
var showOriginalMsg = function(id) {
	if( id != null ) {
		var fullTextElement = $( "#" + id );
		if( fullTextElement != null ) {
			alert( fullTextElement.text() );
		}
	}
};

//#SellOption
var nextPage = function() {
	var index = $( "#paginationIndex" ).val();
	index++;
	setPageIndex( index );
};

//#SellOption
var previousPage = function() {
	var index = $( "#paginationIndex" ).val();
	index--;
	setPageIndex( index );
};

//#SellOption
var setPageIndex = function( index ) {
	$( "#paginationIndex" ).val( index );
	ajaxExt.formSubmit("#paginationForm", "#sellOptionList" );
};

//#SellOption
var refreshCart = function() {
	var refresh = contextPath + '/reservationCart/addMoreRoom';
	navigateTo( refresh, false );
//	ajaxExt.request(refresh, "GET", function() {
//		keepTheSize();
//		checkBody("");
//		initFancyBox();
//	}, "#cartInfo");
}

var addProduct = function(id, index, subItemIndex, sessionId, hosturl) {
	var url = contextPath + '/sellOption/add?selectedRow='+index;
	if(subItemIndex != null)
		url = url + '&subItemIndex='+subItemIndex;
	else
		url = url + '&subItemIndex='+0;
	
	item = index;
	subItem = subItemIndex;
	itemEvent = 'add';
	refreshAddToCartElement = true;
	
	var id = "#"+id + "_" +index;
	if(subItemIndex != null)
		id += "_" + subItemIndex;

	var count = $(id).val();
	var data = 'selectedRoomCount=' + count;
	modifyAction('', sessionId, hosturl);
	ajaxExtAdd.request(url, "GET", function() {
		keepTheSize();
		//resizeIframe({"height" : qikresContent.height(), "width" : qikresContent.width()});
		checkBody("");
	}, "#cartInfo", data);
};

//#SellOption
var deleteProduct = function(resvProdIndex, resvIndex) {
	var selectedCurrency = $('#exchangeCurrency').val();
	var exchange = $('#exchangeCurrency option:selected').data('exchange');
	var propCurrency = $('#propCurrencyCode').val();
	var isUsingExchange = propCurrency != selectedCurrency;
	
	var reservationId = "#resv_" + resvProdIndex + "_" + resvIndex;
	var sellOption = $('#sellOption_' + resvProdIndex + "_" + resvIndex).val();
	var sellOptionID = sellOption.split('_');
	item = sellOptionID[0];
	subItem = sellOptionID[1];
	itemEvent = 'delete';
	var url = contextPath + '/sellOption/delete';
	var data = 'selectedResvProd=' + resvProdIndex + '&selectedResv=' + resvIndex;
	data = data + "&isSellOpt=true";	
	refreshAddToCartElement = true;
	/*ajaxExtDel.request(url, 'POST', function() {
		refreshCart();
		initFancyBox();
		if (isUsingExchange)
			changeCurrency(selectedCurrency, exchange);
	}, "#sellOptionList", data);*/
	//$.blockUI({ message: $('#qikinn_loader') });
	$.blockUI({ message: $('#qikinn_loader') || $('#ajax_loader') });
	$.ajax({
		url: url,
		data: data,
		type: "POST",
		success: function(response){
			refreshCart();
			initFancyBox();
			$("#sellOptionList").html(response);
			if (isUsingExchange)
				changeCurrency(selectedCurrency, exchange);
//			if ($.blockUI) jQuery.unblockUI();
		}
	})
};

//#SellOption
var refreshAddToCart = function() {
	if( item != null ) {
		var suffix = item;
		var physicalCount;
		if( subItem != null ) {
			suffix = suffix + '_' + subItem;
		}
		physicalCount = $( "#physicalCount_" + item ).val();
		
		var addToCartID = "#addToCart_" + suffix;
		var bookControlID = ".book_"+suffix;
		var availabilityCount = eval( $( "#availabilityCount_" + suffix ).val() );
		var roomCount = eval( $( "#roomCount_" + suffix ).val() );

		if( availabilityCount >= roomCount ) {
			// only addProduct event need to minus roomCount
			if (itemEvent == 'add') {  
				availabilityCount = availabilityCount - roomCount;
				physicalCount = physicalCount - roomCount;
			}
			
			//set physicalCout back
			$( "#physicalCount_" + item ).val(physicalCount);
			
			$( "#availabilityCount_" + suffix ).val( availabilityCount );
			if( availabilityCount < 1 || physicalCount < 1) {
				$( addToCartID + "> .qikres_noavailability" ).css( "display", "block" );
				$( bookControlID ).hide();
			}
			
			var optionCount = availabilityCount < physicalCount ? availabilityCount : physicalCount;
			if(optionCount < 5) {
				//reset option list to the selected value
				var options = '' ;
				for(i = 1; i <= optionCount; i++) {
					options += '<option ' + i + '">' + i + '</option>'
				}
				$("#roomCount_" + suffix).find('option').remove() ;
				$("#roomCount_" + suffix).html(options);
			}
		}
		
		var item_avail_count = 'availabilityCount_'+item +'_';
		var selector = $("input[id^="+item_avail_count+"]");
		for ( var index = 0; index < selector.length; index++) {
			var obj = selector[index];
			var itemAvailCount = obj.value;
			var itemId = "_" + item + "_" + index;
			
			if(itemAvailCount >= physicalCount) {
				var optionsCount = physicalCount;
				
				var item_key = itemId;
				if(optionsCount > 5) {
					optionsCount = 5;
				}
				
				
				if(optionsCount < 1) {
					var addToCartID = "#noAvail" + item_key;
					var bookControlID = ".book"+item_key;
					$( addToCartID ).css( "display", "block" );
					$( bookControlID ).hide();
				} else {
					var options = '' ;
					for(i = 1; i <= optionsCount; i++) {
						options += '<option ' + i + '">' + i + '</option>'
					}
					
					var room_combo = "#roomCount"+item_key;
					
					$(room_combo).find('option').remove() ;
					$(room_combo).html(options);
				}
			}
		};
	}
	
	item = null;
	subItem = null;
	itemEvent = null;
	refreshAddToCartElement = false;
};

//#SellOption
var scanForTargetElements = function( targetClass, maintainRatio ) {
	var i = 0;
	var elements = $( targetClass );
	var maxHeight = 0;
	var maxWidth = 0;
	var ratio = 1;
	
	if( typeof elements == 'undefined' || elements == null || elements.length <= 0 )
		return
		
	for( i = 0; i < elements.length; i++ ) {
		maxHeight = Math.max( $( elements[ i ] ).height(), maxHeight );
		maxWidth = Math.max( $( elements[ i ] ).width(), maxWidth );
	}
	
	if( maintainRatio != true ) {
		maxHeight = Math.max( maxHeight, maxWidth );
		maxWidth = Math.max( maxWidth, maxHeight );
	}
	
	for( i = 0; i < elements.length; i++ ) {
		setOptimumSize( elements[ i ], maxHeight, maxWidth );
	}
};

//#SellOption
var resetHeight;
var showMoreProduct = function(index) {
	$("#subrate"+index).slideToggle("fast" );
	$("#lowprice"+index).slideToggle("fast");	
	$("#showMore"+index).hide();	
	$("#showLess"+index).show();	
	//$('#main-content').css({'height':($('#main-content').height() + $( "#subrate"+index ).height() ) +'px'});
	resetHeight = $("#roomList").css("height");
	//$("#roomList").css("height",$('#main-content').height()-131+"px");
	//$("#main-content,#roomList").css("height","auto");
	scanForTargetElements( ".amountText", true );
};

//#SellOption
var showLessProduct = function(index) {
	var resizeMainContent = function() 	{
		$('#main-content').css({'height':($('#main-content').height() - $( "#subrate"+index ).height() )  +'px'});
		//$("#roomList").css("height",$('#main-content').height()-260+"px");
		$("#main-content,#roomList").css("height","auto");
	};
	$("#subrate"+index).slideToggle("fast", resizeMainContent );
	$("#lowprice"+index).slideToggle("fast");
	$("#showLess"+index).hide();
	$("#showMore"+index).show();
};

//#ReservationCart
var popUpConfirmation = function() {
	var mainContent = $("#wrapper");
	var windowAttr = '"';
	windowAttr = windowAttr + 'menubar=0,location=0,status=0,scrollbars=1,resizable=yes,left=0,top=0';
	windowAttr = windowAttr + ',width=' + mainContent.width();
	windowAttr = windowAttr + ',height=' + mainContent.height();
	windowAttr = windowAttr + '"';
	window.open( printURL, "printWindow" , windowAttr );
};

//#ReservationCart
var printConfirmation = function() {
	window.print();
};

var qikresContent;
var parent_url = decodeURIComponent(document.location.hash.replace(/^#/, ''));
var resizeIframe = function(size) {
	if( typeof size != "undefined" && size != null )
	{
	    XD.postMessage(size, parent_url, parent);
		//qikresContent.data("size", qikresContent.height() + ";" + qikresContent.width());
		qikresContent.data("size", {"height" : qikresContent.height() , "width" : qikresContent.width()});
	}
    return false;
};

var zoomImage = function(obj){
	XD.postMessage({"type" : "callFunction", "functionName" : "goToCenter()", "caller" : $(caller).attr("id")}, parent_url, parent);
}

var checkBody = function(result){
	var mainDisplay = $('.qikres_main_display');
	var sideDisplay = $('.qikres_side_display');
	var size = {"height" : qikresContent.height() , "width" : qikresContent.width()};
	var sideHeight = (sideDisplay.length) ? sideDisplay.height() + parseInt( sideDisplay.css("margin-top").replace("px","") ) : 0;
	var mainHeight = (mainDisplay.length) ? mainDisplay.height() + parseInt( mainDisplay.css("margin-top").replace("px","") ) : 0;
	var minHeight = Math.max(qikresContent.height(), mainHeight, sideHeight);
	//if (qikresContent.height() <= 0 || (!compareObject(size, qikresContent.data("size")))) {
		/*var sideHeight = (sideDisplay.length) ? sideDisplay.height() + parseInt( sideDisplay.css("margin-top").replace("px","") ) : 0;
		var mainHeight = (mainDisplay.length) ? mainDisplay.height() + parseInt( mainDisplay.css("margin-top").replace("px","") ) : 0;
		//var mainHeight = $('.qikres_main_display').height() > sideHeight ? $('.qikres_main_display').height() + parseInt( $(".qikres_main_display").css("margin-top").replace("px","") ) : sideHeight; 
		var minHeight = qikresContent.height() > 0 ? qikresContent.height() : mainHeight;
		if ($(".qikres_side_display").length > 0) {
			resizeIframe({"height" : minHeight, "width" : qikresContent.width() , "result" : result});
		}else{
			resizeIframe({"height" : minHeight, "width" : qikresContent.width() , "result" : result});
		}*/
		resizeIframe({"height" : minHeight, "width" : qikresContent.width() , "result" : result});
	//}
};

var resizeContent = function(result) {
	qikresContent = $(".qikres_content");
	var htmlWidth = $(window).width();
	var htmlHeight = $(window).height();
	if (htmlWidth > qikresContent.width()) {
		$('#wrapper').css('width',htmlWidth+"px");
		$('#wrapper').css('height',htmlHeight+"px");
		setInterval(function(){
			checkBody(result);
		}, 100);
	} else {
		setInterval(function(){
			checkBody(result);
		}, 100);
	}
};


//Hack, hack, hack :)
//Returns the real elements to scroll (supports window/iframes, documents and regular nodes)
$.fn._scrollable = function(){
	return this.map(function(){
	 var elem = this,
	   isWin = !elem.nodeName || $.inArray( elem.nodeName.toLowerCase(), ['iframe','#document','html','body'] ) != -1;
	
	 if( ! isWin ) {
	   return elem;
	 }
	
	
	 var doc = (elem.contentWindow || elem).document || elem.ownerDocument || elem;
	
	  return $.browser.safari || doc.compatMode == 'BackCompat' ?
	    doc.body : 
	    doc.documentElement;
	});
};

var repos;
var minimumHeight = 40;

var reposFancyBox = function(needOffSet) {
	var requiredOffSet = needOffSet == undefined ? true : needOffSet;
	var imgHeight = $('#fancybox-img').height();
	var offSet = screen.height/2 - imgHeight/2;
	if ($('.qikres_side_display').attr('toppos')) {
		var topPos =  parseInt($('.qikres_side_display').attr('toppos'));
		if (topPos > minimumHeight) {
			var isPopup = $('.qikres_side_display').attr('ispopup');
			if (isPopup === 'true') {
				offSet = screen.height/2 - imgHeight + 20;
			}
		} else {
			topPos = minimumHeight;
			offSet = 0;
		}
		if (requiredOffSet)
			topPos = topPos + offSet;
		$("#fancybox-wrap").stop().animate({
		    'top': topPos + 'px',
		}, 0); 
	}
};

var parentScrollTop;
var windowHeight;
var iframeTop;
var iframeLeft;
var iframeWidth;
var checkParentWindow = function() {
	parentScrollTop = windowHeight = windowWidth = iframeTop = iframeLeft = iframeWidth = -1;
	XD.postMessage({"type" : "callFunction", "functionName" : "getParentInfo()"}, parent_url, parent);
	XD.receiveMessage(function(message){
		frameMsg = message.data;
		if ((typeof message.data) == 'string') {
			var msg = message.data;
			frameMsg = JSON.parse(msg);
		}
		try{
			if (frameMsg.type == "embedded" || frameMsg.type == "popup"){
				parentScrollTop = frameMsg.parentScrollTop;
				windowHeight = frameMsg.windowHeight;
				windowWidth = frameMsg.windowWidth;
				iframeWidth = frameMsg.iframeWidth;
				iframeTop = frameMsg.iframeTop;
				iframeLeft = frameMsg.iframeLeft;
			}
		}catch(e){}
	}, urlSender[1].replace(/^(.*\/\/[^\/?#]*).*$/,"$1"));
	$(".fancybox-wrap").css("display", "none");
	$(".fancybox-lock .fancybox-overlay").css("overflow-y", "hidden");	
}

var reposFancyBoxImg = function() {
	if ($.blockUI) jQuery.unblockUI();
	var eTop = Math.ceil((windowHeight - $(".fancybox-wrap").outerHeight()) / 2) + parentScrollTop - iframeTop;
	var imgH = imgW = xBtnSize = titleBottom = 0; 
	
	if(eTop < 0) {
		var dif =  (eTop * -2);
		imgH = $(".fancybox-inner").height() - dif;
		imgW = Math.ceil((imgH * $(".fancybox-inner").width()) / $(".fancybox-inner").height()) ;
		xBtnSize = 18;
	}
	else if(eTop + $(".fancybox-wrap").height() + 40 >= $(window).height()) {
		var dif =  (eTop + $(".fancybox-wrap").height() - $(window).height()) * 2;
		if(dif > 0) {
			imgH = $(".fancybox-inner").height() - dif;
		}
		else {
			imgH = $(window).height() - eTop - 18 - 60 - 35;
			eTop = Math.ceil((windowHeight - imgH) / 2) + parentScrollTop - iframeTop;
		}	
		if(imgH < 0) {
			var boxSizePlusXAndTitle = $(".fancybox-wrap").height() + 18 + 35;
			if(boxSizePlusXAndTitle <= $(window).height()) {
				imgH = 0;
				eTop = Math.ceil(($(window).height() - $(".fancybox-wrap").height()) / 2);
			}	
		}
		else {
			imgW = Math.ceil((imgH * $(".fancybox-inner").width()) / $(".fancybox-inner").height()) ;
		}
		titleBottom = 40;
		
	}
	var topPost = eTop+"px";
	$(".fancybox-wrap").css({"top": topPost, "position": "fixed"});
	var position_interval = setInterval(function() { 
	    if($(".fancybox-wrap").css("top") != topPost) {
	    	$(".fancybox-wrap").css({"top": topPost, "position": "fixed", "display": ""});
	    	if(imgH > 0 && imgW > 0) {
	    		$(".fancybox-inner").css({"width": imgW+"px", "height": imgH+"px"});
	    		$(".fancybox-wrap").css({"width": "auto"});
	    		eTop = Math.ceil((windowHeight - $(".fancybox-wrap").outerHeight()) / 2) + parentScrollTop - iframeTop + xBtnSize - titleBottom;
	    		//var eLeft = Math.ceil((windowWidth - $(".fancybox-wrap").outerWidth()) / 2) - iframeLeft;
	    		var eLeft = Math.ceil((iframeWidth - $(".fancybox-wrap").outerWidth()) / 2)// + iframeLeft;
	    		//if(eLeft < 0) eLeft = 0;
	    		$(".fancybox-wrap").css({"left": eLeft+"px", "top": eTop+"px"});
	    	}
	    	clearInterval(position_interval);
	    }
	}, 100);
}

$.fn.hasScrollBar = function() {
    return this.get(0).scrollHeight > this.height();
};

var navigateTo = function( url, refreshFlag ) {
	if( typeof refreshFlag == "undefined" || refreshFlag == null )
	{
		refreshFlag = false;
	}
	
	allowNavigateAway = true;
	// window.location = url;
	errorResponse = function() {
		var refresh = refreshFlag;
		var refreshFunction = refreshCart;
		if( refresh == true )
		{
			refreshFunction();
		}
	};
	onSuccessFunc = function() {
		if ($.blockUI) $.unblockUI();
	//	$("html, body").css("cursor","default");
		if ($('#resvCartBar').length > 0) $('#resvCartBar').css('top', '0');
		XD.postMessage({"type" : "callFunction", "functionName" : "afterNavigate()"}, parent_url, parent);
	};
	ajaxExt.request( 
			url, 
			"GET", 
			function() 
			{
				onSuccessFunc();
				setTimeout(function() {
					keepTheSize()
				}, 100);
				
			}, 
			"#wrapper", 
			null,
			errorResponse
	);
	trackPage(url);
};
  
var preventNavigation = function( e ) {
	e = e || window.event;

	if( typeof allowNavigateAway != 'undefined' && !allowNavigateAway ) {
		if( e ) {
			e.returnValue = navigationPerventionMessage || "Data will be unsaved";
		}
		return navigationPerventionMessage || "Data will be unsaved";
	}
};

var toggleBooking = function(isVisible) {
	if ($('.booking', parent.document)) {
		if (isVisible)
			$('.booking', parent.document).show();
		else
			$('.booking', parent.document).hide();
	}
};

var timeOutResize = function() {
	$('#qik_frame').css({
		'height': '200px',
		'width' : '1000px'
	});
	if ($('#qikinn_loader').length > 0) {
		$('#qikinn_loader').hide();
	}
};

var showMessage = function(msg, type){
	var strHTML = "<ul>";
	if (msg instanceof Array) {
		for (i = 0; i < msg.length; i++) {
			strHTML += "<li style='color:red;list-style:none!important'>" + msg[i] + "</li>";
		}
	} else {
		strHTML += "<li style='color:red;list-style:none!important'>"+msg+"</li>";
	}
	strHTML += "</ul>";
	if (type.toLowerCase() == "error"){
		$("#errorContents").html(strHTML);
		errorMsg();
		return false
	}
	var $dialog = $('<div></div>')
		.html(strHTML)
		.dialog({
			autoOpen: false,
			modal:true,
			dialogClass: type,
			title: type,
			buttons: { "Ok": function() { $(this).dialog("close"); }}
		});
	$dialog.dialog('open');
};

var errorMsg = function(className){
	if(className == undefined) 
		className = "error";
	if(className == "info") {
		$("#errorContents").removeClass("errorContents").addClass("infoContents");
	}
	else if(className == "error") {
		$("#errorContents").removeClass("infoContents").addClass("errorContents");
	}
	var repos = (scrolltop == 0) ? "center" : scrolltop;
	$("#errorContents").dialog("destroy").dialog({
		autoOpen: true,
		modal:true,
		title: (className == "info" ? "Info" : "Error"),
		resizable: false,
		position: ["center", repos ],
		open: function(){
			$(this).parents(".ui-dialog:first").find(".ui-widget-header").removeClass("ui-widget-header").addClass(className);
			$(".ui-dialog").children(".ui-dialog-buttonpane").removeClass("ui-widget-content");
		},
		buttons: 
			{ "Ok": function() 
				{ 
					$(this).dialog("close"); 
				}
			}
	}).parent().addClass("ui-state-"+className);
};

var compareObject = function (obj1, obj2) {
	var result = false;
	if (typeof obj1 == 'undefined') return false;
	if (typeof obj2 == 'undefined') return false;
	
	if (obj1.height == obj2.height && obj1.width == obj2.width)
		return true;
    return false;
};

var resetTmpImg = function(obj) {
	var originalSrc = $(obj).attr('src');
	if (originalSrc == '') {
		var src = $(obj).attr('relsrc');
		if (src != '') {
			$(obj).attr('src', src).removeAttr('relsrc').show();
			imageSize++;
		}
	} else {
		imageSize++;
	}
};

var imageSize = 0;
var imageTimer = new Array();
$.browser.chrome = /chrome/.test(navigator.userAgent.toLowerCase()); 
var loadImage = function() {
	$('.qikres_room_image img, .qikres_property_image img, .qikres_property_image_list img').each(function() {
   		var _this = $(this);
   		resetTmpImg(_this);
   	});
};

var getExchangeValue = function(priceElem, exchangeRate, decimal) {
	var dec = (typeof decimal == 'undefined' || typeof decimal != 'number') ? 2 : decimal;
	var originalPrice = $(priceElem).data('amountvalue');
	
	if (typeof originalPrice == 'string') {
		if (exchangeRate == 1) {
			return originalPrice;
		}
        var re = new RegExp(',', 'g');
		originalPrice = originalPrice.replace(re,'');
	}
	var newPrice = Math.round(originalPrice * exchangeRate * 100)/100; //rouding with 2 decimals
	return newPrice.toFixed(dec);
};

var oldCurrencyCode = '';
var changeCurrency = function(currencyCode, exchangeRate, needAjax) {
	if (currencyCode == '' || typeof currencyCode == 'undefined') {
		$('.currencyNotice').hide();
		$('.homeCurrency').show();
		$('#useHomeCurrency').val(true);
		return;
	}
		
	var propCurrency = $('#propCurrencyCode').val();
	var isUsingExchange = propCurrency != currencyCode;

	if (!isUsingExchange && typeof needAjax == 'undefined') {
		$('.currencyNotice').hide();
		$('.homeCurrency').show();
		$('#useHomeCurrency').val(true);
		return;
	}
	
	if (!isUsingExchange) {
		$('.currencyNotice').hide();
		$('.homeCurrency').show();
		$('#useHomeCurrency').val(true);
		if (oldCurrencyCode == '' || oldCurrencyCode == propCurrencyCode)
			return;
	} else {
		$('.currencyNotice').show();
		$('.homeCurrency').hide();
		$('#useHomeCurrency').val(false);
	}
	oldCurrencyCode = currencyCode;
	if ($('#toCurrencyCode').length > 0) {
		$('#toCurrencyCode').val(currencyCode);
	}
	if ($('#toExchangeRate').length > 0) {
		$('#toExchangeRate').val(exchangeRate);
	} 
	if (typeof needAjax != 'undefined' && needAjax && $('#paginationForm').length > 0) {
		$('#paginationForm').attr('action', contextPath + '/sellOption/changeCurrency.action');
		ajaxExt.formSubmit("#paginationForm", null, null);
	}
		$('.amount .amountText, #totalPayment .second, .item-price, .qikres_book, .price, .sub_total, .addon-price, .item-tax').each(function() {
	//	    if ($(this).is(":visible")) {
		    	$(this).find('.currencyCode').html(currencyCode);
		    	var priceElem = $(this).find('.amountValue');
		    	$(this).find('.amountValue').html(getExchangeValue(priceElem, exchangeRate));
		});
		
		$('.addons').each(function() {
			var _this = $(this);
			_this.find('.amountValue').each(function() {
				$(this).html(getExchangeValue($(this), exchangeRate));
			});
			_this.find('.currencyCode').html(currencyCode);
		});
		
		if ($('.qikres_slider_pos').length > 0) {
			var mymin = 0;
			var mymax = 0;
			$('.qikres_slider_pos').each(function() {
				var _this = $(this);
				_this.find('.amountValue').each(function() {
					var amount = parseFloat(getExchangeValue($(this), exchangeRate, 0));
					mymin = (mymin == 0) ? amount : (amount < mymin ? amount : mymin);
					mymax = (mymax == 0) ? amount : (amount > mymax ? amount : mymax);
					$(this).html(amount);
				});
			});
			jQuery( "#slider-range" ).slider( "destroy" );
			jQuery( "#slider-range" ).slider({
				range: true,
				min: mymin,
				max: mymax,
				values: [ mymin, mymax ],
				stop: null,
				slide: function( event, ui) 	{
					jQuery( "#minRate" ).val( ui.values[ 0 ] );
					jQuery( "#maxRate" ).val( ui.values[ 1 ] );
					jQuery( "#minRateDisplay" ).html( ui.values[ 0 ]  );
					jQuery( "#maxRateDisplay" ).html(  ui.values[ 1 ]  );
				}
			});
		}
		
		var visibleRoomList = $('.roomList, .addOnList'); 
		if (visibleRoomList.length > 0) {
			visibleRoomList.each(function() {
				$(this).find('.currencyCode').html(currencyCode);
				$(this).find('.amountValue').each(function() {
					$(this).html(getExchangeValue($(this), exchangeRate));
				});
			});
		}
};

var showTaxDialg = function() {
	var dialog = null;
	var id = "#taxDialog";
	dialog = $(id).clone();
	dialog.dialog({
			autoOpen: false,
			title: 'Tax breakdown',
			resizable: false,
			dialogClass: 'popup',
			width: 500,
			height: 300,
			modal: true,
			buttons: { "Ok": function() { 
				$(this).dialog("close").dialog('destroy');
				XD.postMessage({"type" : "callFunction", "functionName" : "backToPosition(0)"}, parent_url, parent);
			}}
		});
		
	dialog.dialog( "open" );
	XD.postMessage({"type" : "callFunction", "functionName" : "goToCenter()"}, parent_url, parent);
	$('#taxDialogDiv').show();
};

var showToolTip = function(id, contentId, _gravity) {
	var myid = '#'+id;
	$(myid).tipsy({
		opacity: 1.0,
		html: true,
		gravity: (_gravity) ? _gravity : 'se',
//		trigger: 'manual',
		title: function() { return $('#'+contentId).html(); }
	});
	$(myid).tipsy('show');
	$('*, html,body').bind('mouseleave', function() {
		$(myid).tipsy('hide');
	}).bind('blur', function() {
		$(myid).tipsy('hide');
	});
};

var showTaxTip = function(id) {
	var myid = '#'+id;
	$(myid).tipsy({
		opacity: 1.0,
		html: true,
		gravity: 'nw',
//		trigger: 'manual',
		title: function() { return $("#taxDialog").html(); }
	});
	$(myid).tipsy('show');
	$('*, html,body').bind('mouseleave', function() {
		$(myid).tipsy('hide');
	}).bind('blur', function() {
		$(myid).tipsy('hide');
	});
};

var showTaxbreakdown = function(selectedResvProd, id) {
	var errorResponse = function() {
		if (console)
			console.error("error at showTaxbreakdown");
	};
	var url = contextPath + '/sellOption/showTaxBreakdown.action';
	if (selectedResvProd == null || typeof selectedResvProd == 'undefined') {
		selectedResvProd = '-1';
	} 
	url += '?selectedResvProd=' + encodeURIComponent(selectedResvProd);
	ajaxExt.requestNoBlock(url, "GET", function() {
			showTaxTip(id);
		}, '#taxDialogDiv', errorResponse);
};

var loadCSS = function(cssUrl) {
	if($('link[rel*=style][href="'+cssUrl+'"]').length==0) {
	    $("head").append('<link rel="stylesheet" type="text/css" href="'+cssUrl+'"/>');
	}
};

var ajaxAvailability = function(newDate, callback) {
	var selectedProp = $('#selectedPropertyCode').val() != 'undefined' ? $('#selectedPropertyCode').val() : '';
	if (selectedProp ==='') {
		//console && console.error('selectedProp is null');
		return;
	}
	var url = contextPath + '/sellOption/getCalendarAvailability.action';
	var prop = $('#selectedPropertyCode').val();
	var tmpDate;
	var checkInDate ='';
	if (newDate) {
		tmpDate = new Date(newDate);
		checkInDate = newDate;
	} else {
		checkInDate = $("#checkInDate").val();
		tmpDate = new Date(checkInDate);
		if (checkInDate === ''  || checkInDate == null) {
			checkInDate = '';
			tmpDate = new Date();
		}
	}
	var key = selectedProp + '_avai_'+ (tmpDate.getFullYear()) + "_" + tmpDate.getMonth();
	url += '?propertyCode=' + prop  + '&startDate=' + checkInDate;
	var ajaxExt = new AjaxExt();
	$('#listForm').attr('action', url);
	ajaxExt.requestNoBlock(url, "GET", function(data, textStatus, jqXHR){
		var str = data.trim().replace(/\'/g, '\"');
		var object = jQuery.parseJSON(str);
		var dateArray = object.success.replace('[','').replace(']','').split(',');
		$('#myAvai').val(dateArray);
		sessionStorage.setItem(key, dateArray);
		if (callback)
			callback();
	}, null, null);
};

var getAvai = function(showDate) {
	var selectedProp = $('#selectedPropertyCode').val() != 'undefined' ? $('#selectedPropertyCode').val() : '';
	var key = selectedProp +  '_avai_' + showDate.getFullYear() + '_' +showDate.getMonth();
	if (sessionStorage.getItem(key) !== null) {
		$('#myAvai').val(sessionStorage.getItem(key));
	}

	var localAvail = $('#myAvai').val();
	if (localAvail) {
		var unAvailList = localAvail.split(',');
		var firstDate = new Date(unAvailList[0]);
		firstDate.setHours(0);
		if (firstDate.getTime() > showDate.getTime()) {
			return [true, '', ''];
		} 		
		var endDate = new Date(unAvailList[unAvailList.length-1]);
		endDate.setHours(0);
		if (endDate.getTime() < showDate.getTime())
			return [true, '', ''];
		
		for (i = 0; i < unAvailList.length; i++) {
			var day = new Date(unAvailList[i].trim());
			day.setHours(0);
			if (showDate.getTime() == day.getTime()
	          ){
				return [true, 'holiday', 'No availability'];				
			} 
		}
	}
	return [true, '', ''];	
};

var monthYearChange = function(year, month, widget) {
	if (typeof allowMonthDayChange != 'undefined' && !allowMonthDayChange) {
		return;
	}
	var selectedProp = $('#selectedPropertyCode').val() != 'undefined' ? $('#selectedPropertyCode').val() : '';
	if (selectedProp ==='') {
		//console && console.error('monthYearChange selectedProp is null');
		return;
	}
	var key = selectedProp +  '_avai_' + widget.selectedYear + '_' +widget.selectedMonth;
	if ( sessionStorage.getItem(key) === null ) {
		var month = widget.selectedMonth + 1;
		if (parseInt(month,10) < 10)
			month = '0' + month;
		var newDate = widget.selectedYear + '-' + month + '-01';
		var myWidget = widget;
		ajaxAvailability(newDate, function() {
			$('#'+myWidget.id).datepicker('refresh');
		});
	} else {
		$('#myAvai').val(sessionStorage.getItem(key));
		$('#'+key).datepicker('refresh');
	}
};