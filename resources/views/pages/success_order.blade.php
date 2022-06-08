@extends('layouts.app')
@section('title', 'Home')
@section('content')
<section class="breadcumb">
  <div class="container">
    <ul>
      <li><a href="{{route('home')}}">Home</a></li> 
      <li><a href="{{route('kasse')}}">KASSE</a></li> 
      <li><span class="current">SUCCESS</span></li> 
    </ul>
  </div>
</section>
<div class="main-content-area whtrnbg">
  <div class="container">
    <section class="container-area mt-50 mb-50">
      <div class="success-wrapper">
        <div class="success-heder">
          <h2>Thanks, {{$name}}</h2> 
          <p>Ihre Bestellung Nr. <strong> {{ $order->order_code??'' }} </strong> wurde erfolgreich aufgegeben, wir werden uns sehr bald mit Ihnen in Verbindung setzen</p>
          <p>
            Your default login information below: <br>
            <strong>Emil </strong>: {{$email??''}}, 
            <strong>Password </strong> : {{$pass??''}} <br>
            <small>You can change your login information from account settings.</small> 
          </p>
        </div>
      </div> 
    </section> 
  </div>
</div>
@endsection 
@push('style') 
  <style> 
    .success-wrapper{
      border: 1px solid #b90042;
      padding: 10px;
      margin: 0 auto;
      text-align: center;
      max-width: 600px;
      position: relative;
    }
    .success-heder{
      padding:25px 25px 20px 25px;
      background:#79002b;
      color: #fff;
    }
    .success-heder h2{
      font-size: 20px;
      color: #fff;
    }
    .success-heder p{
      font-size: 14px;
      color: #fff;
    }
    .success-heder strong{
      color: #ff002f;
      font-size: 105%;
    }
  </style>
@endpush
@push('scripts') 
<script> 
   
</script>
@endpush