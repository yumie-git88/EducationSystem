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
        return view('user.article', compact('article'));
    }
}