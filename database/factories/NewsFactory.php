<?php

use Faker\Generator as Faker;

$factory->define(App\News::class, function (Faker $faker) {

    $title = $faker->sentence;

    return [

        'title'         => $title,
        'slug'          => str_slug($title),
        'details'       => $faker->paragraph,
        'image'         => 'post.jpg',
        'status'        => $faker->boolean,
        'featured'      => $faker->boolean,
        'category_id'   => $faker->numberBetween(1, 9)
    ];
});
