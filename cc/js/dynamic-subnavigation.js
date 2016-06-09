(function ($) {
  "use strict";

  /**
   * Toggle subnavigation's content display
   */
  function cc_toggle_content(Breakpoints, $subNav, $subNavTitle, $subNavContent) {
    $subNavTitle.on('click.cc_dynamic_subnav', function() {
      if ($(window).width() < Breakpoints.desktop_sm) {
        $subNav.toggleClass('expanded');
        $subNavContent.slideToggle();
      }
    });
  }

  /**
   * Adjust the subnavigation's location
   */
  function cc_dynamic_subnavigation(Breakpoints, $subNav, $subNavContent) {
    var window_w = $(window).width(),
        $main_content = $('#main');

    if (window_w < Breakpoints.desktop_sm) {
      if ($main_content.children($subNav.attr('id')).length == 0) {
        $main_content.prepend($subNav);
      }
    }
    else {
      $subNav.detach();
    }
  }

  $( document ).ready(function() {
    var Breakpoints = {},
        $subNav = $('#advanced_sidebar_menu-3').clone(),
        $subNavTitle = $subNav.children('.widget-title'),
        $subNavContent = $subNav.children('.child-sidebar-menu');

    Breakpoints.tablet_sm =   710;  // 44.375em
    Breakpoints.tablet_md =   783;  // 48.9375em
    Breakpoints.desktop_sm =  910;  // 56.875em
    Breakpoints.desktop_md =  985;  // 61.5625em
    Breakpoints.desktop_lg = 1200;  // 75em

    $subNav.attr('id', $subNav.attr('id') + '-clone');

    cc_toggle_content(Breakpoints, $subNav, $subNavTitle, $subNavContent);
    cc_dynamic_subnavigation(Breakpoints, $subNav, $subNavContent);
    window.onresize = function () { cc_dynamic_subnavigation(Breakpoints, $subNav, $subNavContent); };
  });
})(jQuery);