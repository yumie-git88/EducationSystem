<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurricurumProgress extends Model //スペル注意
{
    use HasFactory;

    protected $table = 'curricurum_progress'; //スペル注意

    protected $fillable = [ //データベースに追加や更新を許可
        'clear_flg',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function curriculumus() {
        return $this->belongsTo(Curriculumus::class);
    }
}
