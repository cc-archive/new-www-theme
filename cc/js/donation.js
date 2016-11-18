/**
 * Show/Hide Search on narrow layouts
 */
(function ($) {
  "use strict";

  $( document ).ready(function() {
    var other_fields = '#gform_widget-3 .gfield_radio > li:last-child, ' +
                       '#gform_widget-5 .gfield_radio > li:last-child, ' +
                       'body.page-id-48781 #input_3_1 > li:last-child, ' +
                       'body.page-id-48781 #input_3_9 > li:last-child';

    $(other_fields).each(function() {
      var $txtField = $(this).children('input[type="text"]'),
          $parent = $(this);

      $txtField
        .focus(function() {
          $parent.addClass('selected');
        })
        .blur(function() {
          $parent.removeClass('selected');
        });
    });
  });

  // Next on Page 1
  $("#gform_next_button_3_18").on( "click", function() {
    if (typeof(__gaTracker) == 'function'){
      __gaTracker('send', 'pageview','/donate/page-two');
    }
  });
  // Next on Page 2
  $("#gform_next_button_3_19").on( "click", function() {
    if (typeof(__gaTracker) == 'function'){
      __gaTracker('send', 'pageview','/donate/page-three');
    }
  });
  // Next on Page 3
  $("#gform_submit_button_3").on( "click", function() {
    if (typeof(__gaTracker) == 'function'){
      __gaTracker('send', 'pageview','/donate/complete');
    }
  });

})(jQuery);
