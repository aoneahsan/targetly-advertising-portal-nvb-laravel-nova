<?php

namespace Database\Seeders\ZTech;

use App\Models\ZTech\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ReceiptSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Receipt::factory()->count(2)->create();
    }
}
