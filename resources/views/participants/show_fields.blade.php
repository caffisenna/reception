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
        <td>{{ $participant->district }} {{ $participant->dan_name }} {{ $participant->dan_number }}</td>
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
        <td>UUID</td>
        <td>{{ $participant->uuid }}</td>
    </tr>
    <tr>
        <td>QRコード</td>
        <td>{!! QrCode::size(150)->generate($participant->uuid) !!}</td>
    </tr>
</table>
