<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'ادمین',
            'last_name' => 'سیستم',
            'state' => 'Tehran',
            'city' => 'Tehran',
            'organization' => 'سازمان نقشه برداری کشور',
            'phone_number' => '09184004491',
        ]);

        // Call other seeders
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);
    }
}
