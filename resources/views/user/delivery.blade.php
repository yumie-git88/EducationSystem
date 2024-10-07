@extends('user.layouts.user')

@section('content')
<!-- 配信ページ -->
<div class="container">
    <div>
        <button type="button" class="btn btn-outline-secondary mb-4" onClick="history.back()"><i class="bi bi-arrow-left"></i>戻る</button>
    </div>
    <div class="justify-content-center">
        <div class="container">
            <div class="row">
                <!-- 配信動画/画像 -->
                <div class="col-md-7">
                    @if($curriculums->alway_delivery_flg == 1 || $deliveryTime == 1)
                        <!-- 動画公開 -->
                        <div class="video">
                            <video class="w-100" controls muted preload="none" oncontextmenu="return false;">
                                <source src="{{ $curriculums->video_url }}" type="video/mp4">
                            </video>
                        </div>
                    @else
                        <!-- 動画非公開 -->
                        <div class="video_img"><img src="{{ asset('storage/images/video_img/D0002160257_00000_S_002.jpg')}}" class="img-fluid" alt="配信非公開"></div>
                    @endif
                </div>

                <!-- 受講ボタン -->
                <div class="col-md-5 my-auto">
                    @if($curriculums->alway_delivery_flg == 1 || $deliveryTime == 1)
                        @if($curricurum_progress->clear_flg == 1)
                            <!-- 受講ボタン受講後 無効化 -->
                            <button id="flgBtn1" class="btn btn-success btn-lg rounded-pill align-middle my-2" disabled>
                            <i class="bi bi-check-lg"></i>受講しました</button>
                        @else
                            <!-- 受講ボタン -->
                            <form method="post">
                                @csrf
                                <input type="hidden" name="curriculum_id" value="<?php echo $curriculums['id']; ?>">
                                <input type="hidden" name="clear_flg" value="true">
                                <button id="flgBtn0" type="submit" class="btn btn-warning btn-lg rounded-pill align-middle my-2" name="update">受講しました</button>
                            </form>
                        @endif
                    @else
                        <!-- 受講ボタン非公開 無効化 -->
                        <button id="btnDisabled" type="submit" class="btn btn-secondary btn-lg rounded-pill align-middle my-2" disabled>受講しました</button>
                    @endif
                </div>

        <div class="container">
            <!-- 学年/クラス -->
            <div class="mt-4 text-center">
                <p class="col-sm-3 bg-info text-white rounded p-2">{{ $curriculums->grade->name }}</p>
            </div>
            
            <!-- 授業内容 -->
            <div class="my-10">
                <h3 class="mb-2 mt-4"><div class="border-bottom">{{ $curriculums->title }}</div></h3>
                <div class="mb-2 mt-4">{{ $curriculums->thumbnail }}</div>
                <div class="mb-2 mt-4">{{ $curriculums->description }}</div>
            </div>
        </div>
    </div>
</div>
@endsection
