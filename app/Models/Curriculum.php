<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curriculum extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $table = "curriculums";

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function curricurum_progress()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id', 'id');
    }

    public function delivery_times()
    {
        return $this->hasMany(CurriculumProgress::class, 'curriculums_id', 'id');
    }
}
