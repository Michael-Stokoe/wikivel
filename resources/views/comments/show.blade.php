@extends('layouts.app')

@section('title')
Displaying Comment Thread
@endsection

@section('content')
    @include('comments.partials.comment', ['comment' => $comment])
@endsection
