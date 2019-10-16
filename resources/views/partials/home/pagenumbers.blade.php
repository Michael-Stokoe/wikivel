@php
    for ($i = 1; $i <= ceil($recentActivityCount / config('wiki.recent_activity.page_size')); ++$i) {
        if ($i==$currentPage) {
            echo "<span class=\" px-1\">$i</span>";
        } else {
            $route = route('home', ['page' => $i]);
            echo "<a class=\"px-1\" href=\"$route\">$i</a>";
        }
    }
@endphp
