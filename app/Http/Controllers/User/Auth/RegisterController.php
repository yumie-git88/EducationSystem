<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth; // 追記

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/user/top'; //修正2 ログインに成功後のリダイレクト先

    // /**
    //  * Create a new controller instance.
    //  *
    //  * @return void
    //  */
    // public function __construct()
    // {
    //     $this->middleware('guest:user'); //修正
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'name_kana' => ['required', 'string', 'max:255', 'name_kana'], //追加
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'between:8,255', 'confirmed'], //追加
        ]);
        if ($validator->fails()) {
            Session::flash('errors', $validator->messages()); // エラーメッセージをセッションに保存
            return redirect()->back()->withInput();
        }
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $grade = Grade::all()->first(); //追加 最初の要素を取得

        return User::create([
            'name' => $data['name'],
            'name_kana' => $data['name_kana'], //追加
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'grade_id' => $grade->id,  //追加 外部キー作成
        ]);
    }

    public function index()
    {
        return view('user.auth.register');
    }
}
