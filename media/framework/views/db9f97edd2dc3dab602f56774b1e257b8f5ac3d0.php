<?php $__env->startSection('title', 'Locations Management'); ?>
<?php $__env->startSection('content'); ?> 

<div class="row">
    <div class="col-md-7 pl5 pr5">
         <?php if(isset($location->id)): ?>
            <?php echo Form::model($location, ['method' => 'PATCH','route' => ['locations.update', $location], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]); ?>

        <?php else: ?>
            <?php echo Form::open(array('route' => 'locations.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)); ?> 
        <?php endif; ?>
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text"><?php echo e(isset($location->id)?'Edit':'Create New'); ?> Locations</h3>
                    </div>
                </div> 
            </div>
            <div class="m-portlet__body"> 
                <div class="form-group <?php echo e($errors->has('title') ? 'has-danger':''); ?>"> 
                    <?php echo Form::label('title', 'Location Name'); ?>

                    <?php echo Form::text('title',  $location->title??null, array('placeholder' => 'Enter location name','class' => 'form-control m-input', 'id'=>'title')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('title')); ?></div>
                </div> 

                <div class="form-group <?php echo e($errors->has('description') ? 'has-danger' : ''); ?>">
                    <?php echo Form::label('description', 'Description'); ?>

                    <?php echo Form::textarea('description', $location->description??'', array('class' => 'form-control m-input', 'rows'=>'2', 'id'=>'editor')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('description')); ?></div>
                </div> 
 
                <div class="form-group ">
                    <label for="status">Status</label>
                    <?php echo Form::select('status', ['Active'=>'Active','Inactive'=>'Inactive'], $location->status??'', array('class'=>'form-control c_selectpicker m-input')); ?>

                </div> 
            </div> 
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Submit Now</button>
                </div>
            </div>
        </div>
        <?php echo Form::close(); ?>

    </div>
    <div class="col-md-5 pl5 pr5">
        <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">Locations List</h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body right-bar">
                <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                    <thead>
                        <tr>  
                            <th>Title</th>  
                            <th>Status</th>
                            <th width="15%">Actions</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>  
                                <td tabindex="2" width="70%"><?php echo $location->title??''; ?></td>                          
                                <td width="15%"><label class="m--font-bold m--font-primary"><?php echo e($location->status??''); ?></label></td>
                                <td width="15%" nowrap="" align="center">
                                    <?php if((auth()->user()->can('location-delete') || auth()->user()->can('location-edit'))): ?>
                                    <span class="dropdown">
                                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('location-edit')): ?>
                                            <a class="dropdown-item" href="<?php echo e(route('locations.edit',$location->id)); ?>"><i class="la la-edit"></i> Edit </a>
                                            <?php endif; ?>
                                            
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('location-delete')): ?>
                                            
                                            <a class="dropdown-item" href="#<?php echo e(route('categories.destroy', $location->id)); ?>"
                                                onclick="event.preventDefault(); document.getElementById('delete-form<?php echo e($location->id); ?>').submit();
                                            "><i class="la la-trash"></i>Delete</a>

                                            <?php echo Form::open(['method' => 'DELETE','route' => ['locations.destroy', $location->id],'style'=>'display:inline', 'id'=>'delete-form'.$location->id]); ?>

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
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/locations/create.blade.php ENDPATH**/ ?>