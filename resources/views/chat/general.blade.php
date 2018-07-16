@extends('layouts.app')

@section('content')
  <general-chat profile-image="{{ auth()->user()->gravatar }}"></general-chat>
@endsection
