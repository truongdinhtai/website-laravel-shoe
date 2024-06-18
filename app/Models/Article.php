<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'articles';
    protected $guarded = [''];

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class,'articles_tags','article_id','tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
