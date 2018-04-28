(function ($) {
    "use strict"; // Start of use strict

    // Toggle to correct tab depending on button target.
    $('.modal-toggle').click(function (e) {
        var tab = e.target.hash;
        $('li > a[href="' + tab + '"]').tab("show");
    });

    // Clear forms on modal exit.
    $('#login-modal').on('hidden.bs.modal', function () {
        $('#login-frm .error').
            removeClass('error').
            tooltip("dispose");
        $('#login-frm')[0].reset();

        $('#signup-frm .error').
            removeClass('error').
            tooltip("dispose");
        $('#signup-frm')[0].reset();
    });

    // Validate login form.
    $('#login-frm').validate({
        rules: {
            psw: {
                minlength: 5
            }
        },
        submitHandler: function (form) {
            login(form);
        },
        invalidHandler: function(form, validator) {
            alert('invalidHandler');
        },
        showErrors: function(errorMap, errorList) { showToolTipErrors(this, errorList); }
    });

    function login(form) {
        alert("logging in");
        var data = (form).serializeArray();
        $.post('../scripts/login.php', data, function() {
            alert("success");
        })
        .fail(function() {
            alert("failed");
        });
    }

    // Validate signup form.
    $('#signup-frm').validate({
        rules: {
            psw: {
                minlength: 5
            },
            pswrepeat: {
                minlength: 5,
                equalTo: "#signup-frm :input[name='psw']"
            },
            email: {
                remote: '../scripts/checkEmail.php'
            }
        },
        messages: {
            email: { remote: "This email is already taken." }
        },
        showErrors: function(errorMap, errorList) { showToolTipErrors(this, errorList); },

        submitHandler: function (form) {
            alert("This is a valid form!");
        }
    });

function showToolTipErrors(element, errorList) {
    // Clean up any tooltips for valid elements
    $.each(element.validElements(), function (index, element) {
        var $element = $(element);

        $element.data("title", "") // Clear the title - there is no error associated anymore
            .removeClass("error")
            .tooltip("dispose");
    });

    // Create new tooltips for invalid elements
    $.each(errorList, function (index, error) {
        var $element = $(error.element);

        $element.tooltip("dispose") // Destroy any pre-existing tooltip so we can repopulate with new tooltip content
            .data("title", error.message)
            .addClass("error")
            .tooltip(); // Create a new tooltip based on the error messsage we just set in the title
    });
};

// Smooth scrolling using jQuery easing
$('a.js-scroll-trigger[href*="#"]:not([href="#"])').click(function () {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
        if (target.length) {
            $('html, body').animate({
                scrollTop: (target.offset().top - 57)
            }, 1000, "easeInOutExpo");
            return false;
        }
    }
});

// Closes responsive menu when a scroll trigger link is clicked
$('.js-scroll-trigger').click(function () {
    $('.navbar-collapse').collapse('hide');
});

// Activate scrollspy to add active class to navbar items on scroll
$('body').scrollspy({
    target: '#mainNav',
    offset: 57
});

// Collapse Navbar
var navbarCollapse = function () {
    if ($("#mainNav").offset().top > 100) {
        $("#mainNav").addClass("navbar-shrink");
    } else {
        $("#mainNav").removeClass("navbar-shrink");
    }
};
// Collapse now if page is not at top
navbarCollapse();
// Collapse the navbar when page is scrolled
$(window).scroll(navbarCollapse);

// Scroll reveal calls
window.sr = ScrollReveal();
sr.reveal('.sr-icons', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
}, 200);
sr.reveal('.sr-button', {
    duration: 1000,
    delay: 200
});
sr.reveal('.sr-contact', {
    duration: 600,
    scale: 0.3,
    distance: '0px'
}, 300);

// Magnific popup calls
$('.popup-gallery').magnificPopup({
    delegate: 'a',
    type: 'image',
    tLoading: 'Loading image #%curr%...',
    mainClass: 'mfp-img-mobile',
    gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1]
    },
    image: {
        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
    }
});

}) (jQuery); // End of use strict
