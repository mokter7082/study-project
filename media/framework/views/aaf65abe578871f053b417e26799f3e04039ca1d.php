<?php $__env->startSection('title', 'Course Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Our Products</h3>
            </div>
        </div> 
        
    </div>

    <div class="m-portlet__body"> 
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr> 
                    <th width="40">Sl.</th>
                    <th width="70">image</th>  
                    <th>Title</th> 
                    <th>Caegory</th>
                    <th>Price for 30 days</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 
                
                <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $equipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                   
                
                    <tr> 
                        <td tabindex="0"><?php echo e(++$key); ?></td>  
                        <td tabindex="1">
                            <?php if(!empty($equipment->picture)): ?>
                                <img src="<?php echo e(isset($equipment) && $equipment->picture !=''? $equipment->picture: URL::to('image/default.jpg')); ?>" class="m--marginless" alt="photo"> 
                            <?php endif; ?>
                        </td>
                        <td tabindex="2"><?php echo $equipment->title??''; ?></td>
                        <td tabindex="3"><?php echo $equipment->category_id??''; ?></td>
                        <td tabindex="3"><?php echo $equipment->price_30??''; ?></td>
                               
                        <td><label class="m--font-bold m--font-primary"><?php echo e($equipment->status??''); ?></label></td>
                        <td nowrap="" align="center">
                            <?php if((auth()->user()->can('course-delete') || auth()->user()->can('course-edit'))): ?>
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course-edit')): ?>
                                        
                                        <a class="dropdown-item" href="<?php echo e(route('equipments.edit',$equipment->id)); ?>"><i class="la la-edit"></i> Edit </a>
                                    <?php endif; ?>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course-delete')): ?>
                                    <a class="dropdown-item" href="#<?php echo e(route('equipments.destroy', $equipment->id)); ?>"
                                        onclick="event.preventDefault(); document.getElementById('delete-form<?php echo e($equipment->id); ?>').submit();
                                    "><i class="la la-trash"></i>Delete</a>
                                    <?php echo Form::open(['method' => 'DELETE','route' => ['equipments.destroy', $equipment->id],'style'=>'display:inline', 'id'=>'delete-form'.$equipment->id]); ?>

                                    <?php echo Form::close(); ?>






                                    <?php endif; ?>

                                </div>
                            </span>
                            <?php endif; ?>
                            
                                                
                        </td>
                    </tr> 
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
        "ordering": false, 
        "pageLength": 100
    }); 
    $('.delItem').click(function(e) {
        e.preventDefault; 
        var formId = $(this).data('delform'); 
        swalConfirm().then((result) => {
          if (result.value) { 
            $('#'+formId).submit();
          }
        })
    })
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/courses/list.blade.php ENDPATH**/ ?>