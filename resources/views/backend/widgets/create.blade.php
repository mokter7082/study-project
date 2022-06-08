@extends('layouts.app-backend')
@section('title', 'Pages Management')
@section('content') 
@if(isset($widget->id))
	{!! Form::model($widget, ['method' => 'PATCH','route' => ['widgets.update', $widget->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
@else
	{!! Form::open(array('route' => 'widgets.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
@endif
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">
            {{-- @if($errors->any())
                {{ implode('', $errors->all('<div>:message</div>')) }}
            @endif --}}

            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($widget->id)?'Edit':'Create New'}} Widgets</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    @can('category-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('widgets.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>All Widgets</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group {{ $errors->has('title') ? 'has-danger':'' }}"> 
                    {!! Form::label('title', 'Widget Title *') !!}
                    {!! Form::text('title',  $widget->title??null, array('placeholder' => 'Title','class' => 'form-control m-input', 'required'=>true, 'id'=>'title')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                </div>

                <div class="form-group {{ $errors->has('referance') ? 'has-danger':'' }}"> 
                    {!! Form::label('referance', 'Referance') !!}
                    {!! Form::text('referance',  $widget->referance??null, array('placeholder' => 'Referance','class' => 'form-control m-input',  'required'=>true, 'id'=>'referance')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('referance') }}</div>
                </div>  

                <div class="form-group {{ $errors->has('description') ? 'has-danger':'' }}"> 
                    {!! Form::label('description', 'Description', array('class' => 'control-label')) !!} 
                    {!! Form::textarea('description', $widget->description??null, ['id' => 'editor', 'rows' => 3,  'class' => 'form-control m-input']) !!} 
                    <div class="form-control-feedback">{{ $errors->first('description') }}</div>
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
                <div class="form-group">
                    <label for="status">Status</label>
                    {!! Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive'], $page->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']) !!} 
                </div>  

                <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info">Submit Now</button>
                </div>
            </div>
        </div> 
    </div>
</div>
{!! Form::close() !!} 
@endsection

@push('scripts')
 
@endpush