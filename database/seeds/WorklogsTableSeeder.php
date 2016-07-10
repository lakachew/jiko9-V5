<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Worklog as Worklog;

class WorklogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1,30) as $index)
        {
            Worklog::create([
                'user_work_id' => $faker->numberBetween(1,30),
                'description' => $faker->sentence(1),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('now', '+2 years')
            ]);
        }
    }
}
