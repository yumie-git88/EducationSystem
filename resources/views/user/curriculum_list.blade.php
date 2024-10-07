@extends('user.layouts.user')

@section('content')
<!-- 授業一覧ページ -->
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

                    {{ __('授業一覧ページ') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
