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
                    <a class="text-2xl mt-4 ml-4" href="{{ route('user.show.top') }}">{{ __('←戻る') }}</a>
                    <div class="mt-2 mb-2 ml-4 flex items-center">
                        <div class="mr-4">
                            @if ($user->profile_image !== null)
                                <img id="profile-img" class="sm:h-32 lg:h-40 mb-2" src="{{ Storage::url('images/profile/'.$user->profile_image) }}">
                            @else
                                <img id="profile-img" class="sm:h-32 lg:h-40 mb-2" src="{{ Storage::url('images/profile/no_image.png') }}">
                            @endif
                        </div>
                        <div>
                            <div class="text-2xl block mb-4 ml-2">{{ $user->name }}さんの授業進捗</div>
                            <div class="text-2xl block mb-4 ml-2">
                                現在の学年：
                                @php
                                    $gradeName = $user->grade->name;
                                    $bgClass = 'bg-cyan-400';
                                    if (str_contains($gradeName, '中学校')) {
                                        $bgClass = 'bg-emerald-400';
                                    }
                                    if (str_contains($gradeName, '高校')) {
                                        $bgClass = 'bg-lime-400';
                                    }
                                @endphp
                                <span class="{{ $bgClass }} text-white rounded px-4 py-2">
                                    {{ $gradeName }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4 ml-4 mr-4 mt-4">
                        @foreach ($grades as $grade)
                            @php
                                $gradeName = $grade->name;
                                $gradeId = $user->grade->id;
                                $bgClass = 'bg-cyan-400';
                                if (str_contains($gradeName, '中学校')) {
                                    $bgClass = 'bg-emerald-400';
                                }
                                if (str_contains($gradeName, '高校')) {
                                    $bgClass = 'bg-lime-400';
                                }
                            @endphp
                            <div>
                                <div class="{{ $bgClass }} text-center text-white rounded px-4 py-2">
                                    {{ $grade->name }}
                                </div>
                                <div class="ml-4">
                                @foreach ($curriculums->where('grade_id', $grade->id) as $curriculum)
                                    @php
                                        $progress = $curriculum_progress->where('curriculumus_id', $curriculum->id)->first();
                                        $clearFlg = $progress ? $progress->clear_flg : false;
                                    @endphp
                                    <div class="flex items-center px-2 py-2 mb-2">
                                        <div style="width: 70px;">
                                            @if ($clearFlg)
                                                <span class="text-red-500">受講済</span>
                                            @endif
                                        </div>
                                        @if ($grade->id <= $gradeId)
                                            <a class="hover:underline ml-2" href="{{ url('user/delivery/'.$curriculum->id) }}">{{ $curriculum->title }}</a>
                                        @else
                                            <span class="ml-2">{{ $curriculum->title }}</span>
                                        @endif
                                    </div>
                                @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
