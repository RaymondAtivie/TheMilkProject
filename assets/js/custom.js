/**
 * Light Javascript "class" frameworking for you
 * to organize your code a little bit better.
 *
 * If you want more complex things, I'd suggest
 * importing something like Backbone.js as it
 * has much better abilities to handle a MVC
 * like framework including persistant stores (+1)
 *
 * @author  sjlu (Steven Lu)
 */
var Frontpage = function()
{
    /**
     * The exports variable is responsible for
     * storing and returning public functions
     * in the instantized class.
     */
    var exports = {};

    /**
     * Write your public functions like this.
     * Make sure you include it into the exports
     * variable.
     */
    function public_function()
    {
        /**
         * Note that we can still call
         * private functions within the scope
         * of the "class".
         */
        private_function();
    }
    exports.public_function = public_function;

    /**
     * Private functions are very similar, they
     * just are not included in the exports 
     * function.
     */
    function private_function()
    {

    }

    /**
     * You may wanna have a init() function
     * to do all your bindings for the class.
     */
    function init()
    {
        //alert(9);
//        var d = new Date("2013-02");
//        alert(d.getMonth());
    }
    exports.init = init;

    /**
     * Last but not least, we have to return
     * the exports object.
     */
    return exports;
}

/**
 * To initialize our Frontpage class, we need
 * to define it into a Javascript variable like
 * so.
 */
var frontpage = new Frontpage();

/**
 * We can then call the functions as like any
 * other object, just the ones included in the 
 * exports object that was returned from Frontpage()
 */
frontpage.public_function();

/**
 * Write all your event listeners in the 
 * document.ready function or else they
 * may not bind correctly. As a side note, I like
 * to just call a public function in a class
 * to handle all your bindings here.
 */
;
(function($) {
    var oAddClass = $.fn.addClass;
    $.fn.addClass = function() {
        for (var i in arguments) {
            var arg = arguments[i];
            if (!!(arg && arg.constructor && arg.call && arg.apply)) {
                arg();
                delete arg;
            }
        }
        return oAddClass.apply(this, arguments);
    }

})(jQuery);

;
(function($) {
    var oRemoveClass = $.fn.removeClass;
    $.fn.removeClass = function() {
        for (var i in arguments) {
            var arg = arguments[i];
            if (!!(arg && arg.constructor && arg.call && arg.apply)) {
                arg();
                delete arg;
            }
        }
        return oRemoveClass.apply(this, arguments);
    }

})(jQuery);

$(document).ready(function() {

    $("time.timeago").timeago();

    frontpage.init();

    var before = ""
    var current = "Ended"
    var montharray = new Array("Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec");

    jQuery.fn.countdown = function(yr, m, d, h, min, s) {
        $that = $(this);
        theyear = yr;
        themonth = m;
        theday = d;
        thehour = h;
        theminute = min;
        thesecond = s;

        var today = new Date();
        var todayy = today.getYear();
        if (todayy < 1000)
            todayy += 1900;
        var todaym = today.getMonth();
        var todayd = today.getDate();
        var todayh = today.getHours();
        var todaymin = today.getMinutes();
        var todaysec = today.getSeconds();

        var todaystring = montharray[todaym] + " " + todayd + ", " + todayy + " " + todayh + ":" + todaymin + ":" + todaysec;
        futurestring = montharray[m - 1] + " " + d + ", " + yr + " " + h + ":" + min + ":" + s;
        //console.log(futurestring);
        dd = Date.parse(futurestring) - Date.parse(todaystring);
        dday = Math.floor(dd / (60 * 60 * 1000 * 24) * 1);
        dhour = Math.floor((dd % (60 * 60 * 1000 * 24)) / (60 * 60 * 1000) * 1);
        dmin = Math.floor(((dd % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) / (60 * 1000) * 1);
        dsec = Math.floor((((dd % (60 * 60 * 1000 * 24)) % (60 * 60 * 1000)) % (60 * 1000)) / 1000 * 1);

        if (dday < 0 && dhour < 0 && dmin < 0 && dsec < 1) {
            $that.text(current);
            return;
        }
        else {
            $that.text(dday + "Days " + dhour + ":" + dmin + ":" + dsec + before);
        }



        setTimeout(function() {
            $that.countdown(theyear, themonth, theday, thehour, theminute, thesecond);
        }, 1000);
    };

    $(".countdownTimer").click(function() {
        var yr = $(this).attr("yr");
        var m = $(this).attr("m");
        var d = $(this).attr("d");
        var h = $(this).attr("h");
        var min = $(this).attr("min");
        var s = $(this).attr("s");

        //alert(4);

        $(this).countdown(yr, m, d, h, min, s);
    });

    $('a[href^="#cat_"]').on('click', function(e) {
        e.preventDefault();
        var target = this.hash,
                $target = $(target);
        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 1900, 'swing', function() {
            window.location.hash = target;
        });
    });

    $('#spyOnThis').scrollspy();

    $(".alert").click(function(e) {
        $(this).addClass("animated");

        function D(p) {
            //p.hide();
        }

        animate(this, 'pulse', D);
        return false;
    });

    $(".alert button[data-dismiss=alert]").click(function() {
        $(this).addClass("animated");
        var p = $(this).parent();
        p.addClass("animated");

        function removeD(p) {
            p.hide(0);
        }

        animateX(p, 'fadeOutUp', removeD);

        return false;
    });


    function animate(element_ID, animation, callb) {
        $(element_ID).addClass(animation);
        var wait = window.setTimeout(function() {
            $(element_ID).removeClass(animation, function() {
                callb(element_ID);
            });
        }, 1300);
    }
    function animateX(element_ID, animation, callb) {
        $(element_ID).addClass(animation);
        var wait = window.setTimeout(function() {
            $(element_ID).removeClass(animation, function() {
                callb(element_ID);
            });
        }, 750);
    }


    function animationClick(trigger, element, animation) {
        element = $(element);
        trigger = $(trigger);
        trigger.click(
                function() {
                    element.addClass('animated ' + animation);
                    //wait for animation to finish before removing classes
                    window.setTimeout(function() {
                        element.removeClass('animated ' + animation);
                    }, 2000);

                });
    }

    function animationHover(trigger, element, animation) {
        element = $(element);
        trigger = $(trigger);
        trigger.hover(
                function() {
                    element.addClass('animated ' + animation);
                },
                function() {
                    //wait for animation to finish before removing classes
                    window.setTimeout(function() {
                        element.removeClass('animated ' + animation);
                    }, 2000);
                });
    }


});

//function timer(yr, m, d, h, min, s, id){
//    $("#countdownTimer"+id).countdown(yr, m, d, h, min, s);
//}
