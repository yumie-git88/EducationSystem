@extends('user.layouts.user')

@section('content')
<!-- トップページ -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <!-- テーブルのバナー画像を表示 -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <!-- バナー切り替えボタン -->
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active rounded-circle p-0 img-fluid"
                        style="width:1rem;height:1rem;" aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" class="rounded-circle p-0 img-fluid"
                        style="width:1rem;height:1rem;" aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" class="rounded-circle p-0 img-fluid"
                        style="width:1rem;height:1rem;" aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" class="rounded-circle p-0 img-fluid"
                        style="width:1rem;height:1rem;" aria-label="Slide 4"></button>
                </div>
                <div class="carousel-inner">
                    <!-- バナー画像 -->
                    @foreach($banners as $banner)
                        @if($banner->id==1)
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ $banner->image }}?auto=yes&bg=777&fg=555&text=slide_banner{{ $banner->id }}" alt="slide {{ $banner->id }}">
                            </div>
                        @else
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ $banner->image }}?auto=yes&bg=777&fg=555&text=slide_banner{{ $banner->id }}" alt="slide{{ $banner->id }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">前へ</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">次へ</span>
                </a>
            </div>

            <!-- お知らせ -->
            <div class="my-10">
                <h3 class="mb-2 mt-4"><div>お知らせ</div></h3>
            </div>
            <div class="card">
                <div class="card-body">
                    @if (filled($articles))
                        @foreach($articles as $article)
                            <div class="col row">
                                <div class="col-3">{{ $article->posted_date->format('Y年m月d日') }}</div>
                                <div class="col-9"><a href="{{ route('show.article', ['id'=>$article->id]) }}"
                                    class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">{{ $article->title }}</a></div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
 
@endsection
