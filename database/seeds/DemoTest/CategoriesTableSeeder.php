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
        factory(\App\Category::class, 3)->create();
        $cat1 = \App\Category::findOrFail(1);
        $cat1->marker_url = '/assets/images/marker1.png';
        $cat1->title = 'Столкновение';
        $cat1->save();

        $cat2 = \App\Category::findOrFail(2);
        $cat2->marker_url = '/assets/images/marker2.png';
        $cat2->title = 'Опрокидывание';
        $cat2->save();

        $cat3 = \App\Category::findOrFail(3);
        $cat3->marker_url = '/assets/images/marker3.png';
        $cat3->title = 'Наезд на пешехода';
        $cat3->save();

//        $cat4 = \App\Category::findOrFail(4);
//        $cat4->marker_url = '/assets/images/marker4.png';
//        $cat4->title = 'Наезд на стоящее транспортное средство';
//        $cat4->save();
//
//        $cat5 = \App\Category::findOrFail(5);
//        $cat5->marker_url = '/assets/images/marker5.png';
//        $cat5->title = 'Наезд на препятствие';
//        $cat5->save();
//
//        $cat6 = \App\Category::findOrFail(6);
//        $cat6->marker_url = '/assets/images/marker6.png';
//        $cat6->title = 'Наезд на велосипедиста';
//        $cat6->save();

//        $cat7 = \App\Category::findOrFail(7);
//        $cat7->marker_url = '/assets/images/marker7.png';
//        $cat7->title = 'Наезд на животное';
//        $cat7->save();

//        $cat8 = \App\Category::findOrFail(8);
//        $cat8->marker_url = '/assets/images/marker8.png';
//        $cat8->title = 'Иные виды ДТП';
//        $cat8->save();

    }
}
