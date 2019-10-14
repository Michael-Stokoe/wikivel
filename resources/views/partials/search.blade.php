<div id="search_container" class="flex-1 w-full search__container" style="position: relative">
    <input
        id="search_input"
        name="search_input"
        type="search"
        class="p-2 w-full bg-transparent text-white outline-none text-2xl search__input border-b border-transparent"
        placeholder="Search...">
    <i class="fas fa-search search__glass"></i>
</div>

@section('scripts')
<script src="{{ asset('js/search.js') }}"></script>
@endsection
