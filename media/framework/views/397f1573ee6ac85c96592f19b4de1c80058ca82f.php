<?php if(!empty($navs)): ?>
<ul class="main-nav__navigation-box">
	<?php $__currentLoopData = $navs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $nav): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
		<li class="nav_label_1 <?php echo e(active_nav($nav->menu_url??'', $active)); ?> <?php echo e(count($nav->childs)?'dropdown':''); ?>">
			<a href="<?php echo e($nav->menu_url??''); ?>" target="<?php echo e($nav->target??'_self'); ?>"><?php echo e($nav->name??''); ?> <?php echo count($nav->childs)? '<i class="fa fa-angle-down"></i>':''; ?></a> 
			<?php if(count($nav->childs)): ?>
                <?php echo $__env->make('includes.frontend.nav_child', ['childs' => $nav->childs, 'label'=>1, 'active'=>$active], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
		</li>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
</ul>
<?php endif; ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/includes/frontend/nav.blade.php ENDPATH**/ ?>