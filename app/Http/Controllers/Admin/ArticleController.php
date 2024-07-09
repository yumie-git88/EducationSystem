<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdminArticleRequest;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();

        try {
            Article::create([
                'posted_date' => $request->posted_date,
                'title' => $request->title,
                'article_contents' => $request->article_contents
            ]);

            DB::commit();
            return to_route('admin.show.article.list')->with('status', 'お知らせを登録しました');
        } catch (\Exception $e) {
            DB::rollback();
            report($e);
            return back()->with('error', '記事の登録に失敗しました');
        }
    }

    public function destroyArticle($id)
    {
        DB::beginTransaction();

        try {
            $article = Article::find($id);
            if ($article) {
                $article->delete();
                DB::commit();
                return response()->json(['success' => true]);
            } else {
                DB::rollback();
                return response()->json(['error' => '記事が見つかりません'], 404);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollback();
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
        DB::beginTransaction();

        try {

            $article = Article::find($id);

            if ($article) {
                $article->update([
                    'posted_date' => $request->posted_date,
                    'title' => $request->title,
                    'article_contents' => $request->article_contents,
                ]);
                DB::commit();
                return to_route('admin.show.article.list')->with('status', 'お知らせを変更しました');
            } else {
                DB::rollback();
                return back()->with('error', '記事が見つかりません');
            }

        } catch (\Exception $e) {
            DB::rollback();
            report($e);
            return back()->with('error', 'お知らせの変更に失敗しました');
        }
    }
}