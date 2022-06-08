@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content')
    <div class="row">
        <div class="col-md-12 pl5 pr5">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">Role Details</h3>
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
                    <div class="form-group m-form__group">
                        <label for="email">Role Name</label>
                        <div class="form-control m-input m-input--square">
                           {{ $role->name }}
                        </div>
                    </div> 
                     
                    <div class="form-group m-form__group">
                        <label for="exampleTextarea">Permissions</label>
                        <div class="form-control m-input m-input--square auto-height">
                            @if($role->permissions)
                                @foreach($role->permissions as $permission)
                                    <label class="m-badge m-badge--primary m-badge--wide">{{ $permission->name }}</label>
                                @endforeach
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
 