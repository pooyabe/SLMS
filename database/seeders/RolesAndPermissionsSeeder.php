<?php

namespace Database\Seeders;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clearing the Cache
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Defining Permissions

        // مجوزهای کلی برای چک کردن ورود و دسترسی‌های اصلی
        Permission::create(['name' => 'allow-nrp-login']);
        Permission::create(['name' => 'allow-site-login']);

        // مجوزهای منوها (Admin Dashboard)
        Permission::create(['name' => 'view-dashboard-menu-users']);


        // Create Roles

        // Admin role
        $roleAdmin = Role::create(['name' => 'site_admin']);
        
        $roleAdmin->givePermissionTo([
            'allow-site-login',
            'view-dashboard-menu-users',
        ]);

        // mobile reporter
        $roleReporter = Role::create(['name' => 'mobile_reporter']);
        $roleReporter->givePermissionTo([
            'allow-nrp-login', // این مهم ترین مجوز برای لاگین موبایله
            'allow-site-login',
        ]);

        // Give role to the first user
        $user = \App\Models\User::find(1);
        if ($user) {
            $user->assignRole(['site_admin', 'mobile_reporter']);
        }

        $user2 = \App\Models\User::find(2);
        if ($user2) {
            $user2->assignRole(['site_admin']);
        }
    }
}