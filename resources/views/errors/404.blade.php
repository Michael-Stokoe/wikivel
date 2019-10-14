@extends('layouts.app')

@section('title')
Not Authorised
@endsection

@section('content')
<div class="flex items-center justify-content-center w-full h-full">
    <div class="text-center w-1/2">
        <h1 class="text-error-code">404</h1>
    </div>
    <div class="text-left w-1/2">
        <h1>Requested page not found.</h1>
        <p>The page you're looking for cannot be found.</p>
        <p>Return to the <a href="{{ route('home') }}">Home page</a>.</p>
    </div>
</div>
@endsection
