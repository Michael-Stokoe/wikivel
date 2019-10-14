@extends('layouts.app')

@section('title')
Edit User Profile
@endsection

@section('content')
<div class="flex w-full">
    <div class="text-left w-1/2">
        <h1><i class="fas fa-user"></i> Editing {{ $user->name }}</h1>
    </div>
    <div class="text-right w-1/2">

    </div>
</div>
<hr>
<br>

<div id="content" class="w-full h-full pb-10">
    <form class="h-full" action="{{ route('user.update', ['id' => $user->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">

        <div class="w-full text-right py-4">
            <button type="button" class="btn-gray hover:no-underline"
                onclick="window.location.href='{{ $user->getUrl() }}'">Cancel</button>
            <button type="submit" class="btn">Save</button>
        </div>

        <input style="display:none" name="record_id" value="{{ $user->id }}">
    </form>
</div>
@endsection
