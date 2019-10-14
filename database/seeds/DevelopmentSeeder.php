<?php

use App\Models\User;
use App\Models\Wiki;
use App\Models\Space;
use Illuminate\Database\Seeder;
use Spatie\Activitylog\Models\Activity;

class DevelopmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $seederData = config('development-seeder-data.wikis');

        $this->initiateSeeding($seederData);
    }

    public function initiateSeeding($seederData)
    {
        $this->seedWikis($seederData);
    }

    public function seedWikis($wikis)
    {
        foreach ($wikis as $wiki) {
            $newWiki = Wiki::create(
                [
                    'name' => $wiki['name'],
                    'content' => $wiki['content'],
                    'user_id' => $wiki['user_id'],
                ]
            );

            $spaces = $wiki['spaces'];

            $this->command->info(
                sprintf(
                    'Created Wiki: [%s]',
                    $newWiki->name
                )
            );

            $this->command->info(
                sprintf(
                    'Creating [%d] spaces for Wiki: [%s]',
                    count($spaces),
                    $newWiki->name
                )
            );

            $this->seedSpaces($newWiki, $spaces);
        }
    }

    public function seedSpaces($wiki, $spaces)
    {
        foreach ($spaces as $space) {
            $newSpace = $wiki->spaces()->create(
                [
                    'name' => $space['name'],
                    'content' => $space['content'],
                    'user_id' => $space['user_id'],
                ]
            );

            $pages = $space['pages'];

            $this->command->info(
                sprintf(
                    'Created Space [%s] in Wiki [%s]',
                    $newSpace->name,
                    $wiki->name
                )
            );

            $this->command->info(
                sprintf(
                    'Creating [%d] pages for Space: [%s]',
                    count($pages),
                    $newSpace->name
                )
            );

            $this->seedPages($newSpace, $pages);
        }
    }

    public function seedPages($space, $pages)
    {
        foreach ($pages as $page) {
            $newPage = $space->pages()->create(
                [
                    'name' => $page['name'],
                    'content' => $page['content'],
                    'user_id' => $page['user_id'],
                ]
            );

            $this->command->info(
                sprintf(
                    'Created Page [%s] in Space [%s]',
                    $newPage->name,
                    $space->name
                )
            );
        }

        $this->fixActivityLog();
    }

    public function fixActivityLog()
    {
        $user = User::first();
        $activities = Activity::all();

        $this->command->info(
            sprintf(
                'Assigning activity log records to user [%d]',
                $user->id
            )
        );

        foreach ($activities as $activity) {
            $activity->causer_type = User::class;
            $activity->causer_id = $user->id;
            $activity->save();
        }

        $this->command->info(
            sprintf(
                'Assigned activity log records to user [%d]',
                $user->id
            )
        );
    }
}
