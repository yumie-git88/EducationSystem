<?php

namespace App\Http\Controllers\Admin\Auth; //修正

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider; // 追記
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth; // 追記
use Illuminate\Http\Request; // 追記

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

    // use AuthenticatesUsers;
    use AuthenticatesUsers { //追記
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/top'; //修正

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout'); //修正
        // $this->middleware('auth')->only('logout');
    }

    protected function guard() //追記
    {
        return Auth::guard('admin');
    }
    
    //ログインページの表示 追記
    public function index()
    {
        if (Auth::guard('admins')->user()) {
            return redirect()->route('admin.top');
        }

        return view('admin.login.index');
    }
    
    //ログイン処理 追記
    public function login(Request $request)
    {
        $credentials = $request->only(['email', 'password']); //認証情報を受取
        
        if (Auth::guard('admins')->attempt($credentials)) { //ユーザー情報が見つかったらログイン
            return redirect()->route('admin.top')->with([
                'login_msg' => 'ログインしました。',
            ]);
        }
        return back()->withErrors([
            'login' => ['ログインに失敗しました'], //ログインできなかったときに元のページに戻る
        ]);
    }

    //ログアウト処理
    public function logout(Request $request) //追記
    {
        // $this->performLogout($request); //削除
        // return redirect('admin/auth/login'); //削除
        
        Auth::guard('admins')->logout();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.index')->with([
        'logout_msg' => 'ログアウトしました', //ログインページにリダイレクト
        ]);
    }
}
