@extends('layouts.app-backend')
@section('title', 'Locations Management')
@section('content') 

<div class="row">
    <div class="col-md-7 pl5 pr5">
         @if(isset($instructor->id))
            {!! Form::model($instructor, ['method' => 'PATCH','route' => ['instructors.update', $instructor], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
        @else
            {!! Form::open(array('route' => 'instructors.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
        @endif
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($instructor->id)?'Edit':'Create New'}} Instructors</h3>
                    </div>
                </div> 
            </div>
            <div class="m-portlet__body"> 
                <div class="form-group {{ $errors->has('name') ? 'has-danger':'' }}"> 
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name',  $instructor->name??null, array('placeholder' => 'Name','class' => 'form-control m-input', 'id'=>'name')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('name') }}</div>
                </div> 

                <div class="form-group {{ $errors->has('description') ? 'has-danger' : '' }}">
                    {!! Form::label('description', 'Biography') !!}
                    {!! Form::textarea('description', $instructor->description??'', array('class' => 'form-control m-input', 'rows'=>'2', 'id'=>'editor')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('description') }}</div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="status">Status</label>
                            {!! Form::select('status', ['Active'=>'Active','Inactive'=>'Inactive'], $instructor->status??'', array('class'=>'form-control c_selectpicker m-input')) !!}
                        </div> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="status">Feature Image</label>
                        <div class="form-group {{ $errors->has('picture') ? 'has-danger' : '' }}">  
                            <button id="lfm" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows" style="max-width: 140px"> 
                                <div class="holder" id="mediaHolder"> 
                                    <img src="{{$instructor->picture?? URL::to('images/default.jpg')}}">
                                </div>
                                <input id="mediaThumbnail" hidden="" value="{{$instructor->picture?? URL::to('images/default.jpg')}}"  type="text" name="picture">
                            </button>  
                            <div class="form-control-feedback">{{ $errors->first('picture') }}</div>
                        </div>
                    </div> 
                </div>  
            </div> 
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Submit Now</button>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
    <div class="col-md-5 pl5 pr5">
        <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">Instructor List</h3>
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
                        @foreach($instructors as $key => $instructor)
                            <tr>  
                                <td tabindex="2" width="70%">{!! $instructor->name??'' !!}</td>                          
                                <td width="15%"><label class="m--font-bold m--font-primary">{{ $instructor->status??''}}</label></td>

                                <td width="15%" nowrap="" align="center">
                                    @if((auth()->user()->can('instructor-delete') || auth()->user()->can('instructor-edit')))
                                    <span class="dropdown">
                                        <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            @can('instructor-edit')
                                            <a class="dropdown-item" href="{{ route('instructors.edit',$instructor->id) }}"><i class="la la-edit"></i> Edit </a>
                                            @endcan
                                            
                                            @can('instructor-delete')
                                            <a class="dropdown-item delItem" data-delform="delete-form{{ $instructor->id }}" href="#{{ route('instructors.destroy', $instructor->id) }}"><i class="la la-trash"></i>Delete</a>
                                            {!! Form::open(['method' => 'DELETE','route' => ['instructors.destroy', $instructor->id],'style'=>'display:inline', 'id'=>'delete-form'.$instructor->id]) !!}
                                            {!! Form::close() !!}
                                            @endcan
                                        </div>
                                    </span>
                                    @endif 
                                </td>
                            </tr> 
                        @endforeach
                    </tbody>
                </table> 
            </div>
        </div> 
    </div>
</div>

@endsection

@push('scripts')
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

     //image browse form media
    var route_prefix = "{{url('/bdrentz-admin/media-file')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "{{url('images/default.jpg')}}");
    })
</script> 
@endpush