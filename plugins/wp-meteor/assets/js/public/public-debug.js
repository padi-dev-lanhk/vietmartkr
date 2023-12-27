/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(3);


/***/ }),
/* 1 */,
/* 2 */,
/* 3 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
// ESM COMPAT FLAG
__webpack_require__.r(__webpack_exports__);

// CONCATENATED MODULE: ./src/js/common/event-emitter.js
class EventEmitter {
  constructor() {
    this.l = [];
  }

  emit(name) {
    var data = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;
    this.l[name] && this.l[name].forEach(l => l(data));
  }

  on(name, callback) {
    var _this$l;

    (_this$l = this.l)[name] || (_this$l[name] = []);
    this.l[name].push(callback);
  }

  off(name, callback) {
    this.l[name] = (this.l[name] || []).filter(c => c !== callback);
  }
  /*
  once(name, callback) {
      const closure = () => {
          this.off(closure);
          callback();
      }
      this.l[name] ||= [];
      this.l[name].push(closure);
  }
  */


}
// CONCATENATED MODULE: ./src/js/public/includes/utils/dispatcher.js

/* harmony default export */ var dispatcher = (new EventEmitter());
// CONCATENATED MODULE: ./src/js/public/includes/utils/delta.js
var initialTime = new Date();
/* harmony default export */ var delta = (() => (new Date() - initialTime) / 1000);
// CONCATENATED MODULE: ./src/js/public/includes/mocks/jquery.js


var c =  true ? console.log : undefined;
var jquery_d = document;
var DCL = 'DOMContentLoaded';
/**
 * class name should not match mocked object
 */

class jquery_jQueryMock {
  constructor() {
    this.known = [];
  }

  init() {
    var Mock;
    var loaded = false;

    var override = jQuery => {
      if (!loaded && jQuery && jQuery.fn && !jQuery.__wpmeteor) {
         true && c(delta(), 'new jQuery detected', jQuery); // can't use () => {} as it binds to different this

        var enqueue = function enqueue(func) {
           true && c(delta(), 'enqueued jQuery(func)', func);
          jquery_d.addEventListener(DCL, e => {
             true && c(delta(), 'running enqueued jQuery function', func);
            func.bind(jquery_d)(jQuery, e, 'jQueryMock');
          });
          return this;
        };

        this.known.push([jQuery, jQuery.fn.ready, jQuery.fn.init.prototype.ready]);
        jQuery.fn.ready = enqueue;
        jQuery.fn.init.prototype.ready = enqueue;
        jQuery.__wpmeteor = true;
      }

      return jQuery;
    };

    if (window.jQuery) {
      Mock = override(window.jQuery);
    }

    Object.defineProperty(window, 'jQuery', {
      get() {
        return Mock;
      },

      set(jQuery) {
        return Mock = override(jQuery);
      } // configurable: true


    });
    dispatcher.on('l', () => loaded = true);
  }

  unmock() {
    this.known.forEach(_ref => {
      var [jQuery, oldReady, oldPrototypeReady] = _ref;
       true && c(delta(), 'unmocking jQuery', jQuery);
      jQuery.fn.ready = oldReady;
      jQuery.fn.init.prototype.ready = oldPrototypeReady;
    });
  }

}
// CONCATENATED MODULE: ./src/js/public/includes/utils/listener-options.js
// Test via a getter in the options object to see if the passive property is accessed
var listenerOptions = {};

((w, p) => {
  try {
    var opts = Object.defineProperty({}, p, {
      get: function get() {
        listenerOptions[p] = true;
      }
    });
    w.addEventListener(p, null, opts);
    w.removeEventListener(p, null, opts);
  } catch (e) {}
})(window, "passive");

/* harmony default export */ var listener_options = (listenerOptions);
// CONCATENATED MODULE: ./src/js/public/includes/utils/interaction-events.js



