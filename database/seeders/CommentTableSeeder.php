<?php

namespace Database\Seeders;

use App\Models\Comment;
use Database\Factories\CommentFactory;
use Faker\Factory;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 15; $i++) {
            $article_id = rand(1,2);
            Comment::factory()->create([
                'article_id' => $article_id,
                'user_id' => rand(1, 2000),
            ]);
        }

        $faker = Factory::create();
        Comment::create([
            'article_id' => 2,
            'user_id' => 3,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'children' => [
                [
                    'article_id' => 2,
                    'user_id' => 4,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                    'children' => [
                        [
                            'article_id' => 2,
                            'user_id' => 2,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ]);
        Comment::create([
            'article_id' => 2,
            'user_id' => 6,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'children' => [
                [
                    'article_id' => 2,
                    'user_id' => 3,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                ],
                [
                    'article_id' => 2,
                    'user_id' => 6,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                    'children' => [
                        [
                            'article_id' => 2,
                            'user_id' => 3,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),

                            'children' => [
                                [
                                    'article_id' => 2,
                                    'user_id' => 6,
                                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);
        Comment::create([
            'article_id' => 1,
            'user_id' => 4,
            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
            'children' => [
                [
                    'article_id' => 1,
                    'user_id' => 5,
                    'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                    'children' => [
                        [   'article_id' => 1,
                            'user_id' => 2,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                        [
                            'article_id' => 1,
                            'user_id' => 1,
                            'body' => $faker->paragraph($nbSentences = 4, $variableNbSentences = true),
                        ],
                    ],
                ],
            ],
        ]);


    }
}
