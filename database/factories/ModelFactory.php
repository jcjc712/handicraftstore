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
    static $password;// = "12345";

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Seller::class, function ($faker) {
    $trustOptions = array('trusthworthy','good','unreliable');
    return [
        'user_id' => function(){
            return factory('App\User')->create()->id;
        },
        'bio' => $faker->paragraph,
        'picture' => 'no_picture.png',
        'trust' => $trustOptions[rand(0,2)],
        'video' => null,

    ];
});

$factory->define(App\Product::class, function ($faker) {
    return [
        'categorie_id' => function(){
            return \App\Category::skip(rand(0, \App\Category::all()->count()-1))->take(1)->get()[0]->id;
        },
        'seller_id' => function(){
            return \App\Seller::skip(rand(0, \App\Seller::all()->count()-1))->take(1)->get()[0]->id;
        },
        'title' => $faker->sentence,
        'description' => $faker->paragraph,
        'stock' => rand(0, 30),
        'amount' => rand(100, 1000),
        'picture' => 'no_picture.png',
        'active' => rand(0,1),
    ];
});

$factory->define(App\Payment::class, function ($faker) {
    return [
        'user_id' => function(){
            return \App\User::skip(rand(0, \App\User::all()->count()-1))->take(1)->get()[0]->id;
        },
        'bank' => $faker->sentence,
        'complete_name' => $faker->name,
        'card' => '0001212312321332',
        'address' => $faker->paragraph,
    ];
});

$factory->define(App\Shopping::class, function ($faker) {
    $currentPayment = \App\Payment::skip(rand(0, \App\Payment::all()->count()-1))->take(1)->get()[0];
    $currentProduct = \App\Product::skip(rand(0, \App\Product::all()->count()-1))->take(1)->get()[0];
    $deliverOptions = array('pending','processed','delivered','canceled','returned');
    $paymentOptions = array('pending','processed','payed','canceled','returned');
    return [
        'user_id' => function() use($currentPayment) {
            return $currentPayment->user_id;
        },
        'product_id' => function() use($currentProduct){
            return $currentProduct->id;
        },
        'payment_id' => function() use($currentPayment){
            return $currentPayment->id;
        },
        'title' => $currentProduct->title,
        'quantity' => rand(1, 4),
        'deliver' => $deliverOptions[rand(0,4)],
        'payment' => $paymentOptions[rand(0,4)],
        'amount' => $currentProduct->amount
    ];
});
/*
php artisan db:seed
factory('App\User', 10)->create();
factory('App\Seller', 10)->create();
factory('App\Product', 40)->create();
factory('App\Payment', 5)->create();
factory('App\Shopping', 6)->create();
*/

