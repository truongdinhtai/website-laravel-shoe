<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $guarded = [''];

    const ORDER_TYPE_DEFAULT = 1;
    const ORDER_TYPE_WHOLESALE = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_CONFIRM = 2;
    const STATUS_WAIT_FOR_PAY = 3;
    const STATUS_PAID = 4;
    const STATUS_CANCEL = -1;

    const PAYMENT_TYPE_DEFAULT = 1 ;// nhận hàng thanh toán
    const PAYMENT_TYPE_ONLINE = 2 ;// TT Online

    public $statusConfig = [
        self::STATUS_DEFAULT => [
            'name' => 'Khởi tạo',
            'status' => self::STATUS_DEFAULT,
            'class' => 'secondary'
        ],
        self::STATUS_CONFIRM => [
            'name' => 'Đã xác nhận',
            'status' => self::STATUS_CONFIRM,
            'class' => 'primary'
        ],
        self::STATUS_WAIT_FOR_PAY => [
            'name' => 'Chờ thanh toán',
            'status' => self::STATUS_WAIT_FOR_PAY,
            'class' => 'warning'
        ],
        self::STATUS_PAID => [
            'name' => 'Đã thanh toán',
            'status' => self::STATUS_PAID,
            'class' => 'success'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Huỷ đơn',
            'status' => self::STATUS_CANCEL,
            'class' => 'danger'
        ],
    ];

    const STATUS_SHIPPING_DEFAULT = 1;
    const STATUS_SHIPPING_WAITING = 2; // chờ lấy hàng
    const STATUS_SHIPPING_WAREHOUSE = 3; // đơn hàng đang ở kho
    const STATUS_SHIPPING_DELIVERING = 4; // đang giao
    const STATUS_SHIPPING_SUCCESS = 5; // hoàn thành
    const STATUS_SHIPPING_CANCEL = -1; // huỷ

    public $statusShippingConfig = [
        self::STATUS_SHIPPING_DEFAULT => [
            'name' => 'Khởi tạo',
            'status' => self::STATUS_SHIPPING_DEFAULT,
            'class' => 'secondary'
        ],
        self::STATUS_SHIPPING_WAITING => [
            'name' => 'Chờ lấy hàng',
            'status' => self::STATUS_SHIPPING_WAITING,
            'class' => 'warning'
        ],
        self::STATUS_SHIPPING_WAREHOUSE => [
            'name' => 'Đơn hàng ở kho',
            'status' => self::STATUS_SHIPPING_WAREHOUSE,
            'class' => 'warning'
        ],
        self::STATUS_SHIPPING_DELIVERING => [
            'name' => 'Đang giao hàng',
            'status' => self::STATUS_SHIPPING_DELIVERING,
            'class' => 'success'
        ],
        self::STATUS_SHIPPING_SUCCESS => [
            'name' => 'Hoàn thành',
            'status' => self::STATUS_SHIPPING_SUCCESS,
            'class' => 'success'
        ],
        self::STATUS_SHIPPING_CANCEL => [
            'name' => 'Huỷ đơn',
            'status' => self::STATUS_SHIPPING_CANCEL,
            'class' => 'danger'
        ],
    ];

    public $setOrderType = [
        self::ORDER_TYPE_DEFAULT => [
            'name' => 'Đơn thường',
            'class' => 'info'
        ],
        self::ORDER_TYPE_WHOLESALE => [
            'name' => 'Đơn sỉ',
            'class' => 'warning'
        ],
    ];

    public $setOrderPaymentType = [
        self::PAYMENT_TYPE_DEFAULT => [
            'name' => 'Nhận hàng thanh toán',
            'class' => 'info'
        ],
        self::PAYMENT_TYPE_ONLINE => [
            'name' => 'Thanh toán Online',
            'class' => 'warning'
        ],
    ];

    public function getStatus()
    {
        return Arr::get($this->statusConfig, $this->status, []);
    }

    public function getOrderType()
    {
        return Arr::get($this->setOrderType, $this->order_type, []);
    }

    public function getOrderPaymentType()
    {
        return Arr::get($this->setOrderPaymentType, $this->payment_type, []);
    }

    public function getStatusShippingConfig()
    {
        return Arr::get($this->statusShippingConfig, $this->shipping_status , []);
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class,'order_id');
    }
}
