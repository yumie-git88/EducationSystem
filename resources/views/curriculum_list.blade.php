<<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>授業一覧</title>
</head>

<body>
    <header>
        @include('layouts.app')
    </header>


    <!-- コンテンツ -->
    <main>
    <div class="container">
        <!-- サイドバー -->
        <div class="side">
            <h2>授業一覧</h2>
            <p><a href="{{ route('curriculum_create') }}" class="button button-new">授業新規登録</a></p>
            @foreach($grades as $gradeItem)
            <p><a class="button" href="{{ route('grade_courses', ['grade_id' => $gradeItem->id]) }}">{{ $gradeItem->name }}</a></p>
            @endforeach
        </div>

        <!-- コンテンツ -->
        <div class="body">
            @isset($grade)
            <h2>{{ $grade->name }} の授業一覧</h2>
              <div class="wrap">

               @foreach($curriculums as $curriculum)
    <div class="item">
                @if($curriculum->thumbnail)
    <img src="{{ asset($curriculum->thumbnail) }}" alt="サムネイル">
    @endif
                    <h2>{{ $curriculum->title }}</h2>
                    <h3>{{ $curriculum->description }}</h3>
                  
                    @foreach($curriculum->deliveryTimes as $deliveryTime)
            <p>{{ $deliveryTime->delivery_from }} ～ {{ $deliveryTime->delivery_to }}</p>
        @endforeach
                    <a href="{{ route('curriculum_edit', ['id' => $curriculum->id]) }}" class="button">授業内容編集</a>
                    <a href="{{ route('delivery', ['id' => $curriculum->id]) }}">配信日時設定</a>
                </div>
                @endforeach
            </div>
            @else
            <p>学年に対応する授業が見つかりませんでした。</p>
            @endisset
        </div>
    </div>
</main>

    <!-- 追加 -->
    @yield('content')

</body>
</html>