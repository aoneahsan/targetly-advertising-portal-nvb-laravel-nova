<?php

namespace Database\Seeders\ZTech;

use App\Models\ZTech\Notice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Notice::factory()->count(2)->create();
    }
}
