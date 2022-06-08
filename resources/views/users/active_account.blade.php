@extends('layouts.app')

{{-- Main content aection --}}
@section('content')
<div class="login-section">
    <div class="login-box">
        @if($errors->any())
            {!! implode('', $errors->all('<div class="alert alert-warning alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong><strong>Sorry! </strong>:message</div>')) !!} 
        @endif 

        {!! Form::open(array('route' => 'activate-account','method'=>'POST','class'=>'login-form')) !!} 
            <div class="login-header"> 
                <h2>Activate account</h2> 
            </div>
            <div class="login-content">
                <div class="form-group text-center"> 
                    <p><strong>Almost there!</strong> <br> 
                    Here you can enter your new password and log in.</p>
                </div>  
                <div class="form-group {{ $errors->has('password') ? 'has-danger' : '' }}">
                    <label for="password"><strong>Password</strong> <span class="req">*</span></label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="****">  
                    <div class="form-control-feedback">{{ $errors->first('password') }}</div>
                </div>
                <div class="form-group {{ $errors->has('password_confirmation') ? 'has-danger' : '' }}"> 
                    <label for="password_confirmation"><strong>Confirm Password</strong> <span class="req">*</span></label>
                     <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="****" value="{{old('password-confirm')}}"> 
                    <div class="form-control-feedback">{{ $errors->first('password_confirmation') }}</div> 
                </div>
            </div>
            <div class="login-footer">
                <button type="submit" class="btn btn-md login-btn">Confirmed</button>
            </div>
        {!! Form::close() !!}
    </div> 
    <div class="back-btn"><a href="{{route('login')}}"><i class="fa fa-arrow-left"></i>Back to Login</a></div>
</div> 
@endsection
{{-- End main content section --}}

@push('scripts')
    <script></script>
@endpush


