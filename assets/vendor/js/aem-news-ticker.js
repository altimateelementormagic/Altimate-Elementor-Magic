!(function (t, e) {
    "use strict";
    "object" == typeof module &&
        "object" == typeof module.exports &&
        (module.exports = t.document
            ? void 0
            : function (t) {
                  if (!t.document) throw new Error("jQuery requires a window with a document");
              });
})("undefined" != typeof window ? window : this),
    (function (t) {
        "use strict";
        (t.breakingNews = function (e, i) {
            var s = {
                    effect: "scroll",
                    direction: "ltr",
                    height: 40,
                    fontSize: "default",
                    themeColor: "default",
                    background: "default",
                    borderWidth: "",
                    radius: "",
                    source: "html",
                    rss2jsonApiKey: "",
                    play: !0,
                    delayTimer: 4e3,
                    scrollSpeed: 2,
                    stopOnHover: !0,
                    position: "auto",
                    zIndex: 99999,
                },
                n = this;
            n.settings = {};
            var r = t(e),
                o = ((e = e), r.children(".aem-bn-label")),
                a = r.children(".aem-nt-news"),
                l = a.children("ul"),
                c = l.children("li"),
                d = r.children(".aem-nt-controls"),
                f = d.find(".bn-prev").parent(),
                h = d.find(".bn-action").parent(),
                u = d.find(".bn-next").parent(),
                g = !1,
                p = !0,
                m = l.children("li").length,
                b = 0,
                y = !1,
                w = function () {
                    if ((0 < o.length && ("rtl" == n.settings.direction ? a.css({ right: o.outerWidth() }) : a.css({ left: o.outerWidth() })), 0 < d.length)) {
                        var e = d.outerWidth();
                        "rtl" == n.settings.direction ? a.css({ left: e }) : a.css({ right: e });
                    }
                    if ("scroll" === n.settings.effect) {
                        var i = 0;
                        c.each(function () {
                            i += t(this).outerWidth();
                        }),
                            (i += 10),
                            l.css({ width: i });
                    }
                },
                k = function () {
                    var t = parseFloat(l.css("marginLeft"));
                    (t -= n.settings.scrollSpeed / 2),
                        l.css({ marginLeft: t }),
                        t <= -l.find("li:first-child").outerWidth() && (l.find("li:first-child").insertAfter(l.find("li:last-child")), l.css({ marginLeft: 0 })),
                        !1 === g && ((window.requestAnimationFrame && requestAnimationFrame(k)) || setTimeout(k, 16));
                },
                v = function () {
                    var t = parseFloat(l.css("marginRight"));
                    (t -= n.settings.scrollSpeed / 2),
                        l.css({ marginRight: t }),
                        t <= -l.find("li:first-child").outerWidth() && (l.find("li:first-child").insertAfter(l.find("li:last-child")), l.css({ marginRight: 0 })),
                        !1 === g && ((window.requestAnimationFrame && requestAnimationFrame(v)) || setTimeout(v, 16));
                },
                q = function () {
                    switch (((p = !0), n.settings.effect)) {
                        case "typography":
                            l.find("li").hide(), l.find("li").eq(b).width(30).show(), l.find("li").eq(b).animate({ width: "100%", opacity: 1 }, 1500);
                            break;
                        case "fade":
                            l.find("li").hide(), l.find("li").eq(b).fadeIn();
                            break;
                        case "slide-down":
                            m <= 1
                                ? l.find("li").animate({ top: 30, opacity: 0 }, 300, function () {
                                      t(this).css({ top: -30, opacity: 0, display: "block" }), t(this).animate({ top: 0, opacity: 1 }, 300);
                                  })
                                : (l.find("li:visible").animate({ top: 30, opacity: 0 }, 300, function () {
                                      t(this).hide();
                                  }),
                                  l.find("li").eq(b).css({ top: -30, opacity: 0 }).show(),
                                  l.find("li").eq(b).animate({ top: 0, opacity: 1 }, 300));
                            break;
                        case "slide-up":
                            m <= 1
                                ? l.find("li").animate({ top: -30, opacity: 0 }, 300, function () {
                                      t(this).css({ top: 30, opacity: 0, display: "block" }), t(this).animate({ top: 0, opacity: 1 }, 300);
                                  })
                                : (l.find("li:visible").animate({ top: -30, opacity: 0 }, 300, function () {
                                      t(this).hide();
                                  }),
                                  l.find("li").eq(b).css({ top: 30, opacity: 0 }).show(),
                                  l.find("li").eq(b).animate({ top: 0, opacity: 1 }, 300));
                            break;
                        case "slide-left":
                            m <= 1
                                ? l.find("li").animate({ left: "50%", opacity: 0 }, 300, function () {
                                      t(this).css({ left: -50, opacity: 0, display: "block" }), t(this).animate({ left: 0, opacity: 1 }, 300);
                                  })
                                : (l.find("li:visible").animate({ left: "50%", opacity: 0 }, 300, function () {
                                      t(this).hide();
                                  }),
                                  l.find("li").eq(b).css({ left: -50, opacity: 0 }).show(),
                                  l.find("li").eq(b).animate({ left: 0, opacity: 1 }, 300));
                            break;
                        case "slide-right":
                            m <= 1
                                ? l.find("li").animate({ left: "-50%", opacity: 0 }, 300, function () {
                                      t(this).css({ left: "50%", opacity: 0, display: "block" }), t(this).animate({ left: 0, opacity: 1 }, 300);
                                  })
                                : (l.find("li:visible").animate({ left: "-50%", opacity: 0 }, 300, function () {
                                      t(this).hide();
                                  }),
                                  l.find("li").eq(b).css({ left: "50%", opacity: 0 }).show(),
                                  l.find("li").eq(b).animate({ left: 0, opacity: 1 }, 300));
                            break;
                        default:
                            l.find("li").hide(), l.find("li").eq(b).show();
                    }
                },
                x = function () {
                    if (((g = !1), n.settings.play))
                        switch (n.settings.effect) {
                            case "scroll":
                                "rtl" === n.settings.direction ? l.width() > a.width() && v() : l.width() > a.width() && k();
                                break;
                            default:
                                n.pause(),
                                    (y = setInterval(function () {
                                        n.next();
                                    }, n.settings.delayTimer));
                        }
                };
            (n.init = function () {
                if (
                    ((n.settings = t.extend({}, s, i)),
                    "fixed-top" === n.settings.position ? r.addClass("bn-fixed-top").css({ "z-index": n.settings.zIndex }) : "fixed-bottom" === n.settings.position && r.addClass("bn-fixed-bottom").css({ "z-index": n.settings.zIndex }),
                    "default" != n.settings.fontSize && r.css({ "font-size": n.settings.fontSize }),
                    "default" != n.settings.themeColor && (r.css({ "border-color": n.settings.themeColor, color: n.settings.themeColor }), o.css({ background: n.settings.themeColor })),
                    "default" != n.settings.background && r.css({ background: n.settings.background }),
                    r.css({ height: n.settings.height, "line-height": n.settings.height - 2 * n.settings.borderWidth + "px", "border-radius": n.settings.radius, "border-width": n.settings.borderWidth }),
                    c.find(".bn-seperator").css({ height: n.settings.height - 2 * n.settings.borderWidth }),
                    r.addClass("bn-effect-" + n.settings.effect + " bn-direction-" + n.settings.direction),
                    w(),
                    "object" == typeof n.settings.source)
                )
                    switch (n.settings.source.type) {
                        case "rss":
                            "rss2json" === n.settings.source.usingApi
                                ? (((d = new XMLHttpRequest()).onreadystatechange = function () {
                                      if (4 == d.readyState && 200 == d.status) {
                                          var t = JSON.parse(d.responseText),
                                              e = "",
                                              i = "";
                                          switch (n.settings.source.showingField) {
                                              case "title":
                                                  i = "title";
                                                  break;
                                              case "description":
                                                  i = "description";
                                                  break;
                                              case "link":
                                                  i = "link";
                                                  break;
                                              default:
                                                  i = "title";
                                          }
                                          var s = "";
                                          void 0 !== n.settings.source.seperator && void 0 !== typeof n.settings.source.seperator && (s = n.settings.source.seperator);
                                          for (var r = 0; r < t.items.length; r++)
                                              n.settings.source.linkEnabled
                                                  ? (e += '<li><a target="' + n.settings.source.target + '" href="' + t.items[r].link + '">' + s + t.items[r][i] + "</a></li>")
                                                  : (e += "<li><a>" + s + t.items[r][i] + "</a></li>");
                                          l.empty().append(e),
                                              (c = l.children("li")),
                                              (m = l.children("li").length),
                                              w(),
                                              "scroll" != n.settings.effect && q(),
                                              c.find(".bn-seperator").css({ height: n.settings.height - 2 * n.settings.borderWidth }),
                                              x();
                                      }
                                  }),
                                  d.open("GET", "https://api.rss2json.com/v1/api.json?rss_url=" + n.settings.source.url + "&count=" + n.settings.source.limit + "&api_key=" + n.settings.source.rss2jsonApiKey, !0),
                                  d.send())
                                : ((e = new XMLHttpRequest()).open(
                                      "GET",
                                      "https://query.yahooapis.com/v1/public/yql?q=" + encodeURIComponent('select * from rss where url="' + n.settings.source.url + '" limit ' + n.settings.source.limit) + "&format=json",
                                      !0
                                  ),
                                  (e.onreadystatechange = function () {
                                      if (4 == e.readyState)
                                          if (200 == e.status) {
                                              var t = JSON.parse(e.responseText),
                                                  i = "",
                                                  s = "";
                                              switch (n.settings.source.showingField) {
                                                  case "title":
                                                      s = "title";
                                                      break;
                                                  case "description":
                                                      s = "description";
                                                      break;
                                                  case "link":
                                                      s = "link";
                                                      break;
                                                  default:
                                                      s = "title";
                                              }
                                              var r = "";
                                              "undefined" != n.settings.source.seperator && void 0 !== n.settings.source.seperator && (r = n.settings.source.seperator);
                                              for (var o = 0; o < t.query.results.item.length; o++)
                                                  n.settings.source.linkEnabled
                                                      ? (i += '<li><a target="' + n.settings.source.target + '" href="' + t.query.results.item[o].link + '">' + r + t.query.results.item[o][s] + "</a></li>")
                                                      : (i += "<li><a>" + r + t.query.results.item[o][s] + "</a></li>");
                                              l.empty().append(i),
                                                  (c = l.children("li")),
                                                  (m = l.children("li").length),
                                                  w(),
                                                  "scroll" != n.settings.effect && q(),
                                                  c.find(".bn-seperator").css({ height: n.settings.height - 2 * n.settings.borderWidth }),
                                                  x();
                                          } else l.empty().append('<li><span class="bn-loader-text">' + n.settings.source.errorMsg + "</span></li>");
                                  }),
                                  e.send(null));
                            break;
                        case "json":
                            t.getJSON(n.settings.source.url, function (t) {
                                var e,
                                    i = "";
                                e = "undefined" === n.settings.source.showingField ? "title" : n.settings.source.showingField;
                                var s = "";
                                void 0 !== n.settings.source.seperator && void 0 !== typeof n.settings.source.seperator && (s = n.settings.source.seperator);
                                for (var r = 0; r < t.length && !(r >= n.settings.source.limit); r++)
                                    n.settings.source.linkEnabled ? (i += '<li><a target="' + n.settings.source.target + '" href="' + t[r].link + '">' + s + t[r][e] + "</a></li>") : (i += "<li><a>" + s + t[r][e] + "</a></li>"),
                                        "undefined" === t[r][e] && console.log('"' + e + '" does not exist in this json.');
                                l.empty().append(i),
                                    (c = l.children("li")),
                                    (m = l.children("li").length),
                                    w(),
                                    "scroll" != n.settings.effect && q(),
                                    c.find(".bn-seperator").css({ height: n.settings.height - 2 * n.settings.borderWidth }),
                                    x();
                            });
                            break;
                        default:
                            console.log('Please check your "source" object parameter. Incorrect Value');
                    }
                else "html" === n.settings.source ? ("scroll" != n.settings.effect && q(), x()) : console.log('Please check your "source" parameter. Incorrect Value');
                var e, d;
                n.settings.play ? h.find("span").removeClass("bn-play").addClass("bn-pause") : h.find("span").removeClass("bn-pause").addClass("bn-play"),
                    r.on("mouseleave", function (e) {
                        var i = t(document.elementFromPoint(e.clientX, e.clientY)).parents(".breaking-news-ticker")[0];
                        t(this)[0] !== i && (!0 === n.settings.stopOnHover ? !0 === n.settings.play && n.play() : !0 === n.settings.play && !0 === g && n.play());
                    }),
                    r.on("mouseenter", function () {
                        !0 === n.settings.stopOnHover && n.pause();
                    }),
                    u.on("click", function () {
                        p && ((p = !1), n.pause(), n.next());
                    }),
                    f.on("click", function () {
                        p && ((p = !1), n.pause(), n.prev());
                    }),
                    h.on("click", function () {
                        p && (h.find("span").hasClass("bn-pause") ? (h.find("span").removeClass("bn-pause").addClass("bn-play"), n.stop()) : ((n.settings.play = !0), h.find("span").removeClass("bn-play").addClass("bn-pause")));
                    }),
                    t(window).on("resize", function () {
                        r.width() < 480 ? (o.hide(), "rtl" == n.settings.direction ? a.css({ right: 0 }) : a.css({ left: 0 })) : (o.show(), "rtl" == n.settings.direction ? a.css({ right: o.outerWidth() }) : a.css({ left: o.outerWidth() }));
                    });
            }),
                (n.pause = function () {
                    (g = !0), clearInterval(y);
                }),
                (n.stop = function () {
                    (g = !0), (n.settings.play = !1);
                }),
                (n.play = function () {
                    x();
                }),
                (n.next = function () {
                    !(function () {
                        switch (n.settings.effect) {
                            case "scroll":
                                "rtl" === n.settings.direction
                                    ? l.stop().animate({ marginRight: -l.find("li:first-child").outerWidth() }, 300, function () {
                                          l.find("li:first-child").insertAfter(l.find("li:last-child")), l.css({ marginRight: 0 }), (p = !0);
                                      })
                                    : l.stop().animate({ marginLeft: -l.find("li:first-child").outerWidth() }, 300, function () {
                                          l.find("li:first-child").insertAfter(l.find("li:last-child")), l.css({ marginLeft: 0 }), (p = !0);
                                      });
                                break;
                            default:
                                m <= ++b && (b = 0), q();
                        }
                    })();
                }),
                (n.prev = function () {
                    !(function () {
                        switch (n.settings.effect) {
                            case "scroll":
                                "rtl" === n.settings.direction
                                    ? (0 <= parseInt(l.css("marginRight"), 10) && (l.css({ "margin-right": -l.find("li:last-child").outerWidth() }), l.find("li:last-child").insertBefore(l.find("li:first-child"))),
                                      l.stop().animate({ marginRight: 0 }, 300, function () {
                                          p = !0;
                                      }))
                                    : (0 <= parseInt(l.css("marginLeft"), 10) && (l.css({ "margin-left": -l.find("li:last-child").outerWidth() }), l.find("li:last-child").insertBefore(l.find("li:first-child"))),
                                      l.stop().animate({ marginLeft: 0 }, 300, function () {
                                          p = !0;
                                      }));
                                break;
                            default:
                                --b < 0 && (b = m - 1), q();
                        }
                    })();
                }),
                n.init();
        }),
            (t.fn.breakingNews = function (e) {
                return this.each(function () {
                    if (null == t(this).data("breakingNews")) {
                        var i = new t.breakingNews(this, e);
                        t(this).data("breakingNews", i);
                    }
                });
            });
    })(jQuery);
