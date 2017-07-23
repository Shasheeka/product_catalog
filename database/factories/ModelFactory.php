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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});


$factory->define(App\Category::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'english_name' => $faker->name,
    ];
});

$factory->define(App\Brand::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'description' => $faker->text,
        'english_name' =>$faker->name,
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => '澳洲直邮 Bio Oil 百洛油 万能生物油 预防妊娠纹 125ml',
        'english_name' => $faker->name,
        'description' => $faker->name,
        'brand_id' =>$faker->randomDigit,
        'category_id' =>$faker->randomDigit,
        'price' => $faker->randomFloat(2,5,1000),
        'photo_url' =>"https://www.kiwibuy.com/media/catalog/product/1080/5367.jpg",
    ];
});