@extends('layouts.app')

{{-- Main content aection --}}
@section('content')
	<div class="login-section">
		<div class="container lrcontainer">
			<div class="row">
				<div class="col-sm-6 border-right">
					<div class="login-area">
						<h2>Account Verification</h2>
						<p>Please input verification code for active your account.</p>
						 {!! Form::open(array('route' => 'verify-account','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right reg-form', 'files' => false)) !!} 
						  	<div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}"> 
					                    <label for="email"> Email <span class="required">*</span></label>
					                    {!! Form::email('email', $email??'', ['class'=>'form-control m-input m-input--square', 'id'=>'email', 'required'=>true, 'readonly'=>true, 'autocomplete'=>'off']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
					                </div> 
			                    </div> 
			                </div> 
			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('varification_code') ? 'has-danger' : '' }}">  
			                    	  <label for="varification_code">Code <span class="required">*</span></label>            
					                    {!! Form::text('varification_code',  old('varification_code'), ['class'=>'form-control m-input m-input--square', 'id'=>'varification_code', 'autocomplete'=>'off']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('varification_code') }}</div>
					                </div>  
			                    </div>
			                </div> 
			                <div class="login-footer" style="padding-top: 15px;">
					            <button type="submit" class="btn login-btn"> <strong>Verify Now</strong> <i class="fa fa-angle-right"></i></button> 
					        </div>  
	   					{!! Form::close() !!}
					</div>
				</div>
				<div class="col-sm-6">
					<div class="reg-info-area">
						<h2>Don't have an account yet</h2>
						<p>As member of Tuningfileservice24.com you can:</p>
						<ul class="reglist">
							<li><span class="check"><i class="fa fa-check-square-o"></i> </span> Buy credits using iDEAL, Mister Cash or PayPal</li>
							<li><span class="check"><i class="fa fa-check-square-o"></i> </span> Upload tuningfiles and receive the modified files in return</li>
							<li><span class="check"><i class="fa fa-check-square-o"></i> </span> Modified files are of high quality, safe and Dyno-tested</li>
							<li><span class="check"><i class="fa fa-check-square-o"></i> </span> Every tuning file is custom made to fit your car, with the best perfomance results</li> 
						</ul> 
					</div>
				</div>
			</div>
		</div> 
	</div>

@endsection
{{-- End main content section --}}

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
		$('#evc_acc').change(function() {
			if ($(this).val() =='Yes') { $('#evc-rw').show(); } else{ $('#evc-rw').hide(); $('#wols_client_no').val(''); }
		})
	</script>
@endpush


