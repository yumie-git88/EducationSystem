<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //追加

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('articles')->insert([
            [
                'title' => 'お知らせタイトル',
                'posted_date' => date('Y年m月d日 H:i:s'),
                'article_contents' => '授業内容更新についてのお知らせ',
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'title' => 'お知らせタイトル',
                'posted_date' => date('Y年m月d日 H:i:s'),
                'article_contents' => '授業内容更新についてのお知らせ',
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'title' => 'お知らせタイトル',
                'posted_date' => date('Y年m月d日 H:i:s'),
                'article_contents' => '授業内容更新についてのお知らせ',
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'title' => 'お知らせタイトル',
                'posted_date' => date('Y年m月d日 H:i:s'),
                'article_contents' => '授業内容更新についてのお知らせ',
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
            [
                'title' => 'お知らせタイトル',
                'posted_date' => date('Y年m月d日 H:i:s'),
                'article_contents' => '授業内容更新についてのお知らせ',
                'created_at' => date('Y-m-d H:i'),
                'updated_at' => date('Y-m-d H:i'),
            ],
        ]);
    }
}
