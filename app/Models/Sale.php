<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Sale extends Model
{
    use HasFactory;

    protected $table = 'sales';

    protected $fillable = ['product_id'];

    public function products() {
        return $this->belongsTo('App\Models\Product');
       }
}
