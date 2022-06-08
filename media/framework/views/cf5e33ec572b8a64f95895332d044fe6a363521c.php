<?php $__env->startSection('title', 'Pages Management'); ?>
<?php $__env->startSection('content'); ?>
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Quotation List</h3>
            </div>
        </div>

        <div class="m-portlet__head-tools">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('book-create')): ?>
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="<?php echo e(route('posts.create')); ?>" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
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
                    <th width="50">Sl.</th> 
                    <th>Equipment Name</th>       
                    <th>Standard for 240 Hours/Month (Equipment)</th>       
                    <th>Working days</th>       
                    <th>Total Amount for Equipment</th>       
                    <th>Operator Fooding & Maintanace (8h/Day)</th>       
                    <th>Movement, Lowbed Cost, Insallation Cost</th>       
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody> 

            </tbody>
        </table> 
    </div> 


  <form class="form">
    <div class="d-flex">
        <div class="form-group">
              <div class="col-sm-12">
                  <select class="c_selectpicker form-control" id="selectedValue">
                      <option value="">Select Product</option>
                      <?php $__currentLoopData = $equipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($data->id); ?>"><?php echo e($data->title??''); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
             </div>
        </div>
        <div class="form-group">
              <div class="col-sm-12">
              <input type="text" class="form-control-plaintext bordered" name="location" id="location" placeholder="Location">
             </div>
        </div>
        <div class="form-group">
              <div class="col-sm-12">
              <input type="text" class="form-control-plaintext bordered datePicker" id="start_date" name="start_date" placeholder="Start Date">
             </div>
        </div>
        <div class="form-group">
              <div class="col-sm-12">
              <input  type="text" class="form-control-plaintext bordered datePicker" id="end_date"  name="end_date" placeholder="End Date">
             </div>
        </div>
        <div class="form-group">
          <div class="col-sm-12">
            
           <input type="button" id="storeData" class="btn btn-primary" value="Add new" >
           <input type="button" id="update" class="btn btn-warning d-none" value="Update" >
         </div>
       </div>
     </div>
  </form>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    $(".datePicker").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true,
        startDate: "today",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $('.delItem').click(function(e) {
        e.preventDefault; 
        var formId = $(this).data('delform'); 
        swalConfirm().then((result) => {
          if (result.value) { 
            $('#'+formId).submit();
          }
        })
    }) 


    $.ajaxSetup({
      headers: { 'X-CSRF-Token' : '<?php echo e(csrf_token()); ?>' }
    });
    $('#storeData').click(function(e) {
        e.preventDefault(); 
        var equivmentId = $('#selectedValue').find(":selected").val();
        var location = $("#location").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val(); 
        var data = {
                "equivmentId":equivmentId,
                "location":location,
                "start_date":start_date,
                "end_date":end_date,
        
        }; 
        var url ="<?php echo e(route('get_eqv_data')); ?>"; 

        makeAjaxPost(data, url, load=null).then(response =>{
            // console.log(response);
            $('.form').trigger("reset");
            $("tbody").append(response.data);
        });  
    })

    
    $('#update').click(function(e){
        // var obj = $(this).closest('tr');
        var location = $("#location").val();
        var start_date = $("#start_date").val();
        var end_date = $("#end_date").val();
        console.log('start_date',start_date) 
        console.log(parseInt(start_date)) 
        var date1 = new Date(start_date);
        var date2 = new Date(end_date);
        console.log(date1);
        var timeDiff = date2.getTime() - date1.getTime();
        // alert(timeDiff);

        var eqv_name = $('.title').val();
    
         
    });

      //ADD NEW EQUIVMENT ROUTER
 
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/quotation/list.blade.php ENDPATH**/ ?>