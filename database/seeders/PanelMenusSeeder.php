<?php

namespace Database\Seeders;

use App\Models\PanelMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PanelMenusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        PanelMenu::create([
            'name' => 'مدیریت منوها',
            'slug' => 'menus',
            'isMother' => true,
        ]);
        PanelMenu::create([
            'name' => 'افزودن منو',
            'slug' => 'menus-add',
            'isMother' => false,
            'mother_id' => 1,
        ]);
        PanelMenu::create([
            'name' => 'ویرایش منوها',
            'slug' => 'menus-edit',
            'isMother' => false,
            'mother_id' => 1,
        ]);


        PanelMenu::create([
            'name' => 'مدیریت کاربران',
            'slug' => 'users',
            'isMother' => true,
        ]);
        PanelMenu::create([
            'name' => 'افزودن کاربر',
            'slug' => 'users-add',
            'isMother' => false,
            'mother_id' => 4,
        ]);
        PanelMenu::create([
            'name' => 'ویرایش کاربران',
            'slug' => 'users-edit',
            'isMother' => false,
            'mother_id' => 4,
        ]);

    }
}
