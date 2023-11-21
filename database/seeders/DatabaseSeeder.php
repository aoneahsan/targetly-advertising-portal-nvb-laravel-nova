<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Database\Seeders\Default\AttachmentSeeder;
use Database\Seeders\Default\CommentSeeder;
use Database\Seeders\Default\HistorySeeder;
use Database\Seeders\Default\RolePermissionsSeeder;
use Database\Seeders\Default\TaskSeeder;
use Database\Seeders\Default\UserSeeder;
use Database\Seeders\ZLink\SocialMedia\PostSeeder;
use Database\Seeders\ZTech\BatchSeeder;
use Database\Seeders\ZTech\InstallmentSeeder;
use Database\Seeders\ZTech\NoticeSeeder;
use Database\Seeders\ZTech\ReceiptSeeder;
use Database\Seeders\ZTech\RecoverySeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Default DB Seeders
            RolePermissionsSeeder::class,
            UserSeeder::class,
            TaskSeeder::class,
            HistorySeeder::class,
            CommentSeeder::class,
            AttachmentSeeder::class,

            // ----------------- ZTech Project DB Seeders -----------------
            BatchSeeder::class,
            NoticeSeeder::class,
            ReceiptSeeder::class,
            RecoverySeeder::class,
            InstallmentSeeder::class
        ]);
    }
}
