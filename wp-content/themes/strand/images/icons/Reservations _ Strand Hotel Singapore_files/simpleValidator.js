//This class create to simplified the validation process of the html input.
//It is inspire by the jqeury.validate.js and jquery.validationEngine.js
//as both of the validation plugin only work for form tag and doesn't for control outside the form therefore this plugin was create.

var Class = {
   create: function(div) {
     return function(div) {
       if (this.initialize) {
         this.initialize(div);
       }
     }
   }
 }  

var SimpleValidator = Class.create();

SimpleValidator.prototype = {
	initialize: function(div) {
		this.inputs = "#" + div+ " :input";
		this.errorList = [];
		this.showError = true;
		this.divName = div;
	},
	
	createObjectCallback: function(obj, fn)
	{
		return function() { fn.apply(obj, arguments); };
	},
	
	showMsgDialog : function(msg, type){
		var strHTML = "<ul>";
		for(i = 0; i < msg.length; i++)
		{
			strHTML += "<li>"+msg[i]+"</li>";
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
				buttons: { "Ok": function() { $(this).dialog("close"); }},			
			});
		$dialog.dialog('open');
	},
	
	validate : function() {
		this.errorList = [];
		var validateMethods = [];
		var applyMethodFunc = this.applyMethod;
		var inputMap = new Object();

		jQuery(this.inputs).filter(':visible').each(function() {
			
			if(inputMap[this.name] != null) return true;
			
			inputMap[this.name] = this;
			
			if(this.type != 'button' && this.type != 'hidden')
			{
				var visible = true;
				if(jQuery(this).parent().attr('tagName') == 'TD' 
					|| jQuery(this).parent().attr('tagName') == 'DIV'
					|| jQuery(this).parent().attr('tagName') == 'LABEL' )
				{
					visible = jQuery(this).is(':visible');
					/*jQuery(this).parents().each(function() {
						visible = jQuery(this).is(':visible');
						if(visible == false) {
							alert(jQuery(this).attr('tagName'))
							return false; //to break the each loop
						}
					});*/
					
				}
				if(visible)
				{
					var methods = applyMethodFunc(this);
					validateMethods.push({
						methods: methods,
						element: this
					});
				}
				
				
				/*
				if(visible && this.className == 'required' 
					&& (this.value == null || this.value == ''))
				{
					var str = this.title;
					if(str == null || str == '')  
						str = this.name + " is required";
					errors.push({
						message: str,
						element: this
					});
				}*/
			}
		});
		
		this.check(validateMethods);
		
				
		if(this.errorList.length > 0)
		{
			if(this.showError)
			{
				var message = [];
				$('div[id^="errorMsg_"] ' + this.divName).html("").hide();
				for ( var i = 0; this.errorList[i]; i++ ) {
					var error = this.errorList[i];
					if($('#errorMsg_'+error.element.id).length > 0) {
						$('#errorMsg_'+error.element.id).html("* "+error.message).show();
						$('#'+ error.element.id).on('blur', function() {
							$('#errorMsg_'+$(this).attr('id')).html('').hide();
						})
					}	
					else {
						//message[i] = error.message;
						message[message.length++] = error.message;
					}
				}
				//console.log("message length : " + message.length);
				if(message.length > 0) {
					this.showMsgDialog(message, 'error');
				}
			}
			return false;
		}
		return true;
	},
	
	check : function(validateMethods)
	{
		if(validateMethods.length > 0)
		{
			for ( var i = 0; i < validateMethods.length; i++ ) {
				var validateMethod = validateMethods[i];
				var element = validateMethod.element;
				if (validateMethod.methods.length == 0) continue;
				for(var x=0; x < validateMethod.methods.length;x++)
				{
					if ((typeof x) != 'number') break;
					var fn = eval("this."+validateMethod.methods[x]);
					if(fn.call(this, element.value, element) == false)
					{
						var str = element.title;
						if(str == null || str == '')
						{
							var name = element.name;
							try
							{
								name = name.replace(/List\[[0-9]*\]/, 'Data');
								// replace . to _
								name = name.replace(/\./g, '_');
								// handle those using map
								name = name.replace(/\[[0-9]*\]/, '');
								name = name.replace(/\[\'/g, '_');
								name = name.replace(/\'\]/g, '');
								name = name.replace(/[0-9]/, '');
								str = eval(name + "_"+validateMethod.methods[x]);
							}
							catch(e) 
							{
								str = element.name + " : "+this.messages[validateMethod.methods[x]];
							}								
						}
						this.errorList.push({
							message: str,
							element: element
						});
						//alert(element.name + " failed :" + validateMethod.methods[x]);
					}
				}
			}
		}
	},
	
	messages: {
		required: "This field is required.",
		remote: "Please fix this field.",
		email: "Please enter a valid email address.",
		url: "Please enter a valid URL.",
		date: "Please enter a valid date.",
		dateISO: "Please enter a valid date (ISO).",
		number: "Please enter a valid number.",
		digits: "Please enter only digits.",
		creditcard: "Please enter a valid credit card number.",
		equalTo: "Please enter the same value again.",
		accept: "Please enter a value with a valid extension."
		/*
		maxlength: this.format("Please enter no more than {0} characters."),
		minlength: this.format("Please enter at least {0} characters."),
		rangelength: this.format("Please enter a value between {0} and {1} characters long."),
		range: this.format("Please enter a value between {0} and {1}."),
		max: this.format("Please enter a value less than or equal to {0}."),
		min: this.format("Please enter a value greater than or equal to {0}.")*/
	},
	
	format : function(source, params) {
		if ( arguments.length == 1 ) 
			return function() {
				var args = jQuery.makeArray(arguments);
				args.unshift(source);
				return this.format.apply( this, args );
			};
		if ( arguments.length > 2 && params.constructor != Array  ) {
			params = jQuery.makeArray(arguments).slice(1);
		}
		if ( params.constructor != Array ) {
			params = [ params ];
		}
		jQuery.each(params, function(i, n) {
			source = source.replace(new RegExp("\\{" + i + "\\}", "g"), n);
		});
		return source;
	},


	depend: function(param, element) {
		return this.dependTypes[typeof param]
			? this.dependTypes[typeof param](param, element)
			: true;
	},

	dependTypes: {
		"boolean": function(param, element) {
			return param;
		},
		"string": function(param, element) {
			return !!jQuery(param, element.form).length;
		},
		"function": function(param, element) {
			return param(element);
		}
	},
	
	optional: function(element) {
		return !this.required.call(this, jQuery.trim(element.value), element) && "dependency-mismatch";
	},
		
	checkable: function( element ) {
		return /radio|checkbox/i.test(element.type);
	},
	
	findByName: function( name ) {
		// select by name and filter by form for performance over form.find("[name=...]")
		var form = this.currentForm;
		return jQuery(document.getElementsByName(name)).map(function(index, element) {
			return element.name == name && element  || null;
		});
	},
	
	getLength: function(value, element) {
		switch( element.nodeName.toLowerCase() ) {
		case 'select':
			return jQuery("option:selected", element).length;
		case 'input':
			if( this.checkable( element) )
				return this.findByName(element.name).filter(':checked').length;
		}
		return value.length;
	},
	// http://docs.jquery.com/Plugins/Validation/Methods/required
	required: function(value, element, param) {
		// check if dependency is met
		/*if ( !this.depend(param, element) )
			return "dependency-mismatch";*/
		switch( element.nodeName.toLowerCase() ) {
		case 'select':
			// could be an array for select-multiple or a string, both are fine this way
			var val = jQuery(element).val();
			return val && val.length > 0;
		case 'input':
			if ( this.checkable(element) ) {
				return this.getLength(value, element) > 0;
			}
		default:
			return jQuery.trim(value).length > 0;
		}
	},
		
	// http://docs.jquery.com/Plugins/Validation/Methods/email
	email: function(value, element) {
		// contributed by Scott Gonzalez: http://projects.scottsplayground.com/email_address_validation/
		return this.optional(element) || /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(value);
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/minlength
	minlength: function(value, element, param) {
		return this.optional(element) || this.getLength(jQuery.trim(value), element) >= param;
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/maxlength
	maxlength: function(value, element, param) {
		return this.optional(element) || this.getLength(jQuery.trim(value), element) <= param;
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/rangelength
	rangelength: function(value, element, param) {
		var length = this.getLength(jQuery.trim(value), element);
		return this.optional(element) || ( length >= param[0] && length <= param[1] );
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/min
	min: function( value, element, param ) {
		return this.optional(element) || value >= param;
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/max
	max: function( value, element, param ) {
		return this.optional(element) || value <= param;
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/range
	range: function( value, element, param ) {
		return this.optional(element) || ( value >= param[0] && value <= param[1] );
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/url
	url: function(value, element) {
		// contributed by Scott Gonzalez: http://projects.scottsplayground.com/iri/
		return this.optional(element) || /^(https?|ftp):\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?(((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?)(:\d*)?)(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)?(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(value);
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/date
	date: function(value, element) {
		var d = new Date();
		try {
			if (window.chrome)
				return true;
			else
				return this.optional(element) || !/Invalid|NaN/.test(new Date(d.toLocaleDateString(value)));
		} catch (e) {
			return this.optional(element) || !/Invalid|NaN/.test(new Date(value));
		}
	},

	// http://docs.jquery.com/Plugins/Validation/Methods/dateISO
	dateISO: function(value, element) {
		return this.optional(element) || /^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/.test(value);
	},

	// http://docs.jquery.com/Plugins/Validation/Methods/number
	number: function(value, element) {
		return this.optional(element) || /^-?(?:\d+|\d{1,3}(?:,\d{3})+)(?:\.\d+)?$/.test(value);
	},

	// http://docs.jquery.com/Plugins/Validation/Methods/digits
	digits: function(value, element) {
		return this.optional(element) || /^\d+$/.test(value);
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/creditcard
	// based on http://en.wikipedia.org/wiki/Luhn
	creditcard: function(value, element) {
		if ( this.optional(element) )
			return "dependency-mismatch";
		// accept only digits and dashes
		if (/[^0-9-]+/.test(value))
			return false;
		var nCheck = 0,
			nDigit = 0,
			bEven = false;

		value = value.replace(/\D/g, "");

		for (var n = value.length - 1; n >= 0; n--) {
			var cDigit = value.charAt(n);
			var nDigit = parseInt(cDigit, 10);
			if (bEven) {
				if ((nDigit *= 2) > 9)
					nDigit -= 9;
			}
			nCheck += nDigit;
			bEven = !bEven;
		}

		return (nCheck % 10) == 0;
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/accept
	accept: function(value, element, param) {
		param = typeof param == "string" ? param.replace(/,/g, '|') : "png|jpe?g|gif";
		return this.optional(element) || value.match(new RegExp(".(" + param + ")$", "i")); 
	},
	
	// http://docs.jquery.com/Plugins/Validation/Methods/equalTo
	equalTo: function(value, element, param) {
		// bind to the blur event of the target in order to revalidate whenever the target field is updated
		// TODO find a way to bind the event just once, avoiding the unbind-rebind overhead
		var target = jQuery(param).unbind(".validate-equalTo").bind("blur.validate-equalTo", function() {
			jQuery(element).valid();
		});
		return value == target.val();
	},
	
	classRuleSettings: {
		required: true,
		email: true,
		url: true,
		date: true,
		dateISO: true,
		dateDE: true,
		number: true,
		numberDE: true,
		digits: true,
		creditcard: true
	},
	
	applyMethod: function(element) {
		var methods = [];
		var classes = jQuery(element).attr('class');
		
		var classRuleSettings = {
			required: true,
			email: true,
			url: true,
			date: true,
			dateISO: true,
			dateDE: true,
			number: true,
			numberDE: true,
			digits: true,
			creditcard: true
		};
		
		classes && jQuery.each(classes.split(' '), function() {
			if (this in classRuleSettings) {
				methods.push(this);
			}
			
		});
		return methods;
	}
}

