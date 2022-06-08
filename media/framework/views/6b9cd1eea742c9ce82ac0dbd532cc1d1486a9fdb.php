<?php if(!empty($childs)): ?>
<ul>
	<?php ($label = $label+1); ?>
	<?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
		<?php if( $nav->status == 'Active'): ?>
			<li class="nav_label_<?php echo e($label); ?> <?php echo e(active_nav($nav->menu_url??'', $active)); ?> <?php echo e(count($nav->childs)?'dropdown':''); ?>">
				<a href="<?php echo e($nav->menu_url??''); ?>" target="<?php echo e($nav->target??'_self'); ?>"><?php echo e($nav->name??''); ?></a> 
				<?php if(count($nav->childs)): ?>
	                <?php echo $__env->make('includes.frontend.nav_child', ['childs'=>$nav->childs, 'label'=>$label, 'active'=>$active], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	            <?php endif; ?>
			</li>
		<?php endif; ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</ul>
<?php endif; ?>

 <?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/includes/frontend/nav_child.blade.php ENDPATH**/ ?>