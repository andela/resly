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
        'username' => $faker->name,
        'lname' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('resly'),
        'social_id' => "{$faker->word}_$number",
    ];
});

$factory->define(Resly\Restaurateur::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->name,
        'lname' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt('resly'),
    ];
});

/*
 * Create a model factory for the general user, in this case diner.
 */
$factory->define(Resly\User::class, function (Faker\Generator $faker) {
    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'username' => $faker->userName,
        'email' => $faker->safeEmail,
        'password' => bcrypt('resly'),
        'role' => 'diner',
        'remember_token' => str_random(10),
    ];
});

$factory->define(Resly\Restaurant::class, function (Faker\Generator $faker) {
    return [
        'user_id' => factory('Resly\User')->create()->id,
        'name' => $faker->name,
        'description' => $faker->sentence,
        'email' => $faker->safeEmail,
        'opening_time' => $faker->time,
        'closing_time' => $faker->time,
        'telephone' => $faker->phoneNumber,
        'address' => $faker->address,
        'location' => $faker->name,
    ];
});

$factory->define(Resly\Table::class, function (Faker\Generator $faker) {
    $restaurateur = factory('Resly\User')->create([
        'role' => 'restaurateur',
        'password' => bcrypt('resly'),
    ]);

    $restaurant = factory('Resly\Restaurant')->create([
        'user_id' => $restaurateur->id,
    ]);
    $menuItem = factory('Resly\MenuItem')->create([
        'restaurant_id' => $restaurant->id,
    ]);
    

    return [
        'restaurant_id' => $restaurant->id,
        'seats_number' => 5,
        'label' => $faker->streetName,
        'cost' => $faker->randomFloat(null, 5, 120),
    ];
});

$factory->define(Resly\Booking::class, function (Faker\Generator $faker) {
    return [
        'scheduled_date' => $faker->date,
        'duration' => 1,
        'user_id' => factory('Resly\User')->create(['role' => 'diner'])->id,
        'table_id' => factory('Resly\Table')->create()->id,
        'cost' => $faker->randomFloat(null, 5, 120),
        'type' => $faker->word

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
