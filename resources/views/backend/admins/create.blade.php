@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content') 
{!! Form::open(array('route' => 'admin.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!}
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Create New Admin</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('admin.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>Admin List</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group m-form__group {{ $errors->has('email') ? 'has-danger' : '' }}">
                    {!! Form::label('email', 'Admin Email') !!}                    
                    {!! Form::email('email',  null, ['class'=>'form-control m-input m-input--square', 'id'=>'email', 'placeholder'=>'Email']) !!}
                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                </div>

                <div class="form-group m-form__group {{ $errors->has('password') ? 'has-danger' : '' }}">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control m-input', 'id'=>'password')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                </div>

                <div class="form-group m-form__group">
                    {!! Form::label('rcpassword', 'Confirm Password') !!}
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirme Password','class' => 'form-control m-input', 'id'=>'rcpassword')) !!} 
                </div>

                <div class="form-group m-form__group {{ $errors->has('roles') ? 'has-danger' : '' }}">
                    <label for="user_type">User Type (Role)</label> 
                    {!! Form::select('roles[]', $roles, [], array('class' => 'form-control m-input m_selectpicker',' id'=>'user_type', 'multiple')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('roles') }}</div>
                </div>
                
                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div>

                <div class="form-group m-form__group {{ $errors->has('name') ? 'has-danger' : '' }}"> 
                    {!! Form::label('name', 'Full Name') !!}
                    {!! Form::text('name', null, array('placeholder' => 'Full Name','class' => 'form-control m-input', 'id'=>'name')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('name') }}</div>
                </div>

                <div class="form-group m-form__group {{ $errors->has('mobile') ? 'has-danger' : '' }}">
                    {!! Form::label('mobile', 'Mobile No / Phone') !!}
                    {!! Form::number('mobile', null, array('placeholder' => 'Mobile No.','class' => 'form-control m-input', 'id'=>'mobile')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('mobile') }}</div>
                </div>
                
                <div class="form-group m-form__group {{ $errors->has('address') ? 'has-danger' : '' }}">
                    <label for="exampleTextarea">Address</label>
                    {!! Form::textarea('address', null, ['id' => 'address', 'rows' => 3,  'class' => 'form-control m-input']) !!} 
                    <div class="form-control-feedback">{{ $errors->first('address') }}</div>
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
                        <option value="Active"  selected >Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info">Submit Now</button>
                </div>
            </div>
        </div>
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text">
                        Feature Image
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body right-bar">
                <div class="form-group m-form__group">
                    <input type="file" name="image" class="hide" id="choiseImg" onchange="previewFile()">
                    <img src="{{  URL::to('backend/imges/preview.png')}}" height="200" alt="Image preview..." id="previmg" class="preview-img" data-toggle="m-tooltip" title="Please select <b>Image</b>" data-html="true" data-placement="left">
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection