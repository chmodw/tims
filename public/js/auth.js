(window["webpackJsonp"] = window["webpackJsonp"] || []).push([["/js/auth"],{

/***/ "./node_modules/is-buffer/index.js":
/*!*****************************************!*\
  !*** ./node_modules/is-buffer/index.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

/*!
 * Determine if an object is a Buffer
 *
 * @author   Feross Aboukhadijeh <https://feross.org>
 * @license  MIT
 */

// The _isBuffer check is for Safari 5-7 support, because it's missing
// Object.prototype.constructor. Remove this eventually
module.exports = function (obj) {
  return obj != null && (isBuffer(obj) || isSlowBuffer(obj) || !!obj._isBuffer)
}

function isBuffer (obj) {
  return !!obj.constructor && typeof obj.constructor.isBuffer === 'function' && obj.constructor.isBuffer(obj)
}

// For Node v0.10 support. Remove this eventually.
function isSlowBuffer (obj) {
  return typeof obj.readFloatLE === 'function' && typeof obj.slice === 'function' && isBuffer(obj.slice(0, 0))
}


/***/ }),

/***/ "./node_modules/process/browser.js":
/*!*****************************************!*\
  !*** ./node_modules/process/browser.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

// shim for using process in browser
var process = module.exports = {};

// cached from whatever global is present so that test runners that stub it
// don't break things.  But we need to wrap it in a try catch in case it is
// wrapped in strict mode code which doesn't define any globals.  It's inside a
// function because try/catches deoptimize in certain engines.

var cachedSetTimeout;
var cachedClearTimeout;

function defaultSetTimout() {
    throw new Error('setTimeout has not been defined');
}
function defaultClearTimeout () {
    throw new Error('clearTimeout has not been defined');
}
(function () {
    try {
        if (typeof setTimeout === 'function') {
            cachedSetTimeout = setTimeout;
        } else {
            cachedSetTimeout = defaultSetTimout;
        }
    } catch (e) {
        cachedSetTimeout = defaultSetTimout;
    }
    try {
        if (typeof clearTimeout === 'function') {
            cachedClearTimeout = clearTimeout;
        } else {
            cachedClearTimeout = defaultClearTimeout;
        }
    } catch (e) {
        cachedClearTimeout = defaultClearTimeout;
    }
} ())
function runTimeout(fun) {
    if (cachedSetTimeout === setTimeout) {
        //normal enviroments in sane situations
        return setTimeout(fun, 0);
    }
    // if setTimeout wasn't available but was latter defined
    if ((cachedSetTimeout === defaultSetTimout || !cachedSetTimeout) && setTimeout) {
        cachedSetTimeout = setTimeout;
        return setTimeout(fun, 0);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedSetTimeout(fun, 0);
    } catch(e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't trust the global object when called normally
            return cachedSetTimeout.call(null, fun, 0);
        } catch(e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error
            return cachedSetTimeout.call(this, fun, 0);
        }
    }


}
function runClearTimeout(marker) {
    if (cachedClearTimeout === clearTimeout) {
        //normal enviroments in sane situations
        return clearTimeout(marker);
    }
    // if clearTimeout wasn't available but was latter defined
    if ((cachedClearTimeout === defaultClearTimeout || !cachedClearTimeout) && clearTimeout) {
        cachedClearTimeout = clearTimeout;
        return clearTimeout(marker);
    }
    try {
        // when when somebody has screwed with setTimeout but no I.E. maddness
        return cachedClearTimeout(marker);
    } catch (e){
        try {
            // When we are in I.E. but the script has been evaled so I.E. doesn't  trust the global object when called normally
            return cachedClearTimeout.call(null, marker);
        } catch (e){
            // same as above but when it's a version of I.E. that must have the global object for 'this', hopfully our context correct otherwise it will throw a global error.
            // Some versions of I.E. have different rules for clearTimeout vs setTimeout
            return cachedClearTimeout.call(this, marker);
        }
    }



}
var queue = [];
var draining = false;
var currentQueue;
var queueIndex = -1;

function cleanUpNextTick() {
    if (!draining || !currentQueue) {
        return;
    }
    draining = false;
    if (currentQueue.length) {
        queue = currentQueue.concat(queue);
    } else {
        queueIndex = -1;
    }
    if (queue.length) {
        drainQueue();
    }
}

function drainQueue() {
    if (draining) {
        return;
    }
    var timeout = runTimeout(cleanUpNextTick);
    draining = true;

    var len = queue.length;
    while(len) {
        currentQueue = queue;
        queue = [];
        while (++queueIndex < len) {
            if (currentQueue) {
                currentQueue[queueIndex].run();
            }
        }
        queueIndex = -1;
        len = queue.length;
    }
    currentQueue = null;
    draining = false;
    runClearTimeout(timeout);
}

process.nextTick = function (fun) {
    var args = new Array(arguments.length - 1);
    if (arguments.length > 1) {
        for (var i = 1; i < arguments.length; i++) {
            args[i - 1] = arguments[i];
        }
    }
    queue.push(new Item(fun, args));
    if (queue.length === 1 && !draining) {
        runTimeout(drainQueue);
    }
};

// v8 likes predictible objects
function Item(fun, array) {
    this.fun = fun;
    this.array = array;
}
Item.prototype.run = function () {
    this.fun.apply(null, this.array);
};
process.title = 'browser';
process.browser = true;
process.env = {};
process.argv = [];
process.version = ''; // empty string to avoid regexp issues
process.versions = {};

function noop() {}

process.on = noop;
process.addListener = noop;
process.once = noop;
process.off = noop;
process.removeListener = noop;
process.removeAllListeners = noop;
process.emit = noop;
process.prependListener = noop;
process.prependOnceListener = noop;

process.listeners = function (name) { return [] }

process.binding = function (name) {
    throw new Error('process.binding is not supported');
};

process.cwd = function () { return '/' };
process.chdir = function (dir) {
    throw new Error('process.chdir is not supported');
};
process.umask = function() { return 0; };


/***/ }),

