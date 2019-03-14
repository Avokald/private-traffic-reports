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
        Report::create([
            'title' => 'Test title 1',
            'description' => 'Test description 1',
            'lat' => '52.279141',
            'lng' => '76.953151',
        ]);

        Report::create([
            'title' => 'Test title 2',
            'description' => 'Test description 2',
            'lat' => '52.289141',
            'lng' => '76.953151',
        ]);

        Report::create([
            'title' => 'Test title 3',
            'description' => 'Test description 3',
            'lat' => '52.269141',
            'lng' => '76.953151',
        ]);
    }
}
