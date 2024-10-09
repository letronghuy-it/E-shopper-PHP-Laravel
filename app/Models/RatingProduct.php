<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RatingProduct extends Model
{
    use HasFactory;
    protected $table = 'rating_products';
    protected $fillable = [
        'rating_Product',
        'id_Product',
        'id_user',
    ];
}
