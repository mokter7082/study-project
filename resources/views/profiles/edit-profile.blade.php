@extends('layouts.app') 

{{-- Main content aection --}}
@section('content') 
<section class="dashboard-section">
    <div class="container">
         <div class="row">
             <div class="col-sm-4 col-lg-3">
                @include('includes.frontend.leftbar')
             </div>
             <div class="col-sm-8 col-lg-9">
                <div class="page-title">Konto-Details</div>  
                <div class="page-content mb30">
                    <form action="{{route('customers.konto-update', $user->id??'')}}" class="reglogin" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4"> 
                                <div class="form-group {{ $errors->has('anrede') ? 'has-danger':'' }}"> 
                                    {!! Form::label('anrede', 'Anrede') !!}
                                    {!! Form::text('anrede',  $user->anrede??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'anrede')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('anrede') }}</div>
                                </div> 
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('first_name') ? 'has-danger':'' }}"> 
                                    {!! Form::label('first_name', 'Vorname') !!}
                                    {!! Form::text('first_name',  $user->first_name??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'first_name')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('first_name') }}</div>
                                </div>  
                            </div>
                            <div class="col-md-4">
                                <div class="form-group {{ $errors->has('last_name') ? 'has-danger':'' }}"> 
                                    {!! Form::label('last_name', 'Nachname') !!}
                                    {!! Form::text('last_name',  $user->last_name??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'last_name')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('last_name') }}</div>
                                </div>  
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('address') ? 'has-danger':'' }}"> 
                                    {!! Form::label('address', 'Strasse') !!}
                                    {!! Form::text('address',  $user->address??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'address')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('address') }}</div>
                                </div>   
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('postcode') ? 'has-danger':'' }}"> 
                                    {!! Form::label('postcode', 'Postleitzahl') !!}
                                    {!! Form::text('postcode',  $user->postcode??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'postcode')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('postcode') }}</div>
                                </div> 
                            </div>
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('city') ? 'has-danger':'' }}"> 
                                    {!! Form::label('city', 'Ort / Stadt ') !!}
                                    {!! Form::text('city',  $user->city??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'city')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('city') }}</div>
                                </div>  
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-danger':'' }}"> 
                                    {!! Form::label('email', 'E-Mail-Adresse') !!}
                                    {!! Form::text('email',  $user->email??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'email')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                </div>   
                            </div> 
                        </div>
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('phone') ? 'has-danger':'' }}"> 
                                    {!! Form::label('phone', 'Mobil') !!}
                                    {!! Form::text('phone',  $user->phone??null, array('class' => 'form-control m-input', 'required'=>true, 'readonly'=>true, 'id'=>'phone')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('phone') }}</div>
                                </div>    
                            </div>
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('date_of_birth') ? 'has-danger':'' }}"> 
                                    {!! Form::label('date_of_birth', 'Geburstdatum') !!}
                                    {!! Form::text('date_of_birth', !empty($user->date_of_birth)? date('d.m.Y', strtotime( $user->date_of_birth)):null, array('class' => 'form-control m-input datepicker', 'required'=>true, 'readonly'=>true, 'id'=>'date_of_birth')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('date_of_birth') }}</div>
                                </div> 
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <button type="button" class="btn btn-primary" id="edit"><i class="fa fa-edit"></i> Edit Info</button>

                                <button type="submit" class="btn btn-success no-display" id="submit"><i class="fa fa-check"></i> Submit </button>

                                <button type="button" class="btn btn-danger no-display" id="cancle"> <i class="fa fa-times"></i> Cancle</button>
                            </div>
                        </div>
                    </form>
                </div> 
             </div>
         </div> 
    </div>        
</section>
@endsection
{{-- End main content section --}}
@push('style')
<style>
    .no-display{
        display: none; 
    }
    input[readonly]{
        pointer-events: none;
    }
</style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function(){ 
          $('.datepicker').datepicker({
            format: 'dd.mm.yyyy', 
            autoclose:true
          }); 
 
          $('#edit').click(function() {
            $('.form-control').removeAttr('readonly');
            $(this).hide();
            $('#cancle').show();
            $('#submit').show();
          })

          $('#cancle').click(function() {
            location.reload();
          })
        });
    </script>
@endpush


