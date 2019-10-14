<div class="w-full rounded overflow-hidden shadow-md p-4 my-4">
    <div class="w-full flex">
        <div>
            {{-- Display Picture --}}
            @include('partials.displaypicture', [
            'user' => $comment->creator,
            'size' =>'sm'
            ])
        </div>

        <div class="opacity-75 pl-3">
            <a class="font-semibold text-sm" href="{{ route('user.show', ['id' => $comment->creator->id]) }}">
                {{ $comment->creator->name }}
            </a>
            <p class="font-light text-xs">Posted: {{ $comment->created_at->format('d/m/y h:i') }}</p>
            @if ($comment->updated_at > $comment->created_at)
            <p class="font-light text-xs">Edited: {{ $comment->updated_at }}</p>
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
                    {{ $comment->title }}
                </p>
            </div>
            <div class="w-full flex py-1">
                <p class="text-gray-600">
                    {!! $comment->getContentAsHtml() !!}
                </p>
            </div>
            <div class="w-1/12">
                <hr class="my-3">
            </div>
            <div class="w-full flex py-1">
                <a href="{{ route('comment.reply', ['id' => $comment->id, 'redirectTo' => request()->url()]) }}">
                    <i class="fas fa-comment-dots text-gray-500 cursor-pointer pr-1" title="Reply"></i>
                </a>
                <a href="{{ route('comment.report', ['id' => $comment->id, 'redirectTo' => request()->url()]) }}">
                    <i class="fas fa-exclamation-triangle text-gray-500 cursor-pointer pr-1" title="Report comment"></i>
                </a>
            </div>
        </div>
    </div>

    @php
        if (!isset($hideReplies)) {
            $hideReplies = false;
        }
    @endphp

    @if (!$hideReplies)
        @if (count($comment->comments) > 0)
            @foreach ($comment->comments as $comment)
                @include('comments.partials.comment', ['comment' => $comment])
            @endforeach
        @endif
    @endif
</div>
