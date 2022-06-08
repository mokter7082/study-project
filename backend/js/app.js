//Preview Image
function previewFile(pimg='#previmg', cimg='#choiseImg'){
    var preview = document.querySelector(pimg); //selects the query named img
    var file    = document.querySelector(cimg).files[0]; //sames as here
    var reader  = new FileReader();
    reader.onloadend = function () {
        preview.src = reader.result;
    }
    if (file) {
        reader.readAsDataURL(file); //reads the data as a URL
    } else {
        preview.src = "";
    }
}

$('#previmg').click(function(e){
    $('#choiseImg').trigger('click');
})

//SummerNote
var SummernoteDemo = {
    init: function() {
        $(".summernote").summernote({
             toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                //['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['Insert',['picture', 'link', 'table', 'hr']],
                ['Misc', ['fullscreen', 'codeview', 'undo', 'redo']]
              ],
            height: 200
        })

        $('.smallsummer').summernote({
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['Insert', ['link', 'table']],
                ['Misc', ['fullscreen', 'codeview', 'undo', 'redo']]
            ],
            height: 100
        });
    }
};

jQuery(document).ready(function() {
    SummernoteDemo.init()
});

var BootstrapSelect = {
    init: function() {
        $(".m_selectpicker").selectpicker()
    }
};

jQuery(document).ready(function() {
    BootstrapSelect.init()
});


var customSelect = {
    init: function() {
        $(".c_selectpicker").select2()
    }
};

jQuery(document).ready(function() {
    customSelect.init()
});


$(".bootstra-date").datepicker({
    todayHighlight: !0,
    orientation: "bottom left",
    autoclose: true,
    format: 'yyyy-mm-dd',
})

$("#country, #university, #countries, #lavel, #specialization").select2();

$("#examsection").select2({
    placeholder: "Select Exam Article"
});

$("#area_ids").select2({
    placeholder: "Select Area"
});


$("#exp_repeater_1").repeater({
    initEmpty: !1,
    defaultValues: {
        "text-input": "foo"
    },
    show: function() {
        $(this).slideDown()
    },
    hide: function(e) {
        $(this).slideUp(e)
    }
});

$("#dataTable").DataTable({
    responsive: !0,
    paging: !0,
});

//CK Editor
var EditorItem = document.getElementById("editor");
var options = {
    allowedContent:true,
    filebrowserImageBrowseUrl: '/bdrentz-admin/media-file?type=Images',
    filebrowserImageUploadUrl: '/bdrentz-admin/media-file/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/bdrentz-admin/media-file?type=Files',
    filebrowserUploadUrl: '/bdrentz-admin/media-file/upload?type=Files&_token=',
  };

if(EditorItem){
    CKEDITOR.replace( 'editor', options);
}

//Year Picker
$(".years").datepicker({
    rtl: mUtil.isRTL(),
    todayHighlight: !0,
    orientation: "bottom left",
    autoclose: true,
    format: "yyyy",
    viewMode: "years", 
    minViewMode: "years"
})

//Month Picker
$(".month").datepicker( {
    rtl: mUtil.isRTL(),
    todayHighlight: !0,
    orientation: "bottom left",
    autoclose: true,
    format: "yyyy-mm",
    viewMode: "months", 
    minViewMode: "months"
});


//Year Picker
$(".dates").datepicker({
    rtl: mUtil.isRTL(),
    todayHighlight: !0,
    orientation: "bottom left",
    autoclose: true,
    format: "yyyy-mm-dd",
})
 

$(".time_picker").timepicker({
    minuteStep: 1,
    showSeconds: !1,
    showMeridian: !1,
});

$("#m_timepicker_2, #m_timepicker_2_modal").timepicker({
    minuteStep: 1,
    defaultTime: "",
    showSeconds: !0,
    showMeridian: !1,
    snapToStep: !0
})

$(".date_picker").datepicker({
    todayHighlight: !0,
    format: 'yyyy-m-d',
    autoclose: true,
    templates: {
        leftArrow: '<i class="la la-angle-left"></i>',
        rightArrow: '<i class="la la-angle-right"></i>'
    }
})

$(".date_ranger").daterangepicker({
     locale: {
      format: 'YYYY-MM-DD'
    },
    autoApply:true,
    /*buttonClasses:"m-btn btn",
    applyClass:"btn-primary",
    cancelClass:"btn-secondary" */
})

$(document).on("input", ".numeric", function() {
    this.value = this.value.replace(/[^0-9\.]/g,'');
});