var interaction_events_c =  true ? console.log : undefined;
var interaction_events_w = window;
var interaction_events_d = document;
var interaction_events_a = 'addEventListener';
var interaction_events_r = 'removeEventListener';
var interaction_events_ra = 'removeAttribute';
var interaction_events_ga = 'getAttribute';
var interaction_events_sa = 'setAttribute';
var interaction_events_DCL = 'DOMContentLoaded';
var interactionEvents = ['mouseover', 'keydown', 'touchmove', 'touchend', 'wheel'];
var captureEvents = ['mouseover', 'mouseout', 'touchstart', 'touchmove', 'touchend', 'click'];
var prefix = 'data-wpmeteor-';
var separator = "----";
class interaction_events_InteractionEvents {
  init(rdelay) {
    var firstInteractionFired = false;
    var firstInteractionTimeout = false;

    var onFirstInteraction = e => {
       true && interaction_events_c(delta(), separator, "firstInteraction event MAYBE fired", (e || {}).type);

      if (!firstInteractionFired) {
         true && interaction_events_c(delta(), separator, "firstInteraction fired");
        firstInteractionFired = true; // cleaning up listeners

         true && interaction_events_c(delta(), separator, "firstInteraction event listeners removed");
        interactionEvents.forEach(event => interaction_events_d.body[interaction_events_r](event, onFirstInteraction, listener_options));
        clearTimeout(firstInteractionTimeout);
        dispatcher.emit('fi');
      }
    };

    var synteticCick = e => {
       true && interaction_events_c(delta(), 'creating syntetic click event for', e);
      var event = new MouseEvent('click', {
        view: e.view,
        bubbles: true,
        cancelable: true
      });
      Object.defineProperty(event, 'target', {
        writable: false,
        value: e.target
      });
      return event;
    };

    dispatcher.on('i', () => {
      // sometimes first interaction happens before images are loaded, 
      // that means there is no need to set this timeout
      if (!firstInteractionFired) {
        onFirstInteraction();
      }
    });
    var capturedEvents = [];

    var captureEvent = e => {
      if (e.target && 'dispatchEvent' in e.target) {
         true && interaction_events_c(delta(), 'captured', e.type, e.target);

        if (e.type === 'click') {
          e.preventDefault();
          e.stopPropagation(); // result = false;

          capturedEvents.push(synteticCick(e));
        } else if (e.type !== 'touchmove') {
          capturedEvents.push(e);
        }

        e.target[interaction_events_sa](prefix + e.type, true);
      }
    };

    dispatcher.on('l', () => {
       true && interaction_events_c(delta(), separator, "removing mouse event listeners");
      captureEvents.forEach(name => interaction_events_w[interaction_events_r](name, captureEvent));
      var e;

      while (e = capturedEvents.shift()) {
        var target = e.target;

        if (target[interaction_events_ga](prefix + 'touchstart') && target[interaction_events_ga](prefix + 'touchend') && !target[interaction_events_ga](prefix + 'click')) {
          if (target[interaction_events_ga](prefix + 'touchmove')) {
             true && interaction_events_c(delta(), ' touchmove happened, so not dispatching click to ', e.target);
          } else {
            target[interaction_events_ra](prefix + 'touchmove');
            capturedEvents.push(synteticCick(e));
          }

          target[interaction_events_ra](prefix + 'touchstart');
          target[interaction_events_ra](prefix + 'touchend');
        } else {
          target[interaction_events_ra](prefix + e.type);
        }

         true && interaction_events_c(delta(), ' dispatching ' + e.type + ' to ', e.target); // e.target.style.removeProperty('cursor');

        target.dispatchEvent(e);
      }
    });

    var installFirstInteractionListeners = () => {
       true && interaction_events_c(delta(), separator, "installing firstInteraction listeners");
      interactionEvents.forEach(event => interaction_events_d.body[interaction_events_a](event, onFirstInteraction, listener_options));
       true && interaction_events_c(delta(), separator, "installing mouse event listeners");
      captureEvents.forEach(name => interaction_events_w[interaction_events_a](name, captureEvent));
      interaction_events_d[interaction_events_r](interaction_events_DCL, installFirstInteractionListeners);
    };

    interaction_events_d[interaction_events_a](interaction_events_DCL, installFirstInteractionListeners);
  }

}
// CONCATENATED MODULE: ./src/js/public/includes/elementor/device-mode.js
var device_mode_d = document;
var $deviceMode = device_mode_d.createElement('span');
$deviceMode.setAttribute('id', 'elementor-device-mode');
$deviceMode.setAttribute('class', 'elementor-screen-only');
var attached = false;
/* harmony default export */ var device_mode = (() => {
  if (!attached) {
    device_mode_d.body.appendChild($deviceMode);
  }

  return getComputedStyle($deviceMode, ':after').content.replace(/"/g, '');
});
// CONCATENATED MODULE: ./src/js/public/includes/elementor/animations.js



var animations_w = window;
var animations_d = document;
var de = animations_d.documentElement;
var animations_c =  true ? console.log : undefined;
var animations_ga = 'getAttribute';
var animations_sa = 'setAttribute';

var getClass = el => {
  return el[animations_ga]('class') || "";
};

var setClass = (el, value) => {
  return el[animations_sa]('class', value);
};

/* harmony default export */ var animations = (() => {
  window.addEventListener("load", function () {
    var mode = device_mode();
    var vw = Math.max(de.clientWidth || 0, animations_w.innerWidth || 0);
    var vh = Math.max(de.clientHeight || 0, animations_w.innerHeight || 0);
    var keys = ['_animation_' + mode, 'animation_' + mode, '_animation', '_animation', 'animation'];
    Array.from(animations_d.querySelectorAll('.elementor-invisible')).forEach(el => {
      // we  only want to optimize elements in the top of the page
      var viewportOffset = el.getBoundingClientRect();

      if (viewportOffset.top + animations_w.scrollY <= vh && viewportOffset.left + animations_w.scrollX < vw) {
        try {
          var settings = JSON.parse(el[animations_ga]('data-settings'));

          if (settings.trigger_source) {
            return;
          }

          var animationDelay = settings._animation_delay || settings.animation_delay || 0;
          var animation, key;

          for (var i = 0; i < keys.length; i++) {
            if (settings[keys[i]]) {
              key = keys[i];
              animation = settings[keys[i]];
              break;
            }
          }

          ;

          if (animation) {
             true && animations_c(delta(), 'animating with' + animation, el);
            var oldClass = getClass(el);
            var newClass = animation === 'none' ? oldClass : oldClass + ' animated ' + animation;

            var animate = () => {
              setClass(el, newClass.replace(/\belementor\-invisible\b/, ''));
              keys.forEach(key => delete settings[key]);
              el[animations_sa]('data-settings', JSON.stringify(settings));
            };

            var timeout = setTimeout(animate, animationDelay);
            dispatcher.on('fi', () => {
              clearTimeout(timeout);
              setClass(el, getClass(el).replace(new RegExp('\\b' + animation + '\\b'), ''));
            });
          }
        } catch (e) {
          console.error(e);
        }
      }
    });
  });
});
// CONCATENATED MODULE: ./src/js/public/includes/elementor/pp-menu.js


var pp_menu_d = document;
var pp_menu_c =  true ? console.log : undefined;
var pp_menu_ga = 'getAttribute';
var pp_menu_sa = 'setAttribute';
var qsa = 'querySelectorAll';
var inmega = 'data-in-mega_smartmenus';
/* harmony default export */ var pp_menu = (() => {
  var div = pp_menu_d.createElement('div');
  div.innerHTML = '<span class="sub-arrow --wp-meteor"><i class="fa" aria-hidden="true"></i></span>';
  var placeholder = div.firstChild;

  var prevAll = el => {
    var result = [];

    while (el = el.previousElementSibling) {
      result.push(el);
    }

    return result;
  };

  pp_menu_d.addEventListener("DOMContentLoaded", function () {
    Array.from(pp_menu_d[qsa]('.pp-advanced-menu ul')).forEach(ul => {
      /* skipping mega menues */
      if (ul[pp_menu_ga](inmega)) {
        return;
      } else if ((ul[pp_menu_ga]('class') || "").match(/\bmega\-menu\b/)) {
        ul[qsa]('ul').forEach(ul => {
          ul[pp_menu_sa](inmega, true);
        });
      }

      var prev = prevAll(ul);
      var a = prev.filter(el => el).filter(el => el.tagName === 'A').pop();

      if (!a) {
        a = prev.map(el => Array.from(el[qsa]('a'))).filter(el => el).flat().pop();
      }

      if (a) {
        var span = placeholder.cloneNode(true);
        a.appendChild(span);
        var observer = new MutationObserver(mutations => {
          mutations.forEach(_ref => {
            var {
              addedNodes
            } = _ref;
            addedNodes.forEach(node => {
              // For each added script tag
              if (node.nodeType === 1 && 'SPAN' === node.tagName) {
                try {
                  a.removeChild(span);
                } catch (_unused) {}
              }
            });
          });
        });
        observer.observe(a, {
          childList: true
        });
      }
    });
  });
});
// CONCATENATED MODULE: ./src/js/public/includes/utils/marketing.js

class marketing_Marketing {
  constructor(rest_url) {
    this.rest_url = rest_url;
  }

  init() {
    var detected = [];
    dispatcher.on('s', s => {
      if (s) {
        if (s.match(/js\/forms2\/js\/forms2.min.js/)) {
          detected.push('marketo');
        } else if (s.match(/js\.hsforms\.net\/forms\//)) {
          detected.push('hubspot');
        }
      }
    });
    dispatcher.on('l', () => {
      if (detected.length) {
        setTimeout(() => {
          var xhttp = new XMLHttpRequest();
          xhttp.open("POST", this.rest_url + 'wpmeteor/v1/detect/', true);
          xhttp.setRequestHeader("Content-Type", "application/json");
          xhttp.setRequestHeader("X-Requested-With", "XMLHttpRequest");
          xhttp.send(JSON.stringify({
            data: detected
          }));
        }, 20000);
      }
    });
  }

}
// CONCATENATED MODULE: ./src/js/public/public.js



 // import lazysizes from './includes/utils/lazysizes-core';
// import lazybg from './includes/utils/ls.bgset';




var public_DCL = 'DOMContentLoaded';
var RSC = 'readystatechange';
var M = 'message';
var public_separator = "----";
var S = 'SCRIPT';
var I = 'requestIdleCallback';
var N = null;
var public_c =  true ? console.log : undefined;
var ce = console.error;
var public_prefix = 'data-wpmeteor-';
var Object_defineProperty = Object.defineProperty;
var Object_defineProperties = Object.defineProperties;
var javascriptBlocked = 'javascript/blocked';
var isJavascriptRegexp = /^(text\/javascript|module)$/i;

(function (w, d, a, r, ga, sa, ra, ha, L, E) {
  var windowEventPrefix = w.constructor.name + '::';
  var documentEventPrefix = d.constructor.name + '::';

  var forEach = function forEach(callback, thisArg) {
    thisArg = thisArg || w;

    for (var i = 0; i < this.length; i++) {
      callback.call(thisArg, this[i], i, this);
    }
  };

  if ('NodeList' in w && !NodeList.prototype.forEach) {
     true && public_c("polyfilling NodeList.forEach");
    NodeList.prototype.forEach = forEach;
  }

  if ('HTMLCollection' in w && !HTMLCollection.prototype.forEach) {
     true && public_c("polyfilling HTMLCollection.forEach");
    HTMLCollection.prototype.forEach = forEach;
  }

  if (_wpmeteor['elementor-animations']) {
    animations();
  }

  if (_wpmeteor['elementor-pp']) {
    pp_menu();
  }

  var reorder = [];
  var delayed = [];
  var wheight = window.innerHeight || document.documentElement.clientHeight;
  var wwidth = window.innerWidth || document.documentElement.clientWidth;
  var DONE = false;
  var eventQueue = [];
  var listeners = {};
  var WindowLoaded = false;
  var firstInteractionFired = false;
  var firedEventsCount = 0;
  var rIC = w.requestIdleCallback || setTimeout;
  var nextTick = setTimeout;
  var createElementOverride;
  var capturedAttributes = ['src', 'async', 'defer', 'type', 'integrity'];
  /* Hack around 'avoid serving legacy javascript to modern browsers' */

  var O = Object,
      definePropert = 'definePropert';

  O[definePropert + 'y'] = (object, property, options) => {
    if (object === w && ['jQuery', 'onload'].indexOf(property) >= 0 || (object === d || object === d.body) && ['readyState', 'write', 'writeln', 'on' + RSC].indexOf(property) >= 0) {
      if (['on' + RSC, 'on' + L].indexOf(property) && options.set) {
        listeners['on' + RSC] = listeners['on' + RSC] || [];
        listeners['on' + RSC].push(options.set); // objectRedefinitions['onreadystatechange'] = options;
      } else {
         true && ce('Denied ' + (object.constructor || {}).name + ' ' + property + ' redefinition');
      }

      return object;
    } else if (object instanceof HTMLScriptElement && capturedAttributes.indexOf(property) >= 0) {
      if (!object[property + 'Getters']) {
        object[property + 'Getters'] = [];
        object[property + 'Setters'] = [];
        Object_defineProperty(object, property, {
          set(value) {
            object[property + 'Setters'].forEach(setter => setter.call(object, value));
          },

          get() {
            return object[property + 'Getters'].slice(-1)[0]();
          }

        });
      }

      if (options.get) {
        object[property + 'Getters'].push(options.get);
      }

      if (options.set) {
        object[property + 'Setters'].push(options.set);
      }

      return object;
    }

    return Object_defineProperty(object, property, options);
  };

  O[definePropert + 'ies'] = (object, properties) => {
    for (var _i in properties) {
      O[definePropert + 'y'](object, _i, properties[_i]);
    }

    return object;
  };

  if (true) {
    d[a](RSC, () => {
      public_c(delta(), public_separator, RSC, d.readyState);
    });
    d[a](public_DCL, () => {
      public_c(delta(), public_separator, public_DCL);
    });
    dispatcher.on('l', () => {
      public_c(delta(), public_separator, "L");
      public_c(delta(), public_separator, firedEventsCount + " queued events fired");
    });
    w[a](L, () => {
      public_c(delta(), public_separator, L);
    });
  }

  var marketing = new marketing_Marketing(_wpmeteor.rest_url);
  marketing.init();
  var origAddEventListener, origRemoveEventListener; // saving original methods

  var dOrigAddEventListener = d[a].bind(d);
  var dOrigRemoveEventListener = d[r].bind(d);
  var wOrigAddEventListener = w[a].bind(w);
  var wOrigRemoveEventListener = w[r].bind(w);

  if ("undefined" != typeof EventTarget) {
    origAddEventListener = EventTarget.prototype.addEventListener;
    origRemoveEventListener = EventTarget.prototype.removeEventListener; // saving original methods

    dOrigAddEventListener = origAddEventListener.bind(d);
    dOrigRemoveEventListener = origRemoveEventListener.bind(d);
    wOrigAddEventListener = origAddEventListener.bind(w);
    wOrigRemoveEventListener = origRemoveEventListener.bind(w);
  }

  var dOrigCreateElement = d.createElement.bind(d);

  var readyStateGetter = d.__proto__.__lookupGetter__('readyState').bind(d);

  var readyState;
  Object_defineProperty(d, 'readyState', {
    get() {
      return readyState ? readyState : readyStateGetter();
    },

    set(value) {
      return readyState = value;
    }

  });

  var hasUnfiredListeners = eventNames => {
    return eventQueue.filter((_ref, j) => {
      var [event, readyState, context] = _ref;

      if (eventNames.indexOf(event.type) < 0) {
        return;
      }

      if (!context) {
        context = event.target;
      }

      try {
        var name = context.constructor.name + '::' + event.type;

        for (var _i2 = 0; _i2 < listeners[name].length; _i2++) {
          if (listeners[name][_i2]) {
            var listenerKey = name + '::' + j + '::' + _i2;

            if (!firedListeners[listenerKey]) {
              return true;
            }
          }
        }
      } catch (e) {}
    }).length;
  };

  var currentlyFiredEvent;
  var firedListeners = {};

  var fireQueuedEvents = eventNames => {
    eventQueue.forEach((_ref2, j) => {
      var [event, readyState, context] = _ref2;

      if (eventNames.indexOf(event.type) < 0) {
        return;
      }

      if (!context) {
        context = event.target;
      }

      try {
        var name = context.constructor.name + '::' + event.type;

        if ((listeners[name] || []).length) {
          // listeners[name].forEach doesn't work as the listeners might be added 
          // during the loop
          for (var _i3 = 0; _i3 < listeners[name].length; _i3++) {
            var func = listeners[name][_i3];

            if (func) {
              // readystatechanges fires multiple time times on same 
              // listener with different readyState, accounting for that
              // const listenerKey = event === M 
              //     ? name + '::' + j + '::' + i + '::' + readyState
              //     : name + '::' + i + '::' + readyState;
              var listenerKey = name + '::' + j + '::' + _i3;

              if (!firedListeners[listenerKey]) {
                firedListeners[listenerKey] = true;
                d.readyState = readyState;
                currentlyFiredEvent = name;

                try {
                  firedEventsCount++;
                   true && public_c(delta(), 'firing ' + event.type + '(' + d.readyState + ') for', func.prototype ? func.prototype.constructor : func);

                  if (!func.hasOwnProperty('prototype') || func.prototype.constructor === func) {
                    func.bind(context)(event);
                  } else {
                    func(event);
                  }
                } catch (e) {
                  ce(e, func);
                }

                currentlyFiredEvent = null;
              }
            }
          }

          ;
        }
      } catch (e) {
        ce(e);
      }
    });
  };

  dOrigAddEventListener(public_DCL, e => {
     true && public_c(delta(), "enqueued document " + public_DCL);
    eventQueue.push([e, d.readyState, d]);
  });
  dOrigAddEventListener(RSC, e => {
     true && public_c(delta(), "enqueued document " + RSC);
    eventQueue.push([e, d.readyState, d]);
  });
  wOrigAddEventListener(public_DCL, e => {
     true && public_c(delta(), "enqueued window " + public_DCL);
    eventQueue.push([e, d.readyState, w]);
  });
  wOrigAddEventListener(L, e => {
     true && public_c(delta(), "enqueued window " + L);
    eventQueue.push([e, d.readyState, w]); // we must fire queued events for excluded scripts
    // if firstInteractionFired, then some scripts might have registered load event listeners
    // and they will be fired as well, which is invalid behaviour
    // https://wordpress.org/support/topic/meteor-blocks-contact-form-email/

    if (!iterating) fireQueuedEvents([public_DCL, RSC, M, L]);
  });

  var messageListener = e => {
     true && public_c(delta(), "enqueued window " + M);
    eventQueue.push([e, d.readyState, w]);
  }; // will be called inside iterate, right before dispatching 'l'


  var restoreMessageListener = () => {
    wOrigRemoveEventListener(M, messageListener); // restoring message listeners

    (listeners[windowEventPrefix + 'message'] || []).forEach(listener => {
      wOrigAddEventListener(M, listener);
    });
     true && public_c(delta(), "message listener restored");
  }; // removal will be inside iterate


  wOrigAddEventListener(M, messageListener); // there are two cases
  // 1. fi fires before window.load as a resut of user interaction
  // 2. window.load fires before fi - 3rd party scripts might trigger it manually

  dispatcher.on('fi', () => {
     true && public_c(delta(), public_separator, "starting iterating on first interaction");
    firstInteractionFired = true;
    iterating = true;
    mayBePreloadScripts();
    d.readyState = 'loading';
    nextTick(iterate); // starts the iteration
  });

  var startIterating = () => {
    WindowLoaded = true; // this might trigger L twice if iteration cycle hasn't finished yet
    // and it fires inside a cycle causing various side effects
    // double checking on that
    // Sometimes window.load fires after firstInteraction fired and
    // all the scrips were run, so we need to RESTART the iterate() cycle

    if (firstInteractionFired && !iterating) {
       true && public_c(delta(), public_separator, "starting iterating on window.load");
      d.readyState = 'loading';
      nextTick(iterate);
    }

    wOrigRemoveEventListener(L, startIterating);
  };

  wOrigAddEventListener(L, startIterating); // currently InteractionEvents listens for imagesloaded ('i') event, but if I get rid of it
  // then the order will matter - it is important to install InteractionEvents after window.load tracking setup

  new interaction_events_InteractionEvents().init(_wpmeteor.rdelay); // jQuery mock allows to trigger jQuery.ready early
  // because if we rely on native logics, the ready() listeners will fire after window.load

  var jQuery = new jquery_jQueryMock();
  jQuery.init();
  var scriptsToLoad = 1;

  var scriptLoaded = () => {
     true && public_c(delta(), "scriptLoaded", scriptsToLoad - 1);

    if (! --scriptsToLoad) {
      nextTick(dispatcher.emit.bind(dispatcher, 'l'));
    }
  };

  var i = 0;
  var iterating = false;

  var iterate = () => {
     true && public_c(delta(), 'it', i++, reorder.length);
    var element = reorder.shift();

    if (element) {
      // process.env.DEBUG && c(separator, "iterating", element, element.dataset);
      if (element[ga](public_prefix + 'src')) {
        if (element[ha](public_prefix + 'async')) {
           true && public_c(delta(), "async", scriptsToLoad, element);
          scriptsToLoad++;
          unblock(element, scriptLoaded);
          nextTick(iterate);
        } else {
          // process.env.DEBUG && c(delta(), "sync", element);
          unblock(element, nextTick.bind(null, iterate)); // iterate()
        }
      } else if (element.origtype == javascriptBlocked) {
        unblock(element); // allow inserted script to execute

        nextTick(iterate); // } else if (element[ha](prefix + "onload")) {
        //     const script = element[ga](prefix + "onload");
        //     try {
        //         (new Function(script)).call(element);
        //     } catch (e) {
        //         ce(e);
        //     }
        //     nextTick(iterate);
      } else {
        // it might be wrongfully processed script by backend, eg type="application/ld+json" 
        // and execution will stop here
         true && ce("running next iteration", element, element.origtype, element.origtype == javascriptBlocked);
        nextTick(iterate);
      }
    } else {
      // process.env.DEBUG && c('loaded all the scripts');
      // not restoring original addEventListener
      // to avoid unexpected failures, 
      // however, that triggers spurious handlers which were sleeping
      // d[a] = dOrigAddEventListener;
      if (hasUnfiredListeners([public_DCL, RSC, M])) {
        fireQueuedEvents([public_DCL, RSC, M]);
        nextTick(iterate);
      } else if (firstInteractionFired && WindowLoaded) {
        // techinally, firstInteractionFired should already be true
        // as cycle starts in 'fi' listener
        if (hasUnfiredListeners([L, M])) {
          fireQueuedEvents([L, M]);
          nextTick(iterate);
        } else if (scriptsToLoad > 1) {
           true && public_c(delta(), "waiting for", scriptsToLoad - 1, "more scripts to load", reorder);
          rIC(iterate);
        } else if (delayed.length) {
          while (delayed.length) {
            reorder.push(delayed.shift());
             true && public_c(delta(), "adding delayed script", reorder.slice(-1)[0]);
          }

          mayBePreloadScripts();
          nextTick(iterate);
        } else {
          // CloudFlare RocketLoader workaround
          if (w.RocketLazyLoadScripts) {
            try {
              RocketLazyLoadScripts.run();
            } catch (e) {
              ce(e);
            }
          }

          d.readyState = 'complete'; // restoring message listener here to avoid messages that can fall
          // in the gap before 'l' fires

          restoreMessageListener(); // restoring original jQuery.ready here to avoid calls that can fall
          // in the gap before 'l' fires

          jQuery.unmock(); // We can't restore original event listeners
          // because on slow connections, 3rd party scripts might be loaded late
          // and bind to window.load or anything else we track
          // documentAddEventListener = dOrigAddEventListener;
          // documentRemoveEventListener = dOrigRemoveEventListener;
          // windowAddEventListener = wOrigAddEventListener;
          // windowRemoveEventListener = wOrigRemoveEventListener;
          // process.env.DEBUG && c('running emulatedWindowLoaded');
          // technically, iterating = false is not needed
          // as the only place where it is checked is inside window.load
          // and here he has already fired as WindowLoaded === true

          iterating = false;
          DONE = true; // setTimeout(() => dispatcher.emit('l'));

          setTimeout(scriptLoaded);
        }
      } else {
        // exiting iterate() cycle in case window.load hasn't fired yet
        iterating = false;
      }
    }
  };

  var cloneScript = el => {
    var newElement = dOrigCreateElement(S);
    var attrs = el.attributes; // move attributes

    for (var i = attrs.length - 1; i >= 0; i--) {
      newElement[sa](attrs[i].name, attrs[i].value);
    }

    var type = el[ga](public_prefix + 'type'); // data-wpmeteor-type

    if (type) {
      newElement.type = type;
    } else {
      newElement.type = "text/javascript";
    } // CloudFlare RocketLoader workaround


    if ((el.textContent || "").match(/^\s*class RocketLazyLoadScripts/)) {
      newElement.textContent = el.textContent.replace(/^\s*class\s*RocketLazyLoadScripts/, 'window.RocketLazyLoadScripts=class').replace('RocketLazyLoadScripts.run();', '');
    } else {
      newElement.textContent = el.textContent;
    }

    ['after', 'type', 'src', 'async', 'defer'].forEach(postfix => newElement[ra](public_prefix + postfix));
    return newElement;
  };

  var replaceScript = (el, newElement) => {
    var parentNode = el.parentNode;

    if (parentNode) {
      // some scripts want parentNode to remove script themselves
      var newParent = document.createElement(parentNode.tagName);
      return newParent.appendChild(parentNode.replaceChild(newElement, el));
    }

    ce("No parent for", el);
  };

  var unblock = (el, callback) => {
    // const ds = el.dataset;
    var src = el[ga](public_prefix + 'src');

    if (src) {
       true && public_c(delta(), "unblocking src", src);
      var newElement = cloneScript(el);
      var addEventListener = origAddEventListener ? origAddEventListener.bind(newElement) : newElement[a].bind(newElement);

      if (el.getEventListeners) {
        el.getEventListeners().forEach(_ref3 => {
          var [event, listener] = _ref3;
           true && public_c(delta(), "re-adding event listeners to cloned element", event, listener);
          addEventListener(event, listener);
        });
      }

      if (callback) {
        addEventListener(L, callback);
        addEventListener(E, callback);
      } // addEventListener(E, e => ce(e)); // E = error


      newElement.src = src;
      var oldChild = replaceScript(el, newElement);
      var type = newElement[ga]("type");
       true && public_c(delta(), "unblocked src", src, newElement); // http://www.iana.org/assignments/media-types/media-types.xhtml
      // in fact only text/javascript is the right one, the rest is obsolete

      if ((!oldChild || el[ha]('nomodule') || type && !isJavascriptRegexp.test(type)) && callback) {
        // listeners won't fire
        // so have to trigger callback
        callback();
      }
    } else if (el.origtype === javascriptBlocked) {
      // onLoad is never passed here
       true && public_c(delta(), "unblocking inline", el);
      replaceScript(el, cloneScript(el));
       true && public_c(delta(), "unblocked inline", el);
    } else {
       true && ce(delta(), "already unblocked", el);

      if (callback) {
        callback();
      }
    }
  };

  var removeEventListener = (name, func) => {
    var pos = (listeners[name] || []).indexOf(func);

    if (pos >= 0) {
      listeners[name][pos] = undefined;
      return true;
    }
  };

  var documentAddEventListener = function documentAddEventListener(event, func) {
    for (var _len = arguments.length, args = new Array(_len > 2 ? _len - 2 : 0), _key = 2; _key < _len; _key++) {
      args[_key - 2] = arguments[_key];
    }

    if ('HTMLDocument::' + public_DCL == currentlyFiredEvent && event === public_DCL && !func.toString().match(/jQueryMock/)) {
      dispatcher.on('l', d.addEventListener.bind(d, event, func, ...args));
      return;
    }

    if (func && (event === public_DCL || event === RSC)) {
       true && public_c(delta(), "enqueuing event listener", event, func);
      var name = documentEventPrefix + event;
      listeners[name] = listeners[name] || [];
      listeners[name].push(func);

      if (DONE) {
        fireQueuedEvents([event]);
      }

      return;
    }

    return dOrigAddEventListener(event, func, ...args);
  };

  var documentRemoveEventListener = (event, func) => {
    if (event === public_DCL) {
      var name = documentEventPrefix + event;
      removeEventListener(name, func);
    }

    return dOrigRemoveEventListener(event, func);
  }; // some optimizers think they can optimize better than us
  // but it is not true as to 18 Jul 2021
  // so let's keep our handlers


  Object_defineProperties(d, {
    [a]: {
      get() {
        return documentAddEventListener;
      },

      set() {
        return documentAddEventListener;
      }

    },
    [r]: {
      get() {
        return documentRemoveEventListener;
      },

      set() {
        return documentRemoveEventListener;
      }

    }
  });
  var preconnects = {};

  var preconnect = src => {
    if (!src) return;

    try {
      if (src.match(/^\/\/\w+/)) src = d.location.protocol + src;
      var url = new URL(src);
      var href = url.origin;

      if (href && !preconnects[href] && d.location.host !== url.host) {
        var s = dOrigCreateElement('link');
        s.rel = 'preconnect';
        s.href = href;
        d.head.appendChild(s);
         true && public_c(delta(), 'preconnecting', url.origin);
        preconnects[href] = true;
      }
    } catch (e) {
       true && ce(delta(), "failed to parse src for preconnect", src);
    }
  };

  var preloads = {};

  var preloadAsScript = (src, isModule, crossorigin) => {
    var s = dOrigCreateElement('link');
    s.rel = isModule ? 'modulepre' + L : 'pre' + L;
    s.as = 'script';
    if (crossorigin) s[sa]('crossorigin', crossorigin); // must be setAttribute

    s.href = src;
    d.head.appendChild(s);
    preloads[src] = true;
     true && public_c(delta(), s.rel, src);
  };

  var mayBePreloadScripts = () => {
    if (_wpmeteor.preload) {
      reorder.forEach(script => {
        var src = script[ga](public_prefix + 'src');

        if (src && !script[ga](public_prefix + 'integrity') && !script[ha]('nomodule') && !preloads[src]) {
          preloadAsScript(src, script[ga](public_prefix + 'type') == 'module', script[ha]('crossorigin') && script[ga]('crossorigin'));
        }
      });
    }
  };

  dOrigAddEventListener(public_DCL, () => {
    d.querySelectorAll('script[' + public_prefix + 'after]').forEach(el => {
      var originalAttributeGetter = el.__lookupGetter__('type').bind(el);

      Object_defineProperty(el, 'origtype', {
        get() {
          return originalAttributeGetter();
        }

      });

      if ((el[ga](public_prefix + 'src') || "").match(/\/gtm.js\?/)) {
         true && public_c(delta(), 'delaying regex', el[ga](public_prefix + 'src'));
        delayed.push(el);
      } else if (el[ha](public_prefix + 'async')) {
         true && public_c(delta(), 'delaying async', el[ga](public_prefix + 'src'));
        delayed.unshift(el);
      } else {
        reorder.push(el);
      }
    }); // we will loose all event listeners, so we'd better track addEventListener/removeEventListener as well
    // not supported yet, cant find reference in backend
    // const querySelectors = ['link'].map(n => n + '[' + prefix + 'onload]').join(',');
    // d.querySelectorAll(querySelectors).forEach(el => reorder.push(el));
  });
  /* 3rd party scripts handling */

  var createElement = function createElement() {
    for (var _len2 = arguments.length, args = new Array(_len2), _key2 = 0; _key2 < _len2; _key2++) {
      args[_key2] = arguments[_key2];
    }

    var scriptElt = dOrigCreateElement(...args);

    if (args[0].toUpperCase() !== S || !iterating) {
      return scriptElt;
    }

     true && public_c(delta(), "creating script element"); // Backup the original setAttribute function

    var originalSetAttribute = scriptElt[sa].bind(scriptElt);
    var originalGetAttribute = scriptElt[ga].bind(scriptElt);
    var originalHasAttribute = scriptElt[ha].bind(scriptElt);
    originalSetAttribute(public_prefix + 'after', 'REORDER');
    originalSetAttribute(public_prefix + 'type', "text/javascript");
    scriptElt.type = javascriptBlocked;
    var eventListeners = [];

    scriptElt.getEventListeners = () => {
      return eventListeners;
    };

    O[definePropert + 'ies'](scriptElt, {
      'onload': {
        set(func) {
          // process.env.DEBUG && c(delta(), separator, 'setting ' + L + ' handler', func);
          eventListeners.push([L, func]);
        }

      },
      'onerror': {
        set(func) {
          // process.env.DEBUG && c(delta(), separator, 'setting ' + E + ' handler', func);
          eventListeners.push([E, func]);
        }

      }
    });
    capturedAttributes.forEach(property => {
      var originalAttributeGetter = scriptElt.__lookupGetter__(property).bind(scriptElt);

      O[definePropert + 'y'](scriptElt, property, {
        set(value) {
           true && public_c(delta(), "setting ", property, value);
          return value ? scriptElt[sa](public_prefix + property, value) : scriptElt[ra](public_prefix + property);
        },

        get() {
          return scriptElt[ga](public_prefix + property);
        }

      });
      Object_defineProperty(scriptElt, 'orig' + property, {
        get() {
          return originalAttributeGetter();
        }

      });
    });

    scriptElt[a] = function (event, handler) {
      eventListeners.push([event, handler]);
    }; // Monkey patch the setAttribute function so that the setter is called instead.
    // Otherwise, setAttribute('type', 'whatever') will bypass our custom descriptors!


    scriptElt[sa] = function (property, value) {
      if (capturedAttributes.indexOf(property) >= 0) {
         true && public_c(delta(), "setting attribute ", property, value);
        return value ? originalSetAttribute(public_prefix + property, value) : scriptElt[ra](public_prefix + property);
      } else {
        originalSetAttribute(property, value);
      }
    };

    scriptElt[ga] = function (property) {
      return capturedAttributes.indexOf(property) >= 0 ? originalGetAttribute(public_prefix + property) : originalGetAttribute(property);
    };

    scriptElt[ha] = function (property) {
      return capturedAttributes.indexOf(property) >= 0 ? originalHasAttribute(public_prefix + property) : originalHasAttribute(property);
    };
    /* very shallow mocking of NamedNodeMap */


    var attributes = scriptElt.attributes;
    Object_defineProperty(scriptElt, 'attributes', {
      get() {
        var mock = [...attributes].filter(attr => attr.name !== 'type' && attr.name !== public_prefix + 'after').map(attr => {
          return {
            name: attr.name.match(new RegExp(public_prefix)) ? attr.name.replace(public_prefix, '') : attr.name,
            value: attr.value
          };
        });
        return mock;
      }

    });
    return scriptElt;
  }; // Allowing to override, but still not the best option - onetrust captures createElement 
  // even for users who accepted cookies


  Object.defineProperty(d, 'createElement', {
    set(value) {
      if (true) {
        if (value == dOrigCreateElement) {
           true && public_c(delta(), "document.createElement restored to original");
        } else if (value === createElement) {
           true && public_c(delta(), "document.createElement overridden");
        } else {
           true && public_c(delta(), "document.createElement overridden by a 3rd party script");
        }
      }

      if (value !== createElement) {
        createElementOverride = value;
      }
    },

    get() {
      return createElementOverride || createElement;
    }

  });
  var seenScripts = [];
  var observer = new MutationObserver(mutations => {
    if (iterating) {
      mutations.forEach(_ref4 => {
        var {
          addedNodes,
          target
        } = _ref4;
        addedNodes.forEach(node => {
          // For each added script tag
          if (node.nodeType === 1) {
            if (S === node.tagName) {
              if ('REORDER' === node[ga](public_prefix + 'after') && (!node[ga](public_prefix + 'type') || isJavascriptRegexp.test(node[ga](public_prefix + 'type')))) {
                 true && public_c(delta(), "captured new script", node.cloneNode(true), node);
                var src = node[ga](public_prefix + 'src');

                if (seenScripts.filter(n => n === node).length) {
                  ce('Inserted twice', node);
                }

                if (node.parentNode) {
                  seenScripts.push(node);

                  if ((src || "").match(/\/gtm.js\?/)) {
                     true && public_c(delta(), 'delaying regex', node[ga](public_prefix + 'src'));
                    delayed.push(node);
                    preconnect(src);
                  } else if (node[ha](public_prefix + 'async')) {
                     true && public_c(delta(), 'delaying async', node[ga](public_prefix + 'src'));
                    delayed.unshift(node);
                    preconnect(src);
                  } else {
                    if (src && reorder.length && !node[ga](public_prefix + 'integrity') && !node[ha]('nomodule') && !preloads[src]) {
                      // no need to preload if it is the next script in the queue
                      // VWO removes node instantly
                      // preloading 
                      if (reorder.length) {
                        public_c(delta(), 'pre preload', reorder.length);
                        preloadAsScript(src, node[ga](public_prefix + 'type') == 'module', node[ha]('crossorigin') && node[ga]('crossorigin'));
                      }
                    }

                    reorder.push(node);
                  }
                } else {
                  // if the node has been instanly removed, we still want to load it and run
                  // I tested appendNode(script); removeNode(script) - it still loads and triggers the code
                   true && ce('No parent node for', node, "re-adding to", target);
                  node.addEventListener(L, e => e.target.parentNode.removeChild(e.target));
                  node.addEventListener(E, e => e.target.parentNode.removeChild(e.target));
                  target.appendChild(node); // no need to push to seenScripts and reorder as it will happen on the next iteration
                  // of MutationObserver
                }
              } else {
                 true && public_c(delta(), "captured unmodified or non-javascript script", node.cloneNode(true), node);
                dispatcher.emit('s', node.src);
              }
            } else if ("LINK" === node.tagName && node[ga]('as') === 'script') {
              preloads[node[ga]('href')] = true;
            }
          }
        }); // /* attribute mutations */
        // if (type === 'attributes' && target.nodeType === 1 && S === target.tagName) {
        //     // console.log("mutation type", target.cloneNode(true), mutations);
        //     console.log("attribute mutation", target.cloneNode(true), attributeName, "new " + target[ga](attributeName),  "old " + oldValue)
        //     if ('REORDER' === target[ga](prefix + 'after') && (!target[ga](prefix + 'type') || target[ga](prefix + 'type').indexOf('script') >= 0)) {
        //         process.env.DEBUG && c(delta(), "captured updated script", target.cloneNode(true), target);
        //         const src = target[ga](prefix + 'src')
        //         if (!seenScripts.filter(n => n === target).length) {
        //             seenScripts.push(target);
        //         }
        //         if ((target[ga](prefix + 'src') || "").match(/\/gtm.js\?/)) {
        //             process.env.DEBUG && c(delta(), 'delaying regex', target[ga](prefix + 'src'));
        //             delayed.push(target)
        //         } else if (target[ha](prefix + 'async')) {
        //             process.env.DEBUG && c(delta(), 'delaying async', target[ga](prefix + 'src'));
        //             delayed.unshift(target)
        //         } else {
        //             if (src && reorder.length && !target[ga](prefix + 'integrity') && !target[ha]('nomodule') && !preloads[src]) {
        //                 // no need to preload if it is the next script in the queue
        //                 // VWO removes node instantly
        //                 // preloading 
        //                 // if (reorder.length)
        //                 //     preloadAsScript(src, node[ga](prefix + 'type') == 'module');
        //             }
        //             reorder.push(target)
        //         }
        //     }
        // }
      });
    }
  });
  observer.observe(d.documentElement, {
    childList: true,
    subtree: true,
    attributes: true,
    // attributeFilter: ['src', 'type'],
    attributeOldValue: true
  }); // cleaning up

  dispatcher.on('l', () => {
    if (!createElementOverride || createElementOverride === createElement) {
      d.createElement = dOrigCreateElement;
      observer.disconnect();
    } else {
       true && public_c(delta(), 'createElement is overridden, keeping observers in place');
    }
  });
  /* end 3rd party scripts handling */

  /* we have to override document.write as all of them will fire after DOMContentLoaded */

  var documentWrite = str => {
    var parent, currentScript;

    if (!d.currentScript || !d.currentScript.parentNode) {
      /* trying our best */
      parent = d.body;
      currentScript = parent.lastChild;
    } else {
      currentScript = d.currentScript;
      parent = currentScript.parentNode;
    }

    try {
      var df = dOrigCreateElement('div');
      df.innerHTML = str;
      Array.from(df.childNodes).forEach(node => {
        if (node.nodeName === S) {
          // cloneScript is a must for safari
          parent.insertBefore(cloneScript(node), currentScript);
        } else {
          parent.insertBefore(node, currentScript);
        }
      });
    } catch (e) {
      ce(e);
    }
  };

  var documentWriteLn = str => documentWrite(str + "\n");

  Object_defineProperties(d, {
    'write': {
      get() {
        return documentWrite;
      },

      set(func) {
        return documentWrite = func;
      }

    },
    'writeln': {
      get() {
        return documentWriteLn;
      },

      set(func) {
        return documentWriteLn = func;
      }

    }
  }); // Capturing and queueing Window Load event handlers

  var windowAddEventListener = function windowAddEventListener(event, func) {
    for (var _len3 = arguments.length, args = new Array(_len3 > 2 ? _len3 - 2 : 0), _key3 = 2; _key3 < _len3; _key3++) {
      args[_key3 - 2] = arguments[_key3];
    }

    // We have to skip registering message listeners if DONE, as we already restored 
    // original eventListener to messages in restoreMessageListener()
    if ('Window::' + public_DCL == currentlyFiredEvent && event === public_DCL && !func.toString().match(/jQueryMock/)) {
      dispatcher.on('l', w.addEventListener.bind(w, event, func, ...args));
      return;
    }

    if ('Window::' + L == currentlyFiredEvent && event === L) {
      dispatcher.on('l', w.addEventListener.bind(w, event, func, ...args));
      return;
    }

    if (func && (event === L || event === public_DCL || event === M && !DONE)) {
       true && public_c(delta(), "enqueuing event listener", event, func);
      var name = event === public_DCL ? documentEventPrefix + event : windowEventPrefix + event;
      listeners[name] = listeners[name] || [];
      listeners[name].push(func);

      if (DONE) {
        fireQueuedEvents([event]);
      }

      return;
    } // process.env.DEBUG && c(event, func);


    return wOrigAddEventListener(event, func, ...args);
  };

  var windowRemoveEventListener = (event, func) => {
    if (event === L) {
      // L = load
      var name = event === public_DCL ? documentEventPrefix + event : windowEventPrefix + event;
      removeEventListener(name, func);
    }

    return wOrigRemoveEventListener(event, func);
  }; // some optimizers think they can optimize better than us
  // but it is not true as to 18 Jul 2021
  // so let's keep our handlers


  Object_defineProperties(w, {
    [a]: {
      get() {
        return windowAddEventListener;
      },

      set() {
        return windowAddEventListener;
      }

    },
    [r]: {
      get() {
        return windowRemoveEventListener;
      },

      set() {
        return windowRemoveEventListener;
      }

    }
  });

  var onHandlerOptions = name => {
    var handler;
    return {
      get() {
         true && public_c(delta(), public_separator, 'getting ' + name.toLowerCase().replace(/::/, '.') + ' handler', handler);
        return handler;
      },

      set(func) {
         true && public_c(delta(), public_separator, 'setting ' + name.toLowerCase().replace(/::/, '.') + ' handler', func); // only last handler should fire

        if (handler) {
          removeEventListener(name, func);
        }

        listeners[name] = listeners[name] || [];
        listeners[name].push(func);
        return handler = func;
      } // rocket-loader from CloudFlare tries to override onload so we will let him
      // configurable: true,


    };
  };

  dOrigAddEventListener('wpl', e => {
    var {
      target,
      event
    } = e.detail;
    var el = target == w ? d.body : target;
    var func = el[ga](public_prefix + 'on' + event.type);
    el[ra](public_prefix + 'on' + event.type);
    Object_defineProperty(event, 'target', {
      value: target
    });
    Object_defineProperty(event, 'currentTarget', {
      value: target
    });
    var f = new Function(func).bind(target);
    target.event = event; // the trick here is to fire Window::load on the second run of iterate()
    // as the first one fires exactly right when the window.load fires,
    // second fires when javascript is ready

    w[a](L, w[a].bind(w, L, f));
  }); // overriding window.onload and document.body.onload, they are the same function

  {
    var options = onHandlerOptions(windowEventPrefix + L);
    Object_defineProperty(w, 'onload', options);
    dOrigAddEventListener(public_DCL, () => {
      Object_defineProperty(d.body, 'onload', options);
    });
  }
  ; // overriding document.onreadystatechange

  Object_defineProperty(d, 'onreadystatechange', onHandlerOptions(documentEventPrefix + RSC)); // overriding window.onmessage

  Object_defineProperty(w, 'onmessage', onHandlerOptions(windowEventPrefix + M));

  if ( true && location.search.match(/wpmeteorperformance/)) {
    try {
      new PerformanceObserver(entryList => {
        for (var entry of entryList.getEntries()) {
          public_c(delta(), 'LCP candidate:', entry.startTime, entry);
        }
      }).observe({
        type: 'largest-contentful-paint',
        buffered: true
      });
      new PerformanceObserver(list => {
        list.getEntries().forEach(e => public_c(delta(), "resource loaded", e.name, e));
      }).observe({
        type: 'resource'
      }); // buffered to detect loading 
    } catch (e) {}
  }

  var intersectsViewport = el => {
    // chrome settings
    // https://web.dev/browser-level-image-lazy-loading/#improved-data-savings-and-distance-from-viewport-thresholds
    var extras = {
      '4g': 1250,
      '3g': 2500,
      '2g': 2500
    };
    var extra = extras[(navigator.connection || {}).effectiveType] || 0;
    var rect = el.getBoundingClientRect();
    var viewport = {
      top: -1 * wheight - extra,
      left: -1 * wwidth - extra,
      bottom: wheight + extra,
      right: wwidth + extra
    }; // If one rectangle is on left side of other

    if (rect.left >= viewport.right || rect.right <= viewport.left) return false; // If one rectangle is above other

    if (rect.top >= viewport.bottom || rect.bottom <= viewport.top) return false;
    return true;
  };

  var waitForImages = function waitForImages() {
    var reallyWait = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : true;
    var imagesToLoad = 1;
    var imagesLoadedCount = -1;
    var seen = {};

    var imageLoadedHandler = e => {
      imagesLoadedCount++; // let's trigger 

      if (! --imagesToLoad) {
         true && public_c(delta(), imagesLoadedCount + " eager images loaded");
        nextTick(dispatcher.emit.bind(dispatcher, 'i'), _wpmeteor.rdelay);
      }
    };

    Array.from(d.getElementsByTagName('*')).forEach(tag => {
      var src, style, bgUrl;

      if (tag.tagName === 'IMG') {
        var _src = tag.currentSrc || tag.src; // trying to capture srcsets if they are already loading


        if (_src && !seen[_src] && !_src.match(/^data:/i)) {
          if ((tag.loading || "").toLowerCase() !== 'lazy') {
            src = _src;
             true && public_c(delta(), "loading image", src, 'for', tag);
          } else if (intersectsViewport(tag)) {
            // lazy && already loading
            src = _src;
             true && public_c(delta(), "loading lazy image", src, 'for', tag);
          }
        }
      } else if (tag.tagName === S) {
        preconnect(tag[ga](public_prefix + 'src'));
      } else if (tag.tagName === 'LINK' && tag[ga]('as') === 'script' && ['pre' + L, 'modulepre' + L].indexOf(tag[ga]('rel')) >= 0) {
        preloads[tag[ga]('href')] = true; // supposedly all CSS has already been loaded
      } else if ((style = w.getComputedStyle(tag)) && (bgUrl = (style.backgroundImage || "").match(/^url\s*\((.*?)\)/i)) && (bgUrl || []).length) {
        var url = bgUrl[0].slice(4, -1).replace(/"/g, "");

        if (!seen[url] && !url.match(/^data:/i)) {
          src = url;
           true && public_c(delta(), "loading background", src, 'for', tag);
        }
      }

      if (src) {
        seen[src] = true;
        var temp = new Image();

        if (reallyWait) {
          imagesToLoad++;
          temp[a](L, imageLoadedHandler);
          temp[a](E, imageLoadedHandler);
        }

        temp.src = src;
      }
    });
    d.fonts.ready.then(() => {
       true && public_c(delta(), "fonts ready");
      imageLoadedHandler();
    });
  };

  if (_wpmeteor.rdelay < 0) {
    dOrigAddEventListener(public_DCL, d.dispatchEvent.bind(d, new CustomEvent('i')));
    dOrigAddEventListener(public_DCL, dispatcher.emit.bind(dispatcher, 'i'));
  } else if (_wpmeteor.rdelay === 0) {
    dOrigAddEventListener(public_DCL, () => nextTick(waitForImages.bind(null, false)));
  } else {
    wOrigAddEventListener(L, waitForImages);
  }
  /*
  const origXMLHttpRequestSend = XMLHttpRequest.prototype.send;
  const xmlXMLHttpRequestQueue = [];
  XMLHttpRequest.prototype.send = function (data) {
      process.env.DEBUG && c(delta(), 'Enqueueing XMLHttpRequest', data);
      xmlXMLHttpRequestQueue.push([this, data]);
  }
  dispatcher.on('l', () => {
      xmlXMLHttpRequestQueue.forEach(([obj, data]) => {
          process.env.DEBUG && c(delta(), 'Sending queued XMLHttpRequest', obj, data);
          origXMLHttpRequestSend.call(obj, data);
      });
      // XMLHttpRequest.prototype.send = origXMLHttpRequestSend;
  });
  */

})(window, document, 'addEventListener', 'removeEventListener', 'getAttribute', 'setAttribute', 'removeAttribute', 'hasAttribute', 'load', 'error');

/***/ })
/******/ ]);
//# sourceMappingURL=public-debug.js.map