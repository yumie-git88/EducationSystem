<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\User; // 必要なモジュールを読込

use App\Models\Banner; // モデルを現在のファイルで使用する宣言
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; //追記

class TopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();  // 全ての情報を取得
        $articles = Article::all();  

        return view('user.top', compact('banners', 'articles')); // userディレクトリのTOP画面に情報を渡す

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // 送られたデータをデータベースに保存するメソッド
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('user.top', compact('banners', 'articles')); // userディレクトリのTOP画面に情報を渡す
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }

    public function __construct() //未ログインでも特定のページにアクセス
    {
        $this->middleware('auth')
            ->except('top');
    }

}
