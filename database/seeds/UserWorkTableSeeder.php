<?php

use Illuminate\Database\Seeder;
use \App\UserWork as UserWork;
use Faker\Factory as Faker;

class UserWorkTableSeeder extends Seeder
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
            UserWork::create([
                'user_id' => $faker->numberBetween(1,10),
                'work_id' => $faker->numberBetween(1,30),
                'work_customer_id' => $faker->numberBetween(1,30),
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('now', '+2 years')

            ]);
        }
    }
}
