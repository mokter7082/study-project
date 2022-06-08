@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="main-content-area white-bg">
  <div class="container">
    <section class="page-title"><h1>Alle Tanzkurse im Überblick</h1></section>
    @if(!empty($courses))
      @foreach($courses as $key => $course_items)
        <section class="box-area">
          <dv class="box-title"><h2>{{$key??''}}</h2></dv>
          <div class="box-contents">
            <table class="box-table datatable fullwidth">
              <thead>
                <tr role="row">
                  <th>Kurs</th>
                  <th>Wochentag</th>
                  <th>Uhrzeit</th>
                  <th>Zeitraum</th>
                  <th>Preis (Einzel/Paar)</th>
                  <th>Infos</th>
                </tr>
              </thead>
              <tbody>
                @if(!empty($course_items))
                  @foreach($course_items as $item)
                    <tr>
                      <td><a href="{{route('single_course', $item->slug)}}">{{$item->title??''}}</a></td>
                      <td>{{strweekday($item->week_days, $rtype=1)}}</td>
                      <td>{{!empty($item->start_time)? date('H:i', strtotime($item->start_time)) . ' Uhr':''}}</td>
                      <td>{{ !empty($item->available_date)? date('d.m', strtotime($item->available_date)):'' }} - {{ !empty($item->close_date)? date('d.m.Y', strtotime($item->close_date)):'' }} ({{count($item->schedules)}}x{{$item->clss_duration}}  min) </td>
                      <td>
                        @if(!empty($item->single_price))
                        <span class="amount">{{number_format($item->single_price)}}&nbsp;<span class="symbol">CHF</span></span> 
                        @endif
                        @if(!empty($item->single_price) && !empty($item->pair_price)) – @endif
                        @if(!empty($item->pair_price))
                        <span class="amount">{{number_format($item->pair_price)}}&nbsp;<span class="symbol">CHF</span></span>
                        @endif
                      </td>
                      <td>
                        <span data-content="{{excerpt($item, 100)}}" data-delay="50" data-placement="top" data-title="Kursinfo" data-toggle="popover" data-trigger="hover" data-original-title="" title=""><div class="text-center"><i class="fa fa-plus-square"></i></div></span>
                      </td>
                    </tr>
                  @endforeach
                @endif 
              </tbody>
            </table>
          </div>
        </section>
      @endforeach
    @endif 
  </div>
</div>
@endsection 

@push('scripts') 
<script> 
  $(document).ready(function(){
    $('[data-toggle="popover"]').popover();  
    $('#element').popover('show');

    $('.datatable').DataTable({
      "paging": false,
      "searching": false,
      "info": false
    }); 
  });
</script>
@endpush