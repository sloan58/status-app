<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Status;
use App\Project;
use App\User;

class StatusTableSeeder extends Seeder {

    public function run()
    {
        $faker = Faker::create();

        $users = User::lists('id');
        $projects = Project::lists('id');

        foreach(range(1, 50) as $index)
        {
            Status::create([

                'user_id' => $faker->randomElement($users),
                'project_id' => $faker->randomElement($projects),
                'body' => $faker->sentence(),
                'completed' => $faker->boolean(),

            ]);
        }
    }

}