/***/ "./node_modules/webpack/buildin/global.js":
/*!***********************************!*\
  !*** (webpack)/buildin/global.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var g;

// This works in non-strict mode
g = (function() {
	return this;
})();

try {
	// This works if eval is allowed (see CSP)
	g = g || new Function("return this")();
} catch (e) {
	// This works if the window reference is available
	if (typeof window === "object") g = window;
}

// g can still be undefined, but nothing to do about it...
// We return undefined, instead of nothing here, so it's
// easier to handle this case. if(!global) { ...}

module.exports = g;


/***/ }),

/***/ "./node_modules/webpack/buildin/module.js":
/*!***********************************!*\
  !*** (webpack)/buildin/module.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

module.exports = function(module) {
	if (!module.webpackPolyfill) {
		module.deprecate = function() {};
		module.paths = [];
		// module.parent = undefined by default
		if (!module.children) module.children = [];
		Object.defineProperty(module, "loaded", {
			enumerable: true,
			get: function() {
				return module.l;
			}
		});
		Object.defineProperty(module, "id", {
			enumerable: true,
			get: function() {
				return module.i;
			}
		});
		module.webpackPolyfill = 1;
	}
	return module;
};


/***/ }),

/***/ "./resources/assets/js/auth.js":
/*!*************************************!*\
  !*** ./resources/assets/js/auth.js ***!
  \*************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! ./light-bootstrap-dashboard */ "./resources/assets/js/light-bootstrap-dashboard.js");

/***/ }),

