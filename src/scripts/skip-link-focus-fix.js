console.log('wtf::skip-link-focus-fix.js')

/**
 * Makes "skip to content" link work correctly in IE9, Chrome, and Opera
 * for better accessibility.
 *
 * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
 */

const isWebkit = navigator.userAgent.toLowerCase().indexOf('webkit') > -1
const isOpera = navigator.userAgent.toLowerCase().indexOf('opera') > -1
const isIE = navigator.userAgent.toLowerCase().indexOf('msie') > -1

if ((isWebkit || isOpera || isIE) && document.getElementById && window.addEventListener) {
  const ID__RE = /^[A-z0-9_-]+$/
  const TAG_NAMES__RE = /^(?:a|select|input|button|textarea)$/i
  window.addEventListener('hashchange', function () {
    const id = window.location.hash.substring(1)

    if (!(ID__RE.test(id))) {
      return
    }

    const element = document.getElementById(id)

    if (element) {
      if (!(TAG_NAMES__RE.test(element.tagName))) {
        element.tabIndex = -1
      }

      element.focus()

      // Repositions the window on jump-to-anchor to account for admin bar and border height.
      window.scrollBy(0, -53)
    }
  }, false)
}
