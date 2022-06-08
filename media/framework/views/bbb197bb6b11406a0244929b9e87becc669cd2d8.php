<?php $__env->startSection('title', 'Page Management'); ?>
<?php $__env->startSection('content'); ?>  
<div class="row">
    <div class="col-md-8 pl5 pr5">
        <div class="m-portlet m-portlet--tab"> 
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Menu Management</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <button  class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air" id="saveOrder"> Save Order</button> 
                </div>
            </div>
            <div class="m-portlet__body"> 
                <div class="form-group mb-4" style="display: none;">
                    <div class="row mb-4">
                        <label class="font-normal col-md-6 pt-3 text-right" for="module"><strong>Menu Modules </strong></label>
                        <div class="col-md-6">
                            <?php echo Form::select('nav_module', ['1'=>'Main Nav', '2'=>'Footer Nav'], 1, array('class' =>'form-control', 'id'=>'navModule')); ?> 
                        </div>
                    </div> 
                </div> 
                <div class="dd" id="nestableNav">
                    <ol class='dd-list dd3-list' id="dd-placeholder"></ol>
                </div> 
            </div> 
        </div>
    </div>
    <div class="col-md-4 pl5 pr5">
        <?php echo Form::open(array('route' => 'admin.store-menu-item','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'id'=>'navForm', 'files' => true)); ?> 
            <div class="m-portlet m-portlet--tab mb10">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon m--hide">
                                <i class="la la-gear"></i>
                            </span>
                            <h3 class="m-portlet__head-text">Create New Menu </h3> 
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body right-bar">
                    <div class="form-group <?php echo e($errors->has('Menu Title') ? 'has-danger':''); ?>">  
                        <label class="font-normal" for="MenuLabel"><strong>Menu Title</strong> <span class="required">*</span></label>
                        <?php echo Form::text('label',  $nav_item->name??null, array('placeholder' => 'Menu Title', 'class' => 'form-control', 'id'=>'MenuLabel')); ?> 
                        <div class="form-control-feedback"><?php echo e($errors->first('label')); ?></div>
                    </div>

                    <div class="form-group mb-4 <?php echo e($errors->has('Menu Link') ? 'has-danger':''); ?>">
                        <label class="font-normal" for="MenuLink"><strong>Menu Link </strong>  <span class="required">*</span></label>
                        <div class="row">
                            <div class="col-md-10"> 
                                <input type="text" name="link" placeholder="Menu Link " id="MenuLink" class="form-control" value="<?php echo e(isset($nav_item->menu_url)?$nav_item->menu_url:''); ?>"  required>
                                <div class="help-block with-errors has-feedback"></div>
                            </div>
                            <div class="col-md-2">  
                                <button type="button" class="btn btn-primary linkbtn" data-toggle="modal" data-target="#navmodal"><i class="fa fa-link"></i></button>
                            </div>
                        </div> 
                    </div> 
                    <div class="form-group">
                        <label for="linktype"><strong>Menu Target</strong> <span class="required">*</span></label>
                        <?php echo Form::select('target', ['_self'=>'Self','_blank'=>'Blank'], $nav_item->target??old('target'), ['class'=>'form-control c_selectpicker m-input', 'id'=>'target', 'data-rel'=>'chosen']); ?> 
                    </div> 

                    <div id="moduleWrap" class="form-group  mb-4 <?php echo e(isset($nav_item->modules_id)?'no-action':''); ?>" style="display: none;">
                        <label class="font-normal" for="modules_id"><strong>Module For</strong> <span class="required">*</span></label>
                        <?php echo Form::select('modules_id', ['1' => 'Main Nav', '2' => 'Foter Nav']??[], $nav_item->modules_id??old('modules_id'), ['class'=>'form-control c_selectpicker m-input', 'id'=>'modules_id', 'data-rel'=>'chosen']); ?>  
                        <div class="help-block with-errors has-feedback"></div>
                    </div> 

                    <div class="form-group mb-4 <?php echo e($errors->has('icon') ? 'has-danger':''); ?>">
                        <label class="font-normal" for="icon"><strong>Icon Class </strong> <span class="required">(optional)</span></label> 
                        <input type="text" name="icon" placeholder="Icon Class" id="icon" class="form-control" value="<?php echo e(isset($nav_item->icon_class)?$nav_item->icon_class:''); ?>"> 
                        <div class="help-block with-errors has-feedback"></div>  
                    </div>  
                    
                    <div class="form-group">
                        <label for="status"><strong>Status</strong>  <span class="required">*</span></label>
                        <?php echo Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive'], $nav_item->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen', 'id'=>'status']); ?> 
                    </div> 
                    
                    <input type="hidden" name="menu_id" id="menu_id" value="<?php echo e(isset($nav_item->id)?$nav_item->id:''); ?>">
                    <div class="form-group m-form__group"> 
                        <button type="submit" class="btn btn-primary full-width">SUBMIT</button> &nbsp;
                        <button type="reset" id="reset" class="btn btn-warning full-width">RESET</button>  
                    </div>
                </div>
            </div> 
        <?php echo Form::close(); ?>   
    </div>
