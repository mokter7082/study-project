@extends('layouts.app-backend')
@section('title', 'Admin Management')
@section('content')
 
@if(isset($country->id))
{!! Form::model($country, ['method' => 'PATCH','route' => ['countries.update', $country->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
@else
{!! Form::open(array('route' => 'countries.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
@endif

@if($errors->any())
    {{ implode('', $errors->all('<div>:message</div>')) }}
@endif

<div class="row">
    <div class="col-md-12 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($country->id)?'Edit':'Create New'}} Countries</h3>
                    </div>
                </div> 
                <div class="m-portlet__head-tools">
                    @can('product-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('countries.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>Country List</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="row">  
                    <div class="col-md-4">
                        <div class="form-group m-form__group nopad mb10 {{ $errors->has('title') ? 'has-danger':'' }}"> 
                            {!! Form::label('title', 'Title') !!}
                            {!! Form::text('title',  $country->title??null, array('placeholder' => '', "autocomplete"=>"off", 'class' => 'form-control m-input', 'id'=>'title')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group m-form__group nopad mb10 {{ $errors->has('code') ? 'has-danger':'' }}"> 
                            {!! Form::label('code', 'Country Code') !!}
                            {!! Form::text('code',  $country->code??null, array('placeholder' => '', "autocomplete"=>"off", 'class' => 'form-control m-input', 'id'=>'code')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('code') }}</div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group m-form__group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control m-input" id="status">
                                <option value="Active"  selected >Active</option>
                                <option value="Inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                </div>              
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions"> 
                    <button type="submit" name="sales_status" value="21" class="btn m-btn--pill btn-info btn-md m-btn m-btn--custom">Submit</button>
                </div>
            </div>
        </div>
    </div> 
</div>

{!! Form::close() !!}

@endsection

@push('scripts')
    <script type="text/javascript">
        $('#qty, #rate').change(function(e) {
            $qty = parseFloat($('#qty').val()) || 0;
            $rate = parseFloat($('#rate').val()) || 0; 
            $bill = parseFloat($qty*$rate);
            $('#bill').val($bill);
        })
        $('#bill').change(function(e) {
            $qty = parseFloat($('#qty').val()) || 1;
            $bill = parseFloat($('#bill').val()) || 0; 
            $rate = parseFloat($bill/$qty);
            $('#rate').val($rate);
        })
    </script>
@endpush