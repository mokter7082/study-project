var BootstrapNotifyDemo = {
    init: function() {
        $("[data-switch=true]").bootstrapSwitch(), $("#m_notify_btn").click(function() {
            var e = {
                message: "New order has been placed"
            };
            $("#m_notify_title").prop("checked") && (e.title = "Notification Title"), "" != $("#m_notify_icon").val() && (e.icon = "icon " + $("#m_notify_icon").val()),
            $("#m_notify_url").prop("checked") && (e.url = "https://omelab.net", e.target = "_blank");
            var t = $.notify(e, {
                type: $("#m_notify_state").val(),
                allow_dismiss: $("#m_notify_dismiss").prop("checked"),
                newest_on_top: $("#m_notify_top").prop("checked"),
                mouse_over: $("#m_notify_pause").prop("checked"),
                showProgressbar: $("#m_notify_progress").prop("checked"),
                spacing: $("#m_notify_spacing").val(),
                timer: $("#m_notify_timer").val(),
                placement: {
                    from: $("#m_notify_placement_from").val(),
                    align: $("#m_notify_placement_align").val()
                },
                offset: {
                    x: $("#m_notify_offset_x").val(),
                    y: $("#m_notify_offset_y").val()
                },
                delay: $("#m_notify_delay").val(),
                z_index: $("#m_notify_zindex").val(),
                animate: {
                    enter: "animated " + $("#m_notify_animate_enter").val(),
                    exit: "animated " + $("#m_notify_animate_exit").val()
                }
            });
            $("#m_notify_progress").prop("checked") && (setTimeout(function() {
                t.update("message", "<strong>Saving</strong> Page Data."), t.update("type", "primary"), t.update("progress", 20)
            }, 1e3), setTimeout(function() {
                t.update("message", "<strong>Saving</strong> User Data."), t.update("type", "warning"), t.update("progress", 40)
            }, 2e3), setTimeout(function() {
                t.update("message", "<strong>Saving</strong> Profile Data."), t.update("type", "danger"), t.update("progress", 65)
            }, 3e3), setTimeout(function() {
                t.update("message", "<strong>Checking</strong> for errors."), t.update("type", "success"), t.update("progress", 100)
            }, 4e3))
        })
    }
};
jQuery(document).ready(function() {
    BootstrapNotifyDemo.init()
});