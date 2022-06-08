<?php $__env->startSection('title', 'Admin Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text"> Customer Management </h3>
            </div>
        </div>
        <div class="m-portlet__head-tools">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('user-crate')): ?>
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="<?php echo e(route('users.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
        <!--begin: Datatable -->
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Info</th> 
                    <th>Phone</th> 
                    <th>Address</th>
                    <th>Postcode</th>
                    <th>City</th> 
                    <th>Status</th>
                    <th>Actions</th>
                </tr> 
            </thead>
            <tbody>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td>#<?php echo e($user->id ??''); ?></td>
                    <td tabindex="0" class="sorting_1">
                        <div class="m-card-user m-card-user--sm">
                            <div class="m-card-user__pic">
                                <?php ($img = isset($user->image)?env('IMG_URL').'/'.$user->image:URL::to('backend/images/preview.png')); ?>
                                <img src="<?php echo e($img); ?>" class="m--img-rounded m--marginless" alt="photo">
                            </div>
                            <div class="m-card-user__details">
                                <span class="m-card-user__name"><?php echo e($user->name ?? 'N/A'); ?></span>
                                <a class="m-card-user__email m-link"><?php echo e($user->email ?? 'N/A'); ?></a>
                            </div>
                        </div>
                    </td> 
                    <td><?php echo e($user->phone ??''); ?></td>   
                    <td><?php echo e($user->address ??''); ?></td>
                    <td><?php echo e($user->postcode ??''); ?></td>
                    <td><?php echo e($user->city ??''); ?></td>
                    <td>
                        <?php if($user->status =='Active'): ?>
                        <label class="m--font-bold m--font-primary">Active</label>
                        <?php else: ?>
                        <label class="m--font-bold m--font-primary">Inactive</label>
                        <?php endif; ?>
                    </td>
                    <td nowrap="" align="center">
                        <?php if( (auth()->user()->can('user-delete') || auth()->user()->can('user-edit'))): ?>
                        <span class="dropdown">
                            <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-edit')): ?>
                                <a class="dropdown-item" href="<?php echo e(route('users.edit',$user->id)); ?>"><i class="la la-edit"></i> Edit </a>
                                <?php endif; ?>
                                
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-delete')): ?>
                                <a class="dropdown-item" href="#<?php echo e(route('users.destroy', $user->id)); ?>"
                                    onclick="event.preventDefault(); document.getElementById('delete-form<?php echo e($user->id); ?>').submit();
                                "><i class="la la-trash"></i>Delete</a>
                                <?php echo Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline', 'id'=>'delete-form'.$user->id]); ?>

                                <?php echo Form::close(); ?>

                                <?php endif; ?>
                            </div>
                        </span>
                        <?php endif; ?>
                        <a href="<?php echo e(route('users.show',$user->id)); ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                        <i class="la la-external-link"></i></a>                        
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo $users->links(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
<script>
$("#datatable").DataTable({
responsive: !0,
paging: !0,
});
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/users/index.blade.php ENDPATH**/ ?>