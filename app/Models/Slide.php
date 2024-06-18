<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;
    protected $table = 'slides';
    protected $guarded = [''];

    const SLIDE_HOME=1;
    const SLIDE_HOME_TOP_PAY=3;
    const BG_FOOTER=5;
}
