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
    <link rel="stylesheet" href="/css/landing/login.css" />
  </head>
  <body>
    <div class="container">
      <section class="bg-image">
        {{-- <span class="dot"></span> --}}
        <img class="dot" src="/images/eping_logo.png" alt="">
      </section>
      <section class="login">
        <div class="login-field">
            <form method="POST" action="{{ route('login') }}">
                @csrf
            
                <div class="login-nav">
                    <img class="dot" src="/images/eping_logo.png" alt="">
                </div>
                <h1><span>ePing!</span> Login</h1>
                <div class="input-field">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus required placeholder="Email Address">
                    <br />
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" required placeholder="Password">
                    <div class="forgot">
                    <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                    <div class="error-message">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                        @error('email')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                    </div>
                    <button type="submit">
                                    {{ __('Sign in') }}
                    </button>
                    <p>
                    New to ePing? &nbsp;&nbsp;<a href="{{ route('register') }}"
                        >Create an Account</a
                    >
                    </p>
            </form>
          </div>
        </div>
      </section>
    </div>
  </body>
</html>
