<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         $this->call(ReportsTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(TagsTableSeeder::class);

         foreach(\App\Report::all() as $report) {
            $report->setAttribute('category_id', \App\Category::all()->random()->id);
            $report->save();
         }

         foreach(\App\Tag::all() as $tag) {
            $tag->reports()->syncWithoutDetaching([\App\Report::all()->random()->id]);
         }

         $admin = \App\User::create([
             'name' => '1',
             'email' => 'admin@example.com',
             'password' => Hash::make('111'),
         ]);

         $user2 = \App\User::create([
             'name' => '2',
             'email' => 'user@example.com',
             'password' => Hash::make('123'),
         ]);


    }
}
