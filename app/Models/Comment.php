<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed id
 * @property mixed text
 * @property mixed created_at
 * @property mixed updated_at
 */
class Comment extends Model
{
    use HasFactory;

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
