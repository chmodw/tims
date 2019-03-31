<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class SectionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        \DB::table('sections')->delete();

        for($x=0; $x < 50; $x++){
            DB::table('sections')->insert([
                'sectionName' => rtrim($faker->sentence(rand(1, 3)), "."),
                'createdBy' => $faker->unique()->safeEmail,
                'updatedBy' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
