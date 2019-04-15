<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Category::class, 6)->create();
        $cat1 = \App\Category::findOrFail(1);
        $cat1->marker_url = '/assets/images/marker1.png';
        $cat1->save();

        $cat2 = \App\Category::findOrFail(2);
        $cat2->marker_url = '/assets/images/marker2.png';
        $cat2->save();

        $cat3 = \App\Category::findOrFail(3);
        $cat3->marker_url = '/assets/images/marker3.png';
        $cat3->save();

        $cat4 = \App\Category::findOrFail(4);
        $cat4->marker_url = '/assets/images/marker4.png';
        $cat4->save();

        $cat5 = \App\Category::findOrFail(5);
        $cat5->marker_url = '/assets/images/marker5.png';
        $cat5->save();

        $cat6 = \App\Category::findOrFail(6);
        $cat6->marker_url = '/assets/images/marker6.png';
        $cat6->save();
    }
}
