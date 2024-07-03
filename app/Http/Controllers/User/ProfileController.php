<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    protected $redirectTo = '/user/top';

    public function edit($id = null)
    {
        $id = Auth::id(); // ログインユーザーのIDを取得
        $user = User::find($id);
        $validation = new StoreUserProfileRequest();
        
        if (!$user) {
            abort(404); // ユーザーが見つからない場合は404エラーを返す
        }

        return view('user.profile_edit', compact('user'), [
            'rules' => $validation->rules()
        ]);
    }

    public function update(StoreUserProfileRequest $request, $id = null)
    {
        try {
            $id = Auth::id(); // ログインユーザーのIDを取得
            $user = User::find($id);

            // 既存画像を取得
            $path = $request->profile_image;

            // 新規画像を取得
            $img = $request->file('profile_image');

            // 画像を更新する場合
            if (isset($img)) {
                
                // 現在の画像ファイルの削除
                $img_name = $user->profile_image;

                // /storage/app/public/img/画像ファイル名 を削除
                $img_name = str_replace('public/images/profile/', '', $img_name);
                Storage::disk('public')->delete('images/profile/' . $img_name);

                // 拡張子付きでファイル名を取得
                $filename_with_ext = $img->getClientOriginalName();

                // 画像フォームでリクエストした画像を取得して画像を保存
                $path = $img->storeAs("public/images/profile/", $filename_with_ext);

                // store処理が実行できたらDBに保存処理を実行
                if ($path) {
                    $user->name = $request->name;
                    $user->name_kana = $request->name_kana;
                    $user->email = $request->email;
                    $user->profile_image = $filename_with_ext;
                    $user->save();
                }
            }

            // 画像を更新しない場合
            if (!isset($img)) {
                $user->name = $request->name;
                $user->name_kana = $request->name_kana;
                $user->email = $request->email;
                $user->save();
            }
            
            return to_route('user.show.top');

        } catch (\Exception $e) {
            report($e);
            session()->flash('flash_message', '更新が失敗しました');
        }
    }
}