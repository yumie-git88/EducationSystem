<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    public function times() {
        return $this->hasMany(DeliveryTime::class);
    }

    public function progress() {
        return $this->hasMany(CurriculumProgress::class);
    }

    public function grade() {
        return $this->belongsTo(Grade::class);
    }
}
