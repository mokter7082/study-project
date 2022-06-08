@extends('layouts.app-backend')
@section('title', 'Booking Management')
@section('content')
<div class="m-portlet m-portlet--mobile">
    <div class="m-portlet__head">
        <div class="m-portlet__head-caption">
            <div class="m-portlet__head-title">
                <h3 class="m-portlet__head-text">Completed Booking List</h3>
            </div>
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
                    <th>Buchung von</th>
                    <th>Buchung zu</th>
                    <th>Buchungsdatum</th>
                    <th>Zahlungsmethode</th> 
                    <th>Status</th> 
                    <th>Aktion</th> 
                </tr>
            </thead>
            <tbody> 
                @foreach($bookings as $key => $booking) 
                    <tr> 
                        <td tabindex="0">{{ ++$key }}</td>  
                        <td tabindex="2">{!! $booking->course->title??'' !!}</td>
                        <td tabindex="3">
                            <small>
                            {{ $booking->anrede?? '' }} {{ $booking->first_name??'' }} {{ $booking->last_name??'' }} <br>
                            {{ $booking->address??'' }}<br>
                            {{ $booking->city??'' }} <br>
                            {{ $booking->postcode??'' }}
                            </small>
                        </td> 
                        <td tabindex="4"> 
                           {{ $booking->invoice_number??'' }}
                        </td> 
                        <td tabindex="5"> 
                           @if(!empty($booking->day_from)) {{ date('d.m.Y', strtotime($booking->day_from))  }} @endif
                        </td>

                        <td tabindex="6"> 
                           @if(!empty($booking->day_to)) {{ date('d.m.Y', strtotime($booking->day_to))  }} @endif
                        </td>

                        <td tabindex="7"> 
                           @if(!empty($booking->created_at)) {{ date('d.m.Y', strtotime($booking->created_at))  }} @endif
                        </td>  
                        <td tabindex="5"> 
                           {{ ucfirst($booking->order->payment_method)??''}}
                        </td>
                        <td><label class="m--font-bold m--font-primary">{{ $booking->status??''}}</label></td> 

                        <td><a href="{{route('bookings.invoice',  $booking->order_id)}}" target="_blank">Invoice</a></td>
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
