@extends('layouts.app')

@section('title')
Confirm Report
@endsection

@section('content')
<div>
    <h1>Report Comment?</h1>

    @include('comments.partials.comment', ['comment' => $comment, 'hideReplies' => true])

    <form action="{{ route('comment.report.store', ['id' => $comment->id]) }}" method="POST">
        @csrf
        <a class="btn-gray px-2 hover:no-underline" style="padding-top: 5px; padding-bottom: 6px" href="{{ route('home') }}">Cancel</a>
        <button class="btn">Yes, I'm sure</button>
    </form>
</div>
@endsection
