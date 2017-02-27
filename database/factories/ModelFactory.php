<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Project::class, function (Faker\Generator $faker) {
    //TODO: Rewrite this
    return [
        'date' => $faker->dateTimeThisYear,
        'message' => $faker->sentence,
        'level' => $faker->numberBetween(1, 3),
        'stream_id' => $faker->numberBetween(1, 3),
    ];
});

// Factory for streams
$factory->define(App\Models\Stream::class, function (Faker\Generator $faker) {
    //TODO: Rewrite this
    return [
        'date' => $faker->dateTimeThisYear,
        'message' => $faker->sentence,
        'level' => $faker->numberBetween(1, 3),
        'stream_id' => $faker->numberBetween(1, 3),
    ];
});

//Factory for logs
$factory->define(App\Models\Log::class, function (Faker\Generator $faker) {

    $actions = [
        sprintf('User %s has logged in', 'demouser'),
        sprintf('User %s has logged out', 'demouser'),
        sprintf('User %s has made a checkin for booking id %d', 'demouser', $faker->randomNumber(3)),
        sprintf('User %s has made a checkout for booking id %s', 'demouser', $faker->randomNumber(3)),
        sprintf('User %s has made a changes in booking id %s', 'demouser', $faker->randomNumber(3)),
        sprintf('User %s has made a changes in booking id %s', 'demouser', $faker->randomNumber(3)),
    ];

    $data = [];
    $data['date']       = $faker->dateTimeThisYear;
    $data['message']    = $actions[$faker->numberBetween(0, 5)];
    $data['level']      = $faker->numberBetween(1, 3);
    $data['have_diff']  = $faker->numberBetween(0,1);
    $data['stream_id']  = $faker->numberBetween(1, 3);

    return $data;

//    return [
//        'date' => $faker->dateTimeThisYear,
//        'message' => $faker->sentence,
//        'level' => $faker->numberBetween(1, 3),
//        'stream_id' => $faker->numberBetween(1, 3),
//    ];
});

//Factory for difss
$factory->define(App\Models\Diff::class, function (Faker\Generator $faker) {

    $fields = [
        'num_people',
        'num_keys',
        'departure_time',
        'arrival_time',
        'payment_done',
        'city_tax',
    ];

    $data = [];
    $field_number = $faker->numberBetween(0,5);
    $old_value = null;
    $new_value = null;
    $data['log_id']       = $faker->numberBetween(0, 5);
    $data['field']        = $fields[$field_number];

    if ($field_number >= 0 && $field_number <= 1) {
        $old_value = $faker->numberBetween(0, 5);
        $new_value = $faker->numberBetween(0, 5);
    } elseif ($field_number > 1 && $field_number <= 2) {
        $old_value = $faker->dateTimeThisYear;
        $new_value = $faker->dateTimeThisYear;
    } elseif($field_number > 2) {
        $old_value = $faker->numberBetween(10, 120);
        $new_value = $faker->numberBetween(20, 500);
    }

    $data['old_value']    = $old_value;
    $data['new_value']    = $new_value;
    $data['notes']  = $faker->sentence;
    return $data;
});
