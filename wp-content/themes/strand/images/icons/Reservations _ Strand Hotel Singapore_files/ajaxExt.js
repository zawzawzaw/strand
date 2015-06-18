var Class = {
	create : function() {
		return function() {
			if (this.initialize) {
				this.initialize();
			}
		}
	}
}
var AjaxExt = Class.create();
AjaxExt.prototype = {
	initialize : function(asynchronous) {
		this.asynchronous = asynchronous;
		$.ajaxSetup( { cache : false } );
	},

	createObjectCallback : function(obj, fn) {
		return function() {
			fn.apply(obj, arguments);
		};
	},

	progress : function(type) {
		if(type == 'start') {
			if(this.asynchronous == true) return;
			if ($.blockUI && $('.blockOverlay').length == 0) {
				if($('#qikinn_loader').length > 0) {
					$.blockUI({ message: $('#qikinn_loader') });
					XD.postMessage({"type" : "callFunction", "functionName" : "getParentInfo()"}, parent_url, parent);
				}
				else if($('#ajax_loader').length > 0) {
					$.blockUI({ message: $('#ajax_loader') });
				}
			}
		} else {
			if ($.unblockUI) {
				$.unblockUI();
			}
		}
	},

	getHeaderJSON : function(xhr) {
		var json;
		try {
			json = xhr.getResponseHeader('X-Json');
		} catch (e) {
			alert(e);
		}

		if (json) {
			var data = eval('(' + json + ')'); // or JSON.parse or
			// whatever you like
			return data;
		}
	},

	showMsgDialog : function(msg, type, onErrorResponse) {
		var isFromIframe = false;
		if ( window.self !== window.top ) isFromIframe = true;
		if (isFromIframe) XD.postMessage({"type" : "callFunction", "functionName" : "goToCenter()"});
		var strHTML = "<ul>";
		for (i = 0; i < msg.length; i++) {
			strHTML += "<li style='color:red;list-style:none!important'>" + msg[i] + "</li>";
		}
		strHTML += "</ul>";

		var $dialog = jQuery('<div style="color:red;list-style:none!important"></div>').html(strHTML).dialog({
//			dialogClass : type,
			autoOpen : false,
			modal : true,
			title : type,
			buttons : {
				"Ok" : function() {
					jQuery(this).dialog("close");
					if (onErrorResponse) {
						onErrorResponse();
					}
				}
			},
			open: function(){
				$(this).parents(".ui-dialog:first").find(".ui-widget-header").removeClass("ui-widget-header").addClass("error");
				$(".ui-dialog").children(".ui-dialog-buttonpane").removeClass("ui-widget-content");
			},
			
			close: function(){
				if (isFromIframe) XD.postMessage({"type" : "callFunction", "functionName" : "backToPosition(0)"}, parent_url, parent);
			}
		});
		$dialog.dialog('open').parent().addClass("ui-state-error");
	},

	showError : function(json, onErrorResponse) {
		if (json) {
			if (json.ERROR) {
				this.showMsgDialog(json.ERROR, "Error", onErrorResponse);
			}
			if (json.INFOR) {
				this.showMsgDialog(json.INFOR, "Info", onErrorResponse);
			} else if (json.TIMEOUT) {
				// window.location.reload(true);
				window.location.href = json.TIMEOUT;
			}
		}
	},

	request : function(url, sendMethod, onSuccessFunc, updateDiv, data, onErrorResponse) {	
		jQuery.ajax({
			url : url,
			type : sendMethod,
			data : data,
			dataType : "html",
			beforeSend : this.createObjectCallback(this, function() {
				this.progress('start');
			}),
			success : this.createObjectCallback(this,function(data, textStatus, XMLHttpRequest) {
				this.progress('stop');
				if (updateDiv != '' && updateDiv != null)
					jQuery(updateDiv).html(data);
				if (onSuccessFunc) {
					onSuccessFunc(data, textStatus, XMLHttpRequest);
				}
			}),
			complete : this.createObjectCallback(this, function(xhr) {
				this.progress('stop');
				var data = this.getHeaderJSON(xhr);
				// jQuery(updateDiv).html(xhr.responseText);
				this.showError(data, onErrorResponse);
			})
		});
	},
	
	requestSync : function(url, sendMethod, onSuccessFunc, updateDiv, data, onErrorResponse) {	
		jQuery.ajax({
			url : url,
			type : sendMethod,
			async : false, 
			data : data,
			dataType : "html",
			beforeSend : this.createObjectCallback(this, function() {
				this.progress('start');
			}),
			success : this.createObjectCallback(this,function(data, textStatus, XMLHttpRequest) {
				this.progress('stop');
				if (updateDiv != '' && updateDiv != null)
					jQuery(updateDiv).html(data);
				if (onSuccessFunc) {
					onSuccessFunc(data, textStatus, XMLHttpRequest);
				}
			}),
			complete : this.createObjectCallback(this, function(xhr) {
				this.progress('stop');
				var data = this.getHeaderJSON(xhr);
				// jQuery(updateDiv).html(xhr.responseText);
				this.showError(data, onErrorResponse);
			})
		});
	},
	
	formSubmit : function(formName, updateDiv, onSuccessFunc, onErrorResponse) {
		
		var url = $(formName).attr("action");
		var xhr = $.ajax({
		  url: url,
		  type : "POST",
		  data : $(formName).serialize(), 
		  beforeSend : this.createObjectCallback(this,
				function() {
					this.progress('start');
				}),
		  success: this.createObjectCallback(this,function(data, textStatus, XMLHttpRequest) {					
					this.progress('stop');
					if(updateDiv != '' && updateDiv != null)
						$(updateDiv).html(data);
					if(onSuccessFunc) {
						onSuccessFunc(data, textStatus, XMLHttpRequest);
					}
				}),
			complete: this.createObjectCallback(this,
				function(xhr) {
					this.progress('stop');
					var data = this.getHeaderJSON(xhr);
					//$(updateDiv).html(xhr.responseText);
					this.showError(data, onErrorResponse);
				}
			)
		});
	},
	
	multiFormSubmit : function(formName, updateDiv, onSuccessFunc, onErrorResponse, multiForm) {
		
		var url = $(formName).attr("action");
		var xhr = $.ajax({
		  url: url,
		  type : "POST",
		  data : $(multiForm).serialize(), 
		  beforeSend : this.createObjectCallback(this,
				function() {
					this.progress('start');
				}),
		  success: this.createObjectCallback(this,function(data, textStatus, XMLHttpRequest) {					
					this.progress('stop');
					if(updateDiv != '' && updateDiv != null)
						$(updateDiv).html(data);
					if(onSuccessFunc) {
						onSuccessFunc(data, textStatus, XMLHttpRequest);
					}
				}),
			complete: this.createObjectCallback(this,
				function(xhr) {
					this.progress('stop');
					var data = this.getHeaderJSON(xhr);
					//$(updateDiv).html(xhr.responseText);
					this.showError(data, onErrorResponse);
				}
			)
		});
		
	},
	
	requestNoBlock : function(url, sendMethod, onSuccessFunc, updateDiv, data,
			onErrorResponse) {	
		jQuery.ajax({
			url : url,
			type : sendMethod,
			data : data,
			dataType : "html",
			success : function(data, textStatus, XMLHttpRequest) {
				if (updateDiv != '' && updateDiv != null)
					jQuery(updateDiv).html(data);
				if (onSuccessFunc) {
					onSuccessFunc(data, textStatus, XMLHttpRequest);
				}
			},
			complete : this.createObjectCallback(this, function(xhr) {
				var data = this.getHeaderJSON(xhr);
				// jQuery(updateDiv).html(xhr.responseText);
				this.showError(data, onErrorResponse);
			})
		});
	},
};