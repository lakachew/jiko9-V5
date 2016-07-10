<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Customer as Customer;

class CustomersTableSeeder extends Seeder
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
            Customer::create([
                'company_name' => $faker->name,
                'contact_name' => $faker->userName,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber,
                'address' => $faker->streetAddress,
                'created_at' => $faker->dateTimeBetween('-2 years', 'now'),
                'updated_at' => $faker->dateTimeBetween('now', '+2 years')
            ]);
        }
    }
}
