@extends('layouts.app')

@section('content')
<form class="login100-form validate-form flex-sb flex-w" action="{{ route('login') }}" method="POST">
    @csrf
    <span class="login100-form-title p-b-53">
        Sign In With
    </span>

    <a href="{{route('redirect', 'facebook')}}" class="btn-face m-b-20">
        <i class="fa fa-facebook-official"></i>
        Facebook
    </a>

    <a href="{{route('redirect', 'google')}}" class="btn-google m-b-20">
        <img src="{{asset('assets/images/icons/icon-google.png')}}" alt="GOOGLE">
        Google
    </a>
    
    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Email
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Email is required">
        <input id="email" class="input100" value="{{old('email')}}" type="email" name="email" >
        <span class="focus-input100"></span>
    </div>
    @error('email')
        <strong class="error">{{ $message }}</strong>
    @enderror
    

    <div class="p-t-13 p-b-9">
        <span class="txt1">
            Password
        </span>

        <a href="#" class="txt2 bo1 m-l-5">
            Forgot?
        </a>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100" type="password" name="password" id="password" >
        <span class="focus-input100"></span>
    </div>
    @error('password')
        <strong class="error">{{ $message }}</strong>
    @enderror

    <div class="wrap-input100 validate-input" style="margin-top: 15px">
        <input style="display: inline-block; margin-left: 15px;" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

        <label class="form-check-label" style="display: inline-block !important;" for="remember">
            {{ __('Remember Me') }}
        </label>
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn" type="submit">
            Sign In
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Not a member?
        </span>

        <a href="{{route('register')}}" class="txt2 bo1">
            Sign up now
        </a>
    </div>
</form>
@endsection
