<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [ //データベースに追加や更新を許可
        'title',
        'posted_date',
        'article_contents',
    ];

    protected $casts = [
        'posted_date' => 'datetime', //Carbonインスタンスとして扱う
    ];
}
