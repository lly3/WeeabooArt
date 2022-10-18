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
             'name' => 'User01 API',
             'email' => 'user01@api.example.com',
             'date_of_birth' => '1990-01-01',
             'password' => bcrypt('userpass'),
         ]);
    }
}
