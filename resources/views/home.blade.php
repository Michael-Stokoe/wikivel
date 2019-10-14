@extends('layouts.app')

@section('title')
Home
@endsection

@section('content')

{{-- User is logged in --}}
@if (Auth::check())
    <div id="recent_activity" class="w-full text-center">
        <h1 class="text-3xl text-blue-900 mt-5 mb-5"><i class="fas fa-history"></i> Recent Activity</h1>
        <ul class="text-left">
            @foreach ($recentActivities as $recentActivity)
            <li>
                @include('partials.activitybar', ['recentActivity' => $recentActivity])
            </li>
            @endforeach
        </ul>
        @if ($activityCount > 0)
        <div>
            <p class="opacity-50 pt-5">Showing changes 1-{{ $activityCount > 10 ? 10 : $activityCount }} of
                {{ $activityCount }}
                from the last {{ $activityLogDays }} days.
            </p>
        </div>
        <div class="py-2">
            @include('partials.home.pagenumbers')
        </div>

        @else
            <p class="opacity-50 pt-5">No recent activity to show.</p>
        @endif
    </div>
@endif

{{-- No User is logged in --}}
@if (!Auth::check())
    <div class="w-full text-center">
        <h1 class="text-3xl text-blue-900 mt-5 mb-5">Welcome to Lara Wiki!</h1>

        <p>To get started, you either need to
            <a href="{{ route('register') }}">register an account
                now</a> or
            <a href="{{ route('login') }}">log in</a>.
        </p>
    </div>

    <div class="w-full text-center">
        {{--  --}}
    </div>
@endif

@endsection
