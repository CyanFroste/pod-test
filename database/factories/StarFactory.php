<?php

namespace Database\Factories;

use App\Models\Star;
use Illuminate\Database\Eloquent\Factories\Factory;

class StarFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Star::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'ethnicity' => $this->faker->country,
            'actor' => $this->faker->boolean(),
            'cosplayer' => $this->faker->boolean(),
            'model' => $this->faker->boolean(),
            'image' => $this->faker->imageUrl(),
            'note' => $this->faker->text(),
            'extra' => json_encode([
                'email' => $this->faker->email,
                'link' => $this->faker->domainName,
            ]),
            'favorite' => $this->faker->boolean(),
        ];
    }
}
