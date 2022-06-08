<?php $__env->startSection('title', 'Pages Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Pages Management</h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('book-create')): ?>
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="<?php echo e(route('pages.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
                    <th width="50">Sl. Nein.</th> 
                    <th width="70">Bild</th> 
                    <th>Titel</th>   
                    <th width="70px">Status</th>
                    <th width="60px">Aktionen</th>
                </tr>
            </thead>
            <tbody> 

                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                    <tr> 
                        <td tabindex="0"><?php echo e(++$key); ?></td> 
                        <td>
                            <?php if(!empty($page->picture)): ?>
                                <img src="<?php echo e(isset($page) && $page->picture !=''? $page->picture: URL::to('images/default.jpg')); ?>" class="m--marginless" alt="photo"> 
                            <?php endif; ?>
                        </td>    
                        <td tabindex="2"><?php echo $page->title??''; ?></td> 
                        <td><label class="m--font-bold m--font-primary"><?php echo e($page->status??''); ?></label></td>
                        <td nowrap="" align="center">
                            <?php if((auth()->user()->can('page-delete') || auth()->user()->can('page-edit'))): ?>
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">

                                    <a class="dropdown-item" href="<?php echo e(route('pages',$page->slug)); ?>" target="_blank"><i class="la la-external-link"></i> Aussicht </a>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-edit')): ?>
                                        <a class="dropdown-item" href="<?php echo e(route('pages.edit',$page->id)); ?>"><i class="la la-edit"></i> Bearbeiten </a>
                                    <?php endif; ?>
                                    
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('page-delete')): ?>
                                        <a class="dropdown-item delItem" href="#<?php echo e(route('pages.destroy', $page->id)); ?>" data-delform="delete-form<?php echo e($page->id); ?>"><i class="la la-trash"></i>Löschen</a>
                                    <?php echo Form::open(['method' => 'DELETE','route' => ['pages.destroy', $page->id],'style'=>'display:inline', 'id'=>'delete-form'.$page->id]); ?>

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

<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/pages/list.blade.php ENDPATH**/ ?>