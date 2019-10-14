{{-- <div class="flex p-4 text-blue-900 pl-20 pt-20">
    <ul>
        <li class="py-4">
            <p class="text-xl font-black">Your recents</p>
        </li>

        <li class="py-4">
            <i class="fas fa-book px-2 text-lg pb-4"></i></i> <span class="font-semibold">Wikis</span>
            <ul>
                @foreach ($usersRecentWikis as $wiki)
                <li>
                    <a href="{{ $wiki->getUrl() }}">{{ $wiki->name }}</a>
</li>
@endforeach
</ul>
</li>

<li class="py-4">
    <i class="fas fa-book-open px-2 text-lg pb-4"></i> <span class="font-semibold">&nbsp;Spaces</span>
    <ul>
        @foreach ($usersRecentSpaces as $space)
        <li>
            <a href="{{ $space->getUrl() }}">{{ $space->name }}</a>
        </li>
        @endforeach
    </ul>
</li>

<li class="py-4">
    <i class="far fa-bookmark px-2 text-lg pb-4"></i> <span class="font-semibold">&nbsp;Pages</span>
    <ul>
        @foreach ($usersRecentPages as $page)
        <li>
            <a href="{{ $page->getUrl() }}">{{ $page->name }}</a>
        </li>
        @endforeach
    </ul>
</li>
</ul>
</div> --}}
<nav class="bg-gray-400 shadow mb-8 py-6 flex md:hidden">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="text-center ml-6">
                <p class="mb-2">Recent Wikis</p>
                @foreach ($usersRecentWikis as $wiki)
                <a class="text-gray-900 p-3" href="{{ $wiki->getUrl() }}">{{ $wiki->name }}</a>
                @endforeach

            </div>
        </div>
    </div>
</nav>
