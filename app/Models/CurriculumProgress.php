<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurriculumProgress extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
        'created_at',
        'updated_at'
    ];

    protected $table = "curricurum_progress";

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class, 'curriculums_id', 'id');
    }
}
