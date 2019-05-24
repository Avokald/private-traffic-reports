<?php

use App\Report;
use Illuminate\Database\Seeder;


class ReportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Report::class)->state('test')->create([
            'title' => 'Пьяный водитель BMW выехал на встречную полосу и врезался в ВАЗ',
            'description' => 'Сегодня в 4:20 утра BMW выехал на встречную полосу и столкнулся с автомобилем ВАЗ, который въехал в кусты и металлическое ограждение, а затем опрокинулся. Экспертиза показала, что 23-летний водитель BMW был в состоянии алкогольного опьянения средней степени тяжести, а 28-летний водитель ВАЗ трезв. BMW отправлен на штрафстоянку.',
            'lat' => '52.283966',
            'lng' => '76.967178',
            'videos' => ['https://www.youtube.com/watch?v=26c8ss5NynQ'],
            'images' => ['/public/assets/images/rep1.jpg'],
        ]);

        factory(\App\Report::class)->state('test')->create([
            'title' => 'Test title 2',
            'description' => 'Test description 2',
            'lat' => '52.264723',
            'lng' => '76.969626',
            'videos' => ['https://www.youtube.com/watch?v=HEfHFsfGXjs'],
            'images' => ['/public/assets/images/404.png'],
        ]);

        factory(\App\Report::class)->state('test')->create([
            'title' => 'Test title 3',
            'description' => 'Test description 3',
            'lat' => '52.273897',
            'lng' => '76.983912',
            'videos' => [
                'https://www.youtube.com/watch?v=jsYwFizhncE',
                'https://www.youtube.com/watch?v=PFDu9oVAE-g',
                'https://www.youtube.com/watch?v=aircAruvnKk',
                'https://www.youtube.com/watch?v=3d6DsjIBzJ4',
            ],
            'images' => [],
        ]);

        factory(\App\Report::class, 500)->create();

    }
}
