<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\MyTask;
use Faker\Generator as Faker;

$factory->define(MyTask::class, function (Faker $faker) {
    return [
        'name'=> rtrim($faker->sentence(rand(2,3)),"."), //will remoove . at the end of sentence
        'description'=> $faker->paragraphs(rand(2,5),true),
        'startDate'=>date($format = 'Y-m-d'),
        'dueDate'=> date($format = 'Y-m-d'),
        'is_done'=> $faker->boolean(),
        'user_id'=> App\User::pluck('id')->random(), 
    ];
});
