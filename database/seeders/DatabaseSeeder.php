<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //! TypeSeeder must be after ProjectSeeder. Otherwise the db will crash cause based on seeder fullfill
        $this->call([TypeSeeder::class, ProjectSeeder::class, UserSeeder::class]);
    }
}
