<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- font awesome cdn link -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- local css file  -->
    <link rel="stylesheet" href="/css/landing/signup.css" />
  </head>
  <body>
    <section class="main">
      <nav>
        <img class="nav-logo" src="/images/eping_logo.png" alt="">
      </nav>
      <div class="signup-container">
        <div class="signup-form">
          <div class="logo">
            <img class="nav-logo" src="/images/eping_logo.png" alt="">
          </div>
          <h1><span>ePing!</span> Sign up</h1>
          <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-fields">
                <div class="row1">
                    <input id="first_name" type="text"  name="first_name" value="{{ old('first_name') }}"  autofocus required placeholder="First name">
                    <input id="last_name" type="text"  name="last_name" value="{{ old('last_name') }}"  autofocus required placeholder="Last name">
                    <input id="phonenumber" type="text"  name="phonenumber" value="{{ old('phonenumber') }}"  autofocus required placeholder="Phone Number">
                </div>
                <div class="row2">
                    <input id="address" type="text"  name="address" value="{{ old('address') }}"  autofocus required placeholder="Address">
                </div>
                <div class="row2">
                    <input id="email" type="text"  name="email" value="{{ old('email') }}"  autofocus required placeholder="Email Address">
                </div>
                <div class="row3">
                    <input id="emergency_number1" type="text"  name="emergency_number1" value="{{ old('emergency_number1') }}"  autofocus required placeholder="Emergency Number 1">
                    <input id="emergency_number2" type="text"  name="emergency_number2" value="{{ old('emergency_number2') }}" autofocus required placeholder="Emergency Number 2">

                </div>
                <div class="row4">
                <input id="password" type="password"  name="password" required placeholder="Password">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                </div>
                <div class="error-message">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $error)
                                <span>{{$error}}</span>
                            @endforeach
                        </div>
                    @endif
                </div>
                <div class="submission">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Register') }}    
                    </button>   
                <p>
                    Already have an account?
                    <a href="{{ route('login') }}">Sign in</a>
                </p>
                </div>
          </form>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script src="../js/script.js"></script>
</html>
