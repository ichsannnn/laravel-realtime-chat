@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row auth row-main">
      <div class="col s12 m12 l12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">{{ __('Register') }}</span>
            <div class="row margin-bottom">
              <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}" class="col s12">
                @csrf
                <div class="row margin-bottom">
                  <div class="input-field col s12 m12 l12">
                    <input id="name" type="text" class="validate{{ $errors->has('name') ? ' invalid' : '' }}" name="name" value="{{ old('name') }}" required>
                    @if ($errors->has('name'))
                      <span class="red-text" role="alert">
                        <strong>{{ $errors->first('name') }}</strong>
                      </span>
                    @endif
                    <label for="name">{{ __('Name') }}</label>
                  </div>
                </div>
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
                <div class="row margin-bottom">
                  <div class="input-field col s12 m12 l12">
                    <input id="password-confirm" type="password" class="validate" name="password_confirmation" required>
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                  </div>
                </div>
                <div class="row margin-bottom">
                  <div class="col s12 m12 l12">
                    <button type="submit" class="btn btn-full light-blue lighten-1">
                      {{ __('Register') }}
                    </button>
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
