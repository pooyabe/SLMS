<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'مدیر',
            'last_name' => 'سیستم',
            'state' => 'Tehran',
            'city' => 'Tehran',
            'organization' => 'سازمان نقشه برداری کشور',
            'phone_number' => '09184004491',
        ]);

        User::create([
            'name' => 'ادمین',
            'last_name' => 'سایت',
            'state' => 'Gilan',
            'city' => 'Rasht',
            'organization' => 'سازمان نقشه برداری',
            'phone_number' => '09184004492',
        ]);


        // Call other seeders
        $this->call([
            RolesAndPermissionsSeeder::class,
            PanelMenusSeeder::class,
            StationsSeeder::class
        ]);
    }
}
