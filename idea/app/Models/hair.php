<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hair extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'age',
        'color'
    ];
}
