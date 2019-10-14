<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use App\Services\WikiService;
use Illuminate\Support\Carbon;
use App\Services\ActivityService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

class HomeController extends Controller
{
    protected $recentActivityPageSize;
    protected $activityLogDays;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->recentActivityPageSize = config('wiki.recent_activity.page_size');
        $this->activityLogDays = config('wiki.activity_log.days_to_show');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(WikiService $wikiService, ActivityService $activityService, Request $request)
    {
        $user = Auth::user();

        // If there's a user logged in...
        if ($user) {
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
            'activityLogDays' => config('wiki.activity_log.days_to_show'),
            'recentActivityPageSize' => $this->recentActivityPageSize,
            'recentActivityCount' => $activityCount,
            'currentPage' => $request->input('page') ?? 1,
        ]);
    }
}