/*// minimum setup
$("#m_daterangepicker").daterangepicker({
    buttonClasses: "m-btn btn",
    applyClass: "btn-primary",
    cancelClass: "btn-secondary"
}, function(t, i, a) {
    var r = $("#m_daterangepicker").find(".form-control");
    r.val(t.format("YYYY/MM/DD") + " / " + i.format("YYYY/MM/DD")), e.element(r)
})*/

/* FUNCTIONS FOR DYNAMIC ENGINE
------------------------------------------------*/
function makeAjaxText(url, load=null) {
    return $.ajax({
        url: url,
        type: 'get',
        cache: false,
        beforeSend: function(){
            if(typeof(load) != "undefined" && load !== null){
                load.ladda('start');
            }
        }
    }).always(function() {
        if(typeof(load) != "undefined" && load !== null){
            load.ladda('stop');
        }
    }).fail(function() {
        swalError();
    });
}

function makeAjaxPostText(data, url, load=null) {
    return $.ajax({
        url: url,
        type: 'post',
        data: data,
        cache: false,
        beforeSend: function(){
            if(typeof(load) != "undefined" && load !== null){
                load.ladda('start');
            }
        }
    }).always(function() {
        if(typeof(load) != "undefined" && load !== null){
            load.ladda('stop');
        }
    }).fail(function() {
        swalError();
    });
}

function makeAjax(url, load=null) {
    return $.ajax({
        url: url,
        type: 'get',
        dataType: 'json',
        cache: false,
        beforeSend: function(){
            if(typeof(load) != "undefined" && load !== null){
                load.ladda('start');
            }
        }
    }).always(function() {
        if(typeof(load) != "undefined" && load !== null){
            load.ladda('stop');
        }
    }).fail(function() {
        swalError();
    });
}

function makeAjaxPost(data, url, load=null) {
    return $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: data,
        cache: false,
        beforeSend: function(){
            if(typeof(load) != "undefined" && load !== null){
                load.ladda('start');
            }
        }
    }).always(function() {
        if(typeof(load) != "undefined" && load !== null){
            load.ladda('stop');
        }
    }).fail(function() {
        swalError();
    });
}

function swalError(msg) {
    var message = typeof(msg) != "undefined" && msg !== null ? msg : "Something went wrong";
    Swal.fire({
        title: "Sorry !!",
        html: message,
        type: "error",
        showConfirmButton: false,
        // timer: 1000
    });
}

function swalWarning(msg) {
    var message = typeof(msg) != "undefined" && msg !== null ? msg : "Something went wrong";
    Swal.fire({
        title: "Warning !!",
        html: message,
        type: "warning",
        showConfirmButton: false,
        // timer: 1000
    });
}

function swalSuccess(msg) {
    var message = typeof(msg) != "undefined" && msg !== null ? msg : "Action has been Completed Successfully";
    Swal.fire({
        title: 'Successful !!',
        html: message,
        type: 'success',
        showConfirmButton: false,
        // timer: 1500
    });
}

function swalRedirect(url, msg, mode) {
    var message = typeof(msg) != "undefined" && msg !== null ? msg : "Action has been Completed Successfully";
    var title = 'Successful !!';
    var type = 'info';
    if(typeof(mode) != "undefined" && mode !== null){
        if(mode == 'success'){
            var title = 'Successful !!';
            var type = 'success';
        } else if(mode == 'error'){
            var title = 'Failed !!';
            var type = 'error';
        }else if(mode == 'warning'){
            var title = 'Warning !!';
            var type = 'warning';
        }else if(mode == 'question'){
            var title = 'Warning !!';
            var type = 'question';
        }else{
            var title = 'Successful !!';
            var type = 'info';
        }
    }
    return Swal.fire({
        title: title,
        html: message,
        type: type,
        reverseButtons : true,
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Thank You',
    }).then(function (s) {
        if(s.value){
            if(typeof(url) != "undefined" && url !== null){
                window.location.replace(url);
            }else{
                location.reload();
            }
        }
    });

    setTimeout(function(){  window.location.replace(url); }, 100);
}

function swalConfirm(msg) {
    var message = typeof(msg) != "undefined" && msg !== null ? msg : "You won't be able to revert this!";
    return Swal.fire({
        title: 'Are you sure?',
        html: message,
        type: 'warning',
        reverseButtons : true,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Confirm!',
        cancelButtonText: 'Cancel'
    });
}