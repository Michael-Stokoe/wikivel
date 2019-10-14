@extends('layouts.app')

@section('title')
All Wikis
@endsection

@section('head')
@endsection

@section('content')
    <h1><i class="fas fa-book px-2 text-lg pb-4"></i> List of wikis</h1>
    <hr>
    <br>

    <div>
        <ul>
            @foreach ($wikis as $wiki)
                <li class="py-2">
                    <a href="{{ $wiki->getUrl() }}">{{ $wiki->name }}</a>
                    <span class="px-2 text-gray-500 block sm:inline-flex">{{ strlen($wiki->content) < 150 ? $wiki->content : substr($wiki->content, 0, 150) . '...' }}</span>
                </li>
            @endforeach
        </ul>
    </div>
@endsection

@section('scripts')
@endsection
