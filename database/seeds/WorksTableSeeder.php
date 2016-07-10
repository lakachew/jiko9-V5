<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Work as Work;

class WorksTableSeeder extends Seeder
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
            Work::create([
                'customer_id' => $faker->numberBetween(1,25),
                'finished' => $faker->boolean,
                'address' => $faker->streetAddress,
                'longitude' => $faker->longitude,
                'latitude' => $faker->latitude,
                'description' => $faker->sentence,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('now', '+2 years')
            ]);
        }
    }
}
