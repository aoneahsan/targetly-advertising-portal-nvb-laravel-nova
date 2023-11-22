<?php

namespace Database\Factories\ZTech;

use App\Models\Default\User;
use App\Zaions\Enums\EmailsEnum;
use App\Zaions\Helpers\ZHelpers;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ZTech\Notice>
 */
class NoticeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        ZHelpers::defaultUsers();

        $ahsan = User::where('email', EmailsEnum::defaultEmail->value)->first();

        $batchesIds = ZHelpers::checkDefaultBatchesExcise();
        
        return [
            'uniqueId' => uniqid(),
            'userId' => $ahsan->id,
            'batchId'=> collect($batchesIds)->random(),
            'title' => fake()->title(),
            'content' => fake()->text(200),
        ];
    }
}
