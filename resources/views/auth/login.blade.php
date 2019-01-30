<html >
  <head>
    <meta charset="UTF-8">
    <title>COCOO</title>
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}">
  </head>
  <body>
    <div class="wrapper">
        <div class="container">
            <h1>Administracion de Procesos Para Contabilidad COODESCOR</h1>
            <form class="form" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="text" name="email" placeholder="{{ __('E-Mail Address') }}" required autofocus>
                @if ($errors->has('email'))
                    <span class="invalid-feedback col-red" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
                <input type="password" name="password" placeholder="{{ __('Password') }}" required>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
                <div>
                    {{-- <input type="checkbox" class="filled-in chk-col-pink" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="rememberme">{{ __('Remember Me') }}</label> --}}
                    <a href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
                </div>
                <button type="submit" >{{ __('Login') }}</button>
            </form>
        </div>
        
        <ul class="bg-bubbles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    {{-- <script src="{{ asset('login/index.js') }}"></script> --}}
  </body>
</html>