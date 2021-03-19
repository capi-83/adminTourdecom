<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Debugbar;
use Illuminate\Http\Request;
use App\Http\Requests;

class IndexController extends Controller
{
    protected $articleRepository;
    protected $nbrPages;

    /**
     * IndexController constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository  = $articleRepository;
        $this->nbrPages = 4;
    }


    public function show()
    {
        $articles =  $this->articleRepository->getActiveOrderByDate($this->nbrPages);
        $heros =  $this->articleRepository->getHeros();
        DebugBar::warning($articles);
        Debugbar::warning($heros);

        return view('index', compact('articles', 'heros'));
    }
}
