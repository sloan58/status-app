<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Project;
use App\User;

class ProjectTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();
        $users = User::lists('id');

        foreach(range(1, 50) as $index)
        {
            Project::create([

                'created_by' => $faker->randomElement($users),
                'last_updated_by' => $faker->randomElement($users),
                'name' => $faker->unique()->word

            ]);
        }
    }

}