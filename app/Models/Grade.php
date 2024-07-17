<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Curriculum;


class Grade extends Model
{
    use HasFactory;

    protected $fillable = ['name']; //学年を保存できるようにする
    public function getCurriculums()
    {

    $grades=DB::table('grades')->get();
    return $grades;

    }



 //gradesテーブルと結合
    public function curriculums()
    {
        return $this->hasMany(curriculums::class, 'grade_id');
    }



    protected $table = 'grades';

    protected $primaryKey = 'id'; // プライマリキーがidであることを指定

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }       

   
}


 

