@extends('layouts.app')

@section('title')
Not Authorised
@endsection

@section('content')
<div class="flex items-center justify-content-center w-full h-full">
    <div class="text-center w-1/2">
        <h1 class="text-error-code">401</h1>
    </div>
    <div class="text-left w-1/2">
        <h1>You are not authorised to perform this action.</h1>
        <p>This occurrence has been logged.</p>
    </div>
</div>
@endsection
