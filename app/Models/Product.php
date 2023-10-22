<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
   protected $table = 'products';

   protected $fillable = [
        'id',
        'company_id',
        'product_name',
        'price',
        'stock',
        'comment',
        'img_path',
   ];

   public function company() {
    return $this->belongsTo('App\Models\Company');
   }

   public function sales() {
    return $this->hasMany('App\Models\Sale');
   }
}