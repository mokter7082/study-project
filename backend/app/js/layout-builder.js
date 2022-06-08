var LayoutBuilder = function() {
    var e = {
            init: function() {
                $("#m-btn-howto").click(function(e) {
                    e.preventDefault(), $("#m-howto").slideToggle()
                }), this.exportHtml(), this.exportHtmlStatic()
            },
            startLoad: function(e) {
                $("#builder_export").addClass("m-loader m-loader--light m-loader--right").find("> span > span").text("Exporting...").closest(".m-form__actions").find(".btn").prop("disabled", !0), $.notify(e)
            },
            doneLoad: function() {
                $("#builder_export").removeClass("m-loader m-loader--light m-loader--right").find("> span > span").text("Export").closest(".m-form__actions").find(".btn").prop("disabled", !1)
            },
            exportHtml: function() {
                $("#builder_export_html").click(function(a) {
                    a.preventDefault();
                    var i = $("#purchase-code").val();
                    if (i) {
                        var r = $(this);
                        e.startLoad({
                            title: "Generate HTML Partials",
                            message: "Process started and it may take about 1 to 10 minutes."
                        }), $.ajax("index.php", {
                            method: "POST",
                            data: {
                                builder_export: 1,
                                export_type: "partial",
                                demo: $(r).data("demo"),
                                purchase_code: i
                            }
                        }).done(function(a) {
                            var o = JSON.parse(a);
                            if (o.message) e.stopWithNotify(o.message);
                            else {
                                t.setItem("purchase_code", i);
                                var n = setInterval(function() {
                                    $.ajax("index.php", {
                                        method: "POST",
                                        data: {
                                            builder_export: 1,
                                            builder_check: o.id
                                        }
                                    }).done(function(t) {
                                        var a = JSON.parse(t);
                                        void 0 !== a && 1 === a.export_status && $("<iframe/>").attr({
                                            src: "index.php?builder_export&builder_download&id=" + a.id,
                                            style: "visibility:hidden;display:none"
                                        }).ready(function() {
                                            $.notify({
                                                title: "Export HTML Version Layout",
                                                message: "HTML version exported."
                                            }, {
                                                type: "success"
                                            }), e.doneLoad(), clearInterval(n)
                                        }).appendTo(r)
                                    })
                                }, 15e3)
                            }
                        })
                    }
                })
            },
            exportHtmlStatic: function() {
                $("#builder_export_html_static").click(function(a) {
                    a.preventDefault();
                    var i = $("#purchase-code").val();
                    if (i) {
                        var r = $(this);
                        e.startLoad({
                            title: "Generate HTML Static Version",
                            message: "Process started and it may take about 1 to 10 minutes."
                        }), $.ajax("index.php", {
                            method: "POST",
                            data: {
                                builder_export: 1,
                                export_type: "html",
                                demo: $(r).data("demo"),
                                purchase_code: i
                            }
                        }).done(function(a) {
                            var o = JSON.parse(a);
                            if (o.message) e.stopWithNotify(o.message);
                            else {
                                t.setItem("purchase_code", i);
                                var n = setInterval(function() {
                                    $.ajax("index.php", {
                                        method: "POST",
                                        data: {
                                            builder_export: 1,
                                            builder_check: o.id
                                        }
                                    }).done(function(t) {
                                        var a = JSON.parse(t);
                                        void 0 !== a && 1 === a.export_status && $("<iframe/>").attr({
                                            src: "index.php?builder_export&builder_download&id=" + a.id,
                                            style: "visibility:hidden;display:none"
                                        }).ready(function() {
                                            $.notify({
                                                title: "Export Default Version",
                                                message: "Default HTML version exported with current configured layout."
                                            }, {
                                                type: "success"
                                            }), e.doneLoad(), clearInterval(n)
                                        }).appendTo(r)
                                    })
                                }, 15e3)
                            }
                        })
                    }
                })
            },
            stopWithNotify: function(t, a) {
                a = a || "danger", $.notify({
                    title: "Verification failed",
                    message: t
                }, {
                    type: a
                }), e.doneLoad()
            }
        },
        t = {
            expires_in: 3600,
            isVerified: function() {
                return localStorage.getItem("envato")
            },
            reCaptchaVerified: function() {
                return $.ajax("../tools/builder/recaptcha.php?recaptcha", {
                    method: "POST",
                    data: {
                        response: $("#g-recaptcha-response").val()
                    }
                }).fail(function() {
                    grecaptcha.reset(), $("#alert-message").removeClass("alert-success m--hide").addClass("alert-danger").html("Invalid reCaptcha validation")
                })
            },
            init: function() {
                var e;
                $("#purchase-code").keyup(function() {
                    $("#alert-message").addClass("m--hide")
                }).val(t.getItem("purchase_code")), $("#builder_export").closest(".dropdown").find(".dropdown-item").click(function(a) {
                    a.preventDefault(), e = $(this), t.isVerified() || ($("#m-modal-purchase").modal("show"), $("#alert-message").addClass("m--hide"), grecaptcha.reset())
                }), $("#submit-verify").click(function(a) {
                    a.preventDefault(), t.reCaptchaVerified().done(function(t) {
                        t.success ? ($('[data-dismiss="modal"]').trigger("click"), $(e).trigger("click")) : (grecaptcha.reset(), $("#alert-message").removeClass("alert-success m--hide").addClass("alert-danger").html("Invalid reCaptcha validation"))
                    })
                })
            },
            setItems: function(e) {
                var a = $.extend({}, t.getItem(), e);
                localStorage.setItem("envato", JSON.stringify(a))
            },
            setItem: function(e, a) {
                var i = {};
                i[e] = a;
                var r = $.extend({}, t.getItem(), i);
                localStorage.setItem("envato", JSON.stringify(r))
            },
            getItem: function(e) {
                var t = JSON.parse(localStorage.getItem("envato"));
                return void 0 !== e ? null !== t ? t[e] : null : t
            },
            startTimer: function(e) {
                t.setItem("created_on", e), setTimeout(function() {
                    localStorage.removeItem("envato")
                }, 1e3 * t.expires_in)
            },
            tokenIsExpired: function() {
                var e = (new Date).getTime() - t.getItem("created_on");
                return (void 0 === t.expires_in || e >= 1e3 * t.expires_in) && (localStorage.removeItem("envato"), !0)
            }
        },
        a = function() {
            e.init(), $('[href^="#m_builder_"]').click(function(e) {
                var t = $(this).attr("href"),
                    a = $('[name="builder_submit"]'),
                    i = $('[name="builder[tab]"]');
                0 === $(i).length ? $("<input/>").attr("type", "hidden").attr("name", "builder[tab]").val(t).insertBefore(a) : $(i).val(t)
            }).each(function() {
                if ($(this).hasClass("active")) {
                    var e = $(this).attr("href"),
                        t = $('[name="builder_submit"]'),
                        a = $('[name="builder[tab]"]');
                    0 === $(a).length ? $("<input/>").attr("type", "hidden").attr("name", "builder[tab]").val(e).insertBefore(t) : $(a).val(e)
                }
            }), $('[name="builder_submit"]').click(function(e) {
                e.preventDefault();
                var t = $(this);
                $(t).addClass("m-loader m-loader--light m-loader--right").closest(".m-form__actions").find(".btn").prop("disabled", !0), $.ajax("index.php?demo=" + $(t).data("demo"), {
                    method: "POST",
                    data: $("[name]").serialize()
                }).done(function(e) {
                    $.notify({
                        title: "Preview updated",
                        message: "Preview has been updated with current configured layout."
                    }, {
                        type: "success"
                    })
                }).always(function() {
                    setTimeout(function() {
                        location.reload()
                    }, 600)
                })
            }), $('[name="builder_reset"]').click(function(e) {
                e.preventDefault();
                var t = $(this);
                $(t).addClass("m-loader m-loader--primary m-loader--right").closest(".m-form__actions").find(".btn").prop("disabled", !0), $.ajax("index.php?demo=" + $(t).data("demo"), {
                    method: "POST",
                    data: {
                        builder_reset: 1,
                        demo: $(t).data("demo")
                    }
                }).done(function(e) {}).always(function() {
                    location.reload()
                })
            })
        };
    return {
        init: function() {
            t.init(), a()
        }
    }
}();
jQuery(document).ready(function() {
    LayoutBuilder.init()
});