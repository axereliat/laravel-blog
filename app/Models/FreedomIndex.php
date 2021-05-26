<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreedomIndex extends Model
{
    use HasFactory;

    protected $fillable = ['country', 'rating'];

    protected $casts = ['rating' => 'float'];
}
