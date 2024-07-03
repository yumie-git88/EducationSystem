<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    public function users() {
        return $this->hasMany(User::class);
    }

    public function curriculumus() {
        return $this->hasMany(Curriculumus::class);
    }

    public function checks() {
        return $this->hasMany(CurriculumClearCheck::class);
    }
}
