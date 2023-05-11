<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Quote extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $primaryKey = 'api_id';
    public $incrementing = false;

    public function character(): BelongsTo {
        return $this->belongsTo(Character::class, 'character_api_id', 'api_id');
    }
    public function movie(): BelongsTo {
        return $this->belongsTo(Character::class, 'movie_api_id', 'api_id');
    }


}
