<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\User; // 必要なモジュールを読込

use App\Models\Curriculum; // モデルを現在のファイルで使用する宣言
use App\Models\User;
use App\Models\DeliveryTime;
use App\Models\Grade;
use App\Models\CurriculumProgress;
use App\Models\CurriculumClearCheck;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    public function index()
    {
        $curriculums = Curriculum::all();  // 全ての情報を取得

        return view('curriculums.index', compact('curriculums')); // 一覧画面を表示
    }

    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show(Curriculum $curriculum)
    {

    }

    public function edit(Curriculum $curriculum)
    {

    }

    public function update(Request $request, Curriculum $curriculum)
    {

    }

    public function destroy(Curriculum $curriculum)
    {

    }
}
