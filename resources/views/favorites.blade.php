@extends('layouts.app')

@section('title')
Your Favorites
@endsection

@section('head')
@endsection

@section('content')
<h1><i class="fas fa-book px-2 text-lg pb-4"></i> List of Favorites</h1>
<hr>
<br>

<div>
    <ul>
        @foreach ($favorites as $favorite)
        <li class="py-2">
            <a href="{{ $favorite[0]->getUrl() }}">{{ $favorite[0]->name }}</a>
            <span class="px-2 text-gray-500 block sm:inline-flex">
                {{ substr($favorite[0]->content, 0, 150) . '...' }}
            </span>
        </li>
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')

@endsection
