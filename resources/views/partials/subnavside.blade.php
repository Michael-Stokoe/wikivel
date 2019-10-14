<div class="flex-none w-full hidden md:flex md:max-w-xs">
    <div class="flex p-2 text-blue-900 pl-10 pt-20">
        <ul>
            <li class="py-4">
                <i class="fas fa-book px-2 text-lg pb-4"></i> <span class="font-semibold">Wikis</span>
                <ul>
                    @foreach ($sideBarWikis as $wiki)
                    <li class="py-1">
                        <a href="{{ $wiki->getUrl() }}">{{ $wiki->name }}</a>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li class="py-4">
                <p class="text-xl font-black">Recent spaces/pages</p>
            </li>

            <li class="py-4">
                <i class="fas fa-book-open px-2 text-lg pb-4"></i> <span class="font-semibold">&nbsp;Spaces</span>
                <ul>
                    @foreach ($usersRecentSpaces as $space)
                    <li class="py-1">
                        <a href="{{ $space->getUrl() }}">{{ $space->name }}</a>
                        <span class="text-xs text-gray-400 pl-2"
                            title="{{ $space->wiki->name }}">[W:{{ substr($space->wiki->name, 0, 8) . '...' }}]</span>
                    </li>
                    @endforeach
                </ul>
            </li>

            <li class="py-4">
                <i class="far fa-bookmark px-2 text-lg pb-4"></i> <span class="font-semibold">&nbsp;Pages</span>
                <ul>
                    @foreach ($usersRecentPages as $page)
                    <li class="py-1">
                        <a href="{{ $page->getUrl() }}">{{ $page->name }}</a>
                        <span class="text-xs text-gray-400 pl-2"
                            title="{{ $page->space->name }}">[S:{{ substr($page->space->name, 0, 10) . '...' }}]</span>
                    </li>
                    @endforeach
                </ul>
            </li>
        </ul>
    </div>
</div>
