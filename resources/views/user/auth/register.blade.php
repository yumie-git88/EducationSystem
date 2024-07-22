@extends('user.layouts.app')

@section('content')
<!-- ユーザー新規登録 -->
<div class="container">
    <div class="d-flex justify-content-end nav h5">
        <a class="nav-link active link-secondary" href="{{ url('/') }}">ログインはこちら</a>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header h1 text-center">{{ __('new_member_registration') }}</div>

                <div class="card-body">
                    <!-- Formの送信先を変更,プラウザの検証機能無効 -->
                    <form id="form" method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- カナ追加 -->
                        <div class="row mb-3">
                            <label for="name_kana" class="col-md-4 col-form-label text-md-end">{{ __('name_kana') }}</label>

                            <div class="col-md-6">
                                <input id="name_kana" type="text" class="form-control @error('name_kana') is-invalid @enderror" name="name_kana" value="{{ old('name_kana') }}" required autocomplete="name_kana" autofocus>

                                @error('name_kana')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-5">
                                <!-- モーダルを開く登録ボタン -->
                                <button type="button" name="btnModal" id="btnModal" class="btn btn-primary btn-lg col px-md-5" data-bs-toggle="modal" data-bs-target="#registerModal">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>

                        <!-- モーダル内容 -->
                        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-title" id="modalLabel"><h4>入力内容の確認</h4></div>
                                        <div class="text-black-60"><p class="p-4">登録内容はこちらでよろしいですか？</p></div>
                                    </div>
                                    <input id="id" type="hidden" name="project_id" value="" />
                                    <div class="modal-body">

                                        <table class="table" id="register_table">
                                            <tbody>
                                                <tr>
                                                    <td>ユーザーネーム</td>
                                                    <td id="modalName"></td>
                                                </tr>
                                                <tr>
                                                    <td>カナ</td>
                                                    <td id="modalKana"></td>
                                                </tr>
                                                <tr>
                                                    <td>メールアドレス</td>
                                                    <td id="modalEmail"></td>
                                                </tr>
                                                <tr>
                                                    <td>パスワード</td>
                                                    <td id="modalPassword">
                                                        @error('password')
                                                            <p>********</p>
                                                        @enderror
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-bs-dismiss="modal">閉じる</button>
                                        <button type="submit" class="btn btn-primary">OK</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
