<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $table = 'invoice_details';
    protected $fillable = [
        'id_history',
        'id_product',
        'name_product',
        'qty',
        'price',
        'total_amount',
        'image_product',

    ];
}
