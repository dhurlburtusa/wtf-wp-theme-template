/* global jQuery */
/**
 * WTF keyboard support for attachment navigation.
 */

(function ($) {
  $(document).on('keydown.wtf', function (e) {
    let url = false

    // Left arrow key code.
    if (e.which === 37) {
      url = $('.nav-previous a').attr('href')
    }
    // Right arrow key code.
    else if (e.which === 39) {
      url = $('.nav-next a').attr('href')
    }
    // Other key code.
    else {
      return
    }

    if (url && !$('textarea, input').is(':focus')) {
      window.location = url
    }
  })
})(jQuery)
