<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comments')->insert(
            [
                [
                    'id' => 1,
                    'user_id' => '10',
                    'article_id' => '1',
                    'text' => 'blablabla',
                    'created_at' => '2013-02-01 00:00:00',
                    'updated_at' => '2013-02-01 00:00:00'
                ],
                [
                    'id' => 2,
                    'user_id' => '10',
                    'article_id' => '1',
                    'text' => 'blablabla',
                    'created_at' => '2013-02-01 00:00:00',
                    'updated_at' => '2013-02-01 00:00:00'
                ]
            ]
        );
    }
}
