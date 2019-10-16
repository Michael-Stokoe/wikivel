<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Spatie\Activitylog\Models\Activity;

class ActivityService
{
    /**
     * Builds an array of activity data along with original models for passing to the homepage.
     * (Or anywhere you want a list of recent activities).
     * @param Activity $recentActivity
     * @return Collection
     */
    public static function buildRecentActivityData(Activity $recentActivity)
    {

        // Look for the record that has been changed using this one funky little trick that CS Majors hate...
        $changedRecord = $recentActivity->subject_type::where('id', $recentActivity->subject_id)->first();

        // If we found the record, grab the change type. (This is "updated", "created" etc.)
        if ($changedRecord) {
            $changeType = $recentActivity->description;
        } else {
            // The changed record couldn't be found. So it must have been deleted.
            $changedRecord = (object) json_decode($recentActivity->properties)->attributes;
            $changeType = 'deleted';
        }

        // Find the user who changed the record.
        $changedBy = User::where('id', $recentActivity->causer_id)->first();

        // Remove "App\Models" from the changed item's type.
        $recentActivity->subject_type = str_replace('App\\Models\\', '', $recentActivity->subject_type);

        // Build our return array from data collected above.
        $recentActivityData = collect([
            'changedRecord' => $changedRecord,
            'changeType' => $changeType,
            'changedBy' => $changedBy,
            'activityData' => $recentActivity
        ]);

        return $recentActivityData;
    }
}
