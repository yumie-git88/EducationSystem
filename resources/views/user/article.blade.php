@extends('user.layouts.user')

@section('content')
<!-- お知らせ詳細ページ -->
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

                    {{ __('お知らせ詳細ページ') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
