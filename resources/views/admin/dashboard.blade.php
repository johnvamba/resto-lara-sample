@extends('layout.core')

@section('header')
<div class="top-right links">
    @auth
        <a href="{{ url('/') }}">Home</a>
    @else
        <a href="{{ route('admin.login') }}">Login</a>
    @endauth
</div>
@endsection

@section('content')
	Admin
@endsection