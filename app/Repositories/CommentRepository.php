<?php


namespace App\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

class CommentRepository
{

    /**
     * @return Comment[]|Collection
     */
    public function getAll() {
        return Comment::all();
    }

    public function count() {
        return $this->getAll()->count();
    }

}
