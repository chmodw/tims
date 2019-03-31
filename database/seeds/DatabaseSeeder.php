<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     * php artisan make:seeder UsersTableSeeder
     *
     */
    public function run()
    {

        $this->call(UsersTableSeeder::class);
        $this->call(DesignationTableSeeder::class);
        $this->call(SectionTableSeeder::class);
        $this->call(LocalProgramSeeder::class);

    }
}
