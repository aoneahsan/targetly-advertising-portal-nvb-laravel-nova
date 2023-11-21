<?php

namespace Database\Factories\ZTech;

use App\Models\Default\User;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Default\Batch>
 */
class BatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        ZHelpers::checkDefaultUserExcise();

        $ahsan = User::where('email', 'ahsan@zaions.com')->first();

        return [
            'uniqueId' => uniqid(),
            'userId' => $ahsan->id,
            'title' => fake()->title(),
            'description' => fake()->text(400),
            'startDate' => now(),
        ];
    }
}
