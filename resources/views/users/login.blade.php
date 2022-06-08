@extends('layouts.app')

{{-- Main content aection --}}
@section('content')
	<div class="login-section">
		<div class="container">
			<div class="login-grid" id="m_login"> 
	        	<div class="login__container">
		            <div class="m-login__logo">
		            	<h2>User Login</h2> 
						@if (\Session::has('error')) 
						<p class="login-error">
							{!! \Session::get('error') !!}
						</p> 
						@endif
		            </div>  
		            <div class="m-login__signin"> 
		               {!! Form::open(array('route' => 'login','method'=>'POST')) !!}
		                <div class="form-group">
		                	<input class="form-control m-input {{ $errors->has('email') ? ' is-invalid' : '' }}" type="text" placeholder="Email" name="email" autocomplete="off"> 
		                	@if ($errors->has('email'))
		                        <span class="invalid-feedback">
		                            <strong>{{ $errors->first('email') }}</strong>
		                        </span>
		                    @endif
		                </div> 
		                <div class="form-group">
		                	<input class="form-control m-input m-login__form-input--last {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" placeholder="Password" name="password">
		                	@if ($errors->has('password'))
		                        <span class="invalid-feedback">
		                        	<strong>{{ $errors->first('password') }}</strong>
		                        </span>
		                    @endif   
		                </div>
		                <div class="row login__form-sub">
		                	<div class="col text-left login__form-left">
		                    	<label class="m-checkbox">
		                    		<input type="checkbox" name="remember"> Remember me 
		                    	</label>
		                  	</div>
		                	<div class="col login__form-right">
		                		<a href="{{route('password.request')}}"  class="m-link">Forget Password ?</a>  
		                  </div>
		                </div>
		                <div class="login__form-action text-center">
		                  <button type="submit"  class="btn btn--primary">Sign In</button>
		                  <a href="{{route('customers-register')}}" id="register_customer" class="btn--secondary">Register Free</a> 
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
	</style>
@endpush 

@push('scripts')
	<script>
		$('.user_type').click(function(e) { 
			if($(this).val() == 'Private'){
				$('#company_row').hide();
				$('#company, #vat_number').removeAttr('required');
			}else{
				$('#company_row').show();
				$('#company, #vat_number').attr('required',true);
			}
		})
	</script>
@endpush 