<?php $__env->startSection('title', 'Admin Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
   <div class="m-portlet__head">
      <div class="m-portlet__head-caption">
         <div class="m-portlet__head-title">
            <h3 class="m-portlet__head-text"> Admin Management </h3>
         </div>
      </div>
      <div class="m-portlet__head-tools">
         <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-create')): ?> 
         <ul class="m-portlet__nav">
            <li class="m-portlet__nav-item">
               <a href="<?php echo e(route('admin.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
      <table class="table table-striped- table-bordered table-hover table-checkable" id="usertable">
         <thead>
            <tr>
               <th>User ID</th> 
               <th>Email</th>
               <th>Mobile</th>
               <th>User Role</th>               
               <th>Status</th>
               <th>Actions</th>
            </tr>
         </thead>
         <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
               <td tabindex="0" class="sorting_1">
                  <div class="m-card-user m-card-user--sm">
                     <div class="m-card-user__pic">
                        <?php ($img = isset($admin->image)?$admin->image:'default-user.jpg'); ?>
                        <img src="<?php echo e(asset('img/'.$img)); ?>" class="m--img-rounded m--marginless" alt="photo">
                     </div>
                     <div class="m-card-user__details">
                        <span class="m-card-user__name"><?php echo e($admin->name ?? 'N/A'); ?></span>
                        <a class="m-card-user__email m-link"><?php echo e($admin->email ?? 'N/A'); ?></a>
                     </div>
                  </div>
               </td> 
               <td><?php echo e($admin->email ??'N/A'); ?></td>
               <td><?php echo e($admin->mobile ??'N/A'); ?></td>               
               <td>
                  <?php if(!empty($admin->getRoleNames())): ?>
                     <?php $__currentLoopData = $admin->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                         <label class="m-badge m-badge--primary m-badge--wide"><?php echo e($v); ?></label>
                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?> 
               </td>
               <td>
                  <?php if($admin->status ==1): ?>
                     <label class="m--font-bold m--font-primary">Active</label>
                  <?php else: ?>
                     <label class="m--font-bold m--font-primary">Inactive</label>
                  <?php endif; ?>
               </td>
               <td nowrap="" align="center">
                  <?php if($admin->id !=1 && (auth()->user()->can('admin-delete') || auth()->user()->can('admin-edit'))): ?>

                     <span class="dropdown">
                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                        <div class="dropdown-menu dropdown-menu-right">  
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-edit')): ?>                     
                           <a class="dropdown-item" href="<?php echo e(route('admin.edit',$admin->id)); ?>"><i class="la la-edit"></i> Edit </a>
                           <?php endif; ?>
                           
                           <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-delete')): ?>
                           <a class="dropdown-item" href="#<?php echo e(route('admin.destroy', $admin->id)); ?>"
                              onclick="event.preventDefault(); document.getElementById('user-delete-form<?php echo e($admin->id); ?>').submit();
                              "><i class="la la-trash"></i>Delete</a>

                                <?php echo Form::open(['method' => 'DELETE','route' => ['admin.destroy', $admin->id],'style'=>'display:inline', 'id'=>'user-delete-form'.$admin->id]); ?>

                                <?php echo Form::close(); ?>

                           <?php endif; ?>
                        </div>
                     </span>
                  <?php endif; ?>

                  <a href="<?php echo e(route('admin.show',$admin->id)); ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="m-tooltip" title="View Details" data-html="true" data-placement="left">
                         <i class="la la-external-link"></i>
                       </a>
                       
               </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                            
         </tbody>
      </table>
      <?php echo $data->render(); ?> 
   </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
   <script>
      $("#usertable").DataTable({
         responsive: !0,
         paging: !0,
      });
   </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/admins/index.blade.php ENDPATH**/ ?>