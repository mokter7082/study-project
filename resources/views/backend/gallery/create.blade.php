@extends('layouts.app-backend')
@section('title', 'Gallery Management')
@section('content') 

@if(isset($gallery->id))
	{!! Form::model($gallery, ['method' => 'PATCH','route' => ['galleries.update', $gallery->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
@else
	{!! Form::open(array('route' => 'galleries.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
@endif

<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($gallery->id)?'Edit':'Create New'}} Galleries</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    @can('category-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('galleries.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span> <i class="la la-list"></i> <span>All Galleries</span> </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">
                
                <div class="form-group {{ $errors->has('title') ? 'has-danger':'' }}"> 
                    {!! Form::label('title', 'News Title *') !!}
                    {!! Form::text('title',  $gallery->title??null, array('placeholder' => 'Page Title','class' => 'form-control m-input', 'id'=>'title')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                </div>  

                <div class="form-group {{ $errors->has('description') ? 'has-danger':'' }}"> 
                    {!! Form::label('description', 'Description', array('class' => 'control-label')) !!} 
                    {!! Form::textarea('description', $gallery->description??null, ['id' => 'editor', 'rows' => 3,  'class' => 'form-control m-input']) !!} 
                    <div class="form-control-feedback">{{ $errors->first('description') }}</div>
                </div>

                {{-- <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div> 
                <div class="form-group {{ $errors->has('excerpt') ? 'has-danger' : '' }}"> 
                    {!! Form::label('excerpt', 'Excerpt') !!}
                    {!! Form::text('excerpt',  $gallery->excerpt??'', array('class' => 'form-control m-input', 'id'=>'excerpt')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('excerpt') }}</div>
                </div> --}}

            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom"> Submit Now </button>
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
                    {!! Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive'], $gallery->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']) !!} 
                </div> 
            
                <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info"> Submit Now </button>
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
                    <div class="form-group m-form__group {{ $errors->has('picture') ? 'has-danger' : '' }}">  
                        <button id="lfm" type="button" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows"> 
                            <div class="holder" id="mediaHolder"> 
                                <img src="{{$gallery->picture?? URL::to('images/default.jpg')}}">
                            </div>
                            <input id="mediaThumbnail" hidden="" value="{{$gallery->picture?? URL::to('images/default.jpg')}}" type="text" name="picture">
                        </button>  
                        <div class="form-control-feedback">{{ $errors->first('picture') }}</div>
                    </div>  
                </div>
            </div>
        </div> 
    </div>
</div>

{!! Form::close() !!}  

@endsection

@push('scripts')
<script>
 
    //image browse form media
    var route_prefix = "{{url('/bdrentz-admin/media-file')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "{{url('images/default.jpg')}}");
    })

    //check if Exist
    $('#title').change(function(e) {
        e.preventDefault();
        var obj = $(this);
        var exist ="{{$news->id??''}}";
        var url = "{{route('check-exist')}}";
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
@endpush