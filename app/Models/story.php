<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class story extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'text',
        'Background',
        'Font',
        'file',
        'time',
    ];
}
