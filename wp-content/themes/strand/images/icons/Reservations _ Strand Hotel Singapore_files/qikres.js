var Qikres = (function(){
    var frameMsg = "", thePopupWindow, blocker, property, divLoading, domain, url, imgpath, csspath, jspath, winScrollTop, lastPos;
    var interval_id, last_hash, cache_bust = 1, attached_callback, window = this, _this;
	var host, path, fldr="";
	var loaded, callback, rto, randomize;
	_this = this;
	var receiveMessage = function(callback, source_origin) {
		if (window['postMessage']) {
			if (callback) {
				attached_callback = function(e) {
					if ((typeof source_origin === 'string' && e.origin !== source_origin) || (Object.prototype.toString.call(source_origin) === "[object Function]" && source_origin(e.origin) === !1)) {
						return !1;
					}
					callback(e);
				};
			}
			if (window['addEventListener']) {
				window[callback ? 'addEventListener' : 'removeEventListener']('message', attached_callback, !1);
			} else {
				window[callback ? 'attachEvent' : 'detachEvent']('onmessage', attached_callback);
			}
		} else {
			interval_id && clearInterval(interval_id);
			interval_id = null;

			if (callback) {
				interval_id = setInterval(function(){
					var hash = document.location.hash,
					re = /^#?\d+&/;
					if (hash !== last_hash && re.test(hash)) {
						last_hash = hash;
						callback({data: hash.replace(re, '')});
					}
				}, 50);
			}
		} 
	}
	
	var loadScript = function(urlfile, id, type, callback){
		var typ, script;
		if (type == "js"){
			script = document.createElement("script");	
			script.type = "text/javascript";
			script.src = urlfile;
			typ = "script";
		}else{
			script = document.createElement("link");	
			script.rel = "stylesheet";
			script.href = urlfile;
			script.type = "text/css";
			typ = "link";
		}
		script.id = id;
		if (script.readyState) { 
			script.onreadystatechange = function(){
				if (script.readyState == "loaded" ||script.readyState == "complete"){
					script.onreadystatechange = null;
					if (callback) {
						callback();
					}
				}
			};
		} else {
			script.onload = function(){
				if (callback) {
					callback();
				}
			};
		}
		document.getElementsByTagName("head")[0].insertBefore(script,document.getElementById(id));
	} 
	var finalEndTop, finalSideTop;
	var createIframe = function(properties, callback) {

		container = properties.embeddedContainer;		
		cId =  properties.customerID;
		propId = properties.propertyCode;
		productId = properties.productCode;
		checkInDate = properties.checkInDate;
		checkOutDate = properties.checkOutDate;
		adult = properties.adult;
		children = properties.children;
		style = properties.style;
		printStyle = properties.printStyle
		actionPath = properties.actionPath;
		module = trimString(properties.module);
		originHost = encodeURIComponent(properties.hostAddress);
		jsessionId = properties.jsessionId;
		if( productId == null || typeof productId == "undefined" ) {
			productId = '';
		}
		var myAction = "";
		if (module === 'SEARCH') {
			myAction = domain + fldr + "/sellOption/booking.action?customerID="+ cId + "&selectedPropertyCode=" + propId + "&reset=true&referer=" + originHost + "&jsessionId=" + jsessionId;
		} else if (module === 'WBE'){
			myAction = domain + fldr + "/sellOption/listOption.action?customerID="+ cId + "&selectedPropertyCode=" + propId + "&selectedProductCode=" + productId + "&arrivalDate=" + checkInDate + "&departureDate=" + checkOutDate + "&childCount=" + children + "&adultCount=" + adult + "&reset=true&referer=" + originHost + "&jsessionId=" + jsessionId;;
			if (actionPath != '/sellOption/listOption.action' ) {
				myAction = domain + actionPath + "&referer=" + originHost + "&jsessionId=" + jsessionId;
			} 
		} else if (module === 'RESV'){
			myAction = domain + fldr + "/reservation/searchResv.action?customerID="+ cId + "&selectedPropertyCode=" + propId + "&referer=" + originHost + "&jsessionId=" + jsessionId;
		} else if (module === 'REVIEW') {
			var params = "&confirmationNumber=" + properties.reviewConfNumber + "&email=" + properties.reviewEmail + "&phone=" + properties.reviewPhone + "&lastName=" + properties.reviewLastName + "&firstName="+properties.reviewFirstName;
			myAction = domain + fldr + "/reservation/directReview.action?customerID="+ cId + "&selectedPropertyCode=" + propId + params +  "&referer=" + originHost + "&jsessionId=" + jsessionId;
		} else if ( module === 'PROMOTION' ){
			myAction = domain + fldr + "/promotion/listPromotion.action?rst=emb&cid=" + cId + "&pc=" + propId + "&cssPath=" + style;
			if( typeof productId != "undefined" && productId != null )
			{
				myAction += "&prc=" + productId;
			}
			
			if( typeof checkInDate != "undefined" && checkInDate != null )
			{
				myAction += "&sts=" + checkInDate;
			}
			
			if( typeof checkOutDate != "undefined" && checkOutDate != null )
			{
				myAction += "&ste" + checkOutDate;
			}
			myAction += '&referer=' + originHost; 
		} else if (module === 'PROPSEARCH') {
			myAction = domain + fldr + '/property/searchProperties?checkInDate=' + checkInDate  + '&checkOutDate=' + 
				checkOutDate+'&lat='+properties.lat+'&lng=' + properties.lng+ '&propertyQuery='+encodeURIComponent(properties.propertyQuery)+
				"&sellOptionReqData.childCount=" + children + "&sellOptionReqData.adultCount=" + adult +
				"&referer=" + originHost + "&jsessionId=" + jsessionId;
		} else if(module === 'CUSTOMFOLDER') {
			myAction = domain + fldr + '/page/redirectUrl' + "?url=" + encodeURI(properties.link) + "&jsessionId=" + jsessionId;
		}else if(module === 'CONFIRM_VIEW') {
			myAction = domain + actionPath;
		}
		

		var	src = url + '?'+randomize+'&cid='+cId+'&src=' + encodeURIComponent(myAction)+ '&cssPath=' + style + "#" + encodeURIComponent(document.location.href);
		if (printStyle !== '') {
			src = url + '?'+randomize+'&cid='+cId+'&src=' + encodeURIComponent(myAction)+ '&cssPath=' + style + '&printCSSPath=' + printStyle + "#" + encodeURIComponent(document.location.href);
			if (style === '' || style === undefined) {
				src = url + '?'+randomize+'&cid='+cId+'&src=' + encodeURIComponent(myAction)+ '&printCSSPath=' + printStyle + "#" + encodeURIComponent(document.location.href);
			}
		} else {
			if (style === '' || style === undefined) {
				src = url + '?'+randomize+'&cid='+cId+'&src=' + encodeURIComponent(myAction)+ "#" + encodeURIComponent(document.location.href);
			}
		}

		var dimension = 'width:100%;height:0';
		if (properties.popupFullScreen && properties.window != "embedded") {	
			dimension = 'width:'+jQuery(window).width()+'px;height:0px;';
			jQuery("body,html").css("overflow","hidden");
		}

		var theframe = jQuery("<iframe class=\"qikFrame\" scrolling=\"no\" style=\"display:block;"+dimension+ "\" border=\"0\" id=\"qik_frame\" src=\""+src+"\"></iframe>");
		var thePopupFooter = jQuery("<div id=\"qikin-footer\" class=\"qikin-link-footer\" style=\"width:100%; height:0px; float:left\"></div>");
		var theValueChecker = jQuery("<input type=\"hidden\" id=\"qikin-indicator\"/>");
		var footer;
			jQuery("#"+container).html(theframe).append(thePopupFooter).append(theValueChecker).append(divLoading);
			theframe.load(function(response, status, xhr){
				footer = jQuery("#qikin-footer");
				if (callback) callback();
				if (properties.window == "embedded") {
					XD.postMessage({"type":"cart-height", "windowHeight":jQuery(window).height()}, src, jQuery("#qik_frame")[0].contentWindow);
					var top = jQuery("#qik_frame").offset().top;// + jQuery(".qikin-link-header").height();
					jQuery(window).scroll(function() {
						winScrollTop = jQuery(this).scrollTop();
						var footerTop = footer.offset().top;// - jQuery(window).height();
						var offSet = jQuery(window).height() - (jQuery(document).height() - winScrollTop);
						XD.postMessage({"type":"scrolltop", "value":winScrollTop}, src, jQuery("#qik_frame")[0].contentWindow);
						if ((winScrollTop + jQuery(window).height()) <= footer.offset().top){ //if the bottom part of iframe is INvisible then...
							if (winScrollTop >= top) {
								XD.postMessage({"type":"embedded", "touch":true, "topPos":winScrollTop-top, "marginTop":"0px"},src, jQuery("#qik_frame")[0].contentWindow);
							}else{
								XD.postMessage({"type":"embedded", "touch":false, "topPos":0, "marginTop": ""},src, jQuery("#qik_frame")[0].contentWindow);
							}
						}
					});
				} else {
					XD.postMessage({"type":"popup", "body":jQuery("#popupbody").height()}, src, jQuery("#qik_frame")[0].contentWindow);
				}
			});
		//Qikres.doTimeout();

		if (properties.window == "popup" && properties.popupFullScreen) {
			jQuery("#qikinnWindow").css("width","1027px !important"); 
		}
	}
		
	var loadLoader = function(doCheck){		
		divLoading = jQuery("<table id=\"qikinn_loader\" align=\"center\" width=\"100%\" height=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\" style=\"width: 100%; height: 100%; text-align: center; vertical-align: middle; float:left\"><tr><td bgcolor=\"#FFFFFF\" align=\"center\" style=\"text-align: center; vertical-align: middle\"><img alt=\"Qikres\" src=\""+imgpath+"qikres-loader.gif\" /><br/><span id=\"progressbar\" style=\"display: block; text-align:center; line-height:20px;font-weight:bold; color:#666\"><span style=\"font-size:24px;letter-spacing:3px;color:#333\">QikRes</span><br/>Web Booking Engine</span><span id=\"rto\" style=\"display: none; font-family: Tahoma, verdana, arial; font-size: 12px; line-height: 20px\"><br/>Connection to server is slow.<br/>Please check your internet connection or<br/><a href='#' onclick='Qikinn.doTimeout()'>click here to refresh</a></span></td></tr></table>");
		if (typeof doCheck === 'undefined') continueAvailabilityCheck();
	}
	
	var iframing = function(w,h){
		if(typeof h === 'undefined'){
			return;
		}

		jQuery("#qik_frame").css({
			"height" 	: parseInt(h, 10) + "px",
			"width" 	: parseInt(w, 10) + "px"
		});
	}
	
	var goToCenter = function(){
/*		lastPos = jQuery(window).scrollTop();
		var qikFrame = jQuery("#qik_frame");
		var iframeTop = qikFrame.offset().top;
		var qikFrameH = qikFrame.height();
		var winH = jQuery(window).height();
		var gotoPopup = iframeTop + ((qikFrameH - winH) / 2);
		jQuery("html, body").animate({scrollTop : gotoPopup}); */
		
	    var top = ($(window).height() / 2) - ($(".fancybox-wrap").outerHeight() / 2);
	    var left = ($(window).width() / 2) - ($(".fancybox-wrap").outerWidth() / 2);
	    $(".fancybox-wrap").css({ top: top, left: left});
		return false;
	}
	
	var backToPosition = function(pos){
		jQuery("html, body").animate({ scrollTop : (parseInt(pos) != 0) ? jQuery("#qik_frame").offset().top + parseInt(pos) : lastPos });
	}
	
	var getParentInfo = function() {
		//XD.postMessage({"type":"embedded", "parentScrollTop":jQuery(this).scrollTop(), "windowHeight":jQuery(window).height(), "windowWidth":jQuery(window).width(), "iframeTop":jQuery("#qik_frame").position().top, "iframeLeft":jQuery("#qik_frame").position().left, "footerHeight":jQuery("#footer").height(), "bodyPaddingBottom" : jQuery("#body").css("padding-bottom")},url, jQuery("#qik_frame")[0].contentWindow);
		XD.postMessage({"type":"embedded", "parentScrollTop":jQuery(this).scrollTop(), "windowHeight":jQuery(window).height(), "windowWidth":jQuery(window).width(),"iframeWidth":jQuery("#qik_frame").width(), "iframeTop":jQuery("#qik_frame").offset().top, "iframeLeft":jQuery("#qik_frame").offset().left, "footerHeight":jQuery("#footer").height(), "bodyPaddingBottom" : jQuery("#body").css("padding-bottom")},url, jQuery("#qik_frame")[0].contentWindow);
	}
	
	var qikFrameSize = function() {
		XD.postMessage({"type":"embedded", "qikFrameW":jQuery("#qik_frame").width(), "qikFrameH":jQuery("#qik_frame").height()},url, jQuery("#qik_frame")[0].contentWindow);
	}
	
	var maxFrameSize = function() {
		var initFrameWidth = jQuery("#qik_frame").width();
		var initFrameHeight = jQuery("#qik_frame").height(); 
		var initFrameTop = jQuery("#qik_frame").position().top;
		var initFrameLeft = jQuery("#qik_frame").position().left;
		
		jQuery("body").addClass("hideOverflow");
		jQuery(".top-menu,#login-menu,#footer").addClass("hide");
		jQuery("#main-web-content").addClass("forceTopLeft").removeClass('full-page');
		iframing(jQuery(window).width(), jQuery(window).height());
		XD.postMessage({"type":"embedded", "windowW":jQuery(window).width(), "windowH":jQuery(window).height()},url, jQuery("#qik_frame")[0].contentWindow);
	}
	
	var minFrameSize = function(frameW, frameH) {
		jQuery("body").removeClass("hideOverflow");
		jQuery(".top-menu,#login-menu,#footer").removeClass("hide");
		jQuery("#main-web-content").removeClass("forceTopLeft").addClass('full-page');
	}
	
	var afterNavigate = function(){
		jQuery("html, body").animate({ scrollTop : 0 });
	}
		
	receiveMessage(function(message, intervalid){
		frameMsg = message.data;
		if ((typeof message.data) == 'string') {
			var msg = message.data;
			try {
				frameMsg = JSON.parse(msg);
			} catch (e) {
				if (console)
					console.debug('receiveMessage fail JSON parsing ' + msg);
			}
		}
		if (parseInt(frameMsg.height)) jQuery("#qikinn_loader").remove();
		if (frameMsg.type == "callFunction") eval(frameMsg.functionName);
		if (frameMsg.result == "false"){
			iframing(frameMsg.width , frameMsg.height);
			if (property.window == "popup") {
				jQuery("#popupbody").css("height",frameMsg.height + "px");
				Drag.init(document.getElementById("popupHeader"), document.getElementById("qikinnWindow"), 0, jQuery(window).width() - jQuery("#qikinnWindow").width() ,0,jQuery(window).height() - jQuery("#qikinnWindow").height());
			}else{
				jQuery("#"+property.embeddedContainer).css("margin","auto");	
			}
		}else{
			if (property.window == "embedded") {
				iframing(jQuery("#"+property.embeddedContainer).width() , frameMsg.height);
			}else{				
				if (!property.popupFullScreen){
					iframing(1000,property.popupHeight);
				}else{
					//jQuery("#qikinnWindow").css("width",jQuery(window).width()-20 + "px");
					iframing(jQuery(window).width() , frameMsg.height);
				}
			}
		}
	}, domain);
	
	var maximize = function(){ 
		var intv = setInterval(function(){
			var _intv = intv;
			if (jQuery("#qikinnWindow").width() > 300){
				clearInterval(_intv);
				Qikres.reposition(); 	
			}
		},50)
	}		
	
	var locationSetup = function(){
		var qikresjs = document.getElementById("qikresjs");
		if(qikresjs.src !== undefined && qikresjs.src.toLowerCase().indexOf("qikres.js") > -1){
			var theanchor = document.createElement("a");
			theanchor.href = qikresjs.src;
			theanchor.setAttribute("href", qikresjs.src);
			
			var _hostname = theanchor.hostname;
			var _protocol = theanchor.protocol;
			var _port =  theanchor.port;
			
			if (_hostname === '') {
				// fix for IE
				_protocol = theanchor.href.split(':')[0];
				var pathArray = theanchor.href.split( '/' );
				_hostname = pathArray[2];
				fldr = "/" + pathArray[3] + "/";
				domain = _protocol + "://" + _hostname;
			} else {
				port = getPortNumber(_port);
				domain = _protocol + "//" + _hostname + port;
				path = theanchor.pathname.split("/");
				fldr="";
				var start = 1;
				if (path[0] !== '')
					start = 0;
				for (var pos = start; pos <= path.length-3; pos++){
					fldr += "/" + path[pos];
				}
			}
			//url = domain + fldr + "/jsp/frameLayout.jsp";
			url = domain + fldr + "/booking/simpleWebAction.action";
			jspath = domain + fldr + "/js/";
			csspath = domain + fldr + "/css/";
			imgpath = domain + fldr + "/images/";

		} else {
			alert("incomplete setup. Please supply with the correct qikres.js source path");
		}
	}
	
	var getPortNumber = function(port) {
		// 0 for safari
		if (port === undefined || port === '80' || port === '443' || port  === '0' || port === '') {
			return "";
		} else {
			return ":" + port;
		}
	}
	
	var getOriginalURL = function(url, param) {
		var idx = url.indexOf(param);
		if (idx >=0) {
			var paramValue = Qikres.getQueryString(param);
			return s.replace(param + '='+paramValue,'');
		} else {
			return url;
		}
	}
	
	var hadLoadQikRes = function() {
		var loaded = 0;
		if(typeof(Storage)!=="undefined") {
			if(sessionStorage.loadQikRes == null || sessionStorage.loadQikRes == "undefined") {
				sessionStorage.loadQikRes = 1;
			} else {
				loaded = sessionStorage.loadQikRes;
			}
		}
		return loaded;
	}
	
	var jQueryCheck = function(){
		locationSetup();
		var rand = new Date();
		randomize = 'tid=' + rand.getHours() + "" +rand.getMinutes() + "" +rand.getSeconds();
		loadScript(domain + fldr + "/js/xd.js", "xd", "js");
		loadScript(domain + fldr + "/js/qikres-ui.js", "qikres-ui", "js", function(){
			if (typeof jQuery == "undefined" || typeof jQuery === "undefined" || typeof jQuery == undefined || typeof jQuery === undefined) {
				loadScript(domain + fldr + "/js/jquery-1.7.2.min.js", "jqcore", "js", function(){
					if (jQuery.ui === undefined) {
						loadScript(domain + fldr + "/js/jquery-ui-1.8.21.custom.min.js", "jqui", "js", function(){	
							loadScript(csspath + "qikinn.css?"+randomize, "qikinncss", "css", function(){
								loadLoader();
							});
						});
					}else{
						loadScript(csspath + "qikinn.css?"+randomize, "qikinn.css", "css", function(){
							loadLoader();	
						});
					}
				})
			}else{
				//locationSetup();		
				if (jQuery.ui === undefined) {
					loadScript(domain + fldr + "/js/jquery-ui-1.8.21.custom.min.js", "jqui", "js", function(){
						loadScript(csspath + "qikinn.css?"+randomize, "qikinncss", "css", function(){
							loadLoader();
						});	
					});
				}else{
					loadScript(csspath + "qikinn.css?"+randomize, "qikinncss", "css", function(){
						loadLoader();	
					});	
				}
			}
		});
		
		
	}
	
	var continueAvailabilityCheck = function(){
		
		var requireRedirect = Qikres.getQueryString('requireRedirect');
		if (requireRedirect == 'true') {
			forwardFromPaymentGateway()
		} else {
		
	        if (navigator.userAgent.indexOf('Safari') != -1      
	            && navigator.userAgent.indexOf('Chrome') == -1 ){
	                var n = Qikres.getQueryString('fromQikRes');
	                var requestProp = sessionStorage.getItem('requestProp');
	                if(requestProp == null || requestProp == "")
						return;
					
					var properties = JSON.parse(requestProp);
					sessionStorage.removeItem('requestProp');
					Qikres.render(properties);
	        }
		}

       
    }
	
	var forwardFromPaymentGateway = function(){
		var payment = Qikres.getQueryString('payment');
		var prefix = "?"; 
		if (typeof payment != 'undefined' && payment != 'null' ) {
			if (payment.indexOf('?') >= 0)
				prefix = "&";
			
			var local_properties = sessionStorage.getItem('qikres_requestProp');
			var properties = JSON.parse(local_properties);
			
			var paymentRefNo = Qikres.getQueryString('paymentRefNo');
			sessionStorage.setItem(paymentRefNo, '1');
			
			Qikres.render({
				customerID: properties.customerID,
				propertyCode: '',
				checkInDate: 'null',
				checkOutDate: 'null',
				adult: 'null',
				children: 'null',
				module: 'CONFIRM_VIEW',
				window: properties.window, // embedded | popup
				embeddedContainer: properties.embeddedContainer, // defined if embedded
				jsessionId: sessionStorage.payment_jsession,
				style: properties.style,
				actionPath: payment	+ prefix + "fromQikRes=true"
			}, function() {
				sessionStorage.removeItem('qikres_paymentRedirect');
			});
		}
	}
	
	jQueryCheck();
	var trimString = function (pStr){
		try{
			return pStr.toString().replace(/^\s+|\s+$/g, "");
		}catch(x){ return false; }
	}
	
	var filledValues = ["property","checkInDate", "checkOutDate", "adult", "children", "customerID"];
	var modules =  ['SEARCH', 'RESV', 'WBE', 'REVIEW','PROMOTION','PROPSEARCH','CUSTOMFOLDER', 'CONFIRM_VIEW'];
	
	return {
		doTimeout: function(){
			rto = 10000;
			jQuery("#progressbar").css("display", "block");
			jQuery("#rto").css("display", "none");
			loaded = false;
			var intid = setInterval(function (){
				if (loaded) {
					clearInterval(intid);
				}else{
					jQuery("#progressbar").css("display", "none");
					jQuery("#rto").css("display", "block");
					loaded = false;
					clearInterval(intid);
				}
			}, rto);
			/*iframe.removeAttr("src");
			iframe.attr("src", source);
			iframe.load(function(){
				if (this.cb) callback();
				loaded = true;
				clearInterval(intid);
			})*/
		},
		
		reposition: function(){
			if (property.popupFullScreen) {
				jQuery("#qikinnWindow").css({
					"left"		: 0,
					"top"		: 0
				});
			} else {
				var center = jQuery(window).height()/2 - ((property.popupHeight)  / 2);
				var myTop = center < 0 ? 0 : center;
				
				jQuery("#qikinnWindow").css({
					"left"		: jQuery(window).width()/2 - (jQuery("#qikinnWindow").width()/2),
					"top"		: myTop
				});
				if (property.popupDraggable){
					Drag.init(document.getElementById("popupHeader"), document.getElementById("qikinnWindow"), 0, jQuery(window).width() - jQuery("#qikinnWindow").width() ,0,jQuery(window).height() - jQuery("#qikinnWindow").height());
				}
			}
		},
		
		closeWindow: function(){
			try{
				jQuery(blocker).remove();
				if (property.popupFullScreen) {
					jQuery("body,html").css("overflow","auto");
				}
			} catch(e){}
			jQuery(thePopupWindow).remove();
		},
		
		listPromotions: function( properties, callback ){
			if( typeof properties != "undefined" && properties != null )
			{
				if( typeof properties.module == "undefined" || properties.module == null )
				{
					properties.module = "PROMOTION";
				}
			}
			
			this.render( properties, callback );
		},
		
		render : function(properties, callback){
			loadLoader(false);
			if(properties == null || properties == "undefined")
				return;
			
			if(properties.external == 1) {	
				var requireSafariFix = Qikres.fixForSafari({
					checkInDate: properties.checkInDate,
					checkOutDate: properties.checkOutDate,
					requestProp: properties,
					url:domain + fldr+"/jsp/safarifix_loading.jsp"
				});

				if(requireSafariFix ==1)
					return 1;
			}
            
			var requireRedirect = Qikres.getQueryString('requireRedirect');
			var paymentRefNo = Qikres.getQueryString('paymentRefNo');
			if (requireRedirect == 'true') {
				var paymentRefHadRedirected = sessionStorage.getItem(paymentRefNo);
				if(paymentRefHadRedirected != '1') {
					sessionStorage.setItem(paymentRefNo, '1');
					return forwardFromPaymentGateway;
				}
			}
			
			var defaultStyle = domain + fldr + "/themes/"+properties.customerID + "/css/qikres.css";
			var defaultProperties = {
				window					: (!properties.window) ? "popup" : properties.window.toLowerCase(), // embedded | popup
				popupHeight				: (!properties.popupHeight) ? 500 : properties.popupHeight,
				popupBorder				: (!properties.popupBorder) ? "5px solid #3D4856" : properties.popupBorder,
				popupFooterBgColor		: (!properties.popupFooterBgColor) ? "#3D4856" : properties.popupFooterBgColor,
				popupDraggable			: (properties.popupDraggable) ? true : properties.popupDraggable,
				popupHeaderColorType	: (!properties.popupHeaderColorType) ? "gradient" : properties.popupHeaderColorType,
				popupHeaderColorStart	: (!properties.popupHeaderColorStart) ? "#BCE0DE" : properties.popupHeaderColorStart,
				popupHeaderColorEnd		: (!properties.popupHeaderColorEnd) ? "#3D4856" : properties.popupHeaderColorEnd,
				popupTitle				: (!properties.popupTitle) ? "Web Booking Engine" : properties.popupTitle,
				popupBlock				: (properties.popupBlock) ? true : properties.popupBlock,
				popupTitleColor			: (!properties.popupTitleColor) ? "#FFF" : properties.popupTitleColor,
				popupTitleFontType		: (!properties.popupTitleFontType) ? "Tahoma, verdana, arial" : properties.popupTitleFontType,
				popupTitleFontSize		: (!properties.popupTitleFontSize) ? "12px" : properties.popupTitleFontSize,
				popupTitleFontBold		: (properties.popupTitleFontBold) ? true : properties.popupTitleFontBold,
				popupFullScreen			: (!properties.popupFullScreen) ? false : properties.popupFullScreen,
				timeout					: (!properties.timeout) ? 60 : properties.timeout,
				actionPath 				: (!properties.actionPath) ? '/sellOption/listOption.action' : properties.actionPath,
				style					: (!properties.style) ? '' : properties.style,
				embeddedContainer		: (!properties.embeddedContainer) ? 'left' : properties.embeddedContainer,
				customerID				: properties.customerID,
				checkInDate				: properties.checkInDate,
				checkOutDate			: properties.checkOutDate,
				adult					: (!properties.adult) ? 1 : properties.adult,
				children				: (!properties.children) ? 0 : properties.children,
				propertyCode			: encodeURIComponent(properties.propertyCode),
				productCode				: ( typeof properties.productCode == "undefined" )? null : encodeURIComponent(properties.productCode),
				hostAddress				: (!properties.hostAddress) ? window.location.href : properties.hostAddress,
				module					: (typeof properties.module != 'undefined') ? trimString(properties.module) : 'WBE',  // could be WBE, RESV, SEARCH
				reviewPhone				: properties.reviewPhone,
				reviewConfNumber		: properties.reviewConfNumber,
				reviewEmail				: properties.reviewEmail,
				reviewLastName			: encodeURIComponent(properties.reviewLastName),
				reviewFirstName			: encodeURIComponent(properties.reviewFirstName),
				printStyle				: properties.printStyle,
				jsessionId				: properties.jsessionId,
				hideHeader				: ( !properties.hideHeader )? false : properties.hideHeader,
				propertyQuery           : properties.propertyQuery,
				lat						: properties.lat,
				lng						: properties.lng,
				link					: properties.url
			}
			
			if (properties.module == 'SEARCH' || properties.module == 'RESV') {
				if (properties.propertyCode == undefined || properties.customerID == undefined) {
					alert("Please fill all the mandatory parameters");
					return false;	
				}
			} else if (properties.module == 'PROPSEARCH') {
				if (properties.propertyQuery == undefined || properties.propertyQuery == '') {
					alert("Invalid property query");
					return false;
				}
			}
			
			if (properties.module && jQuery.inArray(properties.module, modules) < 0) {
				alert("Invalid module value. The valid values are SEARCH, RESV, WBE, REVIEW, PROMOTION, PROPSEARCH, CUSTOMFOLDER");
				return false;
			}
			
			if( properties.module != "PROMOTION" )
			{
				if ((properties.checkInDate == undefined || 
					properties.checkOutDate == undefined || 
					properties.adult == undefined || 
					properties.children == undefined || 
					properties.propertyCode == undefined ||
					properties.customerID == undefined) && properties.module == 'WBE'){
					alert("Please fill all the mandatory parameters");
					return false;
				}
				
				for (param in properties){
					if (jQuery.inArray(param, filledValues) >= 0 && trimString(properties[param]) == ""){
						alert("Fill in your booking search");
						return false;
					}
					if (trimString(properties[param]) == "" || properties["popupHeight"] <= 0){
						properties[param] = defaultProperties[param];
					}
				}
			}
			
			if (properties.window == "embedded" && properties.embeddedContainer == undefined) {
				alert("embeddedContainer is required");
				return false;
			}
			
			property = properties;
			if (defaultProperties.window == "embedded" ){
//create inline css class for popup window header
				var hideHeaderStyle = '';
				if( defaultProperties.hideHeader == true )
				{
					hideHeaderStyle = 'display:none';
				}
				var thePopupHeader = jQuery("<div id=\"qikin-header\" class=\"qikin-link-header\" style=\"width:100%; float:left\"><a style=\"float:right;" + hideHeaderStyle + "\" id=\"qikinn-link\" href=\"http://www.qikinn.com\" target=\"_blank\"><img id=\"qikinn-footer\" border=\"0\" src=\""+imgpath+"qikres-wbe.png\"/></a></div>");
				var embedded = jQuery("#"+properties.embeddedContainer);
				embedded.empty();
				property.popupFullScreen = false;
				createIframe(defaultProperties, callback);
				//embedded.prepend(thePopupHeader);
				
			} else if (defaultProperties.window == "popup"){
//create inline css style for popup window
				if (property.popupHeight == undefined) {
					property.popupHeight = defaultProperties.popupHeight
				}
				if (property.popupFullScreen === undefined) {
					property.popupFullScreen = false;
				}
				jQuery(blocker).remove();
				jQuery(thePopupWindow).remove();
				var popupWindow = {
					"width"					: "300"
				}
				thePopupWindow = jQuery("<div class=\"popupWindow\" id=\"qikinnWindow\"></div>");
					thePopupWindow.css(popupWindow);
					
				var cursor = (defaultProperties.popupDraggable) ? "move" : "normal";
//create inline css class for popup window header
				var popupHeader = {
					"cursor"							: cursor,
					"border-left"						: defaultProperties.popupBorder,
					"border-right"						: defaultProperties.popupBorder,
					"border-top"						: defaultProperties.popupBorder,
					"padding"							: 5,
					"color"								: defaultProperties.popupTitleColor,
					"font-family"						: defaultProperties.popupTitleFontType,
					"font-size"							: defaultProperties.popupTitleFontSize,
					"font-weight"						: (defaultProperties.popupTitleFontBold) ? "bold" : "normal"
				}
//append new param attr for bgcolor	
				if (defaultProperties.popupHeaderColorType == undefined || defaultProperties.popupHeaderColorType == "solid"){
					popupHeader["background-color"] = defaultProperties.popupFooterBgColor;
				}else{
					popupHeader["background"] = "-o-linear-gradient(top,"+defaultProperties.popupHeaderColorStart+", "+defaultProperties.popupHeaderColorEnd+")";
					popupHeader["background"] = "-webkit-gradient(linear, 0% 0%, 0% 100%, from("+defaultProperties.popupHeaderColorStart+"), to("+defaultProperties.popupHeaderColorEnd+"))";
					popupHeader["background"] = "-webkit-linear-gradient(top, "+defaultProperties.popupHeaderColorStart+", "+defaultProperties.popupHeaderColorEnd+")";
					popupHeader["background"] = "-ms-linear-gradient(top, "+defaultProperties.popupHeaderColorStart+", "+defaultProperties.popupHeaderColorEnd+")";
					popupHeader["filter"] = "progid:DXImageTransform.Microsoft.gradient(startColorstr="+defaultProperties.popupHeaderColorStart+", endColorstr="+defaultProperties.popupHeaderColorEnd+")";
					popupHeader["background"] = "-moz-linear-gradient(top, "+defaultProperties.popupHeaderColorStart+", "+defaultProperties.popupHeaderColorEnd+")";
				}
				
				var thePopupCloseButton = jQuery("<div><a class=\"popupCloseButton\" title=\"Close\" onclick=\"Qikres.closeWindow()\" id=\"close\" \">X</a></div><div style=\"clear:both\"></div>");
				var thePopupHeader = jQuery("<div class=\"popupHeader\" id=\"popupHeader\"><div class=\"popupTextTitle\">" + defaultProperties.popupTitle + "</div></div>");
					thePopupHeader.append(thePopupCloseButton);
				
				var popupFooter = {
					"background-color"					: defaultProperties.popupFooterBgColor, 	
					"border-left"						: defaultProperties.popupBorder,
					"border-right"						: defaultProperties.popupBorder,
					"border-bottom"						: defaultProperties.popupBorder
				}
				var thePopupFooter = jQuery("<div class=\"popupFooter\"><a id=\"qikinn-link\" href=\"http://www.qikinn.com\" target=\"_blank\"><img id=\"qikinn-footer\" border=\"0\" src=\""+imgpath+"qikres-wbe.png\"/></a></div>");
				
				var popupBody = {
					"height"		: (property.popupFullScreen ? (jQuery(window).height() - 88): defaultProperties.popupHeight) + "px",
					"border-left"	: defaultProperties.popupBorder,
					"border-right"	: defaultProperties.popupBorder
				}
				var thePopupBody = jQuery("<div id=\"popupbody\" class=\"popupBody\"></div>");
					thePopupHeader.css(popupHeader);
					thePopupFooter.css(popupFooter);
					thePopupBody.css(popupBody);
					thePopupWindow.append(thePopupHeader);
					thePopupWindow.append(thePopupBody);
					thePopupWindow.append(thePopupFooter);

				var popupBlocker = {
					"left"		: "0px",
					"position"	: "fixed",
					"top"		: "0px"
				}
				if (defaultProperties.popupBlock){
					blocker = jQuery("<table id=\"blocker\" class=\"popBlocker\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" height=\"100%\" border=\"0\"><tr><td id=\"blockerContent\" align=\"center\" bgcolor=\""+defaultProperties.popupFooterBgColor+"\"></td></tr></table>");
					blocker.css(popupBlocker);
					jQuery("body").prepend(blocker);
				}
				
				jQuery("#qikinnWindow").remove();
				jQuery("body").append(thePopupWindow);
				Qikres.reposition();
				defaultProperties.embeddedContainer = "popupbody";
				createIframe(defaultProperties, callback);
				
			}
			sessionStorage.setItem('qikres_requestProp', JSON.stringify(properties));			
		},
		
		fixForSafari : function(properties) {
			var isSafari = false;
			if(hadLoadQikRes() == 0) {
				if (navigator.userAgent.indexOf('Safari') != -1 
				 && navigator.userAgent.indexOf('Chrome') == -1 )
				{
					url = properties.url+"?checkInDate="+properties.checkInDate+"&checkOutDate="+properties.checkOutDate;
					sessionStorage.setItem('requestProp', JSON.stringify(properties.requestProp));
					if(properties.adult != null) {
						url = url + "&adult="+properties.adult;
					}
					
					if(properties.children != null) {
						url = url + "&children="+properties.children;
					}

					if( properties.module == 'WBE' || typeof properties.module == 'undefined') {
						url = url + "&fromQikRes=1";
					} else if (properties.module == 'PROMOTION') {
						url = url + "&fromQikRes=2";
					} else {
						url = url + "&fromQikRes=" + properties.module;
					}
					location.href = url;
					isSafari = true;
				}
			}
			return isSafari;
		},
		
		getQueryString : function(name){
		   if(name=(new RegExp('[?&]'+encodeURIComponent(name)+'=([^&]*)')).exec(location.href))
			  return decodeURIComponent(name[1]);
		}
	}
	
	
})();