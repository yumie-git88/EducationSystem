<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use DateTime;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'name' => 'ユーザー1',
          'name_kana' => 'ユーザーワン',
          'email' => 'user1@user1.com',
          'password' => Hash::make('password'),
          'grade_id' => 1,
          'created_at' => new DateTime(),
          'updated_at' => new DateTime()
        ]);
    }
}
