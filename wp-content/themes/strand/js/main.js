// Avoid `console` errors in browsers that lack a console.
(function() {
    var method;
    var noop = function () {};
    var methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    var length = methods.length;
    var console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

$(document).ready(function(){   

    $('.carousel').carousel();

    $('.reservation').on('click', function(e){
        e.preventDefault();
        $('.reservation-widget').slideToggle();
    });

    $('.check-in-input').datepicker({
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: - 305 + 'px'});
        },
        dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
        minDate: 0,
        dateFormat: 'dd/mm/yy'
    });
    $('.check-out-input').datepicker({
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: - 305 + 'px'});
        },
        dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
        minDate: 0,
        dateFormat: 'dd/mm/yy'
    });

    $('.subscribe-it').on('click', function(e){
        $('#subscribeBtn').trigger('click');
    });

    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    $('#arrival-datepicker').datepicker({
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -159 + 'px', marginLeft: 305 + 'px'});
        },
        dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
        minDate: 0,
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate'),
                day  = date.getDate(),  
                month = date.getMonth(),              
                year =  date.getFullYear();

            $(this).parent().find('.selected-date').find('.month').text(monthNames[month]);
            $(this).parent().find('.selected-date').find('.day').text(day);
            $(this).parent().find('.selected-date').show();
            $(this).parent().find('.select-date').hide();

            jQuery( "#checkInDate" ).val(("0" + day).slice(-2)+'/'+("0" + (month + 1)).slice(-2)+'/'+year);
        }
    });

    $('#departure-datepicker').datepicker({
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -159 + 'px', marginLeft: 155 + 'px'});
        },
        dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
        minDate: 0,
        onSelect: function(dateText, inst) {
            var date = $(this).datepicker('getDate'),
                day  = date.getDate(),  
                month = date.getMonth(),              
                year =  date.getFullYear();

            $(this).parent().find('.selected-date').find('.month').text(monthNames[month]);
            $(this).parent().find('.selected-date').find('.day').text(day);
            $(this).parent().find('.selected-date').show();
            $(this).parent().find('.select-date').hide();

            jQuery( "#checkOutDate" ).val(("0" + day).slice(-2)+'/'+("0" + (month + 1)).slice(-2)+'/'+year);
        }
    });

    $(".select-date").on('click', function(e){
        e.preventDefault();
        $(this).parent().find(".hasDatepicker").datepicker("show");
    });    

    $(".selected-date").on('click', function(e){
        e.preventDefault();
        $(this).parent().find(".hasDatepicker").datepicker("show");
    });    

    $(".check-availability").on('click', function(e){
        e.preventDefault();
        var checkInUserInput = $('.check-in-input').val();
        var checkOutUserInput = $('.check-out-input').val();
        var valid = false;
        var errMsg;

        var checkInDateArr = checkInUserInput.split('/');
        var checkOutDateArr = checkOutUserInput.split('/');
        var currentDate = new Date();

        var checkInDate = new Date(checkInDateArr[2], checkInDateArr[1] - 1, checkInDateArr[0], currentDate.getHours(), currentDate.getMinutes(), currentDate.getSeconds());
        var checkOutDate = new Date(checkOutDateArr[2], checkOutDateArr[1] - 1, checkOutDateArr[0], currentDate.getHours(), currentDate.getMinutes(), currentDate.getSeconds());

        var checkInAdvacedDate = new Date(); checkInAdvacedDate.setHours(0,0,0,0); checkInAdvacedDate.setHours(checkInAdvacedDate.getHours()+24);

        var adults = $( "#adults" ).val();  
        var children = $( "#children" ).val();        

        if(adults=="" || isNaN(adults) || adults <= 0) {
            valid = false; 
            errMsg = "Enter no of guest for booking.";
        }
        else if(children!="" && isNaN(children)) {
            valid = false;
            errMsg = "Enter valid no of children for booking.";
        }
        else if(checkInUserInput=="") {
            valid = false;
            errMsg = "Enter valid check in date.";
        }
        else if(checkOutUserInput=="") {
            valid = false;
            errMsg = "Enter valid check out date.";
        }
        else if(checkInDate < checkInAdvacedDate) {
            valid = false;
            errMsg = "Reservations cannot be made 24 hours before arrival.";
        }
        else if (checkInDate >= checkOutDate) {
            valid = false;
            errMsg = "Check in date must be before check out date.";
        }else {
            valid = true;   
            errMsg = "";
        }

        if(!valid) {
            alert(errMsg);
        }else {
            $('#reservation-form').submit();
        }
    });

    $(".room-page-select-date").on('click', function(e){
        e.preventDefault();
        $(this).parent().find(".hasDatepicker").datepicker("show");
    });    

    $(".room-page-check-availability").on('click', function(e){
        e.preventDefault();
        $( "#adults" ).val('1');
        $(".check-availability").trigger('click');
        
    });

    /////
    /////
    ///// 

    function myScroller()  {
        var scrollPos = $(window).scrollTop();
        
        if( ( scrollPos != 0 ) ) {
            console.log('scrolling')
            $('.arrow').hide();
            if(scrolled==false && initialLoad==false) {
                scrolled = true;               
            }
                
        }       
        else if( ( scrollPos === 0 ) && (scrolled == true) ) {
            scrolled = false;
            $('#header-wrapper').removeClass('shadow');
            $('.arrow').show();
        }
    }

    var initialLoad = true;
    // home page first scroll
    var scrolled = false;
    $(window).on('scroll', function() {
       myScroller();
    });

    myScroller();

    initialLoad = false;

    $('.scroll-to-content').on('click', function(e){
        e.preventDefault();
        var currentId = $(this).attr('href');
        $('html, body').animate({
            scrollTop: $(currentId).offset().top - 50
        }, 800);
    });

    ///////
    ///////
    ///////

    $(".toggleMenu").on('click', function(e){
        $(this).prev('ul').toggleClass('mobile-menu');
    });
    
});