<?php ($sp = $serpart); ?>
<?php $__currentLoopData = $childs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>   
        <td tabindex="2"><?php for($i=1; $i<=$sp; $i++): ?> ―  <?php endfor; ?> <?php echo $child->title??''; ?></td>            
        <td tabindex="2"><?php echo $child->slug??''; ?></td>   
        <td>
            <?php if(!empty($child->picture)): ?>
            <img src="<?php echo e(isset($child) && $child->picture !=''? $child->picture: URL::to('img/default.jpg')); ?>" width="50px" class="m--marginless" alt="photo"> 
             <?php endif; ?> 
        </td> 
        <td> 
            <label class="m--font-bold m--font-primary"><?php echo e($child->status??''); ?></label> 
        </td>
        <td nowrap="" align="center">
            <?php if((auth()->user()->can('category-delete') || auth()->user()->can('category-edit'))): ?>
            <span class="dropdown">
                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-edit')): ?>
                    <a class="dropdown-item" href="<?php echo e(route('categories.edit',$child->id)); ?>"><i class="la la-edit"></i> Edit </a>
                    <?php endif; ?>
                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-delete')): ?>
                    <a class="dropdown-item" href="#<?php echo e(route('categories.destroy', $child->id)); ?>"
                        onclick="event.preventDefault(); document.getElementById('delete-form<?php echo e($child->id); ?>').submit();
                    "><i class="la la-trash"></i>Delete</a>
                    <?php echo Form::open(['method' => 'DELETE','route' => ['categories.destroy', $child->id],'style'=>'display:inline', 'id'=>'delete-form'.$child->id]); ?>

                    <?php echo Form::close(); ?>

                    <?php endif; ?>
                </div>
            </span>
            <?php endif; ?>
            <!-- <a href="<?php echo e(route('categories.show',$child->id)); ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                                   <i class="la la-external-link"></i></a>  -->                       
        </td>
    </tr>
	<?php if(count($child->childs)): ?>
		<?php ($serpart = $sp +1); ?>
		<?php echo $__env->make('backend.categories.child',['childs' => $child->childs, 'serpart'=>$serpart], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endif; ?>	
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/categories/child.blade.php ENDPATH**/ ?>