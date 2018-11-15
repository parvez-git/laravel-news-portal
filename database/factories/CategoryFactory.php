<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {

    $category = 'Category-'.$faker->unique()->randomDigit;
    
    return [
        'name'      => $category,
        'slug'      => str_slug($category),
        'image'     => 'category.jpg',
        'status'    => $faker->boolean
    ];
});
