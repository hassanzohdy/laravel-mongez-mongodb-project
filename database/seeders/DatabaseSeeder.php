<?php

namespace Database\Seeders;

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
        $this->call([
            \App\Modules\Users\Database\Seeders\UserSeeder::class,
            \App\Modules\Users\Database\Seeders\UsersGroupSeeder::class,
            // DatabaseSeeds: DO NOT Remove This Line.
        ]);
    }
}
