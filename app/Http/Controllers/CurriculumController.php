<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Grade;
use App\Models\Curriculum;
use App\Models\DeliveryTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CurriculumController extends Controller
{
    protected $table = 'curriculums';

    public function list()
    {
        $grades = Grade::all();
        return view('curriculum_list', compact('grades'));
    }



    // 新しい授業登録
    public function newList(Request $request)
    {
        $grades = Grade::all();

        if ($request->isMethod('post')) {
            $request->validate([
                'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'title' => 'required',
                'grade_id' => 'required|exists:grades,id',
                'description' => 'nullable',
                'url' => 'required|url',
                'alway_delivery_flg' => 'nullable|boolean',
            ]);

            $productData = [
                'title' => $request->input('title'),
                'grade_id' => $request->input('grade_id'),
                'description' => $request->input('description'),
                'video_url' => $request->input('url'),
                'alway_delivery_flg' => $request->has('alway_delivery_flg') ? true : false,
            ];

            if ($request->hasFile('thumbnail')) {
                $image = $request->file('thumbnail');
                $file_name = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $productData['thumbnail'] = 'storage/images/' . $file_name;
            }

            DB::beginTransaction();
            try {
                $curriculum = Curriculum::create($productData);
                DB::commit();
                return redirect()->route('curriculum_list')->with('success', '授業が登録されました。');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => '授業の登録に失敗しました。']);
            }
        }

        return view('curriculum_create', compact('grades'));
    }


    //選択した学年に対応する授業表示
    public function showCourses($grade_id)
    {
        try {
            $grade = Grade::findOrFail($grade_id);
            $curriculums = Curriculum::where('grade_id', $grade_id)->with('deliveryTimes')->get();
    
            foreach ($curriculums as $curriculum) {
                $curriculum->delivery_text = $curriculum->alway_delivery_flg ? '常時公開' : '配信日時設定';
            }
    
            return view('curriculum_list', [
                'grade' => $grade,
                'curriculums' => $curriculums,
                'grades' => Grade::all(),
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => '学年に対応する授業が見つかりませんでした。']);
        }
    }


    //授業内容修正
    public function edit($id)
    {
        $curriculum = Curriculum::find($id);
        $grades = Grade::all();
        return view('curriculum_edit', compact('curriculum', 'grades'));
    }



  //授業内容修正したやつを登録
  public function update(Request $request, $id)
  {
      $request->validate([
          'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
          'title' => 'required',
          'grade_id' => 'required|exists:grades,id',
          'description' => 'nullable',
          'video_url' => 'required|url',
          'alway_delivery_flg' => 'nullable|boolean',
      ]);

      $curriculum = Curriculum::findOrFail($id);

      $curriculum->title = $request->input('title');
      $curriculum->grade_id = $request->input('grade_id');
      $curriculum->description = $request->input('description');
      $curriculum->video_url = $request->input('video_url');
      $curriculum->alway_delivery_flg = $request->has('alway_delivery_flg') ? true : false;

      if ($request->hasFile('thumbnail')) {
          $image = $request->file('thumbnail');
          $file_name = time() . '_' . $image->getClientOriginalName();
          $image->storeAs('public/images', $file_name);
          // Delete previous image if exists
          if ($curriculum->thumbnail && Storage::exists($curriculum->thumbnail)) {
              Storage::delete($curriculum->thumbnail);
          }
          $curriculum->thumbnail = 'storage/images/' . $file_name;
      }

      $curriculum->save();

      return redirect()->route('curriculum_list')->with('success', '授業が更新されました。');
  }


 

}

