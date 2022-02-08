@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @auth
                <h3>スタッフさんようこそ</h3>
                <ul class="uk-list">
                    <li>スマホのカメラを起動して来場者のQRコードをスキャンしてください</li>
                    <li>もしエラーで読み取れない場合は↓のボタンから手作業でチェックイン!</li>
                </ul>
                <a href="{{ url('/s/check_in/input') }}"
                    class="uk-button uk-button-primary uk-button-xlarge form-control">手入力</a>
            @endauth
        </div>
    </div>
@endsection
