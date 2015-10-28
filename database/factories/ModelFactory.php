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

$factory->define(Resly\Diner::class, function (Faker\Generator $faker) {
    // prevent uniquness violations
    $number = rand(100, 1000);

    return [
        'name' => $faker->name,
        'avatar' => $faker->url,
        'fname' => $faker->name,
        'lname' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('resly'),
        'social_id' => "{$faker->word}_$number",
    ];
});

$factory->define(Resly\Restaurateur::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->name,
        'lname' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt('resly'),
    ];
});

$factory->define(Resly\Restaurant::class, function (Faker\Generator $faker) {
    return [
        'restaurateur_id' => factory('Resly\Restaurateur')->create()->id,
        'name' => $faker->name,
        'description' => $faker->sentence,
        'email' => $faker->email,
        'opening_time' => $faker->time,
        'closing_time' => $faker->time,
        'telephone' => $faker->phoneNumber,
        'address' => $faker->address,
        'location' => $faker->name,
    ];
});

$factory->define(Resly\Table::class, function (Faker\Generator $faker) {
    $restaurateur = factory('Resly\Restaurateur')->create([
        'password' => bcrypt('resly'),
    ]);

    $restaurant = factory('Resly\Restaurant')->create([
        'restaurateur_id' => $restaurateur->id,
    ]);
    $menuItem = factory('Resly\MenuItem')->create([
        'restaurant_id' => $restaurant->id,
    ]);
    $menuItemTag = factory('Resly\MenuItemTag')->create([
        'menu_item_id' => $menuItem->id,
    ]);

    return [
        'restaurant_id' => $restaurant->id,
        'seats_number' => 5,
        'name' => $faker->word,
    ];
});

$factory->define(Resly\Booking::class, function (Faker\Generator $faker) {
    return [
        'number_of_people' => rand(2, 8),
        'booking_date' => $faker->date,
        'booking_time' => $faker->time,
        'diner_id' => factory('Resly\Diner')->create()->id,
        'table_id' => factory('Resly\Table')->create()->table_id,
    ];
});

$factory->define(Resly\Category::class, function (Faker\Generator $faker) {
    $number = rand(100, 1000);

    return [
        'name' => "{$faker->word}_$number",
    ];
});

$factory->define(Resly\MenuItem::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
        'price' => $faker->randomDigit,
        'cat_id' => factory('Resly\Category')->create()->id,
        'restaurant_id' => factory('Resly\Restaurant')->create()->id,
    ];
});

$factory->define(Resly\MenuItemTag::class, function (Faker\Generator $faker) {
    return [
        'menu_item_id' => factory('Resly\MenuItem')->create()->id,
        'tag_id' => factory('Resly\Tag')->create()->id,
    ];
});

$factory->define(Resly\Tag::class, function (Faker\Generator $faker) {
    $number = rand(100, 1000);

    return [
        'name' => "{$faker->word}_$number",
    ];
});
