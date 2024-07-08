<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class CurriculumProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('curricurum_progress')->insert([
            [ 'curriculumus_id' => 1,
              'users_id' => 1,
              'clear_flg' => 1,
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'curriculumus_id' => 2,
              'users_id' => 1,
              'clear_flg' => 1,
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'curriculumus_id' => 3,
              'users_id' => 1,
              'clear_flg' => 0,
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ]
        ]);
    }
}
