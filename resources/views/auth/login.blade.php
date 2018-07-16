@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row auth row-main">
      <div class="col s12 m12 l12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">{{ __('Login') }}</span>
            <div class="row margin-bottom">
              <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}" class="col s12">
                @csrf
                <div class="row margin-bottom">
                  <div class="input-field col s12 m12 l12">
                    <input id="email" type="email" class="validate{{ $errors->has('email') ? ' invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                    @if ($errors->has('email'))
                      <span class="red-text" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                      </span>
                    @endif
                    <label for="email">{{ __('E-Mail Address') }}</label>
                  </div>
                </div>
                <div class="row margin-bottom">
                  <div class="input-field col s12 m12 l12">
                    <input id="password" type="password" class="validate{{ $errors->has('password') ? ' invalid' : '' }}" name="password" required>
                    @if ($errors->has('password'))
                      <span class="red-text" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                      </span>
                    @endif
                    <label for="password">{{ __('Password') }}</label>
                  </div>
                </div>
                <input type="hidden" name="remember" value="1">
                <div class="row">
                  <div class="col s12 m12 l12">
                    <button type="submit" class="btn btn-full light-blue lighten-1">
                      {{ __('Login') }}
                    </button>
                  </div>
                </div>
                <div class="row margin-bottom">
                  <div class="col s12 m12 l12">
                    <a class="waves-effect waves-grey btn-full btn-flat center" href="{{ route('password.request') }}">
                      {{ __('Forgot Password') }}
                    </a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
