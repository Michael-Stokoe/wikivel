<nav class="bg-blue-900 shadow mb-0 py-6 md:mb-8">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                    {{ config('app.name') }}
                </a>
            </div>

            @guest
                <div class="flex-1 w-full"></div>
            @else
                @include('partials.search')
            @endguest

            <div class="text-right ml-6">
                @guest
                <a class="text-gray-300 text-sm p-3 hover:text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                @if (Route::has('register'))
                <a class="text-gray-300 text-sm p-3 hover:text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                @endif

                @else
                <a href="{{ route('invite.index') }}" class="text-gray-300 text-sm p-3 hover:no-underline hover:text-white" title="Invite User(s)">
                    <i class="fas fa-plus"></i>
                </a>

                <a href="{{ route('favorites.index') }}" class="text-gray-300 text-sm p-3 hover:text-white">
                    Favorites
                </a>

                <a href="{{ route('wiki.index') }}" class="text-gray-300 text-sm p-3 hover:text-white">
                    Wikis
                </a>

                <a href="{{ route('user.show', ['id' => Auth::id()]) }}"
                    class="text-gray-300 text-sm p-3 hover:text-white">{{ Auth::user()->name }}</a>

                <a href="{{ route('logout') }}" class="text-gray-300 text-sm p-3 hover:text-white" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    {{ csrf_field() }}
                </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
