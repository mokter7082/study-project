@extends('layouts.app')
@section('title', 'Home')
@section('content')
<section class="breadcumb">
    <div class="container">
       <ul>
          <li><a href="{{route('home')}}">Home</a></li> 
          <li><span class="current">KASSE</span></li> 
       </ul>
    </div>
</section>
<div class="main-content-area whtrnbg">
  <div class="container">  
    <section class="container-area mt-50">
      @if(!auth()->check())
      <div class="row">
        <div class="col-lg-12"> 
          <div class="login-options">
            <div class="login-info"><span class="icon-circle"> <i class="fa fa-check"></i> </span>Besitzt du bereits ein Kundenkonto? <a href="#" class="showlogin" id="showlogin">Klicke hier, um dich anzumelden.</a>
            </div>
          </div> 
          <div id="loginPanel" style="display: none;">
            <form action="{{route('login')}}" class="reglogin" method="post" id="loginForm">
              @csrf
              <p>Wenn du schon vorher bei uns eingekauft hast, gib bitte deine Daten in die untenstehenden Felder ein. Wenn du Neukunde bist, gehe bitte zum Abschnitt mit den Angaben zu Zahlung und Versand.</p>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="email" class="flebel">Benutzername oder E-Mail&nbsp; <span class="required">*</span></label>
                    <input type="text" class="finput" name="email" id="email" autocomplete="email"> 
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="password" class="flebel">Passwort&nbsp;<span class="required">*</span></label>
                    <input class="finput" type="password" name="password" id="password" autocomplete="current-password" required="">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <a class="lost_password" href="{{route('password.request')}}">Passwort vergessen?</a>
                <label class="remember">
                  <input name="remember" type="checkbox" id="remember" value="1"><span>Angemeldet bleiben</span>
                </label>
                <input type="hidden" name="redirect" value="{{route('kasse')}}">
                <button type="submit" class="btn-submit" name="login" value="Anmelden">Anmelden</button>
              </div> 
            </form>
          </div>
        </div> 
      </div> 
      @endif

      <div class="row coupon-area">
        <div class="col-7"> 
          <h3>Hast Du einen Gutschein-Code?</h3>
        </div>
        <div class="col-lg-5 txt-right">
          <form action="" id="coupon">
            <div class="row">
              <div class="col-md-6">
                <input type="text" class="finput" name="coupon_code" id="couponCode" placeholder="Gutscheincode">
              </div>
              <div class="col-md-6"><button type="button" class="btn-submit" id="validCoupon">Gutschein anwenden</button></div>
            </div>
          </form>
        </div>
      </div>

      <div class="billing-area">
        <form action="{{ route('place-order') }}" method="post" class="billing-form" id="billingFor">
          @csrf
          <div class="row">
            <div class="col-md-2">
              <label for="">Anrede * </label>
            </div>
            <div class="col-md-9">
              <label class="radio-label"><input type="radio" checked="" name="billing_anrede" value="Herr"> Herr</label> 
              <label class="radio-label"><input type="radio" name="billing_anrede" value="Frau"> Frau</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">Vorname *</label>
                <input type="text" class="form-control" name="billing_first_name" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">Nachname *</label>
                <input type="text" class="form-control"  name="billing_last_name" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="form-label">Strasse *</label>
                <input type="text" class="form-control"  name="billing_address_1" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="col-md-5">
              <div class="form-group">
                <label class="form-label">Postleitzahl *</label>
                <input type="text" class="form-control"  name="billing_postcode" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-7">
              <div class="form-group">
                <label class="form-label">Ort / Stadt *</label>
                <input type="text" class="form-control"  name="billing_city" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">E-Mail-Adresse *</label>
                <input type="email" class="form-control"  name="billing_email" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">Mobil *</label>
                <input type="text" class="form-control"  name="billing_phone" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="form-label">Geburstdatum *</label>
                <input type="text" class="form-control datepicker" placeholder="TT.MM.JJJJ"  name="billing_date_of_birth" autocomplete="off" required="">
                <div class="help-block with-errors"></div>
              </div>
            </div> 
          </div>
   
          @if($ticket_type =='paar')
            <div class="paar-area">
              <h2>Daten des Partners / der Partnerin</h2> 
              <div class="row">
                <div class="col-md-2">
                  <label for="">Anrede * </label>
                </div>
                <div class="col-md-9">
                  <label class="radio-label"><input type="radio" checked="" name="p_anrede" value="Herr"> Herr</label> 
                  <label class="radio-label"><input type="radio" name="p_anrede" value="Frau"> Frau</label>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="form-label">Vorname (Partner/in) *</label>
                    <input type="text" class="form-control"  name="p_first_name" required="">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Nachname (Partner/in) </label>
                  <input type="text" class="form-control" name="p_last_name">
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <label class="form-label">Strasse (Partner/in) (wenn abweichend)</label>
                  <input type="text" class="form-control" name="p_address">
                </div> 
              </div>
              <div class="row">
                <div class="col-md-5">
                  <label class="form-label">PLZ (Partner/in) (wenn abweichend) </label>
                  <input type="text" class="form-control" name="p_postcode">
                </div>
                <div class="col-md-7">
                  <label class="form-label">Ort (Partner/in) (wenn abweichend) </label>
                  <input type="text" class="form-control"  name="p_city">
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <label class="form-label">E-Mail-Adresse (Partner/in) </label>
                  <input type="text" class="form-control"  name="p_email">
                </div>
                <div class="col-md-6">
                  <label class="form-label">Mobil (Partner/in) </label>
                  <input type="text" class="form-control"  name="p_phone">
                </div>
              </div>
              <div class="row"> 
                <div class="col-md-6">
                  <label class="form-label">Geburtsdatum (Partner/in)  </label>
                  <input type="text" class="form-control datepicker" placeholder="TT.MM.JJJJ"  name="p_birth_date">
                </div>
              </div>
            </div> 
          @endif

          @if(!auth()->check())
          <div class="naccount-wrap">
            <h3>Möchtest Du ein Kundenkonto eröffnen?</h3>
            <label><input type="checkbox" id="createaccount" name="createaccount" value="1"> Ja, bitte ein Kundenkonto eröffnen</label> 
            <div class="naccount-content" id="nacontent">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="account_username"> Konto-Benutzername * </label>
                    <input type="email" name="account_username" class="form-control" placeholder="Benutzername" id="account_username">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-5"> 
                  <div class="form-group">
                    <label for="account_username">Konto-Passwort erstellen *</label>
                    <input type="password" name="account_password" class="form-control" placeholder="Passwort"> 
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
              <p class="worning">Bitte Pflichtfeld ausfüllen</p>
            </div> 
          </div>
          @endif

          <div class="deine-bestellung">
            <h3>Deine Bestellung</h3>
            <table class="order-table">
              <thead>
                <tr>
                  <th class="product-name">Produkt</th>
                  <th class="product-total">Zwischensumme</th>
                </tr>
              </thead>
              <tbody>
                <tr class="cart_item">
                  <td class="product-name"> 
                    @php( $totalMunits = count($couseInfo->schedules) * $couseInfo->clss_duration * 60) 
                    <div class="product-info">{{$couseInfo->title??''}} - {{ ucfirst($ticket_type)}} &nbsp;
                      <strong class="product-quantity">×&nbsp;1</strong>      
                      <p class="product-custom-fields">{{strweekday($couseInfo->week_days, $rtype=1)}}, {{ !empty($couseInfo->available_date)? date('d.m', strtotime($couseInfo->available_date)):'' }} - {{ !empty($couseInfo->close_date)? date('d.m.Y', strtotime($couseInfo->close_date)):'' }} ({{count($couseInfo->schedules)}}x{{$couseInfo->clss_duration}} min), {{date('H:i',  $totalMunits)}}  Uhr  </p> 
                    </div>
                  </td>
                  <td class="product-total">
                    @if($ticket_type=='paar')
                      @php($price = $couseInfo->pair_price)
                    @else
                      @php($price = $couseInfo->single_price)
                    @endif 
                    <span class="amount">{{ number_format($price) }}&nbsp; CHF </span>
                    <input type="hidden" name="price" id="price" value="{{$price}}">
                    <input type="hidden" name="course_id" id="course_id" value="{{$couseInfo->id}}">
                    <input type="hidden" name="ticket_type" id="ticket_type" value="{{$ticket_type}}">
                    <input type="hidden" name="coupon_code" id="coupon_code" value="">
                    <input type="hidden" name="discount" id="discount" value="0">
                  </td>
                </tr>
              </tbody>
              <tfoot>
                <tr class="cart-subtotal">
                  <th>Zwischensumme</th>
                  <td><span class="amount">{{ number_format($price) }}&nbsp;CHF</td>
                </tr>
                <tr class="order-total">
                  <th>Gesamtsumme</th>
                  <td><strong><span class="amount">{{ number_format($price) }}&nbsp; <span class="symbol">CHF</span></span></strong></td>
                </tr>
              </tfoot>
            </table> 
          </div> 

          <div class="checkout-payment">
            <ul class="payment_methods">
              <li class="pay_bank">
                <label for="payment_method_bank">
                  <input id="payment_method_bank" data-target="payment_method_bank" type="radio" class="payment_method" name="payment_method" value="Banküberweisung" checked="checked"> <span> Banküberweisung </span>
                </label>
                <div class="payment_box payment_method_bank">
                  <p>Bitte zahle den Kursbeitrag vorab per Banküberweisung auf das in der Buchungsbestätigung angegebene Bankkonto.</p>
                </div>
              </li>
              <li class="pay_cod">
                <label for="payment_method_cod">
                  <input id="payment_method_cod"  data-target="payment_method_cod" type="radio" class="payment_method" name="payment_method" value="Barzahlung"> <span> Barzahlung </span>
                </label>
                <div class="payment_box payment_method_cod" style="display: none;">
                 <p>Bitte zahle den Kursbeitrag in BAR vor Ort bei Kursbeginn.</p>
                </div>
              </li> 
            </ul>
            <div class="payment-privacy-policy">
              <p>Deine persönlichen Daten werden zur Bearbeitung deiner Bestellung gemäss unserer<a href="{{url('/datenschutz')}}" class="policy-link" target="_blank">Datenschutzerklärung</a> verwendet.</p>
              <p>
              <div class="form-group">
                <label class="terms-check">  
                  <input type="checkbox" name="terms" value="1" id="terms" required="">
                  <span class="checkbox-text">Ich habe die <a href="{{url('/agb')}}" class="terms-link" target="_blank">Geschäftsbedingungen</a> gelesen und stimme ihnen zu.</span>&nbsp;<span class="required">*</span> 
                </label>
                <span class="errmsg">Dies ist ein Pflichtfeld</span>
              </div>
              </p>
            </div> 
            <button type="submit" class="button btn-submit place_order" name="place_order" id="place_order" value="Bestellung abschicken">Bestellung abschicken</button>
          </form>
        </div> 
      </div>
    </section> 
  </div>
