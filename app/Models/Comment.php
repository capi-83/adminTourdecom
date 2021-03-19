<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Kalnoy\Nestedset\NodeTrait;

/**
 * @property mixed id
 * @property mixed body
 * @property mixed created_at
 * @property mixed updated_at
 */
class Comment extends Model
{
    use HasFactory, Notifiable, NodeTrait;

    protected $fillable = [
        'body',
        'article_id',
        'user_id',
    ];

    /**
     * @return BelongsTo
     */
    public function article()
    {
        return $this->belongsTo('Article');
    }

    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('User');
    }
}
