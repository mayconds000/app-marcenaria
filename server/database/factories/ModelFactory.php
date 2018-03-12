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

$faker = \Faker\Factory::create('pt_BR');

$factory->define(\App\Models\User::class, function () use ($faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => app('hash')->make('secret')
    ];
});

$factory->define(\App\Models\Customer::class, function () use ($faker) {
    $isCnpj = mt_rand(0,1);
    $cnpj = $isCnpj ? $faker->cnpj : null;
    $cpf = ! $isCnpj ? $faker->cpf : null;
    return [
        'name' => $faker->company,
        'lastname' => $faker->companySuffix,
        'cnpj' => $cnpj,
        'cpf' => $cpf,
        'address' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'neightborhood' => $faker->region,
        'city' => $faker->city,
        'state' => $faker->stateAbbr,
        'phone1' => $faker->PhoneNumber,
        'phone2' => $faker->PhoneNumber,
        'observation' => $faker->text()
    ];
});

$factory->define(\App\Models\Product::class, function () use ($faker) {
    return [
        'name' => $faker->sentence(3),
        'environment_id' => mt_rand(1, 6)
    ];
});
