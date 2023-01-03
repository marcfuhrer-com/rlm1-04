<?php

namespace Database\Factories;

use App\Models\Building;
use App\Models\Floor;
use App\Models\PublisherData;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PublisherDataFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PublisherData::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->unique()->name(),
            'building_id' => Building::factory(),
            'floor_id' => Floor::factory(),
            'view' => json_encode(["key" => $this->faker->randomNumber(5)] ),
            'ip_range' => Str::random(15),
        ];
    }
}
