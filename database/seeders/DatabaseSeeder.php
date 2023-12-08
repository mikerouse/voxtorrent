<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(50)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        //     'password' => bcrypt('mtr66b4A')
        // ]);
        $this->call([
            RolesAndPermissionsSeeder::class,
            ConstituencyTypeSeeder::class,
            ConstituencySeeder::class,
            DecisionMakerSeeder::class,
            TorrentSeeder::class,
        ]);

    }
}