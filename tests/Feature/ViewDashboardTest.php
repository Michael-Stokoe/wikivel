<?php

namespace Tests\Feature;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Activitylog\Models\Activity;
use Tests\TestCase;

class ViewDashboardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function user_can_view_the_dashboard()
    {
        $this->get('/')->assertStatus(200);
    }

    /**
     * @test
     */
    public function authenticated_user_can_view_all_activities_of_previous_three_days()
    {
        $activityOfToday = factory(Activity::class)->create();

        $activityOfThreeDaysBeforeToday = factory(Activity::class, 4)
            ->create(['created_at' => Carbon::now()->subDays(3)]);


        $this->actingAs(factory(User::class)->create())
            ->get('/')
            ->assertSee($activityOfThreeDaysBeforeToday);

    }
}
