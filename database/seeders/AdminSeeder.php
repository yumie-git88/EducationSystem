<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // 追加
use Illuminate\Support\Facades\Hash; // 追加 パスワードをハッシュ化

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([ // テストデータ追加
            [
              'name' => 'admin',
              'email' => 'developer@gmail.com',
              'password' => Hash::make('password'),
            ],
        ]);
    }
}
