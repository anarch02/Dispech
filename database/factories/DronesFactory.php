<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DronsModel;
use App\Models\Organization;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Drones>
 */
class DronesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'organization_id' => Organization::query()->inRandomOrder()->value('id'),
            'drons_model_id' => DronsModel::query()->inRandomOrder()->value('id'),
            'id_number'=> $this->faker->phoneNumber(),
        ];
    }
}
