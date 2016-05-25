(function ($) {
    "use strict";

    var onScrollTimeout = undefined;
    var lastScrollTop = undefined;

    var onScrollTimeoutCb = function(initial) {
        if (initial && lastScrollTop !== undefined) return;

        var scrollTop = $(window).scrollTop();
        var scrollBottom = scrollTop + $(window).height();
        var scrollDelta = undefined;

        if (lastScrollTop !== undefined) {
            scrollDelta = scrollTop - lastScrollTop;
        }

        var eventParams = {
            'top': scrollTop,
            'bottom': scrollBottom,
            'delta': scrollDelta,
            'bumpTop': scrollTop == 0,
            'bumpBottom': scrollBottom == $(document).height()
        }

        if (scrollDelta < 0) {
            $(document).trigger('cc-scroll-up', eventParams);
        } else if (scrollDelta !== undefined || scrollTop > 0) {
            $(document).trigger('cc-scroll-down', eventParams);
        }

        $(document).trigger('cc-scroll', eventParams);

        if (initial === undefined) lastScrollTop = scrollTop;
        onScrollTimeout = undefined;

        return false;
    }

    $(window).on('scroll', function(e) {
        if (onScrollTimeout === undefined) {
            onScrollTimeout = window.setTimeout(onScrollTimeoutCb, 50);
        }
    });

    $(document).ready(function(e) {
        onScrollTimeoutCb(true);
				$('.choose-license-btn').click(function(){
					document.location.href = 'https://creativecommons.org/choose/ '
				})
    });
})(jQuery);
