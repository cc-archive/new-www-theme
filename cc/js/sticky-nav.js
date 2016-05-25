(function ($) {
    "use strict";

    var headerElem = $('.site-header');
    var headerSpacerElem = undefined;
    var headerFloatTop = 0;

    var footerElem = $('.site-footer');
    var footerFloatFromElem = $('.cc-footer-float-from');
    var footerSpacerElem = undefined;
    var footerFloatTop = undefined;

    // Clone the header ot create an invisible spacer element.
    // The order we place these elements is important: some JavaScript in the
    // twentysixteen base theme will only apply to the first header.
    headerSpacerElem = headerElem.clone().attr('id', null).addClass('spacer');
    headerSpacerElem.removeClass('sticky-nav-main');
    headerSpacerElem.insertAfter(headerElem);
    headerElem.addClass('sticky');

    if (footerFloatFromElem.length == 0 && $(document.body).hasClass('infinite-scroll')) {
        // Automatic sticky footer for Jetpack's infinite scroll pages.
        var mainElem = $('#main');
        footerFloatFromElem = $('<div>').addClass('cc-footer-float-from').appendTo(main);
    }

    if (footerFloatFromElem.length > 0) {
        footerSpacerElem = footerElem.clone().attr('id', null).addClass('spacer');
        footerSpacerElem.removeClass('sticky-nav-main');
        footerSpacerElem.insertAfter(footerElem);
        footerElem.addClass('sticky detached offscreen');
    }

    var updateSticky = function(stickyElem, spacerElem, options) {
        var detached = options['detached'] || false;
        var reveal = options['reveal'] || false;

        if (detached) {
            stickyElem.addClass('detached');
            spacerElem.addClass('detached');
            if (reveal) {
                stickyElem.removeClass('offscreen');
            } else {
                stickyElem.addClass('offscreen');
            }
        } else {
            stickyElem.removeClass('detached offscreen');
            spacerElem.removeClass('detached');
        }
    }

    var onScrollCb = function(e, params) {
        // Show header if scrolling up past bottom of site-header, or initial page load.
        var headerFloatTop = headerSpacerElem.offset().top + headerSpacerElem.height();
        var headerFloatOffset = headerElem.hasClass('detached') ? -headerElem.height() : 0;
        updateSticky(headerElem, headerSpacerElem, {
            detached: params['top'] > headerFloatTop + headerFloatOffset,
            reveal: params['delta'] < 0 || params['delta'] == undefined
        });

        if (footerFloatFromElem.length > 0) {
            // Show footer if scrolling past cc-footer-float-from.
            // The footer element is detached if the document is taller than the window.
            var footerFloatTop = footerFloatFromElem.offset().top;
            var footerBottom = footerSpacerElem.offset().top + footerSpacerElem.outerHeight();
            updateSticky(footerElem, footerSpacerElem, {
                detached: footerBottom > $(window).height(),
                reveal: params['bottom'] >= footerFloatTop,
            });
        }
    }

    $(document).on('cc-scroll', onScrollCb);

    // Detect clicks outside of mobile navigation
    var $mobileNav = $('#mobile-navigation');
    $('body').on('click', function(e) {
        if ($mobileNav.is(':visible')) {
            if(($(e.target).attr('id') != 'menu-toggle' && $(e.target).parent().attr('id') != 'menu-toggle') && ($(e.target).parents('#mobile-navigation').length == 0)) {
                $('#menu-toggle').click();
                return false;
            }
        }
    });
})(jQuery);
