@extends('layouts.app-backend')
@section('title', 'System Settings')
@push('style')
<link rel="stylesheet" href="{{asset('backend/css/codemirror.css')}}"> 
@endpush
@section('content')

{!! Form::open(array('route' => 'settings.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 

<div class="row">
    <div class="col-md-12 pl5 pr5">
        <div class="m-portlet">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                       <ul class="nav nav-pills" role="tablist" style="margin: 0">
                            <li class="nav-item ">
                                <a class="nav-link active" data-toggle="tab" href="#m_tabs_1">
                                    <i class="la la-gear"></i> System Information
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link csslink" data-toggle="tab" href="#m_tabs_2"><i class="flaticon-layers"></i>Custom css</a>
                            </li> 
                            {{-- <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="la la-gift"></i> Dropdown
                                </a>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" data-toggle="tab" href="#m_tabs_3_2">Action</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#m_tabs_3_2">Another action</a>
                                    <a class="dropdown-item" data-toggle="tab" href="#m_tabs_3_2">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" data-toggle="tab" href="#m_tabs_3_2">Separated link</a>
                                </div>
                            </li> --}}
                            
                        </ul>
                    </div>
                </div>
            </div> 
            <div class="m-portlet__body"> 
                <div class="tab-content">
                    <div class="tab-pane active" id="m_tabs_1" role="tabpanel">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group m-form__group {{ $errors->has('title') ? 'has-danger':'' }}">
                                    {!! Form::label('title', getlantext('Site Title')) !!}
                                    {!! Form::text('title',  $title->value??null, array('class' => 'form-control m-input', 'id'=>'title')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                                </div>
                                <div class="form-group m-form__group {{ $errors->has('phone') ? 'has-danger':'' }}"> 
                                    {!! Form::label('phone', getlantext('Phone')) !!}
                                    {!! Form::text('phone',  $phone->value??null, array('class' => 'form-control m-input', 'id'=>'phone')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('phone') }}</div>
                                </div> 
                                <div class="form-group m-form__group {{ $errors->has('email') ? 'has-danger':'' }}"> 
                                    {!! Form::label('email', getlantext('Email')) !!}
                                    {!! Form::text('email',  $email->value??null, array('class' => 'form-control m-input', 'id'=>'email')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                </div>
                                <div class="form-group m-form__group {{ $errors->has('address') ? 'has-danger':'' }}"> 
                                    {!! Form::label('address', getlantext('Address')) !!}
                                    {!! Form::text('address',  $address->value??null, array('placeholder' => 'address','class' => 'form-control m-input', 'id'=>'address')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('address') }}</div>
                                </div> 
                            </div>
                            <div class="col-md-3">
                                <div class="col-md-12">{!! Form::label('logo', getlantext('Site Logo')) !!} </div> 
                                <div class="row">
                                    <div class="form-group m-form__group {{ $errors->has('logo') ? 'has-danger':'' }}"> 
                                        <button id="lfm" type="button" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows" style="max-width: 120px"> 
                                            <div class="holder" id="mediaHolder"> 
                                                <img src="{{$logo->value?? URL::to('images/logo.png')}}">
                                            </div>
                                            <input id="mediaThumbnail" hidden=""  type="text" name="logo">
                                        </button>    
                                    </div> 
                                </div> 

                                <div class="col-md-12 mt-4">
                                {!! Form::label('fevicon', getlantext('Fev Icon')) !!} </div> 
                                <div class="row">
                                    <div class="form-group m-form__group {{ $errors->has('fevicon') ? 'has-danger':'' }}"> 
                                        <button id="fevicon" type="button"  data-input="feviconPath" data-preview="fevHolder" class="img-brows" style="max-width: 120px"> 
                                            <div class="holder" id="fevHolder"> 
                                                <img src="{{$fevicon->value?? URL::to('images/favicon.png')}}">
                                            </div>
                                            <input id="feviconPath" hidden=""  type="text" name="fevicon">
                                        </button>   
                                    </div> 
                                </div> 
                            </div> 
                        </div> 
                         
                        
                      
                        {{-- <div class="form-group m-form__group {{ $errors->has('language') ? 'has-danger':'' }}"> {!! Form::label('language', getlantext('Language')) !!}
                            {!! Form::select('language', $languages, $language->value??null, array('class' => 'form-control m-input', 'id'=>'language')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('language') }}</div>
                        </div> --}}
                    </div>

                    <div class="tab-pane" id="m_tabs_2" role="tabpanel">
                        <textarea id="code" name="custom_style">{{$custom_style->long_text??'/* your custom style here */'}}</textarea>
                    </div>
                </div>
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions"> 
                    <button type="submit" class="btn m-btn--pill btn-info btn-md m-btn m-btn--custom">{{getlantext('save')}}</button>
                </div>
            </div>
        </div> 
    </div> 
</div>

{!! Form::close() !!}

@endsection

@push('scripts') 
    <script src="{{asset('backend/js/codemirror.js')}}"></script>
    <script src="{{asset('backend/js/css.js')}}"></script>  
    <script type="text/javascript"> 
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
            extraKeys: {"Ctrl-Space": "autocomplete"}
        });
  
        $('.csslink').click(function() {  
            setTimeout(function() {
               editor.refresh();
            },1); 
            $('#code').focus();
        })  

        //image browse form media
        var route_prefix = "{{url('/bdrentz-admin/media-file')}}";
        $('#lfm').filemanager('image', {prefix: route_prefix}); 
        $('#fevicon').filemanager('image', {prefix: route_prefix}); 

        $('#mediaHolder').click(function(e) {
            $(this).find('img').attr('src', "{{url('images/logo.png')}}");
            $('#mediaThumbnail').val('{{url('images/logo.png')}}'); 
        }) 
        $('#fevHolder').click(function(e) {
            $(this).find('img').attr('src', "{{url('images/favicon.png')}}"); 
            $('#feviconPath').val('{{url('images/favicon.png')}}');
        })       
    </script>
@endpush