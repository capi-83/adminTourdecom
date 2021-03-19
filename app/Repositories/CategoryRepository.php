<?php


namespace App\Repositories;


use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;

class CategoryRepository
{

    /**
     * @return Category[]|Collection
     */
    public function getAll() {
        return Category::all();
    }
}
