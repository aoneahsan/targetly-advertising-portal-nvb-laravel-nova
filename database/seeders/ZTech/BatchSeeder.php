<?php

namespace Database\Seeders\ZTech;

use App\Models\Default\User;
use App\Models\ZTech\Batch;
use App\Zaions\Helpers\ZHelpers;
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
        Batch::factory()->count(2)->create();
    }
}
