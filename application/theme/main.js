(function($) {
  'use strict';

  function l(path) {
    var path = path || '/';

    if (path[0] == '/' && MVC.global.path_suffix) {
      return '/' + MVC.global.path_suffix + path;
    }

    return path;
  }

  window['l'] = l;

  $(function() {
    var $window = $(window),
        $ui_checkbox = $('.ui.checkbox:not(.custom)'),
        $ui_sidebar = $('.ui.sidebar:not(.custom)'),
        $ui_dropdown = $('.ui.dropdown:not(.custom)'),
        display_sidebar = false;

    $ui_checkbox.checkbox();
    $ui_sidebar.sidebar();
    $ui_dropdown.dropdown();
    $('.tabular.menu .item').tab();
    $('.popup').popup();

    $window.on('mousemove', function(event) {
      if (!display_sidebar && event.pageX < 5) {
        display_sidebar = true;
        $ui_sidebar.sidebar('show');
      }

      if (display_sidebar && event.pageX > $ui_sidebar.width()) {
        display_sidebar = false;
        $ui_sidebar.sidebar('hide');
      }
    });
  });
})(jQuery);
