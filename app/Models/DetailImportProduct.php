<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailImportProduct extends Model
{
    use HasFactory;
    protected $table = 'detail_import_products';
    protected $fillable = [
        'id_product',
        'name_product',
        'quantity_import',
        'price_import',
        'Total_amount',
        'id_import_product',
        'note_import_product',
        'status',
    ];
}
