@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="main-content-area whtrnbg">
    <div class="container">
       <section class="container-area mt-50">
          <div class="row">
             <div class="col-lg-7 col-md-7"> 
                <div class="contact-one__form__wrap">
                    <h3 class="title-text2">{{$course->title??''}}</h3>
                    <P>{{!empty($course->single_price)? number_format($course->single_price,2). ' CHF':'' }}  - {{!empty($course->pair_price)? number_format($course->pair_price,2). ' CHF':'' }}</P> 
                    <div class="cinfo">
                        <h4 class="title-text4">Kursdaten:</h4>
                        <p>{{ !empty($course->available_date)? date('d.m', strtotime($course->available_date)):'' }} - {{ !empty($course->close_date)? date('d.m.Y', strtotime($course->close_date)):'' }} ({{count($course->schedules)}}x{{$course->clss_duration}} min)</p>
                    </div> 
                    @if(isset($course->location->title) && $course->location->title !='')
                    <div class="cinfo">
                        <h4 class="title-text4">Kursort:</h4>
                        <h5 class="title-text5">{{$course->location->title??''}}</h5>
                        {!! $course->location->description ?? '' !!}
                    </div>
                    @endif

                    <div class="cinfo">
                        <h4 class="title-text4">Kursleitung:</h4>
                        <p>  
                            {!! objString($course->instructors, 'name', '</br>') !!}
                        </p>
                    </div>

                    <div class="cinfo">
                        <h4 class="title-text4">Kursinfo:</h4>
                       {!!$course->description??"" !!}
                    </div> 
                </div> 
             </div> 
             <div class="col-lg-5 col-md-5">
                <div class="right-bar">
                  <div class="widget-area">
                      <form action="{{route('kasse.process')}}" method="POST" id="kasseForm">
                        @csrf
                        <input type="hidden" name="course_id" value="{{$course->id}}">
                        <div class="row">
                          <div class="col-lg-5 col-md-6"><h4 class="auswh">Auswahl Teilnehmer</h4></div>
                          <div class="col-lg-7 col-md-6"> 
                            <select id="ticketOptions" 
                              class="form-control" 
                              name="ticket_type" 
                              data-einzelperson="{{$course->single_price??0}}"
                              data-paar="{{$course->pair_price??0}}"
                            >
                              <option value="">Wähle eine Option</option>
                              <option value="einzelperson">Einzelperson</option>
                              @if(isset($course->pair_price) && $course->pair_price > 0)
                              <option value="paar">Paar</option>
                              @endif
                            </select>  
                          </div>
                        </div>
                        <div class="hide" id="priceArea">
                          <div class="row">
                            <div class="col-sm-5 offset-sm-2 text-right">
                              <span class="priceAmount"></span>
                              <input id="ticketPrice" name="price" type="hidden" class="price-input" value="" required="">
                            </div>
                            <div class="col-sm-5 text-right">
                              <button type="button" class="rmprice">Auswahl entfernen</button>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 mt-50">
                              <button class="btn btn-primary fullwidth" type="button" id="jetzt">JETZT ZUM KURS ANMELDEN</button>
                           </div>
                        </div>
                      </form>
                   </div> 
                </div>
             </div>
            
          </div>
       </section>

    </div>
 </div>
@endsection 
@push('style') 
  <style> 
    #priceArea{
      margin-top: 30px;
    }
    .rmprice{
      border: none;
      padding: 0;
      background: none;
      color: #9d0038;
      font-size: 13px;
    }
    .priceAmount{
      color: #9d0038; 
    } 
    .hide{
      display: none;
    }
  </style>
@endpush
@push('scripts') 
<script> 
  $('#ticketOptions').change(function(e) { 
    var ticket_type = $(this).val();
    if (ticket_type !='') {
      var price =  $(this).data(ticket_type); 
      $('.priceAmount').html(price + ' CHF');
      $('#ticketPrice').val(price);
      $('#priceArea').show();
    }else{
      $('#priceArea').hide();
    }    
  })

  $('.rmprice').click(function(e) {
    e.preventDefault();
    $('#priceArea').hide();
    $('.priceAmount').html('');
    $('#ticketOptions').val('');
    $('#ticketPrice').val(''); 
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