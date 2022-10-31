@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @if (auth::user()->is_staff)
                <div class="uk-card uk-card-primary uk-card-body uk-width-1-2@m">
                    <h3 class="uk-card-title">QRスキャン開始</h3>
                    <ul class="uk-list">
                        <li>ブラウザはこのまま、スマホのカメラを起動して来場者のQRコードをスキャンしてください</li>
                    </ul>
                </div>
                <div class="uk-card uk-card-secondary uk-card-body uk-width-1-2@m">
                    <h3 class="uk-card-title">手動チェックイン</h3>
                    <ul class="uk-list">
                        <li>もしエラーで読み取れない場合は↓のボタンから手作業でチェックイン!</li>
                    </ul>
                    <a href="{{ url('/s/check_in/input') }}"
                        class="uk-button uk-button-primary uk-button-xlarge uk-width-1-1">手動チェックイン画面へ</a>
                </div>
            @endif

            @if (auth::user()->is_admin)
                <p class="uk-text-large">県連代表 未登録分</p>
                <table class="uk-table uk-table-divider uk-table-responsive uk-table-striped uk-table-hover">
                    <tr>
                        <th>県連</th>
                        <th>役務</th>
                    </tr>
                    @foreach ($participants as $participant)
                        <tr>
                            <td>{{ $participant->pref }}</td>
                            <td>{{ $participant->role }}</td>
                        </tr>
                    @endforeach
                </table>
            @endauth
        </div>
    </div>
</div>
@endsection
