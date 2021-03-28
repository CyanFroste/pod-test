<?php

namespace Database\Factories;

use App\Models\Studio;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudioFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Studio::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->name,
            'hentai' => $this->faker->boolean(),
            'movie' => $this->faker->boolean(),
            'note' => $this->faker->text(),
            'extra' => json_encode([
                'email' => $this->faker->email,
                'link' => $this->faker->domainName,
            ]),
            'favorite' => $this->faker->boolean(),
        ];
    }
}
