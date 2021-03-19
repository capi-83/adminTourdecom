<?php


namespace App\Repositories;


use App\Models\Article;

class ArticleRepository
{
    /**
     * @return mixed
     */
    public function queryActive()
    {
        return Article::select(
            'id',
            'slug',
            'intro_img',
            'title',
            'intro_text',
            'categorie_id',
            'author_id',
            'updated_at')
            ->with('categorie:id,title')
            ->with('author:id,name')
            ->whereStatus("published");
    }

    /**
     * @return mixed
     */
    protected function queryActiveOrderByDate()
    {
        return $this->queryActive()->latest();
    }


    /**
     * @param $id
     * @return mixed
     */
    protected function getPreviousArticle($id)
    {
        return Article::select('title', 'slug')
            ->whereStatus("published")
            ->latest('id')
            ->firstWhere('id', '<', $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    protected function getNextArticle($id)
    {
        return Article::select('title', 'slug')
            ->whereStatus("published")
            ->oldest('id')
            ->firstWhere('id', '>', $id);
    }


    /**
     * @param $nbrPages
     * @param $idCategory
     * @return mixed
     */
    public function getActiveOrderByDateForCategory($nbrPages, $idCategory)
    {
        return $this->queryActiveOrderByDate()
            ->where('categorie_id','=',$idCategory)->paginate($nbrPages);
    }

    /**
     * @param $nbrPages
     * @param $author_id
     * @return mixed
     */
    public function getActiveOrderByDateForAuthor($nbrPages, $author_id)
    {
        return $this->queryActiveOrderByDate()
            ->where('author_id','=',$author_id)->paginate($nbrPages);
    }

    /**
     * @param $n
     * @param $search
     * @return mixed
     */
    public function search($n, $search)
    {
        return $this->queryActiveOrderByDate()
            ->where(function ($q) use ($search) {
                $q->where('intro_text', 'like', "%$search%")
                    ->orWhere('full_text', 'like', "%$search%")
                    ->orWhere('title', 'like', "%$search%");
            })->paginate($n);
    }

    /**
     * @param $slug
     * @return mixed
     */
    public function getArticleBySlug($slug)
    {
        // Post for slug with user, tags and categories
        $post = Article::with(
            'author:id,name,email',
            'category:title,slug'
        )
            ->whereSlug($slug)
            ->firstOrFail();
        // Previous post
        $post->previous = $this->getPreviousPost($post->id);
        // Next post
        $post->next = $this->getNextPost($post->id);
        return $post;
    }

    /**
     * @param $idCategory
     * @return mixed
     */
    public function getArticleByCategory($idCategory)
    {

        return  Article::select(
            'id',
            'slug',
            'intro_img',
            'title',
            'intro_text',
            'status',
            'categorie_id',
            'author_id')
            ->with('categorie:id,title')
            ->with('author:id,name')
            ->where('categorie_id','=',$idCategory)
            ->get();
    }

    /**
     * @param $nbrPages
     * @return mixed
     */
    public function getActiveOrderByDate($nbrPages)
    {
        return $this->queryActiveOrderByDate()->paginate($nbrPages);
    }

    //Les heros sont les 5 derniers articles créés ou modifiés
    public function getHeros()
    {
        return $this->queryActive()->with('categorie')->where('intro_img','<>',null)->latest('updated_at')->take(5)->get();
    }
}
