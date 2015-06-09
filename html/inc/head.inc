<!-- Mobile Viewport -->
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<!-- Force IE to render best possible view -->
<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<!-- FONT -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
<script src="//use.typekit.net/fwh2axv.js"></script>
<script>try{Typekit.load();}catch(e){}</script>

<!-- CSS -->
<link rel="stylesheet" href="css/vendors/bootstrap/bootstrap.min.css" />
<link rel="stylesheet" href="css/vendors/bootstrap/bootstrap-theme.min.css" />
<link rel="stylesheet" href="css/vendors/jquery-ui/jquery-ui.min.css" />
<link rel="stylesheet" href="css/font-awesome.min.css" />
<link rel="stylesheet" href="css/animate.css" />
<link rel="stylesheet" href="css/style.css" />

<!-- JS -->
<script type="text/javascript" src="js/vendors/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/vendors/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/vendors/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins/imagesloaded.pkgd.min.js"></script>
<script type="text/javascript" src="js/plugins/masonry.pkgd.min.js"></script>
<script type="text/javascript" src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&libraries=places"></script>
<script type="text/javascript" src="js/plugins/infobox.js"></script>

<script id="qikresjs" src="http://210.1.224.42/wbe/js/qikres.js" type="text/javascript"></script> 
<script type="text/javascript" src="js/xd.js"></script>

<script>
	/////////
    /////////
    /////////

    var test = true;
    function checkAvailability(module) {

        var checkInDateArr = jQuery( "#checkInDate" ).val().split('/');
        var formatted_checkInDate = checkInDateArr[2] + '-' + checkInDateArr[1] + '-' + checkInDateArr[0];

        var checkOutDateArr = jQuery( "#checkOutDate" ).val().split('/');
        var formatted_checkOutDate = checkOutDateArr[2] + '-' + checkOutDateArr[1] + '-' + checkOutDateArr[0];

        // console.log(formatted_checkInDate)
        // console.log(formatted_checkOutDate)

        // return false;
        
        var requireSafariFix = Qikres.fixForSafari({
            checkInDate: formatted_checkInDate,
            checkOutDate: formatted_checkOutDate,
            url:"http://210.1.224.42/wbe/jsp/safarifix_loading.jsp"
        }); 
        
        if(requireSafariFix ==1)
            return;
            
        Qikres.render({
            propertyCode: 'BHS',
            checkInDate: formatted_checkInDate,
            checkOutDate: formatted_checkOutDate,
            adult: jQuery( "#adults" ).val(),
            children: jQuery( "#children" ).val(),
            customerID: '0064152669',   
            window: 'embedded', // embedded | popup
            embeddedContainer: "templatemo_content", // defined if embedded,
            // style: "http://192.168.0.88:8080/wbe/crossroads.css",
            // printStyle: 'http://192.168.0.201/hoteldemo/crossroads/css/print.css',
            popupDraggable : true,
            module : module,
            external : 1,
            popupFullScreen : true,
        });

        $('#templatemo_content').prepend('<span class="close">Close X</span>');
        
        $('#content_left').hide();

        $(document).on('click', '.close', function(){
        	console.log('closing');
        	$(this).parent().html('');
        });
    };

    function showPromotion() {
        
        Qikres.listPromotions({
            propertyCode: 'BHS',
            checkInDate: jQuery( "#checkInDate" ).val(),
            checkOutDate: jQuery( "#checkOutDate" ).val(),
            adult: jQuery('#adults').val(),
            children: jQuery('#children').val(),
            customerID: '0064152669',   
            window: 'embedded', // embedded | popup
            embeddedContainer: "templatemo_content", // defined if embedded,
            //style: "http://192.168.0.88:8080/wbe/crossroads.css",
            //printStyle: 'http://192.168.0.201/hoteldemo/crossroads/css/print.css',
            popupDraggable : true,
            popupFullScreen : true
        });
        $('#content_left').hide();
    };

    function reviewResv() {
        Qikres.render({
            propertyCode: 'BHS',
            checkInDate: jQuery( "#checkInDate" ).val(),
            checkOutDate: jQuery( "#checkOutDate" ).val(),
            adult: jQuery('#adults').val(),
            children: jQuery('#children').val(),
            title: "Web Booking Engine",
            window: "embedded", // embedded | popup
            embeddedContainer: "templatemo_content", // defined if embedded
            height: 500,
            customerID: '0064152669',   
            reviewConfNumber : '89ef81e885',
            reviewLastName : 'Mah',
            reviewFirstName : 'Jason',
            reviewEmail : 'jason@mah.com',
            reviewPhone : '234324234',
            module : 'REVIEW',
            popupDraggable : true,
            popupFullScreen: true
        });
    };

    var firsSetCookie = 0;
    function setCookie() {
        if (navigator.userAgent.indexOf('Safari') != -1 
         && navigator.userAgent.indexOf('Chrome') == -1 )
        {
            var w = window.open('http://192.168.0.88:8080/wbe/jsp/safarifix.jsp','','width=2,height=1');
            firsSetCookie = 1; 
            //setTimeout( function(){w.close()},1000 );
        }
    }

    function proceedCheckAvail() {
        if (navigator.userAgent.indexOf('Safari') != -1 
         && navigator.userAgent.indexOf('Chrome') == -1 ) 
        {
            var n = Qikres.getQueryString('fromQikRes');
            var checkInDate = Qikres.getQueryString('checkInDate');
            var checkOutDate = Qikres.getQueryString('checkOutDate');
            if(checkInDate != null)
                jQuery( "#checkInDate" ).val(checkInDate);
            if(checkOutDate != null)
                jQuery( "#checkOutDate" ).val(checkOutDate);
                
            var adult = Qikres.getQueryString('adult');
            var children = Qikres.getQueryString('children');
            
            if(adult != null)
                jQuery( "#adult" ).val(adult);
            if(children != null)
                jQuery( "#children" ).val(children);
                
            if(n == 1) {
                checkAvailability();
                
            }
        }
    }
        


    var parent_url = decodeURIComponent(document.location.hash.replace(/^#/, ''));
    function send() {
        console.log("send from index.html");
        XD.postMessage(jQuery("#templatemo_content").height() + ";" + jQuery("#templatemo_content").width() , parent_url, parent);
        return false;
    }
        
    var parent_url = decodeURIComponent(document.location.hash.replace(/^#/, ''));
</script>

<script type="text/javascript" src="js/main.js"></script>

<script src="//use.typekit.net/jyp3xci.js"></script>
<script>try{Typekit.load();}catch(e){}</script>