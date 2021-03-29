<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int id
 * @property string commander
 * @property string decklist
 * @property mixed color
 */
class CommanderMix extends Model
{
    use HasFactory;
    public $timestamps = false;
}
