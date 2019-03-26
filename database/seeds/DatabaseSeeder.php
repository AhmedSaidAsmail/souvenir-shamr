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
        $this->call(UserTableSeeder::class);
        $this->call(FilterSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(SectionSeeder::class);
    }
}
