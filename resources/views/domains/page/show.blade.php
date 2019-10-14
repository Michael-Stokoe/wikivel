@extends('layouts.app')

@section('title')
{{ $page->name }}
@endsection

@section('head')
@endsection

@section('content')
<div class="flex w-full">
    <div class="text-left w-1/2">
        <h1><i class="fas fa-book px-2 text-lg pb-4"></i> {{ $page->name }}</h1>
    </div>

    <div class="text-right w-1/2 h-full flex-2">
        <div class="w-full h-full flex">
            <div class="w-10/12 h-full text-right invisible md:visible py-1">
                @foreach ($page->tags as $tag)
                @include('partials.components.tag')
                @endforeach
            </div>
            <div class="w-2/12 h-full text-right">
                <form class="flex-2" method="POST" action="{{ route('page.delete', ['page' => $page]) }}">
                    @csrf

                    <a class="px-1 py-1 hover:text-green-600 hover:no-underline favorite__toggle"
                        title="Toggle Favorite">
                        @if ($page->liked())
                        <i class="far fa-thumbs-up cursor-pointer favorite__icon" style="display: none"></i>
                        <i class="fas fa-thumbs-up cursor-pointer favorite__icon"></i>
                        @else
                        <i class="far fa-thumbs-up cursor-pointer favorite__icon"></i>
                        <i class="fas fa-thumbs-up cursor-pointer favorite__icon" style="display: none"></i>
                        @endif
                    </a>

                    <a class="px-1 hover:text-yellow-600 hover:no-underline"
                        href="{{ route('page.edit', ['page' => $page]) }}">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button id="delete_item_button" class="px-1 text-blue-600 hover:text-red-600">
                        <i class="far fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<br>
<div id="content">
    {!! $page->getContentAsHtml() !!}
</div>

<br>
<hr>
<br>

@include('comments.partials.commentsection', ['comments' => $page->comments->sortByDesc('id')])
@endsection

@section('scripts')
<script>
    $('.favorite__toggle').on('click', function (e) {
        $.ajax({
           type: 'POST',
           url: "{{ route('favorites.toggle') }}",
           data: {
               likeable_type: "{{ $likeable_type }}",
               likeable_id: "{{ $likeable_id }}"
            },
           success: function(){
              toggleIcons();
           }
        });
    })

    toggleIcons = function() {
        $('.favorite__icon').toggle();
    }
</script>
@endsection
