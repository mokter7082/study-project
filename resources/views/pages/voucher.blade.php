@extends('layouts.app')
@section('title', 'Welcome to Dancezone')
@section('content') 
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
            <div class="col-lg-6 col-md-6"> 
                {!! $data->description??'' !!}
            </div>
            <div class="col-lg-6 col-md-6">
               <div class="voucher__form__wrap"> 
                  <form method="post" action="{{route('voucher-mail')}}" class="voucher__form">
                    @csrf
                     <div class="row">
                        <div class="col-md-12">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="vorname" placeholder="Vorname *" required="">
                              <div class="form-control-feedback">{{ $errors->first('vorname') }}</div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="nachname" placeholder="Nachname">
                              <div class="form-control-feedback">{{ $errors->first('nachname') }}</div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                              <input type="email" class="form-controll" name="email" placeholder="E-Mail-Adresse *"  required="">
                              <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="telefon" placeholder="Telefon">
                              <div class="form-control-feedback">{{ $errors->first('telefon') }}</div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="strasse" placeholder="Strasse, Nr. *" required="">
                              <div class="form-control-feedback">{{ $errors->first('strasse') }}</div>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="plz" placeholder="PLZ *" required="">
                              <div class="form-control-feedback">{{ $errors->first('plz') }}</div>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="ort" placeholder="Ort *" required="">
                              <div class="form-control-feedback">{{ $errors->first('ort') }}</div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                              <input type="text" class="form-controll" name="gutscheinbetrag" placeholder="Gutscheinbetrag in CHF *" required="">
                               <div class="form-control-feedback">{{ $errors->first('gutscheinbetrag') }}</div>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group">
                              <textarea name="nachricht" class="form-controll" placeholder="Deine Nachricht ..."></textarea>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="input-group contact__btn">
                              <button type="submit" class="thm-btn sm contact-one__btn">Tanzgutschein anfordern</button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div> 
            </div>
         </div>
      </section> 
   </div>
 </section>
@endsection