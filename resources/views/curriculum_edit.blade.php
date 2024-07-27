<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <title>授業内容修正</title>
</head>

<body>
    <header>
        @include('layouts.app')
    </header>

    <main>
    <P><h2>授業内容修正</h2></P>
        
    <form action="{{ route('curriculum_update', ['id' => $curriculum->id]) }}" method="POST" enctype="multipart/form-data">
    @csrf

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif



    @if($curriculum->thumbnail)
   　 <img src="{{ asset($curriculum->thumbnail) }}" alt="現在のサムネイル" style="max-width: 15%; height: auto;">
　　@endif

<div class="form-group">
                <label for="grade_id">学年:</label>
                <select name="grade_id">
                    @foreach($grades as $grade)
                        <option value="{{ $grade->id }}" {{ $curriculum->grade_id == $grade->id ? 'selected' : '' }}>
                            {{ $grade->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <th><label for="thumbnail">サムネイル:</label></th>
                <td><input type="file" name="thumbnail"></td>
            </div>

            <div class="form-group">
                <label for="title">授業名:</label>
                <input type="text" name="title" value="{{ $curriculum->title }}">
            </div>

            <div class="form-group">
                <label for="video_url">動画URL:</label>
                <input type="text" name="video_url" value="{{ $curriculum->video_url }}">
            </div>

            <div class="form-group">
                <label for="description">授業概要:</label>
                <textarea name="description">{{ $curriculum->description }}</textarea>
            </div>

            <div class="form-group">
  <label for="alway_delivery_flg">常時公開:</label>
  <input type="checkbox" name="alway_delivery_flg" value="1" {{ $curriculum->alway_delivery_flg ? 'checked' : '' }}>
</div>

            <button type="submit">更新</button>
</form>
    </main>
</body>
</html>