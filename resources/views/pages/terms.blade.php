@extends('layouts.app')
@section('title', 'Welcome to TUNINGFILESERVICE24')
@section('content')
 
<section class="section-consulting">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <img src="{{asset('frontend/images/tuning-img.jpg')}}" alt="">
            </div>
            <div class="col-md-7">
                <h2 class="tun-title">Terms and Conditions</h2>
                <p>A Terms and Conditions agreement is not legally required. However, having one comes with a number of important benefits for both you and your users/customers. <br><br> The benefits include increasing your control over your business/platform, while helping your users understand your rules, requirements and restrictions.</p>
                <a href="#" class="read-more">Read More</a>
            </div>
        </div>
    </div>
</section>
@endsection