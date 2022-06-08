<?php $__env->startSection('title', 'Instrumententafel'); ?>
<?php $__env->startSection('content'); ?>
<div class="container">
    <!--Begin::Section-->
	<div class="m-portlet col-md-8">
		<div class="m-portlet__body  m-portlet__body--no-padding">
			<div class="row m-row--no-padding m-row--col-separator-xl mx-auto">
				
				<div class="col-xl-9"> 
					<div class="m-widget14">
						<div class="row">
							<div class="col-lg-3 col-md-6 border rounded mx-2 text-center">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand"><?php echo e($total_booking??0); ?></span>
									<span class="m-widget14__desc">
										Category
									</span>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 border rounded mx-2 text-center">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand"><?php echo e($total_students??0); ?></span>
									<span class="m-widget14__desc">
										Product
									</span>
								</div>
							</div>
							<div class="col-lg-3 col-md-6 rounded border mx-2 text-center">
								<div class="m-widget14__header m--margin-top-30">
									<span class="title_number dblock m--font-brand"><?php echo e($total_course??0); ?></span>
									<span class="m-widget14__desc">
										Orders
									</span>
								</div>
							</div>
							
						</div> 
					</div> 
				</div> 
			</div>
		</div>
	</div>
 
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?> 
<script src="<?php echo e(asset('backend/app/js/dashboard.js')); ?>" type="text/javascript"></script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>