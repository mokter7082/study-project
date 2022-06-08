<?php $__env->startSection('title', 'Admin Management'); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-9 pl5 pr5">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">User Details</h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('admin-create')): ?>
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="<?php echo e(route('admin.index')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-list"></i>
                                        <span>User List</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="m-portlet__body">
                    <div class="form-group m-form__group">
                        <label for="email">User Name / Email</label>
                         <div class="form-control m-input m-input--square">
                           <?php echo e($admin->email ?? 'N/A'); ?>

                        </div>
                    </div> 
                    <div class="form-group m-form__group">
                        <label for="name">Full Name</label>
                        <div class="form-control m-input m-input--square">
                           <?php echo e($admin->name ?? 'N/A'); ?>

                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="mobile">Mobile No / Phone :</label>
                        <div class="form-control m-input m-input--square">
                             <?php echo e($admin->mobile ?? 'N/A'); ?>

                        </div>                   
                    </div>
                    <div class="form-group m-form__group">
                        <label for="user_type">User Type (Role) :</label>
                        <div class="form-control m-input m-input--square">
                            <?php if(!empty($admin->getRoleNames())): ?>
                                <?php $__currentLoopData = $admin->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <label class="m-badge m-badge--success m-badge--wide"><?php echo e($v); ?></label>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Address</label>
                        <div class="form-control m-input m-input--square">
                            <?php echo e($admin->address??''); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3 pl5 pr5">
            <div class="m-portlet m-portlet--tab mb10">
                <div class="m-portlet__head">
                  <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                      <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                      </span>
                      <h3 class="m-portlet__head-text">
                        Publish
                      </h3>
                    </div>
                  </div>
                </div>
                <div class="m-portlet__body right-bar">
                  <div class="form-group m-form__group">
                    <label for="status">Status</label>
                    <div class="form-control m-input m-input--square">
                        <?php echo e($admin->status??''); ?>

                    </div> 
                  </div> 
                </div>
            </div>
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide"> <i class="la la-gear"></i> </span>
                            <h3 class="m-portlet__head-text"> Feature Image </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body right-bar">
                    <div class="form-group m-form__group"> 
                        <img src="<?php echo e($admin->image !=''? URL::to('img/'.$admin->image): URL::to('img/default-user.jpg')); ?>" height="200" alt="Image preview..."  class="preview-img" data-toggle="m-tooltip" title="Please select <b>Image</b>" data-html="true" data-placement="left">
                    </div>                   
                </div>
           </div>                  
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/admins/show.blade.php ENDPATH**/ ?>