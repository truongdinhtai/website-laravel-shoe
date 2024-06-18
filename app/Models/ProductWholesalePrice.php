<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWholesalePrice extends Model
{
    use HasFactory;
    protected $table = 'products_wholesale_price';
    protected $guarded = [''];

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}