</div>
@endsection 
@push('style') 
  <style> 
    .icon-circle{
        display: inline-block;
        width: 25px;
        height: 25px;
        text-align: center;
        line-height: 20px;
        border-radius: 50%;
        font-size: 14px;
        border: 1px solid #ddd;
        margin-right: 10px;
    }
    .login-info{
        display: block;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 10px 0;
        margin-bottom: 15px;
    }
    .reglogin{ 
        margin-bottom: 50px;
        padding: 30px;
        background-color: #f2f2f2;
        border-radius: 5px; 
    }
    .form-row{
        display: block;
        text-align: right;
    }
    .reglogin label.flebel{
        display: block;
        font-size: 14px;
        margin-bottom: 0;
        margin-top: 10px;
    }
    .finput,.finput:focus,.finput:active{
      border-radius: 5px;
      border: 1px solid #ddd;
      min-width: 40%;
      padding: 5px 15px;
      outline: none;
      line-height: 1.6;
      font-size: 16px;
    }
    .lost_password{
      color: #9d0038;
      font-size: 14px;
      border-bottom: 1px dotted #9d0038;
    }
    .remember{
        margin-left: 5px;
        font-size: 13px;
    }
    .remember input{
      margin-right: 4px;
    }
    .btn-submit{
      border-radius: 5px;
      background: #9d0038;
      color: #fff;
      padding: 5px 15px;
      border: none;
      font-size: 14px;
      margin-left: 10px;
      line-height: 1.6;
    }
    .coupon-area{
      margin-bottom: 30px; 
    }
    .coupon-area h3{
      font-size: 24px;
      color: #555555;
      border-bottom: none;
      margin-bottom: 20px;
      font-family: NeoTech, Arial, Helvetica, sans-serif;
    }

    .billing-area{
      display: block;
      margin-bottom: 30px; 
    }
    .radio-label{
      display: inline-block;
      margin-right: 15px;
      cursor: pointer;
    }
    .form-label{
      display: block;
      margin-bottom: 0;
    }
    .form-control{
      background: #f1f1f1;
      border-radius:5px;
      margin-bottom: 15px;
      padding: 7px 15px;
      line-height: 1.6;
    }
    .paar-area{
      display: block;
      margin-top: 30px;
    }
    .paar-area h2{
      font-size: 28px;
      margin-bottom: 20px
    }
    .naccount-wrap{
      margin-top: 30px;
    }
    .naccount-wrap h2{
      font-size: 24px;
    }
    .naccount-content{
      margin-bottom: 50px;
      padding:20px 30px;
      background-color: #f2f2f2;
      border-radius: 5px; 
      display: none;
    } 
    .naccount-content .form-control{
      background: #fff;
    }
    .worning{
      color: #f00;
    }
    .deine-bestellung{
      display: block;
      margin-top: 50px;
    }
    .order-table{
      width: 100%;
    }
    .order-table .product-name {
      width: 70%;
      font-size: 14px;
      border-bottom: 1px solid #ddd;
      vertical-align: middle;
    }
    .order-table .product-total {
      width: 30%;
      text-align: right;
      font-size: 14px;
      border-bottom: 1px solid #ddd;
      vertical-align: middle;
    }
    .order-table .cart-subtotal th,
    .order-table .order-total th{
      text-align: right;
      padding: 10px;
      font-size: 16px;
      font-weight: 600;
    }
    .order-table .cart-subtotal td,
    .order-table .order-total td{
      text-align: right;
      padding: 10px; 
      font-size: 16px;
    }
    .order-table .order-total td strong{
      color: #9d0038;
    }
    .checkout-payment {
      background-color: #ffffff;
      border-radius: 5px;
      border: none;
      -webkit-box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
      -moz-box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
      box-shadow: 0px 0px 25px 0px rgba(0,0,0,0.1);
      padding: 30px;
      margin-top: 50px;
      margin-bottom: 30px;
      overflow: hidden;
    }
    .payment_methods{
      display: block;
      list-style: none;
    }
    .payment_box{
      background-color: #f6f3f3;
      clear: both;
      padding: 20px;
      margin-bottom: 10px; 
    }
    .payment_box p{
      margin: 0;
    }
    .payment-privacy-policy{
      display: block;
      margin:20px 0 10px 0;
    }
    .place_order{
      float: right;
    }
    .has-error label{
      color: #f00
    }
    .has-error .form-control{
      border-color: #fbd7d7;
      background: #fff2f2;
    }
    .has-error .checkbox-text{
      color: #f00
    }
    .errmsg{
      display: none;
      color: #f00;
      font-size: 90%;
    }
    .has-error .errmsg{
      display: block;
    }
    .with-errors{
      margin-top: -15px;
      font-size: 12px;
      color: #f00;
    }
  </style>
