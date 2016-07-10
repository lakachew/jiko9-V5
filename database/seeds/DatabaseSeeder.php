<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //for not exceeding our limited data whenever we run the seeder
        /*\App\Customer::truncate();
        \App\Work::truncate();
        \App\UserWork::truncate();
        \App\Worklog::truncate();*/

        //or we can also use this
        //DB::table('worklogs')->truncate();

        /**
         * calle's the WorklogsTableSeeder
         */
        $this->call(CustomersTableSeeder::class);
        $this->call(WorksTableSeeder::class);
        $this->call(UserWorkTableSeeder::class);
        $this->call(WorklogsTableSeeder::class);
        $this->call(MapsTableSeeder::class);
    }
}
