<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorieTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'DeckTech',
                    'description' => 'blablabla',
                    'slug' => 'deck-tech'
                ],
                [
                    'id' => 2,
                    'title' => 'Communauté',
                    'slug' => 'communaute',
                    'description' => 'blablabla'
                ],
                [
                    'id' => 3,
                    'title' => 'Judge',
                    'slug' => 'judge',
                    'description' => 'blablabla'
                ],
                [
                    'id' => 4,
                    'title' => 'La Tour',
                    'slug' => 'la-tour',
                    'description' => 'blablabla'
                ]
            ]
        );
    }
}
