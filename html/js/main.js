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
        dateFormat: 'yy-mm-dd'
    });
    $('.check-out-input').datepicker({
        beforeShow: function(input, inst)
        {
            inst.dpDiv.css({marginTop: -input.offsetHeight + 'px', marginLeft: - 305 + 'px'});
        },
        dayNamesMin: ['S', 'M', 'T', 'W', 'T', 'F', 'S'],
        minDate: 0,
        dateFormat: 'yy-mm-dd'
    });

    $('.form-control-feedback').on('click', function(e){
        console.log('hi')
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
        }
    });

    $(".select-date").on('click', function(e){
        e.preventDefault();
        $(this).parent().find(".hasDatepicker").datepicker("show");
    });    

});