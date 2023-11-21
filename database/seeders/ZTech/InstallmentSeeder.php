<?php

namespace Database\Seeders\ZTech;

use App\Models\ZTech\Installment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstallmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Installment::factory()->count(2)->create();
    }
}
