{{-- <x-guest-layout>
<x-auth-card>
<x-slot name="logo">
<a href="/">
    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
</a>
</x-slot>
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
<!-- Validation Errors -->
<x-auth-validation-errors class="mb-4" :errors="$errors" />
<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Email Address -->
    <div>
        <x-label for="email" :value="__('Email')" />
        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
    </div>
    <!-- Password -->
    <div class="mt-4">
        <x-label for="password" :value="__('Password')" />
        <x-input id="password" class="block mt-1 w-full"
        type="password"
        name="password"
        required autocomplete="current-password" />
    </div>
    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>
    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
            {{ __('Forgot your password?') }}
        </a>
        @endif
        <x-button class="ml-3">
        {{ __('Log in') }}
        </x-button>
    </div>
</form>
</x-auth-card>
</x-guest-layout>
--}}
<!DOCTYPE html>
<html>
    <head>
        <title>Ajar Login Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="stylesheet" href="/style1.css">
    </head>
    <body class="bgcolor">
        
        <div class="container">
            <br><br><br><br><br>
            <div class="row">
                <div class="col-sm-1"></div>
                <div class="col-sm-5">
                    <h1 class="changecolor">ajar</h1>
                    <p class="changetext">Place Holder Text</p>
                </div>
                <div class="col-sm-5">
                    <div class="card loginbox container">
                        <form method="POST" action="{{ route('login') }}">
                                   @csrf
                            
                            <div class="mb-3">
                                <input class="form-control form-control-lg myinputbox  @error('email') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Email address or phone number" type="text" name="email" :value="old('email')" required autofocus>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <input class="form-control form-control-lg myinputbox @error('password') is-invalid @enderror" id="exampleFormControlInput1" placeholder="Password " type="password" name="password" required autocomplete="current-password" :value="__('Password')" >
                            </div>
                            <div class="d-grid gap-2">
                                <button class="btn btn-primary mybuttonbox" type="submit">Login</button>
                            </div>
                            
                        </form>
                        <a href="{{ route('password.request') }}"><P class="text-center">Forgotten Password</P></a>
                        <hr>
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <a href="{{ route('register') }}"><button class="btn btn-success mybuttonbox2" type="button">
                            Create New Account</button></a>
                            
                        </div>
                        
                    </div>
                    <br>
                    <p class="text-center">Place Holder Text</p>
                </div>
                
                <div class="col-sm-1"></div>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>