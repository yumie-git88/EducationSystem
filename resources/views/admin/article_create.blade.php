@extends('admin.layouts.app')

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
                    <a class="text-2xl mt-4 ml-4" href="{{ route('admin.show.article.list') }}">{{ __('←戻る') }}</a>
                    <div class="text-4xl font-semibold mt-2 mb-4 ml-4">お知らせ登録</div>
                    <form id="form-area" class="" method="post" action="{{ route('admin.store.article.create') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            @foreach($errors->all() as $message)
                                <p class="ml-4 mb-4 text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div class="flex items-start mb-4">
                            <label for="posted_date" class="mb-2 ml-4 w-1/6">投稿日時</label>
                            <input id="posted_date" name="posted_date" type="datetime-local" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 ml-4"/>
                        </div>
                        <div class="flex items-start mb-4">
                            <label for="title" class="mb-2 ml-4 w-1/6">タイトル</label>
                            <input id="title" name="title" type="text" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 ml-4"/>
                        </div>
                        <div class="flex items-start mb-10">
                            <label for="article_contents" class="mb-10 ml-4 w-1/6">本文</label>
                            <textarea id="article_contents" name="article_contents" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 ml-4" rows="10"></textarea>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 text-white px-3 ml-3.5 mr-4 mt-2 mb-3">
                                登録
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
