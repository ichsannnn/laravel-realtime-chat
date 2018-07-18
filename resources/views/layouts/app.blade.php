<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">
    <link href="{{ asset(mix('css/custom.css')) }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet">
    <script>
      window.Laravel = {!! json_encode(['user' => auth()->user()]) !!}
    </script>
  </head>
  <body class="grey lighten-5">
    <div id="app">
      <nav class="light-blue lighten-1" role="navigation">
        <ul id="dropdown1" class="dropdown-content">
          <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
        </ul>
        <div class="nav-wrapper container">
          <a id="logo-container" href="{{ url('/') }}" class="brand-logo">{{ config('app.name', 'Laravel') }}</a>
          <ul class="right hide-on-med-and-down">
            @guest
              <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
              <li><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
            @else
              <li>
                <a class="dropdown-button" href="#!" data-target="dropdown1">{{ Auth::user()->name }}
                  <i class="material-icons right">arrow_drop_down</i>
                </a>
              </li>
            @endguest
          </ul>

          {{-- <ul id="nav-mobile" class="side-nav">
            <li><a href="#">Navbar Link</a></li>
          </ul>
          <a href="#" data-target="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a> --}}
        </div>
      </nav>
      <main class="py-4">
        @yield('content')
      </main>
    </div>
  </body>
  <script src="{{ asset(mix('js/app.js')) }}"></script>

  <script>
    $(".dropdown-button").dropdown();
  </script>
</html>
