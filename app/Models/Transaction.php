<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = [''];

    const STATUS_DEFAULT = 1;
    const STATUS_CONFIRM = 2;
    const STATUS_WAIT_FOR_PAY = 3;
    const STATUS_PAID = 4;
    const STATUS_CANCEL = -1;

    public $statusConfig = [
        self::STATUS_DEFAULT => [
            'name' => 'Khởi tạo',
            'status' => self::STATUS_DEFAULT,
            'class' => 'default'
        ],
        self::STATUS_CONFIRM => [
            'name' => 'Đã xác nhận',
            'status' => self::STATUS_CONFIRM,
            'class' => 'default'
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

    public function getStatus()
    {
        return Arr::get($this->statusConfig, $this->status, []);
    }
}
