<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogComent extends Model
{
    use HasFactory;
    protected $table = 'blog_coments';
    protected $fillable = [
        'comment',
        'id_blog',
        'id_user',
        'avatar',
        'name',
        'level'
    ];
}
