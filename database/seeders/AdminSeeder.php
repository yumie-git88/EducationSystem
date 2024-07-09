<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use DateTime;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
          'name' => 'ユーザー1',
          'kana' => 'ユーザーワン',
          'email' => 'user1@user1.com',
          'password' => Hash::make('password'),
          'created_at' => new DateTime(),
          'updated_at' => new DateTime()
        ]);
    }
}
