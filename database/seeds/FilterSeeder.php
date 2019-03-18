<?php

use Illuminate\Database\Seeder;

class FilterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Filter::class, 10)->create()->each(function ($filter) {
            $filter->items()->saveMany(factory(App\Models\FilterItem::class,3)->make());
        });
    }
}
