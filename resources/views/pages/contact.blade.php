@extends('layouts.app')
@section('title', 'Contact')
@section('content')
 
<!--Page Header Start-->
         <section class="page-header" style="background-image: url({{asset('frontend/images/kontakt.jpg')}});">
            <div class="container">
                <h2>Contact</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{url('/')}}">Home</a></li>
                    <li><span>KONTAKT</span></li>
                </ul>
            </div>
         </section> 
         <div class="main-content-area whtrnbg">
            <div class="container">
               <section class="container-area mt-50">
                  <div class="row">
                     <div class="col-lg-3 col-md-4">
                        <div class="right-bar">
                           <div class="widget-area">
                              <div class="center-box">
                                 <div class="icon-box">
                                    <i class="fa fa-map-marker-alt"></i>
                                 </div>
                                 <h4 class="widget-title text-center">Standort</h4>
                                 <p class="loc-text text-center">Seemattstrasse 2<br> 8180 Bülach</p>                                 
                              </div>
                              <div class="center-box">
                                 <div class="icon-box"> 
                                    <i class="fa fa-phone-alt"></i>
                                 </div>
                                 <h4 class="widget-title text-center">TELEFON</h4>
                                 <p class="loc-text text-center"><a href="tel:0041792430303">079 243 03 03</a></p>                                 
                              </div>
                              <div class="center-box">
                                 <div class="icon-box"> 
                                    <i class="fa fa-envelope"></i> 
                                 </div>
                                 <h4 class="widget-title text-center">E-Mail-Adresse</h4>
                                 <p class="loc-text text-center"><a href="mailto:info@dancezone.ch">info@dancezone.ch</a></p>                                 
                              </div>
                           </div> 
                        </div>
                     </div>
                     <div class="col-lg-8 col-md-7 offset-md-1"> 
                        <div class="contact-one__form__wrap">
                           <h2 class="title-text">Nimm Kontakt mit uns auf!<br>Wir freuen uns auf deine Nachricht!</h2>
                           <form action="inc/sendemail.php" class="contact-one__form">
                              <div class="row">
                                 <div class="col-md-6">
                                    <div class="input-group">
                                       <input type="text" name="name" placeholder="Vorname *">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="input-group">
                                       <input type="text" name="name" placeholder="Nachname">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="input-group">
                                       <input type="email" name="email" placeholder="E-Mail-Adresse *">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="input-group">
                                       <input type="text" name="Phone" placeholder="Telefon">
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="input-group">
                                       <textarea name="message" placeholder="Deine Nachricht ..."></textarea>
                                    </div>
                                 </div>
                                 <div class="col-md-12">
                                    <div class="input-group contact__btn">
                                       <button type="submit" class="thm-btn contact-one__btn">Send message</button>
                                    </div>
                                 </div>
                              </div>
                           </form>
                        </div> 
                     </div> 
                  </div>
               </section>
 
            </div>
         </div>
@endsection