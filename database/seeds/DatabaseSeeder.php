<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('AdminSeeder');


    }

}

class AdminSeeder extends Seeder {

    public function run()
    {
        /**
         * Add a Admin Account
         */

        $random_password = rand(100000, 999999);

        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt($random_password)
        ]);

                                                
        $this->command->info('Admin Account Created. Admin account Password is '. $random_password);
    }

}

class DocumentConfigurationSeeder extends Seeder {

    public function run()
    {
        /**
         * Create variables for documents
         */
        DB::table('configurations')->insert([
            'name' => 'LocalProgramVariables',
            'data' =>
                Serialize([
                    ''
                ])
            ,
            'created_by' => 'Database Seeder'
        ]);
        $this->command->info('Local program document variables created');

        DB::table('configurations')->insert([
            'name' => 'LocalProgramVariables',
            'data' => '',
            'created_by' => 'Database Seeder'
        ]);
        $this->command->info('Foreign program document variables created');

        DB::table('configurations')->insert([
            'name' => 'LocalProgramVariables',
            'data' => '',
            'created_by' => 'Database Seeder'
        ]);
        $this->command->info('Post Graduation program document variables created');

        DB::table('configurations')->insert([
            'name' => 'LocalProgramVariables',
            'data' => '',
            'created_by' => 'Database Seeder'
        ]);
        $this->command->info('In House program document variables created');

        $this->command->info('Admin Account Created !');
    }

}