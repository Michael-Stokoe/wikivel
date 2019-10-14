@extends('layouts.app')

@section('title')
Testing page
@endsection

@section('content')
@foreach ($comments as $comment)
@include('comments.partials.comment', [
'comment' => $comment
])
@endforeach
@endsection
