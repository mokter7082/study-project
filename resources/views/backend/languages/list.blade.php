@extends('layouts.app-backend')
@section('title', 'Language Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Language Management</h3>
            </div>
        </div> 
        <div class="m-portlet__head-tools">
            @can('category-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('languages.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Create New</span>
                        </span>
                    </a>
                </li>
            </ul>
            @endcan
        </div>
    </div>

    <div class="m-portlet__body"> 
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr> 
                    <th style="width: 50px;">Sl No.</th> 
                    <th style="width: 120px;">Referance</th>
                    <th>English</th>
                    <th>Germany</th>  
                    <th style="width: 90px;">Status</th>
                    <th style="width: 70px;">Actions</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($languages as $key => $language)
                    <tr> 
                        <td>{{ ++$key }}</td>  
                        <td> {{$language->referance??''}} </td>  
                        <td><input type="text" disabled="" name="en_text" id="{{$language->referance.'_en_text'}}" class="text-input" value="{{$language->en_text??''}}"></td>
                        <td><input type="text" disabled=""  name="ger_text"  id="{{$language->referance.'_ger_text'}}" class="text-input" value="{{$language->ger_text??''}}"></td> 
                        <td>
                            <select name="status"  disabled="" class="text-input" id="{{$language->referance.'_status'}}">
                                <option value="Active" @if(isset($language->status) && $language->status == 'Active') selected  @endif>Active</option>
                                <option value="Inactive" @if(isset($language->status) && $language->status == 'Inactive') selected  @endif>Inactive</option>
                            </select>
                        </td>
                        <td align="center" class="actions">
                            <button 
                            data-en="{{$language->referance.'_en_text'}}"
                            data-ger="{{$language->referance.'_ger_text'}}" 
                            data-stts="{{$language->referance.'_status'}}" 
                            class="btn m-btn--pill btn-warning btn-sm m-btn m-btn--custom edit_btn"
                            >Edit</button>
                            <button  style="margin-bottom: 5px" 
                            data-en="{{$language->referance.'_en_text'}}"
                            data-ger="{{$language->referance.'_ger_text'}}" 
                            data-stts="{{$language->referance.'_status'}}" 
                            data-id="{{$language->id}}" 
                            data-referance="{{$language->referance}}" 
                            class="btn m-btn--pill btn-info no-display btn-sm m-btn m-btn--custom save_btn"
                            >Save</button>
                            <button 
                            data-en="{{$language->referance.'_en_text'}}"
                            data-ger="{{$language->referance.'_ger_text'}}" 
                            data-stts="{{$language->referance.'_status'}}" 
                           
                            class="btn m-btn--pill btn-danger no-display btn-sm m-btn m-btn--custom cancle_btn"
                            >Cancle</button>
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table> 
    </div>
</div>
@endsection

@push('scripts')
<script>
    $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        "ordering": false, 
        "pageLength": 50
    });

    $('.edit_btn').click(function(e) { 
        $(this).hide();
        $(this).parent('td').find('.save_btn').show();
        $(this).parent('td').find('.cancle_btn').show();

        var en_id = $(this).data('en');
        var ger_id = $(this).data('ger');
        var stts_id = $(this).data('stts'); 

        $('#'+en_id).attr("disabled", false); 
        $('#'+ger_id).attr("disabled", false);
        $('#'+stts_id).attr("disabled", false); 
    })

    $('.cancle_btn').click(function(e) { 
        $(this).hide();
        $(this).parent('td').find('.save_btn').hide();
        $(this).parent('td').find('.edit_btn').show();

       var en_id = $(this).data('en');
       var ger_id = $(this).data('ger');
       var stts_id = $(this).data('stts'); 

       $('#'+en_id).attr("disabled", true); 
       $('#'+ger_id).attr("disabled", true);
       $('#'+stts_id).attr("disabled", true); 
    })

    $('.save_btn').click(function(e) { 
        e.preventDefault(); 

        var en_id = $(this).data('en');
        var ger_id = $(this).data('ger');
        var stts_id = $(this).data('stts');  

        var en_text = $('#'+en_id).val(); 
        var ger_text = $('#'+ger_id).val(); 
        var status = $('#'+stts_id).val(); 

        var id = $(this).data('id'); 
        var referance = $(this).data('referance');  

        var post_data = {
            '_token':'<?php echo csrf_token() ?>',
            'en_text': en_text,
            'ger_text': ger_text, 
            'status': status,
            'ref_id': id,
            'rev_referance': referance,
        }

        Swal.fire({
          title: 'Are you sure?',
          text: "Edit this Items",
          icon: 'warning',
          showCancelButton: true, 
          confirmButtonText: 'Yes, edit it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type:'POST',
                    url:'{{url('languages')}}'+id,
                    data:post_data,
                    success:function(response) {
                        if(response.status =='success'){ 
                            toastr.success("Language update successfully");  
                        }else{
                           toastr.error(response.msg);
                        } 
                        window.setTimeout(function(){location.reload()},1000)
                    }
                });
            }
        })
    })
</script>
@endpush
