@extends('layouts.app')

{{-- Main content aection --}}
@section('content')
<section class="dashboard-section">
  <div class="container">
    <div class="row">
       <div class="col-sm-4 col-lg-3">
          @include('includes.frontend.leftbar')
       </div>
       <div class="col-sm-8 col-lg-9">
          <div class="page-title">Bestellungen</div>  
          <div class="page-content" style="margin-bottom: 50px;"> 
            <table class="table table-striped- table-bordered table-hover table-checkable" id="datatable">
              <thead>
                  <tr> 
                      <th width="40">Sl.</th>
                      <th>Tanzkurs</th>   
                      <th>Rechnungs-Nr.</th> 
                      <th>Buchung von</th>
                      <th>Buchung zu</th>
                      <th>Buchungsdatum</th>
                      <th>Zahlungsmethode</th>  
                      <th>Bestellstatus</th>  
                  </tr>
              </thead>
              <tbody> 
                  @foreach($bookings as $key => $booking) 
                      <tr> 
                          <td tabindex="0">{{ ++$key }}</td>  
                          <td tabindex="1">{!! $booking->course->title??'' !!}</td> 
                          <td tabindex="2">  {{ $booking->invoice_number??'' }} </td> 
                          <td tabindex="3">
                            @if(isset($booking->day_from) && !empty($booking->day_from)) 
                              {{ date('d.m.Y', strtotime($booking->day_from))  }} 
                            @elseif(isset($booking->course->available_date))
                              {{ date('d.m.Y', strtotime($booking->course->available_date))  }} 
                            @endif 
                          </td>
                          <td tabindex="3"> 
                            @if(isset($booking->day_to) && !empty($booking->day_to)) 
                              {{ date('d.m.Y', strtotime($booking->day_to))  }} 
                            @elseif(isset($booking->course->close_date))
                              {{ date('d.m.Y', strtotime($booking->course->close_date))  }} 
                            @endif  
                          </td>

                          <td tabindex="4"> 
                            @if(isset($booking->created_at) && !empty($booking->created_at)) 
                              {{ date('d.m.Y', strtotime($booking->created_at))  }}  
                            @endif
                          </td>

                          <td tabindex="5"> 
                             {{ ucfirst($booking->payment_method)??''}}
                          </td>  
                          <td tabindex="6"> 
                             {{ ucfirst($booking->status)??''}}
                          </td> 
                      </tr> 
                  @endforeach
              </tbody>
            </table> 
          </div>
        </div>
      </div>
    </div>        
</section> 
@endsection
{{-- End main content section --}}
@push('scripts')
  <style>
    .dataTables_length label, .dataTables_filter label{
      display: flex;
      font-size: 13px;
    }
    .dataTables_filter label{
      float: right;
    }
    .dataTables_length .form-control, .dataTables_filter .form-control{
      display: inline-block;
      width: 150px;
      margin: 0 5px
    }
    .paging_simple_numbers .pagination{
      float: right;
      font-size: 75%;
    }
    .dataTables_info{
      font-size: 75%;
    }
  </style>
@endpush

@push('scripts')
    <script>
      $("#datatable").DataTable({
        responsive: !0,
        paging: !0,
        "ordering": false, 
        "pageLength": 100
      }); 
    </script>
@endpush


