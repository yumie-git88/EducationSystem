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
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    <a class="text-2xl mt-4 ml-4" href="{{ route('admin.show.top') }}">{{ __('←戻る') }}</a>
                    <div class="text-4xl font-semibold mt-2 mb-4 ml-4">お知らせ一覧</div>
                    <div>
                        <a href="{{ route('admin.show.article.create') }}" class="inline-block bg-cyan-500 hover:bg-cyan-400 text-white py-2 px-4 rounded ml-4">
                            {{ __('新規登録') }}
                        </a>
                    </div>
                    <table id="fav-table" class="product-table w-4/5 mt-4 ml-4">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">投稿日時</th>
                                <th class="px-4 py-2">タイトル</th>
                                <th class="px-4 py-2" colspan="2"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($articles as $article)
                            <tr>
                                <td class="px-4 py-2">{{ \Carbon\Carbon::parse($article->posted_date)->format('Y年n月j日') }}</td>
                                <td class="px-4 py-2">{{ $article->title }}</td>
                                <td class="pl-4 pr-0.5 py-2">
                                    <div class="text-center">
                                    <button type="submit" class="btn bg-cyan-500 hover:bg-cyan-400 text-white">
                                        <a class="nav-link" href="{{ route('admin.show.article.edit', ['id' => $article->id] ) }}">{{ __('変更する') }}</a>
                                    </button>
                                    </div>
                                </td>
                                <td class="pl-0.5 pr-4 py-2">
                                    <button data-article_id="{{ $article->id }}" type="button" class="btn bg-rose-500 hover:bg-rose-400 text-white btn-dell">削除</button>
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

<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}'
    }
});

$(document).ready(function() {
    $('.btn-dell').off('click').on('click', function(e) {
        e.preventDefault(); // ボタンのデフォルトの動作を無効化
        var deleteConfirm = confirm('本当に削除していいですか?');
        if (deleteConfirm == true) {
            var clickEle = $(this);
            var articleID = clickEle.attr('data-article_id');
            $.ajax({
                type: 'DELETE',
                url: '{{ url("admin/article_destroy") }}/' + articleID,
                success: function(data) {
                    if (data.success) {
                        clickEle.closest('tr').remove(); // 削除成功時に行を削除
                    } else {
                        alert('削除に失敗しました');
                    }
                },
                error: function(data) {
                    alert('削除に失敗しました');
                }
            });
        }
    });
});
</script>
@endsection
