<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'email',
        'phone',
        'address',
        'qualification',
        'experience',
        'image',
        'paginate',
        'preview'
        // 'previousPageUrl',
        // 'nextPageUrl',


    ];

    protected $casts = [
        'images' => 'array'
    ];
}
