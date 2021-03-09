<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string title
 * @property string intro_text
 * @property string intro_img
 * @property string full_text
 * @property mixed status
 * @property mixed allow_comment
 * @property mixed published_at
 * @property mixed deleted_at
 * @property mixed created_at
 * @property mixed updated_at
 */
class Article extends Model
{
    use HasFactory;

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany('Comment');
    }

    /**
     * @return BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo('Categorie');
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return BelongsTo
     */
    public function validator()
    {
        return $this->belongsTo('User');
    }

    /**
     * @return BelongsTo
     */
    public function corrector()
    {
        return $this->belongsTo('User');
    }
}