</div>

<div class="modal fade" id="navmodal" tabindex="-1" role="dialog" aria-labelledby="navModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="navModalLabel">Select Menu Label</h5>
                <button type="button" class="btn btn-secondary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air modal-close" data-dismiss="modal">Close</button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs m-tabs-line m-tabs-line--primary" role="tablist">
                    <?php if(isset($pages)): ?>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link active" data-toggle="tab" href="#nav_page" role="tab">Page</a>
                    </li> 
                    <?php endif; ?>
                    <?php if(isset($posts)): ?>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#nav_post" role="tab">Post</a>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($ctyps)): ?>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#nav_ctyp" role="tab">Course Type</a>
                    </li>
                    <?php endif; ?>
                    <?php if(isset($courses)): ?>
                    <li class="nav-item m-tabs__item">
                        <a class="nav-link m-tabs__link" data-toggle="tab" href="#nav_course" role="tab">Course</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="nav_page" role="tabpanel">
                        <table class="table m-table m-table--head-bg-brand">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="75%">Title</th> 
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$key); ?></th>
                                    <td><?php echo e($page->title ??''); ?></td>
                                    <td>
                                        <button type="button" data-link="<?php echo e(url($page->slug??'#')); ?>" data-dismiss="modal" class="btn btn-outline-primary btn-sm m-btn m-btn--icon m-btn--pill navbtn">Select</button>
                                    </td> 
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="nav_post" role="tabpanel">
                        <table class="table m-table m-table--head-bg-brand">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="75%">Title</th> 
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$key); ?></th>
                                    <td><?php echo e($post->title ??''); ?></td>
                                    <td>
                                        <button type="button" data-link="<?php echo e(url('post/'.$post->slug??'#')); ?>" data-dismiss="modal" class="btn btn-outline-primary btn-sm m-btn m-btn--icon m-btn--pill navbtn">Select</button>
                                    </td> 
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="nav_ctyp" role="tabpanel">
                        <table class="table m-table m-table--head-bg-brand">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="75%">Title</th> 
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                               <?php $__currentLoopData = $ctyps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $ctype): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$key); ?></th>
                                    <td><?php echo e($ctype->title ??''); ?></td>
                                    <td>
                                        <button type="button" data-link="<?php echo e(url('tanzkurse/'.$ctype->slug??'#')); ?>" data-dismiss="modal" class="btn btn-outline-primary btn-sm m-btn m-btn--icon m-btn--pill navbtn">Select</button>
                                    </td> 
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="nav_course" role="tabpanel">
                        <table class="table m-table m-table--head-bg-brand">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="75%">Title</th> 
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody> 
                                 <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e(++$key); ?></th>
                                    <td><?php echo e($course->title ??''); ?></td>
                                    <td>
                                        <button type="button" data-link="<?php echo e(url('courses/'.$course->slug??'#')); ?>" data-dismiss="modal" class="btn btn-outline-primary btn-sm m-btn m-btn--icon m-btn--pill navbtn">Select</button>
                                    </td> 
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?> 
<?php $__env->startPush('style'); ?>  
<style>
    .modal .modal-content .modal-body{
        padding-top: 0;
    }
    .modal .modal-content .modal-header{
        padding: 15px 25px
    }
    .modal-close:hover,
    .btn.m-btn--air.btn-secondary.modal-close:hover:not(:disabled):not(.active) {
        background:#f22d4e !important;
        border-color:#f22d4e !important;
    }
    #navModalLabel{
        margin-top: 10px;
    }
    .head-text{
        font-size: 16px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 5px;
        margin-bottom: 10px;
    }
    .linkbtn{
        position: absolute;
        right: 15px;
        top: 0;
    }
    .no-action{
        pointer-events: none;
    }
    .btn.btn-outline-primary{
        border-color: #e7e7e7;
        color: #333;
        padding: 3px 8px;
    }
    .btn.btn-outline-primary:hover,
    .btn.btn-outline-primary:active,
    .btn.btn-outline-primary:focus{
        border-color: #5867dd;
        color: #fff;
        padding: 3px 8px;
    }
    .m-table.m-table--head-bg-brand thead th{
        padding: 4px 10px;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>  
<script>  
    var makeNav =''; 
    $(document).ready(function(){ 
        
        $.ajaxSetup({
          headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
 
        //Build Menu Tree
        makeNav = function($module){
            var data = {'module':$module};
            var url = "<?php echo e(route('admin.menu-items')); ?>";
            makeAjaxPost(data, url ,null).then(function (response) {
                if (response.data.length>0) {
                    var obj = JSON.stringify(response.data);  

                    //'[{"id":1, "title":"home"},{"id":2, "title":"about"},{"id":3, "title":"service", "children":[{"id":4, "title":"company"},{"id":5,  "title":"contact"}]}]';

                    var output = '';

                    $.each(JSON.parse(obj), function (index, item) {
                        output += buildItem(item);
                    });

                    $('#dd-placeholder').html(output);

                    $('#nestableNav').nestable({group:1});
                }
            });
        };

        //call  Menu Tree
        var navmodule = $('#navModule').val(); 
        makeNav(navmodule);
 
        $('#navModule').change(function () {
            var moduleval = $(this).val();
            makeNav(moduleval);
        });


        //Build Function
        function buildItem(item) {
            var html = "<li class='dd-item ' data-id='" + item.id + "'>"+
                "<div class='dd-handle dd-nodrag'>";

                html += "<div class='btn-group float-right'><button class='btn btn-sm btn-secondary editbtn' onclick='editItem(this)' data-id='"+ item.id +"'>Edit</button>";
                if (!item.children) {
                    html += "<button class='btn btn-sm btn-secondary deletebtn' onclick='deleteItem(this)'  data-id='"+ item.id +"'><i class='fa fa-trash'></i></button>";
                }
                html += "</div>";

            var icon = ' fa-caret-left';
            if ( item.icon_class !='' && item.icon_class !=null){ icon = item.icon_class; }else{icon = ' fa-caret-left'; }

            html += "<span class='label label-info'><i class='fa "+ icon +"'></i></span><span>"+item.name +"</span></div>";

            if (item.children) {
                html += "<ol class='dd-list'>";
                $.each(item.children, function (index, sub) {
                    html += buildItem(sub);
                });
                html += "</ol>";
            }

            html += "</li>";
            return html;
        }

        //select link
        $('.navbtn').click(function(e) {
            var $link = $(this).data('link');
            $('#MenuLink').val($link);
        })

        /*
         * Save Menu Order
         */
        $('#saveOrder').click(function () { 

            //ladda add on salary wages head  
            var $l = $(this).ladda();
            $l.ladda('start');

            var serializeItem = $('#nestableNav').nestable('serialize');
            var url = "<?php echo e(route('admin.save-menu-order')); ?>";
            var data = {'menus':serializeItem};
            var redirectUrl = window.location;

            makeAjaxPost(data, url, $l).then(function (response) {
                if (response.status =='success'){
                    swalRedirect(redirectUrl,'Menu order successfully', 'success');
                }else{
                    swalRedirect(redirectUrl,'Something wrong, please try later', 'error');
                }
            });
        });


        $('#reset').click(function (e) {
            e.preventDefault();
            location.reload();
        });


        <?php if(!empty(Session::get('succ_msg'))): ?>
            var popupId = "<?php echo e(uniqid()); ?>";
            if(!sessionStorage.getItem('shown-' + popupId)) {
                swalSuccess("<?php echo e(Session::get('succ_msg')); ?>");
            }
            sessionStorage.setItem('shown-' + popupId, '1');
        <?php endif; ?>
    });

    //Edit Menu Item
    function editItem(elem){
        swalConfirm('Edit this item?').then(function (s) {
            if (s.value){
                var id = $(elem).data("id");
                var url = "<?php echo e(route('admin.edit-menu-item')); ?>";
                var data = {'id':id};
                makeAjaxPost(data, url, null).then(function (response) { 
                    $('#menu_id').val(response.data.id);
                    $('#MenuLabel').val(response.data.name);  
                    $('#modules_id').val(response.data.modules_id).trigger('change');
                    $('#MenuLink').val(response.data.menu_url);
                    $('#icon').val(response.data.icon_class);
                    $('#target').val(response.data.target).trigger('change');
                    $('#status').val(response.data.status).trigger('change');
                    //$('#desc').val(response.data.menus_description); 
                    
                    $('#moduleWrap').addClass('no-action');
                    $('#modules_id').attr("readonly","true"); 
                    $("#navForm").validator('update');
                });
            }
        })
    }

    //delete Items
    function deleteItem(elem){
        swalConfirm('Edit this item?').then(function (s) {
            if (s.value){
                var id = $(elem).data("id");
                var url = "<?php echo e(route('admin.delete-menu-item')); ?>";
                var data = {'id':id};
                var redirectUrl = window.location;
                makeAjaxPost(data, url, null).then(function (response) {
                    if(response.status=="success"){
                        swalSuccess('Menu item deleted successfully');
                        var modudle = $('#navModule').val();
                        makeNav(modudle); 
                    }else{
                        swalRedirect(redirectUrl, "Something wrong please try again", "error")
                    }
                });
            }
        })
    }  
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app-backend', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\bdrentz\resources\views/backend/MenuManager/menu_list.blade.php ENDPATH**/ ?>