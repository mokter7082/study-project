@extends('layouts.app-backend')
@section('title', 'Booking Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Booking Management</h3>
            </div>
        </div> 
        <div class="m-portlet__head-tools">
            @can('book-create')
            <ul class="m-portlet__nav">
                <li class="m-portlet__nav-item">
                    <a href="{{ route('bookings.create') }}" class="btn btn-primary m-btn m-btn--pill m-btn--custom m-btn--icon m-btn--air">
                        <span>
                            <i class="la la-plus"></i>
                            <span>Create New</span>
                        </span>
                    </a>
                </li>
            </ul>
            @endcan
        </div>
    </div>

    <div class="m-portlet__body"> 
        <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
            <thead>
                <tr> 
                    <th width="40">Sl No.</th>
                    <th>Tanzkurs</th>  
                    <th>Rechnung</th>  
                    <th>Rechnungs-Nr.</th> 
                    <th>Rechnungsdatum</th>
                    <th>Bestell-Nr.</th>
                    <th>Bestelldatum</th>
                    <th>Zahlungsmethode</th> 
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody> 
                @foreach($orders as $key => $order) 
                    <tr> 
                        <td tabindex="0">{{ ++$key }}</td>  
                        <td tabindex="2">{!! $order->course->title??'' !!}</td>
                        <td tabindex="3">
                            <small>
                            {{ $order->anrede?? '' }} {{ $order->first_name??'' }} {{ $order->last_name??'' }} <br>
                            {{ $order->address??'' }}<br>
                            {{ $order->city??'' }} <br>
                            {{ $order->postcode??'' }}
                            </small>
                        </td> 
                        <td tabindex="4"> 
                           {{ $order->invoice_number??'' }}
                        </td>
                        <td tabindex="5"> 
                           @if(!empty($order->order_date)) {{ date('d.m.Y', strtotime($order->order_date))  }} @endif
                        </td>
                        <td tabindex="4"> 
                           {{ $order->order_code??''}}
                        </td>
                        <td tabindex="5"> 
                          @if(!empty($order->order_date)) {{ date('d.m.Y', strtotime($order->order_date))  }} @endif
                        </td>
                        <td tabindex="5"> 
                           {{ ucfirst($order->payment_method)??''}}
                        </td>
                        <td><label class="m--font-bold m--font-primary">{{ $order->status??''}}</label></td>
                        <td nowrap="" align="center">
                            @if((auth()->user()->can('booking-delete') || auth()->user()->can('booking-edit')))
                            <span class="dropdown">
                                <a href="#" class="btn m-btn m-btn--hover-brand m-btn--icon m-btn--icon-only m-btn--pill" data-toggle="dropdown" aria-expanded="true"><i class="la la-ellipsis-h"></i></a>
                                <div class="dropdown-menu dropdown-menu-right">  
                                    @can('course-edit')
                                        <a class="dropdown-item" href="{{ route('bookings.edit',$order->id) }}"><i class="la la-edit"></i> Booked </a>
                                    @endcan 
                                    @can('course-delete')
                                        <a class="dropdown-item delItem" href="#{{route('bookings.destroy', $order->id)}}" data-delform="delete-form{{ $order->id }}"><i class="la la-trash"></i>Cancle</a>
                                    {!! Form::open(['method' => 'DELETE','route' => ['bookings.destroy', $order->id],'style'=>'display:inline', 'id'=>'delete-form'.$order->id]) !!}
                                    {!! Form::close() !!}
                                    @endcan 
                                </div>
                            </span>
                            @endif            
                        </td>
                    </tr> 
                @endforeach
            </tbody>
        </table> 
    </div> 
</div>
@endsection

@push('scripts')
<script>
    $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        "ordering": false, 
        "pageLength": 100
    }); 
    $('.delItem').click(function(e) {
        e.preventDefault; 
        var formId = $(this).data('delform'); 
        swalConfirm().then((result) => {
          if (result.value) { 
            $('#'+formId).submit();
          }
        })
    })
</script>
@endpush
