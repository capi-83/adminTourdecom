<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property string title
 * @property string slug
 * @property string seo_title
 * @property string intro_text
 * @property string intro_img
 * @property string full_text
 * @property string meta_description
 * @property string meta_keywords
 * @property mixed status
 * @property mixed allow_comment
 * @property mixed published_at
 * @property mixed deleted_at
 * @property mixed created_at
 * @property mixed updated_at
 */
class Article extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'title',
        'slug',
        'seo_title',
        'intro_text',
        'intro_img',
        'full_text',
        'meta_description',
        'meta_keywords',
        'status',
        'allow_comment',
        'image',
        'categorie_id',
        'author_id',
    ];

    /**
     * @return HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsTo
     */
    public function categorie()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function validator()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function corrector()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return Builder|HasMany
     */
    public function validComments()
    {
        return $this->comments()->whereHas('user', function ($query) {
            $query->whereDisabled(false);
        });
    }
}
