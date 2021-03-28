<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Movie::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'code' => $this->faker->unique()->userName,
            'name' => $this->faker->unique()->name,
            'origin' => $this->faker->country,
            'note' => $this->faker->text(),
            'extra' => json_encode([
                'email' => $this->faker->email,
                'link' => $this->faker->domainName,
            ]),
            'favorite' => $this->faker->boolean(),
        ];
    }
}
