@extends('layouts.app')

@section('title')
Reply to Comment
@endsection

@section('content')
<div>
    <h1>Replying to {{ $originalComment->creator->name }}'s comment:</h1>
    <div>
        <div class="w-full rounded overflow-hidden shadow-md p-4 my-4">
            <div class="w-full flex">
                <div>
                    {{-- Display Picture --}}
                    @include('partials.displaypicture', [
                    'user' => $originalComment->creator,
                    'size' =>'sm'
                    ])
                </div>
        
                <div class="opacity-75 pl-3">
                    <a class="font-semibold text-sm" href="{{ route('user.show', ['id' => $originalComment->creator->id]) }}">
                        {{ $originalComment->creator->name }}
                    </a>
                    <p class="font-light text-xs">Posted: {{ $originalComment->created_at->format('d/m/y h:i') }}</p>
                    @if ($originalComment->updated_at > $originalComment->created_at)
                    <p class="font-light text-xs">Edited: {{ $originalComment->updated_at }}</p>
                    @endif
                </div>
            </div>
            <div>
                <div class="w-1/12">
                    <hr class="my-3">
                </div>
                <div class="w-11/12">
                    <div class="w-full flex py-1">
                        <p class="font-bold text-blue-900">
                            {{ $originalComment->title }}
                        </p>
                    </div>
                    <div class="w-full flex py-1">
                        <p class="text-gray-600">
                            {!! $originalComment->getContentAsHtml() !!}
                        </p>
                    </div>
                    <div class="w-1/12">
                        <hr class="my-3">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form class="py-2 w-full" method="POST" action="{{ route('comment.store') }}">
        @csrf
    
        <p class="py-1 font-semibold">Write a new comment:</p>
        <p class="text-xs text-gray-400 pb-3">(Markdown is enabled)</p>
    
        <input class="hidden" name="commentable_type" value="{{ $commentable_type }}">
        <input class="hidden" name="commentable_id" value="{{ $commentable_id }}">
        <input class="hidden" name="redirect_to" value="{{ $redirect_to }}">


        <input type="text" name="comment_title" placeholder="Give your comment a title!">
        <textarea class="my-2" name="comment_body"></textarea>
        <div class="w-full text-right">
            <div class="w-full text-right py-4">
                <button type="submit" class="btn">Save</button>
            </div>
        </div>
    </form>
</div>
@endsection
