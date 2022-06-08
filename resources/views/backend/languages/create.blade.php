@extends('layouts.app-backend')
@section('title', 'Languate Manager')
@section('content')
{!! Form::open(array('route' => 'languages.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Create New Languages</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    @can('carmodel-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('languages.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>Language List</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group m-form__group {{ $errors->has('referance') ? 'has-danger':'' }}"> 
                    {!! Form::label('referance', 'Referance') !!}
                    {!! Form::text('referance', old('referance'), array('class' => 'form-control m-input', 'required'=>true, 'id'=>'referance')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('referance') }}</div>
                </div>  
 
                <div class="form-group m-form__group {{ $errors->has('en_text') ? 'has-danger':'' }}"> 
                    {!! Form::label('en_text', 'English') !!}
                    {!! Form::text('en_text', old('en_text'), array('class' => 'form-control m-input', 'required'=>true, 'id'=>'en_text')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('en_text') }}</div>
                </div>

                <div class="form-group m-form__group {{ $errors->has('ger_text') ? 'has-danger':'' }}"> 
                    {!! Form::label('ger_text', 'Germany') !!}
                    {!! Form::text('ger_text', old('ger_text'), array('class' => 'form-control m-input', 'required'=>true, 'id'=>'ger_text')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('ger_text') }}</div>
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
                <div class="form-group m-form__group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control m-input" id="status">
                        <option value="Active" @if(isset($carbrand->status) && $carbrand->status == 'Active') selected  @endif>Active</option>
                        <option value="Inactive" @if(isset($carbrand->status) && $carbrand->status == 'Inactive') selected  @endif>Inactive</option>
                    </select>
                </div> 
            </div>
        </div> 
    </div>
</div>
{!! Form::close() !!}
@endsection



@push('scripts')
<script>
   
    //check if Exist
    $('#referance').change(function(e) {
        e.preventDefault();
        var obj = $(this);
        var exist ="{{$language->id??''}}";
        var url = "{{route('check-exist')}}";
        var csrf = $("input[name='_token']").val();

        $data = { 
            '_token' : csrf,
            'table':'languages',
            'field':'referance',
            'value':obj.val(),
            'exist':exist, 
            'slugify': true
        }

        makeAjaxPost( $data, url).then(function(response) {
            if(response.status =='errors'){
                obj.val(''); 
                obj.parent('.m-form__group').addClass('has-danger');
                obj.parent('.m-form__group').find('.form-control-feedback').html('Sorry! this books already exist');
                obj.parent('.m-form__group').find('.form-control-feedback').show();
                toastr.error("Sorry! this books already exist"); 
            }else{
                obj.parent('.m-form__group').removeClass('has-danger');
                obj.parent('.m-form__group').find('.form-control-feedback').html('');
                obj.parent('.m-form__group').find('.form-control-feedback').hide(); 
            }
        });
    }) 
</script>
@endpush

