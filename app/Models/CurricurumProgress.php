<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurricurumProgress extends Model
{
    use HasFactory;

    protected $table = 'curriculum_progress';

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function curriculumus() {
        return $this->belongsTo(Curriculumus::class);
    }
}
