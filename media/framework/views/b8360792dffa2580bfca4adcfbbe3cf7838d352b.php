<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
  <head>
    <meta charset="utf-8"/>
     <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title'); ?> | bdrentz</title>
    <meta name="description" content="Latest updates and statistic charts">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="<?php echo e(asset('https://bdrentz.com/images/backend_images/BdRentz-logo.png')); ?>"/> 

    <link href="<?php echo e(asset('backend/vendors/base/vendors.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('backend/demo/base/style.bundle.css')); ?>" rel="stylesheet" type="text/css" /> 
    <link href="<?php echo e(asset('backend/vendors/custom/fullcalendar/fullcalendar.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('backend/vendors/custom/datatables/datatables.bundle.css')); ?>" rel="stylesheet" type="text/css" />
    <!-- <link href="<?php echo e(asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet" type="text/css" />  -->
    <link href="<?php echo e(asset('css/tagify.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('backend/css/ladda.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('backend/css/style.css')); ?>" rel="stylesheet" type="text/css" /> 
    
    
    <?php echo $__env->yieldPushContent('style'); ?>  
  </head>
  <body class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page">

      <!-- BEGIN: Header -->
      <?php echo $__env->make('includes.backend.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>       
      <!-- END: Header -->

      <!-- begin::Body -->
      <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">

        <!-- BEGIN: Left Aside -->
        <?php echo $__env->make('includes.backend.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
        <!-- END: Left Aside -->

        <div class="m-grid__item m-grid__item--fluid m-wrapper">          
          <div class="m-content" style="overflow: hidden;">
             <?php echo $__env->yieldContent('content'); ?>
          </div>
        </div>       
      </div>
      <!-- end:: Body -->

      <!-- begin::Footer -->
      <?php echo $__env->make('includes.backend.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
      <!-- end::Footer -->

    </div>
    <!-- end:: Page -->

    <!-- begin::Message Sidebar -->
      
    <!-- end::Message Sidebar -->

    <!-- begin::Scroll Top -->
    <div id="m_scroll_top" class="m-scroll-top">
      <i class="la la-arrow-up"></i>
    </div>

    <script src="<?php echo e(asset('backend/vendors/base/vendors.bundle.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('backend/demo/base/scripts.bundle.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('frontend/js/toastr.min.js')); ?>"></script> 
    <script src="<?php echo e(asset('js/tagify.min.js')); ?>"></script>  
    <script src="<?php echo e(asset('backend/vendors/custom/datatables/datatables.bundle.js')); ?>" type="text/javascript"></script>

    <script src="<?php echo e(asset('backend/vendors/ckeditor/ckeditor.js')); ?>" type="text/javascript"></script>  
    <script src="<?php echo e(asset('backend/vendors/ckeditor/adapters/jquery.js')); ?> "></script>
    <script src="<?php echo e(asset('backend/demo/custom/components/base/treeview.js')); ?> "></script>
 
    <script src="<?php echo e(asset('backend/js/form-controls.js')); ?>" type="text/javascript"></script>    
    <script src="<?php echo e(asset('backend/demo/custom/crud/forms/widgets/bootstrap-switch.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/jQuery.print.js')); ?>" type="text/javascript"></script>
    <script src="<?php echo e(asset('vendor/laravel-filemanager/js/stand-alone-button.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/spin.min.js')); ?>"></script>
 
    <script src="<?php echo e(asset('backend/js/ladda.jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/jquery.nestable.js')); ?>"></script>
    <script src="<?php echo e(asset('backend/js/app.js')); ?>" type="text/javascript"></script> 
    
    <script>
      var options = {
        filebrowserImageBrowseUrl: '/bdrentz-admin/media-file?type=Images',
        filebrowserImageUploadUrl: '/bdrentz-admin/media-file/upload?type=Images&_token=',
        filebrowserBrowseUrl: '/bdrentz-admin/media-file?type=Files',
        filebrowserUploadUrl: '/bdrentz-admin/media-file/upload?type=Files&_token=', 
      }; 
      $('#laraEditor').ckeditor(options);
      //var route_prefix = "<?php echo e(url('/bdrentz-admin/media-file')); ?>";
      //$('#lfm').filemanager('image', {prefix: route_prefix}); 
      //$('#lfm').filemanager('file', {prefix: route_prefix});
    </script>

    <script>
      <?php if(Session::has('success')): ?>
        //toastr.success("<?php echo e(Session::get('success')); ?>"); 
        Swal.fire(
          'Success!!',
          '<?php echo e(Session::get('success')); ?>',
          'success'
        ) 
      <?php endif; ?>

      <?php if(Session::has('info')): ?>
        toastr.info("<?php echo e(Session::get('info')); ?>"); 
      <?php endif; ?>

      <?php if(Session::has('warning')): ?>
        toastr.warning("<?php echo e(Session::get('warning')); ?>");
      <?php endif; ?>

      <?php if(Session::has('error')): ?>
        //toastr.error("<?php echo e(Session::get('error')); ?>");
        Swal.fire(
          'Sorry!!',
          '<?php echo e(Session::get('error')); ?>',
          'error'
        ) 
      <?php endif; ?>
    </script>

    
    <?php if(!session()->has('lenguage')): ?>
      <?php echo e(setLanguage()); ?>

      <script> location.reload(); </script>  
    <?php endif; ?>  
    <!-- end: JavaScript-->

    <?php echo $__env->yieldPushContent('scripts'); ?> 
  </body>
</html>


<?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/layouts/app-backend.blade.php ENDPATH**/ ?>