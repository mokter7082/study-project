@extends('layouts.app-backend')
@section('title', 'Customer Management')
@section('content')
    <div class="row">
        <div class="col-md-9 pl5 pr5">
            <div class="m-portlet m-portlet--tab">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="m-portlet__head-title">
                            <h3 class="m-portlet__head-text">Customer Details</h3>
                        </div>
                    </div>
                    <div class="m-portlet__head-tools">
                        @can('user-list')
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ route('users.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                    <span>
                                        <i class="la la-list"></i>
                                        <span>User  List</span>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        @endcan
                    </div>
                </div>
                <div class="m-portlet__body">   

                    <div class="form-group m-form__group">
                        <label for="name">Customer Name</label>
                        <div class="form-control m-input m-input--square">
                           {{ $user->name?? 'N/A' }}
                        </div>
                    </div>

                    
                    <div class="form-group m-form__group">
                        <label for="name">Address / PO Box</label>
                        <div class="form-control m-input m-input--square">
                           {{ $user->address?? 'N/A' }}
                        </div>
                    </div>   

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">Zipcode</label>
                                <div class="form-control m-input m-input--square auto-height">
                                    {{ $user->zip??'' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">City</label>
                                <div class="form-control m-input m-input--square auto-height">
                                    {{ $user->city??'' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">Country</label>
                                <div class="form-control m-input m-input--square auto-height">
                                    {{ $user->country??'' }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">Phone 1</label>
                                <div class="form-control m-input m-input--square auto-height">
                                    {{ $user->phone??'' }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">Phone 2</label>
                                <div class="form-control m-input m-input--square auto-height">
                                    {!! $user->mobile??'&nbsp;' !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group m-form__group">
                                <label for="exampleTextarea">Landline</label>
                                <div class="form-control m-input m-input--square auto-height">
                                    {{ $user->landline??'' }}
                                </div>
                            </div>
                        </div>
                    </div> 

                    <div class="form-group m-form__group">
                        <label for="name">Email</label>
                        <div class="form-control m-input m-input--square">
                           {{ $user->email?? '' }}
                        </div>
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
                            <h3 class="m-portlet__head-text"> Image </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body right-bar"> 
                    <div class="form-group m-form__group"> 
                        @php($img = isset($user->image)?env('IMG_URL').'/'.$user->image:URL::to('backend/images/preview.png'))
                      <img src="{{$img}}"  alt="Image preview..."  class="preview-img">  
                    </div> 
                </div> 
            </div>
        </div> 
    </div>
@endsection