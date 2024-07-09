<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    protected $redirectTo = '/user/top'; 

    public function showProfileForm()
    {
        $id = Auth::id(); // ログインユーザーのIDを取得
        $user = User::find($id);
        $validation = new StoreUserProfileRequest();

        return view('user.profile_edit', compact('user'), [
            'rules' => $validation->rules()
        ]);
    }

    public function updateProfile(StoreUserProfileRequest $request)
    {
        DB::beginTransaction();

        try {
            $id = Auth::id(); // ログインユーザーのIDを取得
            $user = User::find($id);
    
            // 既存画像を取得
            $existing_image_path = $user->profile_image;
    
            // 新規画像を取得
            $new_image = $request->file('profile_image');
    
            // 画像を更新する場合
            if ($new_image) {
                // 現在の画像ファイルを削除
                if ($existing_image_path) {
                    $existing_image_name = basename($existing_image_path);
                    Storage::disk('public')->delete('images/profile/' . $existing_image_name);
                }
    
                // 新しい画像を保存
                $filename_with_ext = $new_image->getClientOriginalName();
                $path = $new_image->storeAs("public/images/profile/", $filename_with_ext);
    
                // ファイル保存が成功したらDBに保存処理を実行
                if ($path) {
                    $user->profile_image = $filename_with_ext;
                }
            }
    
            // ユーザー情報を更新
            $user->name = $request->name;
            $user->name_kana = $request->name_kana;
            $user->email = $request->email;
            $user->save();
    
            DB::commit();
    
            return redirect()->route('user.show.top')->with('status', 'プロフィールが変更されました');
    
        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => '更新が失敗しました']);
        }
    }
}