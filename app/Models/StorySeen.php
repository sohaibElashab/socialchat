<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StorySeen extends Model
{
    use HasFactory;
    protected $fillable = [
        'story_id',
        'user_id',
        'status',
    ];
}
