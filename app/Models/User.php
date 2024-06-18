<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'phone',
        'address',
        'avatar',
        'is_wholesale',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const STATUS_ACTIVE = 2;
    const STATUS_DEFAULT = 1;
    const STATUS_CANCEL = -1;

    const ROLE_ADMIN = 'ADMIN';
    const ROLE_USER = 'USER';

    protected $setStatus = [
        self::STATUS_DEFAULT => [
            'name' => 'Chờ kích hoạt',
            'class' => 'badge badge-light'
        ],
        self::STATUS_CANCEL => [
            'name' => 'Khoá/ Block',
            'class' => 'badge badge-danger'
        ],
        self::STATUS_ACTIVE => [
            'name' => 'Hoạt động',
            'class' => 'badge badge-primary'
        ],
    ];

    public function getStatus()
    {
        return Arr::get($this->setStatus,$this->status, []);
    }

    public function userType()
    {
        return $this->belongsToMany(UserType::class,'users_has_types','user_id','user_type_id');
    }
}
