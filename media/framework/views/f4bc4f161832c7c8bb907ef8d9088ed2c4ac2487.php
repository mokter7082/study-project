<?php $__env->startSection('title', 'Widgets Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Widgets Management</h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('book-create')): ?>
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="<?php echo e(route('widgets.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Create New</span>
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
                    <th width="50">Sl No.</th> 
                    <th>Title</th>       
                    <th>Referance</th>                    
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 

                <?php $__currentLoopData = $widgets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $widget): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <tr> 
                        <td tabindex="0"><?php echo e(++$key); ?></td> 
                        <td tabindex="2"><?php echo $widget->title??''; ?></td>
                        <td tabindex="2"><?php echo $widget->referance??''; ?></td>
                                          
                        <td><label class="m--font-bold m--font-primary"><?php echo e($widget->status??''); ?></label></td>
                        <td nowrap="" align="center">
                            <?php if((auth()->user()->can('widget-delete') || auth()->user()->can('widget-edit'))): ?>
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('widget-edit')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('widgets.edit',$widget->id)); ?>"><i class="la la-edit"></i> Edit </a>
                                    <?php endif; ?>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('widget-delete')): ?>
                                        <a class="dropdown-item delItem" href="#<?php echo e(route('widgets.destroy', $widget->id)); ?>" data-delform="delete-form<?php echo e($widget->id); ?>"><i class="la la-trash"></i>Delete</a>
                                    <?php echo Form::open(['method' => 'DELETE','route' => ['widgets.destroy', $widget->id],'style'=>'display:inline', 'id'=>'delete-form'.$widget->id]); ?>

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

<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/widgets/list.blade.php ENDPATH**/ ?>