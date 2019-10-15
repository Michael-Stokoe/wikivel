<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Services\ActivityService;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    protected $recentActivityPageSize;
    protected $activityLogDays;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->recentActivityPageSize = config('wiki.recent_activity.page_size');
        $this->activityLogDays = config('wiki.activity_log.days_to_show');
    }

    // Show the Dashboard

    /**
     * @param ActivityService $activityService
     * @param Request         $request
     *
     * @return Factory|View
     */
    public function index(ActivityService $activityService, Request $request)
    {
        // If there's a user logged in...
        if (auth()->check()) {
            // Get a full list of recent Activities from the activity log. (Limited the results to 10 for now.)
            $recentActivitiesQuery = Activity::where(
                'created_at',
                '>=',
                Carbon::now()->subDays($this->activityLogDays)
            )->orderByDesc('created_at');

            $activityCount = $recentActivitiesQuery->count();

            $recentActivities = $recentActivitiesQuery->paginate($this->recentActivityPageSize);

            // Instantiate return array.
            $recentActivityData = [];

            // Loop through each activity and gather all info needed for each one.
            foreach ($recentActivities as $recentActivity) {
                $recentActivityData[] = $activityService->buildRecentActivityData($recentActivity);
            }
        } else {
            $recentActivityData = collect();
            $activityCount = 0;
        }

        return view('home', [
            'recentActivities' => $recentActivityData,
            'activityCount' => $activityCount,
            'activityLogDays' => $this->activityLogDays,
            'recentActivityPageSize' => $this->recentActivityPageSize,
            'recentActivityCount' => $activityCount,
            'currentPage' => $request->input('page') ?? 1,
        ]);
    }
}
