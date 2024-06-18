<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomChat extends Model
{
    use HasFactory;

    protected $table = 'rooms_chats';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
