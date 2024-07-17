<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Grade;
use App\Models\DeliveryTime;

class Curriculum extends Model
{
    use HasFactory;

    protected $table = 'curriculums';

    protected $fillable = ['title', 'grade_id', 'description', 'thumbnail', 'alway_delivery_flg', 'video_url' ];

    public $timestamps = false;

    // Curriculumモデルがgradesテーブルとリレーション関係を結ぶためのメソッド
    public function grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id', 'id');
    }

    public function getCurriculum()
    {
        // テーブルからデータを取得
        $curriculum = DB::table('curriculums')
            ->join('grades', 'curriculums.grades_id', '=', 'grades.id')
            ->select('curriculums.*', 'grades.name as name')
            ->paginate(5);
        return $curriculum;
    }


    //登録
    public function registcurriculum_create($thumbnail)
    {
        DB::table('curriculums')->insert([
            'thumbnail' => $thumbnail
        ]);
    }

    public function registcurriculums($data)
    {
        // 登録処理
        DB::table('curriculums')->insert([
            'thumbnail' => $data['thumbnail']
        ]);
    }

    //授業登録
    public function shownewList(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'title' => 'required',
                'thumbnail' =>  'nullable|image',
                'description' => 'required|numeric',
                'video_url' => 'required',
                'alway_delivery_flg' => 'nullable',
                'grade_id' =>  'required|numeric',
            ]);
            \Log::info('Request data:', $request->all());

            $grades = Grade::firstOrCreate(['name' => $request->grades_name]);
            $curriculumsData = [
                'title' => $request->input('title'),
                'grade_id' => $request->input('grade_id'),
                'description' => $request->input('description'),
                'alway_delivery_flg' => $request->input('alway_delivery_flg'),
                'video_url' => $request->input('url'), 
             ];

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $curriculumsData['img_path'] = 'storage/images/' . $file_name;
            }

            DB::beginTransaction();
            try {
                $curriculums = Curriculum::create($curriculumsData);
                DB::commit();
                return redirect()->route('curriculum_list')->with('success', '商品情報が登録されました。');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->withErrors(['error' => '商品情報の登録に失敗しました。']);
            }
        }

        return view('curriculum_create');
    }

    //配信時間のやつ
    public function deliveryTimes()
    {
        return $this->hasMany(DeliveryTime::class, 'curriculums_id', 'id');
    }


}