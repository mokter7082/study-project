@extends('layouts.app-backend')
@section('title', 'Role Management')
@section('content')

@if(isset($role->id))
{!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
@else
{!! Form::open(array('route' => 'roles.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!}
@endif
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($role->id)?'Edit':'Create New'}} Seller/Customer</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">

                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('roles.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>Role List</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group m-form__group {{ $errors->has('name') ? 'has-danger':'' }}">
                    {!! Form::label('name', 'Role Name') !!}
                    {!! Form::text('name',  $role->name??null, array('placeholder' => 'Role Name','class' => 'form-control m-input', 'id'=>'name')) !!}
                    <div class="form-control-feedback">{{ $errors->first('name') }}</div>
                </div>
                <div class="form-group m-form__group {{ $errors->has('permission') ? 'has-danger':'' }}">
                    {!! Form::label('permission', 'Permission') !!}
                    <!-- <select name="permission[]" class="form-control m_selectpicker" placeholder="Select Permission" multiple="">
                       {{-- @foreach($permission as $value)
                        <option value="{{$value->id}}" {{ isset($role) && $role->hasPermissionTo($value->name) ? 'selected':''}}>{{ $value->name }}</option>
                        @endforeach --}} 
                    </select> --> 

                    <div class="m-checkbox-list">
                        @if(!empty($permission))
                            @foreach($permission as $value)
                            <label class="m-checkbox">
                                {{ Form::checkbox('permission[]', $value->id, isset($rolePermissions)&& in_array($value->id, $rolePermissions) ? true : false, array('class' => 'form-control m-input')) }} {{ $value->name??'' }} <span></span>
                            </label>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Submit Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection