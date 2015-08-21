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

$factory->define(angularavel\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(angularavel\Entities\Cliente::class, function (Faker\Generator $faker) {
    return [
        'nome' => $faker->name,
        'responsavel' => $faker->name,
        'email' => $faker->email,
        'telefone' => $faker->phoneNumber,
        'endereco' => $faker->address,
        'obs' => $faker->sentence,
    ];
});

$factory->define(angularavel\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1, 10),
        'client_id' => rand(1, 10),
        'nome' => $faker->word,
        'description' => $faker->sentence,
        'progress' => rand(1, 100),
        'status' => rand(1, 3),
        'due_date' => $faker->dateTime("now")
    ];
});

$factory->define(angularavel\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 10),
        'title' => $faker->word,
        'note' => $faker->paragraph
    ];
});

$factory->define(angularavel\Entities\ProjectTask::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1, 10),
        'name' => $faker->word,
        'status' => rand(1, 3),
        'due_date' => $faker->dateTime(),
        'start_date' => $faker->dateTime()
    ];
});