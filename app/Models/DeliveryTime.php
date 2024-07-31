<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryTime extends Model
{
    use HasFactory;

    protected $table = 'delivery_times';

    protected $fillable = [ //データベースに追加や更新を許可
        'curriculums_id',
        'delivery_from',
        'delivery_to',
    ];

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
