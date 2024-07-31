<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
use Carbon\Carbon; //追加
use Illuminate\Database\Eloquent\Factories\Factory;

class CurriculumsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curriculums')->insert([
            [
                'title' => "授業タイトル",
                'thumbnail' => "講座内容", //カリキュラムサムネイル
                'description' => "講座の説明文 テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト",
                'video_url' => "https://www.nhk.or.jp/das/movie/D0002160/D0002160257_00000_V_000.mp4", //動画URL
                'alway_delivery_flg' => 1, //常時公開フラグ 1:公開
                'grade_id' => 1, //クラスID
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'title' => "授業タイトル",
                'thumbnail' => "講座内容", //カリキュラムサムネイル
                'description' => "講座の説明文 テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト・テスト",
                'video_url' => "https://www.nhk.or.jp/das/movie/D0002160/D0002160257_00000_V_000.mp4", //動画URL
                'alway_delivery_flg' => 0, //常時公開フラグ 1:公開
                'grade_id' => 2, //クラスID
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
        ]);
    }
}