@endpush
@push('scripts') 
 @if(!auth()->check())
  <script>
    $(document).ready(function(){
      $('#loginForm').validator();
    })
  </script>
  @endif

<script> 
    $(document).ready(function(){
      $('#billingFor').validator();

      $("#showlogin").click(function(e){
        e.preventDefault(); 
        $("#loginPanel").slideToggle("slow");
      });

      $('#createaccount').change(function(e){ 
        if ($(this).is(':checked')) {
          $("#nacontent").slideDown("slow");
        }else{
          $("#nacontent").slideUp("slow");
        } 
        return false;
      });

      $('.datepicker').datepicker({
        format: 'dd.mm.yyyy', 
        autoclose:true
      }); 
    });

    $('.payment_method').change(function(e) { 
      if ($(this).data('target') == 'payment_method_bank') {
        $('.payment_method_cod').hide();
        $('.payment_method_bank').show();
      }else{
        $('.payment_method_bank').hide();
        $('.payment_method_cod').show();
      }  
    })
 

  $('#jetzt').click(function(e) { 
    if ($('#ticketOptions').val() =='') {
      swalError('Bitte wählen Sie eine Auswahl der Teilnehmer');
    }else if ($('#ticketPrice').val() =='') {
      swalError('Bitte wählen Sie eine Auswahl der Teilnehmer');
    }else{
      $('#kasseForm').submit();
    }
  })

</script>
@endpush