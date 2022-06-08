<?php $__env->startSection('title', 'News Management'); ?>
<?php $__env->startSection('content'); ?> 
<?php if(isset($news->id)): ?>
	<?php echo Form::model($news, ['method' => 'PATCH','route' => ['news.update', $news->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]); ?>

<?php else: ?>
	<?php echo Form::open(array('route' => 'news.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)); ?> 
<?php endif; ?>
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab"> 
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text"><?php echo e(isset($post->id)?'Edit':'Create New'); ?> News</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-list')): ?>
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="<?php echo e(route('news.index')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>All News</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group <?php echo e($errors->has('title') ? 'has-danger':''); ?>"> 
                    <?php echo Form::label('title', 'News Title *'); ?>

                    <?php echo Form::text('title',  $news->title??null, array('placeholder' => 'News Title','class' => 'form-control m-input', 'id'=>'title')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('title')); ?></div>
                </div>  

                <div class="form-group <?php echo e($errors->has('description') ? 'has-danger':''); ?>"> 
                    <?php echo Form::label('description', 'Description', array('class' => 'control-label')); ?> 
                    <?php echo Form::textarea('description', $news->description??null, ['id' => 'editor', 'rows' => 3,  'class' => 'form-control m-input']); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('description')); ?></div>
                </div>

                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div> 
                <div class="form-group <?php echo e($errors->has('excerpt') ? 'has-danger' : ''); ?>"> 
                    <?php echo Form::label('excerpt', 'Excerpt'); ?>

                    <?php echo Form::text('excerpt',  $news->excerpt??'', array('class' => 'form-control m-input', 'id'=>'excerpt')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('excerpt')); ?></div>
                </div>  
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Submit Now</button>
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
                        <h3 class="m-portlet__head-text"> Publish </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body right-bar"> 
                <div class="form-group">
                    <label for="status">Status</label>
                    <?php echo Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive'], $news->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']); ?> 
                </div> 
            
                <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info">Submit Now</button>
                </div>
            </div>
        </div> 
         <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text"> Feature Image </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body right-bar"> 
                <div class="m-portlet__body right-bar"> 
                    <div class="form-group m-form__group <?php echo e($errors->has('picture') ? 'has-danger' : ''); ?>">  
                        <button id="lfm" type="button" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows"> 
                            <div class="holder" id="mediaHolder"> 
                                <img src="<?php echo e($news->picture?? URL::to('images/default.jpg')); ?>">
                            </div>
                            <input id="mediaThumbnail" hidden="" value="<?php echo e($news->picture?? URL::to('images/default.jpg')); ?>" type="text" name="picture">
                        </button>  
                        <div class="form-control-feedback"><?php echo e($errors->first('picture')); ?></div>
                    </div>  
                </div>
            </div>
        </div> 
    </div>
</div>
<?php echo Form::close(); ?>  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
 
    //image browse form media
    var route_prefix = "<?php echo e(url('/bdrentz-admin/media-file')); ?>";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "<?php echo e(url('images/default.jpg')); ?>");
    })

    //check if Exist
    $('#title').change(function(e) {
        e.preventDefault();
        var obj = $(this);
        var exist ="<?php echo e($news->id??''); ?>";
        var url = "<?php echo e(route('check-exist')); ?>";
        var csrf = $("input[name='_token']").val();

        $data = { 
            '_token' : csrf,
            'table':'news',
            'field':'title',
            'value':obj.val(),
            'exist':exist, 
        }

        makeAjaxPost( $data, url).then(function(response) {
            if(response.status =='errors'){
                obj.val(''); 
                toastr.error("Sorry! this books already exist"); 
            }
        });
    }) 
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/news/create.blade.php ENDPATH**/ ?>