@extends('layouts.app-backend')
@section('title', 'Locations Management')
@section('content') 

<div class="row">
    <div class="col-md-5 pl5 pr5">
         @if(isset($category->id))
            {!! Form::model($category, ['method' => 'PATCH','route' => ['categories.update', $category], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
        @else
            {!! Form::open(array('route' => 'categories.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
        @endif
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($category->id)?'Edit':'Create New'}} Category </h3>
                    </div>
                </div> 
            </div>
            <div class="m-portlet__body"> 

                <div class="form-group {{ $errors->has('title') ? 'has-danger':'' }}"> 
                    {!! Form::label('title', 'Category Name') !!}
                    {!! Form::text('title',  $category->title??null, array('placeholder' => 'Name','class' => 'form-control m-input', 'id'=>'title')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                </div> 

                <div class="form-group  {{ $errors->has('parent_id') ? 'has-danger':'' }}"> 
                    {!! Form::label('parent_id', 'Parent Category') !!}
                    {!! Form::select('parent_id', $allCategories,  $category->parent_id??old('parent_id'), ['class'=>'form-control m-input', 'data-rel'=>'chosen', 'placeholder'=>'Select Parent']) !!} 
                    <div class="form-control-feedback">{{ $errors->first('parent_id') }}</div>
                </div>

                <div class="form-group {{ $errors->has('sort_order') ? 'has-danger':'' }}">
                    {!! Form::label('sort_order', 'Position', array('class' => 'control-label')) !!}
                    {!! Form::number('sort_order', $category->sort_order??old('sort_order'), ['class'=>'form-control m-input', 'placeholder'=>'Enter Display Position','id'=>'sort_order']) !!}
                    <div class="form-control-feedback">{{ $errors->first('sort_order') }}</div>
                </div>
                <div class="form-group">
                    <label for="status">Status</label> 
                    {!! Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive'], $category->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']) !!} 
                </div>
 
                <div class="row">
                    <div class="col-md-6">
                        <label for="status">Feature Image</label> 
                        <div class="form-group {{ $errors->has('picture') ? 'has-danger' : '' }}">  
                            <button id="lfm" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows" style="max-width: 140px"> 
                                <div class="holder" id="mediaHolder"> 
                                    <img src="{{$category->picture?? URL::to('images/default.jpg')}}">
                                </div>
                                <input id="mediaThumbnail" hidden="" value="{{$category->picture?? URL::to('images/default.jpg')}}"  type="text" name="picture">
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
    <div class="col-md-7 pl5 pr5">
    <div class="m-portlet m-portlet--tab mb10">
        <div class="m-portlet__head">
            <div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <span class="m-portlet__head-icon m--hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="m-portlet__head-text">Category List</h3>
                </div>
            </div>
        </div>
        <div class="m-portlet__body right-bar">
            <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
                <thead>
                    <tr>  
                        <th>Title</th>  
                        <th>Slug</th>
                        <th>Status</th>
                        <th width="15%">Actions</th>
                    </tr>
                </thead>
                <tbody>  
                    @if(isset($categories))
                   
                    @foreach($categories as $key => $category)
                        <tr>  
                            <td tabindex="2" width="70%">{!! $category->title??'' !!}</td>
                            <td tabindex="2">{!! $category->slug??'' !!}</td>                             
                            <td width="15%"><label class="m--font-bold m--font-primary">{{ $category->status??''}}</label></td>

                            <td width="15%" nowrap="" align="center">
                                @if((auth()->user()->can('category-delete') || auth()->user()->can('category-edit')))
                                <span class="dropdown">
                                    <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"> <i class="la la-ellipsis-h"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        @can('category-edit')
                                        <a class="dropdown-item" href="{{ route('categories.edit',$category->id) }}"><i class="la la-edit"></i> Edit </a>
                                        @endcan
                                        
                                        @can('category-delete')
                                        <a class="dropdown-item delItem" data-delform="delete-form{{ $category->id }}" href="#{{ route('categories.destroy', $category->id) }}"><i class="la la-trash"></i>Delete</a>
                                        {!! Form::open(['method' => 'DELETE','route' => ['categories.destroy', $category->id],'style'=>'display:inline', 'id'=>'delete-form'.$category->id]) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </div>
                                </span>
                                @endif 
                            </td>
                        </tr> 
                        @if(count($category->childs))
                            @include('backend.categories.child', ['childs' => $category->childs, 'serpart'=>1])
                        @endif
                    @endforeach
                    @endif
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