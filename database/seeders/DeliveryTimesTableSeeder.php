<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加
// use Faker\Provider\DateTime; // 追加
// use Carbon\Carbon; // 追加

class DeliveryTimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('delivery_times')->insert([
            [
                'curriculums_id' => 1,
                'delivery_from' => date('Y-m-d H:i'), //公開開始日
                'delivery_to' => date('Y-m-d H:i'), //公開終了日
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'curriculums_id' => 2,
                'delivery_from' => date('Y-m-d H:i'), //公開開始日
                'delivery_to' => date('Y-m-d H:i'), //公開終了日
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'curriculums_id' => 3,
                'delivery_from' => date('Y-m-d H:i'), //公開開始日
                'delivery_to' => date('Y-m-d H:i'), //公開終了日
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
        ]);
    }
}
