<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Tag::class, 20)->create();
        factory(\App\Tag::class)->create([
            'title' => 'Алкогольное опьянение',
            'description' => '',
        ]);

        factory(\App\Tag::class)->create([
            'title' => 'Наркотическое опьянение',
            'description' => '',
        ]);

        factory(\App\Tag::class)->create([
            'title' => 'Превышение допустимой скорости движения',
            'description' => '',
        ]);

        factory(\App\Tag::class)->create([
            'title' => 'Неиспользование ремней безопасности',
            'description' => '',
        ]);

        factory(\App\Tag::class)->create([
            'title' => 'Неиспользование специальных детских удерживающих средств',
            'description' => '',
        ]);

        factory(\App\Tag::class)->create([
            'title' => 'Использование неисправного транспортного средства',
            'description' => '',
        ]);

    }
}
