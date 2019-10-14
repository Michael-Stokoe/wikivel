<div class="w-full rounded overflow-hidden shadow-md p-4 my-4">
    <div class="w-full flex">
        <div class="w-12">
            {{-- Display Picture --}}
            @if (isset($recentActivity['changedBy']))

            @include('partials.displaypicture', [
                'user' => $recentActivity['changedBy'],
                'size' =>'md'
            ])

            @endif
        </div>

        <div class="w-9/12 pt-0 md:pt-4 pl-2 mr-auto">
            {{-- User name --}}
            @if (isset($recentActivity['changedBy']->name))
                <span class="font-semibold">
                    <a href="{{ route('user.show', ['id' => $recentActivity['changedBy']->id]) }}">
                        {{ $recentActivity['changedBy']->name }}
                    </a>
                </span>
            @else
                <span class="font-semibold">(unknown)</span>
            @endif

            {{-- Updated/Created --}}
            {{ $recentActivity['changeType'] }}

            {{-- Wiki/Space/Page --}}
            <span class="font-semibold">{{ $recentActivity['activityData']->subject_type }}</span>

            {{-- Wiki/Space/Page NAME --}}
            @if ($recentActivity['changeType'] === 'deleted')
                {{ $recentActivity['changedRecord']->name }}
            @else
                <a href="{{ $recentActivity['changedRecord']->getUrl() }}">
                    {{ $recentActivity['changedRecord']->name }}
                </a>
            @endif

            {{-- If it was a "Space" record show the wiki it was created in --}}
            @if ($recentActivity['activityData']->subject_type === 'Space')
                @if ($recentActivity['changeType'] !== 'deleted')
                    in Wiki <a href="{{ $recentActivity['changedRecord']->wiki->getUrl() }}">
                        {{ $recentActivity['changedRecord']->wiki->name }}
                    </a>
                @endif
            @endif

            {{-- If it was a "Page" record, show the space it was created in --}}
            @if ($recentActivity['activityData']->subject_type === 'Page')
                @if ($recentActivity['changeType'] !== 'deleted')
                    in Space <a href="{{ $recentActivity['changedRecord']->space->getUrl() }}">
                        {{ $recentActivity['changedRecord']->space->name }}
                    </a>
                @endif
            @endif
        </div>

        <div class="w-2/12 text-right text-sm opacity-50">
            {{ $recentActivity['activityData']->created_at }}
        </div>
    </div>

    @if ($recentActivity['changeType'] !== 'deleted')
        <div class="w-full py-2 opacity-75">
            {{ substr($recentActivity['changedRecord']->content, 0, 150) . '...' }}
        </div>
    @endif
</div>
