<h1>Comments:</h1>

<form class="py-2 w-full" method="POST" action="{{ route('comment.store') }}">
    @csrf

    <p class="py-1 font-semibold">Write a new comment:</p>
    <p class="text-xs text-gray-400 pb-3">(Markdown is enabled)</p>

    <input class="hidden" name="commentable_type" value="{{ $commentable_type }}">
    <input class="hidden" name="commentable_id" value="{{ $commentable_id }}">

    <input type="text" name="comment_title" placeholder="Give your comment a title!">
    <textarea class="my-2" name="comment_body"></textarea>
    <div class="w-full text-right">
        <div class="w-full text-right py-4">
            <button type="submit" class="btn">Save</button>
        </div>
    </div>
</form>

@foreach ($comments as $comment)
    @include('comments.partials.comment', ['comment' => $comment])
@endforeach
