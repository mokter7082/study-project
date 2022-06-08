<?php $__env->startSection('title', 'Category Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Our Categories</h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-create')): ?>
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Create new</span>
                        </span>
                    </a>
                </li>
            </ul>
            <?php endif; ?>
        </div>
    </div>

    <div class="m-portlet__body">  
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr>  
                    <th>Category name</th>                    
                    <th>Slug</th>  
                    <th>Image</th>  
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                <?php $__currentLoopData = $cats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>  
                        <td tabindex="2" width="50%"><?php echo $category->title??''; ?></td>
                                                
                        <td tabindex="2"><?php echo $category->slug??''; ?></td>                         
                        <td>
                            <?php if(!empty($category->picture)): ?>
                            <img src="<?php echo e(isset($category) && $category->picture !=''? $category->picture: URL::to('img/default.jpg')); ?>" class="m--marginless" width="50px" alt="photo"> 
                             <?php endif; ?> 
                        </td>                         
                        <td><label class="m--font-bold m--font-primary"><?php echo e($category->status??''); ?></label></td>
                        <td nowrap="" align="center">
                            <?php if((auth()->user()->can('category-delete') || auth()->user()->can('category-edit'))): ?>
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-edit')): ?>
                                    <a class="dropdown-item" href="<?php echo e(route('categories.edit',$category->id)); ?>"><i class="la la-edit"></i> Edit </a>
                                    <?php endif; ?>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-delete')): ?>
                                    <a class="dropdown-item" href="#<?php echo e(route('categories.destroy', $category->id)); ?>"
                                        onclick="event.preventDefault(); document.getElementById('delete-form<?php echo e($category->id); ?>').submit();
                                    "><i class="la la-trash"></i>Delete</a>
                                    <?php echo Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline', 'id'=>'delete-form'.$category->id]); ?>

                                    <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                </div>
                            </span>
                            <?php endif; ?>
                             
                        </td>
                    </tr>
                    <?php if(count($category->childs)): ?>
                        <?php echo $__env->make('backend.categories.child', ['childs' => $category->childs, 'serpart'=>1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table> 
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        "searching": false,
        "ordering": false, 
        "pageLength": 100
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/categories/list.blade.php ENDPATH**/ ?>