<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curriculum; 

class DeliveryTime extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_from',
        'delivery_to',
        'curriculums_id', // モデルにカラムを追加する
    ];

    // カリキュラムとのリレーション
    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id', 'id');
    }
}
