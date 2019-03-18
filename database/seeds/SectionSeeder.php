<?php

use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Section::class, 10)->create()->each(function ($section) {
            $section->detail()->save(factory(App\Models\SectionDetail::class)->make());
        });
        $brands = \App\Models\Brand::all();
        \App\Models\Section::all()->each(function ($section) use ($brands) {
            $section->brands()->attach(
                $brands->random(rand(1, 3))
                    ->pluck('id')
                    ->toArray()
            );
        });
    }
}
