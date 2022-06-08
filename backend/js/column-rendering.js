var DatatablesAdvancedColumnRendering = {
    init: function() {
        $("#m_table_1").DataTable({
            responsive: !0,
            paging: !0,
            columnDefs: [
                {
                    targets: 4,
                    render: function(a, e, n, s) {
                        var t = {
                            1: {
                                title: "Pending",
                                class: "m-badge--brand"
                            },
                            2: {
                                title: "Delivered",
                                class: " m-badge--metal"
                            },
                            3: {
                                title: "Canceled",
                                class: " m-badge--primary"
                            },
                            4: {
                                title: "Success",
                                class: " m-badge--success"
                            },
                            5: {
                                title: "Info",
                                class: " m-badge--info"
                            },
                            6: {
                                title: "Danger",
                                class: " m-badge--danger"
                            },
                            7: {
                                title: "Warning",
                                class: " m-badge--warning"
                            }
                        };
                        return void 0 === t[a] ? a : '<span class="m-badge ' + t[a].class + ' m-badge--wide">' + t[a].title + "</span>"
                    }
                },
                {
                    targets: 5,
                    render: function(a, e, n, s) {

                        var t = {
                            1: {
                                title: "Editor",
                                state: "danger"
                            },
                            2: {
                                title: "Admin",
                                state: "primary"
                            },
                            3: {
                                title: "Agent",
                                state: "accent"
                            }
                        };
                        return void 0 === t[a] ? a : '<span class="m-badge m-badge--' + t[a].state + ' m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-' + t[a].state + '">' + t[a].title + "?</span>"
                    }
                }
            ]
        })
    }
};
jQuery(document).ready(function() {
    DatatablesAdvancedColumnRendering.init()
});