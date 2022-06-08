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
                <div class="page-title">Kennwort ändern</div>  
                <div class="page-content mb30">
                    <form action="{{route('customers.update-pass')}}" class="reglogin" method="post">
                        @csrf 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('email') ? 'has-danger':'' }}"> 
                                    {!! Form::label('email', 'Your Email') !!}
                                    {!! Form::text('email',  null, array('class' => 'form-control m-input', 'required'=>true,  'id'=>'email')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
                                </div>   
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('old_pass') ? 'has-danger':'' }}"> 
                                    {!! Form::label('old_pass', 'Old Password') !!}
                                    {!! Form::text('old_pass',  null, array('class' => 'form-control m-input', 'required'=>true,  'id'=>'old_pass')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('old_pass') }}</div>
                                </div>   
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group {{ $errors->has('new_pass') ? 'has-danger':'' }}"> 
                                    {!! Form::label('new_pass', 'New Password') !!}
                                    {!! Form::text('new_pass',  null, array('class' => 'form-control m-input', 'required'=>true, 'id'=>'new_pass')) !!} 
                                    <div class="form-control-feedback">{{ $errors->first('new_pass') }}</div>
                                </div>   
                            </div> 
                        </div> 
                        <div class="row">
                            <div class="col-md-12"> 
                                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Change Now</button>   
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
@endpush

@push('scripts')
    <script>
         $(document).ready(function(){  

          $('#cancle').click(function() {
            location.reload();
          })
        });
    </script>
@endpush


