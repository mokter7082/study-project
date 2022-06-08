<?php $__env->startSection('title', 'Verwaltung von Kurstypen'); ?>
<?php $__env->startSection('content'); ?> 

<div class="row"> 
    <div class="col-md-12 pl5 pr5">
        <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Verwaltung von Kurstypen</h3>
                    </div>
                </div>

                <div class="m-portlet__head-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course-type-create')): ?>
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="<?php echo e(route('course-types.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-plus"></i>
                                    <span>Erstelle neu</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="m-portlet__body right-bar">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                    <thead>
                        <tr>
                            <th width="50">Sl. Nein.</th> 
                            <th width="70">Bild</th> 
                            <th>Titel</th>                    
                            <th>Schnecke</th>
                            <th width="5%">Status</th>
                            <th width="5%">Aktionen</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php $__currentLoopData = $ctypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ctype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>  
                                <td tabindex="0"><?php echo e(++$key); ?></td> 
                                <td>
                                    <img src="<?php echo e(isset($ctype) && $ctype->picture !=''? $ctype->picture: URL::to('images/default.jpg')); ?>" class="m--marginless" alt="photo">  
                                </td> 
                                <td tabindex="2" width="50%"><?php echo $ctype->title??''; ?></td>
                                                        
                                <td tabindex="2"><?php echo $ctype->slug??''; ?></td>                         
                                <td><label class="m--font-bold m--font-primary"><?php echo e($ctype->status??''); ?></label></td>
                                <td nowrap="" align="center">
                                    <?php if((auth()->user()->can('course-type-delete') || auth()->user()->can('course-type-edit'))): ?>
                                    <span class="dropdown">
                                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course-type-edit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('course-types.edit',$ctype->id)); ?>"><i class="la la-edit"></i> Bearbeiten </a>
                                            <?php endif; ?>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('course-type-delete')): ?>
                                            <a class="dropdown-item delItem" data-delform="delete-form<?php echo e($ctype->id); ?>" href="#<?php echo e(route('course-types.destroy', $ctype->id)); ?>"><i class="la la-trash"></i>Löschen</a>
                                            <?php echo Form::open(['method' => 'DELETE','route' => ['course-types.destroy', $ctype->id],'style'=>'display:inline', 'id'=>'delete-form'.$ctype->id]); ?>

                                            <?php echo Form::close(); ?>

                                            <?php endif; ?>
                                        </div>
                                    </span>
                                    <?php endif; ?> 
                                </td>
                            </tr>
                            <?php if(count($ctype->childs)): ?>
                                <?php echo $__env->make('backend.ctypes.child', ['childs' => $ctype->childs, 'serpart'=>1], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table> 
            </div>
        </div> 
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script> 
    $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        ordering: false, 
        pageLength: 30
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
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/ctypes/list.blade.php ENDPATH**/ ?>