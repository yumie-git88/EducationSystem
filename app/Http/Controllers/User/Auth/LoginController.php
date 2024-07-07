<?php

namespace App\Http\Controllers\User\Auth; //修正

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // 追記
use Illuminate\Support\Facades\Auth; // 追記

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/user/top'; //修正

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout'); //修正
        // $this->middleware('auth')->only('logout');
    }

    //ログインページの表示 追記
    public function index()
    {
        if (Auth::guard('users')->user()) {
            return redirect()->route('user.top');
        }

        return view('user.auth.login');
    }

    //ログイン処理 追記
    public function login(Request $request)
    {
        $request->validate([ //バリデーション
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'between:8,255'],
        ]);
        
        $credentials = $request->only(['email', 'password']);  //認証情報を受取

        if (Auth::guard('users')->attempt($credentials)) { //ユーザー情報が見つかったらログイン
            return redirect()->route('user.top')->with([
                'login_msg' => 'ログインしました。',
            ]);
        }
        return back()->withErrors([
            'login' => ['ログインに失敗しました'],  //ログインできなかったときに元のページに戻る
        ]);
    }

    //ログアウト処理 追記
    public function logout(Request $request)
    {
        Auth::guard('users')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('login.index')->with([
        'auth' => ['ログアウトしました'],
        ]);
    }

}
