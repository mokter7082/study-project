<?php $__env->startSection('title', '404'); ?>
<?php $__env->startSection('content'); ?> 
<section class="breadcumb">
<?php ($sigment_parent = Request::segment(1)); ?>
<?php ($sigment_sub = Request::segment(2)); ?>
  <div class="container">
     <ul>
        <li><a href="index.html">Home</a></li>
        <li><a class="current">404</a></li>
     </ul>
  </div>
 </section>
 <section class="main-content-area whtrnbg">
    <div class="container">  
       <section class="container-area">
          <div class="row">
             <div class="col-lg-12">
                 <h1 style="display: block; text-align: center; padding: 100px 0 130px; font-size:64px; line-height: 1; color: #ddd"> 404!! </h1>
             </div> 
          </div>
       </section> 
    </div>
 </section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/errors/404.blade.php ENDPATH**/ ?>