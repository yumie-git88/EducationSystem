<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>配信日時設定</title>
</head>

<body>
    <!-- ヘッダー -->
    <header>
        @include('layouts.app')
    </header>

    <main>
        <h2>{{ $curriculum->title }} の配信日時設定</h2>

        <!-- エラーメッセージ表示 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- 日時入力行 -->
        <form action="{{ route('save_delivery_times', ['id' => $curriculum->id]) }}" method="POST" enctype="multipart/form-data" id="deliveryForm">
            @csrf

            <!-- 初期の日時入力行 -->
            <div id="datetime-rows">
                @if(isset($existingDeliveryTimes))
                    @foreach($existingDeliveryTimes as $dateTime)
                        <div class="datetime-row">
                            <input type="date" name="start_dates[]" value="{{ old('start_dates.'.$loop->index, $dateTime['start_date']) }}">
                            <input type="time" name="start_times[]" value="{{ old('start_times.'.$loop->index, $dateTime['start_time']) }}">
                            ～
                            <input type="date" name="end_dates[]" value="{{ old('end_dates.'.$loop->index, $dateTime['end_date']) }}">
                            <input type="time" name="end_times[]" value="{{ old('end_times.'.$loop->index, $dateTime['end_time']) }}">
                            <button class="remove-btn" type="button">削除</button>
                        </div>
                    @endforeach
                @else
                    <div class="datetime-row">
                        <input type="date" name="start_dates[]">
                        <input type="time" name="start_times[]">
                        ～
                        <input type="date" name="end_dates[]">
                        <input type="time" name="end_times[]">
                        <button class="remove-btn" type="button">削除</button>
                    </div>
                @endif
            </div>

            <!-- 追加ボタン -->
            <button id="addDateTimeRow" type="button">日時入力の行を増やす</button>

            <!-- 登録ボタン -->
            <p><button type="submit">登録</button></p>
        </form>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const addDateTimeButton = document.getElementById('addDateTimeRow');
            const datetimeRowsContainer = document.getElementById('datetime-rows');

            // 追加ボタンの処理
            addDateTimeButton.addEventListener('click', function() {
                const newDateTimeRow = document.createElement('div');
                newDateTimeRow.classList.add('datetime-row');
                newDateTimeRow.innerHTML = `
                    <input type="date" name="start_dates[]">
                    <input type="time" name="start_times[]">
                    ～
                    <input type="date" name="end_dates[]">
                    <input type="time" name="end_times[]">
                    <button class="remove-btn" type="button">削除</button>
                `;
                datetimeRowsContainer.appendChild(newDateTimeRow);
            });

            // 削除ボタンの処理
            datetimeRowsContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-btn')) {
                    event.target.parentNode.remove();
                }
            });
        });
    </script>

</body>

</html>