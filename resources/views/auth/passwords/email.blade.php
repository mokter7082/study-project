@extends('layouts.app')

{{-- Main content aection --}}
@section('content')
    <div class="login-section">
        <div class="container"> 
            <div class="login-grid" id="m_login"> 
                <div class="login__container">
                    <div class="m-login__logo">
                        <h2>{{ __('Reset Password') }}</h2>  
                    </div>  
                    <div class="m-login__signin"> 
                        {!! Form::open(array('route' => 'reset-password','method'=>'POST', 'files' => false)) !!}

                        <div class="form-group m-form__group">
                            <label for="user_email" class="form-label">{{ __('E-Mail Address') }} <span class="required">*</span></label>
                            <div class="input-group mb-3 {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                </div>
                                <input class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="Email" name="email"  value="{{ old('email') }}" required autocomplete="email" autofocus>  
                            </div>
                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif 
                        </div> 
                        <div class="login__form-action text-center">
                          <button type="submit" class="btn btn--primary"><strong> {{ __('Send Password Reset Link') }}</strong> <i class="fa fa-angle-right"></i></button> 
                          <a href="{{route("login")}}" id="loginNow" title="Login Now" class="btn--secondary">Login Now</a> 
                        </div> 
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div> 
    </div>
@endsection
{{-- End main content section --}}


@push('style')
    <style>
        body{
            background: #f1f1f1;
        }
        .login-grid{
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 0;
        }
        .login__container{
            padding: 30px; 
            border: 1px solid #ddd; 
            background: #fff;
            width:350px;
        }
        .m-login__logo{
            display: block;
            text-align: center;
        }
        .m-login__logo h2{
            font-size: 20px;
            margin-bottom: 20px;
        }
        .m-checkbox{
            font-size: 13px;
        }
        .login__form-right{
            font-size: 13px;
            text-align: right;
        }
        .btn--primary{
            background: #333;
            color: #fff;
            border-radius: 30px;
            padding: 5px 20px;
        }
        .btn--primary:hover{
            background: #b90042;
            color: #fff;
            border-radius: 30px;
            padding: 5px 20px;
        }
        .btn--secondary{
            text-align: right;
            margin-left: 15px;
            font-size: 14px;
            font-weight: 600;
            color: #b90042
        }
        .m-link{
            color: #222;
        }
        .m-link:hover, .btn--secondary:hover{
            color: #b90042
        }
        .login-error, .m-login__logo .login-error{
            color: #f00;
            font-size: 13px;
            line-height: 1.4;
        }
        .form-label{
            font-size: 13px;
            margin-bottom: 5px;
        }
    </style>
@endpush 

@push('scripts')
 
@endpush 

 