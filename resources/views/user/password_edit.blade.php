@extends('user.layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <a class="text-2xl mt-4 ml-4" href="{{ route('user.show.profile') }}">{{ __('←戻る') }}</a>
                    <div class="text-4xl font-semibold mt-2 mb-4 ml-4">パスワード変更</div>
                    <form method="POST" action="{{ route('user.update.password') }}">
                        @csrf
                        <div>
                            @foreach($errors->all() as $message)
                                <p class="ml-4 mb-4 text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div>
                            <label for="password" class="mb-2 ml-4 w-1/6">旧パスワード</label>
                            <input id="password" name="password" type="password" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4 ml-4"/>
                        </div>
                        <div>
                            <label for="new_password" class="mb-2 ml-4 w-1/6">新パスワード</label>
                            <input id="new_password" name="new_password" type="password" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4 ml-4"/>
                        </div>
                        <div>
                            <label for="new_password_confirmation" class="mb-2 ml-4 w-1/6">新パスワード確認</label>
                            <input id="new_password_confirmation" name="new_password_confirmation" type="password" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4 ml-4"/>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 text-white px-3 ml-3.5 mr-4 mt-10 mb-3">
                                {{ __('登録') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection