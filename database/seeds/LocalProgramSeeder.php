<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class LocalProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
//        $faker = Faker::create('App\LocalProgram');

        \DB::table('local_programs')->delete();

        for($x=0; $x<2000; $x++){
            DB::table('local_programs')->insert([
                'programId' => md5(date("Y-m-d H:i:s").rand(0,99999999)),
                'title' => rtrim($faker->sentence(rand(3, 6)), "."),
                'organisedBy' => rtrim($faker->sentence(rand(2, 5)), "."),
                'targetGroup' => rtrim($faker->sentence(rand(5, 10)), "."),
                'startDate' => $faker->dateTimeBetween('now', '+3 years'),
                'endDate' => $faker->dateTimeBetween('now', '+3 years'),
                'applicationClosingDateTime' => $faker->dateTimeBetween('now', '+3 years'),
                'nonMemberFee' => rand(1000,2000),
                'memberFee' => rand(1000,2000),
                'studentFee' => rand(1000,2000),
                'brochureUrl' => 'public/brochures/bd141fbc4195ca206c1fc474ad23410a.jpg',
                'createdBy' => $faker->unique()->safeEmail,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
