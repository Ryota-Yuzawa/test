<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'id',
        'company_name',
        'street_address',
        'representative_name',
    ];

    public function products() {
        return $this->hasMany('App\Models\Product');
    }
}
