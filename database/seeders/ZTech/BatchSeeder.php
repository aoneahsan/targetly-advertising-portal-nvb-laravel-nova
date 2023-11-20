<?php

namespace Database\Seeders\ZTech;

use App\Models\Default\User;
use App\Models\ZTech\Batch;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ahsan = User::where('email', 'ahsan@zaions.com')->first();

        $userId = 1;
        if ($ahsan && $ahsan->id) {
            $userId = $ahsan->id;
        }

        Batch::create([
            'userId' => $userId,
            'uniqueId' => uniqid(),
            'title' => 'title',
            'description' => 'description',
            'startDate' => Carbon::now()
        ]);
    }
}
