<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * @var array
     */
    protected $tables = [
        'users',
        'projects',
        'project_user',
        'statuses',
        'language',
        'permissions',
        'role',
        'permission_role'
    ];

    /**
     * @var array
     */
    protected $seeders = [
        'UsersTableSeeder',
        'ProjectTableSeeder',
        'ProjectUserTableSeeder',
        'StatusTableSeeder',
        'LanguagesTableSeeder',
        'RolesTableSeeder',
        'PermissionsTableSeeder',

    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->cleanDatabase();

        foreach($this->seeders as $seedClass)
        {

            $this->call($seedClass);

        }

    }

    /**
     * Clean out the database for a new seed generation
     */
    private function cleanDatabase()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach($this->tables as $table)
        {

            DB::table($table)->truncate();

        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');


    }

}
