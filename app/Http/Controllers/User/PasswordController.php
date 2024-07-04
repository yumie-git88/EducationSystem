<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserPasswordRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    protected $redirectTo = '/user/top'; 

    public function showPasswordFrom()
    {
        $validation = new StoreUserPasswordRequest();

        return view('user.password_edit', [
            'rules' => $validation->rules()
        ]);

        return view('user.password_edit');
    }

    public function updatePassword(StoreUserPasswordRequest $request)
    {
        $id = Auth::id(); // ログインユーザーのIDを取得
        $user = User::find($id);

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => '旧パスワードが正しくありません']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('user.show.top')->with('status', 'パスワードが変更されました');
    }
}