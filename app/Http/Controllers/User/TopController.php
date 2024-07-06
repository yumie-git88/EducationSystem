<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Article;

class TopController extends Controller
{
    public function showTop()
    {
        $articles = Article::all();
        return view('user.top', compact('articles'));
    }
}
