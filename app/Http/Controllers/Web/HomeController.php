<?php

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Carbon;
use App\Services\ActivityService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        // If there's a user logged in...
        if (auth()->check()) {
            // Get a full list of recent Activities from the activity log. (Limited the results to 10 for now.)
            $recentActivitiesQuery = Activity::where('created_at', '>=', Carbon::now()->subDays(config('wiki.activity_log.days_to_show')))
                                        ->orderByDesc('created_at');

            $activityCount = $recentActivitiesQuery->count();

            $recentActivities = $recentActivitiesQuery->paginate(config('wiki.recent_activity.page_size'));

            // Instantiate return array.
            $recentActivityData = [];

            // Loop through each activity and gather all info needed for each one.
            foreach ($recentActivities as $recentActivity) {
                $recentActivityData[] = ActivityService::buildRecentActivityData($recentActivity);
            }
        } else {
            $recentActivityData = collect();
            $activityCount = 0;
        }



        return view('home', [
            'recentActivities' => $recentActivityData,
            'activityCount' => $activityCount,
            'recentActivityCount' => $activityCount,
            'currentPage' => \request('page') ?? 1,
        ]);
    }
}
