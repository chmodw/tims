<?php

use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        \DB::table('designations')->delete();

        for($x=0; $x < 50; $x++){
            DB::table('designations')->insert([
                'designationName' => rtrim($faker->sentence(rand(1, 3)), "."),
                'createdBy' => $faker->unique()->safeEmail,
                'updatedBy' => null,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ]);
        }
    }
}
