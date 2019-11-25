<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use App\Manager;
use App\Departement;
use App\JobPosition;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

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
        'admin' => $faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
    ];

});

$factory->define(Departement::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'nbEmployee' => $faker->randomNumber($nbDigits = 2, $strict = false),
      

    ];

});

$factory->define(Manager::class, function (Faker $faker) {
    return [
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'phone' => $faker->phoneNumber,
        'status' => $faker->randomElement([Manager::ACTIVE_MANAGER,Manager::DISABLED_MANAGER]),
        'departement_id' => Departement::all()->random()->id,

    ];

});


$factory->define(JobPosition::class, function (Faker $faker) {
    return [
        'title' => $faker->jobTitle,
        'description' => $faker->paragraph(1),
        'salary' => $faker->numberBetween($min = 10000, $max = 30000),
        'location' => $faker->city,
        'status' => $faker->randomElement([JobPosition::ON,JobPosition::OFF]),
        'departement_id' => Departement::all()->random()->id,

      

    ];

});