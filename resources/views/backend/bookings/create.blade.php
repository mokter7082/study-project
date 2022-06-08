@extends('layouts.app-backend')
@section('title', 'Course Management')
@section('content') 

@if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif


@if(isset($order->id))
	{!! Form::model($order, ['method' => 'PATCH','route' => ['bookings.update', $order->id], 'class'=>'m-form m-form--fit m-form--label-align-right', 'id'=>'bookingForm', 'files' => false]) !!}
@else
	{!! Form::open(array('route' => 'bookings.store','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right', 'id'=>'bookingForm', 'files' => false)) !!} 
@endif
<div class="row">
    <div class="col-md-12 pl5 pr5">
        <div class="m-portlet m-portlet--tab">  
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">Booking Course</h3>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    @can('category-list')
                    <ul class="m-portlet__nav">
                        <li class="m-portlet__nav-item">
                            <a href="{{ route('bookings.index') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                                <span>
                                    <i class="la la-list"></i>
                                    <span>All Pending Request</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                    @endcan
                </div>
            </div>
            <div class="m-portlet__body">
                <table style="width: 100%"> 
                    <tr>
                        <td colspan="3">
                            <h2>RECHNUNG</h2> 
                        </td> 
                    </tr>
                    <tr>
                        <td width="60%">
                            <p>{{ $order->anrede?? '' }} {{ $order->first_name??'' }} {{ $order->last_name??'' }} <br> {{ $order->address??'' }}<br>
                                {{ $order->city??'' }} <br> {{ $order->postcode??'' }}</p>
                        </td>
                        <td colspan="2" valign="top">
                            <p>Rechnungs-Nr.: {{ $order->invoice_number??'' }}<br>
                             Rechnungsdatum: @if(!empty($order->order_date)) {{ date('d.m.Y', strtotime($order->order_date))  }} @endif<br>
                             Bestell-Nr.: {{ $order->order_code??''}}  <br> Bestelldatum: @if(!empty($order->order_date)) {{ date('d.m.Y', strtotime($order->order_date))  }} @endif <br>
                            Zahlungsmethode: {{ ucfirst($order->payment_method)??''}}</p>
                        </td> 
                    </tr> 
                </table>

                <h4 style="width: 100%; border-collapse: collapse; margin-top: 30px;">Klassendetails</h4>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #222; color: #fff;">
                        <tr>
                            <th style="width: 40%; padding: 5px 10px; background: #9e5354; color: #fff;">Kursinfo</th>
                            <th style="padding: 5px 10px; background: #9e5354; color: #fff;">Unterrichtszeit</th>
                            <th style="padding: 5px 10px; background: #9e5354; color: #fff;">Dauer</th>
                            <th style="padding: 5px 10px; background: #9e5354; color: #fff;">Anfangsdatum</th>
                            <th style="padding: 5px 10px; background: #9e5354; color: #fff;">Instructor</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-bottom: 1px solid #9e5354; padding: 5px 10px">
                                @if(!empty($order->course->picture))
                                <img style="width: 60px; display: inline-block; margin-right: 15px" src="{{isset($order->course->picture) && $order->course->picture !=''? $order->course->picture: URL::to('image/default.jpg')}}" class="m--marginless" alt="photo"> 
                                @endif 

                                <strong style="padding: 5px">{{$order->course->title??''}}</strong> 
                            
                            </td>
                            <td style="border-bottom: 1px solid #9e5354; padding: 5px 10px">
                                 <span>
                                Start: {!! $order->course->start_time??'' !!} <br>
                                End: {!!  $order->course->end_time??'' !!} 
                            </span>
                            </td>
                            <td style="border-bottom: 1px solid #9e5354; padding: 5px 10px">
                                 <span> 
                                Duration: {!! $order->course->clss_duration??'' !!} 
                            </span>
                            </td>
                            <td style="border-bottom: 1px solid #9e5354; padding: 5px 10px">
                                 {{ date('d.m.Y', strtotime($order->course->available_date))??''}} 
                            </td>
                            <td style="border-bottom: 1px solid #9e5354; padding: 5px 10px">
                                @foreach($order->course->instructors as $inst)
                                <span>{{$inst->name??''}}</span> <br>
                                @endforeach 
                            </td> 
                        </tr>
                    </tbody> 
                </table>


                <h4 style="width: 100%; border-collapse: collapse; margin-top: 30px;">Zahlungsinformationen</h4>
                <table style="width: 100%; border-collapse: collapse;">
                    <thead style="background: #222; color: #fff;">
                        <tr>
                            <th style="width: 60%; padding: 5px 10px; background: #222; color: #fff;">Tanzkurs</th>
                            <th style="padding: 5px 10px; background: #222; color: #fff;">Anzahl</th>
                            <th style="padding: 5px 10px; background: #222; color: #fff;">Preis</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{$order->course->title??''}} - {{ ucfirst($order->ticket_type)??''}}</td>
                            <td style="border-bottom: 1px solid #ddd; padding: 5px 10px">1</td>
                            <td style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{$order->price??''}} CHF</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td style="border: none;"></td>
                            <td colspan="2" style="border-bottom: 1px solid #ddd; padding: 5px 10px">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="border: none;"></td>
                            <td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"> <strong>Zwischensumme</strong></td>
                            <td  style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{number_format($order->price,2)??''}} CHF</td>
                        </tr>
                        @if($order->discount > 0)
                        <tr>
                            <td style="border: none;"></td>
                            <td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"> <strong>Rabatt</strong></td>
                            <td  style="border-bottom: 1px solid #ddd; padding: 5px 10px">{{number_format($order->discount,2)??''}} CHF</td>
                        </tr>
                        @endif
                        <tr>
                            <td style="border: none;"></td>
                            <td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"><strong>Gesamt</strong></td>
                            <td  style="border-bottom: 1px solid #ddd; padding: 5px 10px"><strong>{{ number_format($order->total_pay, 2)}} CHF</strong></td>
                        </tr>
                    </tfoot>
                </table>  

                <div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space"></div> 
                
                <div class="row"> 
                    <div class="col-md-4">
                        @php($start_date = date('d.m.Y', strtotime($order->course->available_date)))
                        <div class="form-group {{ $errors->has('day_from') ? 'has-danger' : '' }}"> 
                            {!! Form::label('day_from', 'From Date') !!}
                            {!! Form::text('day_from', $start_date??'', array('class' => 'form-control m-input', 'required'=>true, 'id'=>'day_from')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('day_from') }}</div>
                        </div> 
                    </div>
                     <div class="col-md-4">
                        @php($close_date = date('d.m.Y', strtotime($order->course->close_date)))
                        <div class="form-group {{ $errors->has('day_to') ? 'has-danger' : '' }}"> 
                            {!! Form::label('day_to', 'To Date') !!}
                            {!! Form::text('day_to',  $close_date??'', array('class' => 'form-control m-input', 'required'=>true, 'id'=>'day_to')) !!} 
                            <div class="form-control-feedback">{{ $errors->first('day_to') }}</div>
                        </div> 
                    </div> 
                </div>  

                @if($order->course->seat < 2 && $order->ticket_type =='paar')
                    <p class="note"><strong>Warning:</strong> Currently Available Seat = <strong>{{$order->course->seat??0}}</strong>,  you can place this booking pre booking for next sloat.</p>
                @elseif($order->course->seat < 1 && $order->ticket_type =='einzelperson')
                    <p class="note"><strong>Warning:</strong> Currently Available Seat = <strong>{{$order->course->seat??0}}</strong>,  you can place this booking pre booking for next sloat.</p>    
                @endif 
            </div>
            <div class="m-portlet__foot m-portlet__foot--fit">
                <div class="m-form__actions">
                    <input type="hidden" name="order_id" value="{{$order->id??''}}"> 
                    <input type="hidden" name="status" id="status" value="Confirmed">
                    <button type="button" class="btn m-btn--pill btn-info btn-lg m-btn m-btn--custom" id="confirm">Book Now</button>
                    <button type="button" class="btn m-btn--pill btn-danger btn-lg m-btn m-btn--custom" id="cancle">Cancle</button>
                </div>
            </div>
        </div>
    </div> 
</div>
{!! Form::close() !!} 
@endsection

@push('style')
<style>
    .note strong{
        color: #f4516c;
        font-weight: 500;
    }
</style>
@endpush

@push('scripts')
<script>  

    $('#confirm').click(function(e) { 
        swalConfirm('To Confirm This Request').then((result) => {
          if (result.value) { 
            $('#status').val('Confirmed');
            $('#bookingForm').submit();
          }
        })
    })

    $('#cancle').click(function(e) { 
        swalConfirm('To Cancle This Request').then((result) => {
          if (result.value) { 
            $('#status').val('Canceled');
            $('#bookingForm').submit();
          }
        }) 
    })
 

     //Datepicker
    $("#day_to").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true,
        startDate: "today",
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })

    $("#day_from").datepicker({
        todayHighlight: !0,
        format: 'd.m.yyyy',
        autoclose: true, 
        templates: {
            leftArrow: '<i class="la la-angle-left"></i>',
            rightArrow: '<i class="la la-angle-right"></i>'
        }
    })
</script>
@endpush