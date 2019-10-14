<?php

use App\Models\Page;
use App\Models\User;
use App\Models\Wiki;
use App\Models\Space;
use Illuminate\Database\Seeder;
use Spatie\Activitylog\Models\Activity;

use League\HTMLToMarkdown\HtmlConverter;

class SqlSeeder extends Seeder
{
    protected $sqlFileNames = [
        'users',
        'wikis',
        'spaces',
        'pages'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->sqlFileNames as $sqlFileName) {
            $sql = file_get_contents(
                sprintf(
                    '%s/sql/%s.sql',
                    __DIR__,
                    $sqlFileName
                )
            );

            DB::unprepared($sql);

            $this->command->info(
                sprintf(
                    'Dumped %s.sql to database.',
                    $sqlFileName
                )
            );
        }

        $this->convertHtmlToMarkdown();
        $this->addMissingActivities();
        $this->repairActivityLog();
    }

    public function addMissingActivities()
    {
        $users = User::all();
        $wikis = Wiki::all();
        $spaces = Space::all();
        $pages = Page::all();

        $this->command->info('Fixing user activity logs');

        foreach ($users as $user) {
            Activity::create(
                [
                    'description' => 'created',
                    'subject_id' => $user->id,
                    'subject_type' => 'App\Models\User',
                    'causer_type' => 'App\Models\User',
                    'causer_id' => 1,
                ]
            );
        }

        $this->command->info('Fixing wiki activity logs');

        foreach ($wikis as $wiki) {
            Activity::create(
                [
                    'description' => 'created',
                    'subject_id' => $wiki->id,
                    'subject_type' => 'App\Models\Wiki',
                    'causer_type' => 'App\Models\User',
                    'causer_id' => 1,
                ]
            );
        }

        $this->command->info('Fixing space activity logs');

        foreach ($spaces as $space) {
            Activity::create(
                [
                    'description' => 'created',
                    'subject_id' => $space->id,
                    'subject_type' => 'App\Models\Space',
                    'causer_type' => 'App\Models\User',
                    'causer_id' => 1,
                ]
            );
        }

        $this->command->info('Fixing page activity logs');

        foreach ($pages as $page) {
            Activity::create(
                [
                    'description' => 'created',
                    'subject_id' => $page->id,
                    'subject_type' => 'App\Models\Page',
                    'causer_type' => 'App\Models\User',
                    'causer_id' => 1,
                ]
            );
        }
    }

    public function convertHtmlToMarkdown()
    {
        $wikis = Wiki::all();
        $spaces = Space::all();
        $pages = Page::all();

        $this->command->info('Converting wiki content HTML to markdown');

        foreach ($wikis as $wiki) {
            $converter = new HtmlConverter();

            $html = $wiki->content;

            $markdown = $converter->convert($html);

            $wiki->content = $markdown;
            $wiki->save();
        }

        $this->command->info('Converting space content HTML to markdown');

        foreach ($spaces as $space) {
            $converter = new HtmlConverter();

            $html = $space->content;

            $markdown = $converter->convert($html);

            $space->content = $markdown;
            $space->save();
        }

        $this->command->info('Converting page content HTML to markdown');

        foreach ($pages as $page) {
            $converter = new HtmlConverter();

            $html = $page->content;

            $markdown = $converter->convert($html);

            $page->content = $markdown;
            $page->save();
        }
    }

    public function repairActivityLog()
    {
        $activities = Activity::all();

        foreach ($activities as $activity) {
            $activity->causer_id = 1;
            $activity->causer_type = 'App\Models\User';

            $activity->save();
        }
    }
}
