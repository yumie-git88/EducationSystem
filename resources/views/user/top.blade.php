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
                    <div class="text-3xl font-semibold mt-2 mb-2 ml-4">お知らせ</div>
                    <div class="overflow-hidden rounded-lg border border-gray-300 mt-4 mb-2 ml-2 w-2/5">
                        <table class="w-full">
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="px-2 py-2">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }}</td>
                                    <td class="px-2 py-2">
                                        <a href="{{ url('/user/article/'.$article->id) }}" class="hover:underline">
                                        {{ $article->title }}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
