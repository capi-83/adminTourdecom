<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert(
            [
                [
                    'id' => 1,
                    'title' => 'Article 1',
                    'author_id' => '8',
                    'corrector_id' => '9',
                    'validator_id' => '7',
                    'categorie_id' => '1',
                    'intro_text' => 'Intro 1',
                    'intro_img' => '',
                    'full_text' => 'blablabla sdsdfdfs d sdfsf sdfssdsff sdf ',
                    'status' => 'published',
                    'allow_comment' => 'yes',
                    'published_at' => '2020-02-01 00:00:00',
                    'updated_at' => '2020-02-01 00:00:00',
                    'deleted_at' => '2020-02-01 00:00:00',
                    'updated_at' => '2020-02-01 00:00:00'
                ],
                [
                    'id' => 2,
                    'title' => 'Article 2',
                    'author_id' => '8',
                    'corrector_id' => null,
                    'validator_id' => null,
                    'categorie_id' => '1',
                    'intro_text' => 'Intro 2',
                    'intro_img' => '',
                    'full_text' => 'blablabla sdsdfdfs d sdfsf sdfssdsff sdf ',
                    'status' => 'workInProgress',
                    'allow_comment' => 'yes',
                    'published_at' => '2020-02-02 00:00:00',
                    'updated_at' => '2020-02-02 00:00:00',
                    'deleted_at' => '2020-02-02 00:00:00',
                    'updated_at' => '2020-02-02 00:00:00'
                ],
            ]
        );
    }
}
