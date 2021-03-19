<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Debugbar;
use Illuminate\Http\Request;
use App\Repositories\ArticleRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use App\Rights\DashboardRights;
use App\Role\RoleChecker;
use Illuminate\Contracts\Support\Renderable;

class DashboardController extends Controller
{

    protected $spec;
    protected $articleRepository;
    protected $userRepository;
    protected $categoryRepository;
    protected $commentRepository;

    /**
     * Create a new controller instance.
     *
     * @param UserRepository $userRepository
     * @param ArticleRepository $articleRepository
     * @param CategoryRepository $categoryRepository
     * @param CommentRepository $commentRepository
     */
    public function __construct(UserRepository $userRepository,
                                ArticleRepository $articleRepository,
                                CategoryRepository $categoryRepository,
                                CommentRepository $commentRepository)
    {
        $this->middleware('auth');
        $this->spec = new DashboardRights();
        $this->userRepository = $userRepository;
        $this->articleRepository = $articleRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index()
    {
        $totalUsers = $this->userRepository->getTotal();
        $disabledUsers = $this->userRepository->getTotalDisabled();
        $admins = 0;
        foreach($this->userRepository->getAll() as $u) {
            if(RoleChecker::haveAdminAccess($u)) {
                $admins ++;
            }
        }
        $enabledUsers = $this->userRepository->getTotalEnabled();

        $articlesStats = $this->getArticlesStats();

        $comments = $this->commentRepository->count();

        return view('admin.dashboard', compact(
            'totalUsers',
            'admins',
            'disabledUsers',
            'enabledUsers',
            'articlesStats',
            'comments'
        ));
    }

    protected function getArticlesStats() {
        $stats = [];
        foreach ($this->categoryRepository->getAll() as $cat){
            $stats[$cat->title]=[
                "published" => 0,
                "workInProgress"=> 0,
                "waitingForValidation"=> 0,
                "disabled" => 0];
            foreach ($this->articleRepository->getArticleByCategory($cat->id) as $articleByCat) {
                $stats[$cat->title][$articleByCat->status] = $stats[$cat->title][$articleByCat->status] + 1;
            }
        }
        return $stats;
    }
}
