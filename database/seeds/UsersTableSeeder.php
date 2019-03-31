<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($x=0; $x < 10; $x++){
            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
            ]);
        }
    }
}
