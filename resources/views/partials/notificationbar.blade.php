<div class="bg-blue-900 text-white text-center">
    @if (session()->has('comment_reported_msg'))
        <p>{{ session('comment_reported_msg') }}</p>
    @endif
</div>
