<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\User;

class DatabaseSeeder extends Seeder {

    public function run()
    {
        $this->call('PermissionTableSeeder');
        $this->call('AdminSeeder');

    }

}

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'Role-list',
            'Role-show',
            'Role-create',
            'Role-edit',
            'Role-delete',

            'User-list',
            'User-show',
            'User-create',
            'User-edit',
            'User-delete',

            'program-list',
            'program-show',
            'program-create',
            'program-edit',
            'program-delete',
            'program-generate docs',

            'Employee-list',
            'Employee-show',

            'Trainee-list',
            'Trainee-show',
            'Trainee-create',
            'Trainee-edit',
            'Trainee-delete',

            'Template-list',
            'Template-show',
            'Template-create',
            'Template-edit',
            'Template-delete',

            'Document-list',
            'Document-show',
            'Document-create',
            'Document-edit',
            'Document-delete',

            'Change-username',
            'Change-password'

        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

    }
}

class AdminSeeder extends Seeder {

    public function run()
    {
        /**
         * Create First User role for manage users and user roles
         */
        $role = Role::create(['name' => 'User-Manager']);
        $role->syncPermissions([1,2,3,4,5,6,7,8,9,10]);
        /**
         * Add a Admin Account
         */

        $random_password = rand(100000, 999999);

        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt($random_password)
        ]);
        $user->assignRole(['User-Manager']);


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