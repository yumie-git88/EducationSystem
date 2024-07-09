<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use DateTime;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [ 'title' => 'お知らせタイトル1',
              'posted_date' => '2024-07-01 00:00:00',
              'article_contents' => 'お知らせタイトル1の本文です。',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'title' => 'お知らせタイトル2',
              'posted_date' => '2024-07-02 00:00:00',
              'article_contents' => 'お知らせタイトル2の本文です。',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ],
            [ 'title' => 'お知らせタイトル3',
              'posted_date' => '2024-07-03 00:00:00',
              'article_contents' => 'お知らせタイトル3の本文です。',
              'created_at' => new DateTime(),
              'updated_at' => new DateTime() ] 
        ]);
    }
}
