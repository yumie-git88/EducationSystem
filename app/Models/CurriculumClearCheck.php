<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumClearCheck extends Model
{
    use HasFactory;

    protected $table = 'classes_clear_checks'; //スネークケースで命名されているため指定

    protected $fillable = [ //データベースに追加や更新を許可
        'grade_id',
        'clear_flg',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
