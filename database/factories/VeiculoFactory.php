<?php
use Faker\Generator as Faker;
use App\User;
$factory->define(App\Veiculo::class, function (Faker $faker) {
    
    return[
        'plate' => $faker->bothify('???####'),
        'renew' => $faker->word(1, true),
        'model' => $faker->words(rand(1,3),true),
        'brand' =>  $faker->word(1, true),
        'year' => $faker->year(),
        'user_id' => User::inRandomOrder()->where('role',1)->first(),
    ];
});
