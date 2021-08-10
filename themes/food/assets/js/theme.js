! function(e) {
    function t(o) {
        if (i[o]) return i[o].exports;
        var n = i[o] = {
            i: o,
            l: !1,
            exports: {}
        };
        return e[o].call(n.exports, n, n.exports, t), n.l = !0, n.exports
    }
    var i = {};
    t.m = e, t.c = i, t.i = function(e) {
        return e
    }, t.d = function(e, i, o) {
        t.o(e, i) || Object.defineProperty(e, i, {
            configurable: !1,
            enumerable: !0,
            get: o
        })
    }, t.n = function(e) {
        var i = e && e.__esModule ? function() {
            return e.default
        } : function() {
            return e
        };
        return t.d(i, "a", i), i
    }, t.o = function(e, t) {
        return Object.prototype.hasOwnProperty.call(e, t)
    }, t.p = "", t(t.s = 26)
}([function(e, t) {
    e.exports = jQuery
}, function(e, t) {
    e.exports = prestashop
}, function(e, t, i) {
    "use strict";
    var o, n;
    ! function(e) {
        function t(e) {
            var t = e.length,
                o = i.type(e);
            return "function" !== o && !i.isWindow(e) && (!(1 !== e.nodeType || !t) || ("array" === o || 0 === t || "number" == typeof t && t > 0 && t - 1 in e))
        }
        if (!e.jQuery) {
            var i = function e(t, i) {
                return new e.fn.init(t, i)
            };
            i.isWindow = function(e) {
                return e && e === e.window
            }, i.type = function(e) {
                return e ? "object" == typeof e || "function" == typeof e ? n[r.call(e)] || "object" : typeof e : e + ""
            }, i.isArray = Array.isArray || function(e) {
                return "array" === i.type(e)
            }, i.isPlainObject = function(e) {
                var t;
                if (!e || "object" !== i.type(e) || e.nodeType || i.isWindow(e)) return !1;
                try {
                    if (e.constructor && !s.call(e, "constructor") && !s.call(e.constructor.prototype, "isPrototypeOf")) return !1
                } catch (e) {
                    return !1
                }
                for (t in e);
                return void 0 === t || s.call(e, t)
            }, i.each = function(e, i, o) {
                var n = 0,
                    s = e.length,
                    r = t(e);
                if (o) {
                    if (r)
                        for (; n < s && !1 !== i.apply(e[n], o); n++);
                    else
                        for (n in e)
                            if (e.hasOwnProperty(n) && !1 === i.apply(e[n], o)) break
                } else if (r)
                    for (; n < s && !1 !== i.call(e[n], n, e[n]); n++);
                else
                    for (n in e)
                        if (e.hasOwnProperty(n) && !1 === i.call(e[n], n, e[n])) break;
                return e
            }, i.data = function(e, t, n) {
                if (void 0 === n) {
                    var s = e[i.expando],
                        r = s && o[s];
                    if (void 0 === t) return r;
                    if (r && t in r) return r[t]
                } else if (void 0 !== t) {
                    var a = e[i.expando] || (e[i.expando] = ++i.uuid);
                    return o[a] = o[a] || {}, o[a][t] = n, n
                }
            }, i.removeData = function(e, t) {
                var n = e[i.expando],
                    s = n && o[n];
                s && (t ? i.each(t, function(e, t) {
                    delete s[t]
                }) : delete o[n])
            }, i.extend = function() {
                var e, t, o, n, s, r, a = arguments[0] || {},
                    l = 1,
                    d = arguments.length,
                    c = !1;
                for ("boolean" == typeof a && (c = a, a = arguments[l] || {}, l++), "object" != typeof a && "function" !== i.type(a) && (a = {}), l === d && (a = this, l--); l < d; l++)
                    if (s = arguments[l])
                        for (n in s) s.hasOwnProperty(n) && (e = a[n], o = s[n], a !== o && (c && o && (i.isPlainObject(o) || (t = i.isArray(o))) ? (t ? (t = !1, r = e && i.isArray(e) ? e : []) : r = e && i.isPlainObject(e) ? e : {}, a[n] = i.extend(c, r, o)) : void 0 !== o && (a[n] = o)));
                return a
            }, i.queue = function(e, o, n) {
                if (e) {
                    o = (o || "fx") + "queue";
                    var s = i.data(e, o);
                    return n ? (!s || i.isArray(n) ? s = i.data(e, o, function(e, i) {
                        var o = i || [];
                        return e && (t(Object(e)) ? function(e, t) {
                            for (var i = +t.length, o = 0, n = e.length; o < i;) e[n++] = t[o++];
                            if (i !== i)
                                for (; void 0 !== t[o];) e[n++] = t[o++];
                            e.length = n
                        }(o, "string" == typeof e ? [e] : e) : [].push.call(o, e)), o
                    }(n)) : s.push(n), s) : s || []
                }
            }, i.dequeue = function(e, t) {
                i.each(e.nodeType ? [e] : e, function(e, o) {
                    t = t || "fx";
                    var n = i.queue(o, t),
                        s = n.shift();
                    "inprogress" === s && (s = n.shift()), s && ("fx" === t && n.unshift("inprogress"), s.call(o, function() {
                        i.dequeue(o, t)
                    }))
                })
            }, i.fn = i.prototype = {
                init: function(e) {
                    if (e.nodeType) return this[0] = e, this;
                    throw new Error("Not a DOM node.")
                },
                offset: function() {
                    var t = this[0].getBoundingClientRect ? this[0].getBoundingClientRect() : {
                        top: 0,
                        left: 0
                    };
                    return {
                        top: t.top + (e.pageYOffset || document.scrollTop || 0) - (document.clientTop || 0),
                        left: t.left + (e.pageXOffset || document.scrollLeft || 0) - (document.clientLeft || 0)
                    }
                },
                position: function() {
                    var e = this[0],
                        t = function(e) {
                            for (var t = e.offsetParent; t && "html" !== t.nodeName.toLowerCase() && t.style && "static" === t.style.position.toLowerCase();) t = t.offsetParent;
                            return t || document
                        }(e),
                        o = this.offset(),
                        n = /^(?:body|html)$/i.test(t.nodeName) ? {
                            top: 0,
                            left: 0
                        } : i(t).offset();
                    return o.top -= parseFloat(e.style.marginTop) || 0, o.left -= parseFloat(e.style.marginLeft) || 0, t.style && (n.top += parseFloat(t.style.borderTopWidth) || 0, n.left += parseFloat(t.style.borderLeftWidth) || 0), {
                        top: o.top - n.top,
                        left: o.left - n.left
                    }
                }
            };
            var o = {};
            i.expando = "velocity" + (new Date).getTime(), i.uuid = 0;
            for (var n = {}, s = n.hasOwnProperty, r = n.toString, a = "Boolean Number String Function Array Date RegExp Object Error".split(" "), l = 0; l < a.length; l++) n["[object " + a[l] + "]"] = a[l].toLowerCase();
            i.fn.init.prototype = i.fn, e.Velocity = {
                Utilities: i
            }
        }
    }(window),
    function(s) {
        "object" == typeof e && "object" == typeof e.exports ? e.exports = s() : (o = s, void 0 !== (n = "function" == typeof o ? o.call(t, i, t, e) : o) && (e.exports = n))
    }(function() {
        return function(e, t, i, o) {
            function n(e) {
                for (var t = -1, i = e ? e.length : 0, o = []; ++t < i;) {
                    var n = e[t];
                    n && o.push(n)
                }
                return o
            }

            function s(e) {
                return b.isWrapped(e) ? e = y.call(e) : b.isNode(e) && (e = [e]), e
            }

            function r(e) {
                var t = h.data(e, "velocity");
                return null === t ? o : t
            }

            function a(e, t) {
                var i = r(e);
                i && i.delayTimer && !i.delayPaused && (i.delayRemaining = i.delay - t + i.delayBegin, i.delayPaused = !0, clearTimeout(i.delayTimer.setTimeout))
            }

            function l(e, t) {
                var i = r(e);
                i && i.delayTimer && i.delayPaused && (i.delayPaused = !1, i.delayTimer.setTimeout = setTimeout(i.delayTimer.next, i.delayRemaining))
            }

            function d(e) {
                return function(t) {
                    return Math.round(t * e) * (1 / e)
                }
            }

            function c(e, i, o, n) {
                function s(e, t) {
                    return 1 - 3 * t + 3 * e
                }

                function r(e, t) {
                    return 3 * t - 6 * e
                }

                function a(e) {
                    return 3 * e
                }

                function l(e, t, i) {
                    return ((s(t, i) * e + r(t, i)) * e + a(t)) * e
                }

                function d(e, t, i) {
                    return 3 * s(t, i) * e * e + 2 * r(t, i) * e + a(t)
                }

                function c(t, i) {
                    for (var n = 0; n < m; ++n) {
                        var s = d(i, e, o);
                        if (0 === s) return i;
                        i -= (l(i, e, o) - t) / s
                    }
                    return i
                }

                function u() {
                    for (var t = 0; t < w; ++t) T[t] = l(t * b, e, o)
                }

                function f(t, i, n) {
                    var s, r, a = 0;
                    do {
                        r = i + (n - i) / 2, s = l(r, e, o) - t, s > 0 ? n = r : i = r
                    } while (Math.abs(s) > v && ++a < y);
                    return r
                }

                function p(t) {
                    for (var i = 0, n = 1, s = w - 1; n !== s && T[n] <= t; ++n) i += b;
                    --n;
                    var r = (t - T[n]) / (T[n + 1] - T[n]),
                        a = i + r * b,
                        l = d(a, e, o);
                    return l >= g ? c(t, a) : 0 === l ? a : f(t, i, i + b)
                }

                function h() {
                    _ = !0, e === i && o === n || u()
                }
                var m = 4,
                    g = .001,
                    v = 1e-7,
                    y = 10,
                    w = 11,
                    b = 1 / (w - 1),
                    S = "Float32Array" in t;
                if (4 !== arguments.length) return !1;
                for (var x = 0; x < 4; ++x)
                    if ("number" != typeof arguments[x] || isNaN(arguments[x]) || !isFinite(arguments[x])) return !1;
                e = Math.min(e, 1), o = Math.min(o, 1), e = Math.max(e, 0), o = Math.max(o, 0);
                var T = S ? new Float32Array(w) : new Array(w),
                    _ = !1,
                    k = function(t) {
                        return _ || h(), e === i && o === n ? t : 0 === t ? 0 : 1 === t ? 1 : l(p(t), i, n)
                    };
                k.getControlPoints = function() {
                    return [{
                        x: e,
                        y: i
                    }, {
                        x: o,
                        y: n
                    }]
                };
                var z = "generateBezier(" + [e, i, o, n] + ")";
                return k.toString = function() {
                    return z
                }, k
            }

            function u(e, t) {
                var i = e;
                return b.isString(e) ? _.Easings[e] || (i = !1) : i = b.isArray(e) && 1 === e.length ? d.apply(null, e) : b.isArray(e) && 2 === e.length ? k.apply(null, e.concat([t])) : !(!b.isArray(e) || 4 !== e.length) && c.apply(null, e), !1 === i && (i = _.Easings[_.defaults.easing] ? _.defaults.easing : T), i
            }

            function f(e) {
                if (e) {
                    var t = _.timestamp && !0 !== e ? e : v.now(),
                        i = _.State.calls.length;
                    i > 1e4 && (_.State.calls = n(_.State.calls), i = _.State.calls.length);
                    for (var s = 0; s < i; s++)
                        if (_.State.calls[s]) {
                            var a = _.State.calls[s],
                                l = a[0],
                                d = a[2],
                                c = a[3],
                                u = !c,
                                g = null,
                                y = a[5],
                                w = a[6];
                            if (c || (c = _.State.calls[s][3] = t - 16), y) {
                                if (!0 !== y.resume) continue;
                                c = a[3] = Math.round(t - w - 16), a[5] = null
                            }
                            w = a[6] = t - c;
                            for (var S = Math.min(w / d.duration, 1), x = 0, T = l.length; x < T; x++) {
                                var k = l[x],
                                    C = k.element;
                                if (r(C)) {
                                    var O = !1;
                                    if (d.display !== o && null !== d.display && "none" !== d.display) {
                                        if ("flex" === d.display) {
                                            var A = ["-webkit-box", "-moz-box", "-ms-flexbox", "-webkit-flex"];
                                            h.each(A, function(e, t) {
                                                z.setPropertyValue(C, "display", t)
                                            })
                                        }
                                        z.setPropertyValue(C, "display", d.display)
                                    }
                                    d.visibility !== o && "hidden" !== d.visibility && z.setPropertyValue(C, "visibility", d.visibility);
                                    for (var L in k)
                                        if (k.hasOwnProperty(L) && "element" !== L) {
                                            var W, P = k[L],
                                                $ = b.isString(P.easing) ? _.Easings[P.easing] : P.easing;
                                            if (b.isString(P.pattern)) {
                                                var I = 1 === S ? function(e, t, i) {
                                                    var o = P.endValue[t];
                                                    return i ? Math.round(o) : o
                                                } : function(e, t, i) {
                                                    var o = P.startValue[t],
                                                        n = P.endValue[t] - o,
                                                        s = o + n * $(S, d, n);
                                                    return i ? Math.round(s) : s
                                                };
                                                W = P.pattern.replace(/{(\d+)(!)?}/g, I)
                                            } else if (1 === S) W = P.endValue;
                                            else {
                                                var H = P.endValue - P.startValue;
                                                W = P.startValue + H * $(S, d, H)
                                            }
                                            if (!u && W === P.currentValue) continue;
                                            if (P.currentValue = W, "tween" === L) g = W;
                                            else {
                                                var N;
                                                if (z.Hooks.registered[L]) {
                                                    N = z.Hooks.getRoot(L);
                                                    var j = r(C).rootPropertyValueCache[N];
                                                    j && (P.rootPropertyValue = j)
                                                }
                                                var D = z.setPropertyValue(C, L, P.currentValue + (m < 9 && 0 === parseFloat(W) ? "" : P.unitType), P.rootPropertyValue, P.scrollData);
                                                z.Hooks.registered[L] && (z.Normalizations.registered[N] ? r(C).rootPropertyValueCache[N] = z.Normalizations.registered[N]("extract", null, D[1]) : r(C).rootPropertyValueCache[N] = D[1]), "transform" === D[0] && (O = !0)
                                            }
                                        } d.mobileHA && r(C).transformCache.translate3d === o && (r(C).transformCache.translate3d = "(0px, 0px, 0px)", O = !0), O && z.flushTransformCache(C)
                                }
                            }
                            d.display !== o && "none" !== d.display && (_.State.calls[s][2].display = !1), d.visibility !== o && "hidden" !== d.visibility && (_.State.calls[s][2].visibility = !1), d.progress && d.progress.call(a[1], a[1], S, Math.max(0, c + d.duration - t), c, g), 1 === S && p(s)
                        }
                }
                _.State.isTicking && E(f)
            }

            function p(e, t) {
                if (!_.State.calls[e]) return !1;
                for (var i = _.State.calls[e][0], n = _.State.calls[e][1], s = _.State.calls[e][2], a = _.State.calls[e][4], l = !1, d = 0, c = i.length; d < c; d++) {
                    var u = i[d].element;
                    t || s.loop || ("none" === s.display && z.setPropertyValue(u, "display", s.display), "hidden" === s.visibility && z.setPropertyValue(u, "visibility", s.visibility));
                    var f = r(u);
                    if (!0 !== s.loop && (h.queue(u)[1] === o || !/\.velocityQueueEntryFlag/i.test(h.queue(u)[1])) && f) {
                        f.isAnimating = !1, f.rootPropertyValueCache = {};
                        var p = !1;
                        h.each(z.Lists.transforms3D, function(e, t) {
                            var i = /^scale/.test(t) ? 1 : 0,
                                n = f.transformCache[t];
                            f.transformCache[t] !== o && new RegExp("^\\(" + i + "[^.]").test(n) && (p = !0, delete f.transformCache[t])
                        }), s.mobileHA && (p = !0, delete f.transformCache.translate3d), p && z.flushTransformCache(u), z.Values.removeClass(u, "velocity-animating")
                    }
                    if (!t && s.complete && !s.loop && d === c - 1) try {
                        s.complete.call(n, n)
                    } catch (e) {
                        setTimeout(function() {
                            throw e
                        }, 1)
                    }
                    a && !0 !== s.loop && a(n), f && !0 === s.loop && !t && (h.each(f.tweensContainer, function(e, t) {
                        if (/^rotate/.test(e) && (parseFloat(t.startValue) - parseFloat(t.endValue)) % 360 == 0) {
                            var i = t.startValue;
                            t.startValue = t.endValue, t.endValue = i
                        }
                        /^backgroundPosition/.test(e) && 100 === parseFloat(t.endValue) && "%" === t.unitType && (t.endValue = 0, t.startValue = 100)
                    }), _(u, "reverse", {
                        loop: !0,
                        delay: s.delay
                    })), !1 !== s.queue && h.dequeue(u, s.queue)
                }
                _.State.calls[e] = !1;
                for (var m = 0, g = _.State.calls.length; m < g; m++)
                    if (!1 !== _.State.calls[m]) {
                        l = !0;
                        break
                    }! 1 === l && (_.State.isTicking = !1, delete _.State.calls, _.State.calls = [])
            }
            var h, m = function() {
                    if (i.documentMode) return i.documentMode;
                    for (var e = 7; e > 4; e--) {
                        var t = i.createElement("div");
                        if (t.innerHTML = "\x3c!--[if IE " + e + "]><span></span><![endif]--\x3e", t.getElementsByTagName("span").length) return t = null, e
                    }
                    return o
                }(),
                g = function() {
                    var e = 0;
                    return t.webkitRequestAnimationFrame || t.mozRequestAnimationFrame || function(t) {
                        var i, o = (new Date).getTime();
                        return i = Math.max(0, 16 - (o - e)), e = o + i, setTimeout(function() {
                            t(o + i)
                        }, i)
                    }
                }(),
                v = function() {
                    var e = t.performance || {};
                    if ("function" != typeof e.now) {
                        var i = e.timing && e.timing.navigationStart ? e.timing.navigationStart : (new Date).getTime();
                        e.now = function() {
                            return (new Date).getTime() - i
                        }
                    }
                    return e
                }(),
                y = function() {
                    var e = Array.prototype.slice;
                    try {
                        return e.call(i.documentElement), e
                    } catch (t) {
                        return function(t, i) {
                            var o = this.length;
                            if ("number" != typeof t && (t = 0), "number" != typeof i && (i = o), this.slice) return e.call(this, t, i);
                            var n, s = [],
                                r = t >= 0 ? t : Math.max(0, o + t),
                                a = i < 0 ? o + i : Math.min(i, o),
                                l = a - r;
                            if (l > 0)
                                if (s = new Array(l), this.charAt)
                                    for (n = 0; n < l; n++) s[n] = this.charAt(r + n);
                                else
                                    for (n = 0; n < l; n++) s[n] = this[r + n];
                            return s
                        }
                    }
                }(),
                w = function() {
                    return Array.prototype.includes ? function(e, t) {
                        return e.includes(t)
                    } : Array.prototype.indexOf ? function(e, t) {
                        return e.indexOf(t) >= 0
                    } : function(e, t) {
                        for (var i = 0; i < e.length; i++)
                            if (e[i] === t) return !0;
                        return !1
                    }
                },
                b = {
                    isNumber: function(e) {
                        return "number" == typeof e
                    },
                    isString: function(e) {
                        return "string" == typeof e
                    },
                    isArray: Array.isArray || function(e) {
                        return "[object Array]" === Object.prototype.toString.call(e)
                    },
                    isFunction: function(e) {
                        return "[object Function]" === Object.prototype.toString.call(e)
                    },
                    isNode: function(e) {
                        return e && e.nodeType
                    },
                    isWrapped: function(e) {
                        return e && e !== t && b.isNumber(e.length) && !b.isString(e) && !b.isFunction(e) && !b.isNode(e) && (0 === e.length || b.isNode(e[0]))
                    },
                    isSVG: function(e) {
                        return t.SVGElement && e instanceof t.SVGElement
                    },
                    isEmptyObject: function(e) {
                        for (var t in e)
                            if (e.hasOwnProperty(t)) return !1;
                        return !0
                    }
                },
                S = !1;
            if (e.fn && e.fn.jquery ? (h = e, S = !0) : h = t.Velocity.Utilities, m <= 8 && !S) throw new Error("Velocity: IE8 and below require jQuery to be loaded before Velocity.");
            if (m <= 7) return void(jQuery.fn.velocity = jQuery.fn.animate);
            var x = 400,
                T = "swing",
                _ = {
                    State: {
                        isMobile: /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(t.navigator.userAgent),
                        isAndroid: /Android/i.test(t.navigator.userAgent),
                        isGingerbread: /Android 2\.3\.[3-7]/i.test(t.navigator.userAgent),
                        isChrome: t.chrome,
                        isFirefox: /Firefox/i.test(t.navigator.userAgent),
                        prefixElement: i.createElement("div"),
                        prefixMatches: {},
                        scrollAnchor: null,
                        scrollPropertyLeft: null,
                        scrollPropertyTop: null,
                        isTicking: !1,
                        calls: [],
                        delayedElements: {
                            count: 0
                        }
                    },
                    CSS: {},
                    Utilities: h,
                    Redirects: {},
                    Easings: {},
                    Promise: t.Promise,
                    defaults: {
                        queue: "",
                        duration: x,
                        easing: T,
                        begin: o,
                        complete: o,
                        progress: o,
                        display: o,
                        visibility: o,
                        loop: !1,
                        delay: !1,
                        mobileHA: !0,
                        _cacheValues: !0,
                        promiseRejectEmpty: !0
                    },
                    init: function(e) {
                        h.data(e, "velocity", {
                            isSVG: b.isSVG(e),
                            isAnimating: !1,
                            computedStyle: null,
                            tweensContainer: null,
                            rootPropertyValueCache: {},
                            transformCache: {}
                        })
                    },
                    hook: null,
                    mock: !1,
                    version: {
                        major: 1,
                        minor: 5,
                        patch: 2
                    },
                    debug: !1,
                    timestamp: !0,
                    pauseAll: function(e) {
                        var t = (new Date).getTime();
                        h.each(_.State.calls, function(t, i) {
                            if (i) {
                                if (e !== o && (i[2].queue !== e || !1 === i[2].queue)) return !0;
                                i[5] = {
                                    resume: !1
                                }
                            }
                        }), h.each(_.State.delayedElements, function(e, i) {
                            i && a(i, t)
                        })
                    },
                    resumeAll: function(e) {
                        var t = (new Date).getTime();
                        h.each(_.State.calls, function(t, i) {
                            if (i) {
                                if (e !== o && (i[2].queue !== e || !1 === i[2].queue)) return !0;
                                i[5] && (i[5].resume = !0)
                            }
                        }), h.each(_.State.delayedElements, function(e, i) {
                            i && l(i, t)
                        })
                    }
                };
            t.pageYOffset !== o ? (_.State.scrollAnchor = t, _.State.scrollPropertyLeft = "pageXOffset", _.State.scrollPropertyTop = "pageYOffset") : (_.State.scrollAnchor = i.documentElement || i.body.parentNode || i.body, _.State.scrollPropertyLeft = "scrollLeft", _.State.scrollPropertyTop = "scrollTop");
            var k = function() {
                function e(e) {
                    return -e.tension * e.x - e.friction * e.v
                }

                function t(t, i, o) {
                    var n = {
                        x: t.x + o.dx * i,
                        v: t.v + o.dv * i,
                        tension: t.tension,
                        friction: t.friction
                    };
                    return {
                        dx: n.v,
                        dv: e(n)
                    }
                }

                function i(i, o) {
                    var n = {
                            dx: i.v,
                            dv: e(i)
                        },
                        s = t(i, .5 * o, n),
                        r = t(i, .5 * o, s),
                        a = t(i, o, r),
                        l = 1 / 6 * (n.dx + 2 * (s.dx + r.dx) + a.dx),
                        d = 1 / 6 * (n.dv + 2 * (s.dv + r.dv) + a.dv);
                    return i.x = i.x + l * o, i.v = i.v + d * o, i
                }
                return function e(t, o, n) {
                    var s, r, a, l = {
                            x: -1,
                            v: 0,
                            tension: null,
                            friction: null
                        },
                        d = [0],
                        c = 0;
                    for (t = parseFloat(t) || 500, o = parseFloat(o) || 20, n = n || null, l.tension = t, l.friction = o, s = null !== n, s ? (c = e(t, o), r = c / n * .016) : r = .016;;)
                        if (a = i(a || l, r), d.push(1 + a.x), c += 16, !(Math.abs(a.x) > 1e-4 && Math.abs(a.v) > 1e-4)) break;
                    return s ? function(e) {
                        return d[e * (d.length - 1) | 0]
                    } : c
                }
            }();
            _.Easings = {
                linear: function(e) {
                    return e
                },
                swing: function(e) {
                    return .5 - Math.cos(e * Math.PI) / 2
                },
                spring: function(e) {
                    return 1 - Math.cos(4.5 * e * Math.PI) * Math.exp(6 * -e)
                }
            }, h.each([
                ["ease", [.25, .1, .25, 1]],
                ["ease-in", [.42, 0, 1, 1]],
                ["ease-out", [0, 0, .58, 1]],
                ["ease-in-out", [.42, 0, .58, 1]],
                ["easeInSine", [.47, 0, .745, .715]],
                ["easeOutSine", [.39, .575, .565, 1]],
                ["easeInOutSine", [.445, .05, .55, .95]],
                ["easeInQuad", [.55, .085, .68, .53]],
                ["easeOutQuad", [.25, .46, .45, .94]],
                ["easeInOutQuad", [.455, .03, .515, .955]],
                ["easeInCubic", [.55, .055, .675, .19]],
                ["easeOutCubic", [.215, .61, .355, 1]],
                ["easeInOutCubic", [.645, .045, .355, 1]],
                ["easeInQuart", [.895, .03, .685, .22]],
                ["easeOutQuart", [.165, .84, .44, 1]],
                ["easeInOutQuart", [.77, 0, .175, 1]],
                ["easeInQuint", [.755, .05, .855, .06]],
                ["easeOutQuint", [.23, 1, .32, 1]],
                ["easeInOutQuint", [.86, 0, .07, 1]],
                ["easeInExpo", [.95, .05, .795, .035]],
                ["easeOutExpo", [.19, 1, .22, 1]],
                ["easeInOutExpo", [1, 0, 0, 1]],
                ["easeInCirc", [.6, .04, .98, .335]],
                ["easeOutCirc", [.075, .82, .165, 1]],
                ["easeInOutCirc", [.785, .135, .15, .86]]
            ], function(e, t) {
                _.Easings[t[0]] = c.apply(null, t[1])
            });
            var z = _.CSS = {
                RegEx: {
                    isHex: /^#([A-f\d]{3}){1,2}$/i,
                    valueUnwrap: /^[A-z]+\((.*)\)$/i,
                    wrappedValueAlreadyExtracted: /[0-9.]+ [0-9.]+ [0-9.]+( [0-9.]+)?/,
                    valueSplit: /([A-z]+\(.+\))|(([A-z0-9#-.]+?)(?=\s|$))/gi
                },
                Lists: {
                    colors: ["fill", "stroke", "stopColor", "color", "backgroundColor", "borderColor", "borderTopColor", "borderRightColor", "borderBottomColor", "borderLeftColor", "outlineColor"],
                    transformsBase: ["translateX", "translateY", "scale", "scaleX", "scaleY", "skewX", "skewY", "rotateZ"],
                    transforms3D: ["transformPerspective", "translateZ", "scaleZ", "rotateX", "rotateY"],
                    units: ["%", "em", "ex", "ch", "rem", "vw", "vh", "vmin", "vmax", "cm", "mm", "Q", "in", "pc", "pt", "px", "deg", "grad", "rad", "turn", "s", "ms"],
                    colorNames: {
                        aliceblue: "240,248,255",
                        antiquewhite: "250,235,215",
                        aquamarine: "127,255,212",
                        aqua: "0,255,255",
                        azure: "240,255,255",
                        beige: "245,245,220",
                        bisque: "255,228,196",
                        black: "0,0,0",
                        blanchedalmond: "255,235,205",
                        blueviolet: "138,43,226",
                        blue: "0,0,255",
                        brown: "165,42,42",
                        burlywood: "222,184,135",
                        cadetblue: "95,158,160",
                        chartreuse: "127,255,0",
                        chocolate: "210,105,30",
                        coral: "255,127,80",
                        cornflowerblue: "100,149,237",
                        cornsilk: "255,248,220",
                        crimson: "220,20,60",
                        cyan: "0,255,255",
                        darkblue: "0,0,139",
                        darkcyan: "0,139,139",
                        darkgoldenrod: "184,134,11",
                        darkgray: "169,169,169",
                        darkgrey: "169,169,169",
                        darkgreen: "0,100,0",
                        darkkhaki: "189,183,107",
                        darkmagenta: "139,0,139",
                        darkolivegreen: "85,107,47",
                        darkorange: "255,140,0",
                        darkorchid: "153,50,204",
                        darkred: "139,0,0",
                        darksalmon: "233,150,122",
                        darkseagreen: "143,188,143",
                        darkslateblue: "72,61,139",
                        darkslategray: "47,79,79",
                        darkturquoise: "0,206,209",
                        darkviolet: "148,0,211",
                        deeppink: "255,20,147",
                        deepskyblue: "0,191,255",
                        dimgray: "105,105,105",
                        dimgrey: "105,105,105",
                        dodgerblue: "30,144,255",
                        firebrick: "178,34,34",
                        floralwhite: "255,250,240",
                        forestgreen: "34,139,34",
                        fuchsia: "255,0,255",
                        gainsboro: "220,220,220",
                        ghostwhite: "248,248,255",
                        gold: "255,215,0",
                        goldenrod: "218,165,32",
                        gray: "128,128,128",
                        grey: "128,128,128",
                        greenyellow: "173,255,47",
                        green: "0,128,0",
                        honeydew: "240,255,240",
                        hotpink: "255,105,180",
                        indianred: "205,92,92",
                        indigo: "75,0,130",
                        ivory: "255,255,240",
                        khaki: "240,230,140",
                        lavenderblush: "255,240,245",
                        lavender: "230,230,250",
                        lawngreen: "124,252,0",
                        lemonchiffon: "255,250,205",
                        lightblue: "173,216,230",
                        lightcoral: "240,128,128",
                        lightcyan: "224,255,255",
                        lightgoldenrodyellow: "250,250,210",
                        lightgray: "211,211,211",
                        lightgrey: "211,211,211",
                        lightgreen: "144,238,144",
                        lightpink: "255,182,193",
                        lightsalmon: "255,160,122",
                        lightseagreen: "32,178,170",
                        lightskyblue: "135,206,250",
                        lightslategray: "119,136,153",
                        lightsteelblue: "176,196,222",
                        lightyellow: "255,255,224",
                        limegreen: "50,205,50",
                        lime: "0,255,0",
                        linen: "250,240,230",
                        magenta: "255,0,255",
                        maroon: "128,0,0",
                        mediumaquamarine: "102,205,170",
                        mediumblue: "0,0,205",
                        mediumorchid: "186,85,211",
                        mediumpurple: "147,112,219",
                        mediumseagreen: "60,179,113",
                        mediumslateblue: "123,104,238",
                        mediumspringgreen: "0,250,154",
                        mediumturquoise: "72,209,204",
                        mediumvioletred: "199,21,133",
                        midnightblue: "25,25,112",
                        mintcream: "245,255,250",
                        mistyrose: "255,228,225",
                        moccasin: "255,228,181",
                        navajowhite: "255,222,173",
                        navy: "0,0,128",
                        oldlace: "253,245,230",
                        olivedrab: "107,142,35",
                        olive: "128,128,0",
                        orangered: "255,69,0",
                        orange: "255,165,0",
                        orchid: "218,112,214",
                        palegoldenrod: "238,232,170",
                        palegreen: "152,251,152",
                        paleturquoise: "175,238,238",
                        palevioletred: "219,112,147",
                        papayawhip: "255,239,213",
                        peachpuff: "255,218,185",
                        peru: "205,133,63",
                        pink: "255,192,203",
                        plum: "221,160,221",
                        powderblue: "176,224,230",
                        purple: "128,0,128",
                        red: "255,0,0",
                        rosybrown: "188,143,143",
                        royalblue: "65,105,225",
                        saddlebrown: "139,69,19",
                        salmon: "250,128,114",
                        sandybrown: "244,164,96",
                        seagreen: "46,139,87",
                        seashell: "255,245,238",
                        sienna: "160,82,45",
                        silver: "192,192,192",
                        skyblue: "135,206,235",
                        slateblue: "106,90,205",
                        slategray: "112,128,144",
                        snow: "255,250,250",
                        springgreen: "0,255,127",
                        steelblue: "70,130,180",
                        tan: "210,180,140",
                        teal: "0,128,128",
                        thistle: "216,191,216",
                        tomato: "255,99,71",
                        turquoise: "64,224,208",
                        violet: "238,130,238",
                        wheat: "245,222,179",
                        whitesmoke: "245,245,245",
                        white: "255,255,255",
                        yellowgreen: "154,205,50",
                        yellow: "255,255,0"
                    }
                },
                Hooks: {
                    templates: {
                        textShadow: ["Color X Y Blur", "black 0px 0px 0px"],
                        boxShadow: ["Color X Y Blur Spread", "black 0px 0px 0px 0px"],
                        clip: ["Top Right Bottom Left", "0px 0px 0px 0px"],
                        backgroundPosition: ["X Y", "0% 0%"],
                        transformOrigin: ["X Y Z", "50% 50% 0px"],
                        perspectiveOrigin: ["X Y", "50% 50%"]
                    },
                    registered: {},
                    register: function() {
                        for (var e = 0; e < z.Lists.colors.length; e++) {
                            var t = "color" === z.Lists.colors[e] ? "0 0 0 1" : "255 255 255 1";
                            z.Hooks.templates[z.Lists.colors[e]] = ["Red Green Blue Alpha", t]
                        }
                        var i, o, n;
                        if (m)
                            for (i in z.Hooks.templates)
                                if (z.Hooks.templates.hasOwnProperty(i)) {
                                    o = z.Hooks.templates[i], n = o[0].split(" ");
                                    var s = o[1].match(z.RegEx.valueSplit);
                                    "Color" === n[0] && (n.push(n.shift()), s.push(s.shift()), z.Hooks.templates[i] = [n.join(" "), s.join(" ")])
                                } for (i in z.Hooks.templates)
                            if (z.Hooks.templates.hasOwnProperty(i)) {
                                o = z.Hooks.templates[i], n = o[0].split(" ");
                                for (var r in n)
                                    if (n.hasOwnProperty(r)) {
                                        var a = i + n[r],
                                            l = r;
                                        z.Hooks.registered[a] = [i, l]
                                    }
                            }
                    },
                    getRoot: function(e) {
                        var t = z.Hooks.registered[e];
                        return t ? t[0] : e
                    },
                    getUnit: function(e, t) {
                        var i = (e.substr(t || 0, 5).match(/^[a-z%]+/) || [])[0] || "";
                        return i && w(z.Lists.units, i) ? i : ""
                    },
                    fixColors: function(e) {
                        return e.replace(/(rgba?\(\s*)?(\b[a-z]+\b)/g, function(e, t, i) {
                            return z.Lists.colorNames.hasOwnProperty(i) ? (t || "rgba(") + z.Lists.colorNames[i] + (t ? "" : ",1)") : t + i
                        })
                    },
                    cleanRootPropertyValue: function(e, t) {
                        return z.RegEx.valueUnwrap.test(t) && (t = t.match(z.RegEx.valueUnwrap)[1]), z.Values.isCSSNullValue(t) && (t = z.Hooks.templates[e][1]), t
                    },
                    extractValue: function(e, t) {
                        var i = z.Hooks.registered[e];
                        if (i) {
                            var o = i[0],
                                n = i[1];
                            return t = z.Hooks.cleanRootPropertyValue(o, t), t.toString().match(z.RegEx.valueSplit)[n]
                        }
                        return t
                    },
                    injectValue: function(e, t, i) {
                        var o = z.Hooks.registered[e];
                        if (o) {
                            var n, s = o[0],
                                r = o[1];
                            return i = z.Hooks.cleanRootPropertyValue(s, i), n = i.toString().match(z.RegEx.valueSplit), n[r] = t, n.join(" ")
                        }
                        return i
                    }
                },
                Normalizations: {
                    registered: {
                        clip: function(e, t, i) {
                            switch (e) {
                                case "name":
                                    return "clip";
                                case "extract":
                                    var o;
                                    return z.RegEx.wrappedValueAlreadyExtracted.test(i) ? o = i : (o = i.toString().match(z.RegEx.valueUnwrap), o = o ? o[1].replace(/,(\s+)?/g, " ") : i), o;
                                case "inject":
                                    return "rect(" + i + ")"
                            }
                        },
                        blur: function(e, t, i) {
                            switch (e) {
                                case "name":
                                    return _.State.isFirefox ? "filter" : "-webkit-filter";
                                case "extract":
                                    var o = parseFloat(i);
                                    if (!o && 0 !== o) {
                                        var n = i.toString().match(/blur\(([0-9]+[A-z]+)\)/i);
                                        o = n ? n[1] : 0
                                    }
                                    return o;
                                case "inject":
                                    return parseFloat(i) ? "blur(" + i + ")" : "none"
                            }
                        },
                        opacity: function(e, t, i) {
                            if (m <= 8) switch (e) {
                                case "name":
                                    return "filter";
                                case "extract":
                                    var o = i.toString().match(/alpha\(opacity=(.*)\)/i);
                                    return i = o ? o[1] / 100 : 1;
                                case "inject":
                                    return t.style.zoom = 1, parseFloat(i) >= 1 ? "" : "alpha(opacity=" + parseInt(100 * parseFloat(i), 10) + ")"
                            } else switch (e) {
                                case "name":
                                    return "opacity";
                                case "extract":
                                case "inject":
                                    return i
                            }
                        }
                    },
                    register: function() {
                        function e(e, t, i) {
                            if ("border-box" === z.getPropertyValue(t, "boxSizing").toString().toLowerCase() === (i || !1)) {
                                var o, n, s = 0,
                                    r = "width" === e ? ["Left", "Right"] : ["Top", "Bottom"],
                                    a = ["padding" + r[0], "padding" + r[1], "border" + r[0] + "Width", "border" + r[1] + "Width"];
                                for (o = 0; o < a.length; o++) n = parseFloat(z.getPropertyValue(t, a[o])), isNaN(n) || (s += n);
                                return i ? -s : s
                            }
                            return 0
                        }

                        function t(t, i) {
                            return function(o, n, s) {
                                switch (o) {
                                    case "name":
                                        return t;
                                    case "extract":
                                        return parseFloat(s) + e(t, n, i);
                                    case "inject":
                                        return parseFloat(s) - e(t, n, i) + "px"
                                }
                            }
                        }
                        m && !(m > 9) || _.State.isGingerbread || (z.Lists.transformsBase = z.Lists.transformsBase.concat(z.Lists.transforms3D));
                        for (var i = 0; i < z.Lists.transformsBase.length; i++) ! function() {
                            var e = z.Lists.transformsBase[i];
                            z.Normalizations.registered[e] = function(t, i, n) {
                                switch (t) {
                                    case "name":
                                        return "transform";
                                    case "extract":
                                        return r(i) === o || r(i).transformCache[e] === o ? /^scale/i.test(e) ? 1 : 0 : r(i).transformCache[e].replace(/[()]/g, "");
                                    case "inject":
                                        var s = !1;
                                        switch (e.substr(0, e.length - 1)) {
                                            case "translate":
                                                s = !/(%|px|em|rem|vw|vh|\d)$/i.test(n);
                                                break;
                                            case "scal":
                                            case "scale":
                                                _.State.isAndroid && r(i).transformCache[e] === o && n < 1 && (n = 1), s = !/(\d)$/i.test(n);
                                                break;
                                            case "skew":
                                            case "rotate":
                                                s = !/(deg|\d)$/i.test(n)
                                        }
                                        return s || (r(i).transformCache[e] = "(" + n + ")"), r(i).transformCache[e]
                                }
                            }
                        }();
                        for (var n = 0; n < z.Lists.colors.length; n++) ! function() {
                            var e = z.Lists.colors[n];
                            z.Normalizations.registered[e] = function(t, i, n) {
                                switch (t) {
                                    case "name":
                                        return e;
                                    case "extract":
                                        var s;
                                        if (z.RegEx.wrappedValueAlreadyExtracted.test(n)) s = n;
                                        else {
                                            var r, a = {
                                                black: "rgb(0, 0, 0)",
                                                blue: "rgb(0, 0, 255)",
                                                gray: "rgb(128, 128, 128)",
                                                green: "rgb(0, 128, 0)",
                                                red: "rgb(255, 0, 0)",
                                                white: "rgb(255, 255, 255)"
                                            };
                                            /^[A-z]+$/i.test(n) ? r = a[n] !== o ? a[n] : a.black : z.RegEx.isHex.test(n) ? r = "rgb(" + z.Values.hexToRgb(n).join(" ") + ")" : /^rgba?\(/i.test(n) || (r = a.black), s = (r || n).toString().match(z.RegEx.valueUnwrap)[1].replace(/,(\s+)?/g, " ")
                                        }
                                        return (!m || m > 8) && 3 === s.split(" ").length && (s += " 1"), s;
                                    case "inject":
                                        return /^rgb/.test(n) ? n : (m <= 8 ? 4 === n.split(" ").length && (n = n.split(/\s+/).slice(0, 3).join(" ")) : 3 === n.split(" ").length && (n += " 1"), (m <= 8 ? "rgb" : "rgba") + "(" + n.replace(/\s+/g, ",").replace(/\.(\d)+(?=,)/g, "") + ")")
                                }
                            }
                        }();
                        z.Normalizations.registered.innerWidth = t("width", !0), z.Normalizations.registered.innerHeight = t("height", !0), z.Normalizations.registered.outerWidth = t("width"), z.Normalizations.registered.outerHeight = t("height")
                    }
                },
                Names: {
                    camelCase: function(e) {
                        return e.replace(/-(\w)/g, function(e, t) {
                            return t.toUpperCase()
                        })
                    },
                    SVGAttribute: function(e) {
                        var t = "width|height|x|y|cx|cy|r|rx|ry|x1|x2|y1|y2";
                        return (m || _.State.isAndroid && !_.State.isChrome) && (t += "|transform"), new RegExp("^(" + t + ")$", "i").test(e)
                    },
                    prefixCheck: function(e) {
                        if (_.State.prefixMatches[e]) return [_.State.prefixMatches[e], !0];
                        for (var t = ["", "Webkit", "Moz", "ms", "O"], i = 0, o = t.length; i < o; i++) {
                            var n;
                            if (n = 0 === i ? e : t[i] + e.replace(/^\w/, function(e) {
                                    return e.toUpperCase()
                                }), b.isString(_.State.prefixElement.style[n])) return _.State.prefixMatches[e] = n, [n, !0]
                        }
                        return [e, !1]
                    }
                },
                Values: {
                    hexToRgb: function(e) {
                        var t, i = /^#?([a-f\d])([a-f\d])([a-f\d])$/i,
                            o = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i;
                        return e = e.replace(i, function(e, t, i, o) {
                            return t + t + i + i + o + o
                        }), t = o.exec(e), t ? [parseInt(t[1], 16), parseInt(t[2], 16), parseInt(t[3], 16)] : [0, 0, 0]
                    },
                    isCSSNullValue: function(e) {
                        return !e || /^(none|auto|transparent|(rgba\(0, ?0, ?0, ?0\)))$/i.test(e)
                    },
                    getUnitType: function(e) {
                        return /^(rotate|skew)/i.test(e) ? "deg" : /(^(scale|scaleX|scaleY|scaleZ|alpha|flexGrow|flexHeight|zIndex|fontWeight)$)|((opacity|red|green|blue|alpha)$)/i.test(e) ? "" : "px"
                    },
                    getDisplayType: function(e) {
                        var t = e && e.tagName.toString().toLowerCase();
                        return /^(b|big|i|small|tt|abbr|acronym|cite|code|dfn|em|kbd|strong|samp|var|a|bdo|br|img|map|object|q|script|span|sub|sup|button|input|label|select|textarea)$/i.test(t) ? "inline" : /^(li)$/i.test(t) ? "list-item" : /^(tr)$/i.test(t) ? "table-row" : /^(table)$/i.test(t) ? "table" : /^(tbody)$/i.test(t) ? "table-row-group" : "block"
                    },
                    addClass: function(e, t) {
                        if (e)
                            if (e.classList) e.classList.add(t);
                            else if (b.isString(e.className)) e.className += (e.className.length ? " " : "") + t;
                        else {
                            var i = e.getAttribute(m <= 7 ? "className" : "class") || "";
                            e.setAttribute("class", i + (i ? " " : "") + t)
                        }
                    },
                    removeClass: function(e, t) {
                        if (e)
                            if (e.classList) e.classList.remove(t);
                            else if (b.isString(e.className)) e.className = e.className.toString().replace(new RegExp("(^|\\s)" + t.split(" ").join("|") + "(\\s|$)", "gi"), " ");
                        else {
                            var i = e.getAttribute(m <= 7 ? "className" : "class") || "";
                            e.setAttribute("class", i.replace(new RegExp("(^|s)" + t.split(" ").join("|") + "(s|$)", "gi"), " "))
                        }
                    }
                },
                getPropertyValue: function(e, i, n, s) {
                    function a(e, i) {
                        var n = 0;
                        if (m <= 8) n = h.css(e, i);
                        else {
                            var l = !1;
                            /^(width|height)$/.test(i) && 0 === z.getPropertyValue(e, "display") && (l = !0, z.setPropertyValue(e, "display", z.Values.getDisplayType(e)));
                            var d = function() {
                                l && z.setPropertyValue(e, "display", "none")
                            };
                            if (!s) {
                                if ("height" === i && "border-box" !== z.getPropertyValue(e, "boxSizing").toString().toLowerCase()) {
                                    var c = e.offsetHeight - (parseFloat(z.getPropertyValue(e, "borderTopWidth")) || 0) - (parseFloat(z.getPropertyValue(e, "borderBottomWidth")) || 0) - (parseFloat(z.getPropertyValue(e, "paddingTop")) || 0) - (parseFloat(z.getPropertyValue(e, "paddingBottom")) || 0);
                                    return d(), c
                                }
                                if ("width" === i && "border-box" !== z.getPropertyValue(e, "boxSizing").toString().toLowerCase()) {
                                    var u = e.offsetWidth - (parseFloat(z.getPropertyValue(e, "borderLeftWidth")) || 0) - (parseFloat(z.getPropertyValue(e, "borderRightWidth")) || 0) - (parseFloat(z.getPropertyValue(e, "paddingLeft")) || 0) - (parseFloat(z.getPropertyValue(e, "paddingRight")) || 0);
                                    return d(), u
                                }
                            }
                            var f;
                            f = r(e) === o ? t.getComputedStyle(e, null) : r(e).computedStyle ? r(e).computedStyle : r(e).computedStyle = t.getComputedStyle(e, null), "borderColor" === i && (i = "borderTopColor"), n = 9 === m && "filter" === i ? f.getPropertyValue(i) : f[i], "" !== n && null !== n || (n = e.style[i]), d()
                        }
                        if ("auto" === n && /^(top|right|bottom|left)$/i.test(i)) {
                            var p = a(e, "position");
                            ("fixed" === p || "absolute" === p && /top|left/i.test(i)) && (n = h(e).position()[i] + "px")
                        }
                        return n
                    }
                    var l;
                    if (z.Hooks.registered[i]) {
                        var d = i,
                            c = z.Hooks.getRoot(d);
                        n === o && (n = z.getPropertyValue(e, z.Names.prefixCheck(c)[0])), z.Normalizations.registered[c] && (n = z.Normalizations.registered[c]("extract", e, n)), l = z.Hooks.extractValue(d, n)
                    } else if (z.Normalizations.registered[i]) {
                        var u, f;
                        u = z.Normalizations.registered[i]("name", e), "transform" !== u && (f = a(e, z.Names.prefixCheck(u)[0]), z.Values.isCSSNullValue(f) && z.Hooks.templates[i] && (f = z.Hooks.templates[i][1])), l = z.Normalizations.registered[i]("extract", e, f)
                    }
                    if (!/^[\d-]/.test(l)) {
                        var p = r(e);
                        if (p && p.isSVG && z.Names.SVGAttribute(i))
                            if (/^(height|width)$/i.test(i)) try {
                                l = e.getBBox()[i]
                            } catch (e) {
                                l = 0
                            } else l = e.getAttribute(i);
                            else l = a(e, z.Names.prefixCheck(i)[0])
                    }
                    return z.Values.isCSSNullValue(l) && (l = 0), _.debug, l
                },
                setPropertyValue: function(e, i, o, n, s) {
                    var a = i;
                    if ("scroll" === i) s.container ? s.container["scroll" + s.direction] = o : "Left" === s.direction ? t.scrollTo(o, s.alternateValue) : t.scrollTo(s.alternateValue, o);
                    else if (z.Normalizations.registered[i] && "transform" === z.Normalizations.registered[i]("name", e)) z.Normalizations.registered[i]("inject", e, o), a = "transform", o = r(e).transformCache[i];
                    else {
                        if (z.Hooks.registered[i]) {
                            var l = i,
                                d = z.Hooks.getRoot(i);
                            n = n || z.getPropertyValue(e, d), o = z.Hooks.injectValue(l, o, n), i = d
                        }
                        if (z.Normalizations.registered[i] && (o = z.Normalizations.registered[i]("inject", e, o), i = z.Normalizations.registered[i]("name", e)), a = z.Names.prefixCheck(i)[0], m <= 8) try {
                            e.style[a] = o
                        } catch (e) {
                            _.debug
                        } else {
                            var c = r(e);
                            c && c.isSVG && z.Names.SVGAttribute(i) ? e.setAttribute(i, o) : e.style[a] = o
                        }
                        _.debug
                    }
                    return [a, o]
                },
                flushTransformCache: function(e) {
                    var t = "",
                        i = r(e);
                    if ((m || _.State.isAndroid && !_.State.isChrome) && i && i.isSVG) {
                        var o = function(t) {
                                return parseFloat(z.getPropertyValue(e, t))
                            },
                            n = {
                                translate: [o("translateX"), o("translateY")],
                                skewX: [o("skewX")],
                                skewY: [o("skewY")],
                                scale: 1 !== o("scale") ? [o("scale"), o("scale")] : [o("scaleX"), o("scaleY")],
                                rotate: [o("rotateZ"), 0, 0]
                            };
                        h.each(r(e).transformCache, function(e) {
                            /^translate/i.test(e) ? e = "translate" : /^scale/i.test(e) ? e = "scale" : /^rotate/i.test(e) && (e = "rotate"), n[e] && (t += e + "(" + n[e].join(" ") + ") ", delete n[e])
                        })
                    } else {
                        var s, a;
                        h.each(r(e).transformCache, function(i) {
                            if (s = r(e).transformCache[i], "transformPerspective" === i) return a = s, !0;
                            9 === m && "rotateZ" === i && (i = "rotate"), t += i + s + " "
                        }), a && (t = "perspective" + a + " " + t)
                    }
                    z.setPropertyValue(e, "transform", t)
                }
            };
            z.Hooks.register(), z.Normalizations.register(), _.hook = function(e, t, i) {
                var n;
                return e = s(e), h.each(e, function(e, s) {
                    if (r(s) === o && _.init(s), i === o) n === o && (n = z.getPropertyValue(s, t));
                    else {
                        var a = z.setPropertyValue(s, t, i);
                        "transform" === a[0] && _.CSS.flushTransformCache(s), n = a
                    }
                }), n
            };
            var C = function e() {
                function n() {
                    return m ? C.promise || null : g
                }

                function d(e, n) {
                    function s(s) {
                        var c, p;
                        if (l.begin && 0 === O) try {
                            l.begin.call(y, y)
                        } catch (e) {
                            setTimeout(function() {
                                throw e
                            }, 1)
                        }
                        if ("scroll" === W) {
                            var m, g, v, x = /^x$/i.test(l.axis) ? "Left" : "Top",
                                k = parseFloat(l.offset) || 0;
                            l.container ? b.isWrapped(l.container) || b.isNode(l.container) ? (l.container = l.container[0] || l.container, m = l.container["scroll" + x], v = m + h(e).position()[x.toLowerCase()] + k) : l.container = null : (m = _.State.scrollAnchor[_.State["scrollProperty" + x]], g = _.State.scrollAnchor[_.State["scrollProperty" + ("Left" === x ? "Top" : "Left")]], v = h(e).offset()[x.toLowerCase()] + k), d = {
                                scroll: {
                                    rootPropertyValue: !1,
                                    startValue: m,
                                    currentValue: m,
                                    endValue: v,
                                    unitType: "",
                                    easing: l.easing,
                                    scrollData: {
                                        container: l.container,
                                        direction: x,
                                        alternateValue: g
                                    }
                                },
                                element: e
                            }, _.debug
                        } else if ("reverse" === W) {
                            if (!(c = r(e))) return;
                            if (!c.tweensContainer) return void h.dequeue(e, l.queue);
                            "none" === c.opts.display && (c.opts.display = "auto"), "hidden" === c.opts.visibility && (c.opts.visibility = "visible"), c.opts.loop = !1, c.opts.begin = null, c.opts.complete = null, T.easing || delete l.easing, T.duration || delete l.duration, l = h.extend({}, c.opts, l), p = h.extend(!0, {}, c ? c.tweensContainer : null);
                            for (var A in p)
                                if (p.hasOwnProperty(A) && "element" !== A) {
                                    var L = p[A].startValue;
                                    p[A].startValue = p[A].currentValue = p[A].endValue, p[A].endValue = L, b.isEmptyObject(T) || (p[A].easing = l.easing), _.debug
                                } d = p
                        } else if ("start" === W) {
                            c = r(e), c && c.tweensContainer && !0 === c.isAnimating && (p = c.tweensContainer);
                            var P = function(n, s) {
                                var r, u = z.Hooks.getRoot(n),
                                    f = !1,
                                    m = s[0],
                                    g = s[1],
                                    v = s[2];
                                if (!(c && c.isSVG || "tween" === u || !1 !== z.Names.prefixCheck(u)[1] || z.Normalizations.registered[u] !== o)) return void _.debug;
                                (l.display !== o && null !== l.display && "none" !== l.display || l.visibility !== o && "hidden" !== l.visibility) && /opacity|filter/.test(n) && !v && 0 !== m && (v = 0), l._cacheValues && p && p[n] ? (v === o && (v = p[n].endValue + p[n].unitType), f = c.rootPropertyValueCache[u]) : z.Hooks.registered[n] ? v === o ? (f = z.getPropertyValue(e, u), v = z.getPropertyValue(e, n, f)) : f = z.Hooks.templates[u][1] : v === o && (v = z.getPropertyValue(e, n));
                                var y, w, S, x = !1,
                                    T = function(e, t) {
                                        var i, o;
                                        return o = (t || "0").toString().toLowerCase().replace(/[%A-z]+$/, function(e) {
                                            return i = e, ""
                                        }), i || (i = z.Values.getUnitType(e)), [o, i]
                                    };
                                if (v !== m && b.isString(v) && b.isString(m)) {
                                    r = "";
                                    var k = 0,
                                        C = 0,
                                        E = [],
                                        O = [],
                                        A = 0,
                                        L = 0,
                                        W = 0;
                                    for (v = z.Hooks.fixColors(v), m = z.Hooks.fixColors(m); k < v.length && C < m.length;) {
                                        var P = v[k],
                                            $ = m[C];
                                        if (/[\d\.-]/.test(P) && /[\d\.-]/.test($)) {
                                            for (var I = P, H = $, N = ".", D = "."; ++k < v.length;) {
                                                if ((P = v[k]) === N) N = "..";
                                                else if (!/\d/.test(P)) break;
                                                I += P
                                            }
                                            for (; ++C < m.length;) {
                                                if (($ = m[C]) === D) D = "..";
                                                else if (!/\d/.test($)) break;
                                                H += $
                                            }
                                            var F = z.Hooks.getUnit(v, k),
                                                B = z.Hooks.getUnit(m, C);
                                            if (k += F.length, C += B.length, F === B) I === H ? r += I + F : (r += "{" + E.length + (L ? "!" : "") + "}" + F, E.push(parseFloat(I)), O.push(parseFloat(H)));
                                            else {
                                                var R = parseFloat(I),
                                                    M = parseFloat(H);
                                                r += (A < 5 ? "calc" : "") + "(" + (R ? "{" + E.length + (L ? "!" : "") + "}" : "0") + F + " + " + (M ? "{" + (E.length + (R ? 1 : 0)) + (L ? "!" : "") + "}" : "0") + B + ")", R && (E.push(R), O.push(0)), M && (E.push(0), O.push(M))
                                            }
                                        } else {
                                            if (P !== $) {
                                                A = 0;
                                                break
                                            }
                                            r += P, k++, C++, 0 === A && "c" === P || 1 === A && "a" === P || 2 === A && "l" === P || 3 === A && "c" === P || A >= 4 && "(" === P ? A++ : (A && A < 5 || A >= 4 && ")" === P && --A < 5) && (A = 0), 0 === L && "r" === P || 1 === L && "g" === P || 2 === L && "b" === P || 3 === L && "a" === P || L >= 3 && "(" === P ? (3 === L && "a" === P && (W = 1), L++) : W && "," === P ? ++W > 3 && (L = W = 0) : (W && L < (W ? 5 : 4) || L >= (W ? 4 : 3) && ")" === P && --L < (W ? 5 : 4)) && (L = W = 0)
                                        }
                                    }
                                    k === v.length && C === m.length || (_.debug, r = o), r && (E.length ? (_.debug, v = E, m = O, w = S = "") : r = o)
                                }
                                r || (y = T(n, v), v = y[0], S = y[1], y = T(n, m), m = y[0].replace(/^([+-\/*])=/, function(e, t) {
                                    return x = t, ""
                                }), w = y[1], v = parseFloat(v) || 0, m = parseFloat(m) || 0, "%" === w && (/^(fontSize|lineHeight)$/.test(n) ? (m /= 100, w = "em") : /^scale/.test(n) ? (m /= 100, w = "") : /(Red|Green|Blue)$/i.test(n) && (m = m / 100 * 255, w = "")));
                                if (/[\/*]/.test(x)) w = S;
                                else if (S !== w && 0 !== v)
                                    if (0 === m) w = S;
                                    else {
                                        a = a || function() {
                                            var o = {
                                                    myParent: e.parentNode || i.body,
                                                    position: z.getPropertyValue(e, "position"),
                                                    fontSize: z.getPropertyValue(e, "fontSize")
                                                },
                                                n = o.position === j.lastPosition && o.myParent === j.lastParent,
                                                s = o.fontSize === j.lastFontSize;
                                            j.lastParent = o.myParent, j.lastPosition = o.position, j.lastFontSize = o.fontSize;
                                            var r = {};
                                            if (s && n) r.emToPx = j.lastEmToPx, r.percentToPxWidth = j.lastPercentToPxWidth, r.percentToPxHeight = j.lastPercentToPxHeight;
                                            else {
                                                var a = c && c.isSVG ? i.createElementNS("http://www.w3.org/2000/svg", "rect") : i.createElement("div");
                                                _.init(a), o.myParent.appendChild(a), h.each(["overflow", "overflowX", "overflowY"], function(e, t) {
                                                    _.CSS.setPropertyValue(a, t, "hidden")
                                                }), _.CSS.setPropertyValue(a, "position", o.position), _.CSS.setPropertyValue(a, "fontSize", o.fontSize), _.CSS.setPropertyValue(a, "boxSizing", "content-box"), h.each(["minWidth", "maxWidth", "width", "minHeight", "maxHeight", "height"], function(e, t) {
                                                    _.CSS.setPropertyValue(a, t, "100%")
                                                }), _.CSS.setPropertyValue(a, "paddingLeft", "100em"), r.percentToPxWidth = j.lastPercentToPxWidth = (parseFloat(z.getPropertyValue(a, "width", null, !0)) || 1) / 100, r.percentToPxHeight = j.lastPercentToPxHeight = (parseFloat(z.getPropertyValue(a, "height", null, !0)) || 1) / 100, r.emToPx = j.lastEmToPx = (parseFloat(z.getPropertyValue(a, "paddingLeft")) || 1) / 100, o.myParent.removeChild(a)
                                            }
                                            return null === j.remToPx && (j.remToPx = parseFloat(z.getPropertyValue(i.body, "fontSize")) || 16), null === j.vwToPx && (j.vwToPx = parseFloat(t.innerWidth) / 100, j.vhToPx = parseFloat(t.innerHeight) / 100), r.remToPx = j.remToPx, r.vwToPx = j.vwToPx, r.vhToPx = j.vhToPx, _.debug, r
                                        }();
                                        var V = /margin|padding|left|right|width|text|word|letter/i.test(n) || /X$/.test(n) || "x" === n ? "x" : "y";
                                        switch (S) {
                                            case "%":
                                                v *= "x" === V ? a.percentToPxWidth : a.percentToPxHeight;
                                                break;
                                            case "px":
                                                break;
                                            default:
                                                v *= a[S + "ToPx"]
                                        }
                                        switch (w) {
                                            case "%":
                                                v *= 1 / ("x" === V ? a.percentToPxWidth : a.percentToPxHeight);
                                                break;
                                            case "px":
                                                break;
                                            default:
                                                v *= 1 / a[w + "ToPx"]
                                        }
                                    } switch (x) {
                                    case "+":
                                        m = v + m;
                                        break;
                                    case "-":
                                        m = v - m;
                                        break;
                                    case "*":
                                        m *= v;
                                        break;
                                    case "/":
                                        m = v / m
                                }
                                d[n] = {
                                    rootPropertyValue: f,
                                    startValue: v,
                                    currentValue: v,
                                    endValue: m,
                                    unitType: w,
                                    easing: g
                                }, r && (d[n].pattern = r), _.debug
                            };
                            for (var $ in S)
                                if (S.hasOwnProperty($)) {
                                    var I = z.Names.camelCase($),
                                        H = function(t, i) {
                                            var o, s, r;
                                            return b.isFunction(t) && (t = t.call(e, n, E)), b.isArray(t) ? (o = t[0], !b.isArray(t[1]) && /^[\d-]/.test(t[1]) || b.isFunction(t[1]) || z.RegEx.isHex.test(t[1]) ? r = t[1] : b.isString(t[1]) && !z.RegEx.isHex.test(t[1]) && _.Easings[t[1]] || b.isArray(t[1]) ? (s = i ? t[1] : u(t[1], l.duration), r = t[2]) : r = t[1] || t[2]) : o = t, i || (s = s || l.easing), b.isFunction(o) && (o = o.call(e, n, E)), b.isFunction(r) && (r = r.call(e, n, E)), [o || 0, s, r]
                                        }(S[$]);
                                    if (w(z.Lists.colors, I)) {
                                        var N = H[0],
                                            F = H[1],
                                            B = H[2];
                                        if (z.RegEx.isHex.test(N)) {
                                            for (var R = ["Red", "Green", "Blue"], M = z.Values.hexToRgb(N), V = B ? z.Values.hexToRgb(B) : o, q = 0; q < R.length; q++) {
                                                var U = [M[q]];
                                                F && U.push(F), V !== o && U.push(V[q]), P(I + R[q], U)
                                            }
                                            continue
                                        }
                                    }
                                    P(I, H)
                                } d.element = e
                        }
                        d.element && (z.Values.addClass(e, "velocity-animating"), D.push(d), c = r(e), c && ("" === l.queue && (c.tweensContainer = d, c.opts = l), c.isAnimating = !0), O === E - 1 ? (_.State.calls.push([D, y, l, null, C.resolver, null, 0]), !1 === _.State.isTicking && (_.State.isTicking = !0, f())) : O++)
                    }
                    var a, l = h.extend({}, _.defaults, T),
                        d = {};
                    switch (r(e) === o && _.init(e), parseFloat(l.delay) && !1 !== l.queue && h.queue(e, l.queue, function(t, i) {
                            if (!0 === i) return !0;
                            _.velocityQueueEntryFlag = !0;
                            var o = _.State.delayedElements.count++;
                            _.State.delayedElements[o] = e;
                            var n = function(e) {
                                return function() {
                                    _.State.delayedElements[e] = !1, t()
                                }
                            }(o);
                            r(e).delayBegin = (new Date).getTime(), r(e).delay = parseFloat(l.delay), r(e).delayTimer = {
                                setTimeout: setTimeout(t, parseFloat(l.delay)),
                                next: n
                            }
                        }), l.duration.toString().toLowerCase()) {
                        case "fast":
                            l.duration = 200;
                            break;
                        case "normal":
                            l.duration = x;
                            break;
                        case "slow":
                            l.duration = 600;
                            break;
                        default:
                            l.duration = parseFloat(l.duration) || 1
                    }
                    if (!1 !== _.mock && (!0 === _.mock ? l.duration = l.delay = 1 : (l.duration *= parseFloat(_.mock) || 1, l.delay *= parseFloat(_.mock) || 1)), l.easing = u(l.easing, l.duration), l.begin && !b.isFunction(l.begin) && (l.begin = null), l.progress && !b.isFunction(l.progress) && (l.progress = null), l.complete && !b.isFunction(l.complete) && (l.complete = null), l.display !== o && null !== l.display && (l.display = l.display.toString().toLowerCase(), "auto" === l.display && (l.display = _.CSS.Values.getDisplayType(e))), l.visibility !== o && null !== l.visibility && (l.visibility = l.visibility.toString().toLowerCase()), l.mobileHA = l.mobileHA && _.State.isMobile && !_.State.isGingerbread, !1 === l.queue)
                        if (l.delay) {
                            var c = _.State.delayedElements.count++;
                            _.State.delayedElements[c] = e;
                            var p = function(e) {
                                return function() {
                                    _.State.delayedElements[e] = !1, s()
                                }
                            }(c);
                            r(e).delayBegin = (new Date).getTime(), r(e).delay = parseFloat(l.delay), r(e).delayTimer = {
                                setTimeout: setTimeout(s, parseFloat(l.delay)),
                                next: p
                            }
                        } else s();
                    else h.queue(e, l.queue, function(e, t) {
                        if (!0 === t) return C.promise && C.resolver(y), !0;
                        _.velocityQueueEntryFlag = !0, s(e)
                    });
                    "" !== l.queue && "fx" !== l.queue || "inprogress" === h.queue(e)[0] || h.dequeue(e)
                }
                var c, m, g, v, y, S, T, k = arguments[0] && (arguments[0].p || h.isPlainObject(arguments[0].properties) && !arguments[0].properties.names || b.isString(arguments[0].properties));
                b.isWrapped(this) ? (m = !1, v = 0, y = this, g = this) : (m = !0, v = 1, y = k ? arguments[0].elements || arguments[0].e : arguments[0]);
                var C = {
                    promise: null,
                    resolver: null,
                    rejecter: null
                };
                if (m && _.Promise && (C.promise = new _.Promise(function(e, t) {
                        C.resolver = e, C.rejecter = t
                    })), k ? (S = arguments[0].properties || arguments[0].p, T = arguments[0].options || arguments[0].o) : (S = arguments[v], T = arguments[v + 1]), !(y = s(y))) return void(C.promise && (S && T && !1 === T.promiseRejectEmpty ? C.resolver() : C.rejecter()));
                var E = y.length,
                    O = 0;
                if (!/^(stop|finish|finishAll|pause|resume)$/i.test(S) && !h.isPlainObject(T)) {
                    var A = v + 1;
                    T = {};
                    for (var L = A; L < arguments.length; L++) b.isArray(arguments[L]) || !/^(fast|normal|slow)$/i.test(arguments[L]) && !/^\d/.test(arguments[L]) ? b.isString(arguments[L]) || b.isArray(arguments[L]) ? T.easing = arguments[L] : b.isFunction(arguments[L]) && (T.complete = arguments[L]) : T.duration = arguments[L]
                }
                var W;
                switch (S) {
                    case "scroll":
                        W = "scroll";
                        break;
                    case "reverse":
                        W = "reverse";
                        break;
                    case "pause":
                        var P = (new Date).getTime();
                        return h.each(y, function(e, t) {
                            a(t, P)
                        }), h.each(_.State.calls, function(e, t) {
                            var i = !1;
                            t && h.each(t[1], function(e, n) {
                                var s = T === o ? "" : T;
                                return !0 !== s && t[2].queue !== s && (T !== o || !1 !== t[2].queue) || (h.each(y, function(e, o) {
                                    if (o === n) return t[5] = {
                                        resume: !1
                                    }, i = !0, !1
                                }), !i && void 0)
                            })
                        }), n();
                    case "resume":
                        return h.each(y, function(e, t) {
                            l(t, P)
                        }), h.each(_.State.calls, function(e, t) {
                            var i = !1;
                            t && h.each(t[1], function(e, n) {
                                var s = T === o ? "" : T;
                                return !0 !== s && t[2].queue !== s && (T !== o || !1 !== t[2].queue) || (!t[5] || (h.each(y, function(e, o) {
                                    if (o === n) return t[5].resume = !0, i = !0, !1
                                }), !i && void 0))
                            })
                        }), n();
                    case "finish":
                    case "finishAll":
                    case "stop":
                        h.each(y, function(e, t) {
                            r(t) && r(t).delayTimer && (clearTimeout(r(t).delayTimer.setTimeout), r(t).delayTimer.next && r(t).delayTimer.next(), delete r(t).delayTimer), "finishAll" !== S || !0 !== T && !b.isString(T) || (h.each(h.queue(t, b.isString(T) ? T : ""), function(e, t) {
                                b.isFunction(t) && t()
                            }), h.queue(t, b.isString(T) ? T : "", []))
                        });
                        var $ = [];
                        return h.each(_.State.calls, function(e, t) {
                            t && h.each(t[1], function(i, n) {
                                var s = T === o ? "" : T;
                                if (!0 !== s && t[2].queue !== s && (T !== o || !1 !== t[2].queue)) return !0;
                                h.each(y, function(i, o) {
                                    if (o === n)
                                        if ((!0 === T || b.isString(T)) && (h.each(h.queue(o, b.isString(T) ? T : ""), function(e, t) {
                                                b.isFunction(t) && t(null, !0)
                                            }), h.queue(o, b.isString(T) ? T : "", [])), "stop" === S) {
                                            var a = r(o);
                                            a && a.tweensContainer && (!0 === s || "" === s) && h.each(a.tweensContainer, function(e, t) {
                                                t.endValue = t.currentValue
                                            }), $.push(e)
                                        } else "finish" !== S && "finishAll" !== S || (t[2].duration = 1)
                                })
                            })
                        }), "stop" === S && (h.each($, function(e, t) {
                            p(t, !0)
                        }), C.promise && C.resolver(y)), n();
                    default:
                        if (!h.isPlainObject(S) || b.isEmptyObject(S)) {
                            if (b.isString(S) && _.Redirects[S]) {
                                c = h.extend({}, T);
                                var I = c.duration,
                                    H = c.delay || 0;
                                return !0 === c.backwards && (y = h.extend(!0, [], y).reverse()), h.each(y, function(e, t) {
                                    parseFloat(c.stagger) ? c.delay = H + parseFloat(c.stagger) * e : b.isFunction(c.stagger) && (c.delay = H + c.stagger.call(t, e, E)), c.drag && (c.duration = parseFloat(I) || (/^(callout|transition)/.test(S) ? 1e3 : x), c.duration = Math.max(c.duration * (c.backwards ? 1 - e / E : (e + 1) / E), .75 * c.duration, 200)), _.Redirects[S].call(t, t, c || {}, e, E, y, C.promise ? C : o)
                                }), n()
                            }
                            var N = "Velocity: First argument (" + S + ") was not a property map, a known action, or a registered redirect. Aborting.";
                            return C.promise ? C.rejecter(new Error(N)) : t.console, n()
                        }
                        W = "start"
                }
                var j = {
                        lastParent: null,
                        lastPosition: null,
                        lastFontSize: null,
                        lastPercentToPxWidth: null,
                        lastPercentToPxHeight: null,
                        lastEmToPx: null,
                        remToPx: null,
                        vwToPx: null,
                        vhToPx: null
                    },
                    D = [];
                h.each(y, function(e, t) {
                    b.isNode(t) && d(t, e)
                }), c = h.extend({}, _.defaults, T), c.loop = parseInt(c.loop, 10);
                var F = 2 * c.loop - 1;
                if (c.loop)
                    for (var B = 0; B < F; B++) {
                        var R = {
                            delay: c.delay,
                            progress: c.progress
                        };
                        B === F - 1 && (R.display = c.display, R.visibility = c.visibility, R.complete = c.complete), e(y, "reverse", R)
                    }
                return n()
            };
            _ = h.extend(C, _), _.animate = C;
            var E = t.requestAnimationFrame || g;
            if (!_.State.isMobile && i.hidden !== o) {
                var O = function() {
                    i.hidden ? (E = function(e) {
                        return setTimeout(function() {
                            e(!0)
                        }, 16)
                    }, f()) : E = t.requestAnimationFrame || g
                };
                O(), i.addEventListener("visibilitychange", O)
            }
            return e.Velocity = _, e !== t && (e.fn.velocity = C, e.fn.velocity.defaults = _.defaults), h.each(["Down", "Up"], function(e, t) {
                _.Redirects["slide" + t] = function(e, i, n, s, r, a) {
                    var l = h.extend({}, i),
                        d = l.begin,
                        c = l.complete,
                        u = {},
                        f = {
                            height: "",
                            marginTop: "",
                            marginBottom: "",
                            paddingTop: "",
                            paddingBottom: ""
                        };
                    l.display === o && (l.display = "Down" === t ? "inline" === _.CSS.Values.getDisplayType(e) ? "inline-block" : "block" : "none"), l.begin = function() {
                        0 === n && d && d.call(r, r);
                        for (var i in f)
                            if (f.hasOwnProperty(i)) {
                                u[i] = e.style[i];
                                var o = z.getPropertyValue(e, i);
                                f[i] = "Down" === t ? [o, 0] : [0, o]
                            } u.overflow = e.style.overflow, e.style.overflow = "hidden"
                    }, l.complete = function() {
                        for (var t in u) u.hasOwnProperty(t) && (e.style[t] = u[t]);
                        n === s - 1 && (c && c.call(r, r), a && a.resolver(r))
                    }, _(e, f, l)
                }
            }), h.each(["In", "Out"], function(e, t) {
                _.Redirects["fade" + t] = function(e, i, n, s, r, a) {
                    var l = h.extend({}, i),
                        d = l.complete,
                        c = {
                            opacity: "In" === t ? 1 : 0
                        };
                    0 !== n && (l.begin = null), l.complete = n !== s - 1 ? null : function() {
                        d && d.call(r, r), a && a.resolver(r)
                    }, l.display === o && (l.display = "In" === t ? "auto" : "none"), _(this, c, l)
                }
            }), _
        }(window.jQuery || window.Zepto || window, window, window ? window.document : void 0)
    })
}, function(e, t, i) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    }
    i(19), i(21), i(18), i(17), i(5), i(10), i(14), i(16), i(4), i(15);
    var n = i(7),
        s = o(n),
        r = i(8),
        a = o(r),
        l = i(9),
        d = o(l),
        c = i(1),
        u = o(c),
        f = i(20),
        p = o(f);
    i(13), i(12), i(11), i(6);
    for (var h in p.default.prototype) u.default[h] = p.default.prototype[h];
    $(document).ready(function() {
        var e = new s.default,
            t = new a.default,
            i = new d.default;
        e.init(), t.init(), i.init(), $("#products").bind("DOMSubtreeModified", function() {
            t.init()
        })
    })
}, function(e, t, i) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    }

    function n() {
        r.default.each((0, r.default)(u), function(e, t) {
            (0, r.default)(t).TouchSpin({
                verticalbuttons: !0,
                verticalupclass: "fa fa-angle-up touchspin-up",
                verticaldownclass: "fa fa-angle-down touchspin-down",
                buttondown_class: "btn btn-touchspin  js-touchspin js-increase-product-quantity",
                buttonup_class: "btn btn-touchspin js-decrease-product-quantity",
                min: parseInt((0, r.default)(t).attr("min"), 10),
                max: 1e6
            })
        }), m.switchErrorStat()
    }
    var s = i(0),
        r = o(s),
        a = i(1),
        l = o(a),
        d = i(23),
        c = o(d);
    l.default.cart = l.default.cart || {}, l.default.cart.active_inputs = null;
    var u = 'input[name="product-quantity-spin"]',
        f = !1,
        p = !1,
        h = "";
    (0, r.default)(document).ready(function() {
        function e(e) {
            return "on.startupspin" === e || "on.startdownspin" === e
        }

        function t(e) {
            return "on.startupspin" === e
        }

        function i(e) {
            var t = e.parents(".bootstrap-touchspin").find(h);
            return t.is(":focus") ? null : t
        }

        function o(e) {
            var t = e.split("-"),
                i = void 0,
                o = void 0,
                n = "";
            for (i = 0; i < t.length; i++) o = t[i], 0 !== i && (o = o.substring(0, 1).toUpperCase() + o.substring(1)), n += o;
            return n
        }

        function s(n, s) {
            if (!e(s)) return {
                url: n.attr("href"),
                type: o(n.data("link-action"))
            };
            var r = i(n);
            if (r) {
                return t(s) ? {
                    url: r.data("up-url"),
                    type: "increaseProductQuantity"
                } : {
                    url: r.data("down-url"),
                    type: "decreaseProductQuantity"
                }
            }
        }

        function a(e, t, i, o) {
            return y(), r.default.ajax({
                url: e,
                method: "POST",
                data: t,
                dataType: "json",
                beforeSend: function(e) {
                    g.push(e)
                }
            }).then(function(e) {
                m.checkUpdateOpertation(e), i.val(e.quantity);
                var t;
                t = i && i.dataset ? i.dataset : e, l.default.emit("updateCart", {
                    reason: t
                })
            }).fail(function(e) {
                l.default.emit("handleError", {
                    eventType: "updateProductQuantityInCart",
                    resp: e
                })
            })
        }

        function d(e) {
            return {
                ajax: "1",
                qty: Math.abs(e),
                action: "update",
                op: f(e)
            }
        }

        function f(e) {
            return e > 0 ? "up" : "down"
        }

        function p(e) {
            var t = (0, r.default)(e.currentTarget),
                i = t.data("update-url"),
                o = t.attr("value"),
                n = t.val();
            if (n != parseInt(n) || n < 0 || isNaN(n)) return void t.val(o);
            var s = n - o;
            0 !== s && (t.attr("value", n), a(i, d(s), t))
        }
        var h = ".js-cart-line-product-quantity",
            g = [];
        l.default.on("updateCart", function() {
            (0, r.default)(".quickview").modal("hide")
        }), l.default.on("updatedCart", function() {
            n()
        }), n();
        var v = (0, r.default)("body"),
            y = function() {
                for (var e; g.length > 0;) e = g.pop(), e.abort()
            },
            w = function(e) {
                return (0, r.default)(e.parents(".bootstrap-touchspin").find("input"))
            },
            b = function(e) {
                e.preventDefault();
                var t = (0, r.default)(e.currentTarget),
                    i = e.currentTarget.dataset,
                    o = s(t, e.namespace),
                    n = {
                        ajax: "1",
                        action: "update"
                    };
                void 0 !== o && (y(), r.default.ajax({
                    url: o.url,
                    method: "POST",
                    data: n,
                    dataType: "json",
                    beforeSend: function(e) {
                        g.push(e)
                    }
                }).then(function(e) {
                    m.checkUpdateOpertation(e), w(t).val(e.quantity), l.default.emit("updateCart", {
                        reason: i
                    })
                }).fail(function(e) {
                    l.default.emit("handleError", {
                        eventType: "updateProductInCart",
                        resp: e,
                        cartAction: o.type
                    })
                }))
            };
        v.on("click", '[data-link-action="delete-from-cart"], [data-link-action="remove-voucher"]', b), v.on("touchspin.on.startdownspin", u, b), v.on("touchspin.on.startupspin", u, b), v.on("keyup", h, (0, c.default)(400, function(e) {
            p(e)
        })), v.on("click", ".js-discount .code", function(e) {
            e.stopPropagation();
            var t = (0, r.default)(e.currentTarget);
            return (0, r.default)("[name=discount_name]").val(t.text()), !1
        })
    });
    var m = {
        switchErrorStat: function() {
            var e = (0, r.default)(".checkout a");
            if (((0, r.default)("#notifications article.alert-danger").length || "" !== h && !f) && e.addClass("disabled"), "" !== h) {
                var t = ' <article class="alert alert-danger" role="alert" data-alert="danger"><ul><li>' + h + "</li></ul></article>";
                (0, r.default)("#notifications").html(t), h = "", p = !1
            } else !f && p && (f = !1, p = !1, (0, r.default)("#notifications").html(""), e.removeClass("disabled"))
        },
        checkUpdateOpertation: function(e) {
            f = e.hasOwnProperty("hasError");
            var t = e.errors || "";
            h = t instanceof Array ? t.join(" ") : t, p = !0
        }
    }
}, function(e, t, i) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    }

    function n() {
        0 !== (0, r.default)(".js-cancel-address").length && (0, r.default)(".checkout-step:not(.js-current-step) .step-title").addClass("not-allowed"), (0, r.default)(".js-terms a").on("click", function(e) {
            e.preventDefault();
            var t = (0, r.default)(e.target).attr("href");
            t && (t += "?content_only=1", r.default.get(t, function(e) {
                (0, r.default)("#modal").find(".modal-content").html((0, r.default)(e).find(".page-cms").contents())
            }).fail(function(e) {
                l.default.emit("handleError", {
                    eventType: "clickTerms",
                    resp: e
                })
            })), (0, r.default)("#modal").modal("show")
        }), (0, r.default)(".js-gift-checkbox").on("click", function(e) {
            (0, r.default)("#gift").collapse("toggle")
        })
    }
    var s = i(0),
        r = o(s),
        a = i(1),
        l = o(a);
    (0, r.default)(document).ready(function() {
        1 === (0, r.default)("body#checkout").length && n(), l.default.on("updatedDeliveryForm", function(e) {
            (0, r.default)(".carrier-extra-content").hide(), e.deliveryOption.find(".carrier-extra-content").slideDown()
        })
    })
}, function(e, t, i) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    }
    var n = i(1),
        s = o(n),
        r = i(0),
        a = o(r);
    s.default.blockcart = s.default.blockcart || {}, s.default.blockcart.showModal = function(e) {
        function t() {
            return (0, a.default)("#blockcart-modal")
        }
        var i = t();
        i.length && i.remove(), (0, a.default)("body").append(e), i = t(), i.modal("show").on("hidden.bs.modal", function(e) {
            s.default.emit("updateProduct", {
                reason: e.currentTarget.dataset
            })
        })
    }
}, function(e, t, i) {
    "use strict";

    function o(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var n = function() {
            function e(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var o = t[i];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }
            return function(t, i, o) {
                return i && e(t.prototype, i), o && e(t, o), t
            }
        }(),
        s = i(0),
        r = function(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }(s),
        a = function() {
            function e() {
                o(this, e)
            }
            return n(e, [{
                key: "init",
                value: function() {
                    this.parentFocus(), this.togglePasswordVisibility()
                }
            }, {
                key: "parentFocus",
                value: function() {
                    (0, r.default)(".js-child-focus").focus(function() {
                        (0, r.default)(this).closest(".js-parent-focus").addClass("focus")
                    }), (0, r.default)(".js-child-focus").focusout(function() {
                        (0, r.default)(this).closest(".js-parent-focus").removeClass("focus")
                    })
                }
            }, {
                key: "togglePasswordVisibility",
                value: function() {
                    (0, r.default)('button[data-action="show-password"]').on("click", function() {
                        var e = (0, r.default)(this).closest(".input-group").children("input.js-visible-password");
                        "password" === e.attr("type") ? (e.attr("type", "text"), (0, r.default)(this).text((0, r.default)(this).data("textHide"))) : (e.attr("type", "password"), (0, r.default)(this).text((0, r.default)(this).data("textShow")))
                    })
                }
            }]), e
        }();
    t.default = a, e.exports = t.default
}, function(e, t, i) {
    "use strict";

    function o(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var n = function() {
            function e(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var o = t[i];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }
            return function(t, i, o) {
                return i && e(t.prototype, i), o && e(t, o), t
            }
        }(),
        s = i(0),
        r = function(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }(s),
        a = function() {
            function e() {
                o(this, e)
            }
            return n(e, [{
                key: "init",
                value: function() {
                    (0, r.default)(".js-product-miniature").each(function(e, t) {
                        var i = (0, r.default)(t).find(".discount-percentage"),
                            o = (0, r.default)(t).find(".on-sale"),
                            n = (0, r.default)(t).find(".new");
                        i.length && (n.css("top", 2 * i.height() + 10), i.css("top", -(0, r.default)(t).find(".thumbnail-container").height() + (0, r.default)(t).find(".product-description").height() + 10)), o.length && (i.css("top", parseFloat(i.css("top")) + o.height() + 10), n.css("top", 2 * i.height() + o.height() + 20)), (0, r.default)(t).find(".color").length > 5 && function() {
                            var e = 0;
                            (0, r.default)(t).find(".color").each(function(t, i) {
                                t > 4 && ((0, r.default)(i).hide(), e++)
                            }), (0, r.default)(t).find(".js-count").append("+" + e)
                        }()
                    })
                }
            }]), e
        }();
    t.default = a, e.exports = t.default
}, function(e, t, i) {
    "use strict";

    function o(e, t) {
        if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
    }
    Object.defineProperty(t, "__esModule", {
        value: !0
    });
    var n = function() {
            function e(e, t) {
                for (var i = 0; i < t.length; i++) {
                    var o = t[i];
                    o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                }
            }
            return function(t, i, o) {
                return i && e(t.prototype, i), o && e(t, o), t
            }
        }(),
        s = i(0),
        r = function(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }(s);
    i(2);
    var a = function() {
        function e() {
            o(this, e)
        }
        return n(e, [{
            key: "init",
            value: function() {
                var e = this,
                    t = (0, r.default)(".js-modal-arrows"),
                    i = (0, r.default)(".js-modal-product-images"),
                    o = (0, r.default)(".on-sale");
                (0, r.default)(".js-modal-thumb").on("click", function(e) {
                    (0, r.default)(".js-modal-thumb").hasClass("selected") && (0, r.default)(".js-modal-thumb").removeClass("selected"), (0, r.default)(e.currentTarget).addClass("selected"), (0, r.default)(".js-modal-product-cover").attr("src", (0, r.default)(e.target).data("image-large-src")), (0, r.default)(".js-modal-product-cover").attr("title", (0, r.default)(e.target).attr("title")), (0, r.default)(".js-modal-product-cover").attr("alt", (0, r.default)(e.target).attr("alt"))
                }), o.length && (0, r.default)("#product").length && (0, r.default)(".new").css("top", o.height() + 10), (0, r.default)(".js-modal-product-images li").length <= 5 ? t.css("opacity", ".2") : t.on("click", function(t) {
                    (0, r.default)(t.target).hasClass("arrow-up") && i.position().top < 0 ? (e.move("up"), (0, r.default)(".js-modal-arrow-down").css("opacity", "1")) : (0, r.default)(t.target).hasClass("arrow-down") && i.position().top + i.height() > (0, r.default)(".js-modal-mask").height() && (e.move("down"), (0, r.default)(".js-modal-arrow-up").css("opacity", "1"))
                })
            }
        }, {
            key: "move",
            value: function(e) {
                var t = (0, r.default)(".js-modal-product-images"),
                    i = (0, r.default)(".js-modal-product-images li img").height() + 10,
                    o = t.position().top;
                t.velocity({
                    translateY: "up" === e ? o + i : o - i
                }, function() {
                    t.position().top >= 0 ? (0, r.default)(".js-modal-arrow-up").css("opacity", ".2") : t.position().top + t.height() <= (0, r.default)(".js-modal-mask").height() && (0, r.default)(".js-modal-arrow-down").css("opacity", ".2")
                })
            }
        }]), e
    }();
    t.default = a, e.exports = t.default
}, function(e, t, i) {
    "use strict";

    function o() {
        (0, r.default)("#order-return-form table thead input[type=checkbox]").on("click", function() {
            var e = (0, r.default)(this).prop("checked");
            (0, r.default)("#order-return-form table tbody input[type=checkbox]").each(function(t, i) {
                (0, r.default)(i).prop("checked", e)
            })
        })
    }

    function n() {
        (0, r.default)("body#order-detail") && o()
    }
    var s = i(0),
        r = function(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }(s);
    (0, r.default)(document).ready(n)
}, function(e, t, i) {
    "use strict";
    ! function(e) {
        var t = 0,
            i = function(t, i) {
                this.options = i, this.$elementFilestyle = [], this.$element = e(t)
            };
        i.prototype = {
            clear: function() {
                this.$element.val(""), this.$elementFilestyle.find(":text").val(""), this.$elementFilestyle.find(".badge").remove()
            },
            destroy: function() {
                this.$element.removeAttr("style").removeData("filestyle"), this.$elementFilestyle.remove()
            },
            disabled: function(e) {
                if (!0 === e) this.options.disabled || (this.$element.attr("disabled", "true"), this.$elementFilestyle.find("label").attr("disabled", "true"), this.options.disabled = !0);
                else {
                    if (!1 !== e) return this.options.disabled;
                    this.options.disabled && (this.$element.removeAttr("disabled"), this.$elementFilestyle.find("label").removeAttr("disabled"), this.options.disabled = !1)
                }
            },
            buttonBefore: function(e) {
                if (!0 === e) this.options.buttonBefore || (this.options.buttonBefore = !0, this.options.input && (this.$elementFilestyle.remove(), this.constructor(), this.pushNameFiles()));
                else {
                    if (!1 !== e) return this.options.buttonBefore;
                    this.options.buttonBefore && (this.options.buttonBefore = !1, this.options.input && (this.$elementFilestyle.remove(), this.constructor(), this.pushNameFiles()))
                }
            },
            icon: function(e) {
                if (!0 === e) this.options.icon || (this.options.icon = !0, this.$elementFilestyle.find("label").prepend(this.htmlIcon()));
                else {
                    if (!1 !== e) return this.options.icon;
                    this.options.icon && (this.options.icon = !1, this.$elementFilestyle.find(".icon-span-filestyle").remove())
                }
            },
            input: function(e) {
                if (!0 === e) this.options.input || (this.options.input = !0, this.options.buttonBefore ? this.$elementFilestyle.append(this.htmlInput()) : this.$elementFilestyle.prepend(this.htmlInput()), this.$elementFilestyle.find(".badge").remove(), this.pushNameFiles(), this.$elementFilestyle.find(".group-span-filestyle").addClass("input-group-btn"));
                else {
                    if (!1 !== e) return this.options.input;
                    if (this.options.input) {
                        this.options.input = !1, this.$elementFilestyle.find(":text").remove();
                        var t = this.pushNameFiles();
                        t.length > 0 && this.options.badge && this.$elementFilestyle.find("label").append(' <span class="badge">' + t.length + "</span>"), this.$elementFilestyle.find(".group-span-filestyle").removeClass("input-group-btn")
                    }
                }
            },
            size: function(e) {
                if (void 0 === e) return this.options.size;
                var t = this.$elementFilestyle.find("label"),
                    i = this.$elementFilestyle.find("input");
                t.removeClass("btn-lg btn-sm"), i.removeClass("input-lg input-sm"), "nr" != e && (t.addClass("btn-" + e), i.addClass("input-" + e))
            },
            placeholder: function(e) {
                if (void 0 === e) return this.options.placeholder;
                this.options.placeholder = e, this.$elementFilestyle.find("input").attr("placeholder", e)
            },
            buttonText: function(e) {
                if (void 0 === e) return this.options.buttonText;
                this.options.buttonText = e, this.$elementFilestyle.find("label .buttonText").html(this.options.buttonText)
            },
            buttonName: function(e) {
                if (void 0 === e) return this.options.buttonName;
                this.options.buttonName = e, this.$elementFilestyle.find("label").attr({
                    class: "btn " + this.options.buttonName
                })
            },
            iconName: function(e) {
                if (void 0 === e) return this.options.iconName;
                this.$elementFilestyle.find(".icon-span-filestyle").attr({
                    class: "icon-span-filestyle " + this.options.iconName
                })
            },
            htmlIcon: function() {
                return this.options.icon ? '<span class="icon-span-filestyle ' + this.options.iconName + '"></span> ' : ""
            },
            htmlInput: function() {
                return this.options.input ? '<input type="text" class="form-control ' + ("nr" == this.options.size ? "" : "input-" + this.options.size) + '" placeholder="' + this.options.placeholder + '" disabled> ' : ""
            },
            pushNameFiles: function() {
                var e = "",
                    t = [];
                void 0 === this.$element[0].files ? t[0] = {
                    name: this.$element[0] && this.$element[0].value
                } : t = this.$element[0].files;
                for (var i = 0; i < t.length; i++) e += t[i].name.split("\\").pop() + ", ";
                return "" !== e ? this.$elementFilestyle.find(":text").val(e.replace(/\, $/g, "")) : this.$elementFilestyle.find(":text").val(""), t
            },
            constructor: function() {
                var i = this,
                    o = "",
                    n = i.$element.attr("id"),
                    s = "";
                "" !== n && n || (n = "filestyle-" + t, i.$element.attr({
                    id: n
                }), t++), s = '<span class="group-span-filestyle ' + (i.options.input ? "input-group-btn" : "") + '"><label for="' + n + '" class="btn ' + i.options.buttonName + " " + ("nr" == i.options.size ? "" : "btn-" + i.options.size) + '" ' + (i.options.disabled ? 'disabled="true"' : "") + ">" + i.htmlIcon() + '<span class="buttonText">' + i.options.buttonText + "</span></label></span>", o = i.options.buttonBefore ? s + i.htmlInput() : i.htmlInput() + s, i.$elementFilestyle = e('<div class="bootstrap-filestyle input-group">' + o + "</div>"), i.$elementFilestyle.find(".group-span-filestyle").attr("tabindex", "0").keypress(function(e) {
                    if (13 === e.keyCode || 32 === e.charCode) return i.$elementFilestyle.find("label").click(), !1
                }), i.$element.css({
                    position: "absolute",
                    clip: "rect(0px 0px 0px 0px)"
                }).attr("tabindex", "-1").after(i.$elementFilestyle), i.options.disabled && i.$element.attr("disabled", "true"), i.$element.change(function() {
                    var e = i.pushNameFiles();
                    0 == i.options.input && i.options.badge ? 0 == i.$elementFilestyle.find(".badge").length ? i.$elementFilestyle.find("label").append(' <span class="badge">' + e.length + "</span>") : 0 == e.length ? i.$elementFilestyle.find(".badge").remove() : i.$elementFilestyle.find(".badge").html(e.length) : i.$elementFilestyle.find(".badge").remove()
                }), window.navigator.userAgent.search(/firefox/i) > -1 && i.$elementFilestyle.find("label").click(function() {
                    return i.$element.click(), !1
                })
            }
        };
        var o = e.fn.filestyle;
        e.fn.filestyle = function(t, o) {
            var n = "",
                s = this.each(function() {
                    if ("file" === e(this).attr("type")) {
                        var s = e(this),
                            r = s.data("filestyle"),
                            a = e.extend({}, e.fn.filestyle.defaults, t, "object" == typeof t && t);
                        r || (s.data("filestyle", r = new i(this, a)), r.constructor()), "string" == typeof t && (n = r[t](o))
                    }
                });
            return void 0 !== typeof n ? n : s
        }, e.fn.filestyle.defaults = {
            buttonText: "Choose file",
            iconName: "glyphicon glyphicon-folder-open",
            buttonName: "btn-default",
            size: "nr",
            input: !0,
            badge: !0,
            icon: !0,
            buttonBefore: !1,
            disabled: !1,
            placeholder: ""
        }, e.fn.filestyle.noConflict = function() {
            return e.fn.filestyle = o, this
        }, e(function() {
            e(".filestyle").each(function() {
                var t = e(this),
                    i = {
                        input: "false" !== t.attr("data-input"),
                        icon: "false" !== t.attr("data-icon"),
                        buttonBefore: "true" === t.attr("data-buttonBefore"),
                        disabled: "true" === t.attr("data-disabled"),
                        size: t.attr("data-size"),
                        buttonText: t.attr("data-buttonText"),
                        buttonName: t.attr("data-buttonName"),
                        iconName: t.attr("data-iconName"),
                        badge: "false" !== t.attr("data-badge"),
                        placeholder: t.attr("data-placeholder")
                    };
                t.filestyle(i)
            })
        })
    }(window.jQuery)
}, function(e, t, i) {
    "use strict";
    "function" != typeof Object.create && (Object.create = function(e) {
            function t() {}
            return t.prototype = e, new t
        }),
        function(e, t, i, o) {
            var n = {
                init: function(t, i) {
                    var o = this;
                    o.elem = i, o.$elem = e(i), o.imageSrc = o.$elem.data("zoom-image") ? o.$elem.data("zoom-image") : o.$elem.attr("src"), o.options = e.extend({}, e.fn.elevateZoom.options, t), o.options.tint && (o.options.lensColour = "none", o.options.lensOpacity = "1"), "inner" == o.options.zoomType && (o.options.showLens = !1), o.$elem.parent().removeAttr("title").removeAttr("alt"), o.zoomImage = o.imageSrc, o.refresh(1), e("#" + o.options.gallery + " a").click(function(t) {
                        return o.options.galleryActiveClass && (e("#" + o.options.gallery + " a").removeClass(o.options.galleryActiveClass), e(this).addClass(o.options.galleryActiveClass)), t.preventDefault(), e(this).data("zoom-image") ? o.zoomImagePre = e(this).data("zoom-image") : o.zoomImagePre = e(this).data("image"), o.swaptheimage(e(this).data("image"), o.zoomImagePre), !1
                    })
                },
                refresh: function(e) {
                    var t = this;
                    setTimeout(function() {
                        t.fetch(t.imageSrc)
                    }, e || t.options.refresh)
                },
                fetch: function(e) {
                    var t = this,
                        i = new Image;
                    i.onload = function() {
                        t.largeWidth = i.width, t.largeHeight = i.height, t.startZoom(), t.currentImage = t.imageSrc, t.options.onZoomedImageLoaded(t.$elem)
                    }, i.src = e
                },
                startZoom: function() {
                    var t = this;
                    if (t.nzWidth = t.$elem.width(), t.nzHeight = t.$elem.height(), t.isWindowActive = !1, t.isLensActive = !1, t.isTintActive = !1, t.overWindow = !1, t.options.imageCrossfade && (t.zoomWrap = t.$elem.wrap('<div style="height:' + t.nzHeight + "px;width:" + t.nzWidth + 'px;" class="zoomWrapper" />'), t.$elem.css("position", "absolute")), t.zoomLock = 1, t.scrollingLock = !1, t.changeBgSize = !1, t.currentZoomLevel = t.options.zoomLevel, t.nzOffset = t.$elem.offset(), t.widthRatio = t.largeWidth / t.currentZoomLevel / t.nzWidth, t.heightRatio = t.largeHeight / t.currentZoomLevel / t.nzHeight, "window" == t.options.zoomType && (t.zoomWindowStyle = "overflow: hidden;background-position: 0px 0px;text-align:center;background-color: " + String(t.options.zoomWindowBgColour) + ";width: " + String(t.options.zoomWindowWidth) + "px;height: " + String(t.options.zoomWindowHeight) + "px;float: left;background-size: " + t.largeWidth / t.currentZoomLevel + "px " + t.largeHeight / t.currentZoomLevel + "px;display: none;z-index:100;border: " + String(t.options.borderSize) + "px solid " + t.options.borderColour + ";background-repeat: no-repeat;position: absolute;"), "inner" == t.options.zoomType) {
                        var i = t.$elem.css("border-left-width");
                        t.zoomWindowStyle = "overflow: hidden;margin-left: " + String(i) + ";margin-top: " + String(i) + ";background-position: 0px 0px;width: " + String(t.nzWidth) + "px;height: " + String(t.nzHeight) + "px;px;float: left;display: none;cursor:" + t.options.cursor + ";px solid " + t.options.borderColour + ";background-repeat: no-repeat;position: absolute;"
                    }
                    "window" == t.options.zoomType && (t.nzHeight < t.options.zoomWindowWidth / t.widthRatio ? lensHeight = t.nzHeight : lensHeight = String(t.options.zoomWindowHeight / t.heightRatio), t.largeWidth < t.options.zoomWindowWidth ? lensWidth = t.nzWidth : lensWidth = t.options.zoomWindowWidth / t.widthRatio, t.lensStyle = "background-position: 0px 0px;width: " + String(t.options.zoomWindowWidth / t.widthRatio) + "px;height: " + String(t.options.zoomWindowHeight / t.heightRatio) + "px;float: right;display: none;overflow: hidden;z-index: 999;-webkit-transform: translateZ(0);opacity:" + t.options.lensOpacity + ";filter: alpha(opacity = " + 100 * t.options.lensOpacity + "); zoom:1;width:" + lensWidth + "px;height:" + lensHeight + "px;background-color:" + t.options.lensColour + ";cursor:" + t.options.cursor + ";border: " + t.options.lensBorderSize + "px solid " + t.options.lensBorderColour + ";background-repeat: no-repeat;position: absolute;"), t.tintStyle = "display: block;position: absolute;background-color: " + t.options.tintColour + ";filter:alpha(opacity=0);opacity: 0;width: " + t.nzWidth + "px;height: " + t.nzHeight + "px;", t.lensRound = "", "lens" == t.options.zoomType && (t.lensStyle = "background-position: 0px 0px;float: left;display: none;border: " + String(t.options.borderSize) + "px solid " + t.options.borderColour + ";width:" + String(t.options.lensSize) + "px;height:" + String(t.options.lensSize) + "px;background-repeat: no-repeat;position: absolute;"), "round" == t.options.lensShape && (t.lensRound = "border-top-left-radius: " + String(t.options.lensSize / 2 + t.options.borderSize) + "px;border-top-right-radius: " + String(t.options.lensSize / 2 + t.options.borderSize) + "px;border-bottom-left-radius: " + String(t.options.lensSize / 2 + t.options.borderSize) + "px;border-bottom-right-radius: " + String(t.options.lensSize / 2 + t.options.borderSize) + "px;"), t.zoomContainer = e('<div class="zoomContainer" style="-webkit-transform: translateZ(0);position:absolute;left:' + t.nzOffset.left + "px;top:" + t.nzOffset.top + "px;height:" + t.nzHeight + "px;width:" + t.nzWidth + 'px;"></div>'), e("body").append(t.zoomContainer), t.options.containLensZoom && "lens" == t.options.zoomType && t.zoomContainer.css("overflow", "hidden"), "inner" != t.options.zoomType && (t.zoomLens = e("<div class='zoomLens' style='" + t.lensStyle + t.lensRound + "'>&nbsp;</div>").appendTo(t.zoomContainer).click(function() {
                        t.$elem.trigger("click")
                    }), t.options.tint && (t.tintContainer = e("<div/>").addClass("tintContainer"), t.zoomTint = e("<div class='zoomTint' style='" + t.tintStyle + "'></div>"), t.zoomLens.wrap(t.tintContainer), t.zoomTintcss = t.zoomLens.after(t.zoomTint), t.zoomTintImage = e('<img style="position: absolute; left: 0px; top: 0px; max-width: none; width: ' + t.nzWidth + "px; height: " + t.nzHeight + 'px;" src="' + t.imageSrc + '">').appendTo(t.zoomLens).click(function() {
                        t.$elem.trigger("click")
                    }))), isNaN(t.options.zoomWindowPosition) ? t.zoomWindow = e("<div style='z-index:999;left:" + t.windowOffsetLeft + "px;top:" + t.windowOffsetTop + "px;" + t.zoomWindowStyle + "' class='zoomWindow'>&nbsp;</div>").appendTo("body").click(function() {
                        t.$elem.trigger("click")
                    }) : t.zoomWindow = e("<div style='z-index:999;left:" + t.windowOffsetLeft + "px;top:" + t.windowOffsetTop + "px;" + t.zoomWindowStyle + "' class='zoomWindow'>&nbsp;</div>").appendTo(t.zoomContainer).click(function() {
                        t.$elem.trigger("click")
                    }), t.zoomWindowContainer = e("<div/>").addClass("zoomWindowContainer").css("width", t.options.zoomWindowWidth), t.zoomWindow.wrap(t.zoomWindowContainer), "lens" == t.options.zoomType && t.zoomLens.css({
                        backgroundImage: "url('" + t.imageSrc + "')"
                    }), "window" == t.options.zoomType && t.zoomWindow.css({
                        backgroundImage: "url('" + t.imageSrc + "')"
                    }), "inner" == t.options.zoomType && t.zoomWindow.css({
                        backgroundImage: "url('" + t.imageSrc + "')"
                    }), t.$elem.bind("touchmove", function(e) {
                        e.preventDefault();
                        var i = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                        t.setPosition(i)
                    }), t.zoomContainer.bind("touchmove", function(e) {
                        "inner" == t.options.zoomType && t.showHideWindow("show"), e.preventDefault();
                        var i = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                        t.setPosition(i)
                    }), t.zoomContainer.bind("touchend", function(e) {
                        t.showHideWindow("hide"), t.options.showLens && t.showHideLens("hide"), t.options.tint && "inner" != t.options.zoomType && t.showHideTint("hide")
                    }), t.$elem.bind("touchend", function(e) {
                        t.showHideWindow("hide"), t.options.showLens && t.showHideLens("hide"), t.options.tint && "inner" != t.options.zoomType && t.showHideTint("hide")
                    }), t.options.showLens && (t.zoomLens.bind("touchmove", function(e) {
                        e.preventDefault();
                        var i = e.originalEvent.touches[0] || e.originalEvent.changedTouches[0];
                        t.setPosition(i)
                    }), t.zoomLens.bind("touchend", function(e) {
                        t.showHideWindow("hide"), t.options.showLens && t.showHideLens("hide"), t.options.tint && "inner" != t.options.zoomType && t.showHideTint("hide")
                    })), t.$elem.bind("mousemove", function(e) {
                        0 == t.overWindow && t.setElements("show"), t.lastX === e.clientX && t.lastY === e.clientY || (t.setPosition(e), t.currentLoc = e), t.lastX = e.clientX, t.lastY = e.clientY
                    }), t.zoomContainer.bind("mousemove", function(e) {
                        0 == t.overWindow && t.setElements("show"), t.lastX === e.clientX && t.lastY === e.clientY || (t.setPosition(e), t.currentLoc = e), t.lastX = e.clientX, t.lastY = e.clientY
                    }), "inner" != t.options.zoomType && t.zoomLens.bind("mousemove", function(e) {
                        t.lastX === e.clientX && t.lastY === e.clientY || (t.setPosition(e), t.currentLoc = e), t.lastX = e.clientX, t.lastY = e.clientY
                    }), t.options.tint && "inner" != t.options.zoomType && t.zoomTint.bind("mousemove", function(e) {
                        t.lastX === e.clientX && t.lastY === e.clientY || (t.setPosition(e), t.currentLoc = e), t.lastX = e.clientX, t.lastY = e.clientY
                    }), "inner" == t.options.zoomType && t.zoomWindow.bind("mousemove", function(e) {
                        t.lastX === e.clientX && t.lastY === e.clientY || (t.setPosition(e), t.currentLoc = e), t.lastX = e.clientX, t.lastY = e.clientY
                    }), t.zoomContainer.add(t.$elem).mouseenter(function() {
                        0 == t.overWindow && t.setElements("show")
                    }).mouseleave(function() {
                        t.scrollLock || (t.setElements("hide"), t.options.onDestroy(t.$elem))
                    }), "inner" != t.options.zoomType && t.zoomWindow.mouseenter(function() {
                        t.overWindow = !0, t.setElements("hide")
                    }).mouseleave(function() {
                        t.overWindow = !1
                    }), t.options.zoomLevel, t.options.minZoomLevel ? t.minZoomLevel = t.options.minZoomLevel : t.minZoomLevel = 2 * t.options.scrollZoomIncrement, t.options.scrollZoom && t.zoomContainer.add(t.$elem).bind("mousewheel DOMMouseScroll MozMousePixelScroll", function(i) {
                        t.scrollLock = !0, clearTimeout(e.data(this, "timer")), e.data(this, "timer", setTimeout(function() {
                            t.scrollLock = !1
                        }, 250));
                        var o = i.originalEvent.wheelDelta || -1 * i.originalEvent.detail;
                        return i.stopImmediatePropagation(), i.stopPropagation(), i.preventDefault(), o / 120 > 0 ? t.currentZoomLevel >= t.minZoomLevel && t.changeZoomLevel(t.currentZoomLevel - t.options.scrollZoomIncrement) : t.options.maxZoomLevel ? t.currentZoomLevel <= t.options.maxZoomLevel && t.changeZoomLevel(parseFloat(t.currentZoomLevel) + t.options.scrollZoomIncrement) : t.changeZoomLevel(parseFloat(t.currentZoomLevel) + t.options.scrollZoomIncrement), !1
                    })
                },
                setElements: function(e) {
                    var t = this;
                    if (!t.options.zoomEnabled) return !1;
                    "show" == e && t.isWindowSet && ("inner" == t.options.zoomType && t.showHideWindow("show"), "window" == t.options.zoomType && t.showHideWindow("show"), t.options.showLens && t.showHideLens("show"), t.options.tint && "inner" != t.options.zoomType && t.showHideTint("show")), "hide" == e && ("window" == t.options.zoomType && t.showHideWindow("hide"), t.options.tint || t.showHideWindow("hide"), t.options.showLens && t.showHideLens("hide"), t.options.tint && t.showHideTint("hide"))
                },
                setPosition: function(e) {
                    var t = this;
                    return !!t.options.zoomEnabled && (t.nzHeight = t.$elem.height(), t.nzWidth = t.$elem.width(), t.nzOffset = t.$elem.offset(), t.options.tint && "inner" != t.options.zoomType && (t.zoomTint.css({
                        top: 0
                    }), t.zoomTint.css({
                        left: 0
                    })), t.options.responsive && !t.options.scrollZoom && t.options.showLens && (t.nzHeight < t.options.zoomWindowWidth / t.widthRatio ? lensHeight = t.nzHeight : lensHeight = String(t.options.zoomWindowHeight / t.heightRatio), t.largeWidth < t.options.zoomWindowWidth ? lensWidth = t.nzWidth : lensWidth = t.options.zoomWindowWidth / t.widthRatio, t.widthRatio = t.largeWidth / t.nzWidth, t.heightRatio = t.largeHeight / t.nzHeight, "lens" != t.options.zoomType && (t.nzHeight < t.options.zoomWindowWidth / t.widthRatio ? lensHeight = t.nzHeight : lensHeight = String(t.options.zoomWindowHeight / t.heightRatio), t.nzWidth < t.options.zoomWindowHeight / t.heightRatio ? lensWidth = t.nzWidth : lensWidth = String(t.options.zoomWindowWidth / t.widthRatio), t.zoomLens.css("width", lensWidth), t.zoomLens.css("height", lensHeight), t.options.tint && (t.zoomTintImage.css("width", t.nzWidth), t.zoomTintImage.css("height", t.nzHeight))), "lens" == t.options.zoomType && t.zoomLens.css({
                        width: String(t.options.lensSize) + "px",
                        height: String(t.options.lensSize) + "px"
                    })), t.zoomContainer.css({
                        top: t.nzOffset.top
                    }), t.zoomContainer.css({
                        left: t.nzOffset.left
                    }), t.mouseLeft = parseInt(e.pageX - t.nzOffset.left), t.mouseTop = parseInt(e.pageY - t.nzOffset.top), "window" == t.options.zoomType && (t.Etoppos = t.mouseTop < t.zoomLens.height() / 2, t.Eboppos = t.mouseTop > t.nzHeight - t.zoomLens.height() / 2 - 2 * t.options.lensBorderSize, t.Eloppos = t.mouseLeft < 0 + t.zoomLens.width() / 2, t.Eroppos = t.mouseLeft > t.nzWidth - t.zoomLens.width() / 2 - 2 * t.options.lensBorderSize), "inner" == t.options.zoomType && (t.Etoppos = t.mouseTop < t.nzHeight / 2 / t.heightRatio, t.Eboppos = t.mouseTop > t.nzHeight - t.nzHeight / 2 / t.heightRatio, t.Eloppos = t.mouseLeft < 0 + t.nzWidth / 2 / t.widthRatio, t.Eroppos = t.mouseLeft > t.nzWidth - t.nzWidth / 2 / t.widthRatio - 2 * t.options.lensBorderSize), t.mouseLeft < 0 || t.mouseTop < 0 || t.mouseLeft > t.nzWidth || t.mouseTop > t.nzHeight ? void t.setElements("hide") : (t.options.showLens && (t.lensLeftPos = String(Math.floor(t.mouseLeft - t.zoomLens.width() / 2)), t.lensTopPos = String(Math.floor(t.mouseTop - t.zoomLens.height() / 2))), t.Etoppos && (t.lensTopPos = 0), t.Eloppos && (t.windowLeftPos = 0, t.lensLeftPos = 0, t.tintpos = 0), "window" == t.options.zoomType && (t.Eboppos && (t.lensTopPos = Math.max(t.nzHeight - t.zoomLens.height() - 2 * t.options.lensBorderSize, 0)), t.Eroppos && (t.lensLeftPos = t.nzWidth - t.zoomLens.width() - 2 * t.options.lensBorderSize)), "inner" == t.options.zoomType && (t.Eboppos && (t.lensTopPos = Math.max(t.nzHeight - 2 * t.options.lensBorderSize, 0)), t.Eroppos && (t.lensLeftPos = t.nzWidth - t.nzWidth - 2 * t.options.lensBorderSize)), "lens" == t.options.zoomType && (t.windowLeftPos = String(-1 * ((e.pageX - t.nzOffset.left) * t.widthRatio - t.zoomLens.width() / 2)), t.windowTopPos = String(-1 * ((e.pageY - t.nzOffset.top) * t.heightRatio - t.zoomLens.height() / 2)), t.zoomLens.css({
                        backgroundPosition: t.windowLeftPos + "px " + t.windowTopPos + "px"
                    }), t.changeBgSize && (t.nzHeight > t.nzWidth ? ("lens" == t.options.zoomType && t.zoomLens.css({
                        "background-size": t.largeWidth / t.newvalueheight + "px " + t.largeHeight / t.newvalueheight + "px"
                    }), t.zoomWindow.css({
                        "background-size": t.largeWidth / t.newvalueheight + "px " + t.largeHeight / t.newvalueheight + "px"
                    })) : ("lens" == t.options.zoomType && t.zoomLens.css({
                        "background-size": t.largeWidth / t.newvaluewidth + "px " + t.largeHeight / t.newvaluewidth + "px"
                    }), t.zoomWindow.css({
                        "background-size": t.largeWidth / t.newvaluewidth + "px " + t.largeHeight / t.newvaluewidth + "px"
                    })), t.changeBgSize = !1), t.setWindowPostition(e)), t.options.tint && "inner" != t.options.zoomType && t.setTintPosition(e), "window" == t.options.zoomType && t.setWindowPostition(e), "inner" == t.options.zoomType && t.setWindowPostition(e), t.options.showLens && (t.fullwidth && "lens" != t.options.zoomType && (t.lensLeftPos = 0), t.zoomLens.css({
                        left: t.lensLeftPos + "px",
                        top: t.lensTopPos + "px"
                    })), void 0))
                },
                showHideWindow: function(e) {
                    var t = this;
                    "show" == e && (t.isWindowActive || (t.options.zoomWindowFadeIn ? t.zoomWindow.stop(!0, !0, !1).fadeIn(t.options.zoomWindowFadeIn) : t.zoomWindow.show(), t.isWindowActive = !0)), "hide" == e && t.isWindowActive && (t.options.zoomWindowFadeOut ? t.zoomWindow.stop(!0, !0).fadeOut(t.options.zoomWindowFadeOut, function() {
                        t.loop && (clearInterval(t.loop), t.loop = !1)
                    }) : t.zoomWindow.hide(), t.isWindowActive = !1)
                },
                showHideLens: function(e) {
                    var t = this;
                    "show" == e && (t.isLensActive || (t.options.lensFadeIn ? t.zoomLens.stop(!0, !0, !1).fadeIn(t.options.lensFadeIn) : t.zoomLens.show(), t.isLensActive = !0)), "hide" == e && t.isLensActive && (t.options.lensFadeOut ? t.zoomLens.stop(!0, !0).fadeOut(t.options.lensFadeOut) : t.zoomLens.hide(), t.isLensActive = !1)
                },
                showHideTint: function(e) {
                    var t = this;
                    "show" == e && (t.isTintActive || (t.options.zoomTintFadeIn ? t.zoomTint.css({
                        opacity: t.options.tintOpacity
                    }).animate().stop(!0, !0).fadeIn("slow") : (t.zoomTint.css({
                        opacity: t.options.tintOpacity
                    }).animate(), t.zoomTint.show()), t.isTintActive = !0)), "hide" == e && t.isTintActive && (t.options.zoomTintFadeOut ? t.zoomTint.stop(!0, !0).fadeOut(t.options.zoomTintFadeOut) : t.zoomTint.hide(), t.isTintActive = !1)
                },
                setLensPostition: function(e) {},
                setWindowPostition: function(t) {
                    var i = this;
                    if (isNaN(i.options.zoomWindowPosition)) i.externalContainer = e("#" + i.options.zoomWindowPosition), i.externalContainerWidth = i.externalContainer.width(), i.externalContainerHeight = i.externalContainer.height(), i.externalContainerOffset = i.externalContainer.offset(), i.windowOffsetTop = i.externalContainerOffset.top, i.windowOffsetLeft = i.externalContainerOffset.left;
                    else switch (i.options.zoomWindowPosition) {
                        case 1:
                            i.windowOffsetTop = i.options.zoomWindowOffety, i.windowOffsetLeft = +i.nzWidth;
                            break;
                        case 2:
                            i.options.zoomWindowHeight > i.nzHeight && (i.windowOffsetTop = -1 * (i.options.zoomWindowHeight / 2 - i.nzHeight / 2), i.windowOffsetLeft = i.nzWidth);
                            break;
                        case 3:
                            i.windowOffsetTop = i.nzHeight - i.zoomWindow.height() - 2 * i.options.borderSize, i.windowOffsetLeft = i.nzWidth;
                            break;
                        case 4:
                            i.windowOffsetTop = i.nzHeight, i.windowOffsetLeft = i.nzWidth;
                            break;
                        case 5:
                            i.windowOffsetTop = i.nzHeight, i.windowOffsetLeft = i.nzWidth - i.zoomWindow.width() - 2 * i.options.borderSize;
                            break;
                        case 6:
                            i.options.zoomWindowHeight > i.nzHeight && (i.windowOffsetTop = i.nzHeight, i.windowOffsetLeft = -1 * (i.options.zoomWindowWidth / 2 - i.nzWidth / 2 + 2 * i.options.borderSize));
                            break;
                        case 7:
                            i.windowOffsetTop = i.nzHeight, i.windowOffsetLeft = 0;
                            break;
                        case 8:
                            i.windowOffsetTop = i.nzHeight, i.windowOffsetLeft = -1 * (i.zoomWindow.width() + 2 * i.options.borderSize);
                            break;
                        case 9:
                            i.windowOffsetTop = i.nzHeight - i.zoomWindow.height() - 2 * i.options.borderSize, i.windowOffsetLeft = -1 * (i.zoomWindow.width() + 2 * i.options.borderSize);
                            break;
                        case 10:
                            i.options.zoomWindowHeight > i.nzHeight && (i.windowOffsetTop = -1 * (i.options.zoomWindowHeight / 2 - i.nzHeight / 2), i.windowOffsetLeft = -1 * (i.zoomWindow.width() + 2 * i.options.borderSize));
                            break;
                        case 11:
                            i.windowOffsetTop = i.options.zoomWindowOffety, i.windowOffsetLeft = -1 * (i.zoomWindow.width() + 2 * i.options.borderSize);
                            break;
                        case 12:
                            i.windowOffsetTop = -1 * (i.zoomWindow.height() + 2 * i.options.borderSize), i.windowOffsetLeft = -1 * (i.zoomWindow.width() + 2 * i.options.borderSize);
                            break;
                        case 13:
                            i.windowOffsetTop = -1 * (i.zoomWindow.height() + 2 * i.options.borderSize), i.windowOffsetLeft = 0;
                            break;
                        case 14:
                            i.options.zoomWindowHeight > i.nzHeight && (i.windowOffsetTop = -1 * (i.zoomWindow.height() + 2 * i.options.borderSize), i.windowOffsetLeft = -1 * (i.options.zoomWindowWidth / 2 - i.nzWidth / 2 + 2 * i.options.borderSize));
                            break;
                        case 15:
                            i.windowOffsetTop = -1 * (i.zoomWindow.height() + 2 * i.options.borderSize), i.windowOffsetLeft = i.nzWidth - i.zoomWindow.width() - 2 * i.options.borderSize;
                            break;
                        case 16:
                            i.windowOffsetTop = -1 * (i.zoomWindow.height() + 2 * i.options.borderSize), i.windowOffsetLeft = i.nzWidth;
                            break;
                        default:
                            i.windowOffsetTop = i.options.zoomWindowOffety, i.windowOffsetLeft = i.nzWidth
                    }
                    i.isWindowSet = !0, i.windowOffsetTop = i.windowOffsetTop + i.options.zoomWindowOffety, i.windowOffsetLeft = i.windowOffsetLeft + i.options.zoomWindowOffetx, i.zoomWindow.css({
                        top: i.windowOffsetTop
                    }), i.zoomWindow.css({
                        left: i.windowOffsetLeft
                    }), "inner" == i.options.zoomType && (i.zoomWindow.css({
                        top: 0
                    }), i.zoomWindow.css({
                        left: 0
                    })), i.windowLeftPos = String(-1 * ((t.pageX - i.nzOffset.left) * i.widthRatio - i.zoomWindow.width() / 2)), i.windowTopPos = String(-1 * ((t.pageY - i.nzOffset.top) * i.heightRatio - i.zoomWindow.height() / 2)), i.Etoppos && (i.windowTopPos = 0), i.Eloppos && (i.windowLeftPos = 0), i.Eboppos && (i.windowTopPos = -1 * (i.largeHeight / i.currentZoomLevel - i.zoomWindow.height())), i.Eroppos && (i.windowLeftPos = -1 * (i.largeWidth / i.currentZoomLevel - i.zoomWindow.width())), i.fullheight && (i.windowTopPos = 0), i.fullwidth && (i.windowLeftPos = 0), "window" != i.options.zoomType && "inner" != i.options.zoomType || (1 == i.zoomLock && (i.widthRatio <= 1 && (i.windowLeftPos = 0), i.heightRatio <= 1 && (i.windowTopPos = 0)), "window" == i.options.zoomType && (i.largeHeight < i.options.zoomWindowHeight && (i.windowTopPos = 0), i.largeWidth < i.options.zoomWindowWidth && (i.windowLeftPos = 0)), i.options.easing ? (i.xp || (i.xp = 0), i.yp || (i.yp = 0), i.loop || (i.loop = setInterval(function() {
                        i.xp += (i.windowLeftPos - i.xp) / i.options.easingAmount, i.yp += (i.windowTopPos - i.yp) / i.options.easingAmount, i.scrollingLock ? (clearInterval(i.loop), i.xp = i.windowLeftPos, i.yp = i.windowTopPos, i.xp = -1 * ((t.pageX - i.nzOffset.left) * i.widthRatio - i.zoomWindow.width() / 2), i.yp = -1 * ((t.pageY - i.nzOffset.top) * i.heightRatio - i.zoomWindow.height() / 2), i.changeBgSize && (i.nzHeight > i.nzWidth ? ("lens" == i.options.zoomType && i.zoomLens.css({
                            "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                        }), i.zoomWindow.css({
                            "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                        })) : ("lens" != i.options.zoomType && i.zoomLens.css({
                            "background-size": i.largeWidth / i.newvaluewidth + "px " + i.largeHeight / i.newvalueheight + "px"
                        }), i.zoomWindow.css({
                            "background-size": i.largeWidth / i.newvaluewidth + "px " + i.largeHeight / i.newvaluewidth + "px"
                        })), i.changeBgSize = !1), i.zoomWindow.css({
                            backgroundPosition: i.windowLeftPos + "px " + i.windowTopPos + "px"
                        }), i.scrollingLock = !1, i.loop = !1) : Math.round(Math.abs(i.xp - i.windowLeftPos) + Math.abs(i.yp - i.windowTopPos)) < 1 ? (clearInterval(i.loop), i.zoomWindow.css({
                            backgroundPosition: i.windowLeftPos + "px " + i.windowTopPos + "px"
                        }), i.loop = !1) : (i.changeBgSize && (i.nzHeight > i.nzWidth ? ("lens" == i.options.zoomType && i.zoomLens.css({
                            "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                        }), i.zoomWindow.css({
                            "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                        })) : ("lens" != i.options.zoomType && i.zoomLens.css({
                            "background-size": i.largeWidth / i.newvaluewidth + "px " + i.largeHeight / i.newvaluewidth + "px"
                        }), i.zoomWindow.css({
                            "background-size": i.largeWidth / i.newvaluewidth + "px " + i.largeHeight / i.newvaluewidth + "px"
                        })), i.changeBgSize = !1), i.zoomWindow.css({
                            backgroundPosition: i.xp + "px " + i.yp + "px"
                        }))
                    }, 16))) : (i.changeBgSize && (i.nzHeight > i.nzWidth ? ("lens" == i.options.zoomType && i.zoomLens.css({
                        "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                    }), i.zoomWindow.css({
                        "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                    })) : ("lens" == i.options.zoomType && i.zoomLens.css({
                        "background-size": i.largeWidth / i.newvaluewidth + "px " + i.largeHeight / i.newvaluewidth + "px"
                    }), i.largeHeight / i.newvaluewidth < i.options.zoomWindowHeight ? i.zoomWindow.css({
                        "background-size": i.largeWidth / i.newvaluewidth + "px " + i.largeHeight / i.newvaluewidth + "px"
                    }) : i.zoomWindow.css({
                        "background-size": i.largeWidth / i.newvalueheight + "px " + i.largeHeight / i.newvalueheight + "px"
                    })), i.changeBgSize = !1), i.zoomWindow.css({
                        backgroundPosition: i.windowLeftPos + "px " + i.windowTopPos + "px"
                    })))
                },
                setTintPosition: function(e) {
                    var t = this;
                    t.nzOffset = t.$elem.offset(), t.tintpos = String(-1 * (e.pageX - t.nzOffset.left - t.zoomLens.width() / 2)), t.tintposy = String(-1 * (e.pageY - t.nzOffset.top - t.zoomLens.height() / 2)), t.Etoppos && (t.tintposy = 0), t.Eloppos && (t.tintpos = 0), t.Eboppos && (t.tintposy = -1 * (t.nzHeight - t.zoomLens.height() - 2 * t.options.lensBorderSize)), t.Eroppos && (t.tintpos = -1 * (t.nzWidth - t.zoomLens.width() - 2 * t.options.lensBorderSize)), t.options.tint && (t.fullheight && (t.tintposy = 0), t.fullwidth && (t.tintpos = 0), t.zoomTintImage.css({
                        left: t.tintpos + "px"
                    }), t.zoomTintImage.css({
                        top: t.tintposy + "px"
                    }))
                },
                swaptheimage: function(t, i) {
                    var o = this,
                        n = new Image;
                    o.options.loadingIcon && (o.spinner = e("<div style=\"background: url('" + o.options.loadingIcon + "') no-repeat center;height:" + o.nzHeight + "px;width:" + o.nzWidth + 'px;z-index: 2000;position: absolute; background-position: center center;"></div>'), o.$elem.after(o.spinner)), o.options.onImageSwap(o.$elem), n.onload = function() {
                        o.largeWidth = n.width, o.largeHeight = n.height, o.zoomImage = i, o.zoomWindow.css({
                            "background-size": o.largeWidth + "px " + o.largeHeight + "px"
                        }), o.swapAction(t, i)
                    }, n.src = i
                },
                swapAction: function(t, i) {
                    var o = this,
                        n = new Image;
                    if (n.onload = function() {
                            o.nzHeight = n.height, o.nzWidth = n.width, o.options.onImageSwapComplete(o.$elem), o.doneCallback()
                        }, n.src = t, o.currentZoomLevel = o.options.zoomLevel, o.options.maxZoomLevel = !1, "lens" == o.options.zoomType && o.zoomLens.css({
                            backgroundImage: "url('" + i + "')"
                        }), "window" == o.options.zoomType && o.zoomWindow.css({
                            backgroundImage: "url('" + i + "')"
                        }), "inner" == o.options.zoomType && o.zoomWindow.css({
                            backgroundImage: "url('" + i + "')"
                        }), o.currentImage = i, o.options.imageCrossfade) {
                        var s = o.$elem,
                            r = s.clone();
                        if (o.$elem.attr("src", t), o.$elem.after(r), r.stop(!0).fadeOut(o.options.imageCrossfade, function() {
                                e(this).remove()
                            }), o.$elem.width("auto").removeAttr("width"), o.$elem.height("auto").removeAttr("height"), s.fadeIn(o.options.imageCrossfade), o.options.tint && "inner" != o.options.zoomType) {
                            var a = o.zoomTintImage,
                                l = a.clone();
                            o.zoomTintImage.attr("src", i), o.zoomTintImage.after(l), l.stop(!0).fadeOut(o.options.imageCrossfade, function() {
                                e(this).remove()
                            }), a.fadeIn(o.options.imageCrossfade), o.zoomTint.css({
                                height: o.$elem.height()
                            }), o.zoomTint.css({
                                width: o.$elem.width()
                            })
                        }
                        o.zoomContainer.css("height", o.$elem.height()), o.zoomContainer.css("width", o.$elem.width()), "inner" == o.options.zoomType && (o.options.constrainType || (o.zoomWrap.parent().css("height", o.$elem.height()), o.zoomWrap.parent().css("width", o.$elem.width()), o.zoomWindow.css("height", o.$elem.height()), o.zoomWindow.css("width", o.$elem.width()))), o.options.imageCrossfade && (o.zoomWrap.css("height", o.$elem.height()), o.zoomWrap.css("width", o.$elem.width()))
                    } else o.$elem.attr("src", t), o.options.tint && (o.zoomTintImage.attr("src", i), o.zoomTintImage.attr("height", o.$elem.height()), o.zoomTintImage.css({
                        height: o.$elem.height()
                    }), o.zoomTint.css({
                        height: o.$elem.height()
                    })), o.zoomContainer.css("height", o.$elem.height()), o.zoomContainer.css("width", o.$elem.width()), o.options.imageCrossfade && (o.zoomWrap.css("height", o.$elem.height()), o.zoomWrap.css("width", o.$elem.width()));
                    o.options.constrainType && ("height" == o.options.constrainType && (o.zoomContainer.css("height", o.options.constrainSize), o.zoomContainer.css("width", "auto"), o.options.imageCrossfade ? (o.zoomWrap.css("height", o.options.constrainSize), o.zoomWrap.css("width", "auto"), o.constwidth = o.zoomWrap.width()) : (o.$elem.css("height", o.options.constrainSize), o.$elem.css("width", "auto"), o.constwidth = o.$elem.width()), "inner" == o.options.zoomType && (o.zoomWrap.parent().css("height", o.options.constrainSize), o.zoomWrap.parent().css("width", o.constwidth), o.zoomWindow.css("height", o.options.constrainSize), o.zoomWindow.css("width", o.constwidth)), o.options.tint && (o.tintContainer.css("height", o.options.constrainSize), o.tintContainer.css("width", o.constwidth), o.zoomTint.css("height", o.options.constrainSize), o.zoomTint.css("width", o.constwidth), o.zoomTintImage.css("height", o.options.constrainSize), o.zoomTintImage.css("width", o.constwidth))), "width" == o.options.constrainType && (o.zoomContainer.css("height", "auto"), o.zoomContainer.css("width", o.options.constrainSize), o.options.imageCrossfade ? (o.zoomWrap.css("height", "auto"), o.zoomWrap.css("width", o.options.constrainSize), o.constheight = o.zoomWrap.height()) : (o.$elem.css("height", "auto"), o.$elem.css("width", o.options.constrainSize), o.constheight = o.$elem.height()), "inner" == o.options.zoomType && (o.zoomWrap.parent().css("height", o.constheight), o.zoomWrap.parent().css("width", o.options.constrainSize), o.zoomWindow.css("height", o.constheight), o.zoomWindow.css("width", o.options.constrainSize)), o.options.tint && (o.tintContainer.css("height", o.constheight), o.tintContainer.css("width", o.options.constrainSize), o.zoomTint.css("height", o.constheight), o.zoomTint.css("width", o.options.constrainSize), o.zoomTintImage.css("height", o.constheight), o.zoomTintImage.css("width", o.options.constrainSize))))
                },
                doneCallback: function() {
                    var e = this;
                    e.options.loadingIcon && e.spinner.hide(), e.nzOffset = e.$elem.offset(), e.nzWidth = e.$elem.width(), e.nzHeight = e.$elem.height(), e.currentZoomLevel = e.options.zoomLevel, e.widthRatio = e.largeWidth / e.nzWidth, e.heightRatio = e.largeHeight / e.nzHeight, "window" == e.options.zoomType && (e.nzHeight < e.options.zoomWindowWidth / e.widthRatio ? lensHeight = e.nzHeight : lensHeight = String(e.options.zoomWindowHeight / e.heightRatio), e.options.zoomWindowWidth < e.options.zoomWindowWidth ? lensWidth = e.nzWidth : lensWidth = e.options.zoomWindowWidth / e.widthRatio, e.zoomLens && (e.zoomLens.css("width", lensWidth), e.zoomLens.css("height", lensHeight)))
                },
                getCurrentImage: function() {
                    return this.zoomImage
                },
                getGalleryList: function() {
                    var t = this;
                    return t.gallerylist = [], t.options.gallery ? e("#" + t.options.gallery + " a").each(function() {
                        var i = "";
                        e(this).data("zoom-image") ? i = e(this).data("zoom-image") : e(this).data("image") && (i = e(this).data("image")), i == t.zoomImage ? t.gallerylist.unshift({
                            href: "" + i,
                            title: e(this).find("img").attr("title")
                        }) : t.gallerylist.push({
                            href: "" + i,
                            title: e(this).find("img").attr("title")
                        })
                    }) : t.gallerylist.push({
                        href: "" + t.zoomImage,
                        title: e(this).find("img").attr("title")
                    }), t.gallerylist
                },
                changeZoomLevel: function(e) {
                    var t = this;
                    t.scrollingLock = !0, t.newvalue = parseFloat(e).toFixed(2), newvalue = parseFloat(e).toFixed(2), maxheightnewvalue = t.largeHeight / (t.options.zoomWindowHeight / t.nzHeight * t.nzHeight), maxwidthtnewvalue = t.largeWidth / (t.options.zoomWindowWidth / t.nzWidth * t.nzWidth), "inner" != t.options.zoomType && (maxheightnewvalue <= newvalue ? (t.heightRatio = t.largeHeight / maxheightnewvalue / t.nzHeight, t.newvalueheight = maxheightnewvalue, t.fullheight = !0) : (t.heightRatio = t.largeHeight / newvalue / t.nzHeight, t.newvalueheight = newvalue, t.fullheight = !1), maxwidthtnewvalue <= newvalue ? (t.widthRatio = t.largeWidth / maxwidthtnewvalue / t.nzWidth, t.newvaluewidth = maxwidthtnewvalue, t.fullwidth = !0) : (t.widthRatio = t.largeWidth / newvalue / t.nzWidth, t.newvaluewidth = newvalue, t.fullwidth = !1), "lens" == t.options.zoomType && (maxheightnewvalue <= newvalue ? (t.fullwidth = !0, t.newvaluewidth = maxheightnewvalue) : (t.widthRatio = t.largeWidth / newvalue / t.nzWidth, t.newvaluewidth = newvalue, t.fullwidth = !1))), "inner" == t.options.zoomType && (maxheightnewvalue = parseFloat(t.largeHeight / t.nzHeight).toFixed(2), maxwidthtnewvalue = parseFloat(t.largeWidth / t.nzWidth).toFixed(2), newvalue > maxheightnewvalue && (newvalue = maxheightnewvalue), newvalue > maxwidthtnewvalue && (newvalue = maxwidthtnewvalue), maxheightnewvalue <= newvalue ? (t.heightRatio = t.largeHeight / newvalue / t.nzHeight, newvalue > maxheightnewvalue ? t.newvalueheight = maxheightnewvalue : t.newvalueheight = newvalue, t.fullheight = !0) : (t.heightRatio = t.largeHeight / newvalue / t.nzHeight, newvalue > maxheightnewvalue ? t.newvalueheight = maxheightnewvalue : t.newvalueheight = newvalue, t.fullheight = !1), maxwidthtnewvalue <= newvalue ? (t.widthRatio = t.largeWidth / newvalue / t.nzWidth, newvalue > maxwidthtnewvalue ? t.newvaluewidth = maxwidthtnewvalue : t.newvaluewidth = newvalue, t.fullwidth = !0) : (t.widthRatio = t.largeWidth / newvalue / t.nzWidth, t.newvaluewidth = newvalue, t.fullwidth = !1)), scrcontinue = !1, "inner" == t.options.zoomType && (t.nzWidth >= t.nzHeight && (t.newvaluewidth <= maxwidthtnewvalue ? scrcontinue = !0 : (scrcontinue = !1, t.fullheight = !0, t.fullwidth = !0)), t.nzHeight > t.nzWidth && (t.newvaluewidth <= maxwidthtnewvalue ? scrcontinue = !0 : (scrcontinue = !1, t.fullheight = !0, t.fullwidth = !0))), "inner" != t.options.zoomType && (scrcontinue = !0), scrcontinue && (t.zoomLock = 0, t.changeZoom = !0, t.options.zoomWindowHeight / t.heightRatio <= t.nzHeight && (t.currentZoomLevel = t.newvalueheight, "lens" != t.options.zoomType && "inner" != t.options.zoomType && (t.changeBgSize = !0, t.zoomLens.css({
                        height: String(t.options.zoomWindowHeight / t.heightRatio) + "px"
                    })), "lens" != t.options.zoomType && "inner" != t.options.zoomType || (t.changeBgSize = !0)), t.options.zoomWindowWidth / t.widthRatio <= t.nzWidth && ("inner" != t.options.zoomType && t.newvaluewidth > t.newvalueheight && (t.currentZoomLevel = t.newvaluewidth), "lens" != t.options.zoomType && "inner" != t.options.zoomType && (t.changeBgSize = !0, t.zoomLens.css({
                        width: String(t.options.zoomWindowWidth / t.widthRatio) + "px"
                    })), "lens" != t.options.zoomType && "inner" != t.options.zoomType || (t.changeBgSize = !0)), "inner" == t.options.zoomType && (t.changeBgSize = !0, t.nzWidth > t.nzHeight && (t.currentZoomLevel = t.newvaluewidth), t.nzHeight > t.nzWidth && (t.currentZoomLevel = t.newvaluewidth))), t.setPosition(t.currentLoc)
                },
                closeAll: function() {
                    self.zoomWindow && self.zoomWindow.hide(), self.zoomLens && self.zoomLens.hide(), self.zoomTint && self.zoomTint.hide()
                },
                changeState: function(e) {
                    var t = this;
                    "enable" == e && (t.options.zoomEnabled = !0), "disable" == e && (t.options.zoomEnabled = !1)
                }
            };
            e.fn.elevateZoom = function(t) {
                return this.each(function() {
                    var i = Object.create(n);
                    i.init(t, this), e.data(this, "elevateZoom", i)
                })
            }, e.fn.elevateZoom.options = {
                zoomActivation: "hover",
                zoomEnabled: !0,
                preloading: 1,
                zoomLevel: 1,
                scrollZoom: !1,
                scrollZoomIncrement: .1,
                minZoomLevel: !1,
                maxZoomLevel: !1,
                easing: !1,
                easingAmount: 12,
                lensSize: 200,
                zoomWindowWidth: 400,
                zoomWindowHeight: 400,
                zoomWindowOffetx: 0,
                zoomWindowOffety: 0,
                zoomWindowPosition: 1,
                zoomWindowBgColour: "#fff",
                lensFadeIn: !1,
                lensFadeOut: !1,
                debug: !1,
                zoomWindowFadeIn: !1,
                zoomWindowFadeOut: !1,
                zoomWindowAlwaysShow: !1,
                zoomTintFadeIn: !1,
                zoomTintFadeOut: !1,
                borderSize: 4,
                showLens: !0,
                borderColour: "#888",
                lensBorderSize: 1,
                lensBorderColour: "#000",
                lensShape: "square",
                zoomType: "window",
                containLensZoom: !1,
                lensColour: "white",
                lensOpacity: .4,
                lenszoom: !1,
                tint: !1,
                tintColour: "#333",
                tintOpacity: .4,
                gallery: !1,
                galleryActiveClass: "zoomGalleryActive",
                imageCrossfade: !1,
                constrainType: !1,
                constrainSize: !1,
                loadingIcon: !1,
                cursor: "default",
                responsive: !0,
                onComplete: e.noop,
                onDestroy: function() {},
                onZoomedImageLoaded: function() {},
                onImageSwap: e.noop,
                onImageSwapComplete: e.noop
            }
        }(jQuery, window, document)
}, function(e, t, i) {
    "use strict";
    var o, n, s;
    ! function(r) {
        n = [i(0)], o = r, void 0 !== (s = "function" == typeof o ? o.apply(t, n) : o) && (e.exports = s)
    }(function(e) {
        var t = window.Slick || {};
        (t = function() {
            var t = 0;
            return function(i, o) {
                var n, s = this;
                s.defaults = {
                    accessibility: !0,
                    adaptiveHeight: !1,
                    appendArrows: e(i),
                    appendDots: e(i),
                    arrows: !0,
                    asNavFor: null,
                    prevArrow: '<button class="slick-prev" aria-label="Previous" type="button">Previous</button>',
                    nextArrow: '<button class="slick-next" aria-label="Next" type="button">Next</button>',
                    autoplay: !1,
                    autoplaySpeed: 3e3,
                    centerMode: !1,
                    centerPadding: "50px",
                    cssEase: "ease",
                    customPaging: function(t, i) {
                        return e('<button type="button" />').text(i + 1)
                    },
                    dots: !1,
                    dotsClass: "slick-dots",
                    draggable: !0,
                    easing: "linear",
                    edgeFriction: .35,
                    fade: !1,
                    focusOnSelect: !1,
                    focusOnChange: !1,
                    infinite: !0,
                    initialSlide: 0,
                    lazyLoad: "ondemand",
                    mobileFirst: !1,
                    pauseOnHover: !0,
                    pauseOnFocus: !0,
                    pauseOnDotsHover: !1,
                    respondTo: "window",
                    responsive: null,
                    rows: 1,
                    rtl: !1,
                    slide: "",
                    slidesPerRow: 1,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    speed: 500,
                    swipe: !0,
                    swipeToSlide: !1,
                    touchMove: !0,
                    touchThreshold: 5,
                    useCSS: !0,
                    useTransform: !0,
                    variableWidth: !1,
                    vertical: !1,
                    verticalSwiping: !1,
                    waitForAnimate: !0,
                    zIndex: 1e3
                }, s.initials = {
                    animating: !1,
                    dragging: !1,
                    autoPlayTimer: null,
                    currentDirection: 0,
                    currentLeft: null,
                    currentSlide: 0,
                    direction: 1,
                    $dots: null,
                    listWidth: null,
                    listHeight: null,
                    loadIndex: 0,
                    $nextArrow: null,
                    $prevArrow: null,
                    scrolling: !1,
                    slideCount: null,
                    slideWidth: null,
                    $slideTrack: null,
                    $slides: null,
                    sliding: !1,
                    slideOffset: 0,
                    swipeLeft: null,
                    swiping: !1,
                    $list: null,
                    touchObject: {},
                    transformsEnabled: !1,
                    unslicked: !1
                }, e.extend(s, s.initials), s.activeBreakpoint = null, s.animType = null, s.animProp = null, s.breakpoints = [], s.breakpointSettings = [], s.cssTransitions = !1, s.focussed = !1, s.interrupted = !1, s.hidden = "hidden", s.paused = !0, s.positionProp = null, s.respondTo = null, s.rowCount = 1, s.shouldClick = !0, s.$slider = e(i), s.$slidesCache = null, s.transformType = null, s.transitionType = null, s.visibilityChange = "visibilitychange", s.windowWidth = 0, s.windowTimer = null, n = e(i).data("slick") || {}, s.options = e.extend({}, s.defaults, o, n), s.currentSlide = s.options.initialSlide, s.originalSettings = s.options, void 0 !== document.mozHidden ? (s.hidden = "mozHidden", s.visibilityChange = "mozvisibilitychange") : void 0 !== document.webkitHidden && (s.hidden = "webkitHidden", s.visibilityChange = "webkitvisibilitychange"), s.autoPlay = e.proxy(s.autoPlay, s), s.autoPlayClear = e.proxy(s.autoPlayClear, s), s.autoPlayIterator = e.proxy(s.autoPlayIterator, s), s.changeSlide = e.proxy(s.changeSlide, s), s.clickHandler = e.proxy(s.clickHandler, s), s.selectHandler = e.proxy(s.selectHandler, s), s.setPosition = e.proxy(s.setPosition, s), s.swipeHandler = e.proxy(s.swipeHandler, s), s.dragHandler = e.proxy(s.dragHandler, s), s.keyHandler = e.proxy(s.keyHandler, s), s.instanceUid = t++, s.htmlExpr = /^(?:\s*(<[\w\W]+>)[^>]*)$/, s.registerBreakpoints(), s.init(!0)
            }
        }()).prototype.activateADA = function() {
            this.$slideTrack.find(".slick-active").attr({
                "aria-hidden": "false"
            }).find("a, input, button, select").attr({
                tabindex: "0"
            })
        }, t.prototype.addSlide = t.prototype.slickAdd = function(t, i, o) {
            var n = this;
            if ("boolean" == typeof i) o = i, i = null;
            else if (i < 0 || i >= n.slideCount) return !1;
            n.unload(), "number" == typeof i ? 0 === i && 0 === n.$slides.length ? e(t).appendTo(n.$slideTrack) : o ? e(t).insertBefore(n.$slides.eq(i)) : e(t).insertAfter(n.$slides.eq(i)) : !0 === o ? e(t).prependTo(n.$slideTrack) : e(t).appendTo(n.$slideTrack), n.$slides = n.$slideTrack.children(this.options.slide), n.$slideTrack.children(this.options.slide).detach(), n.$slideTrack.append(n.$slides), n.$slides.each(function(t, i) {
                e(i).attr("data-slick-index", t)
            }), n.$slidesCache = n.$slides, n.reinit()
        }, t.prototype.animateHeight = function() {
            var e = this;
            if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
                var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
                e.$list.animate({
                    height: t
                }, e.options.speed)
            }
        }, t.prototype.animateSlide = function(t, i) {
            var o = {},
                n = this;
            n.animateHeight(), !0 === n.options.rtl && !1 === n.options.vertical && (t = -t), !1 === n.transformsEnabled ? !1 === n.options.vertical ? n.$slideTrack.animate({
                left: t
            }, n.options.speed, n.options.easing, i) : n.$slideTrack.animate({
                top: t
            }, n.options.speed, n.options.easing, i) : !1 === n.cssTransitions ? (!0 === n.options.rtl && (n.currentLeft = -n.currentLeft), e({
                animStart: n.currentLeft
            }).animate({
                animStart: t
            }, {
                duration: n.options.speed,
                easing: n.options.easing,
                step: function(e) {
                    e = Math.ceil(e), !1 === n.options.vertical ? (o[n.animType] = "translate(" + e + "px, 0px)", n.$slideTrack.css(o)) : (o[n.animType] = "translate(0px," + e + "px)", n.$slideTrack.css(o))
                },
                complete: function() {
                    i && i.call()
                }
            })) : (n.applyTransition(), t = Math.ceil(t), !1 === n.options.vertical ? o[n.animType] = "translate3d(" + t + "px, 0px, 0px)" : o[n.animType] = "translate3d(0px," + t + "px, 0px)", n.$slideTrack.css(o), i && setTimeout(function() {
                n.disableTransition(), i.call()
            }, n.options.speed))
        }, t.prototype.getNavTarget = function() {
            var t = this,
                i = t.options.asNavFor;
            return i && null !== i && (i = e(i).not(t.$slider)), i
        }, t.prototype.asNavFor = function(t) {
            var i = this.getNavTarget();
            null !== i && "object" == typeof i && i.each(function() {
                var i = e(this).slick("getSlick");
                i.unslicked || i.slideHandler(t, !0)
            })
        }, t.prototype.applyTransition = function(e) {
            var t = this,
                i = {};
            !1 === t.options.fade ? i[t.transitionType] = t.transformType + " " + t.options.speed + "ms " + t.options.cssEase : i[t.transitionType] = "opacity " + t.options.speed + "ms " + t.options.cssEase, !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(e).css(i)
        }, t.prototype.autoPlay = function() {
            var e = this;
            e.autoPlayClear(), e.slideCount > e.options.slidesToShow && (e.autoPlayTimer = setInterval(e.autoPlayIterator, e.options.autoplaySpeed))
        }, t.prototype.autoPlayClear = function() {
            var e = this;
            e.autoPlayTimer && clearInterval(e.autoPlayTimer)
        }, t.prototype.autoPlayIterator = function() {
            var e = this,
                t = e.currentSlide + e.options.slidesToScroll;
            e.paused || e.interrupted || e.focussed || (!1 === e.options.infinite && (1 === e.direction && e.currentSlide + 1 === e.slideCount - 1 ? e.direction = 0 : 0 === e.direction && (t = e.currentSlide - e.options.slidesToScroll, e.currentSlide - 1 == 0 && (e.direction = 1))), e.slideHandler(t))
        }, t.prototype.buildArrows = function() {
            var t = this;
            !0 === t.options.arrows && (t.$prevArrow = e(t.options.prevArrow).addClass("slick-arrow"), t.$nextArrow = e(t.options.nextArrow).addClass("slick-arrow"), t.slideCount > t.options.slidesToShow ? (t.$prevArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.$nextArrow.removeClass("slick-hidden").removeAttr("aria-hidden tabindex"), t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.prependTo(t.options.appendArrows), t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.appendTo(t.options.appendArrows), !0 !== t.options.infinite && t.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true")) : t.$prevArrow.add(t.$nextArrow).addClass("slick-hidden").attr({
                "aria-disabled": "true",
                tabindex: "-1"
            }))
        }, t.prototype.buildDots = function() {
            var t, i, o = this;
            if (!0 === o.options.dots) {
                for (o.$slider.addClass("slick-dotted"), i = e("<ul />").addClass(o.options.dotsClass), t = 0; t <= o.getDotCount(); t += 1) i.append(e("<li />").append(o.options.customPaging.call(this, o, t)));
                o.$dots = i.appendTo(o.options.appendDots), o.$dots.find("li").first().addClass("slick-active")
            }
        }, t.prototype.buildOut = function() {
            var t = this;
            t.$slides = t.$slider.children(t.options.slide + ":not(.slick-cloned)").addClass("slick-slide"), t.slideCount = t.$slides.length, t.$slides.each(function(t, i) {
                e(i).attr("data-slick-index", t).data("originalStyling", e(i).attr("style") || "")
            }), t.$slider.addClass("slick-slider"), t.$slideTrack = 0 === t.slideCount ? e('<div class="slick-track"/>').appendTo(t.$slider) : t.$slides.wrapAll('<div class="slick-track"/>').parent(), t.$list = t.$slideTrack.wrap('<div class="slick-list"/>').parent(), t.$slideTrack.css("opacity", 0), !0 !== t.options.centerMode && !0 !== t.options.swipeToSlide || (t.options.slidesToScroll = 1), e("img[data-lazy]", t.$slider).not("[src]").addClass("slick-loading"), t.setupInfinite(), t.buildArrows(), t.buildDots(), t.updateDots(), t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0), !0 === t.options.draggable && t.$list.addClass("draggable")
        }, t.prototype.buildRows = function() {
            var e, t, i, o, n, s, r, a = this;
            if (o = document.createDocumentFragment(), s = a.$slider.children(), a.options.rows > 1) {
                for (r = a.options.slidesPerRow * a.options.rows, n = Math.ceil(s.length / r), e = 0; e < n; e++) {
                    var l = document.createElement("div");
                    for (t = 0; t < a.options.rows; t++) {
                        var d = document.createElement("div");
                        for (i = 0; i < a.options.slidesPerRow; i++) {
                            var c = e * r + (t * a.options.slidesPerRow + i);
                            s.get(c) && d.appendChild(s.get(c))
                        }
                        l.appendChild(d)
                    }
                    o.appendChild(l)
                }
                a.$slider.empty().append(o), a.$slider.children().children().children().css({
                    width: 100 / a.options.slidesPerRow + "%",
                    display: "inline-block"
                })
            }
        }, t.prototype.checkResponsive = function(t, i) {
            var o, n, s, r = this,
                a = !1,
                l = r.$slider.width(),
                d = window.innerWidth || e(window).width();
            if ("window" === r.respondTo ? s = d : "slider" === r.respondTo ? s = l : "min" === r.respondTo && (s = Math.min(d, l)), r.options.responsive && r.options.responsive.length && null !== r.options.responsive) {
                n = null;
                for (o in r.breakpoints) r.breakpoints.hasOwnProperty(o) && (!1 === r.originalSettings.mobileFirst ? s < r.breakpoints[o] && (n = r.breakpoints[o]) : s > r.breakpoints[o] && (n = r.breakpoints[o]));
                null !== n ? null !== r.activeBreakpoint ? (n !== r.activeBreakpoint || i) && (r.activeBreakpoint = n, "unslick" === r.breakpointSettings[n] ? r.unslick(n) : (r.options = e.extend({}, r.originalSettings, r.breakpointSettings[n]), !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t)), a = n) : (r.activeBreakpoint = n, "unslick" === r.breakpointSettings[n] ? r.unslick(n) : (r.options = e.extend({}, r.originalSettings, r.breakpointSettings[n]), !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t)), a = n) : null !== r.activeBreakpoint && (r.activeBreakpoint = null, r.options = r.originalSettings, !0 === t && (r.currentSlide = r.options.initialSlide), r.refresh(t), a = n), t || !1 === a || r.$slider.trigger("breakpoint", [r, a])
            }
        }, t.prototype.changeSlide = function(t, i) {
            var o, n, s, r = this,
                a = e(t.currentTarget);
            switch (a.is("a") && t.preventDefault(), a.is("li") || (a = a.closest("li")), s = r.slideCount % r.options.slidesToScroll != 0, o = s ? 0 : (r.slideCount - r.currentSlide) % r.options.slidesToScroll, t.data.message) {
                case "previous":
                    n = 0 === o ? r.options.slidesToScroll : r.options.slidesToShow - o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide - n, !1, i);
                    break;
                case "next":
                    n = 0 === o ? r.options.slidesToScroll : o, r.slideCount > r.options.slidesToShow && r.slideHandler(r.currentSlide + n, !1, i);
                    break;
                case "index":
                    var l = 0 === t.data.index ? 0 : t.data.index || a.index() * r.options.slidesToScroll;
                    r.slideHandler(r.checkNavigable(l), !1, i), a.children().trigger("focus");
                    break;
                default:
                    return
            }
        }, t.prototype.checkNavigable = function(e) {
            var t, i;
            if (t = this.getNavigableIndexes(), i = 0, e > t[t.length - 1]) e = t[t.length - 1];
            else
                for (var o in t) {
                    if (e < t[o]) {
                        e = i;
                        break
                    }
                    i = t[o]
                }
            return e
        }, t.prototype.cleanUpEvents = function() {
            var t = this;
            t.options.dots && null !== t.$dots && (e("li", t.$dots).off("click.slick", t.changeSlide).off("mouseenter.slick", e.proxy(t.interrupt, t, !0)).off("mouseleave.slick", e.proxy(t.interrupt, t, !1)), !0 === t.options.accessibility && t.$dots.off("keydown.slick", t.keyHandler)), t.$slider.off("focus.slick blur.slick"), !0 === t.options.arrows && t.slideCount > t.options.slidesToShow && (t.$prevArrow && t.$prevArrow.off("click.slick", t.changeSlide), t.$nextArrow && t.$nextArrow.off("click.slick", t.changeSlide), !0 === t.options.accessibility && (t.$prevArrow && t.$prevArrow.off("keydown.slick", t.keyHandler), t.$nextArrow && t.$nextArrow.off("keydown.slick", t.keyHandler))), t.$list.off("touchstart.slick mousedown.slick", t.swipeHandler), t.$list.off("touchmove.slick mousemove.slick", t.swipeHandler), t.$list.off("touchend.slick mouseup.slick", t.swipeHandler), t.$list.off("touchcancel.slick mouseleave.slick", t.swipeHandler), t.$list.off("click.slick", t.clickHandler), e(document).off(t.visibilityChange, t.visibility), t.cleanUpSlideEvents(), !0 === t.options.accessibility && t.$list.off("keydown.slick", t.keyHandler), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().off("click.slick", t.selectHandler), e(window).off("orientationchange.slick.slick-" + t.instanceUid, t.orientationChange), e(window).off("resize.slick.slick-" + t.instanceUid, t.resize), e("[draggable!=true]", t.$slideTrack).off("dragstart", t.preventDefault), e(window).off("load.slick.slick-" + t.instanceUid, t.setPosition)
        }, t.prototype.cleanUpSlideEvents = function() {
            var t = this;
            t.$list.off("mouseenter.slick", e.proxy(t.interrupt, t, !0)), t.$list.off("mouseleave.slick", e.proxy(t.interrupt, t, !1))
        }, t.prototype.cleanUpRows = function() {
            var e, t = this;
            t.options.rows > 1 && ((e = t.$slides.children().children()).removeAttr("style"), t.$slider.empty().append(e))
        }, t.prototype.clickHandler = function(e) {
            !1 === this.shouldClick && (e.stopImmediatePropagation(), e.stopPropagation(), e.preventDefault())
        }, t.prototype.destroy = function(t) {
            var i = this;
            i.autoPlayClear(), i.touchObject = {}, i.cleanUpEvents(), e(".slick-cloned", i.$slider).detach(), i.$dots && i.$dots.remove(), i.$prevArrow && i.$prevArrow.length && (i.$prevArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.prevArrow) && i.$prevArrow.remove()), i.$nextArrow && i.$nextArrow.length && (i.$nextArrow.removeClass("slick-disabled slick-arrow slick-hidden").removeAttr("aria-hidden aria-disabled tabindex").css("display", ""), i.htmlExpr.test(i.options.nextArrow) && i.$nextArrow.remove()), i.$slides && (i.$slides.removeClass("slick-slide slick-active slick-center slick-visible slick-current").removeAttr("aria-hidden").removeAttr("data-slick-index").each(function() {
                e(this).attr("style", e(this).data("originalStyling"))
            }), i.$slideTrack.children(this.options.slide).detach(), i.$slideTrack.detach(), i.$list.detach(), i.$slider.append(i.$slides)), i.cleanUpRows(), i.$slider.removeClass("slick-slider"), i.$slider.removeClass("slick-initialized"), i.$slider.removeClass("slick-dotted"), i.unslicked = !0, t || i.$slider.trigger("destroy", [i])
        }, t.prototype.disableTransition = function(e) {
            var t = this,
                i = {};
            i[t.transitionType] = "", !1 === t.options.fade ? t.$slideTrack.css(i) : t.$slides.eq(e).css(i)
        }, t.prototype.fadeSlide = function(e, t) {
            var i = this;
            !1 === i.cssTransitions ? (i.$slides.eq(e).css({
                zIndex: i.options.zIndex
            }), i.$slides.eq(e).animate({
                opacity: 1
            }, i.options.speed, i.options.easing, t)) : (i.applyTransition(e), i.$slides.eq(e).css({
                opacity: 1,
                zIndex: i.options.zIndex
            }), t && setTimeout(function() {
                i.disableTransition(e), t.call()
            }, i.options.speed))
        }, t.prototype.fadeSlideOut = function(e) {
            var t = this;
            !1 === t.cssTransitions ? t.$slides.eq(e).animate({
                opacity: 0,
                zIndex: t.options.zIndex - 2
            }, t.options.speed, t.options.easing) : (t.applyTransition(e), t.$slides.eq(e).css({
                opacity: 0,
                zIndex: t.options.zIndex - 2
            }))
        }, t.prototype.filterSlides = t.prototype.slickFilter = function(e) {
            var t = this;
            null !== e && (t.$slidesCache = t.$slides, t.unload(), t.$slideTrack.children(this.options.slide).detach(), t.$slidesCache.filter(e).appendTo(t.$slideTrack), t.reinit())
        }, t.prototype.focusHandler = function() {
            var t = this;
            t.$slider.off("focus.slick blur.slick").on("focus.slick blur.slick", "*", function(i) {
                i.stopImmediatePropagation();
                var o = e(this);
                setTimeout(function() {
                    t.options.pauseOnFocus && (t.focussed = o.is(":focus"), t.autoPlay())
                }, 0)
            })
        }, t.prototype.getCurrent = t.prototype.slickCurrentSlide = function() {
            return this.currentSlide
        }, t.prototype.getDotCount = function() {
            var e = this,
                t = 0,
                i = 0,
                o = 0;
            if (!0 === e.options.infinite)
                if (e.slideCount <= e.options.slidesToShow) ++o;
                else
                    for (; t < e.slideCount;) ++o, t = i + e.options.slidesToScroll, i += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
            else if (!0 === e.options.centerMode) o = e.slideCount;
            else if (e.options.asNavFor)
                for (; t < e.slideCount;) ++o, t = i + e.options.slidesToScroll, i += e.options.slidesToScroll <= e.options.slidesToShow ? e.options.slidesToScroll : e.options.slidesToShow;
            else o = 1 + Math.ceil((e.slideCount - e.options.slidesToShow) / e.options.slidesToScroll);
            return o - 1
        }, t.prototype.getLeft = function(e) {
            var t, i, o, n, s = this,
                r = 0;
            return s.slideOffset = 0, i = s.$slides.first().outerHeight(!0), !0 === s.options.infinite ? (s.slideCount > s.options.slidesToShow && (s.slideOffset = s.slideWidth * s.options.slidesToShow * -1, n = -1, !0 === s.options.vertical && !0 === s.options.centerMode && (2 === s.options.slidesToShow ? n = -1.5 : 1 === s.options.slidesToShow && (n = -2)), r = i * s.options.slidesToShow * n), s.slideCount % s.options.slidesToScroll != 0 && e + s.options.slidesToScroll > s.slideCount && s.slideCount > s.options.slidesToShow && (e > s.slideCount ? (s.slideOffset = (s.options.slidesToShow - (e - s.slideCount)) * s.slideWidth * -1, r = (s.options.slidesToShow - (e - s.slideCount)) * i * -1) : (s.slideOffset = s.slideCount % s.options.slidesToScroll * s.slideWidth * -1, r = s.slideCount % s.options.slidesToScroll * i * -1))) : e + s.options.slidesToShow > s.slideCount && (s.slideOffset = (e + s.options.slidesToShow - s.slideCount) * s.slideWidth, r = (e + s.options.slidesToShow - s.slideCount) * i), s.slideCount <= s.options.slidesToShow && (s.slideOffset = 0, r = 0), !0 === s.options.centerMode && s.slideCount <= s.options.slidesToShow ? s.slideOffset = s.slideWidth * Math.floor(s.options.slidesToShow) / 2 - s.slideWidth * s.slideCount / 2 : !0 === s.options.centerMode && !0 === s.options.infinite ? s.slideOffset += s.slideWidth * Math.floor(s.options.slidesToShow / 2) - s.slideWidth : !0 === s.options.centerMode && (s.slideOffset = 0, s.slideOffset += s.slideWidth * Math.floor(s.options.slidesToShow / 2)), t = !1 === s.options.vertical ? e * s.slideWidth * -1 + s.slideOffset : e * i * -1 + r, !0 === s.options.variableWidth && (o = s.slideCount <= s.options.slidesToShow || !1 === s.options.infinite ? s.$slideTrack.children(".slick-slide").eq(e) : s.$slideTrack.children(".slick-slide").eq(e + s.options.slidesToShow), t = !0 === s.options.rtl ? o[0] ? -1 * (s.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, !0 === s.options.centerMode && (o = s.slideCount <= s.options.slidesToShow || !1 === s.options.infinite ? s.$slideTrack.children(".slick-slide").eq(e) : s.$slideTrack.children(".slick-slide").eq(e + s.options.slidesToShow + 1), t = !0 === s.options.rtl ? o[0] ? -1 * (s.$slideTrack.width() - o[0].offsetLeft - o.width()) : 0 : o[0] ? -1 * o[0].offsetLeft : 0, t += (s.$list.width() - o.outerWidth()) / 2)), t
        }, t.prototype.getOption = t.prototype.slickGetOption = function(e) {
            return this.options[e]
        }, t.prototype.getNavigableIndexes = function() {
            var e, t = this,
                i = 0,
                o = 0,
                n = [];
            for (!1 === t.options.infinite ? e = t.slideCount : (i = -1 * t.options.slidesToScroll, o = -1 * t.options.slidesToScroll, e = 2 * t.slideCount); i < e;) n.push(i), i = o + t.options.slidesToScroll, o += t.options.slidesToScroll <= t.options.slidesToShow ? t.options.slidesToScroll : t.options.slidesToShow;
            return n
        }, t.prototype.getSlick = function() {
            return this
        }, t.prototype.getSlideCount = function() {
            var t, i, o = this;
            return i = !0 === o.options.centerMode ? o.slideWidth * Math.floor(o.options.slidesToShow / 2) : 0, !0 === o.options.swipeToSlide ? (o.$slideTrack.find(".slick-slide").each(function(n, s) {
                if (s.offsetLeft - i + e(s).outerWidth() / 2 > -1 * o.swipeLeft) return t = s, !1
            }), Math.abs(e(t).attr("data-slick-index") - o.currentSlide) || 1) : o.options.slidesToScroll
        }, t.prototype.goTo = t.prototype.slickGoTo = function(e, t) {
            this.changeSlide({
                data: {
                    message: "index",
                    index: parseInt(e)
                }
            }, t)
        }, t.prototype.init = function(t) {
            var i = this;
            e(i.$slider).hasClass("slick-initialized") || (e(i.$slider).addClass("slick-initialized"), i.buildRows(), i.buildOut(), i.setProps(), i.startLoad(), i.loadSlider(), i.initializeEvents(), i.updateArrows(), i.updateDots(), i.checkResponsive(!0), i.focusHandler()), t && i.$slider.trigger("init", [i]), !0 === i.options.accessibility && i.initADA(), i.options.autoplay && (i.paused = !1, i.autoPlay())
        }, t.prototype.initADA = function() {
            var t = this,
                i = Math.ceil(t.slideCount / t.options.slidesToShow),
                o = t.getNavigableIndexes().filter(function(e) {
                    return e >= 0 && e < t.slideCount
                });
            t.$slides.add(t.$slideTrack.find(".slick-cloned")).attr({
                "aria-hidden": "true",
                tabindex: "-1"
            }).find("a, input, button, select").attr({
                tabindex: "-1"
            }), null !== t.$dots && (t.$slides.not(t.$slideTrack.find(".slick-cloned")).each(function(i) {
                var n = o.indexOf(i);
                e(this).attr({
                    role: "tabpanel",
                    id: "slick-slide" + t.instanceUid + i,
                    tabindex: -1
                }), -1 !== n && e(this).attr({
                    "aria-describedby": "slick-slide-control" + t.instanceUid + n
                })
            }), t.$dots.attr("role", "tablist").find("li").each(function(n) {
                var s = o[n];
                e(this).attr({
                    role: "presentation"
                }), e(this).find("button").first().attr({
                    role: "tab",
                    id: "slick-slide-control" + t.instanceUid + n,
                    "aria-controls": "slick-slide" + t.instanceUid + s,
                    "aria-label": n + 1 + " of " + i,
                    "aria-selected": null,
                    tabindex: "-1"
                })
            }).eq(t.currentSlide).find("button").attr({
                "aria-selected": "true",
                tabindex: "0"
            }).end());
            for (var n = t.currentSlide, s = n + t.options.slidesToShow; n < s; n++) t.$slides.eq(n).attr("tabindex", 0);
            t.activateADA()
        }, t.prototype.initArrowEvents = function() {
            var e = this;
            !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.off("click.slick").on("click.slick", {
                message: "previous"
            }, e.changeSlide), e.$nextArrow.off("click.slick").on("click.slick", {
                message: "next"
            }, e.changeSlide), !0 === e.options.accessibility && (e.$prevArrow.on("keydown.slick", e.keyHandler), e.$nextArrow.on("keydown.slick", e.keyHandler)))
        }, t.prototype.initDotEvents = function() {
            var t = this;
            !0 === t.options.dots && (e("li", t.$dots).on("click.slick", {
                message: "index"
            }, t.changeSlide), !0 === t.options.accessibility && t.$dots.on("keydown.slick", t.keyHandler)), !0 === t.options.dots && !0 === t.options.pauseOnDotsHover && e("li", t.$dots).on("mouseenter.slick", e.proxy(t.interrupt, t, !0)).on("mouseleave.slick", e.proxy(t.interrupt, t, !1))
        }, t.prototype.initSlideEvents = function() {
            var t = this;
            t.options.pauseOnHover && (t.$list.on("mouseenter.slick", e.proxy(t.interrupt, t, !0)), t.$list.on("mouseleave.slick", e.proxy(t.interrupt, t, !1)))
        }, t.prototype.initializeEvents = function() {
            var t = this;
            t.initArrowEvents(), t.initDotEvents(), t.initSlideEvents(), t.$list.on("touchstart.slick mousedown.slick", {
                action: "start"
            }, t.swipeHandler), t.$list.on("touchmove.slick mousemove.slick", {
                action: "move"
            }, t.swipeHandler), t.$list.on("touchend.slick mouseup.slick", {
                action: "end"
            }, t.swipeHandler), t.$list.on("touchcancel.slick mouseleave.slick", {
                action: "end"
            }, t.swipeHandler), t.$list.on("click.slick", t.clickHandler), e(document).on(t.visibilityChange, e.proxy(t.visibility, t)), !0 === t.options.accessibility && t.$list.on("keydown.slick", t.keyHandler), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().on("click.slick", t.selectHandler), e(window).on("orientationchange.slick.slick-" + t.instanceUid, e.proxy(t.orientationChange, t)), e(window).on("resize.slick.slick-" + t.instanceUid, e.proxy(t.resize, t)), e("[draggable!=true]", t.$slideTrack).on("dragstart", t.preventDefault), e(window).on("load.slick.slick-" + t.instanceUid, t.setPosition), e(t.setPosition)
        }, t.prototype.initUI = function() {
            var e = this;
            !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.show(), e.$nextArrow.show()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.show()
        }, t.prototype.keyHandler = function(e) {
            var t = this;
            e.target.tagName.match("TEXTAREA|INPUT|SELECT") || (37 === e.keyCode && !0 === t.options.accessibility ? t.changeSlide({
                data: {
                    message: !0 === t.options.rtl ? "next" : "previous"
                }
            }) : 39 === e.keyCode && !0 === t.options.accessibility && t.changeSlide({
                data: {
                    message: !0 === t.options.rtl ? "previous" : "next"
                }
            }))
        }, t.prototype.lazyLoad = function() {
            function t(t) {
                e("img[data-lazy]", t).each(function() {
                    var t = e(this),
                        i = e(this).attr("data-lazy"),
                        o = e(this).attr("data-srcset"),
                        n = e(this).attr("data-sizes") || s.$slider.attr("data-sizes"),
                        r = document.createElement("img");
                    r.onload = function() {
                        t.animate({
                            opacity: 0
                        }, 100, function() {
                            o && (t.attr("srcset", o), n && t.attr("sizes", n)), t.attr("src", i).animate({
                                opacity: 1
                            }, 200, function() {
                                t.removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading")
                            }), s.$slider.trigger("lazyLoaded", [s, t, i])
                        })
                    }, r.onerror = function() {
                        t.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), s.$slider.trigger("lazyLoadError", [s, t, i])
                    }, r.src = i
                })
            }
            var i, o, n, s = this;
            if (!0 === s.options.centerMode ? !0 === s.options.infinite ? n = (o = s.currentSlide + (s.options.slidesToShow / 2 + 1)) + s.options.slidesToShow + 2 : (o = Math.max(0, s.currentSlide - (s.options.slidesToShow / 2 + 1)), n = s.options.slidesToShow / 2 + 1 + 2 + s.currentSlide) : (o = s.options.infinite ? s.options.slidesToShow + s.currentSlide : s.currentSlide, n = Math.ceil(o + s.options.slidesToShow), !0 === s.options.fade && (o > 0 && o--, n <= s.slideCount && n++)), i = s.$slider.find(".slick-slide").slice(o, n), "anticipated" === s.options.lazyLoad)
                for (var r = o - 1, a = n, l = s.$slider.find(".slick-slide"), d = 0; d < s.options.slidesToScroll; d++) r < 0 && (r = s.slideCount - 1), i = (i = i.add(l.eq(r))).add(l.eq(a)), r--, a++;
            t(i), s.slideCount <= s.options.slidesToShow ? t(s.$slider.find(".slick-slide")) : s.currentSlide >= s.slideCount - s.options.slidesToShow ? t(s.$slider.find(".slick-cloned").slice(0, s.options.slidesToShow)) : 0 === s.currentSlide && t(s.$slider.find(".slick-cloned").slice(-1 * s.options.slidesToShow))
        }, t.prototype.loadSlider = function() {
            var e = this;
            e.setPosition(), e.$slideTrack.css({
                opacity: 1
            }), e.$slider.removeClass("slick-loading"), e.initUI(), "progressive" === e.options.lazyLoad && e.progressiveLazyLoad()
        }, t.prototype.next = t.prototype.slickNext = function() {
            this.changeSlide({
                data: {
                    message: "next"
                }
            })
        }, t.prototype.orientationChange = function() {
            var e = this;
            e.checkResponsive(), e.setPosition()
        }, t.prototype.pause = t.prototype.slickPause = function() {
            var e = this;
            e.autoPlayClear(), e.paused = !0
        }, t.prototype.play = t.prototype.slickPlay = function() {
            var e = this;
            e.autoPlay(), e.options.autoplay = !0, e.paused = !1, e.focussed = !1, e.interrupted = !1
        }, t.prototype.postSlide = function(t) {
            var i = this;
            i.unslicked || (i.$slider.trigger("afterChange", [i, t]), i.animating = !1, i.slideCount > i.options.slidesToShow && i.setPosition(), i.swipeLeft = null, i.options.autoplay && i.autoPlay(), !0 === i.options.accessibility && (i.initADA(), i.options.focusOnChange && e(i.$slides.get(i.currentSlide)).attr("tabindex", 0).focus()))
        }, t.prototype.prev = t.prototype.slickPrev = function() {
            this.changeSlide({
                data: {
                    message: "previous"
                }
            })
        }, t.prototype.preventDefault = function(e) {
            e.preventDefault()
        }, t.prototype.progressiveLazyLoad = function(t) {
            t = t || 1;
            var i, o, n, s, r, a = this,
                l = e("img[data-lazy]", a.$slider);
            l.length ? (i = l.first(), o = i.attr("data-lazy"), n = i.attr("data-srcset"), s = i.attr("data-sizes") || a.$slider.attr("data-sizes"), (r = document.createElement("img")).onload = function() {
                n && (i.attr("srcset", n), s && i.attr("sizes", s)), i.attr("src", o).removeAttr("data-lazy data-srcset data-sizes").removeClass("slick-loading"), !0 === a.options.adaptiveHeight && a.setPosition(), a.$slider.trigger("lazyLoaded", [a, i, o]), a.progressiveLazyLoad()
            }, r.onerror = function() {
                t < 3 ? setTimeout(function() {
                    a.progressiveLazyLoad(t + 1)
                }, 500) : (i.removeAttr("data-lazy").removeClass("slick-loading").addClass("slick-lazyload-error"), a.$slider.trigger("lazyLoadError", [a, i, o]), a.progressiveLazyLoad())
            }, r.src = o) : a.$slider.trigger("allImagesLoaded", [a])
        }, t.prototype.refresh = function(t) {
            var i, o, n = this;
            o = n.slideCount - n.options.slidesToShow, !n.options.infinite && n.currentSlide > o && (n.currentSlide = o), n.slideCount <= n.options.slidesToShow && (n.currentSlide = 0), i = n.currentSlide, n.destroy(!0), e.extend(n, n.initials, {
                currentSlide: i
            }), n.init(), t || n.changeSlide({
                data: {
                    message: "index",
                    index: i
                }
            }, !1)
        }, t.prototype.registerBreakpoints = function() {
            var t, i, o, n = this,
                s = n.options.responsive || null;
            if ("array" === e.type(s) && s.length) {
                n.respondTo = n.options.respondTo || "window";
                for (t in s)
                    if (o = n.breakpoints.length - 1, s.hasOwnProperty(t)) {
                        for (i = s[t].breakpoint; o >= 0;) n.breakpoints[o] && n.breakpoints[o] === i && n.breakpoints.splice(o, 1), o--;
                        n.breakpoints.push(i), n.breakpointSettings[i] = s[t].settings
                    } n.breakpoints.sort(function(e, t) {
                    return n.options.mobileFirst ? e - t : t - e
                })
            }
        }, t.prototype.reinit = function() {
            var t = this;
            t.$slides = t.$slideTrack.children(t.options.slide).addClass("slick-slide"), t.slideCount = t.$slides.length, t.currentSlide >= t.slideCount && 0 !== t.currentSlide && (t.currentSlide = t.currentSlide - t.options.slidesToScroll), t.slideCount <= t.options.slidesToShow && (t.currentSlide = 0), t.registerBreakpoints(), t.setProps(), t.setupInfinite(), t.buildArrows(), t.updateArrows(), t.initArrowEvents(), t.buildDots(), t.updateDots(), t.initDotEvents(), t.cleanUpSlideEvents(), t.initSlideEvents(), t.checkResponsive(!1, !0), !0 === t.options.focusOnSelect && e(t.$slideTrack).children().on("click.slick", t.selectHandler), t.setSlideClasses("number" == typeof t.currentSlide ? t.currentSlide : 0), t.setPosition(), t.focusHandler(), t.paused = !t.options.autoplay, t.autoPlay(), t.$slider.trigger("reInit", [t])
        }, t.prototype.resize = function() {
            var t = this;
            e(window).width() !== t.windowWidth && (clearTimeout(t.windowDelay), t.windowDelay = window.setTimeout(function() {
                t.windowWidth = e(window).width(), t.checkResponsive(), t.unslicked || t.setPosition()
            }, 50))
        }, t.prototype.removeSlide = t.prototype.slickRemove = function(e, t, i) {
            var o = this;
            if (e = "boolean" == typeof e ? !0 === (t = e) ? 0 : o.slideCount - 1 : !0 === t ? --e : e, o.slideCount < 1 || e < 0 || e > o.slideCount - 1) return !1;
            o.unload(), !0 === i ? o.$slideTrack.children().remove() : o.$slideTrack.children(this.options.slide).eq(e).remove(), o.$slides = o.$slideTrack.children(this.options.slide), o.$slideTrack.children(this.options.slide).detach(), o.$slideTrack.append(o.$slides), o.$slidesCache = o.$slides, o.reinit()
        }, t.prototype.setCSS = function(e) {
            var t, i, o = this,
                n = {};
            !0 === o.options.rtl && (e = -e), t = "left" == o.positionProp ? Math.ceil(e) + "px" : "0px", i = "top" == o.positionProp ? Math.ceil(e) + "px" : "0px", n[o.positionProp] = e, !1 === o.transformsEnabled ? o.$slideTrack.css(n) : (n = {}, !1 === o.cssTransitions ? (n[o.animType] = "translate(" + t + ", " + i + ")", o.$slideTrack.css(n)) : (n[o.animType] = "translate3d(" + t + ", " + i + ", 0px)", o.$slideTrack.css(n)))
        }, t.prototype.setDimensions = function() {
            var e = this;
            !1 === e.options.vertical ? !0 === e.options.centerMode && e.$list.css({
                padding: "0px " + e.options.centerPadding
            }) : (e.$list.height(e.$slides.first().outerHeight(!0) * e.options.slidesToShow), !0 === e.options.centerMode && e.$list.css({
                padding: e.options.centerPadding + " 0px"
            })), e.listWidth = e.$list.width(), e.listHeight = e.$list.height(), !1 === e.options.vertical && !1 === e.options.variableWidth ? (e.slideWidth = Math.ceil(e.listWidth / e.options.slidesToShow), e.$slideTrack.width(Math.ceil(e.slideWidth * e.$slideTrack.children(".slick-slide").length))) : !0 === e.options.variableWidth ? e.$slideTrack.width(5e3 * e.slideCount) : (e.slideWidth = Math.ceil(e.listWidth), e.$slideTrack.height(Math.ceil(e.$slides.first().outerHeight(!0) * e.$slideTrack.children(".slick-slide").length)));
            var t = e.$slides.first().outerWidth(!0) - e.$slides.first().width();
            !1 === e.options.variableWidth && e.$slideTrack.children(".slick-slide").width(e.slideWidth - t)
        }, t.prototype.setFade = function() {
            var t, i = this;
            i.$slides.each(function(o, n) {
                t = i.slideWidth * o * -1, !0 === i.options.rtl ? e(n).css({
                    position: "relative",
                    right: t,
                    top: 0,
                    zIndex: i.options.zIndex - 2,
                    opacity: 0
                }) : e(n).css({
                    position: "relative",
                    left: t,
                    top: 0,
                    zIndex: i.options.zIndex - 2,
                    opacity: 0
                })
            }), i.$slides.eq(i.currentSlide).css({
                zIndex: i.options.zIndex - 1,
                opacity: 1
            })
        }, t.prototype.setHeight = function() {
            var e = this;
            if (1 === e.options.slidesToShow && !0 === e.options.adaptiveHeight && !1 === e.options.vertical) {
                var t = e.$slides.eq(e.currentSlide).outerHeight(!0);
                e.$list.css("height", t)
            }
        }, t.prototype.setOption = t.prototype.slickSetOption = function() {
            var t, i, o, n, s, r = this,
                a = !1;
            if ("object" === e.type(arguments[0]) ? (o = arguments[0], a = arguments[1], s = "multiple") : "string" === e.type(arguments[0]) && (o = arguments[0], n = arguments[1], a = arguments[2], "responsive" === arguments[0] && "array" === e.type(arguments[1]) ? s = "responsive" : void 0 !== arguments[1] && (s = "single")), "single" === s) r.options[o] = n;
            else if ("multiple" === s) e.each(o, function(e, t) {
                r.options[e] = t
            });
            else if ("responsive" === s)
                for (i in n)
                    if ("array" !== e.type(r.options.responsive)) r.options.responsive = [n[i]];
                    else {
                        for (t = r.options.responsive.length - 1; t >= 0;) r.options.responsive[t].breakpoint === n[i].breakpoint && r.options.responsive.splice(t, 1), t--;
                        r.options.responsive.push(n[i])
                    } a && (r.unload(), r.reinit())
        }, t.prototype.setPosition = function() {
            var e = this;
            e.setDimensions(), e.setHeight(), !1 === e.options.fade ? e.setCSS(e.getLeft(e.currentSlide)) : e.setFade(), e.$slider.trigger("setPosition", [e])
        }, t.prototype.setProps = function() {
            var e = this,
                t = document.body.style;
            e.positionProp = !0 === e.options.vertical ? "top" : "left", "top" === e.positionProp ? e.$slider.addClass("slick-vertical") : e.$slider.removeClass("slick-vertical"), void 0 === t.WebkitTransition && void 0 === t.MozTransition && void 0 === t.msTransition || !0 === e.options.useCSS && (e.cssTransitions = !0), e.options.fade && ("number" == typeof e.options.zIndex ? e.options.zIndex < 3 && (e.options.zIndex = 3) : e.options.zIndex = e.defaults.zIndex), void 0 !== t.OTransform && (e.animType = "OTransform", e.transformType = "-o-transform", e.transitionType = "OTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.MozTransform && (e.animType = "MozTransform", e.transformType = "-moz-transform", e.transitionType = "MozTransition", void 0 === t.perspectiveProperty && void 0 === t.MozPerspective && (e.animType = !1)), void 0 !== t.webkitTransform && (e.animType = "webkitTransform", e.transformType = "-webkit-transform", e.transitionType = "webkitTransition", void 0 === t.perspectiveProperty && void 0 === t.webkitPerspective && (e.animType = !1)), void 0 !== t.msTransform && (e.animType = "msTransform", e.transformType = "-ms-transform", e.transitionType = "msTransition", void 0 === t.msTransform && (e.animType = !1)), void 0 !== t.transform && !1 !== e.animType && (e.animType = "transform", e.transformType = "transform", e.transitionType = "transition"), e.transformsEnabled = e.options.useTransform && null !== e.animType && !1 !== e.animType
        }, t.prototype.setSlideClasses = function(e) {
            var t, i, o, n, s = this;
            if (i = s.$slider.find(".slick-slide").removeClass("slick-active slick-center slick-current").attr("aria-hidden", "true"), s.$slides.eq(e).addClass("slick-current"), !0 === s.options.centerMode) {
                var r = s.options.slidesToShow % 2 == 0 ? 1 : 0;
                t = Math.floor(s.options.slidesToShow / 2), !0 === s.options.infinite && (e >= t && e <= s.slideCount - 1 - t ? s.$slides.slice(e - t + r, e + t + 1).addClass("slick-active").attr("aria-hidden", "false") : (o = s.options.slidesToShow + e, i.slice(o - t + 1 + r, o + t + 2).addClass("slick-active").attr("aria-hidden", "false")), 0 === e ? i.eq(i.length - 1 - s.options.slidesToShow).addClass("slick-center") : e === s.slideCount - 1 && i.eq(s.options.slidesToShow).addClass("slick-center")), s.$slides.eq(e).addClass("slick-center")
            } else e >= 0 && e <= s.slideCount - s.options.slidesToShow ? s.$slides.slice(e, e + s.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false") : i.length <= s.options.slidesToShow ? i.addClass("slick-active").attr("aria-hidden", "false") : (n = s.slideCount % s.options.slidesToShow, o = !0 === s.options.infinite ? s.options.slidesToShow + e : e, s.options.slidesToShow == s.options.slidesToScroll && s.slideCount - e < s.options.slidesToShow ? i.slice(o - (s.options.slidesToShow - n), o + n).addClass("slick-active").attr("aria-hidden", "false") : i.slice(o, o + s.options.slidesToShow).addClass("slick-active").attr("aria-hidden", "false"));
            "ondemand" !== s.options.lazyLoad && "anticipated" !== s.options.lazyLoad || s.lazyLoad()
        }, t.prototype.setupInfinite = function() {
            var t, i, o, n = this;
            if (!0 === n.options.fade && (n.options.centerMode = !1), !0 === n.options.infinite && !1 === n.options.fade && (i = null, n.slideCount > n.options.slidesToShow)) {
                for (o = !0 === n.options.centerMode ? n.options.slidesToShow + 1 : n.options.slidesToShow, t = n.slideCount; t > n.slideCount - o; t -= 1) i = t - 1, e(n.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i - n.slideCount).prependTo(n.$slideTrack).addClass("slick-cloned");
                for (t = 0; t < o + n.slideCount; t += 1) i = t, e(n.$slides[i]).clone(!0).attr("id", "").attr("data-slick-index", i + n.slideCount).appendTo(n.$slideTrack).addClass("slick-cloned");
                n.$slideTrack.find(".slick-cloned").find("[id]").each(function() {
                    e(this).attr("id", "")
                })
            }
        }, t.prototype.interrupt = function(e) {
            var t = this;
            e || t.autoPlay(), t.interrupted = e
        }, t.prototype.selectHandler = function(t) {
            var i = this,
                o = e(t.target).is(".slick-slide") ? e(t.target) : e(t.target).parents(".slick-slide"),
                n = parseInt(o.attr("data-slick-index"));
            n || (n = 0), i.slideCount <= i.options.slidesToShow ? i.slideHandler(n, !1, !0) : i.slideHandler(n)
        }, t.prototype.slideHandler = function(e, t, i) {
            var o, n, s, r, a, l = null,
                d = this;
            if (t = t || !1, !(!0 === d.animating && !0 === d.options.waitForAnimate || !0 === d.options.fade && d.currentSlide === e))
                if (!1 === t && d.asNavFor(e), o = e, l = d.getLeft(o), r = d.getLeft(d.currentSlide), d.currentLeft = null === d.swipeLeft ? r : d.swipeLeft, !1 === d.options.infinite && !1 === d.options.centerMode && (e < 0 || e > d.getDotCount() * d.options.slidesToScroll)) !1 === d.options.fade && (o = d.currentSlide, !0 !== i ? d.animateSlide(r, function() {
                    d.postSlide(o)
                }) : d.postSlide(o));
                else if (!1 === d.options.infinite && !0 === d.options.centerMode && (e < 0 || e > d.slideCount - d.options.slidesToScroll)) !1 === d.options.fade && (o = d.currentSlide, !0 !== i ? d.animateSlide(r, function() {
                d.postSlide(o)
            }) : d.postSlide(o));
            else {
                if (d.options.autoplay && clearInterval(d.autoPlayTimer), n = o < 0 ? d.slideCount % d.options.slidesToScroll != 0 ? d.slideCount - d.slideCount % d.options.slidesToScroll : d.slideCount + o : o >= d.slideCount ? d.slideCount % d.options.slidesToScroll != 0 ? 0 : o - d.slideCount : o, d.animating = !0, d.$slider.trigger("beforeChange", [d, d.currentSlide, n]), s = d.currentSlide, d.currentSlide = n, d.setSlideClasses(d.currentSlide), d.options.asNavFor && (a = (a = d.getNavTarget()).slick("getSlick")).slideCount <= a.options.slidesToShow && a.setSlideClasses(d.currentSlide), d.updateDots(), d.updateArrows(), !0 === d.options.fade) return !0 !== i ? (d.fadeSlideOut(s), d.fadeSlide(n, function() {
                    d.postSlide(n)
                })) : d.postSlide(n), void d.animateHeight();
                !0 !== i ? d.animateSlide(l, function() {
                    d.postSlide(n)
                }) : d.postSlide(n)
            }
        }, t.prototype.startLoad = function() {
            var e = this;
            !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && (e.$prevArrow.hide(), e.$nextArrow.hide()), !0 === e.options.dots && e.slideCount > e.options.slidesToShow && e.$dots.hide(), e.$slider.addClass("slick-loading")
        }, t.prototype.swipeDirection = function() {
            var e, t, i, o, n = this;
            return e = n.touchObject.startX - n.touchObject.curX, t = n.touchObject.startY - n.touchObject.curY, i = Math.atan2(t, e), (o = Math.round(180 * i / Math.PI)) < 0 && (o = 360 - Math.abs(o)), o <= 45 && o >= 0 ? !1 === n.options.rtl ? "left" : "right" : o <= 360 && o >= 315 ? !1 === n.options.rtl ? "left" : "right" : o >= 135 && o <= 225 ? !1 === n.options.rtl ? "right" : "left" : !0 === n.options.verticalSwiping ? o >= 35 && o <= 135 ? "down" : "up" : "vertical"
        }, t.prototype.swipeEnd = function(e) {
            var t, i, o = this;
            if (o.dragging = !1, o.swiping = !1, o.scrolling) return o.scrolling = !1, !1;
            if (o.interrupted = !1, o.shouldClick = !(o.touchObject.swipeLength > 10), void 0 === o.touchObject.curX) return !1;
            if (!0 === o.touchObject.edgeHit && o.$slider.trigger("edge", [o, o.swipeDirection()]), o.touchObject.swipeLength >= o.touchObject.minSwipe) {
                switch (i = o.swipeDirection()) {
                    case "left":
                    case "down":
                        t = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide + o.getSlideCount()) : o.currentSlide + o.getSlideCount(), o.currentDirection = 0;
                        break;
                    case "right":
                    case "up":
                        t = o.options.swipeToSlide ? o.checkNavigable(o.currentSlide - o.getSlideCount()) : o.currentSlide - o.getSlideCount(), o.currentDirection = 1
                }
                "vertical" != i && (o.slideHandler(t), o.touchObject = {}, o.$slider.trigger("swipe", [o, i]))
            } else o.touchObject.startX !== o.touchObject.curX && (o.slideHandler(o.currentSlide), o.touchObject = {})
        }, t.prototype.swipeHandler = function(e) {
            var t = this;
            if (!(!1 === t.options.swipe || "ontouchend" in document && !1 === t.options.swipe || !1 === t.options.draggable && -1 !== e.type.indexOf("mouse"))) switch (t.touchObject.fingerCount = e.originalEvent && void 0 !== e.originalEvent.touches ? e.originalEvent.touches.length : 1, t.touchObject.minSwipe = t.listWidth / t.options.touchThreshold, !0 === t.options.verticalSwiping && (t.touchObject.minSwipe = t.listHeight / t.options.touchThreshold), e.data.action) {
                case "start":
                    t.swipeStart(e);
                    break;
                case "move":
                    t.swipeMove(e);
                    break;
                case "end":
                    t.swipeEnd(e)
            }
        }, t.prototype.swipeMove = function(e) {
            var t, i, o, n, s, r, a = this;
            return s = void 0 !== e.originalEvent ? e.originalEvent.touches : null, !(!a.dragging || a.scrolling || s && 1 !== s.length) && (t = a.getLeft(a.currentSlide), a.touchObject.curX = void 0 !== s ? s[0].pageX : e.clientX, a.touchObject.curY = void 0 !== s ? s[0].pageY : e.clientY, a.touchObject.swipeLength = Math.round(Math.sqrt(Math.pow(a.touchObject.curX - a.touchObject.startX, 2))), r = Math.round(Math.sqrt(Math.pow(a.touchObject.curY - a.touchObject.startY, 2))), !a.options.verticalSwiping && !a.swiping && r > 4 ? (a.scrolling = !0, !1) : (!0 === a.options.verticalSwiping && (a.touchObject.swipeLength = r), i = a.swipeDirection(), void 0 !== e.originalEvent && a.touchObject.swipeLength > 4 && (a.swiping = !0, e.preventDefault()), n = (!1 === a.options.rtl ? 1 : -1) * (a.touchObject.curX > a.touchObject.startX ? 1 : -1), !0 === a.options.verticalSwiping && (n = a.touchObject.curY > a.touchObject.startY ? 1 : -1), o = a.touchObject.swipeLength, a.touchObject.edgeHit = !1, !1 === a.options.infinite && (0 === a.currentSlide && "right" === i || a.currentSlide >= a.getDotCount() && "left" === i) && (o = a.touchObject.swipeLength * a.options.edgeFriction, a.touchObject.edgeHit = !0), !1 === a.options.vertical ? a.swipeLeft = t + o * n : a.swipeLeft = t + o * (a.$list.height() / a.listWidth) * n, !0 === a.options.verticalSwiping && (a.swipeLeft = t + o * n), !0 !== a.options.fade && !1 !== a.options.touchMove && (!0 === a.animating ? (a.swipeLeft = null, !1) : void a.setCSS(a.swipeLeft))))
        }, t.prototype.swipeStart = function(e) {
            var t, i = this;
            if (i.interrupted = !0, 1 !== i.touchObject.fingerCount || i.slideCount <= i.options.slidesToShow) return i.touchObject = {}, !1;
            void 0 !== e.originalEvent && void 0 !== e.originalEvent.touches && (t = e.originalEvent.touches[0]), i.touchObject.startX = i.touchObject.curX = void 0 !== t ? t.pageX : e.clientX, i.touchObject.startY = i.touchObject.curY = void 0 !== t ? t.pageY : e.clientY, i.dragging = !0
        }, t.prototype.unfilterSlides = t.prototype.slickUnfilter = function() {
            var e = this;
            null !== e.$slidesCache && (e.unload(), e.$slideTrack.children(this.options.slide).detach(), e.$slidesCache.appendTo(e.$slideTrack), e.reinit())
        }, t.prototype.unload = function() {
            var t = this;
            e(".slick-cloned", t.$slider).remove(), t.$dots && t.$dots.remove(), t.$prevArrow && t.htmlExpr.test(t.options.prevArrow) && t.$prevArrow.remove(), t.$nextArrow && t.htmlExpr.test(t.options.nextArrow) && t.$nextArrow.remove(), t.$slides.removeClass("slick-slide slick-active slick-visible slick-current").attr("aria-hidden", "true").css("width", "")
        }, t.prototype.unslick = function(e) {
            var t = this;
            t.$slider.trigger("unslick", [t, e]), t.destroy()
        }, t.prototype.updateArrows = function() {
            var e = this;
            Math.floor(e.options.slidesToShow / 2), !0 === e.options.arrows && e.slideCount > e.options.slidesToShow && !e.options.infinite && (e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false"), 0 === e.currentSlide ? (e.$prevArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$nextArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - e.options.slidesToShow && !1 === e.options.centerMode ? (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")) : e.currentSlide >= e.slideCount - 1 && !0 === e.options.centerMode && (e.$nextArrow.addClass("slick-disabled").attr("aria-disabled", "true"), e.$prevArrow.removeClass("slick-disabled").attr("aria-disabled", "false")))
        }, t.prototype.updateDots = function() {
            var e = this;
            null !== e.$dots && (e.$dots.find("li").removeClass("slick-active").end(), e.$dots.find("li").eq(Math.floor(e.currentSlide / e.options.slidesToScroll)).addClass("slick-active"))
        }, t.prototype.visibility = function() {
            var e = this;
            e.options.autoplay && (document[e.hidden] ? e.interrupted = !0 : e.interrupted = !1)
        }, e.fn.slick = function() {
            var e, i, o = this,
                n = arguments[0],
                s = Array.prototype.slice.call(arguments, 1),
                r = o.length;
            for (e = 0; e < r; e++)
                if ("object" == typeof n || void 0 === n ? o[e].slick = new t(o[e], n) : i = o[e].slick[n].apply(o[e].slick, s), void 0 !== i) return i;
            return o
        }
    })
}, function(e, t, i) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    }

    function n(e) {
        (0, r.default)("#search_filters").replaceWith(e.rendered_facets), (0, r.default)("#js-active-search-filters").replaceWith(e.rendered_active_filters), (0, r.default)("#js-product-list-top").replaceWith(e.rendered_products_top), (0, r.default)("#js-product-list").replaceWith(e.rendered_products), (0, r.default)("#js-product-list-bottom").replaceWith(e.rendered_products_bottom)
    }
    var s = i(0),
        r = o(s),
        a = i(1),
        l = o(a);
    i(2), (0, r.default)(document).ready(function() {
        l.default.on("clickQuickView", function(t) {
            var i = {
                action: "quickview",
                id_product: t.dataset.idProduct,
                id_product_attribute: t.dataset.idProductAttribute
            };
            r.default.post(l.default.urls.pages.product, i, null, "json").then(function(t) {
                (0, r.default)("body").append(t.quickview_html);
                var i = (0, r.default)("#quickview-modal-" + t.product.id + "-" + t.product.id_product_attribute);
                i.modal("show"), i.on("shown.bs.modal", function() {
                    e(i)
                }), i.on("hidden.bs.modal", function() {
                    i.remove()
                })
            }).fail(function(e) {
                l.default.emit("handleError", {
                    eventType: "clickQuickView",
                    resp: e
                })
            })
        });
        var e = function(e) {
            var t = 4;
            var rtl = false;
	        if ($("body").hasClass("rtl") || $("body").hasClass("lang-rtl")) rtl = true;
            gdzSetting.product_thumbs_show && (t = gdzSetting.product_thumbs_show), (0, r.default)(".js-qv-product-images").slick({
                slidesToShow: t,
                slidesToScroll: 1,
                infinite: !0,
                dots: !1,
                arrows: !0,
                rtl: rtl,
                vertical: !1,
                verticalSwiping: !1,
                focusOnSelect: !0,
                lazyLoad: "ondemand"
            }), e.find(".js-thumb").on("click", function(e) {
                (0, r.default)(".js-modal-product-cover").attr("src", (0, r.default)(e.target).data("image-large-src")), (0, r.default)(".selected").removeClass("selected"), (0, r.default)(e.target).addClass("selected"), (0, r.default)(".js-qv-product-cover").prop("src", (0, r.default)(e.currentTarget).data("image-large-src")), (0, r.default)(".zoomContainer").remove(), (0, r.default)(".product-image-zoom").removeData("elevateZoom"), (0, r.default)(".product-image-zoom").data("zoom-image", (0, r.default)(e.currentTarget).data("image-large-src")), (0, r.default)(".product-image-zoom").elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                })
            }), e.find(".product-image-zoom").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            }), e.find("#quantity_wanted").TouchSpin({
                verticalbuttons: !0,
                verticalupclass: "fa fa-angle-up touchspin-up",
                verticaldownclass: "fa fa-angle-down touchspin-down",
                buttondown_class: "btn btn-touchspin js-touchspin",
                buttonup_class: "btn btn-touchspin js-touchspin",
                min: 1,
                max: 1e6
            })
        };
        (0, r.default)("body").on("click", "#search_filter_toggler", function() {
            (0, r.default)("#search_filters_wrapper").removeClass("hidden-sm-down"), (0, r.default)("#content-wrapper").addClass("hidden-sm-down"), (0, r.default)("#footer").addClass("hidden-sm-down")
        }), (0, r.default)("#search_filter_controls .clear").on("click", function() {
            (0, r.default)("#search_filters_wrapper").addClass("hidden-sm-down"), (0, r.default)("#content-wrapper").removeClass("hidden-sm-down"), (0, r.default)("#footer").removeClass("hidden-sm-down")
        }), (0, r.default)("#search_filter_controls .ok").on("click", function() {
            (0, r.default)("#search_filters_wrapper").addClass("hidden-sm-down"), (0, r.default)("#content-wrapper").removeClass("hidden-sm-down"), (0, r.default)("#footer").removeClass("hidden-sm-down")
        }), (0, r.default)("body").on("change", "#search_filters input[data-search-url]", function(e) {
            l.default.emit("updateFacets", e.target.dataset.searchUrl)
        }), (0, r.default)("body").on("click", ".js-search-filters-clear-all", function(e) {
            l.default.emit("updateFacets", e.target.dataset.searchUrl)
        }), (0, r.default)("body").on("click", ".js-search-link", function(e) {
            e.preventDefault(), l.default.emit("updateFacets", (0, r.default)(e.target).closest("a").get(0).href)
        }), (0, r.default)("body").on("change", "#search_filters select", function(e) {
            var t = (0, r.default)(e.target).closest("form");
            l.default.emit("updateFacets", "?" + t.serialize())
        }), l.default.on("updateProductList", function(e) {
            n(e)
        })
    })
}, function(e, t, i) {
    "use strict";
    jQuery(function(e) {
        function t() {
            s.click(function(e) {
                i(), e.stopPropagation()
            }), r && r.click(function() {
                i()
            }), n.click(function(e) {
                var t = e.target;
                a && t !== s && i()
            })
        }

        function i() {
            a ? o.removeClass("show-menu") : o.addClass("show-menu"), a = !a
        }
        var o = e("body"),
            n = e(".bg-overlay"),
            s = e("#mobile-menu-toggle"),
            r = e("#mobile-menu-close"),
            a = !1;
        ! function() {
            t()
        }()
    }), jQuery(function(e) {
        e("#off-canvas-menu .mega .caret").click(function(t) {
            t.preventDefault();
            var i = e(this).parent(),
                o = i.next(".dropdown-menu"),
                n = i.parent();
            n.hasClass("open") ? (n.removeClass("open"), o.slideUp("normal"), e(this).removeClass("rotate")) : (n.addClass("open"), o.slideDown("normal"), e(this).addClass("rotate"))
        }), e(".mega .caret").mouseover(function(e) {
            return e.preventDefault(), !1
        }), e("#off-canvas-menu li a").mouseover(function(e) {
            return e.preventDefault(), !1
        })
    })
}, function(e, t, i) {
    "use strict";
    var o = i(0),
        n = function(e) {
            return e && e.__esModule ? e : {
                default: e
            }
        }(o);
    (0, n.default)(document).ready(function() {
        function e() {
            (0, n.default)(".js-thumb").on("click", function(e) {
                (0, n.default)(".js-modal-product-cover").attr("src", (0, n.default)(e.target).data("image-large-src")), (0, n.default)(".selected").removeClass("selected"), (0, n.default)(e.target).addClass("selected"), (0, n.default)(".js-qv-product-cover").prop("src", (0, n.default)(e.currentTarget).data("image-large-src")), (0, n.default)(".zoomContainer").remove(), (0, n.default)(".product-image-zoom").removeData("elevateZoom"), (0, n.default)(".product-image-zoom").data("zoom-image", (0, n.default)(e.currentTarget).data("image-large-src")), (0, n.default)(".product-image-zoom").elevateZoom({
                    zoomType: "inner",
                    cursor: "crosshair",
                    zoomWindowFadeIn: 500,
                    zoomWindowFadeOut: 750
                })
            }), (0, n.default)(".product-image-zoom").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            })
        }

        function t() {
            var e = !1,
                t = 4,
                i = "ondemand",
                o = [],
                s = gdzSetting.product_content_layout;
            (0, n.default)(".product-detail .images-container").hasClass("thumbs-left") ? s = "thumbs-left" : (0, n.default)(".product-detail .images-container").hasClass("thumbs-right") ? s = "thumbs-right" : (0, n.default)(".product-detail .images-container").hasClass("thumbs-bottom") ? s = "thumbs-bottom" : (0, n.default)(".product-detail .images-container").hasClass("thumbs-gallery") ? s = "thumbs-gallery" : (0, n.default)(".product-detail .images-container").hasClass("3-columns") && (s = "3-columns"), gdzSetting.product_thumbs_show && (t = gdzSetting.product_thumbs_show), "thumbs-left" != s && "thumbs-right" != s || (e = !0, i = "progressive"), "thumbs-left" == s || "thumbs-right" == s ? o = [{
                breakpoint: 769,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 4,
                    vertical: e,
                    verticalSwiping: e
                }
            }] : "thumbs-bottom" == s && (o = [{
                breakpoint: 769,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1,
                    vertical: e,
                    verticalSwiping: e
                }
            }]), "thumbs-left" != s && "thumbs-right" != s && "thumbs-bottom" != s || (0, n.default)(".product-detail .js-qv-product-images").slick({
                slidesToShow: t,
                slidesToScroll: 1,
                infinite: !0,
                dots: !1,
                arrows: !0,
                vertical: e,
                verticalSwiping: e,
                focusOnSelect: !0,
                lazyLoad: i,
                responsive: o
            })
        }

        function i() {
            (0, n.default)(".js-file-input").on("change", function(e) {
                (0, n.default)(".js-file-name").text((0, n.default)(e.currentTarget).val())
            })
        }! function() {
            var e = (0, n.default)("#quantity_wanted");
            e.TouchSpin({
                verticalbuttons: !0,
                verticalupclass: "fa fa-angle-up touchspin-up",
                verticaldownclass: "fa fa-angle-down touchspin-down",
                buttondown_class: "btn btn-touchspin js-touchspin",
                buttonup_class: "btn btn-touchspin js-touchspin",
                min: parseInt(e.attr("min"), 10),
                max: 1e6
            }), e.on("change", function(e) {
                var t = (0, n.default)(".product-refresh");
                return (0, n.default)(e.currentTarget).trigger("touchspin.stopspin"), t.trigger("click", {
                    eventType: "updatedProductQuantity"
                }), e.preventDefault(), !1
            })
        }(), i(), e(), t(), prestashop.on("updatedProduct", function(o) {
            if (i(), e(), o && o.product_minimal_quantity) {
                var s = parseInt(o.product_minimal_quantity, 10);
                (0, n.default)("#quantity_wanted").trigger("touchspin.updatesettings", {
                    min: s
                })
            }
            t(), (0, n.default)((0, n.default)(".tabs .nav-link.active").attr("href")).addClass("active").removeClass("fade"), (0, n.default)(".js-product-images-modal").replaceWith(o.product_images_modal)
        })
    })
}, function(e, t, i) {
    "use strict";

    function o(e) {
        return e && e.__esModule ? e : {
            default: e
        }
    }

    function n(e, t) {
        var i = t.children().detach();
        t.empty().append(e.children().detach()), e.append(i)
    }

    function s() {
        d.default.responsive.mobile ? (0, a.default)("*[id^='_desktop_']").each(function(e, t) {
            var i = (0, a.default)("#" + t.id.replace("_desktop_", "_mobile_"));
            i && n((0, a.default)(t), i)
        }) : (0, a.default)("*[id^='_mobile_']").each(function(e, t) {
            var i = (0, a.default)("#" + t.id.replace("_mobile_", "_desktop_"));
            i && n((0, a.default)(t), i)
        }), d.default.emit("responsive update", {
            mobile: d.default.responsive.mobile
        })
    }
    var r = i(0),
        a = o(r),
        l = i(1),
        d = o(l);
    d.default.responsive = d.default.responsive || {}, d.default.responsive.current_width = (0, a.default)(window).width(), d.default.responsive.min_width = 768, d.default.responsive.mobile = d.default.responsive.current_width < d.default.responsive.min_width, (0, a.default)(window).on("resize", function() {
        var e = d.default.responsive.current_width,
            t = d.default.responsive.min_width,
            i = (0, a.default)(window).width(),
            o = e >= t && i < t || e < t && i >= t;
        d.default.responsive.mobile = e >= t, d.default.responsive.current_width = i, o && s()
    }), (0, a.default)(document).ready(function() {
        d.default.responsive.mobile && s()
    })
}, function(e, t, i) {
    "use strict";
    ! function(e) {
        function t(e, t) {
            return e + ".touchspin_" + t
        }

        function i(i, o) {
            return e.map(i, function(e) {
                return t(e, o)
            })
        }
        var o = 0;
        e.fn.TouchSpin = function(t) {
            if ("destroy" === t) return void this.each(function() {
                var t = e(this),
                    o = t.data();
                e(document).off(i(["mouseup", "touchend", "touchcancel", "mousemove", "touchmove", "scroll", "scrollstart"], o.spinnerid).join(" "))
            });
            var n = {
                    min: 0,
                    max: 100,
                    initval: "",
                    replacementval: "",
                    step: 1,
                    decimals: 0,
                    stepinterval: 100,
                    forcestepdivisibility: "round",
                    stepintervaldelay: 500,
                    verticalbuttons: !1,
                    verticalupclass: "glyphicon glyphicon-chevron-up",
                    verticaldownclass: "glyphicon glyphicon-chevron-down",
                    prefix: "",
                    postfix: "",
                    prefix_extraclass: "",
                    postfix_extraclass: "",
                    booster: !0,
                    boostat: 10,
                    maxboostedstep: !1,
                    mousewheel: !0,
                    buttondown_class: "btn btn-default",
                    buttonup_class: "btn btn-default",
                    buttondown_txt: "-",
                    buttonup_txt: "+"
                },
                s = {
                    min: "min",
                    max: "max",
                    initval: "init-val",
                    replacementval: "replacement-val",
                    step: "step",
                    decimals: "decimals",
                    stepinterval: "step-interval",
                    verticalbuttons: "vertical-buttons",
                    verticalupclass: "vertical-up-class",
                    verticaldownclass: "vertical-down-class",
                    forcestepdivisibility: "force-step-divisibility",
                    stepintervaldelay: "step-interval-delay",
                    prefix: "prefix",
                    postfix: "postfix",
                    prefix_extraclass: "prefix-extra-class",
                    postfix_extraclass: "postfix-extra-class",
                    booster: "booster",
                    boostat: "boostat",
                    maxboostedstep: "max-boosted-step",
                    mousewheel: "mouse-wheel",
                    buttondown_class: "button-down-class",
                    buttonup_class: "button-up-class",
                    buttondown_txt: "button-down-txt",
                    buttonup_txt: "button-up-txt"
                };
            return this.each(function() {
                function r() {
                    "" !== z.initval && "" === $.val() && $.val(z.initval)
                }

                function a(e) {
                    c(e), w();
                    var t = E.input.val();
                    "" !== t && (t = Number(E.input.val()), E.input.val(t.toFixed(z.decimals)))
                }

                function l() {
                    z = e.extend({}, n, I, d(), t)
                }

                function d() {
                    var t = {};
                    return e.each(s, function(e, i) {
                        var o = "bts-" + i;
                        $.is("[data-" + o + "]") && (t[e] = $.data(o))
                    }), t
                }

                function c(t) {
                    z = e.extend({}, z, t)
                }

                function u() {
                    var e = $.val(),
                        t = $.parent();
                    "" !== e && (e = Number(e).toFixed(z.decimals)), $.data("initvalue", e).val(e), $.addClass("form-control"), t.hasClass("input-group") ? f(t) : p()
                }

                function f(t) {
                    t.addClass("bootstrap-touchspin");
                    var i, o, n = $.prev(),
                        s = $.next(),
                        r = '<span class="input-group-addon bootstrap-touchspin-prefix">' + z.prefix + "</span>",
                        a = '<span class="input-group-addon bootstrap-touchspin-postfix">' + z.postfix + "</span>";
                    n.hasClass("input-group-btn") ? (i = '<button class="' + z.buttondown_class + ' bootstrap-touchspin-down" type="button">' + z.buttondown_txt + "</button>", n.append(i)) : (i = '<span class="input-group-btn"><button class="' + z.buttondown_class + ' bootstrap-touchspin-down" type="button">' + z.buttondown_txt + "</button></span>", e(i).insertBefore($)), s.hasClass("input-group-btn") ? (o = '<button class="' + z.buttonup_class + ' bootstrap-touchspin-up" type="button">' + z.buttonup_txt + "</button>", s.prepend(o)) : (o = '<span class="input-group-btn"><button class="' + z.buttonup_class + ' bootstrap-touchspin-up" type="button">' + z.buttonup_txt + "</button></span>", e(o).insertAfter($)), e(r).insertBefore($), e(a).insertAfter($), C = t
                }

                function p() {
                    var t;
                    t = z.verticalbuttons ? '<div class="input-group bootstrap-touchspin"><span class="input-group-addon bootstrap-touchspin-prefix">' + z.prefix + '</span><span class="input-group-addon bootstrap-touchspin-postfix">' + z.postfix + '</span><span class="input-group-btn-vertical"><button class="' + z.buttondown_class + ' bootstrap-touchspin-up" type="button"><i class="' + z.verticalupclass + '"></i></button><button class="' + z.buttonup_class + ' bootstrap-touchspin-down" type="button"><i class="' + z.verticaldownclass + '"></i></button></span></div>' : '<div class="input-group bootstrap-touchspin"><span class="input-group-btn"><button class="' + z.buttondown_class + ' bootstrap-touchspin-down" type="button">' + z.buttondown_txt + '</button></span><span class="input-group-addon bootstrap-touchspin-prefix">' + z.prefix + '</span><span class="input-group-addon bootstrap-touchspin-postfix">' + z.postfix + '</span><span class="input-group-btn"><button class="' + z.buttonup_class + ' bootstrap-touchspin-up" type="button">' + z.buttonup_txt + "</button></span></div>", C = e(t).insertBefore($), e(".bootstrap-touchspin-prefix", C).after($), $.hasClass("input-sm") ? C.addClass("input-group-sm") : $.hasClass("input-lg") && C.addClass("input-group-lg")
                }

                function h() {
                    E = {
                        down: e(".bootstrap-touchspin-down", C),
                        up: e(".bootstrap-touchspin-up", C),
                        input: e("input", C),
                        prefix: e(".bootstrap-touchspin-prefix", C).addClass(z.prefix_extraclass),
                        postfix: e(".bootstrap-touchspin-postfix", C).addClass(z.postfix_extraclass)
                    }
                }

                function m() {
                    "" === z.prefix && E.prefix.hide(), "" === z.postfix && E.postfix.hide()
                }

                function g() {
                    $.on("keydown", function(e) {
                        var t = e.keyCode || e.which;
                        38 === t ? ("up" !== N && (S(), _()), e.preventDefault()) : 40 === t && ("down" !== N && (x(), T()), e.preventDefault())
                    }), $.on("keyup", function(e) {
                        var t = e.keyCode || e.which;
                        38 === t ? k() : 40 === t && k()
                    }), $.on("blur", function() {
                        w()
                    }), E.down.on("keydown", function(e) {
                        var t = e.keyCode || e.which;
                        32 !== t && 13 !== t || ("down" !== N && (x(), T()), e.preventDefault())
                    }), E.down.on("keyup", function(e) {
                        var t = e.keyCode || e.which;
                        32 !== t && 13 !== t || k()
                    }), E.up.on("keydown", function(e) {
                        var t = e.keyCode || e.which;
                        32 !== t && 13 !== t || ("up" !== N && (S(), _()), e.preventDefault())
                    }), E.up.on("keyup", function(e) {
                        var t = e.keyCode || e.which;
                        32 !== t && 13 !== t || k()
                    }), E.down.on("mousedown.touchspin", function(e) {
                        E.down.off("touchstart.touchspin"), $.is(":disabled") || (x(), T(), e.preventDefault(), e.stopPropagation())
                    }), E.down.on("touchstart.touchspin", function(e) {
                        E.down.off("mousedown.touchspin"), $.is(":disabled") || (x(), T(), e.preventDefault(), e.stopPropagation())
                    }), E.up.on("mousedown.touchspin", function(e) {
                        E.up.off("touchstart.touchspin"), $.is(":disabled") || (S(), _(), e.preventDefault(), e.stopPropagation())
                    }), E.up.on("touchstart.touchspin", function(e) {
                        E.up.off("mousedown.touchspin"), $.is(":disabled") || (S(), _(), e.preventDefault(), e.stopPropagation())
                    }), E.up.on("mouseout touchleave touchend touchcancel", function(e) {
                        N && (e.stopPropagation(), k())
                    }), E.down.on("mouseout touchleave touchend touchcancel", function(e) {
                        N && (e.stopPropagation(), k())
                    }), E.down.on("mousemove touchmove", function(e) {
                        N && (e.stopPropagation(), e.preventDefault())
                    }), E.up.on("mousemove touchmove", function(e) {
                        N && (e.stopPropagation(), e.preventDefault())
                    }), e(document).on(i(["mouseup", "touchend", "touchcancel"], o).join(" "), function(e) {
                        N && (e.preventDefault(), k())
                    }), e(document).on(i(["mousemove", "touchmove", "scroll", "scrollstart"], o).join(" "), function(e) {
                        N && (e.preventDefault(), k())
                    }), $.on("mousewheel DOMMouseScroll", function(e) {
                        if (z.mousewheel && $.is(":focus")) {
                            var t = e.originalEvent.wheelDelta || -e.originalEvent.deltaY || -e.originalEvent.detail;
                            e.stopPropagation(), e.preventDefault(), t < 0 ? x() : S()
                        }
                    })
                }

                function v() {
                    $.on("touchspin.uponce", function() {
                        k(), S()
                    }), $.on("touchspin.downonce", function() {
                        k(), x()
                    }), $.on("touchspin.startupspin", function() {
                        _()
                    }), $.on("touchspin.startdownspin", function() {
                        T()
                    }), $.on("touchspin.stopspin", function() {
                        k()
                    }), $.on("touchspin.updatesettings", function(e, t) {
                        a(t)
                    })
                }

                function y(e) {
                    switch (z.forcestepdivisibility) {
                        case "round":
                            return (Math.round(e / z.step) * z.step).toFixed(z.decimals);
                        case "floor":
                            return (Math.floor(e / z.step) * z.step).toFixed(z.decimals);
                        case "ceil":
                            return (Math.ceil(e / z.step) * z.step).toFixed(z.decimals);
                        default:
                            return e
                    }
                }

                function w() {
                    var e, t, i;
                    if ("" === (e = $.val())) return void("" !== z.replacementval && ($.val(z.replacementval), $.trigger("change")));
                    z.decimals > 0 && "." === e || (t = parseFloat(e), isNaN(t) && (t = "" !== z.replacementval ? z.replacementval : 0), i = t, t.toString() !== e && (i = t), t < z.min && (i = z.min), t > z.max && (i = z.max), i = y(i), Number(e).toString() !== i.toString() && ($.val(i), $.trigger("change")))
                }

                function b() {
                    if (z.booster) {
                        var e = Math.pow(2, Math.floor(H / z.boostat)) * z.step;
                        return z.maxboostedstep && e > z.maxboostedstep && (e = z.maxboostedstep, O = Math.round(O / e) * e), Math.max(z.step, e)
                    }
                    return z.step
                }

                function S() {
                    w(), O = parseFloat(E.input.val()), isNaN(O) && (O = 0);
                    var e = O,
                        t = b();
                    O += t, O > z.max && (O = z.max, $.trigger("touchspin.on.max"), k()), E.input.val(Number(O).toFixed(z.decimals)), e !== O && $.trigger("change")
                }

                function x() {
                    w(), O = parseFloat(E.input.val()), isNaN(O) && (O = 0);
                    var e = O,
                        t = b();
                    O -= t, O < z.min && (O = z.min, $.trigger("touchspin.on.min"), k()), E.input.val(O.toFixed(z.decimals)), e !== O && $.trigger("change")
                }

                function T() {
                    k(), H = 0, N = "down", $.trigger("touchspin.on.startspin"), $.trigger("touchspin.on.startdownspin"), W = setTimeout(function() {
                        A = setInterval(function() {
                            H++, x()
                        }, z.stepinterval)
                    }, z.stepintervaldelay)
                }

                function _() {
                    k(), H = 0, N = "up", $.trigger("touchspin.on.startspin"), $.trigger("touchspin.on.startupspin"), P = setTimeout(function() {
                        L = setInterval(function() {
                            H++, S()
                        }, z.stepinterval)
                    }, z.stepintervaldelay)
                }

                function k() {
                    switch (clearTimeout(W), clearTimeout(P), clearInterval(A), clearInterval(L), N) {
                        case "up":
                            $.trigger("touchspin.on.stopupspin"), $.trigger("touchspin.on.stopspin");
                            break;
                        case "down":
                            $.trigger("touchspin.on.stopdownspin"), $.trigger("touchspin.on.stopspin")
                    }
                    H = 0, N = !1
                }
                var z, C, E, O, A, L, W, P, $ = e(this),
                    I = $.data(),
                    H = 0,
                    N = !1;
                ! function() {
                    $.data("alreadyinitialized") || ($.data("alreadyinitialized", !0), o += 1, $.data("spinnerid", o), $.is("input") && (l(), r(), w(), u(), h(), m(), g(), v(), E.input.css("display", "block")))
                }()
            })
        }
    }(jQuery)
}, function(e, t, i) {
    "use strict";
    ! function(e, o) {
        o(t, i(0), i(22))
    }(0, function(e, t, i) {
        function o(e) {
            return e && "object" == typeof e && "default" in e ? e : {
                default: e
            }
        }

        function n(e, t) {
            for (var i = 0; i < t.length; i++) {
                var o = t[i];
                o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
            }
        }

        function s(e, t, i) {
            return t && n(e.prototype, t), i && n(e, i), e
        }

        function r() {
            return (r = Object.assign || function(e) {
                for (var t = 1; t < arguments.length; t++) {
                    var i = arguments[t];
                    for (var o in i) Object.prototype.hasOwnProperty.call(i, o) && (e[o] = i[o])
                }
                return e
            }).apply(this, arguments)
        }

        function a(e) {
            var t = this,
                i = !1;
            return d.default(this).one(u.TRANSITION_END, function() {
                i = !0
            }), setTimeout(function() {
                i || u.triggerTransitionEnd(t)
            }, e), this
        }

        function l(e, t, i) {
            if (0 === e.length) return e;
            if (i && "function" == typeof i) return i(e);
            for (var o = (new window.DOMParser).parseFromString(e, "text/html"), n = Object.keys(t), s = [].slice.call(o.body.querySelectorAll("*")), r = 0, a = s.length; r < a; r++) ! function(e, i) {
                var o = s[e],
                    r = o.nodeName.toLowerCase();
                if (-1 === n.indexOf(o.nodeName.toLowerCase())) return o.parentNode.removeChild(o), "continue";
                var a = [].slice.call(o.attributes),
                    l = [].concat(t["*"] || [], t[r] || []);
                a.forEach(function(e) {
                    (function(e, t) {
                        var i = e.nodeName.toLowerCase();
                        if (-1 !== t.indexOf(i)) return -1 === j.indexOf(i) || Boolean(e.nodeValue.match(F) || e.nodeValue.match(B));
                        for (var o = t.filter(function(e) {
                                return e instanceof RegExp
                            }), n = 0, s = o.length; n < s; n++)
                            if (i.match(o[n])) return !0;
                        return !1
                    })(e, l) || o.removeAttribute(e.nodeName)
                })
            }(r);
            return o.body.innerHTML
        }
        var d = o(t),
            c = o(i),
            u = {
                TRANSITION_END: "bsTransitionEnd",
                getUID: function(e) {
                    do {
                        e += ~~(1e6 * Math.random())
                    } while (document.getElementById(e));
                    return e
                },
                getSelectorFromElement: function(e) {
                    var t = e.getAttribute("data-target");
                    if (!t || "#" === t) {
                        var i = e.getAttribute("href");
                        t = i && "#" !== i ? i.trim() : ""
                    }
                    try {
                        return document.querySelector(t) ? t : null
                    } catch (e) {
                        return null
                    }
                },
                getTransitionDurationFromElement: function(e) {
                    if (!e) return 0;
                    var t = d.default(e).css("transition-duration"),
                        i = d.default(e).css("transition-delay"),
                        o = parseFloat(t),
                        n = parseFloat(i);
                    return o || n ? (t = t.split(",")[0], i = i.split(",")[0], 1e3 * (parseFloat(t) + parseFloat(i))) : 0
                },
                reflow: function(e) {
                    return e.offsetHeight
                },
                triggerTransitionEnd: function(e) {
                    d.default(e).trigger("transitionend")
                },
                supportsTransitionEnd: function() {
                    return Boolean("transitionend")
                },
                isElement: function(e) {
                    return (e[0] || e).nodeType
                },
                typeCheckConfig: function(e, t, i) {
                    for (var o in i)
                        if (Object.prototype.hasOwnProperty.call(i, o)) {
                            var n = i[o],
                                s = t[o],
                                r = s && u.isElement(s) ? "element" : null === (a = s) || void 0 === a ? "" + a : {}.toString.call(a).match(/\s([a-z]+)/i)[1].toLowerCase();
                            if (!new RegExp(n).test(r)) throw new Error(e.toUpperCase() + ': Option "' + o + '" provided type "' + r + '" but expected type "' + n + '".')
                        } var a
                },
                findShadowRoot: function(e) {
                    if (!document.documentElement.attachShadow) return null;
                    if ("function" == typeof e.getRootNode) {
                        var t = e.getRootNode();
                        return t instanceof ShadowRoot ? t : null
                    }
                    return e instanceof ShadowRoot ? e : e.parentNode ? u.findShadowRoot(e.parentNode) : null
                },
                jQueryDetection: function() {
                    if (void 0 === d.default) throw new TypeError("Bootstrap's JavaScript requires jQuery. jQuery must be included before Bootstrap's JavaScript.");
                    var e = d.default.fn.jquery.split(" ")[0].split(".");
                    if (e[0] < 2 && e[1] < 9 || 1 === e[0] && 9 === e[1] && e[2] < 1 || e[0] >= 4) throw new Error("Bootstrap's JavaScript requires at least jQuery v1.9.1 but less than v4.0.0")
                }
            };
        u.jQueryDetection(), d.default.fn.emulateTransitionEnd = a, d.default.event.special[u.TRANSITION_END] = {
            bindType: "transitionend",
            delegateType: "transitionend",
            handle: function(e) {
                if (d.default(e.target).is(this)) return e.handleObj.handler.apply(this, arguments)
            }
        };
        var f = "alert",
            p = d.default.fn[f],
            h = function() {
                function e(e) {
                    this._element = e
                }
                var t = e.prototype;
                return t.close = function(e) {
                    var t = this._element;
                    e && (t = this._getRootElement(e)), this._triggerCloseEvent(t).isDefaultPrevented() || this._removeElement(t)
                }, t.dispose = function() {
                    d.default.removeData(this._element, "bs.alert"), this._element = null
                }, t._getRootElement = function(e) {
                    var t = u.getSelectorFromElement(e),
                        i = !1;
                    return t && (i = document.querySelector(t)), i || (i = d.default(e).closest(".alert")[0]), i
                }, t._triggerCloseEvent = function(e) {
                    var t = d.default.Event("close.bs.alert");
                    return d.default(e).trigger(t), t
                }, t._removeElement = function(e) {
                    var t = this;
                    if (d.default(e).removeClass("show"), d.default(e).hasClass("fade")) {
                        var i = u.getTransitionDurationFromElement(e);
                        d.default(e).one(u.TRANSITION_END, function(i) {
                            return t._destroyElement(e, i)
                        }).emulateTransitionEnd(i)
                    } else this._destroyElement(e)
                }, t._destroyElement = function(e) {
                    d.default(e).detach().trigger("closed.bs.alert").remove()
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this),
                            o = i.data("bs.alert");
                        o || (o = new e(this), i.data("bs.alert", o)), "close" === t && o[t](this)
                    })
                }, e._handleDismiss = function(e) {
                    return function(t) {
                        t && t.preventDefault(), e.close(this)
                    }
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }]), e
            }();
        d.default(document).on("click.bs.alert.data-api", '[data-dismiss="alert"]', h._handleDismiss(new h)), d.default.fn[f] = h._jQueryInterface, d.default.fn[f].Constructor = h, d.default.fn[f].noConflict = function() {
            return d.default.fn[f] = p, h._jQueryInterface
        };
        var m = d.default.fn.button,
            g = function() {
                function e(e) {
                    this._element = e, this.shouldAvoidTriggerChange = !1
                }
                var t = e.prototype;
                return t.toggle = function() {
                    var e = !0,
                        t = !0,
                        i = d.default(this._element).closest('[data-toggle="buttons"]')[0];
                    if (i) {
                        var o = this._element.querySelector('input:not([type="hidden"])');
                        if (o) {
                            if ("radio" === o.type)
                                if (o.checked && this._element.classList.contains("active")) e = !1;
                                else {
                                    var n = i.querySelector(".active");
                                    n && d.default(n).removeClass("active")
                                } e && ("checkbox" !== o.type && "radio" !== o.type || (o.checked = !this._element.classList.contains("active")), this.shouldAvoidTriggerChange || d.default(o).trigger("change")), o.focus(), t = !1
                        }
                    }
                    this._element.hasAttribute("disabled") || this._element.classList.contains("disabled") || (t && this._element.setAttribute("aria-pressed", !this._element.classList.contains("active")), e && d.default(this._element).toggleClass("active"))
                }, t.dispose = function() {
                    d.default.removeData(this._element, "bs.button"), this._element = null
                }, e._jQueryInterface = function(t, i) {
                    return this.each(function() {
                        var o = d.default(this),
                            n = o.data("bs.button");
                        n || (n = new e(this), o.data("bs.button", n)), n.shouldAvoidTriggerChange = i, "toggle" === t && n[t]()
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }]), e
            }();
        d.default(document).on("click.bs.button.data-api", '[data-toggle^="button"]', function(e) {
            var t = e.target,
                i = t;
            if (d.default(t).hasClass("btn") || (t = d.default(t).closest(".btn")[0]), !t || t.hasAttribute("disabled") || t.classList.contains("disabled")) e.preventDefault();
            else {
                var o = t.querySelector('input:not([type="hidden"])');
                if (o && (o.hasAttribute("disabled") || o.classList.contains("disabled"))) return void e.preventDefault();
                "INPUT" !== i.tagName && "LABEL" === t.tagName || g._jQueryInterface.call(d.default(t), "toggle", "INPUT" === i.tagName)
            }
        }).on("focus.bs.button.data-api blur.bs.button.data-api", '[data-toggle^="button"]', function(e) {
            var t = d.default(e.target).closest(".btn")[0];
            d.default(t).toggleClass("focus", /^focus(in)?$/.test(e.type))
        }), d.default(window).on("load.bs.button.data-api", function() {
            for (var e = [].slice.call(document.querySelectorAll('[data-toggle="buttons"] .btn')), t = 0, i = e.length; t < i; t++) {
                var o = e[t],
                    n = o.querySelector('input:not([type="hidden"])');
                n.checked || n.hasAttribute("checked") ? o.classList.add("active") : o.classList.remove("active")
            }
            for (var s = 0, r = (e = [].slice.call(document.querySelectorAll('[data-toggle="button"]'))).length; s < r; s++) {
                var a = e[s];
                "true" === a.getAttribute("aria-pressed") ? a.classList.add("active") : a.classList.remove("active")
            }
        }), d.default.fn.button = g._jQueryInterface, d.default.fn.button.Constructor = g, d.default.fn.button.noConflict = function() {
            return d.default.fn.button = m, g._jQueryInterface
        };
        var v = "carousel",
            y = d.default.fn[v],
            w = {
                interval: 5e3,
                keyboard: !0,
                slide: !1,
                pause: "hover",
                wrap: !0,
                touch: !0
            },
            b = {
                interval: "(number|boolean)",
                keyboard: "boolean",
                slide: "(boolean|string)",
                pause: "(string|boolean)",
                wrap: "boolean",
                touch: "boolean"
            },
            S = {
                TOUCH: "touch",
                PEN: "pen"
            },
            x = function() {
                function e(e, t) {
                    this._items = null, this._interval = null, this._activeElement = null, this._isPaused = !1, this._isSliding = !1, this.touchTimeout = null, this.touchStartX = 0, this.touchDeltaX = 0, this._config = this._getConfig(t), this._element = e, this._indicatorsElement = this._element.querySelector(".carousel-indicators"), this._touchSupported = "ontouchstart" in document.documentElement || navigator.maxTouchPoints > 0, this._pointerEvent = Boolean(window.PointerEvent || window.MSPointerEvent), this._addEventListeners()
                }
                var t = e.prototype;
                return t.next = function() {
                    this._isSliding || this._slide("next")
                }, t.nextWhenVisible = function() {
                    var e = d.default(this._element);
                    !document.hidden && e.is(":visible") && "hidden" !== e.css("visibility") && this.next()
                }, t.prev = function() {
                    this._isSliding || this._slide("prev")
                }, t.pause = function(e) {
                    e || (this._isPaused = !0), this._element.querySelector(".carousel-item-next, .carousel-item-prev") && (u.triggerTransitionEnd(this._element), this.cycle(!0)), clearInterval(this._interval), this._interval = null
                }, t.cycle = function(e) {
                    e || (this._isPaused = !1), this._interval && (clearInterval(this._interval), this._interval = null), this._config.interval && !this._isPaused && (this._interval = setInterval((document.visibilityState ? this.nextWhenVisible : this.next).bind(this), this._config.interval))
                }, t.to = function(e) {
                    var t = this;
                    this._activeElement = this._element.querySelector(".active.carousel-item");
                    var i = this._getItemIndex(this._activeElement);
                    if (!(e > this._items.length - 1 || e < 0))
                        if (this._isSliding) d.default(this._element).one("slid.bs.carousel", function() {
                            return t.to(e)
                        });
                        else {
                            if (i === e) return this.pause(), void this.cycle();
                            var o = e > i ? "next" : "prev";
                            this._slide(o, this._items[e])
                        }
                }, t.dispose = function() {
                    d.default(this._element).off(".bs.carousel"), d.default.removeData(this._element, "bs.carousel"), this._items = null, this._config = null, this._element = null, this._interval = null, this._isPaused = null, this._isSliding = null, this._activeElement = null, this._indicatorsElement = null
                }, t._getConfig = function(e) {
                    return e = r({}, w, e), u.typeCheckConfig(v, e, b), e
                }, t._handleSwipe = function() {
                    var e = Math.abs(this.touchDeltaX);
                    if (!(e <= 40)) {
                        var t = e / this.touchDeltaX;
                        this.touchDeltaX = 0, t > 0 && this.prev(), t < 0 && this.next()
                    }
                }, t._addEventListeners = function() {
                    var e = this;
                    this._config.keyboard && d.default(this._element).on("keydown.bs.carousel", function(t) {
                        return e._keydown(t)
                    }), "hover" === this._config.pause && d.default(this._element).on("mouseenter.bs.carousel", function(t) {
                        return e.pause(t)
                    }).on("mouseleave.bs.carousel", function(t) {
                        return e.cycle(t)
                    }), this._config.touch && this._addTouchEventListeners()
                }, t._addTouchEventListeners = function() {
                    var e = this;
                    if (this._touchSupported) {
                        var t = function(t) {
                                e._pointerEvent && S[t.originalEvent.pointerType.toUpperCase()] ? e.touchStartX = t.originalEvent.clientX : e._pointerEvent || (e.touchStartX = t.originalEvent.touches[0].clientX)
                            },
                            i = function(t) {
                                e._pointerEvent && S[t.originalEvent.pointerType.toUpperCase()] && (e.touchDeltaX = t.originalEvent.clientX - e.touchStartX), e._handleSwipe(), "hover" === e._config.pause && (e.pause(), e.touchTimeout && clearTimeout(e.touchTimeout), e.touchTimeout = setTimeout(function(t) {
                                    return e.cycle(t)
                                }, 500 + e._config.interval))
                            };
                        d.default(this._element.querySelectorAll(".carousel-item img")).on("dragstart.bs.carousel", function(e) {
                            return e.preventDefault()
                        }), this._pointerEvent ? (d.default(this._element).on("pointerdown.bs.carousel", function(e) {
                            return t(e)
                        }), d.default(this._element).on("pointerup.bs.carousel", function(e) {
                            return i(e)
                        }), this._element.classList.add("pointer-event")) : (d.default(this._element).on("touchstart.bs.carousel", function(e) {
                            return t(e)
                        }), d.default(this._element).on("touchmove.bs.carousel", function(t) {
                            return function(t) {
                                t.originalEvent.touches && t.originalEvent.touches.length > 1 ? e.touchDeltaX = 0 : e.touchDeltaX = t.originalEvent.touches[0].clientX - e.touchStartX
                            }(t)
                        }), d.default(this._element).on("touchend.bs.carousel", function(e) {
                            return i(e)
                        }))
                    }
                }, t._keydown = function(e) {
                    if (!/input|textarea/i.test(e.target.tagName)) switch (e.which) {
                        case 37:
                            e.preventDefault(), this.prev();
                            break;
                        case 39:
                            e.preventDefault(), this.next()
                    }
                }, t._getItemIndex = function(e) {
                    return this._items = e && e.parentNode ? [].slice.call(e.parentNode.querySelectorAll(".carousel-item")) : [], this._items.indexOf(e)
                }, t._getItemByDirection = function(e, t) {
                    var i = "next" === e,
                        o = "prev" === e,
                        n = this._getItemIndex(t),
                        s = this._items.length - 1;
                    if ((o && 0 === n || i && n === s) && !this._config.wrap) return t;
                    var r = (n + ("prev" === e ? -1 : 1)) % this._items.length;
                    return -1 === r ? this._items[this._items.length - 1] : this._items[r]
                }, t._triggerSlideEvent = function(e, t) {
                    var i = this._getItemIndex(e),
                        o = this._getItemIndex(this._element.querySelector(".active.carousel-item")),
                        n = d.default.Event("slide.bs.carousel", {
                            relatedTarget: e,
                            direction: t,
                            from: o,
                            to: i
                        });
                    return d.default(this._element).trigger(n), n
                }, t._setActiveIndicatorElement = function(e) {
                    if (this._indicatorsElement) {
                        var t = [].slice.call(this._indicatorsElement.querySelectorAll(".active"));
                        d.default(t).removeClass("active");
                        var i = this._indicatorsElement.children[this._getItemIndex(e)];
                        i && d.default(i).addClass("active")
                    }
                }, t._slide = function(e, t) {
                    var i, o, n, s = this,
                        r = this._element.querySelector(".active.carousel-item"),
                        a = this._getItemIndex(r),
                        l = t || r && this._getItemByDirection(e, r),
                        c = this._getItemIndex(l),
                        f = Boolean(this._interval);
                    if ("next" === e ? (i = "carousel-item-left", o = "carousel-item-next", n = "left") : (i = "carousel-item-right", o = "carousel-item-prev", n = "right"), l && d.default(l).hasClass("active")) this._isSliding = !1;
                    else if (!this._triggerSlideEvent(l, n).isDefaultPrevented() && r && l) {
                        this._isSliding = !0, f && this.pause(), this._setActiveIndicatorElement(l);
                        var p = d.default.Event("slid.bs.carousel", {
                            relatedTarget: l,
                            direction: n,
                            from: a,
                            to: c
                        });
                        if (d.default(this._element).hasClass("slide")) {
                            d.default(l).addClass(o), u.reflow(l), d.default(r).addClass(i), d.default(l).addClass(i);
                            var h = parseInt(l.getAttribute("data-interval"), 10);
                            h ? (this._config.defaultInterval = this._config.defaultInterval || this._config.interval, this._config.interval = h) : this._config.interval = this._config.defaultInterval || this._config.interval;
                            var m = u.getTransitionDurationFromElement(r);
                            d.default(r).one(u.TRANSITION_END, function() {
                                d.default(l).removeClass(i + " " + o).addClass("active"), d.default(r).removeClass("active " + o + " " + i), s._isSliding = !1, setTimeout(function() {
                                    return d.default(s._element).trigger(p)
                                }, 0)
                            }).emulateTransitionEnd(m)
                        } else d.default(r).removeClass("active"), d.default(l).addClass("active"), this._isSliding = !1, d.default(this._element).trigger(p);
                        f && this.cycle()
                    }
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this).data("bs.carousel"),
                            o = r({}, w, d.default(this).data());
                        "object" == typeof t && (o = r({}, o, t));
                        var n = "string" == typeof t ? t : o.slide;
                        if (i || (i = new e(this, o), d.default(this).data("bs.carousel", i)), "number" == typeof t) i.to(t);
                        else if ("string" == typeof n) {
                            if (void 0 === i[n]) throw new TypeError('No method named "' + n + '"');
                            i[n]()
                        } else o.interval && o.ride && (i.pause(), i.cycle())
                    })
                }, e._dataApiClickHandler = function(t) {
                    var i = u.getSelectorFromElement(this);
                    if (i) {
                        var o = d.default(i)[0];
                        if (o && d.default(o).hasClass("carousel")) {
                            var n = r({}, d.default(o).data(), d.default(this).data()),
                                s = this.getAttribute("data-slide-to");
                            s && (n.interval = !1), e._jQueryInterface.call(d.default(o), n), s && d.default(o).data("bs.carousel").to(s), t.preventDefault()
                        }
                    }
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return w
                    }
                }]), e
            }();
        d.default(document).on("click.bs.carousel.data-api", "[data-slide], [data-slide-to]", x._dataApiClickHandler), d.default(window).on("load.bs.carousel.data-api", function() {
            for (var e = [].slice.call(document.querySelectorAll('[data-ride="carousel"]')), t = 0, i = e.length; t < i; t++) {
                var o = d.default(e[t]);
                x._jQueryInterface.call(o, o.data())
            }
        }), d.default.fn[v] = x._jQueryInterface, d.default.fn[v].Constructor = x, d.default.fn[v].noConflict = function() {
            return d.default.fn[v] = y, x._jQueryInterface
        };
        var T = "collapse",
            _ = d.default.fn[T],
            k = {
                toggle: !0,
                parent: ""
            },
            z = {
                toggle: "boolean",
                parent: "(string|element)"
            },
            C = function() {
                function e(e, t) {
                    this._isTransitioning = !1, this._element = e, this._config = this._getConfig(t), this._triggerArray = [].slice.call(document.querySelectorAll('[data-toggle="collapse"][href="#' + e.id + '"],[data-toggle="collapse"][data-target="#' + e.id + '"]'));
                    for (var i = [].slice.call(document.querySelectorAll('[data-toggle="collapse"]')), o = 0, n = i.length; o < n; o++) {
                        var s = i[o],
                            r = u.getSelectorFromElement(s),
                            a = [].slice.call(document.querySelectorAll(r)).filter(function(t) {
                                return t === e
                            });
                        null !== r && a.length > 0 && (this._selector = r, this._triggerArray.push(s))
                    }
                    this._parent = this._config.parent ? this._getParent() : null, this._config.parent || this._addAriaAndCollapsedClass(this._element, this._triggerArray), this._config.toggle && this.toggle()
                }
                var t = e.prototype;
                return t.toggle = function() {
                    d.default(this._element).hasClass("show") ? this.hide() : this.show()
                }, t.show = function() {
                    var t, i, o = this;
                    if (!(this._isTransitioning || d.default(this._element).hasClass("show") || (this._parent && 0 === (t = [].slice.call(this._parent.querySelectorAll(".show, .collapsing")).filter(function(e) {
                            return "string" == typeof o._config.parent ? e.getAttribute("data-parent") === o._config.parent : e.classList.contains("collapse")
                        })).length && (t = null), t && (i = d.default(t).not(this._selector).data("bs.collapse")) && i._isTransitioning))) {
                        var n = d.default.Event("show.bs.collapse");
                        if (d.default(this._element).trigger(n), !n.isDefaultPrevented()) {
                            t && (e._jQueryInterface.call(d.default(t).not(this._selector), "hide"), i || d.default(t).data("bs.collapse", null));
                            var s = this._getDimension();
                            d.default(this._element).removeClass("collapse").addClass("collapsing"), this._element.style[s] = 0, this._triggerArray.length && d.default(this._triggerArray).removeClass("collapsed").attr("aria-expanded", !0), this.setTransitioning(!0);
                            var r = "scroll" + (s[0].toUpperCase() + s.slice(1)),
                                a = u.getTransitionDurationFromElement(this._element);
                            d.default(this._element).one(u.TRANSITION_END, function() {
                                d.default(o._element).removeClass("collapsing").addClass("collapse show"), o._element.style[s] = "", o.setTransitioning(!1), d.default(o._element).trigger("shown.bs.collapse")
                            }).emulateTransitionEnd(a), this._element.style[s] = this._element[r] + "px"
                        }
                    }
                }, t.hide = function() {
                    var e = this;
                    if (!this._isTransitioning && d.default(this._element).hasClass("show")) {
                        var t = d.default.Event("hide.bs.collapse");
                        if (d.default(this._element).trigger(t), !t.isDefaultPrevented()) {
                            var i = this._getDimension();
                            this._element.style[i] = this._element.getBoundingClientRect()[i] + "px", u.reflow(this._element), d.default(this._element).addClass("collapsing").removeClass("collapse show");
                            var o = this._triggerArray.length;
                            if (o > 0)
                                for (var n = 0; n < o; n++) {
                                    var s = this._triggerArray[n],
                                        r = u.getSelectorFromElement(s);
                                    null !== r && (d.default([].slice.call(document.querySelectorAll(r))).hasClass("show") || d.default(s).addClass("collapsed").attr("aria-expanded", !1))
                                }
                            this.setTransitioning(!0), this._element.style[i] = "";
                            var a = u.getTransitionDurationFromElement(this._element);
                            d.default(this._element).one(u.TRANSITION_END, function() {
                                e.setTransitioning(!1), d.default(e._element).removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")
                            }).emulateTransitionEnd(a)
                        }
                    }
                }, t.setTransitioning = function(e) {
                    this._isTransitioning = e
                }, t.dispose = function() {
                    d.default.removeData(this._element, "bs.collapse"), this._config = null, this._parent = null, this._element = null, this._triggerArray = null, this._isTransitioning = null
                }, t._getConfig = function(e) {
                    return (e = r({}, k, e)).toggle = Boolean(e.toggle), u.typeCheckConfig(T, e, z), e
                }, t._getDimension = function() {
                    return d.default(this._element).hasClass("width") ? "width" : "height"
                }, t._getParent = function() {
                    var t, i = this;
                    u.isElement(this._config.parent) ? (t = this._config.parent, void 0 !== this._config.parent.jquery && (t = this._config.parent[0])) : t = document.querySelector(this._config.parent);
                    var o = '[data-toggle="collapse"][data-parent="' + this._config.parent + '"]',
                        n = [].slice.call(t.querySelectorAll(o));
                    return d.default(n).each(function(t, o) {
                        i._addAriaAndCollapsedClass(e._getTargetFromElement(o), [o])
                    }), t
                }, t._addAriaAndCollapsedClass = function(e, t) {
                    var i = d.default(e).hasClass("show");
                    t.length && d.default(t).toggleClass("collapsed", !i).attr("aria-expanded", i)
                }, e._getTargetFromElement = function(e) {
                    var t = u.getSelectorFromElement(e);
                    return t ? document.querySelector(t) : null
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this),
                            o = i.data("bs.collapse"),
                            n = r({}, k, i.data(), "object" == typeof t && t ? t : {});
                        if (!o && n.toggle && "string" == typeof t && /show|hide/.test(t) && (n.toggle = !1), o || (o = new e(this, n), i.data("bs.collapse", o)), "string" == typeof t) {
                            if (void 0 === o[t]) throw new TypeError('No method named "' + t + '"');
                            o[t]()
                        }
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return k
                    }
                }]), e
            }();
        d.default(document).on("click.bs.collapse.data-api", '[data-toggle="collapse"]', function(e) {
            "A" === e.currentTarget.tagName && e.preventDefault();
            var t = d.default(this),
                i = u.getSelectorFromElement(this),
                o = [].slice.call(document.querySelectorAll(i));
            d.default(o).each(function() {
                var e = d.default(this),
                    i = e.data("bs.collapse") ? "toggle" : t.data();
                C._jQueryInterface.call(e, i)
            })
        }), d.default.fn[T] = C._jQueryInterface, d.default.fn[T].Constructor = C, d.default.fn[T].noConflict = function() {
            return d.default.fn[T] = _, C._jQueryInterface
        };
        var E = "dropdown",
            O = d.default.fn[E],
            A = new RegExp("38|40|27"),
            L = {
                offset: 0,
                flip: !0,
                boundary: "scrollParent",
                reference: "toggle",
                display: "dynamic",
                popperConfig: null
            },
            W = {
                offset: "(number|string|function)",
                flip: "boolean",
                boundary: "(string|element)",
                reference: "(string|element)",
                display: "string",
                popperConfig: "(null|object)"
            },
            P = function() {
                function e(e, t) {
                    this._element = e, this._popper = null, this._config = this._getConfig(t), this._menu = this._getMenuElement(), this._inNavbar = this._detectNavbar(), this._addEventListeners()
                }
                var t = e.prototype;
                return t.toggle = function() {
                    if (!this._element.disabled && !d.default(this._element).hasClass("disabled")) {
                        var t = d.default(this._menu).hasClass("show");
                        e._clearMenus(), t || this.show(!0)
                    }
                }, t.show = function(t) {
                    if (void 0 === t && (t = !1), !(this._element.disabled || d.default(this._element).hasClass("disabled") || d.default(this._menu).hasClass("show"))) {
                        var i = {
                                relatedTarget: this._element
                            },
                            o = d.default.Event("show.bs.dropdown", i),
                            n = e._getParentFromElement(this._element);
                        if (d.default(n).trigger(o), !o.isDefaultPrevented()) {
                            if (!this._inNavbar && t) {
                                if (void 0 === c.default) throw new TypeError("Bootstrap's dropdowns require Popper.js (https://popper.js.org/)");
                                var s = this._element;
                                "parent" === this._config.reference ? s = n : u.isElement(this._config.reference) && (s = this._config.reference, void 0 !== this._config.reference.jquery && (s = this._config.reference[0])), "scrollParent" !== this._config.boundary && d.default(n).addClass("position-static"), this._popper = new c.default(s, this._menu, this._getPopperConfig())
                            }
                            "ontouchstart" in document.documentElement && 0 === d.default(n).closest(".navbar-nav").length && d.default(document.body).children().on("mouseover", null, d.default.noop), this._element.focus(), this._element.setAttribute("aria-expanded", !0), d.default(this._menu).toggleClass("show"), d.default(n).toggleClass("show").trigger(d.default.Event("shown.bs.dropdown", i))
                        }
                    }
                }, t.hide = function() {
                    if (!this._element.disabled && !d.default(this._element).hasClass("disabled") && d.default(this._menu).hasClass("show")) {
                        var t = {
                                relatedTarget: this._element
                            },
                            i = d.default.Event("hide.bs.dropdown", t),
                            o = e._getParentFromElement(this._element);
                        d.default(o).trigger(i), i.isDefaultPrevented() || (this._popper && this._popper.destroy(), d.default(this._menu).toggleClass("show"), d.default(o).toggleClass("show").trigger(d.default.Event("hidden.bs.dropdown", t)))
                    }
                }, t.dispose = function() {
                    d.default.removeData(this._element, "bs.dropdown"), d.default(this._element).off(".bs.dropdown"), this._element = null, this._menu = null, null !== this._popper && (this._popper.destroy(), this._popper = null)
                }, t.update = function() {
                    this._inNavbar = this._detectNavbar(), null !== this._popper && this._popper.scheduleUpdate()
                }, t._addEventListeners = function() {
                    var e = this;
                    d.default(this._element).on("click.bs.dropdown", function(t) {
                        t.preventDefault(), t.stopPropagation(), e.toggle()
                    })
                }, t._getConfig = function(e) {
                    return e = r({}, this.constructor.Default, d.default(this._element).data(), e), u.typeCheckConfig(E, e, this.constructor.DefaultType), e
                }, t._getMenuElement = function() {
                    if (!this._menu) {
                        var t = e._getParentFromElement(this._element);
                        t && (this._menu = t.querySelector(".dropdown-menu"))
                    }
                    return this._menu
                }, t._getPlacement = function() {
                    var e = d.default(this._element.parentNode),
                        t = "bottom-start";
                    return e.hasClass("dropup") ? t = d.default(this._menu).hasClass("dropdown-menu-right") ? "top-end" : "top-start" : e.hasClass("dropright") ? t = "right-start" : e.hasClass("dropleft") ? t = "left-start" : d.default(this._menu).hasClass("dropdown-menu-right") && (t = "bottom-end"), t
                }, t._detectNavbar = function() {
                    return d.default(this._element).closest(".navbar").length > 0
                }, t._getOffset = function() {
                    var e = this,
                        t = {};
                    return "function" == typeof this._config.offset ? t.fn = function(t) {
                        return t.offsets = r({}, t.offsets, e._config.offset(t.offsets, e._element) || {}), t
                    } : t.offset = this._config.offset, t
                }, t._getPopperConfig = function() {
                    var e = {
                        placement: this._getPlacement(),
                        modifiers: {
                            offset: this._getOffset(),
                            flip: {
                                enabled: this._config.flip
                            },
                            preventOverflow: {
                                boundariesElement: this._config.boundary
                            }
                        }
                    };
                    return "static" === this._config.display && (e.modifiers.applyStyle = {
                        enabled: !1
                    }), r({}, e, this._config.popperConfig)
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this).data("bs.dropdown");
                        if (i || (i = new e(this, "object" == typeof t ? t : null), d.default(this).data("bs.dropdown", i)), "string" == typeof t) {
                            if (void 0 === i[t]) throw new TypeError('No method named "' + t + '"');
                            i[t]()
                        }
                    })
                }, e._clearMenus = function(t) {
                    if (!t || 3 !== t.which && ("keyup" !== t.type || 9 === t.which))
                        for (var i = [].slice.call(document.querySelectorAll('[data-toggle="dropdown"]')), o = 0, n = i.length; o < n; o++) {
                            var s = e._getParentFromElement(i[o]),
                                r = d.default(i[o]).data("bs.dropdown"),
                                a = {
                                    relatedTarget: i[o]
                                };
                            if (t && "click" === t.type && (a.clickEvent = t), r) {
                                var l = r._menu;
                                if (d.default(s).hasClass("show") && !(t && ("click" === t.type && /input|textarea/i.test(t.target.tagName) || "keyup" === t.type && 9 === t.which) && d.default.contains(s, t.target))) {
                                    var c = d.default.Event("hide.bs.dropdown", a);
                                    d.default(s).trigger(c), c.isDefaultPrevented() || ("ontouchstart" in document.documentElement && d.default(document.body).children().off("mouseover", null, d.default.noop), i[o].setAttribute("aria-expanded", "false"), r._popper && r._popper.destroy(), d.default(l).removeClass("show"), d.default(s).removeClass("show").trigger(d.default.Event("hidden.bs.dropdown", a)))
                                }
                            }
                        }
                }, e._getParentFromElement = function(e) {
                    var t, i = u.getSelectorFromElement(e);
                    return i && (t = document.querySelector(i)), t || e.parentNode
                }, e._dataApiKeydownHandler = function(t) {
                    if (!(/input|textarea/i.test(t.target.tagName) ? 32 === t.which || 27 !== t.which && (40 !== t.which && 38 !== t.which || d.default(t.target).closest(".dropdown-menu").length) : !A.test(t.which)) && !this.disabled && !d.default(this).hasClass("disabled")) {
                        var i = e._getParentFromElement(this),
                            o = d.default(i).hasClass("show");
                        if (o || 27 !== t.which) {
                            if (t.preventDefault(), t.stopPropagation(), !o || 27 === t.which || 32 === t.which) return 27 === t.which && d.default(i.querySelector('[data-toggle="dropdown"]')).trigger("focus"), void d.default(this).trigger("click");
                            var n = [].slice.call(i.querySelectorAll(".dropdown-menu .dropdown-item:not(.disabled):not(:disabled)")).filter(function(e) {
                                return d.default(e).is(":visible")
                            });
                            if (0 !== n.length) {
                                var s = n.indexOf(t.target);
                                38 === t.which && s > 0 && s--, 40 === t.which && s < n.length - 1 && s++, s < 0 && (s = 0), n[s].focus()
                            }
                        }
                    }
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return L
                    }
                }, {
                    key: "DefaultType",
                    get: function() {
                        return W
                    }
                }]), e
            }();
        d.default(document).on("keydown.bs.dropdown.data-api", '[data-toggle="dropdown"]', P._dataApiKeydownHandler).on("keydown.bs.dropdown.data-api", ".dropdown-menu", P._dataApiKeydownHandler).on("click.bs.dropdown.data-api keyup.bs.dropdown.data-api", P._clearMenus).on("click.bs.dropdown.data-api", '[data-toggle="dropdown"]', function(e) {
            e.preventDefault(), e.stopPropagation(), P._jQueryInterface.call(d.default(this), "toggle")
        }).on("click.bs.dropdown.data-api", ".dropdown form", function(e) {
            e.stopPropagation()
        }), d.default.fn[E] = P._jQueryInterface, d.default.fn[E].Constructor = P, d.default.fn[E].noConflict = function() {
            return d.default.fn[E] = O, P._jQueryInterface
        };
        var $ = d.default.fn.modal,
            I = {
                backdrop: !0,
                keyboard: !0,
                focus: !0,
                show: !0
            },
            H = {
                backdrop: "(boolean|string)",
                keyboard: "boolean",
                focus: "boolean",
                show: "boolean"
            },
            N = function() {
                function e(e, t) {
                    this._config = this._getConfig(t), this._element = e, this._dialog = e.querySelector(".modal-dialog"), this._backdrop = null, this._isShown = !1, this._isBodyOverflowing = !1, this._ignoreBackdropClick = !1, this._isTransitioning = !1, this._scrollbarWidth = 0
                }
                var t = e.prototype;
                return t.toggle = function(e) {
                    return this._isShown ? this.hide() : this.show(e)
                }, t.show = function(e) {
                    var t = this;
                    if (!this._isShown && !this._isTransitioning) {
                        d.default(this._element).hasClass("fade") && (this._isTransitioning = !0);
                        var i = d.default.Event("show.bs.modal", {
                            relatedTarget: e
                        });
                        d.default(this._element).trigger(i), this._isShown || i.isDefaultPrevented() || (this._isShown = !0, this._checkScrollbar(), this._setScrollbar(), this._adjustDialog(), this._setEscapeEvent(), this._setResizeEvent(), d.default(this._element).on("click.dismiss.bs.modal", '[data-dismiss="modal"]', function(e) {
                            return t.hide(e)
                        }), d.default(this._dialog).on("mousedown.dismiss.bs.modal", function() {
                            d.default(t._element).one("mouseup.dismiss.bs.modal", function(e) {
                                d.default(e.target).is(t._element) && (t._ignoreBackdropClick = !0)
                            })
                        }), this._showBackdrop(function() {
                            return t._showElement(e)
                        }))
                    }
                }, t.hide = function(e) {
                    var t = this;
                    if (e && e.preventDefault(), this._isShown && !this._isTransitioning) {
                        var i = d.default.Event("hide.bs.modal");
                        if (d.default(this._element).trigger(i), this._isShown && !i.isDefaultPrevented()) {
                            this._isShown = !1;
                            var o = d.default(this._element).hasClass("fade");
                            if (o && (this._isTransitioning = !0), this._setEscapeEvent(), this._setResizeEvent(), d.default(document).off("focusin.bs.modal"), d.default(this._element).removeClass("show"), d.default(this._element).off("click.dismiss.bs.modal"), d.default(this._dialog).off("mousedown.dismiss.bs.modal"), o) {
                                var n = u.getTransitionDurationFromElement(this._element);
                                d.default(this._element).one(u.TRANSITION_END, function(e) {
                                    return t._hideModal(e)
                                }).emulateTransitionEnd(n)
                            } else this._hideModal()
                        }
                    }
                }, t.dispose = function() {
                    [window, this._element, this._dialog].forEach(function(e) {
                        return d.default(e).off(".bs.modal")
                    }), d.default(document).off("focusin.bs.modal"), d.default.removeData(this._element, "bs.modal"), this._config = null, this._element = null, this._dialog = null, this._backdrop = null, this._isShown = null, this._isBodyOverflowing = null, this._ignoreBackdropClick = null, this._isTransitioning = null, this._scrollbarWidth = null
                }, t.handleUpdate = function() {
                    this._adjustDialog()
                }, t._getConfig = function(e) {
                    return e = r({}, I, e), u.typeCheckConfig("modal", e, H), e
                }, t._triggerBackdropTransition = function() {
                    var e = this;
                    if ("static" === this._config.backdrop) {
                        var t = d.default.Event("hidePrevented.bs.modal");
                        if (d.default(this._element).trigger(t), t.isDefaultPrevented()) return;
                        var i = this._element.scrollHeight > document.documentElement.clientHeight;
                        i || (this._element.style.overflowY = "hidden"), this._element.classList.add("modal-static");
                        var o = u.getTransitionDurationFromElement(this._dialog);
                        d.default(this._element).off(u.TRANSITION_END), d.default(this._element).one(u.TRANSITION_END, function() {
                            e._element.classList.remove("modal-static"), i || d.default(e._element).one(u.TRANSITION_END, function() {
                                e._element.style.overflowY = ""
                            }).emulateTransitionEnd(e._element, o)
                        }).emulateTransitionEnd(o), this._element.focus()
                    } else this.hide()
                }, t._showElement = function(e) {
                    var t = this,
                        i = d.default(this._element).hasClass("fade"),
                        o = this._dialog ? this._dialog.querySelector(".modal-body") : null;
                    this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE || document.body.appendChild(this._element), this._element.style.display = "block", this._element.removeAttribute("aria-hidden"), this._element.setAttribute("aria-modal", !0), this._element.setAttribute("role", "dialog"), d.default(this._dialog).hasClass("modal-dialog-scrollable") && o ? o.scrollTop = 0 : this._element.scrollTop = 0, i && u.reflow(this._element), d.default(this._element).addClass("show"), this._config.focus && this._enforceFocus();
                    var n = d.default.Event("shown.bs.modal", {
                            relatedTarget: e
                        }),
                        s = function() {
                            t._config.focus && t._element.focus(), t._isTransitioning = !1, d.default(t._element).trigger(n)
                        };
                    if (i) {
                        var r = u.getTransitionDurationFromElement(this._dialog);
                        d.default(this._dialog).one(u.TRANSITION_END, s).emulateTransitionEnd(r)
                    } else s()
                }, t._enforceFocus = function() {
                    var e = this;
                    d.default(document).off("focusin.bs.modal").on("focusin.bs.modal", function(t) {
                        document !== t.target && e._element !== t.target && 0 === d.default(e._element).has(t.target).length && e._element.focus()
                    })
                }, t._setEscapeEvent = function() {
                    var e = this;
                    this._isShown ? d.default(this._element).on("keydown.dismiss.bs.modal", function(t) {
                        e._config.keyboard && 27 === t.which ? (t.preventDefault(), e.hide()) : e._config.keyboard || 27 !== t.which || e._triggerBackdropTransition()
                    }) : this._isShown || d.default(this._element).off("keydown.dismiss.bs.modal")
                }, t._setResizeEvent = function() {
                    var e = this;
                    this._isShown ? d.default(window).on("resize.bs.modal", function(t) {
                        return e.handleUpdate(t)
                    }) : d.default(window).off("resize.bs.modal")
                }, t._hideModal = function() {
                    var e = this;
                    this._element.style.display = "none", this._element.setAttribute("aria-hidden", !0), this._element.removeAttribute("aria-modal"), this._element.removeAttribute("role"), this._isTransitioning = !1, this._showBackdrop(function() {
                        d.default(document.body).removeClass("modal-open"), e._resetAdjustments(), e._resetScrollbar(), d.default(e._element).trigger("hidden.bs.modal")
                    })
                }, t._removeBackdrop = function() {
                    this._backdrop && (d.default(this._backdrop).remove(), this._backdrop = null)
                }, t._showBackdrop = function(e) {
                    var t = this,
                        i = d.default(this._element).hasClass("fade") ? "fade" : "";
                    if (this._isShown && this._config.backdrop) {
                        if (this._backdrop = document.createElement("div"), this._backdrop.className = "modal-backdrop", i && this._backdrop.classList.add(i), d.default(this._backdrop).appendTo(document.body), d.default(this._element).on("click.dismiss.bs.modal", function(e) {
                                t._ignoreBackdropClick ? t._ignoreBackdropClick = !1 : e.target === e.currentTarget && t._triggerBackdropTransition()
                            }), i && u.reflow(this._backdrop), d.default(this._backdrop).addClass("show"), !e) return;
                        if (!i) return void e();
                        var o = u.getTransitionDurationFromElement(this._backdrop);
                        d.default(this._backdrop).one(u.TRANSITION_END, e).emulateTransitionEnd(o)
                    } else if (!this._isShown && this._backdrop) {
                        d.default(this._backdrop).removeClass("show");
                        var n = function() {
                            t._removeBackdrop(), e && e()
                        };
                        if (d.default(this._element).hasClass("fade")) {
                            var s = u.getTransitionDurationFromElement(this._backdrop);
                            d.default(this._backdrop).one(u.TRANSITION_END, n).emulateTransitionEnd(s)
                        } else n()
                    } else e && e()
                }, t._adjustDialog = function() {
                    var e = this._element.scrollHeight > document.documentElement.clientHeight;
                    !this._isBodyOverflowing && e && (this._element.style.paddingLeft = this._scrollbarWidth + "px"), this._isBodyOverflowing && !e && (this._element.style.paddingRight = this._scrollbarWidth + "px")
                }, t._resetAdjustments = function() {
                    this._element.style.paddingLeft = "", this._element.style.paddingRight = ""
                }, t._checkScrollbar = function() {
                    var e = document.body.getBoundingClientRect();
                    this._isBodyOverflowing = Math.round(e.left + e.right) < window.innerWidth, this._scrollbarWidth = this._getScrollbarWidth()
                }, t._setScrollbar = function() {
                    var e = this;
                    if (this._isBodyOverflowing) {
                        var t = [].slice.call(document.querySelectorAll(".fixed-top, .fixed-bottom, .is-fixed, .sticky-top")),
                            i = [].slice.call(document.querySelectorAll(".sticky-top"));
                        d.default(t).each(function(t, i) {
                            var o = i.style.paddingRight,
                                n = d.default(i).css("padding-right");
                            d.default(i).data("padding-right", o).css("padding-right", parseFloat(n) + e._scrollbarWidth + "px")
                        }), d.default(i).each(function(t, i) {
                            var o = i.style.marginRight,
                                n = d.default(i).css("margin-right");
                            d.default(i).data("margin-right", o).css("margin-right", parseFloat(n) - e._scrollbarWidth + "px")
                        });
                        var o = document.body.style.paddingRight,
                            n = d.default(document.body).css("padding-right");
                        d.default(document.body).data("padding-right", o).css("padding-right", parseFloat(n) + this._scrollbarWidth + "px")
                    }
                    d.default(document.body).addClass("modal-open")
                }, t._resetScrollbar = function() {
                    var e = [].slice.call(document.querySelectorAll(".fixed-top, .fixed-bottom, .is-fixed, .sticky-top"));
                    d.default(e).each(function(e, t) {
                        var i = d.default(t).data("padding-right");
                        d.default(t).removeData("padding-right"), t.style.paddingRight = i || ""
                    });
                    var t = [].slice.call(document.querySelectorAll(".sticky-top"));
                    d.default(t).each(function(e, t) {
                        var i = d.default(t).data("margin-right");
                        void 0 !== i && d.default(t).css("margin-right", i).removeData("margin-right")
                    });
                    var i = d.default(document.body).data("padding-right");
                    d.default(document.body).removeData("padding-right"), document.body.style.paddingRight = i || ""
                }, t._getScrollbarWidth = function() {
                    var e = document.createElement("div");
                    e.className = "modal-scrollbar-measure", document.body.appendChild(e);
                    var t = e.getBoundingClientRect().width - e.clientWidth;
                    return document.body.removeChild(e), t
                }, e._jQueryInterface = function(t, i) {
                    return this.each(function() {
                        var o = d.default(this).data("bs.modal"),
                            n = r({}, I, d.default(this).data(), "object" == typeof t && t ? t : {});
                        if (o || (o = new e(this, n), d.default(this).data("bs.modal", o)), "string" == typeof t) {
                            if (void 0 === o[t]) throw new TypeError('No method named "' + t + '"');
                            o[t](i)
                        } else n.show && o.show(i)
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return I
                    }
                }]), e
            }();
        d.default(document).on("click.bs.modal.data-api", '[data-toggle="modal"]', function(e) {
            var t, i = this,
                o = u.getSelectorFromElement(this);
            o && (t = document.querySelector(o));
            var n = d.default(t).data("bs.modal") ? "toggle" : r({}, d.default(t).data(), d.default(this).data());
            "A" !== this.tagName && "AREA" !== this.tagName || e.preventDefault();
            var s = d.default(t).one("show.bs.modal", function(e) {
                e.isDefaultPrevented() || s.one("hidden.bs.modal", function() {
                    d.default(i).is(":visible") && i.focus()
                })
            });
            N._jQueryInterface.call(d.default(t), n, this)
        }), d.default.fn.modal = N._jQueryInterface, d.default.fn.modal.Constructor = N, d.default.fn.modal.noConflict = function() {
            return d.default.fn.modal = $, N._jQueryInterface
        };
        var j = ["background", "cite", "href", "itemtype", "longdesc", "poster", "src", "xlink:href"],
            D = {
                "*": ["class", "dir", "id", "lang", "role", /^aria-[\w-]*$/i],
                a: ["target", "href", "title", "rel"],
                area: [],
                b: [],
                br: [],
                col: [],
                code: [],
                div: [],
                em: [],
                hr: [],
                h1: [],
                h2: [],
                h3: [],
                h4: [],
                h5: [],
                h6: [],
                i: [],
                img: ["src", "srcset", "alt", "title", "width", "height"],
                li: [],
                ol: [],
                p: [],
                pre: [],
                s: [],
                small: [],
                span: [],
                sub: [],
                sup: [],
                strong: [],
                u: [],
                ul: []
            },
            F = /^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/gi,
            B = /^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i,
            R = "tooltip",
            M = d.default.fn[R],
            V = new RegExp("(^|\\s)bs-tooltip\\S+", "g"),
            q = ["sanitize", "whiteList", "sanitizeFn"],
            U = {
                animation: "boolean",
                template: "string",
                title: "(string|element|function)",
                trigger: "string",
                delay: "(number|object)",
                html: "boolean",
                selector: "(string|boolean)",
                placement: "(string|function)",
                offset: "(number|string|function)",
                container: "(string|element|boolean)",
                fallbackPlacement: "(string|array)",
                boundary: "(string|element)",
                sanitize: "boolean",
                sanitizeFn: "(null|function)",
                whiteList: "object",
                popperConfig: "(null|object)"
            },
            Y = {
                AUTO: "auto",
                TOP: "top",
                RIGHT: "right",
                BOTTOM: "bottom",
                LEFT: "left"
            },
            Q = {
                animation: !0,
                template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
                trigger: "hover focus",
                title: "",
                delay: 0,
                html: !1,
                selector: !1,
                placement: "top",
                offset: 0,
                container: !1,
                fallbackPlacement: "flip",
                boundary: "scrollParent",
                sanitize: !0,
                sanitizeFn: null,
                whiteList: D,
                popperConfig: null
            },
            X = {
                HIDE: "hide.bs.tooltip",
                HIDDEN: "hidden.bs.tooltip",
                SHOW: "show.bs.tooltip",
                SHOWN: "shown.bs.tooltip",
                INSERTED: "inserted.bs.tooltip",
                CLICK: "click.bs.tooltip",
                FOCUSIN: "focusin.bs.tooltip",
                FOCUSOUT: "focusout.bs.tooltip",
                MOUSEENTER: "mouseenter.bs.tooltip",
                MOUSELEAVE: "mouseleave.bs.tooltip"
            },
            Z = function() {
                function e(e, t) {
                    if (void 0 === c.default) throw new TypeError("Bootstrap's tooltips require Popper.js (https://popper.js.org/)");
                    this._isEnabled = !0, this._timeout = 0, this._hoverState = "", this._activeTrigger = {}, this._popper = null, this.element = e, this.config = this._getConfig(t), this.tip = null, this._setListeners()
                }
                var t = e.prototype;
                return t.enable = function() {
                    this._isEnabled = !0
                }, t.disable = function() {
                    this._isEnabled = !1
                }, t.toggleEnabled = function() {
                    this._isEnabled = !this._isEnabled
                }, t.toggle = function(e) {
                    if (this._isEnabled)
                        if (e) {
                            var t = this.constructor.DATA_KEY,
                                i = d.default(e.currentTarget).data(t);
                            i || (i = new this.constructor(e.currentTarget, this._getDelegateConfig()), d.default(e.currentTarget).data(t, i)), i._activeTrigger.click = !i._activeTrigger.click, i._isWithActiveTrigger() ? i._enter(null, i) : i._leave(null, i)
                        } else {
                            if (d.default(this.getTipElement()).hasClass("show")) return void this._leave(null, this);
                            this._enter(null, this)
                        }
                }, t.dispose = function() {
                    clearTimeout(this._timeout), d.default.removeData(this.element, this.constructor.DATA_KEY), d.default(this.element).off(this.constructor.EVENT_KEY), d.default(this.element).closest(".modal").off("hide.bs.modal", this._hideModalHandler), this.tip && d.default(this.tip).remove(), this._isEnabled = null, this._timeout = null, this._hoverState = null, this._activeTrigger = null, this._popper && this._popper.destroy(), this._popper = null, this.element = null, this.config = null, this.tip = null
                }, t.show = function() {
                    var e = this;
                    if ("none" === d.default(this.element).css("display")) throw new Error("Please use show on visible elements");
                    var t = d.default.Event(this.constructor.Event.SHOW);
                    if (this.isWithContent() && this._isEnabled) {
                        d.default(this.element).trigger(t);
                        var i = u.findShadowRoot(this.element),
                            o = d.default.contains(null !== i ? i : this.element.ownerDocument.documentElement, this.element);
                        if (t.isDefaultPrevented() || !o) return;
                        var n = this.getTipElement(),
                            s = u.getUID(this.constructor.NAME);
                        n.setAttribute("id", s), this.element.setAttribute("aria-describedby", s), this.setContent(), this.config.animation && d.default(n).addClass("fade");
                        var r = "function" == typeof this.config.placement ? this.config.placement.call(this, n, this.element) : this.config.placement,
                            a = this._getAttachment(r);
                        this.addAttachmentClass(a);
                        var l = this._getContainer();
                        d.default(n).data(this.constructor.DATA_KEY, this), d.default.contains(this.element.ownerDocument.documentElement, this.tip) || d.default(n).appendTo(l), d.default(this.element).trigger(this.constructor.Event.INSERTED), this._popper = new c.default(this.element, n, this._getPopperConfig(a)), d.default(n).addClass("show"), "ontouchstart" in document.documentElement && d.default(document.body).children().on("mouseover", null, d.default.noop);
                        var f = function() {
                            e.config.animation && e._fixTransition();
                            var t = e._hoverState;
                            e._hoverState = null, d.default(e.element).trigger(e.constructor.Event.SHOWN), "out" === t && e._leave(null, e)
                        };
                        if (d.default(this.tip).hasClass("fade")) {
                            var p = u.getTransitionDurationFromElement(this.tip);
                            d.default(this.tip).one(u.TRANSITION_END, f).emulateTransitionEnd(p)
                        } else f()
                    }
                }, t.hide = function(e) {
                    var t = this,
                        i = this.getTipElement(),
                        o = d.default.Event(this.constructor.Event.HIDE),
                        n = function() {
                            "show" !== t._hoverState && i.parentNode && i.parentNode.removeChild(i), t._cleanTipClass(), t.element.removeAttribute("aria-describedby"), d.default(t.element).trigger(t.constructor.Event.HIDDEN), null !== t._popper && t._popper.destroy(), e && e()
                        };
                    if (d.default(this.element).trigger(o), !o.isDefaultPrevented()) {
                        if (d.default(i).removeClass("show"), "ontouchstart" in document.documentElement && d.default(document.body).children().off("mouseover", null, d.default.noop), this._activeTrigger.click = !1, this._activeTrigger.focus = !1, this._activeTrigger.hover = !1, d.default(this.tip).hasClass("fade")) {
                            var s = u.getTransitionDurationFromElement(i);
                            d.default(i).one(u.TRANSITION_END, n).emulateTransitionEnd(s)
                        } else n();
                        this._hoverState = ""
                    }
                }, t.update = function() {
                    null !== this._popper && this._popper.scheduleUpdate()
                }, t.isWithContent = function() {
                    return Boolean(this.getTitle())
                }, t.addAttachmentClass = function(e) {
                    d.default(this.getTipElement()).addClass("bs-tooltip-" + e)
                }, t.getTipElement = function() {
                    return this.tip = this.tip || d.default(this.config.template)[0], this.tip
                }, t.setContent = function() {
                    var e = this.getTipElement();
                    this.setElementContent(d.default(e.querySelectorAll(".tooltip-inner")), this.getTitle()), d.default(e).removeClass("fade show")
                }, t.setElementContent = function(e, t) {
                    "object" != typeof t || !t.nodeType && !t.jquery ? this.config.html ? (this.config.sanitize && (t = l(t, this.config.whiteList, this.config.sanitizeFn)), e.html(t)) : e.text(t) : this.config.html ? d.default(t).parent().is(e) || e.empty().append(t) : e.text(d.default(t).text())
                }, t.getTitle = function() {
                    var e = this.element.getAttribute("data-original-title");
                    return e || (e = "function" == typeof this.config.title ? this.config.title.call(this.element) : this.config.title), e
                }, t._getPopperConfig = function(e) {
                    var t = this;
                    return r({}, {
                        placement: e,
                        modifiers: {
                            offset: this._getOffset(),
                            flip: {
                                behavior: this.config.fallbackPlacement
                            },
                            arrow: {
                                element: ".arrow"
                            },
                            preventOverflow: {
                                boundariesElement: this.config.boundary
                            }
                        },
                        onCreate: function(e) {
                            e.originalPlacement !== e.placement && t._handlePopperPlacementChange(e)
                        },
                        onUpdate: function(e) {
                            return t._handlePopperPlacementChange(e)
                        }
                    }, this.config.popperConfig)
                }, t._getOffset = function() {
                    var e = this,
                        t = {};
                    return "function" == typeof this.config.offset ? t.fn = function(t) {
                        return t.offsets = r({}, t.offsets, e.config.offset(t.offsets, e.element) || {}), t
                    } : t.offset = this.config.offset, t
                }, t._getContainer = function() {
                    return !1 === this.config.container ? document.body : u.isElement(this.config.container) ? d.default(this.config.container) : d.default(document).find(this.config.container)
                }, t._getAttachment = function(e) {
                    return Y[e.toUpperCase()]
                }, t._setListeners = function() {
                    var e = this;
                    this.config.trigger.split(" ").forEach(function(t) {
                        if ("click" === t) d.default(e.element).on(e.constructor.Event.CLICK, e.config.selector, function(t) {
                            return e.toggle(t)
                        });
                        else if ("manual" !== t) {
                            var i = "hover" === t ? e.constructor.Event.MOUSEENTER : e.constructor.Event.FOCUSIN,
                                o = "hover" === t ? e.constructor.Event.MOUSELEAVE : e.constructor.Event.FOCUSOUT;
                            d.default(e.element).on(i, e.config.selector, function(t) {
                                return e._enter(t)
                            }).on(o, e.config.selector, function(t) {
                                return e._leave(t)
                            })
                        }
                    }), this._hideModalHandler = function() {
                        e.element && e.hide()
                    }, d.default(this.element).closest(".modal").on("hide.bs.modal", this._hideModalHandler), this.config.selector ? this.config = r({}, this.config, {
                        trigger: "manual",
                        selector: ""
                    }) : this._fixTitle()
                }, t._fixTitle = function() {
                    var e = typeof this.element.getAttribute("data-original-title");
                    (this.element.getAttribute("title") || "string" !== e) && (this.element.setAttribute("data-original-title", this.element.getAttribute("title") || ""), this.element.setAttribute("title", ""))
                }, t._enter = function(e, t) {
                    var i = this.constructor.DATA_KEY;
                    (t = t || d.default(e.currentTarget).data(i)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), d.default(e.currentTarget).data(i, t)), e && (t._activeTrigger["focusin" === e.type ? "focus" : "hover"] = !0), d.default(t.getTipElement()).hasClass("show") || "show" === t._hoverState ? t._hoverState = "show" : (clearTimeout(t._timeout), t._hoverState = "show", t.config.delay && t.config.delay.show ? t._timeout = setTimeout(function() {
                        "show" === t._hoverState && t.show()
                    }, t.config.delay.show) : t.show())
                }, t._leave = function(e, t) {
                    var i = this.constructor.DATA_KEY;
                    (t = t || d.default(e.currentTarget).data(i)) || (t = new this.constructor(e.currentTarget, this._getDelegateConfig()), d.default(e.currentTarget).data(i, t)), e && (t._activeTrigger["focusout" === e.type ? "focus" : "hover"] = !1), t._isWithActiveTrigger() || (clearTimeout(t._timeout), t._hoverState = "out", t.config.delay && t.config.delay.hide ? t._timeout = setTimeout(function() {
                        "out" === t._hoverState && t.hide()
                    }, t.config.delay.hide) : t.hide())
                }, t._isWithActiveTrigger = function() {
                    for (var e in this._activeTrigger)
                        if (this._activeTrigger[e]) return !0;
                    return !1
                }, t._getConfig = function(e) {
                    var t = d.default(this.element).data();
                    return Object.keys(t).forEach(function(e) {
                        -1 !== q.indexOf(e) && delete t[e]
                    }), "number" == typeof(e = r({}, this.constructor.Default, t, "object" == typeof e && e ? e : {})).delay && (e.delay = {
                        show: e.delay,
                        hide: e.delay
                    }), "number" == typeof e.title && (e.title = e.title.toString()), "number" == typeof e.content && (e.content = e.content.toString()), u.typeCheckConfig(R, e, this.constructor.DefaultType), e.sanitize && (e.template = l(e.template, e.whiteList, e.sanitizeFn)), e
                }, t._getDelegateConfig = function() {
                    var e = {};
                    if (this.config)
                        for (var t in this.config) this.constructor.Default[t] !== this.config[t] && (e[t] = this.config[t]);
                    return e
                }, t._cleanTipClass = function() {
                    var e = d.default(this.getTipElement()),
                        t = e.attr("class").match(V);
                    null !== t && t.length && e.removeClass(t.join(""))
                }, t._handlePopperPlacementChange = function(e) {
                    this.tip = e.instance.popper, this._cleanTipClass(), this.addAttachmentClass(this._getAttachment(e.placement))
                }, t._fixTransition = function() {
                    var e = this.getTipElement(),
                        t = this.config.animation;
                    null === e.getAttribute("x-placement") && (d.default(e).removeClass("fade"), this.config.animation = !1, this.hide(), this.show(), this.config.animation = t)
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this),
                            o = i.data("bs.tooltip"),
                            n = "object" == typeof t && t;
                        if ((o || !/dispose|hide/.test(t)) && (o || (o = new e(this, n), i.data("bs.tooltip", o)), "string" == typeof t)) {
                            if (void 0 === o[t]) throw new TypeError('No method named "' + t + '"');
                            o[t]()
                        }
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return Q
                    }
                }, {
                    key: "NAME",
                    get: function() {
                        return R
                    }
                }, {
                    key: "DATA_KEY",
                    get: function() {
                        return "bs.tooltip"
                    }
                }, {
                    key: "Event",
                    get: function() {
                        return X
                    }
                }, {
                    key: "EVENT_KEY",
                    get: function() {
                        return ".bs.tooltip"
                    }
                }, {
                    key: "DefaultType",
                    get: function() {
                        return U
                    }
                }]), e
            }();
        d.default.fn[R] = Z._jQueryInterface, d.default.fn[R].Constructor = Z, d.default.fn[R].noConflict = function() {
            return d.default.fn[R] = M, Z._jQueryInterface
        };
        var G = "popover",
            K = d.default.fn[G],
            J = new RegExp("(^|\\s)bs-popover\\S+", "g"),
            ee = r({}, Z.Default, {
                placement: "right",
                trigger: "click",
                content: "",
                template: '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>'
            }),
            te = r({}, Z.DefaultType, {
                content: "(string|element|function)"
            }),
            ie = {
                HIDE: "hide.bs.popover",
                HIDDEN: "hidden.bs.popover",
                SHOW: "show.bs.popover",
                SHOWN: "shown.bs.popover",
                INSERTED: "inserted.bs.popover",
                CLICK: "click.bs.popover",
                FOCUSIN: "focusin.bs.popover",
                FOCUSOUT: "focusout.bs.popover",
                MOUSEENTER: "mouseenter.bs.popover",
                MOUSELEAVE: "mouseleave.bs.popover"
            },
            oe = function(e) {
                function t() {
                    return e.apply(this, arguments) || this
                }
                var i, o;
                o = e, (i = t).prototype = Object.create(o.prototype), i.prototype.constructor = i, i.__proto__ = o;
                var n = t.prototype;
                return n.isWithContent = function() {
                    return this.getTitle() || this._getContent()
                }, n.addAttachmentClass = function(e) {
                    d.default(this.getTipElement()).addClass("bs-popover-" + e)
                }, n.getTipElement = function() {
                    return this.tip = this.tip || d.default(this.config.template)[0], this.tip
                }, n.setContent = function() {
                    var e = d.default(this.getTipElement());
                    this.setElementContent(e.find(".popover-header"), this.getTitle());
                    var t = this._getContent();
                    "function" == typeof t && (t = t.call(this.element)), this.setElementContent(e.find(".popover-body"), t), e.removeClass("fade show")
                }, n._getContent = function() {
                    return this.element.getAttribute("data-content") || this.config.content
                }, n._cleanTipClass = function() {
                    var e = d.default(this.getTipElement()),
                        t = e.attr("class").match(J);
                    null !== t && t.length > 0 && e.removeClass(t.join(""))
                }, t._jQueryInterface = function(e) {
                    return this.each(function() {
                        var i = d.default(this).data("bs.popover"),
                            o = "object" == typeof e ? e : null;
                        if ((i || !/dispose|hide/.test(e)) && (i || (i = new t(this, o), d.default(this).data("bs.popover", i)), "string" == typeof e)) {
                            if (void 0 === i[e]) throw new TypeError('No method named "' + e + '"');
                            i[e]()
                        }
                    })
                }, s(t, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return ee
                    }
                }, {
                    key: "NAME",
                    get: function() {
                        return G
                    }
                }, {
                    key: "DATA_KEY",
                    get: function() {
                        return "bs.popover"
                    }
                }, {
                    key: "Event",
                    get: function() {
                        return ie
                    }
                }, {
                    key: "EVENT_KEY",
                    get: function() {
                        return ".bs.popover"
                    }
                }, {
                    key: "DefaultType",
                    get: function() {
                        return te
                    }
                }]), t
            }(Z);
        d.default.fn[G] = oe._jQueryInterface, d.default.fn[G].Constructor = oe, d.default.fn[G].noConflict = function() {
            return d.default.fn[G] = K, oe._jQueryInterface
        };
        var ne = "scrollspy",
            se = d.default.fn[ne],
            re = {
                offset: 10,
                method: "auto",
                target: ""
            },
            ae = {
                offset: "number",
                method: "string",
                target: "(string|element)"
            },
            le = function() {
                function e(e, t) {
                    var i = this;
                    this._element = e, this._scrollElement = "BODY" === e.tagName ? window : e, this._config = this._getConfig(t), this._selector = this._config.target + " .nav-link," + this._config.target + " .list-group-item," + this._config.target + " .dropdown-item", this._offsets = [], this._targets = [], this._activeTarget = null, this._scrollHeight = 0, d.default(this._scrollElement).on("scroll.bs.scrollspy", function(e) {
                        return i._process(e)
                    }), this.refresh(), this._process()
                }
                var t = e.prototype;
                return t.refresh = function() {
                    var e = this,
                        t = this._scrollElement === this._scrollElement.window ? "offset" : "position",
                        i = "auto" === this._config.method ? t : this._config.method,
                        o = "position" === i ? this._getScrollTop() : 0;
                    this._offsets = [], this._targets = [], this._scrollHeight = this._getScrollHeight(), [].slice.call(document.querySelectorAll(this._selector)).map(function(e) {
                        var t, n = u.getSelectorFromElement(e);
                        if (n && (t = document.querySelector(n)), t) {
                            var s = t.getBoundingClientRect();
                            if (s.width || s.height) return [d.default(t)[i]().top + o, n]
                        }
                        return null
                    }).filter(function(e) {
                        return e
                    }).sort(function(e, t) {
                        return e[0] - t[0]
                    }).forEach(function(t) {
                        e._offsets.push(t[0]), e._targets.push(t[1])
                    })
                }, t.dispose = function() {
                    d.default.removeData(this._element, "bs.scrollspy"), d.default(this._scrollElement).off(".bs.scrollspy"), this._element = null, this._scrollElement = null, this._config = null, this._selector = null, this._offsets = null, this._targets = null, this._activeTarget = null, this._scrollHeight = null
                }, t._getConfig = function(e) {
                    if ("string" != typeof(e = r({}, re, "object" == typeof e && e ? e : {})).target && u.isElement(e.target)) {
                        var t = d.default(e.target).attr("id");
                        t || (t = u.getUID(ne), d.default(e.target).attr("id", t)), e.target = "#" + t
                    }
                    return u.typeCheckConfig(ne, e, ae), e
                }, t._getScrollTop = function() {
                    return this._scrollElement === window ? this._scrollElement.pageYOffset : this._scrollElement.scrollTop
                }, t._getScrollHeight = function() {
                    return this._scrollElement.scrollHeight || Math.max(document.body.scrollHeight, document.documentElement.scrollHeight)
                }, t._getOffsetHeight = function() {
                    return this._scrollElement === window ? window.innerHeight : this._scrollElement.getBoundingClientRect().height
                }, t._process = function() {
                    var e = this._getScrollTop() + this._config.offset,
                        t = this._getScrollHeight(),
                        i = this._config.offset + t - this._getOffsetHeight();
                    if (this._scrollHeight !== t && this.refresh(), e >= i) {
                        var o = this._targets[this._targets.length - 1];
                        this._activeTarget !== o && this._activate(o)
                    } else {
                        if (this._activeTarget && e < this._offsets[0] && this._offsets[0] > 0) return this._activeTarget = null, void this._clear();
                        for (var n = this._offsets.length; n--;) this._activeTarget !== this._targets[n] && e >= this._offsets[n] && (void 0 === this._offsets[n + 1] || e < this._offsets[n + 1]) && this._activate(this._targets[n])
                    }
                }, t._activate = function(e) {
                    this._activeTarget = e, this._clear();
                    var t = this._selector.split(",").map(function(t) {
                            return t + '[data-target="' + e + '"],' + t + '[href="' + e + '"]'
                        }),
                        i = d.default([].slice.call(document.querySelectorAll(t.join(","))));
                    i.hasClass("dropdown-item") ? (i.closest(".dropdown").find(".dropdown-toggle").addClass("active"), i.addClass("active")) : (i.addClass("active"), i.parents(".nav, .list-group").prev(".nav-link, .list-group-item").addClass("active"), i.parents(".nav, .list-group").prev(".nav-item").children(".nav-link").addClass("active")), d.default(this._scrollElement).trigger("activate.bs.scrollspy", {
                        relatedTarget: e
                    })
                }, t._clear = function() {
                    [].slice.call(document.querySelectorAll(this._selector)).filter(function(e) {
                        return e.classList.contains("active")
                    }).forEach(function(e) {
                        return e.classList.remove("active")
                    })
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this).data("bs.scrollspy");
                        if (i || (i = new e(this, "object" == typeof t && t), d.default(this).data("bs.scrollspy", i)), "string" == typeof t) {
                            if (void 0 === i[t]) throw new TypeError('No method named "' + t + '"');
                            i[t]()
                        }
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return re
                    }
                }]), e
            }();
        d.default(window).on("load.bs.scrollspy.data-api", function() {
            for (var e = [].slice.call(document.querySelectorAll('[data-spy="scroll"]')), t = e.length; t--;) {
                var i = d.default(e[t]);
                le._jQueryInterface.call(i, i.data())
            }
        }), d.default.fn[ne] = le._jQueryInterface, d.default.fn[ne].Constructor = le, d.default.fn[ne].noConflict = function() {
            return d.default.fn[ne] = se, le._jQueryInterface
        };
        var de = d.default.fn.tab,
            ce = function() {
                function e(e) {
                    this._element = e
                }
                var t = e.prototype;
                return t.show = function() {
                    var e = this;
                    if (!(this._element.parentNode && this._element.parentNode.nodeType === Node.ELEMENT_NODE && d.default(this._element).hasClass("active") || d.default(this._element).hasClass("disabled"))) {
                        var t, i, o = d.default(this._element).closest(".nav, .list-group")[0],
                            n = u.getSelectorFromElement(this._element);
                        if (o) {
                            var s = "UL" === o.nodeName || "OL" === o.nodeName ? "> li > .active" : ".active";
                            i = (i = d.default.makeArray(d.default(o).find(s)))[i.length - 1]
                        }
                        var r = d.default.Event("hide.bs.tab", {
                                relatedTarget: this._element
                            }),
                            a = d.default.Event("show.bs.tab", {
                                relatedTarget: i
                            });
                        if (i && d.default(i).trigger(r), d.default(this._element).trigger(a), !a.isDefaultPrevented() && !r.isDefaultPrevented()) {
                            n && (t = document.querySelector(n)), this._activate(this._element, o);
                            var l = function() {
                                var t = d.default.Event("hidden.bs.tab", {
                                        relatedTarget: e._element
                                    }),
                                    o = d.default.Event("shown.bs.tab", {
                                        relatedTarget: i
                                    });
                                d.default(i).trigger(t), d.default(e._element).trigger(o)
                            };
                            t ? this._activate(t, t.parentNode, l) : l()
                        }
                    }
                }, t.dispose = function() {
                    d.default.removeData(this._element, "bs.tab"), this._element = null
                }, t._activate = function(e, t, i) {
                    var o = this,
                        n = (!t || "UL" !== t.nodeName && "OL" !== t.nodeName ? d.default(t).children(".active") : d.default(t).find("> li > .active"))[0],
                        s = i && n && d.default(n).hasClass("fade"),
                        r = function() {
                            return o._transitionComplete(e, n, i)
                        };
                    if (n && s) {
                        var a = u.getTransitionDurationFromElement(n);
                        d.default(n).removeClass("show").one(u.TRANSITION_END, r).emulateTransitionEnd(a)
                    } else r()
                }, t._transitionComplete = function(e, t, i) {
                    if (t) {
                        d.default(t).removeClass("active");
                        var o = d.default(t.parentNode).find("> .dropdown-menu .active")[0];
                        o && d.default(o).removeClass("active"), "tab" === t.getAttribute("role") && t.setAttribute("aria-selected", !1)
                    }
                    if (d.default(e).addClass("active"), "tab" === e.getAttribute("role") && e.setAttribute("aria-selected", !0), u.reflow(e), e.classList.contains("fade") && e.classList.add("show"), e.parentNode && d.default(e.parentNode).hasClass("dropdown-menu")) {
                        var n = d.default(e).closest(".dropdown")[0];
                        if (n) {
                            var s = [].slice.call(n.querySelectorAll(".dropdown-toggle"));
                            d.default(s).addClass("active")
                        }
                        e.setAttribute("aria-expanded", !0)
                    }
                    i && i()
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this),
                            o = i.data("bs.tab");
                        if (o || (o = new e(this), i.data("bs.tab", o)), "string" == typeof t) {
                            if (void 0 === o[t]) throw new TypeError('No method named "' + t + '"');
                            o[t]()
                        }
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }]), e
            }();
        d.default(document).on("click.bs.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"], [data-toggle="list"]', function(e) {
            e.preventDefault(), ce._jQueryInterface.call(d.default(this), "show")
        }), d.default.fn.tab = ce._jQueryInterface, d.default.fn.tab.Constructor = ce, d.default.fn.tab.noConflict = function() {
            return d.default.fn.tab = de, ce._jQueryInterface
        };
        var ue = d.default.fn.toast,
            fe = {
                animation: "boolean",
                autohide: "boolean",
                delay: "number"
            },
            pe = {
                animation: !0,
                autohide: !0,
                delay: 500
            },
            he = function() {
                function e(e, t) {
                    this._element = e, this._config = this._getConfig(t), this._timeout = null, this._setListeners()
                }
                var t = e.prototype;
                return t.show = function() {
                    var e = this,
                        t = d.default.Event("show.bs.toast");
                    if (d.default(this._element).trigger(t), !t.isDefaultPrevented()) {
                        this._clearTimeout(), this._config.animation && this._element.classList.add("fade");
                        var i = function() {
                            e._element.classList.remove("showing"), e._element.classList.add("show"), d.default(e._element).trigger("shown.bs.toast"), e._config.autohide && (e._timeout = setTimeout(function() {
                                e.hide()
                            }, e._config.delay))
                        };
                        if (this._element.classList.remove("hide"), u.reflow(this._element), this._element.classList.add("showing"), this._config.animation) {
                            var o = u.getTransitionDurationFromElement(this._element);
                            d.default(this._element).one(u.TRANSITION_END, i).emulateTransitionEnd(o)
                        } else i()
                    }
                }, t.hide = function() {
                    if (this._element.classList.contains("show")) {
                        var e = d.default.Event("hide.bs.toast");
                        d.default(this._element).trigger(e), e.isDefaultPrevented() || this._close()
                    }
                }, t.dispose = function() {
                    this._clearTimeout(), this._element.classList.contains("show") && this._element.classList.remove("show"), d.default(this._element).off("click.dismiss.bs.toast"), d.default.removeData(this._element, "bs.toast"), this._element = null, this._config = null
                }, t._getConfig = function(e) {
                    return e = r({}, pe, d.default(this._element).data(), "object" == typeof e && e ? e : {}), u.typeCheckConfig("toast", e, this.constructor.DefaultType), e
                }, t._setListeners = function() {
                    var e = this;
                    d.default(this._element).on("click.dismiss.bs.toast", '[data-dismiss="toast"]', function() {
                        return e.hide()
                    })
                }, t._close = function() {
                    var e = this,
                        t = function() {
                            e._element.classList.add("hide"), d.default(e._element).trigger("hidden.bs.toast")
                        };
                    if (this._element.classList.remove("show"), this._config.animation) {
                        var i = u.getTransitionDurationFromElement(this._element);
                        d.default(this._element).one(u.TRANSITION_END, t).emulateTransitionEnd(i)
                    } else t()
                }, t._clearTimeout = function() {
                    clearTimeout(this._timeout), this._timeout = null
                }, e._jQueryInterface = function(t) {
                    return this.each(function() {
                        var i = d.default(this),
                            o = i.data("bs.toast");
                        if (o || (o = new e(this, "object" == typeof t && t), i.data("bs.toast", o)), "string" == typeof t) {
                            if (void 0 === o[t]) throw new TypeError('No method named "' + t + '"');
                            o[t](this)
                        }
                    })
                }, s(e, null, [{
                    key: "VERSION",
                    get: function() {
                        return "4.5.3"
                    }
                }, {
                    key: "DefaultType",
                    get: function() {
                        return fe
                    }
                }, {
                    key: "Default",
                    get: function() {
                        return pe
                    }
                }]), e
            }();
        d.default.fn.toast = he._jQueryInterface, d.default.fn.toast.Constructor = he, d.default.fn.toast.noConflict = function() {
            return d.default.fn.toast = ue, he._jQueryInterface
        }, e.Alert = h, e.Button = g, e.Carousel = x, e.Collapse = C, e.Dropdown = P, e.Modal = N, e.Popover = oe, e.Scrollspy = le, e.Tab = ce, e.Toast = he, e.Tooltip = Z, e.Util = u, Object.defineProperty(e, "__esModule", {
            value: !0
        })
    })
}, function(e, t, i) {
    "use strict";

    function o(e) {
        console && console.warn
    }

    function n() {
        n.init.call(this)
    }

    function s(e) {
        return void 0 === e._maxListeners ? n.defaultMaxListeners : e._maxListeners
    }

    function r(e, t, i, n) {
        var r, a, l;
        if ("function" != typeof i) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof i);
        if (a = e._events, void 0 === a ? (a = e._events = Object.create(null), e._eventsCount = 0) : (void 0 !== a.newListener && (e.emit("newListener", t, i.listener ? i.listener : i), a = e._events), l = a[t]), void 0 === l) l = a[t] = i, ++e._eventsCount;
        else if ("function" == typeof l ? l = a[t] = n ? [i, l] : [l, i] : n ? l.unshift(i) : l.push(i), (r = s(e)) > 0 && l.length > r && !l.warned) {
            l.warned = !0;
            var d = new Error("Possible EventEmitter memory leak detected. " + l.length + " " + String(t) + " listeners added. Use emitter.setMaxListeners() to increase limit");
            d.name = "MaxListenersExceededWarning", d.emitter = e, d.type = t, d.count = l.length, o(d)
        }
        return e
    }

    function a() {
        for (var e = [], t = 0; t < arguments.length; t++) e.push(arguments[t]);
        this.fired || (this.target.removeListener(this.type, this.wrapFn), this.fired = !0, g(this.listener, this.target, e))
    }

    function l(e, t, i) {
        var o = {
                fired: !1,
                wrapFn: void 0,
                target: e,
                type: t,
                listener: i
            },
            n = a.bind(o);
        return n.listener = i, o.wrapFn = n, n
    }

    function d(e, t, i) {
        var o = e._events;
        if (void 0 === o) return [];
        var n = o[t];
        return void 0 === n ? [] : "function" == typeof n ? i ? [n.listener || n] : [n] : i ? p(n) : u(n, n.length)
    }

    function c(e) {
        var t = this._events;
        if (void 0 !== t) {
            var i = t[e];
            if ("function" == typeof i) return 1;
            if (void 0 !== i) return i.length
        }
        return 0
    }

    function u(e, t) {
        for (var i = new Array(t), o = 0; o < t; ++o) i[o] = e[o];
        return i
    }

    function f(e, t) {
        for (; t + 1 < e.length; t++) e[t] = e[t + 1];
        e.pop()
    }

    function p(e) {
        for (var t = new Array(e.length), i = 0; i < t.length; ++i) t[i] = e[i].listener || e[i];
        return t
    }
    var h, m = "object" == typeof Reflect ? Reflect : null,
        g = m && "function" == typeof m.apply ? m.apply : function(e, t, i) {
            return Function.prototype.apply.call(e, t, i)
        };
    h = m && "function" == typeof m.ownKeys ? m.ownKeys : Object.getOwnPropertySymbols ? function(e) {
        return Object.getOwnPropertyNames(e).concat(Object.getOwnPropertySymbols(e))
    } : function(e) {
        return Object.getOwnPropertyNames(e)
    };
    var v = Number.isNaN || function(e) {
        return e !== e
    };
    e.exports = n, n.EventEmitter = n, n.prototype._events = void 0, n.prototype._eventsCount = 0, n.prototype._maxListeners = void 0;
    var y = 10;
    Object.defineProperty(n, "defaultMaxListeners", {
        enumerable: !0,
        get: function() {
            return y
        },
        set: function(e) {
            if ("number" != typeof e || e < 0 || v(e)) throw new RangeError('The value of "defaultMaxListeners" is out of range. It must be a non-negative number. Received ' + e + ".");
            y = e
        }
    }), n.init = function() {
        void 0 !== this._events && this._events !== Object.getPrototypeOf(this)._events || (this._events = Object.create(null), this._eventsCount = 0), this._maxListeners = this._maxListeners || void 0
    }, n.prototype.setMaxListeners = function(e) {
        if ("number" != typeof e || e < 0 || v(e)) throw new RangeError('The value of "n" is out of range. It must be a non-negative number. Received ' + e + ".");
        return this._maxListeners = e, this
    }, n.prototype.getMaxListeners = function() {
        return s(this)
    }, n.prototype.emit = function(e) {
        for (var t = [], i = 1; i < arguments.length; i++) t.push(arguments[i]);
        var o = "error" === e,
            n = this._events;
        if (void 0 !== n) o = o && void 0 === n.error;
        else if (!o) return !1;
        if (o) {
            var s;
            if (t.length > 0 && (s = t[0]), s instanceof Error) throw s;
            var r = new Error("Unhandled error." + (s ? " (" + s.message + ")" : ""));
            throw r.context = s, r
        }
        var a = n[e];
        if (void 0 === a) return !1;
        if ("function" == typeof a) g(a, this, t);
        else
            for (var l = a.length, d = u(a, l), i = 0; i < l; ++i) g(d[i], this, t);
        return !0
    }, n.prototype.addListener = function(e, t) {
        return r(this, e, t, !1)
    }, n.prototype.on = n.prototype.addListener, n.prototype.prependListener = function(e, t) {
        return r(this, e, t, !0)
    }, n.prototype.once = function(e, t) {
        if ("function" != typeof t) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof t);
        return this.on(e, l(this, e, t)), this
    }, n.prototype.prependOnceListener = function(e, t) {
        if ("function" != typeof t) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof t);
        return this.prependListener(e, l(this, e, t)), this
    }, n.prototype.removeListener = function(e, t) {
        var i, o, n, s, r;
        if ("function" != typeof t) throw new TypeError('The "listener" argument must be of type Function. Received type ' + typeof t);
        if (void 0 === (o = this._events)) return this;
        if (void 0 === (i = o[e])) return this;
        if (i === t || i.listener === t) 0 == --this._eventsCount ? this._events = Object.create(null) : (delete o[e], o.removeListener && this.emit("removeListener", e, i.listener || t));
        else if ("function" != typeof i) {
            for (n = -1, s = i.length - 1; s >= 0; s--)
                if (i[s] === t || i[s].listener === t) {
                    r = i[s].listener, n = s;
                    break
                } if (n < 0) return this;
            0 === n ? i.shift() : f(i, n), 1 === i.length && (o[e] = i[0]), void 0 !== o.removeListener && this.emit("removeListener", e, r || t)
        }
        return this
    }, n.prototype.off = n.prototype.removeListener, n.prototype.removeAllListeners = function(e) {
        var t, i, o;
        if (void 0 === (i = this._events)) return this;
        if (void 0 === i.removeListener) return 0 === arguments.length ? (this._events = Object.create(null), this._eventsCount = 0) : void 0 !== i[e] && (0 == --this._eventsCount ? this._events = Object.create(null) : delete i[e]), this;
        if (0 === arguments.length) {
            var n, s = Object.keys(i);
            for (o = 0; o < s.length; ++o) "removeListener" !== (n = s[o]) && this.removeAllListeners(n);
            return this.removeAllListeners("removeListener"), this._events = Object.create(null), this._eventsCount = 0, this
        }
        if ("function" == typeof(t = i[e])) this.removeListener(e, t);
        else if (void 0 !== t)
            for (o = t.length - 1; o >= 0; o--) this.removeListener(e, t[o]);
        return this
    }, n.prototype.listeners = function(e) {
        return d(this, e, !0)
    }, n.prototype.rawListeners = function(e) {
        return d(this, e, !1)
    }, n.listenerCount = function(e, t) {
        return "function" == typeof e.listenerCount ? e.listenerCount(t) : c.call(e, t)
    }, n.prototype.listenerCount = c, n.prototype.eventNames = function() {
        return this._eventsCount > 0 ? h(this._events) : []
    }
}, function(e, t, i) {
    "use strict";
    var o, o;
    ! function(t) {
        e.exports = t()
    }(function() {
        return function e(t, i, n) {
            function s(a, l) {
                if (!i[a]) {
                    if (!t[a]) {
                        var d = "function" == typeof o && o;
                        if (!l && d) return o(a, !0);
                        if (r) return r(a, !0);
                        var c = new Error("Cannot find module '" + a + "'");
                        throw c.code = "MODULE_NOT_FOUND", c
                    }
                    var u = i[a] = {
                        exports: {}
                    };
                    t[a][0].call(u.exports, function(e) {
                        var i = t[a][1][e];
                        return s(i || e)
                    }, u, u.exports, e, t, i, n)
                }
                return i[a].exports
            }
            for (var r = "function" == typeof o && o, a = 0; a < n.length; a++) s(n[a]);
            return s
        }({
            1: [function(e, t, i) {
                t.exports = function(e) {
                    var t, i, o, n = -1;
                    if (e.lines.length > 1 && "flex-start" === e.style.alignContent)
                        for (t = 0; o = e.lines[++n];) o.crossStart = t, t += o.cross;
                    else if (e.lines.length > 1 && "flex-end" === e.style.alignContent)
                        for (t = e.flexStyle.crossSpace; o = e.lines[++n];) o.crossStart = t, t += o.cross;
                    else if (e.lines.length > 1 && "center" === e.style.alignContent)
                        for (t = e.flexStyle.crossSpace / 2; o = e.lines[++n];) o.crossStart = t, t += o.cross;
                    else if (e.lines.length > 1 && "space-between" === e.style.alignContent)
                        for (i = e.flexStyle.crossSpace / (e.lines.length - 1), t = 0; o = e.lines[++n];) o.crossStart = t, t += o.cross + i;
                    else if (e.lines.length > 1 && "space-around" === e.style.alignContent)
                        for (i = 2 * e.flexStyle.crossSpace / (2 * e.lines.length), t = i / 2; o = e.lines[++n];) o.crossStart = t, t += o.cross + i;
                    else
                        for (i = e.flexStyle.crossSpace / e.lines.length, t = e.flexStyle.crossInnerBefore; o = e.lines[++n];) o.crossStart = t, o.cross += i, t += o.cross
                }
            }, {}],
            2: [function(e, t, i) {
                t.exports = function(e) {
                    for (var t, i = -1; line = e.lines[++i];)
                        for (t = -1; child = line.children[++t];) {
                            var o = child.style.alignSelf;
                            "auto" === o && (o = e.style.alignItems), "flex-start" === o ? child.flexStyle.crossStart = line.crossStart : "flex-end" === o ? child.flexStyle.crossStart = line.crossStart + line.cross - child.flexStyle.crossOuter : "center" === o ? child.flexStyle.crossStart = line.crossStart + (line.cross - child.flexStyle.crossOuter) / 2 : (child.flexStyle.crossStart = line.crossStart, child.flexStyle.crossOuter = line.cross, child.flexStyle.cross = child.flexStyle.crossOuter - child.flexStyle.crossBefore - child.flexStyle.crossAfter)
                        }
                }
            }, {}],
            3: [function(e, t, i) {
                t.exports = function(e, t) {
                    var i = "row" === t || "row-reverse" === t,
                        o = e.mainAxis;
                    if (o) {
                        i && "inline" === o || !i && "block" === o || (e.flexStyle = {
                            main: e.flexStyle.cross,
                            cross: e.flexStyle.main,
                            mainOffset: e.flexStyle.crossOffset,
                            crossOffset: e.flexStyle.mainOffset,
                            mainBefore: e.flexStyle.crossBefore,
                            mainAfter: e.flexStyle.crossAfter,
                            crossBefore: e.flexStyle.mainBefore,
                            crossAfter: e.flexStyle.mainAfter,
                            mainInnerBefore: e.flexStyle.crossInnerBefore,
                            mainInnerAfter: e.flexStyle.crossInnerAfter,
                            crossInnerBefore: e.flexStyle.mainInnerBefore,
                            crossInnerAfter: e.flexStyle.mainInnerAfter,
                            mainBorderBefore: e.flexStyle.crossBorderBefore,
                            mainBorderAfter: e.flexStyle.crossBorderAfter,
                            crossBorderBefore: e.flexStyle.mainBorderBefore,
                            crossBorderAfter: e.flexStyle.mainBorderAfter
                        })
                    } else e.flexStyle = i ? {
                        main: e.style.width,
                        cross: e.style.height,
                        mainOffset: e.style.offsetWidth,
                        crossOffset: e.style.offsetHeight,
                        mainBefore: e.style.marginLeft,
                        mainAfter: e.style.marginRight,
                        crossBefore: e.style.marginTop,
                        crossAfter: e.style.marginBottom,
                        mainInnerBefore: e.style.paddingLeft,
                        mainInnerAfter: e.style.paddingRight,
                        crossInnerBefore: e.style.paddingTop,
                        crossInnerAfter: e.style.paddingBottom,
                        mainBorderBefore: e.style.borderLeftWidth,
                        mainBorderAfter: e.style.borderRightWidth,
                        crossBorderBefore: e.style.borderTopWidth,
                        crossBorderAfter: e.style.borderBottomWidth
                    } : {
                        main: e.style.height,
                        cross: e.style.width,
                        mainOffset: e.style.offsetHeight,
                        crossOffset: e.style.offsetWidth,
                        mainBefore: e.style.marginTop,
                        mainAfter: e.style.marginBottom,
                        crossBefore: e.style.marginLeft,
                        crossAfter: e.style.marginRight,
                        mainInnerBefore: e.style.paddingTop,
                        mainInnerAfter: e.style.paddingBottom,
                        crossInnerBefore: e.style.paddingLeft,
                        crossInnerAfter: e.style.paddingRight,
                        mainBorderBefore: e.style.borderTopWidth,
                        mainBorderAfter: e.style.borderBottomWidth,
                        crossBorderBefore: e.style.borderLeftWidth,
                        crossBorderAfter: e.style.borderRightWidth
                    }, "content-box" === e.style.boxSizing && ("number" == typeof e.flexStyle.main && (e.flexStyle.main += e.flexStyle.mainInnerBefore + e.flexStyle.mainInnerAfter + e.flexStyle.mainBorderBefore + e.flexStyle.mainBorderAfter), "number" == typeof e.flexStyle.cross && (e.flexStyle.cross += e.flexStyle.crossInnerBefore + e.flexStyle.crossInnerAfter + e.flexStyle.crossBorderBefore + e.flexStyle.crossBorderAfter));
                    e.mainAxis = i ? "inline" : "block", e.crossAxis = i ? "block" : "inline", "number" == typeof e.style.flexBasis && (e.flexStyle.main = e.style.flexBasis + e.flexStyle.mainInnerBefore + e.flexStyle.mainInnerAfter + e.flexStyle.mainBorderBefore + e.flexStyle.mainBorderAfter), e.flexStyle.mainOuter = e.flexStyle.main, e.flexStyle.crossOuter = e.flexStyle.cross, "auto" === e.flexStyle.mainOuter && (e.flexStyle.mainOuter = e.flexStyle.mainOffset), "auto" === e.flexStyle.crossOuter && (e.flexStyle.crossOuter = e.flexStyle.crossOffset), "number" == typeof e.flexStyle.mainBefore && (e.flexStyle.mainOuter += e.flexStyle.mainBefore), "number" == typeof e.flexStyle.mainAfter && (e.flexStyle.mainOuter += e.flexStyle.mainAfter), "number" == typeof e.flexStyle.crossBefore && (e.flexStyle.crossOuter += e.flexStyle.crossBefore), "number" == typeof e.flexStyle.crossAfter && (e.flexStyle.crossOuter += e.flexStyle.crossAfter)
                }
            }, {}],
            4: [function(e, t, i) {
                var o = e("../reduce");
                t.exports = function(e) {
                    if (e.mainSpace > 0) {
                        var t = o(e.children, function(e, t) {
                            return e + parseFloat(t.style.flexGrow)
                        }, 0);
                        t > 0 && (e.main = o(e.children, function(i, o) {
                            return "auto" === o.flexStyle.main ? o.flexStyle.main = o.flexStyle.mainOffset + parseFloat(o.style.flexGrow) / t * e.mainSpace : o.flexStyle.main += parseFloat(o.style.flexGrow) / t * e.mainSpace, o.flexStyle.mainOuter = o.flexStyle.main + o.flexStyle.mainBefore + o.flexStyle.mainAfter, i + o.flexStyle.mainOuter
                        }, 0), e.mainSpace = 0)
                    }
                }
            }, {
                "../reduce": 12
            }],
            5: [function(e, t, i) {
                var o = e("../reduce");
                t.exports = function(e) {
                    if (e.mainSpace < 0) {
                        var t = o(e.children, function(e, t) {
                            return e + parseFloat(t.style.flexShrink)
                        }, 0);
                        t > 0 && (e.main = o(e.children, function(i, o) {
                            return o.flexStyle.main += parseFloat(o.style.flexShrink) / t * e.mainSpace, o.flexStyle.mainOuter = o.flexStyle.main + o.flexStyle.mainBefore + o.flexStyle.mainAfter, i + o.flexStyle.mainOuter
                        }, 0), e.mainSpace = 0)
                    }
                }
            }, {
                "../reduce": 12
            }],
            6: [function(e, t, i) {
                var o = e("../reduce");
                t.exports = function(e) {
                    var t;
                    e.lines = [t = {
                        main: 0,
                        cross: 0,
                        children: []
                    }];
                    for (var i, n = -1; i = e.children[++n];) "nowrap" === e.style.flexWrap || 0 === t.children.length || "auto" === e.flexStyle.main || e.flexStyle.main - e.flexStyle.mainInnerBefore - e.flexStyle.mainInnerAfter - e.flexStyle.mainBorderBefore - e.flexStyle.mainBorderAfter >= t.main + i.flexStyle.mainOuter ? (t.main += i.flexStyle.mainOuter, t.cross = Math.max(t.cross, i.flexStyle.crossOuter)) : e.lines.push(t = {
                        main: i.flexStyle.mainOuter,
                        cross: i.flexStyle.crossOuter,
                        children: []
                    }), t.children.push(i);
                    e.flexStyle.mainLines = o(e.lines, function(e, t) {
                        return Math.max(e, t.main)
                    }, 0), e.flexStyle.crossLines = o(e.lines, function(e, t) {
                        return e + t.cross
                    }, 0), "auto" === e.flexStyle.main && (e.flexStyle.main = Math.max(e.flexStyle.mainOffset, e.flexStyle.mainLines + e.flexStyle.mainInnerBefore + e.flexStyle.mainInnerAfter + e.flexStyle.mainBorderBefore + e.flexStyle.mainBorderAfter)), "auto" === e.flexStyle.cross && (e.flexStyle.cross = Math.max(e.flexStyle.crossOffset, e.flexStyle.crossLines + e.flexStyle.crossInnerBefore + e.flexStyle.crossInnerAfter + e.flexStyle.crossBorderBefore + e.flexStyle.crossBorderAfter)), e.flexStyle.crossSpace = e.flexStyle.cross - e.flexStyle.crossInnerBefore - e.flexStyle.crossInnerAfter - e.flexStyle.crossBorderBefore - e.flexStyle.crossBorderAfter - e.flexStyle.crossLines, e.flexStyle.mainOuter = e.flexStyle.main + e.flexStyle.mainBefore + e.flexStyle.mainAfter, e.flexStyle.crossOuter = e.flexStyle.cross + e.flexStyle.crossBefore + e.flexStyle.crossAfter
                }
            }, {
                "../reduce": 12
            }],
            7: [function(e, t, i) {
                function o(t) {
                    for (var i, o = -1; i = t.children[++o];) e("./flex-direction")(i, t.style.flexDirection);
                    e("./flex-direction")(t, t.style.flexDirection), e("./order")(t), e("./flexbox-lines")(t), e("./align-content")(t), o = -1;
                    for (var n; n = t.lines[++o];) n.mainSpace = t.flexStyle.main - t.flexStyle.mainInnerBefore - t.flexStyle.mainInnerAfter - t.flexStyle.mainBorderBefore - t.flexStyle.mainBorderAfter - n.main, e("./flex-grow")(n), e("./flex-shrink")(n), e("./margin-main")(n), e("./margin-cross")(n), e("./justify-content")(n, t.style.justifyContent, t);
                    e("./align-items")(t)
                }
                t.exports = o
            }, {
                "./align-content": 1,
                "./align-items": 2,
                "./flex-direction": 3,
                "./flex-grow": 4,
                "./flex-shrink": 5,
                "./flexbox-lines": 6,
                "./justify-content": 8,
                "./margin-cross": 9,
                "./margin-main": 10,
                "./order": 11
            }],
            8: [function(e, t, i) {
                t.exports = function(e, t, i) {
                    var o, n, s, r = i.flexStyle.mainInnerBefore,
                        a = -1;
                    if ("flex-end" === t)
                        for (o = e.mainSpace, o += r; s = e.children[++a];) s.flexStyle.mainStart = o, o += s.flexStyle.mainOuter;
                    else if ("center" === t)
                        for (o = e.mainSpace / 2, o += r; s = e.children[++a];) s.flexStyle.mainStart = o, o += s.flexStyle.mainOuter;
                    else if ("space-between" === t)
                        for (n = e.mainSpace / (e.children.length - 1), o = 0, o += r; s = e.children[++a];) s.flexStyle.mainStart = o, o += s.flexStyle.mainOuter + n;
                    else if ("space-around" === t)
                        for (n = 2 * e.mainSpace / (2 * e.children.length), o = n / 2, o += r; s = e.children[++a];) s.flexStyle.mainStart = o, o += s.flexStyle.mainOuter + n;
                    else
                        for (o = 0, o += r; s = e.children[++a];) s.flexStyle.mainStart = o, o += s.flexStyle.mainOuter
                }
            }, {}],
            9: [function(e, t, i) {
                t.exports = function(e) {
                    for (var t, i = -1; t = e.children[++i];) {
                        var o = 0;
                        "auto" === t.flexStyle.crossBefore && ++o, "auto" === t.flexStyle.crossAfter && ++o;
                        var n = e.cross - t.flexStyle.crossOuter;
                        "auto" === t.flexStyle.crossBefore && (t.flexStyle.crossBefore = n / o), "auto" === t.flexStyle.crossAfter && (t.flexStyle.crossAfter = n / o), "auto" === t.flexStyle.cross ? t.flexStyle.crossOuter = t.flexStyle.crossOffset + t.flexStyle.crossBefore + t.flexStyle.crossAfter : t.flexStyle.crossOuter = t.flexStyle.cross + t.flexStyle.crossBefore + t.flexStyle.crossAfter
                    }
                }
            }, {}],
            10: [function(e, t, i) {
                t.exports = function(e) {
                    for (var t, i = 0, o = -1; t = e.children[++o];) "auto" === t.flexStyle.mainBefore && ++i, "auto" === t.flexStyle.mainAfter && ++i;
                    if (i > 0) {
                        for (o = -1; t = e.children[++o];) "auto" === t.flexStyle.mainBefore && (t.flexStyle.mainBefore = e.mainSpace / i), "auto" === t.flexStyle.mainAfter && (t.flexStyle.mainAfter = e.mainSpace / i), "auto" === t.flexStyle.main ? t.flexStyle.mainOuter = t.flexStyle.mainOffset + t.flexStyle.mainBefore + t.flexStyle.mainAfter : t.flexStyle.mainOuter = t.flexStyle.main + t.flexStyle.mainBefore + t.flexStyle.mainAfter;
                        e.mainSpace = 0
                    }
                }
            }, {}],
            11: [function(e, t, i) {
                var o = /^(column|row)-reverse$/;
                t.exports = function(e) {
                    e.children.sort(function(e, t) {
                        return e.style.order - t.style.order || e.index - t.index
                    }), o.test(e.style.flexDirection) && e.children.reverse()
                }
            }, {}],
            12: [function(e, t, i) {
                function o(e, t, i) {
                    for (var o = e.length, n = -1; ++n < o;) n in e && (i = t(i, e[n], n));
                    return i
                }
                t.exports = o
            }, {}],
            13: [function(e, t, i) {
                function o(e) {
                    a(r(e))
                }
                var n = e("./read"),
                    s = e("./write"),
                    r = e("./readAll"),
                    a = e("./writeAll");
                t.exports = o, t.exports.read = n, t.exports.write = s, t.exports.readAll = r, t.exports.writeAll = a
            }, {
                "./read": 15,
                "./readAll": 16,
                "./write": 17,
                "./writeAll": 18
            }],
            14: [function(e, t, i) {
                function o(e, t) {
                    var i = String(e).match(s);
                    if (!i) return e;
                    var o = i[1],
                        r = i[2];
                    return "px" === r ? 1 * o : "cm" === r ? .3937 * o * 96 : "in" === r ? 96 * o : "mm" === r ? .3937 * o * 96 / 10 : "pc" === r ? 12 * o * 96 / 72 : "pt" === r ? 96 * o / 72 : "rem" === r ? 16 * o : n(e, t)
                }

                function n(e, t) {
                    r.style.cssText = "border:none!important;clip:rect(0 0 0 0)!important;display:block!important;font-size:1em!important;height:0!important;margin:0!important;padding:0!important;position:relative!important;width:" + e + "!important", t.parentNode.insertBefore(r, t.nextSibling);
                    var i = r.offsetWidth;
                    return t.parentNode.removeChild(r), i
                }
                t.exports = o;
                var s = /^([-+]?\d*\.?\d+)(%|[a-z]+)$/,
                    r = document.createElement("div")
            }, {}],
            15: [function(e, t, i) {
                function o(e) {
                    var t = {
                        alignContent: "stretch",
                        alignItems: "stretch",
                        alignSelf: "auto",
                        borderBottomWidth: 0,
                        borderLeftWidth: 0,
                        borderRightWidth: 0,
                        borderTopWidth: 0,
                        boxSizing: "content-box",
                        display: "inline",
                        flexBasis: "auto",
                        flexDirection: "row",
                        flexGrow: 0,
                        flexShrink: 1,
                        flexWrap: "nowrap",
                        justifyContent: "flex-start",
                        height: "auto",
                        marginTop: 0,
                        marginRight: 0,
                        marginLeft: 0,
                        marginBottom: 0,
                        paddingTop: 0,
                        paddingRight: 0,
                        paddingLeft: 0,
                        paddingBottom: 0,
                        maxHeight: "none",
                        maxWidth: "none",
                        minHeight: 0,
                        minWidth: 0,
                        order: 0,
                        position: "static",
                        width: "auto"
                    };
                    if (e instanceof Element) {
                        var i = e.hasAttribute("data-style"),
                            o = i ? e.getAttribute("data-style") : e.getAttribute("style") || "";
                        i || e.setAttribute("data-style", o), r(t, window.getComputedStyle && getComputedStyle(e) || {}), n(t, e.currentStyle || {}), s(t, o);
                        for (var a in t) t[a] = l(t[a], e);
                        var d = e.getBoundingClientRect();
                        t.offsetHeight = d.height || e.offsetHeight, t.offsetWidth = d.width || e.offsetWidth
                    }
                    return {
                        element: e,
                        style: t
                    }
                }

                function n(e, t) {
                    for (var i in e) {
                        if (i in t) e[i] = t[i];
                        else {
                            var o = i.replace(/[A-Z]/g, "-$&").toLowerCase();
                            o in t && (e[i] = t[o])
                        }
                    }
                    "-js-display" in t && (e.display = t["-js-display"])
                }

                function s(e, t) {
                    for (var i; i = a.exec(t);) {
                        e[i[1].toLowerCase().replace(/-[a-z]/g, function(e) {
                            return e.slice(1).toUpperCase()
                        })] = i[2]
                    }
                }

                function r(e, t) {
                    for (var i in e) {
                        i in t && !/^(alignSelf|height|width)$/.test(i) && (e[i] = t[i])
                    }
                }
                t.exports = o;
                var a = /([^\s:;]+)\s*:\s*([^;]+?)\s*(;|$)/g,
                    l = e("./getComputedLength")
            }, {
                "./getComputedLength": 14
            }],
            16: [function(e, t, i) {
                function o(e) {
                    var t = [];
                    return n(e, t), t
                }

                function n(e, t) {
                    for (var i, o = s(e), a = [], l = -1; i = e.childNodes[++l];) {
                        var d = 3 === i.nodeType && !/^\s*$/.test(i.nodeValue);
                        if (o && d) {
                            var c = i;
                            i = e.insertBefore(document.createElement("flex-item"), c), i.appendChild(c)
                        }
                        if (i instanceof Element) {
                            var u = n(i, t);
                            if (o) {
                                var f = i.style;
                                f.display = "inline-block", f.position = "absolute", u.style = r(i).style, a.push(u)
                            }
                        }
                    }
                    var p = {
                        element: e,
                        children: a
                    };
                    return o && (p.style = r(e).style, t.push(p)), p
                }

                function s(e) {
                    var t = e instanceof Element,
                        i = t && e.getAttribute("data-style"),
                        o = t && e.currentStyle && e.currentStyle["-js-display"];
                    return a.test(i) || l.test(o)
                }
                t.exports = o;
                var r = e("../read"),
                    a = /(^|;)\s*display\s*:\s*(inline-)?flex\s*(;|$)/i,
                    l = /^(inline-)?flex$/i
            }, {
                "../read": 15
            }],
            17: [function(e, t, i) {
                function o(e) {
                    s(e);
                    var t = e.element.style,
                        i = "inline" === e.mainAxis ? ["main", "cross"] : ["cross", "main"];
                    t.boxSizing = "content-box", t.display = "block", t.position = "relative", t.width = n(e.flexStyle[i[0]] - e.flexStyle[i[0] + "InnerBefore"] - e.flexStyle[i[0] + "InnerAfter"] - e.flexStyle[i[0] + "BorderBefore"] - e.flexStyle[i[0] + "BorderAfter"]), t.height = n(e.flexStyle[i[1]] - e.flexStyle[i[1] + "InnerBefore"] - e.flexStyle[i[1] + "InnerAfter"] - e.flexStyle[i[1] + "BorderBefore"] - e.flexStyle[i[1] + "BorderAfter"]);
                    for (var o, r = -1; o = e.children[++r];) {
                        var a = o.element.style,
                            l = "inline" === o.mainAxis ? ["main", "cross"] : ["cross", "main"];
                        a.boxSizing = "content-box", a.display = "block", a.position = "absolute", "auto" !== o.flexStyle[l[0]] && (a.width = n(o.flexStyle[l[0]] - o.flexStyle[l[0] + "InnerBefore"] - o.flexStyle[l[0] + "InnerAfter"] - o.flexStyle[l[0] + "BorderBefore"] - o.flexStyle[l[0] + "BorderAfter"])), "auto" !== o.flexStyle[l[1]] && (a.height = n(o.flexStyle[l[1]] - o.flexStyle[l[1] + "InnerBefore"] - o.flexStyle[l[1] + "InnerAfter"] - o.flexStyle[l[1] + "BorderBefore"] - o.flexStyle[l[1] + "BorderAfter"])), a.top = n(o.flexStyle[l[1] + "Start"]), a.left = n(o.flexStyle[l[0] + "Start"]), a.marginTop = n(o.flexStyle[l[1] + "Before"]), a.marginRight = n(o.flexStyle[l[0] + "After"]), a.marginBottom = n(o.flexStyle[l[1] + "After"]), a.marginLeft = n(o.flexStyle[l[0] + "Before"])
                    }
                }

                function n(e) {
                    return "string" == typeof e ? e : Math.max(e, 0) + "px"
                }
                t.exports = o;
                var s = e("../flexbox")
            }, {
                "../flexbox": 7
            }],
            18: [function(e, t, i) {
                function o(e) {
                    for (var t, i = -1; t = e[++i];) n(t)
                }
                t.exports = o;
                var n = e("../write")
            }, {
                "../write": 17
            }]
        }, {}, [13])(13)
    })
}, function(e, t, i) {
    "use strict";
    (function(i) {
        function o(e) {
            var t = !1;
            return function() {
                t || (t = !0, window.Promise.resolve().then(function() {
                    t = !1, e()
                }))
            }
        }

        function n(e) {
            var t = !1;
            return function() {
                t || (t = !0, setTimeout(function() {
                    t = !1, e()
                }, pe))
            }
        }

        function s(e) {
            var t = {};
            return e && "[object Function]" === t.toString.call(e)
        }

        function r(e, t) {
            if (1 !== e.nodeType) return [];
            var i = e.ownerDocument.defaultView,
                o = i.getComputedStyle(e, null);
            return t ? o[t] : o
        }

        function a(e) {
            return "HTML" === e.nodeName ? e : e.parentNode || e.host
        }

        function l(e) {
            for (var t = !0; t;) {
                var i = e;
                if (t = !1, !i) return document.body;
                switch (i.nodeName) {
                    case "HTML":
                    case "BODY":
                        return i.ownerDocument.body;
                    case "#document":
                        return i.body
                }
                var o = r(i),
                    n = o.overflow,
                    s = o.overflowX,
                    l = o.overflowY;
                if (/(auto|scroll|overlay)/.test(n + l + s)) return i;
                e = a(i), t = !0, o = n = s = l = void 0
            }
        }

        function d(e) {
            return e && e.referenceNode ? e.referenceNode : e
        }

        function c(e) {
            return 11 === e ? ge : 10 === e ? ve : ge || ve
        }

        function u(e) {
            for (var t = !0; t;) {
                var i = e;
                if (t = !1, !i) return document.documentElement;
                for (var o = c(10) ? document.body : null, n = i.offsetParent || null; n === o && i.nextElementSibling;) n = (i = i.nextElementSibling).offsetParent;
                var s = n && n.nodeName;
                if (!s || "BODY" === s || "HTML" === s) return i ? i.ownerDocument.documentElement : document.documentElement;
                if (-1 === ["TH", "TD", "TABLE"].indexOf(n.nodeName) || "static" !== r(n, "position")) return n;
                e = n, t = !0, o = n = s = void 0
            }
        }

        function f(e) {
            var t = e.nodeName;
            return "BODY" !== t && ("HTML" === t || u(e.firstElementChild) === e)
        }

        function p(e) {
            for (var t = !0; t;) {
                var i = e;
                t = !1; {
                    if (null === i.parentNode) return i;
                    e = i.parentNode, t = !0
                }
            }
        }

        function h(e, t) {
            for (var i = !0; i;) {
                var o = e,
                    n = t;
                if (i = !1, !(o && o.nodeType && n && n.nodeType)) return document.documentElement;
                var s = o.compareDocumentPosition(n) & Node.DOCUMENT_POSITION_FOLLOWING,
                    r = s ? o : n,
                    a = s ? n : o,
                    l = document.createRange();
                l.setStart(r, 0), l.setEnd(a, 0);
                var d = l.commonAncestorContainer;
                if (o !== d && n !== d || r.contains(a)) return f(d) ? d : u(d);
                var c = p(o);
                c.host ? (e = c.host, t = n, i = !0, s = r = a = l = d = c = void 0) : (e = o, t = p(n).host, i = !0, s = r = a = l = d = c = void 0)
            }
        }

        function m(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] ? arguments[1] : "top",
                i = "top" === t ? "scrollTop" : "scrollLeft",
                o = e.nodeName;
            if ("BODY" === o || "HTML" === o) {
                var n = e.ownerDocument.documentElement;
                return (e.ownerDocument.scrollingElement || n)[i]
            }
            return e[i]
        }

        function g(e, t) {
            var i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
                o = m(t, "top"),
                n = m(t, "left"),
                s = i ? -1 : 1;
            return e.top += o * s, e.bottom += o * s, e.left += n * s, e.right += n * s, e
        }

        function v(e, t) {
            var i = "x" === t ? "Left" : "Top",
                o = "Left" === i ? "Right" : "Bottom";
            return parseFloat(e["border" + i + "Width"], 10) + parseFloat(e["border" + o + "Width"], 10)
        }

        function y(e, t, i, o) {
            return Math.max(t["offset" + e], t["scroll" + e], i["client" + e], i["offset" + e], i["scroll" + e], c(10) ? parseInt(i["offset" + e]) + parseInt(o["margin" + ("Height" === e ? "Top" : "Left")]) + parseInt(o["margin" + ("Height" === e ? "Bottom" : "Right")]) : 0)
        }

        function w(e) {
            var t = e.body,
                i = e.documentElement,
                o = c(10) && getComputedStyle(i);
            return {
                height: y("Height", t, i, o),
                width: y("Width", t, i, o)
            }
        }

        function b(e) {
            return Se({}, e, {
                right: e.left + e.width,
                bottom: e.top + e.height
            })
        }

        function S(e) {
            var t = {};
            try {
                if (c(10)) {
                    t = e.getBoundingClientRect();
                    var i = m(e, "top"),
                        o = m(e, "left");
                    t.top += i, t.left += o, t.bottom += i, t.right += o
                } else t = e.getBoundingClientRect()
            } catch (e) {}
            var n = {
                    left: t.left,
                    top: t.top,
                    width: t.right - t.left,
                    height: t.bottom - t.top
                },
                s = "HTML" === e.nodeName ? w(e.ownerDocument) : {},
                a = s.width || e.clientWidth || n.width,
                l = s.height || e.clientHeight || n.height,
                d = e.offsetWidth - a,
                u = e.offsetHeight - l;
            if (d || u) {
                var f = r(e);
                d -= v(f, "x"), u -= v(f, "y"), n.width -= d, n.height -= u
            }
            return b(n)
        }

        function x(e, t) {
            var i = arguments.length > 2 && void 0 !== arguments[2] && arguments[2],
                o = c(10),
                n = "HTML" === t.nodeName,
                s = S(e),
                a = S(t),
                d = l(e),
                u = r(t),
                f = parseFloat(u.borderTopWidth, 10),
                p = parseFloat(u.borderLeftWidth, 10);
            i && n && (a.top = Math.max(a.top, 0), a.left = Math.max(a.left, 0));
            var h = b({
                top: s.top - a.top - f,
                left: s.left - a.left - p,
                width: s.width,
                height: s.height
            });
            if (h.marginTop = 0, h.marginLeft = 0, !o && n) {
                var m = parseFloat(u.marginTop, 10),
                    v = parseFloat(u.marginLeft, 10);
                h.top -= f - m, h.bottom -= f - m, h.left -= p - v, h.right -= p - v, h.marginTop = m, h.marginLeft = v
            }
            return (o && !i ? t.contains(d) : t === d && "BODY" !== d.nodeName) && (h = g(h, t)), h
        }

        function T(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                i = e.ownerDocument.documentElement,
                o = x(e, i),
                n = Math.max(i.clientWidth, window.innerWidth || 0),
                s = Math.max(i.clientHeight, window.innerHeight || 0),
                r = t ? 0 : m(i),
                a = t ? 0 : m(i, "left");
            return b({
                top: r - o.top + o.marginTop,
                left: a - o.left + o.marginLeft,
                width: n,
                height: s
            })
        }

        function _(e) {
            for (var t = !0; t;) {
                var i = e;
                t = !1;
                var o = i.nodeName;
                if ("BODY" === o || "HTML" === o) return !1;
                if ("fixed" === r(i, "position")) return !0;
                var n = a(i);
                if (!n) return !1;
                e = n, t = !0, o = n = void 0
            }
        }

        function k(e) {
            if (!e || !e.parentElement || c()) return document.documentElement;
            for (var t = e.parentElement; t && "none" === r(t, "transform");) t = t.parentElement;
            return t || document.documentElement
        }

        function z(e, t, i, o) {
            var n = arguments.length > 4 && void 0 !== arguments[4] && arguments[4],
                s = {
                    top: 0,
                    left: 0
                },
                r = n ? k(e) : h(e, d(t));
            if ("viewport" === o) s = T(r, n);
            else {
                var c = void 0;
                "scrollParent" === o ? (c = l(a(t)), "BODY" === c.nodeName && (c = e.ownerDocument.documentElement)) : c = "window" === o ? e.ownerDocument.documentElement : o;
                var u = x(c, r, n);
                if ("HTML" !== c.nodeName || _(r)) s = u;
                else {
                    var f = w(e.ownerDocument),
                        p = f.height,
                        m = f.width;
                    s.top += u.top - u.marginTop, s.bottom = p + u.top, s.left += u.left - u.marginLeft, s.right = m + u.left
                }
            }
            i = i || 0;
            var g = "number" == typeof i;
            return s.left += g ? i : i.left || 0, s.top += g ? i : i.top || 0, s.right -= g ? i : i.right || 0, s.bottom -= g ? i : i.bottom || 0, s
        }

        function C(e) {
            return e.width * e.height
        }

        function E(e, t, i, o, n) {
            var s = arguments.length > 5 && void 0 !== arguments[5] ? arguments[5] : 0;
            if (-1 === e.indexOf("auto")) return e;
            var r = z(i, o, s, n),
                a = {
                    top: {
                        width: r.width,
                        height: t.top - r.top
                    },
                    right: {
                        width: r.right - t.right,
                        height: r.height
                    },
                    bottom: {
                        width: r.width,
                        height: r.bottom - t.bottom
                    },
                    left: {
                        width: t.left - r.left,
                        height: r.height
                    }
                },
                l = Object.keys(a).map(function(e) {
                    return Se({
                        key: e
                    }, a[e], {
                        area: C(a[e])
                    })
                }).sort(function(e, t) {
                    return t.area - e.area
                }),
                d = l.filter(function(e) {
                    var t = e.width,
                        o = e.height;
                    return t >= i.clientWidth && o >= i.clientHeight
                }),
                c = d.length > 0 ? d[0].key : l[0].key,
                u = e.split("-")[1];
            return c + (u ? "-" + u : "")
        }

        function O(e, t, i) {
            var o = arguments.length > 3 && void 0 !== arguments[3] ? arguments[3] : null;
            return x(i, o ? k(t) : h(t, d(i)), o)
        }

        function A(e) {
            var t = e.ownerDocument.defaultView,
                i = t.getComputedStyle(e),
                o = parseFloat(i.marginTop || 0) + parseFloat(i.marginBottom || 0),
                n = parseFloat(i.marginLeft || 0) + parseFloat(i.marginRight || 0);
            return {
                width: e.offsetWidth + n,
                height: e.offsetHeight + o
            }
        }

        function L(e) {
            var t = {
                left: "right",
                right: "left",
                bottom: "top",
                top: "bottom"
            };
            return e.replace(/left|right|bottom|top/g, function(e) {
                return t[e]
            })
        }

        function W(e, t, i) {
            i = i.split("-")[0];
            var o = A(e),
                n = {
                    width: o.width,
                    height: o.height
                },
                s = -1 !== ["right", "left"].indexOf(i),
                r = s ? "top" : "left",
                a = s ? "left" : "top",
                l = s ? "height" : "width",
                d = s ? "width" : "height";
            return n[r] = t[r] + t[l] / 2 - o[l] / 2, n[a] = i === a ? t[a] - o[d] : t[L(a)], n
        }

        function P(e, t) {
            return Array.prototype.find ? e.find(t) : e.filter(t)[0]
        }

        function $(e, t, i) {
            if (Array.prototype.findIndex) return e.findIndex(function(e) {
                return e[t] === i
            });
            var o = P(e, function(e) {
                return e[t] === i
            });
            return e.indexOf(o)
        }

        function I(e, t, i) {
            return (void 0 === i ? e : e.slice(0, $(e, "name", i))).forEach(function(e) {
                e.function;
                var i = e.function || e.fn;
                e.enabled && s(i) && (t.offsets.popper = b(t.offsets.popper), t.offsets.reference = b(t.offsets.reference), t = i(t, e))
            }), t
        }

        function H() {
            if (!this.state.isDestroyed) {
                var e = {
                    instance: this,
                    styles: {},
                    arrowStyles: {},
                    attributes: {},
                    flipped: !1,
                    offsets: {}
                };
                e.offsets.reference = O(this.state, this.popper, this.reference, this.options.positionFixed), e.placement = E(this.options.placement, e.offsets.reference, this.popper, this.reference, this.options.modifiers.flip.boundariesElement, this.options.modifiers.flip.padding), e.originalPlacement = e.placement, e.positionFixed = this.options.positionFixed, e.offsets.popper = W(this.popper, e.offsets.reference, e.placement), e.offsets.popper.position = this.options.positionFixed ? "fixed" : "absolute", e = I(this.modifiers, e), this.state.isCreated ? this.options.onUpdate(e) : (this.state.isCreated = !0, this.options.onCreate(e))
            }
        }

        function N(e, t) {
            return e.some(function(e) {
                var i = e.name;
                return e.enabled && i === t
            })
        }

        function j(e) {
            for (var t = [!1, "ms", "Webkit", "Moz", "O"], i = e.charAt(0).toUpperCase() + e.slice(1), o = 0; o < t.length; o++) {
                var n = t[o],
                    s = n ? "" + n + i : e;
                if (void 0 !== document.body.style[s]) return s
            }
            return null
        }

        function D() {
            return this.state.isDestroyed = !0, N(this.modifiers, "applyStyle") && (this.popper.removeAttribute("x-placement"), this.popper.style.position = "", this.popper.style.top = "", this.popper.style.left = "", this.popper.style.right = "", this.popper.style.bottom = "", this.popper.style.willChange = "", this.popper.style[j("transform")] = ""), this.disableEventListeners(), this.options.removeOnDestroy && this.popper.parentNode.removeChild(this.popper), this
        }

        function F(e) {
            var t = e.ownerDocument;
            return t ? t.defaultView : window
        }

        function B(e, t, i, o) {
            var n = "BODY" === e.nodeName,
                s = n ? e.ownerDocument.defaultView : e;
            s.addEventListener(t, i, {
                passive: !0
            }), n || B(l(s.parentNode), t, i, o), o.push(s)
        }

        function R(e, t, i, o) {
            i.updateBound = o, F(e).addEventListener("resize", i.updateBound, {
                passive: !0
            });
            var n = l(e);
            return B(n, "scroll", i.updateBound, i.scrollParents), i.scrollElement = n, i.eventsEnabled = !0, i
        }

        function M() {
            this.state.eventsEnabled || (this.state = R(this.reference, this.options, this.state, this.scheduleUpdate))
        }

        function V(e, t) {
            return F(e).removeEventListener("resize", t.updateBound), t.scrollParents.forEach(function(e) {
                e.removeEventListener("scroll", t.updateBound)
            }), t.updateBound = null, t.scrollParents = [], t.scrollElement = null, t.eventsEnabled = !1, t
        }

        function q() {
            this.state.eventsEnabled && (cancelAnimationFrame(this.scheduleUpdate), this.state = V(this.reference, this.state))
        }

        function U(e) {
            return "" !== e && !isNaN(parseFloat(e)) && isFinite(e)
        }

        function Y(e, t) {
            Object.keys(t).forEach(function(i) {
                var o = ""; - 1 !== ["width", "height", "top", "right", "bottom", "left"].indexOf(i) && U(t[i]) && (o = "px"), e.style[i] = t[i] + o
            })
        }

        function Q(e, t) {
            Object.keys(t).forEach(function(i) {
                !1 !== t[i] ? e.setAttribute(i, t[i]) : e.removeAttribute(i)
            })
        }

        function X(e) {
            return Y(e.instance.popper, e.styles), Q(e.instance.popper, e.attributes), e.arrowElement && Object.keys(e.arrowStyles).length && Y(e.arrowElement, e.arrowStyles), e
        }

        function Z(e, t, i, o, n) {
            var s = O(n, t, e, i.positionFixed),
                r = E(i.placement, s, t, e, i.modifiers.flip.boundariesElement, i.modifiers.flip.padding);
            return t.setAttribute("x-placement", r), Y(t, {
                position: i.positionFixed ? "fixed" : "absolute"
            }), i
        }

        function G(e, t) {
            var i = e.offsets,
                o = i.popper,
                n = i.reference,
                s = Math.round,
                r = Math.floor,
                a = function(e) {
                    return e
                },
                l = s(n.width),
                d = s(o.width),
                c = -1 !== ["left", "right"].indexOf(e.placement),
                u = -1 !== e.placement.indexOf("-"),
                f = l % 2 == d % 2,
                p = l % 2 == 1 && d % 2 == 1,
                h = t ? c || u || f ? s : r : a,
                m = t ? s : a;
            return {
                left: h(p && !u && t ? o.left - 1 : o.left),
                top: m(o.top),
                bottom: m(o.bottom),
                right: h(o.right)
            }
        }

        function K(e, t) {
            var i = t.x,
                o = t.y,
                n = e.offsets.popper,
                s = P(e.instance.modifiers, function(e) {
                    return "applyStyle" === e.name
                }).gpuAcceleration,
                r = void 0 !== s ? s : t.gpuAcceleration,
                a = u(e.instance.popper),
                l = S(a),
                d = {
                    position: n.position
                },
                c = G(e, window.devicePixelRatio < 2 || !xe),
                f = "bottom" === i ? "top" : "bottom",
                p = "right" === o ? "left" : "right",
                h = j("transform"),
                m = void 0,
                g = void 0;
            if (g = "bottom" === f ? "HTML" === a.nodeName ? -a.clientHeight + c.bottom : -l.height + c.bottom : c.top, m = "right" === p ? "HTML" === a.nodeName ? -a.clientWidth + c.right : -l.width + c.right : c.left, r && h) d[h] = "translate3d(" + m + "px, " + g + "px, 0)", d[f] = 0, d[p] = 0, d.willChange = "transform";
            else {
                var v = "bottom" === f ? -1 : 1,
                    y = "right" === p ? -1 : 1;
                d[f] = g * v, d[p] = m * y, d.willChange = f + ", " + p
            }
            var w = {
                "x-placement": e.placement
            };
            return e.attributes = Se({}, w, e.attributes), e.styles = Se({}, d, e.styles), e.arrowStyles = Se({}, e.offsets.arrow, e.arrowStyles), e
        }

        function J(e, t, i) {
            var o = P(e, function(e) {
                    return e.name === t
                }),
                n = !!o && e.some(function(e) {
                    return e.name === i && e.enabled && e.order < o.order
                });
            if (!n);
            return n
        }

        function ee(e, t) {
            var i;
            if (!J(e.instance.modifiers, "arrow", "keepTogether")) return e;
            var o = t.element;
            if ("string" == typeof o) {
                if (!(o = e.instance.popper.querySelector(o))) return e
            } else if (!e.instance.popper.contains(o)) return e;
            var n = e.placement.split("-")[0],
                s = e.offsets,
                a = s.popper,
                l = s.reference,
                d = -1 !== ["left", "right"].indexOf(n),
                c = d ? "height" : "width",
                u = d ? "Top" : "Left",
                f = u.toLowerCase(),
                p = d ? "left" : "top",
                h = d ? "bottom" : "right",
                m = A(o)[c];
            l[h] - m < a[f] && (e.offsets.popper[f] -= a[f] - (l[h] - m)), l[f] + m > a[h] && (e.offsets.popper[f] += l[f] + m - a[h]), e.offsets.popper = b(e.offsets.popper);
            var g = l[f] + l[c] / 2 - m / 2,
                v = r(e.instance.popper),
                y = parseFloat(v["margin" + u], 10),
                w = parseFloat(v["border" + u + "Width"], 10),
                S = g - e.offsets.popper[f] - y - w;
            return S = Math.max(Math.min(a[c] - m, S), 0), e.arrowElement = o, e.offsets.arrow = (i = {}, be(i, f, Math.round(S)), be(i, p, ""), i), e
        }

        function te(e) {
            return "end" === e ? "start" : "start" === e ? "end" : e
        }

        function ie(e) {
            var t = arguments.length > 1 && void 0 !== arguments[1] && arguments[1],
                i = _e.indexOf(e),
                o = _e.slice(i + 1).concat(_e.slice(0, i));
            return t ? o.reverse() : o
        }

        function oe(e, t) {
            if (N(e.instance.modifiers, "inner")) return e;
            if (e.flipped && e.placement === e.originalPlacement) return e;
            var i = z(e.instance.popper, e.instance.reference, t.padding, t.boundariesElement, e.positionFixed),
                o = e.placement.split("-")[0],
                n = L(o),
                s = e.placement.split("-")[1] || "",
                r = [];
            switch (t.behavior) {
                case ke.FLIP:
                    r = [o, n];
                    break;
                case ke.CLOCKWISE:
                    r = ie(o);
                    break;
                case ke.COUNTERCLOCKWISE:
                    r = ie(o, !0);
                    break;
                default:
                    r = t.behavior
            }
            return r.forEach(function(a, l) {
                if (o !== a || r.length === l + 1) return e;
                o = e.placement.split("-")[0], n = L(o);
                var d = e.offsets.popper,
                    c = e.offsets.reference,
                    u = Math.floor,
                    f = "left" === o && u(d.right) > u(c.left) || "right" === o && u(d.left) < u(c.right) || "top" === o && u(d.bottom) > u(c.top) || "bottom" === o && u(d.top) < u(c.bottom),
                    p = u(d.left) < u(i.left),
                    h = u(d.right) > u(i.right),
                    m = u(d.top) < u(i.top),
                    g = u(d.bottom) > u(i.bottom),
                    v = "left" === o && p || "right" === o && h || "top" === o && m || "bottom" === o && g,
                    y = -1 !== ["top", "bottom"].indexOf(o),
                    w = !!t.flipVariations && (y && "start" === s && p || y && "end" === s && h || !y && "start" === s && m || !y && "end" === s && g),
                    b = !!t.flipVariationsByContent && (y && "start" === s && h || y && "end" === s && p || !y && "start" === s && g || !y && "end" === s && m),
                    S = w || b;
                (f || v || S) && (e.flipped = !0, (f || v) && (o = r[l + 1]), S && (s = te(s)), e.placement = o + (s ? "-" + s : ""), e.offsets.popper = Se({}, e.offsets.popper, W(e.instance.popper, e.offsets.reference, e.placement)), e = I(e.instance.modifiers, e, "flip"))
            }), e
        }

        function ne(e) {
            var t = e.offsets,
                i = t.popper,
                o = t.reference,
                n = e.placement.split("-")[0],
                s = Math.floor,
                r = -1 !== ["top", "bottom"].indexOf(n),
                a = r ? "right" : "bottom",
                l = r ? "left" : "top",
                d = r ? "width" : "height";
            return i[a] < s(o[l]) && (e.offsets.popper[l] = s(o[l]) - i[d]), i[l] > s(o[a]) && (e.offsets.popper[l] = s(o[a])), e
        }

        function se(e, t, i, o) {
            var n = e.match(/((?:\-|\+)?\d*\.?\d*)(.*)/),
                s = +n[1],
                r = n[2];
            if (!s) return e;
            if (0 === r.indexOf("%")) {
                var a = void 0;
                switch (r) {
                    case "%p":
                        a = i;
                        break;
                    case "%":
                    case "%r":
                    default:
                        a = o
                }
                return b(a)[t] / 100 * s
            }
            if ("vh" === r || "vw" === r) {
                return ("vh" === r ? Math.max(document.documentElement.clientHeight, window.innerHeight || 0) : Math.max(document.documentElement.clientWidth, window.innerWidth || 0)) / 100 * s
            }
            return s
        }

        function re(e, t, i, o) {
            var n = [0, 0],
                s = -1 !== ["right", "left"].indexOf(o),
                r = e.split(/(\+|\-)/).map(function(e) {
                    return e.trim()
                }),
                a = r.indexOf(P(r, function(e) {
                    return -1 !== e.search(/,|\s/)
                }));
            r[a] && r[a].indexOf(",");
            var l = /\s*,\s*|\s+/,
                d = -1 !== a ? [r.slice(0, a).concat([r[a].split(l)[0]]), [r[a].split(l)[1]].concat(r.slice(a + 1))] : [r];
            return d = d.map(function(e, o) {
                var n = (1 === o ? !s : s) ? "height" : "width",
                    r = !1;
                return e.reduce(function(e, t) {
                    return "" === e[e.length - 1] && -1 !== ["+", "-"].indexOf(t) ? (e[e.length - 1] = t, r = !0, e) : r ? (e[e.length - 1] += t, r = !1, e) : e.concat(t)
                }, []).map(function(e) {
                    return se(e, n, t, i)
                })
            }), d.forEach(function(e, t) {
                e.forEach(function(i, o) {
                    U(i) && (n[t] += i * ("-" === e[o - 1] ? -1 : 1))
                })
            }), n
        }

        function ae(e, t) {
            var i = t.offset,
                o = e.placement,
                n = e.offsets,
                s = n.popper,
                r = n.reference,
                a = o.split("-")[0],
                l = void 0;
            return l = U(+i) ? [+i, 0] : re(i, s, r, a), "left" === a ? (s.top += l[0], s.left -= l[1]) : "right" === a ? (s.top += l[0], s.left += l[1]) : "top" === a ? (s.left += l[0], s.top -= l[1]) : "bottom" === a && (s.left += l[0], s.top += l[1]), e.popper = s, e
        }

        function le(e, t) {
            var i = t.boundariesElement || u(e.instance.popper);
            e.instance.reference === i && (i = u(i));
            var o = j("transform"),
                n = e.instance.popper.style,
                s = n.top,
                r = n.left,
                a = n[o];
            n.top = "", n.left = "", n[o] = "";
            var l = z(e.instance.popper, e.instance.reference, t.padding, i, e.positionFixed);
            n.top = s, n.left = r, n[o] = a, t.boundaries = l;
            var d = t.priority,
                c = e.offsets.popper,
                f = {
                    primary: function(e) {
                        var i = c[e];
                        return c[e] < l[e] && !t.escapeWithReference && (i = Math.max(c[e], l[e])), be({}, e, i)
                    },
                    secondary: function(e) {
                        var i = "right" === e ? "left" : "top",
                            o = c[i];
                        return c[e] > l[e] && !t.escapeWithReference && (o = Math.min(c[i], l[e] - ("right" === e ? c.width : c.height))), be({}, i, o)
                    }
                };
            return d.forEach(function(e) {
                var t = -1 !== ["left", "top"].indexOf(e) ? "primary" : "secondary";
                c = Se({}, c, f[t](e))
            }), e.offsets.popper = c, e
        }

        function de(e) {
            var t = e.placement,
                i = t.split("-")[0],
                o = t.split("-")[1];
            if (o) {
                var n = e.offsets,
                    s = n.reference,
                    r = n.popper,
                    a = -1 !== ["bottom", "top"].indexOf(i),
                    l = a ? "left" : "top",
                    d = a ? "width" : "height",
                    c = {
                        start: be({}, l, s[l]),
                        end: be({}, l, s[l] + s[d] - r[d])
                    };
                e.offsets.popper = Se({}, r, c[o])
            }
            return e
        }

        function ce(e) {
            if (!J(e.instance.modifiers, "hide", "preventOverflow")) return e;
            var t = e.offsets.reference,
                i = P(e.instance.modifiers, function(e) {
                    return "preventOverflow" === e.name
                }).boundaries;
            if (t.bottom < i.top || t.left > i.right || t.top > i.bottom || t.right < i.left) {
                if (!0 === e.hide) return e;
                e.hide = !0, e.attributes["x-out-of-boundaries"] = ""
            } else {
                if (!1 === e.hide) return e;
                e.hide = !1, e.attributes["x-out-of-boundaries"] = !1
            }
            return e
        }

        function ue(e) {
            var t = e.placement,
                i = t.split("-")[0],
                o = e.offsets,
                n = o.popper,
                s = o.reference,
                r = -1 !== ["left", "right"].indexOf(i),
                a = -1 === ["top", "left"].indexOf(i);
            return n[r ? "left" : "top"] = s[i] - (a ? n[r ? "width" : "height"] : 0), e.placement = L(t), e.offsets.popper = b(n), e
        }
        Object.defineProperty(t, "__esModule", {
            value: !0
        });
        var fe = "undefined" != typeof window && "undefined" != typeof document && "undefined" != typeof navigator,
            pe = function() {
                for (var e = ["Edge", "Trident", "Firefox"], t = 0; t < e.length; t += 1)
                    if (fe && navigator.userAgent.indexOf(e[t]) >= 0) return 1;
                return 0
            }(),
            he = fe && window.Promise,
            me = he ? o : n,
            ge = fe && !(!window.MSInputMethodContext || !document.documentMode),
            ve = fe && /MSIE 10/.test(navigator.userAgent),
            ye = function(e, t) {
                if (!(e instanceof t)) throw new TypeError("Cannot call a class as a function")
            },
            we = function() {
                function e(e, t) {
                    for (var i = 0; i < t.length; i++) {
                        var o = t[i];
                        o.enumerable = o.enumerable || !1, o.configurable = !0, "value" in o && (o.writable = !0), Object.defineProperty(e, o.key, o)
                    }
                }
                return function(t, i, o) {
                    return i && e(t.prototype, i), o && e(t, o), t
                }
            }(),
            be = function(e, t, i) {
                return t in e ? Object.defineProperty(e, t, {
                    value: i,
                    enumerable: !0,
                    configurable: !0,
                    writable: !0
                }) : e[t] = i, e
            },
            Se = Object.assign || function(e) {
                for (var t = 1; t < arguments.length; t++) {
                    var i = arguments[t];
                    for (var o in i) Object.prototype.hasOwnProperty.call(i, o) && (e[o] = i[o])
                }
                return e
            },
            xe = fe && /Firefox/i.test(navigator.userAgent),
            Te = ["auto-start", "auto", "auto-end", "top-start", "top", "top-end", "right-start", "right", "right-end", "bottom-end", "bottom", "bottom-start", "left-end", "left", "left-start"],
            _e = Te.slice(3),
            ke = {
                FLIP: "flip",
                CLOCKWISE: "clockwise",
                COUNTERCLOCKWISE: "counterclockwise"
            },
            ze = {
                shift: {
                    order: 100,
                    enabled: !0,
                    fn: de
                },
                offset: {
                    order: 200,
                    enabled: !0,
                    fn: ae,
                    offset: 0
                },
                preventOverflow: {
                    order: 300,
                    enabled: !0,
                    fn: le,
                    priority: ["left", "right", "top", "bottom"],
                    padding: 5,
                    boundariesElement: "scrollParent"
                },
                keepTogether: {
                    order: 400,
                    enabled: !0,
                    fn: ne
                },
                arrow: {
                    order: 500,
                    enabled: !0,
                    fn: ee,
                    element: "[x-arrow]"
                },
                flip: {
                    order: 600,
                    enabled: !0,
                    fn: oe,
                    behavior: "flip",
                    padding: 5,
                    boundariesElement: "viewport",
                    flipVariations: !1,
                    flipVariationsByContent: !1
                },
                inner: {
                    order: 700,
                    enabled: !1,
                    fn: ue
                },
                hide: {
                    order: 800,
                    enabled: !0,
                    fn: ce
                },
                computeStyle: {
                    order: 850,
                    enabled: !0,
                    fn: K,
                    gpuAcceleration: !0,
                    x: "bottom",
                    y: "right"
                },
                applyStyle: {
                    order: 900,
                    enabled: !0,
                    fn: X,
                    onLoad: Z,
                    gpuAcceleration: void 0
                }
            },
            Ce = {
                placement: "bottom",
                positionFixed: !1,
                eventsEnabled: !0,
                removeOnDestroy: !1,
                onCreate: function() {},
                onUpdate: function() {},
                modifiers: ze
            },
            Ee = function() {
                function e(t, i) {
                    var o = this,
                        n = arguments.length > 2 && void 0 !== arguments[2] ? arguments[2] : {};
                    ye(this, e), this.scheduleUpdate = function() {
                        return requestAnimationFrame(o.update)
                    }, this.update = me(this.update.bind(this)), this.options = Se({}, e.Defaults, n), this.state = {
                        isDestroyed: !1,
                        isCreated: !1,
                        scrollParents: []
                    }, this.reference = t && t.jquery ? t[0] : t, this.popper = i && i.jquery ? i[0] : i, this.options.modifiers = {}, Object.keys(Se({}, e.Defaults.modifiers, n.modifiers)).forEach(function(t) {
                        o.options.modifiers[t] = Se({}, e.Defaults.modifiers[t] || {}, n.modifiers ? n.modifiers[t] : {})
                    }), this.modifiers = Object.keys(this.options.modifiers).map(function(e) {
                        return Se({
                            name: e
                        }, o.options.modifiers[e])
                    }).sort(function(e, t) {
                        return e.order - t.order
                    }), this.modifiers.forEach(function(e) {
                        e.enabled && s(e.onLoad) && e.onLoad(o.reference, o.popper, o.options, e, o.state)
                    }), this.update();
                    var r = this.options.eventsEnabled;
                    r && this.enableEventListeners(), this.state.eventsEnabled = r
                }
                return we(e, [{
                    key: "update",
                    value: function() {
                        return H.call(this)
                    }
                }, {
                    key: "destroy",
                    value: function() {
                        return D.call(this)
                    }
                }, {
                    key: "enableEventListeners",
                    value: function() {
                        return M.call(this)
                    }
                }, {
                    key: "disableEventListeners",
                    value: function() {
                        return q.call(this)
                    }
                }]), e
            }();
        Ee.Utils = ("undefined" != typeof window ? window : i).PopperUtils, Ee.placements = Te, Ee.Defaults = Ce, t.default = Ee, e.exports = t.default
    }).call(t, i(25))
}, function(e, t, i) {
    "use strict";
    var o = i(24);
    e.exports = function(e, t, i) {
        return void 0 === i ? o(e, t, !1) : o(e, i, !1 !== t)
    }
}, function(e, t, i) {
    "use strict";
    e.exports = function(e, t, i, o) {
        function n() {
            function n() {
                r = Number(new Date), i.apply(l, c)
            }

            function a() {
                s = void 0
            }
            var l = this,
                d = Number(new Date) - r,
                c = arguments;
            o && !s && n(), s && clearTimeout(s), void 0 === o && d > e ? n() : !0 !== t && (s = setTimeout(o ? a : n, void 0 === o ? e - d : e))
        }
        var s, r = 0;
        return "boolean" != typeof t && (o = i, i = t, t = void 0), n
    }
}, function(e, t, i) {
    "use strict";
    var o;
    o = function() {
        return this
    }();
    try {
        o = o || Function("return this")() || (0, eval)("this")
    } catch (e) {
        "object" == typeof window && (o = window)
    }
    e.exports = o
}, function(e, t, i) {
    e.exports = i(3)
}]);