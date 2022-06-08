<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8"/>
     <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') | bdrentz</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('https://bdrentz.com/images/backend_images/BdRentz-logo.png')}}"/> 

    <link href="{{asset('backend/vendors/base/vendors.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/demo/base/style.bundle.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{asset('backend/vendors/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/vendors/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!-- <link href="{{asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet" type="text/css" />  -->
    <link href="{{asset('css/tagify.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('backend/css/ladda.min.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('backend/css/style.css')}}" rel="stylesheet" type="text/css" /> 
    
    {{-- Custom Style --}}
    @stack('style')  
  </head>
  <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

      <!-- BEGIN: Header -->
      @include('includes.backend.header')       
      <!-- END: Header -->

      <!-- begin::Body -->
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        @include('includes.backend.sidebar') 
        <!-- END: Left Aside -->

        <div class="m-grid__item m-grid__item--fluid m-wrapper">          
          <div class="m-content" style="overflow: hidden;">
             @yield('content')
          </div>
        </div>       
      </div>
      <!-- end:: Body -->

      <!-- begin::Footer -->
      @include('includes.backend.footer') 
      <!-- end::Footer -->

    </div>
    <!-- end:: Page -->

    <!-- begin::Message Sidebar -->
      {{-- @include('includes.backend.quick-message') --}}
    <!-- end::Message Sidebar -->

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
      <i class="la la-arrow-up"></i>
    </div>

    <script src="{{asset('backend/vendors/base/vendors.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('backend/demo/base/scripts.bundle.js')}}" type="text/javascript"></script>
    <script src="{{asset('frontend/js/toastr.min.js')}}"></script> 
    <script src="{{asset('js/tagify.min.js')}}"></script>  
    <script src="{{asset('backend/vendors/custom/datatables/datatables.bundle.js')}}" type="text/javascript"></script>

    <script src="{{asset('backend/vendors/ckeditor/ckeditor.js')}}" type="text/javascript"></script>  
    <script src="{{asset('backend/vendors/ckeditor/adapters/jquery.js')}} "></script>
    <script src="{{asset('backend/demo/custom/components/base/treeview.js')}} "></script>
 
    <script src="{{asset('backend/js/form-controls.js')}}" type="text/javascript"></script>    
    <script src="{{asset('backend/demo/custom/crud/forms/widgets/bootstrap-switch.js')}}"></script>
    <script src="{{asset('backend/js/jQuery.print.js')}}" type="text/javascript"></script>
    <script src="{{asset('vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script src="{{asset('backend/js/spin.min.js')}}"></script>
 
    <script src="{{asset('backend/js/ladda.jquery.min.js')}}"></script>
    <script src="{{asset('backend/js/jquery.nestable.js')}}"></script>
    <script src="{{asset('backend/js/app.js')}}" type="text/javascript"></script> 
    
    <script>
      var options = {
        filebrowserImageBrowseUrl: '/bdrentz-admin/media-file?type=Images',
        filebrowserImageUploadUrl: '/bdrentz-admin/media-file/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/bdrentz-admin/media-file?type=Files',
        filebrowserUploadUrl: '/bdrentz-admin/media-file/upload?type=Files&_token=', 
      }; 
      $('#laraEditor').ckeditor(options);
      //var route_prefix = "{{url('/bdrentz-admin/media-file')}}";
      //$('#lfm').filemanager('image', {prefix: route_prefix}); 
      //$('#lfm').filemanager('file', {prefix: route_prefix});
    </script>

    <script>
      @if(Session::has('success'))
        //toastr.success("{{ Session::get('success') }}"); 
        Swal.fire(
          'Success!!',
          '{{ Session::get('success') }}',
          'success'
        ) 
      @endif

      @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}"); 
      @endif

      @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
      @endif

      @if(Session::has('error'))
        //toastr.error("{{ Session::get('error') }}");
        Swal.fire(
          'Sorry!!',
          '{{ Session::get('error') }}',
          'error'
        ) 
      @endif
    </script>

    {{-- Set Language Session --}}
    @if(!session()->has('lenguage'))
      {{ setLanguage() }}
      <script> location.reload(); </script>  
    @endif  
    <!-- end: JavaScript-->

    @stack('scripts') 
  </body>
</html>


