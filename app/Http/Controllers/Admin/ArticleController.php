<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticleList()
    {
        $articles = Article::all();
        return view('admin.article_list', compact('articles'));
    }

    public function showArticleCreate()
    {
        $validation = new StoreAdminArticleRequest();

        return view('admin.article_create', [
            'rules' => $validation->rules()
        ]);
    }

    public function storeArticleCreate(StoreAdminArticleRequest $request)
    {
        try {
            Article::create([
                'posted_date' => $request->posted_date,
                'title' => $request->title,
                'article_contents' => $request->article_contents
            ]);
            return to_route('admin.show.article.list')->with('status', 'お知らせを登録しました');

        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '登録が失敗しました');
        }
    }

    public function destroyArticle(Request $request, $id)
    {
        try {
            $article = Article::find($id);
            if ($article) {
                $article->delete();
            }
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => '削除に失敗しました'], 500);
        }
    }

    public function showArticleEdit($id)
    {
        $article = Article::find($id);
        $validation = new StoreAdminArticleRequest();

        return view('admin.article_edit', compact('article'), [
            'rules' => $validation->rules()
        ]);
    }

    public function updateArticleEdit(StoreAdminArticleRequest $request, $id)
    {
        try {

            $article = Article::find($id);

            $article->posted_date = $request->posted_date;
            $article->title = $request->title;
            $article->article_contents = $request->article_contents;
            $article->save();

            return to_route('admin.show.article.list')->with('status', 'お知らせを変更しました');

        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '登録が失敗しました');
        }
    }
}