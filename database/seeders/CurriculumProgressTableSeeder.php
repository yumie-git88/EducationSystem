<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加

class CurriculumProgressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curricurum_progress')->insert([ //スペル注意
            [
                'curriculumus_id' => 1, //スペル注意
                'users_id' => 1,
                'clear_flg' => 0, //未クリア
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'curriculumus_id' => 2, //スペル注意
                'users_id' => 1,
                'clear_flg' => 1, //クリア
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'curriculumus_id' => 3, //スペル注意
                'users_id' => 1,
                'clear_flg' => 1, //クリア
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
        ]);
    }
}
