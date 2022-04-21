@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if(auth::user()->is_staff)
                <h3>スタッフさんようこそ</h3>
                <ul class="uk-list">
                    <li>スマホのカメラを起動して来場者のQRコードをスキャンしてください</li>
                    <li>もしエラーで読み取れない場合は↓のボタンから手作業でチェックイン!</li>
                </ul>
                <a href="{{ url('/s/check_in/input') }}"
                    class="uk-button uk-button-primary uk-button-xlarge form-control">チェックイン</a>
            @endif

            @if(auth::user()->is_admin)
            <h3>管理者さんようこそ!</h3>
            @endauth
        </div>
    </div>
@endsection
