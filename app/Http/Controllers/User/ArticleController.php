<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticle($id)
    {
        $article = Article::find($id);

        // 記事が存在しない場合はトップページにリダイレクト
        if (!$article) {
            return redirect()->route('user.show.top')->with('status', '記事が見つかりません');
        }

        // 記事が存在する場合は詳細ページを表示
        return view('user.article', compact('article'));
    }
}