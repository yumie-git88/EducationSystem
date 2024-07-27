<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>授業登録</title>
</head>

<body>
    <header>
        @include('layouts.app')
    </header>

    <main>
        <h2>授業登録</h2>

        <!-- エラーメッセージの表示 -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('curriculum_create.data') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="item">
                <th><label for="thumbnail">サムネイル:</label></th>
                <td><input type="file" id="thumbnail" name="thumbnail"></td>
            </div>

            <p><label for="grade_id">学年</label></p>
            <select id="grade_id" name="grade_id" required>
                <option value="">--選択してください--</option>
                @foreach($grades as $grade)
                    <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                        {{ $grade->name }}
                    </option>
                @endforeach
            </select>

            <p><label for="title">授業名</label></p>
            <input type="text" id="title" name="title" value="{{ old('title') }}" required>

            <p><label for="url">動画URL</label></p>
            <input type="text" id="url" name="url" value="{{ old('url') }}" required>

            <p><label for="description">カリキュラム説明文:</label></p>
            <textarea id="description" name="description">{{ old('description') }}</textarea>

            <p><label for="alway_delivery_flg">常時公開フラグ:</label></p>
            <input type="checkbox" id="alway_delivery_flg" name="alway_delivery_flg" value="1" {{ old('alway_delivery_flg') ? 'checked' : '' }}>

            <p><input type="submit" value="授業登録"></p>
        </form>
    </main>
</body>

</html>