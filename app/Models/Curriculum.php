<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums'; //テーブル指定

    protected $fillable = [ //データベースに追加や更新を許可
        'title',
        'thumbnail',
        'description',
        'video_url',
        'alway_delivery_flg',
        'grade_id',
    ];

    public function times() {
        return $this->hasMany(DeliveryTime::class);
    }

    public function progress() {
        return $this->hasMany(CurricurumProgress::class); //スペル注意
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
