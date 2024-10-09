<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable  = [
      'tax_code',
      'name_company',
      'representative',
      'phone_number',
      'email_address',
      'address',
      'nick_name',
      'status'
    ];
}
