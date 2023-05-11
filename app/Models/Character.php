<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Character extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function quotes(): HasMany {
        return $this->hasMany(Quote::class);
    }
    public function images(): HasMany {
        return $this->hasMany(Image::class, 'characters_api_id', 'api_id');
    }
}
