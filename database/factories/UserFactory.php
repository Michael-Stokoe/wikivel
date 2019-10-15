<?php

/** @var Factory $factory */

use App\Models\Page;
use App\Models\Space;
use App\Models\User;
use App\Models\Wiki;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Wiki::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
    ];
});

$factory->define(Space::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'wiki_id' => function() {
            return factory(Wiki::class)->create()->id;
        }
    ];
});


$factory->define(Page::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'content' => $faker->text,
        'user_id' => function() {
            return factory(User::class)->create()->id;
        },
        'space_id' => function() {
            return \factory(Space::class)->create()->id;
        }
    ];
});



$factory->define(Activity::class, function (Faker $faker) {

    $logs = [
        'created',
        'deleted',
        'updated'
    ];

    $logName = $faker->randomElement($logs);

    $subjects = [
        Page::class,
        Space::class
    ];

    $subjectType = $faker->randomElement($subjects);
    $subject = factory($subjectType)->create();




    return [
        'log_name' => $logName,
        'subject_id' => $subject->id,
        'subject_type' => $subjectType,
        'causer_type' => User::class,
        'causer_id' => function() {
            return \factory(User::class)->create()->id;
        },
        'description' => $faker->text
    ];
});
