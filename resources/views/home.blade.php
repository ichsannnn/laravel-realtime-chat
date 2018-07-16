@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row row-main">
      <div class="col s12 m12 l12">
        <div class="card">
          <div class="card-content">
            <div class="row margin-bottom">
              <div class="col s12 m12 l12">
                <span class="card-title">Dashboard</span>
              </div>
            </div>
            <div class="row margin-bottom">
              <div class="col s12 m12 l12">
                @if (session('status'))
                  <div class="row margin-bottom">
                    <div class="col s12 m12 l12">
                      <div class="card-panel green white-text z-depth-0" role="alert">
                        {{ session('status') }}
                      </div>
                    </div>
                  </div>
                @endif

                {{-- You are logged in! --}}
              </div>
            </div>
            <home-component></home-component>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
