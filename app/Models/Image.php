<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function character(): BelongsTo {
        return $this->belongsTo(Character::class, 'characters_api_id', 'api_id');
    }
}
