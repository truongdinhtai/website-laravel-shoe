<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductValue extends Model
{
    use HasFactory;

    protected $table = 'products_value';
    protected $guarded = [''];

    public function productOption()
    {
        return $this->belongsTo(ProductOption::class,'product_option_id');
    }
}
