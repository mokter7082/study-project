<?php $__env->startSection('title', 'Course Management'); ?>
<?php $__env->startSection('content'); ?> 

<?php if($errors->any()): ?>
    <?php echo implode('', $errors->all('<div>:message</div>')); ?>

<?php endif; ?>


<?php if(isset($course->id)): ?>
	<?php echo Form::model($course, ['method' => 'PATCH','route' => ['equipments.update', $course->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]); ?>

<?php else: ?>
	<?php echo Form::open(array('route' => 'equipments.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)); ?> 
<?php endif; ?>
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">  
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text"><?php echo e(isset($course->id)?'Edit':'Create a new '); ?> Equipment</h3>
                    </div>
                </div> 
                <div class="m-portlet__head-tools">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('category-list')): ?>
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="<?php echo e(route('equipments.index')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>See All Equipment</span>
                                 
                                </span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group <?php echo e($errors->has('title') ? 'has-danger':''); ?>"> 
                    <?php echo Form::label('title', 'Equipment Name *'); ?>

                    <?php echo Form::text('title', $equipment->title??'', array('placeholder' => 'Enter Equipment Name','class' => 'form-control m-input', 'required'=>true, 'id'=>'title')); ?> 
                    <div class="form-control-feedback"><?php echo e($errors->first('title')); ?></div>
                </div>
                <div class="row">
                   
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('start_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('price_for_30_days', 'Price For 30 Days'); ?>

                            <?php echo Form::number('price_for_30_days', $equipment->price_30??'', array('class' => 'form-control calculatAvgMonthly', 'required'=>true, 'id'=>'price_for_30_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('start_time')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('price_for_15_days','Price For 15 Days'); ?>

                            <?php echo Form::number('price_for_15_days', $equipment->price_15??'', array('class' => 'form-control m-input time_pick calculatAvgTwoWeek', 'required'=>true, 'id'=>'price_for_15_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('price_for_7_days', 'Price For 7 Days'); ?>

                            <?php echo Form::number('price_for_7_days', $equipment->price_7??'',array('class' => 'form-control m-input calculatAvgWeekly', 'required'=>true, 'id'=>'price_for_7_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('price_for_1_days', 'Price For 1 Days'); ?>

                            <?php echo Form::number('price_for_1_days', $equipment->price_per_day??'', array('class' => 'form-control m-input time_pick', 'required'=>true, 'id'=>'price_for_1_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('location_id') ? 'has-danger':''); ?>"> 
                            <?php echo Form::label('category_id', 'Equipment Category'); ?>

                            <?php echo Form::select('category_id', $categories, $equipment->category_id??old('category_id'), ['class'=>'form-control c_selectpicker m-input', 'placeholder'=>'--Select Equipment Category--', 'data-rel'=>'chosen']); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('category_id')); ?></div>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('operator_fooding_cost', 'Operator Fooding Cost'); ?>

                            <?php echo Form::number('operator_fooding_cost',$equipment->fooding_cost??'', array('class' => 'form-control m-input time_pick', 'required'=>true, 'id'=>'operator_fooding_cost')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>

                     <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('avarage_for_30_days', 'Average For 30 Days'); ?>

                            <?php echo Form::number('avarage_for_30_days',$equipment->avg_30??'', array('class' => 'form-control m-input getAvgMonthly', 'required',"readonly"=>true, 'id'=>'avarage_for_30_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('avarage_for_15_days', 'Average For 15 Days'); ?>

                            <?php echo Form::number('avarage_for_15_days',$equipment->avg_15??'', array('class' => 'form-control m-input getAvgTwoWeek', 'required','readonly'=>true, 'id'=>'avarage_for_15_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group <?php echo e($errors->has('end_time') ? 'has-danger' : ''); ?>"> 
                            <?php echo Form::label('avarage_for_7_days', 'Average For 07 Days'); ?>

                            <?php echo Form::number('avarage_for_7_days',$equipment->avg_7??'', array('class' => 'form-control m-input getAvgTwoWeekly', 'required','readonly'=>true, 'id'=>'avarage_for_7_days')); ?> 
                            <div class="form-control-feedback"><?php echo e($errors->first('end_time')); ?></div>
                        </div> 
                    </div>
                    
                </div>   
                
                
                
                
                
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Add Equipment</button>
                </div>
            </div>
        </div>
    </div>




    <div class="col-md-3 pl5 pr5">
        <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                
            </div>
            <div class="m-portlet__body right-bar">   
                <label for="status">Feature Image</label> 
                        <div class="form-group <?php echo e($errors->has('picture') ? 'has-danger' : ''); ?>">  
                            <button id="lfm" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows" style="max-width: 140px"> 
                                <div class="holder" id="mediaHolder"> 
                                    <img src="<?php echo e($category->picture?? URL::to('images/default.jpg')); ?>">
                                </div>
                                <input id="mediaThumbnail" hidden="" value="<?php echo e($category->picture?? URL::to('images/default.jpg')); ?>"  type="text" name="picture">
                            </button>  
                            <div class="form-control-feedback"><?php echo e($errors->first('picture')); ?></div>
                        </div>

                

                <div class="form-group">
                    <label for="status">Status</label>
                    <?php echo Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive', 'required'=>true], $course->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']); ?> 
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
    // var input = document.querySelector('input[name=meta_key]'); 
    // new Tagify(input);


    $("#start_time").timepicker({
        minuteStep: 1,
        showSeconds: !1,
        showMeridian: !1,
    });
     
    $("#end_time").timepicker({
        minuteStep: 1,
        showSeconds: !1,
        showMeridian: !1,
    });
     
 
    //image browse form media
    var route_prefix = "<?php echo e(url('/bdrentz-admin/media-file')); ?>";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "<?php echo e(url('images/default.jpg')); ?>");
    })

    //Datepicker
    $("#close_date").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true,
        startDate: "today",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $("#available_date").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true, 
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $('.time_pick').change(function(e) {        
        var start_time = moment($('#start_time').val(), 'HH:mm'); 
        var end_time = moment($('#end_time').val(), 'HH:mm'); 

        var durtion = moment.utc(moment(end_time,"HH:mm:ss").diff(moment(start_time,"HH:mm:ss"))).format("HH:mm"); 
        var minutes = moment.duration(durtion).asMinutes(); 

        if ( start_time  > end_time ) {
            //swalError('Sorry please correct input');
            //$(this).val(0);
        }else{
            $('#clss_duration').val(minutes);
        }  
    })

    $('#wklist > label').click(function(e) {  
        if ($(this).hasClass('selected')) {
            $(this).find("input[type='checkbox']").prop('checked', false);
        }else{
            $(this).find("input[type='checkbox']").prop('checked', true);
        } 
        $(this).toggleClass('selected'); 
        return false;
    })
     

    //Datepicker
    $(".schpicker").datepicker({
        todayHighlight: !0,
        format: 'yyyy-m-d',
        autoclose: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $(document).on("click",".addSchDate", function(e) {
        if ($(this).closest('tr').find('.schpicker').val() !='') {
            var $clone = $(this).closest('tr').clone(); 
            $clone.find(':text').val('');  
            $clone.appendTo("#scheduleTable");

            $(this).addClass('removeSchDate').removeClass('addSchDate'); 

            $(".schpicker").datepicker({
                todayHighlight: !0,
                format: 'yyyy-m-d',
                autoclose: true,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            })
        }else{
            swalError('Sory! please input date');
        } 
    })

    $(document).on("click",".removeSchDate", function(e) {
        $(this).closest('tr').remove();
    }) 
  //image browse form media
  var route_prefix = "<?php echo e(url('/bdrentz-admin/media-file')); ?>";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "<?php echo e(url('images/default.jpg')); ?>");
    })




    // FIND MONTHLY AVARAGE
    $('.calculatAvgMonthly').blur(function(e){
        var value = e.target.value;
        var newValue = Math.floor(value/30);
        $(".getAvgMonthly").val(newValue);
        //  alert('are you book now?')
    });
  // FIND TWO TWOWEEK AVARAGE
   $('.calculatAvgTwoWeek').blur(function(e){
        var value = e.target.value;
        var newValue = Math.floor(value/15);
        $(".getAvgTwoWeek").val(newValue);
    });
   
  // FIND TWO TWOWEEKly AVARAGE
   $('.calculatAvgWeekly').blur(function(e){
        var value = e.target.value;
        var newValue = Math.floor(value/7);
        $(".getAvgTwoWeekly").val(newValue);
    });


</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/courses/create.blade.php ENDPATH**/ ?>