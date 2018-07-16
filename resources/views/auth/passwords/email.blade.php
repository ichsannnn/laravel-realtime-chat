@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row auth row-main">
      <div class="col s12 m12 l12">
        <div class="card">
          <div class="card-content">
            <span class="card-title">{{ __('Reset Password') }}</span>
            <div class="row margin-bottom">
              <form method="POST" action="{{ route('password.email') }}" aria-label="{{ __('Reset Password') }}" class="col s12">
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
                    <button type="submit" class="btn btn-full light-blue lighten-1">
                      {{ __('Send Password Reset Link') }}
                    </button>
                  </div>
                </div>
                @if (session('status'))
                  <div class="row margin-bottom">
                    <div class="col s12 m12 l12">
                      <div class="card-panel green white-text z-depth-0" role="alert">
                        {{ session('status') }}
                      </div>
                    </div>
                  </div>
                @endif
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
