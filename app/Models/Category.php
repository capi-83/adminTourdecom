<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed id
 * @property mixed title
 * @property mixed description
 * @property mixed disabled
 * @property mixed created_at
 * @property mixed updated_at
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function articles()
    {
        return $this->hasMany('Article');
    }
}
