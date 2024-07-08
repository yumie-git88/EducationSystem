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
                    <a class="text-2xl mt-4 ml-4" href="{{ route('user.show.progress') }}">{{ __('←戻る') }}</a>
                    <div class="text-2xl block mb-4 mt-4 ml-2">
                        @php
                            $gradeName = $curriculum->grade->name;
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
                    <div class="text-3xl font-semibold mt-4 ml-4">{{ $curriculum->title }}</div>
                    <div class="mt-4 mb-4 ml-4">{{ $curriculum->description }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
