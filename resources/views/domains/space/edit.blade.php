@extends('layouts.app')

@section('title')
{{ $space->name }}
@endsection

@section('head')
@endsection

@section('content')
<div class="flex w-full">
    <div class="text-left w-1/2">
        <h1><i class="fas fa-book px-2 text-lg pb-4"></i> {{ $space->name }}</h1>
    </div>
    <div class="text-right w-1/2">
        <form method="POST" action="{{ route('space.delete', ['space' => $space]) }}">
            @csrf

            <button id="delete_item_button" class="px-1 text-blue-600 hover:text-red-600">
                <i class="far fa-trash-alt"></i>
            </button>
        </form>
    </div>
</div>
<hr>
<br>

<div id="content" class="w-full h-full pb-10">
    @include('errors.form_errors')
    <form class="h-full" action="{{ route('space.update', ['space' => $space]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $space->name }}" maxlength="20">

        <label for="content" class="py-2">Content</label>
        <textarea id="content" name="content" class="w-full" style="height: 80%">{!! $space->content !!}</textarea>

        <div class="w-full text-right py-4">
            <button type="button" class="btn-gray hover:no-underline"
                onclick="window.location.href='{{ $space->getUrl() }}'">Cancel</button>
            <button type="submit" class="btn">Save</button>
        </div>

        <input style="display:none" name="record_id" value="{{ $space->id }}">
    </form>
</div>

@endsection

@section('scripts')
@endsection
