<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    const FIRST_RANDOM_TAGS = [
        "api",
        "json",
        "schema",
        "node",
        "github",
        "rest"
    ];

    const SECOND_RANDOM_TAGS = [
        "organization", 
        "planning",
        "collaboration",
        "writing",
        "calendar"
    ];

    protected $model = User::class;

    
    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(1,2);   
        return [
            'title'   => $this->faker->title,
            'author'  => $this->faker->name,
            'content' => $this->faker->text,
            'tags'    => $randomNumber == 1 ? self::FIRST_RANDOM_TAGS : self::SECOND_RANDOM_TAGS,
        ];
    }
}
