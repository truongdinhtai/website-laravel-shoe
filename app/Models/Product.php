<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $guarded = [''];

    const STATUS_DEFAULT = 1;
    const STATUS_SUCCESS = 2;
    const STATUS_CANCEL = -1;
    const STATUS_FINISH = 3;

    public $setStatus = [
        self::STATUS_DEFAULT => [
            'name' => 'Khởi tạo',
            'class' => 'badge badge-light'
        ],
        self::STATUS_SUCCESS => [
            'name' => 'Active',
            'class' => 'badge badge-primary bg-primary'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Huỷ bỏ',
            'class' => 'badge badge-danger'
        ],
        self::STATUS_FINISH => [
            'name' => 'Hoàn thành',
            'class' => 'badge badge-success bg-success'
        ],
    ];

    public function getStatus()
    {
        return Arr::get($this->setStatus,$this->status, []);
    }

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function province()
    {
        return $this->belongsTo(Province::class,'province_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class,'district_id');
    }

    public function ward()
    {
        return $this->belongsTo(Ward::class,'ward_id');
    }

    public function wholesale()
    {
        return $this->hasMany(ProductWholesalePrice::class,'product_id');
    }
}
