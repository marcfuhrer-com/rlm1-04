<?php

namespace Database\Factories;

use App\Models\Accesses;
use App\Models\PublisherData;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AccessesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Accesses::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'publisher_data_id' => PublisherData::factory(),
            'creates' => $this->faker->boolean,
            'reads' => $this->faker->boolean,
            'updates' => $this->faker->boolean,
            'deletes' => $this->faker->boolean,
            'subscribes' => $this->faker->boolean,
        ];
    }
}
