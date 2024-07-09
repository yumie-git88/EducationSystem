<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\CurriculumProgress;
use Illuminate\Support\Facades\Auth;

class ProgressController extends Controller
{
    public function showProgress()
    {
        $id = Auth::id();
        $user = User::with('grade')->find($id);
        $grades = Grade::all();
        $curriculums = Curriculum::all();
        $curriculum_progress = CurriculumProgress::where('users_id', $id)->get();

        return view('user.curriculum_progress', compact('user', 'grades', 'curriculums', 'curriculum_progress'));
    }
}