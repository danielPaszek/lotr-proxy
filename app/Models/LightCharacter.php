<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LightCharacter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'api_id';
    public $incrementing = false;
}
