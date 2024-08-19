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
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'title' => 'required|max:100',
            'grade_id' => 'required|exists:grades,id',
            'description' => 'required|max:100',
            'url' => 'required|url',
            'alway_delivery_flg' => 'nullable|boolean',
        ], [
           'thumbnail.required' => '画像は必須です。',
            'thumbnail.image' => '画像ファイルを選択してください。',
            'thumbnail.mimes' => '画像の形式はjpeg, png, jpg, gifのいずれかである必要があります。',
            'thumbnail.max' => '画像のサイズは2MB以下でなければなりません。',
            'description.required' => 'カリキュラム説明文入力は必須です。',
            'title.max' => '授業名は100文字以内で入力してください。',
            'description.max' => 'カリキュラム説明文入力は100文字以内で入力してください。',
            'url' => '有効なURLで入力してください。',
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
            return redirect()->route('curriculum_create')->withInput(); 
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
        'title' => 'required|max:100', 
        'grade_id' => 'required|exists:grades,id',
        'description' => 'required|max:100', 
        'video_url' => 'required|url',
        'alway_delivery_flg' => 'nullable|boolean',
    ], [
        'title.required' => '授業名は必ず入力してください。',
        'title.max' => '授業名は100文字以内で入力してください。',
        'grade_id.required' => '学年を選択してください。',
        'grade_id.exists' => '選択された学年は存在しません。',
        'description.required' => 'カリキュラム説明文入力は必須です。',
        'description.max' => '授業概要は100文字以内で入力してください。',
        'video_url.required' => '動画URLは必ず入力してください。',
        'video_url.url' => '正しい形式のURLを入力してください。',
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

