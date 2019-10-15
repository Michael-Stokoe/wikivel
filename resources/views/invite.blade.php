@extends('layouts.app')

@section('title')
Invite New Users
@endsection

@section('head')
@endsection

@section('content')
<h1><i class="fas fa-user px-2 text-lg pb-4"></i> Invite new users</h1>
<hr>
<br>

<div id="content" class="w-full h-full pb-10">
    @include('errors.form_errors')
    <form class="h-full" action="{{ route('invite.store') }}" method="POST">
        @csrf
        <div id="users">
            <div id="user_1">
                <label class="mt-4 text-base">User 1:</label>
                <label for="user_1_name" class="mt-4">Name</label>
                <input type="text" id="user_1_name" name="user_1_name" maxlength="20">

                <label for="user_1_email" class="mt-4">Email Address</label>
                <input type="text" id="user_1_email" name="user_1_email" maxlength="20" class="mb-4">
            </div>
        </div>

        <div class="w-full text-right py-4">
            <button type="button" class="btn-green"
                onclick="window.addAnotherUser()"><i class="fas fa-plus"></i> Add another</button>
            <button type="button" class="btn-gray"
                onclick="window.location.href='{{ route('invite.index') }}'">Cancel</button>
            <button type="submit" class="btn">Save</button>
        </div>

        <input id="users_to_invite_count" name="users_to_invite_count" class="hidden" value="1">
    </form>
</div>
@endsection

@section('scripts')
@endsection
