<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportProduct extends Model
{
    use HasFactory;
    protected $table = 'import_products';
    protected $fillable = [
        'id_suppliers',
        'total_imports',
        'code_import_product',
        'day_import',
        'id_user',
    ];
}
