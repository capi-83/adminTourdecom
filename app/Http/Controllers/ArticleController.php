<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Repositories\ArticleRepository;
use App\Rights\ArticleRights;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    protected $spec;
    protected $articleRepository;

    /**
     * Create a new controller instance.
     *
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Article  $article
     * @return Response
     */
    public function show(Article $article)
    {
        //
    }
}
