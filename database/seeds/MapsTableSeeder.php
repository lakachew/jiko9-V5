<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Map as Map;

class MapsTableSeeder extends Seeder
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
            Map::create([
                'worklog_id' => $faker->numberBetween(1,30),
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
                'start' => $faker->boolean,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('now', '+2 years')
            ]);
        }
    }
}
