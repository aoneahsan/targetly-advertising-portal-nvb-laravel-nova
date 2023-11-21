<?php

namespace Database\Seeders\ZTech;

use App\Models\ZTech\Recovery;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecoverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Recovery::factory()->count(2)->create();
    }
}
