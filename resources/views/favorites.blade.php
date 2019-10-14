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
        @foreach ($favorites as $section => $favorites)
        <h1>{{ $section }}</h1>
            @forelse ($favorites as $favorite)
            <li class="py-2">
                <a href="{{ $favorite->getUrl() }}">{{ $favorite->name }}</a>
                <span class="px-2 text-gray-500 block sm:inline-flex">
                    {{ substr($favorite->content, 0, 150) . '...' }}
                </span>
            </li>
            @empty
                <li class="py-2">No favorites in this section (yet).</li>
            @endforelse
        @endforeach
    </ul>
</div>
@endsection

@section('scripts')

@endsection
