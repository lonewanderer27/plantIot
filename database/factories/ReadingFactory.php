<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Device;

class ReadingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Get an array of all existing Device IDs
        $deviceIds = Device::pluck('id')->all();

        return [
            'device_id' => $this->faker->randomElement($deviceIds),
            'temperature' => $this->faker->randomFloat(2, -10, 40),
            'humidity' => $this->faker->randomFloat(2, 0, 100),
            'light_intensity' => $this->faker->randomFloat(2, 0, 1000),
            'soil_moisture' => $this->faker->randomFloat(2, 0, 100),
            'water_level' => $this->faker->randomFloat(2, 0, 100),
        ];
    }
}
