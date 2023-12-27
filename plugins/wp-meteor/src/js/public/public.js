import jQueryMock from './includes/mocks/jquery';
import InteractionEvents from './includes/utils/interaction-events';
import dispatcher from './includes/utils/dispatcher';
import delta from './includes/utils/delta';
// import lazysizes from './includes/utils/lazysizes-core';
// import lazybg from './includes/utils/ls.bgset';
import elementorAnimations from './includes/elementor/animations';
import elementorPP from './includes/elementor/pp-menu';
import Marketing from './includes/utils/marketing';

const DCL = 'DOMContentLoaded';
const RSC = 'readystatechange';
const M = 'message';
const separator = "----";
const S = 'SCRIPT';
const I = 'requestIdleCallback';
const N = null;
const c = process.env.DEBUG ? console.log : () => { };
const ce = console.error;
const prefix = 'data-wpmeteor-';
const Object_defineProperty = Object.defineProperty;
const Object_defineProperties = Object.defineProperties;
const javascriptBlocked = 'javascript/blocked';
const isJavascriptRegexp = /^(text\/javascript|module)$/i;

(function (w, d, a, r, ga, sa, ra, ha, L, E) {

    const windowEventPrefix = w.constructor.name + '::';
    const documentEventPrefix = d.constructor.name + '::';

    const forEach = function (callback, thisArg) {
        thisArg = thisArg || w;
        for (var i = 0; i < this.length; i++) {
            callback.call(thisArg, this[i], i, this);
        }
    }

    if ('NodeList' in w && !NodeList.prototype.forEach) {
        process.env.DEBUG && c("polyfilling NodeList.forEach");
        NodeList.prototype.forEach = forEach;
    }
    if ('HTMLCollection' in w && !HTMLCollection.prototype.forEach) {
        process.env.DEBUG && c("polyfilling HTMLCollection.forEach");
        HTMLCollection.prototype.forEach = forEach;
    }

    if (_wpmeteor['elementor-animations']) {
        elementorAnimations();
    }

    if (_wpmeteor['elementor-pp']) {
        elementorPP();
    }

    const reorder = [];
    const delayed = [];

    const wheight = window.innerHeight || document.documentElement.clientHeight;
    const wwidth = window.innerWidth || document.documentElement.clientWidth;

    let DONE = false;
    let eventQueue = [];
    let listeners = {};
    let WindowLoaded = false;
    let firstInteractionFired = false;
    let firedEventsCount = 0;

    const rIC = w.requestIdleCallback || setTimeout;
    const nextTick = setTimeout;

    let createElementOverride;
    const capturedAttributes = ['src', 'async', 'defer', 'type', 'integrity'];

    /* Hack around 'avoid serving legacy javascript to modern browsers' */
    const O = Object,
        definePropert = 'definePropert';
    O[definePropert + 'y'] = (object, property, options) => {
        if (object === w && (['jQuery', 'onload'].indexOf(property) >= 0)
            || (object === d || object === d.body) && ['readyState', 'write', 'writeln', 'on' + RSC].indexOf(property) >= 0) {
            if (['on' + RSC, 'on' + L].indexOf(property) && options.set) {
                listeners['on' + RSC] = listeners['on' + RSC] || [];
                listeners['on' + RSC].push(options.set);
                // objectRedefinitions['onreadystatechange'] = options;
            } else {
                process.env.DEBUG && ce('Denied ' + (object.constructor || {}).name + ' ' + property + ' redefinition');
            }
            return object;
        } else if ((object instanceof HTMLScriptElement) && capturedAttributes.indexOf(property) >= 0) {
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
                })
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
    }

    O[definePropert + 'ies'] = (object, properties) => {
        for (let i in properties) {
            O[definePropert + 'y'](object, i, properties[i]);
        }
        return object;
    };

    if (process.env.DEBUG) {
        d[a](RSC, () => {
            c(delta(), separator, RSC, d.readyState);
        });

        d[a](DCL, () => {
            c(delta(), separator, DCL);
        });

        dispatcher.on('l', () => {
            c(delta(), separator, "L");
            c(delta(), separator, firedEventsCount + " queued events fired");
        });

        w[a](L, () => {
            c(delta(), separator, L);
        });
    }

    const marketing = new Marketing(_wpmeteor.rest_url);
    marketing.init();

    let origAddEventListener, origRemoveEventListener;

    // saving original methods
    let dOrigAddEventListener = d[a].bind(d);
    let dOrigRemoveEventListener = d[r].bind(d);
    let wOrigAddEventListener = w[a].bind(w);
    let wOrigRemoveEventListener = w[r].bind(w);

    if ("undefined" != typeof EventTarget) {
        origAddEventListener = EventTarget.prototype.addEventListener;
        origRemoveEventListener = EventTarget.prototype.removeEventListener;
        // saving original methods
        dOrigAddEventListener = origAddEventListener.bind(d);
        dOrigRemoveEventListener = origRemoveEventListener.bind(d);
        wOrigAddEventListener = origAddEventListener.bind(w);
        wOrigRemoveEventListener = origRemoveEventListener.bind(w);
    }
    const dOrigCreateElement = d.createElement.bind(d);
    const readyStateGetter = d.__proto__.__lookupGetter__('readyState').bind(d);

    let readyState;
    Object_defineProperty(d, 'readyState', {
        get() { return readyState ? readyState : readyStateGetter() },
        set(value) { return readyState = value },
    });

    const hasUnfiredListeners = (eventNames) => {
        return eventQueue.filter(([event, readyState, context], j) => {
            if (eventNames.indexOf(event.type) < 0) {
                return;
            }
            if (!context) {
                context = event.target;
            }
            try {
                const name = context.constructor.name + '::' + event.type;
                for (let i = 0; i < listeners[name].length; i++) {
                    if (listeners[name][i]) {
                        const listenerKey = name + '::' + j + '::' + i;
                        if (!firedListeners[listenerKey]) {
                            return true;
                        }
                    }
                }
            } catch (e) {
            }
        }).length;
    }

    let currentlyFiredEvent;
    const firedListeners = {}
    const fireQueuedEvents = (eventNames) => {
        eventQueue.forEach(([event, readyState, context], j) => {
            if (eventNames.indexOf(event.type) < 0) {
                return;
            }
            if (!context) {
                context = event.target;
            }
            try {
                const name = context.constructor.name + '::' + event.type;
                if ((listeners[name] || []).length) {
                    // listeners[name].forEach doesn't work as the listeners might be added 
                    // during the loop
                    for (let i = 0; i < listeners[name].length; i++) {
                        const func = listeners[name][i];
                        if (func) {
                            // readystatechanges fires multiple time times on same 
                            // listener with different readyState, accounting for that
                            // const listenerKey = event === M 
                            //     ? name + '::' + j + '::' + i + '::' + readyState
                            //     : name + '::' + i + '::' + readyState;
                            const listenerKey = name + '::' + j + '::' + i;
                            if (!firedListeners[listenerKey]) {
                                firedListeners[listenerKey] = true;
                                d.readyState = readyState;
                                currentlyFiredEvent = name;
                                try {
                                    firedEventsCount++;
                                    process.env.DEBUG && c(delta(), 'firing ' + event.type + '(' + d.readyState + ') for', func.prototype ? func.prototype.constructor : func);
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
                    };
                }
            } catch (e) {
                ce(e);
            }
        });
    }

    dOrigAddEventListener(DCL, (e) => {
        process.env.DEBUG && c(delta(), "enqueued document " + DCL);
        eventQueue.push([e, d.readyState, d])
    });
    dOrigAddEventListener(RSC, (e) => {
        process.env.DEBUG && c(delta(), "enqueued document " + RSC);
        eventQueue.push([e, d.readyState, d])
    });
    wOrigAddEventListener(DCL, (e) => {
        process.env.DEBUG && c(delta(), "enqueued window " + DCL);
        eventQueue.push([e, d.readyState, w])
    });
    wOrigAddEventListener(L, (e) => {
        process.env.DEBUG && c(delta(), "enqueued window " + L);
        eventQueue.push([e, d.readyState, w]);
        // we must fire queued events for excluded scripts
        // if firstInteractionFired, then some scripts might have registered load event listeners
        // and they will be fired as well, which is invalid behaviour
        // https://wordpress.org/support/topic/meteor-blocks-contact-form-email/
        if (!iterating)
            fireQueuedEvents([DCL, RSC, M, L]);
    });
    const messageListener = (e) => {
        process.env.DEBUG && c(delta(), "enqueued window " + M);
        eventQueue.push([e, d.readyState, w]);
    }
    // will be called inside iterate, right before dispatching 'l'
    const restoreMessageListener = () => {
        wOrigRemoveEventListener(M, messageListener);
        // restoring message listeners
        (listeners[windowEventPrefix + 'message'] || []).forEach(listener => {
            wOrigAddEventListener(M, listener);
        });
        process.env.DEBUG && c(delta(), "message listener restored");
    }
    // removal will be inside iterate
    wOrigAddEventListener(M, messageListener);

    // there are two cases
    // 1. fi fires before window.load as a resut of user interaction
    // 2. window.load fires before fi - 3rd party scripts might trigger it manually
    dispatcher.on('fi', () => {
        process.env.DEBUG && c(delta(), separator, "starting iterating on first interaction");
        firstInteractionFired = true;
        iterating = true;
        mayBePreloadScripts();
        d.readyState = 'loading';
        nextTick(iterate); // starts the iteration
    });

    const startIterating = () => {
        WindowLoaded = true;
        // this might trigger L twice if iteration cycle hasn't finished yet
        // and it fires inside a cycle causing various side effects
        // double checking on that
        // Sometimes window.load fires after firstInteraction fired and
        // all the scrips were run, so we need to RESTART the iterate() cycle
        if (firstInteractionFired && !iterating) {
            process.env.DEBUG && c(delta(), separator, "starting iterating on window.load");
            d.readyState = 'loading';
            nextTick(iterate);
        }
        wOrigRemoveEventListener(L, startIterating);
    }
    wOrigAddEventListener(L, startIterating);

    // currently InteractionEvents listens for imagesloaded ('i') event, but if I get rid of it
    // then the order will matter - it is important to install InteractionEvents after window.load tracking setup
    (new InteractionEvents()).init(_wpmeteor.rdelay);
    // jQuery mock allows to trigger jQuery.ready early
    // because if we rely on native logics, the ready() listeners will fire after window.load
    const jQuery = new jQueryMock();
    jQuery.init();

    let scriptsToLoad = 1;
    const scriptLoaded = () => {
        process.env.DEBUG && c(delta(), "scriptLoaded", scriptsToLoad - 1);
        if (!--scriptsToLoad) {
            nextTick(dispatcher.emit.bind(dispatcher, 'l'));
        }
    }

    let i = 0;
    let iterating = false;
    const iterate = () => {
        process.env.DEBUG && c(delta(), 'it', i++, reorder.length);
        const element = reorder.shift();
        if (element) {
            // process.env.DEBUG && c(separator, "iterating", element, element.dataset);
            if (element[ga](prefix + 'src')) {
                if (element[ha](prefix + 'async')) {
                    process.env.DEBUG && c(delta(), "async", scriptsToLoad, element);
                    scriptsToLoad++;
                    unblock(element, scriptLoaded);
                    nextTick(iterate);
                } else {
                    // process.env.DEBUG && c(delta(), "sync", element);
                    unblock(element, nextTick.bind(null, iterate));
                    // iterate()
                }
            } else if (element.origtype == javascriptBlocked) {
                unblock(element);
                // allow inserted script to execute
                nextTick(iterate);
            // } else if (element[ha](prefix + "onload")) {
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
                process.env.DEBUG && ce("running next iteration", element, element.origtype, element.origtype == javascriptBlocked);
                nextTick(iterate);
            }
        } else {
            // process.env.DEBUG && c('loaded all the scripts');
            // not restoring original addEventListener
            // to avoid unexpected failures, 
            // however, that triggers spurious handlers which were sleeping
            // d[a] = dOrigAddEventListener;
            if (hasUnfiredListeners([DCL, RSC, M])) {
                fireQueuedEvents([DCL, RSC, M]);
                nextTick(iterate);
            } else if (firstInteractionFired && WindowLoaded) {
                // techinally, firstInteractionFired should already be true
                // as cycle starts in 'fi' listener
                if (hasUnfiredListeners([L, M])) {
                    fireQueuedEvents([L, M]);
                    nextTick(iterate);
                } else if (scriptsToLoad > 1) {
                    process.env.DEBUG && c(delta(), "waiting for", scriptsToLoad - 1, "more scripts to load", reorder);
                    rIC(iterate);
                } else if (delayed.length) {
                    while(delayed.length) {
                        reorder.push(delayed.shift());
                        process.env.DEBUG && c(delta(), "adding delayed script", reorder.slice(-1)[0]);
                    }
                    mayBePreloadScripts();
                    nextTick(iterate);
                } else {
                    // CloudFlare RocketLoader workaround
                    if (w.RocketLazyLoadScripts) {
                        try {
                            RocketLazyLoadScripts.run();
                        } catch(e) {
                            ce(e);
                        }
                    }
                    d.readyState = 'complete';

                    // restoring message listener here to avoid messages that can fall
                    // in the gap before 'l' fires
                    restoreMessageListener();

                    // restoring original jQuery.ready here to avoid calls that can fall
                    // in the gap before 'l' fires
                    jQuery.unmock();

                    // We can't restore original event listeners
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
                    DONE = true;

                    // setTimeout(() => dispatcher.emit('l'));
                    setTimeout(scriptLoaded);
                }
            } else {
                // exiting iterate() cycle in case window.load hasn't fired yet
                iterating = false;
            }
        }
    };

    const cloneScript = (el) => {

        const newElement = dOrigCreateElement(S);

        const attrs = el.attributes;

        // move attributes
        for (var i = attrs.length - 1; i >= 0; i--) {
            newElement[sa](attrs[i].name, attrs[i].value);
        }

        const type = el[ga](prefix + 'type'); // data-wpmeteor-type
        if (type) {
            newElement.type = type; 
        } else {
            newElement.type = "text/javascript";
        }

        // CloudFlare RocketLoader workaround
        if ((el.textContent || "").match(/^\s*class RocketLazyLoadScripts/)) {
            newElement.textContent = el.textContent.replace(/^\s*class\s*RocketLazyLoadScripts/, 'window.RocketLazyLoadScripts=class').replace('RocketLazyLoadScripts.run();','');
        } else {
            newElement.textContent = el.textContent
        }

        ['after', 'type', 'src', 'async', 'defer'].forEach(postfix => newElement[ra](prefix + postfix));

        return newElement;
    }

    const replaceScript = (el, newElement) => {
        const parentNode = el.parentNode;
        if (parentNode) {
            // some scripts want parentNode to remove script themselves
            const newParent = document.createElement(parentNode.tagName);
            return  newParent.appendChild(parentNode.replaceChild(newElement, el));
        }
        ce("No parent for", el);
    }

    const unblock = (el, callback) => {
        // const ds = el.dataset;
        const src = el[ga](prefix + 'src');
        if (src) {
            process.env.DEBUG && c(delta(), "unblocking src", src);
            const newElement = cloneScript(el);

            const addEventListener = origAddEventListener
                ? origAddEventListener.bind(newElement)
                : newElement[a].bind(newElement);

            if (el.getEventListeners) {
                el.getEventListeners().forEach(([event, listener]) => {
                    process.env.DEBUG && c(delta(), "re-adding event listeners to cloned element", event, listener);
                    addEventListener(event, listener);
                });
            }

            if (callback) {
                addEventListener(L, callback);
                addEventListener(E, callback);
            }

            // addEventListener(E, e => ce(e)); // E = error
            newElement.src = src;
            const oldChild = replaceScript(el, newElement);
            const type = newElement[ga]("type");
            process.env.DEBUG && c(delta(), "unblocked src", src, newElement);
            // http://www.iana.org/assignments/media-types/media-types.xhtml
            // in fact only text/javascript is the right one, the rest is obsolete
            if ((!oldChild || el[ha]('nomodule') || (type && !isJavascriptRegexp.test(type))) && callback) {
                // listeners won't fire
                // so have to trigger callback
                callback();
            }
        } else if (el.origtype === javascriptBlocked) {
            // onLoad is never passed here
            process.env.DEBUG && c(delta(), "unblocking inline", el);
            replaceScript(el, cloneScript(el));
            process.env.DEBUG && c(delta(), "unblocked inline", el);
        } else {
            process.env.DEBUG && ce(delta(), "already unblocked", el);
            if (callback) {
                callback();
            }
        }
    }

    const removeEventListener = (name, func) => {
        const pos = (listeners[name] || []).indexOf(func);
        if (pos >= 0) {
            listeners[name][pos] = undefined;
            return true;
        }
    }

    let documentAddEventListener = (event, func, ...args) => {
        if ('HTMLDocument::' + DCL == currentlyFiredEvent && event === DCL && !func.toString().match(/jQueryMock/)) {
            dispatcher.on('l', d.addEventListener.bind(d, event, func, ...args));
            return;
        }
        if (func && (event === DCL || event === RSC)) {
            process.env.DEBUG && c(delta(), "enqueuing event listener", event, func);
            const name = documentEventPrefix + event;
            listeners[name] = listeners[name] || [];
            listeners[name].push(func);
            if (DONE) {
                fireQueuedEvents([event]);
            }
            return;
        }
        return dOrigAddEventListener(event, func, ...args);
    }

    let documentRemoveEventListener = (event, func) => {
        if (event === DCL) {
            const name = documentEventPrefix + event;
            removeEventListener(name, func);
        }
        return dOrigRemoveEventListener(event, func);
    };

    // some optimizers think they can optimize better than us
    // but it is not true as to 18 Jul 2021
    // so let's keep our handlers
    Object_defineProperties(d, {
        [a]: {
            get() { return documentAddEventListener },
            set() { return documentAddEventListener },
        },
        [r]: {
            get() { return documentRemoveEventListener },
            set() { return documentRemoveEventListener },
        }
    });

    const preconnects = {};
    const preconnect = (src) => {
        if (!src)
            return;
        try {
            if (src.match(/^\/\/\w+/))
                src = d.location.protocol + src;
            const url = new URL(src);
            const href = url.origin;
            if (href && !preconnects[href] && d.location.host !== url.host) {
                const s = dOrigCreateElement('link');
                s.rel = 'preconnect';
                s.href = href;
                d.head.appendChild(s);
                process.env.DEBUG && c(delta(), 'preconnecting', url.origin);
                preconnects[href] = true;
            }
        } catch (e) {
            process.env.DEBUG && ce(delta(), "failed to parse src for preconnect", src);
        }
    }

    const preloads = {};
    const preloadAsScript = (src, isModule, crossorigin) => {
        var s = dOrigCreateElement('link');
        s.rel = isModule 
            ? 'modulepre' + L 
            : 'pre' + L;
        s.as = 'script';
        if (crossorigin)
            s[sa]('crossorigin', crossorigin); // must be setAttribute
        s.href = src;
        d.head.appendChild(s);
        preloads[src] = true;
        process.env.DEBUG && c(delta(), s.rel, src);
    }

    const mayBePreloadScripts = () => {
        if (_wpmeteor.preload) {
            reorder.forEach(script => {
                const src = script[ga](prefix + 'src');
                if (src && !script[ga](prefix + 'integrity') && !script[ha]('nomodule') && !preloads[src]) {
                    preloadAsScript(src, script[ga](prefix + 'type') == 'module', script[ha]('crossorigin') && script[ga]('crossorigin'));
                }
            })
        }
    };

    dOrigAddEventListener(DCL, () => {
        d.querySelectorAll('script[' + prefix + 'after]').forEach(el => {
            const originalAttributeGetter = el.__lookupGetter__('type').bind(el);
            Object_defineProperty(el, 'origtype', {
                get() {
                    return originalAttributeGetter();
                }
            });
            if ((el[ga](prefix + 'src') || "").match(/\/gtm.js\?/)) {
                process.env.DEBUG && c(delta(), 'delaying regex', el[ga](prefix + 'src'));
                delayed.push(el)
            } else if (el[ha](prefix + 'async')) {
                process.env.DEBUG && c(delta(), 'delaying async', el[ga](prefix + 'src'));
                delayed.unshift(el)
            } else {
                reorder.push(el)
            }
        });
        // we will loose all event listeners, so we'd better track addEventListener/removeEventListener as well
        // not supported yet, cant find reference in backend
        // const querySelectors = ['link'].map(n => n + '[' + prefix + 'onload]').join(',');
        // d.querySelectorAll(querySelectors).forEach(el => reorder.push(el));
    });

    /* 3rd party scripts handling */
    const createElement = function (...args) {

        const scriptElt = dOrigCreateElement(...args);
        
        if (args[0].toUpperCase() !== S || !iterating) {
            return scriptElt;
        }

        process.env.DEBUG && c(delta(), "creating script element");

        // Backup the original setAttribute function
        const originalSetAttribute = scriptElt[sa].bind(scriptElt);
        const originalGetAttribute = scriptElt[ga].bind(scriptElt);
        const originalHasAttribute = scriptElt[ha].bind(scriptElt);

        originalSetAttribute(prefix + 'after', 'REORDER');
        originalSetAttribute(prefix + 'type', "text/javascript");
        scriptElt.type = javascriptBlocked;

        const eventListeners = [];
        scriptElt.getEventListeners = () => {
            return eventListeners;
        }

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
            },
        });

        capturedAttributes.forEach(property => {
            const originalAttributeGetter = scriptElt.__lookupGetter__(property).bind(scriptElt);
            O[definePropert + 'y'](scriptElt, property, {
                set(value) {
                    process.env.DEBUG && c(delta(), "setting ", property, value);
                    return value
                        ? scriptElt[sa](prefix + property, value)
                        : scriptElt[ra](prefix + property);
                },
                get() {
                    return scriptElt[ga](prefix + property);
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
        }
        // Monkey patch the setAttribute function so that the setter is called instead.
        // Otherwise, setAttribute('type', 'whatever') will bypass our custom descriptors!
        scriptElt[sa] = function (property, value) {
            if (capturedAttributes.indexOf(property) >= 0) {
                process.env.DEBUG && c(delta(), "setting attribute ", property, value);
                return value
                    ? originalSetAttribute(prefix + property, value)
                    : scriptElt[ra](prefix + property);
            } else {
                originalSetAttribute(property, value);
            }
        }

        scriptElt[ga] = function (property) {
            return capturedAttributes.indexOf(property) >= 0 
                ? originalGetAttribute(prefix + property) 
                : originalGetAttribute(property)
        }

        scriptElt[ha] = function (property) {
            return capturedAttributes.indexOf(property) >= 0 
                ? originalHasAttribute(prefix + property) 
                : originalHasAttribute(property)
        }

        /* very shallow mocking of NamedNodeMap */
        const attributes = scriptElt.attributes;
        Object_defineProperty(scriptElt, 'attributes', {
            get() {
                const mock = [...attributes]
                    .filter(attr => attr.name !== 'type' && attr.name !== prefix + 'after')
                    .map(attr => {
                        return {
                            name: attr.name.match(new RegExp(prefix))
                                ? attr.name.replace(prefix, '')
                                : attr.name,
                            value: attr.value
                        };
                    });
                return mock;
            }
        })

        return scriptElt;
    }

    // Allowing to override, but still not the best option - onetrust captures createElement 
    // even for users who accepted cookies
    Object.defineProperty(d, 'createElement', {
        set(value) {
            if (process.env.DEBUG) {
                if (value == dOrigCreateElement) {
                    process.env.DEBUG &&  c(delta(), "document.createElement restored to original");
                } else if (value === createElement) {
                    process.env.DEBUG && c(delta(), "document.createElement overridden");
                } else {
                    process.env.DEBUG && c(delta(), "document.createElement overridden by a 3rd party script");
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

    const seenScripts = [];
    const observer = new MutationObserver(mutations => {
        if (iterating) {
            mutations.forEach(({ addedNodes, target }) => {
                addedNodes.forEach(node => {
                    // For each added script tag
                    if (node.nodeType === 1) {
                        if (S === node.tagName) {
                            if ('REORDER' === node[ga](prefix + 'after') && (!node[ga](prefix + 'type') || isJavascriptRegexp.test(node[ga](prefix + 'type')))) {
                                process.env.DEBUG && c(delta(), "captured new script", node.cloneNode(true), node);
                                const src = node[ga](prefix + 'src')

                                if (seenScripts.filter(n => n === node).length) {
                                    ce('Inserted twice', node)
                                }

                                if (node.parentNode) {
                                    seenScripts.push(node);
                                    if ((src || "").match(/\/gtm.js\?/)) {
                                        process.env.DEBUG && c(delta(), 'delaying regex', node[ga](prefix + 'src'));
                                        delayed.push(node);
                                        preconnect(src);
                                    } else if (node[ha](prefix + 'async')) {
                                        process.env.DEBUG && c(delta(), 'delaying async', node[ga](prefix + 'src'));
                                        delayed.unshift(node)
                                        preconnect(src);
                                    } else {
                                        if (src && reorder.length && !node[ga](prefix + 'integrity') && !node[ha]('nomodule') && !preloads[src]) {
                                            // no need to preload if it is the next script in the queue
                                            // VWO removes node instantly
                                            // preloading 
                                            if (reorder.length) {
                                                c(delta(), 'pre preload', reorder.length);
                                                preloadAsScript(src, node[ga](prefix + 'type') == 'module', node[ha]('crossorigin') && node[ga]('crossorigin'));
                                            }
                                        }
                                        reorder.push(node)
                                    }
                                } else {
                                    // if the node has been instanly removed, we still want to load it and run
                                    // I tested appendNode(script); removeNode(script) - it still loads and triggers the code
                                    process.env.DEBUG && ce('No parent node for', node, "re-adding to", target)
                                    node.addEventListener(L, e => e.target.parentNode.removeChild(e.target))
                                    node.addEventListener(E, e => e.target.parentNode.removeChild(e.target))
                                    target.appendChild(node);
                                    // no need to push to seenScripts and reorder as it will happen on the next iteration
                                    // of MutationObserver
                                }
                            } else {
                                process.env.DEBUG && c(delta(), "captured unmodified or non-javascript script", node.cloneNode(true), node);
                                dispatcher.emit('s', node.src);
                            }
                        } else if ("LINK" === node.tagName && node[ga]('as') === 'script') {
                            preloads[node[ga]('href')] = true;
                        }
                    }
                })
                // /* attribute mutations */
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
            })
        }
    });

    observer.observe(d.documentElement, { 
        childList: true, 
        subtree: true, 
        attributes: true, 
        // attributeFilter: ['src', 'type'],
        attributeOldValue: true,
    });

    // cleaning up
    dispatcher.on('l', () => {
        if (!createElementOverride || createElementOverride === createElement) {
            d.createElement = dOrigCreateElement;
            observer.disconnect();
        } else {
            process.env.DEBUG && c(delta(), 'createElement is overridden, keeping observers in place');
        }
    });
    /* end 3rd party scripts handling */

    /* we have to override document.write as all of them will fire after DOMContentLoaded */
    let documentWrite = (str) => {
        let parent, currentScript;
        if (!d.currentScript || !d.currentScript.parentNode) {
            /* trying our best */
            parent = d.body;
            currentScript = parent.lastChild;
        } else {
            currentScript = d.currentScript;
            parent = currentScript.parentNode;
        }
        try {
            const df = dOrigCreateElement('div');
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
    let documentWriteLn = (str) => documentWrite(str + "\n");

    Object_defineProperties(d, {
        'write': {
            get() { return documentWrite },
            set(func) { return documentWrite = func },
        },
        'writeln': {
            get() { return documentWriteLn },
            set(func) { return documentWriteLn = func },
        },
    });

    // Capturing and queueing Window Load event handlers
    let windowAddEventListener = (event, func, ...args) => {
        // We have to skip registering message listeners if DONE, as we already restored 
        // original eventListener to messages in restoreMessageListener()
        if ('Window::' + DCL == currentlyFiredEvent && event === DCL && !func.toString().match(/jQueryMock/)) {
            dispatcher.on('l', w.addEventListener.bind(w, event, func, ...args));
            return;
        }
        if ('Window::' + L == currentlyFiredEvent && event === L) {
            dispatcher.on('l', w.addEventListener.bind(w, event, func, ...args));
            return;
        }
        if (func && (event === L || event === DCL || (event === M && !DONE))) { 
            process.env.DEBUG && c(delta(), "enqueuing event listener", event, func);
            const name = event === DCL ? documentEventPrefix + event : windowEventPrefix + event;
            listeners[name] = listeners[name] || [];
            listeners[name].push(func);
            if (DONE) {
                fireQueuedEvents([event]);
            }
            return;
        }
        // process.env.DEBUG && c(event, func);
        return wOrigAddEventListener(event, func, ...args);
    }
    let windowRemoveEventListener = (event, func) => {
        if (event === L) { // L = load
            const name = event === DCL ? documentEventPrefix + event : windowEventPrefix + event;
            removeEventListener(name, func);
        }
        return wOrigRemoveEventListener(event, func);
    };

    // some optimizers think they can optimize better than us
    // but it is not true as to 18 Jul 2021
    // so let's keep our handlers
    Object_defineProperties(w, {
        [a]: {
            get() { return windowAddEventListener },
            set() { return windowAddEventListener },
        },
        [r]: {
            get() { return windowRemoveEventListener },
            set() { return windowRemoveEventListener },
        }
    });

    const onHandlerOptions = (name) => {
        let handler;
        return {
            get() {
                process.env.DEBUG && c(delta(), separator, 'getting ' + name.toLowerCase().replace(/::/, '.') + ' handler', handler);
                return handler;
            },
            set(func) {
                process.env.DEBUG && c(delta(), separator, 'setting ' + name.toLowerCase().replace(/::/, '.') + ' handler', func);
                // only last handler should fire
                if (handler) {
                    removeEventListener(name, func);
                }
                listeners[name] = listeners[name] || [];
                listeners[name].push(func);
                return handler = func;
            },
            // rocket-loader from CloudFlare tries to override onload so we will let him
            // configurable: true,
        };
    }

    dOrigAddEventListener('wpl', e => {
        const { target, event } = e.detail;
        const el = target == w ? d.body : target;
        const func = el[ga](prefix + 'on' + event.type);
        el[ra](prefix + 'on' + event.type);
        Object_defineProperty(event, 'target', { value: target });
        Object_defineProperty(event, 'currentTarget', { value: target });
        const f = new Function(func).bind(target);
        target.event = event;
        // the trick here is to fire Window::load on the second run of iterate()
        // as the first one fires exactly right when the window.load fires,
        // second fires when javascript is ready
        w[a](L, w[a].bind(w, L, f));
    });

    // overriding window.onload and document.body.onload, they are the same function
    {
   
        const options = onHandlerOptions(windowEventPrefix + L);
        Object_defineProperty(w, 'onload', options);
        dOrigAddEventListener(DCL, () => {
            Object_defineProperty(d.body, 'onload', options);
        });
    };
    // overriding document.onreadystatechange
    Object_defineProperty(d, 'onreadystatechange', onHandlerOptions(documentEventPrefix + RSC));
    // overriding window.onmessage
    Object_defineProperty(w, 'onmessage', onHandlerOptions(windowEventPrefix + M));

    if (process.env.DEBUG && location.search.match(/wpmeteorperformance/)) {
        try {
            new PerformanceObserver((entryList) => {
                for (const entry of entryList.getEntries()) {
                    c(delta(), 'LCP candidate:', entry.startTime, entry);
                }
            }).observe({ type: 'largest-contentful-paint', buffered: true });
            new PerformanceObserver(list => {
                list.getEntries().forEach(e => c(delta(), "resource loaded", e.name, e));
            }).observe({ type: 'resource' }); // buffered to detect loading 
        } catch (e) { }
    }

    const intersectsViewport = (el) => {
        // chrome settings
        // https://web.dev/browser-level-image-lazy-loading/#improved-data-savings-and-distance-from-viewport-thresholds
        let extras = {
            '4g': 1250,
            '3g': 2500,
            '2g': 2500,
        };

        const extra = extras[(navigator.connection || {}).effectiveType] || 0;
        const rect = el.getBoundingClientRect();
        const viewport = {
            top: -1 * wheight - extra,
            left: -1 * wwidth - extra,
            bottom: wheight + extra,
            right: wwidth + extra
       }

        // If one rectangle is on left side of other
        if (rect.left >= viewport.right || rect.right <= viewport.left)
            return false;

            // If one rectangle is above other
        if (rect.top >= viewport.bottom || rect.bottom <= viewport.top)
            return false;

        return true;
    }

    const waitForImages = (reallyWait = true) => {
        let imagesToLoad = 1;
        let imagesLoadedCount = -1;
        const seen = {};

        const imageLoadedHandler = (e) => {
            imagesLoadedCount++;
            // let's trigger 
            if (!--imagesToLoad) {
                process.env.DEBUG && c(delta(), imagesLoadedCount + " eager images loaded");
                nextTick(dispatcher.emit.bind(dispatcher, 'i'), _wpmeteor.rdelay);
            }
        }

        Array.from(d.getElementsByTagName('*')).forEach(tag => {
            let src, style, bgUrl;
            if (tag.tagName === 'IMG') {
                let _src = tag.currentSrc || tag.src; // trying to capture srcsets if they are already loading
                if (_src && !seen[_src] && !_src.match(/^data:/i)) {
                    if ((tag.loading || "").toLowerCase() !== 'lazy') {
                        src = _src; 
                        process.env.DEBUG && c(delta(), "loading image", src, 'for', tag);
                    } else if (intersectsViewport(tag)) { // lazy && already loading
                        src = _src; 
                        process.env.DEBUG && c(delta(), "loading lazy image", src, 'for', tag);
                    }
                }
            } else if (tag.tagName === S) {
                preconnect(tag[ga](prefix + 'src'));
            } else if (tag.tagName === 'LINK' && tag[ga]('as') === 'script' && ['pre' + L, 'modulepre' + L].indexOf(tag[ga]('rel')) >= 0) {
                preloads[tag[ga]('href')] = true;
            // supposedly all CSS has already been loaded
            } else if ((style = w.getComputedStyle(tag)) && (bgUrl = (style.backgroundImage || "").match(/^url\s*\((.*?)\)/i)) && (bgUrl || []).length) {
                const url = bgUrl[0].slice(4, -1).replace(/"/g, "");
                if (!seen[url] && !url.match(/^data:/i)) {
                    src = url;
                    process.env.DEBUG && c(delta(), "loading background", src, 'for', tag);
                }
            }
            if (src) {
                seen[src] = true;
                const temp = new Image();
                if (reallyWait) {
                    imagesToLoad++;
                    temp[a](L, imageLoadedHandler);
                    temp[a](E, imageLoadedHandler);
                }
                temp.src = src;
            }
        });
        d.fonts.ready.then(() => {
            process.env.DEBUG && c(delta(), "fonts ready");
            imageLoadedHandler();
        });
    }

    if (_wpmeteor.rdelay < 0) {
        dOrigAddEventListener(DCL, d.dispatchEvent.bind(d, new CustomEvent('i')));
        dOrigAddEventListener(DCL, dispatcher.emit.bind(dispatcher, 'i'));
    } else if (_wpmeteor.rdelay === 0) {
        dOrigAddEventListener(DCL, () => nextTick(waitForImages.bind(null, false)));
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

})(window,
    document,
    'addEventListener',
    'removeEventListener',
    'getAttribute',
    'setAttribute',
    'removeAttribute',
    'hasAttribute',
    'load',
    'error');
