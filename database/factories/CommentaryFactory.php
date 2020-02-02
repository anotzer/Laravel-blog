<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Commentary::class,
    function (Faker $faker) {
        $title = $faker->sentence(rand(3, 8), true);
        $txt = $faker->realText(rand(10, 30));
        $createdAt = $faker->dateTimeBetween('-3 month',
            '-2 days');

        $data = [
            'text' => $txt,
            'post_id' => (rand(1, 50)),
            'user_id' => (rand(1, 5) == 5) ? 1 : 2,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,

        ];
        return $data;
    });
