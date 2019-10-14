@extends('layouts.app')

@section('title')
{{ $user->name }}
@endsection

@section('head')
@endsection

@section('content')
<div class="flex w-full">
    <div class="text-left w-1/2">
        <h1><i class="fas fa-user"></i> {{ $user->name }}</h1>
    </div>
    <div class="text-right w-1/2">
        @if(Auth::id() === $user->id || Auth::user()->hasRole('super_admin'))
        <a class="px-1 hover:text-yellow-600 hover:no-underline" href="{{ route('user.edit', ['id' => $user->id]) }}">
            <i class="fas fa-edit"></i>
        </a>
        @endif
    </div>
</div>
<hr>
<br>
@endsection

@section('scripts')

@endsection
