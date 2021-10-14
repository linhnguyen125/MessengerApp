@extends('layouts.app')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address')
                                }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password')
                                }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm
                                Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<form class="login100-form validate-form flex-sb flex-w" action="{{route('register')}}" method="POST">
    @csrf
    <span class="login100-form-title p-b-53">
        Sign Up
    </span>
    <div class="p-t-31 p-b-9">
        <span class="txt1">
            Name
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Email is required">
        <input id="name" class="input100" value="{{old('name')}}" type="text" name="name" >
        <span class="focus-input100"></span>
    </div>
    @error('name')
        <strong class="error">{{ $message }}</strong>
    @enderror

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
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100" type="password" name="password" id="password" >
        <span class="focus-input100"></span>
    </div>
    @error('password')
        <strong class="error">{{ $message }}</strong>
    @enderror

    <div class="p-t-13 p-b-9">
        <span class="txt1">
            Confirm Password
        </span>
    </div>
    <div class="wrap-input100 validate-input" data-validate = "Password is required">
        <input class="input100" type="password" name="password_confirmation" id="password_confirmation" >
        <span class="focus-input100"></span>
    </div>

    <div class="container-login100-form-btn m-t-17">
        <button class="login100-form-btn" type="submit">
            Sign Up
        </button>
    </div>

    <div class="w-full text-center p-t-55">
        <span class="txt2">
            Already have an account?
        </span>

        <a href="{{route('login')}}" class="txt2 bo1">
            Sign In
        </a>
    </div>
</form>
@endsection