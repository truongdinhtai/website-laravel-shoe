<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasType extends Model
{
    use HasFactory;
    protected $table = 'users_has_types';
    protected $guarded = [''];
}
