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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Admin Distro',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        $categories = ['Atasan', 'Bawahan', 'Outerwear', 'Topi', 'Aksesoris'];
        foreach ($categories as $cat) \App\Models\Category::create(['name' => $cat]);

        $colors = ['Hitam', 'Putih', 'Abu-abu', 'Biru Navy', 'Coklat', 'Merah', 'Hijau', 'Hijau Army', 'Cream'];
        foreach ($colors as $c) \App\Models\Attribute::create(['type' => 'color', 'name' => $c]);

        $materials = ['Katun', 'Denim', 'Kulit', 'Rajut'];
        foreach ($materials as $m) \App\Models\Attribute::create(['type' => 'material', 'name' => $m]);

        $themes = ['Casual', 'Formal', 'Vintage 90s', 'Streetwear', 'Sporty'];
        foreach ($themes as $t) \App\Models\Attribute::create(['type' => 'theme', 'name' => $t]);
    }
}
