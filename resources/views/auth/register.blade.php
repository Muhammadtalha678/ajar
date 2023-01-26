{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
 --}}
 <!DOCTYPE html>
<html>
  <head>
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="/signupstyle.css">
  </head>
  <body>
    <div class="container">
      <br><br>
      <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
          <div class="card bg-Light container-fluid setsignup" >
            <h2>Sign up</h2>
            <p class="set">It's quick and easy</p>
            <hr>
            @if (session('registraionError'))
           <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ session('registraionError') }}</strong>
            </div>  
            @endif

            @if (session('errorm'))
            <div class="alert alert-danger alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ session('errorm') }}</strong>
            </div>  
            @endif

             @error('password')
                  <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                  </div>  
             @enderror

             @error('name')
                  <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                  </div>  
             @enderror

             @error('email')
                  <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ $message }}</strong>
                  </div>  
             @enderror
            <form method="POST" action="{{ route('register') }}" class="row g-2">
              @csrf
              <div class="form-group">
                <div class="col-auto mt-3">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror form-control-lg myinputbox" name="name" value="{{ old('name') }}"  autocomplete="name" autofocus placeholder=" Name">
                  {{-- @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>
              <div class="form-group">
                <div class="col-auto mt-3">
                <input type="text" class="form-control @error('email') is-invalid @enderror form-control-lg myinputbox" name="email" value="{{ old('email') }}"  placeholder="Email Or Phone Number">
              {{--   @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror --}}
              </div>
              </div>
              <div class="form-group">
                <div class="col-auto mt-3">
                  <input id="password" type="password" class="form-control form-control-lg myinputbox @error('password') is-invalid @enderror" name="password"  autocomplete="new-password" placeholder="Password">
                 {{--  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror --}}
                </div>
              </div>
              <div class="form-group">
                <div class="col-auto mt-3">
                  <input id="password-confirm" type="password" class="form-control form-control-lg myinputbox" name="password_confirmation"  autocomplete="new-password" placeholder="Confirm Password">
                </div>
              </div>
              <div class="form-group">
                <div class="col-auto mt-3">
                  <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }} 
                </a>
                OR
                  {{-- <a href="{{ route('otp.index') }}">Register with phone no?</a> --}}
                </div>
              </div>
              <br>
              <br>
              <p class="set">By clicking sign up. You agree to our Teams Policy and Cookies Policy.You may receive SMS notification from us and can opt out at any time</p>
              <br>
              <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-success" type="submit">Sign Up</button>
              </div>
            </form>
          </div>
          <div class="col-sm-3"></div>
        </div>
      </div>
    </div>
  </body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>