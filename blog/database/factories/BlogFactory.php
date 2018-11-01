<?php

use Faker\Generator as Faker;

$factory->define(App\Blog::class, function (Faker $faker) {
    return [
        'content'=>$faker->text(200),
        'img'=>$faker->imageUrl(600,400),
        'title'=>$faker->text(10),
        'user_id'=>$faker->randomElement([1,2,3,4,5])
    ];
});
