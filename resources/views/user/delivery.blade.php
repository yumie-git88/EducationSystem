@extends('user.layouts.user')

@section('content')
<!-- 配信ページ -->
<div class="container">
    <button type="button" class="btn btn-outline-secondary" onClick="history.back()"><i class="bi bi-arrow-left"></i>戻る</button>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row mb-8">
                <!-- 配信動画 -->
                <div class="col-7">
                    <video class="col-12" controls muted preload="none" oncontextmenu="return false;">
                        <source src="https://www.nhk.or.jp/das/movie/D0002160/D0002160257_00000_V_000.mp4" type="video/mp4">
                    </video>
                </div>
    
                @if(1)
                    <!-- 受講ボタン -->
                    <div class="col-5 my-auto">
                        <button type="button" class="btn btn-warning btn-lg rounded-pill" onClick="history.back()">受講しました</button>
                    </div>
                @else
                    <!-- 受講ボタン受講後 無効化 -->
                    <div class="col-5 my-auto">
                        <button type="button" class="btn btn-success btn-lg rounded-pill" disabled>
                            <i class="bi bi-check-lg"></i>受講しました</button>
                    </div>
                @endif
                    <!-- 受講ボタン非公開 無効化 -->
                    <div class="col-5 my-auto">
                        <button type="button" class="btn btn-secondary btn-lg rounded-pill" disabled>受講しました</button>
                    </div>
            </div>

            <!-- 学年 -->
            <div class="mb-2 mt-4">
                授業クラス
            </div>
            
            <!-- 授業内容 -->
            <div class="my-10">
                <h3 class="mb-2 mt-4"><div>授業タイトル</div></h3>
                <div class="mb-2 mt-4">講座内容</div>
                <div class="mb-2 mt-4">講座説明</div>
            </div>
        </div>
    </div>
</div>
@endsection
