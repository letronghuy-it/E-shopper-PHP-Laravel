<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewProduct extends Model
{
    use HasFactory;
    protected $table = 'review_products';
    protected $fillable = [
            'id_product',
            'id_user',
            'name_user',
            'avatar_user',
            'review',
    ];
}
