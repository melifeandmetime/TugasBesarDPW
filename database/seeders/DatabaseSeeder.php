<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        User::create([
            'name' => 'Aldi Dan Zidan',
            'email' => 'alzi@gmail.com',
            'password' => bcrypt('12345')
        ]);

        Category::create([
            'nama_kategori' => 'Sabun'
        ]);
        Category::create([
            'nama_kategori' => 'Sampo'
        ]);
        Category::create([
            'nama_kategori' => 'Mie Instant'
        ]);
        Category::create([
            'nama_kategori' => 'Minyak'
        ]);
        Category::create([
            'nama_kategori' => 'Bumbu'
        ]);
    }
}
