<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [ //データベースに追加や更新を許可
        'image',
    ];

    // protected $casts = [
    //     'image' => 'image', //Carbonインスタンスとして扱う
    // ];
}
