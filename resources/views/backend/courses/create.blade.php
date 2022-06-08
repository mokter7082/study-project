@extends('layouts.app-backend')
@section('title', 'Course Management')
@section('content') 

@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif


@if(isset($course->id))
	{!! Form::model($course, ['method' => 'PATCH','route' => ['equipments.update', $course->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true]) !!}
@else
	{!! Form::open(array('route' => 'equipments.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'files' => true)) !!} 
@endif
<div class="row">
    <div class="col-md-9 pl5 pr5">
        <div class="m-portlet m-portlet--tab">  
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">{{ isset($course->id)?'Edit':'Create a new '}} Equipment</h3>
                    </div>
                </div> 
                <div class="m-portlet__head-tools">
                    @can('category-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('equipments.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>See All Equipment</span>
                                 
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="form-group {{ $errors->has('title') ? 'has-danger':'' }}"> 
                    {!! Form::label('title', 'Equipment Name *') !!}
                    {!! Form::text('title', $equipment->title??'', array('placeholder' => 'Enter Equipment Name','class' => 'form-control m-input', 'required'=>true, 'id'=>'title')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('title') }}</div>
                </div>
                <div class="row">
                   
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('start_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('price_for_30_days', 'Price For 30 Days') !!}
                            {!! Form::number('price_for_30_days', $equipment->price_30??'', array('class' => 'form-control calculatAvgMonthly', 'required'=>true, 'id'=>'price_for_30_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('start_time') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('price_for_15_days','Price For 15 Days') !!}
                            {!! Form::number('price_for_15_days', $equipment->price_15??'', array('class' => 'form-control m-input time_pick calculatAvgTwoWeek', 'required'=>true, 'id'=>'price_for_15_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('price_for_7_days', 'Price For 7 Days') !!}
                            {!! Form::number('price_for_7_days', $equipment->price_7??'',array('class' => 'form-control m-input calculatAvgWeekly', 'required'=>true, 'id'=>'price_for_7_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('price_for_1_days', 'Price For 1 Days') !!}
                            {!! Form::number('price_for_1_days', $equipment->price_per_day??'', array('class' => 'form-control m-input time_pick', 'required'=>true, 'id'=>'price_for_1_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('location_id') ? 'has-danger':'' }}"> 
                            {!! Form::label('category_id', 'Equipment Category') !!}
                            {!! Form::select('category_id', $categories, $equipment->category_id??old('category_id'), ['class'=>'form-control c_selectpicker m-input', 'placeholder'=>'--Select Equipment Category--', 'data-rel'=>'chosen']) !!} 
                            <div class="form-control-feedback">{{ $errors->first('category_id') }}</div>
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('operator_fooding_cost', 'Operator Fooding Cost') !!}
                            {!! Form::number('operator_fooding_cost',$equipment->fooding_cost??'', array('class' => 'form-control m-input time_pick', 'required'=>true, 'id'=>'operator_fooding_cost')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>

                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('avarage_for_30_days', 'Average For 30 Days') !!}
                            {!! Form::number('avarage_for_30_days',$equipment->avg_30??'', array('class' => 'form-control m-input getAvgMonthly', 'required',"readonly"=>true, 'id'=>'avarage_for_30_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('avarage_for_15_days', 'Average For 15 Days') !!}
                            {!! Form::number('avarage_for_15_days',$equipment->avg_15??'', array('class' => 'form-control m-input getAvgTwoWeek', 'required','readonly'=>true, 'id'=>'avarage_for_15_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('end_time') ? 'has-danger' : '' }}"> 
                            {!! Form::label('avarage_for_7_days', 'Average For 07 Days') !!}
                            {!! Form::number('avarage_for_7_days',$equipment->avg_7??'', array('class' => 'form-control m-input getAvgTwoWeekly', 'required','readonly'=>true, 'id'=>'avarage_for_7_days')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('end_time') }}</div>
                        </div> 
                    </div>
                    {{-- <div class="col-md-4">
                        <label for="status">Feature Image</label> 
                        <div class="form-group {{ $errors->has('picture') ? 'has-danger' : '' }}">  
                            <button id="lfm" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows" style="max-width: 140px"> 
                                <div class="holder" id="mediaHolder"> 
                                    <img src="{{$category->picture?? URL::to('images/default.jpg')}}">
                                </div>
                                <input id="mediaThumbnail" hidden="" value="{{$category->picture?? URL::to('images/default.jpg')}}"  type="text" name="picture">
                            </button>  
                            <div class="form-control-feedback">{{ $errors->first('picture') }}</div>
                        </div>
                    </div> --}}
                </div>   
                {{-- <div class="row"> 
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('available_date') ? 'has-danger' : '' }}"> 
                            {!! Form::label('available_date', 'Anfangsdatum') !!}
                            {!! Form::text('available_date',  $course->available_date??'', array('class' => 'form-control m-input', 'required'=>true, 'id'=>'available_date')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('available_date') }}</div>
                        </div> 
                    </div>
                     <div class="col-md-4">
                        <div class="form-group {{ $errors->has('close_date') ? 'has-danger' : '' }}"> 
                            {!! Form::label('close_date', 'Abschlussdatum') !!}
                            {!! Form::text('close_date',  $course->close_date??'', array('class' => 'form-control m-input', 'required'=>true, 'id'=>'close_date')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('close_date') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('location_id') ? 'has-danger':'' }}"> 
                            {!! Form::label('location_id', 'Ort') !!}
                            {!! Form::select('location_id', $locations, $course->location_id??old('location_id'), ['class'=>'form-control c_selectpicker m-input', 'placeholder'=>'select one', 'data-rel'=>'chosen']) !!} 
                            <div class="form-control-feedback">{{ $errors->first('location_id') }}</div>
                        </div>
                    </div> 
                </div>  --}}
                {{-- <div class="row">
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('single_price') ? 'has-danger' : '' }}"> 
                            {!! Form::label('single_price', 'Einzelpreis') !!}
                            {!! Form::text('single_price',  $course->single_price??'', array('class' => 'form-control m-input numeric', 'required'=>true, 'id'=>'single_price')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('single_price') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('pair_price') ? 'has-danger' : '' }}"> 
                            {!! Form::label('pair_price', 'Paarpreis') !!}
                            {!! Form::text('pair_price',  $course->pair_price??'', array('class' => 'form-control m-input numeric',  'id'=>'pair_price')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('pair_price') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-4">
                        <div class="form-group {{ $errors->has('seat') ? 'has-danger' : '' }}"> 
                            {!! Form::label('seat', 'Anzahl Sitzplätze') !!}
                            {!! Form::text('seat',  $course->seat??'', array('class' => 'form-control m-input numeric', 'required'=>true, 'id'=>'seat')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('seat') }}</div>
                        </div> 
                    </div>
                </div> --}}
                
                {{-- <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('week') ? 'has-danger' : '' }}">
                            {!! Form::label('Schedule', 'Zeitplan') !!}
                            @php($wday = isset($course->week_days)? explode(',', $course->week_days):[]) 

                            <div class="weekdays-list" id="wklist">
                                <label class="weekdays @if(in_array('Sun',$wday)) selected @endif" data-selected="false">
                                    Sun <input name="week[]" type="checkbox" value="Sun" @if(in_array('Sun',$wday)) checked @endif>
                                </label>
                                <label class="weekdays @if(in_array('Mon',$wday)) selected @endif" data-selected="false">
                                    Mon <input name="week[]" type="checkbox" value="Mon" @if(in_array('Mon',$wday)) checked @endif>
                                </label>
                                <label class="weekdays @if(in_array('Tue',$wday)) selected @endif" data-selected="false">
                                    Tue <input name="week[]" type="checkbox" value="Tue" @if(in_array('Tue',$wday)) checked @endif>
                                </label>
                                <label class="weekdays @if(in_array('Wed',$wday)) selected @endif" data-selected="false">
                                    Wed <input name="week[]" type="checkbox" value="Wed" @if(in_array('Wed',$wday)) checked @endif>
                                </label>
                                <label class="weekdays @if(in_array('Thu',$wday)) selected @endif" data-selected="false">
                                    Thu <input name="week[]" type="checkbox" value="Thu" @if(in_array('Thu',$wday)) checked @endif>
                                </label>
                                <label class="weekdays @if(in_array('Fri',$wday)) selected @endif" data-selected="false">
                                    Fri <input name="week[]" type="checkbox" value="Fri" @if(in_array('Fri',$wday)) checked @endif>
                                </label>
                                <label class="weekdays @if(in_array('Sat',$wday)) selected @endif" data-selected="false">
                                    Sat <input name="week[]" type="checkbox" value="Sat" @if(in_array('Sat',$wday)) checked @endif>
                                </label>
                            </div>
                            <div class="form-control-feedback">{{ $errors->first('week') }}</div>
                        </div> 
                    </div>
                </div>  --}}
                {{-- <div class="form-group {{ $errors->has('description') ? 'has-danger':'' }}"> 
                    {!! Form::label('description', 'Beschreibung', array('class' => 'control-label')) !!} 
                    {!! Form::textarea('description', $course->description??null, ['id' => 'editor', 'rows' => 3,  'class' => 'form-control m-input']) !!} 
                    <div class="form-control-feedback">{{ $errors->first('description') }}</div>
                </div>

                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div> 
             
                <div class="form-group {{ $errors->has('excerpt') ? 'has-danger' : '' }}"> 
                    {!! Form::label('excerpt', 'Auszug') !!}
                    {!! Form::text('excerpt', $course->excerpt??'', array('class' => 'form-control m-input', 'id'=>'excerpt')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('excerpt') }}</div>
                </div> 
                 
                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div> 
                 
                <div class="row mt10">
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('meta_title') ? 'has-danger' : '' }}"> 
                            {!! Form::label('meta_title', 'Meta-Titel') !!}
                            {!! Form::text('meta_title', $course->meta->meta_title??'', array('class' => 'form-control m-input', 'id'=>'meta_title')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('meta_title') }}</div>
                        </div> 
                    </div>
                    <div class="col-md-12">
                        <div class="form-group {{ $errors->has('meta_key') ? 'has-danger' : '' }}"> 
                            {!! Form::label('meta_key', 'Meta-Schlüsselwort *') !!}
                            {!! Form::text('meta_key',  $course->meta->meta_key??'', array('class' => 'form-control m-input', 'id'=>'meta_key')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('meta_key') }}</div>
                        </div> 
                    </div> 
                </div> 
                <div class="form-group {{ $errors->has('meta_description') ? 'has-danger' : '' }}"> 
                    {!! Form::label('meta_description', 'Meta-Beschreibung') !!}
                    {!! Form::textarea('meta_description', $course->meta->meta_description??'', array('class' => 'form-control m-input',  'rows'=>'2', 'id'=>'meta_description')) !!} 
                    <div class="form-control-feedback">{{ $errors->first('meta_description') }}</div>
                </div>   --}}
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <button type="submit" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom">Add Equipment</button>
                </div>
            </div>
        </div>
    </div>




    <div class="col-md-3 pl5 pr5">
        <div class="m-portlet m-portlet--tab mb10">
            <div class="m-portlet__head">
                {{-- <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <span class="m-portlet__head-icon m--hide">
                            <i class="la la-gear"></i>
                        </span>
                        <h3 class="m-portlet__head-text"> Veröffentlichen </h3>
                    </div>
                </div> --}}
            </div>
            <div class="m-portlet__body right-bar">   
                <label for="status">Feature Image</label> 
                        <div class="form-group {{ $errors->has('picture') ? 'has-danger' : '' }}">  
                            <button id="lfm" data-input="mediaThumbnail" data-preview="mediaHolder" class="img-brows" style="max-width: 140px"> 
                                <div class="holder" id="mediaHolder"> 
                                    <img src="{{$category->picture?? URL::to('images/default.jpg')}}">
                                </div>
                                <input id="mediaThumbnail" hidden="" value="{{$category->picture?? URL::to('images/default.jpg')}}"  type="text" name="picture">
                            </button>  
                            <div class="form-control-feedback">{{ $errors->first('picture') }}</div>
                        </div>

                {{-- <div class="form-group {{ $errors->has('instructors') ? 'has-danger':'' }}"> 
                    {!! Form::label('instructors', 'Lehrerin') !!}
                    {!! Form::select('instructors[]', $instructors, $course->instructors??old('instructors'), ['class'=>'form-control c_selectpicker m-input', 'multiple'=>true,  'data-rel'=>'chosen']) !!} 
                    <div class="form-control-feedback">{{ $errors->first('instructors') }}</div>
                </div>   --}}

                <div class="form-group">
                    <label for="status">Status</label>
                    {!! Form::select('status', ['Active'=>'Active', 'Inactive'=>'Inactive', 'required'=>true], $course->status??old('status'), ['class'=>'form-control c_selectpicker m-input', 'data-rel'=>'chosen']) !!} 
                </div>    
                {{-- <div class="form-group m-form__group">
                    <button type="submit" class="btn m-btn--pill btn-info">Jetzt Absenden</button>
                </div> --}}
            </div>
        </div> 
    </div>
</div>
{!! Form::close() !!}
 
 

@endsection

@push('scripts')
<script>
    // The DOM element you wish to replace with Tagify
    // var input = document.querySelector('input[name=meta_key]'); 
    // new Tagify(input);


    $("#start_time").timepicker({
        minuteStep: 1,
        showSeconds: !1,
        showMeridian: !1,
    });
     
    $("#end_time").timepicker({
        minuteStep: 1,
        showSeconds: !1,
        showMeridian: !1,
    });
     
 
    //image browse form media
    var route_prefix = "{{url('/bdrentz-admin/media-file')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "{{url('images/default.jpg')}}");
    })

    //Datepicker
    $("#close_date").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true,
        startDate: "today",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $("#available_date").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true, 
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $('.time_pick').change(function(e) {        
        var start_time = moment($('#start_time').val(), 'HH:mm'); 
        var end_time = moment($('#end_time').val(), 'HH:mm'); 

        var durtion = moment.utc(moment(end_time,"HH:mm:ss").diff(moment(start_time,"HH:mm:ss"))).format("HH:mm"); 
        var minutes = moment.duration(durtion).asMinutes(); 

        if ( start_time  > end_time ) {
            //swalError('Sorry please correct input');
            //$(this).val(0);
        }else{
            $('#clss_duration').val(minutes);
        }  
    })

    $('#wklist > label').click(function(e) {  
        if ($(this).hasClass('selected')) {
            $(this).find("input[type='checkbox']").prop('checked', false);
        }else{
            $(this).find("input[type='checkbox']").prop('checked', true);
        } 
        $(this).toggleClass('selected'); 
        return false;
    })
     

    //Datepicker
    $(".schpicker").datepicker({
        todayHighlight: !0,
        format: 'yyyy-m-d',
        autoclose: true,
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $(document).on("click",".addSchDate", function(e) {
        if ($(this).closest('tr').find('.schpicker').val() !='') {
            var $clone = $(this).closest('tr').clone(); 
            $clone.find(':text').val('');  
            $clone.appendTo("#scheduleTable");

            $(this).addClass('removeSchDate').removeClass('addSchDate'); 

            $(".schpicker").datepicker({
                todayHighlight: !0,
                format: 'yyyy-m-d',
                autoclose: true,
                templates: {
                    leftArrow: '<i class="la la-angle-left"></i>',
                    rightArrow: '<i class="la la-angle-right"></i>'
                }
            })
        }else{
            swalError('Sory! please input date');
        } 
    })

    $(document).on("click",".removeSchDate", function(e) {
        $(this).closest('tr').remove();
    }) 
  //image browse form media
  var route_prefix = "{{url('/bdrentz-admin/media-file')}}";
    $('#lfm').filemanager('image', {prefix: route_prefix}); 
    $('#mediaHolder').click(function(e) {
        $(this).find('img').attr('src', "{{url('images/default.jpg')}}");
    })




    // FIND MONTHLY AVARAGE
    $('.calculatAvgMonthly').blur(function(e){
        var value = e.target.value;
        var newValue = Math.floor(value/30);
        $(".getAvgMonthly").val(newValue);
        //  alert('are you book now?')
    });
  // FIND TWO TWOWEEK AVARAGE
   $('.calculatAvgTwoWeek').blur(function(e){
        var value = e.target.value;
        var newValue = Math.floor(value/15);
        $(".getAvgTwoWeek").val(newValue);
    });
   
  // FIND TWO TWOWEEKly AVARAGE
   $('.calculatAvgWeekly').blur(function(e){
        var value = e.target.value;
        var newValue = Math.floor(value/7);
        $(".getAvgTwoWeekly").val(newValue);
    });


</script>
@endpush