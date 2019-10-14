<!doctype html>
<html lang="{{ app()->getLocale() }}">

@include('partials.head')

<body class="bg-gray-100 h-screen antialiased leading-none line-numbers">
    @include('partials.nav')
    @if (Auth::check())
        @include('partials.subnavtop')
        @include('partials.notificationbar')
    @endif



    <div class="min-h-full flex max-w-full min-w-full">
        @if (Auth::check())
            @include('partials.subnavside')
        @endif
        <div class="flex py-5 pr-8 pl-8 w-full min-h-full">
            <div class="w-full min-h-full shadow-lg bg-white rounded p-6">
                @yield('content')
            </div>
        </div>
    </div>


    @include('partials.scripts')
    @include('partials.footer')
</body>

</html>
