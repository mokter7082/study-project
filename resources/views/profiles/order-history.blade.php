@extends('layouts.app')

{{-- Main content aection --}}
@section('content')

<section class="info-bar">
  <div class="container">
    <div class="welocme">
      <h3>Order History</h3> 
    </div>
  </div>
</section> 
<section class="process-section">
    <div class="breadcumb-section">
      <div class="container">
        <ul>
          <li><a href="#">MY account</a></li>
          <li><a href="#">Order History</a></li>
        </ul>
      </div>
    </div>
    <div class="container">
        <table class="datatable-grid orderhistory-datagrid mb-4">
            <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Method</th>
                    <th>Credits</th>
                    <th>Price</th>
                    <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                @if(!empty($orders))
                    @foreach($orders as $ord)
                    <tr>
                        <td>{{$ord->order_code??''}}</td>
                        <td>{{$ord->order_date??''}}</td>
                        <td>{{$ord->status??''}}</td>
                        <td>{{ucfirst($ord->payment_method)??''}}</td>
                        <td>{{ intval($ord->credits)??''}}</td>
                        <td>€ {{$ord->price??''}} ( Excl. VAT )</td>
                        <td><a target="_blank" class="btn btn btn-sm btn-brand" href="#" title="Download invoice">Download invoice</a></td>
                    </tr>
                    @endforeach
                @endif
            </tbody> 
        </table>
        <div class="col-md-12 pager text-right">{{ $orders->render() }}</div> 
    </div>            
</section> 
@endsection
{{-- End main content section --}}

@push('scripts')
    <script></script>
@endpush