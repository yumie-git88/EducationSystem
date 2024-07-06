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
                    <a class="text-2xl mt-4 ml-4" href="{{ route('user.show.top') }}">{{ __('←戻る') }}</a>
                    <div class="text-2xl mt-4 ml-4">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }}</div>
                    <div class="text-3xl font-semibold ml-4">{{ $article->title }}</div>
                    <div class="mt-4 mb-4 ml-4">{{ $article->article_contents }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
