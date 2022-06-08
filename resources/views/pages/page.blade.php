@extends('layouts.app')
@section('title', 'Welcome to Dancezone')
@section('content')

{{-- @if($data->picture && $data->picture !='')
  <section class="bg-banner" style="background: url({{$data->picture}}) center center no-repeat fixed; background-size: cover;">
    <div class="banner-container">
      <h2>{{$data->title??''}}</h2>
    </div>
  </section>
@endif --}}

<section class="breadcumb">
@php($sigment_parent = Request::segment(1))
@php($sigment_sub = Request::segment(2))
  <div class="container">
     <ul>
        <li><a href="index.html">Home</a></li>
        <li><a class="current" href="{{$sigment_parent}}">{{$data->title??''}}</a></li> 
        @if(!empty($sigment_sub))
        <li><span class="current">{{$sigment_sub}}</span></li> 
        @endif
     </ul>
  </div>
 </section>
 <section class="main-content-area whtrnbg">
    <div class="container">  
       <section class="container-area">
          <div class="row">
             <div class="col-lg-9  col-md-8">
                {!! $data->description??'' !!}
             </div>
             <div class="col-lg-3 col-md-4">
                <div class="right-bar">
                   <div class="widget-area">
                      <h2 class="widget-title">DANCE CLASSES</h2>
                      <ul class="catlist">
                         <li><a href="{{url('/ueber-uns')}}">ÜBER UNS</a></li>
                         <li><a href="{{url('/dienstleistungen')}}">DIENSTLEISTUNGEN</a></li>
                         <li><a href="{{url('/team')}}">TEAM</a></li>
                         <li><a href="{{url('raeumlichkeiten')}}">RÄUMLICHKEITEN</a></li>
                         <li><a href="{{url('/unsere-partner')}}">UNSERE PARTNER</a></li>
                         <li><a href="{{url('/agb')}}">AGB</a></li>
                      </ul>
                   </div>
                   <div class="event-button-area">
                      <button>
                         <span class="iocn">
                            <i class="fa fa-calendar-alt"></i>
                         </span>
                         <span class="txt">Aktuelles Kursprogramm im Überblick</span>
                      </button>
                   </div>

                   <div class="widget-area">
                      <h2 class="widget-title">TANZPARTNER GESUCHT!</h2>
                      <div class="widget-content">
                      <p>Immer wieder kommt es vor, dass für einzelne Paar-Tanzkurse weibliche oder männliche Tanzpartner fehlen. Daher suchen wir immer wieder Tanzkurs-Aushilfspartner.</p> 
                      <p> <strong>Dein Vorteil als Tanzkurs-Aushilfe:</strong> <br> Du kannst kostenlos am Tanzkurs teilnehmen, bei Bedarf auch regelmässig.</p>
                       <p> <a class="btn btn-primary" target="_self" href="tel:0041792430303">MEHR INFOS</a></p> 
                      </div>
                   </div> 
                </div>
             </div>
          </div>
       </section> 
    </div>
 </section>
@endsection