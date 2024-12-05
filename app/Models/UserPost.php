<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPost extends Model
{
    protected $fillable = [
        'user_id',
        'content',
        'view_count',
        'is_public',
        'likes',
        'comments',
    ];


    
}
