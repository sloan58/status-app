<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Project;
use App\User;

class ProjectUserTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $users = User::lists('id');
        $projects = Project::lists('id');

        foreach(range(1, 50) as $index)
        {

            User::find($faker->randomElement($users))->project()->attach($faker->randomElement($projects));

        }
    }

}