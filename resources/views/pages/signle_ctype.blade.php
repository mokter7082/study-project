@extends('layouts.app')
@section('title', 'Home')
@section('content')
<section class="breadcumb">
@php($sigment_parent = Request::segment(1))
@php($sigment_sub = Request::segment(2))
  <div class="container">
     <ul>
        <li><a href="index.html">Home</a></li>
        <li><a href="index.html">{{$sigment_parent}}</a></li> 
        <li><span class="current">{{$sigment_sub}}</span></li> 
     </ul>
  </div>
</section>
<div class="main-content-area whtrnbg">
  <div class="container"> 
    <section class="box-area">
      <dv class="box-title">
         <h2>Aktuelle {{$ctype->title??''}} Kurse</h2>
      </dv>
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
              @if(!empty($couses))
                @foreach($couses as $item)
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
     
    <section class="container-area">
      <div class="row">
         <div class="col-lg-9  col-md-8">
          {!!$ctype->description??''!!} 
         </div>
         <div class="col-lg-3 col-md-4">
            <div class="right-bar">
              @if(!empty($allCtype))
                <div class="widget-area">
                  <h2 class="widget-title">DANCE CLASSES</h2>
                  <ul class="catlist"> 
                    <li @if(empty($sigment_sub)) class="current" @endif><a href="{{url('tanzkurse')}}"> ALL COURSES </a></li>  
                    @foreach($allCtype as $citem)
                    <li  @if(!empty($sigment_sub) && $sigment_sub ==$citem->slug) class="current" @endif><a href="{{url('tanzkurse', $citem->slug)}}">{{strtoupper($citem->title??'')}}</a></li> 
                    @endforeach
                  </ul>
                </div>
              @endif

              {!! OmeLabHelper::displayWidgets('kursanmeldung') !!}
              {!! OmeLabHelper::displayWidgets('all_Kursteilnehmer') !!}
              {!! OmeLabHelper::displayWidgets('tanzpartner') !!} 
 
            </div>
         </div>
      </div>
    </section> 
  </div>
</div>
@endsection 
@push('style') 
  <style> 
    
  </style>
@endpush
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