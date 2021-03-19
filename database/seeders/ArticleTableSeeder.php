<?php

namespace Database\Seeders;

use App\Models\Article;
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
        for ($i = 1; $i <= 20; $i++) {
            Article::factory()->create( [
                'title' => 'Article '.$i,
                'slug' => 'article-'.$i,
                'author_id' => '8',
                'corrector_id' => '9',
                'validator_id' => '7',
                'categorie_id' => rand(1,4),
                'intro_img' => "article{$i}.jpg",
                'meta_description' => 'article '.$i,
                'meta_keywords' => 'article '.$i,
                'status' => 'published',
                'allow_comment' => 'yes',
            ]);
        }
    }
}
