<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);

//        for($x=0; $x<10; $x++) {
            DB::table('organisations')->insert([
                'name' => rtrim($faker->sentence(rand(1, 2)), "."),
                'organisation_id' => md5('chamodya'),
                'created_by' => $faker->unique()->safeEmail,
            ]);
//        }
//
        \DB::table('local_programs')->delete();

        for($x=0; $x<2000; $x++){
            DB::table('local_programs')->insert([
                'program_id' => md5(date("Y-m-d H:i:s").rand(0,99999999)),
                'program_title' => rtrim($faker->sentence(rand(3, 6)), "."),
                'organised_by_id' =>  md5('chamodya'),
                'target_group' => rtrim($faker->sentence(rand(5, 10)), "."),
                'start_date' => $faker->dateTimeBetween('now', '+3 years'),
                'application_closing_date_time' => $faker->dateTimeBetween('now', '+3 years'),
                'nature_of_the_employment' => 'Permanent',
                'employee_category' => 'Technical',
                'venue' => 'Main Hall',
                'is_long_term' => 'true',
                'program_fee' => rand(1000,2000),
                'duration' => rand(1,6),
                'non_member_fee' => rand(1000,2000),
                'member_fee' => rand(1000,2000),
                'student_fee' => rand(1000,2000),
                'brochure_url' => 'bd141fbc4195ca206c1fc474ad23410a.jpg',
                'created_by' => $faker->unique()->safeEmail,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
    }
}

}