/***/ "./resources/assets/js/light-bootstrap-dashboard.js":
/*!**********************************************************!*\
  !*** ./resources/assets/js/light-bootstrap-dashboard.js ***!
  \**********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

/* WEBPACK VAR INJECTION */(function($) {window._ = __webpack_require__(/*! lodash */ "./node_modules/lodash/lodash.js");
window.Chartist = __webpack_require__(/*! chartist */ "./node_modules/chartist/dist/chartist.js");
/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
  window.$ = window.jQuery = __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js"); // Popper JS

  __webpack_require__(/*! popper.js */ "./node_modules/popper.js/dist/esm/popper.js"); // Bootstrap Sass


  __webpack_require__(/*! bootstrap */ "./node_modules/bootstrap/dist/js/bootstrap.js"); // Bootstrap Notify


  __webpack_require__(/*! bootstrap-notify */ "./node_modules/bootstrap-notify/bootstrap-notify.js"); // Bootstrap Select


  __webpack_require__(/*! bootstrap-select */ "./node_modules/bootstrap-select/dist/js/bootstrap-select.js"); // Bootstrap Select


  __webpack_require__(/*! bootstrap-switch */ "./node_modules/bootstrap-switch/dist/js/bootstrap-switch.js"); // FlatUI Radiocheck


  __webpack_require__(/*! flatui-radiocheck */ "./node_modules/flatui-radiocheck/radiocheck.js");
} catch (e) {} // require('_clock');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */


window.axios = __webpack_require__(/*! axios */ "./node_modules/axios/index.js");
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

var token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
  window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */
// import Echo from 'laravel-echo'
// window.Pusher = require('pusher-js');
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'your-pusher-key'
// });

/*!

 =========================================================
 * Light Bootstrap Dashboard - v2.0.1
 =========================================================

 * Product Page: http://www.creative-tim.com/product/light-bootstrap-dashboard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/light-bootstrap-dashboard/blob/master/LICENSE.md)

 =========================================================

 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

 */


var searchVisible = 0;
var transparent = true;
var transparentDemo = true;
var fixedTop = false;
var navbar_initialized = false;
var mobile_menu_visible = 0,
    mobile_menu_initialized = false,
    toggle_initialized = false,
    bootstrap_nav_initialized = false,
    $sidebar,
    isWindows;
$(document).ready(function () {
  window_width = $(window).width(); // check if there is an image set for the sidebar's background

  lbd.checkSidebarImage(); // Init navigation toggle for small screens

  if (window_width <= 991) {
    lbd.initRightMenu();
  } //  Activate the tooltips


  $('[rel="tooltip"]').tooltip(); //      Activate regular switches

  if ($("[data-toggle='switch']").length != 0) {
    $("[data-toggle='switch']").bootstrapSwitch();
  }

  $('.form-control').on("focus", function () {
    $(this).parent('.input-group').addClass("input-group-focus");
  }).on("blur", function () {
    $(this).parent(".input-group").removeClass("input-group-focus");
  }); // Fixes sub-nav not working as expected on IOS

  $('body').on('touchstart.dropdown', '.dropdown-menu', function (e) {
    e.stopPropagation();
  });
}); // activate collapse right menu when the windows is resized

$(window).resize(function () {
  if ($(window).width() <= 991) {
    lbd.initRightMenu();
  }
});
lbd = {
  misc: {
    navbar_menu_visible: 0
  },
  checkSidebarImage: function checkSidebarImage() {
    $sidebar = $('.sidebar');
    image_src = $sidebar.data('image');

    if (image_src !== undefined) {
      sidebar_container = '<div class="sidebar-background" style="background-image: url(' + image_src + ') "/>';
      $sidebar.append(sidebar_container);
    } else if (mobile_menu_initialized == true) {
      // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
      $sidebar_wrapper.find('.navbar-form').remove();
      $sidebar_wrapper.find('.nav-mobile-menu').remove();
      mobile_menu_initialized = false;
    }
  },
  initRightMenu: function initRightMenu() {
    $sidebar_wrapper = $('.sidebar-wrapper');

    if (!mobile_menu_initialized) {
      $navbar = $('nav').find('.navbar-collapse').first().clone(true);
      nav_content = '';
      mobile_menu_content = ''; //add the content from the regular header to the mobile menu

      $navbar.children('ul').each(function () {
        content_buff = $(this).html();
        nav_content = nav_content + content_buff;
      });
      nav_content = '<ul class="nav nav-mobile-menu">' + nav_content + '</ul>';
      $navbar_form = $('nav').find('.navbar-form').clone(true);
      $sidebar_nav = $sidebar_wrapper.find(' > .nav'); // insert the navbar form before the sidebar list

      $nav_content = $(nav_content);
      $nav_content.insertBefore($sidebar_nav);
      $navbar_form.insertBefore($nav_content);
      $(".sidebar-wrapper .dropdown .dropdown-menu > li > a").click(function (event) {
        event.stopPropagation();
      });
      mobile_menu_initialized = true;
    } else {
      console.log('window with:' + $(window).width());

      if ($(window).width() > 991) {
        // reset all the additions that we made for the sidebar wrapper only if the screen is bigger than 991px
        $sidebar_wrapper.find('.navbar-form').remove();
        $sidebar_wrapper.find('.nav-mobile-menu').remove();
        mobile_menu_initialized = false;
      }
    }

    if (!toggle_initialized) {
      $toggle = $('.navbar-toggler');
      $toggle.click(function () {
        if (mobile_menu_visible == 1) {
          $('html').removeClass('nav-open');
          $('.close-layer').remove();
          setTimeout(function () {
            $toggle.removeClass('toggled');
          }, 400);
          mobile_menu_visible = 0;
        } else {
          setTimeout(function () {
            $toggle.addClass('toggled');
          }, 430);
          main_panel_height = $('.main-panel')[0].scrollHeight;
          $layer = $('<div class="close-layer"></div>');
          $layer.css('height', main_panel_height + 'px');
          $layer.appendTo(".main-panel");
          setTimeout(function () {
            $layer.addClass('visible');
          }, 100);
          $layer.click(function () {
            $('html').removeClass('nav-open');
            mobile_menu_visible = 0;
            $layer.removeClass('visible');
            setTimeout(function () {
              $layer.remove();
              $toggle.removeClass('toggled');
            }, 400);
          });
          $('html').addClass('nav-open');
          mobile_menu_visible = 1;
        }
      });
      toggle_initialized = true;
    }
  } // Returns a function, that, as long as it continues to be invoked, will not
  // be triggered. The function will be called after it stops being called for
  // N milliseconds. If `immediate` is passed, trigger the function on the
  // leading edge, instead of the trailing.

};

function debounce(func, wait, immediate) {
  var timeout;
  return function () {
    var context = this,
        args = arguments;
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      timeout = null;
      if (!immediate) func.apply(context, args);
    }, wait);
    if (immediate && !timeout) func.apply(context, args);
  };
}

;
/**
 * Remove Errors from the text fields
 */

$('.form-control').on("focus", function () {
  $(this).removeClass('is-invalid');
});
/* WEBPACK VAR INJECTION */}.call(this, __webpack_require__(/*! jquery */ "./node_modules/jquery/dist/jquery.js")))

/***/ }),

/***/ 1:
/*!*******************************************!*\
  !*** multi ./resources/assets/js/auth.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Users\chamodya wimansha\Documents\TIMS\Code\TIMS\resources\assets\js\auth.js */"./resources/assets/js/auth.js");


/***/ })

},[[1,"/js/manifest","/js/vendor"]]]);