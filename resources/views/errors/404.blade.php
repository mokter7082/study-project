{{-- @extends('errors::minimal')

@section('title', __('Not Found'))
@section('code', '404')
@section('message', __('Not Found')) --}}

@extends('layouts.app')
@section('title', '404')
@section('content') 
<section class="breadcumb">
@php($sigment_parent = Request::segment(1))
@php($sigment_sub = Request::segment(2))
  <div class="container">
     <ul>
        <li><a href="index.html">Home</a></li>
        <li><a class="current">404</a></li>
     </ul>
  </div>
 </section>
 <section class="main-content-area whtrnbg">
    <div class="container">  
       <section class="container-area">
          <div class="row">
             <div class="col-lg-12">
                 <h1 style="display: block; text-align: center; padding: 100px 0 130px; font-size:64px; line-height: 1; color: #ddd"> 404!! </h1>
             </div> 
          </div>
       </section> 
    </div>
 </section>
@endsection