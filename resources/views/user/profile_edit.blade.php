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
                    <a class="text-2xl" href="{{ route('user.show.top') }}">{{ __('←戻る') }}</a>
                    <div class="text-4xl font-semibold mt-2 mb-4">プロフィール変更</div>
                    <form id="form-area" class="" method="post" action="{{ route('user.show.update') }}" enctype="multipart/form-data">
                        @csrf
                        <div>
                            @foreach($errors->all() as $message)
                                <p class="ml-4 mb-4 text-danger">{{$message}}</p>
                            @endforeach
                        </div>
                        <div class="mb-2 ml-4 flex items-start">
                            <div id="del_dis" class="mr-4">
                                @if ($user->profile_image !== null)
                                    <img id="profile-img" class="sm:h-32 lg:h-40 mb-2" src="{{ Storage::url('images/profile/'.$user->profile_image) }}">
                                @else
                                    <img id="profile-img" class="sm:h-32 lg:h-40 mb-2" src="{{ Storage::url('images/profile/no_image.png') }}">
                                @endif
                            </div>
                            <div id="preview"></div>
                            <div>
                                <label class="text-2xl block mb-4 ml-6">プロフィール画像</label>
                                <input id="profile_image" name="profile_image" type="file" onChange="imgPreView(event); deleteDisplay()" multiple accept="image/jpeg,image/png" class="w-full text-sm file:mr-4 file:rounded-md file:border-0 file:bg-primary-500 file:py-2.5 file:px-4 file:text-sm file:font-medium file:text-black hover:file:bg-primary-700 focus:outline-none disabled:pointer-events-none disabled:opacity-60 ml-6"/>
                            </div>
                        </div>
                        <div>
                            <label for="name" class="mb-2 ml-4 w-1/6">ユーザーネーム</label>
                            <input id="name" name="name" type="text" value="{{ $user->name }}" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4 ml-4"/>
                        </div>
                        <div>
                            <label for="name_kana" class="mb-2 ml-4 w-1/6">カナ</label>
                            <input id="name_kana" name="name_kana" type="text" value="{{ $user->name_kana }}" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4 ml-4"/>
                        </div>
                        <div>
                            <label for="email" class="mb-10 ml-4 w-1/6">メールアドレス</label>
                            <input id="email" name="email" type="text" value="{{ $user->email }}" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-3/5 p-2.5 mt-4 ml-4"/>
                        </div>
                        <div>
                            <label for="password" class="mb-10 ml-4 w-1/6">パスワード</label>
                            <a href="{{ route('user.show.password.edit') }}" class="inline-block bg-cyan-500 hover:bg-cyan-400 text-white py-2 px-4 rounded ml-4">
                                {{ __('パスワードを変更する') }}
                            </a>
                        </div>
                        <div class="flex justify-center">
                            <button type="submit" class="btn bg-amber-500 hover:bg-amber-400 text-white px-3 ml-3.5 mr-4 mt-2 mb-3">
                                登録
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function imgPreView(event){
    var file = event.target.files[0];
    var reader = new FileReader();
    var preview = document.getElementById("preview");
    var previewImage = document.getElementById("previewImage");
    
    if(previewImage != null)
    preview.removeChild(previewImage);

    reader.onload = function(event) {
        var img = document.createElement("img");
        img.setAttribute("src", reader.result);
        img.setAttribute("id", "previewImage");
        preview.appendChild(img);
        preview.classList.add('flex');
        preview.classList.add('mr-4');
        preview.classList.add('sm:h-32');
        preview.classList.add('lg:h-40');
        preview.classList.add('mb-2');
    };

  reader.readAsDataURL(file);
}

const deleteDisplay = () => {
    var ele = document.getElementById('del_dis');
    
    if (ele.style.display != 'none') {
        ele.style.display = 'none'; 
    }
};
</script>

@endsection
