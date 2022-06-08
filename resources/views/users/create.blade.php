@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content')
 
@if(isset($user->id))
{!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
@else
{!! Form::open(array('route' => 'users.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
@endif

{{-- @if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif --}}  

<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($user->id)?'Edit':'Create New'}} Customer</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    @can('vendor-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('users.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>Customer List</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">  
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group {{ $errors->has('anrede') ? ' is-invalid' : '' }}">
                            <label for="anrede">Title</label> <span class="required">*</span>
                            {!! Form::select('anrede', ['Mr.'=>'Mr.', 'Mrs.'=>'Mrs.'],  old('anrede'), array('placeholder' => 'Choose', 'class' => 'form-control m-input','required'=>true, 'id'=>'anrede')) !!}  
                            @if ($errors->has('anrede'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('anrede') }}</strong>
                                </span>
                            @endif 
                        </div>
                    </div>
              
                    <div class="col-md-5">
                        <div class="form-group {{ $errors->has('first_name') ? 'has-danger' : '' }}">
                            {!! Form::label('first_name', 'First Name') !!} <span class="required">*</span>                    
                            {!! Form::text('first_name',  old('first_name'), ['class'=>'form-control m-input m-input--square', 'id'=>'first_name', 'required'=>true]) !!}
                            <div class="form-control-feedback">{{ $errors->first('first_name') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('last_name') ? 'has-danger' : '' }}">
                            {!! Form::label('last_name', 'Last Name') !!}                    
                            {!! Form::text('last_name',  old('last_name'), ['class'=>'form-control m-input m-input--square', 'id'=>'last_name']) !!}
                            <div class="form-control-feedback">{{ $errors->first('last_name') }}</div>
                        </div> 
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('address') ? 'has-danger' : '' }}">
                            {!! Form::label('address', 'Address / PO Box') !!} <span class="required">*</span>               
                            {!! Form::text('address',  old('address'), ['class'=>'form-control m-input m-input--square', 'id'=>'address', 'autocomplete'=>'off']) !!}
                            <div class="form-control-feedback">{{ $errors->first('address') }}</div>
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 col-sm-6">
                        <div class="form-group {{ $errors->has('zip') ? 'has-danger' : '' }}">
                            {!! Form::label('zip', 'Zipcode') !!}  <span class="required">*</span>                  
                            {!! Form::text('zip',  old('zip'), ['class'=>'form-control m-input m-input--square', 'id'=>'zip']) !!}
                            <div class="form-control-feedback">{{ $errors->first('zip') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-8 col-sm-6">
                        <div class="form-group {{ $errors->has('city') ? 'has-danger' : '' }}">
                            {!! Form::label('city', 'City') !!} <span class="required">*</span>                 
                            {!! Form::text('city',  old('city'), ['class'=>'form-control m-input m-input--square', 'id'=>'city']) !!}
                            <div class="form-control-feedback">{{ $errors->first('city') }}</div>
                        </div> 
                    </div>
                </div> 
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group {{ $errors->has('country') ? 'has-danger' : '' }}">
                            {!! Form::label('country', 'Country') !!} <span class="required">*</span>
                            {!! Form::select('country',  $countries??[], old('country'), ['class'=>'form-control m-input m-input--square', 'id'=>'country']) !!}
                            <div class="form-control-feedback">{{ $errors->first('country') }}</div>
                        </div> 
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('phone') ? 'has-danger' : '' }}">
                            {!! Form::label('phone', 'Phone 1') !!} <span class="required">*</span>                   
                            {!! Form::text('phone',  old('phone'), ['class'=>'form-control m-input m-input--square', 'id'=>'phone']) !!}
                             <small  class="form-text text-muted">including country code, eg +4312341234567.</small>
                            <div class="form-control-feedback">{{ $errors->first('phone') }}</div>
                        </div>
                    </div> 
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('mobile') ? 'has-danger' : '' }}">
                            {!! Form::label('mobile', 'Phone 2') !!}                    
                            {!! Form::text('mobile',  old('mobile'), ['class'=>'form-control m-input m-input--square', 'id'=>'mobile']) !!}
                             <small  class="form-text text-muted">including country code, eg +4312341234567.</small>
                            <div class="form-control-feedback">{{ $errors->first('mobile') }}</div>
                        </div> 
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('landline') ? 'has-danger' : '' }}">
                            {!! Form::label('landline', 'Landline ') !!}   
                            {!! Form::text('landline',  old('landline'), ['class'=>'form-control m-input m-input--square', 'id'=>'landline']) !!}
                             <small  class="form-text text-muted">including country code, eg +4312341234567</small>
                            <div class="form-control-feedback">{{ $errors->first('landline') }}</div>
                        </div> 
                    </div>  
                </div><hr>  
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}"> 
                            <label for="email"> Email <span class="required">*</span></label>
                            {!! Form::email('email',  old('email'), ['class'=>'form-control m-input m-input--square', 'id'=>'email', 'required'=>true, 'autocomplete'=>'off']) !!}
                            <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                        </div> 
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}"> 
                            <label for="password"> Password <span class="required">*</span></label>
                            <input class="form-control m-input m-input--square" id="password" type="password" autocomplete="off" name="password"> 
                            <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                        </div> 
                    </div> 
                </div> 
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}"> 
                            <label for="password_confirmation">Repeat password <span class="required">*</span></label>
                            <input class="form-control m-input m-input--square" id="password_confirmation" type="password" autocomplete="off" name="password_confirmation"> 
                            <div class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div>
                        </div> 
                    </div> 
                </div>
                <hr>  
                <div class="row">
                    <div class="col-4"><strong>Newsletter</strong></div>
                    <div class="col-md-6"> 
                        <div class="form-group m-form__group row"> 
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <input data-switch="true" data-size="small" name="newsletter" type="checkbox" value="Yes" checked="checked"> 
                            </div>
                        </div>  
                    </div>  
                </div> <hr> 
                <div class="row">
                    <div class="col-md-12">
                        <input type="checkbox" name="policy" value="Yes" required="" id="privacy"><label for="privacy"> &nbsp; Privacy policy  <span class="required"> *</span></label>
                    </div>
                    <div class="col-md-12"><small>By checking the box, you agree that your personal data (name and e-mail address) will be stored and processed for the purpose of processing the order. This consent can be revoked at any time at office@gpt-consulting.com. Further information can be found in our privacy policy.</small>  
                    </div>
                </div>  
                <div class="login-footer" style="padding-top: 15px;">
                    <button type="submit" class="btn login-btn"> <strong>@if(isset($user))Update @else  Register @endif</strong> <i class="fa fa-angle-right"></i></button> 
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
                        <option value="Active" @if(isset($user->status) && $user->status == 'Active') selected  @endif>Active</option>
                        <option value="Inactive" @if(isset($user->status) && $user->status == 'Inactive') selected  @endif>Inactive</option>
                    </select>
                </div> 

                <div class="form-group m-form__group {{ $errors->has('image') ? 'has-danger' : '' }}">
                    {!! Form::label('image', 'Image') !!}
                  <input type="file" name="image" class="hide" id="choiseImg" onchange="previewFile()">
                  <img src="{{isset($user) && $user->image !=''? env('IMG_URL').'/'.$user->image: URL::to('backend/images/preview.png')}}"  alt="Image preview..." id="previmg" class="preview-img" data-toggle="m-tooltip" title="Please select <b>Image</b>" data-html="true" data-placement="left">
                  <div class="form-control-feedback">{{ $errors->first('image') }}</div> 
                </div>   
                <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info">
                        <strong> @if(isset($user))Update @else  Register @endif</strong> <i class="fa fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div> 
    </div>
</div>

{!! Form::close() !!}
@endsection

@push('scripts')
<script> 
    $('[data-switch=true]').bootstrapSwitch();
</script>
   
@endpush