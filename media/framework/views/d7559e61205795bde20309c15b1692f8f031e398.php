<?php $__env->startSection('title', 'Page Management'); ?>
<?php $__env->startSection('content'); ?> 
<?php if(isset($page->id)): ?>
	<?php echo Form::model($page, ['method' => 'PATCH','route' => ['pages.update', $page->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]); ?>

<?php else: ?>
	<?php echo Form::open(array('route' => 'pages.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)); ?> 
<?php endif; ?>
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab"> 
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text"><?php echo e(isset($page->id)?'Edit':'Neue Seite'); ?> erstellen</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-list')): ?>
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="<?php echo e(route('pages.index')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>All Page</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group <?php echo e($errors->has('title') ? 'has-danger':''); ?>"> 
                    <?php echo Form::label('title', 'Seitentitel *'); ?>

                    <?php echo Form::text('title',  $page->title??null, array('placeholder' => 'Seitentitel','class' => 'form-control m-input', 'id'=>'title')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('title')); ?></div>
                </div>  

                <div class="form-group <?php echo e($errors->has('description') ? 'has-danger':''); ?>"> 
                    <?php echo Form::label('description', 'Beschreibung', array('class' => 'control-label')); ?> 
                    <?php echo Form::textarea('description', $page->description??null, ['id' => 'editor', 'rows' => 3,  'class' => 'form-control m-input']); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('description')); ?></div>
                </div>

                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div> 
                <div class="form-group <?php echo e($errors->has('excerpt') ? 'has-danger' : ''); ?>"> 
                    <?php echo Form::label('excerpt', 'Auszug'); ?>

                    <?php echo Form::text('excerpt',  $page->excerpt??'', array('class' => 'form-control m-input', 'id'=>'excerpt')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('excerpt')); ?></div>
                </div> 

                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>  
               
                <div class="row mt10">
                    <div class="col-md-12">
                        <div class="form-group <?php echo e($errors->has('meta_title') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('meta_title', 'Meta-Titel'); ?>

                            <?php echo Form::text('meta_title', $page->meta->meta_title??'', array('class' => 'form-control m-input', 'id'=>'meta_title')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('meta_title')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group <?php echo e($errors->has('meta_key') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('meta_key', 'Meta-Schlüsselwort *'); ?>

                            <?php echo Form::text('meta_key',  $page->meta->meta_key??'', array('class' => 'form-control m-input', 'id'=>'meta_key')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('meta_key')); ?></div>
                        </div> 
                    </div> 
                </div> 
                <div class="form-group <?php echo e($errors->has('meta_description') ? 'has-danger' : ''); ?>"> 
                    <?php echo Form::label('meta_description', 'Meta-Beschreibung'); ?>

                    <?php echo Form::textarea('meta_description', $page->meta->meta_description??'', array('class' => 'form-control m-input',  'rows'=>'2', 'id'=>'meta_description')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('meta_description')); ?></div>
                </div>  
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Jetzt Absenden</button>
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
                        <h3 class="m-portlet__head-text"> Veröffentlichen </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body right-bar">  
                <div class="form-group">
                    <label for="parent_id">Elternteil</label>
                    <?php echo Form::select('parent_id',$allPages??[], $page->parent_id??old('parent_id'), ['class'=>'form-control c_selectpicker m-input', 'placeholder'=>'Select Parent', 'data-rel'=>'chosen']); ?> 
                </div>  

                <div class="form-group">
                    <label for="template">Seitenlayouts</label>
                    <?php echo Form::select('template',$templates??[], $page->template??old('template'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']); ?> 
                </div>  

                <div class="form-group">
                    <label for="status">Status</label>
                    <?php echo Form::select('status', ['Active'=>'Aktiv', 'Inactive'=>'Inaktiv'], $page->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']); ?> 
                </div> 
            
                <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info">Jetzt Absenden</button>
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
                        <h3 class="m-portlet__head-text"> Funktionsbild </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body right-bar"> 
                <div class="m-portlet__body right-bar"> 
                    <div class="form-group m-form__group <?php echo e($errors->has('picture') ? 'has-danger' : ''); ?>">  
                        <button id="lfm" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows"> 
                            <div class="holder" id="mediaHolder"> 
                                <img src="<?php echo e($page->picture?? URL::to('images/default.jpg')); ?>">
                            </div>
                            <input id="mediaThumbnail" hidden="" value="<?php echo e($page->picture?? URL::to('images/default.jpg')); ?>"  type="text" name="picture">
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
    // The DOM element you wish to replace with Tagify
    var input = document.querySelector('input[name=meta_key]'); 
    new Tagify(input);

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
        var exist ="<?php echo e($page->id??''); ?>";
        var url = "<?php echo e(route('check-exist')); ?>";
        var csrf = $("input[name='_token']").val();

        $data = { 
            '_token' : csrf,
            'table':'pages',
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
   
    //Delete Gallery Images
    function delFeatureImage(elem){ 
        var $img = $(elem).data('img');
        var $id = $(elem).data('job_id');

        if ($id !=='') {
            Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#e60b00',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) { 
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "<?php echo e(route('pages.rmfimg')); ?>",
                        type: 'POST',
                        data: {_token: CSRF_TOKEN, img:$img,  book_id:$id},
                        dataType: 'JSON',                    
                        success: function (data) { 
                            if (data.status == 'success') {
                                Swal.fire(
                                  'Deleted!',
                                  'Your file has been deleted.',
                                  'success'
                                )
                            }else{
                                Swal.fire(
                                  'Sorry!',
                                  'Something wrong please try later.',
                                  'error'
                                )
                            }  

                            location.reload();      
                        } 
                    });  
                }
            }) 
        }
        else{
           location.reload();   
        }
  
        return false;
    }; 
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/pages/create.blade.php ENDPATH**/ ?>