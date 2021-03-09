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
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ],
                [
                    'id' => 2,
                    'title' => 'Communauté',
                    'description' => 'blablabla',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ],
                [
                    'id' => 3,
                    'title' => 'Judge',
                    'description' => 'blablabla',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ],
                [
                    'id' => 4,
                    'title' => 'La Tour',
                    'description' => 'blablabla',
                    'created_at' => new \DateTime(),
                    'updated_at' => new \DateTime()
                ]
            ]
        );
    }
}
