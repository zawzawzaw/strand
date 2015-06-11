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

    $(".check-availability").on('click', function(e){
        e.preventDefault();
        checkAvailability('WBE');
    });

    $(".room-page-select-date").on('click', function(e){
        e.preventDefault();
        $(this).parent().find(".hasDatepicker").datepicker("show");
    });    

    $(".room-page-check-availability").on('click', function(e){
        $( "#adults" ).val('1');
        checkAvailability('WBE');
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