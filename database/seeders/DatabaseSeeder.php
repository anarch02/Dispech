<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Region::factory(10)->create();
        \App\Models\DronsModel::factory(50)->create();
        \App\Models\Organization::factory(10)->create();
        \App\Models\User::factory(100)->create();
        \App\Models\Drones::factory(1200)->create();
        \App\Models\Pilots::factory(100)->create();

        \App\Models\AdminUser::factory()->create([
            'name' => 'Super Admin',
            'login' => 'superAdmin',
            'phone_number' => '+9989012345678',
            'isSuperAdmin' => true,
            'password' => bcrypt('12345')
        ]);

        \App\Models\AdminUser::factory()->create([
            'name' => 'Admin',
            'isSuperAdmin' => true,
            'phone_number' => '+9989012345688',
            'login' => 'admin',
            'password' => bcrypt('12345')
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'login' => 'user',
            'organization_id' => '1',
            'password' => bcrypt('12345')
        ]);
    }
}
