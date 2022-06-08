@extends('layouts.app')

{{-- Main content aection --}}
@section('content')
	<div class="login-section">
		<div class="container lrcontainer">
			<div class="row">
				<div class="col-sm-6 border-right">
					<div class="login-area">
						<h2>Register</h2>
						<p>Use the form below to register for an account.</p>
{{-- @if($errors->any())
    {!! implode('', $errors->all('<div>:message</div>')) !!}
@endif --}}
						 {!! Form::open(array('route' => 'customers-register','method'=>'POST','class'=>'m-form m-form--fit m-form--label-align-right reg-form', 'files' => false)) !!}
							<div class="row">
			                    <div class="col-md-12">
			                        <div class="form-group"> 
			                            <label for="pvt">
			                            	<input class="user_type" type="radio"
			                            	@if(old('user_type') !='')
												@if(old('user_type') == 'Private') checked="" @endif
			                            	@else checked="" @endif 
			                            	name="user_type" value="Private" id="pvt"><span> Private </span>
			                            </label>
			                            <label for="cmp">
			                            	<input class="user_type" type="radio" name="user_type" value="Cmpany" @if(old('user_type') == 'Cmpany') checked="" @endif  id="cmp"> <span> Cmpany</span>
			                            </label>
			                       </div>
			                    </div> 
			                </div> 
			                <div class="no-display" id="company_row" @if(old('user_type') == 'Cmpany') style="display:block;" @endif >
			                	<div class="row">	                   
				                    <div class="col-md-7">
				                        <div class="form-group {{ $errors->has('company') ? 'has-danger' : '' }}">
						                    {!! Form::label('company', 'Company') !!}                    
						                    {!! Form::text('company',  old('company'), ['class'=>'form-control m-input m-input--square', 'id'=>'company']) !!}
						                    <div class="form-control-feedback">{{ $errors->first('company') }}</div>
						                </div>
				                    </div>
				                    <div class="col-md-5">
				                    	<div class="form-group {{ $errors->has('vat_number') ? 'has-danger' : '' }}">
						                    {!! Form::label('vat_number', 'Vat Number') !!}                    
						                    {!! Form::text('vat_number',  old('vat_number'), ['class'=>'form-control m-input m-input--square', 'id'=>'vat_number']) !!}
						                    <div class="form-control-feedback">{{ $errors->first('vat_number') }}</div>
						                </div>  
				                    </div>
				                </div>
			                </div> 

			                <div class="row">
			                	<div class="col-sm-4">
			                		<div class="form-group m-form__group {{ $errors->has('salute') ? ' is-invalid' : '' }}">
										<label for="salute">Title</label> <span class="required">*</span>
										{!! Form::select('salute', ['Mr.'=>'Mr.', 'Mrs.'=>'Mrs.'],  old('salute'), array('placeholder' => 'Choose', 'class' => 'form-control m-input','required'=>true, 'id'=>'salute')) !!}  
										@if ($errors->has('salute'))
					                        <span class="invalid-feedback">
					                            <strong>{{ $errors->first('salute') }}</strong>
					                        </span>
					                    @endif 
					                </div>
			                	</div>
			                </div>
			                <div class="row">
			                	<div class="col-md-6">
			                    	<div class="form-group {{ $errors->has('fname') ? 'has-danger' : '' }}">
					                    {!! Form::label('fname', 'First Name') !!} <span class="required">*</span>                    
					                    {!! Form::text('fname',  old('fname'), ['class'=>'form-control m-input m-input--square', 'id'=>'fname', 'required'=>true]) !!}
					                    <div class="form-control-feedback">{{ $errors->first('fname') }}</div>
					                </div> 
			                    </div>
			                    <div class="col-md-6">
			                    	<div class="form-group {{ $errors->has('lname') ? 'has-danger' : '' }}">
					                    {!! Form::label('lname', 'Last Name') !!}                    
					                    {!! Form::text('lname',  old('lname'), ['class'=>'form-control m-input m-input--square', 'id'=>'lname']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('lname') }}</div>
					                </div> 
			                    </div>
			                </div>

			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('address') ? 'has-danger' : '' }}">
					                    {!! Form::label('address', 'Address / PO Box') !!} <span class="required">*</span>               
					                    {!! Form::text('address',  old('address'), ['class'=>'form-control m-input m-input--square', 'id'=>'address', 'autocomplete'=>'off']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('address') }}</div>
					                </div>  
			                    </div>
			                </div>
			           		<div class="row">
			                    <div class="col-md-4 col-sm-6">
			                        <div class="form-group {{ $errors->has('zip') ? 'has-danger' : '' }}">
					                    {!! Form::label('zip', 'Zipcode') !!}  <span class="required">*</span>                  
					                    {!! Form::text('zip',  old('zip'), ['class'=>'form-control m-input m-input--square', 'id'=>'zip']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('zip') }}</div>
					                </div> 
			                    </div>
			                    <div class="col-md-8 col-sm-6">
			                        <div class="form-group {{ $errors->has('city') ? 'has-danger' : '' }}">
					                    {!! Form::label('city', 'City') !!} <span class="required">*</span>                 
					                    {!! Form::text('city',  old('city'), ['class'=>'form-control m-input m-input--square', 'id'=>'city']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('city') }}</div>
					                </div> 
			                    </div>
			                </div>

			                <div class="row">
			                    <div class="col-sm-12">
			                        <div class="form-group {{ $errors->has('country') ? 'has-danger' : '' }}">
					                    {!! Form::label('country', 'Country') !!} <span class="required">*</span>
					                    {!! Form::select('country',  $countries??[], old('country'), ['class'=>'form-control m-input m-input--square', 'id'=>'country']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('country') }}</div>
					                </div> 
			                    </div> 
			                </div>

			                <div class="row">
			                    <div class="col-md-6">
			                    	<div class="form-group {{ $errors->has('phone1') ? 'has-danger' : '' }}">
					                    {!! Form::label('phone1', 'Phone 1') !!} <span class="required">*</span>                   
					                    {!! Form::text('phone1',  old('phone1'), ['class'=>'form-control m-input m-input--square', 'id'=>'phone1']) !!}
					                     <small  class="form-text text-muted">including country code, eg +4312341234567.</small>
					                    <div class="form-control-feedback">{{ $errors->first('phone1') }}</div>
					                </div>
			                    </div> 
			                    <div class="col-md-6">
			                    	<div class="form-group {{ $errors->has('phone2') ? 'has-danger' : '' }}">
					                    {!! Form::label('phone2', 'Phone 2') !!}                    
					                    {!! Form::text('phone2',  old('phone2'), ['class'=>'form-control m-input m-input--square', 'id'=>'phone2']) !!}
					                     <small  class="form-text text-muted">including country code, eg +4312341234567.</small>
					                    <div class="form-control-feedback">{{ $errors->first('phone2') }}</div>
					                </div> 
			                    </div> 
			                </div>

			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('landline') ? 'has-danger' : '' }}">
					                    {!! Form::label('landline', 'Landline ') !!}   
					                    {!! Form::text('landline',  old('landline'), ['class'=>'form-control m-input m-input--square', 'id'=>'landline']) !!}
					                     <small  class="form-text text-muted">including country code, eg +4312341234567</small>
					                    <div class="form-control-feedback">{{ $errors->first('landline') }}</div>
					                </div> 
			                    </div>  
			                </div><hr> 

			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('email') ? 'has-danger' : '' }}"> 
					                    <label for="email"> Email <span class="required">*</span></label>
					                    {!! Form::email('email',  old('email'), ['class'=>'form-control m-input m-input--square', 'id'=>'email', 'required'=>true, 'autocomplete'=>'off']) !!}
					                    <div class="form-control-feedback">{{ $errors->first('email') }}</div>
					                </div> 
			                    </div> 
			                </div>

			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}"> 
					                    <label for="password"> Password <span class="required">*</span></label>
					                    <input class="form-control m-input m-input--square" id="password" type="password" required="" autocomplete="off" name="password"> 
					                    <div class="form-control-feedback">{{ $errors->first('password') }}</div>
					                </div> 
			                    </div> 
			                </div>
			                
			                <div class="row">
			                    <div class="col-md-12">
			                    	<div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}"> 
					                    <label for="password_confirmation">Repeat password <span class="required">*</span></label>
					                    <input class="form-control m-input m-input--square" id="password_confirmation" type="password" required="" autocomplete="off" name="password_confirmation"> 
					                    <div class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div>
					                </div> 
			                    </div> 
			                </div>
			                <hr> 
 
 							<div class="row">
								<div class="col-sm-12">
									<label for="evc_acc">Are you registered at EVC.de</label> 
			                	</div>
			                	<div class="col-md-4 col-sm-5">
			                		<div class="form-group m-form__group"> 
										{!! Form::select('evc_acc', ['No'=>'No', 'Yes'=>'Yes'],  old('evc_acc'), array('class' => 'form-control m-input', 'id'=>'evc_acc')) !!} 
					                </div>
			                	</div>
			                	<div class="col-md-8 col-sm-7 no-display" id="evc-rw">
			                		<div class="form-group m-form__group {{ $errors->has('wols_client_no') ? 'has-danger' : '' }}"> 
										{!! Form::text('wols_client_no', old('wols_client_no'), ['class'=>'form-control m-input m-input--wols_client_no', 'id'=>'wols_client_no', 'autocomplete'=>'off', 'placeholder'=>'WinOLS client no.']) !!}
					                </div>
			                	</div>
			                </div>  <hr> 
 
							<div class="row">
			                    <div class="col-4"><strong>Newsletter</strong></div>
			                    <div class="col-md-6">
			                        <div class="form-group"> 
			                            <label class="swtcher-no" for="newsletter">No</label>
			                            <div class="custom-control custom-switch">
			                              <input type="checkbox" name="newsletter" value="Yes" class="custom-control-input" id="newsletter">
			                              <label class="custom-control-label" for="newsletter">Yes</label>
			                            </div>
			                        </div>
			                    </div>  
			                </div> <hr>

			                <div class="row">
			                    <div class="col-md-12">
			                        <input type="checkbox" name="policy" value="Yes" required="" id="privacy"><label for="privacy"> &nbsp; Privacy policy  <span class="required"> *</span></label>
			                    </div>
			                    <div class="col-md-12"><small>By checking the box, you agree that your personal data (name and e-mail address) will be stored and processed for the purpose of processing the order. This consent can be revoked at any time at office@gpt-consulting.com. Further information can be found in our privacy policy.</small>  
			                    </div>
			                </div> 
 
			                <div class="login-footer" style="padding-top: 15px;">
					            <button type="submit" class="btn login-btn"> <strong>Register</strong> <i class="fa fa-angle-right"></i></button> 
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
		@if(session()->has('success_sweet')) 
			Swal.fire({ 
			  icon: 'success',
			  title: 'Welcome!',
			  text:'We have sent you an e-mail with a verification code. Please follow the link in the e-mail and confirm your registration with the code.', 
			  showConfirmButton: false,
			  timer: 3500
			})
		@endif
      
		$('.user_type').click(function(e) { 
			if($(this).val() == 'Private'){
				$('#company_row').hide();
				$('#company').removeAttr('required');
			}else{
				$('#company_row').show();
				$('#company').attr('required',true);
			}
		})
		$('#evc_acc').change(function() {
			if ($(this).val() =='Yes') { $('#evc-rw').show(); } else{ $('#evc-rw').hide(); $('#wols_client_no').val(''); }
		})
	</script>
@endpush


