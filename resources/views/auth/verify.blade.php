<!DOCTYPE html>
<html>
  <head>
    <title>Sign up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
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
            <h2>Verify</h2>
            <p class="set">It's quick and easy</p>
            @if (session('error'))
             <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                          <strong>{{ session('error') }}</strong>
                  </div>
            @endif
             @if (session('errorm'))
            <div class="alert alert-danger" role="alert">
                {{session('errorm')}}
            </div>
            @endif
             Please enter the OTP sent to your number: {{session('phone_no')}}
             @error('phone_number')
             <span class="invalid-feedback" role="alert">
                 <strong>{{ $message }}</strong>
             </span>
             @enderror
            <hr>
            <form action="{{route('verifystore')}}" method="post">
                @csrf
                <div class="form-group row">
                    <label for="verification_code"
                        class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>
                    <div class="col-md-6">
                        <input type="hidden" name="phone_number" value="{{session('phone_no')}}">
                        <input id="verification_code" type="tel"
                            class="form-control @error('verification_code') is-invalid @enderror form-control-lg myinputbox"
                            name="verification_code" value="{{ old('verification_code') }}" >
                        @error('verification_code')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Verify Phone Number') }}
                        </button>
                    </div>
                </div>
            </form>
            {{-- resendcode form --}}
            <form action="{{ route('resendcode') }}" method="post">
              @csrf
               <div class="form-group row mt-5">
                    <div class="col-md-6 offset-md-4">
                       <input type="hidden" name="phone_number" value="{{session('phone_no')}}">
                      <div class="col-md-6 ">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Resend Code') }}
                        </button>
                    </div>
                    </div>
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