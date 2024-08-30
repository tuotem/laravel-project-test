@extends('layouts.master')

@section("content")

<a href="{{ url("localization/kh") }}">Khmer</a>
<a href="{{ url("localization/en") }}">English</a>

<h1>{{ __("frontend.Welcome to our application") }}</h1>

<h1>@{{ $name }}</h1>


@endsection 

@section('script')

    <script>
        
    </script>

@endsection