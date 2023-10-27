<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
   protected $table = 'products';

   protected $fillable = ['product_name', 'company_id', 'price', 'stock', 'comment', 'img_path'];

    public function getAllProducts($keyword, $company_name)
    {
        $query = self::query();

        if (!empty($keyword)) {
            $query->where('product_name', 'like', "%{$keyword}%");
        }

        if ($company_name) {
            $query->where('company_id', $company_name);
        }

        return $query->get();
    }

    public function storeProduct($data)
    {
        return self::create($data);
    }

    public function findProduct($id)
    {
        return self::find($id);
    }

    public function updateProduct($id, $data)
    {
        $product = self::find($id);
        $product->fill($data);
        $product->save();
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = self::find($id);
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

   public function company() {
    return $this->belongsTo('App\Models\Company');
   }

   public function sales() {
    return $this->hasMany('App\Models\Sale');
   }
}