<table class="uk-table uk-table-hover uk-table-striped">
    <tr>
        <td>氏名</td>
        <td>{{ $participant->name }} ({{ $participant->furigana }})</td>
    </tr>
    <tr>
        <td>座席番号</td>
        <td>{{ $participant->seat_number }}</td>
    </tr>
    <tr>
        <td>県連盟</td>
        <td>{{ $participant->pref }}</td>
    </tr>
    <tr>
        <td>所属</td>
        <td>{{ $participant->district }} {{ $participant->dan_name }}</td>
    </tr>
    <tr>
        <td>役務</td>
        <td>{{ $participant->role }}</td>
    </tr>
    <tr>
        <td>email</td>
        <td>{{ $participant->email }}</td>
    </tr>
    <tr>
        <td>電話</td>
        <td>{{ $participant->phone }}</td>
    </tr>
    <tr>
        <td>UUID<br>マイページ</td>
        <td><a href="{{ url('/mypage?id=').$participant->uuid }}">{{ $participant->uuid }}</a></td>
    </tr>
    <tr>
        <td>QRコード</td>
        <td>{!! QrCode::size(150)->generate('https://reception.rs100.info/mypage?id='.$participant->uuid) !!}</td>
    </tr>
    <tr>
        <td>チェックイン</td>
        <td>{{ $participant->checkedin_at }}</td>
    </tr>
</table>
